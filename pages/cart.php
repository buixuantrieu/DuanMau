<head>
    <link rel="stylesheet" href="assets/css/cart.css">
</head>
<div class="cart__wrapper">
    <?php
    if (!isset($_SESSION['auth'])) {
    ?>
        <div class="title_cart">Bạn cần đăng nhập để xem giỏ hàng</div>
    <?php
    } else if (count_cart($_SESSION['auth']['id']) == 0) {
    ?>
        <div class="title_cart">Giỏ hàng trống</div>
    <?php
    } else {
    ?>
        <div class="cart__container">
            <table>
                <form action="index.php?page=order" method="post">
                    <tr>
                        <th></th>
                        <th>Tên sản phẩm</th>
                        <th>Ảnh</th>
                        <th>Số lượng</th>
                        <th>Tổng tiền</th>
                        <th></th>
                    </tr>

                    <?php
                    foreach ($cart_list as $item) {
                        extract($item);
                        if ($quantity_cart > $quantity) {
                            update_cart($cart_id, $quantity);
                        }
                    ?>

                        <tr>
                            <td><input type="checkbox" name="arr-cart[]" value="<?php echo $cart_id ?>"></td>
                            <td><?php echo $name ?></td>
                            <td><img class="cart__image" src="uploadFiles/<?php echo $image ?>" alt=""></td>
                            <td><input min="1" max="<?php echo $quantity ?>" class="quantity" type="number" value="<?php if ($quantity_cart > $quantity) {
                                                                                                                        echo $quantity;
                                                                                                                    } else {
                                                                                                                        echo $quantity_cart;
                                                                                                                    } ?>">
                                <input type="hidden" value="<?php echo $quantity ?>" class="quantity_product">
                            </td>
                            <td><?php if ($quantity_cart <= $quantity) {
                                    echo number_format(($price - $price * $sale) * $quantity_cart);
                                } else {
                                    echo number_format(($price - $price * $sale) * $quantity);
                                } ?>đ</td>
                            <td><a class="delete__cart" href="index.php?page=cart&&delete_id=<?php echo $cart_id ?>">Xóa</a></td>
                        </tr>
                        <input class="id__cart" type="hidden" value="<?php echo $cart_id ?>">
                    <?php
                    }
                    ?>
            </table>
            <input class="submit__cart" type="submit" value="Đến trang thanh toán">
            </form>
        </div>
    <?php
    }
    ?>

</div>
<script>
    const quantity = document.querySelectorAll('.quantity');
    const quantity_product = document.querySelectorAll('.quantity_product');
    const idCart = document.querySelectorAll('.id__cart');
    quantity.forEach((item, index) => {
        item.onchange = () => {
            let id_cart = idCart[index].value;
            console.log(quantity_product[index].value)
            if (parseInt(item.value) > parseInt(quantity_product[index].value)) {
                item.value = parseInt(quantity_product[index].value)
                alert(`Trong kho chỉ còn ${quantity_product[index].value} sản phẩm`)
                console.log(item.value)
            } else if (item.value < 1) {
                item.value = 1;
                alert("Giỏ hàng chỉ cho phép mua ít nhất 1 sản phẩm!")
            } else {
                window.location.href = `index.php?page=cart&&update_id=${id_cart}&&quantity=${item.value}`;
            }

        }
    });
</script>