@extends('layouts.main')

@section('css')

@endsection

@section('title')
Thêm mới khối nội dung
@endsection

@section('page_title')
Thêm mới khối nội dung
@endsection

@section('content')
<div ng-controller="CreateBlock" ng-cloak>
  @include('admin.blocks2.form')
</div>
@endsection

@section('script')
@include('admin.blocks2.Block2')
<script>
  app.controller('CreateBlock', function ($scope, $http) {
    $scope.form = new Block2({}, {scope: $scope});
    $scope.loading = {};

    $scope.submit = function() {
      $scope.loading.submit = true;
      let data = $scope.form.submit_data;
      data.append('page', "{{$page}}");
      $.ajax({
        type: 'POST',
        url: "{!! route('Block2.store') !!}",
        headers: {
          'X-CSRF-TOKEN': CSRF_TOKEN
        },
        data: data,
        processData: false,
        contentType: false,
        success: function(response) {
          if (response.success) {
            toastr.success(response.message);
            window.location.href = "{{ route('Block2.index', ['page' => $page]) }}";
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
