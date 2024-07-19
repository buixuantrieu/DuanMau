<div class="products__wrapper">
    <div class="product__title">Quản lí tài khoản</div>
    <div class="product__container">
        <table>
            <thead>
                <tr>
                    <th>Tên tài khoản</th>
                    <th>Email</th>
                    <th>Ngày tạo tài khoản</th>
                    <th>Trạng thái</th>
                    <th>Chức năng</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($account_list as $item) {
                    extract($item);
                ?>
                    <tr>
                        <td><?php echo $user_name  ?></td>
                        <td>
                            <?php echo $email ?>
                        </td>
                        <td>
                            <?php echo $created_at ?>
                        </td>
                        <td>
                            <?php echo $status ?>
                        </td>
                        <td class="operation">
                            <?php
                            if ($status === "Normal") {
                            ?>
                                <a onclick="return confirm('Bạn có chắc chắn muốn khóa tài khoản này?')" href="index.php?page=customers&&lock=<?php echo $id ?>" class="delete__product">Khóa tài khoản</a>
                            <?php
                            } else {
                            ?>
                                <a onclick="return confirm('Bạn có chắc chắn muốn mở khóa tài khoản này?')" href="index.php?page=customers&&unlock=<?php echo $id ?>" class="unlock__account">Mở khóa</a>
                            <?php
                            }
                            ?>


                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>

    </div>
</div>