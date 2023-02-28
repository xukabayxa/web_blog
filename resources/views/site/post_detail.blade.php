<!DOCTYPE html>
<html lang="en">
<head>
    {{--        @include('site.partials.meta-seo')--}}
    @include('site.partials.head')

    <script type='text/javascript'
            src='/site/js/jquery.min.js?ver=3.6.0'
            id='jquery-core-js'></script>
    @yield('css')
</head>

<body class="dark blog" ng-app="App">
    <div class="page">
        <!-- Wrapper Starts -->
        <div class="wrapper">
            <div class="container-fluid page-title post-title" style="background-image: url({{$post->banner->path ?? ''}})">
                <div class="content-banner">
                    <h2 class="text-center">
                        <span>{{$post->name}}</span>
                    </h2>
                    <div class="meta">
                        <span><i class="fa fa-user"></i> <a href="#">{{$post->user_create->name}}</a></span>
                        <span class="date"><i class="fa fa-calendar"></i>{{\Carbon\Carbon::parse($post->created_at)->format('d/m/Y H:i')}}</span>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="content">
                        <!-- Article Starts -->
                        <article>
                            <!-- Excerpt Starts -->
                            <div class="blog-excerpt">
                                {!! $post->body !!}
                                <!-- Meta Ends -->
                            </div>
                            <!-- Excerpt Ends -->
                            <!-- Comments Starts -->

                        </article>
                        <!-- Article Ends -->
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

<script type="text/javascript" src="/site/js/jquery-3.4.1.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="/site/js/script.js" defer="defer" type="text/javascript"></script>

<!-- Angular Js -->
<script src="{{ asset('libs/angularjs/angular.js') }}"></script>
<script src="{{ asset('libs/angularjs/angular-resource.js') }}"></script>
<script src="{{ asset('libs/angularjs/sortable.js') }}"></script>
<script src="{{ asset('libs/dnd/dnd.min.js') }}"></script>
<script
    src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.9/angular-sanitize.js"></script>
<script src="{{ asset('libs/angularjs/select.js') }}"></script>
<script
    src="{{ asset('js/angular.js') }}?version={{ env('APP_VERSION', '1') }}"></script>

<script
    src="https://cdn.tutorialjinni.com/jquery-toast-plugin/1.3.2/jquery.toast.js"></script>
<script
    src="https://cdn.tutorialjinni.com/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script>

<script
    src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src='https://cdn.rawgit.com/matthieua/WOW/1.0.1/dist/wow.min.js'></script>

    <div class="preloader">
        <div class="preloader-container">
            <h1>{{$user->surname}}</h1>
            <div id="progress-line-container">
                <div class="progress-line"></div>
            </div>
            <h1>{{$user->lastname}}</h1>
        </div>
    </div>

@stack('scripts')

<script src="/site/js/blog/jquery-2.2.4.min.js"></script>
<script src="/site/js/blog/jquery.animatedheadline.js"></script>
<script src="/site/js/blog/bootstrap.min.js"></script>
<script src="/site/js/blog/transition.js"></script>
<!-- Main JS Initialization File -->
<script src="/site/js/blog/custom.js"></script>
    <script>
        app.controller('Posts', function ($rootScope, $scope, $compile, $interval) {

        })
    </script>
</body>
</html>

