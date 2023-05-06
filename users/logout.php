<?php
    include("../includes/config.php");
    include("../includes/conn.php");
    include("../includes/func.php");

    session_start();
    session_destroy();

    redirect_url("../login.php");
?>