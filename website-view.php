<?php
	require_once"common/sidebar.php";
    if($ses_id){$uid=$data['id'];}
    if(isset($_GET['page'])&&is_numeric($_GET['page'])){
        $start=$_GET['page'];
    }else{
        $start=0;
    }

?>

<!--===== main page content =====-->
<div class="content">
    <div class="container">
        <div class="page_content">
            <div style="text-align: center;">
                <?php if(!empty($top_ad['code'])){  echo base64_decode($top_ad['code']);} ?>
            </div>
            <!-- Notification  -->
            <div class="notify_wrapper">
                <div class="notify_icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" width="24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                    </svg>
                </div>
                <div class="notify_text">
                    <small><?php
               $d=_getData($db,"SELECT * FROM `notice` WHERE name='web'");
               echo $d['notice'];
                ?></small>
                </div>
            </div <br /><br />
            <!-- Notification -->

            <div class="social_views">
                <?php
                $start_page=$start*10;
                if($ses_id){
                    $tim=time()-3600;
                    $fatch_youser=array();
                    $y_done=_getAllData($db,"SELECT* FROM web_surfing_done WHERE (user_id=$uid AND s_time<$tim) || skip=$uid ORDER BY web_id ASC");
                    $total_w= count($y_done);
                    if($total_w>0){
                        foreach($y_done as $y) {
                            $fatch_youser[]=$y['web_id'];

                            }
                    }

                    $webs=_getAllData($db,"SELECT* FROM web_surfing WHERE click_need>0 AND dailyClick > today_clicks OR dailyClick=0 AND activity=1 ORDER BY 'point' DESC  LIMIT  $start_page,1000");

                }else{
                    $webs=_getAllData($db,"SELECT* FROM web_surfing WHERE click_need>0  AND activity=1  ORDER BY 'point' DESC LIMIT  $start_page,10");

                }

               if($webs==0){
                echo '<h3 style="text-align: center;margin: 10px;color: #134df9;width: 100% !important;">No Website Available .</h3>';
              }else{
                $total_ch=0;
                $ctime=time();
                 foreach($webs as $web){
                    $web_id=$web['id'];
                    if($total_ch>9){
                        break;
                    }
                    if (!in_array($web_id, $fatch_youser)){

                ?>


                <div class="view">
                    <div class="view_container">
                        <h6 class="title"><?php echo $web['title'] ?></h6>
                        <p class="link"> &nbsp; &nbsp; <?php echo $web['web_link'] ?></p>
                        <div class="thumbnail">
                            <img src="assets/icons/website-icon.png" alt="<?php echo $web['title'] ?>"
                                style="width: 150px;height: auto;display: block;margin-right: auto;margin-left: auto;">
                        </div>
                        <div class="time">Duration: <b><?php echo $web['watch_time'] ?> Sec</b></div>
                        <div class="reward-badge">Earn Coins: <b><?php echo $web['point'] ?></b></div>
                        <div class="buttons">
                            <button
                                onclick="ModulePopup('<?php echo $web['id']; ?>','<?php echo $web['web_link'];  ?>','Youtube','<?php echo $web['web_link'];  ?>');">View</button>
                            <button onclick="skipuser(<?php echo $web['id']; ?>,1)" class="skip">Skip</button>
                        </div>
                    </div>
                </div>
                <?php $total_ch++;
          }
        }
     }

?>


            </div>

            <br />
            <!-- Paginations -->
            <div class="paginations">
                <?php
                $Jb=_getAllData($db,"SELECT*  FROM web_surfing WHERE click_need>0 OR (today_clicks>dailyClick OR dailyClick=0) AND activity=1");

                 $totalPage=ceil(count($Jb)/10);

                ?>
                <div class="badge">Page <?php echo  $start  ?> of <?php echo  $totalPage ?></div>
                <span class="paginaton-appender">
                    <?php ?>
                    <a href="?page=<?php if($start>0){ echo $start-1; }else{echo 0; } ?>"> <button>Previous</button></a>
                    <?php
                    for ($i=0; $i <=6 ; $i++) {
                        if($start<$totalPage-1){
                        $start++;
                        echo '<a href="?page='.$start.'"> <button>'.$start.'</button></a>';
                        }
                    } ?>


                    <a href="?page=<?php if($start<=$totalPage-1){ echo $start+1; }else{echo $totalPage-1; } ?>">
                        <button>Next</button></a>
                </span>
                <!-- Paginations -->
            </div>
            <br />
            <br />
        </div>

        <script>
        /////end focus/////


        var uid = '<?php echo $data['id']?>';
        console.log(uid);
        var start_click = 1;
        var end_click = <?=count($sites)?>;



        function click_refresh() {
            if (start_click < end_click) {
                start_click = start_click + 1
            } else {
                location.reload(true)
            }
        }

        function skipuser(b, c) {
            var tt = "skip";
            $.ajax({
                type: "POST",
                url: "system/ajax",
                data: 'skip=' + tt + '&idweb=' + b,
                success: function(a) {
                    $("#Hint").html(a);
                    remove(b);
                    click_refresh()
                }
            })
        }
        var targetWin;

        function getRandomPosition() {
            return Math.floor(Math.random() * 1000);
        }

        function ModulePopup(a, b, c, d) {
            if (!uid) {
                return;
            }

            if (!targetWin || targetWin.closed) {

                var i = getRandomPosition();
                $.ajax({
                    type: "POST",
                    url: "system/ajax",
                    data: 'web=' + a + '&rand=' + i,
                    success: function(z) {
                        if (z != 1) {
                            console.log("error");
                        }
                    }


                });

                targetWin = window.open("webview?page=serf&num=" + a + "&Rand=" + i, "_blank");



                var pollTimer = window.setInterval(function() {
                    if (targetWin.closed !== false) {
                        window.clearInterval(pollTimer);
                        setTimeout(function() {
                            $.ajax({
                                type: "POST",
                                url: "system/ajax",
                                data: 'wid=' + a + '&rand=' + i,
                                success: function(z) {
                                    popup_message(z, "success");
                                    setTimeout(function() {
                                        location.reload(1);
                                    }, 500);
                                }

                            });
                        }, 1000);

                    }



                }, 200);

            }


        }

        function remove(a) {
            $('#' + a).hide()
        }
        </script>



        <?php include"common/footer.php"; ?>