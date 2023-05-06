<?php 
    session_start();
    include("../includes/config.php");
    include("../includes/conn.php");
    include("../includes/func.php");
    admin_session_expired("login.php");
    set_headers("Payment Gateways", "gateways");
    include("header.php");

    if (isset($_POST["add_gateway"])) 
    {
        $gateway = mysqli_real_escape_string($link, $_POST["gateway"]);
        $status = mysqli_real_escape_string($link, $_POST["status"]);

        if (empty($gateway)) {
            $_SESSION["error"] = "Please fill out the gateway name.";
        }
        else {
            # Insert new payment gateway
            $gateway_statement = "INSERT INTO `gateways` (`gateway`, `status`) VALUES ('$gateway',  '$status')";
            $insert_gateway = mysqli_query($link, $gateway_statement);


            if ($insert_gateway) {
                $_SESSION["success"] = "New payment gateway added successfully.";
            } 
            else {
                $_SESSION["error"] = "unable to add a new payment gateway.";
            }
        }
    }
?>
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title mb-0">Payment Gateways</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12 mb-2"></div>
                </div>
            </div>
            <div class="content-header-right col-md-6 col-12 mb-md-0 mb-2">
                <div class="float-md-right">
                    <a href="#" class="btn btn-secondary" data-toggle="modal" data-target="#add-gateway">
                        <i class="fas fa-plus mr-1"></i>Add Payment Gateway
                    </a> 
                </div>   
            </div>
            <div class="modal fade" id="add-gateway" tabindex="-1" role="dialog" aria-labelledby="slip" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title text-center col-lg-12" id="slip">
                                <img src="app-assets/images/logo/logo1.png" class="mb-3" />
                                <br><b>Add Payment Gateway</b>
                            </h1>
                        </div>
                        <form class="form" action="" method="post">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-12 col-lg-12">
                                        <div class="form-body">
                                            <div class="form-group">
                                                <label for="name">Payment Gateway</label>
                                                <input type="text" id="name" class="form-control" placeholder="Enter Gateway Name" name="gateway">
                                            </div>  
                                        </div>
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select name="status" id="status" class="custom-select block" required>
                                                <option value="enabled" selected>Enabled</option>
                                                <option value="disabled">Disabled</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="add_gateway">Save</button>
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
                                                <th>Payment Gateway</th>
                                                <th>Date Added</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $result = mysqli_query($link, "SELECT * FROM `gateways` ORDER BY `created_at` DESC");
                                                $line = 0;

                                                while ($row = mysqli_fetch_array($result)):
                                                    $line++;
                                            ?>
                                            <tr>
                                                <td><b><?php echo $line . '.'; ?></b></td>
                                                <td><?php echo print_var(ucwords($row["gateway"])); ?></td>
                                                <td><?php echo ucwords(print_date($row["created_at"])); ?></td>
                                                <td>
                                                    <?php
                                                        if ($row["status"] == "enabled") { echo print_status($row["status"], "Enabled"); }
                                                        else { echo print_status($row["status"], "Disabled"); }
                                                    ?>
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <?php if ($row["status"] == "disabled") { ?>
                                                        <a href="gateway-status.php?enId=<?php echo $row["id"]; ?>" class="bold btn btn-success mr-1">
                                                            <i class="fas fa-check action-icon"></i> Enable
                                                        </a>
                                                        <?php } else { ?>
                                                        <a href="gateway-status.php?disId=<?php echo $row["id"]; ?>" class="bold btn btn-danger mr-1">
                                                            <i class="fas fa-ban action-icon"></i> Disable
                                                        </a>
                                                        <?php } ?>
                                                        <a href="gateway-delete.php?gId=<?php echo $row["id"]; ?>" class="bold btn btn-secondary" onclick="return confirm('Are you sure you want to delete this payment gateway?');">
                                                            <i class="fas fa-trash-alt"></i> Delete
                                                        </a>
                                                    </div>
                                                </td>
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
    mysqli_close($link); 
?>   