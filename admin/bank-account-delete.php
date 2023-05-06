<?php
    session_start();
    include("../includes/config.php");
    include("../includes/conn.php");
    include("../includes/func.php");
    admin_session_expired("login.php");

    if (isset($_GET['baId'])) 
    {
        $baId = $_GET['baId'];

        $delete_account = "DELETE FROM `bank_accounts` WHERE `id`='$baId'";
        $execute_account =  mysqli_query($link, $delete_account);

        if ($execute_account) {
            $_SESSION['success'] = "Bank account was deleted successfully.";
            relocate_url("bank-accounts.php");
        } 
        else {
            $_SESSION['error'] = "Unable to delete bank account.";
            relocate_url("bank-accounts.php");
        }
    }
?>