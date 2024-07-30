<?php
session_start();
if (!isset($_SESSION['auth']) || $_SESSION['auth']['role'] !== 'admin') {
    header('Location: ../index.php');
}
include '../model/pdo.php';
include '../model/category.php';
include '../model/product.php';
include '../model/order.php';
include '../model/order_detail.php';
include '../model/review.php';
include '../model/account.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="./css/admin.css" />
    <script src="https://kit.fontawesome.com/2417364cca.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

</head>

<body>
    <div class="admin__wrapper">
        <?php include 'navigate.php' ?>
        <div class="admin__container">
            <?php include 'header.php' ?>
            <?php
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
                switch ($page) {
                    case 'products':
                        if (isset($_POST['submit__search'])) {
                            $key_word = $_POST['value__search'];
                            $select = $_POST['select_search'];
                        } else {
                            $key_word = "";
                            $select = "";
                        }
                        $list_products = get_product_filter($key_word, $select);
                        $list_category = get_category_all();
                        include "./products/index.php";
                        break;
                    case 'categories':
                        if (isset($_POST['value__search'])) {
                            $_SESSION['value-search'] = $_POST['value__search'];
                        }
                        $list_categories = get_category_search_all($_SESSION['value-search']);

                        include "./categories/index.php";
                        break;
                    case 'update_category':
                        if (isset($_GET['id'])) {
                            $item = get_category_one($_GET['id']);
                        }
                        include "./categories/update.php";
                        break;
                    case 'update_product':
                        if (isset($_GET['id'])) {
                            $item = get_product_one($_GET['id']);
                        }
                        $list_category = get_category_all();
                        include "./products/update.php";
                        break;
                    case 'orders':
                        if (isset($_POST['search_order']) && isset($_POST['keyword'])) {
                            $order_list = get_all_order($_POST['keyword']);
                        } else {
                            $order_list = get_all_order("");
                        }

                        if (isset($_POST['status-update']) && $_POST['id-detail']) {
                            update_status($_POST['status-update'], $_POST['id-detail']);
                        }
                        if (isset($_GET['delete'])) {

                            delete_order_detail($_GET['delete'], $_GET['order_id']);
                            header('Location: index.php?page=orders');
                        }
                        include "orders/index.php";
                        break;
                    case 'comments':

                        if (isset($_GET['id'])) {
                            delete_review($_GET['id']);
                            header('Location: index.php?page=comments');
                        }
                        if (isset($_POST['select-review'])) {
                            foreach ($_POST['select-review'] as $item) {
                                delete_review($item);
                            }
                        }
                        $review_list = get_all_review();
                        include "reviews/index.php";
                        break;
                    case 'customers':
                        if (isset($_GET['lock'])) {
                            lock_account($_GET['lock']);
                            header('Location: index.php?page=customers');
                        }
                        if (isset($_GET['unlock'])) {
                            unlock_account($_GET['unlock']);
                            header('Location: index.php?page=customers');
                        }
                        $account_list = get_all_account();
                        include "customer/index.php";
                        break;
                    case 'bins':
                        if (isset($_GET['filter'])) {
                            if ($_GET['filter'] == "products") {
                                $deleted_list = get_all_product_deleted();
                            } else if ($_GET['filter'] == "categories") {
                                $deleted_list = get_all_category_deleted();
                            }
                        } else {
                            $deleted_list = get_all_product_deleted();
                        }
                        if (isset($_GET['filter']) && isset($_GET['id']) && $_GET['filter'] == "products") {
                            restore_product($_GET['id']);
                            header('Location: index.php?page=bins&&filter=products');
                        }
                        if (isset($_GET['filter']) && isset($_GET['id']) && $_GET['filter'] == "categories") {
                            restore_category($_GET['id']);
                            header('Location: index.php?page=bins&&filter=categories');
                        }
                        include "bins/index.php";
                        break;
                    default:

                        include 'home/index.php';
                        break;
                }
            } else {
                $count_list_product = count_product();
                $sum_price_list = revenue_shop(2024);
                if (isset($_POST['month'])) {
                    $month = $_POST['month'];
                    $quarter = $_POST['quarter'];
                    $year = $_POST['year'];
                    $sort = $_POST['sort'];
                    $revenue_list = revenue_total($month, $quarter, $year, $sort);
                } else {
                    $revenue_list = revenue_total('', '', '', '');
                }
                $count_user = count_account();
                $count_view = count_view();
                $count_order = count_order();
                include 'home/index.php';
            }
            ?>

        </div>
    </div>
</body>

</html>