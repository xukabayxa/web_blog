<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h6>Thông tin chi nhánh</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Tên chi nhánh (tiếng Việt): </label>
                            <span class="text-danger">(*)</span>
                            <input type="text" class="form-control" ng-model="form.name">

                            <span class="invalid-feedback d-block" role="alert">
				        <strong><% errors.name[0] %></strong>
			        </span>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Tên chi nhánh (tiếng Anh): </label>
                            <input type="text" class="form-control" ng-model="form.en_name">

                            <span class="invalid-feedback d-block" role="alert">
				        <strong><% errors.en_name[0] %></strong>
			        </span>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Địa chỉ: (tiếng Việt)</label>
                            <span class="text-danger">(*)</span>
                            <input type="text" class="form-control" ng-model="form.address">

                            <span class="invalid-feedback d-block" role="alert">
				                <strong><% errors.address[0] %></strong>
			                </span>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Địa chỉ: (tiếng Anh)</label>
                            <input type="text" class="form-control" ng-model="form.en_address">

                            <span class="invalid-feedback d-block" role="alert">
				        <strong><% errors.en_address[0] %></strong>
			        </span>
                        </div>

                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">SĐT liên hệ (Việt): </label>
                            <input type="text" class="form-control" ng-model="form.phone">

                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">SĐT liên hệ (Anh): </label>
                            <input type="text" class="form-control" ng-model="form.en_phone">

                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Hotline: (Việt)</label>
                            <input type="text" class="form-control" ng-model="form.hotline">

                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Hotline: (Anh)</label>
                            <input type="text" class="form-control" ng-model="form.en_hotline">

                        </div>
                    </div>

{{--                    <div class="col-md-6">--}}
{{--                        <div class="form-group">--}}
{{--                            <label class="form-label">Khu vực: </label>--}}
{{--                            <select class="form-control" ng-model="form.province_id">--}}
{{--                                <option value="">Chọn khu vực</option>--}}
{{--                                <option ng-repeat="p in provinces" ng-value="p.id"--}}
{{--                                        ng-selected="p.id == form.province_id">--}}
{{--                                    <% p.name %>--}}
{{--                                </option>--}}
{{--                            </select>--}}
{{--                            <span class="invalid-feedback d-block" role="alert">--}}
{{--				        <strong><% errors.province_id[0] %></strong>--}}
{{--			        </span>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Email: (Việt)</label>
                            <input type="text" class="form-control" ng-model="form.email">

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Email: (Anh)</label>
                            <input type="text" class="form-control" ng-model="form.en_email">

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

{{--    <div class="col-md-12">--}}
{{--        <div class="card">--}}
{{--            <div class="card-header">--}}
{{--                <h5>Bản đồ</h5>--}}
{{--            </div>--}}
{{--            <div id="map" style="height: 400px;"></div>--}}
{{--            <input type="hidden" id="latitude" name="latitude"--}}
{{--                   ng-value="form.lat"--}}
{{--            >--}}
{{--            <input type="hidden" id="longitude" name="longitude"--}}
{{--                   ng-value="form.long"--}}
{{--            >--}}
{{--            <span class="invalid-feedback d-block" role="alert">--}}
{{--				        <strong><% errors.lat[0] %></strong>--}}
{{--			        </span>--}}
{{--        </div>--}}
{{--    </div>--}}

</div>
<hr>
<div class="text-right">
    <button type="submit" class="btn btn-success btn-cons" ng-click="submit(0)" ng-disabled="loading.submit">
        <i ng-if="!loading.submit" class="fa fa-save"></i>
        <i ng-if="loading.submit" class="fa fa-spin fa-spinner"></i>
        Lưu
    </button>
    <a href="{{ route('stores.index') }}" class="btn btn-danger btn-cons">
        <i class="fa fa-remove"></i> Hủy
    </a>
</div>
