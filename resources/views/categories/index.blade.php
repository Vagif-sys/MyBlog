@extends('main_layouts.master')

@section('title', 'Categories | Home')

@section('content')
<div class="colorlib-blog">
    <div class="container">
        <div class="row">
            <div class="col-md-12 categories-col">
                <div class='row'>
                    @forelse($categories as $category)
                     <div class='col-md-3'>
                    <div class="block-21 d-flex animate-box">
                        <div class="text">
                            <h3 class="heading"><a 
                            href="{{ route('categories.show',$category) }}">{{ $category->name }}</a></h3>
                            <div class="meta">
                                <div><a href="#"><span class="icon-calendar"></span>{{ $category->created_at->diffforHumans() }}</a></div>
                                <div><a href="#"><span class="icon-user2"></span>{{ $category->user->name }}</a></div>
                                <div><a href="{{ route('categories.show',$category) }}"><span class="icon-chat"></span>{{ $category->posts_count }}</a></div>
                            </div>
                        </div>
                    </div>
                    </div>
                    @empty
                    <p class='lead'>There is no categories to show</p>
                    @endforelse
                </div> 
                 {{ $categories->links() }} 
            </div> 
            
        </div>
    </div>
</div>
	
<div id="colorlib-subscribe" class="subs-img" style="background-image: url(blog_template/images/img_bg_2.jpg);" data-stellar-background-ratio="0.5">
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