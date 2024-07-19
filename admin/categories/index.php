<div class="products__wrapper">
    <div class="product__title">Quản lí loại hàng</div>
    <div class="popup__wrapper">
        <div class="popup__container">
            <div class="popup__container--exits">
                <i class="fa-solid fa-xmark"></i>
            </div>
            <div class="popup__title">
                Add Category
            </div>
            <form action="categories/add.php" method="post">
                <label for="">
                    Name:
                </label>
                <input name="category-name" required type="text">
                <input name="category-submit" type="submit" value="Add Product">
                <input type="reset" value="Reset">
            </form>
        </div>
    </div>
    <div class="product__button__popup">
        <form action="index.php?page=categories" method="post">
            <input class="search__product" name="value__search" type="text" placeholder="Enter product name...">
            <input class="submit__search" type="submit" value="Search">
        </form>
        <button class="button__popup">
            Add Category
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
                    <th>Code</th>
                    <th>Name</th>
                    <th>Create At</th>
                    <th>Update At</th>
                    <th>Operation</th>
                </tr>
            </thead>
            <form action="categories/delete.php" method="post">
                <tbody>
                    <?php
                    foreach ($list_categories as $item) {
                        extract($item);
                    ?>
                        <tr>
                            <td><input type="checkbox" name="select-category[]" value="<?php echo $id ?>"></td>
                            <td><?php echo $id ?></td>
                            <td>
                                <?php echo $name ?>
                            </td>
                            <td><?php echo $create_at ?></td>
                            <td><?php echo $update_at ?></td>
                            <td class="operation">
                                <a href="./index.php?page=update_category&&id=<?php echo $id ?>" class="update__product">Update</a>
                                <a onclick="return confirm('Confirm deletion <?php echo $name ?>?')" href="categories/delete.php?id=<?php echo $id ?>" class="delete__product">Delete</a>
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