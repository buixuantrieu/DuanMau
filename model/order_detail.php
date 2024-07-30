<?php
function create_order_detail($product_id, $order_id, $quantity, $status, $price)
{
    $sql = "INSERT INTO `order_details` (`product_id`,`order_id`,`quantity`,`status`,`price`) VALUES ('$product_id','$order_id','$quantity','$status','$price')";
    pdo_execute($sql);
}
function get_order_detail($id, $keyword)
{
    $sql = "SELECT *,order_details.id as order_detail_id ,order_details.quantity as order_quantity, order_details.price as order_price FROM order_details JOIN products ON products.id = order_details.product_id WHERE order_id = '$id' AND order_details.status LIKE '%$keyword%'";
    $item = pdo_query($sql);
    return $item;
}
function canceled_order($id)
{
    $sql = "UPDATE order_details SET status = 'Đã hủy đơn hàng' WHERE id = '$id'";
    pdo_execute($sql);
}
function update_status($status, $id)
{
    $sql = "UPDATE order_details SET status = '$status' WHERE id = '$id'";
    pdo_execute($sql);
}
function delete_order_detail($id, $order_id)
{
    $sql = "DELETE From order_details WHERE id = '$id'";
    pdo_execute($sql);
    $sql_check = "SELECT * FROM order_details WHERE order_id='$order_id'";
    $check = pdo_query($sql_check);
    if (count($check) == 0) {
        $sql_delete = "DELETE FROM orders WHERE id='$order_id'";
        pdo_execute($sql_delete);
    }
}
function check_order_status($product_id, $user_id)
{
    $sql = "SELECT * FROM order_details JOIN orders ON order_details.order_id = orders.id WHERE order_details.status ='Nhận hàng thành công' AND user_id = '$user_id' AND product_id = '$product_id'";
    $check = pdo_query($sql);
    if (count($check) !== 0) {
        return false;
    }
    return true;
}
function count_order()
{
    $sql = "SELECT COUNT(id) as count_order FROM order_details WHERE status = 'Nhận hàng thành công'";
    $item = pdo_query_one($sql);
    return $item;
}
function update_view($id)
{
    $sql = "UPDATE products SET view= view + 1 WHERE id = '$id'";
    pdo_execute($sql);
}
