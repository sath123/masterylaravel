@extends('layouts.app')

@section('title','Edit Post')

@section('content')
   
    <a href="{{ route('posts.index') }}">Back</a> 
    <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-md">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Posts</h2>

        <form action="{{ route('posts.update',$post) }}" method="POST" class="space-y-5">
            @csrf
             @method('PUT')
            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" id="title" name="title" value="{{ old('title',$post->title) }}" required
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>
            @error('title')
                <p style="color:red">{{ $message }}</p>
            @enderror
            <!-- content -->
            <div>
                <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                <textarea id="content" name="content" rows="4" required
                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('content',$post->content) }}</textarea>
            </div>
             @error('content')
                <p style="color:red">{{ $message }}</p>
            @enderror
            <!-- Submit Button -->
            <div>
                <button type="submit"
                        class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition duration-200">
                    Update Post
                </button>
            </div>
        </form>
    </div>
@endsection