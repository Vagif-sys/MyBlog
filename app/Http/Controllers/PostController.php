<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
class PostController extends Controller
{
    public function show(Post $post){
        $recent_posts = Post::latest()->take(5)->get();
        $categories = Category::withCount('posts')->orderBy('posts_count','desc')->take(10)->get();
        $tags = Tag::latest()->take(50)->get();
        return view('post',['post'=> $post,
        'categories'=> $categories,'recent_posts'=> $recent_posts,'tags'=>$tags]);
    }

    public function addComment(Post $post){
        $attributes = request()->validate([
            'the_comment' => 'required|min:10|max:300'
        ]);

       $attributes['user_id'] = auth()->id();

        $comment = $post->comments()->create($attributes);
       

        return redirect('/post/'. $post->slug . '#comment_' . $comment->id)->with(
            'success','Comment has been added'
        );
    }
}
