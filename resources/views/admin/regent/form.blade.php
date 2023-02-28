<div class="row">
    <div class="col-md-9    ">
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
                    <div class="col-md-7">
                        <div class="card">
                            <div class="card-header">
                                <h6>Thông tin chung</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Họ tên</label>
                                            <span class="text-danger">(*)</span>
                                            <input class="form-control" type="text" ng-model="form.regentVi.full_name">
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong><% errors['regent_vi.full_name'][0] %></strong>
                                            </span>
                                        </div>
                                    </div>
    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Chức danh</label>
                                            <span class="text-danger">(*)</span>
                                            <input class="form-control" type="text" ng-model="form.regentVi.role">
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong><% errors['regent_vi.role'][0] %></strong>
                                            </span>
                                        </div>
                                    </div>
                                </div>
    
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Giới thiệu</label>
                                            <span class="text-danger">(*)</span>
                                            <textarea id="editor" class="form-control" ck-editor
                                                      ng-model="form.regentVi.description" rows="7"></textarea>
                                            <span class="invalid-feedback d-block" role="alert">
                     <strong><% errors['regent_vi.description'][0] %></strong>
                </span>
    
                                        </div>
                                    </div>
    
                                </div>
    
                            </div>
                        </div>
    
                    </div>
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-header">
                                <h6>Quá trình công tác</h6>
                            </div>
                            <div class="card-body">
                                <div class="form-group text-center">
    
                                    <div ng-repeat="experience in form.regentVi.experience track by $index">
                                        <div class="mb-2 d-flex align-items-center">
                                            <button class="btn btn-link text-danger ml-auto"
                                                    ng-click="form.regentVi.removeExperience($index)"><i
                                                    class="fa fa-times"></i></button>
                                        </div>
                                        <div class="form-group custom-group mb-4">
                                            <input class="form-control " type="text" ng-model="experience.content">
    
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>
                                                    <% errors['videos.' + $index + '.link'][0] %>
                                                </strong>
                                            </span>
                                        </div>
                                    </div>
    
                                    <button class="btn btn-info btn-sm mt-1" ng-click="form.regentVi.addExperience()">
                                        <i class="fa fa-plus"></i> Thêm
                                    </button>
                                </div>
                            </div>
                        </div>
    
    
                    </div>
                </div>
            </div>
    
            <div class="tab-pane p-0" id="en">
                <div class="row">
                    <div class="col-md-7">
                        <div class="card">
                            <div class="card-header">
                                <h6>Thông tin chung</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Họ tên</label>
                                            <span class="text-danger">(*)</span>
                                            <input class="form-control" type="text" ng-model="form.regentEn.full_name">
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong><% errors['regent_en.full_name'][0] %></strong>
                                            </span>
                                        </div>
                                    </div>
    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Chức danh</label>
                                            <span class="text-danger">(*)</span>
                                            <input class="form-control" type="text" ng-model="form.regentEn.role">
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong><% errors['regent_en.role'][0]  %></strong>
                                            </span>
                                        </div>
                                    </div>
    
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Giới thiệu</label>
                                            <span class="text-danger">(*)</span>
                                            <textarea id="editor" class="form-control" ck-editor
                                                      ng-model="form.regentEn.description" rows="7"></textarea>
                                            <span class="invalid-feedback d-block" role="alert">
                     <strong><% errors['regent_en.description'][0] %></strong>
                </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                    </div>
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-header">
                                <h6>Quá trình công tác</h6>
                            </div>
                            <div class="card-body">
                                <div class="form-group text-center">
    
                                    <div ng-repeat="experience in form.regentEn.experience track by $index">
                                        <div class="mb-2 d-flex align-items-center">
                                            <button class="btn btn-link text-danger ml-auto"
                                                    ng-click="form.regentEn.removeExperience($index)"><i
                                                    class="fa fa-times"></i></button>
                                        </div>
                                        <div class="form-group custom-group mb-4">
                                            <input class="form-control " type="text" ng-model="experience.content">
    
                                            <span class="invalid-feedback d-block" role="alert">
                            <strong>
                                <% errors['videos.' + $index + '.link'][0] %>
                            </strong>
                        </span>
                                        </div>
                                    </div>
    
                                    <button class="btn btn-info btn-sm mt-1" ng-click="form.regentEn.addExperience()">
                                        <i class="fa fa-plus"></i> Thêm
                                    </button>
                                </div>
                            </div>
                        </div>
    
    
                    </div>
                </div>
    
            </div>
    
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group text-center mb-4">
            <div class="main-img-preview"  >
                <p class="help-block-img">* Ảnh định dạng: jpg, png không quá 2MB.</p>
                <img class="thumbnail img-preview" ng-src="<% form.image.path %>" height="200px">
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
    <a href="{{ route('User.index') }}" class="btn btn-danger btn-cons">
        <i class="fa fa-remove"></i> Hủy
    </a>
</div>
