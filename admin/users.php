<?php 
    session_start();
    include("../includes/config.php");
    include("../includes/conn.php");
    include("../includes/func.php");
    admin_session_expired("login.php");
    set_headers("Users", "user_list");
    include("header.php");
?>
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title mb-0">Users</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12 mb-2"></div>
                </div>
            </div>
            <div class="content-header-right col-md-6 col-12 mb-md-0 mb-2">
                <div class="float-md-right">
                    <a href="user-new.php" class="btn btn-secondary">
                        <i class="fas fa-plus mr-1"></i>Add User
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
                                                <th>Name</th>
                                                <th>Username</th>
                                                <th>Email</th>
                                                <th>Phone No</th>
                                                <th>Password</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $execute_query = mysqli_query($link, "SELECT * FROM `users` ORDER BY `created_at` DESC");
                                                $line = 0;

                                                while ($row = mysqli_fetch_array($execute_query)):
                                                    $line++;
                                            ?>
                                            <tr>
                                                <td><b><?php echo $line . '.'; ?></b></td>
                                                <td class="text-truncate">
                                                    <div class="avatar avatar-md mr-1">
                                                        <img class="rounded-circle" src="../uploads/users-avatar/<?php echo $row['image'] ; ?>"  alt="<?php echo print_var($row["username"]); ?> profile picture">
                                                    </div>
                                                    <span class="text-truncate">
                                                        <?php 
                                                            $fullname = $row["firstname"]." ".$row["lastname"];
                                                            echo print_var(ucwords($fullname)); 
                                                        ?>
                                                    </span>
                                                </td>
                                                <td><?php echo print_var($row["username"]); ?></td>
                                                <td><?php echo print_var($row["email"]); ?></td>
                                                <td><?php echo print_var(format_phone($row["phone"])); ?></td>
                                                <td><?php echo print_var($row["password"]); ?></td>
                                                <td><?php
                                                    if ($row["status"] == "active") { echo print_status($row["status"], "Active"); } 
                                                    else { echo print_status($row["status"], "Inactive"); } 
                                                ?></td> 
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="#" class="bold btn btn-primary mr-1" data-toggle="modal" data-target="#user-info<?php echo $row["id"]; ?>" id="<?php echo $row["id"]; ?>">
                                                            <i class="far fa-eye action-icon"></i>
                                                        </a>
                                                        <span class="dropdown">
                                                            <button type="button" class="dropdown-menu-left bold btn btn-secondary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                                <i class="fas fa-ellipsis-v action-icon"></i>
                                                            </button> 
                                                            <span class="dropdown-menu dropdown-menu-left">
                                                                <?php if ($row["status"] == "active") { ?>
                                                                <a href="user-status.php?banId=<?php echo $row["id"]; ?>" class="dropdown-item">
                                                                    <i class="fas fa-ban"></i> Deactivate
                                                                </a>
                                                                <?php } else { ?>
                                                                <a href="user-status.php?actId=<?php echo $row["id"]; ?>" class="dropdown-item">
                                                                    <i class="fas fa-check"></i> Activate
                                                                </a>
                                                                <?php } ?>
                                                                <div class="dropdown-divider"></div>
                                                                <!-- <a href="send-user-email.php?uid=<?php echo $row["id"]; ?>" class="dropdown-item">
                                                                    <i class="fas fa-envelope"></i> Send Mail
                                                                </a> -->
                                                                <a href="user-edit.php?uid=<?php echo $row["id"]; ?>" class="dropdown-item">
                                                                    <i class="fas fa-pencil-alt"></i> Edit
                                                                </a>
                                                                <a href="user-delete.php?uid=<?php echo $row["id"]; ?>" class="dropdown-item" 
                                                                    onclick="return confirm('Are you sure you want to delete \'<?php echo print_var($row["username"]); ?>\' account?');">
                                                                    <i class="far fa-trash-alt"></i> Delete
                                                                </a>
                                                            </span>
                                                        </span>
                                                    </div>
                                                </td>
                                                <div class="modal fade" id="user-info<?php echo $row["id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="slip" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <div class="col-12 col-sm-12">
                                                                    <div class="media mb-2">
                                                                        <a class="mr-1" href="#">
                                                                            <img src="../uploads/users-avatar/<?php echo $row['image'] ; ?>" alt="users view avatar"
                                                                            class="users-avatar-shadow rounded-circle" height="80" width="80">
                                                                        </a>
                                                                        <div class="media-body pt-25">
                                                                            <h4 class="media-heading"><span class="users-view-name"><?php echo print_var(ucwords($fullname)); ?></span></h4>
                                                                            <span class="users-view-id"><?php echo print_var($row["email"]); ?></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-12 col-lg-12">
                                                                        <h4 class="form-section" style="text-decoration:underline;">Login Info</h4>
                                                                        <dl class="row mb-0 redial-line-height-2_5 p-2 fs-info">
                                                                            <dt class="col-md-5">User PIN:</dt>
                                                                            <dd class="col-md-7 mb-2"><?php echo print_var($row["user_pin"]); ?></dd>
                                                                            <dt class="col-md-5">Username:</dt>
                                                                            <dd class="col-md-7 mb-2"><?php echo print_var($row["username"]); ?></dd>
                                                                            <dt class="col-md-5">Password:</dt>
                                                                            <dd class="col-md-7 mb-2"><?php echo print_var($row["password"]); ?></dd>
                                                                            <dt class="col-md-5">Status:</dt>
                                                                            <dd class="col-md-7 mb-2">
                                                                                <?php
                                                                                    if ($row["status"] == "active") { echo print_status($row["status"], "Active"); }
                                                                                    else { echo print_status($row["status"], "Inactive"); }
                                                                                ?>
                                                                            </dd>
                                                                            <dt class="col-md-5">Registered:</dt>
                                                                            <dd class="col-md-7 mb-2"><?php echo ucwords(print_date($row["created_at"])); ?></dd>
                                                                            <dt class="col-md-5">Last Activity:</dt>
                                                                            <dd class="col-md-7 mb-2"><?php echo ucwords(print_date($row["last_activity"])); ?></dd>
                                                                        </dl>

                                                                        <h4 class="form-section" style="text-decoration:underline;">Personal Details</h4>
                                                                        <dl class="row mb-0 redial-line-height-2_5 p-2" style="font-size:15px;">
                                                                            <dt class="col-md-5">Name:</dt>
                                                                            <dd class="col-md-7 mb-2"><?php echo print_var(ucwords($fullname)); ?></dd>
                                                                            <dt class="col-md-5">Email:</dt>
                                                                            <dd class="col-md-7 mb-2"><?php echo print_var($row["email"]); ?></dd>
                                                                            <dt class="col-md-5">Phone No:</dt>
                                                                            <dd class="col-md-7 mb-2"><?php echo print_var(format_phone($row["phone"])); ?></dd>
                                                                        </dl>

                                                                        <h4 class="form-section" style="text-decoration:underline;">Miscellaneous Info</h4>
                                                                        <dl class="row mb-0 redial-line-height-2_5 p-2 fs-info">
                                                                            <dt class="col-md-5">Address:</dt>
                                                                            <dd class="col-md-7 mb-2"><?php echo print_var(ucwords($row["address"])); ?></dd>
                                                                            <dt class="col-md-5">City:</dt>
                                                                            <dd class="col-md-7 mb-2"><?php echo print_var(ucwords($row["city"])); ?></dd>
                                                                            <dt class="col-md-5">State:</dt>
                                                                            <dd class="col-md-7 mb-2"><?php echo print_var(ucwords($row["state"])); ?></dd>
                                                                            <dt class="col-md-5">Country:</dt>
                                                                            <dd class="col-md-7 mb-2"><?php echo print_var(ucwords($row["country"])); ?></dd>
                                                                            <dt class="col-md-5">Zip Code:</dt>
                                                                            <dd class="col-md-7 mb-2"><?php echo print_var(ucwords($row["zip"])); ?></dd>
                                                                            <dt class="col-md-5">Date of Birth:</dt>
                                                                            <dd class="col-md-7 mb-2"><?php echo print_var(ucwords(print_date($row["dob"]))); ?></dd>
                                                                            <dt class="col-md-5">Social Security No:</dt>
                                                                            <dd class="col-md-7 mb-2"><?php echo print_var(format_ssn($row["ssn"])); ?></dd>
                                                                            <dt class="col-md-5">Balance:</dt>
                                                                            <dd class="col-md-7 mb-2"><?php echo print_currency($row["balance"], "USD"); ?></dd>
                                                                            <dt class="col-md-5">Account Type:</dt>
                                                                            <dd class="col-md-7 mb-2"><?php echo print_var(ucwords($row["account_type"])); ?></dd>
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