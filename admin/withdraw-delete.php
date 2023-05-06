<?php
    session_start();
    include("../includes/config.php");
    include("../includes/conn.php");
    include("../includes/func.php");
    admin_session_expired("login.php");

    if (isset($_GET['wId'])) 
    {
        $wId = $_GET['wId'];

        $delete_withdraw = "DELETE FROM `withdraws` WHERE `id`='$wId'";
        $execute_withdraw =  mysqli_query($link, $delete_withdraw);

        if ($execute_withdraw) {
            $_SESSION['success'] = "Withdraw record was deleted successfully.";
            relocate_url("withdraws.php");
        } 
        else {
            $_SESSION['error'] = "Unable to delete withdraw record.";
            relocate_url("withdraws.php");
        }
    }
?>