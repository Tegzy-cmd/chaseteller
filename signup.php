<?php 
    session_start();
    include("includes/config.php");
    include("includes/conn.php");
    include("includes/func.php");

    /** 
     * Create a new user account 
     **/
    if (isset($_POST["create_user_account"])) 
    {
        $firstname = mysqli_real_escape_string($link, $_POST["firstname"]);
        $lastname = mysqli_real_escape_string($link, $_POST["lastname"]);
        $email = mysqli_real_escape_string($link, $_POST["email"]);
        $phone = mysqli_real_escape_string($link, $_POST["phone"]);
        $user_pin = mysqli_real_escape_string($link, $_POST["user_pin"]);
        $username = mysqli_real_escape_string($link, $_POST["username"]);
        $password = mysqli_real_escape_string($link, $_POST["password"]);
        $retyped_password = mysqli_real_escape_string($link, $_POST["retyped_password"]);
        // $suffix = mysqli_real_escape_string($link, $_POST["suffix"]);
        // $maiden_name = mysqli_real_escape_string($link, $_POST["maiden_name"]);
        // $ssn = mysqli_real_escape_string($link, $_POST["ssn"]);
        // $dob = mysqli_real_escape_string($link, $_POST["dob"]);
        // $address = mysqli_real_escape_string($link, $_POST["address"]);
        // $country = mysqli_real_escape_string($link, $_POST["country"]);
        // $state = mysqli_real_escape_string($link, $_POST["state"]);
        // $city = mysqli_real_escape_string($link, $_POST["city"]);
        // $zip = mysqli_real_escape_string($link, $_POST["zip"]);
        // $account_type = mysqli_real_escape_string($link, $_POST["account_type"]);
        // $security_question = mysqli_real_escape_string($link, $_POST["security_question"]);
        // $answer = mysqli_real_escape_string($link, $_POST["answer"]);

        if (empty($firstname) || empty($lastname)) {
            $_SESSION["failure"] = "Please fill out the firstname and lastname.";
        } 
        elseif (empty($email)) {
            $_SESSION["failure"] = "Please fill out your email.";
        } 
        elseif (empty($phone)) {
            $_SESSION["failure"] = "Please fill out your phone number.";
        }
        elseif (empty($user_pin)) {
            $_SESSION["failure"] = "Please enter a user PIN.";
        } 
        elseif (empty($username)) {
            $_SESSION["failure"] = "Please fill out the username.";
        } 
        elseif (empty($password) || empty($retyped_password)) {
            $_SESSION["failure"] = "Password and retyped password cannot be empty.";
        } 
        elseif (!is_alpha($firstname) || !is_alpha($lastname)) {
            $_SESSION["failure"] = "Firstname and lastname can only be alphabets.";
        }
        // elseif (empty($maiden_name)) {
        //     $_SESSION["failure"] = "Please fill out the maiden's name.";
        // } 
        // elseif (empty($ssn)) {
        //     $_SESSION["failure"] = "Please enter your social security number.";
        // } 
        // elseif (empty($dob)) {
        //     $_SESSION["failure"] = "Please enter your date of birth.";
        // } 
        // elseif (empty($address) || empty($country) || empty($state) || empty($city) || empty($zip)) {
        //     $_SESSION["failure"] = "Please fill out the following: address, country, state, city and zip.";
        // } 
        // elseif (empty($account_type)) {
        //     $_SESSION["failure"] = "Please select an account type.";
        // } 
        // elseif (empty($security_question) || empty($answer)) {
        //     $_SESSION["failure"] = "Please fill out the security question and answer.";
        // } 
        // elseif (get_year($dob) <= "1890") {
        //     $_SESSION["failure"] = "Invalid date of birth was provided.";
        // }
        // elseif (!val_ssn($ssn)) {
        //     $_SESSION["failure"] = "Invalid social security number. Please check";
        // }
        elseif (!val_username($username)) {
            $_SESSION["failure"] = "Username can only be alphabets or alpha-numeric characters.";
        } 
        elseif (!val_email($email)) {
            $_SESSION["failure"] = "Invalid email address. Please check";
        } 
        elseif (!val_pin($user_pin)) {
            $_SESSION["failure"] = "The user pin must be 4 digits only.";
        } 
        elseif (!val_phoneno($phone)) {
            $_SESSION["failure"] = "Invalid phone number. Please check";
        } 
        elseif (!minimum($password, 5)) {
            $_SESSION["failure"] = "Password must be at least 5 characters.";
        }
        elseif (!compare($password, $retyped_password)) {
            $_SESSION["failure"] = "Password fields do not match!";
        }
        else {
            $email_exist = mysqli_query($link, "SELECT `email` FROM `users` WHERE `email`='$email' LIMIT 1");
            if (mysqli_num_rows($email_exist) > 0) {
                $_SESSION["failure"] = "Email already exists.";
            }

            $user_exist = mysqli_query($link, "SELECT `username` FROM `users` WHERE `username`='$username' LIMIT 1");
            if (mysqli_num_rows($user_exist) > 0) {
                $_SESSION["failure"] = "Username already exists.";
            }

            $pin_exist = mysqli_query($link, "SELECT `user_pin` FROM `users` WHERE `user_pin`='$user_pin' LIMIT 1");
            if (mysqli_num_rows($pin_exist) > 0) {
                $_SESSION["failure"] = "User PIN already exists.";
            }

            $insert_statement = "INSERT INTO `users` (`firstname`, `lastname`, `email`, `phone`, `user_pin`, `username`, `password`) VALUES ('$firstname', '$lastname', '$email', '$phone', '$user_pin', '$username', '$password')";
            $execute_statement = mysqli_query($link, $insert_statement);

            if ($execute_statement) {
                $_SESSION["successful"] = "Account was created successfully login with your username and password to see your dashboard. Thanks.";
                relocate_url("login.php"); 
            } 
            else {
                $_SESSION["failure"] = "Something went wrong was unable to create account. Please contact ChasetellerBank customer care if failure persists.";
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">
<link href="images/favicon-32.png" rel="icon" />
<title>ChasetellerBank - Account Registration</title>
<meta name="description" content="ChasetellerBank is a banking platform for payment and receiving of money worldwide.">
<meta name="author" content="Aleph-Null">

<!-- Web Fonts
============================================= -->
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Rubik:300,300i,400,400i,500,500i,700,700i,900,900i' type='text/css'>

<!-- Stylesheet
============================================= -->
<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="vendor/font-awesome/css/all.min.css" />
<link rel="stylesheet" type="text/css" href="vendor/owl.carousel/assets/owl.carousel.min.css" />
<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css" />
<link rel="stylesheet" type="text/css" href="css/stylesheet.css" />

<style type="text/css">
    @media (max-width: 768px) {
        .clifftop-logo { 
            width: 130px; 
        }
    }
</style>
</head>
<body>

<!-- Preloader -->
<!-- <div id="preloader">
  <div data-loader="dual-ring"></div>
</div> -->
<!-- Preloader End --> 

<!-- Document Wrapper   
============================================= -->
<div id="main-wrapper"> 
  
   <!-- Header
  ============================================= -->
  <header id="header">
    <div class="container">
      <div class="header-row">
        <div class="header-column justify-content-start"> 
          <!-- Logo
          ============================= -->
          <div class="logo"> 
            <a class="d-flex" href="index.php" title="ChasetellerBank - Online Banking">
              <img src="images/cliff-logo.png" alt="ChasetellerBank" class="clifftop-logo" />
            </a> 
          </div>
          <!-- Logo end -->

          <!-- Collapse Button
          ============================== -->
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#header-nav"> 
            <span></span> <span></span> <span></span> 
          </button>
          <!-- Collapse Button end --> 
          
          <!-- Primary Navigation
          ============================== -->
          <nav class="primary-menu navbar navbar-expand-lg">
            <div id="header-nav" class="collapse navbar-collapse">
              <ul class="navbar-nav mr-auto">
                <li><a href="index.php">Home</a></li>
                <li><a href="send-money.php">Send</a></li>
                <li><a href="receive-money.php">Receive</a></li>
                <li><a href="about-us.php">About Us</a></li>
                <li><a href="fees.php">Fees</a></li>
                <li><a href="help.php">Help</a></li>
                <li><a href="contact-us.php">Contact Us</a></li>
              </ul>
            </div>
          </nav>
          <!-- Primary Navigation end --> 
        </div>
        <div class="header-column justify-content-end"> 
          <!-- Login & Signup Link
          ============================== -->
          <nav class="login-signup navbar navbar-expand">
            <ul class="navbar-nav">
              <!-- <li><a href="login.php"><b>Login</b></a></li> -->
              <li class="align-items-center h-auto ml-sm-3"><a class="btn btn-outline-primary d-sm-block" href="login.php">Login</a></li>
            </ul>
          </nav>
          <!-- Login & Signup Link end --> 
        </div>
      </div>
    </div>
  </header>
  <!-- Header End --> 
    
  <!-- Content
  ============================================= -->
  <div id="content">
  <div class="login-signup-page mx-auto my-5" style="max-width: 800px;">
      <?php 
        echo msg_success();
        echo msg_failure();
      ?>

      <h3 class="font-weight-400 text-center">Create Account</h3>
      <p class="lead text-center">Your account information is safe with us.</p>
      <div class="bg-light shadow-md rounded p-4 mx-2">
        <form id="signupForm" method="post"> 
          <fieldset>
            <legend>Create Login</legend>
            <div class="row mt-5">
              <div class="col-12 col-sm-6">
                <div class="form-group">
                  <label for="username">Username</label>
                  <input type="text" class="form-control" id="username" name="username" required placeholder="Enter Your Username">
                </div>
              </div>
              <div class="col-12 col-sm-6">
                <div class="form-group">
                  <label for="pin">User PIN</label>
                  <input type="password" class="form-control" id="pin" name="user_pin" required placeholder="Enter Your User PIN">
                  <p><small>Please enter a 4 digits PIN. For secure transactions.</small></p>
                </div>
              </div>
              <div class="col-12 col-sm-6">
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" id="password" name="password" required placeholder="Enter Password">
                </div>
              </div>
              <div class="col-12 col-sm-6">
                <div class="form-group">
                  <label for="retyped_password">Retype-Password</label>
                  <input type="password" class="form-control" id="retyped_password" name="retyped_password" required placeholder="Retype Password">
                </div>
              </div>
            </div>
          </fieldset>

          <fieldset class="mt-5">
            <legend class="mb-5">Personal Details</legend>
            <div class="row">
              <div class="col-12 col-sm-6">
                <div class="form-group">
                  <label for="firstname">First Name</label>
                  <input type="text" class="form-control" id="firstname" name="firstname" required placeholder="Enter Your First Name">
                </div>
              </div>
              <div class="col-12 col-sm-6">
                <div class="form-group">
                  <label for="lastname">Last Name</label>
                  <input type="text" class="form-control" id="lastname" name="lastname" required placeholder="Enter Your Last Name">
                </div>
              </div>
              <div class="col-12 col-sm-6">
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" id="email" name="email" required placeholder="Enter Your Email Address">
                </div>
              </div>
              <div class="col-12 col-sm-6">
                <div class="form-group">
                  <label for="phone">Phone Number</label>
                  <input type="text" class="form-control" id="phone" name="phone" required placeholder="Enter Your Phone Number">
                </div>
              </div>
              <!-- <div class="col-12 col-sm-6">
                <div class="form-group">
                  <label for="suffix">Suffix</label>
                  <input type="text" class="form-control" id="suffix" name="suffix" required placeholder="Enter Suffix">
                  <p><small>Enter any title e.g Mr or Mrs. You can also ignore this field. </small></p>
                </div>
              </div>
              <div class="col-12 col-sm-6">
                <div class="form-group">
                  <label for="maiden-name">Mother's Maiden Name</label>
                  <input type="text" class="form-control" id="maiden-name" name="maiden_name" required placeholder="Enter Your Mother's Maiden Name">
                </div>
              </div>
              <div class="col-12 col-sm-6">
                <div class="form-group">
                  <label for="ssn">Social Security Number</label>
                  <input type="number" class="form-control" id="ssn" name="ssn" required placeholder="Enter Your Social Security Number">
                </div>
              </div>
              <div class="col-12 col-sm-6">
                <div class="form-group">
                  <label for="dob">Date of Birth</label>
                  <input type="date" class="form-control" id="dob" name="dob" required placeholder="Enter Your Last Name">
                </div>
              </div> -->
            </div>
          </fieldset>

          <!-- <fieldset class="mt-5">
            <legend class="mb-5">Contact Information</legend>
            <div class="row">
              <div class="col-12 col-sm-6">
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" id="email" name="email" required placeholder="Enter Your Email Address">
                </div>
              </div>
              <div class="col-12 col-sm-6">
                <div class="form-group">
                  <label for="phone">Phone Number</label>
                  <input type="text" class="form-control" id="phone" name="phone" required placeholder="Enter Your Phone Number">
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <label for="address">Street</label>
                  <input type="text" class="form-control" id="address" name="address" required placeholder="Enter Your Street Address">
                </div>
              </div>
              <div class="col-12 col-sm-6">
                <div class="form-group">
                  <label for="city">City</label>
                  <input type="text" class="form-control" id="city" name="city" required placeholder="Enter City">
                </div>
              </div>
              <div class="col-12 col-sm-6">
                <div class="form-group">
                  <label for="state">State</label>
                  <input type="text" class="form-control" id="state" name="state" required placeholder="Enter State">
                </div>
              </div>
              <div class="col-12 col-sm-6">
                <div class="form-group">
                  <label for="country">Country</label>
                  <select class="custom-select form-control" id="country" name="country" required>
                    <option value="" selected>-- Select Country --</option>
                    <option value="Afganistan">Afghanistan</option>
                    <option value="Albania">Albania</option>
                    <option value="Algeria">Algeria</option>
                    <option value="American Samoa">American Samoa</option>
                    <option value="Andorra">Andorra</option>
                    <option value="Angola">Angola</option>
                    <option value="Anguilla">Anguilla</option>
                    <option value="Antigua & Barbuda">Antigua & Barbuda</option>
                    <option value="Argentina">Argentina</option>
                    <option value="Armenia">Armenia</option>
                    <option value="Aruba">Aruba</option>
                    <option value="Australia">Australia</option>
                    <option value="Austria">Austria</option>
                    <option value="Azerbaijan">Azerbaijan</option>
                    <option value="Bahamas">Bahamas</option>
                    <option value="Bahrain">Bahrain</option>
                    <option value="Bangladesh">Bangladesh</option>
                    <option value="Barbados">Barbados</option>
                    <option value="Belarus">Belarus</option>
                    <option value="Belgium">Belgium</option>
                    <option value="Belize">Belize</option>
                    <option value="Benin">Benin</option>
                    <option value="Bermuda">Bermuda</option>
                    <option value="Bhutan">Bhutan</option>
                    <option value="Bolivia">Bolivia</option>
                    <option value="Bonaire">Bonaire</option>
                    <option value="Bosnia & Herzegovina">Bosnia & Herzegovina</option>
                    <option value="Botswana">Botswana</option>
                    <option value="Brazil">Brazil</option>
                    <option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
                    <option value="Brunei">Brunei</option>
                    <option value="Bulgaria">Bulgaria</option>
                    <option value="Burkina Faso">Burkina Faso</option>
                    <option value="Burundi">Burundi</option>
                    <option value="Cambodia">Cambodia</option>
                    <option value="Cameroon">Cameroon</option>
                    <option value="Canada">Canada</option>
                    <option value="Canary Islands">Canary Islands</option>
                    <option value="Cape Verde">Cape Verde</option>
                    <option value="Cayman Islands">Cayman Islands</option>
                    <option value="Central African Republic">Central African Republic</option>
                    <option value="Chad">Chad</option>
                    <option value="Channel Islands">Channel Islands</option>
                    <option value="Chile">Chile</option>
                    <option value="China">China</option>
                    <option value="Christmas Island">Christmas Island</option>
                    <option value="Cocos Island">Cocos Island</option>
                    <option value="Colombia">Colombia</option>
                    <option value="Comoros">Comoros</option>
                    <option value="Congo">Congo</option>
                    <option value="Cook Islands">Cook Islands</option>
                    <option value="Costa Rica">Costa Rica</option>
                    <option value="Cote DIvoire">Cote DIvoire</option>
                    <option value="Croatia">Croatia</option>
                    <option value="Cuba">Cuba</option>
                    <option value="Curaco">Curacao</option>
                    <option value="Cyprus">Cyprus</option>
                    <option value="Czech Republic">Czech Republic</option>
                    <option value="Denmark">Denmark</option>
                    <option value="Djibouti">Djibouti</option>
                    <option value="Dominica">Dominica</option>
                    <option value="Dominican Republic">Dominican Republic</option>
                    <option value="East Timor">East Timor</option>
                    <option value="Ecuador">Ecuador</option>
                    <option value="Egypt">Egypt</option>
                    <option value="El Salvador">El Salvador</option>
                    <option value="Equatorial Guinea">Equatorial Guinea</option>
                    <option value="Eritrea">Eritrea</option>
                    <option value="Estonia">Estonia</option>
                    <option value="Ethiopia">Ethiopia</option>
                    <option value="Falkland Islands">Falkland Islands</option>
                    <option value="Faroe Islands">Faroe Islands</option>
                    <option value="Fiji">Fiji</option>
                    <option value="Finland">Finland</option>
                    <option value="France">France</option>
                    <option value="French Guiana">French Guiana</option>
                    <option value="French Polynesia">French Polynesia</option>
                    <option value="French Southern Ter">French Southern Ter</option>
                    <option value="Gabon">Gabon</option>
                    <option value="Gambia">Gambia</option>
                    <option value="Georgia">Georgia</option>
                    <option value="Germany">Germany</option>
                    <option value="Ghana">Ghana</option>
                    <option value="Gibraltar">Gibraltar</option>
                    <option value="Great Britain">Great Britain</option>
                    <option value="Greece">Greece</option>
                    <option value="Greenland">Greenland</option>
                    <option value="Grenada">Grenada</option>
                    <option value="Guadeloupe">Guadeloupe</option>
                    <option value="Guam">Guam</option>
                    <option value="Guatemala">Guatemala</option>
                    <option value="Guinea">Guinea</option>
                    <option value="Guyana">Guyana</option>
                    <option value="Haiti">Haiti</option>
                    <option value="Hawaii">Hawaii</option>
                    <option value="Honduras">Honduras</option>
                    <option value="Hong Kong">Hong Kong</option>
                    <option value="Hungary">Hungary</option>
                    <option value="Iceland">Iceland</option>
                    <option value="Indonesia">Indonesia</option>
                    <option value="India">India</option>
                    <option value="Iran">Iran</option>
                    <option value="Iraq">Iraq</option>
                    <option value="Ireland">Ireland</option>
                    <option value="Isle of Man">Isle of Man</option>
                    <option value="Israel">Israel</option>
                    <option value="Italy">Italy</option>
                    <option value="Jamaica">Jamaica</option>
                    <option value="Japan">Japan</option>
                    <option value="Jordan">Jordan</option>
                    <option value="Kazakhstan">Kazakhstan</option>
                    <option value="Kenya">Kenya</option>
                    <option value="Kiribati">Kiribati</option>
                    <option value="Korea North">Korea North</option>
                    <option value="Korea Sout">Korea South</option>
                    <option value="Kuwait">Kuwait</option>
                    <option value="Kyrgyzstan">Kyrgyzstan</option>
                    <option value="Laos">Laos</option>
                    <option value="Latvia">Latvia</option>
                    <option value="Lebanon">Lebanon</option>
                    <option value="Lesotho">Lesotho</option>
                    <option value="Liberia">Liberia</option>
                    <option value="Libya">Libya</option>
                    <option value="Liechtenstein">Liechtenstein</option>
                    <option value="Lithuania">Lithuania</option>
                    <option value="Luxembourg">Luxembourg</option>
                    <option value="Macau">Macau</option>
                    <option value="Macedonia">Macedonia</option>
                    <option value="Madagascar">Madagascar</option>
                    <option value="Malaysia">Malaysia</option>
                    <option value="Malawi">Malawi</option>
                    <option value="Maldives">Maldives</option>
                    <option value="Mali">Mali</option>
                    <option value="Malta">Malta</option>
                    <option value="Marshall Islands">Marshall Islands</option>
                    <option value="Martinique">Martinique</option>
                    <option value="Mauritania">Mauritania</option>
                    <option value="Mauritius">Mauritius</option>
                    <option value="Mayotte">Mayotte</option>
                    <option value="Mexico">Mexico</option>
                    <option value="Midway Islands">Midway Islands</option>
                    <option value="Moldova">Moldova</option>
                    <option value="Monaco">Monaco</option>
                    <option value="Mongolia">Mongolia</option>
                    <option value="Montserrat">Montserrat</option>
                    <option value="Morocco">Morocco</option>
                    <option value="Mozambique">Mozambique</option>
                    <option value="Myanmar">Myanmar</option>
                    <option value="Nambia">Nambia</option>
                    <option value="Nauru">Nauru</option>
                    <option value="Nepal">Nepal</option>
                    <option value="Netherland Antilles">Netherland Antilles</option>
                    <option value="Netherlands">Netherlands (Holland, Europe)</option>
                    <option value="Nevis">Nevis</option>
                    <option value="New Caledonia">New Caledonia</option>
                    <option value="New Zealand">New Zealand</option>
                    <option value="Nicaragua">Nicaragua</option>
                    <option value="Niger">Niger</option>
                    <option value="Nigeria">Nigeria</option>
                    <option value="Niue">Niue</option>
                    <option value="Norfolk Island">Norfolk Island</option>
                    <option value="Norway">Norway</option>
                    <option value="Oman">Oman</option>
                    <option value="Pakistan">Pakistan</option>
                    <option value="Palau Island">Palau Island</option>
                    <option value="Palestine">Palestine</option>
                    <option value="Panama">Panama</option>
                    <option value="Papua New Guinea">Papua New Guinea</option>
                    <option value="Paraguay">Paraguay</option>
                    <option value="Peru">Peru</option>
                    <option value="Phillipines">Philippines</option>
                    <option value="Pitcairn Island">Pitcairn Island</option>
                    <option value="Poland">Poland</option>
                    <option value="Portugal">Portugal</option>
                    <option value="Puerto Rico">Puerto Rico</option>
                    <option value="Qatar">Qatar</option>
                    <option value="Republic of Montenegro">Republic of Montenegro</option>
                    <option value="Republic of Serbia">Republic of Serbia</option>
                    <option value="Reunion">Reunion</option>
                    <option value="Romania">Romania</option>
                    <option value="Russia">Russia</option>
                    <option value="Rwanda">Rwanda</option>
                    <option value="St Barthelemy">St Barthelemy</option>
                    <option value="St Eustatius">St Eustatius</option>
                    <option value="St Helena">St Helena</option>
                    <option value="St Kitts-Nevis">St Kitts-Nevis</option>
                    <option value="St Lucia">St Lucia</option>
                    <option value="St Maarten">St Maarten</option>
                    <option value="St Pierre & Miquelon">St Pierre & Miquelon</option>
                    <option value="St Vincent & Grenadines">St Vincent & Grenadines</option>
                    <option value="Saipan">Saipan</option>
                    <option value="Samoa">Samoa</option>
                    <option value="Samoa American">Samoa American</option>
                    <option value="San Marino">San Marino</option>
                    <option value="Sao Tome & Principe">Sao Tome & Principe</option>
                    <option value="Saudi Arabia">Saudi Arabia</option>
                    <option value="Senegal">Senegal</option>
                    <option value="Seychelles">Seychelles</option>
                    <option value="Sierra Leone">Sierra Leone</option>
                    <option value="Singapore">Singapore</option>
                    <option value="Slovakia">Slovakia</option>
                    <option value="Slovenia">Slovenia</option>
                    <option value="Solomon Islands">Solomon Islands</option>
                    <option value="Somalia">Somalia</option>
                    <option value="South Africa">South Africa</option>
                    <option value="Spain">Spain</option>
                    <option value="Sri Lanka">Sri Lanka</option>
                    <option value="Sudan">Sudan</option>
                    <option value="Suriname">Suriname</option>
                    <option value="Swaziland">Swaziland</option>
                    <option value="Sweden">Sweden</option>
                    <option value="Switzerland">Switzerland</option>
                    <option value="Syria">Syria</option>
                    <option value="Tahiti">Tahiti</option>
                    <option value="Taiwan">Taiwan</option>
                    <option value="Tajikistan">Tajikistan</option>
                    <option value="Tanzania">Tanzania</option>
                    <option value="Thailand">Thailand</option>
                    <option value="Togo">Togo</option>
                    <option value="Tokelau">Tokelau</option>
                    <option value="Tonga">Tonga</option>
                    <option value="Trinidad & Tobago">Trinidad & Tobago</option>
                    <option value="Tunisia">Tunisia</option>
                    <option value="Turkey">Turkey</option>
                    <option value="Turkmenistan">Turkmenistan</option>
                    <option value="Turks & Caicos Is">Turks & Caicos Is</option>
                    <option value="Tuvalu">Tuvalu</option>
                    <option value="Uganda">Uganda</option>
                    <option value="United Kingdom">United Kingdom</option>
                    <option value="Ukraine">Ukraine</option>
                    <option value="United Arab Erimates">United Arab Emirates</option>
                    <option value="United States of America">United States of America</option>
                    <option value="Uraguay">Uruguay</option>
                    <option value="Uzbekistan">Uzbekistan</option>
                    <option value="Vanuatu">Vanuatu</option>
                    <option value="Vatican City State">Vatican City State</option>
                    <option value="Venezuela">Venezuela</option>
                    <option value="Vietnam">Vietnam</option>
                    <option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
                    <option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
                    <option value="Wake Island">Wake Island</option>
                    <option value="Wallis & Futana Is">Wallis & Futana Is</option>
                    <option value="Yemen">Yemen</option>
                    <option value="Zaire">Zaire</option>
                    <option value="Zambia">Zambia</option>
                    <option value="Zimbabwe">Zimbabwe</option>
                  </select>
                </div>
              </div>
              <div class="col-12 col-sm-6">
                <div class="form-group">
                  <label for="zip">Zip Code</label>
                  <input type="number" class="form-control" id="zip" name="zip" required placeholder="Enter Zip Code">
                </div>
              </div>
            </div>
          </fieldset> -->

          <!-- <fieldset class="mt-5">
            <legend class="mb-5">Account Setup</legend>
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <label for="account_type">Account Type</label>
                  <select class="custom-select form-control" id="account_type" name="account_type" required>
                    <option value="" selected>-- Select Type --</option>
                    <option value="personal">Personal</option>
                    <option value="business">Business</option>
                  </select>
                </div>
              </div>
              <div class="col-12 col-sm-6">
                <div class="form-group">
                  <label for="account_type">Security Question</label>
                  <select class="custom-select form-control" name="security_question" required>
                    <option value="" selected>-- Select Question --</option>
                    <option value="question1">My Best Friend?</option>
                    <option value="question2">My Spouse Name?</option>
                    <option value="question3">My Alma Mater?</option>
                    <option value="question4">My Sibling Name?</option>
                    <option value="question5">My Favorite Food?</option>
                    <option value="question6">My Pet Name?</option>
                  </select>
                  <p><small>This question is compulsory and will be used for account verification purposes. </small></p>
                </div>
              </div>
              <div class="col-12 col-sm-6">
                <div class="form-group">
                  <label for="answer">Answer</label>
                  <input type="password" class="form-control" id="answer" name="answer" required placeholder="Enter Answer to Security Question">
                </div>
              </div>
            </div>  
          </fieldset> -->
          
          <fieldset class="mt-4">
            <div class="row">
              <div class="col-sm">
                <div class="form-check custom-control custom-checkbox">
                  <input id="accept-terms" name="remember" class="custom-control-input" type="checkbox">
                  <label class="custom-control-label" for="accept-terms">I Accept the Terms and Conditions.</label>
                </div>
              </div>
            </div>
          </fieldset> 
          
          <fieldset class="mt-3">
            <button class="btn btn-primary btn-block my-4" type="submit" name="create_user_account" id="signup">
              Create Account
            </button>
          </fieldset>
        </form>

        <p class="text-3 text-muted text-center mb-0">
          Already have an account? <a class="btn-link" href="login.php">Log In</a>
        </p>
      </div>
    </div>
    <!-- Content end -->
  
   <!-- Footer
  ============================================= -->
  <footer id="footer">
    <div class="container">
      <div class="row">
        <div class="col-lg d-lg-flex align-items-center">
          <ul class="nav justify-content-center justify-content-lg-start text-3">
            <li class="nav-item"> <a class="nav-link" href="about-us.php">About Us</a></li>
            <li class="nav-item"> <a class="nav-link" href="help.php">Help</a></li>
            <li class="nav-item"> <a class="nav-link" href="fees.php">Fees</a></li>
            <li class="nav-item"> <a class="nav-link" href="contact-us.php">Contact Us</a></li>
          </ul>
        </div>
        <div class="col-lg d-lg-flex justify-content-lg-end mt-3 mt-lg-0">
          <ul class="social-icons justify-content-center">
            <li class="social-icons-facebook"><a data-toggle="tooltip" href="http://www.facebook.com/" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
            <li class="social-icons-twitter"><a data-toggle="tooltip" href="http://www.twitter.com/" target="_blank" title="Twitter"><i class="fab fa-twitter"></i></a></li>
            <li class="social-icons-google"><a data-toggle="tooltip" href="http://www.google.com/" target="_blank" title="Google"><i class="fab fa-google"></i></a></li>
            <li class="social-icons-youtube"><a data-toggle="tooltip" href="http://www.youtube.com/" target="_blank" title="Youtube"><i class="fab fa-youtube"></i></a></li>
          </ul>
        </div>
      </div>
      <div class="footer-copyright pt-3 pt-lg-2 mt-2">
        <div class="row">
          <div class="col-lg">
            <p class="text-center text-lg-left mb-2 mb-lg-0">Copyright &copy; <script>document.write(new Date().getFullYear());</script> <a href="#">ChasetellerBank</a>. All Rights Reserved.</p>
          </div>
          <div class="col-lg d-lg-flex align-items-center justify-content-lg-end">
            <ul class="nav justify-content-center">
              <li class="nav-item"> <a class="nav-link active" href="#">Security</a></li>
              <li class="nav-item"> <a class="nav-link" href="#">Terms</a></li>
              <li class="nav-item"> <a class="nav-link" href="#">Privacy</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- Footer end --> 
  
</div>
<!-- Document Wrapper end --> 

<!-- Back to Top
============================================= --> 
<a id="back-to-top" data-toggle="tooltip" title="Back to Top" href="javascript:void(0)"><i class="fa fa-chevron-up"></i></a> 

<!-- Video Modal
============================================= -->
<div class="modal fade" id="videoModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content bg-transparent border-0">
      <button type="button" class="close text-white opacity-10 ml-auto mr-n3 font-weight-400" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <div class="modal-body p-0">
        <div class="embed-responsive embed-responsive-16by9">
          <iframe class="embed-responsive-item" id="video" allow="autoplay"></iframe>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Video Modal end --> 

<!-- Script --> 
<script src="vendor/jquery/jquery.min.js"></script> 
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script> 
<script src="vendor/owl.carousel/owl.carousel.min.js"></script> 
<script src="js/theme.js"></script>

<script type="text/javascript">
  $('#signup').prop("disabled", true); 
  $('input:checkbox').click(function() {
    if ($(this).is(':checked')) {
      $('#signup').prop("disabled", false);
    }
  });
</script>
</body>
</html>