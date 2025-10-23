@extends('layouts.app')

@section('title','create post')

@section('content')   
    <a href="{{ route('posts.index') }}">Back</a> 
    <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-md">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Posts</h2>

        <form action="{{ route('posts.store') }}" method="POST" class="space-y-5">
            @csrf

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" id="name" name="title" value="{{ old('title') }}" required
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>
            @error('title')
                <p style="color:red">{{ $message }}</p>
            @enderror
            <!-- content -->
            <div>
                <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                <textarea id="content" name="content" rows="4" required
                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('content') }}</textarea>
            </div>
             @error('content')
                <p style="color:red">{{ $message }}</p>
            @enderror
            <!-- Submit Button -->
            <div>
                <button type="submit"
                        class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition duration-200">
                    Save Post
                </button>
            </div>
        </form>
    </div>
@endsection