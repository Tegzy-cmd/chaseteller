<?php 
    session_start();
    include("../includes/config.php");
    include("../includes/conn.php");
    include("../includes/func.php");
    admin_session_expired("login.php");
    set_headers("Edit User Profile", "user_list");
    include("header.php");

    if (isset($_GET["uid"])) {
        $user = mysqli_fetch_array(mysqli_query($link, "SELECT * FROM `users` WHERE `id`='".$_GET["uid"]."'"));
        $u_id = $user['id'];
        $u_firstname = $user['firstname'];
        $u_lastname = $user['lastname'];
        $u_suffix = $user['suffix'];
        $u_maiden_name = $user['maiden_name'];
        $u_dob = $user['dob'];
        $u_ssn = $user['ssn'];
        $u_dob = $user['dob'];
        $u_balance = $user['balance'];
        $u_account_type = $user['account_type'];
        $u_email = $user['email'];
        $u_phone = $user['phone'];
        $u_address = $user['address'];
        $u_country = $user['country'];
        $u_city = $user['city'];
        $u_state = $user['state'];
        $u_zip = $user['zip'];
        $u_user_pin = $user['user_pin'];
        $u_username = $user['username'];
        $u_password = $user['password'];
        $u_sec_ques = $user['security_question'];
        $u_sec_ans = $user['answer'];
        $u_status = $user['status'];
        $u_register = $user['created_at'];
        $u_modified = $user['updated_at'];
    }
?>
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title mb-0">Edit User Info For [User: <b><?php echo $u_username; ?></b>]</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12 mb-2"></div>
                </div>
            </div>
        </div>
        <?php
            echo alert_ok();
            echo alert_error();
        ?>
        <div class="content-body">
            <div class="row match-height">
                <div class="col-12 col-sm-12">
                    <section id="horizontal-form-layouts">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <ul class="nav nav-tabs mb-2" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link d-flex align-items-center active" id="profile-tab" data-toggle="tab"
                                                href="#profile" aria-controls="profile" role="tab" aria-selected="true">
                                                <i class="fas fa-user-edit"></i> Profile
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link d-flex align-items-center" id="password-tab" data-toggle="tab"
                                                href="#password" aria-controls="password" role="tab" aria-selected="false">
                                                <i class="fas fa-lock"></i>Password
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link d-flex align-items-center" id="photo-tab" data-toggle="tab"
                                                href="#photo" aria-controls="photo" role="tab" aria-selected="false">
                                                <i class="fas fa-image"></i>Photo
                                            </a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link d-flex align-items-center" id="auth-code-tab" data-toggle="tab"
                                                href="#auth-code" aria-controls="auth-code" role="tab" aria-selected="false">
                                                <i class="fas fa-phone"></i>Auth-Codes
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="profile" aria-labelledby="profile-tab" role="tabpanel">
                                            <form action="" method="post" class="form form-horizontal">
                                                <h4 class="form-section">Login Info</h4>
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="user-pin">User PIN</label>
                                                    <div class="col-md-9">
                                                        <input type="number" class="form-control" id="user-pin" placeholder="User PIN" name="user_pin" value="<?php echo $u_user_pin; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="username">Username</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" id="username" placeholder="Username" name="username" value="<?php echo $u_username; ?>" required>
                                                    </div>
                                                </div>

                                                <h4 class="form-section">Personal Info</h4>
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="firstName">First Name</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" id="firstName" placeholder="First Name" name="firstname"  value="<?php echo $u_firstname; ?>" required>                                               
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="lastName">Last Name</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" id="lastName" placeholder="Last Name" name="lastname" value="<?php echo $u_lastname; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="emailAddress">Email</label>
                                                    <div class="col-md-9">
                                                        <input type="email" class="form-control" id="emailAddress" placeholder="Email" name="email" value="<?php echo $u_email; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="phoneNumber">Phone No</label>
                                                    <div class="col-md-9">
                                                        <input type="tel" class="form-control" id="phoneNumber" placeholder="Phone Number" name="phone" value="<?php echo $u_phone; ?>" required>
                                                    </div>
                                                </div>

                                                <h4 class="form-section">Miscellaneous Info</h4>
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="suffix">Suffix</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" id="suffix" placeholder="E.g Mr. or Mrs." name="suffix" value="<?php echo $u_suffix; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="mothersMaidenName">Mother's Maiden Name</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" id="mothersMaidenName" placeholder="Mother's Maiden Name" name="maiden_name" value="<?php echo $u_maiden_name; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="dob">Social Security No</label>
                                                    <div class="col-md-9">
                                                        <input type="number" class="form-control" id="ssn" placeholder="Social Security Number" name="ssn" value="<?php echo $u_ssn; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="dob">Date of Birth</label>
                                                    <div class="col-md-9">
                                                        <input type="date" class="form-control" id="dob" placeholder="Date of Birth" name="dob" value="<?php echo $u_dob; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="address">Street Address</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" id="address" placeholder="Street Address" name="address" value="<?php echo $u_address; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="dob">Country</label>
                                                    <div class="col-md-9">
                                                        <select class="custom-select form-control" id="country" name="country" required>
                                                            <option <?php if ($u_country == "Afganistan") { echo "selected"; } ?> value="Afganistan">Afghanistan</option>
                                                            <option <?php if ($u_country == "Albania") { echo "selected"; } ?> value="Albania">Albania</option>
                                                            <option <?php if ($u_country == "Algeria") { echo "selected"; } ?> value="Algeria">Algeria</option>
                                                            <option <?php if ($u_country == "American Samoa") { echo "selected"; } ?> value="American Samoa">American Samoa</option>
                                                            <option <?php if ($u_country == "Andorra") { echo "selected"; } ?> value="Andorra">Andorra</option>
                                                            <option <?php if ($u_country == "Angola") { echo "selected"; } ?> value="Angola">Angola</option>
                                                            <option <?php if ($u_country == "Anguilla") { echo "selected"; } ?> value="Anguilla">Anguilla</option>
                                                            <option <?php if ($u_country == "Antigua & Barbuda") { echo "selected"; } ?> value="Antigua & Barbuda">Antigua & Barbuda</option>
                                                            <option <?php if ($u_country == "Argentina") { echo "selected"; } ?> value="Argentina">Argentina</option>
                                                            <option <?php if ($u_country == "Armenia") { echo "selected"; } ?> value="Armenia">Armenia</option>
                                                            <option <?php if ($u_country == "Aruba") { echo "selected"; } ?> value="Aruba">Aruba</option>
                                                            <option <?php if ($u_country == "Australia") { echo "selected"; } ?> value="Australia">Australia</option>
                                                            <option <?php if ($u_country == "Austria") { echo "selected"; } ?> value="Austria">Austria</option>
                                                            <option <?php if ($u_country == "Azerbaijan") { echo "selected"; } ?> value="Azerbaijan">Azerbaijan</option>
                                                            <option <?php if ($u_country == "Bahamas") { echo "selected"; } ?> value="Bahamas">Bahamas</option>
                                                            <option <?php if ($u_country == "Bahrain") { echo "selected"; } ?> value="Bahrain">Bahrain</option>
                                                            <option <?php if ($u_country == "Bangladesh") { echo "selected"; } ?> value="Bangladesh">Bangladesh</option>
                                                            <option <?php if ($u_country == "Barbados") { echo "selected"; } ?> value="Barbados">Barbados</option>
                                                            <option <?php if ($u_country == "Belarus") { echo "selected"; } ?> value="Belarus">Belarus</option>
                                                            <option <?php if ($u_country == "Belgium") { echo "selected"; } ?> value="Belgium">Belgium</option>
                                                            <option <?php if ($u_country == "Belize") { echo "selected"; } ?> value="Belize">Belize</option>
                                                            <option <?php if ($u_country == "Benin") { echo "selected"; } ?> value="Benin">Benin</option>
                                                            <option <?php if ($u_country == "Bermuda") { echo "selected"; } ?> value="Bermuda">Bermuda</option>
                                                            <option <?php if ($u_country == "Bhutan") { echo "selected"; } ?> value="Bhutan">Bhutan</option>
                                                            <option <?php if ($u_country == "Bolivia") { echo "selected"; } ?> value="Bolivia">Bolivia</option>
                                                            <option <?php if ($u_country == "Bonaire") { echo "selected"; } ?> value="Bonaire">Bonaire</option>
                                                            <option <?php if ($u_country == "Bosnia & Herzegovina") { echo "selected"; } ?> value="Bosnia & Herzegovina">Bosnia & Herzegovina</option>
                                                            <option <?php if ($u_country == "Botswana") { echo "selected"; } ?> value="Botswana">Botswana</option>
                                                            <option <?php if ($u_country == "Brazil") { echo "selected"; } ?> value="Brazil">Brazil</option>
                                                            <option <?php if ($u_country == "British Indian Ocean Ter") { echo "selected"; } ?> value="British Indian Ocean Ter">British Indian Ocean Ter</option>
                                                            <option <?php if ($u_country == "Brunei") { echo "selected"; } ?> value="Brunei">Brunei</option>
                                                            <option <?php if ($u_country == "Bulgaria") { echo "selected"; } ?> value="Bulgaria">Bulgaria</option>
                                                            <option <?php if ($u_country == "Burkina Faso") { echo "selected"; } ?> value="Burkina Faso">Burkina Faso</option>
                                                            <option <?php if ($u_country == "Burundi") { echo "selected"; } ?> value="Burundi">Burundi</option>
                                                            <option <?php if ($u_country == "Cambodia") { echo "selected"; } ?> value="Cambodia">Cambodia</option>
                                                            <option <?php if ($u_country == "Cameroon") { echo "selected"; } ?> value="Cameroon">Cameroon</option>
                                                            <option <?php if ($u_country == "Canada") { echo "selected"; } ?> value="Canada">Canada</option>
                                                            <option <?php if ($u_country == "Canary Islands") { echo "selected"; } ?> value="Canary Islands">Canary Islands</option>
                                                            <option <?php if ($u_country == "Cape Verde") { echo "selected"; } ?> value="Cape Verde">Cape Verde</option>
                                                            <option <?php if ($u_country == "Cayman Islands") { echo "selected"; } ?> value="Cayman Islands">Cayman Islands</option>
                                                            <option <?php if ($u_country == "Central African Republic") { echo "selected"; } ?> value="Central African Republic">Central African Republic</option>
                                                            <option <?php if ($u_country == "Chad") { echo "selected"; } ?> value="Chad">Chad</option>
                                                            <option <?php if ($u_country == "Channel Islands") { echo "selected"; } ?> value="Channel Islands">Channel Islands</option>
                                                            <option <?php if ($u_country == "Chile") { echo "selected"; } ?> value="Chile">Chile</option>
                                                            <option <?php if ($u_country == "China") { echo "selected"; } ?> value="China">China</option>
                                                            <option <?php if ($u_country == "Christmas Island") { echo "selected"; } ?> value="Christmas Island">Christmas Island</option>
                                                            <option <?php if ($u_country == "Cocos Island") { echo "selected"; } ?> value="Cocos Island">Cocos Island</option>
                                                            <option <?php if ($u_country == "Colombia") { echo "selected"; } ?> value="Colombia">Colombia</option>
                                                            <option <?php if ($u_country == "Comoros") { echo "selected"; } ?> value="Comoros">Comoros</option>
                                                            <option <?php if ($u_country == "Congo") { echo "selected"; } ?> value="Congo">Congo</option>
                                                            <option <?php if ($u_country == "Cook Islands") { echo "selected"; } ?> value="Cook Islands">Cook Islands</option>
                                                            <option <?php if ($u_country == "Costa Rica") { echo "selected"; } ?> value="Costa Rica">Costa Rica</option>
                                                            <option <?php if ($u_country == "Cote DIvoire") { echo "selected"; } ?> value="Cote DIvoire">Cote DIvoire</option>
                                                            <option <?php if ($u_country == "Croatia") { echo "selected"; } ?> value="Croatia">Croatia</option>
                                                            <option <?php if ($u_country == "Cuba") { echo "selected"; } ?> value="Cuba">Cuba</option>
                                                            <option <?php if ($u_country == "Curaco") { echo "selected"; } ?> value="Curaco">Curacao</option>
                                                            <option <?php if ($u_country == "Cyprus") { echo "selected"; } ?> value="Cyprus">Cyprus</option>
                                                            <option <?php if ($u_country == "Czech Republic") { echo "selected"; } ?> value="Czech Republic">Czech Republic</option>
                                                            <option <?php if ($u_country == "Denmark") { echo "selected"; } ?> value="Denmark">Denmark</option>
                                                            <option <?php if ($u_country == "Djibouti") { echo "selected"; } ?> value="Djibouti">Djibouti</option>
                                                            <option <?php if ($u_country == "Dominica") { echo "selected"; } ?> value="Dominica">Dominica</option>
                                                            <option <?php if ($u_country == "Dominican Republic") { echo "selected"; } ?> value="Dominican Republic">Dominican Republic</option>
                                                            <option <?php if ($u_country == "East Timor") { echo "selected"; } ?> value="East Timor">East Timor</option>
                                                            <option <?php if ($u_country == "Ecuador") { echo "selected"; } ?> value="Ecuador">Ecuador</option>
                                                            <option <?php if ($u_country == "Egypt") { echo "selected"; } ?> value="Egypt">Egypt</option>
                                                            <option <?php if ($u_country == "El Salvador") { echo "selected"; } ?> value="El Salvador">El Salvador</option>
                                                            <option <?php if ($u_country == "Equatorial Guinea") { echo "selected"; } ?> value="Equatorial Guinea">Equatorial Guinea</option>
                                                            <option <?php if ($u_country == "Eritrea") { echo "selected"; } ?> value="Eritrea">Eritrea</option>
                                                            <option <?php if ($u_country == "Estonia") { echo "selected"; } ?> value="Estonia">Estonia</option>
                                                            <option <?php if ($u_country == "Ethiopia") { echo "selected"; } ?> value="Ethiopia">Ethiopia</option>
                                                            <option <?php if ($u_country == "Falkland Islands") { echo "selected"; } ?> value="Falkland Islands">Falkland Islands</option>
                                                            <option <?php if ($u_country == "Faroe Islands") { echo "selected"; } ?> value="Faroe Islands">Faroe Islands</option>
                                                            <option <?php if ($u_country == "Fiji") { echo "selected"; } ?> value="Fiji">Fiji</option>
                                                            <option <?php if ($u_country == "Finland") { echo "selected"; } ?> value="Finland">Finland</option>
                                                            <option <?php if ($u_country == "France") { echo "selected"; } ?> value="France">France</option>
                                                            <option <?php if ($u_country == "French Guiana") { echo "selected"; } ?> value="French Guiana">French Guiana</option>
                                                            <option <?php if ($u_country == "French Polynesia") { echo "selected"; } ?> value="French Polynesia">French Polynesia</option>
                                                            <option <?php if ($u_country == "French Southern Ter") { echo "selected"; } ?> value="French Southern Ter">French Southern Ter</option>
                                                            <option <?php if ($u_country == "Gabon") { echo "selected"; } ?> value="Gabon">Gabon</option>
                                                            <option <?php if ($u_country == "Gambia") { echo "selected"; } ?> value="Gambia">Gambia</option>
                                                            <option <?php if ($u_country == "Georgia") { echo "selected"; } ?> value="Georgia">Georgia</option>
                                                            <option <?php if ($u_country == "Germany") { echo "selected"; } ?> value="Germany">Germany</option>
                                                            <option <?php if ($u_country == "Ghana") { echo "selected"; } ?> value="Ghana">Ghana</option>
                                                            <option <?php if ($u_country == "Gibraltar") { echo "selected"; } ?> value="Gibraltar">Gibraltar</option>
                                                            <option <?php if ($u_country == "Great Britain") { echo "selected"; } ?> value="Great Britain">Great Britain</option>
                                                            <option <?php if ($u_country == "Greece") { echo "selected"; } ?> value="Greece">Greece</option>
                                                            <option <?php if ($u_country == "Greenland") { echo "selected"; } ?> value="Greenland">Greenland</option>
                                                            <option <?php if ($u_country == "Grenada") { echo "selected"; } ?> value="Grenada">Grenada</option>
                                                            <option <?php if ($u_country == "Guadeloupe") { echo "selected"; } ?> value="Guadeloupe">Guadeloupe</option>
                                                            <option <?php if ($u_country == "Guam") { echo "selected"; } ?> value="Guam">Guam</option>
                                                            <option <?php if ($u_country == "Guatemala") { echo "selected"; } ?> value="Guatemala">Guatemala</option>
                                                            <option <?php if ($u_country == "Guinea") { echo "selected"; } ?> value="Guinea">Guinea</option>
                                                            <option <?php if ($u_country == "Guyana") { echo "selected"; } ?> value="Guyana">Guyana</option>
                                                            <option <?php if ($u_country == "Haiti") { echo "selected"; } ?> value="Haiti">Haiti</option>
                                                            <option <?php if ($u_country == "Hawaii") { echo "selected"; } ?> value="Hawaii">Hawaii</option>
                                                            <option <?php if ($u_country == "Honduras") { echo "selected"; } ?> value="Honduras">Honduras</option>
                                                            <option <?php if ($u_country == "Hong Kong") { echo "selected"; } ?> value="Hong Kong">Hong Kong</option>
                                                            <option <?php if ($u_country == "Hungary") { echo "selected"; } ?> value="Hungary">Hungary</option>
                                                            <option <?php if ($u_country == "Iceland") { echo "selected"; } ?> value="Iceland">Iceland</option>
                                                            <option <?php if ($u_country == "Indonesia") { echo "selected"; } ?> value="Indonesia">Indonesia</option>
                                                            <option <?php if ($u_country == "India") { echo "selected"; } ?> value="India">India</option>
                                                            <option <?php if ($u_country == "Iran") { echo "selected"; } ?> value="Iran">Iran</option>
                                                            <option <?php if ($u_country == "Iraq") { echo "selected"; } ?> value="Iraq">Iraq</option>
                                                            <option <?php if ($u_country == "Ireland") { echo "selected"; } ?> value="Ireland">Ireland</option>
                                                            <option <?php if ($u_country == "Isle of Man") { echo "selected"; } ?> value="Isle of Man">Isle of Man</option>
                                                            <option <?php if ($u_country == "Israel") { echo "selected"; } ?> value="Israel">Israel</option>
                                                            <option <?php if ($u_country == "Italy") { echo "selected"; } ?> value="Italy">Italy</option>
                                                            <option <?php if ($u_country == "Jamaica") { echo "selected"; } ?> value="Jamaica">Jamaica</option>
                                                            <option <?php if ($u_country == "Japan") { echo "selected"; } ?> value="Japan">Japan</option>
                                                            <option <?php if ($u_country == "Jordan") { echo "selected"; } ?> value="Jordan">Jordan</option>
                                                            <option <?php if ($u_country == "Kazakhstan") { echo "selected"; } ?> value="Kazakhstan">Kazakhstan</option>
                                                            <option <?php if ($u_country == "Kenya") { echo "selected"; } ?> value="Kenya">Kenya</option>
                                                            <option <?php if ($u_country == "Kiribati") { echo "selected"; } ?> value="Kiribati">Kiribati</option>
                                                            <option <?php if ($u_country == "Korea North") { echo "selected"; } ?> value="Korea North">Korea North</option>
                                                            <option <?php if ($u_country == "Korea South") { echo "selected"; } ?> value="Korea South">Korea South</option>
                                                            <option <?php if ($u_country == "Kuwait") { echo "selected"; } ?> value="Kuwait">Kuwait</option>
                                                            <option <?php if ($u_country == "Kyrgyzstan") { echo "selected"; } ?> value="Kyrgyzstan">Kyrgyzstan</option>
                                                            <option <?php if ($u_country == "Laos") { echo "selected"; } ?> value="Laos">Laos</option>
                                                            <option <?php if ($u_country == "Latvia") { echo "selected"; } ?> value="Latvia">Latvia</option>
                                                            <option <?php if ($u_country == "Lebanon") { echo "selected"; } ?> value="Lebanon">Lebanon</option>
                                                            <option <?php if ($u_country == "Lesotho") { echo "selected"; } ?> value="Lesotho">Lesotho</option>
                                                            <option <?php if ($u_country == "Liberia") { echo "selected"; } ?> value="Liberia">Liberia</option>
                                                            <option <?php if ($u_country == "Libya") { echo "selected"; } ?> value="Libya">Libya</option>
                                                            <option <?php if ($u_country == "Liechtenstein") { echo "selected"; } ?> value="Liechtenstein">Liechtenstein</option>
                                                            <option <?php if ($u_country == "Lithuania") { echo "selected"; } ?> value="Lithuania">Lithuania</option>
                                                            <option <?php if ($u_country == "Luxembourg") { echo "selected"; } ?> value="Luxembourg">Luxembourg</option>
                                                            <option <?php if ($u_country == "Macau") { echo "selected"; } ?> value="Macau">Macau</option>
                                                            <option <?php if ($u_country == "Macedonia") { echo "selected"; } ?> value="Macedonia">Macedonia</option>
                                                            <option <?php if ($u_country == "Madagascar") { echo "selected"; } ?> value="Madagascar">Madagascar</option>
                                                            <option <?php if ($u_country == "Malaysia") { echo "selected"; } ?> value="Malaysia">Malaysia</option>
                                                            <option <?php if ($u_country == "Malawi") { echo "selected"; } ?> value="Malawi">Malawi</option>
                                                            <option <?php if ($u_country == "Maldives") { echo "selected"; } ?> value="Maldives">Maldives</option>
                                                            <option <?php if ($u_country == "Mali") { echo "selected"; } ?> value="Mali">Mali</option>
                                                            <option <?php if ($u_country == "Malta") { echo "selected"; } ?> value="Malta">Malta</option>
                                                            <option <?php if ($u_country == "Marshall Islands") { echo "selected"; } ?> value="Marshall Islands">Marshall Islands</option>
                                                            <option <?php if ($u_country == "Martinique") { echo "selected"; } ?> value="Martinique">Martinique</option>
                                                            <option <?php if ($u_country == "Mauritania") { echo "selected"; } ?> value="Mauritania">Mauritania</option>
                                                            <option <?php if ($u_country == "Mauritius") { echo "selected"; } ?> value="Mauritius">Mauritius</option>
                                                            <option <?php if ($u_country == "Mayotte") { echo "selected"; } ?> value="Mayotte">Mayotte</option>
                                                            <option <?php if ($u_country == "Mexico") { echo "selected"; } ?> value="Mexico">Mexico</option>
                                                            <option <?php if ($u_country == "Midway Islands") { echo "selected"; } ?> value="Midway Islands">Midway Islands</option>
                                                            <option <?php if ($u_country == "Moldova") { echo "selected"; } ?> value="Moldova">Moldova</option>
                                                            <option <?php if ($u_country == "Monaco") { echo "selected"; } ?> value="Monaco">Monaco</option>
                                                            <option <?php if ($u_country == "Mongolia") { echo "selected"; } ?> value="Mongolia">Mongolia</option>
                                                            <option <?php if ($u_country == "Montserrat") { echo "selected"; } ?> value="Montserrat">Montserrat</option>
                                                            <option <?php if ($u_country == "Morocco") { echo "selected"; } ?> value="Morocco">Morocco</option>
                                                            <option <?php if ($u_country == "Mozambique") { echo "selected"; } ?> value="Mozambique">Mozambique</option>
                                                            <option <?php if ($u_country == "Myanmar") { echo "selected"; } ?> value="Myanmar">Myanmar</option>
                                                            <option <?php if ($u_country == "Nambia") { echo "selected"; } ?> value="Nambia">Nambia</option>
                                                            <option <?php if ($u_country == "Nauru") { echo "selected"; } ?> value="Nauru">Nauru</option>
                                                            <option <?php if ($u_country == "Nepal") { echo "selected"; } ?> value="Nepal">Nepal</option>
                                                            <option <?php if ($u_country == "Netherland Antilles") { echo "selected"; } ?> value="Netherland Antilles">Netherland Antilles</option>
                                                            <option <?php if ($u_country == "Netherlands") { echo "selected"; } ?> value="Netherlands">Netherlands (Holland, Europe)</option>
                                                            <option <?php if ($u_country == "Nevis") { echo "selected"; } ?> value="Nevis">Nevis</option>
                                                            <option <?php if ($u_country == "New Caledonia") { echo "selected"; } ?> value="New Caledonia">New Caledonia</option>
                                                            <option <?php if ($u_country == "New Zealand") { echo "selected"; } ?> value="New Zealand">New Zealand</option>
                                                            <option <?php if ($u_country == "Nicaragua") { echo "selected"; } ?> value="Nicaragua">Nicaragua</option>
                                                            <option <?php if ($u_country == "Niger") { echo "selected"; } ?> value="Niger">Niger</option>
                                                            <option <?php if ($u_country == "Nigeria") { echo "selected"; } ?> value="Nigeria">Nigeria</option>
                                                            <option <?php if ($u_country == "Niue") { echo "selected"; } ?> value="Niue">Niue</option>
                                                            <option <?php if ($u_country == "Norfolk Island") { echo "selected"; } ?> value="Norfolk Island">Norfolk Island</option>
                                                            <option <?php if ($u_country == "Norway") { echo "selected"; } ?> value="Norway">Norway</option>
                                                            <option <?php if ($u_country == "Oman") { echo "selected"; } ?> value="Oman">Oman</option>
                                                            <option <?php if ($u_country == "Pakistan") { echo "selected"; } ?> value="Pakistan">Pakistan</option>
                                                            <option <?php if ($u_country == "Palau Island") { echo "selected"; } ?> value="Palau Island">Palau Island</option>
                                                            <option <?php if ($u_country == "Palestine") { echo "selected"; } ?> value="Palestine">Palestine</option>
                                                            <option <?php if ($u_country == "Panama") { echo "selected"; } ?> value="Panama">Panama</option>
                                                            <option <?php if ($u_country == "Papua New Guinea") { echo "selected"; } ?> value="Papua New Guinea">Papua New Guinea</option>
                                                            <option <?php if ($u_country == "Paraguay") { echo "selected"; } ?> value="Paraguay">Paraguay</option>
                                                            <option <?php if ($u_country == "Peru") { echo "selected"; } ?> value="Peru">Peru</option>
                                                            <option <?php if ($u_country == "Phillipines") { echo "selected"; } ?> value="Phillipines">Philippines</option>
                                                            <option <?php if ($u_country == "Pitcairn Island") { echo "selected"; } ?> value="Pitcairn Island">Pitcairn Island</option>
                                                            <option <?php if ($u_country == "Poland") { echo "selected"; } ?> value="Poland">Poland</option>
                                                            <option <?php if ($u_country == "Portugal") { echo "selected"; } ?> value="Portugal">Portugal</option>
                                                            <option <?php if ($u_country == "Puerto Rico") { echo "selected"; } ?> value="Puerto Rico">Puerto Rico</option>
                                                            <option <?php if ($u_country == "Qatar") { echo "selected"; } ?> value="Qatar">Qatar</option>
                                                            <option <?php if ($u_country == "Republic of Montenegro") { echo "selected"; } ?> value="Republic of Montenegro">Republic of Montenegro</option>
                                                            <option <?php if ($u_country == "Republic of Serbia") { echo "selected"; } ?> value="Republic of Serbia">Republic of Serbia</option>
                                                            <option <?php if ($u_country == "Reunion") { echo "selected"; } ?> value="Reunion">Reunion</option>
                                                            <option <?php if ($u_country == "Romania") { echo "selected"; } ?> value="Romania">Romania</option>
                                                            <option <?php if ($u_country == "Russia") { echo "selected"; } ?> value="Russia">Russia</option>
                                                            <option <?php if ($u_country == "Rwanda") { echo "selected"; } ?> value="Rwanda">Rwanda</option>
                                                            <option <?php if ($u_country == "St Barthelemy") { echo "selected"; } ?> value="St Barthelemy">St Barthelemy</option>
                                                            <option <?php if ($u_country == "St Eustatius") { echo "selected"; } ?> value="St Eustatius">St Eustatius</option>
                                                            <option <?php if ($u_country == "St Helena") { echo "selected"; } ?> value="St Helena">St Helena</option>
                                                            <option <?php if ($u_country == "St Kitts-Nevis") { echo "selected"; } ?> value="St Kitts-Nevis">St Kitts-Nevis</option>
                                                            <option <?php if ($u_country == "St Lucia") { echo "selected"; } ?> value="St Lucia">St Lucia</option>
                                                            <option <?php if ($u_country == "St Maarten") { echo "selected"; } ?> value="St Maarten">St Maarten</option>
                                                            <option <?php if ($u_country == "St Pierre & Miquelon") { echo "selected"; } ?> value="St Pierre & Miquelon">St Pierre & Miquelon</option>
                                                            <option <?php if ($u_country == "St Vincent & Grenadines") { echo "selected"; } ?> value="St Vincent & Grenadines">St Vincent & Grenadines</option>
                                                            <option <?php if ($u_country == "Saipan") { echo "selected"; } ?> value="Saipan">Saipan</option>
                                                            <option <?php if ($u_country == "Samoa") { echo "selected"; } ?> value="Samoa">Samoa</option>
                                                            <option <?php if ($u_country == "Samoa American") { echo "selected"; } ?> value="Samoa American">Samoa American</option>
                                                            <option <?php if ($u_country == "San Marino") { echo "selected"; } ?> value="San Marino">San Marino</option>
                                                            <option <?php if ($u_country == "Sao Tome & Principe") { echo "selected"; } ?> value="Sao Tome & Principe">Sao Tome & Principe</option>
                                                            <option <?php if ($u_country == "Saudi Arabia") { echo "selected"; } ?> value="Saudi Arabia">Saudi Arabia</option>
                                                            <option <?php if ($u_country == "Senegal") { echo "selected"; } ?> value="Senegal">Senegal</option>
                                                            <option <?php if ($u_country == "Seychelles") { echo "selected"; } ?> value="Seychelles">Seychelles</option>
                                                            <option <?php if ($u_country == "Sierra Leone") { echo "selected"; } ?> value="Sierra Leone">Sierra Leone</option>
                                                            <option <?php if ($u_country == "Singapore") { echo "selected"; } ?> value="Singapore">Singapore</option>
                                                            <option <?php if ($u_country == "Slovakia") { echo "selected"; } ?> value="Slovakia">Slovakia</option>
                                                            <option <?php if ($u_country == "Slovenia") { echo "selected"; } ?> value="Slovenia">Slovenia</option>
                                                            <option <?php if ($u_country == "Solomon Islands") { echo "selected"; } ?> value="Solomon Islands">Solomon Islands</option>
                                                            <option <?php if ($u_country == "Somalia") { echo "selected"; } ?> value="Somalia">Somalia</option>
                                                            <option <?php if ($u_country == "South Africa") { echo "selected"; } ?> value="South Africa">South Africa</option>
                                                            <option <?php if ($u_country == "Spain") { echo "selected"; } ?> value="Spain">Spain</option>
                                                            <option <?php if ($u_country == "Sri Lanka") { echo "selected"; } ?> value="Sri Lanka">Sri Lanka</option>
                                                            <option <?php if ($u_country == "Sudan") { echo "selected"; } ?> value="Sudan">Sudan</option>
                                                            <option <?php if ($u_country == "Suriname") { echo "selected"; } ?> value="Suriname">Suriname</option>
                                                            <option <?php if ($u_country == "Swaziland") { echo "selected"; } ?> value="Swaziland">Swaziland</option>
                                                            <option <?php if ($u_country == "Sweden") { echo "selected"; } ?> value="Sweden">Sweden</option>
                                                            <option <?php if ($u_country == "Switzerland") { echo "selected"; } ?> value="Switzerland">Switzerland</option>
                                                            <option <?php if ($u_country == "Syria") { echo "selected"; } ?> value="Syria">Syria</option>
                                                            <option <?php if ($u_country == "Tahiti") { echo "selected"; } ?> value="Tahiti">Tahiti</option>
                                                            <option <?php if ($u_country == "Taiwan") { echo "selected"; } ?> value="Taiwan">Taiwan</option>
                                                            <option <?php if ($u_country == "Tajikistan") { echo "selected"; } ?> value="Tajikistan">Tajikistan</option>
                                                            <option <?php if ($u_country == "Tanzania") { echo "selected"; } ?> value="Tanzania">Tanzania</option>
                                                            <option <?php if ($u_country == "Thailand") { echo "selected"; } ?> value="Thailand">Thailand</option>
                                                            <option <?php if ($u_country == "Togo") { echo "selected"; } ?> value="Togo">Togo</option>
                                                            <option <?php if ($u_country == "Tokelau") { echo "selected"; } ?> value="Tokelau">Tokelau</option>
                                                            <option <?php if ($u_country == "Tonga") { echo "selected"; } ?> value="Tonga">Tonga</option>
                                                            <option <?php if ($u_country == "Trinidad & Tobago") { echo "selected"; } ?> value="Trinidad & Tobago">Trinidad & Tobago</option>
                                                            <option <?php if ($u_country == "Tunisia") { echo "selected"; } ?> value="Tunisia">Tunisia</option>
                                                            <option <?php if ($u_country == "Turkey") { echo "selected"; } ?> value="Turkey">Turkey</option>
                                                            <option <?php if ($u_country == "Turkmenistan") { echo "selected"; } ?> value="Turkmenistan">Turkmenistan</option>
                                                            <option <?php if ($u_country == "Turks & Caicos Is") { echo "selected"; } ?> value="Turks & Caicos Is">Turks & Caicos Is</option>
                                                            <option <?php if ($u_country == "Tuvalu") { echo "selected"; } ?> value="Tuvalu">Tuvalu</option>
                                                            <option <?php if ($u_country == "Uganda") { echo "selected"; } ?> value="Uganda">Uganda</option>
                                                            <option <?php if ($u_country == "United Kingdom") { echo "selected"; } ?> value="United Kingdom">United Kingdom</option>
                                                            <option <?php if ($u_country == "Ukraine") { echo "selected"; } ?> value="Ukraine">Ukraine</option>
                                                            <option <?php if ($u_country == "United Arab Erimates") { echo "selected"; } ?> value="United Arab Erimates">United Arab Emirates</option>
                                                            <option <?php if ($u_country == "United States of America") { echo "selected"; } ?> value="United States of America">United States of America</option>
                                                            <option <?php if ($u_country == "Uraguay") { echo "selected"; } ?> value="Uraguay">Uruguay</option>
                                                            <option <?php if ($u_country == "Uzbekistan") { echo "selected"; } ?> value="Uzbekistan">Uzbekistan</option>
                                                            <option <?php if ($u_country == "Vanuatu") { echo "selected"; } ?> value="Vanuatu">Vanuatu</option>
                                                            <option <?php if ($u_country == "Vatican City State") { echo "selected"; } ?> value="Vatican City State">Vatican City State</option>
                                                            <option <?php if ($u_country == "Venezuela") { echo "selected"; } ?> value="Venezuela">Venezuela</option>
                                                            <option <?php if ($u_country == "Vietnam") { echo "selected"; } ?> value="Vietnam">Vietnam</option>
                                                            <option <?php if ($u_country == "Virgin Islands (Brit)") { echo "selected"; } ?> value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
                                                            <option <?php if ($u_country == "Virgin Islands (USA)") { echo "selected"; } ?> value="Virgin Islands (USA)">Virgin Islands (USA)</option>
                                                            <option <?php if ($u_country == "Wake Island") { echo "selected"; } ?> value="Wake Island">Wake Island</option>
                                                            <option <?php if ($u_country == "Wallis & Futana Is") { echo "selected"; } ?> value="Wallis & Futana Is">Wallis & Futana Is</option>
                                                            <option <?php if ($u_country == "Yemen") { echo "selected"; } ?> value="Yemen">Yemen</option>
                                                            <option <?php if ($u_country == "Zaire") { echo "selected"; } ?> value="Zaire">Zaire</option>
                                                            <option <?php if ($u_country == "Zambia") { echo "selected"; } ?> value="Zambia">Zambia</option>
                                                            <option <?php if ($u_country == "Zimbabwe") { echo "selected"; } ?> value="Zimbabwe">Zimbabwe</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="state">State</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" id="state" placeholder="State" name="state" value="<?php echo $u_state; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="city">City</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" id="city" placeholder="City" name="city" value="<?php echo $u_city; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="zip">Zip Code</label>
                                                    <div class="col-md-9">
                                                        <input type="number" class="form-control" id="zip" placeholder="Zip Code" name="zip" value="<?php echo $u_zip; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="accountType">Account Type</label>
                                                    <div class="col-md-9">
                                                        <select class="custom-select form-control" id="accountType" name="account_type">
                                                            <option <?php if ($u_account_type == "personal") { echo "selected"; } ?> value="personal">Personal</option>
                                                            <option <?php if ($u_account_type == "business") { echo "selected"; } ?> value="business">Business</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="accountBalance">Account Balance</label>
                                                    <div class="col-md-9">
                                                        <div class="input-group mt-0">
                                                            <input type="number" class="form-control" name="balance" value="<?php echo $u_balance; ?>">
                                                            <div class="input-group-append"><span class="input-group-text">.00</span></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="securityQuestion">Security Question</label>
                                                    <div class="col-md-9 mb-2">
                                                        <select class="custom-select form-control" name="security_question">
                                                            <option value="" selected="" disabled="">-- Select Question --</option>
                                                            <option <?php if ($u_sec_ques == "question1") { echo "selected"; } ?> value="question1">My Best Friend?</option>
                                                            <option <?php if ($u_sec_ques == "question2") { echo "selected"; } ?> value="question2">My Spouse Name?</option>
                                                            <option <?php if ($u_sec_ques == "question3") { echo "selected"; } ?> value="question3">My Alma Mater?</option>
                                                            <option <?php if ($u_sec_ques == "question4") { echo "selected"; } ?> value="question4">My Sibling Name?</option>
                                                            <option <?php if ($u_sec_ques == "question5") { echo "selected"; } ?> value="question3">My Favorite Food?</option>
                                                            <option <?php if ($u_sec_ques == "question6") { echo "selected"; } ?> value="question4">My Pet Name?</option>
                                                        </select>
                                                    </div>
                                                    <label class="col-md-3 label-control" for="securityAnswer">Answer</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" id="securityAnswer" name="answer" value="<?php echo $u_sec_ans; ?>">
                                                    </div>
                                                </div>
                                                <input type="hidden" name="id" value="<?php echo $u_id; ?>">
                                                <div class="form-actions center mt-3">
                                                    <button type="submit" class="btn btn-success" name="update_user_account">
                                                        Save Changes
                                                    </button>
                                                </div>
                                            </form>
                                        </div>

                                        <div class="tab-pane" id="password" aria-labelledby="password-tab" role="tabpanel">
                                            <form action="" method="post" class="form form-horizontal">
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
                                                <input type="hidden" name="id" value="<?php echo $u_id; ?>">
                                                <div class="form-actions center mt-3">
                                                    <button type="submit" class="btn btn-success" name="update_user_password">Save Changes</button>
                                                </div>
                                            </form>
                                        </div>

                                        <div class="tab-pane" id="photo" aria-labelledby="photo-tab" role="tabpanel">
                                            <form action="" method="post" enctype="multipart/form-data" class="form">
                                                <div class="row justify-content-md-center">
                                                    <div class="col-md-6">
                                                        <div class="form-body">
                                                            <div class="form-group">
                                                                <label>Select File</label>
                                                                <label id="projectinput7" class="file center-block">
                                                                    <input type="file" id="file" name="avatar">
                                                                    <span class="file-custom"></span>
                                                                </label>
                                                                <p class="text-muted ml-75 mt-50">
                                                                    <small class="danger">Allowed files are JPG, GIF or PNG. Max size of 800kB</small>
                                                                </p>
                                                            </div>    
                                                            <input type="hidden" name="id" value="<?php echo $u_id; ?>">

                                                            <div class="form-actions center mt-3">
                                                                <button type="submit" class="btn btn-success" name="update_user_photo">Upload Now</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="tab-pane" id="auth-code" aria-labelledby="auth-code-tab" role="tabpanel">
                                            <form action="" method="post" class="form form-horizontal">
                                                <!-- <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="otp">Enter 4 digit otp</label>
                                                    <div class="col-md-9">
                                                        <input type="text" maxlength="4" class="form-control" id="text" placeholder="Enter 4 digit otp" name="otp" required>
                                                    </div> -->
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="bvc">Enter  digit bvc</label>
                                                    <div class="col-md-9">
                                                        <input type="text" maxlength="4" class="form-control" id="bvc" placeholder="Enter 4 digit bvc" name="bvc" required>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="id" value="<?php echo $u_id; ?>">
                                                <div class="form-actions center mt-3">
                                                    <button type="submit" class="btn btn-success" name="update_user_codes">Save Changes</button>
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
    </div>
</div>
<?php 
    flush_headers();
    include("footer.php");

    if (isset($_POST['update_user_account'])) 
    {
        $id = mysqli_real_escape_string($link, $_POST["id"]);
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
        $account_type = mysqli_real_escape_string($link, $_POST["account_type"]);
        $balance = mysqli_real_escape_string($link, $_POST["balance"]);
        $security_question = mysqli_real_escape_string($link, $_POST["security_question"]);
        $answer = mysqli_real_escape_string($link, $_POST["answer"]);
        $status = mysqli_real_escape_string($link, $_POST["status"]);
        $log = get_date();

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
        elseif (empty($maiden_name)) {
            $_SESSION["error"] = "Please fill out the maiden's name.";
        }
        elseif (empty($ssn)) {
            $_SESSION["error"] = "Please enter your social security number.";
        } 
        elseif (empty($dob)) {
            $_SESSION["error"] = "Please enter your date of birth.";
        }
        elseif (empty($address) || empty($country) || empty($state) || empty($city) || empty($zip)) {
            $_SESSION["error"] = "Please fill out the following: address, country, state, city and zip.";
        } 
        elseif (empty($account_type)) {
            $_SESSION["error"] = "Please select an account type.";
        } 
        elseif (empty($security_question) || empty($answer)) {
            $_SESSION["error"] = "Please fill out the security question and answer.";
        }
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
        else {
            $profile_statement = "UPDATE `users` SET `firstname`='$firstname', `lastname`='$lastname', `suffix`='$suffix', `maiden_name`='$maiden_name', `ssn`='$ssn', `dob`='$dob', `email`='$email', `phone`='$phone', `address`='$address', `country`='$country', `state`='$state', ".
                                 "`city`='$city', `zip`='$zip', `user_pin`='$user_pin', `username`='$username', `account_type`='$account_type', `balance`='$balance', `security_question`='$security_question', `answer`='$answer', `status`='$status', `updated_at`='$log' WHERE `id`='$id'";
            $update_profile = mysqli_query($link, $profile_statement);

            if ($update_profile) {
                $_SESSION["success"] = "User profile has been updated successfully.";
                relocate_url("users.php");
            } 
            else {
                $_SESSION["error"] = "unable to update user profile.";
            }
        }
    }


    // update user otp and bvc start

if (isset($_POST['update_user_codes'])) {
    $id = mysqli_real_escape_string($link, $_POST["id"]);
    $bvc = mysqli_real_escape_string($link, $_POST["bvc"]);

    if (empty($bvc)) {
        $_SESSION["error"] = "Please all fields must be filled.";
    } else {
        $codes_statement = "UPDATE `users` SET `bvc`='$bvc' WHERE `id`='$id'";
        $update_codes = mysqli_query($link, $codes_statement);

        if ($update_password) {
            $_SESSION["success"] = "User password has been updated successfully.";
            relocate_url("users.php");
        } else {
            $_SESSION["error"] = "unable to update user password.";
        }
    }
}


    // update user opt and bvc end

    if (isset($_POST['update_user_password'])) 
    {
        $id = mysqli_real_escape_string($link, $_POST["id"]);
        $password = mysqli_real_escape_string($link, $_POST["password"]);
        $retyped_password = mysqli_real_escape_string($link, $_POST["retyped_password"]);
        $log = get_date();

        if (empty($password) || empty($retyped_password)) {
            $_SESSION["error"] = "Please all fields must be filled.";
        } 
        elseif (!minimum($password, 5)) {
            $_SESSION["error"] = "Password must be at least 5 characters.";
        }
        elseif (!compare($password, $retyped_password)) {
            $_SESSION["error"] = "Password fields do not match!";
        }
        else {
            $password_statement = "UPDATE `users` SET `password`='$password', `updated_at`='$log' WHERE `id`='$id'";
            $update_password = mysqli_query($link, $password_statement);

            if ($update_password)  {
                $_SESSION["success"] = "User password has been updated successfully.";
                relocate_url("users.php");
            } 
            else {
                $_SESSION["error"] = "unable to update user password.";
            }
        }
    }

    if (isset($_POST['update_user_photo'])) 
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
            $file_folder = "../uploads/users-avatar/" . $avatar;

            if (move_uploaded_file($temp_name, $file_folder)) {
                $avatar_statement = "UPDATE `users` SET `image`='$avatar', `updated_at`='$log' WHERE `id`='$id'";
                $upload_avatar = mysqli_query($link, $avatar_statement);

                if ($upload_avatar) {
                    $_SESSION["success"] = "User picture uploaded successfully.";
                    relocate_url("users.php");
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