@extends('layouts.main')

@section('css')

@section('title')
Chỉnh sửa danh mục đối tác
@endsection

@section('page_title')
Chỉnh sửa danh mục đối tác
@endsection

@section('content')
<div ng-controller="EditCategory" ng-cloak>
    @include('admin.partner_categories.form')
</div>
@endsection

@section('script')
@include('admin.partner_categories.PartnerCategory')
<script>
    app.controller('EditCategory', function ($scope, $http) {
    $scope.form = new PartnerCategory(@json($object), {scope: $scope});
    // console.log($scope.form);

    $scope.form.all_categories = @json($categories);
    $scope.loading = {};
    $scope.submit = function() {
      $scope.loading.submit = true;
      $.ajax({
        type: 'POST',
        url: "/admin/partner-categories/" + "{{ $object->id }}" + "/update",
        headers: {
          'X-CSRF-TOKEN': CSRF_TOKEN
        },
        data: $scope.form.submit_data,
        processData: false,
        contentType: false,
        success: function(response) {
          if (response.success) {
            toastr.success(response.message);
            window.location.href = "{{ route('partner-category.index') }}";
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
