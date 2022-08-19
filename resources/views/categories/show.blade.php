@extends('main_layouts.master')

@section('title', $category->name. '| MyBlog')

@section('content')
<div class="colorlib-blog">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
               @forelse($posts as $post)
                <div class="block-21 d-flex animate-box">
                    <a href="{{ route('post.show',$post) }}" class="blog-img" 
                    style="background-image: url({{ asset('storage/'.$post->image->path.'') }});"></a>
                    <div class="text">
                        <h3 class="heading"><a href="#">{{ $post->title }}</a></h3>
                        <p>{{ $post->desc }}</p>
                        <div class="meta">
                            <div><a href="#"><span class="icon-calendar"></span>{{ $post->created_at->diffforHumans() }}</a></div>
                            <div><a href="#"><span class="icon-user2"></span>{{ $post->author->name }}</a></div>
                            <div><a href="#"><span class="icon-chat"></span>{{ $post->comments_count }}</a></div>
                        </div>
                    </div>
                 </div>
                 @empty
                 <p class='lead'>There is no posts relted to this category</p>
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
	
<div id="colorlib-subscribe" class="subs-img" style="background-image: url({{ asset('blog_template/images/img_bg_2.jpg') }});" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 text-center colorlib-heading animate-box">
                <h2>Subscribe Newsletter</h2>
                <p>Subscribe our newsletter and get latest update</p>
            </div>
        </div>
        <div class="row animate-box">
            <div class="col-md-6 col-md-offset-3">
                <div class="row">
                    <div class="col-md-12">
                    <form class="form-inline qbstp-header-subscribe">
                        <div class="col-three-forth">
                            <div class="form-group">
                                <input type="text" class="form-control" id="email" placeholder="Enter your email">
                            </div>
                        </div>
                        <div class="col-one-third">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Subscribe Now</button>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection