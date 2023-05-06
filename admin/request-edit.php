<?php 
    session_start();
    include("../includes/config.php");
    include("../includes/conn.php");
    include("../includes/func.php");
    admin_session_expired("login.php");
    set_headers("Edit Money Request", "requests");
    include("header.php");

    if (isset($_GET["rId"])) {
        $request = mysqli_fetch_array(mysqli_query($link, "SELECT * FROM `requests` WHERE `id`='".$_GET["rId"]."'"));
        $r_id = $request['id'];
        $r_user_id = $request['user_id'];
        $r_trnx_id = $request['trnx_id'];
        $r_recipient = $request['recipient'];
        $r_recipient_country = $request['recipient_country'];
        $r_recipient_email = $request['recipient_email'];
        $r_amount = $request['amount'];
        $r_currency = $request['currency'];
        $r_charge = $request['charge'];
        $r_payment_due = $request['payment_due'];
        $r_narration = $request['narration'];
        $r_status = $request['status'];
        $r_created_at = $request['created_at'];
    }
?>
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-12 col-12 mb-2">
                <h3 class="content-header-title mb-0">Edit Money Request [TRNX ID: <b><?php echo $r_trnx_id; ?></b>]</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12 mb-2">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="deposits.php">Requests</a></li>
                            <li class="breadcrumb-item active">Edit Money Request</li>
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
                                            <input type="hidden" id="id" class="form-control" name="id" value="<?php echo $r_id; ?>">
                                            <input type="hidden" id="trnx_id" class="form-control" name="trnx_id" value="<?php echo $r_trnx_id; ?>">
                                            <div class="form-group row">
                                                <label for="payer" class="col-md-3 label-control">Payer</label>
                                                <div class="col-md-9">
                                                    <select name="payer" id="payer" class="select2 form-control" required>
                                                        <?php
                                                            $customer = mysqli_query($link, "SELECT `id`, CONCAT(`firstname`, ' ', `lastname`) AS `name` FROM `users` WHERE `status`='active'");
                                                            while($data = mysqli_fetch_array($customer)) {
                                                                if ($data['id'] == $d_user_id) { echo "<option value='".$data['id']."' selected>".ucwords($data['name'])."</option>"; }
                                                                else { echo "<option value='".$data['id']."'>".ucwords($data['name'])."</option>"; }
                                                            } 
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="recipient" class="col-md-3 label-control">Recipient Name</label>
                                                <div class="col-md-9">
                                                    <input type="text" id="recipient" class="form-control" placeholder="Enter Recipient Name" value="<?php echo $r_recipient; ?>" name="recipient" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="dob">Recipient Country</label>
                                                <div class="col-md-9">
                                                    <select class="custom-select form-control" id="recipient_country" name="recipient_country" required>
                                                        <option <?php if ($r_recipient_country == "Afganistan") { echo "selected"; } ?> value="Afganistan">Afghanistan</option>
                                                        <option <?php if ($r_recipient_country == "Albania") { echo "selected"; } ?> value="Albania">Albania</option>
                                                        <option <?php if ($r_recipient_country == "Algeria") { echo "selected"; } ?> value="Algeria">Algeria</option>
                                                        <option <?php if ($r_recipient_country == "American Samoa") { echo "selected"; } ?> value="American Samoa">American Samoa</option>
                                                        <option <?php if ($r_recipient_country == "Andorra") { echo "selected"; } ?> value="Andorra">Andorra</option>
                                                        <option <?php if ($r_recipient_country == "Angola") { echo "selected"; } ?> value="Angola">Angola</option>
                                                        <option <?php if ($r_recipient_country == "Anguilla") { echo "selected"; } ?> value="Anguilla">Anguilla</option>
                                                        <option <?php if ($r_recipient_country == "Antigua & Barbuda") { echo "selected"; } ?> value="Antigua & Barbuda">Antigua & Barbuda</option>
                                                        <option <?php if ($r_recipient_country == "Argentina") { echo "selected"; } ?> value="Argentina">Argentina</option>
                                                        <option <?php if ($r_recipient_country == "Armenia") { echo "selected"; } ?> value="Armenia">Armenia</option>
                                                        <option <?php if ($r_recipient_country == "Aruba") { echo "selected"; } ?> value="Aruba">Aruba</option>
                                                        <option <?php if ($r_recipient_country == "Australia") { echo "selected"; } ?> value="Australia">Australia</option>
                                                        <option <?php if ($r_recipient_country == "Austria") { echo "selected"; } ?> value="Austria">Austria</option>
                                                        <option <?php if ($r_recipient_country == "Azerbaijan") { echo "selected"; } ?> value="Azerbaijan">Azerbaijan</option>
                                                        <option <?php if ($r_recipient_country == "Bahamas") { echo "selected"; } ?> value="Bahamas">Bahamas</option>
                                                        <option <?php if ($r_recipient_country == "Bahrain") { echo "selected"; } ?> value="Bahrain">Bahrain</option>
                                                        <option <?php if ($r_recipient_country == "Bangladesh") { echo "selected"; } ?> value="Bangladesh">Bangladesh</option>
                                                        <option <?php if ($r_recipient_country == "Barbados") { echo "selected"; } ?> value="Barbados">Barbados</option>
                                                        <option <?php if ($r_recipient_country == "Belarus") { echo "selected"; } ?> value="Belarus">Belarus</option>
                                                        <option <?php if ($r_recipient_country == "Belgium") { echo "selected"; } ?> value="Belgium">Belgium</option>
                                                        <option <?php if ($r_recipient_country == "Belize") { echo "selected"; } ?> value="Belize">Belize</option>
                                                        <option <?php if ($r_recipient_country == "Benin") { echo "selected"; } ?> value="Benin">Benin</option>
                                                        <option <?php if ($r_recipient_country == "Bermuda") { echo "selected"; } ?> value="Bermuda">Bermuda</option>
                                                        <option <?php if ($r_recipient_country == "Bhutan") { echo "selected"; } ?> value="Bhutan">Bhutan</option>
                                                        <option <?php if ($r_recipient_country == "Bolivia") { echo "selected"; } ?> value="Bolivia">Bolivia</option>
                                                        <option <?php if ($r_recipient_country == "Bonaire") { echo "selected"; } ?> value="Bonaire">Bonaire</option>
                                                        <option <?php if ($r_recipient_country == "Bosnia & Herzegovina") { echo "selected"; } ?> value="Bosnia & Herzegovina">Bosnia & Herzegovina</option>
                                                        <option <?php if ($r_recipient_country == "Botswana") { echo "selected"; } ?> value="Botswana">Botswana</option>
                                                        <option <?php if ($r_recipient_country == "Brazil") { echo "selected"; } ?> value="Brazil">Brazil</option>
                                                        <option <?php if ($r_recipient_country == "British Indian Ocean Ter") { echo "selected"; } ?> value="British Indian Ocean Ter">British Indian Ocean Ter</option>
                                                        <option <?php if ($r_recipient_country == "Brunei") { echo "selected"; } ?> value="Brunei">Brunei</option>
                                                        <option <?php if ($r_recipient_country == "Bulgaria") { echo "selected"; } ?> value="Bulgaria">Bulgaria</option>
                                                        <option <?php if ($r_recipient_country == "Burkina Faso") { echo "selected"; } ?> value="Burkina Faso">Burkina Faso</option>
                                                        <option <?php if ($r_recipient_country == "Burundi") { echo "selected"; } ?> value="Burundi">Burundi</option>
                                                        <option <?php if ($r_recipient_country == "Cambodia") { echo "selected"; } ?> value="Cambodia">Cambodia</option>
                                                        <option <?php if ($r_recipient_country == "Cameroon") { echo "selected"; } ?> value="Cameroon">Cameroon</option>
                                                        <option <?php if ($r_recipient_country == "Canada") { echo "selected"; } ?> value="Canada">Canada</option>
                                                        <option <?php if ($r_recipient_country == "Canary Islands") { echo "selected"; } ?> value="Canary Islands">Canary Islands</option>
                                                        <option <?php if ($r_recipient_country == "Cape Verde") { echo "selected"; } ?> value="Cape Verde">Cape Verde</option>
                                                        <option <?php if ($r_recipient_country == "Cayman Islands") { echo "selected"; } ?> value="Cayman Islands">Cayman Islands</option>
                                                        <option <?php if ($r_recipient_country == "Central African Republic") { echo "selected"; } ?> value="Central African Republic">Central African Republic</option>
                                                        <option <?php if ($r_recipient_country == "Chad") { echo "selected"; } ?> value="Chad">Chad</option>
                                                        <option <?php if ($r_recipient_country == "Channel Islands") { echo "selected"; } ?> value="Channel Islands">Channel Islands</option>
                                                        <option <?php if ($r_recipient_country == "Chile") { echo "selected"; } ?> value="Chile">Chile</option>
                                                        <option <?php if ($r_recipient_country == "China") { echo "selected"; } ?> value="China">China</option>
                                                        <option <?php if ($r_recipient_country == "Christmas Island") { echo "selected"; } ?> value="Christmas Island">Christmas Island</option>
                                                        <option <?php if ($r_recipient_country == "Cocos Island") { echo "selected"; } ?> value="Cocos Island">Cocos Island</option>
                                                        <option <?php if ($r_recipient_country == "Colombia") { echo "selected"; } ?> value="Colombia">Colombia</option>
                                                        <option <?php if ($r_recipient_country == "Comoros") { echo "selected"; } ?> value="Comoros">Comoros</option>
                                                        <option <?php if ($r_recipient_country == "Congo") { echo "selected"; } ?> value="Congo">Congo</option>
                                                        <option <?php if ($r_recipient_country == "Cook Islands") { echo "selected"; } ?> value="Cook Islands">Cook Islands</option>
                                                        <option <?php if ($r_recipient_country == "Costa Rica") { echo "selected"; } ?> value="Costa Rica">Costa Rica</option>
                                                        <option <?php if ($r_recipient_country == "Cote DIvoire") { echo "selected"; } ?> value="Cote DIvoire">Cote DIvoire</option>
                                                        <option <?php if ($r_recipient_country == "Croatia") { echo "selected"; } ?> value="Croatia">Croatia</option>
                                                        <option <?php if ($r_recipient_country == "Cuba") { echo "selected"; } ?> value="Cuba">Cuba</option>
                                                        <option <?php if ($r_recipient_country == "Curaco") { echo "selected"; } ?> value="Curaco">Curacao</option>
                                                        <option <?php if ($r_recipient_country == "Cyprus") { echo "selected"; } ?> value="Cyprus">Cyprus</option>
                                                        <option <?php if ($r_recipient_country == "Czech Republic") { echo "selected"; } ?> value="Czech Republic">Czech Republic</option>
                                                        <option <?php if ($r_recipient_country == "Denmark") { echo "selected"; } ?> value="Denmark">Denmark</option>
                                                        <option <?php if ($r_recipient_country == "Djibouti") { echo "selected"; } ?> value="Djibouti">Djibouti</option>
                                                        <option <?php if ($r_recipient_country == "Dominica") { echo "selected"; } ?> value="Dominica">Dominica</option>
                                                        <option <?php if ($r_recipient_country == "Dominican Republic") { echo "selected"; } ?> value="Dominican Republic">Dominican Republic</option>
                                                        <option <?php if ($r_recipient_country == "East Timor") { echo "selected"; } ?> value="East Timor">East Timor</option>
                                                        <option <?php if ($r_recipient_country == "Ecuador") { echo "selected"; } ?> value="Ecuador">Ecuador</option>
                                                        <option <?php if ($r_recipient_country == "Egypt") { echo "selected"; } ?> value="Egypt">Egypt</option>
                                                        <option <?php if ($r_recipient_country == "El Salvador") { echo "selected"; } ?> value="El Salvador">El Salvador</option>
                                                        <option <?php if ($r_recipient_country == "Equatorial Guinea") { echo "selected"; } ?> value="Equatorial Guinea">Equatorial Guinea</option>
                                                        <option <?php if ($r_recipient_country == "Eritrea") { echo "selected"; } ?> value="Eritrea">Eritrea</option>
                                                        <option <?php if ($r_recipient_country == "Estonia") { echo "selected"; } ?> value="Estonia">Estonia</option>
                                                        <option <?php if ($r_recipient_country == "Ethiopia") { echo "selected"; } ?> value="Ethiopia">Ethiopia</option>
                                                        <option <?php if ($r_recipient_country == "Falkland Islands") { echo "selected"; } ?> value="Falkland Islands">Falkland Islands</option>
                                                        <option <?php if ($r_recipient_country == "Faroe Islands") { echo "selected"; } ?> value="Faroe Islands">Faroe Islands</option>
                                                        <option <?php if ($r_recipient_country == "Fiji") { echo "selected"; } ?> value="Fiji">Fiji</option>
                                                        <option <?php if ($r_recipient_country == "Finland") { echo "selected"; } ?> value="Finland">Finland</option>
                                                        <option <?php if ($r_recipient_country == "France") { echo "selected"; } ?> value="France">France</option>
                                                        <option <?php if ($r_recipient_country == "French Guiana") { echo "selected"; } ?> value="French Guiana">French Guiana</option>
                                                        <option <?php if ($r_recipient_country == "French Polynesia") { echo "selected"; } ?> value="French Polynesia">French Polynesia</option>
                                                        <option <?php if ($r_recipient_country == "French Southern Ter") { echo "selected"; } ?> value="French Southern Ter">French Southern Ter</option>
                                                        <option <?php if ($r_recipient_country == "Gabon") { echo "selected"; } ?> value="Gabon">Gabon</option>
                                                        <option <?php if ($r_recipient_country == "Gambia") { echo "selected"; } ?> value="Gambia">Gambia</option>
                                                        <option <?php if ($r_recipient_country == "Georgia") { echo "selected"; } ?> value="Georgia">Georgia</option>
                                                        <option <?php if ($r_recipient_country == "Germany") { echo "selected"; } ?> value="Germany">Germany</option>
                                                        <option <?php if ($r_recipient_country == "Ghana") { echo "selected"; } ?> value="Ghana">Ghana</option>
                                                        <option <?php if ($r_recipient_country == "Gibraltar") { echo "selected"; } ?> value="Gibraltar">Gibraltar</option>
                                                        <option <?php if ($r_recipient_country == "Great Britain") { echo "selected"; } ?> value="Great Britain">Great Britain</option>
                                                        <option <?php if ($r_recipient_country == "Greece") { echo "selected"; } ?> value="Greece">Greece</option>
                                                        <option <?php if ($r_recipient_country == "Greenland") { echo "selected"; } ?> value="Greenland">Greenland</option>
                                                        <option <?php if ($r_recipient_country == "Grenada") { echo "selected"; } ?> value="Grenada">Grenada</option>
                                                        <option <?php if ($r_recipient_country == "Guadeloupe") { echo "selected"; } ?> value="Guadeloupe">Guadeloupe</option>
                                                        <option <?php if ($r_recipient_country == "Guam") { echo "selected"; } ?> value="Guam">Guam</option>
                                                        <option <?php if ($r_recipient_country == "Guatemala") { echo "selected"; } ?> value="Guatemala">Guatemala</option>
                                                        <option <?php if ($r_recipient_country == "Guinea") { echo "selected"; } ?> value="Guinea">Guinea</option>
                                                        <option <?php if ($r_recipient_country == "Guyana") { echo "selected"; } ?> value="Guyana">Guyana</option>
                                                        <option <?php if ($r_recipient_country == "Haiti") { echo "selected"; } ?> value="Haiti">Haiti</option>
                                                        <option <?php if ($r_recipient_country == "Hawaii") { echo "selected"; } ?> value="Hawaii">Hawaii</option>
                                                        <option <?php if ($r_recipient_country == "Honduras") { echo "selected"; } ?> value="Honduras">Honduras</option>
                                                        <option <?php if ($r_recipient_country == "Hong Kong") { echo "selected"; } ?> value="Hong Kong">Hong Kong</option>
                                                        <option <?php if ($r_recipient_country == "Hungary") { echo "selected"; } ?> value="Hungary">Hungary</option>
                                                        <option <?php if ($r_recipient_country == "Iceland") { echo "selected"; } ?> value="Iceland">Iceland</option>
                                                        <option <?php if ($r_recipient_country == "Indonesia") { echo "selected"; } ?> value="Indonesia">Indonesia</option>
                                                        <option <?php if ($r_recipient_country == "India") { echo "selected"; } ?> value="India">India</option>
                                                        <option <?php if ($r_recipient_country == "Iran") { echo "selected"; } ?> value="Iran">Iran</option>
                                                        <option <?php if ($r_recipient_country == "Iraq") { echo "selected"; } ?> value="Iraq">Iraq</option>
                                                        <option <?php if ($r_recipient_country == "Ireland") { echo "selected"; } ?> value="Ireland">Ireland</option>
                                                        <option <?php if ($r_recipient_country == "Isle of Man") { echo "selected"; } ?> value="Isle of Man">Isle of Man</option>
                                                        <option <?php if ($r_recipient_country == "Israel") { echo "selected"; } ?> value="Israel">Israel</option>
                                                        <option <?php if ($r_recipient_country == "Italy") { echo "selected"; } ?> value="Italy">Italy</option>
                                                        <option <?php if ($r_recipient_country == "Jamaica") { echo "selected"; } ?> value="Jamaica">Jamaica</option>
                                                        <option <?php if ($r_recipient_country == "Japan") { echo "selected"; } ?> value="Japan">Japan</option>
                                                        <option <?php if ($r_recipient_country == "Jordan") { echo "selected"; } ?> value="Jordan">Jordan</option>
                                                        <option <?php if ($r_recipient_country == "Kazakhstan") { echo "selected"; } ?> value="Kazakhstan">Kazakhstan</option>
                                                        <option <?php if ($r_recipient_country == "Kenya") { echo "selected"; } ?> value="Kenya">Kenya</option>
                                                        <option <?php if ($r_recipient_country == "Kiribati") { echo "selected"; } ?> value="Kiribati">Kiribati</option>
                                                        <option <?php if ($r_recipient_country == "Korea North") { echo "selected"; } ?> value="Korea North">Korea North</option>
                                                        <option <?php if ($r_recipient_country == "Korea South") { echo "selected"; } ?> value="Korea South">Korea South</option>
                                                        <option <?php if ($r_recipient_country == "Kuwait") { echo "selected"; } ?> value="Kuwait">Kuwait</option>
                                                        <option <?php if ($r_recipient_country == "Kyrgyzstan") { echo "selected"; } ?> value="Kyrgyzstan">Kyrgyzstan</option>
                                                        <option <?php if ($r_recipient_country == "Laos") { echo "selected"; } ?> value="Laos">Laos</option>
                                                        <option <?php if ($r_recipient_country == "Latvia") { echo "selected"; } ?> value="Latvia">Latvia</option>
                                                        <option <?php if ($r_recipient_country == "Lebanon") { echo "selected"; } ?> value="Lebanon">Lebanon</option>
                                                        <option <?php if ($r_recipient_country == "Lesotho") { echo "selected"; } ?> value="Lesotho">Lesotho</option>
                                                        <option <?php if ($r_recipient_country == "Liberia") { echo "selected"; } ?> value="Liberia">Liberia</option>
                                                        <option <?php if ($r_recipient_country == "Libya") { echo "selected"; } ?> value="Libya">Libya</option>
                                                        <option <?php if ($r_recipient_country == "Liechtenstein") { echo "selected"; } ?> value="Liechtenstein">Liechtenstein</option>
                                                        <option <?php if ($r_recipient_country == "Lithuania") { echo "selected"; } ?> value="Lithuania">Lithuania</option>
                                                        <option <?php if ($r_recipient_country == "Luxembourg") { echo "selected"; } ?> value="Luxembourg">Luxembourg</option>
                                                        <option <?php if ($r_recipient_country == "Macau") { echo "selected"; } ?> value="Macau">Macau</option>
                                                        <option <?php if ($r_recipient_country == "Macedonia") { echo "selected"; } ?> value="Macedonia">Macedonia</option>
                                                        <option <?php if ($r_recipient_country == "Madagascar") { echo "selected"; } ?> value="Madagascar">Madagascar</option>
                                                        <option <?php if ($r_recipient_country == "Malaysia") { echo "selected"; } ?> value="Malaysia">Malaysia</option>
                                                        <option <?php if ($r_recipient_country == "Malawi") { echo "selected"; } ?> value="Malawi">Malawi</option>
                                                        <option <?php if ($r_recipient_country == "Maldives") { echo "selected"; } ?> value="Maldives">Maldives</option>
                                                        <option <?php if ($r_recipient_country == "Mali") { echo "selected"; } ?> value="Mali">Mali</option>
                                                        <option <?php if ($r_recipient_country == "Malta") { echo "selected"; } ?> value="Malta">Malta</option>
                                                        <option <?php if ($r_recipient_country == "Marshall Islands") { echo "selected"; } ?> value="Marshall Islands">Marshall Islands</option>
                                                        <option <?php if ($r_recipient_country == "Martinique") { echo "selected"; } ?> value="Martinique">Martinique</option>
                                                        <option <?php if ($r_recipient_country == "Mauritania") { echo "selected"; } ?> value="Mauritania">Mauritania</option>
                                                        <option <?php if ($r_recipient_country == "Mauritius") { echo "selected"; } ?> value="Mauritius">Mauritius</option>
                                                        <option <?php if ($r_recipient_country == "Mayotte") { echo "selected"; } ?> value="Mayotte">Mayotte</option>
                                                        <option <?php if ($r_recipient_country == "Mexico") { echo "selected"; } ?> value="Mexico">Mexico</option>
                                                        <option <?php if ($r_recipient_country == "Midway Islands") { echo "selected"; } ?> value="Midway Islands">Midway Islands</option>
                                                        <option <?php if ($r_recipient_country == "Moldova") { echo "selected"; } ?> value="Moldova">Moldova</option>
                                                        <option <?php if ($r_recipient_country == "Monaco") { echo "selected"; } ?> value="Monaco">Monaco</option>
                                                        <option <?php if ($r_recipient_country == "Mongolia") { echo "selected"; } ?> value="Mongolia">Mongolia</option>
                                                        <option <?php if ($r_recipient_country == "Montserrat") { echo "selected"; } ?> value="Montserrat">Montserrat</option>
                                                        <option <?php if ($r_recipient_country == "Morocco") { echo "selected"; } ?> value="Morocco">Morocco</option>
                                                        <option <?php if ($r_recipient_country == "Mozambique") { echo "selected"; } ?> value="Mozambique">Mozambique</option>
                                                        <option <?php if ($r_recipient_country == "Myanmar") { echo "selected"; } ?> value="Myanmar">Myanmar</option>
                                                        <option <?php if ($r_recipient_country == "Nambia") { echo "selected"; } ?> value="Nambia">Nambia</option>
                                                        <option <?php if ($r_recipient_country == "Nauru") { echo "selected"; } ?> value="Nauru">Nauru</option>
                                                        <option <?php if ($r_recipient_country == "Nepal") { echo "selected"; } ?> value="Nepal">Nepal</option>
                                                        <option <?php if ($r_recipient_country == "Netherland Antilles") { echo "selected"; } ?> value="Netherland Antilles">Netherland Antilles</option>
                                                        <option <?php if ($r_recipient_country == "Netherlands") { echo "selected"; } ?> value="Netherlands">Netherlands (Holland, Europe)</option>
                                                        <option <?php if ($r_recipient_country == "Nevis") { echo "selected"; } ?> value="Nevis">Nevis</option>
                                                        <option <?php if ($r_recipient_country == "New Caledonia") { echo "selected"; } ?> value="New Caledonia">New Caledonia</option>
                                                        <option <?php if ($r_recipient_country == "New Zealand") { echo "selected"; } ?> value="New Zealand">New Zealand</option>
                                                        <option <?php if ($r_recipient_country == "Nicaragua") { echo "selected"; } ?> value="Nicaragua">Nicaragua</option>
                                                        <option <?php if ($r_recipient_country == "Niger") { echo "selected"; } ?> value="Niger">Niger</option>
                                                        <option <?php if ($r_recipient_country == "Nigeria") { echo "selected"; } ?> value="Nigeria">Nigeria</option>
                                                        <option <?php if ($r_recipient_country == "Niue") { echo "selected"; } ?> value="Niue">Niue</option>
                                                        <option <?php if ($r_recipient_country == "Norfolk Island") { echo "selected"; } ?> value="Norfolk Island">Norfolk Island</option>
                                                        <option <?php if ($r_recipient_country == "Norway") { echo "selected"; } ?> value="Norway">Norway</option>
                                                        <option <?php if ($r_recipient_country == "Oman") { echo "selected"; } ?> value="Oman">Oman</option>
                                                        <option <?php if ($r_recipient_country == "Pakistan") { echo "selected"; } ?> value="Pakistan">Pakistan</option>
                                                        <option <?php if ($r_recipient_country == "Palau Island") { echo "selected"; } ?> value="Palau Island">Palau Island</option>
                                                        <option <?php if ($r_recipient_country == "Palestine") { echo "selected"; } ?> value="Palestine">Palestine</option>
                                                        <option <?php if ($r_recipient_country == "Panama") { echo "selected"; } ?> value="Panama">Panama</option>
                                                        <option <?php if ($r_recipient_country == "Papua New Guinea") { echo "selected"; } ?> value="Papua New Guinea">Papua New Guinea</option>
                                                        <option <?php if ($r_recipient_country == "Paraguay") { echo "selected"; } ?> value="Paraguay">Paraguay</option>
                                                        <option <?php if ($r_recipient_country == "Peru") { echo "selected"; } ?> value="Peru">Peru</option>
                                                        <option <?php if ($r_recipient_country == "Phillipines") { echo "selected"; } ?> value="Phillipines">Philippines</option>
                                                        <option <?php if ($r_recipient_country == "Pitcairn Island") { echo "selected"; } ?> value="Pitcairn Island">Pitcairn Island</option>
                                                        <option <?php if ($r_recipient_country == "Poland") { echo "selected"; } ?> value="Poland">Poland</option>
                                                        <option <?php if ($r_recipient_country == "Portugal") { echo "selected"; } ?> value="Portugal">Portugal</option>
                                                        <option <?php if ($r_recipient_country == "Puerto Rico") { echo "selected"; } ?> value="Puerto Rico">Puerto Rico</option>
                                                        <option <?php if ($r_recipient_country == "Qatar") { echo "selected"; } ?> value="Qatar">Qatar</option>
                                                        <option <?php if ($r_recipient_country == "Republic of Montenegro") { echo "selected"; } ?> value="Republic of Montenegro">Republic of Montenegro</option>
                                                        <option <?php if ($r_recipient_country == "Republic of Serbia") { echo "selected"; } ?> value="Republic of Serbia">Republic of Serbia</option>
                                                        <option <?php if ($r_recipient_country == "Reunion") { echo "selected"; } ?> value="Reunion">Reunion</option>
                                                        <option <?php if ($r_recipient_country == "Romania") { echo "selected"; } ?> value="Romania">Romania</option>
                                                        <option <?php if ($r_recipient_country == "Russia") { echo "selected"; } ?> value="Russia">Russia</option>
                                                        <option <?php if ($r_recipient_country == "Rwanda") { echo "selected"; } ?> value="Rwanda">Rwanda</option>
                                                        <option <?php if ($r_recipient_country == "St Barthelemy") { echo "selected"; } ?> value="St Barthelemy">St Barthelemy</option>
                                                        <option <?php if ($r_recipient_country == "St Eustatius") { echo "selected"; } ?> value="St Eustatius">St Eustatius</option>
                                                        <option <?php if ($r_recipient_country == "St Helena") { echo "selected"; } ?> value="St Helena">St Helena</option>
                                                        <option <?php if ($r_recipient_country == "St Kitts-Nevis") { echo "selected"; } ?> value="St Kitts-Nevis">St Kitts-Nevis</option>
                                                        <option <?php if ($r_recipient_country == "St Lucia") { echo "selected"; } ?> value="St Lucia">St Lucia</option>
                                                        <option <?php if ($r_recipient_country == "St Maarten") { echo "selected"; } ?> value="St Maarten">St Maarten</option>
                                                        <option <?php if ($r_recipient_country == "St Pierre & Miquelon") { echo "selected"; } ?> value="St Pierre & Miquelon">St Pierre & Miquelon</option>
                                                        <option <?php if ($r_recipient_country == "St Vincent & Grenadines") { echo "selected"; } ?> value="St Vincent & Grenadines">St Vincent & Grenadines</option>
                                                        <option <?php if ($r_recipient_country == "Saipan") { echo "selected"; } ?> value="Saipan">Saipan</option>
                                                        <option <?php if ($r_recipient_country == "Samoa") { echo "selected"; } ?> value="Samoa">Samoa</option>
                                                        <option <?php if ($r_recipient_country == "Samoa American") { echo "selected"; } ?> value="Samoa American">Samoa American</option>
                                                        <option <?php if ($r_recipient_country == "San Marino") { echo "selected"; } ?> value="San Marino">San Marino</option>
                                                        <option <?php if ($r_recipient_country == "Sao Tome & Principe") { echo "selected"; } ?> value="Sao Tome & Principe">Sao Tome & Principe</option>
                                                        <option <?php if ($r_recipient_country == "Saudi Arabia") { echo "selected"; } ?> value="Saudi Arabia">Saudi Arabia</option>
                                                        <option <?php if ($r_recipient_country == "Senegal") { echo "selected"; } ?> value="Senegal">Senegal</option>
                                                        <option <?php if ($r_recipient_country == "Seychelles") { echo "selected"; } ?> value="Seychelles">Seychelles</option>
                                                        <option <?php if ($r_recipient_country == "Sierra Leone") { echo "selected"; } ?> value="Sierra Leone">Sierra Leone</option>
                                                        <option <?php if ($r_recipient_country == "Singapore") { echo "selected"; } ?> value="Singapore">Singapore</option>
                                                        <option <?php if ($r_recipient_country == "Slovakia") { echo "selected"; } ?> value="Slovakia">Slovakia</option>
                                                        <option <?php if ($r_recipient_country == "Slovenia") { echo "selected"; } ?> value="Slovenia">Slovenia</option>
                                                        <option <?php if ($r_recipient_country == "Solomon Islands") { echo "selected"; } ?> value="Solomon Islands">Solomon Islands</option>
                                                        <option <?php if ($r_recipient_country == "Somalia") { echo "selected"; } ?> value="Somalia">Somalia</option>
                                                        <option <?php if ($r_recipient_country == "South Africa") { echo "selected"; } ?> value="South Africa">South Africa</option>
                                                        <option <?php if ($r_recipient_country == "Spain") { echo "selected"; } ?> value="Spain">Spain</option>
                                                        <option <?php if ($r_recipient_country == "Sri Lanka") { echo "selected"; } ?> value="Sri Lanka">Sri Lanka</option>
                                                        <option <?php if ($r_recipient_country == "Sudan") { echo "selected"; } ?> value="Sudan">Sudan</option>
                                                        <option <?php if ($r_recipient_country == "Suriname") { echo "selected"; } ?> value="Suriname">Suriname</option>
                                                        <option <?php if ($r_recipient_country == "Swaziland") { echo "selected"; } ?> value="Swaziland">Swaziland</option>
                                                        <option <?php if ($r_recipient_country == "Sweden") { echo "selected"; } ?> value="Sweden">Sweden</option>
                                                        <option <?php if ($r_recipient_country == "Switzerland") { echo "selected"; } ?> value="Switzerland">Switzerland</option>
                                                        <option <?php if ($r_recipient_country == "Syria") { echo "selected"; } ?> value="Syria">Syria</option>
                                                        <option <?php if ($r_recipient_country == "Tahiti") { echo "selected"; } ?> value="Tahiti">Tahiti</option>
                                                        <option <?php if ($r_recipient_country == "Taiwan") { echo "selected"; } ?> value="Taiwan">Taiwan</option>
                                                        <option <?php if ($r_recipient_country == "Tajikistan") { echo "selected"; } ?> value="Tajikistan">Tajikistan</option>
                                                        <option <?php if ($r_recipient_country == "Tanzania") { echo "selected"; } ?> value="Tanzania">Tanzania</option>
                                                        <option <?php if ($r_recipient_country == "Thailand") { echo "selected"; } ?> value="Thailand">Thailand</option>
                                                        <option <?php if ($r_recipient_country == "Togo") { echo "selected"; } ?> value="Togo">Togo</option>
                                                        <option <?php if ($r_recipient_country == "Tokelau") { echo "selected"; } ?> value="Tokelau">Tokelau</option>
                                                        <option <?php if ($r_recipient_country == "Tonga") { echo "selected"; } ?> value="Tonga">Tonga</option>
                                                        <option <?php if ($r_recipient_country == "Trinidad & Tobago") { echo "selected"; } ?> value="Trinidad & Tobago">Trinidad & Tobago</option>
                                                        <option <?php if ($r_recipient_country == "Tunisia") { echo "selected"; } ?> value="Tunisia">Tunisia</option>
                                                        <option <?php if ($r_recipient_country == "Turkey") { echo "selected"; } ?> value="Turkey">Turkey</option>
                                                        <option <?php if ($r_recipient_country == "Turkmenistan") { echo "selected"; } ?> value="Turkmenistan">Turkmenistan</option>
                                                        <option <?php if ($r_recipient_country == "Turks & Caicos Is") { echo "selected"; } ?> value="Turks & Caicos Is">Turks & Caicos Is</option>
                                                        <option <?php if ($r_recipient_country == "Tuvalu") { echo "selected"; } ?> value="Tuvalu">Tuvalu</option>
                                                        <option <?php if ($r_recipient_country == "Uganda") { echo "selected"; } ?> value="Uganda">Uganda</option>
                                                        <option <?php if ($r_recipient_country == "United Kingdom") { echo "selected"; } ?> value="United Kingdom">United Kingdom</option>
                                                        <option <?php if ($r_recipient_country == "Ukraine") { echo "selected"; } ?> value="Ukraine">Ukraine</option>
                                                        <option <?php if ($r_recipient_country == "United Arab Erimates") { echo "selected"; } ?> value="United Arab Erimates">United Arab Emirates</option>
                                                        <option <?php if ($r_recipient_country == "United States of America") { echo "selected"; } ?> value="United States of America">United States of America</option>
                                                        <option <?php if ($r_recipient_country == "Uraguay") { echo "selected"; } ?> value="Uraguay">Uruguay</option>
                                                        <option <?php if ($r_recipient_country == "Uzbekistan") { echo "selected"; } ?> value="Uzbekistan">Uzbekistan</option>
                                                        <option <?php if ($r_recipient_country == "Vanuatu") { echo "selected"; } ?> value="Vanuatu">Vanuatu</option>
                                                        <option <?php if ($r_recipient_country == "Vatican City State") { echo "selected"; } ?> value="Vatican City State">Vatican City State</option>
                                                        <option <?php if ($r_recipient_country == "Venezuela") { echo "selected"; } ?> value="Venezuela">Venezuela</option>
                                                        <option <?php if ($r_recipient_country == "Vietnam") { echo "selected"; } ?> value="Vietnam">Vietnam</option>
                                                        <option <?php if ($r_recipient_country == "Virgin Islands (Brit)") { echo "selected"; } ?> value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
                                                        <option <?php if ($r_recipient_country == "Virgin Islands (USA)") { echo "selected"; } ?> value="Virgin Islands (USA)">Virgin Islands (USA)</option>
                                                        <option <?php if ($r_recipient_country == "Wake Island") { echo "selected"; } ?> value="Wake Island">Wake Island</option>
                                                        <option <?php if ($r_recipient_country == "Wallis & Futana Is") { echo "selected"; } ?> value="Wallis & Futana Is">Wallis & Futana Is</option>
                                                        <option <?php if ($r_recipient_country == "Yemen") { echo "selected"; } ?> value="Yemen">Yemen</option>
                                                        <option <?php if ($r_recipient_country == "Zaire") { echo "selected"; } ?> value="Zaire">Zaire</option>
                                                        <option <?php if ($r_recipient_country == "Zambia") { echo "selected"; } ?> value="Zambia">Zambia</option>
                                                        <option <?php if ($r_recipient_country == "Zimbabwe") { echo "selected"; } ?> value="Zimbabwe">Zimbabwe</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="recipient_email" class="col-md-3 label-control">Recipient Email</label>
                                                <div class="col-md-9">
                                                    <input type="email" id="recipient_email" class="form-control" placeholder="Enter Recipient Email" value="<?php echo $r_recipient_email; ?>" name="recipient_email" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="amount" class="col-md-3 label-control">Amount</label>
                                                <div class="col-md-9">
                                                    <div class="input-group mt-0">
                                                        <input type="number" class="form-control" value="<?php echo $r_amount; ?>" name="amount" required>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">.00</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="currency" class="col-md-3 label-control">Currency</label>
                                                <div class="col-md-9">
                                                    <select id="currency" name="currency" class="select2 form-control" required>
                                                        <option <?php if ($r_currency == "aed") { echo "selected"; } ?> value="aed">AED</option>
                                                        <option <?php if ($r_currency == "ars") { echo "selected"; } ?> value="ars">ARS</option>
                                                        <option <?php if ($r_currency == "aud") { echo "selected"; } ?> value="aud">AUD</option>
                                                        <option <?php if ($r_currency == "bdt") { echo "selected"; } ?> value="bdt">BDT</option>
                                                        <option <?php if ($r_currency == "bgn") { echo "selected"; } ?> value="bgn">BGN</option>
                                                        <option <?php if ($r_currency == "brl") { echo "selected"; } ?> value="brl">BRL</option>
                                                        <option <?php if ($r_currency == "cad") { echo "selected"; } ?> value="cad">CAD</option>
                                                        <option <?php if ($r_currency == "chf") { echo "selected"; } ?> value="chf">CHF</option>
                                                        <option <?php if ($r_currency == "clp") { echo "selected"; } ?> value="clp">CLP</option>
                                                        <option <?php if ($r_currency == "cny") { echo "selected"; } ?> value="cny">CNY</option>
                                                        <option <?php if ($r_currency == "czk") { echo "selected"; } ?> value="czk">CZK</option>
                                                        <option <?php if ($r_currency == "dkk") { echo "selected"; } ?> value="dkk">DKK</option>
                                                        <option <?php if ($r_currency == "egp") { echo "selected"; } ?> value="egp">EGP</option>
                                                        <option <?php if ($r_currency == "eur") { echo "selected"; } ?> value="eur">EUR</option>
                                                        <option <?php if ($r_currency == "gbp") { echo "selected"; } ?> value="gbp">GBP</option>
                                                        <option <?php if ($r_currency == "gel") { echo "selected"; } ?> value="gel">GEL</option>
                                                        <option <?php if ($r_currency == "ghs") { echo "selected"; } ?> value="ghs">GHS</option>
                                                        <option <?php if ($r_currency == "hkd") { echo "selected"; } ?> value="hkd">HKD</option>
                                                        <option <?php if ($r_currency == "hrk") { echo "selected"; } ?> value="hrk">HRK</option>
                                                        <option <?php if ($r_currency == "huf") { echo "selected"; } ?> value="huf">HUF</option>
                                                        <option <?php if ($r_currency == "idr") { echo "selected"; } ?> value="idr">IDR</option>
                                                        <option <?php if ($r_currency == "ils") { echo "selected"; } ?> value="ils">ILS</option>
                                                        <option <?php if ($r_currency == "inr") { echo "selected"; } ?> value="inr">INR</option>
                                                        <option <?php if ($r_currency == "jpy") { echo "selected"; } ?> value="jpy">JPY</option>
                                                        <option <?php if ($r_currency == "kes") { echo "selected"; } ?> value="kes">KES</option>
                                                        <option <?php if ($r_currency == "krw") { echo "selected"; } ?> value="krw">KRW</option>
                                                        <option <?php if ($r_currency == "lkr") { echo "selected"; } ?> value="lkr">LKR</option>
                                                        <option <?php if ($r_currency == "mad") { echo "selected"; } ?> value="mad">MAD</option>
                                                        <option <?php if ($r_currency == "mxn") { echo "selected"; } ?> value="mxn">MXN</option>
                                                        <option <?php if ($r_currency == "myr") { echo "selected"; } ?> value="myr">MYR</option>
                                                        <option <?php if ($r_currency == "ngn") { echo "selected"; } ?> value="ngn">NGN</option>
                                                        <option <?php if ($r_currency == "nok") { echo "selected"; } ?> value="nok">NOK</option>
                                                        <option <?php if ($r_currency == "npr") { echo "selected"; } ?> value="npr">NPR</option>
                                                        <option <?php if ($r_currency == "nzd") { echo "selected"; } ?> value="nzd">NZD</option>
                                                        <option <?php if ($r_currency == "pen") { echo "selected"; } ?> value="pen">PEN</option>
                                                        <option <?php if ($r_currency == "php") { echo "selected"; } ?> value="php">PHP</option>
                                                        <option <?php if ($r_currency == "pkr") { echo "selected"; } ?> value="pkr">PKR</option>
                                                        <option <?php if ($r_currency == "pln") { echo "selected"; } ?> value="pln">PLN</option>
                                                        <option <?php if ($r_currency == "ron") { echo "selected"; } ?> value="ron">RON</option>
                                                        <option <?php if ($r_currency == "rub") { echo "selected"; } ?> value="rub">RUB</option>
                                                        <option <?php if ($r_currency == "sek") { echo "selected"; } ?> value="sek">SEK</option>
                                                        <option <?php if ($r_currency == "sgd") { echo "selected"; } ?> value="sgd">SGD</option>
                                                        <option <?php if ($r_currency == "thb") { echo "selected"; } ?> value="thb">THB</option>
                                                        <option <?php if ($r_currency == "try") { echo "selected"; } ?> value="try">TRY</option>
                                                        <option <?php if ($r_currency == "uah") { echo "selected"; } ?> value="uah">UAH</option>
                                                        <option <?php if ($r_currency == "ugx") { echo "selected"; } ?> value="ugx">UGX</option>
                                                        <option <?php if ($r_currency == "usd") { echo "selected"; } ?> value="usd">USD</option>
                                                        <option <?php if ($r_currency == "vnd") { echo "selected"; } ?> value="vnd">VND</option>
                                                        <option <?php if ($r_currency == "zar") { echo "selected"; } ?> value="zar">ZAR</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="due_date" class="col-md-3 label-control">Payment Due</label>
                                                <div class="col-md-9">
                                                    <input type="date" id="new_payment_date" class="form-control" name="new_payment_date">
                                                    <input type="hidden" id="old_payment_date" class="form-control" value="<?php echo $r_payment_due; ?>" name="old_payment_date">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="narration" class="col-md-3 label-control">Description</label>
                                                <div class="col-md-9">
                                                    <textarea id="narration" rows="6" class="form-control square" name="narration" placeholder="Reason for payment" required><?php echo $r_narration; ?></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="request_date" class="col-md-3 label-control">Request Date</label>
                                                <div class="col-md-9">
                                                    <input type="datetime-local" id="new_request_date" class="form-control" name="new_request_date">
                                                    <input type="hidden" id="old_request_date" class="form-control" value="<?php echo $r_created_at; ?>" name="old_request_date">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions center">
                                            <button type="submit" class="btn btn-success" name="update_request">Update Request</button>
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

    if (isset($_POST["update_request"])) 
    {
        $id = mysqli_real_escape_string($link, $_POST["id"]);
        $trnx_id = mysqli_real_escape_string($link, $_POST["trnx_id"]);
        $payer = mysqli_real_escape_string($link, $_POST["payer"]);
        $recipient = mysqli_real_escape_string($link, $_POST["recipient"]);
        $recipient_country = mysqli_real_escape_string($link, $_POST["recipient_country"]);
        $recipient_email = mysqli_real_escape_string($link, $_POST["recipient_email"]);
        $amount = mysqli_real_escape_string($link, $_POST["amount"]);
        $currency = mysqli_real_escape_string($link, $_POST["currency"]);
        $narration = mysqli_real_escape_string($link, $_POST["narration"]);
        $request_date = $payment_date = "";
        $log = get_date();

        // Check if the new date is empty.
        if (empty($_POST["new_payment_date"])) { $payment_date = mysqli_real_escape_string($link, $_POST["old_payment_date"]); }
        else { $payment_date = mysqli_real_escape_string($link, $_POST["new_payment_date"]); }

        // Check if the new date is empty.
        if (empty($_POST["new_request_date"])) { $request_date = mysqli_real_escape_string($link, $_POST["old_request_date"]); }
        else { $request_date = mysqli_real_escape_string($link, $_POST["new_request_date"]); }

        if (empty($payer)) {
            $_SESSION["error"] = "Please select a payer.";
        }
        elseif (empty($recipient)) {
            $_SESSION["error"] = "Please fill out the recipient name.";
        }
        elseif (empty($recipient_country)) {
            $_SESSION["error"] = "Please select the recipient country.";
        }
        elseif (empty($recipient_email)) {
            $_SESSION["error"] = "Please fill out the recipient email.";
        }
        elseif (empty($amount)) {
            $_SESSION["error"] = "Please fill out the amount.";
        }
        elseif (empty($currency)) {
            $_SESSION["error"] = "Please select a currency.";
        }
        elseif (empty($narration)) {
            $_SESSION["error"] = "Please fill in the narration.";
        }
        else {
            // Update the transaction log for this deposit using the transaction ID.
            $transaction_statement = "UPDATE `transactions` SET `user_id`='$payer', `amount`='$amount', `currency`='$currency', ".
                                     "`description`='$narration', `created_at`='$request_date', `updated_at`='$log' WHERE `trnx_id`='$trnx_id'";
            $update_transaction = mysqli_query($link, $transaction_statement);

            // Update the requests table with the new passed values.
            $request_statement = "UPDATE `requests` SET `user_id`='$payer', `recipient`='$recipient', `recipient_country`='$recipient_country', `recipient_email`='$recipient_email', ".
                                 "`amount`='$amount', `currency`='$currency', `payment_due`='$payment_date', `narration`='$narration', `created_at`='$request_date', `updated_at`='$log' WHERE `id`='$id'";
            $update_request = mysqli_query($link, $request_statement);

            // Confirm if all transactions was successful
            if ($update_request && $update_transaction) {
                $_SESSION["success"] = "Request record updated successfully.";
                relocate_url("requests.php"); 
            } 
            else {
                $_SESSION["error"] = "unable to update request record";
            }
        }
    }
    mysqli_close($link);
?>  