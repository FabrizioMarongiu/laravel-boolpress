@extends('layouts.app')

@section('content')
    <div class="container">

        <h1>OUR POSTS</h1>

        <form action="{{ route('admin.posts.store') }}" method="POST">
        @csrf
        @method('POST')

            @if($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)

                    <div>{{$error}}</div>
                    
                @endforeach
            </div>
                
            @endif



        <div class="mb-6">
            <label for="title" class="control-table">Title</label>
            <input type="text" name="title" class="form-control" id="title" value="{{old('title')}}">
        </div>
        <div class="mb-6">
            <label for="content" class="control-table">Content</label>
            <textarea class="form-control" name="content" class="form-control" id="content" rows="10">{{old('content')}}</textarea>
        </div>

        <button type="submit" class="btn btn-warning">Crea Post</button>

        </form>

    </div>
@endsection