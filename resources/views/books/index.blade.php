@extends('layouts.app')

@section('title', 'Books')

@section('content')
    <div class="w-full max-w-md p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:p-8 dark:bg-gray-800 dark:border-gray-700">
    <div class="flex items-center justify-between mb-4">
        <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Books</h5>
        <a href="#" class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">
            View all
        </a>
   </div>   
   <div class="flow-root">
    <form method="GET" action="{{ route('books.index') }}">
        <input type="text" name="title" placeholder="search by title" value="{{ request('title') }}" class="input"/>
        <button type="submit" class="btn">Search</button>
        <a href="{{ route('books.index') }}">Clear</a>
    </form>
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

        @foreach($filters as $key => $label)
            <a href="#" class="filter-item"> {{ $label }}</a>
        @endforeach
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
