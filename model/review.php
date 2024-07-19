<?php
$time = time();
session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
$create_at = date('Y-m-d H:i:s', $time);
function create_review($user_id, $product_id, $rate, $comment)
{
    global $create_at;
    $sql = "INSERT INTO `reviews` (`user_id`, `product_id`, `rate`, `comment`,`create_at`) VALUES ('$user_id', '$product_id', '$rate', '$comment','$create_at')";
    pdo_execute($sql);
}
function get_review($product_id)
{
    $sql = "SELECT * FROM reviews JOIN account ON reviews.user_id = account.id WHERE reviews.product_id = '$product_id'";
    $item = pdo_query($sql);
    return $item;
}
function check_review($product_id, $user_id)
{
    $sql = "SELECT * FROM reviews WHERE product_id ='$product_id' AND user_id ='$user_id'";
    $check = pdo_query($sql);
    if (count($check) !== 0) {
        return false;
    }
    return true;
}
function get_all_review()
{
    $sql = "SELECT *,reviews.id as review_id, account.user_name as user_name, products.name as product_name ,reviews.create_at as create_review FROM reviews JOIN products ON reviews.product_id = products.id JOIN account ON reviews.user_id = account.id ORDER BY reviews.create_at DESC";
    $item = pdo_query($sql);
    return $item;
}
function delete_review($id)
{
    $sql = "DELETE FROM reviews WHERE id = $id";
    pdo_execute($sql);
}
