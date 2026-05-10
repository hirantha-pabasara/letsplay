<?php

    require "connection.php";

    $fname = $_POST["f"];
    $lname = $_POST["l"];
    $email = $_POST["e"];
    $password = $_POST["p"];
    $mobile = $_POST["m"];
    $gender = $_POST["g"];

    if(empty($fname)){
        echo ("First Name Field Cannot Be Empty");
    }else if(strlen($fname) > 30 ){
        echo ("First Name must have less than 30 characters");
    }else if(empty($lname)){
        echo ("Last Name Field Cannot Be Empty");
    }else if(strlen($lname) > 50){
        echo ("Last Name must have less than 50 characters");
    }else if (empty($email)){
        echo ("Email Field Cannot Be Empty");
    }else if(strlen($email) >= 100){
        echo ("Email must have less than 100 characters");
    }else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        echo ("Please Enter valid Email ");
    }else if (empty($password)){
        echo ("Password Field Cannot Be Empty");
    }else if(strlen($password) < 5 || strlen($password) > 20){
        echo ("Password must be between 5 - 20 charcters");
    }else if(empty($mobile)){
        echo ("Mobile Field Cannot Be Empty");
    }else if(strlen($mobile) != 10){
        echo ("Mobile must have 10 characters");
    }else if(!preg_match("/07[0,1,2,4,5,6,7,8][0-9]/",$mobile)){
        echo ("Please Enter valid Mobile ");
    }else{

        $rs = Database::search("SELECT*FROM`user`WHERE `email`='".$email."' OR `mobile`='".$mobile."' ");
        $n = $rs ->num_rows;

        if($n > 0){
            echo ("Opps there is an user with same Email or Password");
        }else{
            $d = new DateTime();
            $tz = new DateTimeZone("Asia/Colombo");
            $d->setTimezone($tz);
            $date = $d->format("Y-m-d H:i:s");

            Database::iud("INSERT INTO `user` (`fname`,`lname`,`email`,`password`,`mobile`,`joined_date`,`gender_id`,`status_id`) VALUES 
            ('".$fname."','".$lname."','".$email."','".$password."','".$mobile."','".$date."','".$gender."','1') ");

            echo "success";

        }

    }

?>