<article>
    <a href="{{route('front.getPost', ['categorySlug' => $post->category->slug, 'slug' => $post->slug])}}"><h4>{{$post->name}}</h4></a>
    <!-- Figure Starts -->
    <figure class="blog-figure">
        <a href="{{route('front.getPost', ['categorySlug' => $post->category->slug, 'slug' => $post->slug])}}">
            <img class="responsive-img" src="{{$post->image->path ?? 'http://via.placeholder.com/748x364'}}" alt="">
        </a>
    </figure>
    <!-- Figure Ends -->
    <!-- Excerpt Starts -->
    <div class="blog-excerpt">
        <p>{!! $post->intro !!}</p>
        <a href="{{route('front.getPost', ['categorySlug' => $post->category->slug, 'slug' => $post->slug])}}" class="btn readmore">
            <span>Chi tiết</span>
        </a>
        <!-- Meta Starts -->
        <div class="meta">
            <span><i class="fa fa-user"></i> <a href="#">{{$post->user_create->name}}</a></span>
            <span class="date"><i class="fa fa-calendar"></i> {{\Carbon\Carbon::parse($post->created_at)->format('d/m/Y H:i')}}</span>
        </div>
        <!-- Meta Ends -->
    </div>
    <!-- Excerpt Ends -->
</article>
