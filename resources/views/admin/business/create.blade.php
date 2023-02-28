@extends('layouts.main')

@section('title')
Thêm mới lĩnh vực kinh doanh
@endsection

@section('page_title')
Thêm mới lĩnh vực kinh doanh
@endsection

@section('content')
<div ng-controller="Business" ng-cloak>
  @include('admin.business.form')
</div>
@endsection
@section('script')
@include('admin.business.Business')
@include('admin.business.BusinessVi')
@include('admin.business.BusinessEn')
<script>
  app.controller('Business', function ($scope, $http) {
    $scope.form = new Business({}, {scope: $scope});
    $scope.loading = {}

    $scope.submit = function() {
      $scope.loading.submit = true;
      let data = $scope.form.submit_data;

      console.log(data);
      $.ajax({
        type: 'POST',
        url: "{!! route('business.store') !!}",
        headers: {
          'X-CSRF-TOKEN': CSRF_TOKEN
        },
        data: data,
        processData: false,
        contentType: false,
        success: function(response) {
          if (response.success) {
            toastr.success(response.message);
            window.location.href = "{{ route('business.index') }}";
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
