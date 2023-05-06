<?php
    session_start();
    include("../includes/config.php");
    include("../includes/conn.php");
    include("../includes/func.php");
    admin_session_expired("login.php");

    if (isset($_GET['rId'])) 
    {
        $rId = $_GET['rId'];

        $delete_request = "DELETE FROM `requests` WHERE `id`='$rId'";
        $execute_request =  mysqli_query($link, $delete_request);

        if ($execute_request) {
            $_SESSION['success'] = "Request record was deleted successfully.";
            relocate_url("requests.php");
        } 
        else {
            $_SESSION['error'] = "Unable to delete request record.";
            relocate_url("requests.php");
        }
    }
?>