<?php
	require_once"common/sidebar.php";
    if(!$is_online){ header("Location: index");}
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
            <div class="table_wrapper">
                <div class="table">
                    <table>
                        <caption>
                            My Videos
                            <small>(Promoted Videos)</small>
                        </caption>
                        <thead>
                            <tr>
                                <th class="col">Video</th>
                                <th class="col">Remaining Views</th>
                                <th class="col">Received Views</th>
                                <th class="col">Today Views</th>
                                <th class="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                        $uid=$data['id'];
                        $start_page=$start*10;
                        $c_web=_getAllData($db,"SELECT * FROM `vad_videos` WHERE user_id=$uid ORDER BY id DESC LIMIT $start_page,10");
                        foreach ($c_web as $web) {
                            $pac=$web['ad_pack'];
                            $pac=_getData($db,"SELECT * FROM `vad_packs` WHERE id=$pac");
                        ?>
                            <tr>
                                <td><a href="https://www.youtube.com/watch?v=<?php echo $web['video_id'] ?>"
                                        target="_blank"><?php echo $web['title'] ?>
                                    </a>
                                </td>
                                <td>
                                    <p><?php echo $web['clickneed'] ?> x <?php echo $pac['time'] ?> sec</p>
                                </td>
                                <td>
                                    <p><?php echo $web['visits'] ?></p>
                                </td>
                                <td>
                                    <p><?php echo $web['today_clicks'] ?></p>
                                </td>
                                <td class="status">
                                    <p>
                                        <?php
                                    $a= $web['status'];
                                    if ($a==1) {
                                       echo "<p>Active</p>";
                                    }elseif ($a==0) {
                                        echo "<p>Pending</p>";
                                    }else{
                                        echo "<p>Reject</p>";
                                    }
                                    ?>
                                    </p>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <br />
            <!-- Paginations -->
            <div class="paginations">
                <?php
                $Jb=_getAllData($db,"SELECT*  FROM vad_videos WHERE user_id='$uid'");

                 $totalPage=ceil(count($Jb)/10);

                ?>
                <div class="badge">Page <?php echo  $start  ?> of <?php echo  $totalPage ?></div>
                <span class="paginaton-appender">
                    <?php ?>
                    <a href="?page=<?php if($start>0){ echo $start-1; }else{echo 0; } ?>">
                        <button>Previous</button></a>
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
        </div>

        <?php include"common/footer.php"; ?>