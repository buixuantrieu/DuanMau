<?php
$time = time();
// session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
$create_at = date('Y-m-d H:i:s', $time);
function create_order($full_name, $tel, $address, $user_id, $total, $payment)
{
    global $create_at;
    $sql = "INSERT INTO `orders` (`customer_name`,`tel`,`address`,`user_id`,`total_price`,`payment`, `create_at`) VALUES ('$full_name','$tel','$address','$user_id','$total','$payment' ,'$create_at')";
    $last_id = pdo_execute($sql);
    return $last_id;
}
function get_order($id)
{
    $sql = "SELECT *,orders.id as order_id FROM orders WHERE user_id ='$id' ORDER BY orders.id DESC";
    $item = pdo_query($sql);
    return $item;
}
function get_all_order($keyword)
{
    if ($keyword == "") {
        $sql = "SELECT * FROM orders ORDER BY orders.create_at DESC";
        $item = pdo_query($sql);
        return $item;
    } else {
        $sql = "SELECT *, order_details.status as order_status FROM orders JOIN order_details ON orders.id = order_details.order_id WHERE order_details.status LIKE '%$keyword%' ORDER BY orders.create_at DESC";
        $item = pdo_query($sql);
        return $item;
    }
}
function revenue_shop($year)
{
    $sql = "SELECT MONTH(create_at) as month , SUM(price) AS price_total FROM orders  JOIN order_details ON orders.id = order_details.order_id WHERE order_details.status='Nhận hàng thành công' AND YEAR(create_at) ='$year' GROUP BY MONTH(create_at) ORDER BY MONTH(create_at)";
    $item = pdo_query($sql);
    return $item;
}
function revenue_total($month, $quarter, $year, $sort)
{
    $sql = "SELECT YEAR(create_at) as years ,QUARTER(create_at) as quarters , MONTH(create_at) as months ,SUM(price) as revenue FROM orders JOIN order_details ON orders.id = order_details.order_id WHERE order_details.status='Nhận hàng thành công'";
    if ($month !== "") {
        $sql .= " AND MONTH(create_at)='$month'";
    }
    if ($quarter !== "") {
        $sql .= " AND QUARTER(create_at)='$quarter'";
    }
    if ($year !== "") {
        $sql .= " AND YEAR(create_at)='$year'";
    }
    $sql .= " GROUP BY years,quarters,months";
    if ($sort !== "") {
        $sql .= " ORDER BY revenue $sort";
    } else {
        $sql .= " ORDER BY years, months DESC";
    }
    $item = pdo_query($sql);
    return $item;
}
