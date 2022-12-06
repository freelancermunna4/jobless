<?php
	require_once"common/sidebar.php";
    if(!$is_online){ header("Location: index");}
    if($ses_id<1){
        header('location:about');

    }

    $err="";
    if(isset($_POST['profile-submit'])){
        $name=$db->EscapeString($_POST['uname']);
        $country=$db->EscapeString($_POST['country']);
        $address=$db->EscapeString($_POST['address']);
        $city=$db->EscapeString($_POST['city']);
        $zipcode=$db->EscapeString($_POST['zipcode']);
        $birth=$db->EscapeString($_POST['birth']);
        $facebook=$db->EscapeString($_POST['facebook']);
        $twiter=$db->EscapeString($_POST['twiter']);

        if(empty($name)){$err="Enter Your Name";}
        else if(empty($country)){$err="Select Your Country";}
        else if(empty($address)){$err="Enter your Address";}
        else if(empty($city)){$err="Enter your City";}
        else if(empty($zipcode)){$err="Enter your Zipcode";}
        else if(empty($birth)){$err="Select your Birthday";}
        else{
            $dt="UPDATE `users` SET  `fullname`='$name',`country`='$country',`address`=' $address',`city`=' $city',`zipcod`='$zipcode',`datebirth`='$birth',`facebook`='$facebook',`twiter`='$twiter' WHERE id=$ses_id";
            $updateUser=_insertData($db,$dt);
            if($updateUser){
                $profilepic=$_FILES['img'];
                if(!empty($profilepic)){
                    /**  image */
                    $fileName=$_FILES['img']['name'];
                    $fileTempName=$_FILES['img']['tmp_name'];
                    $fileSize=$_FILES['img']['size'];
                    $fileError=$_FILES['img']['error'];
                    $fileType=$_FILES['img']['type'];
                    $fileExt=explode('.',$fileName);
                    $fileActualExt=strtolower(end($fileExt));
                    $allaowed=array('jpeg', 'jpg', 'png', 'gif');
                    if(in_array($fileActualExt,$allaowed)){
                    if ($fileError===0) {
                        if($fileSize<1000000){
                        $fileNameNew=uniqid('',true).".".$fileActualExt;
                        $fileDestination="assets/images/".$fileNameNew;
                        move_uploaded_file( $fileTempName,$fileDestination);

                        $dt="UPDATE `users` SET  `image`='$fileDestination' WHERE id=$ses_id";
                        $updateUser=_insertData($db,$dt);
                           }else{
                                  echo "Your file is too big!";

                                 }
                                }else{
                                    echo "There is an Error uploading your file!";
                                }
                            }else{
                                echo "You cannot upload files this type !";

                            }
                }
                $err="Successfully Updated";
            }else{
                $err="ERROR::Something Wrong";
            }



        }

    }


    $user=_getData($db,"SELECT * FROM users WHERE id = $ses_id");

?>

<!--===== main page content =====-->
<div class="content">
    <div class="container">
        <div class="page_content">
            <div class="dashboard_layout">
                <?php require_once('common/profile_sidebar.php'); ?>

                <div class="dashboard_content">
                    <div class="dc_box">
                        <div class="dc_box_header">
                            <div class="dc_box_container">
                                <h6>
                                    <span class="icon">
                                        <i class="fa fa-user"></i>
                                    </span>
                                    <span class="text"> Profile </span>
                                </h6>
                            </div>
                        </div>

                        <p style="margin-left: 25px;color: #ff1477;"> <?php  echo $err; ?> </p>


                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="dc_box_container">
                                <div class="flex_inputs">
                                    <div class="input_area">
                                        <label for="f_name">Full Name</label>

                                        <input name="uname" required id="f_name" type="text" class="base_input"
                                            value="<?php echo $user['fullname']?>" placeholder="Enter Yout Full Name" />
                                    </div>

                                </div>
                                <br />
                                <div class="flex_inputs">
                                    <div class="input_area">
                                        <label for="f_name">Email <smal><small>You Cannot Change
                                                    email</small> </smal></label>

                                        <input required type="text" class="base_input"
                                            value="<?php echo $user['email']?>" placeholder="Enter Yout Full Name" />
                                    </div>

                                </div>
                                <br />
                                <div class="flex_inputs">
                                    <div class="input_area">
                                        <label>Select Country</label>
                                        <select class="base_select" name="country">
                                            <option value="Bangladesh">Bangladesh</option>
                                            <option value="Afghanistan">Afghanistan</option>
                                            <option value="Albania">Albania</option>
                                            <option value="7">Algeria</option>
                                            <option value="Algeria">American Samoa</option>
                                            <option value="Andorra">Andorra</option>
                                            <option value="Angola">Angola</option>
                                            <option value="Anguilla">Anguilla</option>
                                            <option value="Antigua">Antigua &amp; Barbuda</option>
                                            <option value="Antilles, Netherlands">Antilles, Netherlands</option>
                                            <option value="Argentina">Argentina</option>
                                            <option value="Armenia">Armenia</option>
                                            <option value="Aruba">Aruba</option>
                                            <option value="Australia">Australia</option>
                                            <option value="Austria">Austria</option>
                                            <option value="Azerbaijan">Azerbaijan</option>
                                            <option value="Bahamas">Bahamas, The</option>
                                            <option value="Bahrain">Bahrain</option>
                                            <option value="Barbados">Barbados</option>
                                            <option value="Belarus">Belarus</option>
                                            <option value="Belgium">Belgium</option>
                                            <option value="Belize">Belize</option>
                                            <option value="Benin">Benin</option>
                                            <option value="Bermuda">Bermuda</option>
                                            <option value="Bhutan">Bhutan</option>
                                            <option value="Bolivia">Bolivia</option>
                                            <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                            <option value="Botswana">Botswana</option>
                                            <option value="Brazil">Brazil</option>
                                            <option value="British Virgin Islands">British Virgin Islands</option>
                                            <option value="Brunei Darussalam">Brunei Darussalam</option>
                                            <option value="Bulgaria">Bulgaria</option>
                                            <option value="Burkina Faso">Burkina Faso</option>
                                            <option value="Burundi">Burundi</option>
                                            <option value="Cambodia">Cambodia</option>
                                            <option value="Cameroon">Cameroon</option>
                                            <option value="Canada">Canada</option>
                                            <option value="Cape Verde">Cape Verde</option>
                                            <option value="Cayman Islands">Cayman Islands</option>
                                            <option value="Central African Republic">Central African Republic</option>
                                            <option value="Chad">Chad</option>
                                            <option value="Chile">Chile</option>
                                            <option value="China">China</option>
                                            <option value="Colombia">Colombia</option>
                                            <option value="Comoros">Comoros</option>
                                            <option value="Congo">Congo</option>
                                            <option value="Congo">Congo</option>
                                            <option value="Cook Islands">Cook Islands</option>
                                            <option value="Costa Rica">Costa Rica</option>
                                            <option value="Cote D'Ivoire">Cote D'Ivoire</option>
                                            <option value="Croatia">Croatia</option>
                                            <option value="Cuba">Cuba</option>
                                            <option value="Cyprus">Cyprus</option>
                                            <option value="Czech Republic">Czech Republic</option>
                                            <option value="Denmark">Denmark</option>
                                            <option value="Djibouti">Djibouti</option>
                                            <option value="Dominica">Dominica</option>
                                            <option value="Dominican Republic">Dominican Republic</option>
                                            <option value="East Timor (Timor-Leste)">East Timor (Timor-Leste)</option>
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
                                            <option value="Gabon">Gabon</option>
                                            <option value="Gambia, the">Gambia, the</option>
                                            <option value="Georgia">Georgia</option>
                                            <option value="Germany">Germany</option>
                                            <option value="Ghana">Ghana</option>
                                            <option value="Gibraltar">Gibraltar</option>
                                            <option value="Greece">Greece</option>
                                            <option value="Greenland">Greenland</option>
                                            <option value="Grenada">Grenada</option>
                                            <option value="Guadeloupe">Guadeloupe</option>
                                            <option value="Guam">Guam</option>
                                            <option value="Guatemala">Guatemala</option>
                                            <option value="Guernsey and Alderney">Guernsey and Alderney</option>
                                            <option value="Guiana, French">Guiana, French</option>
                                            <option value="Guinea">Guinea</option>
                                            <option value="Guinea, Equatorial">Guinea, Equatorial</option>
                                            <option value="Guinea-Bissau-Bissau3">Guinea-Bissau</option>
                                            <option value="Guyana">Guyana</option>
                                            <option value="Haiti">Haiti</option>
                                            <option value="Honduras">Honduras</option>
                                            <option value="Hong Kong, (China)">Hong Kong, (China)</option>
                                            <option value="Hungary">Hungary</option>
                                            <option value="Iceland">Iceland</option>
                                            <option value="India">India</option>
                                            <option value="Indonesia">Indonesia</option>
                                            <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                                            <option value="Iraq">Iraq</option>
                                            <option value="Ireland">Ireland</option>
                                            <option value="Israel">Israel</option>
                                            <option value="Italy">Italy</option>
                                            <option value="Ivory Coast (Cote d'Ivoire)">
                                                Ivory Coast (Cote d'Ivoire)
                                            </option>
                                            <option value="Jamaica">Jamaica</option>
                                            <option value="Japan">Japan</option>
                                            <option value="Jersey">Jersey</option>
                                            <option value="Jordan">Jordan</option>
                                            <option value="Kazakhstan">Kazakhstan</option>
                                            <option value="Kenya">Kenya</option>
                                            <option value="Kiribati">Kiribati</option>
                                            <option value="Korea, (South) Rep. of">Korea, (South) Rep. of</option>
                                            <option value="Kuwait">Kuwait</option>
                                            <option value="Kyrgyzstan">Kyrgyzstan</option>
                                            <option value="Lao People's Dem. Rep.">Lao People's Dem. Rep.</option>
                                            <option value="Latvia">Latvia</option>
                                            <option value="Lebanon">Lebanon</option>
                                            <option value="Lesotho">Lesotho</option>
                                            <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                                            <option value="Liechtenstein">Liechtenstein</option>
                                            <option value="Lithuania">Lithuania</option>
                                            <option value="Luxembourg">Luxembourg</option>
                                            <option value="Macao, (China)">Macao, (China)</option>
                                            <option value="Macedonia, TFYR">Macedonia, TFYR</option>
                                            <option value="Madagascar">Madagascar</option>
                                            <option value="Malawi">Malawi</option>
                                            <option value="13Malaysia3">Malaysia</option>
                                            <option value="Maldives">Maldives</option>
                                            <option value="Mali">Mali</option>
                                            <option value="Malta">Malta</option>
                                            <option value="Martinique">Martinique</option>
                                            <option value="Mauritania">Mauritania</option>
                                            <option value="Mauritius">Mauritius</option>
                                            <option value="Mexico">Mexico</option>
                                            <option value="Micronesia">Micronesia</option>
                                            <option value="Moldova, Republic of">Moldova, Republic of</option>
                                            <option value="Monaco">Monaco</option>
                                            <option value="Mongolia">Mongolia</option>
                                            <option value="Montenegro">Montenegro</option>
                                            <option value="Morocco">Morocco</option>
                                            <option value="Mozambique">Mozambique</option>
                                            <option value="Myanmar (ex-Burma)">Myanmar (ex-Burma)</option>
                                            <option value="Namibia">Namibia</option>
                                            <option value="Nepal">Nepal</option>
                                            <option value="Netherlands">Netherlands</option>
                                            <option value="New Caledonia">New Caledonia</option>
                                            <option value="New Zealand">New Zealand</option>
                                            <option value="Nicaragua">Nicaragua</option>
                                            <option value="Niger">Niger</option>
                                            <option value="Nigeria">Nigeria</option>
                                            <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                            <option value="Norway">Norway</option>
                                            <option value="Oman">Oman</option>
                                            <option value="Pakistan">Pakistan</option>
                                            <option value="Palestinian Territory">Palestinian Territory</option>
                                            <option value="Panama">Panama</option>
                                            <option value="Papua New Guinea">Papua New Guinea</option>
                                            <option value="Paraguay">Paraguay</option>
                                            <option value="Peru">Peru</option>
                                            <option value="1Philippines66">Philippines</option>
                                            <option value="Poland">Poland</option>
                                            <option value="Portugal">Portugal</option>
                                            <option value="Qatar">Qatar</option>
                                            <option value="Reunion">Reunion</option>
                                            <option value="Romania">Romania</option>
                                            <option value="Russian Federation">Russian Federation</option>
                                            <option value="Rwanda">Rwanda</option>
                                            <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                            <option value="Saint Lucia">Saint Lucia</option>
                                            <option value="Samoa">Samoa</option>
                                            <option value="San Marino">San Marino</option>
                                            <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                            <option value="Saudi Arabia">Saudi Arabia</option>
                                            <option value="Senegal">Senegal</option>
                                            <option value="Serbia">Serbia</option>
                                            <option value="Seychelles">Seychelles</option>
                                            <option value="Singapore">Singapore</option>
                                            <option value="Slovakia">Slovakia</option>
                                            <option value="Slovenia">Slovenia</option>
                                            <option value="Solomon Islands">Solomon Islands</option>
                                            <option value="Somalia">Somalia</option>
                                            <option value="South Africa">South Africa</option>
                                            <option value="Spain">Spain</option>
                                            <option value="Sri Lanka (ex-Ceilan)">Sri Lanka (ex-Ceilan)</option>
                                            <option value=" St. Vincent &amp; the Grenad.">
                                                St. Vincent &amp; the Grenad.
                                            </option>
                                            <option value="Sudan">Sudan</option>
                                            <option value="Suriname">Suriname</option>
                                            <option value="Swaziland">Swaziland</option>
                                            <option value="Sweden">Sweden</option>
                                            <option value="Switzerland">Switzerland</option>
                                            <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                                            <option value="Taiwan">Taiwan</option>
                                            <option value="Tajikistan">Tajikistan</option>
                                            <option value="Tanzania, United Rep. of">Tanzania, United Rep. of</option>
                                            <option value="Thailand">Thailand</option>
                                            <option value="Togo">Togo</option>
                                            <option value="Tonga">Tonga</option>
                                            <option value="Trinidad &amp; Tobago">Trinidad &amp; Tobago</option>
                                            <option value="Tunisia">Tunisia</option>
                                            <option value="Turkey">Turkey</option>
                                            <option value="Turkmenistan">Turkmenistan</option>
                                            <option value="Uganda">Uganda</option>
                                            <option value="Ukraine">Ukraine</option>
                                            <option value="United Arab Emirates">United Arab Emirates</option>
                                            <option value="United Kingdom">United Kingdom</option>
                                            <option value="United States">United States</option>
                                            <option value="Uruguay">Uruguay</option>
                                            <option value="Uzbekistan">Uzbekistan</option>
                                            <option value="Vanuatu">Vanuatu</option>
                                            <option value="Venezuela">Venezuela</option>
                                            <option value="Viet Nam">Viet Nam</option>
                                            <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                                            <option value="Yemen">Yemen</option>
                                            <option value="Zambia">Zambia</option>
                                            <option value="Zimbabwe">Zimbabwe</option>
                                        </select>
                                    </div>
                                    <div class="input_area">
                                        <label for="address">Address</label>
                                        <input name="address" required id="address" type="text" class="base_input"
                                            value="<?php echo $user['address']?>" placeholder="Address" />
                                    </div>
                                </div>
                                <br />
                                <div class="flex_inputs">
                                    <div class="input_area">
                                        <label for="city">City</label>
                                        <input name="city" required id="city" type="text" class="base_input"
                                            value="<?php echo $user['city']?>" placeholder="City Name" />
                                    </div>

                                    <div class="input_area">
                                        <label for="zipcode">ZIP Code</label>
                                        <input name="zipcode" required id="zipcode" type="text" class="base_input"
                                            value="<?php echo $user['zipcod']?>" placeholder="ZIP Code" />
                                    </div>
                                </div>
                                <br />
                                <div class="flex_inputs">
                                    <div class="input_area">
                                        <label for="date-of-birth">Date of Birth</label>
                                        <input name="birth" required id="date-of-birth" type="date" class="base_input"
                                            value="<?php echo $user['datebirth']?>" placeholder="Address" />
                                    </div>

                                    <div class="input_area">
                                        <label for="m_number">Mobile Number</label>
                                        <input required id="m_number" type="text" class="base_input"
                                            value="<?php echo $user['mobile']?>" placeholder="+880139123704" />
                                    </div>
                                </div>
                                <br />

                                <div class="input_area">
                                    <label for="a_info">Select Profile Picture</label>
                                    <input name="img" style="height: fit-content; padding: 12px" type="file"
                                        class="base_input" />
                                    <p>
                                        <small><small>Allowed file types: PNG, JPG, PDF | Max file size:
                                                10 MB</small></small>
                                    </p>
                                </div>


                                <br />
                                <div>
                                    <label for="facebook_profile">Facebook Profile</label>
                                    <div class="base_input_icon">
                                        <div class="icon">
                                            <span>
                                                <i class="fab fa-facebook"></i>
                                            </span>
                                        </div>
                                        <input name="facebook" type="text" placeholder="Facebook Profile Link"
                                            value="<?php echo $user['facebook']?>" id="facebook_profile" />
                                    </div>
                                </div>

                                <br />
                                <div>
                                    <label for="twitter_p">Twitter</label>
                                    <div class="base_input_icon">
                                        <div class="icon">
                                            <span>
                                                <i class="fab fa-twitter"></i>
                                            </span>
                                        </div>
                                        <input name="twiter" type="text" placeholder="Twitter Profile Link"
                                            value="<?php echo $user['twiter']?>" id="twitter_p" />
                                    </div>
                                </div>

                                <br />
                                <button type="submit" name="profile-submit" class="base_btn profile_save">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include"common/footer.php";?>