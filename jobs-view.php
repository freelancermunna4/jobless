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
               $d=_getData($db,"SELECT * FROM `notice` WHERE name='job'");
               echo $d['notice'];
                ?></small>
            </div>
            </div
    <br/><br/>
    <!-- Notification -->
            <?php
                $start_page=$start*10;
                if($ses_id){
                    $Jobs=_getAllData($db,"SELECT* FROM job_system WHERE clickneed>0 AND activity=1  ORDER BY amount DESC LIMIT  $start_page,10");

                }else{
                    $Jobs=_getAllData($db,"SELECT* FROM job_system WHERE clickneed>0 AND activity=1  ORDER BY amount DESC LIMIT  $start_page,10");

                }

               if($Jobs==0){
                echo '<h3 style="text-align: center;margin: 10px;color: #134df9;">No Jobs Available Now.</h3>';
              }else{ ?>
            <div class="jobs-views">

                <?php foreach($Jobs as $job){
                    $jid=$job['id'];

                ?>
                <div class="job" class="job_holder_<?php echo $job['id'] ?>">
                    <div class="jv_header">
                        <h3><?php echo $job['job_title'] ?></h3>
                        <p>Reward: <?php echo $job['amount'] ?> Coins <span
                                style="color: green;">(<?php echo $job['clickneed'] ?> Job Available)</span></p>
                        <p class="err_<?php echo $job['id'] ?>" style="color: #ff1f9d;"></p>
                    </div>
                    <div class="jv_body">
                        <a href="<?php echo $job['web_link'] ?>" target="_blank"><?php echo $job['web_link'] ?></a>
                        <p>
                            <?php echo $job['work_discription'] ?>
                        </p>

                        <div class="input_wrapper" action="" method="post">
                            <div class="icon">
                                <img src="assets/images/link.png" alt="" />
                            </div>
                            <input required type="url" placeholder="https://example.com"
                                class="base_input submit_url_<?php echo $job['id'] ?>" />
                            <button class="base_btn jbsubmit" id="<?php echo $job['id'] ?>" type="submit">Submit</button>
                        </div>
                    </div>
                </div>

                <?php }} ?>







            </div>

            <br />
            <br />
            <!-- Paginations -->
            <div class="paginations">
                <?php
                 if($ses_id){
                 $Jb=_getAllData($db,"SELECT*  FROM job_system WHERE clickneed>0 AND activity=1 AND userid !=$uid");
                 }{
                    $Jb=_getAllData($db,"SELECT*  FROM job_system WHERE clickneed>0 AND activity=1");
                 }

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
<script>
    jobsuccess();
    function jobsuccess(){
    
    $.ajax({
      type: "POST",
      url: "system/ajax",
      data: 'job=' + "job" + '&success=' + "success",
      success: function(z) {
         
            console.log(z);
         
      }
  })
  }
</script>
    <?php include"common/footer.php"; ?>