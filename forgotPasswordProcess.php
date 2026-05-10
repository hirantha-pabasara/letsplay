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

        $smtpUsername = getenv("SMTP_USERNAME") ?: "sample.sender@example.com";
        $smtpPassword = getenv("SMTP_PASSWORD") ?: "sample-app-password";
        $smtpFrom = getenv("SMTP_FROM") ?: $smtpUsername;

        if ($smtpUsername === "sample.sender@example.com" || $smtpPassword === "sample-app-password") {
            echo ("SMTP credentials are not configured");
            exit;
        }

        $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = $smtpUsername;
            $mail->Password = $smtpPassword;
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
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
