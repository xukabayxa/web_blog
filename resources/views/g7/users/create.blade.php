@extends('layouts.main')

@section('css')

@endsection

@section('title')
Thêm mới người dùng
@endsection

@section('content')
<div ng-controller="createG7User" ng-cloak>
	@include('g7.users.form')
</div>

@endsection

@section('script')
@include('partial.classes.g7.G7User')
<script>
	app.controller('createG7User', function ($scope, $http) {
	$scope.form = new G7User({}, {scope: $scope, mode: 'create'});

	@include('g7.users.formJs')

	$scope.submit = function() {
		$scope.loading.submit = true;
		let data = $scope.form.submit_data;
		$.ajax({
			type: 'POST',
			url: "{!! route('G7User.store') !!}",
			headers: {
				'X-CSRF-TOKEN': CSRF_TOKEN
			},
			data: data,
			success: function(response) {
				if (response.success) {
					toastr.success(response.message);
					window.location.href = "{{ route('G7User.index') }}";
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
