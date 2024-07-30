<?php


$time = time();
// session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
$create_at = date('Y-m-d H:i:s', $time);
function create_account($user_name, $password, $email)
{
    global $create_at;
    $sql = "INSERT INTO `account` (`user_name`, `password`, `email`,`created_at`) VALUES ('$user_name', '$password', '$email','$create_at')";
    pdo_execute($sql);
}
function check_account($username, $email)
{
    $sql = "SELECT * FROM account WHERE user_name = '$username' OR email = '$email'";
    $item = pdo_query($sql);
    if (count($item) > 0) {
        return false;
    }
    return true;
}
function check_login($username, $password)
{
    $sql = "SELECT * FROM account WHERE user_name ='$username' AND password = '$password'";
    $item = pdo_query_one($sql);
    if (is_array($item)) {
        return $item;
    }
    return false;
}
function update_account($id, $full_name, $email, $tel, $birthday, $address)
{
    $sql = "UPDATE account SET full_name='$full_name', email = '$email', tel ='$tel', birthday='$birthday', address = '$address' WHERE id = '$id'";
    pdo_execute($sql);
    $sql_2 = "SELECT * FROM account WHERE id = '$id'";
    $item = pdo_query_one($sql_2);
    $_SESSION['auth'] = $item;
}
function update_avatar($avatar, $id)
{
    $sql = "UPDATE account SET avatar='$avatar' WHERE id = '$id'";
    pdo_execute($sql);
    $sql_2 = "SELECT * FROM account WHERE id = '$id'";
    $item = pdo_query_one($sql_2);
    $_SESSION['auth'] = $item;
}
function change_password($id, $password, $new_password)
{
    $sql_get = "SELECT * FROM account WHERE id = '$id' AND password = '$password'";
    $sql_update = "UPDATE account SET password = '$new_password'";
    $check = pdo_query_one($sql_get);
    if (is_array($check)) {
        pdo_execute($sql_update);
        return true;
    }
    return false;
}
function get_all_account()
{
    $sql = "SELECT * FROM account WHERE role != 'admin'";
    $item = pdo_query($sql);
    return $item;
}
function lock_account($id)
{
    $sql = "UPDATE account SET account.status = 'Lock' WHERE id = '$id' ";
    pdo_execute($sql);
}
function unlock_account($id)
{
    $sql = "UPDATE account SET account.status = 'Normal' WHERE id = '$id' ";
    pdo_execute($sql);
}
function count_account()
{
    $sql = "SELECT COUNT(id) as count_account FROM account";
    $item = pdo_query_one($sql);
    return $item;
}
function forgot_password($id, $password)
{
    $sql = "UPDATE account SET password ='$password' WHERE id='$id'";
    pdo_execute($sql);
    return "Thay đổi mật khẩu thành công";
}
