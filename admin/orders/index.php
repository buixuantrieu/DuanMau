<head>
    <link rel="stylesheet" href="css/order.css">
</head>
<div class="order__wrapper">
    <div class="order__container">
        <div class="order__title">Quản lí đơn hàng</div>
        <div>
            <form style="display:flex; gap:12px; justify-content:end; margin-bottom:12px" action="" method="post">
                <select style="padding: 8px 12px;" name="keyword" id="">
                    <option value="">Tất cả đơn hàng</option>
                    <option value="Đang chờ xác nhận đơn hàng">Đang chờ xác nhận đơn hàng</option>
                    <option value="Đã xác nhận đơn hàng">Đã xác nhận đơn hàng</option>
                    <option value="Đang giao">Đang giao</option>
                    <option value="Nhận hàng thành công">Nhận hàng thành công</option>
                    <option value="Đã hủy đơn hàng">Đã hủy đơn hàng</option>
                </select>
                <button name="search_order" type="submit" style="padding: 4px 12px; border: 1px solid black; background-color: white; border-radius: 4px">Tìm kiếm</button>
            </form>
        </div>
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
                    <td><?php echo number_format($total_price) ?> đ</td>
                    <td><?php echo $create_at ?></td>
                </tr>
                <tr class="table__detail">
                    <td colspan="7">
                        <table class="order__detail--table">
                            <tr>
                                <th>Tên sản phẩm</th>
                                <th>Ảnh</th>
                                <th>Số lượng</th>
                                <th>Tổng tiền</th>
                                <th>Trạng thái đơn hàng</th>
                                <th></th>
                            </tr>
                            <?php
                            if (isset($order_status)) {
                                $detail_list = get_order_detail($order_id, $order_status);
                            } else {
                                $detail_list = get_order_detail($id, "");
                            }
                            foreach ($detail_list as $item_detail) {
                                extract($item_detail)
                            ?>
                                <form action="" method="post">
                                    <tr>
                                        <td><?php echo $name ?></td>
                                        <td><img src="../uploadFiles/<?php echo $image ?>" alt=""></td>
                                        <td><?php echo $order_quantity ?></td>
                                        <td><?php echo number_format($order_price) ?>đ</td>
                                        <td>

                                            <?php if ($status === "Đã hủy đơn hàng") {
                                                echo $status;
                                            } else {
                                            ?>
                                                <input type="hidden" name="id-detail" value="<?php echo $order_detail_id ?>">
                                                <input type="hidden" class="status" value="<?php echo $status ?>">
                                                <select class="select__status" name="status-update" id="">
                                                    <?php if ($status === "Đang chờ xác nhận đơn hàng") {
                                                    ?>
                                                        <option <?php if ($status === "Đang chờ xác nhận đơn hàng") {
                                                                    echo "selected";
                                                                } ?> value="Đang chờ xác nhận đơn hàng">Đang chờ xác nhận đơn hàng</option>
                                                        <option <?php if ($status === "Đã xác nhận đơn hàng") {
                                                                    echo "selected";
                                                                } ?> value="Đã xác nhận đơn hàng">Đã xác nhận đơn hàng</option>
                                                        <option <?php if ($status === "Đang giao") {
                                                                    echo "selected";
                                                                } ?> value="Đang giao">Đang giao</option>
                                                        <option <?php if ($status === "Nhận hàng thành công") {
                                                                    echo "selected";
                                                                } ?> value="Nhận hàng thành công">Nhận hàng thành công</option>
                                                    <?php
                                                    } else if ($status === "Đã xác nhận đơn hàng") {
                                                    ?>
                                                        <option <?php if ($status === "Đã xác nhận đơn hàng") {
                                                                    echo "selected";
                                                                } ?> value="Đã xác nhận đơn hàng">Đã xác nhận đơn hàng</option>
                                                        <option <?php if ($status === "Đang giao") {
                                                                    echo "selected";
                                                                } ?> value="Đang giao">Đang giao</option>
                                                        <option <?php if ($status === "Nhận hàng thành công") {
                                                                    echo "selected";
                                                                } ?> value="Nhận hàng thành công">Nhận hàng thành công</option>
                                                    <?php
                                                    } else if ($status === "Đang giao") {
                                                    ?>
                                                        <option <?php if ($status === "Đang giao") {
                                                                    echo "selected";
                                                                } ?> value="Đang giao">Đang giao</option>
                                                        <option <?php if ($status === "Nhận hàng thành công") {
                                                                    echo "selected";
                                                                } ?> value="Nhận hàng thành công">Nhận hàng thành công</option>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <option <?php if ($status === "Nhận hàng thành công") {
                                                                    echo "selected";
                                                                } ?> value="Nhận hàng thành công">Nhận hàng thành công</option>
                                                    <?php
                                                    } ?>


                                                </select>
                                            <?php
                                            }
                                            ?>

                                        </td>
                                        <td>
                                            <?php
                                            if ($status !== "Đã hủy đơn hàng") {
                                            ?>
                                                <input class="submit__update" type="submit" value="Cập nhật">
                                            <?php
                                            } else {
                                            ?>
                                                <a onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này?')" href="index.php?page=orders&&delete=<?php echo $order_detail_id ?>&&order_id=<?php echo $order_id ?>" class="delete__order">Xóa</a>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                </form>
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
    const selectStatus = document.querySelectorAll('.select__status');
    const statusValue = document.querySelectorAll('.status');
    const buttonUpdate = document.querySelectorAll('.submit__update');
    for (let i = 0; i < selectStatus.length; i++) {
        if (selectStatus[i].value === statusValue[i].value) {
            buttonUpdate[i].setAttribute('disabled', true)
        }
        selectStatus[i].onchange = () => {
            if (selectStatus[i].value === statusValue[i].value) {
                buttonUpdate[i].setAttribute('disabled', true)
            } else {
                buttonUpdate[i].removeAttribute('disabled')
            }
            console.log(1);

        }
    }
</script>