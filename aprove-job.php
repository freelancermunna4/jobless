<?php
	require_once"common/sidebar.php";
    if(!$is_online){ header("Location: index");}
    if(isset($_GET['page'])&&is_numeric($_GET['page'])){
        $start=$_GET['page'];
    }else{
        $start=0;
    }
    echo $ses_id=$data['id'];

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
                            My Job
                            <small>(Need Aproved)</small>
                        </caption>
                        <thead> 
                            <tr>
                                <th>Job Name</th>
                                <th>Discription</th>
                                <th>Old Url</th> 
                                <th>Submited Url</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                             $start_page=$start*10;
                                $jobs=_getAllData($db,"SELECT * FROM `job_submit` WHERE (pubid='$ses_id' AND activity=0)  LIMIT $start_page,25");
                                if($jobs!=0){ foreach($jobs as $job){ ?>
                            <tr>
                                 <td>
                                    <p><?php echo $job['title'] ?></p>
                                </td>
                                <td>
                                    <p><?php echo $job['discription'] ?></p>
                                </td>

                                <td>
                                    <a href="<?php echo $job['oldUrl'] ?>"
                                        target="_blank"><?php echo $job['oldUrl'] ?></a>
                                </td>
                                <td>
                                    <a href="<?php echo $job['submiturl'] ?>"
                                        target="_blank"><?php echo $job['submiturl'] ?></a>
                                </td>
                                <td class="status">


                                    <div class="btns">
                                        <button id="b+<?=$job['id'] ?>" onclick="aproved(<?=$job['id'] ?>)" class="show_fsp" data-ref="add-subscribe">
                                            Aprove
                                        </button>
                                        <button id="c+<?=$job['id'] ?>" onclick="deleteyt(<?=$job['id'] ?>)" class="show_fsp" data-ref="delete-confirm">
                                            Reject
                                        </button>
                                    </div>

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
        </div>

        <script>
            function aproved(id){
                $('#b'+id).hide();

                $.ajax({
                        type: "POST",
                        url: "system/ajax",
                        data: 'aprovejob=' + id,
                        success: function(z) {
                            if(z.trim()=="success"){
                                swal("Success!", "You Aprove this job!", "success");
                                location.reload(true);
                            }else{
                                swal("Error!",z);
                                $('#b'+id).show();

                            }


                        }
                    })
            }


            function deleteyt(id){
                $('#c'+id).hide();

                $.ajax({
                        type: "POST",
                        url: "system/ajax",
                        data: 'rejec_job=' + id,
                        success: function(z) {
                            if(z.trim()=="success"){
                                popup_message("You Reject this job Check by Admin!", "success");
                                location.reload(true);
                            }else{
                                popup_message(z, "error");
                                $('#c'+id).show();

                            }


                        }
                    })
            }
        </script>


        <?php include"common/footer.php"; ?>
