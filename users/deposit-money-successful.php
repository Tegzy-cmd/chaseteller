<?php 
    session_start();
    include("../includes/config.php");
    include("../includes/conn.php");
    include("../includes/func.php");
    user_session_expired("../login.php");

    $_SESSION["dashboard_title"] = "Deposit Successful";
    $_SESSION["nav"] = "deposit";
    include("header.php"); 
?>
  
  <!-- Content
  ============================================= -->
  <div id="content" class="py-4">
    <div class="container">
      <h2 class="font-weight-400 text-center mt-3 mb-4">Deposit Money</h2>
      <div class="row">
        <div class="col-md-8 col-lg-6 col-xl-5 mx-auto">
          <div class="bg-light shadow-sm rounded p-3 p-sm-4 mb-4">
            <div class="text-center my-5">
            <p class="text-center text-success text-20 line-height-07"><i class="fas fa-check-circle"></i></p>
            <p class="text-center text-success text-8 line-height-07">Success!</p>
            <p class="text-center text-4">Transaction Complete...</p>
            </div>
            <p class="text-center text-3 mb-4">
              Your deposit was successfully.<br>See transaction details under 
              <a href="transactions.php">Activity</a>.
            </p>
            <a href="deposit-money.php" class="btn btn-primary btn-block">Deposit Money Again</a>
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