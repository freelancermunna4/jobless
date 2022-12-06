<?php
	require_once"header.php";
?>
<!-- Main Body Content -->
<main class="content_wrapper">
    <!--===== Sidebar Navigation =====-->
    <div class="sidebar_nav transparent_scrollbar">
        <div class="sidebar_nav_container">
            <ul class="sidebar_user_info">
                <div class="user_info_wrapper">
                    <img src="assets/images/anonymouse.jpg" alt="" />
                    <div class="user_details">
                        <h6 class="username">
                            <?php if($is_online){echo $data['fullname'];}else{ echo ' <span class="login_btn show_fsp" data-ref="login">Please Login</span>'; }?>
                        </h6>
                        <div>
                            <?php if($is_online){ ?>
                            <a href="my-account">My Account</a>
                            <span>|</span>
                            <button class="log-out">Logout</button>
                            <?php }?>


                        </div>
                    </div>
                </div>

                <div class="coins">
                    <b>Coins:</b>
                    <span><?php echo $data['coins']?></span>
                </div>

                <div class="button">
                    <?php if($is_online){ ?>
                    <a href="withdraw">Withdraw Money</a>
                    <?php }else{ ?>
                    <a href="#">Withdraw Money</a>
                    <?php }?>


                </div>
            </ul>

            <ul>
                <h6 class="sidebar_nav_title">Earn Coins</h6>

                <li class="dropdown">
                    <a href="#" class="dropdown_toggler">
                        <span class="icon" style="color: #1da1f2">
                            <img src="assets/icons/work.svg" alt="" /> </span><span>Jobs</span>
                        <span class="chevron_right">
                            <i class="fa fa-chevron-right"></i>
                        </span>
                    </a>

                    <ul>
                        <li><a href="jobs-view"> View </a></li>
                        <li><a href="completed-jobs"> Completed Jobs </a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown_toggler">
                        <span class="icon" style="color: #1da1f2">
                            <img src="assets/icons/website.svg" alt="" />
                        </span>
                        <span>Website</span>
                        <span class="chevron_right">
                            <i class="fa fa-chevron-right"></i>
                        </span>
                    </a>

                    <ul>
                        <li><a href="website-view"> View </a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown_toggler">
                        <span class="icon" style="color: red">
                            <i class="fab fa-youtube"></i>
                        </span>
                        <span>Youtube</span>
                        <span class="chevron_right">
                            <i class="fa fa-chevron-right"></i>
                        </span>
                    </a>

                    <ul>
                        <li><a href="youtube-views">Views</a></li>
                        <li><a href="youtube-subscribe">Subscribe</a></li>
                    </ul>
                </li>


            </ul>

            <ul>
                <h6 class="sidebar_nav_title">Promote</h6>

                <li class="dropdown">
                    <a href="#" class="dropdown_toggler">
                        <span class="icon" style="color: red">
                            <img src="assets/icons/work.svg" alt="" />
                        </span>
                        <span>Jobs</span>
                        <span class="chevron_right">
                            <i class="fa fa-chevron-right"></i>
                        </span>
                    </a>

                    <ul>
                        <li><a href="add-job">Add Job</a></li>
                        <li><a href="my-jobs">My Jobs</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown_toggler">
                        <span class="icon" style="color: red">
                            <img src="assets/icons/website.svg" alt="" />
                        </span>
                        <span>Website</span>
                        <span class="chevron_right">
                            <i class="fa fa-chevron-right"></i>
                        </span>
                    </a>

                    <ul>
                        <li><a href="add-website">Add Website</a></li>
                        <li><a href="my-websites">My Websites</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown_toggler">
                        <span class="icon" style="color: red">
                            <i class="fab fa-youtube"></i>
                        </span>
                        <span>Youtube</span>
                        <span class="chevron_right">
                            <i class="fa fa-chevron-right"></i>
                        </span>
                    </a>

                    <ul>
                        <li><a href="add-channel">Add Channel</a></li>
                        <li><a href="my-channels">My Channels</a></li>
                        <li><a href="add-video">Add Video</a></li>
                        <li><a href="my-videos">My Videos</a></li>
                    </ul>
                </li>


            </ul>

            <ul>
                <h6 class="sidebar_nav_title">Play & Wins</h6>
                <li>
                    <a href="lottery">
                        <img src="assets/icons/gift.png" alt="" />
                        <span>Lottery</span>
                    </a>
                </li>
                <li>
                    <a href="lottery-recharge">
                        <img src="assets/icons/wheel.png" alt="" />
                        <span>Lucky Recharge</span>
                    </a>
                </li>
            </ul>

            <ul>
                <h6 class="sidebar_nav_title">MORE</h6>
                <li>
                    <a href="contact">
                        <img src="assets/icons/contact.png" alt="" />
                        <span>Contact US</span>
                    </a>
                </li>
                <li>
                    <a href="about">
                        <img src="assets/icons/info.png" alt="" />
                        <span>About US</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="sidebar_nav_overlay"></div>
    <!--===== Sidebar Navigation End =====-->