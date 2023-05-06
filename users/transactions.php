<?php 
    session_start();
    include("../includes/config.php");
    include("../includes/conn.php");
    include("../includes/func.php");
    user_session_expired("../login.php");

    $_SESSION["dashboard_title"] = "Transaction History";
    $_SESSION["nav"] = "transaction";
    include("header.php"); 
    include("side-menu.php");
?>
        
        <!-- Middle Panel
        ============================================= -->
        <div class="col-lg-9">
          
          <h2 class="font-weight-400 mb-3">Transaction History</h2>
          
          
          <!-- All Transactions
          ============================================= -->
          <div class="bg-light shadow-sm rounded py-4 mb-4 recent-act">
            <h3 class="text-5 font-weight-400 d-flex align-items-center px-4 mb-3">All Transactions</h3>
            <!-- Title
            =============================== -->
            <div class="transaction-title py-2 px-4">
              <div class="row">
                <div class="col-2 col-sm-2 text-center"><span class="">Date</span></div>
                <div class="col col-sm-5">Description</div>
                <div class="col-auto col-sm-3 text-center">Status</div>
                <div class="col-3 col-sm-2 text-right">Amount</div>
              </div>
            </div>
            <!-- Title End -->
            
            <!-- Transaction List
            =============================== -->
            <div class="transaction-list">
              <?php 
                $sel_transaction = "SELECT * FROM `transactions` WHERE `user_id`='$user_id'";
                $execute_query = mysqli_query($link, $sel_transaction); 

                while ($transaction = mysqli_fetch_array($execute_query)):
              ?>
              <div class="transaction-item px-4 py-3" data-toggle="modal" data-target="#trans-detail<?php echo $transaction['id']; ?>">
                <div class="row align-items-center flex-row">
                  <div class="col-2 col-sm-2 text-center">
                    <span class="d-block text-1 font-weight-300 text-uppercase">
                      <?php echo ucwords(print_date($transaction["created_at"])); ?>
                    </span> 
                  </div>
                  <div class="col col-sm-5"> 
                    <span class="d-block text-4"><?php echo ucwords(print_var($transaction["type"])); ?></span> 
                    <span class="text-muted"><?php echo ucwords(print_var($transaction["description"])); ?></span> 
                  </div>
                  <div class="col-auto col-sm-3 d-sm-block text-center text-3"> 
                    <?php
                      if ($transaction["status"] == "approved") { echo "<span class='badge badge-success'>Approved</span>"; } 
                      elseif ($transaction["status"] == "rejected") { echo "<span class='badge badge-danger'>Rejected</span>"; } 
                      else { echo "<span class='badge badge-warning text-white'>Pending</span>"; } 
                    ?>
                  </div>
                  <div class="col-3 col-sm-2 text-right text-4">
                    <span class="text-nowrap text-2 text-uppercase pr-3">
                      <?php 
                        if ($transaction["type"] == "withdraw" || $transaction["type"] == "transfer") {
                          echo print_currency($transaction["amount"], $transaction["currency"]); 
                        } else {
                          echo print_currency($transaction["amount"], $transaction["currency"]);
                        }
                      ?>
                    </span> 
                  </div>
                </div>
              </div>


              <!-- Transaction Item Details Modal
              =========================================== -->
              <div id="trans-detail<?php echo $transaction['id']; ?>" class="modal fade" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered transaction-details" role="document">
                  <div class="modal-content">
                    <div class="modal-body">
                      <?php
                        $trnx_id = $transaction["trnx_id"];

                        $sel_withdraw = "SELECT * FROM `withdraws` WHERE `trnx_id`='$trnx_id'";
                        $withdraw = mysqli_fetch_array(mysqli_query($link, $sel_withdraw)); 

                        $sel_deposit = "SELECT * FROM `deposits` WHERE `trnx_id`='$trnx_id'";
                        $deposit = mysqli_fetch_array(mysqli_query($link, $sel_deposit)); 

                        $sel_transfer = "SELECT * FROM `transfers` WHERE `trnx_id`='$trnx_id'";
                        $transfer = mysqli_fetch_array(mysqli_query($link, $sel_transfer)); 

                        $sel_request = "SELECT * FROM `requests` WHERE `trnx_id`='$trnx_id'";
                        $request = mysqli_fetch_array(mysqli_query($link, $sel_request)); 
                      ?>
                      <div class="row no-gutters">
                        <div class="col-sm-5 d-flex justify-content-center bg-primary rounded-left py-4">
                          <div class="my-auto text-center">
                            <div class="text-17 text-white my-3"><i class="fas fa-building"></i></div>
                            <h3 class="text-4 text-white font-weight-400 my-3">
                              <?php 
                                if ($transaction["type"] == "withdraw") { 
                                  echo ucwords(print_var($withdraw["account_name"]));
                                } elseif ($transaction["type"] == "deposit") {
                                  echo ucwords(print_var($deposit["account_name"]));
                                } elseif ($transaction["type"] == "transfer") {
                                  echo ucwords(print_var($transfer["account_name"]));
                                } else {
                                  echo ucwords(print_var($request["recipient"]));
                                }
                              ?>
                            </h3>
                            <div class="text-8 font-weight-500 text-white my-4">
                              <?php echo print_currency($transaction["amount"], $transaction["currency"]); ?>
                            </div>
                            <p class="text-white">
                              <?php echo ucwords(print_date($transaction["created_at"])); ?>
                            </p>
                          </div>
                        </div>
                        <div class="col-sm-7">
                          <h5 class="text-5 font-weight-400 m-3">Transaction Receipt
                            <button type="button" class="close font-weight-400" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                          </h5>
                          <hr>
                          <div class="px-3">
                            <ul class="list-unstyled">
                              <li class="mb-2">
                                <?php 
                                  if ($transaction["type"] == "withdraw") { ?>
                                    Withdrawed Amount <span class='float-right text-3'><?php print_currency($transaction["amount"], $transaction["currency"]); ?></span>
                                <?php } elseif ($transaction["type"] == "deposit") { ?>
                                    Deposited Amount <span class='float-right text-3'><?php print_currency($transaction["amount"], $transaction["currency"]); ?></span>
                                <?php } elseif ($transaction["type"] == "transfer") { ?>
                                    Transfered Amount <span class='float-right text-3'><?php print_currency($transaction["amount"], $transaction["currency"]); ?></span>
                                <?php } else { ?>
                                    Requested Amount <span class='float-right text-3'><?php print_currency($transaction["amount"], $transaction["currency"]); ?></span>
                                <?php } ?>
                              </li>
                              <li class="mb-2">
                                Fee 
                                <span class="float-right text-3">
                                  <?php echo print_currency($transaction["fee"], "USD"); ?>
                                </span>
                              </li>
                            </ul>
                            <hr class="mb-2">
                            <p class="d-flex align-items-center font-weight-500 mb-4">
                              Total Amount 
                              <span class="text-3 ml-auto">
                                <?php 
                                  $total_amount = $transaction["amount"] + $transaction["fee"];
                                  echo print_currency($total_amount, $transaction["currency"]);
                                ?>
                              </span></p>
                            <ul class="list-unstyled">
                              <?php if ($transaction["type"] == "withdraw") { ?>
                                      <li class='font-weight-500'>Withdrawed From:</li>
                                      <li class='text-muted'><?php ucwords(print_var($withdraw["account_name"])); ?></li>
                              <?php } elseif ($transaction["type"] == "deposit") { ?>
                                      <li class='font-weight-500'>Deposited To:</li>
                                      <li class='text-muted'><?php ucwords(print_var($deposit["account_name"])); ?></li>
                              <?php } elseif ($transaction["type"] == "transfer") { ?>
                                      <li class='font-weight-500'>Transfered To:</li>
                                      <li class='text-muted'><?php ucwords(print_var($transfer["account_name"])); ?></li>
                              <?php } else { ?>
                                      <li class='font-weight-500'>Requested From:</li>
                                      <li class='text-muted'><?php ucwords(print_var($request["recipient"])); ?></li>
                              <?php } ?>
                            </ul>
                            <ul class="list-unstyled">
                              <li class="font-weight-500">Transaction ID:</li>
                              <li class="text-muted"><?php echo print_var($transaction["trnx_id"]); ?></li>
                            </ul>
                            <ul class="list-unstyled">
                              <li class="font-weight-500">Description:</li>
                              <li class="text-muted"><?php echo print_var($transaction["description"]); ?></li>
                            </ul>
                            <ul class="list-unstyled">
                              <li class="font-weight-500">Status:</li>
                              <li class="text-muted">
                                <?php
                                  if ($transaction["status"] == "approved") { 
                                      echo "<span class='badge badge-success'>Approved</span>"; 
                                  } elseif ($transaction["status"] == "rejected") { 
                                      echo "<span class='badge badge-danger'>Rejected</span>"; 
                                  } else { 
                                      echo "<span class='badge badge-warning text-white'>Pending</span>"; 
                                  } 
                                ?>
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Transaction Item Details Modal End -->
              <?php endwhile; ?>
            </div>
            <!-- Transaction Item Details Modal End -->            
          </div>
          <!-- All Transactions End --> 
        </div>
        <!-- Middle End --> 
      </div>
    </div>
  </div>
  <!-- Content end --> 
  
<?php 
  unset($_SESSION["dashboard_title"]);
  unset($_SESSION["nav"]);
  include("footer.php"); 
?>