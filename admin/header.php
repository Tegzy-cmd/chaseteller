<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="A Reliable and efficient online banking admin platform.">
    <meta name="keywords" content="banking, online banking, internet banking, admin panel, money transfer">
    <meta name="author" content="Aleph-Null">
    <title><?php site_title(); ?></title>
    <link rel="apple-touch-icon" href="app-assets/images/ico/apple-120.png">
    <link rel="shortcut icon" type="image/png" href="app-assets/images/ico/favicon-32.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/charts/apexcharts.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/tables/datatable/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/forms/selects/select2.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/bootstrap-extended.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/colors.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/components.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/plugins/forms/wizard.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/core/menu/menu-types/vertical-menu-modern.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/core/colors/palette-gradient.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/fonts/simple-line-icons/style.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/pages/card-statistics.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/pages/vertical-timeline.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/fonts/font-awesome/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <style type="text/css">
        .action-icon { font-size: 20px; }
        .reason-icon { font-size: 18px; }
        .underline { text-decoration: underline; }
        .text-right { text-align: right; }
        .text-left { text-align: left; }
        .text-center { text-align: center; }
        .bold { font-weight: bold; }
        .uppercase { text-transform: uppercase; }
        .fs-info { font-size: 15px; }
        .mb-10 { margin-bottom: 7rem; }
        @media (max-width: 767px) {
            .table-responsive .dropdown { 
                position: static !important; 
            }
        }
        @media (min-width: 768px) {
            .table-responsive { 
                overflow-y: visible; 
            }
            .dropdown .dropdown-menu .dropdown-item { 
                z-index: 99999; 
            }
        }
    </style>
</head>
<body class="vertical-layout vertical-menu-modern 2-columns fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
    <nav class="header-navbar navbar-expand-lg navbar navbar-with-menu fixed-top navbar-dark navbar-shadow">
        <div class="navbar-wrapper">
            <div class="navbar-header">
                <ul class="nav navbar-nav flex-row">
                    <li class="nav-item mobile-menu d-lg-none mr-auto">
                        <a href="#" class="nav-link nav-menu-main menu-toggle hidden-xs">
                            <i class="fa fa-bars font-large-1"></i>
                        </a>
                    </li>
                    <li class="nav-item mr-auto">
                        <a class="navbar-brand" href="index.php">
                            <!-- <img src="app-assets/images/logo/logo1.png" alt="CliffTop admin logo" class="brand-logo" height="35"> -->
                        </a>
                    </li>
                    <li class="nav-item d-none d-lg-block nav-toggle">
                        <a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse">
                            <i class="fa fa-angle-double-left font-medium-3 white" data-ticon="feather.icon-toggle-right"></i>
                        </a>
                    </li>
                    <li class="nav-item d-lg-none">
                        <a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile">
                            <i class="fa fa-ellipsis-v"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="navbar-container content">
                <div class="collapse navbar-collapse" id="navbar-mobile">
                    <ul class="nav navbar-nav mr-auto float-left">
                        <li class="nav-item d-none d-md-block">
                            <a class="nav-link nav-link-expand" href="#">
                                <i class="fa fa-arrows-alt"></i>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav float-right">
                        <li class="dropdown dropdown-user nav-item">
                            <?php
                                $admin_id = $_SESSION["admin_id"];
                                $admin = mysqli_fetch_array(mysqli_query($link, "SELECT * FROM `admins` WHERE `id`='$admin_id'"));
                            ?>
                            <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                                <div class="avatar avatar-online">
                                    <img src="../uploads/admin-avatar/<?php echo $admin['image'] ; ?>" alt="avatar"><i></i>
                                </div>
                                <span><?php echo ucwords($admin["firstname"]." ".$admin["lastname"]); ?></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="profile-settings.php"><i class="fas fa-user-cog"></i> Edit Profile</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php"><i class="fas fa-power-off"></i> Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class=" navigation-header"></li>
                <li <?php set_navlink_active('dashboard'); ?>>
                    <a href="index.php">
                        <i class="fa fa-tachometer-alt"></i>
                        <span class="menu-title" data-i18n="Dashboard">Dashboard</span>
                    </a>
                </li>
                <li <?php set_navlink_active('user_list'); ?>>
                    <a href="users.php">
                        <i class="fa fa-users"></i>
                        <span class="menu-title" data-i18n="Users">Users</span>
                    </a>
                </li>
                <li <?php set_navlink_active('deposits'); ?>>
                    <a href="deposits.php">
                        <i class="fa fa-wallet"></i>
                        <span class="menu-title" data-i18n="Deposits">Deposits</span>
                    </a>
                </li>
                <li <?php set_navlink_active('transfers'); ?>>
                    <a href="transfers.php">
                        <i class="far fa-paper-plane"></i>
                        <span class="menu-title" data-i18n="Transfers">Transfers</span>
                    </a>
                </li>
                <li <?php set_navlink_active('withdraws'); ?>>
                    <a href="withdraws.php">
                        <i class="fa fa-money"></i>
                        <span class="menu-title" data-i18n="Withdraws">Withdraws</span>
                    </a>
                </li>
                <li <?php set_navlink_active('requests'); ?>>
                    <a href="requests.php">
                        <i class="fas fa-piggy-bank"></i>
                        <span class="menu-title" data-i18n="Transfers">Requests</span>
                    </a>
                </li>
                <li <?php set_navlink_active('bank_accounts'); ?>>
                    <a href="bank-accounts.php">
                        <i class="fa fa-university"></i>
                        <span class="menu-title" data-i18n="Banks">Bank Accounts</span>
                    </a>
                </li>
                <li <?php set_navlink_active('cards'); ?>>
                    <a href="cards.php">
                        <i class="fa fa-credit-card"></i>
                        <span class="menu-title" data-i18n="Cards">Cards</span>
                    </a>
                </li>
                <li <?php set_navlink_active('transaction_log'); ?>>
                    <a href="transaction-log.php">
                        <i class="fas fa-receipt"></i>
                        <span class="menu-title" data-i18n="Transaction Log">Transaction Log</span>
                    </a>
                </li>
                <li <?php set_navlink_active('gateways'); ?>>
                    <a href="gateways.php">
                        <i class="fab fa-cc-amazon-pay"></i>
                        <span class="menu-title" data-i18n="Gateways">Payment Gateways</span>
                    </a>
                </li>
                <li <?php set_navlink_active('bank_charges'); ?>>
                    <a href="bank-charges.php">
                        <i class="fas fa-dollar-sign"></i>
                        <span class="menu-title" data-i18n="Bank Charges">Bank Charges</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>