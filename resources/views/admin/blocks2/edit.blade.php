@extends('layouts.main')

@section('css')

@endsection

@section('title')
Chỉnh sửa khối nội dung
@endsection

@section('page_title')
Chỉnh sửa khối nội dung
@endsection

@section('content')
<div ng-controller="EditBlock" ng-cloak>
    @include('admin.blocks.form')
</div>
@endsection

@section('script')
@include('admin.blocks.Block')
<script>
    app.controller('EditBlock', function ($scope, $http) {
    $scope.form = new Block(@json($object), {scope: $scope});

    $scope.loading = {};
    $scope.submit = function() {
      $scope.loading.submit = true;
      $.ajax({
        type: 'POST',
        url: "/admin/blocks/" + "{{ $object->id }}" + "/update",
        headers: {
          'X-CSRF-TOKEN': CSRF_TOKEN
        },
        data: $scope.form.submit_data,
        processData: false,
        contentType: false,
        success: function(response) {
          if (response.success) {
            toastr.success(response.message);
            window.location.href = "{{ route('Block.index') }}";
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