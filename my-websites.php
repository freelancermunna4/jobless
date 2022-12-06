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
                            Promoted Website
                        </caption>
                        <thead>
                            <tr>
                                <th>Website</th>
                                <th>Remaining Views</th>
                                <th>Received Views</th>
                                <th>Today Views</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                        $uid=$data['id'];
                        $start_page=$start*10;
                        $c_web=_getAllData($db,"SELECT * FROM `web_surfing` WHERE user_id=$uid ORDER BY id DESC LIMIT $start_page,10");
                        foreach ($c_web as $web) {
                        ?>
                            <tr>
                                <td><a href="<?php echo $web['web_link'] ?>" target="_blank"><?php echo $web['title'] ?>
                                    </a>
                                </td>
                                <td>
                                    <p><?php echo $web['click_need'] ?> x <?php echo $web['watch_time'] ?> sec</p>
                                </td>
                                <td>
                                    <p><?php echo $web['clicks'] ?></p>
                                </td>
                                <td>
                                    <p><?php echo $web['today_clicks'] ?></p>
                                </td>
                                <td class="status">
                                    <p>
                                        <?php
                                    $a= $web['activity'];
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

                <br />
                <!-- Paginations -->
                <div class="paginations">
                    <?php
                $Jb=_getAllData($db,"SELECT*  FROM web_surfing WHERE user_id='$uid'");

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
        </div>



        <!-- Popup Message -->
        <!-- <div class="popup_message">Successfully Added</div> -->
        <!-- All Popup -->
        <?php include"common/footer.php"; ?>