@extends('site.layouts.master')
@section('title')
    <title>{{ "Blog - " . ucfirst($_SERVER['HTTP_HOST']) }}</title>
@endsection
@section('content')

    <div class="wrapper" ng-controller="Posts">
        <div class="container-fluid page-title" style="background-image: url({{$banner->image->path ?? ''}})">
            <div class="content-banner">
                <h2 class="text-center">
                    <span>Blog </span>
                </h2>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="content ">
                    <div class="load-more-post">
                        @foreach($posts as $index => $post)
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
                        @endforeach
                    </div>

                    <div class="col-12 mx-auto text-center">
                        <a href="#" class="btn btn-secondary refresh" ng-click="loadMorePost()" ng-if="checkLoad">
                            <span><i class="fa fa-refresh"></i>Xem thêm</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="preloader">
        <div class="preloader-container">
            <h1>daria</h1>
            <div id="progress-line-container">
                <div class="progress-line"></div>
            </div>
            <h1>taylor</h1>
        </div>
    </div>


    <!-- Wrapper Ends -->
    <!-- Preloader Starts -->

@endsection

@push('scripts')
    <script>
        app.controller('Posts', function ($rootScope, $scope, $compile, $interval) {
            $scope.checkLoad = {{$posts->count() > 3 ? true : false}};
            $scope.loading = false;
            $scope.post_ids = {{$posts->pluck('id')}};

            $scope.loadMorePost = function () {



                $.ajax({
                    type: 'GET',
                    url: '{{route('front.loadmore.post')}}',
                    data: {
                        post_ids_load_more: $scope.post_ids,
                    },
                    beforeSend: function() {
                        $scope.loading = true;
                    },
                    success: function (response) {
                        if (response.success) {
                            $(".load-more-post").append($compile(response.post_render)($scope));
                            $scope.post_ids = $scope.post_ids.concat(response.post_ids);

                            $('html, body').animate({ scrollTop: $(".load-more-post").height()-$(window).height() }, 500);


                            if(response.post_ids.length < 1) {
                                $scope.checkLoad = false;
                            }
                        }
                    },
                    error: function (e) {
                    },
                    complete: function () {
                        $scope.loading = false;
                        $scope.$applyAsync();
                    }
                });
            }
        })
    </script>
@endpush
