<?php
    session_start();
    include("../includes/config.php");
    include("../includes/conn.php");
    include("../includes/func.php");
    admin_session_expired("login.php");

    if (isset($_GET['gId'])) 
    {
        $gId = $_GET['gId'];

        $delete_gateway = "DELETE FROM `gateways` WHERE `id`='$gId'";
        $execute_gateway =  mysqli_query($link, $delete_gateway);

        if ($execute_gateway) {
            $_SESSION['success'] = "Payment gateway was deleted successfully.";
            relocate_url("gateways.php");
        } 
        else {
            $_SESSION['error'] = "Unable to delete payment gateway.";
            relocate_url("gateways.php");
        }
    }
?>