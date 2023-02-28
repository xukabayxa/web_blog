<style>
    .gallery-item {
        padding: 5px;
        padding-bottom: 0;
        border-radius: 2px;
        border: 1px solid #bbb;
        min-height: 100px;
        height: 100%;
        position: relative;
    }

    .gallery-item .remove {
        position: absolute;
        top: 5px;
        right: 5px;
    }

    .gallery-item .drag-handle {
        position: absolute;
        top: 5px;
        left: 5px;
        cursor: move;
    }

    .gallery-item:hover {
        background-color: #eee;
    }

    .gallery-item .image-chooser img {
        max-height: 150px;
    }

    .gallery-item .image-chooser:hover {
        border: 1px dashed green;
    }
</style>
<div class="row">
    <div class="col-sm-8">
        <div class="form-group custom-group mb-4">
            <label class="form-label required-label">Danh mục sản phẩm</label>
            <ui-select class="" remove-selected="true" ng-model="form.cate_id" theme="select2" ng-change="changeCategory(form.cate_id)">
                <ui-select-match placeholder="Chọn danh mục">
                    <% $select.selected.name %>
                </ui-select-match>
                <ui-select-choices repeat="t.id as t in (form.all_categories | filter: $select.search)">
                    <span ng-bind="t.name"></span>
                </ui-select-choices>
            </ui-select>
            <span class="invalid-feedback d-block" role="alert">
                <strong>
                    <% errors.cate_id[0] %>
                </strong>
            </span>
        </div>

        <div class="form-group custom-group mb-4">
            <label class="form-label required-label">Tên hàng hóa</label>
            <input class="form-control " type="text" ng-model="form.name">
            <span class="invalid-feedback d-block" role="alert">
                <strong>
                    <% errors.name[0] %>
                </strong>
            </span>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group custom-group mb-4">
                    <label class="form-label">Hãng sản xuất</label>
                    <select class="form-control" ng-model="form.manufacturer_id">
                        <option value="">Chọn hãng sản xuất</option>
                        <option ng-repeat="m in manufacturers" ng-value="m.id" ng-selected="m.id == form.manufacturer_id">
                            <% m.name %>
                        </option>
                    </select>
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>
                            <% errors.manufacturer_id[0] %>
                        </strong>
                    </span>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group custom-group mb-4">
                    <label class="form-label">Xuất xứ</label>
                    <select class="form-control" ng-model="form.origin_id">
                        <option value="">Chọn nơi xuất xứ</option>
                        <option ng-repeat="o in origins" ng-value="o.id" ng-selected="o.id == form.origin_id">
                            <% o.name %>
                        </option>
                    </select>
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>
                            <% errors.origin_id[0] %>
                        </strong>
                    </span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="form-group custom-group mb-4">
                    <label class="form-label">Chọn thẻ tag</label>
                    <select select2 class="select2 form-control" name="tag_group_id[]"
                            ng-model="form.tag_ids"
                            ng-class="{'is-invalid': errors && errors.tag_ids}"
                            multiple>
                        <option ng-repeat="t in tags"
                                value="<% t.id %>"
                                ng-selected="arrayInclude(form.tag_ids, t.id)"><% t.name %></option>

                    </select>

                    <style>
                        .btn-addon {
                            border: 1px solid #c4cdd5 !important;
                            background-color: #fff!important;
                        }
                    </style>
                    <span class="input-group-btn">
                        <button class="btn btn-addon" type="button" data-toggle="modal" data-target="#createTag"><i class="fa fa-plus"></i></button>
                    </span>
                </div>

            </div>
        </div>

        <div class="form-group custom-group mb-4">
            <label class="form-label">Mô tả ngắn gọn</label>
            <textarea class="form-control" ck-editor rows="5" ng-model="form.short_des"></textarea>
            <span class="invalid-feedback d-block" role="alert">
                <strong>
                    <% errors.short_des[0] %>
                </strong>
            </span>
        </div>

        <div class="form-group custom-group mb-4">
            <label class="form-label">Thông số kỹ thuật</label>
            <textarea class="form-control" ck-editor rows="5" ng-model="form.intro"></textarea>
            <span class="invalid-feedback d-block" role="alert">
                <strong>
                    <% errors.intro[0] %>
                </strong>
            </span>
        </div>

        <div class="form-group custom-group mb-4">
            <label class="form-label">Chi tiết sản phẩm</label>
            <textarea class="form-control ck-editor" ck-editor rows="5" ng-model="form.body"></textarea>
            <span class="invalid-feedback d-block" role="alert">
                <strong>
                    <% errors.body[0] %>
                </strong>
            </span>
        </div>


    </div>
    <div class="col-sm-4">
        <div class="form-group custom-group mb-4">
            <label class="form-label">Giá trước giảm</label>
            <input class="form-control " type="text" ng-model="form.base_price">
            <span class="invalid-feedback d-block" role="alert">
                <strong>
                    <% errors.base_price[0] %>
                </strong>
            </span>
        </div>
        <div class="form-group custom-group mb-4">
            <label class="form-label required-label">Giá bán</label>
            <input class="form-control " type="text" ng-model="form.price">
            <span class="invalid-feedback d-block" role="alert">
                <strong>
                    <% errors.price[0] %>
                </strong>
            </span>
        </div>
        <div class="form-group custom-group mb-4">
            <label class="form-label required-label">Trạng thái</label>
            <select id="my-select" class="form-control custom-select" ng-model="form.status">
                <option value="">Chọn trạng thái</option>
                <option value="0">Lưu nháp</option>
                <option value="1">Xuất bản</option>
            </select>
            <span class="invalid-feedback d-block" role="alert">
                <strong>
                    <% errors.name[0] %>
                </strong>
            </span>
        </div>

        <div class="form-group custom-group mb-4">
            <label class="form-label">Tình trạng</label>
            <select id="my-select" class="form-control custom-select" ng-model="form.state">
                <option value="">Chọn tình trạng hàng hóa</option>
                <option value="1">Còn hàng</option>
                <option value="2">Hết hàng</option>
            </select>
        </div>

        <div class="form-group custom-group mb-4">
            <label class="form-label">Ghim sản phẩm</label>
            <select id="my-select" class="form-control custom-select" ng-model="form.is_pin">
                <option value="2">Không ghim</option>
                <option value="1">Ghim</option>
            </select>
        </div>

        <div class="row">
            <div class="col-sm-6">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="use_url_custom"
                               ng-checked="form.use_url_custom" ng-model="form.use_url_custom">
                        <label class="custom-control-label" for="use_url_custom">Sử dụng url thủ công
                            <br>({{$_SERVER['HTTP_HOST'].'/san-pham/url'}})
                        </label>
                    </div>
            </div>

            <div class="col-sm-6" ng-if="form.use_url_custom">
                <div class="form-group custom-group mb-4">
                    <label class="form-label required-label">url thủ công</label>
                    <input class="form-control " type="text" ng-model="form.url_custom"
                           ng-disabled="!form.use_url_custom">
                    <span class="invalid-feedback d-block" role="alert">
                 <strong>
                    <% errors.url_custom[0] %>
                </strong>
            </span>
                </div>
            </div>
        </div>

        <div class="form-group text-center">
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
                <strong>
                    <% errors.image[0] %>
                </strong>
            </span>
        </div>
        <hr>
        <div class="form-group text-center">
            <label for="">Gallery ảnh</label>
            <div class="row gallery-area border">
                <div class="col-md-4 p-2" ng-repeat="g in form.galleries">
                    <div class="gallery-item">
                        <button class="btn btn-sm btn-danger remove" ng-click="form.removeGallery($index)">
                            <i class="fa fa-times mr-0"></i>
                        </button>
                        <div class="form-group">
                            <div class="img-chooser" title="Chọn ảnh">
                                <label for="<% g.image.element_id %>">
                                    <img ng-src="<% g.image.path %>">
                                    <input class="d-none" type="file" accept=".jpg,.png,.jpeg" id="<% g.image.element_id %>">
                                </label>
                            </div>
                            <span class="invalid-feedback d-block" role="alert" ng-if="!errors['galleries.' + $index + '.image_obj']">
                                <strong>
                                    <% errors['galleries.' + $index + '.image' ][0] %>
                                </strong>
                            </span>
                            <span class="invalid-feedback">
                                <strong>
                                    <% errors['galleries.' + $index + '.image_obj' ][0] %>
                                </strong>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 p-2">
                    <label class="gallery-item d-flex align-items-center justify-content-center cursor-pointer" for="gallery-chooser">
                        <i class="fa fa-plus fa-2x text-secondary"></i>
                    </label>
                    <input class="d-none" type="file" accept=".jpg,.png,.jpeg" id="gallery-chooser" multiple>
                </div>
            </div>
            <span class="invalid-feedback">
                <strong>
                    <% errors.galleries[0] %>
                </strong>
            </span>
        </div>

        <div class="form-group mb-4 text-center">
            <label for="">Thông tin Seo</label>
        </div>

        <div class="form-group custom-group mb-4 text-center">
            <label class="form-label">Tiêu đề seo</label>
            <input class="form-control" type="text" ng-model="form.title_seo">
        </div>

        <div class="form-group custom-group mb-4 text-center">
            <label class="form-label">Nội dung seo</label>
            <textarea class="form-control" rows="3" ng-model="form.content_seo"></textarea>
        </div>

        <div class="form-group text-center">
            <label for="">Video, link</label>
            <div ng-if="!form.videos || !form.videos.length">Chưa có videos</div>

            <div ng-repeat="video in form.videos track by $index">
                <div class="mb-2 d-flex align-items-center">
                    <u>Video <% $index + 1 %></u>
                    <button class="btn btn-link text-danger ml-auto" ng-click="form.removeVideo($index)"><i class="fa fa-times"></i></button>
                </div>
                <div class="form-group custom-group mb-4">
                    <label class="form-label required-label">Link youtube</label>
                    <input class="form-control " type="text" ng-model="video.link">

                    <span class="invalid-feedback d-block" role="alert">
                        <strong>
                            <% errors['videos.' + $index + '.link' ][0] %>
                        </strong>
                    </span>
                </div>

                <div class="form-group custom-group mb-4">
                    <label class="form-label required-label">Video</label>
                    <input class="form-control " type="text" ng-model="video.video">
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>
                            <% errors['videos.' + $index + '.video' ][0] %>
                        </strong>
                    </span>
                </div>
            </div>

            <button class="btn btn-info btn-sm mt-1" ng-click="form.addVideo()">
                <i class="fa fa-plus"></i> Thêm video
            </button>
        </div>

        <div class="form-group text-center">
            <label for="">Thông số mở rộng</label>
            <div ng-if="!form.attribute_values || !form.attribute_values.length">Chưa có thuộc tính</div>

            <div ng-repeat="attribute in form.attribute_values track by $index">
                <div class="mb-2 d-flex align-items-center">
                    <u>Thông số <% $index + 1 %></u>
                    <button class="btn btn-link text-danger ml-auto" ng-click="form.removeAttribute($index)"><i class="fa fa-times"></i></button>
                </div>
                <div class="form-group custom-group mb-4">
                    <label class="form-label required-label">Thuộc tính</label>
                    <select class="form-control" ng-model="attribute.attribute_id">
                        <option value="">Chọn thuộc tính</option>
                        <option ng-repeat="att in attributes" ng-value="att.id" ng-selected="att.id == attribute.attribute_id">
                            <% att.name %>
                        </option>
                    </select>
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>
                            <% errors['attributes.' + $index + '.attribute_id' ][0] %>
                        </strong>
                    </span>
                </div>

                <div class="form-group custom-group mb-4">
                    <label class="form-label required-label">Giá trị</label>
                    <input class="form-control " type="text" ng-model="attribute.value">
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>
                            <% errors['attributes.' + $index + '.value' ][0] %>
                        </strong>
                    </span>
                </div>
            </div>

            <button class="btn btn-info btn-sm mt-1" ng-click="form.addAttribute()">
                <i class="fa fa-plus"></i> Thêm thông số
            </button>

            <span class="invalid-feedback">
                <strong>
                    <% errors.galleries[0] %>
                </strong>
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
