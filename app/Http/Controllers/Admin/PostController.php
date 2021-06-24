<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Category;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Tag;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $posts = Post::all();

        return view('admin.posts.index', compact('posts', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        $categories = Category::all();
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // VALIDATION
        $request->validate([
            'title' => 'required|unique:posts',
            'content' => 'required',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|exists:tags,id'
        ]);


        $data = $request->all();

        $post = new Post();
        
        $data['slug'] = Str::slug($data['title'], '-');

        $post->fill($data);

        $post->save();

        //salvare relazioni nella tabella pivot
        if(array_key_exists('tags', $data)){
            $post->tags()->attach($data['tags']);
        }

        return redirect()->route('admin.posts.show', $post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);

        if(!$post){
            abort(404);
        }

        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();

        if($post){
            return view('admin.posts.edit', compact('post', 'categories', 'tags'));
        }
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        $post = Post::find($id);

        if($data['title'] != $post->title){
            $data['slug'] = Str::slug($data['title'], '-');
        }

        $request->validate([
            'title' => [
                'required',
                Rule::unique('posts')->ignore($id),
            ],
            'tags' => 'nullable|exists:tags,id',
            'content' => 'required',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $post->update($data);

        // AGGIORNA RELAZIONE TABELLA PIVOT
        if(array_key_exists('tags', $data)){
            $post->tags()->sync($data['tags']);
        }else{
            $post->tags()->detach();
        }

        return redirect()->route('admin.posts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Post::find($id);

        //PULIZIA ORFANI TABELLA PIVOT
        $data->tags()->detach();
        
        $data->delete();

        

        return redirect()->route('admin.posts.index')->with('deleted', $data->title);
    }
}
