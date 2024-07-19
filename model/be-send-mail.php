<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
$mail = new PHPMailer(true);
if (isset($_POST['forgot'])) {
    $email = $_POST['email'];
    $command_getUser = "SELECT * FROM users WHERE email= '$email'";
    $result = mysqli_query($connect, $command_getUser);
    $check_email = mysqli_num_rows($result);
    $auth = mysqli_fetch_assoc($result);
    $username = $auth['user_name'];
    $fullname = $auth['fullname'];
    if ($check_email === 0) {
        $_SESSION['error-forgot'] = 1;
        header("Location: ../FrontEnd/page/login.php");
    } else {

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
            $mail->Body    = '<p>Xin chào <strong>' . $fullname . ' </strong>,</p>
            <p></p>
            <p>Bạn đã yêu cầu thiết lập lại mật khẩu cho tài khoản ' . $username . ' tại <strong>Xuan Trieu Fashion</strong></p>
            <p></p>
            <p>Vui lòng truy cập vào <a href="http://localhost/Final_PHP_BuiXuanTrieu/FrontEnd/page/login.php?username=' . $username . '"> đây</a> để thiết lập lại mật khẩu của bạn. </p>
            <p></p>
            <p></p> 
            <p>Nếu bạn nhận được email này do nhầm lẫn, bạn hoàn toàn có thể bỏ qua email này.</p>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            $_SESSION['forgot-success'] = 1;
            $mail->send();
            header("Location: ../FrontEnd/page/login.php");
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
