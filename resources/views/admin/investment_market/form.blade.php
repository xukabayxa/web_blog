<div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="form-group custom-group">
                    <label class="form-label required-label">Mã</label>
                    <input class="form-control " type="text" ng-model="form.code">
                    <span class="invalid-feedback d-block" role="alert">
                        <strong><% errors.code[0] %></strong>
                    </span>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="form-group custom-group">
                    <label class="form-label required-label">Tên thị trường</label>
                    <input class="form-control " type="text" ng-model="form.name">
                    <span class="invalid-feedback d-block" role="alert">
                        <strong><% errors.name[0] %></strong>
                    </span>
                </div>
            </div>

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="form-group custom-group">
                    <label class="form-label required-label">Tên thị trường (tiếng Anh)</label>
                    <input class="form-control " type="text" ng-model="form.en_name">
                    <span class="invalid-feedback d-block" role="alert">
                        <strong><% errors.en_name[0] %></strong>
                    </span>
                </div>
            </div>

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="form-group custom-group">
                    <label class="form-label required-label">Hiển thị</label>
                    <select select2 class="form-control" ng-model="form.is_show">
                        <option ng-repeat="s in form.statuses" ng-value="s.id" ng-selected="form.is_show == s.id"><% s.name %></option>
                    </select>
                    <span class="invalid-feedback d-block" role="alert">
                        <strong><% errors.is_show[0] %></strong>
                    </span>
                </div>
            </div>

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="form-group custom-group">
                    <label class="form-label required-label">Thứ tự</label>
                    <input type="number" class="form-control" ng-model="form.order" min="1" title="thứ tự">

                    <span class="invalid-feedback d-block" role="alert">
                        <strong><% errors.order[0] %></strong>
                    </span>
                </div>
            </div>

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="form-group custom-group">
                    <label class="form-label required-label">Mô tả</label>
                    <textarea id="editor" class="form-control"
                              ng-model="form.des" rows="4"></textarea>
                    <span class="invalid-feedback d-block" role="alert">
                        <strong><% errors.des[0] %></strong>
                    </span>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="form-group custom-group">
                    <label class="form-label required-label">Mô tả (tiếng Anh)</label>
                    <textarea id="editor" class="form-control"
                              ng-model="form.en_des" rows="4"></textarea>
                    <span class="invalid-feedback d-block" role="alert">
                        <strong><% errors.en_des[0] %></strong>
                    </span>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <label class="form-label">Ảnh đại diện</label>
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

            </span>
            </div>

        </div>
    </div>
</div>
