   <?php $this->load->view('assests/header'); ?>
 
    <?php $this->load->view('assests/sidebar'); ?>

   
<style>
         .input-group-prepend {
    margin-right: -47px;
    z-index: 9999;
}
.content-body{
    padding-top:90px;
}
.form-control {
    display: block;
    width: 50% !important; 
    }
</style>
<h3>
       <?php if(isset($media_detail)) {?>
           
       <?php }else { ?>
          
        <?php } ?>
        
    </h3>
<?php

        if($this->session->flashdata('item')) {
           $message = $this->session->flashdata('item');
        ?>
           <div class="<?php echo $message['class'] ?>"><?php echo $message['message']; ?>

           </div>
           <?php
         }

          ?>

    <div class="content-body">

          
            <!-- row -->

            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Add / Update Coach</h4>
                                <div class="basic-form">
                                    <form class="form-horizontal" id="RegisterValidation" action="<?= base_url(); ?>Mailtocoach/Apply" method="POST" onSubmit = "return checkPassword(this)" enctype="multipart/form-data"> 
                                        
                                        <input type="hidden" name="usertype" value="teacher" /> 
                                        
                                         <label>Category</label>
                                        <div class="form-group">
                                        
                                        <select  name="subcat_id" class="form-control" id="catgry" required>
                                        
                                        <option value="">----Select Category----</option>
                                        <?php foreach ($getgigcats as $row) {
                                        
                                        if($media_detail->subcat_id == $row->subcat_id){ ?>
                                        <option selected value="<?php echo $row->subcat_id; ?>" >
                                        <?php echo $row->category_name; ?>
                                        </option>
                                        <?php }else{ ?>
                                        <option value="<?php echo $row->subcat_id; ?>" >
                                        <?php echo $row->category_name; ?>
                                        </option>
                                        <?php }
                                        ?>
                                        <?php } ?>                                  
                                        
                                        </select>
                                        
                                        </div>
                                        
                                        
                                        
                                        <label>Sub Category</label>
  <div class="form-group">
   <select name="subcatname" id="subcategory" class="form-control">
    <option value="">----Select Sub Category---- </option>
   </select>
  </div>
                                        
                                        <label>Coach Name</label>
                                        <div class="form-group">
                                            
                                            <input type="text" name="username" value="<?php if(isset($media_detail)){ print_r($media_detail->username); } ?>" class="form-control input-default" placeholder="Coach Name" required >
                                        </div>
                                        
                                        <label>Coach Email</label>
                                        <div class="form-group">
                                            <span id="error" style="display:none;color:red;">Invalid email</span>
                                            <input type="email" id="email_address" name="email"  value="<?php if(isset($media_detail)){ print_r($media_detail->email); } ?>" class="form-control input-flat" placeholder="Coach Email" required>
                                        </div>
                                        
                                        <label>Address</label>
                                        <div class="form-group">
                                            <input type="text" name="address" value="<?php if(isset($media_detail)){ print_r($media_detail->address); } ?>" class="form-control input-flat" placeholder="Address" required>
                                        </div>
                                        
                                        <label>Country Code</label>
                                        <div class="form-group">
                                        
                                        <select  name="country_code" class="form-control" id="country_code" required>
                                        
                                        <option value="">----Select Country Code----</option>
                                        <?php foreach ($getcountry as $row) {
                                        
                                        if($media_detail->country_code == $row->country_code){ ?>
                                        <option selected value="<?php echo $row->country_code; ?>" >
                                        <?php echo $row->country_code; ?>
                                        </option>
                                        <?php }else{ ?>
                                        <option value="<?php echo $row->country_code; ?>" >
                                        <?php echo $row->country_code; ?>
                                        </option>
                                        <?php }
                                        ?>
                                        <?php } ?>                                  
                                        
                                        </select>
                                        
                                        </div>
                                        
                                        <!--<label>Select Country Code</label>
                                        <div class="form-control">
                                            <select id="" class="" name="country_code" required="required" tabindex="50">
<option data-countryCode="#" value="#">----Select Country Code----</option>
<option data-countryCode="AF" value="Afghanistan (+93)">Afghanistan (+93)</option>
<option data-countryCode="AL" value="Albania (+355)">Albania (+355)</option>
<option data-countryCode="DZ" value="Algeria (+213)">Algeria (+213)</option>
<option data-countryCode="AD" value="Andorra (+376)">Andorra (+376)</option>
<option data-countryCode="AO" value="Angola (+244)">Angola (+244)</option>
<option data-countryCode="AI" value="Anguilla (+1264)">Anguilla (+1264)</option>
<option data-countryCode="AG" value="Antigua and Barbuda (+1268)">Antigua &amp; Barbuda (+1268)</option>
<option data-countryCode="AR" value="Argentina (+54)">Argentina (+54)</option>
<option data-countryCode="AM" value="Armenia (+374)">Armenia (+374)</option>
<option data-countryCode="AW" value="Aruba (+297)">Aruba (+297)</option>
<option data-countryCode="AU" value="Australia (+61)">Australia (+61)</option>
<option data-countryCode="AT" value="Austria (+43)">Austria (+43)</option>
<option data-countryCode="AZ" value="Azerbaijan (+994)">Azerbaijan (+994)</option>
<option data-countryCode="BS" value="Bahamas (+1242)">Bahamas (+1242)</option>
<option data-countryCode="BH" value="Bahrain (+973)">Bahrain (+973)</option>
<option data-countryCode="BD" value="Bangladesh (+880)">Bangladesh (+880)</option>
<option data-countryCode="BB" value="Barbados (+1246)">Barbados (+1246)</option>
<option data-countryCode="BY" value="Belarus (+375)">Belarus (+375)</option>
<option data-countryCode="BE" value="Belgium (+32)">Belgium (+32)</option>
<option data-countryCode="BZ" value="Belize (+501)">Belize (+501)</option>
<option data-countryCode="BJ" value="Benin (+229)">Benin (+229)</option>
<option data-countryCode="BM" value="Bermuda (+1441)">Bermuda (+1441)</option>
<option data-countryCode="BT" value="Bhutan (+975)">Bhutan (+975)</option>
<option data-countryCode="BO" value="Bolivia (+591)">Bolivia (+591)</option>
<option data-countryCode="BA" value="Bosnia Herzegovina (+387)">Bosnia Herzegovina (+387)</option>
<option data-countryCode="BW" value="Botswana (+267)">Botswana (+267)</option>
<option data-countryCode="BR" value="razil (+55)">Brazil (+55)</option>
<option data-countryCode="BN" value="Brunei (+673)">Brunei (+673)</option>
<option data-countryCode="BG" value="Bulgaria (+359)">Bulgaria (+359)</option>
<option data-countryCode="BF" value="Burkina Faso (+226)">Burkina Faso (+226)</option>
<option data-countryCode="BI" value="Burundi (+257)">Burundi (+257)</option>
<option data-countryCode="KH" value="Cambodia (+855)">Cambodia (+855)</option>
<option data-countryCode="CM" value="Cameroon (+237)">Cameroon (+237)</option>
<option data-countryCode="CA" value="Canada (+1)">Canada (+1)</option>
<option data-countryCode="CV" value="Cape Verde Islands (+238)">Cape Verde Islands (+238)</option>
<option data-countryCode="KY" value="Cayman Islands (+1345)">Cayman Islands (+1345)</option>
<option data-countryCode="CF" value="Central African Republic (+236)">Central African Republic (+236)</option>
<option data-countryCode="CL" value="Chile (+56)">Chile (+56)</option>
<option data-countryCode="CN" value="China (+86)">China (+86)</option>
<option data-countryCode="CO" value="Colombia (+57)">Colombia (+57)</option>
<option data-countryCode="KM" value="Comoros (+269)">Comoros (+269)</option>
<option data-countryCode="CG" value="Congo (+242)">Congo (+242)</option>
<option data-countryCode="CK" value="Cook Islands (+682)">Cook Islands (+682)</option>
<option data-countryCode="CR" value="Costa Rica (+506)">Costa Rica (+506)</option>
<option data-countryCode="HR" value="Croatia (+385)">Croatia (+385)</option>
<option data-countryCode="CU" value="Cuba (+53)">Cuba (+53)</option>
<option data-countryCode="CY" value="Cyprus North (+90392)">Cyprus North (+90392)</option>
<option data-countryCode="CY" value="Cyprus South (+357)">Cyprus South (+357)</option>
<option data-countryCode="CZ" value="Czech Republic (+42)">Czech Republic (+42)</option>
<option data-countryCode="DK" value="Denmark (+45)">Denmark (+45)</option>
<option data-countryCode="DJ" value="Djibouti (+253)">Djibouti (+253)</option>
<option data-countryCode="DM" value="Dominica (+1809)">Dominica (+1809)</option>
<option data-countryCode="DO" value="Dominican Republic (+1809)">Dominican Republic (+1809)</option>
<option data-countryCode="EC" value="Ecuador (+593)">Ecuador (+593)</option>
<option data-countryCode="EG" value="Egypt (+20)">Egypt (+20)</option>
<option data-countryCode="SV" value="El Salvador (+503)">El Salvador (+503)</option>
<option data-countryCode="GQ" value="Equatorial Guinea (+240)">Equatorial Guinea (+240)</option>
<option data-countryCode="ER" value="Eritrea (+291)">Eritrea (+291)</option>
<option data-countryCode="EE" value="Estonia (+372)">Estonia (+372)</option>
<option data-countryCode="ET" value="Ethiopia (+251)">Ethiopia (+251)</option>
<option data-countryCode="FK" value="Falkland Islands (+500)">Falkland Islands (+500)</option>
<option data-countryCode="FO" value="Faroe Islands (+298)">Faroe Islands (+298)</option>
<option data-countryCode="FJ" value="Fiji (+679)">Fiji (+679)</option>
<option data-countryCode="FI" value="Finland (+358)">Finland (+358)</option>
<option data-countryCode="FR" value="France (+33)">France (+33)</option>
<option data-countryCode="GF" value="French Guiana (+594)">French Guiana (+594)</option>
<option data-countryCode="PF" value="French Polynesia (+689)">French Polynesia (+689)</option>
<option data-countryCode="GA" value="Gabon (+241)">Gabon (+241)</option>
<option data-countryCode="GM" value="Gambia (+220)">Gambia (+220)</option>
<option data-countryCode="GE" value="Georgia (+7880)">Georgia (+7880)</option>
<option data-countryCode="DE" value="Germany (+49)">Germany (+49)</option>
<option data-countryCode="GH" value="Ghana (+233)">Ghana (+233)</option>
<option data-countryCode="GI" value="Gibraltar (+350)">Gibraltar (+350)</option>
<option data-countryCode="GR" value="Greece (+30)">Greece (+30)</option>
<option data-countryCode="GL" value="Greenland (+299)">Greenland (+299)</option>
<option data-countryCode="GD" value="Grenada (+1473)">Grenada (+1473)</option>
<option data-countryCode="GP" value="Guadeloupe (+590)">Guadeloupe (+590)</option>
<option data-countryCode="GU" value="Guam (+671)">Guam (+671)</option>
<option data-countryCode="GT" value="Guatemala (+502)">Guatemala (+502)</option>
<option data-countryCode="GN" value="Guinea (+224)">Guinea (+224)</option>
<option data-countryCode="GW" value="Guinea - Bissau (+245)">Guinea - Bissau (+245)</option>
<option data-countryCode="GY" value="Guinea - Bissau (+245)">Guinea - Bissau (+245)</option>
<option data-countryCode="HT" value="Haiti (+509)">Haiti (+509)</option>
<option data-countryCode="HN" value="Honduras (+504)">Honduras (+504)</option>
<option data-countryCode="HK" value="Hong Kong (+852)">Hong Kong (+852)</option>
<option data-countryCode="HU" value="Hungary (+36)">Hungary (+36)</option>
<option data-countryCode="IS" value="Iceland (+354)">Iceland (+354)</option>
<option data-countryCode="IN" value="India (+91)">India (+91)</option>
<option data-countryCode="ID" value="Indonesia (+62)">Indonesia (+62)</option>
<option data-countryCode="IR" value="Iran (+98)">Iran (+98)</option>
<option data-countryCode="IQ" value="Iraq (+964)">Iraq (+964)</option>
<option data-countryCode="IE" value="Ireland (+353)">Ireland (+353)</option>
<option data-countryCode="IL" value="Israel (+972)">Israel (+972)</option>
<option data-countryCode="IT" value="Italy (+39)">Italy (+39)</option>
<option data-countryCode="JM" value="Jamaica (+1876)">Jamaica (+1876)</option>
<option data-countryCode="JP" value="Japan (+81)">Japan (+81)</option>
<option data-countryCode="JO" value="Jordan (+962)">Jordan (+962)</option>
<option data-countryCode="KZ" value="Kazakhstan (+7)">Kazakhstan (+7)</option>
<option data-countryCode="KE" value="Kenya (+254)">Kenya (+254)</option>
<option data-countryCode="KI" value="Kiribati (+686)">Kiribati (+686)</option>
<option data-countryCode="KP" value="Korea North (+850)">Korea North (+850)</option>
<option data-countryCode="KR" value="Korea South (+82)">Korea South (+82)</option>
<option data-countryCode="KW" value="Kuwait (+965)">Kuwait (+965)</option>
<option data-countryCode="KG" value="Kyrgyzstan (+996)">Kyrgyzstan (+996)</option>
<option data-countryCode="LA" value="Laos (+856)">Laos (+856)</option>
<option data-countryCode="LV" value="Latvia (+371)">Latvia (+371)</option>
<option data-countryCode="LB" value="Lebanon (+961)">Lebanon (+961)</option>
<option data-countryCode="LS" value="Lesotho (+266)">Lesotho (+266)</option>
<option data-countryCode="LR" value="Liberia (+231)">Liberia (+231)</option>
<option data-countryCode="LY" value="Libya (+218)">Libya (+218)</option>
<option data-countryCode="LI" value="Liechtenstein (+417)">Liechtenstein (+417)</option>
<option data-countryCode="LT" value="Lithuania (+370)">Lithuania (+370)</option>
<option data-countryCode="LU" value="Luxembourg (+352)">Luxembourg (+352)</option>
<option data-countryCode="MO" value="Macao (+853)">Macao (+853)</option>
<option data-countryCode="MK" value="Macedonia (+389)">Macedonia (+389)</option>
<option data-countryCode="MG" value="Madagascar (+261)">Madagascar (+261)</option>
<option data-countryCode="MW" value="Malawi (+265)">Malawi (+265)</option>
<option data-countryCode="MY" value="Malaysia (+60)">Malaysia (+60)</option>
<option data-countryCode="MV" value="Maldives (+960)">Maldives (+960)</option>
<option data-countryCode="ML" value="Mali (+223)">Mali (+223)</option>
<option data-countryCode="MT" value="Malta (+356)">Malta (+356)</option>
<option data-countryCode="MH" value="Marshall Islands (+692)">Marshall Islands (+692)</option>
<option data-countryCode="MQ" value="Martinique (+596)">Martinique (+596)</option>
<option data-countryCode="MR" value="Mauritania (+222)">Mauritania (+222)</option>
 <option data-countryCode="YT" value="Mayotte (+269)">Mayotte (+269)</option>
<option data-countryCode="MX" value="Mexico (+52)">Mexico (+52)</option>
<option data-countryCode="FM" value="Micronesia (+691)">Micronesia (+691)</option>
<option data-countryCode="MD" value="Moldova (+373)">Moldova (+373)</option>
<option data-countryCode="MC" value="Monaco (+377)">Monaco (+377)</option>
<option data-countryCode="MN" value="Mongolia (+976)">Mongolia (+976)</option>
<option data-countryCode="MS" value="Montserrat (+1664)">Montserrat (+1664)</option>
<option data-countryCode="MA" value="Morocco (+212)">Morocco (+212)</option>
<option data-countryCode="MZ" value="Mozambique (+258)">Mozambique (+258)</option>
<option data-countryCode="MN" value="Myanmar (+95)">Myanmar (+95)</option>
<option data-countryCode="NA" value="Namibia (+264)">Namibia (+264)</option>
<option data-countryCode="NR" value="Nauru (+674)">Nauru (+674)</option>
<option data-countryCode="NP" value="Nepal (+977)">Nepal (+977)</option>
<option data-countryCode="NL" value="Netherlands (+31)">Netherlands (+31)</option>
<option data-countryCode="NC" value="New Caledonia (+687)">New Caledonia (+687)</option>
<option data-countryCode="NZ" value="New Zealand (+64)">New Zealand (+64)</option>
<option data-countryCode="NI" value="Nicaragua (+505)">Nicaragua (+505)</option>
<option data-countryCode="NE" value="Niger (+227)">Niger (+227)</option>
<option data-countryCode="NG" value="Nigeria (+234)">Nigeria (+234)</option>
<option data-countryCode="NU" value="Niue (+683)">Niue (+683)</option>
<option data-countryCode="NF" value="Norfolk Islands (+672)">Norfolk Islands (+672)</option>
<option data-countryCode="NP" value="Northern Marianas (+670)">Northern Marianas (+670)</option>
<option data-countryCode="NO" value="Norway (+47)">Norway (+47)</option>
<option data-countryCode="OM" value="Oman (+968)">Oman (+968)</option>
<option data-countryCode="PW" value="Palau (+680)">Palau (+680)</option>
<option data-countryCode="PA" value="Panama (+507)">Panama (+507)</option>
<option data-countryCode="PG" value="Papua New Guinea (+675)">Papua New Guinea (+675)</option>
<option data-countryCode="PY" value="Paraguay (+595)">Paraguay (+595)</option>
<option data-countryCode="PE" value="Peru (+51)">Peru (+51)</option>
<option data-countryCode="PH" value="Philippines (+63)">Philippines (+63)</option>
<option data-countryCode="PL" value="Poland (+48)">Poland (+48)</option>
<option data-countryCode="PT" value="Portugal (+351)">Portugal (+351)</option>
<option data-countryCode="PR" value="Puerto Rico (+1787)">Puerto Rico (+1787)</option>
<option data-countryCode="QA" value="Qatar (+974)">Qatar (+974)</option>
<option data-countryCode="RE" value="Reunion (+262)">Reunion (+262)</option>
<option data-countryCode="RO" value="Romania (+40)">Romania (+40)</option>
<option data-countryCode="RU" value="Russia (+7)">Russia (+7)</option>
<option data-countryCode="RW" value="Rwanda (+250)">Rwanda (+250)</option>
<option data-countryCode="SM" value="San Marino (+378)">San Marino (+378)</option>
<option data-countryCode="ST" value="Sao Tome and Principe (+239)">Sao Tome &amp; Principe (+239)</option>
<option data-countryCode="SA" value="Saudi Arabia (+966)">Saudi Arabia (+966)</option>
<option data-countryCode="SN" value="Senegal (+221)">Senegal (+221)</option>
<option data-countryCode="CS" value="Serbia (+381)">Serbia (+381)</option>
<option data-countryCode="SC" value="Seychelles (+248)">Seychelles (+248)</option>
<option data-countryCode="SL" value="Sierra Leone (+232)">Sierra Leone (+232)</option>
<option data-countryCode="SG" value="Singapore (+65)">Singapore (+65)</option>
<option data-countryCode="SK" value="Slovak Republic (+421)">Slovak Republic (+421)</option>
<option data-countryCode="SI" value="Slovenia (+386)">Slovenia (+386)</option>
<option data-countryCode="SB" value="Solomon Islands (+677)">Solomon Islands (+677)</option>
<option data-countryCode="SO" value="Somalia (+252)">Somalia (+252)</option>
<option data-countryCode="ZA" value="South Africa (+27)">South Africa (+27)</option>
 <option data-countryCode="ES" value="Spain (+34)">Spain (+34)</option>
<option data-countryCode="LK" value="Sri Lanka (+94)">Sri Lanka (+94)</option>
<option data-countryCode="SH" value="St. Helena (+290)">St. Helena (+290)</option>
<option data-countryCode="KN" value="St. Kitts (+1869)">St. Kitts (+1869)</option>
<option data-countryCode="SC" value="St. Lucia (+1758)">St. Lucia (+1758)</option>
<option data-countryCode="SD" value="Sudan (+249)">Sudan (+249)</option>
<option data-countryCode="SR" value="Suriname (+597)">Suriname (+597)</option>
<option data-countryCode="SZ" value="Swaziland (+268)">Swaziland (+268)</option>
<option data-countryCode="SE" value="Sweden (+46)">Sweden (+46)</option>
<option data-countryCode="CH" value="Switzerland (+41)">Switzerland (+41)</option>
<option data-countryCode="SI" value="Syria (+963)">Syria (+963)</option>
<option data-countryCode="TW" value="Taiwan (+886)">Taiwan (+886)</option>
<option data-countryCode="TJ" value="Tajikstan (+7)">Tajikstan (+7)</option>
<option data-countryCode="TH" value="Thailand (+66)">Thailand (+66)</option>
<option data-countryCode="TG" value="Togo (+228)">Togo (+228)</option>
<option data-countryCode="TO" value="Tonga (+676)">Tonga (+676)</option>
<option data-countryCode="TT" value="Trinidad and Tobago (+1868)">Trinidad &amp; Tobago (+1868)</option>
<option data-countryCode="TN" value="Tunisia (+216)">Tunisia (+216)</option>
<option data-countryCode="TR" value="Turkey (+90)">Turkey (+90)</option>
<option data-countryCode="TM" value="Turkmenistan (+7)">Turkmenistan (+7)</option>
<option data-countryCode="TM" value="Turkmenistan (+993)">Turkmenistan (+993)</option>
<option data-countryCode="TC" value="Turks and Caicos Islands (+1649)">Turks &amp; Caicos Islands (+1649)</option>
<option data-countryCode="TV" value="Tuvalu (+688)">Tuvalu (+688)</option>
<option data-countryCode="UG" value="Uganda (+256)">Uganda (+256)</option>
<option data-countryCode="GB" value="UK (+44)">UK (+44)</option>
<option data-countryCode="UA" value="Ukraine (+380)">Ukraine (+380)</option>
<option data-countryCode="AE" value="United Arab Emirates (+971)">United Arab Emirates (+971)</option>
<option data-countryCode="UY" value="Uruguay (+598)">Uruguay (+598)</option>
<option data-countryCode="US" value="USA (+1)">USA (+1)</option>
<option data-countryCode="UZ" value="Uzbekistan (+7)">Uzbekistan (+7)</option>
<option data-countryCode="VU" value="Vanuatu (+678)">Vanuatu (+678)</option>
<option data-countryCode="VA" value="Vatican City (+379)">Vatican City (+379)</option>
<option data-countryCode="VE" value="Venezuela (+58)">Venezuela (+58)</option>
<option data-countryCode="VN" value="Vietnam (+84)">Vietnam (+84)</option>
<option data-countryCode="VG" value="Virgin Islands - British (+1284)">Virgin Islands - British (+1284)</option>
<option data-countryCode="VI" value="Virgin Islands - US (+1340)">Virgin Islands - US (+1340)</option>
<option data-countryCode="WF" value="Wallis and Futuna (+681)">Wallis &amp; Futuna (+681)</option>
<option data-countryCode="YE" value="Yemen (North)(+969)">Yemen (North)(+969)</option>
<option data-countryCode="YE" value="Yemen (South)(+967)">Yemen (South)(+967)</option>
<option data-countryCode="ZM" value="Zambia (+260)">Zambia (+260)</option>
<option data-countryCode="ZW" value="Zimbabwe (+263)">Zimbabwe (+263)</option>
												</select>
                                            </div>-->
                                        
                                        <label>Coach Mobile Number</label>
                                        <div class="form-group">
                                            <span id="lblError" style="color: red"></span>
                                            <input type="text" name="mobile" id="txtName" maxlength="10" minlength="10" required="required" value="<?php if(isset($media_detail)){ print_r($media_detail->mobile); } ?>" class="form-control input-default" placeholder="Coach Mobile Number">
                                        </div>
                                        
                                        
                                        <label>Date Of Birth</label>
                                        <div class="form-group">
                                            <input type="text" name="dob" id="datepicker" value="<?php if(isset($media_detail)){ print_r($media_detail->dob); } ?>" class="form-control input-flat disableFuturedate" placeholder="Date Of Birth" required>
                                        </div>
                                        
                                        
                                        
                                       <!-- <label>Select Source</label>
                                        <div class="form-control">
                                            <select id="selectBox" onchange="changeFunc();" class="" name="source" tabindex="100">
                                        <option data-countryCode="#" value="#">----Select Source----</option>
                                        <option data-countryCode="facebook" value="Facebook">Facebook</option>
                                        <option data-countryCode="linkedin" value="Linkedin">Linkedin</option>
                                        <option data-countryCode="youtube" value="Youtube">Youtube</option>
                                        <option data-countryCode="instagram" value="Instagram">Instagram</option>
                                        <option data-countryCode="google" value="Google">Google</option>
                                        <option data-countryCode="Referal" value="Referal">Referal</option>
                                        <option value="Other">Other</option>
												</select>
												                   </div>
                                            
                                            <input name="source" placeholder="Add New Source" class="form-control" type="text" style="display: none" id="textboxes">
<script type="text/javascript">
function changeFunc() {
var selectBox = document.getElementById("selectBox");
var selectedValue = selectBox.options[selectBox.selectedIndex].value;
if (selectedValue=="Other"){
$('#textboxes').show();
}

}
</script>-->


                                         <label>Source</label>
                                        <div class="form-group">
                                        
                                        <select  name="source" class="form-control" id="source" required>
                                        
                                        <option value="">----Select Source----</option>
                                        <?php foreach ($getsource as $row) {
                                        
                                        if($media_detail->source == $row->source){ ?>
                                        <option selected value="<?php echo $row->source; ?>" >
                                        <?php echo $row->source; ?>
                                        </option>
                                        <?php }else{ ?>
                                        <option value="<?php echo $row->source; ?>" >
                                        <?php echo $row->source; ?>
                                        </option>
                                        <?php }
                                        ?>
                                        <?php } ?>                                  
                                        
                                        </select>
                                        
                                        </div>
                                        
                                        <label>Name In Bank Account</label>
                                        <div class="form-group">
                                            
                                            <input type="text" name="name_in_bank_account" value="<?php if(isset($media_detail)){ print_r($media_detail->name_in_bank_account); } ?>" class="form-control input-flat" placeholder="Name In Bank Account"required >
                                        </div>
                                        
                                        <label>Bank Name</label>
                                        <div class="form-group">
                                            <input type="text" name="bankname" value="<?php if(isset($media_detail)){ print_r($media_detail->bankname); } ?>" class="form-control input-flat" placeholder="Bank Name" required>
                                        </div>
                                        
                                        <label>Branch Location</label>
                                        <div class="form-group">
                                            <input type="text" name="branch_name" value="<?php if(isset($media_detail)){ print_r($media_detail->branch_name); } ?>" class="form-control input-flat" placeholder="Branch Location" required>
                                        </div>
                                        
                                        <label>Account Number</label>
                                        <div class="form-group">
                                            <span id="lblError2" style="color: red"></span>
                                            <input type="text" name="account_number" id="txtName2" value="<?php if(isset($media_detail)){ print_r($media_detail->account_number); } ?>" class="form-control input-flat" placeholder="Account Number" required>
                                        </div>
                                        
                                        <label>IFSC Code</label>
                                        <div class="form-group">
                                            <input type="text" name="ifsc_code" value="<?php if(isset($media_detail)){ print_r($media_detail->ifsc_code); } ?>" class="form-control input-flat" placeholder="IFSC Code" required>
                                        </div>
                                        
                                       
                                        <label>Induction Date </label>
                                        <div class="form-group">
                                            <input type="date" name="induction_date" value="<?php if(isset($media_detail)){ print_r($media_detail->induction_date); } ?>" class="form-control input-flat" placeholder="Induction Date" required>
                                        </div>
                                        
                                        
                                        <label>Password</label>
                                        <div class="form-group">
                                            <input type="password" name="password" value="<?php if(isset($media_detail)){ print_r($media_detail->password); } ?>" class="form-control input-default" placeholder="Password" required>
                                        </div>
                                        
                                        
                                        <label>Confirm Password</label>
                                        <div class="form-group">
                                            <input type="password" name="confpassword" value="<?php if(isset($media_detail)){ print_r($media_detail->confpassword); } ?>" class="form-control input-default" placeholder="Confirm Password" required>
                                        </div>
                                        
                                        <label>T&C & Privacypolicy</label>
                                        <div class="form-group">
                                        
                                        <select  name="policy" class="form-control" id="policy" required>
                                        
                                        <option value="">----Select T&C & Privacypolicy----</option>
                                        <?php foreach ($getpolicyaccept as $row) {
                                        
                                        if($media_detail->policy == $row->policy){ ?>
                                        <option selected value="<?php echo $row->policy; ?>" >
                                        <?php echo $row->policy; ?>
                                        </option>
                                        <?php }else{ ?>
                                        <option value="<?php echo $row->policy; ?>" >
                                        <?php echo $row->policy; ?>
                                        </option>
                                        <?php }
                                        ?>
                                        <?php } ?>                                  
                                        
                                        </select>
                                        
                                        </div>
                                        
                                        <input type="hidden" name="radioID"  id="radioID" value="<?php if(isset($media_detail)){ echo $media_detail->studentid; } ?>" /> 
                                        <button type="submit" name="add_radio" value="Update" class="btn btn-dark mb-2">Add Coach</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                    </div>
                </div>
            </div>
            <!-- #/ container -->
        </div>
        
        <script>
$(document).ready(function(){
 $('#catgry').change(function(){
  var subcat_id = $('#catgry').val();
  if(subcat_id != '')
  {
   $.ajax({
    url:"<?php echo base_url(); ?>Fetchsubcat/Fetch_catgry",
    method:"POST",
    data:{subcat_id:subcat_id},
    success:function(data)
    {
     $('#subcategory').html(data);
     $('#city').html('<option value="">Select City</option>');
    }
   });
  }
  else
  {
   $('#subcategory').html('<option value="">Select sub category</option>');
   $('#city').html('<option value="">Select City</option>');
  }
 });

 $('#subcategory').change(function(){
  var subcat_id = $('#subcategory').val();
  if(subcat_id != '')
  {
   $.ajax({
    url:"<?php echo base_url(); ?>Dynamic_dependent/fetch_city",
    method:"POST",
    data:{subcat_id:subcat_id},
    success:function(data)
    {
     $('#city').html(data);
    }
   });
  }
  else
  {
   $('#city').html('<option value="">Select City</option>');
  }
 });
 
});
</script>
        
        <script>
  $( function() {
      var currentDate = new Date();
    $( "#datepicker" ).datepicker({
      changeMonth: true,
      changeYear: true,
      endDate: "currentDate",
maxDate: currentDate,
dateFormat: 'dd-mm-yy'
    });
  } );
  </script>
        
        <script>
$(document).ready(function () {
var currentDate = new Date();
$('.disableFuturedate').datepicker({
format: 'dd/mm/yyyy',
autoclose:true,
endDate: "currentDate",
maxDate: currentDate
}).on('changeDate', function (ev) {
$(this).datepicker('hide');
});
$('.disableFuturedate').keyup(function () {
if (this.value.match(/[^0-9]/g)) {
this.value = this.value.replace(/[^0-9^-]/g, '');
}
});
});
</script>
        
        
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script type="text/javascript">
    $(function () {
        $("#txtName").keypress(function (e) {
            var keyCode = e.keyCode || e.which;
 
            $("#lblError").html("");
 
            //Regex for Valid Characters i.e. Numbers.
            var regex = /^[0-9]+$/;
 
            //Validate TextBox value against the Regex.
            var isValid = regex.test(String.fromCharCode(keyCode));
            if (!isValid) {
                $("#lblError").html("Only Numbers allowed.");
            }
 
            return isValid;
        });
    });
</script> 
<script type="text/javascript">
    $(function () {
        $("#txtName2").keypress(function (e) {
            var keyCode = e.keyCode || e.which;
 
            $("#lblError2").html("");
 
            //Regex for Valid Characters i.e. Numbers.
            var regex = /^[0-9]+$/;
 
            //Validate TextBox value against the Regex.
            var isValid = regex.test(String.fromCharCode(keyCode));
            if (!isValid) {
                $("#lblError2").html("Only Numbers allowed.");
            }
 
            return isValid;
        });
    });
</script> 
<script>
    $('#email_address').on('keypress', function() {
    var re = /([A-Z0-9a-z_-][^@])+?@[^$#<>?]+?\.[\w]{2,4}/.test(this.value);
    if(!re) {
        $('#error').show();
    } else {
        $('#error').hide();
    }
})
    
</script>
 <script> 
    
      // Function to check Whether both passwords 
      // is same or not. 
      function checkPassword(form) { 
        password = form.password.value; 
        confpassword = form.confpassword.value; 

        // If Password not entered 
        if (password == '') 
          alert ("Please enter Password"); 
          
        // If confirm Password not entered 
        else if (confpassword == '') 
          alert ("Please enter confirm Password"); 
          
        // If Not same return False.   
        else if (password != confpassword) { 
          alert ("\nPassword did not match: Please try again...") 
          return false; 
        } 

        // If same return True. 
        else{ 
          //alert("Password Match") 
          return true; 
        } 
      } 
    </script> 
  
  <?php $this->load->view('assests/footer'); ?>