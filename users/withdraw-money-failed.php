<?php 
    session_start();
    include("../includes/config.php");
    include("../includes/conn.php");
    include("../includes/func.php");
    user_session_expired("../login.php");

    $_SESSION["dashboard_title"] = "Withdraw Failed";
    $_SESSION["nav"] = "withdraw";
    include("header.php"); 
?>
  
  <!-- Content
  ============================================= -->
  <div id="content" class="py-4">
    <div class="container">
      <h2 class="font-weight-400 text-center mt-3 mb-4">Withdraw Money</h2>
      <div class="row">
        <div class="col-md-8 col-lg-6 col-xl-5 mx-auto">
          <div class="bg-light shadow-sm rounded p-3 p-sm-4 mb-4">
            <div class="text-center my-5">
            <p class="text-center text-danger text-20 line-height-07"><i class="fas fa-exclamation-triangle"></i></p>
            <p class="text-center text-danger text-8 line-height-07">Error!</p>
            <p class="text-center text-4">Transactions Failed...</p>
            </div>
            <p class="text-center text-3 mb-4">
              Sorry you are unable to withdraw at the moment.<br>
              Please contact <a href="mailto:contact@chastellerbank.com" class="text-success font-weight-500">contact@chasetellerbank.com</a> for more information.
            </p>
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