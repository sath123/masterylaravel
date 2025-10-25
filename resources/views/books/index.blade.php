@extends('layouts.app')

@section('title', 'Books')

@section('content')
    <div class="w-full max-w-md p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:p-8 dark:bg-gray-800 dark:border-gray-700">
    <div class="flex items-center justify-between mb-4">
        <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Books</h5>        
   </div>   
   <br/>
   <div class="flow-root">
    <form method="GET" action="{{ route('books.index') }}">
        <input type="text" name="title" placeholder="search by title" value="{{ request('title') }}" class="px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"/>
        <input type="hidden" name="filter" value="{{ request('filter') }}"/>
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">Search</button>
        <a href="{{ route('books.index') }}" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400 transition">Clear</a>
    </form>
    <br />
    <div class="filter-container mb-b flex"> 
        @php 
            $filters = [
                '' => 'Latest',
                'popular_last_month' => 'Popular Last Month',
                'popular_latest_6months' => 'Popular Last 6 Months',
                'highest_rated_last_month' => 'Highest Rated Last Month',
                'highest_rated_last_6months' => 'Highest Rated Last 6 Months',                
            ];
        @endphp


<div class="w-full">
  <div class="relative right-0">
    <ul class="relative flex flex-wrap px-1.5 py-1.5 list-none rounded-md bg-slate-100" data-tabs="tabs" role="list">
       @foreach($filters as $key => $label)
    <li class="z-30 flex-auto text-center">
        <a class="z-30 flex items-center justify-center w-full px-0 py-2 text-sm mb-0 transition-all ease-in-out border-0 rounded-md cursor-pointer 
    {{ request('filter') === $key || (request('filter')=== null && $key === '') ? 'text-blue-600 font-semibold bg-white shadow-md' : 'text-slate-600 bg-inherit' }}"
    data-tab-target="" role="tab" aria-selected="{{ request('filter') === $key || (request('filter')=== null && $key === '') ? 'true' : 'false' }}"
    href="{{ route('books.index',[...request()->query(),'filter' => $key]) }}">
    {{ $label }}
</a>

      </li>      
      @endforeach
    </ul>
  </div>
</div>         
        
    </div>
        <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
            @forelse($books as $book)
            <li class="py-3 sm:py-4">
                <div class="flex items-center">
                    
                    <div class="flex-1 min-w-0 ms-4">
                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                            <a href="{{ route('books.show', $book) }}" class="book-title">{{$book->title}}</a>
                        </p>
                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                            <span class="book-author">by {{$book->author}}</span>
                        </p>
                    </div>
                    <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                        <div>
                            <div class="book-rating">{{ number_format($book->reviews_avg_rating,1) }}</div>
                            <div class="book-review-count">out of {{ $book->reviews_count }}</div>
                        </div>

                    </div>
                </div>
            </li>         
            @empty
            <li class="mb-4">
                <div class="empty-book-item">
                    <p class="empty-text">No books found</p>
                    <a href="{{ route('books.index') }}" class="reset-link">Reset Criteria</a>
                </div>
            </li>
        @endforelse
        </ul>
   </div>   
</div>
<div>{{ $books->links() }}</div>    
@endsection
