<?php 
    session_start();
    include("../includes/config.php");
    include("../includes/conn.php");
    include("../includes/func.php");
    user_session_expired("../login.php");

    $_SESSION["dashboard_title"] = "Deposit Money";
    $_SESSION["nav"] = "deposit";
    include("header.php"); 
?> 
  
  <!-- Content
  ============================================= -->
  <div id="content" class="py-4">

    <?php 
      echo msg_success();
      echo msg_failure();
    ?>

    <div class="container">
      <h2 class="font-weight-400 text-center mt-3">Deposit Money</h2>
      <p class="text-4 text-center mb-4">Deposit your money to your bank account.</p>
      <div class="row">
        <div class="col-md-8 col-lg-6 col-xl-5 mx-auto">
          <div class="bg-light shadow-sm rounded p-3 p-sm-4 mb-4">
            <!-- Deposit Money Form
            ============================================= -->
            <form id="form-send-money" action="deposit-money-confirm.php" method="post">
              <input type="hidden" name="trnx_id" value="<?php echo strtoupper(generate_reference(18)); ?>">
              <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">

              <div class="form-group">
                <label for="bank">Bank Name</label>
                <input type="text" class="form-control" data-bv-field="bank" id="bank" name="bank" required placeholder="Enter Your Bank Name">
              </div>
              <div class="form-group">
                <label for="account_name">Account Name</label>
                <input type="text" class="form-control" data-bv-field="account_name" id="account_name" name="account_name" required placeholder="Enter Your Account Name">
              </div>
              <div class="form-group">
                <label for="account_no">Account Number</label>
                <input type="text" class="form-control" data-bv-field="account_no" id="account_no" name="account_no" required placeholder="Enter Your Account Number">
              </div>
              <div class="form-group">
                <label for="youSend">Amount</label>
                <div class="input-group">
                  <input type="text" class="form-control" name="amount" required placeholder="Enter Amount to Deposit">
                  <div class="input-group-append"> 
                    <span class="input-group-text p-0">
                      <select id="youSendCurrency" name="currency" required data-style="custom-select bg-transparent border-0" data-container="body" data-live-search="true" class="selectpicker form-control bg-transparent" required="">
                        <optgroup label="Popular Currency">
                          <option data-icon="currency-flag currency-flag-usd mr-1" data-subtext="United States dollar" selected="selected" value="usd">USD</option>
                          <option data-icon="currency-flag currency-flag-eur mr-1" data-subtext="Euro" value="eur">EUR</option>
                          <option data-icon="currency-flag currency-flag-gbp mr-1" data-subtext="British pound" value="gbp">GBP</option>
                        </optgroup>
                        <option value="" data-divider="true">divider</option>
                          <optgroup label="Other Currency">
                          <option data-icon="currency-flag currency-flag-aed mr-1" data-subtext="United Arab Emirates dirham" value="aed">AED</option>
                          <option data-icon="currency-flag currency-flag-ars mr-1" data-subtext="Argentine peso" value="ars">ARS</option>
                          <option data-icon="currency-flag currency-flag-aud mr-1" data-subtext="Australian dollar" value="aud">AUD</option>
                          <option data-icon="currency-flag currency-flag-bdt mr-1" data-subtext="Bangladeshi taka" value="bdt">BDT</option>
                          <option data-icon="currency-flag currency-flag-bgn mr-1" data-subtext="Bulgarian lev" value="bgn">BGN</option>
                          <option data-icon="currency-flag currency-flag-brl mr-1" data-subtext="Brazilian real" value="brl">BRL</option>
                          <option data-icon="currency-flag currency-flag-cad mr-1" data-subtext="Canadian dollar" value="cad">CAD</option>
                          <option data-icon="currency-flag currency-flag-chf mr-1" data-subtext="Swiss franc" value="chf">CHF</option>
                          <option data-icon="currency-flag currency-flag-clp mr-1" data-subtext="Chilean peso" value="clp">CLP</option>
                          <option data-icon="currency-flag currency-flag-cny mr-1" data-subtext="Chinese yuan" value="cny">CNY</option>
                          <option data-icon="currency-flag currency-flag-czk mr-1" data-subtext="Czech koruna" value="czk">CZK</option>
                          <option data-icon="currency-flag currency-flag-dkk mr-1" data-subtext="Danish krone" value="dkk">DKK</option>
                          <option data-icon="currency-flag currency-flag-egp mr-1" data-subtext="Egyptian pound" value="egp">EGP</option>
                          <option data-icon="currency-flag currency-flag-eur mr-1" data-subtext="Euro" value="eur">EUR</option>
                          <option data-icon="currency-flag currency-flag-gbp mr-1" data-subtext="British pound" value="gbp">GBP</option>
                          <option data-icon="currency-flag currency-flag-gel mr-1" data-subtext="Georgian lari" value="gel">GEL</option>
                          <option data-icon="currency-flag currency-flag-ghs mr-1" data-subtext="Ghanaian cedi" value="ghs">GHS</option>
                          <option data-icon="currency-flag currency-flag-hkd mr-1" data-subtext="Hong Kong dollar" value="hkd">HKD</option>
                          <option data-icon="currency-flag currency-flag-hrk mr-1" data-subtext="Croatian kuna" value="hrk">HRK</option>
                          <option data-icon="currency-flag currency-flag-huf mr-1" data-subtext="Hungarian forint" value="huf">HUF</option>
                          <option data-icon="currency-flag currency-flag-idr mr-1" data-subtext="Indonesian rupiah" value="idr">IDR</option>
                          <option data-icon="currency-flag currency-flag-ils mr-1" data-subtext="Israeli shekel" value="ils">ILS</option>
                          <option data-icon="currency-flag currency-flag-inr mr-1" data-subtext="Indian rupee" value="inr">INR</option>
                          <option data-icon="currency-flag currency-flag-jpy mr-1" data-subtext="Japanese yen" value="jpy">JPY</option>
                          <option data-icon="currency-flag currency-flag-kes mr-1" data-subtext="Kenyan shilling" value="">KES</option>
                          <option data-icon="currency-flag currency-flag-krw mr-1" data-subtext="South Korean won" value="krw">KRW</option>
                          <option data-icon="currency-flag currency-flag-lkr mr-1" data-subtext="Sri Lankan rupee" value="lkr">LKR</option>
                          <option data-icon="currency-flag currency-flag-mad mr-1" data-subtext="Moroccan dirham" value="mad">MAD</option>
                          <option data-icon="currency-flag currency-flag-mxn mr-1" data-subtext="Mexican peso" value="mxn">MXN</option>
                          <option data-icon="currency-flag currency-flag-myr mr-1" data-subtext="Malaysian ringgit" value="myr">MYR</option>
                          <option data-icon="currency-flag currency-flag-ngn mr-1" data-subtext="Nigerian naira" value="ngn">NGN</option>
                          <option data-icon="currency-flag currency-flag-nok mr-1" data-subtext="Norwegian krone" value="nok">NOK</option>
                          <option data-icon="currency-flag currency-flag-npr mr-1" data-subtext="Nepalese rupee" value="npr">NPR</option>
                          <option data-icon="currency-flag currency-flag-nzd mr-1" data-subtext="New Zealand dollar" value="nzd">NZD</option>
                          <option data-icon="currency-flag currency-flag-pen mr-1" data-subtext="Peruvian nuevo sol" value="pen">PEN</option>
                          <option data-icon="currency-flag currency-flag-php mr-1" data-subtext="Philippine peso" value="php">PHP</option>
                          <option data-icon="currency-flag currency-flag-pkr mr-1" data-subtext="Pakistani rupee" value="pkr">PKR</option>
                          <option data-icon="currency-flag currency-flag-pln mr-1" data-subtext="Polish złoty" value="pln">PLN</option>
                          <option data-icon="currency-flag currency-flag-ron mr-1" data-subtext="Romanian leu" value="ron">RON</option>
                          <option data-icon="currency-flag currency-flag-rub mr-1" data-subtext="Russian rouble" value="rub">RUB</option>
                          <option data-icon="currency-flag currency-flag-sek mr-1" data-subtext="Swedish krona" value="sek">SEK</option>
                          <option data-icon="currency-flag currency-flag-sgd mr-1" data-subtext="Singapore dollar" value="sgd">SGD</option>
                          <option data-icon="currency-flag currency-flag-thb mr-1" data-subtext="Thai baht" value="thb">THB</option>
                          <option data-icon="currency-flag currency-flag-try mr-1" data-subtext="Turkish lira" value="try">TRY</option>
                          <option data-icon="currency-flag currency-flag-uah mr-1" data-subtext="Ukrainian hryvnia" value="uah">UAH</option>
                          <option data-icon="currency-flag currency-flag-ugx mr-1" data-subtext="Ugandan shilling" value="ugx">UGX</option>
                          <option data-icon="currency-flag currency-flag-vnd mr-1" data-subtext="Vietnamese dong" value="vnd">VND</option>
                          <option data-icon="currency-flag currency-flag-zar mr-1" data-subtext="South African rand" value="zar">ZAR</option>
                        </optgroup>
                      </select>
                    </span> 
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="payment_method">Payment Method</label>
                <select name="method" id="payment_method" class="custom-select block" required>
                    <option value="" selected>-- Select Payment Method --</option>
                    <option value="debit card">Debit Card</option>
                    <option value="credit card">Credit Card</option>
                    <option value="bank accounts">Bank Accounts</option>
                    <?php
                        $fetch_gateways = "SELECT * FROM `gateways`";
                        $gateways = mysqli_query($link, $fetch_gateways);

                        while($gate = mysqli_fetch_array($gateways)) {
                            echo "<option value='".$gate['gateway']."'>".ucwords($gate['gateway'])."</option>";
                        } 
                    ?>
                </select>
              </div>
              <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" rows="4" id="description" name="description" required placeholder="Deposit Description"></textarea>
              </div>
              <button class="btn btn-primary btn-block mt-5">Continue</button>
            </form>
            <!-- Send Money Form end --> 
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