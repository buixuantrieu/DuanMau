<div class="products__wrapper">
    <div class="product__title">Quản lí bình luận</div>
    <div class="product__container">
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th>Tên tài khoản</th>
                    <th>Sản phẩm</th>
                    <th>Nội dung bình luận</th>
                    <th>Ngày bình luận</th>
                    <th>Chức năng</th>
                </tr>
            </thead>
            <form action="" method="post">
                <tbody>
                    <?php
                    foreach ($review_list as $item) {
                        extract($item);
                    ?>
                        <tr>
                            <td><input type="checkbox" name="select-review[]" value="<?php echo $review_id ?>"></td>
                            <td>
                                <?php echo $user_name ?>
                            </td>
                            <td>
                                <?php echo $product_name ?>
                            </td>
                            <td>
                                <?php echo $comment ?>
                            </td>
                            <td>
                                <?php echo $create_review ?>
                            </td>
                            <td class="operation">
                                <a onclick="return confirm('Bạn có chắc chắn muốn xóa bình luận này?')" href="index.php?page=comments&&id=<?php echo $review_id ?>" class="delete__product">Xóa</a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
        </table>
        <input class="submit__category" onclick="return confirm('Xóa các mục đã chọn?')" type="submit" value=" Xóa các mục đã chọn">
        </form>
    </div>
</div>