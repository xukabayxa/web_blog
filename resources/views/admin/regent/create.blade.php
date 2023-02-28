@extends('layouts.main')

@section('css')

@endsection

@section('title')
Thêm nhân sự điều hành
@endsection

@section('content')
<div ng-controller="Attorney" ng-cloak>
	@include('admin.regent.form')
</div>

@endsection

@section('script')
@include('admin.regent.Regent')
@include('admin.regent.RegentEn')
@include('admin.regent.RegentVi')
<script>
app.controller('Attorney', function ($scope, $http) {
	$scope.form = new Regent({}, {scope: $scope});
    console.log($scope.form.regentVi);
    $scope.loading = {};
	$scope.submit = function() {
		$scope.loading.submit = true;
		let data = $scope.form.submit_data;

		$.ajax({
			type: 'POST',
			url: "{!! route('regent.store') !!}",
			headers: {
				'X-CSRF-TOKEN': CSRF_TOKEN
			},
			processData: false,
			contentType: false,
			data: data,
			success: function(response) {
				if (response.success) {
					toastr.success(response.message);
					window.location.href = "{{ route('regent.index') }}";
				} else {
					toastr.warning(response.message);
					$scope.errors = response.errors;
                    console.log($scope.errors)
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
