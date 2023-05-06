<?php
    session_start();
    include("../includes/config.php");
    include("../includes/conn.php");
    include("../includes/func.php");
    admin_session_registered("index.php");

    if (isset($_POST["login"])) 
    {
        $username = mysqli_real_escape_string($link, $_POST["username"]);
        $password = mysqli_real_escape_string($link, $_POST["password"]);

        if (empty($username) && empty($password)) {
            $_SESSION["feedback"] = "The username and password fields are empty.";
        }
        elseif (empty($username)) {
            $_SESSION["feedback"] = "The username field is empty.";
        }
        elseif (empty($password)) {
            $_SESSION["feedback"] = "The password field is empty.";
        }
        else {
            $find_username = mysqli_query($link, "SELECT * FROM `admins` WHERE `username`='$username'");
            $find_password = mysqli_query($link, "SELECT * FROM `admins` WHERE `password`='$password'");

            if (mysqli_num_rows($find_username) == 0) {
                $_SESSION["feedback"] = "Unknown username. Please check again."; 
            } 
            elseif (mysqli_num_rows($find_password) == 0) {
                $_SESSION["feedback"] = "The password you enter for the username \"" . $username . "\" is incorrect."; 
            } 
            else {
                $admin_id = $admin_password = "";
                while ($row = mysqli_fetch_array($find_username)) {
                    $admin_id = $row["id"];
                    $admin_password = $row["password"];
                }

                if (!empty($_POST["remember_me"])) {
                    setcookie("admin_name", $username, time() + (10 * 365 * 24 * 60 * 60));
                    setcookie("admin_pass", $password, time() + (10 * 365 * 24 * 60 * 60));
                } else {
                    setcookie("admin_name", "");
                    setcookie("admin_pass", "");
                }

                if (compare($password, $admin_password)) {
                    $_SESSION["logged_in"] = TRUE;
                    $_SESSION["admin_id"] = $admin_id;
                    $_SESSION["time_stamped"] = time();
                    redirect_url("index.php"); 
                } 
                else {
                    $_SESSION["feedback"] = "The password you enter for the username \"" . $username . "\" is incorrect.";
                }
            }
        }
    }
?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

    <!-- BEGIN: Head-->
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <meta name="description" content="A Reliable and efficient online banking admin platform.">
        <meta name="keywords" content="banking, online banking, internet banking, admin panel, money transfer">
        <meta name="author" content="Aleph-Null">

        <title>Login - CliffTop Admin</title>

        <link rel="apple-touch-icon" href="app-assets/images/ico/apple-120.png">
        <link rel="shortcut icon" type="image/png" href="app-assets/images/ico/favicon-32.png">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i">

        <!-- BEGIN: Vendor CSS-->
        <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/vendors.min.css">
        <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/forms/icheck/icheck.css">
        <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/forms/icheck/custom.css">
        <!-- END: Vendor CSS-->

        <!-- BEGIN: Theme CSS-->
        <link rel="stylesheet" type="text/css" href="app-assets/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="app-assets/css/bootstrap-extended.min.css">
        <link rel="stylesheet" type="text/css" href="app-assets/css/colors.min.css">
        <link rel="stylesheet" type="text/css" href="app-assets/css/components.min.css">
        <!-- END: Theme CSS-->

        <!-- BEGIN: Page CSS-->
        <link rel="stylesheet" type="text/css" href="app-assets/css/core/menu/menu-types/vertical-menu-modern.css">
        <link rel="stylesheet" type="text/css" href="app-assets/css/core/colors/palette-gradient.min.css">
        <link rel="stylesheet" type="text/css" href="app-assets/css/pages/login-register.min.css">
         <link rel="stylesheet" type="text/css" href="app-assets/fonts/font-awesome/css/all.min.css">
        <!-- END: Page CSS-->

        <!-- BEGIN: Custom CSS-->
        <link rel="stylesheet" type="text/css" href="assets/css/style.css">
        <!-- END: Custom CSS-->

    </head>
    <!-- END: Head-->

    <!-- BEGIN: Body-->
    <body class="vertical-layout vertical-menu-modern 1-column bg-full-screen-image blank-page blank-page" data-open="click" data-menu="vertical-menu-modern" data-col="1-column">
        <!-- BEGIN: Content-->
        <div class="app-content content">
            <div class="content-overlay"></div>

            <div class="content-wrapper">
                <div class="content-header row"></div>

                <div class="content-body">
                    <section class="row flexbox-container">
                        <div class="col-12 d-flex align-items-center justify-content-center">
                            <div class="col-lg-4 col-md-8 col-10 box-shadow-2 p-0">
                                <div class="card border-grey border-lighten-3 px-1 py-1 m-0">
                                    <div class="card-header border-0">
                                        <div class="card-title text-center">
                                            <img src="app-assets/images/logo/logo1.png" alt="branding logo">
                                        </div>
                                    </div>
                                    <div class="card-content">
                                        <p class="card-subtitle line-on-side text-muted text-center font-small-3 mx-2 my-1">
                                            <span>Login To Access CliffTop Admin</span>
                                        </p>
                                        <div class="card-body">

                                            <?php 
                                                echo alert_warning();
                                                echo login_feedback(); 
                                            ?>

                                            <form action="" method="post" class="form-horizontal">
                                                <fieldset class="form-group floating-label-form-group">
                                                    <label for="user-name">Your Username</label>
                                                    <input type="text" class="form-control" id="user-name" placeholder="Your Username" name="username" value="<?php if (isset($_COOKIE['admin_name'])) { echo($_COOKIE['admin_name']); } ?>">
                                                </fieldset>
                                                <fieldset class="form-group floating-label-form-group mb-1">
                                                    <label for="user-password">Enter Password</label>
                                                    <input type="password" class="form-control" id="user-password"
                                                        placeholder="Enter Password" name="password" value="<?php if (isset($_COOKIE['admin_pass'])) { echo($_COOKIE['admin_pass']); } ?>">
                                                </fieldset>
                                                <div class="form-group row">
                                                    <div class="col-sm-6 col-12 text-center text-sm-left pr-0">
                                                        <fieldset>
                                                            <input type="checkbox" id="remember-me" class="chk-remember" name="remember_me" <?php if (isset($_COOKIE['admin_name']) || isset($_COOKIE['admin_pass'])) { echo("checked"); } ?>>
                                                            <label for="remember-me"> Remember Me</label>
                                                        </fieldset>
                                                    </div>                                                
                                                </div>
                                                <button type="submit" class="btn btn-primary btn-block" name="login">
                                                    Login
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
        <!-- END: Content-->

        <!-- BEGIN: Vendor JS-->
        <script src="app-assets/vendors/js/vendors.min.js"></script>
        <!-- BEGIN Vendor JS-->

        <!-- BEGIN: Page Vendor JS-->
        <script src="app-assets/vendors/js/forms/validation/jqBootstrapValidation.js"></script>
        <script src="app-assets/vendors/js/forms/icheck/icheck.min.js"></script>
        <!-- END: Page Vendor JS-->

        <!-- BEGIN: Theme JS-->
        <script src="app-assets/js/core/app-menu.min.js"></script>
        <script src="app-assets/js/core/app.min.js"></script>
        <!-- END: Theme JS-->

        <!-- BEGIN: Page JS-->
        <script src="app-assets/js/scripts/forms/form-login-register.min.js"></script>
        <!-- END: Page JS-->
    </body>
    <!-- END: Body-->
</html>