<div class="row">
    <div class="col-sm-8">
        <div class="form-group custom-group mb-4">
            <label class="form-label required-label">Tên khối nội dung</label>
            <input class="form-control " type="text" ng-model="form.name">
            <span class="invalid-feedback d-block" role="alert">
                <strong><% errors.name[0] %></strong>
            </span>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group custom-group mb-4">
                    <label class="form-label">Tiêu đề</label>
                    <input class="form-control " type="text" ng-model="form.title">

                </div>
            </div>
            <div class="col-sm-6">

                <div class="form-group custom-group mb-4">
                    <label class="form-label">Tiêu đề (tiếng Anh)</label>
                    <input class="form-control " type="text" ng-model="form.title_en">

                </div>
            </div>
        </div>



        <div class="form-group custom-group mb-4">
            <label class="form-label">Nội dung khối</label>
            <textarea class="form-control" ck-editor rows="5" ng-model="form.body"></textarea>
            <span class="invalid-feedback d-block" role="alert">
                <strong><% errors.body[0] %></strong>
            </span>
        </div>

        <div class="form-group custom-group mb-4">
            <label class="form-label">Nội dung khối (tiếng Anh)</label>
            <textarea class="form-control" ck-editor rows="5" ng-model="form.body_en"></textarea>
            <span class="invalid-feedback d-block" role="alert">
                <strong><% errors.body[0] %></strong>
            </span>
        </div>
    </div>
    <div class="col-sm-4">
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
    <a href="{{ route('Category.index') }}" class="btn btn-danger btn-cons">
        <i class="fa fa-remove"></i> Hủy
    </a>
</div>
