<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;

class HomeController extends Controller
{
    public  function index(){
        $posts = Post::withCount('comments')->paginate(5);
        $recent_posts = Post::latest()->take(5)->get();
        $categories = Category::withCount('posts')->orderBy('posts_count','desc')->take(10)->get();
        $tags = Tag::latest()->take(50)->get();
        //dd($category);
        return view('home',compact('posts','recent_posts','categories','tags'));
    }
}
