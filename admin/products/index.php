<div class="products__wrapper">
    <div class="product__title">Quản lí sản phẩm</div>
    <div class="popup__wrapper">
        <div class="popup__container">
            <div class="popup__container--exits">
                <i class="fa-solid fa-xmark"></i>
            </div>
            <div class="popup__title">
                Thêm sản phẩm
            </div>
            <form action="products/add.php" method="post" enctype="multipart/form-data">
                <label for="">
                    Tên SP:
                </label>
                <input name="product-name" required type="text">
                <label for="">Mô tả:</label>
                <textarea required name="product-des" name="" id=""></textarea>
                <label for="">Loại hàng:</label>
                <select name="category" id="">
                    <?php
                    foreach ($list_category as $category) {
                        extract($category)
                    ?>
                        <option value="<?php echo $id ?>"><?php echo $name ?></option>
                    <?php
                    }
                    ?>
                </select>
                <label for="">Giá:</label>
                <input name="product-price" required type="number">
                <label for="">Số lượng:</label>
                <input name="product-quantity" min="1" max="999" required type="number">
                <label for="">Khuyến mãi:</label>
                <input name="product-sale" required>
                <label for="">Ảnh SP:</label>
                <input name="product-image" required type="file">
                <input name="product-submit" type="submit" value="Thêm sản phẩm">
                <input type="reset" value="Reset">
            </form>
        </div>
    </div>
    <div class="product__button__popup">
        <form action="index.php?page=products" method="post">
            <input class="search__product" name="value__search" type="text" placeholder="Nhập tên sản phẩm...">
            <select class="filter__select" name="select_search" id="">
                <option value="">Tất cả sản phẩm</option>
                <?php
                foreach ($list_category as $category) {
                    extract($category)
                ?>
                    <option value="<?php echo $id ?>"><?php echo $name ?></option>
                <?php
                }
                ?>
            </select>
            <input class="submit__search" name="submit__search" type="submit" value="Search">
        </form>
        <button class="button__popup">
            Thêm sản phẩm
            <div class="border__top"></div>
            <div class="border__right"></div>
            <div class="border__bottom"></div>
            <div class="border__left"></div>
        </button>
    </div>
    <div class="product__container">
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th>Mã SP</th>
                    <th>Tên sản phẩm</th>
                    <th>Ảnh</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Khuyến mãi</th>
                    <th>Chức năng</th>
                </tr>
            </thead>
            <form action="products/delete.php" method="post">
                <tbody>
                    <?php
                    foreach ($list_products as $item) {
                        extract($item);
                    ?>
                        <tr>
                            <td><input type="checkbox" name="select-product[]" value="<?php echo $id ?>"></td>
                            <td>
                                <?php echo $id ?>
                            </td>
                            <td style="max-width: 300px">
                                <?php echo $name ?>
                            </td>
                            <td>
                                <img class="product__image" src="../uploadFiles/<?php echo $image ?>" alt="">
                            </td>
                            <td>
                                <?php echo  number_format($price) . "đ" ?>
                            </td>
                            <td>
                                <?php echo $quantity ?>
                            </td>
                            <td>
                                <?php echo $sale * 100 . '%' ?>
                            </td>
                            <td class="operation">
                                <a href="./index.php?page=update_product&&id=<?php echo $id ?>" class="update__product">Chỉnh sửa</a>
                                <a onclick="return confirm('Confirm deletion <?php echo $name ?>?')" href="products/delete.php?id=<?php echo $id ?>" class="delete__product">Xóa</a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
        </table>
        <input class="submit__category" onclick="return confirm('delete selected items?')" type="submit" value=" Xóa các mục đã chọn">
        </form>
    </div>
</div>
<script>
    const popupWrapper = document.querySelector('.popup__wrapper');
    const buttonExit = document.querySelector('.popup__container--exits');
    const buttonPopup = document.querySelector('.button__popup')
    buttonPopup.onclick = () => {
        popupWrapper.classList.add('active__popup')
    }
    buttonExit.onclick = () => {
        popupWrapper.classList.remove('active__popup')
    }
</script>