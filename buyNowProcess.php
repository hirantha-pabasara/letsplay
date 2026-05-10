<?php

session_start();
require "connection.php";

if(isset($_SESSION["user"])){

    $id = $_GET["id"];
    $qty = $_GET["qty"];
    $umail = $_SESSION["user"]["email"];


    $array;

    $order_id = uniqid();

    $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='".$id."'");
    $product_data = $product_rs->fetch_assoc();

        $item = $product_data["title"];
        $amount = ((int)$product_data["price"] * (int)$qty) ;

        $fname = $_SESSION["user"]["fname"];
        $lname = $_SESSION["user"]["lname"];
        $mobile = $_SESSION["user"]["mobile"];

        $merchant_id ="1227460";
        $merchant_secret ="MjU4MDczNTg4NTI3NDYxOTY2NDkyNjA5MDExNTI0MjEyNDA5MDkzMQ==";

        $currency = "LKR";

        $hash = strtoupper(
            md5(
                $merchant_id . 
                $order_id . 
                number_format($amount, 2, '.', '') . 
                $currency .  
                strtoupper(md5($merchant_secret)) 
            ) 
        );

        $array["id"] = $order_id;
        $array["hash"] = $hash;
        $array["item"] = $item;
        $array["amount"] = $amount;
        $array["fname"] = $fname;
        $array["lname"] = $lname;
        $array["mobile"] = $mobile;
        $array["umail"] = $umail;

        echo json_encode($array);

    

}else{
    echo ("1");
}

?>