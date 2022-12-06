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
                            My Job List
                            <small>(Submitted Jobs)</small>
                        </caption>
                        <thead>
                            <tr>
                                <th>Job</th>
                                <th>Completed</th>
                                <th>Need Submited</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                             $start_page=$start*10;
                                $jobs=_getAllData($db,"SELECT * FROM `job_system` WHERE uid='$ses_id' LIMIT $start_page,10");
                                if($jobs!=0){ foreach($jobs as $job){ ?>
                            <tr>

                                <td>
                                    <a href="<?php echo $job['web_link'] ?>"
                                        target="_blank"><?php echo $job['job_title'] ?></a>
                                </td>
                                <td>
                                    <p><?php echo $job['totalClick'] ?></p>
                                </td>
                                <td>
                                    <p><?php echo $job['clickneed'] ?></p>
                                </td>
                                <td class="status">
                                    <p>
                                        <?php
                                        $status=$job['activity'];
                                        if($status==0){
                                            echo "Pending";
                                        }elseif ($status==1) {
                                            echo "Active";
                                        }else {
                                            echo "Reject";
                                        }
                                       ?>

                                    </p>
                                </td>

                            </tr>
                            <?php } } else{ ?>

                            <tr>
                                <td>
                                    <a href="#">Not Submited Jobs</a>
                                </td>
                                <td>
                                    <p>-</p>
                                </td>
                                <td>
                                    <p>-</p>
                                </td>
                                <td class="status">
                                    <p>-</p>
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
                $Jb=_getAllData($db,"SELECT*  FROM job_system WHERE uid='$ses_id'");

                 $totalPage=ceil(count($Jb)/10);

                ?>
                <div class="badge">Page <?php echo  $start+1  ?> of <?php echo  $totalPage ?></div>
                <span class="paginaton-appender">
                    <?php ?>
                    <a href="?page=<?php if($start>0){ echo $start; }else{echo 0; } ?>"> <button>Previous</button></a>
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