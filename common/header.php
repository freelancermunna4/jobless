<?php
	require_once"system/functions.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo $config['site_name']; ?>- Earn money with easy tasks</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="HandheldFriendly" content="true" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/images/<?= $config['favicon']; ?>" type="image/x-icon" />

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Merienda:wght@400;700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Oswald:wght@200;300;400;500;600;700&display=swap"
        rel="stylesheet" />

    <!-- FONT-AWESOME -->
    <script src="https://kit.fontawesome.com/6788eb3be6.js" crossorigin="anonymous"></script>

    <!-- BEGIN CSS STYLES -->
    <link rel="stylesheet" href="assets/css/style.css" type="text/css" media="all" />
    <!-- END CSS STYLES -->
    <!-- coustom by arif -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- coustom by arif -->

    <link rel="stylesheet" href="assets/css/jquery-confirm.min.css">
<script src="assets/js/jquery-confirm.min.js"></script>

<script src="assets/js/sweetalert.min.js"></script>



</head>

<body>
    <!-- Header -->
    <header class="header">
        <div class="container">
            <div class="header_left">
                <button id="sidebar_nav_toggler">
                    <span class="header_icon">
                        <i class="fas fa-bars"></i>
                    </span>
                </button>
                <a href="index" class="logo">
                    <img src="assets/icons/working.png" alt="" />
                    <span><?php echo $config['site_name'];?></span>
                </a>
            </div>

            <ul class="header_right">

                <?php if ($is_online){ ?>
                <li class="deposit_btn">
                    <a href="deposit" class="base_gradient_btn blue">
                        <span class="icon"> <i class="fa-solid fa-wallet"></i> </span>
                        <span>Deposit</span>
                    </a>
                </li>

                <li class="my_profile_btn">
                    <a href="#" id="profile-options-toggler">
                    <?php
                            $uid=$data['id'];
                            $user=_getData($db,"SELECT * FROM users WHERE id='$uid'");
                            ?>
                        <img class="profile_image" src="<?php if(empty($user['image'])){
                            echo "assets/images/anonymouse.jpg";
                        }else{
                            echo $user['image'];} ?>" alt="" />
                    </a>

                    <div class="profile-options">
                        <div>
                            <img class="profile_image" src="<?php if(empty($user['image'])){
                            echo "assets/images/anonymouse.jpg";
                        }else{
                            echo $user['image'];} ?>" alt="" />
                            <div>
                                <?php
                                if($data['id']>0){

                                    $uname=$user['fullname'];
                                    echo "<p><b>".$uname."</b></p>";

                                }else{
                                    echo "<p><b>John Doe</b></p>";
                                }
                                ?>

                                <p><a href="my-account">Dashboard</a></p>
                            </div>
                        </div>

                        <ul>
                            <?php $admin=$data['admin'];
                            if($admin==1){ ?>
                            <li>
                                <a target="_blank" href="admin/index.php">
                                    <span class="icon"><i class="fa-solid fa-user"></i> </span>
                                    <span class="text">Admin Panel</span>
                                </a>
                            </li>
                            <?php } ?>

                            <li>
                                <a href="profile">
                                    <span class="icon"><i class="fa-solid fa-user"></i> </span>
                                    <span class="text">Profile</span>
                                </a>
                            </li>

                            <li>
                                <a href="withdraw">
                                    <span class="icon">
                                        <i class="fa-solid fa-credit-card"></i>
                                    </span>
                                    <span class="text">Withdraw Money</span>
                                </a>
                            </li>
                        </ul>

                        <ul>
                            <li>
                                <a href="contact">
                                    <span class="icon"><i class="fa-solid fa-address-book"></i>
                                    </span>
                                    <span class="text">Contact US</span>
                                </a>
                            </li>
                            <li>
                                <a href="about">
                                    <span class="icon"><i class="fa-solid fa-info-circle"></i>
                                    </span>
                                    <span class="text">About US</span>
                                </a>
                            </li>

                            <li>
                                <a href="#" class="log-out">
                                    <span class="icon"><i class="fa-solid fa-arrow-right-from-bracket"></i>
                                    </span>
                                    <span class="text">Logout</span>
                                </a>
                            </li>
                        </ul>

                        <div class="buttons">
                            <a href="deposit" class="header_deposit_btn gradient_blue_btn deposit_btn">
                                <span class="icon">
                                    <i class="fas fa-wallet"></i>
                                </span>
                                <span>Deposit</span>
                            </a>
                        </div>
                    </div>
                </li>
                <?php } else{?>
                <li class="signup_btn show_fsp" data-ref="signup">
                    <a href="#" class="">
                        <span>Signup</span>
                    </a>
                </li>

                <li class="login_btn show_fsp" data-ref="login">
                    <a href="#" class="base_gradient_btn">
                        <span class="icon"><i class="fa-solid fa-lock"></i> </span>
                        <span>Login</span>
                    </a>
                </li>
                <?php } ?>

            </ul>
        </div>
    </header>

    <?php
        $top_ad=_getData($db,"SELECT * FROM `ads` WHERE name='top'");
        $bottom_ad=_getData($db,"SELECT * FROM `ads` WHERE name='bottom'");
        $side_ad=_getData($db,"SELECT * FROM `ads` WHERE name='side'");
    ?>