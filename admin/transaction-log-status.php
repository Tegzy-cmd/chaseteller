<?php
    session_start();
    include("../includes/config.php");
    include("../includes/conn.php");
    include("../includes/func.php");
    admin_session_expired("login.php");

    if (isset($_GET['appId'])) 
    {
        $id = $_GET['appId'];
        $status = "approved";
        
        $update_transaction = "UPDATE `transactions` SET `status`='$status' WHERE `id`='$id'";
        $execute_transaction = mysqli_query($link, $update_transaction);

        if ($execute_transaction) {
            $_SESSION['success'] = "Transaction has been approved successfully."; 
            relocate_url("transaction-log.php"); 
        } 
        else {
            $_SESSION['error'] = "Unable to approve transaction.";
            relocate_url("transaction-log.php");  
        }
    }

    if (isset($_GET['rejId'])) 
    {
        $id = $_GET['rejId'];
        $status = "rejected";
        
        $update_transaction = "UPDATE `transactions` SET `status`='$status' WHERE `id`='$id'";
        $execute_transaction = mysqli_query($link, $update_transaction);

        if ($execute_transaction) {
            $_SESSION['success'] = "Transaction has been rejected successfully."; 
            relocate_url("transaction-log.php"); 
        } 
        else {
            $_SESSION['error'] = "Unable to reject transaction.";
            relocate_url("transaction-log.php");  
        }
    }
?>