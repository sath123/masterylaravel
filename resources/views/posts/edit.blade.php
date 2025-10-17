@extends('layouts.app')

@section('title','Edit Post')

@section('content')
   <a href="{{ route('posts.index') }}">Back</a> 
    <form action="{{ route('posts.update',$post) }}" method = "POST">
        @csrf 
        @method('PUT')

        <div>
            <label>Title:</label>
            <input type="text" name="title" value="{{ old('title',$post->title) }}">
            @error('title')
                <p style="color:red">{{ $message }} </p>
            @enderror
        </div>

        <div>
            <label>Content:</label>
            <textarea name="content"> {{ old('content',$post->content) }}</textarea>
            @error('content')
                <p style="color:red">{{ $message }} </p>
            @enderror
        </div>

        <button type="submit">Update Post</button>
    </form>
@endsection