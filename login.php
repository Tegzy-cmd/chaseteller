<?php
    session_start();
    include("includes/config.php");
    include("includes/conn.php");
    include("includes/func.php");
    user_session_registered("users/dashboard.php");

    if (isset($_POST["login"])) 
    {
        $username = mysqli_real_escape_string($link, $_POST["username"]);
        $password = mysqli_real_escape_string($link, $_POST["password"]);

        if (empty($username) && empty($password)) {
            $_SESSION["failure"] = "The username and password fields are empty.";
        }
        elseif (empty($username)) {
            $_SESSION["failure"] = "The username field is empty.";
        }
        elseif (empty($password)) {
            $_SESSION["failure"] = "The password field is empty.";
        }
        else {
            $find_username = mysqli_query($link, "SELECT * FROM `users` WHERE `username`='$username'");
            $find_password = mysqli_query($link, "SELECT * FROM `users` WHERE `password`='$password'");
            

            if (mysqli_num_rows($find_username) == 0) {
                $_SESSION["failure"] = "Unknown username. Please check again."; 
            } 
            elseif (mysqli_num_rows($find_password) == 0) {
                $_SESSION["failure"] = "The password you entered is incorrect."; 
            } 
            else {
                $user_id = $user_password = "";
                while ($row = mysqli_fetch_array($find_username)) {
                    $user_id = $row["id"];
                    $user_password = $row["password"];
                    $user_otp_status = $row["otp_status"];
                }

                if (!empty($_POST["remember_me"])) {
                    setcookie("user_name", $username, time() + (10 * 365 * 24 * 60 * 60));
                    setcookie("user_pass", $password, time() + (10 * 365 * 24 * 60 * 60));
                } else {
                    setcookie("user_name", "");
                    setcookie("user_pass", "");
                }

                if (compare($password, $user_password)) {
                    $_SESSION["logged_in"] = TRUE;
                    $_SESSION["user_id"] = $user_id;
                    $_SESSION["time_stamped"] = time();
if (compare("inactive", $user_otp_status)) {
    redirect_url("users/dashboard.php");
}else if (compare("active",$user_otp_status)){
  redirect_url("users/verify-otp.php");
} 
                } 
                else {
                    $_SESSION["failure"] = "The password you entered is incorrect.";
                }
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">
<link href="images/favicon-32.png" rel="icon" />
<title>UBS Transact - User Access Login Portal</title>
<meta name="description" content="UBS Transact is a banking platform for payment and receiving of money worldwide.">
<meta name="author" content="Aleph-Null">

<!-- Web Fonts
============================================= -->
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Rubik:300,300i,400,400i,500,500i,700,700i,900,900i' type='text/css'>

<!-- Stylesheet
============================================= -->
<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="vendor/font-awesome/css/all.min.css" />
<link rel="stylesheet" type="text/css" href="css/stylesheet.css" />
</head>
<body>

<!-- Preloader -->
<div id="preloader">
  <div data-loader="dual-ring"></div>
</div>
<!-- Preloader End -->
<style type="text/css">
  .cliff-logo{
    width:150px;
    height: 100px;
  }
    @media (max-width: 768px) {
        .cliff-logo { 
            width: 130px; 
        }
    }
</style>
<div id="main-wrapper" class="h-100">
  <div class="container-fluid px-0 h-100">
    <div class="row no-gutters h-100">
      <!-- Welcome Text
      ============================================= -->
      <div class="col-md-6">
        <div class="hero-wrap d-flex align-items-center h-100">
          <div class="hero-mask opacity-8 bg-dark"></div>
          <div class="hero-bg hero-bg-scroll" style="background-image:url('./images/bg/signup-bg.jpg');"></div>
          <div class="hero-content mx-auto w-100 h-100 d-flex flex-column">
            <div class="row no-gutters">
              <div class="col-10 col-lg-9 mx-auto">
                <div class="logo mt-5 mb-5 mb-md-0"> 
                  <a class="d-flex" href="index.php" title="UBS Transact - Online Banking">
                    <img src="images/logo.png" alt="UBS Transact" class="cliff-logo"></a> 
                  </div>
              </div>
            </div>
              <div class="row no-gutters my-auto">
                <div class="col-10 col-lg-9 mx-auto">
                  <h1 class="text-11 text-white mb-4">Welcome Back!</h1>
                  <p class="text-4 text-white line-height-4 mb-5">We are glad to see you again! Instant deposits, withdrawals & payouts trusted by millions worldwide.</p>
                </div>
              </div>
          </div>
        </div>
      </div>
      <!-- Welcome Text End -->
      
      <!-- Login Form
      ============================================= -->
      <div class="col-md-6 d-flex align-items-center">
        <div class="container my-4">
          <div class="row">
            <div class="col-11 col-lg-9 col-xl-8 mx-auto">
              <h3 class="font-weight-400 mb-4">Log In</h3>

              <?php 
                echo msg_success();
                echo msg_failure();
              ?>

              <form id="loginForm" action="" method="post">
                <div class="form-group">
                  <label for="username">Username</label>
                  <input type="text" class="form-control" id="username" name="username" required placeholder="Enter Your Username" value="<?php if (isset($_COOKIE['user_name'])) { echo($_COOKIE['user_name']); } ?>">
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" id="password" name="password" required placeholder="Enter Password" value="<?php if (isset($_COOKIE['user_pass'])) { echo($_COOKIE['user_pass']); } ?>">
                </div>
                <div class="row">
                  <div class="col-sm">
                    <div class="form-check custom-control custom-checkbox">
                      <input id="remember-me" name="remember_me" class="custom-control-input" type="checkbox" <?php if (isset($_COOKIE['user_name']) || isset($_COOKIE['user_pass'])) { echo("checked"); } ?>>
                      <label class="custom-control-label" for="remember-me">Remember Me</label>
                    </div>
                  </div>
                  <div class="col-sm text-right"><a class="btn-link" href="forgot-password.php">Forgot Password ?</a></div>
                </div>
                <button class="btn btn-primary btn-block my-4" type="submit" name="login">Login</button>
              </form>
              <p class="text-3 text-center text-muted">Don't have an account? <a class="btn-link" href="signup.php">Sign Up</a></p>
            </div>
          </div>
        </div>
      </div>
      <!-- Login Form End -->
    </div>
  </div>
</div>

<!-- Back to Top
============================================= --> 
<a id="back-to-top" data-toggle="tooltip" title="Back to Top" href="javascript:void(0)"><i class="fa fa-chevron-up"></i></a> 

<!-- Script -->
<script src="vendor/jquery/jquery.min.js"></script> 
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script> 
<script src="js/theme.js"></script>
</body>
</html>