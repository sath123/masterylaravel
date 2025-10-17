@extends('layouts.app')

@section('title','create post')

@section('content')
    <form action="{{ route('posts.store') }}" method="POST">
        @csrf 

        <div>
            <label>Title:</label>
            <input type="text" name="title" value="{{ old('title') }}">
            @error('title')
                <p style="color:red">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label>Content:</label>
            <textarea name="content">{{ old('content') }}</textarea>
            @error('content')
                <p style="color:red">{{ $message }}</p>
            @enderror
        </div>
        <button type="submit">Save Post</button>

    </form>
@endsection