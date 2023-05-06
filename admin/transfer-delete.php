<?php
    session_start();
    include("../includes/config.php");
    include("../includes/conn.php");
    include("../includes/func.php");
    admin_session_expired("login.php");

    if (isset($_GET['transId'])) 
    {
        $transId = $_GET['transId'];

        $delete_transfer = "DELETE FROM `transfers` WHERE `id`='$transId'";
        $execute_transfer =  mysqli_query($link, $delete_transfer);

        if ($execute_transfer) {
            $_SESSION['success'] = "Transfer record was deleted successfully.";
            relocate_url("transfers.php");
        } 
        else {
            $_SESSION['error'] = "Unable to delete transfer record.";
            relocate_url("transfers.php");
        }
    }
?>