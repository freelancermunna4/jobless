<?php
 if(isset($_GET['ref'])&&is_numeric($_GET['ref'])&& !empty($_GET['ref'])){
        
    setcookie("PT_REF_ID", $_GET['ref'], time() + (86400*360), "/");
    header("Location: index");
}
	//$footer= $db->QueryFetchArray("SELECT * FROM `footer` WHERE id=1");

?>


<footer class="main_footer">
    <div class="footer_container">
        <div class="footer_left">
            ©Jobless Inc.. 2019 All rights reserved.
        </div>
        <ul class="footer_right">
            <li>
                <a href="#" style="color: blueviolet">
                    <i class="fab fa-facebook"></i>
                </a>
            </li>
            <li>
                <a href="#" style="color: blueviolet">
                    <i class="fab fa-twitter"></i>
                </a>
            </li>
            <li>
                <a href="#" style="color: red">
                    <i class="fab fa-youtube"></i>
                </a>
            </li>
            <li>
                <a href="#" style="color: blueviolet">
                    <i class="fab fa-linkedin"></i>
                </a>
            </li>
        </ul>
    </div>
</footer>
</div>
<!--===== main page content =====-->
</main>

<!-- All Popups -->
<!-- Login Popup -->
<div class="full_screen_popup" data-ref="login">
    <div class="fsp_overlay"></div>
    <div class="fsp_content">
        <h6>Login</h6>
        <p class="loginerr" style="color: red;font-size: 15px;text-align: center;"></p>
        <div>
            <label for="number"><small>Mobile Number</small></label>
            <div class="base_input_icon">
                <div class="icon">
                    <span>
                        <i class="fa-solid fa-phone"></i>
                    </span>
                </div>
                <input type="text" placeholder="Number" id="number" required />
            </div>
        </div>

        <div>
            <label for="password"><small>Password</small></label>
            <div class="base_input_icon">
                <div class="icon">
                    <span><i class="fa-solid fa-lock"></i> </span>
                </div>
                <input type="password" placeholder="Password" id="password" required />
            </div>
        </div>

        <div>
            <a href="#"><small><u>Forgot Password</u></small></a>
        </div>
        <button class="base_btn loginbutton">Login</button>
    </div>
</div>

<!-- Signup Popup -->
<div class="full_screen_popup" data-ref="signup">
    <div class="fsp_overlay"></div>
    <div class="fsp_content">
        <h6 style="text-align: center;">Create Account</h6>
        <p class="sinuperr" style="color: red;font-size: 15px;text-align: center;"></p>
        <div>
            <label for="signup_number"><small>Mobile Number</small></label>
            <div class="base_input_icon">
                <div class="icon">
                    <span>
                        <i class="fa-solid fa-phone"></i>
                    </span>
                </div>
                <input type="text" placeholder="Number" id="signup_number" required />
            </div>
        </div>

        <div>
            <label for="signup_password"><small>Password</small></label>
            <div class="base_input_icon">
                <div class="icon">
                    <span>
                        <i class="fa-solid fa-lock"></i>
                    </span>
                </div>
                <input type="password" placeholder="Password" id="signup_password" required />
            </div>
        </div>

        <div>
            <label for="confirm_password"><small>Confirm Password</small></label>
            <div class="base_input_icon">
                <div class="icon">
                    <span>
                        <i class="fa-solid fa-lock"></i>
                    </span>
                </div>
                <input type="password" placeholder="Password" id="confirm_password" required />
            </div>
        </div>

        <div>
            <label for="confirm_refarel"><small>Refarel Code <small> ( Optional )</small></small></label>
            <div class="base_input_icon">
                <div class="icon">
                    <span>
                        <i class="fa-solid fa-lock"></i>
                    </span>
                </div>
                <input type="number" placeholder="refarel" id="confirm_refarel"
                    value="<?php echo $_COOKIE['PT_REF_ID'] ?>" required />
            </div>
        </div>

        <button class="base_btn">Signup</button>
    </div>
</div>
<!-- All Popups -->


<script src="assets/js/main.js"></script>
<script src="assets/js/login.js"></script>
</body>

</html>