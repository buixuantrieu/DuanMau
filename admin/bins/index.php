<div class="products__wrapper">
    <div class="product__title">Thùng rác</div>
    <div class="bin__checkbox">
        <span>
            <input name="bin" <?php if (isset($_GET['filter']) && $_GET['filter'] == "products") {
                                    echo "checked";
                                } ?> type="radio" id="products">
            <label for="products">Sản phẩm</label>
        </span>
        <span>
            <input name="bin" type="radio" <?php if (isset($_GET['filter']) && $_GET['filter'] == "categories") {
                                                echo "checked";
                                            } ?> id="categories">
            <label for="categories">Loại hàng</label>
        </span>
    </div>
    <div class="product__container">
        <table>
            <thead>
                <tr>
                    <th>Tên</th>
                    <th>Theo tác</th>
                </tr>
            </thead>
            <form action="" method="post">
                <tbody>
                    <?php
                    foreach ($deleted_list as $item) {
                        extract($item);
                    ?>
                        <tr>
                            <td><?php echo $name ?></td>
                            <td><a onclick="return confirm('Bạn có chắc chắc muốn khôi phụ mục này?')" href="index.php?page=bins<?php if (isset($_GET['filter'])) {
                                                                                                                                    echo "&&filter=" . $_GET['filter'];
                                                                                                                                } ?>&&id=<?php echo $id ?>">Khôi phục</a></td>
                        </tr>

                    <?php
                    }
                    ?>

                </tbody>
        </table>
        </form>
    </div>
</div>
<script>
    const products = document.querySelector("#products");
    const categories = document.querySelector("#categories");
    products.onchange = () => {
        window.location.href = "http://localhost/DuAnMauBuiXuanTrieu%202/admin/index.php?page=bins&&filter=products";
    }
    categories.onchange = () => {
        window.location.href = "http://localhost/DuAnMauBuiXuanTrieu%202/admin/index.php?page=bins&&filter=categories";
    }
</script>