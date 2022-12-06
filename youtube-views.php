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
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                width="24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                </svg>

            </div>

            <div class="notify_text">
                <small><?php
               $d=_getData($db,"SELECT * FROM `notice` WHERE name='video'");
               echo $d['notice'];
                ?></small>
            </div>
            </div
    <br/><br/>
    <!-- Notification -->
        <div class="social_views">
            <?php
                $start_page=$start*10;
                if($ses_id){
                    $tim=time()-3600;
                    $fatch_youser=array();
                    $y_done=_getAllData($db,"SELECT* FROM vad_videos_done WHERE user_id =$uid  ORDER BY id ASC");
                    $total_w= count($y_done);
                    if($total_w>0){
                        foreach($y_done as $y) {
                            $fatch_youser[]=$y['video_id'];

                            }
                    }

                    $webs=_getAllData($db,"SELECT* FROM vad_videos WHERE clickneed>0 AND daily_clicks > today_clicks OR daily_clicks=0 ORDER BY 'coins' DESC  LIMIT  $start_page,1000");

                }else{
                    $webs=_getAllData($db,"SELECT* FROM vad_videos WHERE clickneed>0  ORDER BY 'coins' DESC LIMIT  $start_page,10");

                }

               if($webs==0){
                echo '<h3 style="text-align: center;margin: 10px;color: #134df9;">No Videos Available Now.</h3>';
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
                    <div class="thumbnail">
                        <img src="https://img.youtube.com/vi/<?php echo $web['video_id'] ?>/hqdefault.jpg" alt="" />
                    </div>
                    <h6 class="title">
                        <?php echo $web['title']  ?>
                    </h6>
                    <div class="reward-badge">Earn Coins: <b><?php echo $web['coins'] ?></b></div>
                    <div class="buttons">
                        <a href="watch-video?id=<?php echo $web['id'] ?>">Watch</a>
                        <button onclick="scipViews(<?php echo $web['id'] ?>)" class="skip">Skip</button>
                    </div>
                </div>
            </div>
            <?php $total_ch++;
          }
        }
     } ?>


        </div>
        <br />
        <!-- Paginations -->
        <div class="paginations">
            <?php
                $Jb=_getAllData($db,"SELECT*  FROM vad_videos WHERE click_need>0 OR (today_clicks>daily_clicks OR daily_clicks=0)");

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
    clearYoutubeViews()

    function clearYoutubeViews() {

        $.ajax({
            type: "POST",
            url: "system/ajax",
            data: 'clearYoutubeviews=' + "tt",
            success: function(a) {

            }
        })

    }


    function scipViews(data) {
        var yid = data;
        $.ajax({
            type: "POST",
            url: "system/ajax",
            data: 'skip=' + "tt" + '&yid=' + yid,
            success: function(a) {
                if (a.trim() != 1) {
                    console.log(a);
                } else {
                    location.reload(true)
                }
            }
        })
        console.log(data);

    }
    </script>

    <?php include"common/footer.php"; ?>