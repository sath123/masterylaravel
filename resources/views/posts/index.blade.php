@extends('layouts.app')

@section('title', 'All Posts')

@section('content')
    <h2>All Posts</h2>

    @if(session('success'))
        <p style="color:green;">{{ session('success') }}</p>
    @endif

    <a href="{{ route('posts.create') }}">Create New Post</a>

    <ul>
        @forelse ($posts as $post)
            <li>
                <strong>{{ $post->title }}</strong><br>
                <a href="{{ route('posts.edit', $post->id) }}">Edit</a>
                {{ $post->content }}
            </li>
        @empty
            <p>No posts found.</p>
        @endforelse
    </ul>

    <div>{{ $posts->links() }}</div>
@endsection
