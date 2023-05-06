<?php
    session_start();
    include("../includes/config.php");
    include("../includes/conn.php");
    include("../includes/func.php");
    user_session_expired("../login.php");

    if (isset($_GET['cardId'])) {
        $cardId = $_GET['cardId'];

        $delete_card = "DELETE FROM `cards` WHERE `id`='$cardId'";
        $execute_card =  mysqli_query($link, $delete_card);

        if ($execute_card) {
            $_SESSION['successful'] = "Your card has been deleted successfully.";
            relocate_url("profile-cards-and-bank.php");
        } 
        else {
            $_SESSION['failure'] = "Something went wrong, Unable to delete card. Please contact CliffTopBank customer care if failure persists.";
            relocate_url("profile-cards-and-bank.php");
        }
    }
?>