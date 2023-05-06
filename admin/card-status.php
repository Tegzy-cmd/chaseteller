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
        
        $update_card = "UPDATE `cards` SET `status`='$status' WHERE `id`='$id'";
        $execute_card = mysqli_query($link, $update_card);

        if ($execute_card) {
            $_SESSION['success'] = "Card is activated successfully."; 
            relocate_url("cards.php"); 
        } 
        else {
            $_SESSION['error'] = "Unable to activate card.";
            relocate_url("cards.php");  
        }
    }

    if (isset($_GET['disId'])) 
    {
        $id = $_GET['disId'];
        $status = "disabled";
        
        $update_card = "UPDATE `cards` SET `status`='$status' WHERE `id`='$id'";
        $execute_card = mysqli_query($link, $update_card);

        if ($execute_card) {
            $_SESSION['success'] = "Card is disabled successfully."; 
            relocate_url("cards.php"); 
        } 
        else {
            $_SESSION['error'] = "Unable to disable card.";
            relocate_url("cards.php");  
        }
    }
?>