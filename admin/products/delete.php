<?php
include '../../model/pdo.php';
include '../../model/product.php';
if (isset($_POST['select-product'])) {
    $arr_id = $_POST['select-product'];
    foreach ($arr_id as $id) {
        delete_product($id);
    }
}
if (isset($_GET['id'])) {
    delete_product($_GET['id']);
}
header('Location: ../index.php?page=products');
