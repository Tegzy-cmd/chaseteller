<?php 
    session_start();
    include("../includes/config.php");
    include("../includes/conn.php");
    include("../includes/func.php");
    admin_session_expired("login.php");
    set_headers("Edit Transaction", "transaction_log");
    include("header.php");

    if (isset($_GET["tId"])) {
        $transaction = mysqli_fetch_array(mysqli_query($link, "SELECT * FROM `transactions` WHERE `id`='".$_GET["tId"]."'"));
        $tl_id = $transaction['id'];
        $tl_user_id = $transaction['user_id'];
        $tl_trnx_id = $transaction['trnx_id'];
        $tl_amount = $transaction['amount'];
        $tl_currency = $transaction['currency'];
        $tl_type = $transaction['type'];
        $tl_description = $transaction['description'];
        $tl_after_balance = $transaction['after_balance'];
        $tl_status = $transaction['status'];
        $tl_created_at = $transaction['created_at'];
    }
?>
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-12 col-12 mb-2">
                <h3 class="content-header-title mb-0">Edit Transaction [TRNX ID: <b><?php echo $tl_trnx_id; ?></b>]</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12 mb-2">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="transaction-log.php">Transactions</a></li>
                            <li class="breadcrumb-item active">Edit Transaction</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <?php
            echo alert_ok();
            echo alert_error();
        ?>
        <div class="content-body">
            <section id="basic-form-layouts">
                <div class="row match-height">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-content mt-3">
                                <div class="card-body">
                                    <form action="" method="post" class="form form-horizontal">
                                        <div class="form-body">
                                            <input type="hidden" id="id" class="form-control" name="id" value="<?php echo $tl_id; ?>">
                                            <input type="hidden" id="trnx_id" class="form-control" name="trnx_id" value="<?php echo $tl_trnx_id; ?>">
                                            <div class="form-group row">
                                                <label for="user" class="col-md-3 label-control">User</label>
                                                <div class="col-md-9">
                                                    <select name="user" id="user" class="select2 form-control" required>
                                                        <?php
                                                            $customer = mysqli_query($link, "SELECT `id`, CONCAT(`firstname`, ' ', `lastname`) AS `name` FROM `users` WHERE `status`='active'");
                                                            while($data = mysqli_fetch_array($customer)) {
                                                                if ($data['id'] == $d_user_id) { echo "<option value='".$data['id']."' selected>".ucwords($data['name'])."</option>"; }
                                                                else { echo "<option value='".$data['id']."'>".ucwords($data['name'])."</option>"; }
                                                            } 
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="amount" class="col-md-3 label-control">Amount</label>
                                                <div class="col-md-9">
                                                    <div class="input-group mt-0">
                                                        <input type="number" class="form-control" name="amount" value="<?php echo $tl_amount; ?>" required>
                                                        <div class="input-group-append"><span class="input-group-text">.00</span></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="currency" class="col-md-3 label-control">Currency</label>
                                                <div class="col-md-9">
                                                    <select id="currency" name="currency" class="select2 form-control" required>
                                                        <option <?php if ($tl_currency == "aed") { echo "selected"; } ?> value="aed">AED</option>
                                                        <option <?php if ($tl_currency == "ars") { echo "selected"; } ?> value="ars">ARS</option>
                                                        <option <?php if ($tl_currency == "aud") { echo "selected"; } ?> value="aud">AUD</option>
                                                        <option <?php if ($tl_currency == "bdt") { echo "selected"; } ?> value="bdt">BDT</option>
                                                        <option <?php if ($tl_currency == "bgn") { echo "selected"; } ?> value="bgn">BGN</option>
                                                        <option <?php if ($tl_currency == "brl") { echo "selected"; } ?> value="brl">BRL</option>
                                                        <option <?php if ($tl_currency == "cad") { echo "selected"; } ?> value="cad">CAD</option>
                                                        <option <?php if ($tl_currency == "chf") { echo "selected"; } ?> value="chf">CHF</option>
                                                        <option <?php if ($tl_currency == "clp") { echo "selected"; } ?> value="clp">CLP</option>
                                                        <option <?php if ($tl_currency == "cny") { echo "selected"; } ?> value="cny">CNY</option>
                                                        <option <?php if ($tl_currency == "czk") { echo "selected"; } ?> value="czk">CZK</option>
                                                        <option <?php if ($tl_currency == "dkk") { echo "selected"; } ?> value="dkk">DKK</option>
                                                        <option <?php if ($tl_currency == "egp") { echo "selected"; } ?> value="egp">EGP</option>
                                                        <option <?php if ($tl_currency == "eur") { echo "selected"; } ?> value="eur">EUR</option>
                                                        <option <?php if ($tl_currency == "gbp") { echo "selected"; } ?> value="gbp">GBP</option>
                                                        <option <?php if ($tl_currency == "gel") { echo "selected"; } ?> value="gel">GEL</option>
                                                        <option <?php if ($tl_currency == "ghs") { echo "selected"; } ?> value="ghs">GHS</option>
                                                        <option <?php if ($tl_currency == "hkd") { echo "selected"; } ?> value="hkd">HKD</option>
                                                        <option <?php if ($tl_currency == "hrk") { echo "selected"; } ?> value="hrk">HRK</option>
                                                        <option <?php if ($tl_currency == "huf") { echo "selected"; } ?> value="huf">HUF</option>
                                                        <option <?php if ($tl_currency == "idr") { echo "selected"; } ?> value="idr">IDR</option>
                                                        <option <?php if ($tl_currency == "ils") { echo "selected"; } ?> value="ils">ILS</option>
                                                        <option <?php if ($tl_currency == "inr") { echo "selected"; } ?> value="inr">INR</option>
                                                        <option <?php if ($tl_currency == "jpy") { echo "selected"; } ?> value="jpy">JPY</option>
                                                        <option <?php if ($tl_currency == "kes") { echo "selected"; } ?> value="kes">KES</option>
                                                        <option <?php if ($tl_currency == "krw") { echo "selected"; } ?> value="krw">KRW</option>
                                                        <option <?php if ($tl_currency == "lkr") { echo "selected"; } ?> value="lkr">LKR</option>
                                                        <option <?php if ($tl_currency == "mad") { echo "selected"; } ?> value="mad">MAD</option>
                                                        <option <?php if ($tl_currency == "mxn") { echo "selected"; } ?> value="mxn">MXN</option>
                                                        <option <?php if ($tl_currency == "myr") { echo "selected"; } ?> value="myr">MYR</option>
                                                        <option <?php if ($tl_currency == "ngn") { echo "selected"; } ?> value="ngn">NGN</option>
                                                        <option <?php if ($tl_currency == "nok") { echo "selected"; } ?> value="nok">NOK</option>
                                                        <option <?php if ($tl_currency == "npr") { echo "selected"; } ?> value="npr">NPR</option>
                                                        <option <?php if ($tl_currency == "nzd") { echo "selected"; } ?> value="nzd">NZD</option>
                                                        <option <?php if ($tl_currency == "pen") { echo "selected"; } ?> value="pen">PEN</option>
                                                        <option <?php if ($tl_currency == "php") { echo "selected"; } ?> value="php">PHP</option>
                                                        <option <?php if ($tl_currency == "pkr") { echo "selected"; } ?> value="pkr">PKR</option>
                                                        <option <?php if ($tl_currency == "pln") { echo "selected"; } ?> value="pln">PLN</option>
                                                        <option <?php if ($tl_currency == "ron") { echo "selected"; } ?> value="ron">RON</option>
                                                        <option <?php if ($tl_currency == "rub") { echo "selected"; } ?> value="rub">RUB</option>
                                                        <option <?php if ($tl_currency == "sek") { echo "selected"; } ?> value="sek">SEK</option>
                                                        <option <?php if ($tl_currency == "sgd") { echo "selected"; } ?> value="sgd">SGD</option>
                                                        <option <?php if ($tl_currency == "thb") { echo "selected"; } ?> value="thb">THB</option>
                                                        <option <?php if ($tl_currency == "try") { echo "selected"; } ?> value="try">TRY</option>
                                                        <option <?php if ($tl_currency == "uah") { echo "selected"; } ?> value="uah">UAH</option>
                                                        <option <?php if ($tl_currency == "ugx") { echo "selected"; } ?> value="ugx">UGX</option>
                                                        <option <?php if ($tl_currency == "usd") { echo "selected"; } ?> value="usd">USD</option>
                                                        <option <?php if ($tl_currency == "vnd") { echo "selected"; } ?> value="vnd">VND</option>
                                                        <option <?php if ($tl_currency == "zar") { echo "selected"; } ?> value="zar">ZAR</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="type" class="col-md-3 label-control">Transaction Type</label>
                                                <div class="col-md-9">
                                                    <select name="type" id="type" class="custom-select block">
                                                        <option <?php if ($tl_type == "transfer") { echo "selected"; } ?> value="transfer">Transfer</option>
                                                        <option <?php if ($tl_type == "deposit") { echo "selected"; } ?> value="deposit">Deposit</option>
                                                        <option <?php if ($tl_type == "withdraw") { echo "selected"; } ?> value="withdraw">Withdraw</option>
                                                        <option <?php if ($tl_type == "request") { echo "selected"; } ?> value="request">Request</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="narration" class="col-md-3 label-control">Description</label>
                                                <div class="col-md-9">
                                                    <textarea id="narration" rows="6" class="form-control square" name="narration" placeholder="Reason for transaction" required><?php echo $tl_description; ?></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="after_balance" class="col-md-3 label-control">After Balance</label>
                                                <div class="col-md-9">
                                                    <div class="input-group mt-0">
                                                        <input type="number" class="form-control" name="after_balance" value="<?php echo $tl_after_balance; ?>" required>
                                                        <div class="input-group-append"><span class="input-group-text">.00</span></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="status" class="col-md-3 label-control">Status</label>
                                                <div class="col-md-9">
                                                    <select name="status" id="status" class="custom-select block">
                                                        <option <?php if ($tl_status == "pending") { echo "selected"; } ?> value="pending">Pending</option>
                                                        <option <?php if ($tl_status == "approved") { echo "selected"; } ?> value="approved">Approved</option>
                                                        <option <?php if ($tl_status == "rejected") { echo "selected"; } ?> value="rejected">Rejected</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="old_date" class="col-md-3 label-control">Transaction Date</label>
                                                <div class="col-md-9">
                                                    <input type="datetime-local" id="new_date" class="form-control" name="new_date">
                                                    <input type="hidden" id="old_date" class="form-control" value="<?php echo $tl_created_at; ?>" name="old_date">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-actions center">
                                            <button type="submit" class="btn btn-success" name="update_transaction">Update Transaction</button>
                                        </div>
                                    </form> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<?php 
    flush_headers();
    include("footer.php");     

    if (isset($_POST["update_transaction"])) 
    {
        $id = mysqli_real_escape_string($link, $_POST["id"]);
        $trnx_id = mysqli_real_escape_string($link, $_POST["trnx_id"]);
        $user = mysqli_real_escape_string($link, $_POST["user"]);
        $amount = mysqli_real_escape_string($link, $_POST["amount"]);
        $currency = mysqli_real_escape_string($link, $_POST["currency"]);
        $type = mysqli_real_escape_string($link, $_POST["type"]);
        $narration = mysqli_real_escape_string($link, $_POST["narration"]);
        $after_balance = mysqli_real_escape_string($link, $_POST["after_balance"]);
        $status = mysqli_real_escape_string($link, $_POST["status"]);
        $log = get_date();
        $transaction_date = "";

        // Check if the new date is empty.
        if (empty($_POST["new_date"])) { $transaction_date = mysqli_real_escape_string($link, $_POST["old_date"]); }
        else { $transaction_date = mysqli_real_escape_string($link, $_POST["new_date"]); }

        if (empty($user)) {
            $_SESSION["error"] = "Please select a user.";
        } 
        elseif (empty($amount)) {
            $_SESSION["error"] = "Please fill out the amount.";
        }
        elseif (empty($currency)) {
            $_SESSION["error"] = "Please select a currency.";
        }
        elseif (empty($type)) {
            $_SESSION["error"] = "Please select a transaction type.";
        }
        elseif (empty($narration)) {
            $_SESSION["error"] = "Please fill out the narration.";
        }
        elseif (empty($after_balance)) {
            $_SESSION["error"] = "Please fill out the after balance.";
        }
        else {
            // Update the transaction log for this deposit using the transaction ID.
            $transaction_statement = "UPDATE `transactions` SET `user_id`='$user', `amount`='$amount', `currency`='$currency', `type`='$type', `description`='$narration', ".
                                     "`after_balance`='$after_balance', `status`='$status', `created_at`='$transaction_date', `updated_at`='$log' WHERE `trnx_id`='$trnx_id'";
            $update_transaction = mysqli_query($link, $transaction_statement);

            // Verify if all transactions was successful
            if ($update_transaction) {
                $_SESSION["success"] = "Transaction log updated successfully.";
                relocate_url("transaction-log.php"); 
            } 
            else {
                $_SESSION["error"] = "unable to update transaction log.";
            }
        }
    }
    mysqli_close($link);
?>  