<?php 
    session_start();
    include("../includes/config.php");
    include("../includes/conn.php");
    include("../includes/func.php");
    admin_session_expired("login.php");

    set_headers("Bank Charges", "bank_charges");
    include("header.php");

    /** 
     * Add a new bank charge
     **/
    if (isset($_POST["add_bank_charge"])) 
    {
        $level = mysqli_real_escape_string($link, $_POST["level"]);
        $fee = mysqli_real_escape_string($link, $_POST["fee"]);

        if (empty($level)) {
            $_SESSION["error"] = "Please fill out the level name.";
        }
        else {
            # Insert new bank charge
            $bank_charge_statement = "INSERT INTO `transaction_fee` (`level`, `fee`) VALUES ('$level',  '$fee')";
            $insert_bank_charge = mysqli_query($link, $bank_charge_statement);


            if ($insert_bank_charge) {
                $_SESSION["success"] = "New bank charge added successfully.";
            } 
            else {
                $_SESSION["error"] = "unable to add a new bank charge.";
            }
        }
    }
?>

<!-- BEGIN: Content -->
<div class="app-content content">
    <div class="content-overlay"></div>
    <!-- BEGIN: Content-wrapper -->
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title mb-0">Bank Charges</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12 mb-2"></div>
                </div>
            </div>
            <div class="content-header-right col-md-6 col-12 mb-md-0 mb-2">
                <div class="float-md-right">
                    <a href="#" class="btn btn-secondary" data-toggle="modal" data-target="#add-charge">
                        <i class="fas fa-plus mr-1"></i>Add Bank Charge
                    </a> 
                </div>   
            </div>

            <!-- Add Transaction Fee modal -->
            <div class="modal fade" id="add-charge" tabindex="-1" role="dialog" aria-labelledby="slip" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title text-center col-lg-12" id="slip">
                                <img src="app-assets/images/logo/logo1.png" class="mb-3" />
                                <br><b>Add Bank Charge</b>
                            </h1>
                        </div>
                        <form class="form" action="" method="post">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-12 col-lg-12">
                                        <div class="form-body">
                                            <div class="form-group">
                                                <label for="level">Level</label>
                                                <input type="text" id="level" class="form-control" placeholder="Enter Level" name="level">
                                            </div>
                                            <div class="form-group">
                                                <label>Fee</label>
                                                <div class="input-group mt-0">
                                                    <input type="number" class="form-control" name="fee">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">.00</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="add_bank_charge">Save</button>
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
                                <div class="card-body card-dashboard">
                                    <table class="table table-light zero-configuration">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Level</th>
                                                <th>Fee</th>
                                                <th>Date Added</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $result = mysqli_query($link, "SELECT * FROM `transaction_fee` ORDER BY `created_at` DESC");

                                                $line = 0;
                                                while ($row = mysqli_fetch_array($result)):
                                                    $line++;
                                            ?>
                                            <tr>
                                                <td><b><?php echo $line . '.'; ?></b></td>
                                                <td><?php echo print_var(ucwords($row["level"])); ?></td>
                                                <td><?php echo print_var($row["fee"]); ?></td>
                                                <td><?php echo ucwords(print_date($row["created_at"])); ?></td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="#" class="bold btn btn-secondary mr-1" data-toggle="modal" data-target="#edit-charge<?php echo $row["id"]; ?>">
                                                            <i class="fas fa-pencil-alt"></i> Edit
                                                        </a>
                                                        <a href="bank-charge-delete.php?bcId=<?php echo $row["id"]; ?>" class="bold btn btn-secondary" onclick="return confirm('Are you sure you want to delete bank charge?');">
                                                            <i class="fas fa-trash-alt"></i> Delete
                                                        </a>
                                                    </div>
                                                </td>
                                                <div class="modal fade" id="edit-charge<?php echo $row["id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="slip" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title text-center col-lg-12" id="slip">
                                                                    <img src="app-assets/images/logo/logo1.png" class="mb-3" />
                                                                    <br><b>Edit Bank Charge For [<b><?php echo $row["level"]; ?></b>]</b>
                                                                </h1>
                                                            </div>
                                                            <form class="form" action="" method="post">
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-12 col-lg-12">
                                                                            <div class="form-body">
                                                                                <div class="form-group">
                                                                                    <label for="level">Level</label>
                                                                                    <input type="text" id="level" class="form-control" placeholder="Enter Level" value="<?php echo $row["level"]; ?>" name="level">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label>Fee</label>
                                                                                    <div class="input-group mt-0">
                                                                                        <input type="number" class="form-control" value="<?php echo $row["fee"]; ?>"name="amount">
                                                                                        <div class="input-group-append">
                                                                                            <span class="input-group-text">.00</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary" name="update_bank_charge">Save Changes</button>
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

    if (isset($_POST["update_bank_charge"])) 
    {
        $upd_id = mysqli_real_escape_string($link, $_POST["upd_id"]);
        $upd_level = mysqli_real_escape_string($link, $_POST["upd_level"]);
        $upd_fee = mysqli_real_escape_string($link, $_POST["upd_fee"]);

        if (empty($upd_level)) {
            $_SESSION["error"] = "Please fill out the level name.";
        }
        else {
            // Update the cards table with the new passed values.
            $bank_charge_statement = "UPDATE `transaction_fee` SET `level`='$upd_level', `fee`='$upd_fee' WHERE `id`='$upd_id'";
            $update_bank_charge = mysqli_query($link, $bank_charge_statement);

            // Confirm if all transactions was successful
            if ($update_bank_charge) {
                $_SESSION["success"] = "Bank charge was updated successfully.";
            } 
            else {
                $_SESSION["error"] = "unable to update bank charge.";
            }
        }
    }
    mysqli_close($link);
?> 