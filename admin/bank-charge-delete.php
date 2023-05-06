<?php
    session_start();
    include("../includes/config.php");
    include("../includes/conn.php");
    include("../includes/func.php");
    admin_session_expired("login.php");

    if (isset($_GET['bcId'])) 
    {
        $bcId = $_GET['bcId'];

        $delete_bank_charge = "DELETE FROM `transaction_fee` WHERE `id`='$bcId'";
        $execute_bank_charge =  mysqli_query($link, $delete_bank_charge);

        if ($execute_bank_charge) {
            $_SESSION['success'] = "Bank charge was deleted successfully.";
            relocate_url("bank-charges.php");
        } 
        else {
            $_SESSION['error'] = "Unable to delete bank charge.";
            relocate_url("bank-charges.php");
        }
    }
?>