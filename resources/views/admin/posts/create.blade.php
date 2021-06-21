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



        <div class="mb-3">
            <label for="title" class="control-table">Title</label>
            <input type="text" name="title" class="form-control" id="title" value="{{old('title')}}">
        </div>
        <div class="mb-3">
            <label for="content" class="control-table">Content</label>
            <textarea class="form-control" name="content" class="form-control" id="content" rows="10">{{old('content')}}</textarea>
        </div>
        <div class="mb-3">
            <label for="category_id">Category</label>
            <select class="form-control" name="category_id" id="category_id">
                <option value="" >Select Category</option>
                @foreach ($categories as $category)
                    <option value="{{$category->id}}" @if($category->id == old('category_id')) selected @endif>
                        {{$category->name}}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-warning">Crea Post</button>

        </form>

    </div>
@endsection