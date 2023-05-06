<?php
    session_start();
    include("../includes/config.php");
    include("../includes/conn.php");
    include("../includes/func.php");
    admin_session_expired("login.php");

    if (isset($_GET['tId'])) {
        $tId = $_GET['tId'];

        $delete_transaction = "DELETE FROM `transactions` WHERE `id`='$tId'";
        $execute_transaction =  mysqli_query($link, $delete_transaction);

        if ($execute_transaction) {
            $_SESSION['success'] = "Transaction log was deleted successfully.";
            relocate_url("transaction-log.php");
        } 
        else {
            $_SESSION['error'] = "Unable to delete transaction log.";
            relocate_url("transaction-log.php");
        }
    }
?>