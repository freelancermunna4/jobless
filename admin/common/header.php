<?php
	require_once"../system/functions.php";
  if(!$is_online || $data['admin'] !=1){ header("Location: ".$config['site_url']."");}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $config['site_name']; ?> ADMIN Panel</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="../assets/images/<?= $config['favicon']; ?>" type="image/x-icon" />
    <!--=== Google Font  ===-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">


    <link rel="shortcut icon" href="./assets/favicon.ico" type="image/x-icon">

    <!--=== FONT-AWESOME  ===-->
    <script src="https://kit.fontawesome.com/6788eb3be6.js" crossorigin="anonymous"></script>

    <!--=== Styles ===-->
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="../assets/css/jquery-confirm.min.css">
    <script src="../assets/js/jquery-confirm.min.js"></script>
    <script src="../assets/js/sweetalert.min.js"></script>


    <link rel="stylesheet" href="css/styles.css">
    <script src="../assets/js/sweetalert.min.js"></script>
</head>

<body>

    <main class="flex p-0 m-0 justify-between w-full h-screen overflow-hidden">

        <!--== Sidebar ==-->
        <div id="sidebar"
            class="sidebar transition-all w-[0px] min-w-[0px] lg:min-w-[255px] lg:w-[255px] h-screen overflow-auto bg-white border-r shadow sidebar fixed lg:relative inset-y-0 left-0"
            style="z-index: 99;">

            <div
                class="flex items-center justify-between px-4 gap-x-2 h-20 border-b shadow-sm sticky top-0 left-0 bg-white z-50">
                <a class="flex items-center justify-between gap-x-2 active" href="./index.php">
                    <p class="text-blue-600"> <i class="fa-solid fa-crown"></i> </p>
                    <p class="flex items-center justify-center"><span
                            class="font-semibold text-lg text-blue-500"><?= $config['site_name']; ?></span><span
                            class="font-bold text-lg text-purple-700">ADMIN</span></p>
                </a>
                <button id="hide_sidebar" class="lg:hidden text-gray-800"> <i class="fa-solid fa-xmark"></i> </button>
            </div>

            <!-- Sidebar Item -> Statistics -->
            <div class="sidebar_item overflow-hidden">
                <button class="ds_title active" data-ref="STATISTICS">
                    <span class="text-xs transition-all text-purple-600"><i class="fa-solid fa-chart-simple"></i></span>
                    <span class="tracking-wider block">STATISTICS</span>
                    <span class="text-xs transition-all"><i class="fa-solid fa-chevron-up"></i></span>
                </button>
                <ul class="ds_ul transition-all" data-ref="STATISTICS">
                    <li>
                        <a class="active" href="./index.php">
                            <h4> <i class="fa-solid fa-gauge"></i> </h4>
                            <span>Dashboard</span>
                        </a>
                    </li>
                </ul>
            </div>
            <hr class="my-0">

            <!-- Sidebar Item -> Bank -->
            <div class="sidebar_item overflow-hidden">
                <button class="ds_title" data-ref="BANK"><span class="text-xs transition-all text-orange-500"><i
                            class="fa-solid fa-building-columns"></i></span><span
                        class="tracking-wider block">BANK</span><span class="text-xs opacity-50 transition-all"><i
                            class="fa-solid fa-chevron-up"></i></span>
                </button>
                <ul class="ds_ul transition-all" data-ref="BANK">
                    <li>
                        <a href="./deposit-requests.php">
                            <h4> <i class="fa-solid fa-money-bill"></i> </h4>
                            <span>Deposit Requests</span>
                        </a>
                    </li>

                    <li>
                        <a href="./deposit-history.php">
                            <h4> <i class="fa-solid fa-money-bill"></i> </h4>
                            <span>Reject Deposit</span>
                        </a>
                    </li>
                    <li>
                        <a href="./withdrawl-requests.php">
                            <h4> <i class="fa-solid fa-money-bill-transfer"></i> </h4>
                            <span>Withdrawl Requests</span>
                        </a>
                    </li>
                    <li>
                        <a href="./withdrawl-history.php">
                            <h4> <i class="fa-solid fa-money-bill"></i> </h4>
                            <span>Reject Withdrawl</span>
                        </a>
                    </li>
                </ul>
            </div>
            <hr class="my-0">

            <!-- Sidebar Item -> Users -->
            <div class="sidebar_item overflow-hidden">
                <button class="ds_title" data-ref="USERS"><span class="text-xs transition-all text-cyan-600"><i
                            class="fa-solid fa-users"></i></span><span class="tracking-wider block">USERS</span><span
                        class="text-xs opacity-50 transition-all"><i class="fa-solid fa-chevron-up"></i></span>
                </button>
                <ul class="ds_ul transition-all" data-ref="USERS">
                    <li>
                        <a href="./admin.php">
                            <h4> <i class="fa-solid fa-users"></i> </h4>
                            <span>All Admin</span>
                        </a>
                    </li>
                    <li>
                        <a href="./users.php">
                            <h4> <i class="fa-solid fa-users"></i> </h4>
                            <span>All Users</span>
                        </a>
                    </li>
                    <li>
                        <a href="./top-20-users.php">
                            <h4> <i class="fa-solid fa-users"></i> </h4>
                            <span>Top 20 Users</span>
                        </a>
                    </li>
                    <li>
                        <a href="./banned-users.php">
                            <h4> <i class="fa-solid fa-users"></i> </h4>
                            <span>Banned Users</span>
                        </a>
                    </li>

                </ul>


            </div>
            <hr class="my-0">

            <!-- Sidebar Item -> Jobs -->
            <div class="sidebar_item overflow-hidden">
                <button class="ds_title" data-ref="JOBS"><span class="text-xs transition-all text-pink-600"><i
                            class="fa-solid fa-briefcase"></i></span><span class="tracking-wider block">JOBS</span><span
                        class="text-xs opacity-50 transition-all"><i class="fa-solid fa-chevron-up"></i></span>
                </button>
                <ul class="ds_ul transition-all" data-ref="JOBS">
                    <li>
                        <a href="./add-new-job.php">
                            <h4> <i class="fa-solid fa-briefcase"></i> </h4>
                            <span>Add New Job</span>
                        </a>
                    </li>
                    <li>
                        <a href="./my-jobs.php">
                            <h4> <i class="fa-solid fa-briefcase"></i> </h4>
                            <span>My Jobs</span>
                        </a>
                    </li>
                    <li>
                        <a href="./request-jobs.php">
                            <h4> <i class="fa-solid fa-briefcase"></i> </h4>
                            <span>Request Aprove Jobs</span>
                        </a>
                    </li>

                    <li>
                        <a href="./active-jobs.php">
                            <h4> <i class="fa-solid fa-briefcase"></i> </h4>
                            <span>Active Jobs</span>
                        </a>
                    </li>


                    <li>
                        <a href="./success-jobs.php">
                            <h4> <i class="fa-solid fa-briefcase"></i> </h4>
                            <span>Success Jobs</span>
                        </a>
                    </li>

                    <li>
                        <a href="./band-jobs.php">
                            <h4> <i class="fa-solid fa-briefcase"></i> </h4>
                            <span>Banded Jobs</span>
                        </a>
                    </li>



                </ul>
            </div>
            <hr class="my-0">

                       <!-- Sidebar Item -> Product -->
                       <div class="sidebar_item overflow-hidden">
                <button class="ds_title" data-ref="Product"><span class="text-xs transition-all text-pink-600"><i class="fa-solid fa-handshake"></i></span><span class="tracking-wider block">Buy & Sell</span><span
                        class="text-xs opacity-50 transition-all"><i class="fa-solid fa-chevron-up"></i></span>
                </button>
                <ul class="ds_ul transition-all" data-ref="Product">
                    <li>
                        <a href="./pending-product.php">
                            <h4> <i class="fa-solid fa-briefcase"></i> </h4>
                            <span>Pending Product</span>
                        </a>
                    </li>

                    <li>
                        <a href="./running-product.php">
                            <h4> <i class="fa-solid fa-briefcase"></i> </h4>
                            <span>Running Product</span>
                        </a>
                    </li>


                    <li>
                        <a href="./completed-product.php">
                            <h4> <i class="fa-solid fa-briefcase"></i> </h4>
                            <span>Completed Product</span>
                        </a>
                    </li>

                </ul>
            </div>
            <hr class="my-0">

            <!-- Sidebar Item -> Websites -->
            <div class="sidebar_item overflow-hidden">
                <button class="ds_title" data-ref="Website"><span class="text-xs transition-all text-slate-600"><i
                            class="fa fa-internet-explorer"></i></span><span
                        class="tracking-wider block">Website</span><span class="text-xs opacity-50 transition-all"><i
                            class="fa-solid fa-chevron-up"></i></span>
                </button>
                <ul class="ds_ul transition-all" data-ref="Website">
                    <li>
                        <a href="./add-website.php">
                            <h4> <i class="fa fa-internet-explorer"></i> </h4>
                            <span>Add Website</span>
                        </a>
                    </li>
                    <li>
                        <a href="./active-websites.php">
                            <h4> <i class="fa fa-internet-explorer"></i> </h4>
                            <span>Active Websites</span>
                        </a>
                    </li>

                    <li>
                        <a href="./band-websites.php">
                            <h4> <i class="fa fa-internet-explorer"></i> </h4>
                            <span>Band Websites</span>
                        </a>
                    </li>

                    <li>
                        <a href="./all-website-packs.php">
                            <h4> <i class="fa fa-internet-explorer"></i> </h4>
                            <span>All Website Packs</span>
                        </a>
                    </li>

                    <li>
                        <a href="./add-website-pack.php">
                            <h4> <i class="fa fa-internet-explorer"></i> </h4>
                            <span>Add Website Packs</span>
                        </a>
                    </li>
                </ul>
            </div>
            <hr class="my-0">

            <!-- Sidebar Item -> Video Ads -->
            <div class="sidebar_item overflow-hidden">
                <button class="ds_title" data-ref="Video Ads"><span class="text-xs transition-all text-black"><i
                            class="fa-solid fa-play-circle"></i></span><span class="tracking-wider block">Video
                        View</span><span class="text-xs opacity-50 transition-all"><i
                            class="fa-solid fa-chevron-up"></i></span>
                </button>
                <ul class="ds_ul transition-all" data-ref="Video Ads">
                    <li>
                        <a href="./add-video.php">
                            <h4> <i class="fa-solid fa-play"></i> </h4>
                            <span>Add Video</span>
                        </a>
                    </li>
                    <li>
                        <a href="./active-videos.php">
                            <h4> <i class="fa-solid fa-play"></i> </h4>
                            <span>Active Videos</span>
                        </a>
                    </li>

                    <li>
                        <a href="./all-video-packs.php">
                            <h4> <i class="fa-solid fa-play"></i> </h4>
                            <span>All Video Packs</span>
                        </a>
                    </li>
                    <li>
                        <a href="./add-video-pack.php">
                            <h4> <i class="fa-solid fa-play"></i> </h4>
                            <span>Add Video Packs</span>
                        </a>
                    </li>
                </ul>
            </div>
            <hr class="my-0">
            <!-- Sidebar Item -> Subscriber -->
            <div class="sidebar_item overflow-hidden">
                <button class="ds_title" data-ref="subscriber"><span class="text-xs transition-all text-black"><i
                            class="fa-brands fa-youtube"></i></span><span class="tracking-wider block">Youtube
                        Subscriber</span><span class="text-xs opacity-50 transition-all"><i
                            class="fa-solid fa-chevron-up"></i></span>
                </button>
                <ul class="ds_ul transition-all" data-ref="subscriber">


                    <li>
                        <a href="./apikey.php">
                            <h4> <i class="fa-solid fa-play"></i> </h4>
                            <span>Add Youtube Api</span>
                        </a>
                    </li>

                    <li>
                        <a href="./active-subscriber.php">
                            <h4> <i class="fa-solid fa-play"></i> </h4>
                            <span>Active Subscriber</span>
                        </a>
                    </li>

                    <li>
                        <a href="./all-subscribe-pack.php">
                            <h4> <i class="fa-solid fa-play"></i> </h4>
                            <span>All Subscriber Packs</span>
                        </a>
                    </li>
                    <li>
                        <a href="./add-subs-pack.php">
                            <h4> <i class="fa-solid fa-play"></i> </h4>
                            <span>Add Subscriber Packs</span>
                        </a>
                    </li>

                </ul>
            </div>
            <hr class="my-0">

            <!-- Sidebar Item -> Gift Recharge -->
            <div class="sidebar_item overflow-hidden">
                <button class="ds_title" data-ref="Lucky Coupon"><span class="text-xs transition-all text-green-600"><i
                            class="fa-solid fa-gifts"></i></span><span class="tracking-wider block">Gift
                        Recharge</span><span class="text-xs opacity-50 transition-all"><i
                            class="fa-solid fa-chevron-up"></i></span>
                </button>
                <ul class="ds_ul transition-all" data-ref="Lucky Coupon">

                    <li>
                        <a href="./add-gift-timer.php">
                            <h4> <i class="fa-solid fa-gifts"></i> </h4>
                            <span>Add Timer</span>
                        </a>
                    </li>

                    <li>
                        <a href="./pending-winner.php">
                            <h4> <i class="fa-solid fa-gifts"></i> </h4>
                            <span>Pending Winner</span>
                        </a>
                    </li>
                    <li>
                        <a href="./all-winner.php">
                            <h4> <i class="fa-solid fa-gifts"></i> </h4>
                            <span>All Winner</span>
                        </a>
                    </li>
                </ul>
            </div>
            <hr class="my-0">






            <!-- Sidebar Item -> Lottery -->
            <div class="sidebar_item overflow-hidden">
                <button class="ds_title" data-ref="Lottery"><span class="text-xs transition-all text-green-700"><i
                            class="fa-solid fa-box"></i></span><span class="tracking-wider block">Gift
                        Rewards</span><span class="text-xs opacity-50 transition-all"><i
                            class="fa-solid fa-chevron-up"></i></span>
                </button>
                <ul class="ds_ul transition-all" data-ref="Lottery">
                    <li>
                        <a href="./add-new-lottery.php">
                            <h4> <i class="fa-solid fa-gifts"></i> </h4>
                            <span>Add New Lottery</span>
                        </a>
                    </li>

                    <li>
                        <a href="./all-lottery.php">
                            <h4> <i class="fa-solid fa-gifts"></i> </h4>
                            <span>All Lottery</span>
                        </a>
                    </li>

                    <li>
                        <a href="./lottery-winner.php">
                            <h4> <i class="fa-solid fa-gifts"></i> </h4>
                            <span>Pending Winner</span>
                        </a>
                    </li>

                    <li>
                        <a href="./lottery-setting.php">
                            <h4> <i class="fa-solid fa-gifts"></i> </h4>
                            <span>Lottery Setting</span>
                        </a>
                    </li>

                    <li>
                        <a href="./winner-lottery.php">
                            <h4> <i class="fa-solid fa-gifts"></i> </h4>
                            <span>All Winner</span>
                        </a>
                    </li>

                </ul>
            </div>




            <hr class="my-0">
            <!-- Sidebar Item -> Game -->
            <div class="sidebar_item overflow-hidden">
                <button class="ds_title" data-ref="Game"><span class="text-xs transition-all text-green-800">
                        <i class="fa-solid fa-trophy"></i>
                    </span><span class="tracking-wider block">Game Rewards</span><span
                        class="text-xs opacity-50 transition-all"><i class="fa-solid fa-chevron-up"></i></span>
                </button>
                <ul class="ds_ul transition-all" data-ref="Game">

                    <li>
                        <a href="./game-settings.php">
                            <h4> <i class="fa-solid fa-gifts"></i> </h4>
                            <span>Settings</span>
                        </a>
                    </li>

                </ul>
            </div>

            <hr class="my-0">
            <!-- Sidebar Item -> TIKETS -->
            <div class="sidebar_item overflow-hidden">
                <button class="ds_title" data-ref="TIKETS">
                    <span class="text-xs transition-all text-orange-600"><i class="fa-solid fa-ticket"></i></span>
                    <span class="tracking-wider block">All Tikets</span>
                    <span class="text-xs transition-all"><i class="fa-solid fa-chevron-up"></i></span>
                </button>

                <ul class="ds_ul transition-all" data-ref="TIKETS">
                    <li>
                        <a href="./all-tiket.php">
                            <h4> <i class="fa-solid fa-cog"></i> </h4>
                            <span>Pending Tikets</span>
                        </a>
                    </li>

                    <li>
                        <a href="./success-tiket.php">
                            <h4> <i class="fa-solid fa-cog"></i> </h4>
                            <span>Replied Tikets</span>
                        </a>
                    </li>

                </ul>
            </div>


            <hr class="my-0">
            <!-- Sidebar Item -> Contact -->
            <div class="sidebar_item overflow-hidden">
                <button class="ds_title" data-ref="Contact">
                    <span class="text-xs transition-all text-orange-600"><i
                            class="fa-solid fa-square-envelope"></i></span>
                    <span class="tracking-wider block">All Contact</span>
                    <span class="text-xs transition-all"><i class="fa-solid fa-chevron-up"></i></span>
                </button>

                <ul class="ds_ul transition-all" data-ref="Contact">
                    <li>
                        <a href="./all-contact">
                            <h4> <i class="fa-solid fa-cog"></i> </h4>
                            <span>Pending Contact</span>
                        </a>
                    </li>

                    <li>
                        <a href="./success-contact.php">
                            <h4> <i class="fa-solid fa-cog"></i> </h4>
                            <span>Replied Contact</span>
                        </a>
                    </li>

                </ul>
            </div>



            <hr class="my-0">
            <!-- Sidebar Item -> REPORTS -->
            <div class="sidebar_item overflow-hidden">
                <button class="ds_title" data-ref="REPORTS">
                    <span class="text-xs transition-all text-orange-600"><i
                            class="fa-solid fa-circle-exclamation"></i></span>
                    <span class="tracking-wider block">REPORTS</span>
                    <span class="text-xs transition-all"><i class="fa-solid fa-chevron-up"></i></span>
                </button>

                <ul class="ds_ul transition-all" data-ref="REPORTS">
                    <li>
                        <a href="./reported-pages.php">
                            <h4> <i class="fa-solid fa-cog"></i> </h4>
                            <span>Reported Pages</span>
                        </a>
                    </li>

                </ul>
            </div>


            <!-- Sidebar Item -> Settings -->
            <div class="sidebar_item overflow-hidden">
                <button class="ds_title md:hidden" data-ref="SETTINGS">
                    <span class="text-xs transition-all text-gray-900"><i
                            class="fa-solid fa-screwdriver-wrench"></i></span>
                    <span class="tracking-wider block">SETTINGS</span>
                    <span class="text-xs transition-all"><i class="fa-solid fa-chevron-up"></i></span>
                </button>
                <a href="./settings.php" class="ds_title hidden md:flex" data-ref="SETTINGS">
                    <span class="text-xs transition-all"><i class="fa-solid fa-screwdriver-wrench"></i></span>
                    <span class="tracking-wider block">SETTINGS</span>
                    <span class="text-xs transition-all"><i class="fa-solid fa-chevron-right"></i></span>
                </a>
                <ul class="ds_ul transition-all md:hidden" data-ref="SETTINGS">
                    <li>
                        <a href="./settings.php">
                            <h4> <i class="fa-solid fa-cog"></i> </h4>
                            <span>General Setting</span>
                        </a>
                    </li>

                    <li>
                        <a href="./payment-gateway.html">
                            <h4> <i class="fa-solid fa-cog"></i> </h4>
                            <span>Payment Gateway</span>
                        </a>
                    </li>

                    <li>
                        <a href="./limit-setting.html">
                            <h4> <i class="fa-solid fa-cog"></i> </h4>
                            <span>Limit Setting</span>
                        </a>
                    </li>

                    <li>
                        <a href="./deposit-bank.html">
                            <h4> <i class="fa-solid fa-cog"></i> </h4>
                            <span>Deposit Bank</span>
                        </a>
                    </li>

                    <li>
                        <a href="./withdrawl-bank.html">
                            <h4> <i class="fa-solid fa-cog"></i> </h4>
                            <span>Withdrawl Bank</span>
                        </a>
                    </li>
                    <li>
                        <a href="./mailing-setting.html">
                            <h4> <i class="fa-solid fa-cog"></i> </h4>
                            <span>Mailing Setting</span>
                        </a>
                    </li>
                    <li>
                        <a href="./adsense.html">
                            <h4> <i class="fa-solid fa-cog"></i> </h4>
                            <span>Adsense</span>
                        </a>
                    </li>
                </ul>
            </div>

        </div>

        <!--== Page Content ==-->
        <div class="w-full h-screen overflow-auto">
            <header class="h-20 bg-white z-40 sticky top-0 left-0 right-0 shadow-sm border-b">
                <div class="h-full flex items-center relative justify-between px-5 xl:px-10">
                    <div class="text-xl font-semibold tracking-wide capitalize space-x-3">
                        <button id="sidebar_toggler">
                            <i class="fa-solid fa-bars"></i>
                        </button>
                        <span class="hidden sm:inline-block capitalize page_title">Dashboard</span>
                    </div>

                    <div class="flex items-center justify-center gap-x-3 sm:gap-x-4">
                        <div class="relative w-fit z-50"><button type="button"
                                class="header_options_toggler w-full p-2 rounded bg-gray-100 shadow border flex items-center justify-center gap-x-3">
                                <a target="_blank" href="https://joblessbd.com/">
                                    <span class="text-sm font-medium"><i class="fa fa-eye"></i></span></a>
                                <span>
                                    <?= $data['fullname'] ?> </span><img class="h-7 w-7 rounded-full"
                                    src="https://firebasestorage.googleapis.com/v0/b/bs-game-topup.appspot.com/o/images%2Fimages.png?alt=media&amp;token=f46fd874-00f4-48fe-a8ac-c43abf380491"
                                    alt=""> <small class="header_options_icon transition-all transform"><i
                                        class="fa-solid fa-chevron-right"></i></small>
                            </button>
                            <div
                                class="header_options absolute w-full bg-white rounded shadow top-full right-0 transition-all origin-top transform scale-y-0">
                                <button id="Logout" class="flex items-center gap-x-2 w-full  hover:bg-gray-100 p-3">
                                    <i class="fa-solid fa-arrow-right-from-bracket"></i><span
                                        class="text-sm font-medium">Logout</span></button>

                                <a target="_blank" href="<?= $config['site_url'] ?>"
                                    class="flex items-center gap-x-2 w-full  hover:bg-gray-100 p-3"> <i
                                        class="fa fa-internet-explorer"></i>
                                    <span class="text-sm font-medium">View Website</span></a>

                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <script>
            $('#Logout').click(() => {
                $.ajax({
                    type: "POST",
                    url: "../system/ajax",
                    data: "logout=" + "logout",

                    success: function(z) {
                        if (z.trim() == 0) {
                            location.reload(true);
                        }

                        setTimeout(function() {
                            if (msg.html().trim() == "Success") {
                                location.reload(true);
                            }
                        }, 1000);
                    },
                });
            })
            </script>