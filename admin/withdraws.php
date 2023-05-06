<?php 
    session_start();
    include("../includes/config.php");
    include("../includes/conn.php");
    include("../includes/func.php");
    admin_session_expired("login.php");
    set_headers("Withdraws", "withdraws");
    include("header.php");
?>
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title mb-0">Withdraws</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12 mb-2"></div>
                </div>
            </div>
            <div class="content-header-right col-md-6 col-12 mb-md-0 mb-2">
                <div class="float-md-right">
                    <a href="withdraw-new.php" class="btn btn-secondary">
                        <i class="fas fa-plus mr-1"></i>Add Withdrawal
                    </a> 
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
                                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-h font-medium-3"></i></a>
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
                                                <th>Date</th>
                                                <th>Transaction Id</th>
                                                <th>Username</th>
                                                <th>Amount</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $execute_query = mysqli_query($link, "SELECT * FROM `withdraws` ORDER BY `created_at` DESC");
                                                $line = 0;

                                                while ($row = mysqli_fetch_array($execute_query)):
                                                    $line++;
                                                    $get_user = mysqli_fetch_array(mysqli_query($link, "SELECT * FROM `users` WHERE `id`='".$row['user_id']."'"));
                                            ?>
                                            <tr>
                                                <td><b><?php echo $line . '.'; ?></b></td>
                                                <td><?php echo ucwords(print_date($row["created_at"])); ?></td>
                                                <td><?php echo print_var($row["trnx_id"]); ?></td>
                                                <td><?php echo print_var($get_user["username"]); ?></td>
                                                <td class="uppercase"><?php echo print_currency($row["amount"], $row["currency"]); ?></td>
                                                <td>
                                                    <?php
                                                        if ($row["status"] == "approved") { echo print_status($row["status"], "Approved"); }
                                                        elseif ($row["status"] == "rejected") { echo print_status($row["status"], "Rejected"); }
                                                        else { echo print_status($row["status"], "Pending"); }
                                                    ?>
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="#" class="bold btn btn-primary mr-1" data-toggle="modal" data-target="#transaction-receipt<?php echo $row["id"]; ?>" id="<?php echo $row["id"]; ?>">
                                                            <i class="far fa-eye action-icon"></i>
                                                        </a>
                                                        <span class="dropdown">
                                                            <button type="button" class="dropdown-menu-left bold btn btn-secondary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                                <i class="fas fa-ellipsis-v action-icon"></i>
                                                            </button>
                                                            <span class="dropdown-menu dropdown-menu-left">
                                                                <?php if ($row["status"] == "rejected") { ?>
                                                                <a href="withdraw-status.php?appId=<?php echo $row["id"]; ?>" class="dropdown-item">
                                                                    <i class="fas fa-ban"></i> Approve
                                                                </a>
                                                                <?php } else if ($row["status"] == "approved") { ?>
                                                                <a href="withdraw-status.php?rejId=<?php echo $row["id"]; ?>" class="dropdown-item">
                                                                    <i class="fas fa-check"></i> Reject
                                                                </a>
                                                                <?php } else { ?>
                                                                <a href="withdraw-status.php?appId=<?php echo $row["id"]; ?>" class="dropdown-item">
                                                                    <i class="fas fa-ban"></i> Approve
                                                                </a>
                                                                <a href="withdraw-status.php?rejId=<?php echo $row["id"]; ?>" class="dropdown-item">
                                                                    <i class="fas fa-check"></i> Reject
                                                                </a>
                                                                <?php } ?>
                                                                <div class="dropdown-divider"></div>
                                                                <a href="withdraw-edit.php?wId=<?php echo $row["id"]; ?>" class="dropdown-item">
                                                                    <i class="fas fa-pencil-alt"></i> Edit
                                                                </a>
                                                                <a href="withdraw-delete.php?wId=<?php echo $row["id"]; ?>" class="dropdown-item" onclick="return confirm('Are you sure you want to delete this withdrawal?');">
                                                                    <i class="far fa-trash-alt"></i> Delete
                                                                </a>
                                                            </span>
                                                        </span>
                                                    </div>
                                                </td>
                                                <div class="modal fade" id="transaction-receipt<?php echo $row["id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="slip" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title text-center col-lg-12" id="slip">
                                                                    <img src="app-assets/images/logo/logo1.png" class="mb-3" />
                                                                    <br><b>Transaction Receipt</b>
                                                                </h1>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-12 col-lg-12">
                                                                        <dl class="row mb-0 redial-line-height-2_5 p-2" style="font-size:15px;">
                                                                            <dt class="col-md-5">Date and Time:</dt>
                                                                            <dd class="col-md-7 mb-2"><?php echo ucwords(print_datetime($row["created_at"])); ?></dd>
                                                                            <dt class="col-md-5">Transaction ID:</dt>
                                                                            <dd class="col-md-7 mb-2"><?php echo print_var($row["trnx_id"]); ?></dd>
                                                                            <dt class="col-md-5">Account Name:</dt>
                                                                            <dd class="col-md-7 mb-2"><?php echo ucwords(print_var($row["account_name"])); ?></dd>
                                                                            <dt class="col-md-5">Account Number:</dt>
                                                                            <dd class="col-md-7 mb-2"><?php echo print_var(format_account_no($row["account_no"])); ?></dd>
                                                                            <dt class="col-md-5">Bank Name:</dt>
                                                                            <dd class="col-md-7 mb-2"><?php echo ucwords(print_var($row["bank"])); ?></dd>
                                                                            <dt class="col-sm-5">Transaction Type:</dt>
                                                                            <dd class="col-md-7 mb-2 uppercase"><?php echo print_var("withdrawal"); ?></dd>
                                                                            <dt class="col-md-5">Amount:</dt>
                                                                            <dd class="col-md-7 mb-2 uppercase"><?php echo print_currency($row["amount"], $row["currency"]); ?></dd>
                                                                            <dt class="col-md-5">Transaction Fee:</dt>
                                                                            <dd class="col-md-7 mb-2 uppercase"><?php echo print_currency($row["charge"], "usd"); ?></dd>
                                                                            <dt class="col-md-5">After Balance:</dt>
                                                                            <dd class="col-md-7 mb-2 uppercase"><?php echo print_currency($row["after_balance"], $row["currency"]); ?></dd>
                                                                            <dt class="col-md-5">Description:</dt>
                                                                            <dd class="col-md-7 mb-2"><?php echo print_var($row["narration"]); ?></dd>
                                                                            <dt class="col-md-5">Status:</dt>
                                                                            <dd class="col-md-7 mb-2">
                                                                                <?php
                                                                                    if ($row["status"] == "approved") { echo print_status($row["status"], "Approved"); }
                                                                                    elseif ($row["status"] == "rejected") { echo print_status($row["status"], "Rejected"); }
                                                                                    else { echo print_status($row["status"], "Pending"); }
                                                                                ?>
                                                                            </dd>
                                                                        </dl>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
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
    mysqli_close($link);
?>  