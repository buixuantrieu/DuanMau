<head>
    <link rel="stylesheet" href="assets/css/product-list.css">
</head>
<div class="product__list--wrapper">
    <form action="index.php?page=product-list" method="post">
        <div class="product__list--filter--wrapper">
            <div class="product__list--filter--container">
                <label for="">Loại: </label>
                <select name="category" id="">
                    <option value="">
                        Tất cả
                    </option>
                    <?php
                    foreach ($category_list as $category) {
                        extract($category);
                    ?>
                        <option value="<?php echo $id ?>" <?php
                                                            if ($_SESSION['category'] == $id) {
                                                                echo "selected";
                                                            }
                                                            ?>>
                            <?php echo $name ?>
                        </option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="product__list--filter--container">
                <label for="">Giá: </label>
                <select name="price" id="">
                    <option value="">
                        Mặc định
                    </option>
                    <option value="0 AND 5000000" <?php
                                                    if ($_SESSION['price'] === "0 AND 5000000") {
                                                        echo "selected";
                                                    }
                                                    ?>>
                        Dưới 5 triệu
                    </option>
                    <option value="5000000 AND 20000000" <?php
                                                            if ($_SESSION['price'] === "5000000 AND 20000000") {
                                                                echo "selected";
                                                            }
                                                            ?>>
                        5 triệu - 20 triệu
                    </option>
                    <option value="20000000 AND 40000000" <?php
                                                            if ($_SESSION['price'] === "20000000 AND 40000000") {
                                                                echo "selected";
                                                            }
                                                            ?>>
                        20 triệu - 40 triệu
                    </option>
                    <option value="40000000 AND 500000000" <?php
                                                            if ($_SESSION['price'] === "40000000 AND 500000000") {
                                                                echo "selected";
                                                            }
                                                            ?>>
                        Lớn hơn 40 triệu
                    </option>
                </select>
            </div>
            <div class="product__list--filter--container">
                <label for="">Sắp xếp: </label>
                <select name="sort" id="">
                    <option value="">
                        Mặc định
                    </option>
                    <option value="ASC" <?php
                                        if ($_SESSION['sort'] === "ASC") {
                                            echo "selected";
                                        }
                                        ?>>
                        Theo giá tăng dần
                    </option>
                    <option value="DESC" <?php
                                            if ($_SESSION['sort'] === "DESC") {
                                                echo "selected";
                                            }
                                            ?>>
                        Theo giá giảm dần
                    </option>
                </select>
            </div>
            <div class="product__list--filter--container">
                <input name="search" value="<?php echo $_SESSION['search'] ?>" type="search" placeholder="Nhập sản phẩm cần tìm...">
            </div>
        </div>
        <input class="filter__submit" name="filter__product" type="submit" value="Lọc sản phẩm">
    </form>
    <div class="product__container">
        <?php
        foreach ($product_list as $product_item) {
            extract($product_item);
        ?>
            <a href="index.php?page=product-detail&&id=<?php echo $id ?>" class="box__product--container">
                <div class="product__title--new">New</div>
                <?php if ($quantity == 0) {
                ?>
                    <div class="out__of--stock"></div>
                <?php
                } ?>
                <div class="product__image">
                    <img src="uploadFiles/<?php echo $image ?>" alt="">
                </div>
                <div class="product__name"><?php echo $name ?></div>
                <div class="product__price">
                    <?php echo number_format($price - $price * $sale) ?>đ
                    <?php if ($sale > 0) {
                    ?>
                        <div class="product__price--sale"><?php echo number_format($price) ?>đ</div>
                        <div class="product__sale">-<?php echo $sale * 100 ?>%</div>
                    <?php
                    } ?>

                </div>
            </a>
        <?php } ?>

    </div>
    <div class="page__number--container">
        <?php
        for ($i = 1; $i <= $length_page; $i++) {
        ?>
            <a href="index.php?page=product-list&&pg=<?php echo $i ?>" class="page__number--element 
            <?php
            if (isset($_GET['pg'])) {
                if ($_GET['pg'] == $i) {
                    echo "page__active";
                }
            } else if ($i == 1) {
                echo "page__active";
            }
            ?>"><?php echo $i ?></a>
        <?php
        }
        ?>
    </div>
</div>