<?php 
    session_start();
    include("../includes/config.php");
    include("../includes/conn.php");
    include("../includes/func.php");
    admin_session_expired("login.php");
    set_headers("Bank Accounts", "bank_accounts");
    include("header.php");

    if (isset($_POST["add_account"])) 
    {
        $user = mysqli_real_escape_string($link, $_POST["user"]);
        $bank = mysqli_real_escape_string($link, $_POST["bank"]);
        $account_name = mysqli_real_escape_string($link, $_POST["account_name"]);
        $account_no = mysqli_real_escape_string($link, $_POST["account_no"]);
        $account_type = mysqli_real_escape_string($link, $_POST["account_type"]);
        $status = mysqli_real_escape_string($link, $_POST["status"]);
        $date_added = mysqli_real_escape_string($link, $_POST["date_added"]);

        if (empty($user)) {
            $_SESSION["error"] = "Please select a user.";
        }
        elseif (empty($bank)) {
            $_SESSION["error"] = "Please fill out the bank name.";
        }
        elseif (empty($account_name)) {
            $_SESSION["error"] = "Please fill out the account name.";
        }
        elseif (empty($account_no)) {
            $_SESSION["error"] = "Please fill out the account number.";
        }
        elseif (empty($account_type)) {
            $_SESSION["error"] = "Please select an account type.";
        }
        else {
            // Insert new bank account to the bank_accounts table.
            $account_statement = "INSERT INTO `bank_accounts` (`user_id`, `bank`, `account_name`, `account_no`, `account_type`, `status`, `created_at`) ".
                                 "VALUES ('$user', '$bank', '$account_name', '$account_no', '$account_type', '$status', '$date_added')";
            $insert_account = mysqli_query($link, $account_statement);

            // Verify if the operation was successful.
            if ($insert_account) {
                $_SESSION["success"] = "New bank account added successfully.";
                relocate_url("bank-accounts.php");
            } 
            else {
                $_SESSION["error"] = "unable to add a new bank account";
                relocate_url("bank-accounts.php");
            }
        }
    }
?>
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title mb-0">Bank Accounts</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12 mb-2"></div>
                </div>
            </div>
            <div class="content-header-right col-md-6 col-12 mb-md-0 mb-2">
                <div class="float-md-right">
                    <a href="#" class="btn btn-secondary" data-toggle="modal" data-target="#add-account">
                        <i class="fas fa-plus mr-1"></i>Add Bank Account
                    </a> 
                </div>   
            </div>
            <div class="modal fade" id="add-account" tabindex="-1" role="dialog" aria-labelledby="slip" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title text-center col-lg-12" id="slip">
                                <img src="app-assets/images/logo/logo1.png" class="mb-3" />
                                <br><b>Add Bank Account</b>
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
                                                <label for="bank">Bank Name</label>
                                                <input type="text" id="bank" class="form-control" placeholder="Bank Name" name="bank" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="account_name">Account Name</label>
                                                <input type="text" id="account_name" class="form-control" placeholder="Account Name" name="account_name" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="account_no">Account Number</label>
                                                <input type="text" id="account_no" class="form-control" placeholder="Account Number" name="account_no" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="account_type">Account Type</label>
                                                <select name="account_type" id="account_type" class="custom-select block" required>
                                                    <option value="" selected>-- Select Type --</option>
                                                    <option value="personal">Personal</option>
                                                    <option value="business">Business</option>
                                                </select>
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
                                <button type="submit" class="btn btn-primary" name="add_account">Save</button>
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
                                                <th>Account Name</th>
                                                <th>Account No.</th>
                                                <th>Account Type</th>                                              
                                                <th>Bank Name</th>                                                
                                                <th>Date Added</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $result = mysqli_query($link, "SELECT * FROM `bank_accounts` ORDER BY `created_at` DESC");
                                                $line = 0;

                                                while ($row = mysqli_fetch_array($result)):
                                                    $line++;
                                                    $get_user = mysqli_fetch_array(mysqli_query($link, "SELECT * FROM `users` WHERE `id`='".$row['user_id']."'"));
                                            ?>
                                            <tr>
                                                <td><b><?php echo $line . '.'; ?></b></td>
                                                <td><?php echo print_var($get_user["username"]); ?></td>
                                                <td><?php echo print_var($row["account_name"]); ?></td>
                                                <td><?php echo print_var(format_account_no($row["account_no"])); ?></td>
                                                <td><?php echo print_var(ucwords($row["account_type"])); ?></td>
                                                <td><?php echo print_var(ucwords($row["bank"])); ?></td>
                                                <td><?php echo ucwords(print_date($row["created_at"])); ?></td>
                                                <td>
                                                    <?php
                                                        if ($row["status"] == "active") echo print_status($row["status"], "Active"); 
                                                        elseif ($row["status"] == "disabled") echo print_status($row["status"], "Disabled"); 
                                                        else echo print_status($row["status"], "Pending"); 
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
                                                                <a href="bank-account-status.php?actId=<?php echo $row["id"]; ?>" class="dropdown-item">
                                                                    <i class="fas fa-check"></i> Activate
                                                                </a>
                                                                <?php } else if ($row["status"] == "active") { ?>
                                                                <a href="bank-account-status.php?disId=<?php echo $row["id"]; ?>" class="dropdown-item">
                                                                    <i class="fas fa-ban"></i> Disable
                                                                </a>
                                                                <?php } else { ?>
                                                                <a href="bank-account-status.php?actId=<?php echo $row["id"]; ?>" class="dropdown-item">
                                                                    <i class="fas fa-check"></i> Activate
                                                                </a>
                                                                <a href="bank-account-status.php?disId=<?php echo $row["id"]; ?>" class="dropdown-item bold">
                                                                    <i class="fas fa-ban"></i> Disable
                                                                </a>
                                                                <?php } ?>
                                                                <div class="dropdown-divider"></div>
                                                                <a href="#" class="dropdown-item" data-toggle="modal" data-target="#edit-account<?php echo $row["id"]; ?>">
                                                                    <i class="fas fa-pencil-alt"></i> Edit
                                                                </a>
                                                                <a href="bank-account-delete.php?baId=<?php echo $row["id"]; ?>" class="dropdown-item" onclick="return confirm('Are you sure you want to delete this bank account?');">
                                                                    <i class="far fa-trash-alt"></i> Delete
                                                                </a>
                                                            </span>
                                                        </span>
                                                    </div>
                                                </td>
                                                <div class="modal fade" id="edit-account<?php echo $row["id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="slip" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title text-center col-lg-12" id="slip">
                                                                    <img src="app-assets/images/logo/logo1.png" class="mb-3" />
                                                                    <br><b>Edit [ACC NO: <b><?php echo $row["account_no"]; ?></b>]</b>
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
                                                                                    <label for="bankName">Bank Name</label>
                                                                                    <input type="text" id="bankName" class="form-control" value="<?php echo $row["bank"]; ?>" placeholder="Bank Name" name="upd_bank" required>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="accountName">Account Name</label>
                                                                                    <input type="text" id="accountName" class="form-control" value="<?php echo $row["account_name"]; ?>" placeholder="Account Name" name="upd_account_name" required>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="accountNumber">Account Number</label>
                                                                                    <input type="text" id="accountNumber" class="form-control" value="<?php echo $row["account_no"]; ?>" placeholder="Account Number" name="upd_account_no" required>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="upd_account_type">Account Type</label>
                                                                                    <select name="upd_account_type" id="upd_account_type" class="custom-select block" required>
                                                                                        <option <?php if ($row["account_type"] == "personal") { echo "selected"; } ?> value="personal">Personal</option>
                                                                                        <option <?php if ($row["account_type"] == "business") { echo "selected"; } ?> value="business">Business</option>
                                                                                    </select>
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
                                                                    <button type="submit" class="btn btn-primary" name="update_account">Save Changes</button>
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

    if (isset($_POST["update_account"])) 
    {
        $upd_id = mysqli_real_escape_string($link, $_POST["upd_id"]);
        $upd_user = mysqli_real_escape_string($link, $_POST["upd_user"]);
        $upd_bank = mysqli_real_escape_string($link, $_POST["upd_bank"]);
        $upd_account_name = mysqli_real_escape_string($link, $_POST["upd_account_name"]);
        $upd_account_no = mysqli_real_escape_string($link, $_POST["upd_account_no"]);
        $upd_account_type = mysqli_real_escape_string($link, $_POST["upd_account_type"]);
        $upd_status = mysqli_real_escape_string($link, $_POST["upd_status"]);
        $upd_log = get_date();
        $upd_date_added = "";

        // Check if the new date is empty.
        if (empty($_POST["new_date"])) { $upd_date_added = mysqli_real_escape_string($link, $_POST["old_date"]); }
        else { $upd_date_added = mysqli_real_escape_string($link, $_POST["new_date"]); }

        if (empty($upd_user)) {
            $_SESSION["error"] = "Please select a user.";
        }
        elseif (empty($upd_bank)) {
            $_SESSION["error"] = "Please fill out the bank name.";
        }
        elseif (empty($upd_account_name)) {
            $_SESSION["error"] = "Please fill out the account name.";
        }
        elseif (empty($upd_account_no)) {
            $_SESSION["error"] = "Please fill out the account number.";
        }
        elseif (empty($upd_account_type)) {
            $_SESSION["error"] = "Please select an account type.";
        }
        else {
            // Update the bank accounts table with the new passed values.
            $account_statement = "UPDATE `bank_accounts` SET `user_id`='$upd_user', `bank`='$upd_bank', `account_name`='$upd_account_name', `account_no`='$upd_account_no', ".
                                 "`account_type`='$upd_account_type', `status`='$upd_status', `created_at`='$upd_date_added', `updated_at`='$upd_log' WHERE `id`='$upd_id'";
            $update_account = mysqli_query($link, $account_statement);

            // Verify if operation was successful
            if ($update_account) {
                $_SESSION["success"] = "Bank account info was updated successfully.";
                relocate_url("bank-accounts.php");
            } 
            else {
                $_SESSION["error"] = "unable to update bank account info";
                relocate_url("bank-accounts.php");
            }
        }
    }
    mysqli_close($link);
?>  