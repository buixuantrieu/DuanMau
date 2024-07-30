<head>
    <link rel="stylesheet" href="assets/css/order.css">
</head>
<div class="order__wrapper">
    <div class="order__container">
        <div class="order__box--right">

            <div class="order__title">Thông tin đặt hàng</div>
            <form action="" method="post">
                <div class="form__group">
                    <label for="">Tên khách hàng:</label>
                    <input type="text" required name="full_name" value="<?php echo $_SESSION['auth']['full_name'] ?>">
                    <span class="error"></span>
                </div>
                <div class="form__group">
                    <label for="">Số điện thoại:</label>
                    <input type="text" required name="tel" value="<?php echo $_SESSION['auth']['tel'] ?>">
                    <span class="error"></span>
                </div>
                <div class="form__group">
                    <label for="">Địa chỉ:</label>
                    <input type="text" required name="address" value="<?php echo $_SESSION['auth']['address'] ?>">
                    <span class="error"></span>
                </div>
                <div class="form__group">
                    <label for="">Phương thức thanh toán:</label>
                    <div>
                        <input checked name="payment" value="Thanh toán khi nhận hàng" type="radio">
                        <span>Thanh toán khi nhận hàng</span>
                    </div>
                    <div>
                        <input name="payment" value="paypal" type="radio">
                        <span>Paypal</span>
                    </div>

                    <span class="error"></span>
                </div>
                <input class="order__submit" name="order_submit" type="submit" value="Đặt hàng">

        </div>
        <div class="order__box--left">
            <table>
                <tr>
                    <th>Ảnh sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                </tr>
                <?php
                $total = 0;
                foreach ($arr_cart_list as $id_cart) {
                    $cart_item = get_cart_by_id($id_cart);
                    extract($cart_item);
                    $total += ($price - $price * $sale) * $product_quantity;
                ?>

                    <tr>
                        <td class="order__image"><img src="uploadFiles/<?php echo $image ?>" alt=""></td>
                        <td><?php echo $product_quantity ?></td>
                        <td><?php echo number_format(($price - $price * $sale) * $product_quantity) ?>đ</td>
                    </tr>
                <?php
                }
                ?>
                <tr>
                    <td colspan="2">

                        <div class="total__title">Tổng cộng:</div>


                    </td>
                    <td>
                        <div class="total__price"><?php echo number_format($total) ?>đ</div>
                    </td>
                </tr>
            </table>
        </div>
        <input type="hidden" value="<?php echo $total ?>" name="total">
        </form>
    </div>
</div>