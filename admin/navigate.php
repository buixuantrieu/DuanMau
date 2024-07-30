<div class="navigate__wrapper">
    <div class="navigate__title">Apple Store</div>
    <a href="index.php" class="navigate__element  <?php if (!isset($_GET['page'])) echo "navigate__active" ?>"><i class="fa-solid fa-house"></i> Trang chủ </a>
    <a href="index.php?page=products" class="navigate__element <?php if ($_GET['page'] === "products") echo "navigate__active" ?>"><i class="fa-solid fa-list"></i>Sản phẩm</a>
    <a href="index.php?page=categories" class="navigate__element <?php if ($_GET['page'] === "categories") echo "navigate__active" ?>"><i class="fa-brands fa-dropbox"></i> Loại hàng</a>
    <a href="index.php?page=orders" class="navigate__element <?php if ($_GET['page'] === "orders") echo "navigate__active" ?>"><i class="fa-brands fa-jedi-order"></i>Đơn hàng</a>
    <a href="index.php?page=comments" class="navigate__element <?php if ($_GET['page'] === "comments") echo "navigate__active" ?>"><i class="fa-regular fa-comment"></i>Bình luận</a>
    <a href="index.php?page=customers" class="navigate__element <?php if ($_GET['page'] === "customers") echo "navigate__active" ?>"><i class="fa-solid fa-users"></i>Tài khoản</a>
    <a href="index.php?page=bins&&filter=products" class="navigate__element <?php if ($_GET['page'] === "bins") echo "navigate__active" ?>"><i class="fa-solid fa-users"></i>Thùng rác</a>
</div>