@extends('layouts.main')

@section('css')
<link rel="stylesheet" href="{{ asset('libs/pagination/pagination.css') }}">
@endsection

@section('title')
    Sổ quỹ
@endsection

@section('content')
<div ng-controller="Warehouse" ng-cloak>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Bộ lọc</h4>
                </div>
                <div class="card-body">
                    <div class="row">
						<div class="col-md-3">
                            <div class="form-group custom-group">
                                <label>Từ ngày:</label>
                                <input class="form-control" date ng-model="form.from_date">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group custom-group">
                                <label>Đến ngày:</label>
                                <input class="form-control" date ng-model="form.to_date">
                            </div>
                        </div>
						<div class="col-md-3">
                            <div class="form-group custom-group">
                                <label>Hình thức thanh toán:</label>
                                <select class="form-control custom-select" ng-model="form.payment_method">
									<option value="">Chọn hình thức</option>
									<option ng-repeat="e in payment_methods" value="<% e.id %>"><% e.name %></option>
								</select>
                            </div>
                        </div>
						<div class="col-md-3">
                            <div class="form-group custom-group">
                                <label>Người nộp/nhận:</label>
                                <input class="form-control" ng-model="form.object_name">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="text-right">
                        <button class="btn btn-primary" ng-click="filter(1)" ng-disabled="loading.search">
                            <i ng-if="!loading.search" class="fa fa-filter"></i>
                            <i ng-if="loading.search" class="fa fa-spinner fa-spin"></i>
                            Lọc
                        </button>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>Chi tiết</h4>
                </div>
                <div class="card-body">
                    <table class="table table-condensed table-bordered table-head-border">
						<thead class="sticky-thead">
							<tr>
								<th>STT</th>
								<th>Loại phiếu</th>
								<th>Ngày ghi nhận</th>
                                <th>Ngày tạo</th>
								<th>Mã phiếu</th>
                                <th>Người nộp/nhận</th>
								<th>Hình thức thanh toán</th>
								<th>Tiền thu</th>
								<th>Tiền chi</th>
								<th>Mô tả</th>
								<th>Tham chiếu</th>
							</tr>
						</thead>
						<tbody>
							<tr ng-if="loading.search">
								<td colspan="11"><i class="fa fa-spin fa-spinner"></i> Đang tải dữ liệu</td>
							</tr>
							<tr ng-if="!loading.search && details && !details.length">
								<td colspan="11">Chưa có dữ liệu</td>
							</tr>
							<tr ng-if="!loading.search && details && details.length" ng-repeat="d in details">
								<td class="text-center"><% $index + 1 + current.page * (per_page - 1) %></td>
								<td><% d.type_name %></td>
                                <td><% d.record_date | toDate | date:'dd/MM/yyyy' %></td>
								<td><% d.created_at | toDate | date:'dd/MM/yyyy' %></td>
								<td>
									<a href="#" ng-if="d.type == 1"><% d.code %></a>
									<a href="#" ng-if="d.type == 2"><% d.code %></a>
								</td>
								<td><% d.object_name %></td>
								<td><% getPayType(d.pay_type) %></td>
								<td class="text-right"><% d.type == 1 ? (d.value | number) : '-' %></td>
								<td class="text-right"><% d.type == 2 ? (d.value | number) : '-' %></td>
								<td><% d.note %></td>
								<td>
									<a href="#" ng-if="d.type == 1"><% d.ref_code %></a>
									<a href="#" ng-if="d.type == 2"><% d.ref_code %></a>
								</td>
							</tr>
							<tr ng-if="!loading.search && details && details.length">
								<td class="text-center" colspan="7"><b>Tổng cộng</b></td>
								<td class="text-right"><b><% summary.income | number %></b></td>
								<td class="text-right"><b><% summary.spending | number %></b></td>
								<td class="text-right" colspan="2"><b>Tồn cuối: <% (summary.income - summary.spending) | number %></b></td>
							</tr>
						</tbody>
					</table>
					<div class="text-right mt-2">
						<ul uib-pagination ng-change="pageChanged()" total-items="total_items" ng-model="current.page" max-size="10"
							class="pagination-sm" boundary-links="true" items-per-page="per_page" previous-text="‹" next-text="›" first-text="«" last-text="»">
						</ul>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('libs/pagination/ui-bootstrap.min.js') }}"></script>
@include('partial.classes.g7.WarehouseReport')
<script>
    angular.module("App").requires.push('ui.bootstrap');
    app.controller('Warehouse', function ($scope) {
        $scope.form = new WarehouseReport({});
		$scope.details = [];
		$scope.payment_methods = PAYMENT_METHODS;

        @include('g7.warehouse_reports.js')

		$scope.filter = function(page = 1) {
			draw++;
			$scope.current.page = page;
			$scope.loading.search = true;
			$.ajax({
                type: 'GET',
                url: "{{ route('WarehouseReport.fundReportSearchData') }}",
                headers: {
                    'X-CSRF-TOKEN': CSRF_TOKEN
                },
                data: {
					...$scope.form.submit_data,
					per_page: $scope.per_page,
					current_page: $scope.current.page,
					draw: draw
				},
                success: function(response) {
                    if (response.success && response.draw == draw) {
						$scope.details = response.data.data;
						$scope.total_items = response.data.total;
						$scope.current.page = response.data.current_page;
						$scope.summary = response.total;
					}
				},
				error: function(err) {
					toastr.error('Đã có lỗi xảy ra');
				},
				complete: function() {
					$scope.loading.search = false;
					$scope.$applyAsync();
				}
            });
        }

		$scope.getPayType = function(type) {
			return (PAYMENT_METHODS.find(val => val.id == type) || {}).name;
		}

		$scope.filter(1);

		$scope.pageChanged = function() {
			$scope.filter($scope.current.page);
		};
    })
</script>
@endsection
