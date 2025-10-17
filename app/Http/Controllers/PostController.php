<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;


class PostController extends Controller
{

   public function boot(): void{
        Paginator::useBootstrap(); // Enables Bootstrap style
    } 
    
    public function index(){
        //$posts = Post::all();
        $posts = Post::paginate(5);
        return view('posts.index',compact('posts'));    
    }

    public function create(){
        return view('posts.create');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        Post::create($validated);

        return redirect()->back()->with('success','Post created successfully!');
    }

    public function edit(Post $post){
        return view('posts.edit',compact('post'));
    }

    public function update(Request $request, Post $post){

        $validated = $request->validate([
            'title' => 'required|max:255',
            'content'=> 'required',
        ]);

        $post->update($validated);

        return redirect()->back()->with('success','post updated successfully');        
    }
}
