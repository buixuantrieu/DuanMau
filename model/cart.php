<?php
function add_to_cart($user_id, $product_id, $quantity)
{
    $sql = "SELECT * FROM carts WHERE user_id = '$user_id' AND product_id ='$product_id'";
    $check = pdo_query_one($sql);
    if (is_array($check)) {
        $quantity_update = $check['quantity'] + $quantity;
        $id = $check['id'];
        $sql_update = "UPDATE carts SET quantity = '$quantity_update' WHERE id = '$id'";
        pdo_execute($sql_update);
        return false;
    } else {
        $sql_add = "INSERT INTO `carts` (`id`, `product_id`, `user_id`, `quantity`) VALUES (NULL, '$product_id', '$user_id', '$quantity')";
        pdo_execute($sql_add);
        return true;
    }
}
function get_cart($user_id)
{
    $sql = "SELECT *,carts.id as cart_id FROM carts JOIN products ON products.id = carts.product_id WHERE user_id = '$user_id'";
    $item = pdo_query($sql);
    return $item;
}
function update_cart($id, $quantity)
{
    $sql = "UPDATE carts SET quantity ='$quantity' WHERE id = '$id'";
    pdo_execute($sql);
}
function delete_cart($id)
{
    $sql = "DELETE FROM carts WHERE id = '$id'";
    pdo_execute($sql);
}
function get_cart_by_id($id)
{
    $sql = "SELECT * FROM carts JOIN products ON products.id = carts.product_id WHERE carts.id ='$id'";
    $item = pdo_query_one($sql);
    return $item;
}
function count_cart($id)
{
    $sql = "SELECT count(id) as count_cart FROM carts WHERE user_id= '$id'";
    $item = pdo_query_one($sql);
    return $item['count_cart'];
}
