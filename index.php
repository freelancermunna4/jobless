<?php
	require_once"common/sidebar.php";
    if(isset($_GET['id'])&&isset($_GET['hash'])){
        $id= $db->EscapeString($_GET['id']);
        $hash= $db->EscapeString($_GET['hash']);
        $getu=_getData($db,"SELECT * FROM users WHERE id=$id AND password='$hash'");
        if($getu !=0){
            $_SESSION['User_Id']=$getu['id'];
            header('location:my-account');
        }

    }

 ?>



<!--===== main page content =====-->
<div class="content">
    <div class="container">
        <div class="home">
            <div style="text-align: center;">
                <?php if(!empty($top_ad['code'])){  echo base64_decode($top_ad['code']);} ?>
            </div>
            <div class="boxes">
                <div class="box">
                    <div class="value_area">
                        <span class="value_area_icon">
                            <i class="fa-solid fa-coins"></i></span>
                        <span class="value"><?php if($is_online){ echo($data['coins']); }else{ echo "00.00";} ?></span>
                    </div>
                    <div class="title">Your Coins</div>
                </div>


                <div class="box">
                    <div class="value_area">
                        <span class="value_area_icon">
                            <i class="fa-solid fa-coins"></i>
                        </span>
                        <span class="value">
                            <?php
                            if($is_online){
                                $withdraw=_getAllData($db,"SELECT * FROM `withdrawals` WHERE user_id='$ses_id' AND status=1");
                                $am=0;
                                foreach ($withdraw as $wm) {
                                    $am=$am+$wm['coins'];
                                }

                                echo $am;

                             }else{ echo "00.00";} ?>

                        </span>
                    </div>
                    <div class="title">Total Withdraw</div>
                </div>

                <div class="box">
                    <div class="value_area">
                        <span class="value_area_icon">
                            <i class="fa-solid fa-users"></i>
                        </span>
                        <span class="value">
                            <?php
                            if($is_online){
                                $myref=$ses_id+100;
                                $w=_getAllData($db,"SELECT * FROM `users` WHERE ref='$myref'");
                               if($w !=0){
                               echo count($w);
                               }else{ echo "0"; }

                             }else{ echo "0";} ?>


                        </span>
                    </div>
                    <div class="title">Your Referrals</div>
                </div>

                <div class="box">
                    <div class="value_area">
                        <span class="value_area_icon">
                            <i class="fa-solid fa-coins"></i>
                        </span>
                        <span class="value">
                            <?php if($is_online){ echo $data['totalarn'];}else{ echo "00.00";} ?>
                        </span>
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
                        <span class="value">
                            <?php if($is_online){ echo count($withdraw);}else{ echo 0;} ?>
                        </span>
                    </div>
                    <div class="title">Total Exchanges</div>
                </div>
            </div>

            <div class="description">
                <h4>Do you need some money?</h4>

                <p>
                    Who doesn't need money? Start earning free coins by watching
                    YouTube videos. Is free and it take a couple of minutes to earn
                    coins and convert them in real cash, paid to you using our
                    payment methods.
                </p>
            </div>

            <div class="description">
                <h4>Invite your friends and get more coins!</h4>

                <p>
                    Invite your friends using your special affiliate URL and receive
                    <b><?php echo $config['refarel_comition'];?>% of their earnings</b> for life
                </p>

                <div class="copy_refarrel">
                    <input type="text"
                        value="<?php echo $ref=$config['site_url'];?>/?ref=<?php if($is_online){ echo $data['id']+100;}else{ echo "Your Refarel id";} ?>"
                        id="copy_refarrel_input" />

                    <button id="copy_btn">
                        <i class="fa-solid fa-copy"></i>
                    </button>
                </div>

                <div class="share_buttons">
                    <button>
                        <span><i class="fa-solid fa-share"></i></span>
                        <span>Facebook</span>
                    </button>
                    <button>
                        <span><i class="fa-solid fa-share"></i></span>
                        <span>Twitter</span>
                    </button>
                    <button>
                        <span><i class="fa-solid fa-share"></i></span>
                        <span>WhatsApp</span>
                    </button>
                </div>
            </div>

            <div class="activities">
                <h5 class="title">Your Recent Activities</h5>

                <?php
                 include_once"system/time_ago.php";
                if($is_online){
                        $uid=$data['id'];
                            $activitis=_getAllData($db,"SELECT * FROM `activity` WHERE my_id=$uid OR clint_id=$uid ORDER BY id DESC LIMIT 2");
                            if($activitis !=0){
                            foreach ($activitis as $activiti) {

                                if( $activiti['my_id']==$uid){
                            ?>

                <div class="activity">
                    <div>
                        <img src="<?php echo $activiti['image'] ?>" alt="">
                        <b class="username">you</b>
                        <span class="action"><?php echo $activiti['middle_name'] ?></span>
                        <b class="username"><?php echo $activiti['clint_name'] ?></b>
                        <span class="action"><?php echo $activiti['last_name'] ?></span>
                    </div>

                    <div class="date"><?php echo time_ago($activiti['tim'], true) ?></div>
                </div>

                <?php }else{ ?>

                <div class="activity">
                    <div>
                        <img src="<?php echo $activiti['image'] ?>" alt=""> &nbsp;
                        <b class="username"><?php echo $activiti['clint_name'] ?></b>
                        <span class="action"><?php echo $activiti['middle_name'] ?></span>
                        <b class="username">your</b>
                        <span class="action"><?php echo $activiti['last_name'] ?></span>
                    </div>

                    <div class="date"><?php echo time_ago($activiti['tim'], true) ?></div>
                </div>



                <?php }} } }else{
                    $activitis=_getAllData($db,"SELECT * FROM `activity`  ORDER BY id DESC LIMIT 2");
                    if($activitis !=0){
                    foreach ($activitis as $activiti) {
                ?>

                <div class="activity">
                    <div>
                        <img src="<?php echo $activiti['image'] ?>" alt="">
                        <b class="username"><?php echo $activiti['my_name'] ?></b>
                        <span class="action"><?php echo $activiti['middle_name'] ?></span>
                        <b class="username"><?php echo $activiti['clint_name'] ?></b>
                        <span class="action"><?php echo $activiti['last_name'] ?></span>
                    </div>

                    <div class="date"><?php echo time_ago($activiti['tim'], true) ?></div>
                </div>




                <?php } } }?>

                <a href="activities" class="view_all">View all Activities</a>
            </div>
        </div>
    </div>



    <?php include"common/footer.php"; ?>