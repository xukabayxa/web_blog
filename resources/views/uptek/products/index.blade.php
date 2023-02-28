@extends('layouts.main')

@section('css')
@endsection

@section('title')
Quản lý hàng hóa - vật tư
@endsection

@section('buttons')
@if(Auth::user()->type == App\Model\Common\User::QUAN_TRI_VIEN || Auth::user()->type == App\Model\Common\User::SUPER_ADMIN)
<a href="javascript:void(0)" class="btn btn-outline-success" data-toggle="modal" href="javascript:void(0)" data-target="#createProduct" class="btn btn-info" ng-click="errors = null"><i class="fa fa-plus"></i> Thêm mới</a>
<a href="javascript:void(0)" target="_blank" data-href="{{ route('Product.exportExcel') }}" class="btn btn-info export-button"><i class="fas fa-file-excel"></i> Xuất file excel</a>
<a href="javascript:void(0)" target="_blank" data-href="{{ route('Product.exportPDF') }}" class="btn btn-warning export-button"><i class="far fa-file-pdf"></i> Xuất file pdf</a>
@endif
@endsection

@section('content')
<div ng-cloak>
    <div class="row" ng-controller="Product">
        <div class="col-12">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="table-list">
                    </table>
                </div>
            </div>
            {{-- Form sửa --}}
            <div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-hidden="true">
                <form method="POST" role="form" id="editModalForm">
                    @csrf
                    <div class="modal-dialog" style="max-width: 850px">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="semi-bold">Sửa vật tư</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-8 col-sm-12">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12">
                                                <div class="form-group custom-group">
                                                    <label class="required-label form-label">Tên hàng hóa</label>
                                                    <input class="form-control" type="text" ng-model="formEdit.name" placeholder="Tên hàng hóa (*)">
                                                    <span class="invalid-feedback d-block" role="alert">
                                                        <strong><% errors.name[0] %></strong>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group custom-group">
                                                    <label class="form-label">Mã vạch</label>
                                                    <input class="form-control" type="text" ng-model="formEdit.barcode" placeholder="Mã vạch">
                                                    <span class="invalid-feedback d-block" role="alert">
                                                        <strong><% errors.barcode[0] %></strong>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group custom-group">
                                                    <label class="required-label form-label">Loại hàng hóa</label>
                                                    <div class="input-group mb-3">
                                                        <ui-select remove-selected="false" ng-model="formEdit.product_category_id">
                                                            <ui-select-match placeholder="Chọn nhóm vật tư">
                                                                <% $select.selected.name %>
                                                            </ui-select-match>
                                                            <ui-select-choices repeat="item.id as item in (formEdit.all_categories | filter: $select.search)">
                                                                <span ng-bind="item.name"></span>
                                                            </ui-select-choices>
                                                        </ui-select>
                                                        <div class="input-group-append">
                                                            <button class="btn btn-outline-success" type="button" data-toggle="modal" data-target="#createProductCategory">
                                                                <i class="fa fa-plus"></i>
                                                            </button>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group custom-group">
                                                    <label class="required-label form-label">Giá bán</label>
                                                    <input class="form-control" type="text" ng-model="formEdit.price" placeholder="Đơn giá bán (*)">
                                                    <span class="invalid-feedback d-block" role="alert">
                                                        <strong><% errors.price[0] %></strong>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group custom-group">
                                                    <label class="required-label form-label">Đơn vị tính</label>
                                                    <div class="input-group mb-3">
                                                        <ui-select remove-selected="false" ng-model="formEdit.unit_id">
                                                            <ui-select-match placeholder="Chọn đơn vị tính">
                                                                <% $select.selected.name %>
                                                            </ui-select-match>
                                                            <ui-select-choices repeat="item.id as item in (formEdit.all_units | filter: $select.search)" ng-selected="item.id == formEdit.unit_id">
                                                                <span ng-bind="item.name"></span>
                                                            </ui-select-choices>
                                                        </ui-select>
                                                        <div class="input-group-append">
                                                            <button class="btn btn-outline-success" type="button" data-toggle="modal" data-target="#createUnit">
                                                                <i class="fa fa-plus"></i>
                                                            </button>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group custom-group">
                                                    <label class="form-label">Tích điểm</label>
                                                    <input class="form-control" type="text" ng-model="formEdit.points" placeholder="Tích điểm">
                                                    <span class="invalid-feedback d-block" role="alert">
                                                        <strong><% errors.points[0] %></strong>
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group custom-group">
                                                    <label class="form-label required-label">Trạng thái</label>
                                                    <select class="form-control" select2 style="width: 100%;" name="status" ng-model="formEdit.status">
                                                        <option value="1">Hoạt động</option>
                                                        <option value="0">Khóa</option>
                                                    </select>
                                                    <span class="invalid-feedback d-block" role="alert">
                                                        <strong><% errors.status[0] %></strong>
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="col-md-12 col-sm-12">
                                                <div class="form-group custom-group">
                                                    <label class="form-label">Ghi chú</label>
                                                    <textarea id="my-textarea" class="form-control" ng-model="formEdit.note" rows="3"></textarea>
                                                    <span class="invalid-feedback d-block" role="alert">
                                                        <strong><% errors.price[0] %></strong>
                                                    </span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group text-center">
                                            <div class="main-img-preview">
                                                <p class="help-block-img">* Ảnh định dạng: jpg, png không quá 2MB.</p>
                                                <img class="thumbnail img-preview" ng-src="<% formEdit.image.path %>">
                                            </div>
                                            <div class="input-group" style="width: 100%; text-align: center">
                                                <div class="input-group-btn" style="margin: 0 auto">
                                                    <div class="fileUpload fake-shadow cursor-pointer">
                                                        <label class="mb-0" for="<% formEdit.image.element_id %>">
                                                            <i class="glyphicon glyphicon-upload"></i> Chọn ảnh
                                                        </label>
                                                        <input class="d-none" id="<% formEdit.image.element_id %>" type="file" class="attachment_upload" accept=".jpg,.jpeg,.png">
                                                    </div>
                                                </div>
                                            </div>
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong><% errors.image[0] %></strong>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success btn-cons" ng-click="submit()" ng-disabled="loading.submit">
                                    <i ng-if="!loading.submit" class="fa fa-save"></i>
                                    <i ng-if="loading.submit" class="fa fa-spin fa-spinner"></i>
                                    Lưu
                                </button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-window-close"></i> Hủy</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                </form>
            </div>
        </div>
        @include('uptek.products.show')
    </div>
    {{-- Form tạo mới --}}
    @include('uptek.products.createProduct')

</div>
@include('common.product_categories.createProductCategory')
@include('common.units.createUnit')
@endsection

@section('script')
@include('partial.classes.uptek.Product')
<script>
    let datatable = new DATATABLE('table-list', {
		ajax: {
			url: '{!! route('Product.searchData') !!}',
			data: function (d, context) {
				DATATABLE.mergeSearch(d, context);
			}
		},
		columns: [
			{data: 'DT_RowIndex', orderable: false, title: "STT", className: "text-center"},
            {
                data: 'image', title: "Hình ảnh", orderable: false, className: "text-center",
                render: function (data) {
					return `<img src="${data.path}" style="max-width: 55px !important">`;
				}
            },
            {data: 'custom_name', title: 'Tên'},
            {data: 'price', title: "Đơn giá bán"},
            {data: 'category', title: 'Loại vật tư'},
            {
				data: 'status',
				title: "Trạng thái",
				render: function (data) {
					if (data == 0) {
						return `<span class="badge badge-danger">Khóa</span>`;
					} else {
						return `<span class="badge badge-success">Hoạt động</span>`;
					}
				}
			},
			{data: 'points', title: "Tích điểm"},
			{data: 'action', orderable: false, title: "Hành động"}
		],
		search_columns: [
			{data: 'name', search_type: "text", placeholder: "Tên loại vật tư"},
			{
				data: 'status', search_type: "select", placeholder: "Trạng thái",
				column_data: [{id: 1, name: "Hoạt động"}, {id: 0, name: "Khóa"}]
			}
		],
	}).datatable;

    app.controller('Product', function ($scope, $rootScope, $http) {
        $scope.units = @json(App\Model\Common\Unit::all());
        $scope.categories = @json(App\Model\Common\ProductCategory::all());
        $scope.loading = {};

        $rootScope.$on("createdProductCategory", function (event, data){
            $scope.formEdit.all_categories.push(data);
            $scope.formEdit.product_category_id = data.id;
            $scope.$applyAsync();
        });

        // Show hàng hóa
        $('#table-list').on('click', '.show-product', function () {
            $scope.data = datatable.row($(this).parents('tr')).data();
            $scope.formEdit = new Product($scope.data, {scope: $scope});
            $scope.$apply();
            $('#show-modal').modal('show');
        });
        // Sửa hàng hóa
        $('#table-list').on('click', '.edit', function () {
            $scope.data = datatable.row($(this).parents('tr')).data();
            $scope.formEdit = new Product($scope.data, {scope: $scope});

            createUnitCallback = (response) => {
                $scope.formEdit.all_units.push(response);
                $scope.formEdit.unit_id = response.id;
            }

            $scope.errors = null;
            $scope.$apply();
            $('#edit-modal').modal('show');
        });
        // Submit mode mới
        $scope.submit = function() {
            $scope.loading.submit = false;
            $.ajax({
                type: 'POST',
                url: "/uptek/products/" + $scope.formEdit.id + "/update",
                headers: {
                    'X-CSRF-TOKEN': CSRF_TOKEN
                },
                processData: false,
                contentType: false,
                data: $scope.formEdit.submit_data,
                success: function(response) {
                if (response.success) {
                    $('#edit-modal').modal('hide');
                    toastr.success(response.message);
                    if (datatable.datatable) datatable.ajax.reload();
                    $scope.errors = null;
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
    })
    $(document).on('click', '.export-button', function(event) {
        event.preventDefault();
        let data = {};
        mergeSearch(data, datatable.context[0]);
        window.location.href = $(this).data('href') + "?" + $.param(data);
    })

</script>
@include('partial.confirm')
@endsection