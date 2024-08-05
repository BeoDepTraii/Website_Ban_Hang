$(document).ready(function() {
    $('.btn-plus, .btn-minus').on('click', function() {
        var button = $(this);
        var productId = button.data('product-id');
        var action = button.data('action');
        var input = $('input[data-product-id="' + productId + '"]');
        var quantity = parseInt(input.val());

        if (action === 'increase') {
            quantity++;
        } else if (action === 'decrease') {
            if (quantity > 1) {
                quantity--;
            }
        }

        input.val(quantity);

        $.ajax({
            url: '/cart/updateQuantity',
            method: 'POST',
            data: {
                productId: productId,
                quantity: quantity
            },
            success: function(response) {
                // Cập nhật giá sản phẩm mới sau khi số lượng được thay đổi
                // Giả sử `response` chứa thông tin giá mới
                $('.total-price[data-product-id="' + productId + '"]').text(response.newTotalPrice);
            },
            error: function() {
                alert('Có lỗi xảy ra.');
            }
        });
    });
});
