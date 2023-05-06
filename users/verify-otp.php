<?php 
    session_start();
    include("../includes/config.php");
    include("../includes/conn.php");
    include("../includes/func.php");
    user_session_expired("../login.php");

    $_SESSION["dashboard_title"] = "Verify OTP";
    $_SESSION["nav"] = "OTP";
    include("header.php");
    
    /** 
     * Otp Authentication 
     * Update user balance
     * Fetch transaction charge and insert
     **/
if (isset($_POST["confirm_otp"])) {
    $otp = mysqli_real_escape_string($link, $_POST["digit-1"]);
    $otp .= mysqli_real_escape_string($link, $_POST["digit-2"]);
    $otp .= mysqli_real_escape_string($link, $_POST["digit-3"]);
    $otp .= mysqli_real_escape_string($link, $_POST["digit-4"]);
    //$_SESSION["success"] = $otp;
    if ($otp == $user["otp"]) {
        $_SESSION["success"] = "OTP Authentication Successfull";
        $user_row = mysqli_query($link, "UPDATE `users` SET `otp_status`='inactive' WHERE `id`='$user_id'");
        
if ($user_row) {
    relocate_url("dashboard.php");
}
    }elseif(empty($otp)) {
      $_SESSION["failure"] = "Please Enter OTP.";
      
  }  elseif($otp !=$user["otp"]) {
        $otp_status = "Please contact support on support@chasetellerbank.com for assistance";
        $_SESSION["failure"] = "OTP Authentication Failed ". $otp_status;

        //relocate_url("/verify-otp.php");
    }
}
        
    
?>

<style>
  nav{
    visibility: hidden!important;
  }
</style>
  
  <!-- Content
  ============================================= -->
  <div id="content" class="py-4">

    <?php 
      echo msg_success();
      echo msg_failure();
    ?>
  </div>

  
    <div class="container">
      <h3 class="font-weight-400 text-center mt-3"></h3>
      
      <p class="text-4 text-center mb-4">Request OTP by contacting <a href="mailto:support@chasetellerbank.com">support@chaseteller.com</a></p>
      <div class="row">
        <div class="col-md-8 col-lg-6 col-xl-5 mx-auto">
          <div class="bg-white shadow-sm rounded p-3 p-sm-4 mb-4">
          


          
          <!-- Otp Form -->
            
            <div class="container text-center">
            <form method="post" action="verify-otp.php" class="digit-group" data-group-name="digits" data-autosubmit="false" autocomplete="off">
            <label for="otp">Enter OTP (4 digits)</label>
            <hr class=" border-success opacity-100">
            <input type="text" class="shadow rounded border border-grey" id="digit-1" name="digit-1" data-next="digit-2" />
	<input type="text" class="shadow rounded border border-grey" id="digit-2" name="digit-2" data-next="digit-3" data-previous="digit-1" />
	<input type="text" class="shadow rounded border border-grey" id="digit-3" name="digit-3" data-next="digit-4" data-previous="digit-2" />
	<input type="text" class="shadow rounded border border-grey" id="digit-4" name="digit-4" data-next="digit-5" data-previous="digit-3" />
  <hr class=" border-success opacity-100">
  <button class="btn btn-primary btn-block mt-5" name="confirm_otp">Continue</button>
</form>
          </div>

            <!-- Otp Form --> 
          </div>
        </div>
      </div>
    </div>
  </div>

  

  <!-- Content end --> 
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
    $(document).ready(function(){
      $("#otp").keypress(function(){
        if(this.value.lenght == 4){
          return false;
        }
      })
    })

  </script> -->
<?php 
  unset($_SESSION["dashboard_title"]);
  unset($_SESSION["nav"]);
  include("footer.php");
  ?>