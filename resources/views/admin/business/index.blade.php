@extends('layouts.main')

@section('css')
@endsection

@section('title')
Quản lý lĩnh vực kinh doanh
@endsection

@section('page_title')
Quản lý lĩnh vực kinh doanh
@endsection

@section('content')
<div  ng-cloak>
	<div class="row" ng-controller="Posts">
		<div class="col-12">
			<div class="card">
				<!-- /.card-header -->
				<div class="card-body">
					<table id="table-list">
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('script')
<script>
    let datatable = new DATATABLE('table-list', {
        ajax: {
            url: '{!! route('business.searchData') !!}',
            data: function (d, context) {
                DATATABLE.mergeSearch(d, context);
            }
        },
        columns: [
            {data: 'DT_RowIndex', orderable: false, title: "STT"},
            {data: 'title',title: 'Tên'},
            {data: 'created_at', title: "Ngày cập nhật"},
            {data: 'updated_by', title: "Người cập nhật"},
            {
                data: 'image', title: "Hình ảnh", orderable: false, className: "text-center",
                render: function (data) {
                    return `<img src="${data.path}" style="max-width: 55px !important">`;
                }
            },
            {data: 'action', orderable: false, title: "Hành động"}
        ],
        search_columns: [
            {data: 'title', search_type: "text", placeholder: "Tên lĩnh vực"},
        ],
        search_by_time: false,
        @if(Auth::user()->type == App\Model\Common\User::SUPER_ADMIN || Auth::user()->type == App\Model\Common\User::QUAN_TRI_VIEN)
        create_link: "{{ route('business.create') }}"
        @endif
    }).datatable;

    app.controller('Posts', function ($scope, $rootScope, $http) {

        $scope.categorieSpeicals = @json(\App\Model\Admin\CategorySpecial::getForSelectForPost());
        $scope.arrayInclude = arrayInclude;
        $scope.loading = {};

        $('#table-list').on('click', '.add-category-special', function () {
            event.preventDefault();

            $scope.data = datatable.row($(this).parents('tr')).data();

            $.ajax({
                type: 'GET',
                url: "/admin/posts/" + $scope.data.id + "/getData",

                data: $scope.data.id,

                success: function(response) {
                    if (response.success) {
                        $scope.post = response.data;
                        console.log($scope.post);
                        // console.log($scope.arrayInclude);
                    } else {
                        toastr.warning(response.message);
                    }
                    // $('select.select2').select2();
                    // $('.select2').trigger('change');
                    $scope.$applyAsync();
                },
                error: function(e) {
                    toastr.error('Đã có lỗi xảy ra');
                },
                complete: function() {
                    $scope.loading.submit = false;
                    $scope.$applyAsync();
                }
            });

            $('#add-to-category-special').modal('show');
        })

        $scope.submit = function () {
            let url = "{!! route('Post.add.category.special') !!}";
            $scope.loading.submit = true;
            $.ajax({
                type: "POST",
                url: url,
                headers: {
                    'X-CSRF-TOKEN': CSRF_TOKEN
                },
                data: {
                    post_id: $scope.post.id,
                    category_special_ids: $scope.post.category_special_ids
                },
                success: function (response) {
                    if (response.success) {
                        $('#add-to-category-special').modal('hide');
                        toastr.success(response.message);
                        datatable.ajax.reload();
                    } else {
                        $scope.errors = response.errors;
                        toastr.warning(response.message);
                    }
                },
                error: function () {
                    toastr.error('Đã có lỗi xảy ra');
                },
                complete: function () {
                    $scope.loading.submit = false;
                    $scope.$applyAsync();
                },
            });
        }

    })
</script>
@include('partial.confirm')
@endsection
