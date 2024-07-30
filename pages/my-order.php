<head>
    <link rel="stylesheet" href="assets/css/my-order.css">
</head>
<div class="my__order--wrapper">
    <div class="my__order--container">
        <table>
            <tr>
                <th></th>
                <th>Tên người nhận</th>
                <th>Số điện thoại</th>
                <th>Địa chỉ</th>
                <th>Phương thức thanh toán</th>
                <th>Tổng tiền</th>
                <th>Ngày đặt</th>
            </tr>

            <?php
            foreach ($order_list as $item) {
                extract($item);
            ?>
                <tr>
                    <td class="show__more">+</td>
                    <td><?php echo $customer_name ?></td>
                    <td><?php echo $tel ?></td>
                    <td><?php echo $address ?></td>
                    <td><?php echo $payment ?></td>
                    <td><?php echo number_format($total_price) ?>đ</td>
                    <td><?php echo $create_at ?></td>
                </tr>
                <tr class="table__detail">
                    <td colspan="7">
                        <table class="order__detail--table">
                            <tr>
                                <th>Tên sản phẩm</th>
                                <th>Ảnh</th>
                                <th>Số lượng</th>
                                <th>Trạng thái đơn hàng</th>
                                <th>Tổng tiền</th>
                                <th></th>
                            </tr>
                            <?php
                            $order_details = get_order_detail($order_id, "");
                            foreach ($order_details as $item_detail) {
                                extract($item_detail)
                            ?>
                                <tr>
                                    <td><?php echo $name ?></td>
                                    <td class="order__detail--img"><img src="uploadFiles/<?php echo $image ?>" alt=""></td>
                                    <td><?php echo $order_quantity ?></td>
                                    <td><?php echo $status ?></td>
                                    <td><?php echo number_format($order_price) ?>đ</td>
                                    <td>
                                        <?php
                                        if ($status === "Nhận hàng thành công") {
                                        ?>
                                            <a href="index.php?page=product-detail&&id=<?php echo $product_id ?>">
                                                <button class="review__product--button">Đánh giá</button>
                                            </a>
                                        <?php
                                        } else {
                                        ?>
                                            <a onclick="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này?')" href="index.php?page=my-order&&canceled=<?php echo $order_detail_id ?>">

                                                <button <?php
                                                        if ($status == "Đã hủy đơn hàng") {
                                                            echo 'style="display:none"';
                                                        } else if ($status != "Đang chờ xác nhận đơn hàng") {
                                                            echo "disabled";
                                                        }
                                                        ?> class="button__canceled">
                                                    Hủy đơn hàng
                                                </button>
                                            </a>
                                        <?php
                                        }
                                        ?>

                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </table>
                    </td>
                </tr>


            <?php
            }
            ?>


        </table>
    </div>
</div>
<script>
    const showMore = document.querySelectorAll('.show__more');
    const tableDetail = document.querySelectorAll('.table__detail');
    showMore.forEach((item, index) => {
        item.onclick = () => {
            tableDetail[index].classList.toggle('active__table');
        }
    })
</script>