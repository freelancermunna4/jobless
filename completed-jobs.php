<?php
	require_once"common/sidebar.php";
    if(isset($_GET['page'])&&is_numeric($_GET['page'])){
        $start=$_GET['page'];
    }else{
        $start=0;
    }
    $ses_id=$data['id'];
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
                            Completed Jobs
                        </caption>
                        <thead>
                            <tr>
                                <th>Old Url</th>
                                <th>Submited Url</th>
                                <th>Price</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                        $uid=$data['id'];
                        $start_page=$start*10;
                        if(!$is_online){
                            $c_job=_getAllData($db,"SELECT * FROM `job_submit` ORDER BY id DESC LIMIT $start_page,10");
                        }else{
                            $c_job=_getAllData($db,"SELECT * FROM `job_submit` WHERE userid=$uid ORDER BY id DESC LIMIT $start_page,10");
                        }

                        foreach ($c_job as $job) {
                        ?>

                            <tr>
                                <td>
                                    <a href="<?php echo $job['oldUrl'] ?>" target="_blank">Website Review</a>
                                </td>
                                <td>
                                    <a href="<?php echo $job['submiturl'] ?>" target="_blank">URL</a>
                                </td>
                                <td>
                                    <p><?php echo $job['amount'] ?></p>
                                </td>
                                <td class="status">
                                    <?php
                                    $a= $job['activity'];
                                    if ($a==1) {
                                       echo "<p>Success</p>";
                                    }elseif ($a==0 || $a==3) {
                                        echo "<p>Pending</p>";
                                    }else{
                                        echo "<p>Reject</p>";
                                    }
                                    ?>

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
                $Jb=_getAllData($db,"SELECT*  FROM job_submit WHERE userid='$ses_id'");

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
    </div>


    <!-- <div class="popup_message">Successfully Added</div> -->
    <?php include"common/footer.php"; ?>