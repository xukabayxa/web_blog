<div class="modal fade" id="create-partner" tabindex="-1" role="dialog" aria-hidden="true"
     ng-controller="CreatePartner">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="semi-bold">Thêm thị trường</h4>
            </div>
            <div class="modal-body">
                @include('admin.investment_market.form')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success btn-cons" ng-click="submit()" ng-disabled="loading.submit">
                    <i ng-if="!loading.submit" class="fa fa-save"></i>
                    <i ng-if="loading.submit" class="fa fa-spin fa-spinner"></i>
                    Lưu
                </button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-window-close"></i> Hủy</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script>
    app.controller('CreatePartner', function ($rootScope, $scope, $http) {
        $rootScope.$on("createPartner", function (event, data , form){
            $scope.errors = data;
            $scope.form = new Market({}, {scope: $scope});
            $scope.$applyAsync();
            $('#create-partner').modal('show');
        });

        $scope.form = new Market({}, {scope: $scope});
        $scope.loading = {};

        // Submit Form tạo mới
        $scope.submit = function () {
            let url = "{!! route('investment-market.store') !!}";
            $scope.loading.submit = true;
            // return 0;
            $.ajax({
                type: "POST",
                url: url,
                headers: {
                    'X-CSRF-TOKEN': CSRF_TOKEN
                },
                data: $scope.form.submit_data,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.success) {
                        $('#create-partner').modal('hide');
                        toastr.success(response.message);
                        datatable.ajax.reload();
                        $scope.errors = null;
                    } else {
                        $scope.errors = response.errors;
                        toastr.warning(response.message);
                    }
                },
                error: function () {
                    toastr.error('Đã có lỗi xảy ra');
                },
                complete: function () {
                    $scope.loading.submit = false;
                    $scope.$applyAsync();
                },
            });
        }

    })
</script>
