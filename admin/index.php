<?php 
    session_start();
    include("../includes/config.php");
    include("../includes/conn.php");
    include("../includes/func.php");
    admin_session_expired("login.php");
    set_headers("Dashboard", "dashboard");
    include("header.php");
?>
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title mb-0">Dashboard</h3>
            </div>
        </div>
        <div class="content-body">
            <div class="row grouped-multiple-statistics-card">
                <div class="col-12">
                    <div class="row">
                        <div class="col-xl-4 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="media align-items-stretch">
                                        <div class="p-2 text-center bg-primary">
                                            <i class="fa fa-users font-large-2 white"></i>
                                        </div>
                                        <div class="p-2 media-body">
                                            <?php
                                                $total_users = 0;
                                                $total_query = "SELECT COUNT(*) AS `total_users` FROM `users`";
                                                $execute_users = mysqli_query($link, $total_query);
                                                while ($row = mysqli_fetch_assoc($execute_users)):
                                                    $total_users = $row["total_users"]; 
                                                endwhile;
                                            ?>
                                            <h5>Total Users</h5>
                                            <h5 class="text-bold-400 mb-0"><?php echo print_count($total_users); ?></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="media align-items-stretch">
                                        <div class="p-2 text-center bg-success">
                                            <i class="fas fa-user-check font-large-2 white"></i>
                                        </div>
                                        <div class="p-2 media-body">
                                            <?php
                                                $active_users = 0;
                                                $active_query = "SELECT COUNT(*) AS `active_users` FROM `users` WHERE `status`='active'";
                                                $execute_active = mysqli_query($link, $active_query);
                                                while ($row = mysqli_fetch_assoc($execute_active)):
                                                    $active_users = $row["active_users"]; 
                                                endwhile;
                                            ?>
                                            <h5>Active Users</h5>
                                            <h5 class="text-bold-400 mb-0"><?php echo print_count($active_users); ?></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="media align-items-stretch">
                                        <div class="p-2 text-center bg-danger">
                                            <i class="fas fa-user-slash font-large-2 white"></i>
                                        </div>
                                        <div class="p-2 media-body">
                                            <?php
                                                $inactive_users = 0;
                                                $inactive_query = "SELECT COUNT(*) AS `inactive_users` FROM `users` WHERE `status`='inactive'";
                                                $execute_inactive = mysqli_query($link, $inactive_query);
                                                while ($row = mysqli_fetch_assoc($execute_inactive)):
                                                    $inactive_users = $row["inactive_users"]; 
                                                endwhile;
                                            ?>
                                            <h5>Inactive Users</h5>
                                            <h5 class="text-bold-400 mb-0"><?php echo print_count($inactive_users); ?></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-4 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="align-self-center">
                                                <i class="fas fa-list warning font-large-2"></i>
                                            </div>
                                            <div class="media-body text-right">
                                                <?php
                                                    $total_deposits = 0;
                                                    $total_deposits_query = "SELECT COUNT(*) AS `total_deposits` FROM `deposits`";
                                                    $execute_total_deposits = mysqli_query($link, $total_deposits_query);
                                                    while ($row = mysqli_fetch_assoc($execute_total_deposits)):
                                                        $total_deposits = $row["total_deposits"]; 
                                                    endwhile;
                                                ?>
                                                <h3><?php echo print_count($total_deposits); ?></h3>
                                                <span>Deposits</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="align-self-center">
                                                <i class="fas fa-list success font-large-2"></i>
                                            </div>
                                            <div class="media-body text-right">
                                                <?php
                                                    $total_withdraws = 0;
                                                    $total_withdraws_query = "SELECT COUNT(*) AS `total_withdraws` FROM `withdraws`";
                                                    $execute_total_withdraws = mysqli_query($link, $total_withdraws_query);
                                                    while ($row = mysqli_fetch_assoc($execute_total_withdraws)):
                                                        $total_withdraws = $row["total_withdraws"]; 
                                                    endwhile;
                                                ?>
                                                <h3><?php echo print_count($total_withdraws); ?></h3>
                                                <span>Withdrawals</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="align-self-center">
                                                <i class="fas fa-list danger font-large-2"></i>
                                            </div>
                                            <div class="media-body text-right">
                                                <?php
                                                    $total_transfers = 0;
                                                    $total_transfers_query = "SELECT COUNT(*) AS `total_transfers` FROM `transfers`";
                                                    $execute_total_transfers = mysqli_query($link, $total_transfers_query);
                                                    while ($row = mysqli_fetch_assoc($execute_total_transfers)):
                                                        $total_transfers = $row["total_transfers"]; 
                                                    endwhile;
                                                ?>
                                                <h3><?php echo print_count($total_transfers); ?></h3>
                                                <span>Transfers</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-4 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="media align-items-stretch">
                                        <div class="p-2 media-body text-left">
                                            <?php
                                                $amount_deposited = 0;
                                                $deposits = mysqli_query($link, "SELECT * FROM `deposits`");
                                                while ($deposited_row = mysqli_fetch_assoc($deposits)):
                                                    $amount_deposited += $deposited_row["amount"];
                                                endwhile;
                                            ?>
                                            <h5>Total Amount Deposited</h5>
                                            <h5 class="text-bold-400 mb-0">
                                                <?php echo print_currency($amount_deposited, "(USD)"); ?>
                                            </h5>
                                        </div>
                                        <div class="p-2 text-center bg-warning">
                                            <i class="fas fa-wallet font-large-2 white"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="media align-items-stretch">
                                        <div class="p-2 media-body text-left">
                                            <?php
                                                $amount_withdraw = 0;
                                                $withdraws = mysqli_query($link, "SELECT * FROM `withdraws`");
                                                while ($withdraw_row = mysqli_fetch_assoc($withdraws)):
                                                    $amount_withdraw += $withdraw_row["amount"];
                                                endwhile;
                                            ?>
                                            <h5>Total Amount Withdrawed</h5>
                                            <h5 class="text-bold-400 mb-0">
                                                <?php echo print_currency($amount_withdraw, "(USD)"); ?>
                                            </h5>
                                        </div>
                                        <div class="p-2 text-center bg-success">
                                            <i class="fas fa-money-bill-alt font-large-2 white"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="media align-items-stretch">
                                        <div class="p-2 media-body text-left">
                                            <?php
                                                $amount_transfered = 0;
                                                $transfers = mysqli_query($link, "SELECT * FROM `transfers`");
                                                while ($transfered_row = mysqli_fetch_assoc($transfers)):
                                                    $amount_transfered += $transfered_row["amount"];
                                                endwhile;
                                            ?>
                                            <h5>Total Amount Transfered</h5>
                                            <h5 class="text-bold-400 mb-0">
                                                <?php echo print_currency($amount_transfered, "(USD)"); ?>
                                            </h5>
                                        </div>
                                        <div class="p-2 text-center bg-danger">
                                            <i class="fas fa-paper-plane font-large-2 white"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-4 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="media-body text-left">
                                                <?php
                                                    $total_requests = 0;
                                                    $total_requests_query = "SELECT COUNT(*) AS `total_requests` FROM `requests`";
                                                    $execute_total_requests = mysqli_query($link, $total_requests_query);
                                                    while ($row = mysqli_fetch_assoc($execute_total_requests)):
                                                        $total_requests = $row["total_requests"]; 
                                                    endwhile;
                                                ?>
                                                <h3 class="danger"><?php echo print_count($total_requests); ?></h3>
                                                <span>Requests</span>
                                            </div>
                                            <div class="align-self-center">
                                                <i class="fas fa-bullhorn danger font-large-2 float-right"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="media-body text-left">
                                                <?php
                                                    $total_cards = 0;
                                                    $total_cards_query = "SELECT COUNT(*) AS `total_cards` FROM `cards`";
                                                    $execute_total_cards = mysqli_query($link, $total_cards_query);
                                                    while ($row = mysqli_fetch_assoc($execute_total_cards)):
                                                        $total_cards = $row["total_cards"]; 
                                                    endwhile;
                                                ?>
                                                <h3 class="success"><?php echo print_count($total_cards); ?></h3>
                                                <span>Cards</span>
                                            </div>
                                            <div class="align-self-center">
                                                <i class="fas fa-credit-card success font-large-2 float-right"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="media-body text-left">
                                                <?php
                                                    $total_bank_accounts = 0;
                                                    $total_bank_accounts_query = "SELECT COUNT(*) AS `total_bank_accounts` FROM `bank_accounts`";
                                                    $execute_total_bank_accounts = mysqli_query($link, $total_bank_accounts_query);
                                                    while ($row = mysqli_fetch_assoc($execute_total_bank_accounts)):
                                                        $total_bank_accounts = $row["total_bank_accounts"]; 
                                                    endwhile;
                                                ?>
                                                <h3 class="warning"><?php echo print_count($total_bank_accounts); ?></h3>
                                                <span>Bank Accounts</span>
                                            </div>
                                            <div class="align-self-center">
                                                <i class="fas fa-landmark warning font-large-2 float-right"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row match-height">
                <div class="col-xl-12 col-lg-12">
                    <div class="card active-users">
                        <div class="card-header border-0">
                            <h4 class="card-title">Latest Transactions</h4>
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
                            <div class="card-content">
                                <div id="audience-list-scroll" class="table-responsive position-relative">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Transaction Id</th>
                                                <th>Username</th>
                                                <th>Amount</th>
                                                <th>Type</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $execute_query = mysqli_query($link, "SELECT * FROM `transactions` ORDER BY `created_at` DESC LIMIT 10");
                                                $line = 0;

                                                while ($row = mysqli_fetch_array($execute_query)):
                                                    $line++;
                                                    $get_user = mysqli_fetch_array(mysqli_query($link, "SELECT * FROM `users` WHERE `id`='".$row['user_id']."'"));
                                            ?>
                                            <tr>
                                                <td><?php echo ucwords(print_date($row["created_at"])); ?></td>
                                                <td><?php echo print_var($row["trnx_id"]); ?></td>
                                                <td><?php echo print_var($get_user["username"]); ?></td>
                                                <td><?php echo print_currency($row["amount"], $row["currency"]); ?></td>
                                                <td>
                                                    <?php
                                                        if ($row["type"] == "deposit") { echo print_var("<span class='bullet bullet-success bullet-sm'></span> Deposit"); } 
                                                        elseif ($row["type"] == "withdraw") { echo print_var("<span class='bullet bullet-danger bullet-sm'></span> Withdraw"); } 
                                                        elseif ($row["type"] == "transfer") { echo print_var("<span class='bullet bullet-primary bullet-sm'></span> Transfer"); } 
                                                        elseif ($row["type"] == "request") { echo print_var("<span class='bullet bullet-warning bullet-sm'></span> Request"); } 
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php endwhile; ?>
                                            <tr><td colspan="5" class="pt-4"><button class="btn btn-secondary">View More</button></td></tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php 
    flush_headers();
    include("footer.php"); 
?>   

