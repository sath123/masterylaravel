<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Cache;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
            $title = $request->input('title');
            $filter = $request->input('filter', '');
            $page = $request->input('page', 1);

            // Build a unique cache key based on filters and pagination
            $cacheKey = "books_{$filter}_{$title}_page_{$page}";

            // Cache the paginated result for 1 hour (3600 seconds)
            $books = Cache::remember($cacheKey, 3600, function () use ($title, $filter) {
            $query = Book::query();

            // Apply title filter
            $query = $query->when($title, function ($q, $title) {
                return $q->where('title', 'like', '%' . $title . '%');
            });

            // Apply filter logic
            $query = match ($filter) {
                'popular_last_month' => $query->PopularLastMonth(),
                'popular_last_6month' => $query->PopularLast6Month(),
                'highest_rated_last_month' => $query->HighestRatedLastMonth(),
                'popular_rated_last_6month' => $query->HighestRatedLast6Month(),
                default => $query,
            };

            return $query->paginate(5);
        });

        return view('books.index', ['books' => $books]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
