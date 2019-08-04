<!-- -content- -->
<link href="<?php echo base_url() ?>css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/iEdit.css">
<style>
   .border-right
   {
      border-right: 1px solid #333;
   }
   .pdt10
   {
      padding-top: 10px;
   }
   html, 
   body {
      height: 100%;
   }
</style>
<div class="warper container-fluid" style="margin-top:0;">
   <div class="row height-box">
      <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12 padding0" style="margin-top:6%;">
         <div class="bg-light-grey clearfix"   style="padding-top:10px;border-top:1px solid #5d88a9;">
            
            <div class="col-md-4 col-sm-4 col-lg-4 noprl border-right">
               <div class="search-container">
                  <div class="row nomrl">
                     <div class="col-sm-8 col-md-8 col-lg-8 col-xs-8 pdr0">
                        <div id="imaginary_container">
                           <div class="input-group stylish-input-group">
                              <input type="text" class="form-control" id="search"  placeholder="Search For Organisations" >
                              <span class="input-group-addon">
                                 <button type="submit">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                 </button>
                              </span>
                           </div>
                        </div>
                     </div>
                     <!--                   <div class="col-sm-4 col-md-4 col-lg-4 col-xs-4">
                                           <a href="javascript:void(0)" class="alpha-shorting"><img src="<?php echo base_url(); ?>images/alpha-shorting.png"></a>
                                        </div>-->
                  </div>
               </div>
               <!--end--search-container-->


               <div id="demo">
                  <section id="examples">
                     <!-- content -->
                     <div id="content-3dtd" class="custom-scroll light">
                        <div class="panel-group mt20 bg-light-grey mem-list">

                           <!-- codes for displaying organisations list -->
                           <?php
                           $sn = 1;
                           if ($org_type_list) {
                              foreach ($org_type_list as $keyo => $otvalue) {
                                

                                 ?>
                                 <div class="panel panel-default ">
                                    <div class="panel-heading">
                                       <h4 class="panel-title">
                                          <div class="row nomrl">
                                             <div class="col-md-11 col-sm-11 col-lg-11 col-xs-11 cursor-pointer" data-toggle="collapse" data-parent="#accordion" href="#collapseOne<?php echo $sn; ?>">
                                                <hr class="hr-blue">
                                                <span class="spantext alignright"><?php echo $otvalue['org_type']; ?></span>
                                             </div>
                                             <div class="col-md-1 col-sm-1 col-lg-1 col-xs-1 padding0">
                                                <a id="architect" class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"></a>
                                             </div>
                                          </div>
                                       </h4>
                                    </div>
                                    <div id="collapseOne<?php echo $sn; ?>" class="panel-collapse collapse in">
                                       <div class="panel-body">
                                          <?php
                                          // php code start for architech type commpanies
                                          $tsn = 1;
                                          foreach ($orgs as $key => $value) {
                                             if ($value['org_type'] == $otvalue['org_type']) {
                                                ?>
                                                <div class="border-left-green"> 
                                                   <a href="#" class="delete_org" id="<?php echo $value['org_id']; ?>" onclick="show_org_details('<?php echo $value['org_id']; ?>')">
                                                      <div class=" mt5b5">
                                                         <div class="row nomrl bg-white">
                                                            <div class="col-md-1 col-sm-1 col-lg-1 col-xs-1 noprl"><span class="m-number"><span class="moveright"><?php //echo $sn; ?></span></span></div>
                                                            <div id="org_image<?php echo $value['org_id']; ?>" class="col-md-2 col-sm-2 col-lg-2 col-xs-2 search_img"><img width="45" height="45" src="<?php if(!$value['file_name']){echo base_url() .'images/profil_icon.png';}else{echo base_url() . $value['path'] . '/' . $value['file_name'];} ?>" class="img-circle "></div>
                                                            <div id="org_name<?php echo $value['org_id']; ?>" class="col-md-7 col-sm-7 col-lg-7 col-xs-7 getDetails search_name"><?php echo $value['org_name']; ?></div>
                                                         </div>
                                                         <!--end--row-->
                                                      </div>
                                                   </a>
                                                </div>
                                                <?php
                                                
                                             }// end of if org type statement
                                             $sn++;
                                          }// end of foreach  and php code ends for architech type commpanies
                                          ?>
                                       </div>
                                       <!-- end of panel body -->
                                    </div>
                                    <!-- end of collspseone  -->
                                 </div>
                                 <?php
                                 
                              }// end of foreach loop for org type 
                           }// end of if statement to check existance of org type
                           ?>
                           <!-- end of panel -->




                           <!-- end of codes for displaying organisations list -->


                        </div><!--end panel group -->

                     </div><!--end--content-3dtd-->

                  </section>


               </div><!--end--of--id-demo-->

            </div><!--end--col md 5-->
            <div class="col-md-8 col-lg-8 col-sm-8" style="">
               <div class="col-md-10 btn-group">
                  <button id="bt_addorg"   class="member-add-btn mt10"><i class="fa fa-plus" aria-hidden="true"></i> Add New</button>
                  <button  id="btn_edit" class="member-add-btn mt10">Edit</button>
                  <button id="btn_delete1" data-toggle="modal" data-target="#delete_modal" class="member-add-btn mt10">Delete</button>
               </div>
               <div class="col-md-2"></div>
            </div>
            <div id="error_msg" style="margin-top: 15px;">
               <div class='text-danger'> <?php echo $error; ?></div><br>

               <div class='text-success'> <?php echo $msg; ?></div><br>
            </div>
            <div id="addorg_form" class="col-md-7 col-sm-7 col-lg-7  bg-white dynamicData" style="overflow: auto; height:515px;">

               <?php
               echo form_open_multipart('addorg/add_org');
               ?>
               <form>
                  <div class="row">
                     <div class="col-md-6 col-sm-6 col-lg-6 bg-white" >
                        <label class="rightposition" >Add New Organisation</label><br><br><br>
                        <div><input type="text" name="org_name" class="form-control heightinput" placeholder="Organisation Name" required></div>
                        <div class="form-group">
                           <select class="form-control heightinput org_select" name="org_type" id="dropdown">
                              <option hidden>Type of organisation</option>
                              <?php
                              if ($org_type) {
                                 foreach ($org_type as $orgkey => $orgvalue) {
                                    ?>
                                    <option value='<?php echo $orgvalue['org_type_name']; ?>'><?php echo $orgvalue['org_type_name']; ?></option>
                                    <?php
                                 }
                              }
                              ?>
                              <option class="editable" value="other">Other</option>
                           </select>
                           <input class="editOption form-control" style="display:none;"></input>

                           <br>
                           <select class="form-control" id="org_selected" name="org_type" placeholder="">


                           </select>
                        </div>
                        <div><input type="text" class="form-control heightinput margintop" name="add_line1" placeholder="Address line 1"></div>
                        <div><input type="text" class="form-control heightinput margintop" name="add_line2" placeholder="Address line 2"></div>
                        <div><input type="text" class="form-control heightinput margintop pin" name="pin" placeholder="Pin"> </div>
                        <div>
                           <input type="text" class="form-control heightinput margintop city" name="city" placeholder="City">

                        </div>
                        <div>
                           <select class="form-control heightinput margintop" name="state">
                              
                              <option value="0">- Select State -</option>
                              <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                              <option value="Andhra Pradesh">Andhra Pradesh</option>
                              <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                              <option value="Assam">Assam</option>
                              <option value="Bihar">Bihar</option>
                              <option value="Chandigarh">Chandigarh</option>
                              <option value="Chhattisgarh">Chhattisgarh</option>
                              <option value="Dadra and Nagar Haveli">Dadra and Nagar Haveli</option>
                              <option value="Daman and Diu">Daman and Diu</option>
                              <option value="Delhi">Delhi</option>
                              <option value="Goa">Goa</option>
                              <option value="Gujarat">Gujarat</option>
                              <option value="Haryana">Haryana</option>
                              <option value="Himachal Pradesh">Himachal Pradesh</option>
                              <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                              <option value="Jharkhand">Jharkhand</option>
                              <option value="Karnataka">Karnataka</option>
                              <option value="Kerala">Kerala</option>
                              <option value="Lakshadweep">Lakshadweep</option>
                              <option value="Madhya Pradesh">Madhya Pradesh</option>
                              <option value="Maharashtra">Maharashtra</option>
                              <option value="Manipur">Manipur</option>
                              <option value="Meghalaya">Meghalaya</option>
                              <option value="Mizoram">Mizoram</option>
                              <option value="Nagaland">Nagaland</option>
                              <option value="Orissa">Orissa</option>
                              <option value="Pondicherry">Pondicherry</option>
                              <option value="Punjab">Punjab</option>
                              <option value="Rajasthan">Rajasthan</option>
                              <option value="Sikkim">Sikkim</option>
                              <option value="Tamil Nadu">Tamil Nadu</option>
                              <option value="Tripura">Tripura</option>
                              <option value="Uttaranchal">Uttaranchal</option>
                              <option value="Uttar Pradesh">Uttar Pradesh</option>
                              <option value="West Bengal">West Bengal</option>

                           </select>
<!--                           <input type="text" class="form-control heightinput margintop" name="state" placeholder="State" required>-->
                        </div>
                        <div>
                           <select class="form-control heightinput margintop" name="country">
                              
                              <option value="0">- Select Country -</option>
                              <option Value="AF">Afghanistan</option>
                              <option Value="AL">Albania</option>
                              <option Value="DZ">Algeria</option>
                              <option Value="AS">American Samoa</option>
                              <option Value="AD">Andorra</option>
                              <option Value="AO">Angola</option>
                              <option Value="AI">Anguilla</option>
                              <option Value="AQ">Antarctica</option>
                              <option Value="AG">Antigua And Barbuda</option>
                              <option Value="AR">Argentina</option>
                              <option Value="AM">Armenia</option>
                              <option Value="AW">Aruba</option>
                              <option Value="AU">Australia</option>
                              <option Value="AT">Austria</option>
                              <option Value="AZ">Azerbaijan</option>
                              <option Value="BS">Bahamas</option>
                              <option Value="BH">Bahrain</option>
                              <option Value="BD">Bangladesh</option>
                              <option Value="BB">Barbados</option>
                              <option Value="BY">Belarus</option>
                              <option Value="BE">Belgium</option>
                              <option Value="BZ">Belize</option>
                              <option Value="BJ">Benin</option>
                              <option Value="BM">Bermuda</option>
                              <option Value="BT">Bhutan</option>
                              <option Value="BO">Bolivia</option>
                              <option Value="BA">Bosnia And Herzegowina</option>
                              <option Value="BW">Botswana</option>
                              <option Value="BV">Bouvet Island</option>
                              <option Value="BR">Brazil</option>
                              <option Value="IO">British Indian Ocean Territory</option>
                              <option Value="BN">Brunei Darussalam</option>
                              <option Value="BG">Bulgaria</option>
                              <option Value="BF">Burkina Faso</option>
                              <option Value="BI">Burundi</option>
                              <option Value="KH">Cambodia</option>
                              <option Value="CM">Cameroon</option>
                              <option Value="CA">Canada</option>
                              <option Value="CV">Cape Verde</option>
                              <option Value="KY">Cayman Islands</option>
                              <option Value="CF">Central African Republic</option>
                              <option Value="TD">Chad</option>
                              <option Value="CL">Chile</option>
                              <option Value="CN">China</option>
                              <option Value="CX">Christmas Island</option>
                              <option Value="CC">Cocos (Keeling) Islands</option>
                              <option Value="CO">Colombia</option>
                              <option Value="KM">Comoros</option>
                              <option Value="CG">Congo</option>
                              <option Value="CK">Cook Islands</option>
                              <option Value="CR">Costa Rica</option>
                              <option Value="CI">Cote D'Ivoire</option>
                              <option Value="HR">Croatia (Local Name: Hrvatska)</option>
                              <option Value="CU">Cuba</option>
                              <option Value="CY">Cyprus</option>
                              <option Value="CZ">Czech Republic</option>
                              <option Value="DK">Denmark</option>
                              <option Value="DJ">Djibouti</option>
                              <option Value="DM">Dominica</option>
                              <option Value="DO">Dominican Republic</option>
                              <option Value="TP">East Timor</option>
                              <option Value="EC">Ecuador</option>
                              <option Value="EG">Egypt</option>
                              <option Value="SV">El Salvador</option>
                              <option Value="GQ">Equatorial Guinea</option>
                              <option Value="ER">Eritrea</option>
                              <option Value="EE">Estonia</option>
                              <option Value="ET">Ethiopia</option>
                              <option Value="FK">Falkland Islands (Malvinas)</option>
                              <option Value="FO">Faroe Islands</option>
                              <option Value="FJ">Fiji</option>
                              <option Value="FI">Finland</option>
                              <option Value="FR">France</option>
                              <option Value="GF">French Guiana</option>
                              <option Value="PF">French Polynesia</option>
                              <option Value="TF">French Southern Territories</option>
                              <option Value="GA">Gabon</option>
                              <option Value="GM">Gambia</option>
                              <option Value="GE">Georgia</option>
                              <option Value="DE">Germany</option>
                              <option Value="GH">Ghana</option>
                              <option Value="GI">Gibraltar</option>
                              <option Value="GR">Greece</option>
                              <option Value="GL">Greenland</option>
                              <option Value="GD">Grenada</option>
                              <option Value="GP">Guadeloupe</option>
                              <option Value="GU">Guam</option>
                              <option Value="GT">Guatemala</option>
                              <option Value="GN">Guinea</option>
                              <option Value="GW">Guinea-Bissau</option>
                              <option Value="GY">Guyana</option>
                              <option Value="HT">Haiti</option>
                              <option Value="HM">Heard And Mc Donald Islands</option>
                              <option Value="VA">Holy See (Vatican City State)</option>
                              <option Value="HN">Honduras</option>
                              <option Value="HK">Hong Kong</option>
                              <option Value="HU">Hungary</option>
                              <option Value="IS">Icel And</option>
                              <option Value="IN">India</option>
                              <option Value="ID">Indonesia</option>
                              <option Value="IR">Iran (Islamic Republic Of)</option>
                              <option Value="IQ">Iraq</option>
                              <option Value="IE">Ireland</option>
                              <option Value="IL">Israel</option>
                              <option Value="IT">Italy</option>
                              <option Value="JM">Jamaica</option>
                              <option Value="JP">Japan</option>
                              <option Value="JO">Jordan</option>
                              <option Value="KZ">Kazakhstan</option>
                              <option Value="KE">Kenya</option>
                              <option Value="KI">Kiribati</option>
                              <option Value="KP">Korea, Dem People'S Republic</option>
                              <option Value="KR">Korea, Republic Of</option>
                              <option Value="KW">Kuwait</option>
                              <option Value="KG">Kyrgyzstan</option>
                              <option Value="LA">Lao People'S Dem Republic</option>
                              <option Value="LV">Latvia</option>
                              <option Value="LB">Lebanon</option>
                              <option Value="LS">Lesotho</option>
                              <option Value="LR">Liberia</option>
                              <option Value="LY">Libyan Arab Jamahiriya</option>
                              <option Value="LI">Liechtenstein</option>
                              <option Value="LT">Lithuania</option>
                              <option Value="LU">Luxembourg</option>
                              <option Value="MO">Macau</option>
                              <option Value="MK">Macedonia</option>
                              <option Value="MG">Madagascar</option>
                              <option Value="MW">Malawi</option>
                              <option Value="MY">Malaysia</option>
                              <option Value="MV">Maldives</option>
                              <option Value="ML">Mali</option>
                              <option Value="MT">Malta</option>
                              <option Value="MH">Marshall Islands</option>
                              <option Value="MQ">Martinique</option>
                              <option Value="MR">Mauritania</option>
                              <option Value="MU">Mauritius</option>
                              <option Value="YT">Mayotte</option>
                              <option Value="MX">Mexico</option>
                              <option Value="FM">Micronesia, Federated States</option>
                              <option Value="MD">Moldova, Republic Of</option>
                              <option Value="MC">Monaco</option>
                              <option Value="MN">Mongolia</option>
                              <option Value="MS">Montserrat</option>
                              <option Value="MA">Morocco</option>
                              <option Value="MZ">Mozambique</option>
                              <option Value="MM">Myanmar</option>
                              <option Value="NA">Namibia</option>
                              <option Value="NR">Nauru</option>
                              <option Value="NP">Nepal</option>
                              <option Value="NL">Netherlands</option>
                              <option Value="AN">Netherlands Ant Illes</option>
                              <option Value="NC">New Caledonia</option>
                              <option Value="NZ">New Zealand</option>
                              <option Value="NI">Nicaragua</option>
                              <option Value="NE">Niger</option>
                              <option Value="NG">Nigeria</option>
                              <option Value="NU">Niue</option>
                              <option Value="NF">Norfolk Island</option>
                              <option Value="MP">Northern Mariana Islands</option>
                              <option Value="NO">Norway</option>
                              <option Value="OM">Oman</option>
                              <option Value="PK">Pakistan</option>
                              <option Value="PW">Palau</option>
                              <option Value="PA">Panama</option>
                              <option Value="PG">Papua New Guinea</option>
                              <option Value="PY">Paraguay</option>
                              <option Value="PE">Peru</option>
                              <option Value="PH">Philippines</option>
                              <option Value="PN">Pitcairn</option>
                              <option Value="PL">Poland</option>
                              <option Value="PT">Portugal</option>
                              <option Value="PR">Puerto Rico</option>
                              <option Value="QA">Qatar</option>
                              <option Value="RE">Reunion</option>
                              <option Value="RO">Romania</option>
                              <option Value="RU">Russian Federation</option>
                              <option Value="RW">Rwanda</option>
                              <option Value="KN">Saint K Itts And Nevis</option>
                              <option Value="LC">Saint Lucia</option>
                              <option Value="VC">Saint Vincent, The Grenadines</option>
                              <option Value="WS">Samoa</option>
                              <option Value="SM">San Marino</option>
                              <option Value="ST">Sao Tome And Principe</option>
                              <option Value="SA">Saudi Arabia</option>
                              <option Value="SN">Senegal</option>
                              <option Value="SC">Seychelles</option>
                              <option Value="SL">Sierra Leone</option>
                              <option Value="SG">Singapore</option>
                              <option Value="SK">Slovakia (Slovak Republic)</option>
                              <option Value="SI">Slovenia</option>
                              <option Value="SB">Solomon Islands</option>
                              <option Value="SO">Somalia</option>
                              <option Value="ZA">South Africa</option>
                              <option Value="GS">South Georgia , S Sandwich Is.</option>
                              <option Value="ES">Spain</option>
                              <option Value="LK">Sri Lanka</option>
                              <option Value="SH">St. Helena</option>
                              <option Value="PM">St. Pierre And Miquelon</option>
                              <option Value="SD">Sudan</option>
                              <option Value="SR">Suriname</option>
                              <option Value="SJ">Svalbard, Jan Mayen Islands</option>
                              <option Value="SZ">Sw Aziland</option>
                              <option Value="SE">Sweden</option>
                              <option Value="CH">Switzerland</option>
                              <option Value="SY">Syrian Arab Republic</option>
                              <option Value="TW">Taiwan</option>
                              <option Value="TJ">Tajikistan</option>
                              <option Value="TZ">Tanzania, United Republic Of</option>
                              <option Value="TH">Thailand</option>
                              <option Value="TG">Togo</option>
                              <option Value="TK">Tokelau</option>
                              <option Value="TO">Tonga</option>
                              <option Value="TT">Trinidad And Tobago</option>
                              <option Value="TN">Tunisia</option>
                              <option Value="TR">Turkey</option>
                              <option Value="TM">Turkmenistan</option>
                              <option Value="TC">Turks And Caicos Islands</option>
                              <option Value="TV">Tuvalu</option>
                              <option Value="UG">Uganda</option>
                              <option Value="UA">Ukraine</option>
                              <option Value="AE">United Arab Emirates</option>
                              <option Value="GB">United Kingdom</option>
                              <option Value="US">United States</option>
                              <option Value="UM">United States Minor Is.</option>
                              <option Value="UY">Uruguay</option>
                              <option Value="UZ">Uzbekistan</option>
                              <option Value="VU">Vanuatu</option>
                              <option Value="VE">Venezuela</option>
                              <option Value="VN">Viet Nam</option>
                              <option Value="VG">Virgin Islands (British)</option>
                              <option Value="VI">Virgin Islands (U.S.)</option>
                              <option Value="WF">Wallis And Futuna Islands</option>
                              <option Value="EH">Western Sahara</option>
                              <option Value="YE">Yemen</option>
                              <option Value="ZR">Zaire</option>
                              <option Value="ZM">Zambia</option>
                              <option Value="ZW">Zimbabwe</option>

                           </select>

<!--                           <input type="text" class="form-control heightinput margintop" name="country" placeholder="Country" required>-->
                        </div>
                        <div class="input-group heightinput">
                           <span class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i></span>
                           <input type="mobile" class="form-control heightinput con tact_no" name="l_number"  placeholder="Landline Numaber">

                        </div>
                        <div class="input-group heightinput">
                           <span class="input-group-addon"><i class="fa fa-mobile" aria-hidden="true"></i></span>
                           <input type="mobile" class="form-control heightinput contact_no" name="comtact_no"  placeholder="Mobile No">

                        </div>
                        <div class="input-group heightinput">
                           <span class="input-group-addon"><i class="fa fa-user"></i></span>
                           <input type="text" class="form-control heightinput" name="contact_name" placeholder="Contact Name">
                        </div>
                        <div class="input-group heightinput">
                           <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                           <input type="email" id="email" class="form-control heightinput" name="email" placeholder="E-mail" required>
                        </div>

                        <div class="col-md-12"><span class="org_number" style="color:red;"></span></div>

                        <div class="col-md-12 col-sm-12 col-lg-12 padding10">

                           <button class="btn btn-success btn-right btn-add">
                              <i class="fa fa-check" aria-hidden="true"></i> ADD
                           </button>

                        </div>
                     </div><!-- end of col md 6 -->


                    

     <div class="col-md-6 col-sm-6 col-lg-6 clr-gray">
                        <label for="org_logo_file">
                           <div class="circle" id="logo_pic">
                              <center >
                                 <i class=" fa fa-plus profileicon"><br>
                                    <span id="dataoffile" ><u>Company Logo</u></span>
                                 </i>
                              </center>
                           </div>

                        </label>
                        <input class="hide" name="company_logo"  id="org_logo_file" type="file"/>
                         <input  type="hidden" id="w" name="w" value="" class="form-control">
                        <input  type="hidden" id="h" name="h" value="" class="form-control">
                        <input  type="hidden" id="x" name="x" value="" class="form-control">
                        <input  type="hidden" id="y" name="y" value="" class="form-control">

                     </div>

                  </div> <!-- end row -->


                  <!--end--member-detail-container-->
               </form>
            </div> <!-- end of col md 7 -->

            <!-- *******edit form *************-->

            <div id="edit_org_form" class="col-md-7 col-sm-7 col-lg-7  bg-white dynamicData" style="overflow: auto; height:490px;">

               <?php
               echo form_open_multipart('addorg/edit_add_org');
               ?>
               <form>
                  <div class="row">
                     <div class="col-md-6 col-sm-6 col-lg-6 bg-white" >
                        <label class="rightposition" >Edit Organisation</label><br><br><br>
                        <div>
                           <input id="edit_org_id" type="hidden" name="edit_org_id">
                           <input id="edit_name" type="text" name="edit_name" class="form-control heightinput" placeholder="Organisation Name">
                        </div>
                        <div class="form-group">
                           <select class="form-control heightinput" name="edit_org_type" id="edit_org_type">
                              <option hidden>Type of organisation</option>
                              <?php
                              if ($org_type) {
                                 foreach ($org_type as $orgkey => $orgvalue) {
                                    ?>
                                    <option value='<?php echo $orgvalue['org_type_name']; ?>'><?php echo $orgvalue['org_type_name']; ?></option>
                                    <?php
                                 }
                              }
                              ?>

                           </select>
                        </div>
                        <div><input type="text" class="form-control heightinput margintop" name="edit_add_line1" id="edit_add_line1" placeholder="Address line 1" ></div>
                        <div><input type="text" class="form-control heightinput margintop" name="edit_add_line2" id="edit_add_line2" placeholder="Address line 2" ></div>
                        <div><input type="text" class="form-control heightinput margintop edit_pin" name="edit_pin" id="edit_pin" placeholder="Pin" ></div>
                        <div><input type="text" class="form-control heightinput margintop" name="edit_city" id="edit_city" placeholder="City" ></div>
                        <div><input type="text" class="form-control heightinput margintop" name="edit_state" id="edit_state" placeholder="State" ></div>
                        <div><input type="text" class="form-control heightinput margintop" name="edit_country" id="edit_country" placeholder="Country" ></div>
                        <div class="input-group heightinput">
                           <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                           <input type="text" id="edit_l_number" class="form-control heightinput con tact_no" name="edit_l_number"  placeholder="Landline Numaber">

                        </div>
                        <div class="input-group heightinput">
                           <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                           <input type="mobile" class="form-control heightinput edit_contact_no" name="edit_comtact_no" id="edit_comtact_no" placeholder="Mobile No" >
                        </div>
                        <div class="input-group heightinput">
                           <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                           <input type="text" class="form-control heightinput" name="edit_contact_name" id="edit_contact_name" placeholder="Contact Name" >
                        </div>
                        <div class="input-group heightinput">
                           <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                           <input type="email" class="form-control heightinput" name="edit_email" id="edit_email" placeholder="E-mail" required>
                        </div>

                        <div class="col-md-12"><br> <br><span class="edit_contact" style="color:red;"></span></div>
                     </div><!-- end of col md 6 -->


                     <div class="  col-md-6 col-sm-6 col-lg-6 clr-gray">
                        <label for="edit_org_logo_file">
                           <div class="circle" id="edit_logo_pic">
                              <center>
                                 <i class=" fa fa-plus profileicon"><br>
                                    <span id="dataoffile" ><u>Company Logo</u></span>
                                 </i>
                              </center>
                           </div>

                        </label>
                        <input class="hide" name="company_logo"  id="edit_org_logo_file" type="file"/>

                        <div class="col-md-12"><br> <br><span class="edit_org_pin" style="color:red;"></span></div>
                     </div>

                  </div> <!-- end row -->

                  <div class="row">
                     <div class="col-md-12 col-sm-12 col-lg-12">
                        <button class="btn btn-success btn-right btn-add">Update</button>
                     </div>
                  </div>
                  <!--end--member-detail-container-->
               </form>
            </div> <!-- end of col md 7 -->


            <!-- end of edit form *****************-->

            <!-- the organisation detials division -->
            <div id="org_detials" class="col-xs-7 col-md-7 col-sm-7 col-lg-7  bg-white heightofpanel dynamicData" style="overflow: auto; height: 500px;">
               <div class="member-detail-container ">
                  <div class="row mt30">
                     <div class="col-md-4 col-sm-4 col-lg-4">
                        <label id="orgname" class="mt15">Organisation Name</label>
                     </div>
                     <!--end-col-3-->
                     <div class="col-md-1 col-sm-1 col-lg-1 pdr0 pdt10">
                        <img width="45" height="45" id='org_logo' src="" class="img-circle member-img">
                     </div>
                     <!--end-col-2-->
                     <div class="col-md-7 col-sm-7 col-lg-7">
                        <p id="org_name" class="mt15">XXX</p>
                     </div>
                     <!--end-col-7-->
                  </div>
                  <!--end--row-->
                  <div class="row mt30">
                     <div class="col-md-4 col-sm-4 col-lg-4">
                        <p >Type Of Organisation</p>
                     </div>
                     <!--end-col-3-->
                     <div class="col-md-8 col-sm-8 col-lg-8">
                        <p id="org_type" class="border-left-blue pdl8">XXX</p>
                     </div>
                     <!--end-col-7-->
                  </div>
                  <!--end--row-->
                  <div class="row mt30">
                     <div class="col-md-4 col-sm-4 col-lg-4">
                        <p class="">Contact Details</p>
                     </div>
                     <!--end-col-3-->
                     <div class="col-md-8 col-sm-8 col-lg-8">
                        <div class="mt10"><i class="fa fa-user" aria-hidden="true"></i><label class="pdl8" id="contact_name">XXX</label> </div>

                        <div class="mt10"><i class="fa fa-envelope-o" aria-hidden="true"></i><label class="pdl8" id="email1">XXX </label> </div>
                        <div class="mt10"><i class="fa fa-mobile" aria-hidden="true"></i><label class="pdl8" id="contact_no">XXX</label></div>
                        <div class="mt10"><i class="fa fa-phone" aria-hidden="true"></i><label class="pdl8" id="landline_number">XXX</label></div>
                     </div>
                     <!--end-col-9-->
                  </div>
                  <!--end--row-->
                  <div class="row mt30">
                     <div class="col-md-4 col-sm-4 col-lg-4">
                        <p class="">Address Details</p>
                     </div>
                     <!--end-col-3-->
                     <div class="col-md-8 col-sm-8 col-lg-8">
                        <div class="mt10">
                           <i class="fa fa-map-marker" aria-hidden="true"></i>
                           <label class="pdl8" id="address_line1">XXX</label>
                        </div>
                        <div class="mt10">
                           <label class="pdl8" id="address_line2">XXX</label>
                        </div>
                        <div class="mt10">
                           <label class="pdl8" id="pin">XXX</label>
                        </div>

                        <div class="mt10">
                           <label class="pdl8" id="city">XXX </label> 
                        </div>
                        <div class="mt10">
                           <label class="pdl8" id="state">XXX</label>
                        </div>
                        <div class="mt10">
                           <label class="pdl8" id="country">XXX</label>
                        </div>
                     </div>
                     <!--end-col-9-->
                  </div>

                  <div class="row mt30">
                     <div class="col-md-4 col-sm-4 col-lg-4">
                        <p >Added On</p>
                     </div>
                     <!--end-col-3-->
                     <div class="col-md-8 col-sm-8 col-lg-8">
                        <i class="fa fa-calendar" aria-hidden="true"></i>
                        <label id="added_on" class=" pdl8">XXX</label>
                     </div>
                     <!--end-col-7-->
                  </div>
                  <!--end--row-->
                  <div id="project_handeled"  class="row mt30">
                     <div class="col-md-4 col-sm-4 col-lg-4">
                        <p  class="mt15">Projects Handled</p>
                     </div>
                     <!--end-col-3-->
                     <div class="col-md-4 col-sm-4 col-lg-4 pdr0 pdl10">
                        <a href="javascript:void(0)">
                           <img src="images/project-1.png" class="img-circle img-responsive project-handle-img">
                        </a>
                        <a href="javascript:void(0)">
                           <img src="images/project-2.png" class="img-circle img-responsive project-handle-img">
                        </a>
                        <a href="javascript:void(0)">
                           <img src="images/project-3.png" class="img-circle img-responsive project-handle-img">
                        </a>
                        <a href="javascript:void(0)">
                           <img src="images/project-4.png" class="img-circle img-responsive project-handle-img">
                        </a>
                     </div>
                     <!--end-col-7-->
                     <div class="col-md-3 col-sm-3 col-lg-3 noprl">
                        <p class="more15 mt15"><a href="javascript:void(0)">& 15 more</a></p>
                     </div>
                     <!--end-col-2-->
                  </div>
                  <!--end--row-->
                  <!--end--row-->
               </div>
               <!--end--member-detail-container-->
            </div>
            <!--end-col-7- main-->
            <!-- end of organisation details division -->
         </div>
         <!--end of gray-bg-->

      </div>
      <!--end of col-md-12-->
   </div>
   <!--end of row-->


</div>

<!-- Add Organization Type Modal -->
<div class="modal fade" id="org_type_add" role="dialog">
   <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Organization Type</h4>
         </div>
         <form id="add_org">
            <div class="modal-body">
               <div class="row">
                  <div class="col-md-4"><label>Add Organization Type</label></div>
                  <div class="col-md-5"><input type="text" value="" name="add_org_type" id="add_org_type" class="form-control"></div>
               </div>
            </div>
            <div class="modal-footer">
               <button id="other_btn" type="button" class="btn btn-success">ADD</button>
         </form>

         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
   </div>

</div>
</div>


<!-- ======================================== Delete  Modal ============================================= -->
<div class="modal fade" id="delete_modal" role="dialog">
   <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-body">
            <h2>Are you sure you wont to delete </h2>
         </div>
         <div class="modal-footer">
            <button id="btn_delete" type="button" class="btn btn-default" data-dismiss="modal">Delete</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
         </div>
      </div>

   </div>
</div>



<!--======================================== NOT Delete MSG  Modal =======================================-->
<div class="modal fade" id="delete_modal_msg" role="dialog">
   <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-body">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <div class="row">
            <div class="col-md-12" style="margin-bottom:10px;">
               <h2>This Organization will Not Delete</h2>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
         </div>
      </div>

   </div>
</div>
<script src="<?php echo base_url() ?>js/jquery-3.1.1.min.js?v=1.0"></script>
<script src="<?php echo base_url() ?>js/org_list.js?v=1.0" type="text/javascript"></script>
<script src="<?php echo base_url() ?>js/addorg.js?v=1.0" type="text/javascript"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>js/iEdit.js?v=1.0"></script>




