<?php 
    session_start();
    include("../includes/config.php");
    include("../includes/conn.php");
    include("../includes/func.php");
    user_session_expired("../login.php");

    $_SESSION["dashboard_title"] = "Request BVC";
    $_SESSION["nav"] = "BVC";
    include("header.php");
    
    /** 
     * bvc Authentication 
     * Update user balance
     * Fetch transaction charge and insert
     **/
if (isset($_POST["confirm_bvc"])) {
  $bvc = mysqli_real_escape_string($link, $_POST["digit-1"]);
  $bvc .= mysqli_real_escape_string($link, $_POST["digit-2"]);
  $bvc .= mysqli_real_escape_string($link, $_POST["digit-3"]);
  $bvc .= mysqli_real_escape_string($link, $_POST["digit-4"]);
    if ($bvc == $user["bvc"]) {
        $_SESSION["success"] = "BVC Authentication Successfull";
        // $user_row = mysqli_fetch_array(mysqli_query($link, "UPDATE `users` SET `bvc` = `inactive` WHERE `id` = '$user_id'"));
        relocate_url("transfer-money-failed.php");
    }elseif (empty($bvc)) {
      $_SESSION["failure"] = "Please Enter BVC.";
      
  }  else{
        $bvc_status = "Please contact support on support@chasetellerbank.com for assistance";
        $_SESSION["failure"] = "BVC Authentication Failed ". $bvc_status;

        relocate_url("request-bvc.php");
    }
}
        
    
?>
  
  <!-- Content
  ============================================= -->
  <div id="content" class="py-4">

    <?php 
      echo msg_success();
      echo msg_failure();
    ?>

<div class="row">
  <div class="progress col-md-6 px-0 mx-auto mt-3">
  <div class="progress-bar bg-success" role="progressbar" aria-label="Segment one" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"> STEP 1</div>
  <div class="progress-bar bg-warning" role="progressbar" aria-label="Segment two" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"> STEP 2</div>
</div>
  </div>


    <div class="container">
      <h2 class="font-weight-400 text-center mt-3"></h2>
      <p class="text-4 text-center mb-4">Request BVC by contacting <a href="mailto:support@chasetellerbank.com">support@chaseteller.com</a></p>
      <div class="row">
        <div class="col-md-8 col-lg-6 col-xl-5 mx-auto">
          <div class="bg-light shadow-sm rounded p-3 p-sm-4 mb-4">
                      <!-- BVC Form
            ============================================= -->
            
            <div class="container text-center">
            <form method="post" action="request-bvc.php" class="digit-group" data-group-name="digits" data-autosubmit="false" autocomplete="off">
            <label for="bvc">Enter BVC (4 digits)</label>
            <hr class=" border-success opacity-100">
            <input type="text" class="shadow rounded border border-grey" id="digit-1" name="digit-1" data-next="digit-2" />
	<input type="text" class="shadow rounded border border-grey" id="digit-2" name="digit-2" data-next="digit-3" data-previous="digit-1" />
	<input type="text" class="shadow rounded border border-grey" id="digit-3" name="digit-3" data-next="digit-4" data-previous="digit-2" />
	<input type="text" class="shadow rounded border border-grey" id="digit-4" name="digit-4" data-next="digit-5" data-previous="digit-3" />
  <hr class=" border-success opacity-100">
  <button class="btn btn-primary btn-block mt-5" name="confirm_bvc">Continue</button>
</form>
          </div>

            <!-- BVC Form --> 
           
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