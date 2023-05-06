<?php
	include(__DIR__ . "/config.php");

    $link = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

    if ($link === false) {
        echo "Failed to connect to MySQL: " . mysqli_connect_errno();
    } else {
        echo "";
    }
?>