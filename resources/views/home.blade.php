@extends('main_layouts.master')

@section('title', 'MyBlog | Home')

@section('content')
<div class="colorlib-blog">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
               @forelse($posts as $post)
                <div class="block-21 d-flex animate-box">
                    <a href="{{ route('post.show',$post) }}" class="blog-img" 
                    style="background-image: url({{ asset('blog_template/'.$post->image->path) }});"></a>
                    <div class="text">
                        <h3 class="heading"><a href="{{ route('post.show',$post) }} ">{{ $post->title }}</a></h3>
                        <p>{{ $post->desc }}</p>
                        <div class="meta">
                            <div><a href="#"><span class="icon-calendar"></span>{{ $post->created_at->diffforHumans() }}</a></div>
                            <div><a href="#"><span class="icon-user2"></span>{{ $post->author->name }}</a></div>
                            <div><a href="#"><span class="icon-chat"></span>{{ $post->comments_count }}</a></div>
                        </div>
                    </div>
                 </div>
                 @empty
                 <p class='lead'>There is no posts to show</p>
               @endforelse
              
               {{ $posts->links() }}
            </div>

            <!-- SIDEBAR: start -->
            <div class="col-md-4 animate-box">
                <div class="sidebar">
                    <x-blog.side-categories :categories='$categories'/>
                    <x-blog.side-recent_posts :recent_posts='$recent_posts'/>
                    <x-blog.side-tags :tags='$tags'/>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection