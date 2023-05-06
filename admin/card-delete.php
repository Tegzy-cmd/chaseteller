<?php
    session_start();
    include("../includes/config.php");
    include("../includes/conn.php");
    include("../includes/func.php");
    admin_session_expired("login.php");

    if (isset($_GET['cId'])) 
    {
        $cId = $_GET['cId'];

        $delete_card = "DELETE FROM `cards` WHERE `id`='$cId'";
        $execute_card =  mysqli_query($link, $delete_card);

        if ($execute_card) {
            $_SESSION['success'] = "Card was deleted successfully.";
            relocate_url("cards.php");
        } 
        else {
            $_SESSION['error'] = "Unable to delete card.";
            relocate_url("cards.php");
        }
    }
?>