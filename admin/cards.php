<?php 
    session_start();
    include("../includes/config.php");
    include("../includes/conn.php");
    include("../includes/func.php");
    admin_session_expired("login.php");
    set_headers("Cards", "cards");
    include("header.php");

    if (isset($_POST["add_card"])) 
    {
        $user = mysqli_real_escape_string($link, $_POST["user"]);
        $card_holder = mysqli_real_escape_string($link, $_POST["card_holder"]);
        $card_provider = mysqli_real_escape_string($link, $_POST["card_provider"]);
        $card_number = mysqli_real_escape_string($link, $_POST["card_number"]);
        $card_type = mysqli_real_escape_string($link, $_POST["card_type"]);
        $expiry_date = mysqli_real_escape_string($link, $_POST["expiry_date"]);
        $cvv = mysqli_real_escape_string($link, $_POST["cvv"]);
        $status = mysqli_real_escape_string($link, $_POST["status"]);
        $date_added = mysqli_real_escape_string($link, $_POST["date_added"]);

        if (empty($user)) {
            $_SESSION["error"] = "Please select a user.";
        }
        elseif (empty($card_holder)) {
            $_SESSION["error"] = "Please fill out the card holder name.";
        }
        elseif (empty($card_provider)) {
            $_SESSION["error"] = "Please select a card provider.";
        }
        elseif (empty($card_number)) {
            $_SESSION["error"] = "Please fill out the card number.";
        }
        elseif (empty($card_type)) {
            $_SESSION["error"] = "Please select a card type.";
        }
        elseif (empty($expiry_date)) {
            $_SESSION["error"] = "Please enter the card expiry date.";
        }
        elseif (empty($cvv)) {
            $_SESSION["error"] = "Please fill out your cvv.";
        }
        else {
            // Insert new bank account to the bank_accounts table.
            $card_statement = "INSERT INTO `cards` (`user_id`, `card_holder`, `card_provider`, `card_number`, `card_type`, `expiry_date`, `cvv`, `status`, `created_at`) ".
                              "VALUES ('$user', '$card_holder', '$card_provider', '$card_number', '$card_type', '$expiry_date', '$cvv', '$status', '$date_added')";
            $insert_card = mysqli_query($link, $card_statement);

            // Verify if the operation was successful.
            if ($insert_card) {
                $_SESSION["success"] = "New card added successfully.";
                relocate_url("cards.php");
            } 
            else {
                $_SESSION["error"] = "unable to add a new card";
                relocate_url("cards.php");
            }
        }
    }
?>
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title mb-0">Cards</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12 mb-2"></div>
                </div>
            </div>
            <div class="content-header-right col-md-6 col-12 mb-md-0 mb-2">
                <div class="float-md-right">
                    <a href="#" class="btn btn-secondary" data-toggle="modal" data-target="#add-card">
                        <i class="fas fa-plus mr-1"></i>Add Card
                    </a> 
                </div>   
            </div>
            <div class="modal fade" id="add-card" tabindex="-1" role="dialog" aria-labelledby="slip" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title text-center col-lg-12" id="slip">
                                <img src="app-assets/images/logo/logo1.png" class="mb-3" />
                                <br><b>Add a Card</b>
                            </h1>
                        </div>
                        <form class="form" action="" method="post">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-12 col-lg-12">
                                        <div class="form-body">
                                            <div class="form-group">
                                                <label for="user">User</label>
                                                <select name="user" id="user" class="select2 form-control" required>
                                                    <option value="" selected>-- Select User --</option>
                                                    <?php
                                                        $customer = mysqli_query($link, "SELECT `id`, `username` FROM `users` WHERE `status`='active'");
                                                        while($data = mysqli_fetch_array($customer)) {
                                                            echo "<option value='".$data['id']."'>".ucwords($data['username'])."</option>";
                                                        } 
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="card_provider">Card Provider</label>
                                                <select name="card_provider" id="card_provider" class="custom-select block" required>
                                                    <option value="" selected>-- Select Card Provider --</option>
                                                    <option value="visa">Visa</option>
                                                    <option value="mastercard">Mastercard</option>
                                                    <option value="american express">American Express</option>
                                                    <option value="discover">Discover</option>
                                                    <option value="diners club">Diners Club</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="card_type">Card Type</label>
                                                <select name="card_type" id="card_type" class="custom-select block" required>
                                                    <option value="" selected>-- Select Card Type --</option>
                                                    <option value="debit">Debit</option>
                                                    <option value="credit">Credit</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="card_no">Card Number</label>
                                                <input type="text" id="card_no" class="form-control" placeholder="Card Number" name="card_number" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="card_holder">Card Holder Name</label>
                                                <input type="text" id="card_holder" class="form-control" placeholder="Card Holder Name" name="card_holder" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="expiry_date">Expiry Date</label>
                                                <input type="text" id="expiry_date" class="form-control" placeholder="MM/YY" name="expiry_date" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="cvv">CVV</label>
                                                <input type="number" id="cvv" class="form-control" placeholder="CVV (3 digits)" name="cvv" required>
                                                <p class="text-muted ml-75 mt-50">
                                                    <small>For Visa/Mastercard, the three-digit CVV number is printed on the signature panel on the back of the card 
                                                    immediately after the card's account number. For American Express, the four-digit CVV number is printed on the front of the card above the card account number.</small>
                                                </p>
                                            </div>
                                            <div class="form-group">
                                                <label for="status">Status</label>
                                                <select name="status" id="status" class="custom-select block" required>
                                                    <option value="pending" selected>Pending</option>
                                                    <option value="active">Active</option>
                                                    <option value="disabled">Disabled</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="date_added">Date Added</label>
                                                <input type="datetime-local" id="date_added" class="form-control" name="date_added" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="add_card">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
            echo alert_ok();
            echo alert_error();
        ?>
        <div class="content-body">
            <section id="configuration">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="fas fa-minus"></i></a></li>
                                        <li><a data-action="reload"><i class="fas fa-redo"></i></a></li>
                                        <li><a data-action="expand"><i class="fas fa-arrows-alt"></i></a></li>
                                        <li><a data-action="close"><i class="fas fa-times"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard table-responsive">
                                    <table class="table table-light zero-configuration">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Username</th>
                                                <th>Card Holder</th>
                                                <th>Card No</th>                                              
                                                <th>Card Provider</th>
                                                <th>Card Type</th>
                                                <th>Expiry Date</th>  
                                                <th>CVV</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $result = mysqli_query($link, "SELECT * FROM `cards` ORDER BY `created_at` DESC");
                                                $line = 0;

                                                while ($row = mysqli_fetch_array($result)):
                                                    $line++;
                                                    $get_user = mysqli_fetch_array(mysqli_query($link, "SELECT * FROM `users` WHERE `id`='".$row['user_id']."'"));
                                            ?>
                                            <tr>
                                                <td><b><?php echo $line . '.'; ?></b></td>
                                                <td><?php echo print_var($get_user["username"]); ?></td>
                                                <td><?php echo print_var($row["card_holder"]); ?></td>
                                                <td><?php echo print_var(format_card($row["card_number"])); ?></td>
                                                <td><?php echo print_var(ucwords($row["card_provider"])); ?></td>
                                                <td><?php echo print_var(ucwords($row["card_type"])); ?></td>
                                                <td><?php echo print_var($row["expiry_date"]); ?></td>
                                                <td><?php echo print_var($row["cvv"]); ?></td>
                                                <td>
                                                    <?php
                                                        if ($row["status"] == "active") { echo print_status($row["status"], "Active"); }
                                                        elseif ($row["status"] == "disabled") { echo print_status($row["status"], "Disabled"); }
                                                        else { echo print_status($row["status"], "Pending"); }
                                                    ?>
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <span class="dropdown">
                                                            <button type="button" class="dropdown-menu-left bold btn btn-secondary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                                <i class="fas fa-ellipsis-v action-icon"></i>
                                                            </button>
                                                            <span class="dropdown-menu dropdown-menu-left">
                                                                <?php if ($row["status"] == "disabled") { ?>
                                                                <a href="card-status.php?actId=<?php echo $row["id"]; ?>" class="dropdown-item">
                                                                    <i class="fas fa-check"></i> Activate
                                                                </a>
                                                                <?php } else if ($row["status"] == "active") { ?>
                                                                <a href="card-status.php?disId=<?php echo $row["id"]; ?>" class="dropdown-item">
                                                                    <i class="fas fa-ban"></i> Disable
                                                                </a>
                                                                <?php } else { ?>
                                                                <a href="card-status.php?actId=<?php echo $row["id"]; ?>" class="dropdown-item">
                                                                    <i class="fas fa-check"></i> Activate
                                                                </a>
                                                                <a href="card-status.php?disId=<?php echo $row["id"]; ?>" class="dropdown-item">
                                                                    <i class="fas fa-ban"></i> Disable
                                                                </a>
                                                                <?php } ?>
                                                                <div class="dropdown-divider"></div>
                                                                <a href="#" class="dropdown-item" data-toggle="modal" data-target="#edit-card<?php echo $row["id"]; ?>">
                                                                    <i class="fas fa-pencil-alt"></i> Edit
                                                                </a>
                                                                <a href="card-delete.php?cId=<?php echo $row["id"]; ?>" class="dropdown-item" onclick="return confirm('Are you sure you want to delete this card?');">
                                                                    <i class="far fa-trash-alt"></i> Delete
                                                                </a>
                                                            </span>
                                                        </span>
                                                    </div>
                                                </td>
                                                <div class="modal fade" id="edit-card<?php echo $row["id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="slip" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title text-center col-lg-12" id="slip">
                                                                    <img src="app-assets/images/logo/logo1.png" class="mb-3" />
                                                                    <br><b>Edit Card For [<b><?php echo $row["card_holder"]; ?></b>]</b>
                                                                </h1>
                                                            </div>
                                                            <form class="form" action="" method="post">
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-12 col-lg-12">
                                                                            <div class="form-body">
                                                                                <div class="form-group">
                                                                                    <label for="user">User</label>
                                                                                    <select name="upd_user" id="user" class="select2 form-control" required>
                                                                                        <?php
                                                                                            $customer = mysqli_query($link, "SELECT `id`, `username` FROM `users` WHERE `status`='active'");
                                                                                            while($data = mysqli_fetch_array($customer)) {
                                                                                                if ($data['id'] == $get_user["username"]) { echo "<option value='".$data['id']."' selected>".ucwords($data['username'])."</option>"; }
                                                                                                else { echo "<option value='".$data['id']."'>".ucwords($data['username'])."</option>"; }
                                                                                            } 
                                                                                        ?>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="upd_card_provider">Card Provider</label>
                                                                                    <select name="upd_card_provider" id="upd_card_provider" class="custom-select block" required>
                                                                                        <option <?php if ($row["card_provider"] == "visa") { echo "selected"; } ?> value="visa">Visa</option>
                                                                                        <option <?php if ($row["card_provider"] == "mastercard") { echo "selected"; } ?> value="mastercard">Mastercard</option>
                                                                                        <option <?php if ($row["card_provider"] == "american express") { echo "selected"; } ?> value="american express">American Express</option>
                                                                                        <option <?php if ($row["card_provider"] == "discover") { echo "selected"; } ?> value="discover">Discover</option>
                                                                                        <option <?php if ($row["card_provider"] == "diners club") { echo "selected"; } ?> value="diners club">Diners Club</option>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="upd_card_type">Card Type</label>
                                                                                    <select name="upd_card_type" id="upd_card_type" class="custom-select block" required>
                                                                                        <option <?php if ($row["card_type"] == "debit") { echo "selected"; } ?> value="debit">Debit</option>
                                                                                        <option <?php if ($row["card_type"] == "credit") { echo "selected"; } ?> value="credit">Credit</option>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="upd_card_number">Card Number</label>
                                                                                    <input type="text" id="upd_card_number" class="form-control" placeholder="Card Number" name="upd_card_number" value="<?php echo $row["card_number"]; ?>" required>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="upd_card_holder">Card Holder Name</label>
                                                                                    <input type="text" id="upd_card_holder" class="form-control" placeholder="Card Holder Name" name="upd_card_holder" value="<?php echo $row["card_holder"]; ?>" required>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="upd_expiry_date">Expiry Date</label>
                                                                                    <input type="text" id="upd_expiry_date" class="form-control" placeholder="MM/YY" name="upd_expiry_date" value="<?php echo $row["expiry_date"]; ?>" required>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="upd_cvv">CVV</label>
                                                                                    <input type="number" id="upd_cvv" class="form-control" placeholder="CVV (3 digits)" name="upd_cvv" value="<?php echo $row["cvv"]; ?>" required>
                                                                                    <p class="text-muted ml-75 mt-50">
                                                                                        <small>For Visa/Mastercard, the three-digit CVV number is printed on the signature panel on the back of the card immediately after the card's account number. For American Express, the four-digit CVV number is printed on the front of the card above the card account number.</small>
                                                                                    </p>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="upd_status">Status</label>
                                                                                    <select name="upd_status" id="upd_status" class="custom-select block" required>
                                                                                        <option <?php if ($row["status"] == "pending") { echo "selected"; } ?> value="pending">Pending</option>
                                                                                        <option <?php if ($row["status"] == "active") { echo "selected"; } ?> value="active">Active</option>
                                                                                        <option <?php if ($row["status"] == "disabled") { echo "selected"; } ?> value="disabled">Disabled</option>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="date_added">Date Added</label>
                                                                                    <input type="datetime-local" id="new_date" class="form-control" name="new_date">
                                                                                    <input type="hidden" id="old_date" class="form-control" value="<?php echo $row["created_at"]; ?>" name="old_date">
                                                                                </div>
                                                                                <input type="hidden" value="<?php echo $row["id"]; ?>" name="upd_id">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary" name="update_card">Save Changes</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </tr>
                                            <?php endwhile; ?>
                                        </tbody>
                                    </table>
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

    if (isset($_POST["update_card"])) 
    {
        $upd_id = mysqli_real_escape_string($link, $_POST["upd_id"]);
        $upd_user = mysqli_real_escape_string($link, $_POST["upd_user"]);
        $upd_card_holder = mysqli_real_escape_string($link, $_POST["upd_card_holder"]);
        $upd_card_provider = mysqli_real_escape_string($link, $_POST["upd_card_provider"]);
        $upd_card_number = mysqli_real_escape_string($link, $_POST["upd_card_number"]);
        $upd_card_type = mysqli_real_escape_string($link, $_POST["upd_card_type"]);
        $upd_expiry_date = mysqli_real_escape_string($link, $_POST["upd_expiry_date"]);
        $upd_cvv = mysqli_real_escape_string($link, $_POST["upd_cvv"]);
        $upd_status = mysqli_real_escape_string($link, $_POST["upd_status"]);
        $upd_log = get_date();
        $upd_date_added = "";

        // Check if the new date is empty.
        if (empty($_POST["new_date"])) { $upd_date_added = mysqli_real_escape_string($link, $_POST["old_date"]); }
        else { $upd_date_added = mysqli_real_escape_string($link, $_POST["new_date"]); }
       
        if (empty($upd_user)) {
            $_SESSION["error"] = "Please select a user.";
        }
        elseif (empty($upd_card_holder)) {
            $_SESSION["error"] = "Please fill out the card holder name.";
        }
        elseif (empty($upd_card_provider)) {
            $_SESSION["error"] = "Please select a card provider.";
        }
        elseif (empty($upd_card_number)) {
            $_SESSION["error"] = "Please fill out the card number.";
        }
        elseif (empty($upd_card_type)) {
            $_SESSION["error"] = "Please select a card type.";
        }
        elseif (empty($upd_expiry_date)) {
            $_SESSION["error"] = "Please enter the card expiry date.";
        }
        elseif (empty($upd_cvv)) {
            $_SESSION["error"] = "Please fill out your cvv.";
        }
        else {
            // Update the cards table with the new passed values.
            $card_statement = "UPDATE `cards` SET `user_id`='$upd_user', `card_holder`='$upd_card_holder', `card_provider`='$upd_card_provider', `card_number`='$upd_card_number', `card_type`='$upd_card_type', ".
                              "`expiry_date`='$upd_expiry_date', `cvv`='$upd_cvv', `status`='$upd_status', `created_at`='$upd_date_added', `updated_at`='$upd_log' WHERE `id`='$upd_id'";
            $update_card = mysqli_query($link, $card_statement);

            // Verify if operation was successful
            if ($update_card) {
                $_SESSION["success"] = "Card info was updated successfully.";
                relocate_url("cards.php");
            } 
            else {
                $_SESSION["error"] = "unable to update card info.";
                relocate_url("cards.php");
            }
        }
    }
    mysqli_close($link);
?>  