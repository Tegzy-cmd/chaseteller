<?php
    session_start();
    include("../includes/config.php");
    include("../includes/conn.php");
    include("../includes/func.php");
    admin_session_expired("login.php");

    if (isset($_GET['actId'])) 
    {
        $id = $_GET['actId'];
        $status = "active";
        
        $update_account = "UPDATE `bank_accounts` SET `status`='$status' WHERE `id`='$id'";
        $execute_account = mysqli_query($link, $update_account);

        if ($execute_account) {
            $_SESSION['success'] = "Bank account is activated successfully."; 
            relocate_url("bank-accounts.php"); 
        } 
        else {
            $_SESSION['error'] = "Unable to activate bank account.";
            relocate_url("bank-accounts.php");  
        }
    }

    if (isset($_GET['disId'])) 
    {
        $id = $_GET['disId'];
        $status = "disabled";
        
        $update_account = "UPDATE `bank_accounts` SET `status`='$status' WHERE `id`='$id'";
        $execute_account = mysqli_query($link, $update_account);

        if ($execute_account) {
            $_SESSION['success'] = "Bank account is disabled successfully."; 
            relocate_url("bank-accounts.php"); 
        } 
        else {
            $_SESSION['error'] = "Unable to disable bank account.";
            relocate_url("bank-accounts.php");  
        }
    }
?>