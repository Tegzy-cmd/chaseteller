<?php 
    session_start();
    include("../includes/config.php");
    include("../includes/conn.php");
    include("../includes/func.php");
    admin_session_expired("login.php");
    set_headers("Profile Settings");
    include("header.php");

    $admin = mysqli_fetch_array(mysqli_query($link, "SELECT * FROM `admins` WHERE `id`='$admin_id'"));
    $ad_id = $admin['id'];
    $ad_firstname = $admin['firstname'];
    $ad_lastname = $admin['lastname'];
    $ad_email = $admin['email'];
    $ad_username = $admin['username'];
    $ad_image = $admin["image"];
    $_SESSION["warning"] = "Profile update would require re-login for security reasons.";
?>
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title mb-0">Profile Settings</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12 mb-2"></div>
                </div>
            </div>
        </div>
        <?php
            echo alert_warning();
            echo alert_ok();
            echo alert_error();
        ?>
        <div class="content-body">
            <section id="page-account-settings">
                <div class="row">
                    <div class="col-md-3 mb-2 mb-md-0">
                        <div class="media mb-2">
                            <a class="mr-1" href="#">
                                <img src="../uploads/admin-avatar/<?php echo $ad_image; ?>" alt="admin avatar"
                                class="users-avatar-shadow rounded-circle" height="150" width="150">
                            </a>
                        </div>
                        <ul class="nav nav-pills flex-column mt-md-0 mt-1">
                            <li class="nav-item">
                                <a class="nav-link d-flex active" id="account-pill-general" data-toggle="pill"
                                    href="#account-vertical-general" aria-expanded="true">
                                    <i class="fas fa-user"></i>
                                    Edit Profile Info
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex" id="account-pill-password" data-toggle="pill" href="#account-vertical-password"
                                    aria-expanded="false">
                                    <i class="fas fa-lock"></i>
                                    Change Password
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex" id="account-pill-info" data-toggle="pill" href="#account-vertical-info"
                                    aria-expanded="false">
                                    <i class="fas fa-image"></i>
                                    Upload New Photo
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane active" id="account-vertical-general"
                                            aria-labelledby="account-pill-general" aria-expanded="true">
                                            <form action="" method="post">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <div class="controls">
                                                                <label for="account-firstname">First Name</label>
                                                                <input type="text" class="form-control" id="account-firstname" placeholder="First Name" value="<?php echo $ad_firstname; ?>" name="firstname" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <div class="controls">
                                                                <label for="account-lastname">Last Name</label>
                                                                <input type="text" class="form-control" id="account-lastname" placeholder="Last Name" value="<?php echo $ad_lastname; ?>" name="lastname" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <div class="controls">
                                                                <label for="account-username">Username</label>
                                                                <input type="text" class="form-control" id="account-username" placeholder="Username" value="<?php echo $ad_username; ?>" name="username" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <div class="controls">
                                                                <label for="account-e-mail">E-mail</label>
                                                                <input type="email" class="form-control" id="account-e-mail" placeholder="E-mail" value="<?php echo $ad_email; ?>" name="email" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="id" value="<?php echo $ad_id; ?>">
                                                    <div class="col-12 d-flex flex-sm-row flex-column justify-content-center">
                                                        <button type="submit" class="btn btn-primary" name="update_admin_profile">Save Changes</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="tab-pane fade " id="account-vertical-password" role="tabpanel"
                                            aria-labelledby="account-pill-password" aria-expanded="false">
                                            <form action="" method="post">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <div class="controls">
                                                                <label for="old-password">Old Password</label>
                                                                <input type="password" class="form-control" name="old_password" 
                                                                    id="old-password" placeholder="Old Password" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <div class="controls">
                                                                <label for="new-password">New Password</label>
                                                                <input type="password" name="new_password" id="new-password"
                                                                    class="form-control" placeholder="New Password" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <div class="controls">
                                                                <label for="confirm-password">Confirm Password</label>
                                                                <input type="password" name="confirm_password" id="confirm-password" class="form-control" placeholder="Confirm Password" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="id" value="<?php echo $ad_id; ?>">
                                                    <div class="col-12 d-flex flex-sm-row flex-column justify-content-center">
                                                        <button type="submit" class="btn btn-primary" name="update_admin_password">Save Changes</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="tab-pane fade" id="account-vertical-info" role="tabpanel"
                                            aria-labelledby="account-pill-info" aria-expanded="false">
                                            <form action="" method="post" enctype="multipart/form-data">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <div class="controls">
                                                                <label for="account-new-password" class="col-12 mb-2">
                                                                    Select a photo
                                                                </label>
                                                                <label id="avatar" class="file center-block col-12">
                                                                    <input type="file" id="file" name="avatar">
                                                                    <span class="file-custom"></span>
                                                                </label>
                                                            </div>
                                                            <p class="text-muted ml-75 mt-50">
                                                                <small>Allowed JPG, GIF or PNG. Max size of 800kB</small>
                                                            </p> 
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="id" value="<?php echo $ad_id; ?>">
                                                    <div class="col-12 d-flex flex-sm-row flex-column justify-content-center">
                                                        <button type="submit" class="btn btn-primary" name="update_admin_photo">Upload Photo</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
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

    if (isset($_POST['update_admin_profile'])) 
    {
        $id = mysqli_real_escape_string($link, $_POST["id"]);
        $firstname = mysqli_real_escape_string($link, $_POST["firstname"]);
        $lastname = mysqli_real_escape_string($link, $_POST["lastname"]);
        $email = mysqli_real_escape_string($link, $_POST["email"]);
        $username = mysqli_real_escape_string($link, $_POST["username"]);
        $log = get_date();

        if (empty($firstname) || empty($lastname)) {
            $_SESSION["error"] = "Please fill out the firstname and lastname.";
        } 
        elseif (empty($email)) {
            $_SESSION["error"] = "Please fill out your email.";
        } 
        elseif (empty($username)) {
            $_SESSION["error"] = "Please fill out the username.";
        } 
        elseif (!val_username($username)) {
            $_SESSION["error"] = "Username can only be alphabets or alpha-numeric characters.";
        } 
        elseif (!val_email($email)) {
            $_SESSION["error"] = "The email format is invalid. Please check";
        } 
        else {
            $profile_statement = "UPDATE `admins` SET `firstname`='$firstname', `lastname`='$lastname', `username`='$username', ".
                                 "`email`='$email', `updated_at`='$log' WHERE `id`='$id'";
            $update_profile = mysqli_query($link, $profile_statement);

            if ($update_profile) {
                session_destroy();
                relocate_url("login.php");
            } 
            else {
                $_SESSION["error"] = "unable to update admin profile.";
                relocate_url("profile-settings.php");
            }
        }
    }

    if (isset($_POST['update_admin_password'])) 
    {
        $id = mysqli_real_escape_string($link, $_POST["id"]);
        $old_password = mysqli_real_escape_string($link, $_POST["old_password"]);
        $new_password = mysqli_real_escape_string($link, $_POST["new_password"]);
        $confirm_password = mysqli_real_escape_string($link, $_POST["confirm_password"]);
        $log = get_date();

        if (empty($old_password) || empty($new_password) || empty($confirm_password)) {
            $_SESSION["error"] = "Please all fields must be filled.";
        } 
        elseif (!minimum($new_password, 5)) {
            $_SESSION["error"] = "Password must be at least 5 characters.";
        }
        elseif (!compare($new_password, $confirm_password)) {
            $_SESSION["error"] = "Password fields do not match!";
        }
        else {
            $check_password = "SELECT `password` FROM `admins` WHERE `id`='$id'";
            $verify_password = mysqli_query($link, $check_password);

            while ($password_row = mysqli_fetch_array($verify_password)) { 
                $admin_password = $password_row["password"]; 
            }

            if (equals($old_password, $admin_password)) {
                $password_statement = "UPDATE `admins` SET `password`='$new_password', `updated_at`='$log' WHERE `id`='$id'";
                $update_password = mysqli_query($link, $password_statement);

                if ($update_password) {
                    session_destroy();
                    relocate_url("login.php");
                } 
                else {
                    $_SESSION["error"] = "unable to update admin password.";
                    relocate_url("profile-settings.php");
                }
            } 
            else {
                $_SESSION["error"] = "Your old password is incorrect. Please check again.";
                relocate_url("profile-settings.php");
            }
        }
    }

    if (isset($_POST['update_admin_photo'])) 
    {
        $id = mysqli_real_escape_string($link, $_POST["id"]);
        $file_name = basename($_FILES["avatar"]["name"]);
        $temp_name = $_FILES["avatar"]["tmp_name"];
        $log = get_date();

        $sep = explode(".", $file_name);
        $file_ext = strtolower(end($sep));
        $ext = array("jpg", "jpeg", "png", "gif", "bmp");

        if (in_array($file_ext, $ext)) {
            $avatar = $id . "-" . date("Ymdhis") . '.' . $file_ext;
            $file_folder = "../uploads/admin-avatar/" . $avatar;

            if (move_uploaded_file($temp_name, $file_folder)) {
                $avatar_statement = "UPDATE `admins` SET `image`='$avatar', `updated_at`='$log' WHERE `id`='$id'";
                $upload_avatar = mysqli_query($link, $avatar_statement);

                if ($upload_avatar) {
                    session_destroy();
                    relocate_url("login.php");
                } 
                else {
                    $_SESSION["error"] = "unable to upload avatar.";
                }
            } 
            else {
                $_SESSION["error"] = "unable to upload avatar.";
            }
        } 
        else {
            $_SESSION["error"] = "Unknown file extension. allowed files are jpg, jpeg, bmp, png, gif.";
        }
    }
    mysqli_close($link);
?>   