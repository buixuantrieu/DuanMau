<?php
include '../../model/pdo.php';
include '../../model/category.php';
if (isset($_POST['select-category'])) {
    $arr_id = $_POST['select-category'];
    foreach ($arr_id as $id) {
        delete_category($id);
    }
}
if (isset($_GET['id'])) {
    delete_category($_GET['id']);
}
header('Location: ../index.php?page=categories');
