<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xuan Trieu Shop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="assets/css/header.css">
    <script src="https://kit.fontawesome.com/2417364cca.js" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <div class="header__logo">
            <img src="./assets/image/logoXTShop.png" alt="">
        </div>
        <div class="header__nav--container">
            <a href="index.php" class="header__nav--element">Trang chủ</a>
            <a href="index.php?page=product-list" class="header__nav--element">Sản phẩm</a>
            <a href="" class="header__nav--element">Tin tức</a>
            <a href="" class="header__nav--element">Liên hệ</a>
        </div>
        <div class="header__login--container">
            <div class="header__cart">
                <a href="index.php?page=cart"><i class="fa-solid fa-cart-shopping"></i></a>
                <?php if (isset($_SESSION['auth'])) {
                ?>
                    <div class="show__quantity--cart">
                        <?php
                        echo count_cart($_SESSION['auth']['id']);
                        ?></div>
                <?php
                } ?>

            </div>
            <?php
            if (isset($_SESSION['auth'])) {
            ?>
                <div class="header__avatar" style="background-image: url(./uploadFiles/<?php echo $_SESSION['auth']['avatar'] ?>);"></div>
            <?php
            } else {
            ?>
                <div class="header__user">
                    <a href=""><i class="fa-solid fa-circle-user"></i></a>
                </div>
            <?php
            }
            ?>
            <div class="header__down">
                <a href=""><i class="fa-solid fa-caret-down"></i></a>
                <div class="menu__down">
                    <?php
                    if (isset($_SESSION['auth'])) {
                    ?>
                        <a href="index.php?page=info" class="menu__down--element">Thông tin cá nhân</a>
                        <a href="index.php?page=change-password" class="menu__down--element">Thay đổi mật khẩu</a>
                        <a href="index.php?page=my-order" class="menu__down--element">Đơn hàng của tôi</a>
                        <!-- <a href="index.php?page=login" class="menu__down--element">Danh sách sản phẩm yêu thích</a> -->
                        <a href="index.php?page=login" class="menu__down--element">Đăng xuất</a>

                    <?php
                    } else {
                    ?>
                        <a href="index.php?page=login" class="menu__down--element">Đăng nhập</a>
                    <?php
                    }
                    ?>



                </div>
            </div>
            <div class="header__menu"><i class="fa-solid fa-bars"></i></div>
        </div>
    </header>
    <div class="menu__wrapper">
        <div class="menu__exit"><i class="fa-solid fa-xmark"></i></div>
        <a href="index.php" class="menu__element">Trang chủ</a>
        <a href="index.php?page=product-list" class="menu__element">Sản phẩm</a>
        <a href="#" class="menu__element">Tin tức</a>
        <a href="#" class="menu__element">Liên hệ</a>
    </div>
</body>

</html>
<script>
    const headerMenu = document.querySelector('.header__menu');
    const menuWrapper = document.querySelector('.menu__wrapper');
    const buttonExit = document.querySelector('.menu__exit');
    headerMenu.onclick = () => {
        menuWrapper.style.display = 'flex';
    }
    buttonExit.onclick = () => {
        menuWrapper.style.display = 'none';
    }
</script>