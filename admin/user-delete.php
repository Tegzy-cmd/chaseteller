<?php
    session_start();
    include("../includes/config.php");
    include("../includes/conn.php");
    include("../includes/func.php");
    admin_session_expired("login.php");

    if (isset($_GET['uid'])) 
    {
        $uid = $_GET['uid'];

        $delete_user = "DELETE FROM `users` WHERE `id`='$uid'";
        $execute_user =  mysqli_query($link, $delete_user);

        if ($execute_user) {
            $_SESSION['success'] = "User account was deleted successfully.";
            relocate_url("users.php");
        } else {
            $_SESSION['error'] = "Unable to delete user account.";
            relocate_url("users.php");
        }
    }
?>