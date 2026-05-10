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
        $smtpUsernameEnv = getenv("SMTP_USERNAME");
        $smtpPasswordEnv = getenv("SMTP_PASSWORD");
        $smtpFromEnv = getenv("SMTP_FROM");
        $smtpUsername = $smtpUsernameEnv ?: "sample.sender@example.com";
        $smtpPassword = $smtpPasswordEnv ?: "sample-app-password";
        $smtpFrom = $smtpFromEnv ?: $smtpUsername;

        $smtpPortNumber = (int)$smtpPort;
        if ($smtpPortNumber < 1 || $smtpPortNumber > 65535) {
            error_log("Invalid SMTP_PORT value '" . $smtpPort . "'. Falling back to 465.");
            $smtpPortNumber = 465;
        }

        if ($smtpUsernameEnv === false || trim($smtpUsernameEnv) === "" || $smtpPasswordEnv === false || trim($smtpPasswordEnv) === "") {
            error_log("SMTP credentials are not configured. Missing SMTP_USERNAME or SMTP_PASSWORD environment variable.");
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
            $mail->Port = $smtpPortNumber;
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
