<div class="row">
	<div class="col-md-9 col-sm-8 col-xs-12">
        <div class="card-block">
            <ul class="nav nav-tabs  tabs nav-quotation" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#vi" role="tab" aria-expanded="true">
                        Tiếng Việt
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#en" role="tab" aria-expanded="false">
                        Tiếng Anh
                    </a>
                </li>
            </ul>
            <div class="tab-content tab-custom">
                <div class="tab-pane p-0 active" id="vi">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h6>Thông tin chung</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">


                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Tên dự án</label>
                                                <span class="text-danger">(*)</span>
                                                <input class="form-control" type="text" ng-model="form.projectVi.title">
                                                <span class="invalid-feedback d-block" role="alert">
                                            <strong><% errors['project_vi.title'][0] %></strong>
                                        </span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Địa điểm</label>
                                                <input class="form-control" type="text" ng-model="form.projectVi.address">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Giới thiệu ngắn</label>
                                                <span class="text-danger">(*)</span>
                                                <textarea id="editor" class="form-control" ck-editor
                                                          ng-model="form.projectVi.short_des" rows="4"></textarea>
                                                <span class="invalid-feedback d-block" role="alert">
				 <strong><% errors['project_vi.short_des'][0] %></strong>
			</span>

                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Chi tiết</label>
                                                <span class="text-danger">(*)</span>
                                                <textarea id="editor" class="form-control" ck-editor
                                                          ng-model="form.projectVi.des" rows="4"></textarea>
                                                <span class="invalid-feedback d-block" role="alert">
				 <strong><% errors['project_vi.des'][0] %></strong>
			</span>

                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>

                        </div>

                    </div>
                </div>

                <div class="tab-pane p-0" id="en">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h6>Thông tin chung</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Tên dự án</label>
                                                <span class="text-danger">(*)</span>
                                                <input class="form-control" type="text" ng-model="form.projectEn.title">
                                                <span class="invalid-feedback d-block" role="alert">
                                            <strong><% errors['project_en.title'][0] %></strong>
                                        </span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Địa điểm</label>
                                                <input class="form-control" type="text" ng-model="form.projectEn.address">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Giới thiệu ngắn</label>
                                                <span class="text-danger">(*)</span>
                                                <textarea id="editor" class="form-control" ck-editor
                                                          ng-model="form.projectEn.short_des" rows="4"></textarea>
                                                <span class="invalid-feedback d-block" role="alert">
				 <strong><% errors['project_en.short_des'][0] %></strong>
			</span>

                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Chi tiết</label>
                                                <span class="text-danger">(*)</span>
                                                <textarea id="editor" class="form-control" ck-editor
                                                          ng-model="form.projectEn.des" rows="4"></textarea>
                                                <span class="invalid-feedback d-block" role="alert">
				 <strong><% errors['project_en.des'][0] %></strong>
			</span>

                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>

                        </div>

                    </div>

                </div>

            </div>
        </div>
	</div>

	<div class="col-md-3 col-sm-4 col-xs-12">
        <div class="form-group">
            <label class="form-label required-label">Danh mục</label>
            <ui-select class="" remove-selected="true" ng-model="form.category_id" theme="select2">
                <ui-select-match placeholder="Chọn danh mục">
                    <% $select.selected.name %>
                </ui-select-match>
                <ui-select-choices repeat="t.id as t in (form.all_categories | filter: $select.search)">
                    <span ng-bind="t.name"></span>
                </ui-select-choices>
            </ui-select>
            <span class="invalid-feedback d-block" role="alert">
                                                    <strong><% errors.category_id[0] %></strong>
                                                </span>
        </div>
		<div class="form-group text-center mb-4">
			<div class="main-img-preview">
				<p class="help-block-img">* Ảnh định dạng: jpg, png không quá 2MB.</p>
				<img class="thumbnail img-preview" ng-src="<% form.image.path %>">
			</div>
			<div class="input-group" style="width: 100%; text-align: center">
				<div class="input-group-btn" style="margin: 0 auto">
					<div class="fileUpload fake-shadow cursor-pointer">
						<label class="mb-0" for="<% form.image.element_id %>">
							<i class="glyphicon glyphicon-upload"></i> Chọn ảnh
						</label>
						<input class="d-none" id="<% form.image.element_id %>" type="file" class="attachment_upload" accept=".jpg,.jpeg,.png">
					</div>
				</div>
			</div>
			<span class="invalid-feedback d-block" role="alert">
				<strong><% errors.image[0] %></strong>
			</span>
		</div>

	</div>
</div>

<hr>
<div class="text-right">
	<button type="submit" class="btn btn-success btn-cons" ng-click="submit(0)" ng-disabled="loading.submit">
		<i ng-if="!loading.submit" class="fa fa-save"></i>
		<i ng-if="loading.submit" class="fa fa-spin fa-spinner"></i>
		Lưu
	</button>
	<a href="{{ route('Post.index') }}" class="btn btn-danger btn-cons">
		<i class="fa fa-remove"></i> Hủy
	</a>
</div>
