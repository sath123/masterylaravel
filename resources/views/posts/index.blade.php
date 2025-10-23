@extends('layouts.app')

@section('title', 'All Posts')

@section('content')
   <div class="bg-blue-500 text-white p-4"> 
    <div class="flex justify-center items-center h-screen">    

    @if(session('success'))
        <p style="color:green;">{{ session('success') }}</p>
    @endif

<div class="overflow-x-auto">
    <div class="text-red-600 hover:underline mr-2"> <a href="{{ route('posts.create') }}">Create New Post</a> </div>
  <table class="min-w-full divide-y divide-gray-200 border border-gray-300">
    <thead class="bg-gray-100">
      <tr>
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
          Title
        </th>
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
          Content
        </th>
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
          Link
        </th>
      </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
      
        @forelse ($posts as $post)
        <tr>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $post->title }}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $post->content }}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800"><a href="{{ route('posts.edit', $post->id) }}">Edit</a></td>
        </tr>
        @empty
        <tr>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">No posts found.</td>           
        </tr>
        @endforelse     
    </tbody>
  </table>
  <div>{{ $posts->links() }}</div>
</div>
    

</div>
</div>    
@endsection
