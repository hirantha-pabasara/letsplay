<?php
session_start();
require "connection.php";

if (isset($_SESSION["user"])) {
    $oid = $_GET["oid"];
    $umail = $_SESSION["user"]["email"];

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>letsplay | invoice</title>
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="icon" href="resource/logo.jpeg">

        <style>
            body {
                margin: 0;
                padding: 0;
                font: 400 .875rem 'Open Sans', sans-serif;
                color: #bcd0f7;
                background: #1A233A;
                position: relative;
                height: 100%;
            }

            .invoice-container {
                padding: 1rem;
            }

            .invoice-container .invoice-header .invoice-logo {
                margin: 0.8rem 0 0 0;
                display: inline-block;
                font-size: 1.6rem;
                font-weight: 700;
                color: #bcd0f7;
            }

            .invoice-container .invoice-header .invoice-logo img {
                max-width: 130px;
            }

            .invoice-container .invoice-header address {
                font-size: 0.8rem;
                color: #8a99b5;
                margin: 0;
            }

            .invoice-container .invoice-details {
                margin: 1rem 0 0 0;
                padding: 1rem;
                line-height: 180%;
                background: #1a233a;
            }

            .invoice-container .invoice-details .invoice-num {
                text-align: right;
                font-size: 0.8rem;
            }

            .invoice-container .invoice-body {
                padding: 1rem 0 0 0;
            }

            .invoice-container .invoice-footer {
                text-align: center;
                font-size: 0.7rem;
                margin: 5px 0 0 0;
            }

            .invoice-status {
                text-align: center;
                padding: 1rem;
                background: #272e48;
                -webkit-border-radius: 4px;
                -moz-border-radius: 4px;
                border-radius: 4px;
                margin-bottom: 1rem;
            }

            .invoice-status h2.status {
                margin: 0 0 0.8rem 0;
            }

            .invoice-status h5.status-title {
                margin: 0 0 0.8rem 0;
                color: #8a99b5;
            }

            .invoice-status p.status-type {
                margin: 0.5rem 0 0 0;
                padding: 0;
                line-height: 150%;
            }

            .invoice-status i {
                font-size: 1.5rem;
                margin: 0 0 1rem 0;
                display: inline-block;
                padding: 1rem;
                background: #1a233a;
                -webkit-border-radius: 50px;
                -moz-border-radius: 50px;
                border-radius: 50px;
            }

            .invoice-status .badge {
                text-transform: uppercase;
            }

            @media (max-width: 767px) {
                .invoice-container {
                    padding: 1rem;
                }
            }

            .card {
                background: #272E48;
                -webkit-border-radius: 5px;
                -moz-border-radius: 5px;
                border-radius: 5px;
                border: 0;
                margin-bottom: 1rem;
            }

            .custom-table {
                border: 1px solid #2b3958;
            }

            .custom-table thead {
                background: #2f71c1;
            }

            .custom-table thead th {
                border: 0;
                color: #ffffff;
            }

            .custom-table>tbody tr:hover {
                background: #172033;
            }

            .custom-table>tbody tr:nth-of-type(even) {
                background-color: #1a243a;
            }

            .custom-table>tbody td {
                border: 1px solid #2e3d5f;
            }

            .table {
                background: #1a243a;
                color: #bcd0f7;
                font-size: .75rem;
            }

            .text-success {
                color: #c0d64a !important;
            }

            .custom-actions-btns {
                margin: auto;
                display: flex;
                justify-content: flex-end;
            }

            .custom-actions-btns .btn {
                margin: .3rem 0 .3rem .3rem;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <div class="row gutters">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="invoice-container">
                                <div class="invoice-header">

                                    <!-- Row start -->
                                    <div class="row gutters">
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                            <div class="custom-actions-btns mb-5">
                                                <a href="#" class="btn btn-primary">
                                                    <i class="icon-download"></i> Download
                                                </a>
                                                <a href="#" class="btn btn-secondary">
                                                    <i class="icon-printer"></i> Print
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Row end -->

                                    <!-- Row start -->
                                    <div class="row gutters">
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                            <a href="index.html" class="invoice-logo">
                                                letsplay.com
                                            </a>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 d-flex justify-content-end">

                                            <address class="text-right fs-6 ">
                                                Java Institute,<br>
                                                Gampaha,<br>
                                                Sri Lanka
                                            </address>
                                        </div>
                                    </div>
                                    <!-- Row end -->

                                    <!-- Row start -->

                                    <?php
                                    $user_address = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $umail . "' ");
                                    $address_data = $user_address->fetch_assoc();
                                    ?>

                                    <div class="row gutters">
                                        <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                                            <div class="invoice-details">
                                                <address class="fs-6">
                                                    <?php echo $umail ?><br>
                                                    <?php echo $address_data["Aline1"] ?>,<?php echo $address_data["Aline2"]  ?>
                                                </address>
                                            </div>
                                        </div>

                                        <?php
                                        $invoice = Database::search("SELECT * FROM `invoice` WHERE `order_id`='" . $oid . "' ");
                                        $invoice_data = $invoice->fetch_assoc();
                                        ?>

                                        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                                            <div class="invoice-details">
                                                <div class="invoice-num text-white fs-6  ">
                                                    <div><?php echo $invoice_data["id"] ?><br></div>
                                                    <div><?php echo $invoice_data["date"] ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Row end -->

                                </div>

                                <div class="invoice-body">

                                    <!-- Row start -->
                                    <div class="row gutters">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="table-responsive">
                                                <?php
                                                $product_info = Database::search("SELECT * FROM `product` INNER JOIN `invoice` ON `invoice`.`product_id`=`product`.`id` WHERE `order_id`='" . $oid . "'");
                                   
                                                $product_num = $product_info->num_rows;
                                                ?>
                                                <table class="table custom-table m-0">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-dark">Items</th>
                                                            <th class="text-dark">Product ID</th>
                                                            <th class="text-dark">Quantity</th>
                                                            <th class="text-dark">Sub Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        
                                                        <?php
                                                        $subtotal = 0;
                                                        
                                                        for($x= 0; $x < $product_num ; $x++ ){
                                                            $product_data = $product_info->fetch_assoc();
                                                            $subtotal = ($product_data["price"])*($invoice_data["qty"]);
                                                            $total = $subtotal;
                                                            ?>
                                                            
                                                            <tr>
                                                            <td>
                                                                <?php echo $product_data["title"]  ?>
                                                                <p class="m-0 text-muted">
                                                                    <?php echo $product_data["description"]?>
                                                                </p>
                                                            </td>
                                                            <td> <?php echo $product_data["product_id"]?></td>
                                                            <td> <?php echo $product_data["qty"]?></td>
                                                            <td> LKR <?php echo $product_data["total"]?></td>
                                                        </tr>
                                                            <?php
                                                        }
                                                        
                                                        ?>
                                                        
                                                        <tr>
                
                                                            <td>&nbsp;</td>
                                                            <td colspan="2">
                                                                
                                                                <h5 class="text-success"><strong>Grand Total</strong></h5>
                                                            </td>
                                                            <td>
                                                                
                                                                <h5 class="text-success"><strong>LKR <?php echo $total  ?><br></strong></h5>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Row end -->

                                </div>

                                <div class="invoice-footer">
                                    Thank you for your Business.
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>
<?php

}
?>