<?php
    session_start();
    include("../includes/config.php");
    include("../includes/conn.php");
    include("../includes/func.php");
    admin_session_expired("login.php");

    if (isset($_GET['banId'])) 
    {
        $id = $_GET['banId'];
        $status = "inactive";
        
        $update_status = "UPDATE `users` SET `status`='$status' WHERE `id`='$id'";
        $execute_status = mysqli_query($link, $update_status);

        if ($execute_status) {
            $_SESSION['success'] = "User account has been deactivated successfully."; 
            relocate_url("users.php"); 
        } else {
            $_SESSION['error'] = "Unable to deactivate user account.";
            relocate_url("users.php");  
        }
    }

    if (isset($_GET['actId'])) 
    {
        $id = $_GET['actId'];
        $status = "active";
        
        $update_status = "UPDATE `users` SET `status`='$status' WHERE `id`='$id'";
        $execute_status = mysqli_query($link, $update_status);

        if ($execute_status) {
            $_SESSION['success'] = "User account has been activated successfully."; 
            relocate_url("users.php"); 
        } else {
            $_SESSION['error'] = "Unable to activate user account.";
            relocate_url("users.php");  
        }
    }
?>