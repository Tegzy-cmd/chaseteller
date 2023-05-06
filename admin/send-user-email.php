<?php 
    session_start();
    include("../includes/config.php");
    include("../includes/conn.php");
    include("../includes/func.php");
    admin_session_expired("login.php");

    set_headers("Send User Email", "user_list");
    include("header.php");

    if (isset($_GET["uid"])) {
        $uid = $_GET["uid"];
        $sql_user = "SELECT * FROM `users` WHERE `id`='$uid'";
        $user = mysqli_fetch_array(mysqli_query($link, $sql_user));

        $u_id = $user['id'];
        $u_email = $user['email'];
        $u_username = $user['username'];
        $ad_email = $admin["email"];
    }
?>

<!-- BEGIN: Content -->
<div class="app-content content">
    <div class="content-overlay"></div>
    <!-- BEGIN: Content-wrapper -->
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title mb-0">Send Email To [<i><?php echo $u_username; ?></i>]</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12 mb-2"></div>
                </div>
            </div>
        </div>

        <?php
            echo alert_ok();
            echo alert_error();
        ?>

        <!-- Users send email -->
        <div class="content-body">
            <section id="horizontal-form-layouts">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="fas fa-minus"></i></a></li>
                                        <li><a data-action="expand"><i class="fas fa-arrows-alt"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collpase show">
                                <div class="card-body">
                                    <form action="" method="post" class="form form-horizontal">
                                        <div class="form-body">
                                            <input type="hidden" value="<?php echo $ad_email; ?>" name="from">
                                            <input type="hidden" value="<?php echo $u_email; ?>" name="to">
                                            <input type="hidden" value="<?php echo $u_username; ?>" name="user">

                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="subject">Subject</label>
                                                <div class="col-md-9">
                                                <input type="text" class="form-control" id="subject" name="subject" placeholder="E.g Testing Mail" required>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="message">Message</label>
                                                <div class="col-md-9">
                                                    <textarea id="message" class="form-control" id="message" name="message" required></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-actions center mt-3">
                                            <a href="users.php" class="btn btn-secondary mr-1">
                                                Cancel
                                            </a>
                                            <button type="submit" class="btn btn-success" name="send_mail">
                                                Send Mail
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- END: Content-body -->
    </div>
    <!-- END: Content-wrapper -->
</div>
<!-- END: Content -->

<?php 
    flush_headers();
    include("footer.php");

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    require("../includes/PHPMailer/src/Exception.php");
    require("../includes/PHPMailer/src/PHPMailer.php");
    require("../includes/PHPMailer/src/SMTP.php");

    if (isset($_POST['send_mail'])) {
        $mail = new PHPMailer(true);

        $from = $_POST["from"];
        $to = $_POST["to"];
        $subject = $_POST["subject"];
        $message = $_POST["message"];
        $user = $_POST["user"];

        if (empty($subject)) {
            $_SESSION["error"] = "Please fill out the email subject.";
        } 
        elseif (empty($message)) {
            $_SESSION["error"] = "Please type out the email message.";
        } 
        else {
            try {
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                $mail->isSMTP();
                $mail->SMTPAuth = true;
                $mail->SMTPKeepAlive = true;
                $mail->Host = $from;
                $mail->Username = $from;
                $mail->Password = 'welcome2021';
                $mail->SMTPSecure = "tls";
                $mail->Port = 587; 

                $mailer->SMTPOptions = array('tls' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                ));

                $mail->setFrom($from, "www.website.com");
                $mail->addAddress($to, $user);
                $mail->addReplyTo($from, "Information");

                $mail->isHTML(true);
                $mail->Subject = $subject;
                $mail->Body = $message;
                $mail->AltBody = $message;
                $mail->send();

                $_SESSION["success"] = "Message has been sent to " . $u_username . " successfully.";
                relocate_url("users.php");
            } 
            catch (Exception $e) {
                $_SESSION["error"] = "Message could not be sent. Mailer Error: " . $mail->ErrorInfo;
            }

            $mail->smtpClose();
        }
    }
    mysqli_close($link);
?>   