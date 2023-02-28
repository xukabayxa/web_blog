jQuery(document).ready(function() {

    if ($('.wpml-ls-legacy-list-horizontal ul li.wpml-ls-item-vi.wpml-ls-current-language').length > 0) {
        $('.wpml-ls-legacy-list-horizontal ul').attr('current', 'vi');
    } else {
        $('.wpml-ls-legacy-list-horizontal ul').attr('current', 'en');
    }

    setTimeout(function() {
        $('.loader').addClass('inactive');        
    }, 500);

    var vp_w = $(window).width();
    var vp_h = $(window).height();

    console.log(vp_w);
    console.log(vp_h);

    // setTimeout(function() {
    //     $('.popup').addClass('active');
    // }, 750);
    // $('.popup .overlay, .popup .close, .popup .menu-item').click(function() {
    //     $('.popup').removeClass('active');
    // });

    $('.headSearchIcon').click(function() {
        $('header').toggleClass('search-on');
    });

    $('.homeIndustry-navItem:nth-child(1), .homeIndustry-img:nth-child(1), .homeIndustry-item:nth-child(1)').addClass('active');

    $('.homeIndustry-navItem').mouseover(function() {
        $('.homeIndustry-navItem').not(this).removeClass('active');
        $(this).addClass('active');
        var homeIndustryIndex = $(this).index() + 1;
        $('.homeIndustry-img, .homeIndustry-item').removeClass('active');
        $('.homeIndustry-img:nth-child(' + homeIndustryIndex + '), .homeIndustry-item:nth-child(' + homeIndustryIndex + ')').addClass('active');
    });

    $('.homeNews-item').mouseover(function(){
        var getCurrentNews = $(this).index() + 1;
        var getCurrentLeft = $(this).offset().left;
        var getCurrentTop = $(this).offset().top;
        $('.homeNews-detailItem').removeClass('active');
        $('.homeNews-detailItem:nth-child(' + getCurrentNews + ')').addClass('active').css('left',getCurrentLeft - 25).css('top',getCurrentTop - 132);
    });

    $('.homeNews-item').mouseleave(function(){
        $('.homeNews-detailItem').removeClass('active');
    });

    $(document).on('click', 'a.scrollTo[href^="#"]', function(e) {
        // target element id
        var id = $(this).attr('href');

        // target element
        var $id = $(id);
        if ($id.length === 0) {
            return;
        }

        // prevent standard hash navigation (avoid blinking in IE)
        e.preventDefault();

        // top position relative to the document
        var pos = $id.offset().top - 100;

        // animated top scrolling
        $('body, html').animate({ scrollTop: pos }, "easeOutBounce", );
    });

    $('body').delegate('.newsList-nav a', 'click', function() {
        $('body, html').animate({ scrollTop: $('.newsList').offset().top - 100 }, "easeOutBounce", );
    })
    $('body').delegate('.businessContent-nav a', 'click', function() {
        $('body, html').animate({ scrollTop: $('.businessMain').offset().top - 100 }, "easeOutBounce", );
    })

    $('.homeBanner-slider').slick({
        draggable: true,
        arrows: true,
        dots: true,
        autoplay: true,
        autoplaySpeed: 10000,
        infinite: true,
        fade: true,
        adaptiveHeight: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        // cssEase: 'cubic-bezier(0.7, 0, 0.3, 1)',
        // touchThreshold: 100
        appendArrows: $('.homeBanner-nav'),
        appendDots: $('.homeBanner-nav'),
        prevArrow: '<i class="slideNavPrev slideNavItem fal fa-chevron-circle-up"></i>',
        nextArrow: '<i class="slideNavNext slideNavItem fal fa-chevron-circle-down"></i>',
    });

    $('.aboutBanner-slider').slick({
        draggable: true,
        arrows: true,
        dots: true,
        autoplay: true,
        autoplaySpeed: 10000,
        infinite: true,
        fade: true,
        adaptiveHeight: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        // cssEase: 'cubic-bezier(0.7, 0, 0.3, 1)',
        // touchThreshold: 100
        appendArrows: $('.homeBanner-nav'),
        appendDots: $('#aboutBanner-dots'),
        prevArrow: '<i class="slideNavPrev slideNavItem fal fa-chevron-circle-up"></i>',
        nextArrow: '<i class="slideNavNext slideNavItem fal fa-chevron-circle-down"></i>',
    });
    $('.projectGallery').slick({
        draggable: true,
        arrows: false,
        dots: false,
        autoplay: true,
        autoplaySpeed: 10000,
        infinite: true,
        fade: true,
        adaptiveHeight: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        // cssEase: 'cubic-bezier(0.7, 0, 0.3, 1)',
        // touchThreshold: 100
        // appendArrows: $('.homeBanner-nav'),
        // appendDots: $('.homeBanner-nav'),
        // prevArrow: '<i class="slideNavPrev slideNavItem fal fa-chevron-circle-up"></i>',
        // nextArrow: '<i class="slideNavNext slideNavItem fal fa-chevron-circle-down"></i>',
    });
    $('.newsLastest-slider').slick({
        draggable: true,
        arrows: true,
        dots: true,
        autoplay: true,
        autoplaySpeed: 10000,
        infinite: true,
        fade: true,
        adaptiveHeight: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        // cssEase: 'cubic-bezier(0.7, 0, 0.3, 1)',
        // touchThreshold: 100
        appendArrows: $('#newsLastest-nav'),
        appendDots: $('#newsLastest-dots'),
        prevArrow: '<div class="slideNavPrev slideNavItem slideNavArr"></div>',
        nextArrow: '<div class="slideNavNext slideNavItem slideNavArr"></div>',
    });
    $('.homeNews-listing').slick({
        draggable: true,
        arrows: true,
        dots: false,
        autoplay: false,
        autoplaySpeed: 10000,
        infinite: false,
        fade: false,
        adaptiveHeight: false,
        variableWidth: true,
        slidesToShow: 3,
        slidesToScroll: 2,
        // cssEase: 'cubic-bezier(0.7, 0, 0.3, 1)',
        // touchThreshold: 100
        appendArrows: $('.homeNews-nav'),
        // appendDots: $('.homeBanner-nav'),
        prevArrow: '<i class="slideNavPrev slideNavItem fal fa-angle-left"></i>',
        nextArrow: '<i class="slideNavNext slideNavItem fal fa-angle-right"></i>',
    });

    function homeIntroSetting() {
        return {
            draggable: true,
            arrows: false,
            dots: true,
            autoplay: false,
            autoplaySpeed: 10000,
            infinite: true,
            fade: true,
            adaptiveHeight: false,
            slidesToShow: 1,
            slidesToScroll: 1,
            // cssEase: 'cubic-bezier(0.7, 0, 0.3, 1)',
            // touchThreshold: 100
            // appendArrows: $('.homeBanner-nav'),
            appendDots: $('.homeIntro-slideNav'),
            // prevArrow: '<i class="slideNavPrev slideNavItem fal fa-chevron-circle-up"></i>',
            // nextArrow: '<i class="slideNavNext slideNavItem fal fa-chevron-circle-down"></i>',
        }
    };

    $('.homeIntro-slides').slick(homeIntroSetting());

    $('.aboutPartner .component-partner, .newsPartner .component-partner, .singlePost-partner .component-partner, .businessPartner .component-partner').slick({
        draggable: true,
        arrows: false,
        dots: false,
        autoplay: true,
        autoplaySpeed: 10000,
        infinite: true,
        adaptiveHeight: false,
        slidesToShow: 6,
        slidesToScroll: 3,
        // cssEase: 'cubic-bezier(0.7, 0, 0.3, 1)',
        // touchThreshold: 100
        // appendArrows: $('.homeBanner-nav'),
        // appendDots: $('.homeIntro-slideNav'),
        // prevArrow: '<i class="slideNavPrev slideNavItem fal fa-chevron-circle-up"></i>',
        // nextArrow: '<i class="slideNavNext slideNavItem fal fa-chevron-circle-down"></i>',
        responsive: [
        {
            breakpoint: 640,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 2,
            }
        },
        ]
    });

    $('.businessItem').mouseover(function() {
        $('.businessItem').not(this).addClass('inactive');
    });
    $('.businessItem').mouseleave(function() {
        $('.businessItem').removeClass('inactive');
    });


    if ($(window).width() > 640) {
        $('#home').fullpage({
            anchors: ['1', '2', '3', '4', '5', '6', '7', '8', '9'],
            autoScrolling: true,
            scrollHorizontally: true,
            afterLoad: function(origin, destination, direction) {
                // console.log(index);
                var loadedSection = $(this);
                // alert(anchorLink);
                $('.mainMenu .nav li, .menuLabel li').removeClass('active');
                $('.mainMenu .nav li').eq(destination.index).addClass('active');
                $('.menuLabel li').eq(destination.index).addClass('active');
                // console.log(destination);
                if (destination.anchor == 3) {
                    setTimeout(function() {
                        $('.homeIntro-slides').addClass('on');
                    }, 1000);
                }
                if (destination.anchor != 3) {
                    // $('.map .item').removeClass('active');
                    $('.homeIntro-slides').removeClass('on');
                }
            },
            onLeave: function(origin, destination, direction) {
                if (destination.anchor == 1) {
                    $('.homeScroll').removeClass('f2').removeClass('f3').addClass('f1');
                }
                if (destination.anchor == 2) {
                    $('.homeScroll').removeClass('f1').removeClass('f3').addClass('f2');
                }
                if (destination.anchor == 3) {
                    $('.homeScroll').removeClass('f1').removeClass('f2').addClass('f3');
                    // $('.homeIntro-slides').slick(homeIntroSetting());
                } else {
                    // $('.homeIntro-slides').slick('unslick');
                }
            },
        });
        $(".innerScroll").mCustomScrollbar();
    };



    $('#nav-icon1').click(function() {
        $('body').toggleClass('toggleMenu');
        $(this).toggleClass('open');
    });

    $(".newsSuggest-projectNav").jPages({
        containerID: "newsSuggest-projects",
        minHeight: false,
        perPage: 10,
        previous: '←',
        next: '→',
        startPage: 1,
        startRange: 1,
        midRange: 5,
        endRange: 1
    });

    $(".newsList-nav").jPages({
        containerID: "newsList",
        minHeight: false,
        perPage: 9,
        previous: '←',
        next: '→',
        startPage: 1,
        startRange: 1,
        midRange: 5,
        endRange: 1
    });

    $(".businessNews-nav").jPages({
        containerID: "businessNews",
        minHeight: false,
        perPage: 5,
        previous: '←',
        next: '→',
        startPage: 1,
        startRange: 1,
        midRange: 5,
        endRange: 1
    });

    $(".businessContent-nav").jPages({
        containerID: "businessContent",
        minHeight: false,
        perPage: 5,
        previous: '←',
        next: '→',
        startPage: 1,
        startRange: 1,
        midRange: 5,
        endRange: 1
    });

    

    // new WOW().init();

    $('.contactForm-toggle').click(function() {
        $('.contactForm').toggleClass('on');
    });

    if (vp_w < 640) {
        $('.headMenuToggle').click(function() {
            $('body').toggleClass('menuOn');
        });

        $('.component-comboBox').click(function(){
            $(this).toggleClass('on');
        });
    }

    $(document).on('click', 'a.scrollTo[href^="#"]', function(e) {
        // target element id
        var id = $(this).attr('href');

        // target element
        var $id = $(id);
        if ($id.length === 0) {
            return;
        }

        // prevent standard hash navigation (avoid blinking in IE)
        e.preventDefault();

        // top position relative to the document
        var pos = $id.offset().top - 100;

        // animated top scrolling
        $('body, html').animate({
            scrollTop: pos
        }, "easeOutBounce", );
    });

    // page Parners

    $('.partner-slider .component-partner').slick({
        draggable: false,
        arrows: true,
        dots: true,
        autoplay: true,
        autoplaySpeed: 10000,
        infinite: false,
        adaptiveHeight: false,
        slidesToShow: 5,
        slidesToScroll: 1,
        centerMode: true,
        centerPadding: '0px',
        focusOnSelect: true,
        asNavFor: '.partnerContent-list',
        // cssEase: 'cubic-bezier(0.7, 0, 0.3, 1)',
        // touchThreshold: 100
        appendArrows: $('#partner-sliderNav'),
        // appendDots: $('.homeIntro-slideNav'),
        prevArrow: '<div class="slideNavPrev slideNavItem slideNavArr"></div>',
        nextArrow: '<div class="slideNavNext slideNavItem slideNavArr"></div>',
        responsive: [
        {
            breakpoint: 640,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 2,
            }
        },
        ]
    });

    $('.partnerContent-list').slick({
        draggable: true,
        arrows: false,
        dots: false,
        autoplay: true,
        autoplaySpeed: 10000,
        infinite: false,
        fade: true,
        adaptiveHeight: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        asNavFor: '.partnerList .component-partner',
        // cssEase: 'cubic-bezier(0.7, 0, 0.3, 1)',
        // touchThreshold: 100
        // appendArrows: $('.homeBanner-nav'),
        // appendDots: $('.homeIntro-slideNav'),
        // prevArrow: '<i class="slideNavPrev slideNavItem fal fa-chevron-circle-up"></i>',
        // nextArrow: '<i class="slideNavNext slideNavItem fal fa-chevron-circle-down"></i>',
    });

    $('.partner-slider .component-partner').slick('slickGoTo', 2);
    $('.partnerNav-first').click(function() {
        $('.partner-slider .component-partner').slick('slickGoTo', "0");
    })
    $('.partnerNav-last').click(function() {
        var getLastSlide = $('.partner-slider .component-partner .partnerItem').length;
        console.log(getLastSlide);
        $('.partner-slider .component-partner').slick('slickGoTo', getLastSlide);
    })

});




