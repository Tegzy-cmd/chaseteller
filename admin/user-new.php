<?php 
    session_start();
    include("../includes/config.php");
    include("../includes/conn.php");
    include("../includes/func.php");
    admin_session_expired("login.php");
    set_headers("Add New User", "user_list");
    include("header.php");

    if (isset($_POST["create_user_account"])) 
    {
        $firstname = mysqli_real_escape_string($link, $_POST["firstname"]);
        $lastname = mysqli_real_escape_string($link, $_POST["lastname"]);
        $suffix = mysqli_real_escape_string($link, $_POST["suffix"]);
        $maiden_name = mysqli_real_escape_string($link, $_POST["maiden_name"]);
        $ssn = mysqli_real_escape_string($link, $_POST["ssn"]);
        $dob = mysqli_real_escape_string($link, $_POST["dob"]);
        $email = mysqli_real_escape_string($link, $_POST["email"]);
        $phone = mysqli_real_escape_string($link, $_POST["phone"]);
        $address = mysqli_real_escape_string($link, $_POST["address"]);
        $country = mysqli_real_escape_string($link, $_POST["country"]);
        $state = mysqli_real_escape_string($link, $_POST["state"]);
        $city = mysqli_real_escape_string($link, $_POST["city"]);
        $zip = mysqli_real_escape_string($link, $_POST["zip"]);
        $user_pin = mysqli_real_escape_string($link, $_POST["user_pin"]);
        $username = mysqli_real_escape_string($link, $_POST["username"]);
        $password = mysqli_real_escape_string($link, $_POST["password"]);
        $retyped_password = mysqli_real_escape_string($link, $_POST["retyped_password"]);
        $account_type = mysqli_real_escape_string($link, $_POST["account_type"]);
        $balance = mysqli_real_escape_string($link, $_POST["balance"]);
        $security_question = mysqli_real_escape_string($link, $_POST["security_question"]);
        $answer = mysqli_real_escape_string($link, $_POST["answer"]);

        if (empty($firstname) || empty($lastname)) {
            $_SESSION["error"] = "Please fill out the firstname and lastname.";
        } 
        elseif (empty($email)) {
            $_SESSION["error"] = "Please fill out your email.";
        } 
        elseif (empty($phone)) {
            $_SESSION["error"] = "Please fill out your phone number.";
        }
        elseif (empty($user_pin)) {
            $_SESSION["error"] = "Please enter a user PIN.";
        } 
        elseif (empty($username)) {
            $_SESSION["error"] = "Please fill out the username.";
        } 
        elseif (empty($password) || empty($retyped_password)) {
            $_SESSION["error"] = "Password and retype password cannot be empty.";
        } 
        // elseif (empty($maiden_name)) {
        //     $_SESSION["error"] = "Please fill out the maiden's name.";
        // } 
        // elseif (empty($ssn)) {
        //     $_SESSION["error"] = "Please enter your social security number.";
        // } 
        // elseif (empty($dob)) {
        //     $_SESSION["error"] = "Please enter your date of birth.";
        // } 
        // elseif (empty($address) || empty($country) || empty($state) || empty($city) || empty($zip)) {
        //     $_SESSION["error"] = "Please fill out the following: address, country, state, city and zip.";
        // } 
        // elseif (empty($account_type)) {
        //     $_SESSION["error"] = "Please select an account type.";
        // } 
        // elseif (empty($security_question) || empty($answer)) {
        //     $_SESSION["error"] = "Please fill out the security question and answer.";
        // }
        elseif (!is_alpha($firstname) || !is_alpha($lastname)) {
            $_SESSION["error"] = "Firstname and lastname can only be alphabets.";
        } 
        elseif (!val_username($username)) {
            $_SESSION["error"] = "Username can only be alphabets or alpha-numeric characters.";
        } 
        elseif (!val_email($email)) {
            $_SESSION["error"] = "Invalid email address. Please check";
        } 
        elseif (!val_pin($user_pin)) {
            $_SESSION["error"] = "The user pin must be 4 digits only.";
        }
        // elseif (get_year($dob) <= "1890") {
        //     $_SESSION["error"] = "Invalid date of birth was provided.";
        // }
        // elseif (!val_ssn($ssn)) {
        //     $_SESSION["error"] = "Invalid social security number. Please check";
        // } 
        elseif (!val_phoneno($phone)) {
            $_SESSION["error"] = "Invalid phone number. Please check";
        } 
        elseif (!minimum($password, 5)) {
            $_SESSION["error"] = "Password must be at least 5 characters.";
        }
        elseif (!compare($password, $retyped_password)) {
            $_SESSION["error"] = "Password fields do not match!";
        }
        else {
            $email_exist = mysqli_query($link, "SELECT `email` FROM `users` WHERE `email`='$email' LIMIT 1");
            if (mysqli_num_rows($email_exist) > 0) {
                $_SESSION["error"] = "Email already exists.";
            }

            $user_exist = mysqli_query($link, "SELECT `username` FROM `users` WHERE `username`='$username' LIMIT 1");
            if (mysqli_num_rows($user_exist) > 0) {
                $_SESSION["error"] = "Username already exists.";
            }

            $pin_exist = mysqli_query($link, "SELECT `user_pin` FROM `users` WHERE `user_pin`='$user_pin' LIMIT 1");
            if (mysqli_num_rows($pin_exist) > 0) {
                $_SESSION["error"] = "User PIN already exists.";
            }

            $insert_statement = "INSERT INTO `users` (`firstname`, `lastname`, `suffix`, `maiden_name`, `ssn`, `dob`, `email`, `phone`, `address`, `country`, `state`, `city`, `zip`, `user_pin`, `username`, `password`, `account_type`, `balance`, `security_question`, `answer`) ".
                                "VALUES ('$firstname', '$lastname', '$suffix', '$maiden_name', '$ssn', '$dob', '$email', '$phone', '$address', '$country', '$state', '$city', '$zip', '$user_pin', '$username', '$password', '$account_type', '$balance', '$security_question', '$answer')";
            $execute_statement = mysqli_query($link, $insert_statement);

            if ($execute_statement) {
                $_SESSION["success"] = "New user account created successfully.";
                relocate_url("users.php"); 
            } 
            else {
                $_SESSION["error"] = "unable to create a new user account.";
            }
        }
    }
?>
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title mb-0">Add New User</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12 mb-2">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="users.php">Users</a></li>
                            <li class="breadcrumb-item active">Add User</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <?php
            echo alert_ok();
            echo alert_error();
        ?>
        <div class="content-body">
            <section id="horizontal-form-layouts">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title" id="horz-layout-basic">user registration form</h4>
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
                                    <form class="form form-horizontal" action="" method="post">
                                        <div class="form-body">
                                            <h4 class="form-section">Create Login</h4>
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="user-pin">User PIN</label>
                                                <div class="col-md-9">
                                                    <input type="number" class="form-control" id="user-pin" placeholder="4 digits" name="user_pin" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="username">Username</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" id="username" placeholder="Username" name="username" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="password">Password</label>
                                                <div class="col-md-9">
                                                    <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="confirmPassword">Retype Password</label>
                                                <div class="col-md-9">
                                                    <input type="password" class="form-control" id="confirmPassword" placeholder="Retype Password" name="retyped_password" required>
                                                </div>
                                            </div>

                                            <h4 class="form-section">Personal Information</h4>
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="firstName">First Name</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" id="firstName" placeholder="First Name" name="firstname" required>                                           
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="lastName">Last Name</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" id="lastName" placeholder="Last Name" name="lastname" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="emailAddress">Email</label>
                                                <div class="col-md-9">
                                                    <input type="email" class="form-control" id="emailAddress" placeholder="Email" name="email" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="phoneNumber">Phone No</label>
                                                <div class="col-md-9">
                                                    <input type="tel" class="form-control" id="phoneNumber" placeholder="E.g +19 999 999 999" name="phone" required>
                                                </div>
                                            </div>
                                            

                                            <h4 class="form-section">Miscellaneous Information</h4>
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="suffix">Suffix</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" id="suffix" placeholder="E.g Mr. or Mrs." name="suffix">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="mothersMaidenName">Mother's Maiden Name</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" id="mothersMaidenName" placeholder="Mother's Maiden Name" name="maiden_name">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="dob">Social Security No</label>
                                                <div class="col-md-9">
                                                    <input type="number" class="form-control" id="ssn" placeholder="Social Security Number e.g 999 99 9999" name="ssn">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="dob">Date of Birth</label>
                                                <div class="col-md-9">
                                                    <input type="date" class="form-control" id="dob" placeholder="Date of Birth" name="dob">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="address">Street Address</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" id="address" placeholder="Street Address" name="address">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="city">City</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" id="city" placeholder="City" name="city">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="state">State</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" id="state" placeholder="State" name="state">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="dob">Country</label>
                                                <div class="col-md-9">
                                                    <select class="custom-select form-control" id="country" name="country">
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
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="zip">Zip Code</label>
                                                <div class="col-md-9">
                                                    <input type="number" class="form-control" id="zip" placeholder="Zip Code" name="zip">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="accountType">Account Type</label>
                                                <div class="col-md-9">
                                                    <select class="custom-select form-control" id="accountType" name="account_type">
                                                        <option value="" selected>-- Select Type --</option>
                                                        <option value="personal">Personal</option>
                                                        <option value="business">Business</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="balance">Account Balance</label>
                                                <div class="col-md-9">
                                                    <div class="input-group mt-0">
                                                        <input type="number" class="form-control" id="balance" name="balance">
                                                        <div class="input-group-append"><span class="input-group-text">.00</span></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="securityQuestion">Security Question</label>
                                                <div class="col-md-9 mb-2">
                                                    <select class="custom-select form-control" name="security_question">
                                                        <option value="" selected>-- Select Question --</option>
                                                        <option value="question1">My Best Friend?</option>
                                                        <option value="question2">My Spouse Name?</option>
                                                        <option value="question3">My Alma Mater?</option>
                                                        <option value="question4">My Sibling Name?</option>
                                                        <option value="question5">My Favorite Food?</option>
                                                        <option value="question6">My Pet Name?</option>
                                                    </select>
                                                </div>
                                                <label class="col-md-3 label-control" for="answer">Answer</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" id="answer" name="answer">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions center mt-3">
                                            <button type="submit" class="btn btn-primary" name="create_user_account">Add New User</button>
                                        </div>
                                    </form>
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