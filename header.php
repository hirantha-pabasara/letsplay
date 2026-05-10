<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/bootstrap.css" />
  <link rel="stylesheet" href="css/style.css" />
</head>

<body>
  <header>

    <a href="home.php" class="logo"> letsplay </a>
    <ul class="nav">
        <li class="list"><a href="home.php">Home</a></li>
        <li class="list"><a href="#about">About</a></li>
        <li class="list"><a href="#games">Games</a></li>
        <li class="list"><a href="#tournament">Components</a></li>
        <li class="list"><a href="#contact">Contact Us</a></li>
    </ul>
    <div class="action">
        <div class="searchBox">
            <a href=""><i class="bi bi-search"> </i></a>
            <input type="text" placeholder="Search Games" />
        </div>
    </div>

    <div class="dropdown text-end">
        <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="resource/person-fill.svg" alt="mdo" width="32" height="32" class="rounded-circle">
        </a>
        <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
            <li><a class="dropdown-item" href="#">Whishlist</a></li>
            <li><a class="dropdown-item" href="cart.php">Cart</a></li>
        <?php
        session_start();

        if(isset($_SESSION["user"])){
            $data = $_SESSION["user"];

            ?>
                <li><a class="dropdown-item" href="userProfile.php">Edit Profile</a></li>
                <li>
                <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" onclick="signout();">Sign out</a></li> 
            <?php

        }else{
            ?>
                <li><a class="dropdown-item" href="userProfile.php">Profile</a></li>
                <li>
                <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="join.php">Sign In or Register</a></li> 
            <?php
        }

    ?>
        
            
                          
        </ul>
    </div>
    <div class="toggleMenu" onclick="toggleMenu();"></div>

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
</header>
</body>

</html>