<?php 
    session_start();
    include("../includes/config.php");
    include("../includes/conn.php");
    include("../includes/func.php");
    admin_session_expired("login.php");
    set_headers("Transaction Logs", "transaction_log");
    include("header.php");
?>
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title mb-0">Transaction Logs</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12 mb-2"></div>
                </div>
            </div>
            <div class="content-header-right col-md-6 col-12 mb-md-0 mb-2">
                <div class="float-md-right">
                    <a href="transaction-log-new.php" class="btn btn-secondary">
                        <i class="fas fa-plus mr-1"></i>Add Transaction
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
                                                <th>Date</th>
                                                <th>Transaction Id</th>
                                                <th>Username</th>
                                                <th>Amount</th>
                                                <th>Type</th>
                                                <th>Status</th>
                                                <th>Description</th>
                                                <th>After Balance</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $execute_query = mysqli_query($link, "SELECT * FROM `transactions` ORDER BY `created_at` DESC");
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
                                                <td><?php echo print_currency($row["amount"], $row["currency"]); ?></td>
                                                <td>
                                                    <?php
                                                        if ($row["type"] == "deposit") { echo print_var("<span class='text-success'>Deposit</span>"); }
                                                        elseif ($row["type"] == "withdraw") { echo print_var("<span class='text-danger'>Withdraw</span>"); }
                                                        elseif ($row["type"] == "transfer") { echo print_var("<span class='text-primary'>Transfer</span>"); }
                                                        elseif ($row["type"] == "request") { echo print_var("<span class='text-warning'>Request</span>"); }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                        if ($row["status"] == "approved") { echo print_status($row["status"], "Approved"); }
                                                        elseif ($row["status"] == "rejected") { echo print_status($row["status"], "Rejected"); }
                                                        else { echo print_status($row["status"], "Pending"); }
                                                    ?>
                                                </td>
                                                <td><?php echo print_var($row["description"]); ?></td>
                                                <td><?php echo print_currency($row["after_balance"], $row["currency"]); ?></td>
                                                <td>
                                                    <div class="d-flex">
                                                        <span class="dropdown">
                                                            <button type="button" class="dropdown-menu-left bold btn btn-secondary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                                <i class="fas fa-ellipsis-v action-icon"></i>
                                                            </button>
                                                            <span class="dropdown-menu dropdown-menu-left">
                                                                <?php if ($row["status"] == "rejected") { ?>
                                                                <a href="transaction-log-status.php?appId=<?php echo $row["id"]; ?>" class="dropdown-item">
                                                                    <i class="fas fa-check"></i> Approve
                                                                </a>
                                                                <?php } else if ($row["status"] == "approved") { ?>
                                                                <a href="transaction-log-status.php?rejId=<?php echo $row["id"]; ?>" class="dropdown-item">
                                                                    <i class="fas fa-ban"></i> Reject
                                                                </a>
                                                                <?php } else { ?>
                                                                <a href="transaction-log-status.php?appId=<?php echo $row["id"]; ?>" class="dropdown-item">
                                                                    <i class="fas fa-check"></i> Approve
                                                                </a>
                                                                <a href="transaction-log-status.php?rejId=<?php echo $row["id"]; ?>" class="dropdown-item">
                                                                    <i class="fas fa-ban"></i> Reject
                                                                </a>
                                                                <?php } ?>
                                                                <div class="dropdown-divider"></div>
                                                                <a href="transaction-log-edit.php?tId=<?php echo $row["id"]; ?>" class="dropdown-item">
                                                                    <i class="fas fa-pencil-alt"></i> Edit
                                                                </a>
                                                                <a href="transaction-log-delete.php?tId=<?php echo $row["id"]; ?>" class="dropdown-item" onclick="return confirm('Are you sure you want to delete this transaction?');">
                                                                    <i class="far fa-trash-alt"></i> Delete
                                                                </a>
                                                            </span>
                                                        </span>
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