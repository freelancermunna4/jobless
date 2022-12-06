<?php
 if(isset($_GET['ref'])&&is_numeric($_GET['ref'])&& !empty($_GET['ref'])){

    setcookie("PT_REF_ID", $_GET['ref'], time() + (86400*360), "/");
    header("Location: index");
}


?>
<div style="text-align: center;">
<?php if(!empty($bottom_ad['code'])){  echo base64_decode($bottom_ad['code']);} ?>
</div>


<footer class="main_footer">
    <div class="footer_container">
        <div class="footer_left">
        <?= $config['foder'] ?>

        </div>
        <ul class="footer_right">
            <li>
                <a href="<?= $config['fb'] ?>"  target="_blank" style="color: blueviolet">
                    <i class="fab fa-facebook"></i>
                </a>
            </li>
            <li>
                <a href="<?= $config['tw'] ?>"  target="_blank" style="color: blueviolet">
                    <i class="fab fa-twitter"></i>
                </a>
            </li>
            <li>
                <a href="<?= $config['yt'] ?>"  target="_blank" style="color: red">
                    <i class="fab fa-youtube"></i>
                </a>
            </li>
            <li>
                <a href="<?= $config['ld'] ?>"  target="_blank" style="color: blueviolet">
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
<div id="loginpop" class="full_screen_popup" data-ref="login">
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
            <a href="#" onclick="resetpassword()"><small><u>Forgot Password</u></small></a>
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
            <label for="signup_number"><small>Your Name</small></label>
            <div class="base_input_icon">
                <div class="icon">
                    <span>
                    <i class="fa-solid fa-user"></i>
                    </span>
                </div>
                <input type="text" placeholder="Your Name" id="uname" required />
            </div>
        </div>


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
            <label for="signup_number"><small>Email</small></label>
            <div class="base_input_icon">
                <div class="icon">
                    <span>
                    <i class="fa-solid fa-envelope"></i>
                    </span>
                </div>
                <input type="email" placeholder="Email" id="email" required />
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
                    <i class="fa-solid fa-retweet"></i>
                    </span>
                </div>
                <input type="number" placeholder="refarel" id="confirm_refarel"
                    value="<?php echo $_COOKIE['PT_REF_ID'] ?>" required />
            </div>
        </div>

        <button class="base_btn sineupbtn">Signup</button>
    </div>
</div>
<!-- All Popups -->


<!-- reset Popup -->
<div id="resetpo" class="full_screen_popup" data-ref="reset" style="display: block;margin-top: 150px;width: 50%;padding: 10px;display: none;" >
    <div class="fsp_overlay"></div>
    <div class="fsp_content">
        <h6>reset</h6>
        <p class="loginerr" style="color: red;font-size: 15px;text-align: center;"></p>

        <div>
            <label for="password"><small>Password</small></label>
            <div class="base_input_icon">
                <div class="icon">
                <i class="fa-solid fa-envelope"></i>
                </div>
                <input type="email" placeholder="Email" id="emailreset" required />
            </div>
        </div>


        <button class="" onclick="resetpassworsfinal()" style="padding: 0 20px;width: fit-content;height: 40px;color: #fff;font-size: 12px;background: #5f22d1;border-radius: 3px;">reset</button>
    </div>
</div>





<div id="popup_message"></div>
<script src="assets/js/main.js"></script>
<script src="assets/js/login.js"></script>
</body>

</html>