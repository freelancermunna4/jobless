<?php
	require_once"common/sidebar.php";
    if(!$is_online){ header("Location: index");}     
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
                                        <i class="fa fa-user-plus"></i>
                                    </span>
                                    <span class="text"> Referrals </span>
                                </h6>
                            </div>
                        </div>

                        <div class="dc_box_container">
                            <div class="boxes">
                                <div class="box">
                                    <h2 style="text-align: center">
                                        <i class="fa fa-user-plus"></i>
                                    </h2>
                                    <span class="title">Total Referrals</span>
                                    <span class="value" style="text-align: center">
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

                                <div class="box">
                                    <h2 style="text-align: center">
                                        <i class="fa fa-money"></i>
                                    </h2>
                                    <span class="title">Your balance</span>
                                    <span class="value" style="text-align: center"><?php echo $data['coins'] ?></span>
                                </div>

                                <div class="box">
                                    <h2 style="text-align: center">
                                        <i class="fa-solid fa-percent"></i>
                                    </h2>
                                    <span class="title">Referral Comission</span>
                                    <span class="value"
                                        style="text-align: center"><?php echo $config['refarel_comition'];?>%</span>
                                </div>
                            </div>

                            <p style="
                        margin-top: 24px;
                        margin-bottom: 8px;
                        font-weight: 500;
                      ">
                                Your referral link:

                            </p>

                            <div class="copy_refarrel">
                                <input type="text"
                                    value="<?php echo $ref=$config['site_url'];?>/?ref=<?php echo $data[id]+100;?>"
                                    id="copy_refarrel_input" />

                                <button id="copy_btn">
                                    <i class="fa-solid fa-copy"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include"common/footer.php"; ?>