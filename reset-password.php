<?php
    session_start();
    include("includes/config.php");
    include("includes/conn.php");
    include("includes/func.php");
    user_session_registered("users/dashboard.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">
<link href="images/favicon-32.png" rel="icon" />
<title>ChasetellerBank - Password Reset</title>
<meta name="description" content="ChasetellerBank is a banking platform for payment and receiving of money worldwide.">
<meta name="author" content="Aleph-Null">

<!-- Web Fonts
============================================= -->
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Rubik:300,300i,400,400i,500,500i,700,700i,900,900i' type='text/css'>

<!-- Stylesheet
============================================= -->
<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="vendor/font-awesome/css/all.min.css" />
<link rel="stylesheet" type="text/css" href="vendor/owl.carousel/assets/owl.carousel.min.css" />
<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css" />
<link rel="stylesheet" type="text/css" href="css/stylesheet.css" />

<style type="text/css">
    @media (max-width: 768px) {
        .clifftop-logo { 
            width: 130px; 
        }
    }
</style>
</head>
<body>

<!-- Preloader -->
<div id="preloader">
  <div data-loader="dual-ring"></div>
</div>
<!-- Preloader End --> 

<!-- Document Wrapper   
============================================= -->
<div id="main-wrapper"> 
  
   <!-- Header
  ============================================= -->
  <header id="header">
    <div class="container">
      <div class="header-row">
        <div class="header-column justify-content-start"> 
          <!-- Logo
          ============================= -->
          <div class="logo"> 
            <a class="d-flex" href="index.php" title="ChasetellerBank - Online Banking">
              <img src="images/cliff-logo.png" alt="ChasetellerBank" class="clifftop-logo" />
            </a> 
          </div>
          <!-- Logo end --> 

          <!-- Collapse Button
          ============================== -->
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#header-nav"> 
            <span></span> <span></span> <span></span> 
          </button>
          <!-- Collapse Button end --> 
          
          <!-- Primary Navigation
          ============================== -->
          <nav class="primary-menu navbar navbar-expand-lg">
            <div id="header-nav" class="collapse navbar-collapse">
              <ul class="navbar-nav mr-auto">
                <li><a href="index.php">Home</a></li>
                <li><a href="send-money.php">Send</a></li>
                <li><a href="receive-money.php">Receive</a></li>
                <li><a href="about-us.php">About Us</a></li>
                <li><a href="fees.php">Fees</a></li>
                <li><a href="help.php">Help</a></li>
                <li><a href="contact-us.php">Contact Us</a></li>
              </ul>
            </div>
          </nav>
          <!-- Primary Navigation end --> 
        </div>
        <div class="header-column justify-content-end"> 
          <!-- Login & Signup Link
          ============================== -->
          <nav class="login-signup navbar navbar-expand">
            <ul class="navbar-nav">
              <li><a href="login.php"><b>Login</b></a></li>
              <li class="align-items-center h-auto ml-sm-3"><a class="btn btn-outline-primary d-sm-block" href="signup.php">Sign Up</a></li>
            </ul>
          </nav>
          <!-- Login & Signup Link end --> 
        </div>
      </div>
    </div>
  </header>
  <!-- Header End --> 
    
  <!-- Content
  ============================================= -->
  <div id="content">
  <div class="login-signup-page mx-auto my-5">
      <h3 class="font-weight-400 text-center">Reset Password</h3>
      <p class="lead text-center">Please reset your password now as this link will expire in 24 hours.</p>
      <div class="bg-light shadow-md rounded p-4 mx-2">
      <?php 
          if (isset($_GET["key"]) && isset($_GET["email"]) && isset($_GET["action"]) && isset($_GET["action"] == "reset"))  
          {
              $key = $_GET["key"];
              $email = $_GET["email"];
              $curr_date = date("Y-m-d H:i:s");

              $query = mysqli_query($link, "SELECT * FROM `password_reset` WHERE `token`='$key' AND `email`='$email'");

              if (mysqli_num_rows($query) == 0) {
                  $_SESSION["failure"] = "Invalid link. The link is invalid/expired. Either you did not copy the correct from the email, or you have already used the key in which case it is deactivated.";
              } else {
                  $row = mysqli_fetch_assoc($query);
                  $exp_date = $row["exp_date"];

                  if ($exp_date >= $curr_date) {
              }
              $email = mysqli_real_escape_string($link, $_POST["email"]);

              if (!val_email($email)) {
      ?>
      <form id="loginForm" action="" method="post" name="update">
          <input type="hidden" name="action" value="update">
          <div class="form-group mb-5">
            <label for="new_password">Enter New Password</label>
            <input type="password" class="form-control" id="new_password" name="new_password" required placeholder="Enter Your New Password">
          </div>
          <div class="form-group mb-5">
            <label for="conf_password">Re-enter New Password</label>
            <input type="password" class="form-control" id="conf_password" name="conf_password" required placeholder="Re-Enter Your New Password">
          </div>
          <input type="hidden" name="email" value="<?php echo $email; ?>">
          <button class="btn btn-primary btn-block my-4" type="submit" >Reset Password</button>
      </form>
      <?php 
              } else {
                  $_SESSION["failure"] = "Link expired. You are trying to use the expired link which is only valid for 24 hours.";
              }
          }

          if (isset($_POST["email"]) && isset($_POST["action"]) && (isset($_POST["action"]) == "update")) 
          {
              $new_password = mysqli_real_escape_string($link, $_POST["new_password"]);
              $conf_password = mysqli_real_escape_string($link, $_POST["conf_password"]);
              $email = $_POST["email"];
              $curr_date = date("Y-m-d H:i:s");

              if (!compare($new_password, $conf_password)) {
                  $_SESSION["error"] = "Password fields do not match. Both password should be the same.";
              } 
              else {
                  mysqli_query($link, "UPDATE `users` SET `password`='$new_password', `updated_at`='$curr_date' WHERE `email`='$email'");
                  mysqli_query($link, "DELETE FROM `password_reset` WHERE `email`='$email'");
                  $_SESSION["successful"] = "Congratulations! Your password has been reseted successfully";
                  relocate_url("login.php"); 
              }
          }
      ?>
    </div>
  </div>
  <!-- Content end -->
  
   <!-- Footer
  ============================================= -->
  <footer id="footer">
    <div class="container">
      <div class="row">
        <div class="col-lg d-lg-flex align-items-center">
          <ul class="nav justify-content-center justify-content-lg-start text-3">
            <li class="nav-item"> <a class="nav-link" href="about-us.php">About Us</a></li>
            <li class="nav-item"> <a class="nav-link" href="help.php">Help</a></li>
            <li class="nav-item"> <a class="nav-link" href="fees.php">Fees</a></li>
            <li class="nav-item"> <a class="nav-link" href="contact-us.php">Contact Us</a></li>
          </ul>
        </div>
        <div class="col-lg d-lg-flex justify-content-lg-end mt-3 mt-lg-0">
          <ul class="social-icons justify-content-center">
            <li class="social-icons-facebook"><a data-toggle="tooltip" href="http://www.facebook.com/" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
            <li class="social-icons-twitter"><a data-toggle="tooltip" href="http://www.twitter.com/" target="_blank" title="Twitter"><i class="fab fa-twitter"></i></a></li>
            <li class="social-icons-google"><a data-toggle="tooltip" href="http://www.google.com/" target="_blank" title="Google"><i class="fab fa-google"></i></a></li>
            <li class="social-icons-youtube"><a data-toggle="tooltip" href="http://www.youtube.com/" target="_blank" title="Youtube"><i class="fab fa-youtube"></i></a></li>
          </ul>
        </div>
      </div>
      <div class="footer-copyright pt-3 pt-lg-2 mt-2">
        <div class="row">
          <div class="col-lg">
            <p class="text-center text-lg-left mb-2 mb-lg-0">Copyright &copy; <script>document.write(new Date().getFullYear());</script> <a href="#">ChasetellerBank</a>. All Rights Reserved.</p>
          </div>
          <div class="col-lg d-lg-flex align-items-center justify-content-lg-end">
            <ul class="nav justify-content-center">
              <li class="nav-item"> <a class="nav-link active" href="#">Security</a></li>
              <li class="nav-item"> <a class="nav-link" href="#">Terms</a></li>
              <li class="nav-item"> <a class="nav-link" href="#">Privacy</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- Footer end --> 
  
</div>
<!-- Document Wrapper end --> 

<!-- Back to Top
============================================= --> 
<a id="back-to-top" data-toggle="tooltip" title="Back to Top" href="javascript:void(0)"><i class="fa fa-chevron-up"></i></a> 

<!-- Video Modal
============================================= -->
<div class="modal fade" id="videoModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content bg-transparent border-0">
      <button type="button" class="close text-white opacity-10 ml-auto mr-n3 font-weight-400" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <div class="modal-body p-0">
        <div class="embed-responsive embed-responsive-16by9">
          <iframe class="embed-responsive-item" id="video" allow="autoplay"></iframe>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Video Modal end --> 

<!-- Script --> 
<script src="vendor/jquery/jquery.min.js"></script> 
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script> 
<script src="vendor/owl.carousel/owl.carousel.min.js"></script> 
<script src="js/theme.js"></script>
</body>
</html>