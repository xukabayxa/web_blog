$scope.addToWishList = function ($event, product_id) {
    url = "{{route('cart.add.wishlist', ['productId' => 'productId'])}}";
    if (product_id) {
        url = url.replace('productId', product_id);
    } else {
        url = url.replace('productId', $scope.product.id);
    }

    $.ajax({
        type: "POST",
        url: url,
        headers: {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
        },
        processData: false,
        contentType: false,
        success: function (response) {
        if (response.success) {
        if(response.type == 'add') {
            angular.element($event.currentTarget).parent().addClass('active-wishlist');
        } else {
            angular.element($event.currentTarget).parent().removeClass('active-wishlist');
        }

        toastr.options = {
            timeOut : 1000,
            extendedTimeOut : 1000,
            tapToDismiss : true,
            debug : false,
            fadeOut: 10,
            positionClass : "toast-top-center"
        };

        toastr.success(response.message);

        $interval.cancel($rootScope.promise);
        $rootScope.promise = $interval(function(){
            wishlistSync.count = response.countProductWishlist;
            }, 1000);
            }
        },
        error: function () {
            toastr.error('Lỗi !!!');
            },
        complete: function () {
            },
    });
}
