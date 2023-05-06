<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">
<link href="images/favicon-32.png" rel="icon" />
<title>
  <?php 
    if (isset($_SESSION['dashboard_title'])) {
      echo $_SESSION['dashboard_title'] . " - UBSTransactBank";
    } else {
      echo "UBSTransactBank"; 
    }
  ?>
</title>
<meta name="description" content="UBSTransactBank is a banking platform for payment and receiving of money worldwide.">
<meta name="author" content="Aleph-Null">

<!-- Web Fonts
============================================= -->
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Rubik:300,300i,400,400i,500,500i,700,700i,900,900i' type='text/css'>

<!-- Stylesheet
============================================= -->
<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="vendor/font-awesome/css/all.min.css" />
<link rel="stylesheet" type="text/css" href="vendor/bootstrap-select/css/bootstrap-select.min.css" />
<link rel="stylesheet" type="text/css" href="vendor/currency-flags/css/currency-flags.min.css" />
<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css" />
<link rel="stylesheet" type="text/css" href="css/stylesheet.css" />

<style type="text/css">
   .cliff-logo { 
            width: 130px; 
        }
    @media (max-width: 768px) {
        .cliff-logo { 
            width: 130px; 
        }
        .recent-act {
           overflow-x: scroll;
        }
    }

    .digit-group input {
		width: 50px;
		height: 70px;
		/* background-color: lighten($BaseBG, 5%); */
		border: none;
    /* border-radius: 5px; */
		line-height: 50px;
		text-align: center;
		font-size: 24px;
		font-family: 'Raleway', sans-serif;
		font-weight: 200;
		color: black;
		margin: 0 2px;
	}
  .splitter {
		padding: 0 5px;
		color: white;
		font-size: 24px;
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
            <a class="d-flex" href="dashboard.php" title="UBSTransactBank - Online Banking">
              <img src="../images/logo.png" alt="CliffTop" class="cliff-logo" />
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
                <li <?php set_navlink_active('dashboard'); ?>><a href="dashboard.php">Dashboard</a></li>
                <li <?php set_navlink_active('transfer'); ?>><a href="transfer-money.php">Transfer</a></li>
                <li <?php set_navlink_active('withdraw'); ?>><a href="withdraw-money.php">Withdraw</a></li>
                <li <?php set_navlink_active('deposit'); ?>><a href="deposit-money.php">Deposit</a></li>
                <li <?php set_navlink_active('request'); ?>><a href="request-money.php">Request</a></li>
                <li <?php set_navlink_active('bank_and_card'); ?>><a href="profile-cards-and-bank.php">Bank/Card</a></li>
                <li <?php set_navlink_active('transaction'); ?>><a href="transactions.php">Transactions</a></li>
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
              <li class="align-items-center h-auto ml-sm-3">
                <a class="btn btn-outline-primary shadow-none d-sm-block" href="logout.php">Sign out</a>
              </li>
            </ul>
          </nav>
          <!-- Login & Signup Link end --> 
        </div>
      </div>
    </div>
  </header>
  
  <?php
      $user_id = $_SESSION["user_id"];
      $query = "SELECT * FROM `users` WHERE `id`='$user_id'";
      $user = mysqli_fetch_array(mysqli_query($link, $query));
  ?>
  <!-- Header End -->