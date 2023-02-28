<footer class="position-relative pt-3 pt-md-5">
    <div class="container z-index-9 position-relative">
        <div class="row">
            <div class="col-lg-12">
                <a href="#" class="footer-logo">
                    <img src="{{ asset('site/system/rt-footer.png') }}" class="mb-4" alt="Footer Logo">
                </a>
            </div>
        </div>
        <div class="row mt-n5 pb-2 pb-xxl-6">

            @foreach($stores as $store)
                <div class="col-lg-5 mt-3 wow fadeIn" data-wow-delay="180ms" style="visibility: visible; animation-delay: 200ms; animation-name: fadeIn;">
                    <div>
                        <div>
                            <div class="textwidget">
                                <div class="sec-title pb-4">
                                    <h3 class="text-white h5 text-uppercase">{{App::isLocale('vi') ? $store->name : $store->en_name }}</h3>
                                </div>
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-3"><i class="far fa-envelope text-primary display-25 mr-3"></i>{{App::isLocale('vi') ? $store->email : $store->en_email }}</li>
                                    <li class="mb-3"><i class="fas fa-mobile-alt text-primary display-25 mr-3"></i>{{App::isLocale('vi') ? $store->hotline : $store->en_hotline }}</li>
                                    <li><i class="fas fa-map-marker-alt text-primary display-25 mr-3"></i>{{App::isLocale('vi') ? $store->address : $store->en_address }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach

            <div class="col-lg-2 mt-3 wow fadeIn" data-wow-delay="200ms" style="visibility: visible; animation-delay: 200ms; animation-name: fadeIn;">
                <div>
                    <div class="textwidget">
                        <div class="sec-title pb-4">
                            <h3 class="text-white h5">Links</h3>
                        </div>
                        <ul class="footer-link mb-0 list-unstyled">
                            <li class="mb-3"><a href="{{route('front.home_page')}}">Home</a></li>
                            <li class="mb-3"><a href="{{route('front.about')}}">About</a></li>
                            <li class="mb-3"><a href="{{route('front.globalReach')}}">Our global presence</a></li>
                            <li class="mb-3"><a href="{{route('front.insights')}}">Insights</a></li>
                            <li><a href="{{route('front.contact')}}">Contact</a></li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="border-top border-color-light-white z-index-9 position-relative wow fadeIn" data-wow-delay="200ms" style="visibility: visible; animation-delay: 200ms; animation-name: fadeIn;">
        <div class="container">
            <div class="row align-items-center py-4">
                <div class="col-md-7 col-lg-6 text-md-start order-2 order-md-1">
                    <p class="d-inline-block text-white mb-0">
                        © <span class="current-year">{{ date('Y') }}</span> All rights reserved by
                        <a href="#!" class="text-primary text-secondary-hover">RTENERGY</a>
                    </p>
                </div>
                <div class="col-md-5 col-lg-6 text-md-end mb-3 mb-md-0 order-1 order-md-2 text-right">
                    <ul class="social-icon-style1 pull-right">
                        <li><a target="_blank" href="{{$config->facebook}}"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a target="_blank" href="{{$config->twitter}}"><i class="fab fa-twitter"></i></a></li>
                        <li><a target="_blank" href="#"><i class="fab fa-youtube"></i></a></li>
                        <li><a target="_blank" href="#"><i class="fab fa-linkedin-in"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div>
        <div class="textwidget">
            <p class="mb-0"><img class="footer-bg-left" src="https://renumawp.websitelayout.net/wp-content/uploads/2022/02/bg-06.png" alt=""></p>
            <p class="mb-0"><img class="footer-bg-right" src="https://renumawp.websitelayout.net/wp-content/uploads/2022/02/bg-07.png" alt=""></p>
        </div>
    </div>
</footer>
