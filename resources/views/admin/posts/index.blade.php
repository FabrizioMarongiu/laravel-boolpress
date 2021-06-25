@extends('layouts.app')

@section('content')
    <div class="container">

        <h1>OUR POSTS</h1>

        @if (session('deleted'))
        <div class="alert alert-success">
            <span>{{ session('deleted') }}</span>
             ELIMINATO
        </div>
            
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Create</th>
                    <th colspan="3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td>@if($post->category) {{ $post->category->name }} @endif</td>
                    <td>
                       <div>{{ $post->created_at->format('l d/m/y') }}</div>
                       <div>{{ $post->created_at->diffForHumans() }}</div>
                    </td>
                    <td>
                        <a class="btn btn-success"
                        href="{{ route('admin.posts.show', $post->id) }}">SHOW</a>
                    </td>
                    <td>
                        <a class="btn btn-primary"
                        href="{{ route('admin.posts.edit', $post->id) }}">EDIT</a>
                    </td>
                    <td>
                        <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">DELETE</button>
                        </form>

                    </td>
                </tr>
                    
                @endforeach
            </tbody>
        </table>
        
        <h2>Post By categories</h2>
        @foreach ($categories as $category)
        <h3 class="mb-3">
            {{$category->name}}
        </h3>
        {{-- @dump($category->posts) --}}
            @forelse ($category->posts as $post)
                <a href=" {{ route('admin.posts.show', $post->id) }} "><h4>{{$post->title }}</h4></a>
                
            @empty
            <div class="alert alert-success"> No posts for this category <a href="{{ route('admin.posts.create') }}">Create a new post</a> </div>
            @endforelse
        @endforeach
    </div>
@endsection