<?php 
    session_start();
    include("../includes/config.php");
    include("../includes/conn.php");
    include("../includes/func.php");
    user_session_expired("../login.php");

    $_SESSION["dashboard_title"] = "Confirm Withdraw Details";
    $_SESSION["nav"] = "withdraw";
    include("header.php"); 

    /** 
     * Add a new withdrawal 
     * Update user balance
     * Fetch transaction charge and insert
     **/
    if (isset($_POST["confirm_withdrawal"])) 
    {
        $user = mysqli_real_escape_string($link, $_POST["userId"]);
        $trnx_id = mysqli_real_escape_string($link, $_POST["trnxId"]);
        $bank = mysqli_real_escape_string($link, $_POST["bankName"]);
        $account_name = mysqli_real_escape_string($link, $_POST["accountName"]);
        $account_no = mysqli_real_escape_string($link, $_POST["accountNo"]);
        $amount = mysqli_real_escape_string($link, $_POST["amt"]);
        $currency = mysqli_real_escape_string($link, $_POST["curr"]);
        $description = mysqli_real_escape_string($link, $_POST["desc"]);
        $type = "withdraw";

        if (empty($bank)) {
            $_SESSION["failure"] = "Please fill out the bank name.";
            relocate_url("withdraw-money.php");
        }
        elseif (empty($account_name)) {
            $_SESSION["failure"] = "Please fill out the account name.";
            relocate_url("withdraw-money.php");
        }
        elseif (empty($account_no)) {
            $_SESSION["failure"] = "Please fill out the account number.";
            relocate_url("withdraw-money.php");
        }
        elseif (empty($amount)) {
            $_SESSION["failure"] = "Please fill out the amount.";
            relocate_url("withdraw-money.php");
        }
        elseif (empty($currency)) {
            $_SESSION["failure"] = "Please select a currency.";
            relocate_url("withdraw-money.php");
        }
        elseif (empty($description)) {
            $_SESSION["failure"] = "Please fill in the description.";
            relocate_url("withdraw-money.php");
        }
        else {
            # Fetch withdraw charge
            $fee_row = mysqli_fetch_array(mysqli_query($link, "SELECT `fee` FROM `transaction_fee` WHERE `level`='withdraw'"));
            $fee = $fee_row["fee"];

            # Insert new transaction log
            $transaction_statement = "INSERT INTO `transactions` (`user_id`, `trnx_id`, `amount`, `currency`, `fee`, `type`, `description`) ".
                                     "VALUES ('$user', '$trnx_id', '$amount', '$currency', '$fee', '$type', '$description')";
            $insert_transaction = mysqli_query($link, $transaction_statement);

            # Insert new withdraw
            $withdraw_statement = "INSERT INTO `withdraws` (`user_id`, `trnx_id`, `bank`, `account_name`, `account_no`, `amount`, `currency`, `charge`, `narration`) ".
                                 "VALUES ('$user', '$trnx_id', '$bank', '$account_name', '$account_no', '$amount', '$currency', '$fee', '$description')";
            $insert_withdraw = mysqli_query($link, $withdraw_statement);

            if ($insert_withdraw && $insert_transaction) {
                relocate_url("withdraw-money-successful.php"); 
            } 
            else {
                relocate_url("withdraw-money-failed.php");
            }
        }
    }
?>
  
  <!-- Content
  ============================================= -->
  <div id="content" class="py-4">
    <div class="container">
      <h2 class="font-weight-400 text-center mt-3 mb-4">Withdraw Money Confirmation</h2>
      <div class="row">
        <div class="col-md-8 col-lg-6 mx-auto">
          <div class="bg-light shadow-sm rounded p-3 p-sm-4 mb-4"> 
            <!-- Request Money Confirm Details
            ============================================= -->
            <form id="form-send-money" action="" method="post">
              <p class="text-4 text-center alert alert-info">You are Withdraw Money <br>to<br>
                <span class="font-weight-500">
                  <?php 
                    echo ucwords(print_var($_POST["bank"]));
                    echo " - ";
                    echo print_var($_POST["account_no"]); 
                  ?>
                </span>
              </p>
              <div class="col-12 col-lg-12">
                <dl class="row mb-0 redial-line-height-2_5 p-2" style="font-size:15px;">
                  <dt class="col-md-5 text-muted">Transaction ID:</dt>
                  <dd class="col-md-7 mb-3"><?php echo print_var($_POST["trnx_id"]); ?></dd>
                  <dt class="col-md-5 text-muted">Bank Name:</dt>
                  <dd class="col-md-7 mb-3"><?php ucwords(print_var($_POST["bank"])); ?></dd>
                  <dt class="col-md-5 text-muted">Account Name:</dt>
                  <dd class="col-md-7 mb-3"><?php ucwords(print_var($_POST["account_name"])); ?></dd>
                  <dt class="col-md-5 text-muted">Account Number:</dt>
                  <dd class="col-md-7 mb-3"><?php print_var($_POST["account_no"]); ?></dd>
                  <dt class="col-md-5 text-muted">Description:</dt>
                  <dd class="col-md-7 mb-3"><?php echo print_var($_POST["description"]); ?></dd>
                </dl>
              </div>
              <p class="mb-2 mt-4 text-muted" style="font-weight:bold;">
                Amount to Withdraw: 
                <span class="text-3 float-right" style="font-weight:lighter;">
                  <?php echo print_currency($_POST["amount"], strtoupper($_POST["currency"])); ?>
                </span>
              </p>
              <?php
                $sel_fee = "SELECT * FROM `transaction_fee` WHERE `level`='withdraw'";
                $fee = mysqli_fetch_array(mysqli_query($link, $sel_fee)); 
              ?>
              <p class="text-muted" style="font-weight:bold;">
                Transactions fees: 
                <span class="text-3 float-right" style="font-weight:lighter;">
                  <?php echo print_currency($fee["fee"], "USD"); ?>
                </span>
              </p> 
              <hr>
              <div class="row">
                <p class="col-sm-4 text-muted text-left font-weight-500 mb-0 mb-sm-3" style="font-size:18px;">Total</p>
                <p class="col-sm-8 font-weight-500 text-right" style="font-size:18px;">
                  <?php
                    $total_amount = $_POST["amount"] + $fee["fee"];
                    echo print_currency($total_amount, strtoupper($_POST["currency"]));
                  ?>
                </p>
              </div>     

              <input type="hidden" name="userId" value="<?php echo $_POST["user_id"]; ?>">
              <input type="hidden" name="trnxId" value="<?php echo $_POST["trnx_id"]; ?>">
              <input type="hidden" name="bankName" value="<?php echo $_POST["bank"]; ?>">
              <input type="hidden" name="accountName" value="<?php echo $_POST["account_name"]; ?>">
              <input type="hidden" name="accountNo" value="<?php echo $_POST["account_no"]; ?>">
              <input type="hidden" name="amt" value="<?php echo $total_amount; ?>">
              <input type="hidden" name="curr" value="<?php echo $_POST["currency"]; ?>">
              <input type="hidden" name="desc" value="<?php echo $_POST["description"]; ?>">

              <button class="btn btn-primary btn-block mt-5" name="confirm_withdrawal">Finish</button>
            </form>
            <!-- Request Money Confirm Details end --> 
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Content end -->  
  
<?php 
  unset($_SESSION["dashboard_title"]);
  unset($_SESSION["nav"]);
  include("footer.php"); 
?>