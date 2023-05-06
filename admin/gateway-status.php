<?php
    session_start();
    include("../includes/config.php");
    include("../includes/conn.php");
    include("../includes/func.php");
    admin_session_expired("login.php");

    if (isset($_GET['enId'])) 
    {
        $id = $_GET['enId'];
        $status = "active";
        
        $update_gateway = "UPDATE `gateways` SET `status`='$status' WHERE `id`='$id'";
        $execute_gateway = mysqli_query($link, $update_gateway);

        if ($execute_gateway) {
            $_SESSION['success'] = "Payment gateway enabled successfully."; 
            relocate_url("gateways.php"); 
        } 
        else {
            $_SESSION['error'] = "Unable to enable payment gateway.";
            relocate_url("gateways.php");  
        }
    }

    if (isset($_GET['disId'])) 
    {
        $id = $_GET['disId'];
        $status = "disabled";
        
        $update_gateway = "UPDATE `gateways` SET `status`='$status' WHERE `id`='$id'";
        $execute_gateway = mysqli_query($link, $update_gateway);

        if ($execute_gateway) {
            $_SESSION['success'] = "Payment gateway disabled successfully."; 
            relocate_url("gateways.php"); 
        } 
        else {
            $_SESSION['error'] = "Unable to disable payment gateway.";
            relocate_url("gateways.php");  
        }
    }
?>