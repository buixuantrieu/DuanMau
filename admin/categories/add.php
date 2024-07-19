<?php
include '../../model/pdo.php';
include '../../model/category.php';
if (isset($_POST['category-name'])) {
    create_category($_POST['category-name']);
    header('Location: ../index.php?page=categories');
}
