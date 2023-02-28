@extends('layouts.main')

@section('title')
    Thêm mới banner
@endsection

@section('page_title')
    Thêm mới banner
@endsection

@section('content')
    <div ng-controller="Banner" ng-cloak>
        @include('admin.banners.form')
    </div>
@endsection
@section('script')
    @include('admin.banners.Banner')
    <script>
        app.controller('Banner', function ($scope, $http) {
            $scope.pages = [
                {id: 1, name: "Trang chủ"},
                {id: 2, name: "Trang blog"},
            ];
            $scope.statues = [
                {id: 0, name: "Khóa"},
                {id: 1, name: "Kích hoạt"},
            ];
            $scope.form = new Banner({}, {scope: $scope});
            $scope.loading = {}

            $scope.submit = function(publish = 0) {
                $scope.loading.submit = true;
                let data = $scope.form.submit_data;
                data.append('publish', publish);
                $.ajax({
                    type: 'POST',
                    url: "{!! route('banners.store') !!}",
                    headers: {
                        'X-CSRF-TOKEN': CSRF_TOKEN
                    },
                    data: data,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.message);
                            window.location.href = "{{ route('banners.index') }}";
                        } else {
                            toastr.warning(response.message);
                            $scope.errors = response.errors;
                        }
                    },
                    error: function(e) {
                        toastr.error('Đã có lỗi xảy ra');
                    },
                    complete: function() {
                        $scope.loading.submit = false;
                        $scope.$applyAsync();
                    }
                });
            }
        });
    </script>
@endsection
