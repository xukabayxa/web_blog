@extends('site.layouts.master')
@section('title')
    <title>{{ "Không tìm thấy yêu cầu - " . ucfirst($_SERVER['HTTP_HOST']) }}</title>
@endsection
@section('content')
    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="{{route('front.home_page')}}">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Lỗi</li>
                        <input type="hidden" value="{{$error}}">
                    </ul>
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area end -->

    <!-- main-content-wrap start -->
    <div class="main-content-wrap section-ptb wishlist-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="search-error-wrapper">
                        <h1>404</h1>
                        <h2>Không tìm thấy yêu cầu</h2>
                        <p class="home-link">
                            Xin lỗi trang bạn đang tìm không tồn tại, đã bị xóa, đổi tên hoặc tạm thời không có.
                        </p>
                        <form action="#" class="error-form">
                            <div class="error-form-input">
{{--                                <input type="text" placeholder="Search..." class="error-input-text">--}}
{{--                                <button type="submit" class="error-s-button"><i class="icon-magnifier"></i></button>--}}
                            </div>
                        </form>
                        <a href="{{route('front.home_page')}}" class="home-bacck-button">Quay lại</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- main-content-wrap end -->
@endsection
