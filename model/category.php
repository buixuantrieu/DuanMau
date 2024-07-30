<?php
$time = time();
// session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
$create_at = date('Y-m-d H:i:s', $time);
function create_category($name)
{
    global $create_at;
    $sql = "INSERT INTO `categories` (`id`, `name`, `create_at`, `update_at`) VALUES (NULL, '$name', '$create_at', '$create_at')";
    pdo_execute($sql);
}
function delete_category($id)
{
    $sql = "DELETE FROM categories WHERE id='$id'";
    pdo_execute($sql);
}
function get_category_search_all($search)
{
    $sql = "SELECT * FROM categories WHERE categories.name LIKE '%$search%'  ORDER BY id DESC";
    $list_categories = pdo_query($sql);
    return $list_categories;
}
function update_category($name, $id)
{
    global $create_at;
    $sql = "UPDATE categories SET categories.name = '$name', update_at='$create_at' WHERE id = '$id' ";
    pdo_execute($sql);
}
function get_category_one($id)
{
    $sql = "SELECT * FROM categories WHERE id='$id'";
    $item = pdo_query_one($sql);
    return $item;
}
function get_category_all()
{
    $sql = "SELECT * FROM categories";
    $items = pdo_query($sql);
    return $items;
}
