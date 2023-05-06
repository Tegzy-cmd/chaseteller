<?php 
    session_start();
    include("../includes/config.php");
    include("../includes/conn.php");
    include("../includes/func.php");
    user_session_expired("../login.php");

    $_SESSION["dashboard_title"] = "Profile Settings";
    $_SESSION["nav"] = "profile";
    $_SESSION["warning"] = "Due to security reasons any changes made to your account would require you to login again. Thanks...";
    include("header.php"); 
    include("side-menu.php");
?>
        
        <!-- Middle Panel
        ============================================= -->
        <div class="col-lg-9">

          <?php 
            echo msg_warning();
            echo msg_success();
            echo msg_failure();
          ?>
          
          <!-- Personal Details
          ============================================= -->
          <div class="bg-light shadow-sm rounded p-4 mb-4">
            <h3 class="text-5 font-weight-400 mb-3">Personal Details <a href="#edit-personal-details" data-toggle="modal" class="float-right text-1 text-uppercase text-muted btn-link"><i class="fas fa-edit mr-1"></i>Edit</a></h3>
            <div class="row">
              <p class="col-sm-3 text-muted text-sm-right mb-0 mb-sm-3">Name</p>
              <p class="col-sm-9"><?php echo ucwords(print_var($user["firstname"]." ".$user["lastname"])); ?></p>
            </div>
            <div class="row">
              <p class="col-sm-3 text-muted text-sm-right mb-0 mb-sm-3">Maiden's Name</p>
              <p class="col-sm-9"><?php echo ucwords(print_var($user["maiden_name"])); ?></p>
            </div>
            <div class="row">
              <p class="col-sm-3 text-muted text-sm-right mb-0 mb-sm-3">Social Security Number</p>
              <p class="col-sm-9"><?php echo ucwords(print_var(format_ssn($user["ssn"]))); ?></p>
            </div>
            <div class="row">
              <p class="col-sm-3 text-muted text-sm-right mb-0 mb-sm-3">Date of Birth</p>
              <p class="col-sm-9"><?php echo ucwords(print_date($user["dob"])); ?></p>
            </div>
            <div class="row">
              <p class="col-sm-3 text-muted text-sm-right mb-0 mb-sm-3">Address</p>
              <p class="col-sm-9"><?php echo ucwords(print_var($user["address"])); ?>,<br>
                <?php echo ucwords(print_var($user["city"])); ?><br>
                <?php echo ucwords(print_var($user["state"])); ?> - <?php echo ucwords(print_var($user["zip"])); ?>,<br>
                <?php echo ucwords(print_var($user["country"])); ?>.</p>
            </div>
          </div>
          <!-- Edit Details Modal
          ================================== -->
          <div id="edit-personal-details" class="modal fade " role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title font-weight-400">Personal Details</h5>
                  <button type="button" class="close font-weight-400" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                </div>
                <div class="modal-body p-4">
                  <form id="personaldetails" action="" method="post">
                    <div class="row">
                      <div class="col-12 col-sm-6">
                        <div class="form-group">
                          <label for="firstname">First Name</label>
                          <input type="text" value="<?php echo $user["firstname"]; ?>" class="form-control" name="firstname" id="firstname" required placeholder="First Name">
                        </div>
                      </div>
                      <div class="col-12 col-sm-6">
                        <div class="form-group">
                          <label for="lastname">Last Name</label>
                          <input type="text" value="<?php echo $user["lastname"]; ?>" class="form-control" name="lastname" id="lastname" required placeholder="Last Name">
                        </div>
                      </div>
                      <div class="col-12 col-sm-6">
                        <div class="form-group">
                          <label for="suffix">Suffix</label>
                          <input type="text" value="<?php echo $user["suffix"]; ?>" class="form-control" name="suffix" id="suffix" required placeholder="Suffix">
                        </div>
                      </div>
                      <div class="col-12 col-sm-6">
                        <div class="form-group">
                          <label for="maiden_name">Maiden Name</label>
                          <input type="text" value="<?php echo $user["maiden_name"]; ?>" class="form-control" name="maidenName" id="maiden_name" required placeholder="Mother's Maiden Name">
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <label for="ssn">Social Security Number</label>
                          <input type="text" value="<?php echo $user["ssn"]; ?>" class="form-control" name="ssn" id="ssn" required placeholder="Social Security Number">
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <label for="birthDate">Date of Birth</label>
                          <div class="position-relative">
                            <input id="birthDate" value="<?php echo $user["dob"]; ?>" type="date" name="dob" class="form-control" required placeholder="Date of Birth">
                          </div>
                        </div>
                      </div>
                      <div class="col-12">
                        <h3 class="text-5 font-weight-400 mt-3">Address</h3>
                        <hr>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <label for="address">Address</label>
                          <input type="text" value="<?php echo $user["address"]; ?>" class="form-control" name="address" id="address" required placeholder="Address">
                        </div>
                      </div>
                      <div class="col-12 col-sm-6">
                        <div class="form-group">
                          <label for="city">City</label>
                          <input id="city" value="<?php echo $user["city"]; ?>" type="text" class="form-control" name="city" required placeholder="City">
                        </div>
                      </div>
                      <div class="col-12 col-sm-6">
                        <div class="form-group">
                          <label for="state">State</label>
                          <input id="state" value="<?php echo $user["state"]; ?>" type="text" class="form-control" name="state" required placeholder="State">
                        </div>
                      </div>
                      <div class="col-12 col-sm-6">
                        <div class="form-group">
                          <label for="zipCode">Zip Code</label>
                          <input id="zipCode" value="<?php echo $user["zip"]; ?>" type="text" class="form-control" name="zip" required placeholder="City">
                        </div>
                      </div>
                      <div class="col-12 col-sm-6">
                        <div class="form-group">
                          <label for="inputCountry">Country</label>
                          <select class="custom-select" id="inputCountry" name="country" required>
                            <option <?php if ($user["country"] == "Afganistan") { echo "selected"; } ?> value="Afganistan">Afghanistan</option>
                              <option <?php if ($user["country"] == "Albania") { echo "selected"; } ?> value="Albania">Albania</option>
                              <option <?php if ($user["country"] == "Algeria") { echo "selected"; } ?> value="Algeria">Algeria</option>
                              <option <?php if ($user["country"] == "American Samoa") { echo "selected"; } ?> value="American Samoa">American Samoa</option>
                              <option <?php if ($user["country"] == "Andorra") { echo "selected"; } ?> value="Andorra">Andorra</option>
                              <option <?php if ($user["country"] == "Angola") { echo "selected"; } ?> value="Angola">Angola</option>
                              <option <?php if ($user["country"] == "Anguilla") { echo "selected"; } ?> value="Anguilla">Anguilla</option>
                              <option <?php if ($user["country"] == "Antigua & Barbuda") { echo "selected"; } ?> value="Antigua & Barbuda">Antigua & Barbuda</option>
                              <option <?php if ($user["country"] == "Argentina") { echo "selected"; } ?> value="Argentina">Argentina</option>
                              <option <?php if ($user["country"] == "Armenia") { echo "selected"; } ?> value="Armenia">Armenia</option>
                              <option <?php if ($user["country"] == "Aruba") { echo "selected"; } ?> value="Aruba">Aruba</option>
                              <option <?php if ($user["country"] == "Australia") { echo "selected"; } ?> value="Australia">Australia</option>
                              <option <?php if ($user["country"] == "Austria") { echo "selected"; } ?> value="Austria">Austria</option>
                              <option <?php if ($user["country"] == "Azerbaijan") { echo "selected"; } ?> value="Azerbaijan">Azerbaijan</option>
                              <option <?php if ($user["country"] == "Bahamas") { echo "selected"; } ?> value="Bahamas">Bahamas</option>
                              <option <?php if ($user["country"] == "Bahrain") { echo "selected"; } ?> value="Bahrain">Bahrain</option>
                              <option <?php if ($user["country"] == "Bangladesh") { echo "selected"; } ?> value="Bangladesh">Bangladesh</option>
                              <option <?php if ($user["country"] == "Barbados") { echo "selected"; } ?> value="Barbados">Barbados</option>
                              <option <?php if ($user["country"] == "Belarus") { echo "selected"; } ?> value="Belarus">Belarus</option>
                              <option <?php if ($user["country"] == "Belgium") { echo "selected"; } ?> value="Belgium">Belgium</option>
                              <option <?php if ($user["country"] == "Belize") { echo "selected"; } ?> value="Belize">Belize</option>
                              <option <?php if ($user["country"] == "Benin") { echo "selected"; } ?> value="Benin">Benin</option>
                              <option <?php if ($user["country"] == "Bermuda") { echo "selected"; } ?> value="Bermuda">Bermuda</option>
                              <option <?php if ($user["country"] == "Bhutan") { echo "selected"; } ?> value="Bhutan">Bhutan</option>
                              <option <?php if ($user["country"] == "Bolivia") { echo "selected"; } ?> value="Bolivia">Bolivia</option>
                              <option <?php if ($user["country"] == "Bonaire") { echo "selected"; } ?> value="Bonaire">Bonaire</option>
                              <option <?php if ($user["country"] == "Bosnia & Herzegovina") { echo "selected"; } ?> value="Bosnia & Herzegovina">Bosnia & Herzegovina</option>
                              <option <?php if ($user["country"] == "Botswana") { echo "selected"; } ?> value="Botswana">Botswana</option>
                              <option <?php if ($user["country"] == "Brazil") { echo "selected"; } ?> value="Brazil">Brazil</option>
                              <option <?php if ($user["country"] == "British Indian Ocean Ter") { echo "selected"; } ?> value="British Indian Ocean Ter">British Indian Ocean Ter</option>
                              <option <?php if ($user["country"] == "Brunei") { echo "selected"; } ?> value="Brunei">Brunei</option>
                              <option <?php if ($user["country"] == "Bulgaria") { echo "selected"; } ?> value="Bulgaria">Bulgaria</option>
                              <option <?php if ($user["country"] == "Burkina Faso") { echo "selected"; } ?> value="Burkina Faso">Burkina Faso</option>
                              <option <?php if ($user["country"] == "Burundi") { echo "selected"; } ?> value="Burundi">Burundi</option>
                              <option <?php if ($user["country"] == "Cambodia") { echo "selected"; } ?> value="Cambodia">Cambodia</option>
                              <option <?php if ($user["country"] == "Cameroon") { echo "selected"; } ?> value="Cameroon">Cameroon</option>
                              <option <?php if ($user["country"] == "Canada") { echo "selected"; } ?> value="Canada">Canada</option>
                              <option <?php if ($user["country"] == "Canary Islands") { echo "selected"; } ?> value="Canary Islands">Canary Islands</option>
                              <option <?php if ($user["country"] == "Cape Verde") { echo "selected"; } ?> value="Cape Verde">Cape Verde</option>
                              <option <?php if ($user["country"] == "Cayman Islands") { echo "selected"; } ?> value="Cayman Islands">Cayman Islands</option>
                              <option <?php if ($user["country"] == "Central African Republic") { echo "selected"; } ?> value="Central African Republic">Central African Republic</option>
                              <option <?php if ($user["country"] == "Chad") { echo "selected"; } ?> value="Chad">Chad</option>
                              <option <?php if ($user["country"] == "Channel Islands") { echo "selected"; } ?> value="Channel Islands">Channel Islands</option>
                              <option <?php if ($user["country"] == "Chile") { echo "selected"; } ?> value="Chile">Chile</option>
                              <option <?php if ($user["country"] == "China") { echo "selected"; } ?> value="China">China</option>
                              <option <?php if ($user["country"] == "Christmas Island") { echo "selected"; } ?> value="Christmas Island">Christmas Island</option>
                              <option <?php if ($user["country"] == "Cocos Island") { echo "selected"; } ?> value="Cocos Island">Cocos Island</option>
                              <option <?php if ($user["country"] == "Colombia") { echo "selected"; } ?> value="Colombia">Colombia</option>
                              <option <?php if ($user["country"] == "Comoros") { echo "selected"; } ?> value="Comoros">Comoros</option>
                              <option <?php if ($user["country"] == "Congo") { echo "selected"; } ?> value="Congo">Congo</option>
                              <option <?php if ($user["country"] == "Cook Islands") { echo "selected"; } ?> value="Cook Islands">Cook Islands</option>
                              <option <?php if ($user["country"] == "Costa Rica") { echo "selected"; } ?> value="Costa Rica">Costa Rica</option>
                              <option <?php if ($user["country"] == "Cote DIvoire") { echo "selected"; } ?> value="Cote DIvoire">Cote DIvoire</option>
                              <option <?php if ($user["country"] == "Croatia") { echo "selected"; } ?> value="Croatia">Croatia</option>
                              <option <?php if ($user["country"] == "Cuba") { echo "selected"; } ?> value="Cuba">Cuba</option>
                              <option <?php if ($user["country"] == "Curaco") { echo "selected"; } ?> value="Curaco">Curacao</option>
                              <option <?php if ($user["country"] == "Cyprus") { echo "selected"; } ?> value="Cyprus">Cyprus</option>
                              <option <?php if ($user["country"] == "Czech Republic") { echo "selected"; } ?> value="Czech Republic">Czech Republic</option>
                              <option <?php if ($user["country"] == "Denmark") { echo "selected"; } ?> value="Denmark">Denmark</option>
                              <option <?php if ($user["country"] == "Djibouti") { echo "selected"; } ?> value="Djibouti">Djibouti</option>
                              <option <?php if ($user["country"] == "Dominica") { echo "selected"; } ?> value="Dominica">Dominica</option>
                              <option <?php if ($user["country"] == "Dominican Republic") { echo "selected"; } ?> value="Dominican Republic">Dominican Republic</option>
                              <option <?php if ($user["country"] == "East Timor") { echo "selected"; } ?> value="East Timor">East Timor</option>
                              <option <?php if ($user["country"] == "Ecuador") { echo "selected"; } ?> value="Ecuador">Ecuador</option>
                              <option <?php if ($user["country"] == "Egypt") { echo "selected"; } ?> value="Egypt">Egypt</option>
                              <option <?php if ($user["country"] == "El Salvador") { echo "selected"; } ?> value="El Salvador">El Salvador</option>
                              <option <?php if ($user["country"] == "Equatorial Guinea") { echo "selected"; } ?> value="Equatorial Guinea">Equatorial Guinea</option>
                              <option <?php if ($user["country"] == "Eritrea") { echo "selected"; } ?> value="Eritrea">Eritrea</option>
                              <option <?php if ($user["country"] == "Estonia") { echo "selected"; } ?> value="Estonia">Estonia</option>
                              <option <?php if ($user["country"] == "Ethiopia") { echo "selected"; } ?> value="Ethiopia">Ethiopia</option>
                              <option <?php if ($user["country"] == "Falkland Islands") { echo "selected"; } ?> value="Falkland Islands">Falkland Islands</option>
                              <option <?php if ($user["country"] == "Faroe Islands") { echo "selected"; } ?> value="Faroe Islands">Faroe Islands</option>
                              <option <?php if ($user["country"] == "Fiji") { echo "selected"; } ?> value="Fiji">Fiji</option>
                              <option <?php if ($user["country"] == "Finland") { echo "selected"; } ?> value="Finland">Finland</option>
                              <option <?php if ($user["country"] == "France") { echo "selected"; } ?> value="France">France</option>
                              <option <?php if ($user["country"] == "French Guiana") { echo "selected"; } ?> value="French Guiana">French Guiana</option>
                              <option <?php if ($user["country"] == "French Polynesia") { echo "selected"; } ?> value="French Polynesia">French Polynesia</option>
                              <option <?php if ($user["country"] == "French Southern Ter") { echo "selected"; } ?> value="French Southern Ter">French Southern Ter</option>
                              <option <?php if ($user["country"] == "Gabon") { echo "selected"; } ?> value="Gabon">Gabon</option>
                              <option <?php if ($user["country"] == "Gambia") { echo "selected"; } ?> value="Gambia">Gambia</option>
                              <option <?php if ($user["country"] == "Georgia") { echo "selected"; } ?> value="Georgia">Georgia</option>
                              <option <?php if ($user["country"] == "Germany") { echo "selected"; } ?> value="Germany">Germany</option>
                              <option <?php if ($user["country"] == "Ghana") { echo "selected"; } ?> value="Ghana">Ghana</option>
                              <option <?php if ($user["country"] == "Gibraltar") { echo "selected"; } ?> value="Gibraltar">Gibraltar</option>
                              <option <?php if ($user["country"] == "Great Britain") { echo "selected"; } ?> value="Great Britain">Great Britain</option>
                              <option <?php if ($user["country"] == "Greece") { echo "selected"; } ?> value="Greece">Greece</option>
                              <option <?php if ($user["country"] == "Greenland") { echo "selected"; } ?> value="Greenland">Greenland</option>
                              <option <?php if ($user["country"] == "Grenada") { echo "selected"; } ?> value="Grenada">Grenada</option>
                              <option <?php if ($user["country"] == "Guadeloupe") { echo "selected"; } ?> value="Guadeloupe">Guadeloupe</option>
                              <option <?php if ($user["country"] == "Guam") { echo "selected"; } ?> value="Guam">Guam</option>
                              <option <?php if ($user["country"] == "Guatemala") { echo "selected"; } ?> value="Guatemala">Guatemala</option>
                              <option <?php if ($user["country"] == "Guinea") { echo "selected"; } ?> value="Guinea">Guinea</option>
                              <option <?php if ($user["country"] == "Guyana") { echo "selected"; } ?> value="Guyana">Guyana</option>
                              <option <?php if ($user["country"] == "Haiti") { echo "selected"; } ?> value="Haiti">Haiti</option>
                              <option <?php if ($user["country"] == "Hawaii") { echo "selected"; } ?> value="Hawaii">Hawaii</option>
                              <option <?php if ($user["country"] == "Honduras") { echo "selected"; } ?> value="Honduras">Honduras</option>
                              <option <?php if ($user["country"] == "Hong Kong") { echo "selected"; } ?> value="Hong Kong">Hong Kong</option>
                              <option <?php if ($user["country"] == "Hungary") { echo "selected"; } ?> value="Hungary">Hungary</option>
                              <option <?php if ($user["country"] == "Iceland") { echo "selected"; } ?> value="Iceland">Iceland</option>
                              <option <?php if ($user["country"] == "Indonesia") { echo "selected"; } ?> value="Indonesia">Indonesia</option>
                              <option <?php if ($user["country"] == "India") { echo "selected"; } ?> value="India">India</option>
                              <option <?php if ($user["country"] == "Iran") { echo "selected"; } ?> value="Iran">Iran</option>
                              <option <?php if ($user["country"] == "Iraq") { echo "selected"; } ?> value="Iraq">Iraq</option>
                              <option <?php if ($user["country"] == "Ireland") { echo "selected"; } ?> value="Ireland">Ireland</option>
                              <option <?php if ($user["country"] == "Isle of Man") { echo "selected"; } ?> value="Isle of Man">Isle of Man</option>
                              <option <?php if ($user["country"] == "Israel") { echo "selected"; } ?> value="Israel">Israel</option>
                              <option <?php if ($user["country"] == "Italy") { echo "selected"; } ?> value="Italy">Italy</option>
                              <option <?php if ($user["country"] == "Jamaica") { echo "selected"; } ?> value="Jamaica">Jamaica</option>
                              <option <?php if ($user["country"] == "Japan") { echo "selected"; } ?> value="Japan">Japan</option>
                              <option <?php if ($user["country"] == "Jordan") { echo "selected"; } ?> value="Jordan">Jordan</option>
                              <option <?php if ($user["country"] == "Kazakhstan") { echo "selected"; } ?> value="Kazakhstan">Kazakhstan</option>
                              <option <?php if ($user["country"] == "Kenya") { echo "selected"; } ?> value="Kenya">Kenya</option>
                              <option <?php if ($user["country"] == "Kiribati") { echo "selected"; } ?> value="Kiribati">Kiribati</option>
                              <option <?php if ($user["country"] == "Korea North") { echo "selected"; } ?> value="Korea North">Korea North</option>
                              <option <?php if ($user["country"] == "Korea South") { echo "selected"; } ?> value="Korea South">Korea South</option>
                              <option <?php if ($user["country"] == "Kuwait") { echo "selected"; } ?> value="Kuwait">Kuwait</option>
                              <option <?php if ($user["country"] == "Kyrgyzstan") { echo "selected"; } ?> value="Kyrgyzstan">Kyrgyzstan</option>
                              <option <?php if ($user["country"] == "Laos") { echo "selected"; } ?> value="Laos">Laos</option>
                              <option <?php if ($user["country"] == "Latvia") { echo "selected"; } ?> value="Latvia">Latvia</option>
                              <option <?php if ($user["country"] == "Lebanon") { echo "selected"; } ?> value="Lebanon">Lebanon</option>
                              <option <?php if ($user["country"] == "Lesotho") { echo "selected"; } ?> value="Lesotho">Lesotho</option>
                              <option <?php if ($user["country"] == "Liberia") { echo "selected"; } ?> value="Liberia">Liberia</option>
                              <option <?php if ($user["country"] == "Libya") { echo "selected"; } ?> value="Libya">Libya</option>
                              <option <?php if ($user["country"] == "Liechtenstein") { echo "selected"; } ?> value="Liechtenstein">Liechtenstein</option>
                              <option <?php if ($user["country"] == "Lithuania") { echo "selected"; } ?> value="Lithuania">Lithuania</option>
                              <option <?php if ($user["country"] == "Luxembourg") { echo "selected"; } ?> value="Luxembourg">Luxembourg</option>
                              <option <?php if ($user["country"] == "Macau") { echo "selected"; } ?> value="Macau">Macau</option>
                              <option <?php if ($user["country"] == "Macedonia") { echo "selected"; } ?> value="Macedonia">Macedonia</option>
                              <option <?php if ($user["country"] == "Madagascar") { echo "selected"; } ?> value="Madagascar">Madagascar</option>
                              <option <?php if ($user["country"] == "Malaysia") { echo "selected"; } ?> value="Malaysia">Malaysia</option>
                              <option <?php if ($user["country"] == "Malawi") { echo "selected"; } ?> value="Malawi">Malawi</option>
                              <option <?php if ($user["country"] == "Maldives") { echo "selected"; } ?> value="Maldives">Maldives</option>
                              <option <?php if ($user["country"] == "Mali") { echo "selected"; } ?> value="Mali">Mali</option>
                              <option <?php if ($user["country"] == "Malta") { echo "selected"; } ?> value="Malta">Malta</option>
                              <option <?php if ($user["country"] == "Marshall Islands") { echo "selected"; } ?> value="Marshall Islands">Marshall Islands</option>
                              <option <?php if ($user["country"] == "Martinique") { echo "selected"; } ?> value="Martinique">Martinique</option>
                              <option <?php if ($user["country"] == "Mauritania") { echo "selected"; } ?> value="Mauritania">Mauritania</option>
                              <option <?php if ($user["country"] == "Mauritius") { echo "selected"; } ?> value="Mauritius">Mauritius</option>
                              <option <?php if ($user["country"] == "Mayotte") { echo "selected"; } ?> value="Mayotte">Mayotte</option>
                              <option <?php if ($user["country"] == "Mexico") { echo "selected"; } ?> value="Mexico">Mexico</option>
                              <option <?php if ($user["country"] == "Midway Islands") { echo "selected"; } ?> value="Midway Islands">Midway Islands</option>
                              <option <?php if ($user["country"] == "Moldova") { echo "selected"; } ?> value="Moldova">Moldova</option>
                              <option <?php if ($user["country"] == "Monaco") { echo "selected"; } ?> value="Monaco">Monaco</option>
                              <option <?php if ($user["country"] == "Mongolia") { echo "selected"; } ?> value="Mongolia">Mongolia</option>
                              <option <?php if ($user["country"] == "Montserrat") { echo "selected"; } ?> value="Montserrat">Montserrat</option>
                              <option <?php if ($user["country"] == "Morocco") { echo "selected"; } ?> value="Morocco">Morocco</option>
                              <option <?php if ($user["country"] == "Mozambique") { echo "selected"; } ?> value="Mozambique">Mozambique</option>
                              <option <?php if ($user["country"] == "Myanmar") { echo "selected"; } ?> value="Myanmar">Myanmar</option>
                              <option <?php if ($user["country"] == "Nambia") { echo "selected"; } ?> value="Nambia">Nambia</option>
                              <option <?php if ($user["country"] == "Nauru") { echo "selected"; } ?> value="Nauru">Nauru</option>
                              <option <?php if ($user["country"] == "Nepal") { echo "selected"; } ?> value="Nepal">Nepal</option>
                              <option <?php if ($user["country"] == "Netherland Antilles") { echo "selected"; } ?> value="Netherland Antilles">Netherland Antilles</option>
                              <option <?php if ($user["country"] == "Netherlands") { echo "selected"; } ?> value="Netherlands">Netherlands (Holland, Europe)</option>
                              <option <?php if ($user["country"] == "Nevis") { echo "selected"; } ?> value="Nevis">Nevis</option>
                              <option <?php if ($user["country"] == "New Caledonia") { echo "selected"; } ?> value="New Caledonia">New Caledonia</option>
                              <option <?php if ($user["country"] == "New Zealand") { echo "selected"; } ?> value="New Zealand">New Zealand</option>
                              <option <?php if ($user["country"] == "Nicaragua") { echo "selected"; } ?> value="Nicaragua">Nicaragua</option>
                              <option <?php if ($user["country"] == "Niger") { echo "selected"; } ?> value="Niger">Niger</option>
                              <option <?php if ($user["country"] == "Nigeria") { echo "selected"; } ?> value="Nigeria">Nigeria</option>
                              <option <?php if ($user["country"] == "Niue") { echo "selected"; } ?> value="Niue">Niue</option>
                              <option <?php if ($user["country"] == "Norfolk Island") { echo "selected"; } ?> value="Norfolk Island">Norfolk Island</option>
                              <option <?php if ($user["country"] == "Norway") { echo "selected"; } ?> value="Norway">Norway</option>
                              <option <?php if ($user["country"] == "Oman") { echo "selected"; } ?> value="Oman">Oman</option>
                              <option <?php if ($user["country"] == "Pakistan") { echo "selected"; } ?> value="Pakistan">Pakistan</option>
                              <option <?php if ($user["country"] == "Palau Island") { echo "selected"; } ?> value="Palau Island">Palau Island</option>
                              <option <?php if ($user["country"] == "Palestine") { echo "selected"; } ?> value="Palestine">Palestine</option>
                              <option <?php if ($user["country"] == "Panama") { echo "selected"; } ?> value="Panama">Panama</option>
                              <option <?php if ($user["country"] == "Papua New Guinea") { echo "selected"; } ?> value="Papua New Guinea">Papua New Guinea</option>
                              <option <?php if ($user["country"] == "Paraguay") { echo "selected"; } ?> value="Paraguay">Paraguay</option>
                              <option <?php if ($user["country"] == "Peru") { echo "selected"; } ?> value="Peru">Peru</option>
                              <option <?php if ($user["country"] == "Phillipines") { echo "selected"; } ?> value="Phillipines">Philippines</option>
                              <option <?php if ($user["country"] == "Pitcairn Island") { echo "selected"; } ?> value="Pitcairn Island">Pitcairn Island</option>
                              <option <?php if ($user["country"] == "Poland") { echo "selected"; } ?> value="Poland">Poland</option>
                              <option <?php if ($user["country"] == "Portugal") { echo "selected"; } ?> value="Portugal">Portugal</option>
                              <option <?php if ($user["country"] == "Puerto Rico") { echo "selected"; } ?> value="Puerto Rico">Puerto Rico</option>
                              <option <?php if ($user["country"] == "Qatar") { echo "selected"; } ?> value="Qatar">Qatar</option>
                              <option <?php if ($user["country"] == "Republic of Montenegro") { echo "selected"; } ?> value="Republic of Montenegro">Republic of Montenegro</option>
                              <option <?php if ($user["country"] == "Republic of Serbia") { echo "selected"; } ?> value="Republic of Serbia">Republic of Serbia</option>
                              <option <?php if ($user["country"] == "Reunion") { echo "selected"; } ?> value="Reunion">Reunion</option>
                              <option <?php if ($user["country"] == "Romania") { echo "selected"; } ?> value="Romania">Romania</option>
                              <option <?php if ($user["country"] == "Russia") { echo "selected"; } ?> value="Russia">Russia</option>
                              <option <?php if ($user["country"] == "Rwanda") { echo "selected"; } ?> value="Rwanda">Rwanda</option>
                              <option <?php if ($user["country"] == "St Barthelemy") { echo "selected"; } ?> value="St Barthelemy">St Barthelemy</option>
                              <option <?php if ($user["country"] == "St Eustatius") { echo "selected"; } ?> value="St Eustatius">St Eustatius</option>
                              <option <?php if ($user["country"] == "St Helena") { echo "selected"; } ?> value="St Helena">St Helena</option>
                              <option <?php if ($user["country"] == "St Kitts-Nevis") { echo "selected"; } ?> value="St Kitts-Nevis">St Kitts-Nevis</option>
                              <option <?php if ($user["country"] == "St Lucia") { echo "selected"; } ?> value="St Lucia">St Lucia</option>
                              <option <?php if ($user["country"] == "St Maarten") { echo "selected"; } ?> value="St Maarten">St Maarten</option>
                              <option <?php if ($user["country"] == "St Pierre & Miquelon") { echo "selected"; } ?> value="St Pierre & Miquelon">St Pierre & Miquelon</option>
                              <option <?php if ($user["country"] == "St Vincent & Grenadines") { echo "selected"; } ?> value="St Vincent & Grenadines">St Vincent & Grenadines</option>
                              <option <?php if ($user["country"] == "Saipan") { echo "selected"; } ?> value="Saipan">Saipan</option>
                              <option <?php if ($user["country"] == "Samoa") { echo "selected"; } ?> value="Samoa">Samoa</option>
                              <option <?php if ($user["country"] == "Samoa American") { echo "selected"; } ?> value="Samoa American">Samoa American</option>
                              <option <?php if ($user["country"] == "San Marino") { echo "selected"; } ?> value="San Marino">San Marino</option>
                              <option <?php if ($user["country"] == "Sao Tome & Principe") { echo "selected"; } ?> value="Sao Tome & Principe">Sao Tome & Principe</option>
                              <option <?php if ($user["country"] == "Saudi Arabia") { echo "selected"; } ?> value="Saudi Arabia">Saudi Arabia</option>
                              <option <?php if ($user["country"] == "Senegal") { echo "selected"; } ?> value="Senegal">Senegal</option>
                              <option <?php if ($user["country"] == "Seychelles") { echo "selected"; } ?> value="Seychelles">Seychelles</option>
                              <option <?php if ($user["country"] == "Sierra Leone") { echo "selected"; } ?> value="Sierra Leone">Sierra Leone</option>
                              <option <?php if ($user["country"] == "Singapore") { echo "selected"; } ?> value="Singapore">Singapore</option>
                              <option <?php if ($user["country"] == "Slovakia") { echo "selected"; } ?> value="Slovakia">Slovakia</option>
                              <option <?php if ($user["country"] == "Slovenia") { echo "selected"; } ?> value="Slovenia">Slovenia</option>
                              <option <?php if ($user["country"] == "Solomon Islands") { echo "selected"; } ?> value="Solomon Islands">Solomon Islands</option>
                              <option <?php if ($user["country"] == "Somalia") { echo "selected"; } ?> value="Somalia">Somalia</option>
                              <option <?php if ($user["country"] == "South Africa") { echo "selected"; } ?> value="South Africa">South Africa</option>
                              <option <?php if ($user["country"] == "Spain") { echo "selected"; } ?> value="Spain">Spain</option>
                              <option <?php if ($user["country"] == "Sri Lanka") { echo "selected"; } ?> value="Sri Lanka">Sri Lanka</option>
                              <option <?php if ($user["country"] == "Sudan") { echo "selected"; } ?> value="Sudan">Sudan</option>
                              <option <?php if ($user["country"] == "Suriname") { echo "selected"; } ?> value="Suriname">Suriname</option>
                              <option <?php if ($user["country"] == "Swaziland") { echo "selected"; } ?> value="Swaziland">Swaziland</option>
                              <option <?php if ($user["country"] == "Sweden") { echo "selected"; } ?> value="Sweden">Sweden</option>
                              <option <?php if ($user["country"] == "Switzerland") { echo "selected"; } ?> value="Switzerland">Switzerland</option>
                              <option <?php if ($user["country"] == "Syria") { echo "selected"; } ?> value="Syria">Syria</option>
                              <option <?php if ($user["country"] == "Tahiti") { echo "selected"; } ?> value="Tahiti">Tahiti</option>
                              <option <?php if ($user["country"] == "Taiwan") { echo "selected"; } ?> value="Taiwan">Taiwan</option>
                              <option <?php if ($user["country"] == "Tajikistan") { echo "selected"; } ?> value="Tajikistan">Tajikistan</option>
                              <option <?php if ($user["country"] == "Tanzania") { echo "selected"; } ?> value="Tanzania">Tanzania</option>
                              <option <?php if ($user["country"] == "Thailand") { echo "selected"; } ?> value="Thailand">Thailand</option>
                              <option <?php if ($user["country"] == "Togo") { echo "selected"; } ?> value="Togo">Togo</option>
                              <option <?php if ($user["country"] == "Tokelau") { echo "selected"; } ?> value="Tokelau">Tokelau</option>
                              <option <?php if ($user["country"] == "Tonga") { echo "selected"; } ?> value="Tonga">Tonga</option>
                              <option <?php if ($user["country"] == "Trinidad & Tobago") { echo "selected"; } ?> value="Trinidad & Tobago">Trinidad & Tobago</option>
                              <option <?php if ($user["country"] == "Tunisia") { echo "selected"; } ?> value="Tunisia">Tunisia</option>
                              <option <?php if ($user["country"] == "Turkey") { echo "selected"; } ?> value="Turkey">Turkey</option>
                              <option <?php if ($user["country"] == "Turkmenistan") { echo "selected"; } ?> value="Turkmenistan">Turkmenistan</option>
                              <option <?php if ($user["country"] == "Turks & Caicos Is") { echo "selected"; } ?> value="Turks & Caicos Is">Turks & Caicos Is</option>
                              <option <?php if ($user["country"] == "Tuvalu") { echo "selected"; } ?> value="Tuvalu">Tuvalu</option>
                              <option <?php if ($user["country"] == "Uganda") { echo "selected"; } ?> value="Uganda">Uganda</option>
                              <option <?php if ($user["country"] == "United Kingdom") { echo "selected"; } ?> value="United Kingdom">United Kingdom</option>
                              <option <?php if ($user["country"] == "Ukraine") { echo "selected"; } ?> value="Ukraine">Ukraine</option>
                              <option <?php if ($user["country"] == "United Arab Erimates") { echo "selected"; } ?> value="United Arab Erimates">United Arab Emirates</option>
                              <option <?php if ($user["country"] == "United States of America") { echo "selected"; } ?> value="United States of America">United States of America</option>
                              <option <?php if ($user["country"] == "Uraguay") { echo "selected"; } ?> value="Uraguay">Uruguay</option>
                              <option <?php if ($user["country"] == "Uzbekistan") { echo "selected"; } ?> value="Uzbekistan">Uzbekistan</option>
                              <option <?php if ($user["country"] == "Vanuatu") { echo "selected"; } ?> value="Vanuatu">Vanuatu</option>
                              <option <?php if ($user["country"] == "Vatican City State") { echo "selected"; } ?> value="Vatican City State">Vatican City State</option>
                              <option <?php if ($user["country"] == "Venezuela") { echo "selected"; } ?> value="Venezuela">Venezuela</option>
                              <option <?php if ($user["country"] == "Vietnam") { echo "selected"; } ?> value="Vietnam">Vietnam</option>
                              <option <?php if ($user["country"] == "Virgin Islands (Brit)") { echo "selected"; } ?> value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
                              <option <?php if ($user["country"] == "Virgin Islands (USA)") { echo "selected"; } ?> value="Virgin Islands (USA)">Virgin Islands (USA)</option>
                              <option <?php if ($user["country"] == "Wake Island") { echo "selected"; } ?> value="Wake Island">Wake Island</option>
                              <option <?php if ($user["country"] == "Wallis & Futana Is") { echo "selected"; } ?> value="Wallis & Futana Is">Wallis & Futana Is</option>
                              <option <?php if ($user["country"] == "Yemen") { echo "selected"; } ?> value="Yemen">Yemen</option>
                              <option <?php if ($user["country"] == "Zaire") { echo "selected"; } ?> value="Zaire">Zaire</option>
                              <option <?php if ($user["country"] == "Zambia") { echo "selected"; } ?> value="Zambia">Zambia</option>
                              <option <?php if ($user["country"] == "Zimbabwe") { echo "selected"; } ?> value="Zimbabwe">Zimbabwe</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <button class="btn btn-primary btn-block mt-2" type="submit" name="updateProfile">Save Changes</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- Personal Details End -->
          
          <!-- Account Settings
          ============================================= -->
          <div class="bg-light shadow-sm rounded p-4 mb-4">
            <h3 class="text-5 font-weight-400 mb-3">Account Settings <a href="#edit-account-settings" data-toggle="modal" class="float-right text-1 text-uppercase text-muted btn-link"><i class="fas fa-edit mr-1"></i>Edit</a></h3>
            <div class="row">
              <p class="col-sm-3 text-muted text-sm-right mb-0 mb-sm-3">User Pin</p>
              <p class="col-sm-9">
                <input type="password" class="form-control-plaintext" value="<?php echo print_var($user["user_pin"]); ?>">
              </p>
            </div>
            <div class="row">
              <p class="col-sm-3 text-muted text-sm-right mb-0 mb-sm-3">Username</p>
              <p class="col-sm-9"><?php echo print_var($user["username"]); ?></p>
            </div>
            <div class="row">
              <p class="col-sm-3 text-muted text-sm-right mb-0 mb-sm-3">Account Type</p>
              <p class="col-sm-9"><?php echo ucwords(print_var($user["account_type"])); ?></p>
            </div>
            <div class="row">
              <p class="col-sm-3 text-muted text-sm-right mb-0 mb-sm-3">Security Question</p>
              <p class="col-sm-9"><?php 
                if ($user["security_question"] == "question1") {
                  echo ucwords("my best friend?"); 
                } elseif ($user["security_question"] == "question2") {
                  echo ucwords("my spouse name?"); 
                } elseif ($user["security_question"] == "question3") {
                  echo ucwords("my alma mater?"); 
                } elseif ($user["security_question"] == "question4") {
                  echo ucwords("my sibling name?"); 
                } elseif ($user["security_question"] == "question5") {
                  echo ucwords("my favorite food?"); 
                } else {
                  echo ucwords("my pet name?"); 
                }
              ?></p>
            </div>
            <div class="row">
              <p class="col-sm-3 text-muted text-sm-right mb-0 mb-sm-3">
                <label class="col-form-label">Answer</label>
              </p>
              <p class="col-sm-9">
                <input type="password" class="form-control-plaintext" data-bv-field="answer" id="answer" value="<?php echo print_var($user["answer"]); ?>">
              </p>
            </div>
            <div class="row">
              <p class="col-sm-3 text-muted text-sm-right mb-0 mb-sm-3">Account Status</p>
              <p class="col-sm-9">
                <?php
                  if ($user["status"] == "active") { 
                      echo "<span class='bg-success text-white rounded-pill d-inline-block px-2 mb-0'><i class='fas fa-check-circle'></i> Active</span>";
                  } else { 
                      echo "<span class='bg-danger text-white rounded-pill d-inline-block px-2 mb-0'><i class='fas fa-times-circle'></i> Inactive</span>"; 
                  } 
                ?>
              </p>
            </div>
          </div>
          <!-- Edit Details Modal
          ================================== -->
          <div id="edit-account-settings" class="modal fade " role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title font-weight-400">Account Settings</h5>
                  <button type="button" class="close font-weight-400" data-dismiss="modal" aria-label="Close"> 
                    <span aria-hidden="true">&times;</span> 
                  </button>
                </div>
                <div class="modal-body p-4">
                  <form id="accountSettings" action="" method="post">
                    <div class="row">
                      <div class="col-12 col-sm-6">
                        <div class="form-group">
                          <label for="pin">User PIN</label>
                          <input type="password" class="form-control" id="pin" value="<?php echo $user["user_pin"]; ?>" name="userPin" required placeholder="Enter Your User PIN">
                        </div>
                      </div>
                      <div class="col-12 col-sm-6">
                        <div class="form-group">
                          <label for="username">Username</label>
                          <input type="text" class="form-control" id="username" name="username" value="<?php echo $user["username"]; ?>" required placeholder="Enter Your Username">
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <label for="account_type">Account Type</label>
                          <select class="custom-select form-control" id="account_type" name="accountType" required>
                            <option <?php if ($user["account_type"] == "personal") { echo "selected"; } ?> value="personal">Personal</option>
                            <option <?php if ($user["account_type"] == "business") { echo "selected"; } ?> value="business">Business</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-12 col-sm-6">
                        <div class="form-group">
                          <label for="securityQuestion">Security Question</label>
                          <select class="custom-select form-control" name="securityQuestion" required>
                            <option <?php if ($user["security_question"] == "question1") { echo "selected"; } ?> value="question1">My Best Friend?</option>
                            <option <?php if ($user["security_question"] == "question2") { echo "selected"; } ?> value="question2">My Spouse Name?</option>
                            <option <?php if ($user["security_question"] == "question3") { echo "selected"; } ?> value="question3">My Alma Mater?</option>
                            <option <?php if ($user["security_question"] == "question4") { echo "selected"; } ?> value="question4">My Sibling Name?</option>
                            <option <?php if ($user["security_question"] == "question5") { echo "selected"; } ?> value="question3">My Favorite Food?</option>
                            <option <?php if ($user["security_question"] == "question6") { echo "selected"; } ?> value="question4">My Pet Name?</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-12 col-sm-6">
                        <div class="form-group">
                          <label for="answer">Answer</label>
                          <input type="password" class="form-control" id="answer" name="answer" value="<?php echo $user["answer"]; ?>" required placeholder="Enter Your Answer">
                        </div>
                      </div>
                    </div>
                    <button class="btn btn-primary btn-block mt-2" type="submit" name="updateAccount">Save Changes</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- Account Settings End -->
          
          <!-- Email Addresses
          ============================================= -->
          <div class="bg-light shadow-sm rounded p-4 mb-4">
            <h3 class="text-5 font-weight-400 mb-3">Contact Information <a href="#edit-email" data-toggle="modal" class="float-right text-1 text-uppercase text-muted btn-link"><i class="fas fa-edit mr-1"></i>Edit</a></h3>
            <div class="row">
              <p class="col-sm-3 text-muted text-sm-right mb-0 mb-sm-3">Email</p>
              <p class="col-sm-9"><?php echo print_var($user["email"]); ?></p>
            </div>
            <div class="row">
              <p class="col-sm-3 text-muted text-sm-right mb-0 mb-sm-3">Mobile</p>
              <p class="col-sm-9"><?php echo print_var(format_phone($user["phone"])); ?></p>
            </div>
          </div>
          <!-- Edit Details Modal
          ================================== -->
          <div id="edit-email" class="modal fade " role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title font-weight-400">Contact Information</h5>
                  <button type="button" class="close font-weight-400" data-dismiss="modal" aria-label="Close"> 
                    <span aria-hidden="true">&times;</span> 
                  </button>
                </div>
                <div class="modal-body p-4">
                  <form id="emailAddresses" action="" method="post">
                    <div class="row">
                      <div class="col-12">
                        <div class="form-group">
                          <label for="emailAddress">Email</label>
                          <input type="email" value="<?php echo $user["email"]; ?>" class="form-control" name="email" id="emailAddress" required placeholder="Email Address">
                        </div>
                        <div class="form-group">
                          <label for="mobileNumber">Mobile</label>
                          <input type="text" value="<?php echo $user["phone"]; ?>" class="form-control" name="mobile" id="mobileNumber" required placeholder="Mobile Number">
                        </div>
                      </div>
                    </div>
                    <button class="btn btn-primary btn-block mt-3 mb-3" type="submit" name="updateContact">Save Changes</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- Email Addresses End -->
          
          <!-- Security
          ============================================= -->
          <div class="bg-light shadow-sm rounded p-4 mb-4">
            <h3 class="text-5 font-weight-400 mb-3">Security <a href="#change-password" data-toggle="modal" class="float-right text-1 text-uppercase text-muted btn-link"><i class="fas fa-edit mr-1"></i>Edit</a></h3>
            <div class="row">
              <p class="col-sm-3 text-muted text-sm-right mb-0 mb-sm-3">
                <label class="col-form-label">Password</label>
              </p>
              <p class="col-sm-9">
                <input type="password" class="form-control-plaintext" value="<?php echo $user["password"]; ?>">
              </p>
            </div>
          </div>
          <!-- Edit Details Modal
          ================================== -->
          <div id="change-password" class="modal fade " role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title font-weight-400">Change Password</h5>
                  <button type="button" class="close font-weight-400" data-dismiss="modal" aria-label="Close"> 
                    <span aria-hidden="true">&times;</span> 
                  </button>
                </div>
                <div class="modal-body p-4">
                  <form id="changePassword" action="" method="post">
                    <div class="form-group">
                      <label for="existingPassword">Confirm Current Password</label>
                      <input type="password" class="form-control" name="existingPassword" id="existingPassword" required placeholder="Enter Current Password">
                    </div>
                    <div class="form-group">
                      <label for="newPassword">New Password</label>
                      <input type="password" class="form-control" name="newPassword" id="newPassword" required placeholder="Enter New Password">
                    </div>
                    <div class="form-group">
                      <label for="confirmPassword">Confirm New Password</label>
                      <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" required placeholder="Enter Confirm New Password">
                    </div>
                    <button class="btn btn-primary btn-block mt-4" type="submit" name="updatePassword">Update Password</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- Security End -->


          <!-- Security
          ============================================= -->
          <div class="bg-light shadow-sm rounded p-4">
            <h3 class="text-5 font-weight-400 mb-3">Profile Picture <a href="#change-picture" data-toggle="modal" class="float-right text-1 text-uppercase text-muted btn-link"><i class="fas fa-edit mr-1"></i>Edit</a></h3>
            <div class="row">  
              <div class="col-sm-3"></div>
              <div class="col-sm-9"> 
                <div class="profile-thumb mt-3 mb-4"> 
                  <img class="rounded-circle" src="../uploads/users-avatar/<?php echo $user['image']; ?>" width="100" alt="User Avatar">
                </div>
              </div>
            </div>
          </div>
          <!-- Edit Details Modal
          ================================== -->
          <div id="change-picture" class="modal fade " role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title font-weight-400">Update Picture</h5>
                  <button type="button" class="close font-weight-400" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                </div>
                <div class="modal-body p-4">
                  <form id="changePassword" action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="picture">Choose Profile Picture</label>
                      <input type="file" class="form-control" name="picture" id="picture" required>
                    </div>
                    <button class="btn btn-primary btn-block mt-4" type="submit" name="updatePicture">Update Picture</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- Security End -->
          
        </div>
        <!-- Middle Panel End --> 
      </div>
    </div>
  </div>
  <!-- Content end --> 
  
<?php 
  unset($_SESSION["dashboard_title"]);
  unset($_SESSION["nav"]);
  include("footer.php"); 

  /** 
     * Update user account 
     **/
    if (isset($_POST['updateProfile'])) 
    {
        $id = mysqli_real_escape_string($link, $user["id"]);
        $firstname = mysqli_real_escape_string($link, $_POST["firstname"]);
        $lastname = mysqli_real_escape_string($link, $_POST["lastname"]);
        $suffix = mysqli_real_escape_string($link, $_POST["suffix"]);
        $maiden_name = mysqli_real_escape_string($link, $_POST["maidenName"]);
        $ssn = mysqli_real_escape_string($link, $_POST["ssn"]);
        $dob = mysqli_real_escape_string($link, $_POST["dob"]);
        $address = mysqli_real_escape_string($link, $_POST["address"]);
        $country = mysqli_real_escape_string($link, $_POST["country"]);
        $state = mysqli_real_escape_string($link, $_POST["state"]);
        $city = mysqli_real_escape_string($link, $_POST["city"]);
        $zip = mysqli_real_escape_string($link, $_POST["zip"]);
        $log = get_date();

        if (empty($firstname) || empty($lastname)) {
            $_SESSION["failure"] = "Please fill out the firstname and lastname.";
            relocate_url("profile.php");
        } 
        elseif (empty($maiden_name)) {
            $_SESSION["failure"] = "Please fill out the maiden's name.";
            relocate_url("profile.php");
        } 
        elseif (empty($ssn)) {
            $_SESSION["failure"] = "Please enter your social security number.";
            relocate_url("profile.php");
        } 
        elseif (empty($dob)) {
            $_SESSION["failure"] = "Please enter your date of birth.";
            relocate_url("profile.php");
        } 
        elseif (empty($address) || empty($country) || empty($state) || empty($city) || empty($zip)) {
            $_SESSION["failure"] = "Please fill out the following: address, country, state, city and zip.";
            relocate_url("profile.php");
        } 
        elseif (!is_alpha($firstname) || !is_alpha($lastname)) {
            $_SESSION["failure"] = "Firstname and lastname can only be alphabets.";
            relocate_url("profile.php");
        } 
        elseif (get_year($dob) <= "1890") {
            $_SESSION["failure"] = "Invalid date of birth was provided.";
            relocate_url("profile.php");
        }
        elseif (!val_ssn($ssn)) {
            $_SESSION["failure"] = "Invalid social security number. Please check";
        } 
        else {
            $profileStatement = "UPDATE `users` SET ".
                                 "`firstname`='$firstname', `lastname`='$lastname', `suffix`='$suffix', `maiden_name`='$maiden_name', `ssn`='$ssn', `dob`='$dob', `address`='$address', `country`='$country', `state`='$state', `city`='$city', `zip`='$zip', `updated_at`='$log' ".
                                 "WHERE `id`='$id'";
            $updateProfile = mysqli_query($link, $profileStatement);

            if ($updateProfile) {
                session_destroy();
                $_SESSION["successful"] = "Your profile has been updated successfully. Please login agin to continue.";
                relocate_url("../login.php");
            } 
            else {
                $_SESSION["failure"] = "Something went wrong unable to update profile. Please contact CliffTopBank customer care if failure persists.";
                relocate_url("profile.php");
            }
        }
    }


    if (isset($_POST['updateAccount'])) 
    {
        $id = mysqli_real_escape_string($link, $user["id"]);
        $user_pin = mysqli_real_escape_string($link, $_POST["userPin"]);
        $username = mysqli_real_escape_string($link, $_POST["username"]);
        $account_type = mysqli_real_escape_string($link, $_POST["accountType"]);
        $security_question = mysqli_real_escape_string($link, $_POST["securityQuestion"]);
        $answer = mysqli_real_escape_string($link, $_POST["answer"]);
        $log = get_date();

        if (empty($user_pin)) {
            $_SESSION["failure"] = "Please enter a user PIN.";
            relocate_url("profile.php");
        } 
        elseif (empty($username)) {
            $_SESSION["failure"] = "Please fill out the username.";
            relocate_url("profile.php");
        } 
        elseif (empty($account_type)) {
            $_SESSION["failure"] = "Please select an account type.";
            relocate_url("profile.php");
        } 
        elseif (empty($security_question) || empty($answer)) {
            $_SESSION["failure"] = "Please fill out the security question and answer.";
            relocate_url("profile.php");
        }
        elseif (!val_pin($user_pin)) {
            $_SESSION["failure"] = "The user pin must be 4 digits only.";
            relocate_url("profile.php");
        }
        else {
            $profileStatement = "UPDATE `users` SET ".
                                 "`user_pin`='$user_pin', `username`='$username', `account_type`='$account_type', `security_question`='$security_question', `answer`='$answer', `updated_at`='$log' ".
                                 "WHERE `id`='$id'";
            $updateProfile = mysqli_query($link, $profileStatement);

            if ($updateProfile) {
                session_destroy();
                $_SESSION["successful"] = "Your account details has been updated successfully. Please login agin to continue.";
                relocate_url("../login.php");
            } 
            else {
                $_SESSION["failure"] = "Something went wrong unable to update account details. Please contact CliffTopBank customer care if failure persists.";
                relocate_url("profile.php");
            }
        }
    }


    if (isset($_POST['updateContact'])) 
    {
        $id = mysqli_real_escape_string($link, $user["id"]);
        $email = mysqli_real_escape_string($link, $_POST["email"]);
        $phone = mysqli_real_escape_string($link, $_POST["mobile"]);
        $log = get_date();

        if (empty($email)) {
            $_SESSION["failure"] = "Please fill out your email.";
            relocate_url("profile.php");
        } 
        elseif (empty($phone)) {
            $_SESSION["failure"] = "Please fill out your mobile number.";
            relocate_url("profile.php");
        }
        elseif (!val_email($email)) {
            $_SESSION["failure"] = "Invalid email address. Please check";
            relocate_url("profile.php");
        }
        elseif (!val_phoneno($phone)) {
            $_SESSION["failure"] = "Invalid phone number. Please check";
        } 
        else {
            $old_email = "";

            // Verify the old email address with the new one.
            $email_exist = mysqli_query($link, "SELECT `email` FROM `users` WHERE `id`='$id' LIMIT 1");
            while ($email_row = mysqli_fetch_array($email_exist)) { 
                $old_email = $email_row["email"]; 
            }
            if ((mysqli_num_rows($email_exist) > 0) && !equals($old_email, $email)) { 
                $_SESSION["failure"] = "Email already exists."; 
                relocate_url("profile.php");
            }

            $profileStatement = "UPDATE `users` SET `email`='$email', `phone`='$phone', `updated_at`='$log' WHERE `id`='$id'";
            $updateProfile = mysqli_query($link, $profileStatement);

            if ($updateProfile) {
                session_destroy();
                $_SESSION["successful"] = "Your contact details has been updated successfully. Please login agin to continue.";
                relocate_url("../login.php");
            } 
            else {
                $_SESSION["failure"] = "Something went wrong unable to update contact details. Please contact CliffTopBank customer care if failure persists.";
                relocate_url("profile.php");
            }
        }
    }

    /** 
     * Update user password 
     **/
    if (isset($_POST['updatePassword'])) 
    {
        $id = mysqli_real_escape_string($link, $user["id"]);
        $old_password = mysqli_real_escape_string($link, $_POST["existingPassword"]);
        $new_password = mysqli_real_escape_string($link, $_POST["newPassword"]);
        $confirm_password = mysqli_real_escape_string($link, $_POST["confirmPassword"]);
        $log = get_date();

        if (empty($old_password) || empty($new_password) || empty($confirm_password)) {
            $_SESSION["failure"] = "Please all fields must be filled.";
            relocate_url("profile.php");
        } 
        elseif (!minimum($new_password, 5)) {
            $_SESSION["failure"] = "Password must be at least 5 characters.";
            relocate_url("profile.php");
        }
        elseif (!compare($new_password, $confirm_password)) {
            $_SESSION["failure"] = "Password fields do not match!";
            relocate_url("profile.php");
        }
        else {
            $check_password = "SELECT `password` FROM `users` WHERE `id`='$id'";
            $verify_password = mysqli_query($link, $check_password);

            while ($password_row = mysqli_fetch_array($verify_password)) { 
                $user_password = $password_row["password"]; 
            }

            if (equals($old_password, $user_password)) {
                $passwordStatement = "UPDATE `users` SET `password`='$new_password', `updated_at`='$log' WHERE `id`='$id'";
                $updatePassword = mysqli_query($link, $passwordStatement);

                if ($updatePassword) {
                    session_destroy();
                    $_SESSION["successful"] = "Your password has been updated successfully. Please login agin to continue.";
                    relocate_url("../login.php");
                } 
                else {
                    $_SESSION["failure"] = "Something went wrong unable to update password. Please contact CliffTopBank customer care if failure persists.";
                    relocate_url("profile.php");
                }
            } 
            else {
                $_SESSION["failure"] = "The current password is incorrect. Please try again.";
                relocate_url("profile.php");
            }
        }
    }


    /** 
     * Update user photo 
     * For UI template see user-edit.php
     **/
    if (isset($_POST['updatePicture'])) 
    {
        $id = mysqli_real_escape_string($link, $user["id"]);
        $file_name = basename($_FILES["picture"]["name"]);
        $temp_name = $_FILES["picture"]["tmp_name"];
        $log = get_date();

        $sep = explode(".", $file_name);
        $file_ext = strtolower(end($sep));
        $ext = array("jpg", "jpeg", "png", "gif", "bmp");

        if (in_array($file_ext, $ext)) {
            $avatar = $id . "-" . date("Ymdhis") . '.' . $file_ext;
            $file_folder = "../uploads/users-avatar/" . $avatar;

            if (move_uploaded_file($temp_name, $file_folder)) {
                $avatarStatement = "UPDATE `users` SET `image`='$avatar', `updated_at`='$log' WHERE `id`='$id'";
                $uploadAvatar = mysqli_query($link, $avatarStatement);

                if ($uploadAvatar) {
                    session_destroy();
                    $_SESSION["successful"] = "Your profile picture has been updated successfully. Please login agin to continue.";
                    relocate_url("../login.php");
                } 
                else {
                    $_SESSION["failure"] = "Something went wrong unable to update profile picture. Please contact CliffTopBank customer care if failure persists.";
                    relocate_url("profile.php");
                }
            } 
            else {
                $_SESSION["failure"] = "Something went wrong unable to update profile picture. Please contact CliffTopBank customer care if failure persists.";
                relocate_url("profile.php");
            }
        } 
        else {
            $_SESSION["failure"] = "Unknown file extension. allowed files are jpg, jpeg, bmp, png, gif.";
            relocate_url("profile.php");
        }
    }
?>