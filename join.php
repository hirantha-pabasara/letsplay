<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | Log In</title>
    <link rel="icon" href="resource/logo.jpeg">
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet' />
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

<body style="background: linear-gradient(122deg, rgba(5,14,45,1) 41%, rgba(16,8,191,1) 100%) ;    height: 100vh; width: 100% ">

    <div class="container-fluid">
        <div class="row ">

            <!-- header -->
             <div class="col-12">
                <div class="row">
                    <header>
                        <a href="home.php" class="logo"> letsplay </a>
                        <ul class="nav">
                            <li class="list"><a href="home.php">Home</a></li>
                            <li class="list"><a href="home.php">About</a></li>
                            <li class="list"><a href="home.php">Games</a></li>
                            <li class="list"><a href="home.php">Components</a></li>
                            <li class="list"><a href="home.php">Contact Us</a></li>
                        </ul>
                        <div class="action">
                            <div class="searchBox">
                                <a href=""><i class="bi bi-search"> </i></a>
                                <input type="text" placeholder="Search Games" />
                            </div>
                        </div>
                        <div class="toggleMenu" onclick="toggleMenu();"></div>
                    </header>
                </div>
             </div>
            <!-- header -->
    
    
            <!-- content -->
            <div class="col-12 p-5" style="margin-top: 60px;" >
                <div class="row ">

                    <div class="col-6 d-flex justify-content-center align-content-center d-none d-lg-block ">
                        <div class="d-flex justify-content-center  " >
                            <img class="mt-5" src="resource/Login.png" style="height: 400px; width: 400px; background-repeat: no-repeat;"  alt="">
                        </div>
                        
                    </div>

                    <div class="col-12 col-lg-6 backgroundBlur p-4" id="signUpBox" >
                        <div class="row g-2">

                            <div class="col-12 mt-5 ">
                                <p class="fs-5 text-white">Let's Create Account</p>
                            </div>

                            <div class="col-12 d-none" id="msgdiv">
                                <div class="alert alert-danger" role="alert" id="alertdiv">
                                    <i class="bi bi-x-octagon-fill fs-5" id="msg">

                                    </i>
                                </div>
                            </div>

                            <div class=" col-6">
                                <label class="form-label text-white">First Name</label>
                                <input type="text" class="form-control" id="f">
                            </div>

                            <div class="col-6">
                                <label class="form-label text-white">Last Name</label>
                                <input type="text" class="form-control" id="l">
                            </div>

                            <div class="col-sm-6">
                                <label class="form-label text-white">Email</label>
                                <input type="email" class="form-control" id="e">
                            </div>

                            <div class="col-sm-6">
                                <label class="form-label text-white">Password</label>
                                <input type="password" class="form-control" id="p">
                            </div>

                            <div class="col-sm-6">
                                <label class="form-label text-white">Mobile</label>
                                <input type="text" class="form-control" id="m">
                            </div>

                            <div class="col-sm-6">
                                <label class="form-label text-white">Gender</label>
                                <select  class="form-control" id="g">
                                    <?php
                                        require "connection.php";

                                        $rs = Database::search("SELECT * FROM `gender` ");
                                        $n = $rs->num_rows;

                                        for($x = 0; $x < $n ; $x++){
                                            $d = $rs->fetch_assoc();

                                            ?>
                                                <option value="<?php echo $d["id"]; ?>"><?php echo $d["gender_name"]; ?></option>
                                            <?php
                                        }

                                    ?>
                                </select>
                            </div>

                            <div class="col-sm-6 d-grid mt-4 ">
                                <button class="btn btn-primary" onclick="signUp()">Sign Up</button>
                            </div>

                            <div class="col-sm-6 d-grid mt-4 ">
                                <button class="btn btn-dark" onclick="changeView();" >Already have an account ? Sign In</button>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-6 d-none d-flex align-items-center backgroundBlur p-4 " id="signInBox">
                        <div class="row g-2">
                            <div class="col-12">
                                <p class="fs-5 text-white ">Let's Sign In</p>
                                <span class="text-danger" id="msg2"></span>
                            </div>

                            <div class="col-sm-12">
                                <label class="form-label text-white">Email</label>
                                <input type="email" class="form-control" id="su_email"/>
                            </div>
                            <div class="col-12">
                                <label class="form-label text-white">Password</label>
                                <input type="password" class="form-control" id="su_password"  />
                            </div>
                            <div class="col-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="rememberme">
                                    <label class="form-check-label text-white">Remember Me</label>
                                </div>
                            </div>
                            <div class="col-6 text-end">
                                <a href="#" class="link-primary" onclick="forgotPassword();">Forgot Password?</a>
                            </div>
                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-primary" onclick="signIn();">Sign In</button>
                            </div>
                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-danger" onclick="changeView();">New to eShop?Join Now</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- content -->
    
            <!-- modal -->

            <div class="modal" tabindex="-1" id="forgotPasswordModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Reset Password</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-3">

                                <div class="col-6">
                                    <label class="form-label">New Password</label>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" id="new_pass"/>
                                        <button class="btn btn-outline-secondary" type="button" id="npb" onclick="showPassword1();"><i id="e1" class="bi bi-eye-slash-fill"></i></button>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label class="form-label">Re-type Password</label>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" id="re_pass"/>
                                        <button class="btn btn-outline-secondary" type="button" id="rnpb" onclick="showPassword2();"><i id="e2" class="bi bi-eye-slash-fill"></i></button>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Verification Code</label>
                                    <input type="text" class="form-control" id="verify"/>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="resetpw();">Reset Password</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- modal -->
    
            
        </div>
    </div>
    <script src="js/bootstrap.js"></script>
    <script src="js/script.js"></script>
</body>

</html>