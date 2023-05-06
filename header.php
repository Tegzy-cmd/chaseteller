<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">
<link href="images/favicon-32.png" rel="icon" />
<title>
  <?php 
    if (isset($_SESSION['page_title'])) {
      echo "Bank - " . $_SESSION['page_title'];
    } else {
      echo "Bank"; 
    }
  ?>
</title>
<meta name="description" content="Bank is a banking platform for payment and receiving of money worldwide.">
<meta name="author" content="Aleph-Null">

<!-- Web Fonts
============================================= -->
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Rubik:300,300i,400,400i,500,500i,700,700i,900,900i' type='text/css'>

<!-- Stylesheet
============================================= -->
<!-- <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css" /> -->
<link rel="stylesheet" type="text/css" href="vendor/owl.carousel/assets/owl.carousel.min.css" />
<link rel="stylesheet" type="text/css" href="vendor/font-awesome/css/all.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
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
            <a class="d-flex" href="index.php" title="Bank - Online Banking">
              <img src="images/cliff-logo.png" alt="Bank" class="clifftop-logo" />
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
                <li <?php set_navlink_active('home'); ?>><a href="index.php">Home</a></li>
                <li <?php set_navlink_active('about_us'); ?>><a href="about-us.php">About Us</a></li>
                <li <?php set_navlink_active('help'); ?>><a href="help.php">Help</a></li>
                <li <?php set_navlink_active('contact_us'); ?>><a href="contact-us.php">Contact Us</a></li>
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