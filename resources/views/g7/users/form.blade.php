<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h6>Thông tin chung</h6>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-12 col-xs-12 mb-3">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group custom-group">
									<label class="form-label required-label">Tên người dùng</label>
									<input class="form-control" type="text" ng-model="form.name"  ng-disabled="form.mode == 'edit'">
									<span class="invalid-feedback d-block" role="alert">
										<strong><% errors.name[0] %></strong>
									</span>
								</div>
							</div>
							<div class="col-md-6 mb-3">
								<div class="form-group custom-group" >
									<label class="form-label required-label">Email đăng nhập</label>
									<input class="form-control" type="text" ng-model="form.email" ng-disabled="form.mode == 'edit'">
									<span class="invalid-feedback d-block" role="alert">
										<strong><% errors.email[0] %></strong>
									</span>
								</div>
							</div>
							<div class="col-md-6 mb-3" ng-if="form.mode != 'edit'">
								<div class="form-group custom-group">
									<label class="form-label required-label">Mật khẩu</label>
									<div class="input-group mb-0">
										<input class="form-control" type="password" ng-model="form.password">
										<div class="input-group-append">
											<button class="btn btn-outline-secondary show-password" type="button"><i class="fa fa-eye muted"></i></button>
										</div>
									</div>
									<span class="invalid-feedback d-block" role="alert">
										<strong><% errors.password[0] %></strong>
									</span>
								</div>
							</div>
							<div class="col-md-6 mb-3" ng-if="form.mode != 'edit'">
								<div class="form-group custom-group">
									<label class="form-label required-label">Xác nhận mật khẩu</label>
									<div class="input-group mb-0">
										<input class="form-control" type="password" ng-model="form.password_confirm">
										<div class="input-group-append">
											<button class="btn btn-outline-secondary show-password" type="button"><i class="fa fa-eye muted"></i></button>
										</div>
									</div>
									<span class="invalid-feedback d-block" role="alert">
										<strong><% errors.password_confirm[0] %></strong>
									</span>
								</div>
							</div>
							<div class="col-md-6 mb-3">
								<div class="form-group custom-group">
									<label class="form-label required-label">Hồ sơ nhân viên</label>
									<select class="form-control custom-select" ng-model="form.employee_id">
										<option value="">Chọn hồ sơ nhân viên</option>
										<option ng-repeat="item in form.g7_employees" value="<% item.id %>" ng-selected="form.employee_id == item.id"><% item.name %> - <% item.mobile %></option>
									</select>
									<span class="invalid-feedback d-block" role="alert">
										<strong><% errors.employee_id[0] %></strong>
									</span>
								</div>
							</div>
							<div class="col-md-6 mb-3">
								<div class="form-group custom-group">
									<label class="form-label required-label">Trạng thái</label>
									<select class="form-control custom-select" ng-model="form.status">
										<option value="1" ng-selected="form.status == 1">Hoạt động</option>
										<option value="0" ng-selected="form.status == 0">Khóa</option>
									</select>
									<span class="invalid-feedback d-block" role="alert">
										<strong><% errors.status[0] %></strong>
									</span>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
		<div class="card">
			<div class="card-header d-flex align-items-center">
				<h6 class="mb-0">Phân quyền</h6>
				<div class="text-danger ml-1">(*)</div>
			</div>
			<div class="card-body">
				<ui-select remove-selected="false" multiple ng-model="form.roles">
					<ui-select-match placeholder="Chọn chức vụ">
						<% $item.name %>
					</ui-select-match>
					<ui-select-choices repeat="item.id as item in (form.available_roles | filter: $select.search)">
						<span ng-bind="item.name"></span>
					</ui-select-choices>
				</ui-select>
				<span class="invalid-feedback d-block" role="alert">
					<strong><% errors.roles[0] %></strong>
				</span>
			</div>
		</div>
	</div>
</div>
<hr>
<div class="text-right">
	<button type="submit" class="btn btn-success btn-cons" ng-click="submit()" ng-disabled="loading.submit">
		<i ng-if="!loading.submit" class="fa fa-save"></i>
		<i ng-if="loading.submit" class="fa fa-spin fa-spinner"></i>
		Lưu
	</button>
	<a href="{{ route('User.index') }}" class="btn btn-danger btn-cons">
		<i class="fa fa-remove"></i> Hủy
	</a>
</div>
