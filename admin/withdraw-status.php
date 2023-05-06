<?php
    session_start();
    include("../includes/config.php");
    include("../includes/conn.php");
    include("../includes/func.php");
    admin_session_expired("login.php");

    if (isset($_GET['appId'])) 
    {
        $id = $_GET['appId'];
        $status = "approved";

        $select_trnxId = "SELECT `trnx_id`, `user_id`, `amount`  FROM `withdraws` WHERE `id`='$id'";
        $row = mysqli_fetch_array(mysqli_query($link, $select_trnxId));
        $trnx_id = $row["trnx_id"];

        $select_userId = "SELECT `balance` FROM `users` WHERE `id`='".$row["user_id"]."'";
        $user_row = mysqli_fetch_array(mysqli_query($link, $select_userId));

        if ($row["amount"] > $user_row["balance"]) {
            $_SESSION["error"] = "Cannot approve withdrawal amount is bigger than user balance.";
            relocate_url("withdraws.php"); 
        } 
        $balance = $user_row["balance"] - $row["amount"];

        $update_balance = "UPDATE `users` SET `balance`='$balance' WHERE `id`='".$row["user_id"]."'";
        $execute_balance = mysqli_query($link, $update_balance);
        
        $update_withdraw = "UPDATE `withdraws` SET `status`='$status', `after_balance`='$balance' WHERE `id`='$id'";
        $execute_withdraw = mysqli_query($link, $update_withdraw);
        
        $update_transaction = "UPDATE `transactions` SET `status`='$status', `after_balance`='$balance' WHERE `trnx_id`='$trnx_id'";
        $execute_transaction = mysqli_query($link, $update_transaction);

        if ($execute_withdraw && $execute_balance && $execute_transaction) {
            $_SESSION['success'] = "Withdraw has been approved successfully."; 
            relocate_url("withdraws.php"); 
        } 
        else {
            $_SESSION['error'] = "Unable to approve withdraw.";
            relocate_url("withdraws.php");  
        }
    }

    if (isset($_GET['rejId'])) 
    {
        $id = $_GET['rejId'];
        $status = "rejected";
        
        $select_trnxId = "SELECT * FROM `withdraws` WHERE `id`='$id'";
        $row = mysqli_fetch_array(mysqli_query($link, $select_trnxId));
        $trnx_id = $row["trnx_id"];

        $select_userId = "SELECT `balance` FROM `users` WHERE `id`='".$row["user_id"]."'";
        $user_row = mysqli_fetch_array(mysqli_query($link, $select_userId));

        if ($row["status"] == "pending") { $balance = 0; } 
        else { $balance = $user_row["balance"] + $row["amount"]; }

        //$update_balance = "UPDATE `users` SET `balance`='$balance' WHERE `id`='".$row["user_id"]."'";
        //$execute_balance = mysqli_query($link, $update_balance);
        
        $update_withdraw = "UPDATE `withdraws` SET `status`='$status' WHERE `id`='$id'";
        $execute_withdraw = mysqli_query($link, $update_withdraw);
        
        $update_transaction = "UPDATE `transactions` SET `status`='$status' WHERE `trnx_id`='$trnx_id'";
        $execute_transaction = mysqli_query($link, $update_transaction);

        if ($execute_withdraw && $execute_transaction) {
            $_SESSION['success'] = "Withdraw has been rejected successfully."; 
            relocate_url("withdraws.php"); 
        } 
        else {
            $_SESSION['error'] = "Unable to reject withdraw.";
            relocate_url("withdraws.php");  
        }
    }
?>