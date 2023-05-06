<?php 
    session_start();
    include("../includes/config.php");
    include("../includes/conn.php");
    include("../includes/func.php");
    user_session_expired("../login.php");

    $_SESSION["dashboard_title"] = "Bank Account and Card Settings";
    $_SESSION["nav"] = "bank_and_card";
    include("header.php"); 
    include("side-menu.php");

     /** 
     * Add a new card
     **/
    if (isset($_POST["add_card"])) 
    {
        $userId = mysqli_real_escape_string($link, $_POST["user"]);
        $cardHolder = mysqli_real_escape_string($link, $_POST["cardHolder"]);
        $cardProvider = mysqli_real_escape_string($link, $_POST["cardProvider"]);
        $cardNumber = mysqli_real_escape_string($link, $_POST["cardNumber"]);
        $cardType = mysqli_real_escape_string($link, $_POST["cardType"]);
        $expiryDate = mysqli_real_escape_string($link, $_POST["expiryDate"]);
        $cvvNumber = mysqli_real_escape_string($link, $_POST["cvvNumber"]);

        if (empty($user)) {
            $_SESSION["failure"] = "Please select a user.";
        }
        elseif (empty($cardHolder)) {
            $_SESSION["failure"] = "Please fill out the card holder name.";
        }
        elseif (empty($cardProvider)) {
            $_SESSION["failure"] = "Please select a card provider.";
        }
        elseif (empty($cardNumber)) {
            $_SESSION["failure"] = "Please fill out the card number.";
        }
        elseif (empty($cardType)) {
            $_SESSION["failure"] = "Please select a card type.";
        }
        elseif (empty($expiryDate)) {
            $_SESSION["failure"] = "Please enter the card expiry date.";
        }
        elseif (empty($cvvNumber)) {
            $_SESSION["failure"] = "Please fill out your cvv.";
        }
        elseif (!validateCC($cardNumber)) {
            $_SESSION["failure"] = "Invalid credit card number. Please check.";
        }
        else {
          # Insert new bank account
          $card_statement = "INSERT INTO `cards` (`user_id`, `card_holder`, `card_provider`, `card_number`, `card_type`, `expiry_date`, `cvv`) ".
                               "VALUES ('$userId', '$cardHolder', '$cardProvider', '$cardNumber', '$cardType', '$expiryDate', '$cvvNumber')";
          $insert_card = mysqli_query($link, $card_statement);


            if ($insert_card) {
                $_SESSION["successful"] = "Your card has been added successfully. Please note that it may take a while to verify and approve.";
                relocate_url("profile-cards-and-bank.php");
            } 
            else {
                $_SESSION["failure"] = "Something went wrong unable to add a new card. Please contact CliffTopBank customer care if failure persists.";
                relocate_url("profile-cards-and-bank.php");
            }
        }
    }


    /** 
     * Add a new bank account
     **/
    if (isset($_POST["add_account"])) 
    {
        $user = mysqli_real_escape_string($link, $_POST["user"]);
        $bank = mysqli_real_escape_string($link, $_POST["bank"]);
        $account_name = mysqli_real_escape_string($link, $_POST["accountName"]);
        $account_no = mysqli_real_escape_string($link, $_POST["accountNumber"]);
        $account_type = mysqli_real_escape_string($link, $_POST["accountType"]);

        if (empty($bank)) {
            $_SESSION["failure"] = "Please fill out the bank name.";
        }
        elseif (empty($account_name)) {
            $_SESSION["failure"] = "Please fill out the account name.";
        }
        elseif (empty($account_no)) {
            $_SESSION["failure"] = "Please fill out the account number.";
        }
        elseif (empty($account_type)) {
            $_SESSION["failure"] = "Please select an account type.";
        }
        else {
            # Insert new bank account
            $account_statement = "INSERT INTO `bank_accounts` (`user_id`, `bank`, `account_name`, `account_no`, `account_type`) ".
                                 "VALUES ('$user', '$bank', '$account_name', '$account_no', '$account_type')";
            $insert_account = mysqli_query($link, $account_statement);


            if ($insert_account) {
                $_SESSION["successful"] = "Your bank account has been added successfully. Please note that it may take a while to verify and approve.";
                relocate_url("profile-cards-and-bank.php");
            } 
            else {
                $_SESSION["failure"] = "Something went wrong unable to add a new bank account. Please contact CliffTopBank customer care if failure persists.";
                relocate_url("profile-cards-and-bank.php");
            }
        }
    }
?>
        
        <!-- Middle Panel
        ============================================= -->
        <div class="col-lg-9">

          <?php 
            echo msg_success();
            echo msg_failure();
          ?>
          
          <!-- Credit or Debit Cards
          ============================================= -->
          <div class="bg-light shadow-sm rounded p-4 mb-4">
            <h3 class="text-5 font-weight-400 mb-4">
              Credit or Debit Cards <span class="text-muted text-4">(for payments)</span>
            </h3>
            <div class="row">
              <div class="col-12 col-sm-6 col-lg-6">
                <?php 
                  $query = "SELECT * FROM `cards` WHERE `user_id`='$user_id' ORDER BY `created_at` DESC";
                  $result = mysqli_query($link, $query);

                  while ($card_row = mysqli_fetch_array($result)):
                ?>
                <div class="account-card text-white rounded p-3 mb-4 mb-lg-0">
                  <p class="text-4"><?php echo print_var(mask(format_card($card_row["card_number"]), "X")); ?></p>
                  <p class="d-flex align-items-center"> 
                    <span class="account-card-expire text-uppercase d-inline-block opacity-6 mr-2">Valid<br>thru<br></span> 
                    <span class="text-4 opacity-9"><?php echo print_var($card_row["expiry_date"]); ?></span> 
                    <span class="text-0 d-inline-block px-2 line-height-4 ml-auto">
                      <?php
                        if ($card_row["status"] == "active") { 
                            echo "Active <span class='text-3'><i class='fas fa-check-circle'></i></span>";
                        } elseif ($card_row["status"] == "disabled") { 
                            echo "Disabled <span class='text-3'><i class='fas fa-times-circle'></i></span>";
                        } else { 
                            echo "Pending <span class='text-3'><i class='fas fa-minus-circle'></i></span>"; 
                        } 
                      ?>
                    </span> 
                  </p>
                  <p class="d-flex align-items-center m-0">
                    <span class="text-uppercase font-weight-500"><?php echo print_var($card_row["card_holder"]); ?></span>
                    <?php 
                      if ($card_row["card_provider"] == "visa") {
                        echo "<i class='fab fa-cc-visa ml-auto text-12'></i>";
                      } elseif ($card_row["card_provider"] == "mastercard") {
                        echo "<i class='fab fa-cc-mastercard ml-auto text-12'></i>";
                      } elseif ($card_row["card_provider"] == "american express") {
                        echo "<i class='fab fa-cc-amex ml-auto text-12'></i>";
                      } elseif ($card_row["card_provider"] == "discover") {
                        echo "<i class='fab fa-cc-discover ml-auto text-12'></i>";
                      } elseif ($card_row["card_provider"] == "diners club") {
                        echo "<i class='fab fa-cc-diners-club ml-auto text-12'></i>";
                      } 
                    ?>
                  </p>
                  <div class="account-card-overlay rounded">
                    <a href="#" data-target="#edit-card<?php echo $card_row["id"]; ?>" data-toggle="modal" class="text-light btn-link mx-2">
                      <span class="mr-1"><i class="fas fa-edit"></i></span>Edit
                    </a> 
                    <a href="profile-card-delete.php?cardId=<?php echo($card_row["id"]); ?>" class="text-light btn-link mx-2" onclick="return confirm('Are you sure you want to delete this card?');">
                      <span class="mr-1"><i class="fas fa-trash-alt"></i></span>Delete
                    </a> 
                  </div>
                </div>

                <!-- Edit Card Details Modal
                ================================== -->
                <div id="edit-card<?php echo $card_row["id"]; ?>" class="modal fade" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title font-weight-400">Update Card</h5>
                        <button type="button" class="close font-weight-400" data-dismiss="modal" aria-label="Close"> 
                          <span aria-hidden="true">&times;</span> 
                        </button>
                      </div>
                      <div class="modal-body p-4">
                        <form id="updateCard" action="" method="post">
                          <input type="hidden" name="id" value="<?php echo $card_row["id"]; ?>">
                          <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">

                          <div class="form-group">
                            <label for="card_number">Card Number</label>
                            <div class="input-group">
                              <input type="text" class="form-control" name="card_number" id="card_number" disabled value="<?php echo print_var(mask(format_card($card_row["card_number"]), "X")); ?>" placeholder="Card Number">
                            </div>
                          </div>
                          <div class="form-row">
                            <div class="col-lg-6">
                              <div class="form-group">
                                <label for="expiry_date">Expiry Date</label>
                                <input id="expiry_date" type="text" class="form-control" name="expiry_date" required value="<?php echo $card_row["expiry_date"]; ?>" placeholder="MM/YY">
                              </div>
                            </div>
                            <div class="col-lg-6">
                              <div class="form-group">
                                <label for="cvv">CVV <span class="text-info ml-1" data-toggle="tooltip" data-original-title="For Visa/Mastercard, the three-digit CVV number is printed on the signature panel on the back of the card immediately after the card's account number. For American Express, the four-digit CVV number is printed on the front of the card above the card account number."><i class="fas fa-question-circle"></i></span></label>
                                <input id="cvv" type="password" class="form-control" name="cvv" required value="<?php echo $card_row["cvv"]; ?>" placeholder="CVV (3 digits)">
                              </div>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="card_holder">Card Holder Name</label>
                            <input type="text" class="form-control" name="card_holder" id="card_holder" required value="<?php echo $card_row["card_holder"]; ?>" placeholder="Card Holder Name">
                          </div>

                          <button class="btn btn-primary btn-block" type="submit" name="update_card">Update Card</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <?php endwhile; ?>
              </div>

              <div class="col-12 col-sm-6 col-lg-6 mt-4"> 
                <a href="" data-target="#add-new-card-details" data-toggle="modal" class="account-card-new d-flex align-items-center rounded h-100 p-3 mb-4 mb-lg-0">
                  <p class="w-100 text-center line-height-4 m-0"> 
                    <span class="text-3"><i class="fas fa-plus-circle"></i></span> 
                    <span class="d-block text-body text-3">Add New Card</span> 
                  </p>
                </a> 
              </div>
            </div>
          </div>
          
          <!-- Add New Card Details Modal
          ================================== -->
          <div id="add-new-card-details" class="modal fade" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title font-weight-400">Add a Card</h5>
                  <button type="button" class="close font-weight-400" data-dismiss="modal" aria-label="Close"> 
                    <span aria-hidden="true">&times;</span> 
                  </button>
                </div>
                <div class="modal-body p-4">
                  <form id="addCard" action="" method="post">
                    <input type="hidden" name="user" value="<?php echo $user_id; ?>">
                    <div class="mb-4">
                      <div class="custom-control custom-radio custom-control-inline">
                        <input id="credit" name="cardType" class="custom-control-input" checked required type="radio" value="credit">
                        <label class="custom-control-label" for="credit">Credit</label>
                      </div>
                      <div class="custom-control custom-radio custom-control-inline">
                        <input id="debit" name="cardType" class="custom-control-input" required type="radio" value="debit">
                        <label class="custom-control-label" for="debit">Debit</label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="cardProvider">Card Provider</label>
                      <select id="cardProvider" class="custom-select" name="cardProvider" required>
                        <option value="" selected>-- Select Card Provider --</option>
                        <option value="visa">Visa</option>
                        <option value="mastercard">MasterCard</option>
                        <option value="american express">American Express</option>
                        <option value="discover">Discover</option>
                        <option value="diners club">Diners Club</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="cardNumber">Card Number</label>
                      <input type="text" class="form-control" name="cardNumber" id="cardNumber" required placeholder="Card Number">
                    </div>
                    <div class="form-row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="expiryDate">Expiry Date</label>
                          <input type="text" class="form-control" name="expiryDate" id="expiryDate" required placeholder="MM/YY">
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="cvvNumber">
                            CVV <span class="text-info ml-1" data-toggle="tooltip" data-original-title="For Visa/Mastercard, the three-digit CVV number is printed on the signature panel on the back of the card immediately after the card's account number. For American Express, the four-digit CVV number is printed on the front of the card above the card account number."><i class="fas fa-question-circle"></i></span>
                          </label>
                          <input id="cvvNumber" type="password" class="form-control" name="cvvNumber" required value="" placeholder="CVV (3 digits)">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="cardHolder">Card Holder Name</label>
                      <input type="text" class="form-control" name="cardHolder" id="cardHolder" required placeholder="Card Holder Name">
                    </div>

                    <button class="btn btn-primary btn-block" type="submit" name="add_card">Add Card</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- Credit or Debit Cards End -->
          
          <!-- Bank Accounts
          ============================================= -->
          <div class="bg-light shadow-sm rounded p-4 mb-4">
            <h3 class="text-5 font-weight-400 mb-4">Bank Accounts <span class="text-muted text-4">(for withdrawal)</span></h3>
            <div class="row">
              <div class="col-12 col-sm-6">
                <?php 
                  $bank_query = "SELECT * FROM `bank_accounts` WHERE `user_id`='$user_id' ORDER BY `created_at` DESC";
                  $bank_result = mysqli_query($link, $bank_query);

                  while ($bank_row = mysqli_fetch_array($bank_result)):
                ?>
                <div class="account-card account-card-primary text-white rounded mb-4 mb-lg-0">
                  <div class="row no-gutters">
                    <div class="col-3 d-flex justify-content-center p-3">
                      <div class="my-auto text-center text-13"> 
                        <i class="fas fa-university"></i>
                      </div>
                    </div>
                    <div class="col-9 border-left">
                      <div class="py-4 my-2 pl-4">
                        <p class="text-4 font-weight-500 mb-1"><?php echo ucwords(print_var($bank_row["account_name"])); ?></p>
                        <p class="text-4 opacity-9 mb-1"><?php echo print_var(mask(format_account_no($bank_row["account_no"]), "X")); ?></p>
                        <p class="m-0">
                          <?php
                            if ($bank_row["status"] == "active") { 
                                echo "Active <span class='text-3'><i class='fas fa-check-circle'></i></span>";
                            } elseif ($bank_row["status"] == "disabled") { 
                                echo "Disabled <span class='text-3'><i class='fas fa-times-circle'></i></span>";
                            } else { 
                                echo "Pending <span class='text-3'><i class='fas fa-minus-circle'></i></span>"; 
                            } 
                          ?>
                        </p>
                      </div>
                    </div>
                  </div>
                  <div class="account-card-overlay rounded"> 
                    <a href="#" data-target="#bank-account<?php echo $bank_row["id"]; ?>" data-toggle="modal" class="text-light btn-link mx-2">
                      <span class="mr-1"><i class="fas fa-share"></i></span>More Details
                    </a> 
                    <a href="profile-bank-delete.php?bankId=<?php echo($bank_row["id"]); ?>" class="text-light btn-link mx-2" onclick="return confirm('Are you sure you want to delete this bank account?');">
                      <span class="mr-1"><i class="fas fa-trash-alt"></i></span>Delete
                    </a> 
                  </div>
                </div>

                <!-- Edit Bank Account Details Modal
                ======================================== -->
                <div id="bank-account<?php echo $bank_row["id"]; ?>" class="modal fade" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered transaction-details" role="document">
                    <div class="modal-content">
                      <div class="modal-body">
                        <div class="row no-gutters">
                          <div class="col-sm-5 d-flex justify-content-center bg-primary rounded-left py-4">
                            <div class="my-auto text-center">
                              <div class="text-17 text-white mb-3"><i class="fas fa-university"></i></div>
                              <h3 class="text-6 text-white my-3"><?php echo ucwords(print_var($bank_row["bank"])); ?></h3>
                              <div class="text-4 text-white my-4"><?php echo print_var($bank_row["account_no"]); ?></div>
                            </div>
                          </div>
                          <div class="col-sm-7">
                            <h5 class="text-5 font-weight-400 m-3">Bank Account Details
                              <button type="button" class="close font-weight-400" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                            </h5>
                            <hr>
                            <div class="px-3">
                              <ul class="list-unstyled">
                                <li class="font-weight-500">Account Type:</li>
                                <li class="text-muted"><?php echo ucwords(print_var($bank_row["account_type"])); ?></li>
                              </ul>
                              <ul class="list-unstyled">
                                <li class="font-weight-500">Account Name:</li>
                                <li class="text-muted"><?php echo ucwords(print_var($bank_row["account_name"])); ?></li>
                              </ul>
                              <ul class="list-unstyled">
                                <li class="font-weight-500">Account Number:</li>
                                <li class="text-muted"><?php echo print_var(format_account_no($bank_row["account_no"])); ?></li>
                              </ul>
                              <ul class="list-unstyled">
                                <li class="font-weight-500">Status:</li>
                                <li class="text-muted">
                                  <?php
                                    if ($bank_row["status"] == "active") { 
                                        echo "Active <span class='text-3'><i class='fas fa-check-circle'></i></span>";
                                    } elseif ($bank_row["status"] == "disabled") { 
                                        echo "Disabled <span class='text-3'><i class='fas fa-times-circle'></i></span>";
                                    } else { 
                                        echo "Pending <span class='text-3'><i class='fas fa-minus-circle'></i></span>"; 
                                    } 
                                  ?>
                                </li>
                              </ul>
                              <p>
                                <a href="profile-bank-delete.php?bankId=<?php echo($bank_row["id"]); ?>" class="btn btn-sm btn-outline-danger btn-block shadow-none" onclick="return confirm('Are you sure you want to delete this bank account?');">
                                  <span class="mr-1"><i class="fas fa-trash-alt"></i></span>Delete Account
                                </a>
                              </p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endwhile; ?>
              </div>

              <div class="col-12 col-sm-6"> 
                <a href="" data-target="#add-new-bank-account" data-toggle="modal" class="account-card-new d-flex align-items-center rounded h-100 p-3 mb-4 mb-lg-0">
                  <p class="w-100 text-center line-height-4 m-0"> 
                    <span class="text-3"><i class="fas fa-plus-circle"></i></span> 
                    <span class="d-block text-body text-3">Add New Bank Account</span> 
                  </p>
                </a> 
              </div>
            </div>
          </div>
          
          <!-- Add New Bank Account Details Modal
          ======================================== -->
          <div id="add-new-bank-account" class="modal fade" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title font-weight-400">Add bank account</h5>
                  <button type="button" class="close font-weight-400" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                </div>
                <div class="modal-body p-4">
                  <form id="addbankaccount" method="post">
                    <input type="hidden" name="user" value="<?php echo $user_id; ?>">
                    <div class="mb-3">
                      <div class="custom-control custom-radio custom-control-inline">
                        <input id="personal" name="accountType" class="custom-control-input" checked required type="radio" value="personal">
                        <label class="custom-control-label" for="personal">Personal</label>
                      </div>
                      <div class="custom-control custom-radio custom-control-inline">
                        <input id="business" name="accountType" class="custom-control-input" required type="radio" value="business">
                        <label class="custom-control-label" for="business">Business</label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="bank">Bank Name</label>
                      <input type="text" class="form-control" name="bank" id="bank" required placeholder="e.g HFSC Bank">
                    </div>
                    <div class="form-group">
                      <label for="accountName">Account Name</label>
                      <input type="text" class="form-control" name="accountName" id="accountName" required placeholder="e.g. Smith Rhodes">
                    </div>
                    <div class="form-group">
                      <label for="accountNumber">Account Number</label>
                      <input type="text" class="form-control" name="accountNumber" id="accountNumber" required placeholder="e.g. 12346678900001">
                    </div>

                    <button class="btn btn-primary btn-block" type="submit" name="add_account">Add Bank Account</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- Bank Accounts End -->
          
        </div>
        <!-- Middle Panel End --> 
      </div>
    </div>
  </div>
  <!-- Content end --> 
  
<?php 
  unset($_SESSION["dashboard_title"]);
  unset($_SESSION["nav"]);
  include("footer.php"); 

  /** 
     * Edit card
     **/
    if (isset($_POST["update_card"])) 
    {
        $id = mysqli_real_escape_string($link, $_POST["id"]);
        $user_id = mysqli_real_escape_string($link, $_POST["user_id"]);
        $card_holder = mysqli_real_escape_string($link, $_POST["card_holder"]);
        $expiry_date = mysqli_real_escape_string($link, $_POST["expiry_date"]);
        $cvv = mysqli_real_escape_string($link, $_POST["cvv"]);
        $log = get_date();

        if (empty($card_holder)) {
            $_SESSION["failure"] = "Please fill out the card holder name.";
        }
        elseif (empty($expiry_date)) {
            $_SESSION["failure"] = "Please enter the card expiry date.";
        }
        elseif (empty($cvv)) {
            $_SESSION["failure"] = "Please fill out your cvv.";
        }
        else {
            // Update the cards table with the new passed values.
            $card_statement = "UPDATE `cards` ".
                                 "SET `user_id`='$user_id', `card_holder`='$card_holder', `expiry_date`='$expiry_date', `cvv`='$cvv', `updated_at`='$log' ".
                                 "WHERE `id`='$upd_id'";
            $update_card = mysqli_query($link, $card_statement);

            // Confirm if all transactions was successful
            if ($update_card) {
              $_SESSION["successful"] = "Your card has been updated successfully. Please note that it may take a while to verify and approve.";
              relocate_url("profile-cards-and-bank.php");
            } 
            else {
              $_SESSION["failure"] = "Something went wrong unable to update card. Please contact CliffTopBank customer care if failure persists.";
              relocate_url("profile-cards-and-bank.php");
            }
        }
    }
?>