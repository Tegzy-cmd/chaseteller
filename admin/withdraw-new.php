<?php 
    session_start();
    include("../includes/config.php");
    include("../includes/conn.php");
    include("../includes/func.php");
    user_session_expired("../login.php");
    set_headers("Add New Withdrawal", "withdraws");
    include("header.php");

    if (isset($_POST["add_withdrawal"])) 
    {
        $trnx_id = mysqli_real_escape_string($link, $_POST["trnx_id"]);
        $user = mysqli_real_escape_string($link, $_POST["user"]);
        $bank = mysqli_real_escape_string($link, $_POST["bank"]);
        $account_name = mysqli_real_escape_string($link, $_POST["account_name"]);
        $account_no = mysqli_real_escape_string($link, $_POST["account_no"]);
        $amount = mysqli_real_escape_string($link, $_POST["amount"]);
        $currency = mysqli_real_escape_string($link, $_POST["currency"]);
        $narration = mysqli_real_escape_string($link, $_POST["narration"]);
        $withdraw_date = mysqli_real_escape_string($link, $_POST["withdraw_date"]);
        $type = "withdraw";

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
            // Fetch the transaction fee for withdrawal.
            $fee_row = mysqli_fetch_array(mysqli_query($link, "SELECT `fee` FROM `transaction_fee` WHERE `level`='$type'"));
            $fee = $fee_row["fee"];

            // Insert a new transaction log to the transactions table.
            $transaction_statement = "INSERT INTO `transactions` (`user_id`, `trnx_id`, `amount`, `currency`, `fee`, `type`, `description`, `created_at`) ".
                                     "VALUES ('$user', '$trnx_id', '$amount', '$currency', '$fee', '$type', '$narration', '$withdraw_date')";
            $insert_transaction = mysqli_query($link, $transaction_statement);

            // Insert the new withdrawal to the withdraws table.
            $withdraw_statement = "INSERT INTO `withdraws` (`user_id`, `trnx_id`, `bank`, `account_name`, `account_no`, `amount`, `currency`, `charge`, `narration`, `created_at`) ".
                                 "VALUES ('$user', '$trnx_id', '$bank', '$account_name', '$account_no', '$amount', '$currency', '$fee', '$narration', '$withdraw_date')";
            $insert_withdraw = mysqli_query($link, $withdraw_statement);

            // Verify if all the operations where successful.
            if ($insert_withdraw && $insert_transaction) {
                $_SESSION["success"] = "New withdraw record added successfully.";
                relocate_url("withdraws.php"); 
            } 
            else {
                $_SESSION["error"] = "unable to add a new withdraw record";
            }
        }
    }
?>
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title mb-0">Add New Deposit</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12 mb-2">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="deposits.php">Deposits</a></li>
                            <li class="breadcrumb-item active">Add New Deposit</li>
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
                                            <div class="form-group row">
                                                <label for="trnx_id" class="col-md-3 label-control">Transaction ID</label>
                                                <div class="col-md-9">
                                                    <input type="text" id="trnx_id" class="form-control" name="trnx_id" value="<?php echo strtoupper(generate_reference(18)); ?>">
                                                    <p class="text-muted ml-75 mt-50">
                                                        <small>This is the transaction Id. It is automatically generated do not edit.</small>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="user" class="col-md-3 label-control">User</label>
                                                <div class="col-md-9">
                                                    <select name="user" id="user" class="select2 form-control" required>
                                                        <option value="" selected>-- Select User --</option>
                                                        <?php
                                                            $customer = mysqli_query($link, "SELECT `id`, CONCAT(`firstname`, ' ', `lastname`) AS `name` FROM `users` WHERE `status`='active'");
                                                            while($data = mysqli_fetch_array($customer)) {
                                                                echo "<option value='".$data['id']."'>".ucwords($data['name'])."</option>";
                                                            } 
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="bank" class="col-md-3 label-control">Bank Name</label>
                                                <div class="col-md-9">
                                                    <input type="text" id="bank" class="form-control" placeholder="Enter Bank Name" name="bank" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="accountName" class="col-md-3 label-control">Account Name</label>
                                                <div class="col-md-9">
                                                    <input type="text" id="accountName" class="form-control" placeholder="Enter Account Name" name="account_name" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="accountNumber" class="col-md-3 label-control">Account Number</label>
                                                <div class="col-md-9">
                                                    <input type="text" id="accountNumber" class="form-control" placeholder="Enter Account Number" name="account_no" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="amount" class="col-md-3 label-control">Amount</label>
                                                <div class="col-md-9">
                                                    <div class="input-group mt-0">
                                                        <input type="number" class="form-control" name="amount" required>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">.00</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="currency" class="col-md-3 label-control">Currency</label>
                                                <div class="col-md-9">
                                                    <select id="currency" name="currency" class="select2 form-control" required>
                                                        <optgroup label="Popular Currency">
                                                            <option selected value="usd">USD</option>
                                                            <option value="gbp">GBP</option>
                                                            <option value="eur">EUR</option>
                                                        </optgroup>
                                                        <optgroup label="Other Currency">
                                                            <option value="aed">AED</option>
                                                            <option value="ars">ARS</option>
                                                            <option value="aud">AUD</option>
                                                            <option value="bdt">BDT</option>
                                                            <option value="bgn">BGN</option>
                                                            <option value="brl">BRL</option>
                                                            <option value="cad">CAD</option>
                                                            <option value="chf">CHF</option>
                                                            <option value="clp">CLP</option>
                                                            <option value="cny">CNY</option>
                                                            <option value="czk">CZK</option>
                                                            <option value="dkk">DKK</option>
                                                            <option value="egp">EGP</option>
                                                            <option value="gel">GEL</option>
                                                            <option value="ghs">GHS</option>
                                                            <option value="hkd">HKD</option>
                                                            <option value="hrk">HRK</option>
                                                            <option value="huf">HUF</option>
                                                            <option value="idr">IDR</option>
                                                            <option value="ils">ILS</option>
                                                            <option value="inr">INR</option>
                                                            <option value="jpy">JPY</option>
                                                            <option value="kes">KES</option>
                                                            <option value="krw">KRW</option>
                                                            <option value="lkr">LKR</option>
                                                            <option value="mad">MAD</option>
                                                            <option value="mxn">MXN</option>
                                                            <option value="myr">MYR</option>
                                                            <option value="ngn">NGN</option>
                                                            <option value="nok">NOK</option>
                                                            <option value="npr">NPR</option>
                                                            <option value="nzd">NZD</option>
                                                            <option value="pen">PEN</option>
                                                            <option value="php">PHP</option>
                                                            <option value="pkr">PKR</option>
                                                            <option value="pln">PLN</option>
                                                            <option value="ron">RON</option>
                                                            <option value="rub">RUB</option>
                                                            <option value="sek">SEK</option>
                                                            <option value="sgd">SGD</option>
                                                            <option value="thb">THB</option>
                                                            <option value="try">TRY</option>
                                                            <option value="uah">UAH</option>
                                                            <option value="ugx">UGX</option>
                                                            <option value="vnd">VND</option>
                                                            <option value="zar">ZAR</option>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="narration" class="col-md-3 label-control">Description</label>
                                                <div class="col-md-9">
                                                    <textarea id="narration" rows="6" class="form-control square" name="narration" placeholder="Reason for payment" required></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="withdrawDate" class="col-md-3 label-control">Date</label>
                                                <div class="col-md-9">
                                                    <input type="datetime-local" id="withdrawDate" class="form-control" name="withdraw_date">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-actions center">
                                            <button type="submit" class="btn btn-success" name="add_withdrawal">Add Withdrawal</button>
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
    mysqli_close($link);
?>  