<?php 
    session_start();
    include("../includes/config.php");
    include("../includes/conn.php");
    include("../includes/func.php");
    user_session_expired("../login.php");

    $_SESSION["dashboard_title"] = "Confirm Request Details";
    $_SESSION["nav"] = "request";
    include("header.php"); 

    /** 
     * Add a new money request 
     * Fetch transaction charge and insert
     **/
    if (isset($_POST["confirm_request"])) 
    {
        $trnx_id = mysqli_real_escape_string($link, $_POST["trnxId"]);
        $payer = mysqli_real_escape_string($link, $_POST["userId"]);
        $recipient = mysqli_real_escape_string($link, $_POST["recipientName"]);
        $recipient_country = mysqli_real_escape_string($link, $_POST["recipientCountry"]);
        $recipient_email = mysqli_real_escape_string($link, $_POST["recipientEmail"]);
        $amount = mysqli_real_escape_string($link, $_POST["amt"]);
        $currency = mysqli_real_escape_string($link, $_POST["curr"]);
        $narration = mysqli_real_escape_string($link, $_POST["desc"]);
        $payment_date = mysqli_real_escape_string($link, $_POST["paymentDate"]);
        $type = "request";

        if (empty($recipient)) {
            $_SESSION["error"] = "Please fill out the recipient name.";
            relocate_url("request-money.php");
        }
        elseif (empty($recipient_country)) {
            $_SESSION["error"] = "Please select the recipient country.";
            relocate_url("request-money.php");
        }
        elseif (empty($recipient_email)) {
            $_SESSION["error"] = "Please fill out the recipient email.";
            relocate_url("request-money.php");
        }
        elseif (empty($amount)) {
            $_SESSION["error"] = "Please fill out the amount.";
            relocate_url("request-money.php");
        }
        elseif (empty($currency)) {
            $_SESSION["error"] = "Please select a currency.";
            relocate_url("request-money.php");
        }
        elseif (empty($narration)) {
            $_SESSION["error"] = "Please fill in the narration.";
            relocate_url("request-money.php");
        }
        elseif (empty($payment_date)) {
            $_SESSION["error"] = "Please fill in the payment date.";
            relocate_url("request-money.php");
        }
        else {
            # Fetch request charge
            $fee_row = mysqli_fetch_array(mysqli_query($link, "SELECT `fee` FROM `transaction_fee` WHERE `level`='request'"));
            $fee = $fee_row["fee"];

            # Insert new transaction log
            $transaction_statement = "INSERT INTO `transactions` (`user_id`, `trnx_id`, `amount`, `currency`, `fee`, `type`, `description`) ".
                                     "VALUES ('$payer', '$trnx_id', '$amount', '$currency', '$fee', '$type', '$narration')";
            $insert_transaction = mysqli_query($link, $transaction_statement);

            # Insert new deposit
            $request_statement = "INSERT INTO `requests` (`user_id`, `trnx_id`, `recipient`, `recipient_country`, `recipient_email`, `amount`, `currency`, `charge`, `payment_due`, `narration`) ".
                                 "VALUES ('$payer', '$trnx_id', '$recipient', '$recipient_country', '$recipient_email', '$amount', '$currency', '$fee', '$payment_date', '$narration')";
            $insert_request = mysqli_query($link, $request_statement);


            if ($insert_request && $insert_transaction) {
                relocate_url("request-money-successful.php"); 
            } 
            else {
                relocate_url("request-money-failed.php"); 
            }
        }
    }
?>
  
  <!-- Content
  ============================================= -->
  <div id="content" class="py-4">
    <div class="container">
      <h2 class="font-weight-400 text-center mt-3 mb-4">Request Money Confirmation</h2>
      <div class="row">
        <div class="col-md-8 col-lg-6 mx-auto">
          <div class="bg-light shadow-sm rounded p-3 p-sm-4 mb-4"> 
            <!-- Request Money Confirm Details
            ============================================= -->
            <form id="form-send-money" action="" method="post">
            <p class="text-4 text-center alert alert-info">You are to Requesting Money <br>
              from<br>
              <span class="font-weight-500">
                <?php echo print_var($_POST["recipient_email"]); ?>
              </span>
            </p>
              <div class="col-12 col-lg-12">
                <dl class="row mb-0 redial-line-height-2_5 p-2" style="font-size:15px;">
                  <dt class="col-md-5 text-muted">Transaction ID:</dt>
                  <dd class="col-md-7 mb-3"><?php echo print_var($_POST["trnx_id"]); ?></dd>
                  <dt class="col-md-5 text-muted">Recipient Name:</dt>
                  <dd class="col-md-7 mb-3"><?php ucwords(print_var($_POST["recipient_name"])); ?></dd>
                  <dt class="col-md-5 text-muted">Recipient Country:</dt>
                  <dd class="col-md-7 mb-3"><?php ucwords(print_var($_POST["recipient_country"])); ?></dd>
                  <dt class="col-md-5 text-muted">Recipient Email:</dt>
                  <dd class="col-md-7 mb-3"><?php print_var($_POST["recipient_email"]); ?></dd>
                  <dt class="col-md-5 text-muted">Payment Due:</dt>
                  <dd class="col-md-7 mb-3"><?php print_var($_POST["payment_due"]); ?></dd>
                  <dt class="col-md-5 text-muted">Description:</dt>
                  <dd class="col-md-7 mb-3"><?php print_var($_POST["description"]); ?></dd>
                </dl>
              </div>
              <p class="mb-2 mt-4 text-muted" style="font-weight:bold;">
                Amount Requested: 
                <span class="text-3 float-right" style="font-weight:lighter;">
                  <?php echo print_currency($_POST["amount"], strtoupper($_POST["currency"])); ?>
                </span>
              </p>
              <?php
                $sel_fee = "SELECT * FROM `transaction_fee` WHERE `level`='request'";
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
              <input type="hidden" name="recipientName" value="<?php echo $_POST["recipient_name"]; ?>">
              <input type="hidden" name="recipientCountry" value="<?php echo $_POST["recipient_country"]; ?>">
              <input type="hidden" name="recipientEmail" value="<?php echo $_POST["recipient_email"]; ?>">
              <input type="hidden" name="amt" value="<?php echo $total_amount; ?>">
              <input type="hidden" name="curr" value="<?php echo $_POST["currency"]; ?>">
              <input type="hidden" name="paymentDate" value="<?php echo $_POST["payment_due"]; ?>">
              <input type="hidden" name="desc" value="<?php echo $_POST["description"]; ?>">

              <button class="btn btn-primary btn-block mt-5" name="confirm_request">Finish</button>
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