<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up | Log In</title>
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
      color: white;
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
      <!-- Database Connection -->
      <?php 
      
      require "connection.php";

      if (isset($_SESSION["user"])) {

            $email = $_SESSION["user"]["email"];

            $details_rs = Database::search("SELECT * FROM `user` INNER JOIN `gender` ON
            gender.id=user.gender_id WHERE `email`='" . $email . "'");

            $image_rs = Database::search("SELECT * FROM `profile_image` WHERE `user_email` ='" . $email . "'");

            $address_rs = Database::search("SELECT * FROM `user_has_address` INNER JOIN `city` ON 
            user_has_address.city_id=city.id INNER JOIN `district` ON 
            city.district_id=district.id INNER JOIN `province` ON 
            district.province_id=province.id WHERE `user_email` ='" . $email . "'");

            $data = $details_rs->fetch_assoc();
            $image_data = $image_rs->fetch_assoc();
            $address_data = $address_rs->fetch_assoc();
      
      ?>
        <!-- Database Connection -->
      <!-- Content -->
      <div class="col-12">
        <div class="row mt-5">
          <div class="mt-3">
            <h2 class="mt-3">User Profile</h2>
            <p>Manage your details,view your tire status and change your password</p>
          </div>

          <div class="col-md-3 offset-1 ">

            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
            <?php
              if (empty($image_data["path"])) {
                ?>
                  <img src="resource/newuser.svg" class="rounded mt-5" style="width: 150px;" id="viewImg" />
                <?php
              } else {
                ?>
                  <img src=<?php echo $image_data["path"]; ?> class=" roundedmt-5" style="width: 150px;" id="viewImg" />
                <?php
              }
                ?>
            <span class="fw-bold"><?php echo $data["fname"] . " " . $data["lname"]; ?></span>
            <span class="fw-bold"><?php echo $email; ?></span>

            <input type="file" class="d-none" id="profileImg" accept="image/*" />
            <label for="profileImg" class="btn btn-primary mt-5" onclick="changeImage();">Update Profile Image</label>
            </div>
            

          </div>
          <div class="col-md-7  ">
            <div class="p2 ">



              <div class="row mt-4">

                <div class="col-6 mt-3">
                  <label class="form-label">First Name</label>
                  <input type="text" class="form-control" value="<?php echo $data["fname"]; ?>" id="fname">
                </div>
                <div class="col-6 mt-3">
                  <label class="form-label">Last Name</label>
                  <input type="text" class="form-control" value="<?php echo $data["lname"]; ?>" id="lname">
                </div>

                <div class="col-12 mt-3">
                  <label class="form-label">Mobile</label>
                  <input type="text" class="form-control" value="<?php echo $data["mobile"]; ?>" id="mobile">
                </div>

                <div class="col-12 mt-3">
                  <label class="form-label">Email</label>
                  <input type="email" class="form-control" readonly value="<?php echo $data["email"]; ?>">
                </div>

                <div class="col-12 mt-3">
                  <label class="form-label">Password</label>
                  <div class="input-group">
                    <input type="password" class="form-control " readonly value="<?php echo $data["password"]; ?>" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <span class="input-group-text bg-primary" id="basic-addon2">
                        <i class="bi bi-eye-slash text-white"></i>
                      </span>
                    </div>
                  </div>
                </div>


                <div class="col-12 mt-3">
                  <label class="form-label">Registred Date</label>
                  <input type="text" class="form-control" readonly value="<?php echo $data["joined_date"]; ?>">
                </div>

                <?php

                if (!empty($address_data["line1"])) {

                ?>
                  <div class="col-12 mt-3">
                    <label class="form-label">Address Line 1</label>
                    <input type="text" id="line1" class="form-control" value="<?php echo $address_data["line1"]; ?>">
                  </div>
                <?php

                } else {

                ?>
                  <div class="col-12 mt-3">
                    <label class="form-label">Address Line 1</label>
                    <input id="line1" type="text" class="form-control">
                  </div>
                <?php

                }

                ?>



                <?php

                if (!empty($address_data["line2"])) {

                ?>
                  <div class="col-12 mt-3">
                    <label class="form-label">Address Line 2</label>
                    <input id="line2" type="text" class="form-control" value="<?php echo $address_data["line2"]; ?>">
                  </div>
                <?php

                } else {

                ?>
                  <div class="col-12 mt-3">
                    <label class="form-label">Address Line 2</label>
                    <input id="line2" type="text" class="form-control">
                  </div>
                <?php

                }

                $province_rs = Database::search("SELECT * FROM `province`");
                $district_rs = Database::search("SELECT * FROM `district`");
                $city_rs = Database::search("SELECT * FROM `city`");



                ?>

                <div class="col-6 mt-3">
                  <label class="form-label">Province</label>
                  <select class="form-select bg-info" id="province">
                    <option value="0" >Select Province</option>

                    <?php
                    $province_num = $province_rs->num_rows;
                    for ($x = 0; $x < $province_num; $x++) {

                      $province_data = $province_rs->fetch_assoc();
                    ?>
                      <option value="<?php echo $province_data["id"]; ?>" <?php

                        if (!empty($address_data["province_id"])) {
                          if ($province_data["id"] == $address_data["province_id"]) { ?>selected<?php
                            }
                        }
                          ?>>
                        <?php echo $province_data["name"]; ?></option>
                    <?php
                    }
                    ?>

                  </select>
                </div>

                <div class="col-6 mt-3">
                  <label class="form-label">District</label>
                  <select class="form-select bg-info" id="district">
                    <option value="0">Select District</option>

                    <?php
                    $district_num = $district_rs->num_rows;
                    for ($x = 0; $x < $district_num; $x++) {

                      $district_data = $district_rs->fetch_assoc();
                    ?>
                      <option value="<?php echo $district_data["id"]; ?>" <?php

                                                                          if (!empty($address_data["district_id"])) {

                                                                            if ($district_data["id"] == $address_data["district_id"]) {
                                                                          ?>selected<?php
                                                                            }
                                                                          }
                                                                              ?>><?php echo $district_data["name"]; ?></option>
                    <?php
                    }
                    ?>

                  </select>
                </div>

                <div class="col-6 mt-3">
                  <label class="form-label">City</label>
                  <select class="form-select bg-info" id="city">
                    <option value="0">Select City</option>

                    <?php
                    $city_num = $city_rs->num_rows;
                    for ($x = 0; $x < $city_num; $x++) {

                      $city_data = $city_rs->fetch_assoc();
                    ?>
                      <option value="<?php echo $city_data["id"]; ?>" <?php

                                                                      if (!empty($address_data["id"])) {

                                                                        if ($district_data["id"] == $address_data["id"]) {
                                                                      ?>selected<?php
                                                                        }
                                                                      }
                                                                          ?>><?php echo $city_data["name"]; ?></option>
                    <?php
                    }
                    ?>

                  </select>
                </div>

                

                <div class="col-12 mt-3">
                  <label class="form-label">Gender</label>
                  <input type="text" class="form-control" readonly value="<?php echo $data["gender_name"] ?>">
                </div>

                <div class="col-12 d-grid mt-3">
                  <button class="btn btn-primary" onclick="updateProfile();">Update My Profile</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Content -->

    </div>
  </div>

  <script src="js/script.js"></script>
  <script src="js/count.js"></script>
  <script src="js/bootstrap.bundle.js"></script>
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
<?php

} else {
    header("Location:http://localhost/letsplay2/home.php");
}
?>
  <!-- Fillterable Card -->
</body>