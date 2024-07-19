<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

function send_mail($user_name)
{
    $mail = new PHPMailer(true);
    $sql = "SELECT * FROM account WHERE user_name = '$user_name'";
    $user = pdo_query_one($sql);
    if (!is_array($user)) {
        return 1;
    }
    $email = $user['email'];
    $full_name = $user['full_name'];
    $id = $user['id'];
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'trieubxpd09711@fpt.edu.vn';
        $mail->Password   = 'u h c c o b n r q t z a g r c h';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        $mail->setFrom('trieubxpd09711@fpt.edu.vn', 'Trieu admin');
        $mail->addAddress($email, 'Joe User');
        $mail->isHTML(true);
        $mail->Subject = 'Hi Fen!!! -.-';
        $mail->Body    = '<p>Xin chào <strong>' . $full_name . ' </strong>,</p>
            <p></p>
            <p>Bạn đã yêu cầu thiết lập lại mật khẩu cho tài khoản ' . $user_name . '  tại <strong>Xuan Trieu Shop</strong></p>
            <p></p>
            <p>Vui lòng truy cập vào <a href="http://localhost/DuAnMauBuiXuanTrieu/index.php?page=forgot-password&&id=' . $id . '"> đây</a> để thiết lập lại mật khẩu của bạn. </p>
            <p></p>
            <p></p> 
            <p>Nếu bạn nhận được email này do nhầm lẫn, bạn hoàn toàn có thể bỏ qua email này.</p>';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
