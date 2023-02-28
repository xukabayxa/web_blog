@extends('site.layouts.master')
@section('title')
@endsection
@section('content')
<header class="lte-page-header lte-parallax-yes header-contact">
    <div class="container">
        <div class="lte-header-h1-wrapper">
            <h1 class="header">{{App::isLocale('vi') ? 'Liên hệ' : 'Contact'}}</h1>
        </div>

    @include('site.partials.bread_crumb2', ['vi' => 'Liên hệ', 'en' => 'Contact'])

    </div>
</header>
    <section id="sozo-main">
    <section class="contact" id="contact" ng-controller="Contact">
        <div class="box-container">
            <div class="contact-info">
                <h3 style="color: #fff">@if(App::isLocale('en')) Contact info @else Thông tin liên hệ: @endif</h3>
                <div class="box-container">
                    @if(App::isLocale('en'))
                    <div class="info-item">
                        <div class="icon-item">
                            <div class="icon">
                                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 1024 1024" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M721.7 184.9L610.9 295.8l120.8 120.7-8 21.6A481.29 481.29 0 0 1 438 723.9l-21.6 8-.9-.9-119.8-120-110.8 110.9 104.5 104.5c10.8 10.7 26 15.7 40.8 13.2 117.9-19.5 235.4-82.9 330.9-178.4s158.9-213.1 178.4-331c2.5-14.8-2.5-30-13.3-40.8L721.7 184.9z"></path>
                                    <path d="M877.1 238.7L770.6 132.3c-13-13-30.4-20.3-48.8-20.3s-35.8 7.2-48.8 20.3L558.3 246.8c-13 13-20.3 30.5-20.3 48.9 0 18.5 7.2 35.8 20.3 48.9l89.6 89.7a405.46 405.46 0 0 1-86.4 127.3c-36.7 36.9-79.6 66-127.2 86.6l-89.6-89.7c-13-13-30.4-20.3-48.8-20.3a68.2 68.2 0 0 0-48.8 20.3L132.3 673c-13 13-20.3 30.5-20.3 48.9 0 18.5 7.2 35.8 20.3 48.9l106.4 106.4c22.2 22.2 52.8 34.9 84.2 34.9 6.5 0 12.8-.5 19.2-1.6 132.4-21.8 263.8-92.3 369.9-198.3C818 606 888.4 474.6 910.4 342.1c6.3-37.6-6.3-76.3-33.3-103.4zm-37.6 91.5c-19.5 117.9-82.9 235.5-178.4 331s-213 158.9-330.9 178.4c-14.8 2.5-30-2.5-40.8-13.2L184.9 721.9 295.7 611l119.8 120 .9.9 21.6-8a481.29 481.29 0 0 0 285.7-285.8l8-21.6-120.8-120.7 110.8-110.9 104.5 104.5c10.8 10.8 15.8 26 13.3 40.8z"></path></svg>
                                </div>
                            </div>
                            <div class="content">
                                <h4>Hotline</h4><ol>
                                    <p>Ha noi (Head Office): +8494 866 8889</p>
                                    <p>HCM: +8494 866 8889</p>
                                </ol>
                            </div>
                            </div>
                            <div class="info-item">
                                <div class="icon-item">
                                    <div class="icon">
                                        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 16 16" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="content">
                                    <h4>Opening hours</h4>
                                    <ol><p>Mon - Fri : 8am - 6pm</p><p>Sat : 8am - 12am</p></ol>
                                </div>
                            </div>
                            <div class="info-item">
                                <div class="icon-item">
                                    <div class="icon">
                                        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M502.3 190.8c3.9-3.1 9.7-.2 9.7 4.7V400c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V195.6c0-5 5.7-7.8 9.7-4.7 22.4 17.4 52.1 39.5 154.1 113.6 21.1 15.4 56.7 47.8 92.2 47.6 35.7.3 72-32.8 92.3-47.6 102-74.1 131.6-96.3 154-113.7zM256 320c23.2.4 56.6-29.2 73.4-41.4 132.7-96.3 142.8-104.7 173.4-128.7 5.8-4.5 9.2-11.5 9.2-18.9v-19c0-26.5-21.5-48-48-48H48C21.5 64 0 85.5 0 112v19c0 7.4 3.4 14.3 9.2 18.9 30.6 23.9 40.7 32.4 173.4 128.7 16.8 12.2 50.2 41.8 73.4 41.4z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="content">
                                    <h4>Email</h4>
                                    <ol>
                                        <p>infor.RTenergy@gmail.com</p>
                                    </ol>
                                </div>
                            </div>

                            <div class="info-item">
                                <div class="icon-item-address">
                                    <div class="icon">
                                        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 16 16" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.598-.49L10.5.99 5.598.01a.5.5 0 0 0-.196 0l-5 1A.5.5 0 0 0 0 1.5v14a.5.5 0 0 0 .598.49l4.902-.98 4.902.98a.502.502 0 0 0 .196 0l5-1A.5.5 0 0 0 16 14.5V.5zM5 14.09V1.11l.5-.1.5.1v12.98l-.402-.08a.498.498 0 0 0-.196 0L5 14.09zm5 .8V1.91l.402.08a.5.5 0 0 0 .196 0L11 1.91v12.98l-.5.1-.5-.1z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="content">
                                    <h4>Address</h4>
                                    <ol>
                                        <p>Ha noi (Head Office): IDMC Building, No. 21 Duy Tan street, Cau Giay, Hanoi
                                        </p>
                                        <p>Ho Chi Minh City: 146 Nguyen Van Huong, F18, Thao Dien, District 2, Ho Chi Minh City
                                        </p>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="info-item">
                        <div class="icon-item">
                            <div class="icon">
                                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 1024 1024" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M721.7 184.9L610.9 295.8l120.8 120.7-8 21.6A481.29 481.29 0 0 1 438 723.9l-21.6 8-.9-.9-119.8-120-110.8 110.9 104.5 104.5c10.8 10.7 26 15.7 40.8 13.2 117.9-19.5 235.4-82.9 330.9-178.4s158.9-213.1 178.4-331c2.5-14.8-2.5-30-13.3-40.8L721.7 184.9z"></path>
                                    <path d="M877.1 238.7L770.6 132.3c-13-13-30.4-20.3-48.8-20.3s-35.8 7.2-48.8 20.3L558.3 246.8c-13 13-20.3 30.5-20.3 48.9 0 18.5 7.2 35.8 20.3 48.9l89.6 89.7a405.46 405.46 0 0 1-86.4 127.3c-36.7 36.9-79.6 66-127.2 86.6l-89.6-89.7c-13-13-30.4-20.3-48.8-20.3a68.2 68.2 0 0 0-48.8 20.3L132.3 673c-13 13-20.3 30.5-20.3 48.9 0 18.5 7.2 35.8 20.3 48.9l106.4 106.4c22.2 22.2 52.8 34.9 84.2 34.9 6.5 0 12.8-.5 19.2-1.6 132.4-21.8 263.8-92.3 369.9-198.3C818 606 888.4 474.6 910.4 342.1c6.3-37.6-6.3-76.3-33.3-103.4zm-37.6 91.5c-19.5 117.9-82.9 235.5-178.4 331s-213 158.9-330.9 178.4c-14.8 2.5-30-2.5-40.8-13.2L184.9 721.9 295.7 611l119.8 120 .9.9 21.6-8a481.29 481.29 0 0 0 285.7-285.8l8-21.6-120.8-120.7 110.8-110.9 104.5 104.5c10.8 10.8 15.8 26 13.3 40.8z"></path></svg>
                                </div>
                            </div>
                            <div class="content">
                                <h4>Đường dây nóng</h4><ol>
                                    <p>Hà Nội (Trụ sở chính): +8494 866 8889</p>
                                    <p>Tp. Hồ Chí Minh: +8494 866 8889</p>
                                </ol>
                            </div>
                            </div>
                            <div class="info-item">
                                <div class="icon-item">
                                    <div class="icon">
                                        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 16 16" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="content">
                                    <h4>Giờ làm việc</h4>
                                    <ol><p>Thứ 2 - Thứ 6 : 8h - 18h</p><p>Thứ 7 : 9h - 12h</p></ol>
                                </div>
                            </div>
                            <div class="info-item">
                                <div class="icon-item">
                                    <div class="icon">
                                        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M502.3 190.8c3.9-3.1 9.7-.2 9.7 4.7V400c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V195.6c0-5 5.7-7.8 9.7-4.7 22.4 17.4 52.1 39.5 154.1 113.6 21.1 15.4 56.7 47.8 92.2 47.6 35.7.3 72-32.8 92.3-47.6 102-74.1 131.6-96.3 154-113.7zM256 320c23.2.4 56.6-29.2 73.4-41.4 132.7-96.3 142.8-104.7 173.4-128.7 5.8-4.5 9.2-11.5 9.2-18.9v-19c0-26.5-21.5-48-48-48H48C21.5 64 0 85.5 0 112v19c0 7.4 3.4 14.3 9.2 18.9 30.6 23.9 40.7 32.4 173.4 128.7 16.8 12.2 50.2 41.8 73.4 41.4z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="content">
                                    <h4>Email</h4>
                                    <ol>
                                        <p>infor.RTenergy@gmail.com</p>
                                    </ol>
                                </div>
                            </div>

                            <div class="info-item">
                                <div class="icon-item-address">
                                    <div class="icon">
                                        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 16 16" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.598-.49L10.5.99 5.598.01a.5.5 0 0 0-.196 0l-5 1A.5.5 0 0 0 0 1.5v14a.5.5 0 0 0 .598.49l4.902-.98 4.902.98a.502.502 0 0 0 .196 0l5-1A.5.5 0 0 0 16 14.5V.5zM5 14.09V1.11l.5-.1.5.1v12.98l-.402-.08a.498.498 0 0 0-.196 0L5 14.09zm5 .8V1.91l.402.08a.5.5 0 0 0 .196 0L11 1.91v12.98l-.5.1-.5-.1z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="content">
                                    <h4>Địa chỉ</h4>
                                    <ol>
                                        <p>Trụ sở chính: Tòa nhà IDMC, số 21 phố Duy Tân, quận Cầu Giấy, thành phố Hà Nội, Việt Nam.
                                        </p>
                                        <p>Văn phòng tại TPHCM: Số 146 Nguyễn Văn Hưởng, F18, phường Thảo Điền, thành phố Thủ Đức, Thành phố Hồ Chí Minh, Việt Nam
                                        </p>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    <form class="contact-form" id="contactUs-Form">
                        <h3>{{App::isLocale('vi') ? 'Gửi tin nhắn' : 'Send message'}}</h3>
                        <input type="text" name="name" class="box" id="name" placeholder="{{App::isLocale('vi') ? 'Họ tên' : 'Name'}}" ng-model="contact.user_name" required="" value="">
                        <span class="invalid-feedback d-block" role="alert" ng-if="errors && errors.user_name" >
                            <strong><% errors.user_name[0] %></strong>
                        </span>
                        <input type="email" name="email" class="box" id="email" placeholder="Email" ng-model="contact.email" required="" value="">
                        <span class="invalid-feedback d-block" role="alert" ng-if="errors && errors.email" >
                            <strong><% errors.email[0] %></strong>
                        </span>
                        <input type="text" name="subject" class="box" id="subject" placeholder="{{App::isLocale('vi') ? 'Địa chỉ' : 'Address'}}" ng-model="contact.address" value="">
                        <span class="invalid-feedback d-block" role="alert" ng-if="errors && errors.address" >
                            <strong><% errors.address[0] %></strong>
                        </span>
                        <textarea cols="30" rows="3" name="comment" id="comment" class="box" placeholder="{{App::isLocale('vi') ? 'Tin nhắn' : 'Message'}}" ng-model="contact.content" ></textarea>
                        <span class="invalid-feedback d-block" role="alert" ng-if="errors && errors.content" >
                            <strong><% errors.content[0] %></strong>
                        </span>
                        <div class="msg-alert">
                            <button href="#" type="button" class="btn-style2 uk-animation-slide-bottom" ng-click="submit()">
                                <span ng-if="!loading"> {{App::isLocale('vi') ? 'Gửi tin' : 'Send'}}</span>
                                <i class="fa fa-spinner fa-spin" ng-if="loading"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </section>
    </section>
@endsection
@push('scripts')
    <script>
        app.controller('Contact', function ($scope, $http) {
            $scope.contact = {};
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
