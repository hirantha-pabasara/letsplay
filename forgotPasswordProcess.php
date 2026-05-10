<?php

require "connection.php";

require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if(isset($_GET["e"])){

    $email = $_GET["e"];
    $rs = Database::search("SELECT * FROM `user` WHERE `email`='".$email."'");
    $n = $rs->num_rows;

    if($n == 1){

        $code = uniqid();

       Database::iud("UPDATE `user` SET `verification_code`='".$code."' WHERE 
        `email`='".$email."'");

        $smtpHost = getenv("SMTP_HOST") ?: "smtp.gmail.com";
        $smtpPort = getenv("SMTP_PORT") ?: "465";
        $smtpSecure = getenv("SMTP_SECURE") ?: "ssl";
        $smtpUsername = getenv("SMTP_USERNAME") ?: "sample.sender@example.com";
        $smtpPassword = getenv("SMTP_PASSWORD") ?: "sample-app-password";
        $smtpFrom = getenv("SMTP_FROM") ?: $smtpUsername;

        if ($smtpUsername === "sample.sender@example.com" || $smtpPassword === "sample-app-password") {
            echo ("Unable to send password reset email. Please try again later.");
            exit;
        }

        $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = $smtpHost;
            $mail->SMTPAuth = true;
            $mail->Username = $smtpUsername;
            $mail->Password = $smtpPassword;
            $mail->SMTPSecure = $smtpSecure;
            $mail->Port = (int)$smtpPort;
            $mail->setFrom($smtpFrom, 'Reset Password');
            $mail->addReplyTo($smtpFrom, 'Reset Password');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'letsplay Forgot Password Verification Code';
            $bodyContent = '<h1 style="color:green">Your Verification code is '.$code.'</h1>';
            $mail->Body    = $bodyContent;

            if (!$mail->send()) {
                echo ('Verification code sending failed');
            } else {
                echo ('Success');
            }

    }else{
        echo ("Invalid Email address");
    }

}

?>
