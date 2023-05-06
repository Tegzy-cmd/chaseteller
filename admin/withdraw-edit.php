<?php 
    session_start();
    include("../includes/config.php");
    include("../includes/conn.php");
    include("../includes/func.php");
    admin_session_expired("login.php");
    set_headers("Edit Withdrawal", "withdraws");
    include("header.php");

    if (isset($_GET["wId"])) {
        $withdraw = mysqli_fetch_array(mysqli_query($link, "SELECT * FROM `withdraws` WHERE `id`='".$_GET["wId"]."'"));
        $w_id = $withdraw['id'];
        $w_user_id = $withdraw['user_id'];
        $w_trnx_id = $withdraw['trnx_id'];
        $w_bank = $withdraw['bank'];
        $w_account_name = $withdraw['account_name'];
        $w_account_no = $withdraw['account_no'];
        $w_amount = $withdraw['amount'];
        $w_currency = $withdraw['currency'];
        $w_charge = $withdraw['charge'];
        $w_after_balance = $withdraw['after_balance'];
        $w_narration = $withdraw['narration'];
        $w_status = $withdraw['status'];
        $w_created_at = $withdraw['created_at'];
    }
?>
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-12 col-12 mb-2">
                <h3 class="content-header-title mb-0">Edit Withdrawal [TRNX ID: <b><?php echo $w_trnx_id; ?></b>]</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12 mb-2">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="withdraws.php">Withdraws</a></li>
                            <li class="breadcrumb-item active">Edit Withdrawal</li>
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
                                            <input type="hidden" id="id" class="form-control" name="id" value="<?php echo $w_id; ?>">
                                            <input type="hidden" id="trnx_id" class="form-control" name="trnx_id" value="<?php echo $w_trnx_id; ?>">
                                            <div class="form-group row">
                                                <label for="user" class="col-md-3 label-control">User</label>
                                                <div class="col-md-9">
                                                    <select name="user" id="user" class="select2 form-control" required>
                                                        <?php
                                                            $customer = mysqli_query($link, "SELECT `id`, CONCAT(`firstname`, ' ', `lastname`) AS `name` FROM `users` WHERE `status`='active'");
                                                            while($data = mysqli_fetch_array($customer)) {
                                                                if ($data['id'] == $t_user_id) { echo "<option value='".$data['id']."' selected>".ucwords($data['name'])."</option>"; }
                                                                else { echo "<option value='".$data['id']."'>".ucwords($data['name'])."</option>"; }
                                                            } 
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="bank" class="col-md-3 label-control">Bank Name</label>
                                                <div class="col-md-9">
                                                    <input type="text" id="bank" class="form-control" placeholder="Enter Bank Name" value="<?php echo $w_bank; ?>" name="bank" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="accountName" class="col-md-3 label-control">Account Name</label>
                                                <div class="col-md-9">
                                                    <input type="text" id="accountName" class="form-control" placeholder="Enter Account Name" value="<?php echo $w_account_name; ?>" name="account_name" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="accountNumber" class="col-md-3 label-control">Account Number</label>
                                                <div class="col-md-9">
                                                    <input type="text" id="accountNumber" class="form-control" placeholder="Enter Account Number" value="<?php echo $w_account_no; ?>" name="account_no" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="amount" class="col-md-3 label-control">Amount</label>
                                                <div class="col-md-9">
                                                    <div class="input-group mt-0">
                                                        <input type="number" class="form-control" name="amount" value="<?php echo $w_amount; ?>" required>
                                                        <div class="input-group-append"><span class="input-group-text">.00</span></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="currency" class="col-md-3 label-control">Currency</label>
                                                <div class="col-md-9">
                                                    <select id="currency" name="currency" class="select2 form-control" required>
                                                        <option <?php if ($w_currency == "aed") { echo "selected"; } ?> value="aed">AED</option>
                                                        <option <?php if ($w_currency == "ars") { echo "selected"; } ?> value="ars">ARS</option>
                                                        <option <?php if ($w_currency == "aud") { echo "selected"; } ?> value="aud">AUD</option>
                                                        <option <?php if ($w_currency == "bdt") { echo "selected"; } ?> value="bdt">BDT</option>
                                                        <option <?php if ($w_currency == "bgn") { echo "selected"; } ?> value="bgn">BGN</option>
                                                        <option <?php if ($w_currency == "brl") { echo "selected"; } ?> value="brl">BRL</option>
                                                        <option <?php if ($w_currency == "cad") { echo "selected"; } ?> value="cad">CAD</option>
                                                        <option <?php if ($w_currency == "chf") { echo "selected"; } ?> value="chf">CHF</option>
                                                        <option <?php if ($w_currency == "clp") { echo "selected"; } ?> value="clp">CLP</option>
                                                        <option <?php if ($w_currency == "cny") { echo "selected"; } ?> value="cny">CNY</option>
                                                        <option <?php if ($w_currency == "czk") { echo "selected"; } ?> value="czk">CZK</option>
                                                        <option <?php if ($w_currency == "dkk") { echo "selected"; } ?> value="dkk">DKK</option>
                                                        <option <?php if ($w_currency == "egp") { echo "selected"; } ?> value="egp">EGP</option>
                                                        <option <?php if ($w_currency == "eur") { echo "selected"; } ?> value="eur">EUR</option>
                                                        <option <?php if ($w_currency == "gbp") { echo "selected"; } ?> value="gbp">GBP</option>
                                                        <option <?php if ($w_currency == "gel") { echo "selected"; } ?> value="gel">GEL</option>
                                                        <option <?php if ($w_currency == "ghs") { echo "selected"; } ?> value="ghs">GHS</option>
                                                        <option <?php if ($w_currency == "hkd") { echo "selected"; } ?> value="hkd">HKD</option>
                                                        <option <?php if ($w_currency == "hrk") { echo "selected"; } ?> value="hrk">HRK</option>
                                                        <option <?php if ($w_currency == "huf") { echo "selected"; } ?> value="huf">HUF</option>
                                                        <option <?php if ($w_currency == "idr") { echo "selected"; } ?> value="idr">IDR</option>
                                                        <option <?php if ($w_currency == "ils") { echo "selected"; } ?> value="ils">ILS</option>
                                                        <option <?php if ($w_currency == "inr") { echo "selected"; } ?> value="inr">INR</option>
                                                        <option <?php if ($w_currency == "jpy") { echo "selected"; } ?> value="jpy">JPY</option>
                                                        <option <?php if ($w_currency == "kes") { echo "selected"; } ?> value="kes">KES</option>
                                                        <option <?php if ($w_currency == "krw") { echo "selected"; } ?> value="krw">KRW</option>
                                                        <option <?php if ($w_currency == "lkr") { echo "selected"; } ?> value="lkr">LKR</option>
                                                        <option <?php if ($w_currency == "mad") { echo "selected"; } ?> value="mad">MAD</option>
                                                        <option <?php if ($w_currency == "mxn") { echo "selected"; } ?> value="mxn">MXN</option>
                                                        <option <?php if ($w_currency == "myr") { echo "selected"; } ?> value="myr">MYR</option>
                                                        <option <?php if ($w_currency == "ngn") { echo "selected"; } ?> value="ngn">NGN</option>
                                                        <option <?php if ($w_currency == "nok") { echo "selected"; } ?> value="nok">NOK</option>
                                                        <option <?php if ($w_currency == "npr") { echo "selected"; } ?> value="npr">NPR</option>
                                                        <option <?php if ($w_currency == "nzd") { echo "selected"; } ?> value="nzd">NZD</option>
                                                        <option <?php if ($w_currency == "pen") { echo "selected"; } ?> value="pen">PEN</option>
                                                        <option <?php if ($w_currency == "php") { echo "selected"; } ?> value="php">PHP</option>
                                                        <option <?php if ($w_currency == "pkr") { echo "selected"; } ?> value="pkr">PKR</option>
                                                        <option <?php if ($w_currency == "pln") { echo "selected"; } ?> value="pln">PLN</option>
                                                        <option <?php if ($w_currency == "ron") { echo "selected"; } ?> value="ron">RON</option>
                                                        <option <?php if ($w_currency == "rub") { echo "selected"; } ?> value="rub">RUB</option>
                                                        <option <?php if ($w_currency == "sek") { echo "selected"; } ?> value="sek">SEK</option>
                                                        <option <?php if ($w_currency == "sgd") { echo "selected"; } ?> value="sgd">SGD</option>
                                                        <option <?php if ($w_currency == "thb") { echo "selected"; } ?> value="thb">THB</option>
                                                        <option <?php if ($w_currency == "try") { echo "selected"; } ?> value="try">TRY</option>
                                                        <option <?php if ($w_currency == "uah") { echo "selected"; } ?> value="uah">UAH</option>
                                                        <option <?php if ($w_currency == "ugx") { echo "selected"; } ?> value="ugx">UGX</option>
                                                        <option <?php if ($w_currency == "usd") { echo "selected"; } ?> value="usd">USD</option>
                                                        <option <?php if ($w_currency == "vnd") { echo "selected"; } ?> value="vnd">VND</option>
                                                        <option <?php if ($w_currency == "zar") { echo "selected"; } ?> value="zar">ZAR</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="narration" class="col-md-3 label-control">Description</label>
                                                <div class="col-md-9">
                                                    <textarea id="narration" rows="6" class="form-control square" name="narration" placeholder="Reason for payment" required><?php echo $w_narration; ?></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="old_date" class="col-md-3 label-control">Date</label>
                                                <div class="col-md-9">
                                                    <input type="datetime-local" id="new_date" class="form-control" name="new_date">
                                                    <input type="hidden" id="old_date" class="form-control" value="<?php echo $w_created_at; ?>" name="old_date">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions center">
                                            <button type="submit" class="btn btn-success" name="update_withdrawal">Update Withdrawal</button>
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

    if (isset($_POST["update_withdrawal"])) 
    {
        $id = mysqli_real_escape_string($link, $_POST["id"]);
        $trnx_id = mysqli_real_escape_string($link, $_POST["trnx_id"]);
        $user = mysqli_real_escape_string($link, $_POST["user"]);
        $bank = mysqli_real_escape_string($link, $_POST["bank"]);
        $account_name = mysqli_real_escape_string($link, $_POST["account_name"]);
        $account_no = mysqli_real_escape_string($link, $_POST["account_no"]);
        $amount = mysqli_real_escape_string($link, $_POST["amount"]);
        $currency = mysqli_real_escape_string($link, $_POST["currency"]);
        $narration = mysqli_real_escape_string($link, $_POST["narration"]);
        $status = mysqli_real_escape_string($link, $_POST["status"]);
        $log = get_date();
        $withdraw_date = "";

        // Check if the new date is empty, if so use the old date.
        if (empty($_POST["new_date"])) { $withdraw_date = mysqli_real_escape_string($link, $_POST["old_date"]); }
        else { $withdraw_date = mysqli_real_escape_string($link, $_POST["new_date"]); }

        if (empty($user)) {
            $_SESSION["error"] = "Please select a user.";
        }
        elseif (empty($bank)) {
            $_SESSION["error"] = "Please fill out the bank name.";
        }
        elseif (empty($account_name)) {
            $_SESSION["error"] = "Please fill out the account name.";
        }
        elseif (empty($account_no)) {
            $_SESSION["error"] = "Please fill out the account number.";
        }
        elseif (empty($amount)) {
            $_SESSION["error"] = "Please fill out the amount.";
        }
        elseif (empty($currency)) {
            $_SESSION["error"] = "Please select a currency.";
        }
        elseif (empty($narration)) {
            $_SESSION["error"] = "Please fill in the narration.";
        }
        else {
            // Fetch user balance
            $balance_row = mysqli_fetch_array(mysqli_query($link, "SELECT * FROM `users` WHERE `id`='$user'"));
            $new_balance = 0;

            // Check if the user is the same user.
            if ($d_user_id == $user) {
                // If it's the same user subtract the former amount from balance and add this new amount.
                if ($amount > $balance_row["balance"]) {
                    $_SESSION["error"] = "Cannot carry out withdrawal, amount is bigger than balance.";
                }
                $get_balance = $balance_row["balance"] - $d_amount;
                $new_balance = $get_balance - $amount;
            } else {
                if ($amount > $balance_row["balance"]) {
                    $_SESSION["error"] = "Cannot carry out withdrawal, amount is bigger than balance.";
                }
                // Or else if the user is a new one just add the amount to the user balance.
                $new_balance = $balance_row["balance"] - $amount;
            }

            // Update the user balance
            $balance_statement = "UPDATE `users` SET `balance`='$new_balance' WHERE `id`='$user'";
            $update_balance = mysqli_query($link, $balance_statement);

            // Update the transaction log for this withdraw using the transaction ID.
            $transaction_statement = "UPDATE `transactions` SET `user_id`='$user', `amount`='$amount', `currency`='$currency', `description`='$narration', ".
                                     "`after_balance`='$new_balance', `created_at`='$withdraw_date', `updated_at`='$log' WHERE `trnx_id`='$trnx_id'";
            $update_transaction = mysqli_query($link, $transaction_statement);

            // Update the withdraw table with the new passed values.
            $withdraw_statement = "UPDATE `withdraws` SET `user_id`='$user', `bank`='$bank', `account_name`='$account_name', `account_no`='$account_no', `amount`='$amount', `currency`='$currency', ".
                                  "`after_balance`='$new_balance', `narration`='$narration', `created_at`='$withdraw_date', `updated_at`='$log' WHERE `id`='$id'";
            $update_withdraw = mysqli_query($link, $withdraw_statement);

            // Confirm if all transactions was successful
            if ($update_withdraw && $update_balance && $update_transaction) {
                $_SESSION["success"] = "Withdraw record updated successfully.";
                relocate_url("withdraws.php"); 
            } 
            else {
                $_SESSION["error"] = "unable to update withdraw record";
            }
        }
    }
    mysqli_close($link);
?>  