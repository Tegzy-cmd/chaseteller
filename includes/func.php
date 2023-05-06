<?php
    function redirect_url($location = NULL) {
        if ($location != NULL) {
            header("location:{$location}");
            exit;
        }
    }

    function relocate_url($location = NULL) {
        if ($location != NULL) {
            echo "<script>window.location.href='{$location}';</script>";
            exit;
        }
    }

    function print_ellipsis($str) {
        if (strlen($str) > 20) $str = substr($str, 0, 20)."...";
        echo $str;
    }

    function print_datetime($datetime) {
        if ($datetime == null || empty($datetime)) {
            echo "<i>N/A</i>";
        } else {
            $unixdatetime = strtotime($datetime);
            return strftime("%d-%b-%Y %I:%M %p", $unixdatetime);
        }
    }

    function print_date($date) {
        if ($date == null || empty($date)) {
            echo "<i>N/A</i>";
        } else {
            $unixdate = strtotime($date);
            return strftime("%d-%b-%Y", $unixdate);
        }
    }

    function print_time($time) {
        if ($time == null || empty($time)) {
            echo "<i>N/A</i>";
        } else {
            $unixtime = strtotime($time);
            return strftime("%I:%M %p", $unixtime);
        }
    }

    function get_year($year) {
        $unixyear = strtotime($year);
        return strftime("%Y", $unixyear);
    }

    function get_date() {
        $date = new DateTime("now", new DateTimeZone('America/New_York'));
        return $date->format('Y-m-d h:i:s');
    }

    function val_ssn($ssn) {
        if (preg_match('/^[0-9]{9}$/', str_replace('-', '', $ssn))) return true;
        return false;
    }

    function val_phoneno($phone) {
        $filtered_phone = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
        $phone_to_check = str_replace("-", "", $filtered_phone);

        if (strlen($phone_to_check) > 10 || strlen($phone_to_check) < 14) return true;
        return false;
    }

    function val_username($username) {
        if (preg_match('/^[a-zA-Z0-9]{5,}$/', $username)) return true;
        return false;
    }

    function val_email($data) {
        if (filter_var($data, FILTER_VALIDATE_EMAIL)) return true;
        return false;
    }
 
    function is_alpha($data) {
        if (preg_match("/^([a-z])+$/i", $data)) return true;
        return false;
    }

    function is_num($data) {
        if (preg_match('/^[1-9][0-9\.]{0,15}$/', $data)) return true;
        return false;
    }

    function is_alpha_num($data) {
        if (preg_match('/^[a-zA-Z]+[a-zA-Z0-9._]+$/', $data)) return true;
        return false;
    }

    function maximum($data, $number) {
        $num = (int) $number;

        if (strlen($data) <= $num) return true;
        return false;
    }

    function minimum($data, $number) {
        $num = (int) $number;

        if (strlen($data) >= $num) return true;
        return false;
    }
 
    function val_pin($pin) {
        if (strlen($pin) == 4) return true;
        return false;
    }

    function compare($value1, $value2) {
        if ($value1 === $value2) return true;
        return false;
    }

    function equals($value1, $value2) {
        if ($value1 == $value2) return true;
        return false;
    }

    function escape($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function format_phone($phone_no) {
        $phone_no = preg_replace('/[^0-9]/', '', $phone_no);

        if (strlen($phone_no) > 10) {
            $country_code = substr($phone_no, 0, strlen($phone_no) - 10);
            $area_code = substr($phone_no, -10, 3);
            $next_three = substr($phone_no, -7, 3);
            $last_four = substr($phone_no, -4, 4);

            $phone_no = '+' . $country_code . ' ('.$area_code.') '.$next_three.'-'.$last_four; 
        } 
        elseif (strlen($phone_no) == 10) {
            $area_code = substr($phone_no, 0, 3);
            $next_three = substr($phone_no, 3, 3);
            $last_four = substr($phone_no, 6, 4);

            $phone_no = '('.$area_code.') '.$next_three.'-'.$last_four;
        }
        elseif (strlen($phone_no) == 7) {
            $next_three = substr($phone_no, 0, 3);
            $last_four = substr($phone_no, 3, 4);

            $phone_no = $next_three.'-'.$last_four;
        }
        return $phone_no;
    }

    function format_card($card_no) {
        $card_no = preg_replace('/[^0-9]/', '', $card_no);

        if (strlen($card_no) == 16) {
            $first_four = substr($card_no, 0, 4);
            $second_four = substr($card_no, 4, 4);
            $next_four = substr($card_no, 7, 4);
            $last_four = substr($card_no, 10, 4);

            $card_no = $first_four.'-'.$second_four.'-'.$next_four.'-'.$last_four; 
        } 
        elseif (strlen($card_no) == 15) {
            $first_four = substr($card_no, 0, 4);
            $next_six = substr($card_no, 4, 6);
            $last_five = substr($card_no, 9, 5);

            $card_no = $first_four.'-'.$next_six.'-'.$last_five; 
        }
        return $card_no;
    }

    function format_account_no($account_no) {
        $account_no = preg_replace('/[^0-9]/', '', $account_no);

        if (strlen($account_no) == 10) {
            $first_three = substr($account_no, 0, 3);
            $next_three = substr($account_no, 3, 3);
            $last_four = substr($account_no, 6, 4);

            $account_no = $first_three.'-'.$next_three.'-'.$last_four;
        }
        return $account_no;
    }

    function format_ssn($ssn) {
        $ssn = preg_replace('/[^0-9]/', '', $ssn);

        if (strlen($ssn) == 9) {
            $first_three = substr($ssn, 0, 3);
            $next_two = substr($ssn, 3, 2);
            $last_four = substr($ssn, 5, 4);

            $ssn = $first_three.'-'.$next_two.'-'.$last_four;
        }
        return $ssn;
    }

    function mask($cc, $char) {
        $pattern = '/^([0-9-]+)([0-9]*)$/U';
        $matches = array();
        preg_match($pattern, $cc, $matches);
        return preg_replace('([0-9])', $char, $matches[1]).$matches[2];
    }

    function val_credit_card($number) {
        // Strip any non-digits (useful for credit card number with spaces and hyphens)
        $number = preg_replace('/\D/', '', $number);

        // Set the string length and parity
        $number_length = strlen($number);
        $parity = $number_length % 2;

        // Loop through each digits and do the maths
        $total = 0;
        for ($i = 0; $i < $number_length; $i++) {
            $digit = $number[$i];

            // Multiply alternate digits
            if ($i % 2 == $parity) {
                $digit *= 2;

                // If the sum is two digits, add them together (in effect)
                if ($digit > 9) {
                    $digit -= 9;
                }
            }

            // Total up the digits
            $total += $digit;

            // If the total mod 10 equals 0, the number is valid 
            return ($total % 10 == 0) ? true : false;
        }
    }

    function generateCheckSum($num) {
        $value = (String) $num;
        $length = strlen($value);
        $parity = $length % 2;
        $sum = 0;

        for ($i = $length - 1; $i >= 0; --$i) {
            $char = $value[$i];
            if ($i % 2 != $parity) {
                $char *= 2;
                if ($char > 9) {
                    $char -= 9;
                }
            }

            $sum += $char;
        }
        return ($sum * 9) % 10;
    }

    function validateCC($value) {
        $extractedCheckSum = substr($value, -1);
        $extractedValue = substr($value, 0, -1);
        $calculatedCheckSum = generateCheckSum($extractedValue);

        if ($extractedCheckSum == $calculatedCheckSum) {
            return true;
        } else {
            return false;
        }
    }

    function log_action($action, $message = "") {
      	$logfile = SITE_ROOT.'logs'.DS.'log.txt';
      	$new = file_exists($logfile) ? false : true;

        if ($handle = fopen($logfile, 'a')) {
            $timestamp = strftime("%Y-%m-%d %H:%M:%S", time());
        	$content = "{$timestamp} | {$action}: {$message}\n";

            fwrite($handle, $content);
            fclose($handle);

            if($new) { chmod($logfile, 0755); }
        } else {
            echo "Could not open log file for writing.";
        }
    }

    function  admin_session_expired($page = "") {
        if (!$_SESSION["logged_in"]) { 
            redirect_url("{$page}"); 
        }

        if (time() - $_SESSION['time_stamped'] > 25200) {
            $_SESSION["warning"] = "Session has expired. Please login again to access your account.";
            unset($_SESSION["logged_in"]);
            unset($_SESSION["admin_id"]);
            redirect_url("{$page}");
        }
    }

    function  user_session_expired($page = "") {
        if (!$_SESSION["logged_in"]) { 
            redirect_url("{$page}"); 
        }

        if (time() - $_SESSION["time_stamped"] > 25200) {
            $_SESSION["warning"] = "Session has expired. Please login again to access.";
            unset($_SESSION["logged_in"]);
            unset($_SESSION["user_id"]);
            redirect_url("{$page}");
        }
    }

    function user_session_registered($page = "") {
        if (isset($_SESSION["logged_in"]) && isset($_SESSION["user_id"])) { 
            redirect_url("{$page}"); 
        }
    }

    function admin_session_registered($page = "") {
        if (isset($_SESSION["logged_in"]) && isset($_SESSION["admin_id"])) { 
            redirect_url("{$page}"); 
        }
    }

    function print_var($variable) {
        if (compare($variable, NULL) || empty($variable)) echo "<i>N/A</i>";
        else echo $variable;
    }

    function print_count($variable) {
        if (compare($variable, NULL) || empty($variable)) echo "0";
        else echo $variable;
    }

    function print_currency($amount, $curr) {
        if ($amount === null || empty($amount)) echo "0.00" . strtoupper($curr);
        else echo number_format($amount, 2, ".", ",")." ".strtoupper($curr);
    }

    function print_status($status, $str) {
        switch ($status):
            case 'approved':
            case 'active':
            case 'enabled':
            case 'completed':
            case 'deposit':
                echo "<span class='badge badge-success'>".$str."</span>";
                break;
            case 'disabled':
            case 'rejected':
            case 'declined':
            case 'inactive':
            case 'withdrawal':
                echo "<span class='badge badge-danger'>".$str."</span>";
                break;
            case 'pending':
            case 'processing':
                echo "<span class='badge badge-warning'>".$str."</span>";
                break;
            case 'transfer':
                echo "<span class='badge badge-primary'>".$str."</span>";
                break;
        endswitch;
    }

    function status_link($stats, $link) {
        switch($stats) :
            case 'active':
                echo "<a href=\"".$link."\" class=\"dropdown-item bold\">
                        <i class=\"fas fa-ban\"></i> Ban</a>";
                break;
            case 'banned':
                echo "<a href=\"".$link."\" class=\"dropdown-item bold\">
                        <i class=\"fas fa-check\"></i> Activate</a>";
                break;
        endswitch;
    }

    function site_title() {
        if (isset($_SESSION['title'])) echo $_SESSION['title'] . " - CliffTop Admin"; 
        else echo "CliffTop Admin"; 
    }

    function set_headers($title, $nav = "") {
        $_SESSION["title"] = $title;
        $_SESSION["nav"] = $nav;
    }

    function flush_headers() {
        unset($_SESSION['title']);
        unset($_SESSION['nav']);
    }

    function set_navlink_active($nav = "") {
        if ($_SESSION['nav'] === $nav) echo "class=\"active\"";
        elseif ($_SESSION['nav'] === null) echo "";
    }

    function alert_ok() {
        if (isset($_SESSION["success"])) {
            $msg = "<div class=\"alert alert-success alert-dismissible mb-3 pt-2 pb-2\" role=\"alert\">";
            $msg .= "<button type=\"button\" class=\"close pt-2 pb-2\" data-dismiss=\"alert\" aria-label=\"Close\">";
            $msg .= "<span aria-hidden=\"true\">&times;</span></button>";
            $msg .= "<strong>SUCCESS!</strong> ";
            $msg .= htmlentities($_SESSION["success"])."</div>";
            unset($_SESSION["success"]);
            return $msg;
        }
    }

    function alert_error() {
        if (isset($_SESSION["error"])) {
            $msg = "<div class=\"alert alert-danger alert-dismissible mb-3 pt-2 pb-2\" role=\"alert\">";
            $msg .= "<button type=\"button\" class=\"close pt-2 pb-2\" data-dismiss=\"alert\" aria-label=\"Close\">";
            $msg .= "<span aria-hidden=\"true\">&times;</span></button>";
            $msg .= "<strong>ERROR:</strong> ";
            $msg .= htmlentities($_SESSION["error"])."</div>";
            unset($_SESSION["error"]);
            return $msg;
        }
    }

    function alert_info() {
        if (isset($_SESSION["info"])) {
            $msg = "<div class=\"alert alert-info alert-dismissible mb-3 pt-2 pb-2\" role=\"alert\">";
            $msg .= "<button type=\"button\" class=\"close pt-2 pb-2\" data-dismiss=\"alert\" aria-label=\"Close\">";
            $msg .= "<span aria-hidden=\"true\">&times;</span></button>";
            $msg .= "<strong>NOTE:</strong> ";
            $msg .= htmlentities($_SESSION["info"])."</div>";
            unset($_SESSION["info"]);
            return $msg;
        }
    }

    function alert_warning() {
        if (isset($_SESSION["warning"])) {
            $msg = "<div class=\"alert alert-warning alert-dismissible mb-3 pt-2 pb-2\" role=\"alert\">";
            $msg .= "<button type=\"button\" class=\"close pt-2 pb-2\" data-dismiss=\"alert\" aria-label=\"Close\">";
            $msg .= "<span aria-hidden=\"true\">&times;</span></button>";
            $msg .= "<strong>WARNING:</strong> ";
            $msg .= htmlentities($_SESSION["warning"])."</div>";
            unset($_SESSION["warning"]);
            return $msg;
        }
    }

    function login_feedback() {
        if (isset($_SESSION["feedback"])) {
            $msg = "<div class=\"alert alert-danger alert-dismissible mb-2\" role=\"alert\">";
            $msg .= "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">";
            $msg .= "<span aria-hidden=\"true\">&times;</span></button>";
            $msg .= "<strong>Error: </strong> ";
            $msg .= htmlentities($_SESSION["feedback"])."</div>";
            unset($_SESSION["feedback"]);
            return $msg;
        }
    }

    function msg_success() {
        if (isset($_SESSION["successful"])) {
            $out = "<div class=\"alert alert-success alert-dismissible mb-2\" role=\"alert\">";
            $out .= "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">";
            $out .= "<span aria-hidden=\"true\">&times;</span></button>";
            $out .= htmlentities($_SESSION["successful"])."</div>";
            unset($_SESSION["successful"]);
            return $out;
        }
    }

    function msg_failure() {
        if (isset($_SESSION["failure"])) {
            $out = "<div class=\"alert alert-danger alert-dismissible mb-2\" role=\"alert\">";
            $out .= "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">";
            $out .= "<span aria-hidden=\"true\">&times;</span></button>";
            $out .= htmlentities($_SESSION["failure"])."</div>";
            unset($_SESSION["failure"]);
            return $out;
        }
    }

    function msg_notificate() {
        if (isset($_SESSION["notify"])) {
            $out = "<div class=\"alert alert-info alert-dismissible mb-5\" role=\"alert\">";
            $out .= "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">";
            $out .= "<span aria-hidden=\"true\">&times;</span></button>";
            $out .= "<strong><i class='fas fa-grin-alt'></i> </strong> ";
            $out .= htmlentities($_SESSION["notify"])."</div>";
            unset($_SESSION["notify"]);
            return $out;
        }
    }

    function msg_warning() {
        if (isset($_SESSION["warning"])) {
            $out = "<div class=\"alert alert-warning alert-dismissible mb-2\" role=\"alert\">";
            $out .= "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">";
            $out .= "<span aria-hidden=\"true\">&times;</span></button>";
            $out .= "<strong><i class='fas fa-exclamation-triangle'></i> </strong> ";
            $out .= htmlentities($_SESSION["warning"])."</div>";
            unset($_SESSION["warning"]);
            return $out;
        }
    }

    function generate_reference($len) {
        return substr(md5(time()), 0, $len);
    } 

?>