@extends('site.layouts.master')

@section('css')
@endsection
@section('content')
    <div ng-controller="Contact">

        <header id="header">
            <div class="nav-container">
                <div>
                    <!-- Mobile Navigation Starts -->
                    <ul id="nav" class="navigation">
                        <li class="active">
                            <div>
                                <a id="link-home" href="#home" class="active">
                                    <i class="fa fa-home"></i><span>Home</span>
                                </a>
                            </div>
                        </li>
                        <li>
                            <div>
                                <a id="link-about" href="#about">
                                    <i class="fa fa-user"></i><span>Đôi nét về tôi</span>
                                </a>
                            </div>
                        </li>
{{--                        <li>--}}
{{--                            <div>--}}
{{--                                <a id="link-work" href="#work">--}}
{{--                                    <i class="fa fa-briefcase"></i><span>Portfolio</span>--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                        </li>--}}
                        <li>
                            <div>
                                <a id="link-contact" href="#contact">
                                    <i class="fa fa-envelope-open"></i><span>Liên hệ</span>
                                </a>
                            </div>
                        </li>
                        <li>
                            <div>
                                <a id="link-blog" href="#blog">
                                    <i class="fa fa-comments"></i><span>Blog</span>
                                </a>
                            </div>
                        </li>
                    </ul>
                    <!-- Mobile Navigation Ends -->
                </div>
            </div>
            <!-- Stretchy Navigation Starts -->
            <div class="cd-stretchy-nav">
                <a class="cd-nav-trigger" href="#0">
                    <span aria-hidden="true"></span>
                </a>
                <ul class="stretchy-nav">
                    <li class="active"><a href="#home"><span>Trang chủ</span></a></li>
                    <li><a href="#about"><span>Về tôi</span></a></li>
{{--                    <li><a href="#work"><span>Portfolio</span></a></li>--}}
                    <li><a href="#contact"><span>Liên hệ</span></a></li>
                    <li><a href="#blog"><span>Blog</span></a></li>
                </ul>
                <span aria-hidden="true" class="stretchy-nav-bg"></span>
            </div>
            <!-- Stretchy Navigation Ends -->
        </header>

        <main id="main">
            <!-- Back To Home Starts [ONLY MOBILE] -->
            <span class="back-mobile" id="back-mobile"><i class="fa fa-arrow-left"></i></span>
            <!-- Back To Home Ends [ONLY MOBILE] -->
            <!-- Home Section Starts -->
            <section id="home" class="active" style="background-image: url({{$banner->image->path ?? ''}})">
                <!-- Text Rotator Starts -->
                <div class="main-text-container">
                    <div class="main-text" id="selector">
                        <h3>Xin chào !</h3>
                        <h1 class="ah-headline">
                            Tôi là
                            <span class="ah-words-wrapper">
							<b class="is-visible">{{@$user->name ?? ''}}</b>
						</span>
                        </h1>
                        <p>{{$config->des_homepage}}</p>
                        <div class="call-to-actions-home">
                            <div class="text-left">
                                <a href="#about" class="btn link-portfolio-one"><span><i class="fa fa-user"></i>xem thêm về tôi</span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Text Rotator Ends -->
            </section>
            <!-- Home Section Ends -->
            <!-- About Section Starts -->
            <section id="about">
                <!-- Main Heading Starts -->
                <div class="container page-title text-center">
                    <h2 class="text-center">Đôi nét về <span>Tôi</span></h2>
                    <span class="title-head-subtitle">{{$config->des_aboutpage}}</span>
                </div>
                <!-- Main Heading Ends -->
                <div class="container infos">
                    <div class="row personal-info">
                        <!-- Personal Infos Starts -->
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                            <div class="image-container">
                                <img class="img-fluid d-block" src="{{@$user->image->path ?? 'http://via.placeholder.com/500x500.jpg'}}"  alt="" />
                            </div>
                            <p  class="d-block d-md-none">I'm a Freelance UI/UX Designer and Developer based in London, England. I strives to build immersive and beautiful web applications through carefully crafted code and user-centric design.</p>
                        </div>
                        <div class="row col-xl-6 col-lg-6 col-md-12">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <ul class="list-1">
                                    <li>
                                        <h6><span class="font-weight-600">Họ tên </span>{{@$user->name ?? ''}}</h6>
                                    </li>
                                    <li>
                                        <h6><span class="font-weight-600">Email </span>{{@$user->email ?? ''}}</h6>
                                    </li>
                                    <li>
                                        <h6><span class="font-weight-600">Sinh nhật </span>{{@$user->birthday ? \Carbon\Carbon::parse($user->birthday)->format('d/m/Y') : ''}}</h6>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <ul class="list-2">
                                    <li>
                                        <h6><span class="font-weight-600">Quốc gia </span>{{@$user->nation ?? ''}}</h6>
                                    </li>
                                    <li>
                                        <h6><span class="font-weight-600">Số điện thoại </span>{{@$user->phone ?? ''}}</h6>
                                    </li>
                                    <li>
                                        <h6><span class="font-weight-600">Facebook </span>{{@$user->facebook ?? ''}}</h6>
                                    </li>
                                </ul>
                            </div>

                        </div>
                        <!-- Personal Infos Ends -->
                    </div>
                </div>
                <!-- Download CV Starts -->
                <div class="container col-12 mx-auto text-center">
                    <hr class="about-section" />
                </div>
                <!-- Download CV Ends -->
                <!-- Resume Starts -->
                <div class="resume-container">


                    <!-- Resume Ends -->
                </div>
            </section>
            <!-- About Section Ends -->
            <!-- Portfolio Section Starts -->
{{--            <section id="work">--}}
{{--                <div class="portfolio-container">--}}
{{--                    <!-- Main Heading Starts -->--}}
{{--                    <div class="container page-title text-center">--}}
{{--                        <h2 class="text-center">my <span>portfolio</span></h2>--}}
{{--                        <span class="title-head-subtitle">a few recent design and coding projects. Want to see more? Email me.</span>--}}
{{--                    </div>--}}
{{--                    <!-- Main Heading Ends -->--}}
{{--                    <div class="portfolio-section">--}}
{{--                        <div class="container cd-container">--}}
{{--                            <div>--}}
{{--                                <!-- Portfolio Items Starts -->--}}
{{--                                <ul class="row" id="portfolio-items">--}}
{{--                                    <!-- Portfolio Item Starts -->--}}
{{--                                    <li class="col-12 col-md-6 col-lg-4">--}}
{{--                                        <a href="#0" data-type="project-1">--}}
{{--                                            <img src="http://via.placeholder.com/854x480" alt="Project" class="img-fluid">--}}
{{--                                            <div><span>Image Format</span>--}}
{{--                                            </div>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                    <!-- Portfolio Item Ends -->--}}
{{--                                    <!-- Portfolio Item Starts -->--}}
{{--                                    <li class="col-12 col-md-6 col-lg-4">--}}
{{--                                        <a href="#0" data-type="project-2">--}}
{{--                                            <img src="http://via.placeholder.com/854x480" alt="Project" class="img-fluid">--}}
{{--                                            <div><span>Youtube Format</span>--}}
{{--                                            </div>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                    <!-- Portfolio Item Ends -->--}}
{{--                                    <!-- Portfolio Item Starts -->--}}
{{--                                    <li class="col-12 col-md-6 col-lg-4">--}}
{{--                                        <a href="#0" data-type="project-3">--}}
{{--                                            <img src="http://via.placeholder.com/854x480" alt="Project" class="img-fluid">--}}
{{--                                            <div><span>Slider Format</span>--}}
{{--                                            </div>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                    <!-- Portfolio Item Ends -->--}}
{{--                                    <!-- Portfolio Item Starts -->--}}
{{--                                    <li class="col-12 col-md-6 col-lg-4">--}}
{{--                                        <a href="#0" data-type="project-4">--}}
{{--                                            <img src="http://via.placeholder.com/854x480" alt="Project" class="img-fluid">--}}
{{--                                            <div><span>Video Format</span>--}}
{{--                                            </div>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                    <!-- Portfolio Item Ends -->--}}
{{--                                    <!-- Portfolio Item Starts -->--}}
{{--                                    <li class="col-12 col-md-6 col-lg-4">--}}
{{--                                        <a href="#0" data-type="project-5">--}}
{{--                                            <img src="http://via.placeholder.com/854x480" alt="Project" class="img-fluid">--}}
{{--                                            <div><span>Image Format</span>--}}
{{--                                            </div>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                    <!-- Portfolio Item Ends -->--}}
{{--                                    <!-- Portfolio Item Starts -->--}}
{{--                                    <li class="col-12 col-md-6 col-lg-4">--}}
{{--                                        <a href="#0" data-type="project-6">--}}
{{--                                            <img src="http://via.placeholder.com/854x480" alt="Project" class="img-fluid">--}}
{{--                                            <div><span>Image Format</span>--}}
{{--                                            </div>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                    <!-- Portfolio Item Ends -->--}}
{{--                                    <!-- Portfolio Item Starts -->--}}
{{--                                    <li class="col-12 col-md-6 col-lg-4">--}}
{{--                                        <a href="#0" data-type="project-7">--}}
{{--                                            <img src="http://via.placeholder.com/854x480" alt="Project" class="img-fluid">--}}
{{--                                            <div><span>Image Format</span>--}}
{{--                                            </div>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                    <!-- Portfolio Item Ends -->--}}
{{--                                    <!-- Portfolio Item Starts -->--}}
{{--                                    <li class="col-12 col-md-6 col-lg-4">--}}
{{--                                        <a href="#0" data-type="project-8">--}}
{{--                                            <img src="http://via.placeholder.com/854x480" alt="Project" class="img-fluid">--}}
{{--                                            <div><span>Image Format</span>--}}
{{--                                            </div>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                    <!-- Portfolio Item Ends -->--}}
{{--                                    <!-- Portfolio Item Starts -->--}}
{{--                                    <li class="col-12 col-md-6 col-lg-4">--}}
{{--                                        <a href="#0" data-type="project-9">--}}
{{--                                            <img src="http://via.placeholder.com/854x480" alt="Project" class="img-fluid">--}}
{{--                                            <div><span>Image Format</span>--}}
{{--                                            </div>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                    <!-- Portfolio Item Ends -->--}}
{{--                                </ul>--}}
{{--                                <!-- Portfolio Items Ends -->--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- PORTFOLIO OVERLAY STARTS -->--}}
{{--                    <div class="portfolio-overlay"></div>--}}
{{--                    <!-- PORTFOLIO OVERLAY ENDS -->--}}
{{--                </div>--}}
{{--                <!-- Portfolio Project Content Starts -->--}}
{{--                <div class="project-info-container project-1">--}}
{{--                    <!-- Main Content Starts -->--}}
{{--                    <div class="project-info-main-content">--}}
{{--                        <img src="http://via.placeholder.com/854x480" alt="Project Image">--}}
{{--                    </div>--}}
{{--                    <!-- Main Content Ends -->--}}
{{--                    <!-- Project Details Starts -->--}}
{{--                    <div class="projects-info row">--}}
{{--                        <div class="col-12 col-sm-6 p-none">--}}
{{--                            <h3 class="font-weight-600 uppercase">Image Format</h3>--}}
{{--                            <ul class="project-details">--}}
{{--                                <li><i class="fa fa-file-text-o"></i><span class="font-weight-400 project-label"> Project </span>: <span class="font-weight-600 uppercase">Website</span>--}}
{{--                                </li>--}}
{{--                                <li><i class="fa fa-user-o"></i><span class="font-weight-400 project-label"> Client </span>: <span class="font-weight-600 uppercase">Envato</span>--}}
{{--                                </li>--}}
{{--                                <li><i class="fa fa-hourglass-o"></i><span class="font-weight-400 project-label"> Duration </span>: <span class="font-weight-600 uppercase">3 months</span>--}}
{{--                                </li>--}}
{{--                                <li><i class="fa fa-code"></i> <span class="font-weight-400 project-label"> Technologies</span> : <span class="font-weight-600 uppercase">html, javascript</span>--}}
{{--                                </li>--}}
{{--                                <li><i class="fa fa-money"></i> <span class="font-weight-400 project-label"> Budget</span> : <span class="font-weight-600 uppercase">1550 USD</span>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                            <a href="#" class="btn"><span><i class="fa fa-external-link"></i>preview</span></a>--}}
{{--                        </div>--}}
{{--                        <div class="col-6 p-none text-right">--}}
{{--                            <a href="#" class="btn btn-secondary close-project"><span><i class="fa fa-close"></i>Close</span></a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- Project Details Ends -->--}}
{{--                </div>--}}
{{--                <!-- Portfolio Project Content Ends -->--}}
{{--                <!-- Portfolio Project Content Starts -->--}}
{{--                <div class="project-info-container project-2">--}}
{{--                    <!-- Main Content Starts -->--}}
{{--                    <div class="project-info-main-content">--}}
{{--                        <div class="videocontainer">--}}
{{--                            <iframe class="youtube-video" src="https://www.youtube.com/embed/7e90gBu4pas?enablejsapi=1&version=3&playerapiid=ytplayer" allowfullscreen></iframe>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- Main Content Ends -->--}}
{{--                    <!-- Project Details Starts -->--}}
{{--                    <div class="projects-info row">--}}
{{--                        <div class="col-12 col-sm-6 p-none">--}}
{{--                            <h3 class="font-weight-600 uppercase">Youtube Format</h3>--}}
{{--                            <ul class="project-details">--}}
{{--                                <li><i class="fa fa-file-text-o"></i><span class="font-weight-400 project-label"> Project </span>: <span class="font-weight-600 uppercase">Website</span>--}}
{{--                                </li>--}}
{{--                                <li><i class="fa fa-user-o"></i><span class="font-weight-400 project-label"> Client </span>: <span class="font-weight-600 uppercase">Envato</span>--}}
{{--                                </li>--}}
{{--                                <li><i class="fa fa-hourglass-o"></i><span class="font-weight-400 project-label"> Duration </span>: <span class="font-weight-600 uppercase">3 months</span>--}}
{{--                                </li>--}}
{{--                                <li><i class="fa fa-code"></i> <span class="font-weight-400 project-label"> Technologies</span> : <span class="font-weight-600 uppercase">html, javascript</span>--}}
{{--                                </li>--}}
{{--                                <li><i class="fa fa-money"></i> <span class="font-weight-400 project-label"> Budget</span> : <span class="font-weight-600 uppercase">1550 USD</span>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                            <a href="#" class="btn"><span><i class="fa fa-external-link"></i>preview</span></a>--}}
{{--                        </div>--}}
{{--                        <div class="col-6 p-none text-right">--}}
{{--                            <a href="#" class="btn btn-secondary close-project"><span><i class="fa fa-close"></i>Close</span></a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- Project Details Ends -->--}}
{{--                </div>--}}
{{--                <!-- Portfolio Project Content Ends -->--}}
{{--                <!-- Portfolio Project Content Starts -->--}}
{{--                <div class="project-info-container project-3">--}}
{{--                    <!-- Main Content Starts -->--}}
{{--                    <div class="project-info-main-content">--}}
{{--                        <div id="slider" class="carousel slide portfolio-slider" data-ride="carousel">--}}
{{--                            <!-- The slideshow -->--}}
{{--                            <div class="carousel-inner">--}}
{{--                                <div class="carousel-item active">--}}
{{--                                    <img src="http://via.placeholder.com/854x480" alt="slide 1">--}}
{{--                                </div>--}}
{{--                                <div class="carousel-item">--}}
{{--                                    <img src="http://via.placeholder.com/854x480" alt="slide 2">--}}
{{--                                </div>--}}
{{--                                <div class="carousel-item">--}}
{{--                                    <img src="http://via.placeholder.com/854x480" alt="slide 3">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <!-- Left and right controls -->--}}
{{--                            <a class="carousel-control-prev" href="#slider" data-slide="prev"> <span class="fa fa-chevron-left carousel-controls"></span>--}}
{{--                            </a>--}}
{{--                            <a class="carousel-control-next" href="#slider" data-slide="next"> <span class="fa fa-chevron-right carousel-controls"></span>--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- Main Content Ends -->--}}
{{--                    <!-- Project Details Starts -->--}}
{{--                    <div class="projects-info row">--}}
{{--                        <div class="col-12 col-sm-6 p-none">--}}
{{--                            <h3 class="font-weight-600 uppercase">Slider Format</h3>--}}
{{--                            <ul class="project-details">--}}
{{--                                <li><i class="fa fa-file-text-o"></i><span class="font-weight-400 project-label"> Project </span>: <span class="font-weight-600 uppercase">Website</span>--}}
{{--                                </li>--}}
{{--                                <li><i class="fa fa-user-o"></i><span class="font-weight-400 project-label"> Client </span>: <span class="font-weight-600 uppercase">Envato</span>--}}
{{--                                </li>--}}
{{--                                <li><i class="fa fa-hourglass-o"></i><span class="font-weight-400 project-label"> Duration </span>: <span class="font-weight-600 uppercase">3 months</span>--}}
{{--                                </li>--}}
{{--                                <li><i class="fa fa-code"></i> <span class="font-weight-400 project-label"> Technologies</span> : <span class="font-weight-600 uppercase">html, javascript</span>--}}
{{--                                </li>--}}
{{--                                <li><i class="fa fa-money"></i> <span class="font-weight-400 project-label"> Budget</span> : <span class="font-weight-600 uppercase">1550 USD</span>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                            <a href="#" class="btn"><span><i class="fa fa-external-link"></i>preview</span></a>--}}
{{--                        </div>--}}
{{--                        <div class="col-6 p-none text-right">--}}
{{--                            <a href="#" class="btn btn-secondary close-project"><span><i class="fa fa-close"></i>Close</span></a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- Project Details Ends -->--}}

{{--                </div>--}}
{{--                <!-- Portfolio Project Content Ends -->--}}
{{--                <!-- Portfolio Project Content Starts -->--}}
{{--                <div class="project-info-container project-4">--}}
{{--                    <!-- Main Content Starts -->--}}
{{--                    <div class="project-info-main-content">--}}
{{--                        <video id="video" class="responsive-video" controls poster="http://via.placeholder.com/854x480">--}}
{{--                            <source src="path_to_your_video" type="video/mp4">--}}
{{--                        </video>--}}
{{--                    </div>--}}
{{--                    <!-- Main Content Ends -->--}}
{{--                    <!-- Project Details Starts -->--}}
{{--                    <div class="projects-info row">--}}
{{--                        <div class="col-12 col-sm-6 p-none">--}}
{{--                            <h3 class="font-weight-600 uppercase">Video Format</h3>--}}
{{--                            <ul class="project-details">--}}
{{--                                <li><i class="fa fa-file-text-o"></i><span class="font-weight-400 project-label"> Project </span>: <span class="font-weight-600 uppercase">Website</span>--}}
{{--                                </li>--}}
{{--                                <li><i class="fa fa-user-o"></i><span class="font-weight-400 project-label"> Client </span>: <span class="font-weight-600 uppercase">Envato</span>--}}
{{--                                </li>--}}
{{--                                <li><i class="fa fa-hourglass-o"></i><span class="font-weight-400 project-label"> Duration </span>: <span class="font-weight-600 uppercase">3 months</span>--}}
{{--                                </li>--}}
{{--                                <li><i class="fa fa-code"></i> <span class="font-weight-400 project-label"> Technologies</span> : <span class="font-weight-600 uppercase">html, javascript</span>--}}
{{--                                </li>--}}
{{--                                <li><i class="fa fa-money"></i> <span class="font-weight-400 project-label"> Budget</span> : <span class="font-weight-600 uppercase">1550 USD</span>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                            <a href="#" class="btn"><span><i class="fa fa-external-link"></i>preview</span></a>--}}
{{--                        </div>--}}
{{--                        <div class="col-6 p-none text-right">--}}
{{--                            <a href="#" class="btn btn-secondary close-project"><span><i class="fa fa-close"></i>Close</span></a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- Project Details Ends -->--}}
{{--                </div>--}}
{{--                <!-- Portfolio Project Content Ends -->--}}
{{--                <!-- Portfolio Project Content Starts -->--}}
{{--                <div class="project-info-container project-5">--}}
{{--                    <!-- Main Content Starts -->--}}
{{--                    <div class="project-info-main-content">--}}
{{--                        <img src="http://via.placeholder.com/854x480" alt="Project Image">--}}
{{--                    </div>--}}
{{--                    <!-- Main Content Ends -->--}}
{{--                    <!-- Project Details Starts -->--}}
{{--                    <div class="projects-info row">--}}
{{--                        <div class="col-12 col-sm-6 p-none">--}}
{{--                            <h3 class="font-weight-600 uppercase">Image Format</h3>--}}
{{--                            <ul class="project-details">--}}
{{--                                <li><i class="fa fa-file-text-o"></i><span class="font-weight-400 project-label"> Project </span>: <span class="font-weight-600 uppercase">Website</span>--}}
{{--                                </li>--}}
{{--                                <li><i class="fa fa-user-o"></i><span class="font-weight-400 project-label"> Client </span>: <span class="font-weight-600 uppercase">Envato</span>--}}
{{--                                </li>--}}
{{--                                <li><i class="fa fa-hourglass-o"></i><span class="font-weight-400 project-label"> Duration </span>: <span class="font-weight-600 uppercase">3 months</span>--}}
{{--                                </li>--}}
{{--                                <li><i class="fa fa-code"></i> <span class="font-weight-400 project-label"> Technologies</span> : <span class="font-weight-600 uppercase">html, javascript</span>--}}
{{--                                </li>--}}
{{--                                <li><i class="fa fa-money"></i> <span class="font-weight-400 project-label"> Budget</span> : <span class="font-weight-600 uppercase">1550 USD</span>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                            <a href="#" class="btn"><span><i class="fa fa-external-link"></i>preview</span></a>--}}
{{--                        </div>--}}
{{--                        <div class="col-6 p-none text-right">--}}
{{--                            <a href="#" class="btn btn-secondary close-project"><span><i class="fa fa-close"></i>Close</span></a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- Project Details Ends -->--}}
{{--                </div>--}}
{{--                <!-- Portfolio Project Content Ends -->--}}
{{--                <!-- Portfolio Project Content Starts -->--}}
{{--                <div class="project-info-container project-6">--}}
{{--                    <!-- Main Content Starts -->--}}
{{--                    <div class="project-info-main-content">--}}
{{--                        <img src="http://via.placeholder.com/854x480" alt="Project Image">--}}
{{--                    </div>--}}
{{--                    <!-- Main Content Ends -->--}}
{{--                    <!-- Project Details Starts -->--}}
{{--                    <div class="projects-info row">--}}
{{--                        <div class="col-12 col-sm-6 p-none">--}}
{{--                            <h3 class="font-weight-600 uppercase">Image Format</h3>--}}
{{--                            <ul class="project-details">--}}
{{--                                <li><i class="fa fa-file-text-o"></i><span class="font-weight-400 project-label"> Project </span>: <span class="font-weight-600 uppercase">Website</span>--}}
{{--                                </li>--}}
{{--                                <li><i class="fa fa-user-o"></i><span class="font-weight-400 project-label"> Client </span>: <span class="font-weight-600 uppercase">Envato</span>--}}
{{--                                </li>--}}
{{--                                <li><i class="fa fa-hourglass-o"></i><span class="font-weight-400 project-label"> Duration </span>: <span class="font-weight-600 uppercase">3 months</span>--}}
{{--                                </li>--}}
{{--                                <li><i class="fa fa-code"></i> <span class="font-weight-400 project-label"> Technologies</span> : <span class="font-weight-600 uppercase">html, javascript</span>--}}
{{--                                </li>--}}
{{--                                <li><i class="fa fa-money"></i> <span class="font-weight-400 project-label"> Budget</span> : <span class="font-weight-600 uppercase">1550 USD</span>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                            <a href="#" class="btn"><span><i class="fa fa-external-link"></i>preview</span></a>--}}
{{--                        </div>--}}
{{--                        <div class="col-6 p-none text-right">--}}
{{--                            <a href="#" class="btn btn-secondary close-project"><span><i class="fa fa-close"></i>Close</span></a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- Project Details Ends -->--}}
{{--                </div>--}}
{{--                <!-- Portfolio Project Content Ends -->--}}
{{--                <!-- Portfolio Project Content Starts -->--}}
{{--                <div class="project-info-container project-7">--}}
{{--                    <!-- Main Content Starts -->--}}
{{--                    <div class="project-info-main-content">--}}
{{--                        <img src="http://via.placeholder.com/854x480" alt="Project Image">--}}
{{--                    </div>--}}
{{--                    <!-- Main Content Ends -->--}}
{{--                    <!-- Project Details Starts -->--}}
{{--                    <div class="projects-info row">--}}
{{--                        <div class="col-12 col-sm-6 p-none">--}}
{{--                            <h3 class="font-weight-600 uppercase">Image Format</h3>--}}
{{--                            <ul class="project-details">--}}
{{--                                <li><i class="fa fa-file-text-o"></i><span class="font-weight-400 project-label"> Project </span>: <span class="font-weight-600 uppercase">Website</span>--}}
{{--                                </li>--}}
{{--                                <li><i class="fa fa-user-o"></i><span class="font-weight-400 project-label"> Client </span>: <span class="font-weight-600 uppercase">Envato</span>--}}
{{--                                </li>--}}
{{--                                <li><i class="fa fa-hourglass-o"></i><span class="font-weight-400 project-label"> Duration </span>: <span class="font-weight-600 uppercase">3 months</span>--}}
{{--                                </li>--}}
{{--                                <li><i class="fa fa-code"></i> <span class="font-weight-400 project-label"> Technologies</span> : <span class="font-weight-600 uppercase">html, javascript</span>--}}
{{--                                </li>--}}
{{--                                <li><i class="fa fa-money"></i> <span class="font-weight-400 project-label"> Budget</span> : <span class="font-weight-600 uppercase">1550 USD</span>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                            <a href="#" class="btn"><span><i class="fa fa-external-link"></i>preview</span></a>--}}
{{--                        </div>--}}
{{--                        <div class="col-6 p-none text-right">--}}
{{--                            <a href="#" class="btn btn-secondary close-project"><span><i class="fa fa-close"></i>Close</span></a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- Project Details Ends -->--}}
{{--                </div>--}}
{{--                <!-- Portfolio Project Content Ends -->--}}
{{--                <!-- Portfolio Project Content Starts -->--}}
{{--                <div class="project-info-container project-8">--}}
{{--                    <!-- Main Content Starts -->--}}
{{--                    <div class="project-info-main-content">--}}
{{--                        <img src="http://via.placeholder.com/854x480" alt="Project Image">--}}
{{--                    </div>--}}
{{--                    <!-- Main Content Ends -->--}}
{{--                    <!-- Project Details Starts -->--}}
{{--                    <div class="projects-info row">--}}
{{--                        <div class="col-12 col-sm-6 p-none">--}}
{{--                            <h3 class="font-weight-600 uppercase">Image Format</h3>--}}
{{--                            <ul class="project-details">--}}
{{--                                <li><i class="fa fa-file-text-o"></i><span class="font-weight-400 project-label"> Project </span>: <span class="font-weight-600 uppercase">Website</span>--}}
{{--                                </li>--}}
{{--                                <li><i class="fa fa-user-o"></i><span class="font-weight-400 project-label"> Client </span>: <span class="font-weight-600 uppercase">Envato</span>--}}
{{--                                </li>--}}
{{--                                <li><i class="fa fa-hourglass-o"></i><span class="font-weight-400 project-label"> Duration </span>: <span class="font-weight-600 uppercase">3 months</span>--}}
{{--                                </li>--}}
{{--                                <li><i class="fa fa-code"></i> <span class="font-weight-400 project-label"> Technologies</span> : <span class="font-weight-600 uppercase">html, javascript</span>--}}
{{--                                </li>--}}
{{--                                <li><i class="fa fa-money"></i> <span class="font-weight-400 project-label"> Budget</span> : <span class="font-weight-600 uppercase">1550 USD</span>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                            <a href="#" class="btn"><span><i class="fa fa-external-link"></i>preview</span></a>--}}
{{--                        </div>--}}
{{--                        <div class="col-6 p-none text-right">--}}
{{--                            <a href="#" class="btn btn-secondary close-project"><span><i class="fa fa-close"></i>Close</span></a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- Project Details Ends -->--}}
{{--                </div>--}}
{{--                <!-- Portfolio Project Content Ends -->--}}
{{--                <!-- Portfolio Project Content Starts -->--}}
{{--                <div class="project-info-container project-9">--}}
{{--                    <!-- Main Content Starts -->--}}
{{--                    <div class="project-info-main-content">--}}
{{--                        <img src="http://via.placeholder.com/854x480" alt="Project Image">--}}
{{--                    </div>--}}
{{--                    <!-- Main Content Ends -->--}}
{{--                    <!-- Project Details Starts -->--}}
{{--                    <div class="projects-info row">--}}
{{--                        <div class="col-12 col-sm-6 p-none">--}}
{{--                            <h3 class="font-weight-600 uppercase">Image Format</h3>--}}
{{--                            <ul class="project-details">--}}
{{--                                <li><i class="fa fa-file-text-o"></i><span class="font-weight-400 project-label"> Project </span>: <span class="font-weight-600 uppercase">Website</span>--}}
{{--                                </li>--}}
{{--                                <li><i class="fa fa-user-o"></i><span class="font-weight-400 project-label"> Client </span>: <span class="font-weight-600 uppercase">Envato</span>--}}
{{--                                </li>--}}
{{--                                <li><i class="fa fa-hourglass-o"></i><span class="font-weight-400 project-label"> Duration </span>: <span class="font-weight-600 uppercase">3 months</span>--}}
{{--                                </li>--}}
{{--                                <li><i class="fa fa-code"></i> <span class="font-weight-400 project-label"> Technologies</span> : <span class="font-weight-600 uppercase">html, javascript</span>--}}
{{--                                </li>--}}
{{--                                <li><i class="fa fa-money"></i> <span class="font-weight-400 project-label"> Budget</span> : <span class="font-weight-600 uppercase">1550 USD</span>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                            <a href="#" class="btn"><span><i class="fa fa-external-link"></i>preview</span></a>--}}
{{--                        </div>--}}
{{--                        <div class="col-6 p-none text-right">--}}
{{--                            <a href="#" class="btn btn-secondary close-project"><span><i class="fa fa-close"></i>Close</span></a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- Project Details Ends -->--}}
{{--                </div>--}}
{{--                <!-- Portfolio Project Content Ends -->--}}
{{--                <span class="back-mobile close-project"><i class="fa fa-arrow-left"></i></span>--}}
{{--            </section>--}}
            <!-- Portfolio Section Ends -->
            <!-- Contact Section Starts -->
            <section id="contact">
                <div class="contact-container">
                    <!-- Main Heading Starts -->
                    <div class="container page-title text-center">
                        <h2 class="text-center">Liên hệ <span>với tôi</span></h2>
                        <span class="title-head-subtitle">{{$config->des_contactpage}}</span>
                    </div>
                    <!-- Main Heading Ends -->
                    <div class="container">
                        <div class="row contact">
                            <!-- Contact Infos Starts -->
                            <div class="col-12 col-md-4 col-xl-4 leftside">
                                <ul class="custom-list">
                                    <li>
                                        <h6 class="font-weight-600"> <span class="contact-title">Phone</span><i class="fa fa-whatsapp"></i><span class="contact-content">{{@$user->phone ?? ''}}</span></h6>
                                    </li>
                                    <li>
                                        <h6 class="font-weight-600"> <span class="contact-title">Email</span><i class="fa fa-envelope-o fs-14"></i><span class="contact-content">{{@$user->email ?? ''}}</span></h6>

                                    </li>
                                    <li>
                                        <h6 class="font-weight-600"><span class="contact-title">Facebook</span><i class="fa fa-instagram"></i><span class="contact-content">{{@$user->facebook ?? ''}}</span></h6>

                                    </li>
                                    <li>
                                        <h6 class="font-weight-600"><span class="contact-title">Skype </span><i class="fa fa-dribbble"></i><span class="contact-content">{{@$user->skype ?? ''}}</span></h6>
                                    </li>
                                </ul>

                                <!-- Social Media Profiles Starts -->

                                <div class="social">
                                    <h6 class="font-weight-600 uppercase">Social Profiles</h6>
                                    <ul class="list-inline social social-intro text-center p-none">
                                        <li class="facebook"><a title="Facebook" href="{{@$user->facebook ?? ''}}"><i class="fa fa-facebook"></i></a>
                                        </li>
                                        <li class="twitter"><a title="Twitter" href="#"><i class="fa fa-twitter"></i></a>
                                        </li>
                                        <li class="youtube"><a title="Youtube" href="#"><i class="fa fa-youtube"></i></a>
                                        </li>
                                        <li class="dribbble"><a title="Dribbble" href="#"><i class="fa fa-dribbble"></i></a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- Social Media Profiles Ends -->
                            </div>
                            <!-- Contact Infos Ends -->
                            <!-- Contact Form Starts -->
                            <div class="col-12 col-md-8 col-xl-8 rightside">
                                <p ng-if="!sendSuccess">
                                    Nếu bạn có bất kỳ đề xuất, dự án nào hoặc thậm chí bạn muốn nói Xin chào..
                                    vui lòng điền vào mẫu bên dưới và tôi sẽ trả lời bạn ngay
                                </p>
                                <p ng-if="sendSuccess">
                                    Cảm ơn bạn đã để lại liên hệ!
                                </p>
                                <form class="contactform">
                                    <div class="row">
                                        <!-- Name Field Starts -->
                                        <div class="form-group col-xl-6"> <i class="fa fa-user prefix"></i>
                                            <input id="name" name="name" type="text" class="form-control" placeholder="Họ tên" ng-model="contact.user_name" required>
                                            <span class="invalid-feedback d-block" role="alert" ng-if="errors && errors.user_name" >
                                                <strong><% errors.user_name[0] %></strong>
                                            </span>
                                        </div>
                                        <!-- Name Field Ends -->
                                        <!-- Email Field Starts -->
                                        <div class="form-group col-xl-6"> <i class="fa fa-envelope prefix"></i>
                                            <input id="email" type="email" name="email" class="form-control" placeholder="Email" ng-model="contact.email" required>
                                            <span class="invalid-feedback d-block" role="alert" ng-if="errors && errors.email" >
                                                <strong><% errors.email[0] %></strong>
                                            </span>
                                        </div>
                                        <!-- Email Field Ends -->
                                        <!-- Comment Textarea Starts -->
                                        <div class="form-group col-xl-12"> <i class="fa fa-comments prefix"></i>
                                            <textarea id="comment" name="comment" class="form-control" placeholder="Tin nhắn" ng-model="contact.content" required></textarea>
                                            <span class="invalid-feedback d-block" role="alert" ng-if="errors && errors.content" >
                                                <strong><% errors.content[0] %></strong>
                                            </span>
                                        </div>
                                        <!-- Comment Textarea Ends -->
                                    </div>
                                    <!-- Submit Form Button Starts -->
                                    <div class="submit-form">
                                        <button class="btn button-animated" type="button" name="send" ng-click="submit()">
                                            <span>
                                                <i class="fa fa-send" ng-if="!loading"></i>
                                                <img src="/site/image/loading1.gif"  class="loading" ng-if="loading">
                                                Gửi
                                            </span>
                                        </button>
                                    </div>
                                    <!-- Submit Form Button Ends -->
                                    <div class="form-message"> <span class="output_message text-center font-weight-600 uppercase"></span>
                                    </div>
                                </form>
                            </div>
                            <!-- Contact Form Ends -->

                        </div>
                    </div>
                </div>
            </section>
            <!-- Contact Section Ends -->
            <!-- Blog Section Starts -->
            <section id="blog">
                <div class="container page-title text-center">
                    <h2 class="text-center">Blog <span>mới nhất</span></h2>
                    <span class="title-head-subtitle">{{$config->des_blogpage}}</span>
                </div>
                <div class="container">
                    <div class="row">
                        @foreach($posts as $post)
                            <div class="col-12 col-sm-6">
                                <article>
                                    <!-- Figure Starts -->
                                    <figure class="blog-figure">
                                        <a href="{{route('front.getPost', ['categorySlug' => $post->category->slug, 'slug' => $post->slug])}}">
                                            <img class="img-fluid" src="{{$post->image->path ?? ''}}" alt="" style="max-height: 304px">
                                        </a>

                                        <div class="post-date">
                                            <span>{{\Carbon\Carbon::parse($post->created_at)->format('d')}}</span>
                                            <span>T {{\Carbon\Carbon::parse($post->created_at)->format('m')}}</span>
                                        </div>
                                    </figure>
                                    <!-- Figure Ends -->
                                    <a href="{{route('front.getPost', ['categorySlug' => $post->category->slug, 'slug' => $post->slug])}}">
                                        <h4>{{$post->name}}</h4>
                                    </a>
                                    <!-- Excerpt Starts -->
                                    <div class="blog-excerpt">
{{--                                        <p>{!! $post->intro !!}</p>--}}
                                        <a href="{{route('front.getPost', ['categorySlug' => $post->category->slug, 'slug' => $post->slug])}}" class="btn readmore"><span>Đọc thêm</span></a>
                                    </div>
                                    <!-- Excerpt Ends -->
                                </article>
                            </div>

                        @endforeach
                        <!-- Article Starts -->
                                               <!-- Article Ends -->
                        <!-- Link To Blog Starts -->
                        <div class="col-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 allposts"> <a href="{{route('front.posts')}}" class="btn btn-secondary"><span><i class="fa fa-comments"></i>Tất cả Blog</span></a>
                        </div>
                        <!-- Link To Blog Ends -->
                    </div>
                </div>
            </section>
            <!-- Blog Section Ends -->
        </main>


    </div>


<!-- <span></span> -->
@endsection
@push('scripts')
    <script>
        app.controller('Contact', function ($scope, $http) {
            $scope.contact = {};
            $scope.sendSuccess = false;
            $scope.submit = function() {
                var url = "{{route('send.contact')}}";
                $scope.loading = true;
                $.ajax({
                    url: url,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{!! csrf_token() !!}'
                    },
                    data: $scope.contact,
                    beforeSend: function() {
                        $('.loading').show();
                    },
                    success: function(response) {
                        if (response.success) {
                            $scope.errors = null;
                            $scope.sendSuccess = true;
                            $scope.contact = null;
                        } else {
                            $scope.errors = response.errors;
                        }
                    },
                    error: function(err) {
                        console.log(err);
                    },
                    complete: function() {
                        $scope.loading = false;
                        $scope.$apply();
                    }
                });
            }
        })
    </script>

@endpush
