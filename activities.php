<?php
	require_once"common/sidebar.php";
    if(!$is_online){ header("Location: index");} 
	include_once"system/time_ago.php";
   
    $uid=$data['id'];
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
            <div class="dashboard_layout">
                <?php require_once('common/profile_sidebar.php'); ?>

                <div class="dashboard_content">
                    <div class="dc_box">
                        <div class="activities">
                            <h5 class="title">Your Recent Activities</h5>
                            <?php
                            $start_page=$start*10;
                            $activitis=_getAllData($db,"SELECT * FROM `activity` WHERE my_id=$uid OR clint_id=$uid ORDER BY id DESC LIMIT  $start_page,10");
                            if($activitis !=0){
                            foreach ($activitis as $activiti) {

                                if( $activiti['my_id']==$uid){                               
                            ?>

                            <div class="activity">
                                <div>
                                    &nbsp; <img src="<?php echo $activiti['image'] ?>" alt=""> &nbsp;
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
                                    &nbsp; <img src="<?php echo $activiti['image'] ?>" alt=""> &nbsp;
                                    <b class="username"><?php echo $activiti['clint_name'] ?></b>
                                    <span class="action"><?php echo $activiti['middle_name'] ?></span>
                                    <b class="username">your</b>
                                    <span class="action"><?php echo $activiti['last_name'] ?></span>
                                </div>

                                <div class="date"><?php echo time_ago($activiti['tim'], true) ?></div>
                            </div>



                            <?php }} }?>





                            <!-- Paginations -->
                            <div class="paginations">
                                <?php  
                                    $Jb=_getAllData($db,"SELECT * FROM `activity` WHERE my_id=$uid OR clint_id=$uid ORDER BY id DESC");

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


                                    <a
                                        href="?page=<?php if($start<=$totalPage-1){ echo $start+1; }else{echo $totalPage-1; } ?>">
                                        <button>Next</button></a>
                                </span>
                                <!-- Paginations -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include"common/footer.php"; ?>