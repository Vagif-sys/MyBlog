@props(['recent_posts'])
<div class="side">
    <h3 class="sidebar-heading">Recent Blog</h3>
    @foreach($recent_posts as $recent_post)
    <div class="f-blog">
        <a href="blog.html" class="blog-img" style="background-image: url({{ asset('blog_template/'.$recent_post->image->path.'') }});">
        </a>
        <div class="desc">
            <p class="admin"><span>{{ $recent_post->created_at->diffforHumans() }}</span></p>
            <h2><a href="">{{ Str::limit($recent_post->title,20) }}</a></h2>
            <p>{{ $recent_post->desc }}</p>
        </div>
    </div> 
    @endforeach
</div>