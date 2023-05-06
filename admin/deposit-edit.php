<?php 
    session_start();
    include("../includes/config.php");
    include("../includes/conn.php");
    include("../includes/func.php");
    admin_session_expired("login.php");
    set_headers("Edit Deposit", "deposits");
    include("header.php");

    if (isset($_GET["dId"])) {
        $deposit = mysqli_fetch_array(mysqli_query($link, "SELECT * FROM `deposits` WHERE `id`='".$_GET["dId"]."'"));
        $d_id = $deposit['id'];
        $d_user_id = $deposit['user_id'];
        $d_trnx_id = $deposit['trnx_id'];
        $d_bank = $deposit['bank'];
        $d_account_name = $deposit['account_name'];
        $d_account_no = $deposit['account_no'];
        $d_amount = $deposit['amount'];
        $d_currency = $deposit['currency'];
        $d_charge = $deposit['charge'];
        $d_after_balance = $deposit['after_balance'];
        $d_method = $deposit['method'];
        $d_narration = $deposit['narration'];
        $d_status = $deposit['status'];
        $d_created_at = $deposit['created_at'];
    }
?>
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title mb-0">Edit Deposit [TRNX ID: <b><?php echo $d_trnx_id; ?></b>]</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12 mb-2">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="deposits.php">Deposits</a></li>
                            <li class="breadcrumb-item active">Edit Deposit</li>
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
                                            <input type="hidden" id="id" class="form-control" name="id" value="<?php echo $d_id; ?>">
                                            <input type="hidden" id="trnx_id" class="form-control" name="trnx_id" value="<?php echo $d_trnx_id; ?>">
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
                                                <label for="paymentMethod" class="col-md-3 label-control">Payment Method</label>
                                                <div class="col-md-9">
                                                    <select name="method" id="paymentMethod" class="custom-select block" required>
                                                        <option <?php if ($d_method == "debit card") { echo "selected"; } ?> value="debit card">Debit Card</option>
                                                        <option <?php if ($d_method == "credit card") { echo "selected"; } ?> value="credit card">Credit Card</option>
                                                        <option <?php if ($d_method == "bank account") { echo "selected"; } ?> value="bank account">Bank Accounts</option>
                                                        <?php
                                                            $gateways = mysqli_query($link, "SELECT * FROM `gateways` WHERE `status`='enabled'");
                                                            while($gate = mysqli_fetch_array($gateways)) {
                                                                if ($gate['gateway'] == $d_method) { echo "<option value='".$gate['gateway']."' selected>".ucwords($gate['gateway'])."</option>"; }
                                                                else { echo "<option value='".$gate['gateway']."'>".ucwords($gate['gateway'])."</option>"; }
                                                            } 
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="bank" class="col-md-3 label-control">Bank Name</label>
                                                <div class="col-md-9">
                                                    <input type="text" id="bank" class="form-control" placeholder="Enter Bank Name" value="<?php echo $d_bank; ?>" name="bank" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="accountName" class="col-md-3 label-control">Account Name</label>
                                                <div class="col-md-9">
                                                    <input type="text" id="accountName" class="form-control" placeholder="Enter Account Name" value="<?php echo $d_account_name; ?>" name="account_name" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="accountNumber" class="col-md-3 label-control">Account Number</label>
                                                <div class="col-md-9">
                                                    <input type="text" id="accountNumber" class="form-control" placeholder="Enter Account Number" value="<?php echo $d_account_no; ?>" name="account_no" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="amount" class="col-md-3 label-control">Amount</label>
                                                <div class="col-md-9">
                                                    <div class="input-group mt-0">
                                                        <input type="number" class="form-control" name="amount" value="<?php echo $d_amount; ?>" required>
                                                        <div class="input-group-append"><span class="input-group-text">.00</span></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="currency" class="col-md-3 label-control">Currency</label>
                                                <div class="col-md-9">
                                                    <select id="currency" name="currency" class="select2 form-control" required>
                                                        <option <?php if ($d_currency == "aed") { echo "selected"; } ?> value="aed">AED</option>
                                                        <option <?php if ($d_currency == "ars") { echo "selected"; } ?> value="ars">ARS</option>
                                                        <option <?php if ($d_currency == "aud") { echo "selected"; } ?> value="aud">AUD</option>
                                                        <option <?php if ($d_currency == "bdt") { echo "selected"; } ?> value="bdt">BDT</option>
                                                        <option <?php if ($d_currency == "bgn") { echo "selected"; } ?> value="bgn">BGN</option>
                                                        <option <?php if ($d_currency == "brl") { echo "selected"; } ?> value="brl">BRL</option>
                                                        <option <?php if ($d_currency == "cad") { echo "selected"; } ?> value="cad">CAD</option>
                                                        <option <?php if ($d_currency == "chf") { echo "selected"; } ?> value="chf">CHF</option>
                                                        <option <?php if ($d_currency == "clp") { echo "selected"; } ?> value="clp">CLP</option>
                                                        <option <?php if ($d_currency == "cny") { echo "selected"; } ?> value="cny">CNY</option>
                                                        <option <?php if ($d_currency == "czk") { echo "selected"; } ?> value="czk">CZK</option>
                                                        <option <?php if ($d_currency == "dkk") { echo "selected"; } ?> value="dkk">DKK</option>
                                                        <option <?php if ($d_currency == "egp") { echo "selected"; } ?> value="egp">EGP</option>
                                                        <option <?php if ($d_currency == "eur") { echo "selected"; } ?> value="eur">EUR</option>
                                                        <option <?php if ($d_currency == "gbp") { echo "selected"; } ?> value="gbp">GBP</option>
                                                        <option <?php if ($d_currency == "gel") { echo "selected"; } ?> value="gel">GEL</option>
                                                        <option <?php if ($d_currency == "ghs") { echo "selected"; } ?> value="ghs">GHS</option>
                                                        <option <?php if ($d_currency == "hkd") { echo "selected"; } ?> value="hkd">HKD</option>
                                                        <option <?php if ($d_currency == "hrk") { echo "selected"; } ?> value="hrk">HRK</option>
                                                        <option <?php if ($d_currency == "huf") { echo "selected"; } ?> value="huf">HUF</option>
                                                        <option <?php if ($d_currency == "idr") { echo "selected"; } ?> value="idr">IDR</option>
                                                        <option <?php if ($d_currency == "ils") { echo "selected"; } ?> value="ils">ILS</option>
                                                        <option <?php if ($d_currency == "inr") { echo "selected"; } ?> value="inr">INR</option>
                                                        <option <?php if ($d_currency == "jpy") { echo "selected"; } ?> value="jpy">JPY</option>
                                                        <option <?php if ($d_currency == "kes") { echo "selected"; } ?> value="kes">KES</option>
                                                        <option <?php if ($d_currency == "krw") { echo "selected"; } ?> value="krw">KRW</option>
                                                        <option <?php if ($d_currency == "lkr") { echo "selected"; } ?> value="lkr">LKR</option>
                                                        <option <?php if ($d_currency == "mad") { echo "selected"; } ?> value="mad">MAD</option>
                                                        <option <?php if ($d_currency == "mxn") { echo "selected"; } ?> value="mxn">MXN</option>
                                                        <option <?php if ($d_currency == "myr") { echo "selected"; } ?> value="myr">MYR</option>
                                                        <option <?php if ($d_currency == "ngn") { echo "selected"; } ?> value="ngn">NGN</option>
                                                        <option <?php if ($d_currency == "nok") { echo "selected"; } ?> value="nok">NOK</option>
                                                        <option <?php if ($d_currency == "npr") { echo "selected"; } ?> value="npr">NPR</option>
                                                        <option <?php if ($d_currency == "nzd") { echo "selected"; } ?> value="nzd">NZD</option>
                                                        <option <?php if ($d_currency == "pen") { echo "selected"; } ?> value="pen">PEN</option>
                                                        <option <?php if ($d_currency == "php") { echo "selected"; } ?> value="php">PHP</option>
                                                        <option <?php if ($d_currency == "pkr") { echo "selected"; } ?> value="pkr">PKR</option>
                                                        <option <?php if ($d_currency == "pln") { echo "selected"; } ?> value="pln">PLN</option>
                                                        <option <?php if ($d_currency == "ron") { echo "selected"; } ?> value="ron">RON</option>
                                                        <option <?php if ($d_currency == "rub") { echo "selected"; } ?> value="rub">RUB</option>
                                                        <option <?php if ($d_currency == "sek") { echo "selected"; } ?> value="sek">SEK</option>
                                                        <option <?php if ($d_currency == "sgd") { echo "selected"; } ?> value="sgd">SGD</option>
                                                        <option <?php if ($d_currency == "thb") { echo "selected"; } ?> value="thb">THB</option>
                                                        <option <?php if ($d_currency == "try") { echo "selected"; } ?> value="try">TRY</option>
                                                        <option <?php if ($d_currency == "uah") { echo "selected"; } ?> value="uah">UAH</option>
                                                        <option <?php if ($d_currency == "ugx") { echo "selected"; } ?> value="ugx">UGX</option>
                                                        <option <?php if ($d_currency == "usd") { echo "selected"; } ?> value="usd">USD</option>
                                                        <option <?php if ($d_currency == "vnd") { echo "selected"; } ?> value="vnd">VND</option>
                                                        <option <?php if ($d_currency == "zar") { echo "selected"; } ?> value="zar">ZAR</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="narration" class="col-md-3 label-control">Description</label>
                                                <div class="col-md-9">
                                                    <textarea id="narration" rows="6" class="form-control square" name="narration" placeholder="Reason for payment" required><?php echo $d_narration; ?></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="old_date" class="col-md-3 label-control">Date</label>
                                                <div class="col-md-9">
                                                    <input type="datetime-local" id="new_date" class="form-control" name="new_date">
                                                    <input type="hidden" id="old_date" class="form-control" value="<?php echo $d_created_at; ?>" name="old_date">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions center">
                                            <button type="submit" class="btn btn-success" name="update_deposit">Update Deposit</button>
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

    if (isset($_POST["update_deposit"])) 
    {
        $id = mysqli_real_escape_string($link, $_POST["id"]);
        $trnx_id = mysqli_real_escape_string($link, $_POST["trnx_id"]);
        $user = mysqli_real_escape_string($link, $_POST["user"]);
        $method = mysqli_real_escape_string($link, $_POST["method"]);
        $bank = mysqli_real_escape_string($link, $_POST["bank"]);
        $account_name = mysqli_real_escape_string($link, $_POST["account_name"]);
        $account_no = mysqli_real_escape_string($link, $_POST["account_no"]);
        $amount = mysqli_real_escape_string($link, $_POST["amount"]);
        $currency = mysqli_real_escape_string($link, $_POST["currency"]);
        $narration = mysqli_real_escape_string($link, $_POST["narration"]);
        $log = get_date();
        $deposit_date = "";

        // Check if the new date is empty, if so use the old date.
        if (empty($_POST["new_date"])) { $deposit_date = mysqli_real_escape_string($link, $_POST["old_date"]); } 
        else { $deposit_date = mysqli_real_escape_string($link, $_POST["new_date"]); }

        if (empty($user)) {
            $_SESSION["error"] = "Please select a user.";
        } 
        elseif (empty($method)) {
            $_SESSION["error"] = "Please select a payment method.";
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
                $get_balance = $balance_row["balance"] - $d_amount;
                $new_balance = $get_balance + $amount;
            } else {
                // Or else if the user is a new one just add the amount to the user balance.
                $new_balance = $balance_row["balance"] + $amount;
            }

            // Update the user balance
            $balance_statement = "UPDATE `users` SET `balance`='$new_balance' WHERE `id`='$user'";
            $update_balance = mysqli_query($link, $balance_statement);

            // Update the transaction log for this deposit using the transaction ID.
            $transaction_statement = "UPDATE `transactions` SET `user_id`='$user', `amount`='$amount', `currency`='$currency', `description`='$narration', ".
                                     "`after_balance`='$new_balance', `created_at`='$deposit_date', `updated_at`='$log' WHERE `trnx_id`='$trnx_id'";
            $update_transaction = mysqli_query($link, $transaction_statement);

            // Update the deposit table with the new passed values.
            $deposit_statement = "UPDATE `deposits` SET `user_id`='$user', `bank`='$bank', `account_name`='$account_name', `account_no`='$account_no', `amount`='$amount', `currency`='$currency', ".
                                 "`after_balance`='$new_balance', `method`='$method', `narration`='$narration', `created_at`='$deposit_date', `updated_at`='$log' WHERE `id`='$id'";
            $update_deposit = mysqli_query($link, $deposit_statement);

            // Confirm if all transactions was successful
            if ($update_deposit && $update_balance && $update_transaction) {
                $_SESSION["success"] = "Deposit record updated successfully.";
                relocate_url("deposits.php"); 
            } 
            else {
                $_SESSION["error"] = "unable to update deposit record";
            }
        }
    }
    mysqli_close($link);
?>  