@extends('layouts.app')

@section('content')
    <div class="container">

        <h1>EDIT POST: {{$post->title}}</h1>

        <form action="{{ route('admin.posts.update', $post->id) }}" method="POST">
        @csrf
        @method('PATCH')

            @if($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)

                    <div>{{$error}}</div>
                    
                @endforeach
            </div>
                
            @endif



        <div class="mb-6">
            <label for="title" class="control-table">Title</label>
            <input type="text" name="title" class="form-control" id="title" value="{{old('title', $post->title), }}">
        </div>
        <div class="mb-6">
            <label for="content" class="control-table">Content</label>
            <textarea class="form-control" name="content" class="form-control" id="content" rows="10">{{old('content', $post->content)}}</textarea>
        </div>
        <div class="mb-6">
            <button type="submit" class="btn btn-warning">Modifica Post</button>
        </div>
        <div class="mb-6">
            <a href="{{ route('admin.posts.index') }}">Back to INDEX</a>
        </div>


        </form>

    </div>
@endsection