<?php 
    session_start();
    include("../includes/config.php");
    include("../includes/conn.php");
    include("../includes/func.php");
    admin_session_expired("login.php");
    set_headers("Add New Transfer", "transfers");
    include("header.php");

    if (isset($_POST["add_transfer"])) 
    {
        $trnx_id = mysqli_real_escape_string($link, $_POST["trnx_id"]);
        $user = mysqli_real_escape_string($link, $_POST["user"]);
        $bank = mysqli_real_escape_string($link, $_POST["bank"]);
        $account_name = mysqli_real_escape_string($link, $_POST["account_name"]);
        $account_no = mysqli_real_escape_string($link, $_POST["account_no"]);
        $routing_no = mysqli_real_escape_string($link, $_POST["routing_no"]);
        $swift_code = mysqli_real_escape_string($link, $_POST["swift_code"]);
        $country = mysqli_real_escape_string($link, $_POST["country"]);
        $amount = mysqli_real_escape_string($link, $_POST["amount"]);
        $currency = mysqli_real_escape_string($link, $_POST["currency"]);
        $method = mysqli_real_escape_string($link, $_POST["method"]);
        $narration = mysqli_real_escape_string($link, $_POST["narration"]);
        $transfer_date = mysqli_real_escape_string($link, $_POST["transfer_date"]);
        $type = "transfer";

        if (empty($user)) {
            $_SESSION["error"] = "Please select a user.";
        } 
        elseif (empty($bank)) {
            $_SESSION["error"] = "Please fill out the bank name.";
        }
        elseif (empty($account_name)) {
            $_SESSION["error"] = "Please fill out the account name.";
        }
        elseif (empty($account_no)) {
            $_SESSION["error"] = "Please fill out the account number.";
        }
        elseif (empty($routing_no)) {
            $_SESSION["error"] = "Please fill out the routing number.";
        }
        elseif (empty($swift_code)) {
            $_SESSION["error"] = "Please fill out the swift code.";
        }
        elseif (empty($country)) {
            $_SESSION["error"] = "Please select a country.";
        }
        elseif (empty($amount)) {
            $_SESSION["error"] = "Please fill out the amount.";
        }
        elseif (empty($currency)) {
            $_SESSION["error"] = "Please select a currency.";
        }
        elseif (empty($method)) {
            $_SESSION["error"] = "Please select a payment method.";
        }
        elseif (empty($narration)) {
            $_SESSION["error"] = "Please fill in the narration.";
        }
        else {
            // Fetch the transaction fee for transfer. 
            $fee_row = mysqli_fetch_array(mysqli_query($link, "SELECT `fee` FROM `transaction_fee` WHERE `level`='$type'"));
            $fee = $fee_row["fee"];

            // Insert a new transaction log to the transactions table.
            $transaction_statement = "INSERT INTO `transactions` (`user_id`, `trnx_id`, `amount`, `currency`, `fee`, `type`, `description`, `created_at`) ".
                                     "VALUES ('$user', '$trnx_id', '$amount', '$currency', '$fee', '$type', '$narration', '$transfer_date')";
            $insert_transaction = mysqli_query($link, $transaction_statement);

            // Insert the new transfer to the transfers table.
            $transfer_statement = "INSERT INTO `transfers` (`user_id`, `trnx_id`, `bank`, `account_name`, `account_no`, `routing_no`, `swift_code`, `country`, `amount`, `charge`, `currency`, `method`, `narration`, `created_at`) ".
                                  "VALUES ('$user', '$trnx_id', '$bank', '$account_name', '$account_no', '$routing_no', '$swift_code', '$country', '$amount', '$fee', '$currency', '$method', '$narration', '$transfer_date')";
            $insert_transfer = mysqli_query($link, $transfer_statement);

            // Verify if all the operations where successful.
            if ($insert_transfer && $insert_transaction) {
                $_SESSION["success"] = "New transfer record added successfully.";
                relocate_url("transfers.php"); 
            } 
            else {
                $_SESSION["error"] = "unable to add a new transfer record";
            }
        }
    }
?>
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title mb-0">Add New Transfer</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12 mb-2">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="transfers.php">Transfers</a></li>
                            <li class="breadcrumb-item active">Add New Transfer</li>
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
            <section id="basic-form-layouts">
                <div class="row match-height">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-content mt-3">
                                <div class="card-body">
                                    <form action="" method="post" class="form form-horizontal">
                                        <div class="form-body">
                                            <div class="form-group row">
                                                <label for="trnx_id" class="col-md-3 label-control">Transaction ID</label>
                                                <div class="col-md-9">
                                                    <input type="text" id="trnx_id" class="form-control" name="trnx_id" value="<?php echo strtoupper(generate_reference(18)); ?>">
                                                    <p class="text-muted ml-75 mt-50">
                                                        <small>This is the transaction Id. It is automatically generated do not edit.</small>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="user" class="col-md-3 label-control">User</label>
                                                <div class="col-md-9">
                                                    <select name="user" id="user" class="select2 form-control" required>
                                                        <option value="" selected>-- Select User --</option>
                                                        <?php
                                                            $customer = mysqli_query($link, "SELECT `id`, CONCAT(`firstname`, ' ', `lastname`) AS `name` FROM `users` WHERE `status`='active'");
                                                            while($data = mysqli_fetch_array($customer)) {
                                                                echo "<option value='".$data['id']."'>".ucwords($data['name'])."</option>";
                                                            } 
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="bank" class="col-md-3 label-control">Bank Name</label>
                                                <div class="col-md-9">
                                                    <input type="text" id="bank" class="form-control" placeholder="Enter Bank Name" name="bank" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="accountName" class="col-md-3 label-control">Account Name</label>
                                                <div class="col-md-9">
                                                    <input type="text" id="accountName" class="form-control" placeholder="Enter Account Name" name="account_name" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="accountNumber" class="col-md-3 label-control">Account Number</label>
                                                <div class="col-md-9">
                                                    <input type="text" id="accountNumber" class="form-control" placeholder="Enter Account Number" name="account_no" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="accountName" class="col-md-3 label-control">Routing Number</label>
                                                <div class="col-md-9">
                                                    <input type="text" id="accountName" class="form-control" placeholder="Enter Routing Number" name="routing_no" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="accountName" class="col-md-3 label-control">Swift Code</label>
                                                <div class="col-md-9">
                                                    <input type="text" id="accountName" class="form-control" placeholder="Enter Swift Code" name="swift_code" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="dob">Country</label>
                                                <div class="col-md-9">
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
                                            <div class="form-group row">
                                                <label for="amount" class="col-md-3 label-control">Amount</label>
                                                <div class="col-md-9">
                                                    <div class="input-group mt-0">
                                                        <input type="number" class="form-control" name="amount" required>
                                                        <div class="input-group-append"><span class="input-group-text">.00</span></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="currency" class="col-md-3 label-control">Currency</label>
                                                <div class="col-md-9">
                                                    <select id="currency" name="currency" class="select2 form-control" required>
                                                        <optgroup label="Popular Currency">
                                                            <option selected value="usd">USD</option>
                                                            <option value="gbp">GBP</option>
                                                            <option value="eur">EUR</option>
                                                        </optgroup>
                                                        <optgroup label="Other Currency">
                                                            <option value="aed">AED</option>
                                                            <option value="ars">ARS</option>
                                                            <option value="aud">AUD</option>
                                                            <option value="bdt">BDT</option>
                                                            <option value="bgn">BGN</option>
                                                            <option value="brl">BRL</option>
                                                            <option value="cad">CAD</option>
                                                            <option value="chf">CHF</option>
                                                            <option value="clp">CLP</option>
                                                            <option value="cny">CNY</option>
                                                            <option value="czk">CZK</option>
                                                            <option value="dkk">DKK</option>
                                                            <option value="egp">EGP</option>
                                                            <option value="gel">GEL</option>
                                                            <option value="ghs">GHS</option>
                                                            <option value="hkd">HKD</option>
                                                            <option value="hrk">HRK</option>
                                                            <option value="huf">HUF</option>
                                                            <option value="idr">IDR</option>
                                                            <option value="ils">ILS</option>
                                                            <option value="inr">INR</option>
                                                            <option value="jpy">JPY</option>
                                                            <option value="kes">KES</option>
                                                            <option value="krw">KRW</option>
                                                            <option value="lkr">LKR</option>
                                                            <option value="mad">MAD</option>
                                                            <option value="mxn">MXN</option>
                                                            <option value="myr">MYR</option>
                                                            <option value="ngn">NGN</option>
                                                            <option value="nok">NOK</option>
                                                            <option value="npr">NPR</option>
                                                            <option value="nzd">NZD</option>
                                                            <option value="pen">PEN</option>
                                                            <option value="php">PHP</option>
                                                            <option value="pkr">PKR</option>
                                                            <option value="pln">PLN</option>
                                                            <option value="ron">RON</option>
                                                            <option value="rub">RUB</option>
                                                            <option value="sek">SEK</option>
                                                            <option value="sgd">SGD</option>
                                                            <option value="thb">THB</option>
                                                            <option value="try">TRY</option>
                                                            <option value="uah">UAH</option>
                                                            <option value="ugx">UGX</option>
                                                            <option value="vnd">VND</option>
                                                            <option value="zar">ZAR</option>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="paymentMethod" class="col-md-3 label-control">Payment Method</label>
                                                <div class="col-md-9">
                                                    <select name="method" id="paymentMethod" class="custom-select block" required>
                                                        <option value="" selected>-- Select Payment Method --</option>
                                                        <option value="debit card">Debit Card</option>
                                                        <option value="credit card">Credit Card</option>
                                                        <option value="bank accounts">Bank Accounts</option>
                                                        <?php
                                                            $gateways = mysqli_query($link, "SELECT * FROM `gateways` WHERE `status`='enabled'");
                                                            while($gate = mysqli_fetch_array($gateways)) {
                                                                echo "<option value='".$gate['gateway']."'>".ucwords($gate['gateway'])."</option>";
                                                            } 
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="narration" class="col-md-3 label-control">Description</label>
                                                <div class="col-md-9">
                                                    <textarea id="narration" rows="6" class="form-control square" name="narration" placeholder="Reason for transfer" required></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="transferDate" class="col-md-3 label-control">Date</label>
                                                <div class="col-md-9">
                                                    <input type="datetime-local" id="transferDate" class="form-control" name="transfer_date">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions center">
                                            <button type="submit" class="btn btn-success" name="add_transfer">Add Transfer</button>
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