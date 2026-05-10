<?php
require "connection.php";

if (isset($_GET["id"])) {

  $pid = $_GET["id"];

  $product_rs = Database::search("SELECT * FROM `product` WHERE  product.id='" . $pid . "'");

  $product_num = $product_rs->num_rows;

  if ($product_num == 1) {

    $product_data = $product_rs->fetch_assoc();

?>


    <!DOCTYPE html>
    <html>

    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Signle Product View</title>
      <link rel="icon" href="resource/logo.jpeg" />
      <link rel="stylesheet" href="css/style.css" />
      <link rel="stylesheet" href="css/bootstrap.css" />
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
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

      <div class="container-fluid">
        <div class="row">
          <!-- header -->
          <?php include "header.php"; ?>
          <!-- header -->

          <!-- Content -->
          <div class="col-12 mt-5">
            <div class="row">
              <div class="col-md-8    mt-5">
                <div id="carouselExampleRide" class="carousel slide  " data-bs-ride="true">
                  <div class="carousel-inner">
                    <?php

                    $image_rs = Database::search("SELECT * FROM `image` WHERE `product_id`='" . $pid . "'");
                    $image_num = $image_rs->num_rows;
                    $img = array();

                    if ($image_num != 0) {

                      for ($x = 0; $x < $image_num; $x++) {
                        $image_data = $image_rs->fetch_assoc();
                        $img[$x] = $image_data["code"];
                    ?>
                        <div class="carousel-item active">
                          <img src="<?php echo $image_data["code"] ?>" class="d-block w-100 object-fit-contain"  style="height: 400px; alt="...">
                        </div>
                      <?php
                      }
                    } else {
                      ?>
                      <div class="carousel-item">
                        <img src="resource/product_img/13pro.png" class="d-block w-100" alt="...">
                      </div>
                    <?php
                    }

                    ?>
                  </div>
                  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                  </button>
                  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                  </button>
                </div>
              </div>
              <div class="col-md-4   mt-5">
                <div class="row">
                  <div class="col-12">
                    <div class="row">
                      <p class="fs-5 text-white"><?php echo $product_data["title"] ?></p>
                      <p class="fs-5 text-white"><?php echo $product_data["description"] ?></p>
                      <p class="fs-5 text-white"><?php echo $product_data["qty"] ?> <span class="fs-5 text-white"> Product Available</span> </p>
                      <hr class="text-white  border-4" />
                      <div class="col-md-6 mt-3 d-grid">
                        <input type="number" class="form-control" id="qty2" value="1">
                      </div>
                      <div class="col-md-6 mt-3 d-grid">
                        <button class="btn bg-white "><i class="bi bi-heart-fill text-danger"></i></button>
                      </div>
                      <div class="col-md-12 mt-3 d-grid">
                        <button class="btn btn-success" id="payhere-payment" onclick="payNow(<?php echo $pid?>);" >Pay Now</button>
                      </div>
                      <div class="col-md-12 mt-3 d-grid">
                        <button class="btn btn-danger">Add to Cart</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="row p-5">
                <span class="text-warning">Description</span>
                <p class="text-white">Need for Speed: The Run is a racing game unlike its predecessors. Instead of focusing on a single city, The Run throws you in a high-stakes, cross-country race across the United States, from San Francisco to New York. You’ll be dodging cops, battling rival racers, and pushing your car to the limit as you tear through cities, deserts, and mountain highways.
                  Here are some key features of the game:
                  <li class="text-white">Epic Road Trip: The Run features a unique story mode where you race across the entire United States. You’ll encounter different environments, weather conditions, and race types throughout the journey.</li>
                  <li class="text-white">Variety is Key: The Run offers a good mix of race types to keep things interesting. You’ll compete in standard races, checkpoint races, drift battles, and even intense cop chases.</li>
                  <li class="text-white">High Stakes: There’s more than just bragging rights on the line. You’re racing to win a hefty sum of money to clear your debt.</li>
                  <li class="text-white">Fast-Paced Action: Need for Speed is known for its arcade-style racing, and The Run is no exception. Expect intense races, narrow escapes, and plenty of nitrous-fueled action.</li>
                </p>
              </div>
            </div>
          </div>
          <!-- Content -->

        </div>
      </div>

      <script src="js/script.js"></script>
      <script src="js/bootstrap.bundle.js"></script>
      <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
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
    </body>

<?php

  } else {
    echo ("Sorry for the inconvinient");
  }
} else {
  echo ("Something went wrong");
}

?>