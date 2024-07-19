<head>
    <link rel="stylesheet" href="assets/css/home.css">
</head>
<div class="home__wrapper">
    <div class="slider__wrapper">
        <div id="demo" class="carousel slide" data-ride="carousel">
            <ul class="carousel-indicators">
                <li data-target="#demo" data-slide-to="0" class="active"></li>
                <li data-target="#demo" data-slide-to="1"></li>
                <li data-target="#demo" data-slide-to="2"></li>
            </ul>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="assets/image/slide-home-3.webp" alt="Los Angeles">
                </div>
                <div class="carousel-item">
                    <img src="assets/image/slide-home-1.webp" alt="Chicago">
                </div>
                <div class="carousel-item">
                    <img src="assets/image/slide-home2.webp" alt="New York">
                </div>
            </div>
            <a class="carousel-control-prev" href="#demo" data-slide="prev">
                <span style="filter: drop-shadow(0 0 2px black);" class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#demo" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>

        </div>
    </div>
    <div class="box__sale--wrapper">
        <div class="box__sale--title--container">
            <div class="sale__logo">
                <img src="assets/image/flash-sale.png" alt="">
            </div>
            <!-- <div class="sale__time">
                <div class="sale__time--title">Kết thúc trong</div>
                <div class="sale__time--number--container">
                    <div class="box__hour">
                    </div>
                    :
                    <div class="box__minute"></div>
                    :
                    <div class="box__second"></div>
                </div>
            </div> -->
        </div>
        <div class="box__sale--product--wrapper">
            <div class="box__sale--product--container">
                <?php
                foreach ($list_sale_product as $sale_product) {
                    extract($sale_product);
                ?>
                    <a href="index.php?page=product-detail&&id=<?php echo $id ?>">
                        <div class="box__sale--product">
                            <div class="sale__product--image">
                                <img src="uploadFiles/<?php echo $image ?>" alt="">
                            </div>
                            <div class="sale__product--title"><?php echo $name ?></div>
                            <div class="sale__product--price"><?php echo number_format($price - $price * $sale) ?>đ</div>
                            <div class="box__sale--price">
                                <div class="box__sale--price--left"><?php echo number_format($price) ?>đ</div>
                                <div class="box__sale--price--right">-<?php echo $sale * 100 ?>%</div>
                            </div>
                        </div>
                    </a>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
    <div class="home__title"><i class="fa-brands fa-apple"></i> Iphone</div>
    <div class="product__container">
        <?php
        foreach ($list_product_iphone_limit as $product_limit) {
            extract($product_limit);
        ?>
            <a href="index.php?page=product-detail&&id=<?php echo $id ?>" class="box__product--container">
                <div class="product__title--new">New</div>
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
    <div class="home__title"><i class="fa-brands fa-apple"></i> Ipad</div>
    <div class="product__container">
        <?php
        foreach ($list_product_ipad_limit as $product_limit) {
            extract($product_limit);
        ?>
            <a href="index.php?page=product-detail&&id=<?php echo $id ?>" class="box__product--container">
                <div class="product__title--new">New</div>
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
    <div class="home__title"><i class="fa-brands fa-apple"></i> MacBook</div>
    <div class="product__container">
        <?php
        foreach ($list_product_macbook_limit as $product_limit) {
            extract($product_limit);
        ?>
            <a href="index.php?page=product-detail&&id=<?php echo $id ?>" class="box__product--container">
                <div class="product__title--new">New</div>
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
    <div class="home__title"><i class="fa-brands fa-apple"></i> Apple Watch</div>
    <div class="product__container">
        <?php
        foreach ($list_product_apple_watch_limit as $product_limit) {
            extract($product_limit);
        ?>
            <a href="index.php?page=product-detail&&id=<?php echo $id ?>" class="box__product--container">
                <div class="product__title--new">New</div>
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
    <div class="home__title"><i class="fa-brands fa-apple"></i> LoudSpeaker</div>
    <div class="product__container">
        <?php
        foreach ($list_product_loudspeaker_limit as $product_limit) {
            extract($product_limit);
        ?>
            <a href="index.php?page=product-detail&&id=<?php echo $id ?>" class="box__product--container">
                <div class="product__title--new">New</div>
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
    <div class="home__title"><i class="fa-brands fa-apple"></i> Accessories</div>
    <div class="product__container">
        <?php
        foreach ($list_product_accessories_limit as $product_limit) {
            extract($product_limit);
        ?>
            <a href="index.php?page=product-detail&&id=<?php echo $id ?>" class="box__product--container">
                <div class="product__title--new">New</div>
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
</div>