@extends('layouts.main')

@section('title')
Thêm mới danh mục dự án
@endsection

@section('page_title')
Thêm mới danh mục dự án
@endsection

@section('title')
Thêm mới danh mục
@endsection
@section('content')
<div ng-controller="CreateCategory" ng-cloak>
  @include('admin.project_categories.form')
</div>
@endsection

@section('script')
@include('admin.project_categories.ProjectCategory')
<script>
  app.controller('CreateCategory', function ($scope, $http) {
    $scope.form = new ProjectCategory({}, {scope: $scope});
    $scope.loading = {};
    $scope.submit = function() {
      $scope.loading.submit = true;
      $.ajax({
        type: 'POST',
        url: "{!! route('project_categories.store') !!}",
        headers: {
          'X-CSRF-TOKEN': CSRF_TOKEN
        },
        data: $scope.form.submit_data,
        processData: false,
        contentType: false,
        success: function(response) {
          if (response.success) {
            toastr.success(response.message);
            window.location.href = "{{ route('project_categories.index') }}";
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
