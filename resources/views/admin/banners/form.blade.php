<div class="row">
    <div class="col-md-7">
        <div class="row">

            <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Trang </label>
                        <span class="text-danger">(*)</span>
                        <select select2 class="form-control" ng-model="form.page">
                            <option value="">Chọn trang</option>
                            <option ng-repeat="p in pages" ng-value="p.id" ng-selected="form.page == p.id"><% p.name %></option>
                        </select>
                        <span class="invalid-feedback d-block" role="alert">
                                                    <strong><% errors.page[0] %></strong>
                        </span>
                    </div>
                </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">Trạng thái </label>
                    <span class="text-danger">(*)</span>
                    <select select2 class="form-control" ng-model="form.status">
                        <option value="">Chọn trạng thái</option>
                        <option ng-repeat="s in statues" ng-value="s.id" ng-selected="form.status == s.id"><% s.name %></option>
                    </select>
                    <span class="invalid-feedback d-block" role="alert">
                                                    <strong><% errors.status[0] %></strong>
                        </span>
                </div>


            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label class="form-label">Tiêu đề</label>
                    <span class="text-danger">(*)</span>
                    <input class="form-control" type="text" ng-model="form.title">
                    <span class="invalid-feedback d-block" role="alert">
                                            <strong><% errors.title[0] %></strong>
                    </span>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label class="form-label">Nội dung</label>
                    <textarea id="editor" class="form-control" ck-editor
                              ng-model="form.intro" rows="4"></textarea>

                </div>
            </div>
        </div>

    </div>

    <div class="col-md-5">
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
    <button type="submit" class="btn btn-success btn-cons" ng-click="submit()" ng-disabled="loading.submit">
        <i ng-if="!loading.submit" class="fa fa-save"></i>
        <i ng-if="loading.submit" class="fa fa-spin fa-spinner"></i>
        Lưu
    </button>
    <a href="{{ route('banners.index') }}" class="btn btn-danger btn-cons">
        <i class="fa fa-remove"></i> Hủy
    </a>
</div>
