@extends('layouts.main')

@section('title')
Thêm mới bài viết
@endsection

@section('page_title')
Thêm mới bài viết
@endsection

@section('content')
<div ng-controller="Post" ng-cloak>
  @include('admin.posts.form')
</div>
@endsection
@section('script')
@include('admin.posts.Post')
<script>
  app.controller('Post', function ($scope, $http) {
    $scope.form = new Post({}, {scope: $scope});
    $scope.languages = @json(\App\Model\Admin\Language::query()->get());
    $scope.loading = {}

    $scope.submit = function(publish = 0) {
      $scope.loading.submit = true;
      let data = $scope.form.submit_data;
      data.append('publish', publish);
      $.ajax({
        type: 'POST',
        url: "{!! route('Post.store') !!}",
        headers: {
          'X-CSRF-TOKEN': CSRF_TOKEN
        },
        data: data,
        processData: false,
        contentType: false,
        success: function(response) {
          if (response.success) {
            toastr.success(response.message);
            window.location.href = "{{ route('Post.index') }}";
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
