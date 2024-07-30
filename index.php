<head>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<?php
session_start();
if ($_SESSION['auth']['status'] == 'Lock') {
    header('Location: index.php?page=lock');
}
include './model/pdo.php';
include './model/product.php';
include './model/account.php';
include './model/category.php';
include './model/cart.php';
include './model/order.php';
include './model/order_detail.php';
include './model/review.php';
include './model/forgot.php';

?>
<div class="page__wrapper">
    <?php include './layout/header.php'; ?>
    <div class="main__wrapper">
        <?php
        if ($_GET['page'] !== 'product-list' || !isset($_GET['page'])) {
            unset($_SESSION['category']);
            unset($_SESSION['price']);
            unset($_SESSION['search']);
            unset($_SESSION['sort']);
        }
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
            switch ($page) {
                case 'login':

                    if (isset($_SESSION['auth'])) {
                        unset($_SESSION['auth']);
                        header('Location: index.php?page=login');
                    }
                    if (isset($_POST['user-name-register'])) {
                        $username = $_POST['user-name-register'];
                        $password = $_POST['password-register'];
                        $email = $_POST['email-register'];
                        $check = check_account($username, $email);
                        if ($check) {
                            create_account($username, $password, $email);
        ?>
                            <script>
                                alert('Đăng kí tài khoản thành công!');
                            </script>
                        <?php
                        } else {
                        ?>
                            <script>
                                alert('Email hoặc tên tài khoản đã tồn tại!')
                            </script>
                        <?php
                        }
                    }
                    if (isset($_POST['user-login'])) {
                        $user_login = $_POST['user-login'];
                        $password_login = $_POST['password-login'];
                        $check_login = check_login($user_login, $password_login);
                        if ($check_login) {
                            $_SESSION['auth'] = $check_login;
                            if ($check_login['role'] === 'admin') {
                                header('Location: ./admin/index.php');
                            } else {
                                header('Location: index.php');
                            }
                        } else {
                            $notification = "Sai tài khoản hoặc mật khẩu";
                        }
                    }
                    include './pages/login.php';
                    break;
                case 'info':
                    if (isset($_POST['id'])) {
                        $id = $_POST['id'];
                        $email = $_POST['email'];
                        $tel = $_POST['tel'];
                        $birthday = $_POST['birthday'];
                        $address = $_POST['address'];
                        $full_name = $_POST['full-name'];
                        update_account($id, $full_name, $email, $tel, $birthday, $address);
                        $notification = "Cập nhật thành công!";
                    }
                    if (isset($_FILES['avatar'])) {
                        $picture = $_FILES['avatar'];
                        $id = $_POST['id-avatar'];
                        $avatar = $picture['name'];
                        $path = __DIR__ . '/uploadFiles';
                        if (!is_dir($path)) {
                            mkdir($path, 0777, true);
                        }
                        if (move_uploaded_file($picture['tmp_name'], $path . '/' . $picture['name'])) {

                            update_avatar($avatar, $id);
                        } else {
                            echo 'Image uploaded Error!';
                        }
                    }
                    include './pages/info.php';
                    break;
                case 'change-password':
                    if (isset($_POST['old-password'])) {
                        $password = $_POST['old-password'];
                        $new_password = $_POST['new-password'];
                        $id = $_POST['id'];
                        $check = change_password($id, $password, $new_password);
                        if ($check) {
                            $notification_success = "Cập nhật khẩu thành công";
                        } else {
                            $notification_error = "Sai mật khẩu cũ";
                        }
                    }
                    include './pages/change-password.php';
                    break;
                case 'product-list':
                    $product_limit = 8;


                    if (isset($_POST['filter__product'])) {
                        $_SESSION['category'] = $_POST['category'];
                        $_SESSION['price']  = $_POST['price'];
                        $_SESSION['search'] = $_POST['search'];
                        $_SESSION['sort'] = $_POST['sort'];
                    } else if (!isset($_SESSION['category'])) {
                        $_SESSION['category'] = "";
                        $_SESSION['price']  = "";
                        $_SESSION['search'] = "";
                        $_SESSION['sort'] = "";
                    }
                    $product_filter = get_product_list_filter($_SESSION['category'], $_SESSION['price'], $_SESSION['search'], $_SESSION['sort'], "");
                    if (isset($_GET['pg'])) {
                        $pg = ($_GET['pg'] - 1) * $product_limit;
                    } else {
                        $pg = 0;
                    }
                    $length_page = ceil(count($product_filter) / $product_limit);
                    $limit = $pg . ", " . $product_limit;
                    $product_list = get_product_list_filter($_SESSION['category'], $_SESSION['price'], $_SESSION['search'], $_SESSION['sort'], $limit);
                    $category_list = get_category_all();
                    include './pages/product-list.php';
                    break;
                case 'product-detail':

                    if ($_POST['add-to-cart']) {
                        if ($_SESSION['auth']) {
                            $user_id = $_SESSION['auth']['id'];
                            $quantity = $_POST['quantity'];
                            $id = $_GET['id'];
                            $check = add_to_cart($user_id, $id, $quantity);
                        } else {
                        ?>
                            <script>
                                alert('Bạn cần đăng nhập để thực hiện chức năng này')
                            </script>
        <?php
                        }
                    }
                    if ($_POST['rate'] && isset($_SESSION['auth'])) {
                        $rate = $_POST['rate'];
                        $comment = $_POST['comment'];
                        $product_id = $_GET['id'];
                        $user_id = $_SESSION['auth']['id'];
                        create_review($user_id, $product_id, $rate, $comment);
                    }
                    if (isset($_GET['id'])) {
                        $id_product = $_GET['id'];
                        $product_detail = get_product_detail($id_product);
                        $review_list = get_review($_GET['id']);
                        update_view($_GET['id']);
                        if (isset($_SESSION['auth'])) {
                            $check_review = check_review($_GET['id'], $_SESSION['auth']['id']);
                            $check_status = check_order_status($_GET['id'], $_SESSION['auth']['id']);
                        }
                    } else {
                        header('Location: index.php?page=product-list');
                    }
                    include './pages/product-detail.php';
                    break;
                case 'cart':
                    if (isset($_GET['update_id']) && isset($_GET['quantity'])) {
                        update_cart($_GET['update_id'], $_GET['quantity']);
                        header('Location: index.php?page=cart');
                    }
                    if (isset($_SESSION['auth'])) {
                        $user_id = $_SESSION['auth']['id'];
                        $cart_list = get_cart($user_id);
                    }
                    if (isset($_GET['delete_id'])) {
                        delete_cart($_GET['delete_id']);
                        header('Location: index.php?page=cart');
                    }
                    include './pages/cart.php';
                    break;
                case 'order':
                    if (isset($_POST['arr-cart'])) {
                        $arr_cart_list = $_POST['arr-cart'];
                        $_SESSION['arr-cart'] = $arr_cart_list;
                    }
                    if (!isset($_SESSION['arr-cart'])) {
                        header('Location: index.php?page=cart');
                    }
                    if ($_POST['order_submit']) {
                        $full_name = $_POST['full_name'];
                        $tel = $_POST['tel'];
                        $address = $_POST['address'];
                        $payment = $_POST['payment'];
                        $total = $_POST['total'];
                        $user_id = $_SESSION['auth']['id'];
                        $order_id = create_order($full_name, $tel, $address, $user_id, $total, $payment);
                        foreach ($_SESSION['arr-cart'] as $cart_item) {
                            $cart_list = get_cart_by_id($cart_item);
                            extract($cart_list);
                            $status = "Đang chờ xác nhận đơn hàng";
                            $price = ($price - $price * $sale) * $product_quantity;
                            create_order_detail($product_id, $order_id, $product_quantity, $status, $price);
                            update_quantity($product_id, $product_quantity);
                        }
                        foreach ($_SESSION['arr-cart'] as $cart_item) {
                            delete_cart($cart_item);
                        }
                        unset($_SESSION['arr-cart']);
                        header('Location: index.php?page=order_success');
                    }

                    include './pages/order.php';
                    break;
                case 'order_success';
                    include './pages/order-success.php';
                    break;
                case 'lock';
                    unset($_SESSION['auth']);
                    include './pages/lock.php';
                    break;
                case 'forgot-password';
                    if ($_POST['user_name']) {
                        $check_success = send_mail($_POST['user_name']);
                        if ($check_success == 1) {
                            echo 'Sai tài khoản';
                        }
                    }
                    if (isset($_GET['id'])) {
                        if ($_POST['password']) {
                            $notification = forgot_password($_GET['id'], $_POST['password']);
                        }
                    }
                    include './pages/forgot-password.php';
                    break;
                case 'my-order';
                    if (isset($_SESSION['auth'])) {
                        $order_list = get_order($_SESSION['auth']['id']);
                    }
                    if (isset($_GET['canceled'])) {
                        canceled_order($_GET['canceled']);
                    }
                    include './pages/my-order.php';
                    break;
                default:
                    $list_sale_product = get_product_sale_limit(40);
                    $list_product_iphone_limit = get_product_limit(4, 6);
                    $list_product_ipad_limit = get_product_limit(4, 7);
                    $list_product_macbook_limit = get_product_limit(4, 15);
                    $list_product_apple_watch_limit = get_product_limit(4, 18);
                    $list_product_loudspeaker_limit = get_product_limit(4, 17);
                    $list_product_accessories_limit = get_product_limit(4, 16);
                    include './pages/home.php';
                    break;
            }
        } else {
            $list_sale_product = get_product_sale_limit(40);
            $list_product_iphone_limit = get_product_limit(4, 6);
            $list_product_ipad_limit = get_product_limit(4, 7);
            $list_product_macbook_limit = get_product_limit(4, 15);
            $list_product_apple_watch_limit = get_product_limit(4, 18);
            $list_product_loudspeaker_limit = get_product_limit(4, 17);
            $list_product_accessories_limit = get_product_limit(4, 16);
            include './pages/home.php';
        }
        ?>
    </div>
    <?php include './layout/footer.php' ?>
</div>
<script src="./assets/js/main.js">
</script>