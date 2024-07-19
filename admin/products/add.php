<?php
include '../../model/pdo.php';
include '../../model/product.php';

if (isset($_POST['product-submit']) && isset($_FILES['product-image'])) {
    $picture = $_FILES['product-image'];
    $path = __DIR__ . '/../../uploadFiles';
    if (!is_dir($path)) {
        mkdir($path, 0777, true);
    }
    if (move_uploaded_file($picture['tmp_name'], $path . '/' . $picture['name'])) {
        $name = $_POST['product-name'];
        $des = $_POST['product-des'];
        $price = $_POST['product-price'];
        $sale = $_POST['product-sale'];
        $category_id = $_POST['category'];
        $image = $picture['name'];
        create_product($name, $image,  $price, $sale, $des, $category_id);
        header('Location:../index.php?page=products ');
    } else {
        echo 'Image uploaded Error!';
    }
}
