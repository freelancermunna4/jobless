<?php
	require_once"common/sidebar.php";
    if(!$is_online){ header("Location: about");  } 
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
                                <h6>YOUR STATISTICS</h6>
                            </div>
                        </div>

                        <div class="dc_box_container">
                            <div class="boxes">
                                <div class="box">
                                    <div class="value_area">
                                        <span class="value_area_icon">
                                            <i class="fa-solid fa-coins"></i></span>
                                        <span class="value"><?php echo $data['coins']?></span>
                                    </div>
                                    <div class="title">Your Coins</div>
                                </div>

                                <div class="box">
                                    <div class="value_area">
                                        <span class="value_area_icon">
                                            <i class="fa-solid fa-dollar-sign"></i>
                                        </span>
                                        <span class="value">10.00</span>
                                    </div>
                                    <div class="title">Cash Balance</div>
                                </div>

                                <div class="box">
                                    <div class="value_area">
                                        <span class="value_area_icon">
                                            <i class="fa-solid fa-users"></i>
                                        </span>
                                        <span class="value">
                                            <?php
                                            $refLink=$ses_id+100;
                                            $ref=_getAllData($db,"SELECT * FROM `users` WHERE ref=$refLink");
                                            
                                                $dt=0;
                                                foreach($ref as $rf){
                                                    $dt++;
                                                }
                                                echo $dt;
                                            ?>
                                        </span>
                                    </div>
                                    <div class="title">Your Referrals</div>
                                </div>

                                <div class="box">
                                    <div class="value_area">
                                        <span class="value_area_icon">
                                            <i class="fa-solid fa-dollar-sign"></i>
                                        </span>
                                        <span class="value">10.00</span>
                                    </div>
                                    <div class="title">Total Earned</div>
                                </div>

                                <div class="box">
                                    <div class="value_area">
                                        <span class="value_area_icon"><i class="fa-solid fa-star"></i>
                                        </span>
                                        <span class="value">FREE</span>
                                    </div>
                                    <div class="title">Membership</div>
                                </div>

                                <div class="box">
                                    <div class="value_area">
                                        <span class="value_area_icon"><i class="fa-solid fa-right-left"></i>
                                        </span>
                                        <span class="value">7</span>
                                    </div>
                                    <div class="title">Total Exchanges</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include"common/footer.php"; ?>