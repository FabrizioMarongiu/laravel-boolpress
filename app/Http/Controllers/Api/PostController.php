<?php

namespace App\Http\Controllers\Api;
use App\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    
    public function index(){
        // $posts = Post::all();

        $posts = Post::paginate(3);

        return response()->json($posts);
    }

}
