<?php 
    session_start();
    include("../includes/config.php");
    include("../includes/conn.php");
    include("../includes/func.php");
    user_session_expired("../login.php");

    $_SESSION["dashboard_title"] = "Request Money";
    $_SESSION["nav"] = "request";
    include("header.php"); 
?> 
  
  <!-- Content
  ============================================= -->
  <div id="content" class="py-4">

    <?php 
      echo msg_success();
      echo msg_failure();
    ?>

    <div class="container">
      <h2 class="font-weight-400 text-center mt-3">Request Money</h2>
      <p class="text-4 text-center mb-4">Request money from anyone at anytime.</p>
      <div class="row">
        <div class="col-md-8 col-lg-6 col-xl-5 mx-auto">
          <div class="bg-light shadow-sm rounded p-3 p-sm-4 mb-4">
            <!-- Request Money Form
            ============================================= -->
            <form id="form-send-money" action="request-money-confirm.php" method="post">
              <input type="hidden" name="trnx_id" value="<?php echo strtoupper(generate_reference(18)); ?>">
              <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">

              <div class="form-group">
                <label for="recipient_name">Recipient Name</label>
                <input type="text" class="form-control" data-bv-field="recipient_name" id="recipient_name" name="recipient_name" required placeholder="Enter the Recipient Name">
              </div>
              <div class="form-group">
                <label for="recipient_country">Recipient Country</label>
                <select class="custom-select form-control" id="recipient_country" name="recipient_country" required>
                  <option value="" selected>-- Select Recipient Country --</option>
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
              <div class="form-group">
                <label for="recipient_email">Recipient Email</label>
                <input type="email" class="form-control" data-bv-field="recipient_email" id="recipient_email" name="recipient_email" required placeholder="Enter the Recipient Email">
              </div>
              <div class="form-group">
                <label for="youSend">Amount</label>
                <div class="input-group">
                  <input type="text" class="form-control" name="amount" required placeholder="Enter Amount Requested">
                  <div class="input-group-append"> 
                    <span class="input-group-text p-0">
                      <select id="youSendCurrency" name="currency" required data-style="custom-select bg-transparent border-0" data-container="body" data-live-search="true" class="selectpicker form-control bg-transparent" required="">
                        <optgroup label="Popular Currency">
                          <option data-icon="currency-flag currency-flag-usd mr-1" data-subtext="United States dollar" selected="selected" value="usd">USD</option>
                          <option data-icon="currency-flag currency-flag-eur mr-1" data-subtext="Euro" value="eur">EUR</option>
                          <option data-icon="currency-flag currency-flag-gbp mr-1" data-subtext="British pound" value="gbp">GBP</option>
                        </optgroup>
                        <option value="" data-divider="true">divider</option>
                          <optgroup label="Other Currency">
                          <option data-icon="currency-flag currency-flag-aed mr-1" data-subtext="United Arab Emirates dirham" value="aed">AED</option>
                          <option data-icon="currency-flag currency-flag-ars mr-1" data-subtext="Argentine peso" value="ars">ARS</option>
                          <option data-icon="currency-flag currency-flag-aud mr-1" data-subtext="Australian dollar" value="aud">AUD</option>
                          <option data-icon="currency-flag currency-flag-bdt mr-1" data-subtext="Bangladeshi taka" value="bdt">BDT</option>
                          <option data-icon="currency-flag currency-flag-bgn mr-1" data-subtext="Bulgarian lev" value="bgn">BGN</option>
                          <option data-icon="currency-flag currency-flag-brl mr-1" data-subtext="Brazilian real" value="brl">BRL</option>
                          <option data-icon="currency-flag currency-flag-cad mr-1" data-subtext="Canadian dollar" value="cad">CAD</option>
                          <option data-icon="currency-flag currency-flag-chf mr-1" data-subtext="Swiss franc" value="chf">CHF</option>
                          <option data-icon="currency-flag currency-flag-clp mr-1" data-subtext="Chilean peso" value="clp">CLP</option>
                          <option data-icon="currency-flag currency-flag-cny mr-1" data-subtext="Chinese yuan" value="cny">CNY</option>
                          <option data-icon="currency-flag currency-flag-czk mr-1" data-subtext="Czech koruna" value="czk">CZK</option>
                          <option data-icon="currency-flag currency-flag-dkk mr-1" data-subtext="Danish krone" value="dkk">DKK</option>
                          <option data-icon="currency-flag currency-flag-egp mr-1" data-subtext="Egyptian pound" value="egp">EGP</option>
                          <option data-icon="currency-flag currency-flag-eur mr-1" data-subtext="Euro" value="eur">EUR</option>
                          <option data-icon="currency-flag currency-flag-gbp mr-1" data-subtext="British pound" value="gbp">GBP</option>
                          <option data-icon="currency-flag currency-flag-gel mr-1" data-subtext="Georgian lari" value="gel">GEL</option>
                          <option data-icon="currency-flag currency-flag-ghs mr-1" data-subtext="Ghanaian cedi" value="ghs">GHS</option>
                          <option data-icon="currency-flag currency-flag-hkd mr-1" data-subtext="Hong Kong dollar" value="hkd">HKD</option>
                          <option data-icon="currency-flag currency-flag-hrk mr-1" data-subtext="Croatian kuna" value="hrk">HRK</option>
                          <option data-icon="currency-flag currency-flag-huf mr-1" data-subtext="Hungarian forint" value="huf">HUF</option>
                          <option data-icon="currency-flag currency-flag-idr mr-1" data-subtext="Indonesian rupiah" value="idr">IDR</option>
                          <option data-icon="currency-flag currency-flag-ils mr-1" data-subtext="Israeli shekel" value="ils">ILS</option>
                          <option data-icon="currency-flag currency-flag-inr mr-1" data-subtext="Indian rupee" value="inr">INR</option>
                          <option data-icon="currency-flag currency-flag-jpy mr-1" data-subtext="Japanese yen" value="jpy">JPY</option>
                          <option data-icon="currency-flag currency-flag-kes mr-1" data-subtext="Kenyan shilling" value="">KES</option>
                          <option data-icon="currency-flag currency-flag-krw mr-1" data-subtext="South Korean won" value="krw">KRW</option>
                          <option data-icon="currency-flag currency-flag-lkr mr-1" data-subtext="Sri Lankan rupee" value="lkr">LKR</option>
                          <option data-icon="currency-flag currency-flag-mad mr-1" data-subtext="Moroccan dirham" value="mad">MAD</option>
                          <option data-icon="currency-flag currency-flag-mxn mr-1" data-subtext="Mexican peso" value="mxn">MXN</option>
                          <option data-icon="currency-flag currency-flag-myr mr-1" data-subtext="Malaysian ringgit" value="myr">MYR</option>
                          <option data-icon="currency-flag currency-flag-ngn mr-1" data-subtext="Nigerian naira" value="ngn">NGN</option>
                          <option data-icon="currency-flag currency-flag-nok mr-1" data-subtext="Norwegian krone" value="nok">NOK</option>
                          <option data-icon="currency-flag currency-flag-npr mr-1" data-subtext="Nepalese rupee" value="npr">NPR</option>
                          <option data-icon="currency-flag currency-flag-nzd mr-1" data-subtext="New Zealand dollar" value="nzd">NZD</option>
                          <option data-icon="currency-flag currency-flag-pen mr-1" data-subtext="Peruvian nuevo sol" value="pen">PEN</option>
                          <option data-icon="currency-flag currency-flag-php mr-1" data-subtext="Philippine peso" value="php">PHP</option>
                          <option data-icon="currency-flag currency-flag-pkr mr-1" data-subtext="Pakistani rupee" value="pkr">PKR</option>
                          <option data-icon="currency-flag currency-flag-pln mr-1" data-subtext="Polish złoty" value="pln">PLN</option>
                          <option data-icon="currency-flag currency-flag-ron mr-1" data-subtext="Romanian leu" value="ron">RON</option>
                          <option data-icon="currency-flag currency-flag-rub mr-1" data-subtext="Russian rouble" value="rub">RUB</option>
                          <option data-icon="currency-flag currency-flag-sek mr-1" data-subtext="Swedish krona" value="sek">SEK</option>
                          <option data-icon="currency-flag currency-flag-sgd mr-1" data-subtext="Singapore dollar" value="sgd">SGD</option>
                          <option data-icon="currency-flag currency-flag-thb mr-1" data-subtext="Thai baht" value="thb">THB</option>
                          <option data-icon="currency-flag currency-flag-try mr-1" data-subtext="Turkish lira" value="try">TRY</option>
                          <option data-icon="currency-flag currency-flag-uah mr-1" data-subtext="Ukrainian hryvnia" value="uah">UAH</option>
                          <option data-icon="currency-flag currency-flag-ugx mr-1" data-subtext="Ugandan shilling" value="ugx">UGX</option>
                          <option data-icon="currency-flag currency-flag-vnd mr-1" data-subtext="Vietnamese dong" value="vnd">VND</option>
                          <option data-icon="currency-flag currency-flag-zar mr-1" data-subtext="South African rand" value="zar">ZAR</option>
                        </optgroup>
                      </select>
                    </span> 
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="payment_due">Payment Due</label>
                <input type="date" class="form-control" id="payment_due" name="payment_due" required placeholder="Enter the Payment Due Date">
              </div>
              <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" rows="4" id="description" name="description" required placeholder="Request Description"></textarea>
              </div>
              <button class="btn btn-primary btn-block mt-5">Continue</button>
            </form>
            <!-- Send Money Form end --> 
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Content end --> 
  
<?php 
  unset($_SESSION["dashboard_title"]);
  unset($_SESSION["nav"]);
  include("footer.php"); 
?>