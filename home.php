<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LetsPlay | Home </title>
    <link rel="icon" href="resource/logo.jpeg">
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Quicksand";
            font-size: 14px;
            scroll-behavior: smooth;
        }

        @font-face {
            font-family: "Quicksand";
            src: url("font/Quicksand-Medium.ttf");
        }

        @font-face {
            font-family: "Honey";
            src: url("font/HoneyScript-Light.ttf");
        }
    </style>

</head>

<body>
    <?php require "connection.php" ?>
    <!-- Header -->
    <?php include "header.php"; ?>
    <!-- Header -->

    <!-- Home Banner -->
    <div class="banner animeX" id="Home">
        <div class="bg">
            <div class="content">
                <h2>A New Home for <br>Game Lovers </h2>
                <p> Welcome to our game store!
                    we are offers the latest and greatest games for all platforms, a user-friendly website, and a variety of gaming accessories.
                    We strive to provide the best shopping experience and competitive pricing to help customers save</p>
                <a href="join.php" class="btn">Join Now</a>
            </div>
            <img src="resource/home/pngwing1.com.png" alt="" />
        </div>
    </div>
    <!-- Home Banner -->

    <!-- About -->
    <div class="about animeX" id="about">
        <div class="contentBox">
            <h2>About Us</h2>
            <p> We are dedicated to providing our customers with the latest and greatest games for all platforms,
                including PC, Xbox, PlayStation, and Nintendo Switch. Our extensive game library includes a wide range of genres,
                including action, adventure, sports, and strategy games, to cater to all gaming preferences.
                Our user-friendly website allows you to easily browse and search for your favorite games, watch trailers and gameplay videos,
                and read detailed reviews from other gamers. We also offer a variety of gaming accessories, including controllers, headsets,
                keyboards, and mice, to enhance your gaming experience. Our knowledgeable and friendly staff are always available to provide
                recommendations and answer any questions you may have. We strive to provide the best possible shopping experience and competitive
                pricing to help you save on your favorite titles. Thank you for choosing our game store!
            </p>
            <a href="">Read More</a>
        </div>
        <img src="resource/home/pngwing.com (7).png" alt="">
    </div>
    <!-- About -->

    <!-- Games -->

    <div class="games animeX" id="games">
        <h2>Popular Games</h2>
        <ul>
            <li class="list">All</li>
            <li class="list">Pc games</li>
            <li class="list">Console games</li>
        </ul>

        <div class="cardBox">
            <?php
            $category_rs = Database::search("SELECT * FROM `category` ");
            $category_num = $category_rs->num_rows;

            for ($x = 0; $x < $category_num; $x++) {
                $category_data = $category_rs->fetch_assoc();
            ?>
                <a href="#" class="text-decoration-none text-white fs-3 fw-bold"><?php echo $category_data["name"]; ?></a>&nbsp;&nbsp;
                <a href="#" class="text-decoration-none text-white fs-6">See All &nbsp; &rarr;</a>

                <div class="cardBox">
                    <?php

                    $product_rs = Database::search("SELECT * FROM `product` INNER JOIN `product_has_category` ON  product.id=product_has_category.id WHERE product.id='" . $category_data["id"] . "' AND
                    `status_id`='1'  ");
                    // $product_rs = Database::search("SELECT * FROM `product` WHERE `category_id`='" . $category_data["id"] . "' AND
                    // `status_id`='1'  ");
                    $product_num = $product_rs->num_rows;

                    for ($z = 0; $z < $product_num; $z++) {
                        $product_data = $product_rs->fetch_assoc();
                        $image_rs = Database::search("SELECT*FROM`image` WHERE `product_id`='" . $product_data["id"] . "' ");
                        $image_data = $image_rs->fetch_assoc();
                    ?>
                        <div class="card" data-item="pc">
                            <img src="<?php echo $image_data["code"]; ?>" alt="">
                            <div class="content">
                                <h4><?php echo $product_data["title"]; ?></h4>
                                <h4>
                                    <p>Pricing<br><span>$ <?php echo $product_data["price"]; ?></span></p>
                                </h4>
                                <div class="info">
                                    <a href="" class="" onclick="addToCart(<?php echo $product_data['id']; ?>);">Add Cart</a>
                                    <a href='<?php echo "singleProductView.php?id=" . $product_data["id"]; ?>'>Buy Now</a>
                                </div>
                            </div>
                        </div>
                    <?php
                    }

                    ?>


                </div>
            <?php
            }

            ?>
        </div>

    </div>
    <!-- Games -->

    <!-- Tournaments -->
    <div class="tournament animeX " id="tournament">
        <h2>Live Tournaments</h2>
        <div class="boxBox">

            <div class="box">
                <img src="resource/tournament/tornrment.jpg" alt="">
                <div class="content">
                    <h4><span>50 </span>Matches in progress</h4>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos, repudiandae! Distinctio quas eveniet,
                        maiores reiciendis nihil a, nulla, sit aspernatur beatae dolorem quidem quia non.
                        Quae nobis eveniet quidem quisquam.
                    </p>
                    <div class="btn">
                        <a href="" class="watch">Watch</a>
                        <a href="" class="join">Join Now</a>
                    </div>
                </div>
            </div>

            <div class="box">
                <img src="resource/tournament/tornrment2.jpg" alt="">
                <div class="content">
                    <h4><span>50 </span>Matches in progress</h4>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos, repudiandae! Distinctio quas eveniet,
                        maiores reiciendis nihil a, nulla, sit aspernatur beatae dolorem quidem quia non.
                        Quae nobis eveniet quidem quisquam.
                    </p>
                    <div class="btn">
                        <a href="" class="watch">Watch</a>
                        <a href="" class="join">Join Now</a>
                    </div>
                </div>
            </div>

            <div class="box">
                <img src="resource/tournament/tournerment3.jpg" alt="">
                <div class="content">
                    <h4><span>50 </span>Matches in progress</h4>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos, repudiandae! Distinctio quas eveniet,
                        maiores reiciendis nihil a, nulla, sit aspernatur beatae dolorem quidem quia non.
                        Quae nobis eveniet quidem quisquam.
                    </p>
                    <div class="btn">
                        <a href="" class="watch">Watch</a>
                        <a href="" class="join">Join Now</a>
                    </div>
                </div>
            </div>

            <div class="box">
                <img src="resource/tournament/tournerment4.jpg" alt="">
                <div class="content">
                    <h4><span>50 </span>Matches in progress</h4>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos, repudiandae! Distinctio quas eveniet,
                        maiores reiciendis nihil a, nulla, sit aspernatur beatae dolorem quidem quia non.
                        Quae nobis eveniet quidem quisquam.
                    </p>
                    <div class="btn">
                        <a href="" class="watch">Watch</a>
                        <a href="" class="join">Join Now</a>
                    </div>
                </div>
            </div>

            <div class="box">
                <img src="resource/tournament/tournerment5.jpg" alt="">
                <div class="content">
                    <h4><span>50 </span>Matches in progress</h4>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos, repudiandae! Distinctio quas eveniet,
                        maiores reiciendis nihil a, nulla, sit aspernatur beatae dolorem quidem quia non.
                        Quae nobis eveniet quidem quisquam.
                    </p>
                    <div class="btn">
                        <a href="" class="watch">Watch</a>
                        <a href="" class="join">Join Now</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Tournaments -->

    <!-- Contact Us -->
    <div class="contact animeX " id="contact">
        <img src="resource/tournament/contactus.png" alt="">
        <div class="form">
            <h1>Contact Us</h1>
            <div class="inputBox">
                <p>Enter Name</p>
                <input type="text" placeholder="Full Name" />
            </div>
            <div class="inputBox">
                <p>Enter Email</p>
                <input type="email" placeholder="Full Name" />
            </div>
            <div class="inputBox">
                <p>Message</p>
                <textarea name="" id="" placeholder="Type here........"></textarea>
            </div>
            <div class="inputBox">
                <input type="submit" name="Submit">
            </div>
        </div>
    </div>
    <!-- Contact Us -->

    <!-- Footer -->
    <footer>
        <div class="info">
            <div class="logo">letsplay</div>
            <p><i class="bi bi-c-circle"></i> 2023 All Right Reserved </p>
            <ul>
                <li><a href=""><i class="bi bi-facebook"></i></a></li>
                <li><a href=""><i class="bi bi-twitch"></i></a></li>
                <li><a href=""><i class="bi bi-youtube"></i></a></li>
                <li><a href=""><i class="bi bi-twitter"></i></a></li>
            </ul>
        </div>
    </footer>
    <!-- Footer -->

    <script>
        // Sticky NavBar
        window.addEventListener('scroll', function() {
            var header = document.querySelector('header');
            header.classList.toggle('sticky', window.scrollY > 0);
        });

        // Scrolling Animation Effect
        window.addEventListener('scroll', function() {
            var anime = document.querySelectorAll('.animeX')

            for (var s = 0; s < anime.length; s++) {
                var windowheight = window.innerHeight;
                var animetop = anime[s].getBoundingClientRect().top;
                var animepoint = 80;

                if (animetop < windowheight - animepoint) {
                    anime[s].classList.add('active');
                } else {
                    anime[s].classList.remove('active');
                }

            }

        })


        // Responsive NabBar
        function toggleMenu() {
            const toggleMenu = document.querySelector('.toggleMenu');
            const nav = document.querySelector('.nav');
            toggleMenu.classList.toggle('active')
            nav.classList.toggle('active')
        }
    </script>

    <!-- Fillterable Card -->

        <script src="js/script.js"></script>
        <script src="js/bootstrap.bundle.js"></script>
</body>

</html>