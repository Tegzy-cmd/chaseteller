<?php
    session_start();
    include("../includes/config.php");
    include("../includes/conn.php");
    include("../includes/func.php");
    user_session_expired("../login.php");

    if (isset($_GET['bankId'])) {
        $bankId = $_GET['bankId'];

        $delete_account = "DELETE FROM `bank_accounts` WHERE `id`='$bankId'";
        $execute_account =  mysqli_query($link, $delete_account);

        if ($execute_account) {
            $_SESSION['successful'] = "Your bank account has been deleted successfully.";
            relocate_url("profile-cards-and-bank.php");
        } 
        else {
            $_SESSION['failure'] = "Something went wrong, Unable to delete bank account. Please contact CliffTopBank customer care if failure persists.";
            relocate_url("profile-cards-and-bank.php");
        }
    }
?>