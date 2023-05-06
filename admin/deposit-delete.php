<?php
    session_start();
    include("../includes/config.php");
    include("../includes/conn.php");
    include("../includes/func.php");
    admin_session_expired("login.php");

    if (isset($_GET['dId'])) 
    {
        $dId = $_GET['dId'];

        $delete_deposit = "DELETE FROM `deposits` WHERE `id`='$dId'";
        $execute_deposit =  mysqli_query($link, $delete_deposit);

        if ($execute_deposit) {
            $_SESSION['success'] = "Deposit record was deleted successfully.";
            relocate_url("deposits.php");
        } 
        else {
            $_SESSION['error'] = "Unable to delete deposit record.";
            relocate_url("deposits.php");
        }
    }
?>