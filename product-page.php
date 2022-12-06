<?php
	require_once"common/sidebar.php";

    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }
    $product =$db->Query("SELECT * FROM product_system WHERE id=$id");  
    $product = mysqli_fetch_assoc($product);
    $user_id = $product['uid'];
    $user_info = $db->Query("SELECT * FROM users WHERE id=$user_id");
    $user_info = mysqli_fetch_assoc($user_info);
?>
<!--===== main page content =====-->


<div class="content">
    <div class="container">
        <div class="page_content">
            <div style="text-align: center;">
                <?php if(!empty($top_ad['code'])){  echo base64_decode($top_ad['code']);} ?>
            </div>
            <br /><br />
            <div class="page_content" style="display:flex;">
                <div style="width:65%">
                    <div class="cf_wrapper">
                        <h4 style="text-align:center"><b><?php echo $product['product_title'];?></b></h4>
                        <br>
                        <img id="main_img" style="width:100%;height:400px;display:block;border-radius:5px;object-fit:cover" src="upload/<?php echo $product['file'];?>">                        
                        <br>
                        <div style="display:flex;align-items:space-between;justify-content: space-evenly;">
                        <img id="img1" style="width:22%;height:100px;display:block;border-radius:5px;" src="upload/<?php echo $product['file'];?>">
                        <?php if($product['file2'] == 'no-photo-available.png'){ ?><?php }else{?>
                        <img id="img2" style="width:22%;height:100px;display:block;border-radius:5px;" src="upload/<?php echo $product['file2'];?>">
                        <?php }?>
                        <?php if($product['file3'] == 'no-photo-available.png'){ ?><?php }else{?>
                        <img id="img3" style="width:22%;height:100px;display:block;border-radius:5px;" src="upload/<?php echo $product['file3'];?>">
                        <?php }?>
                        <?php if($product['file4'] == 'no-photo-available.png'){ ?><?php }else{?>
                        <img id="img4" style="width:22%;height:100px;display:block;border-radius:5px;" src="upload/<?php echo $product['file4'];?>">
                        <?php }?>
                        </div>

                        <br>
                        <br>

                        <div style="display:flex;justify-content:space-between;color:gray;">
                            <div>
                                <p style="padding:5px;">Price: <b><?php if($product['amount'] == '0'){echo 'Please Contact Fast';}else{echo $product['amount'];}?></b></p>
                                <p style="padding:5px;">Category: <b><?php echo $product['category'];?></b></p>
                                <?php 
                                if(empty($product['web_link'])){ ?>
                                <?php  }else{ ?>
                                <p style="padding:5px;">Url: <b><a target="_blank" href="<?php echo $product['web_link'];?>"><?php echo $product['web_link'];?></a></b></p> 
                                <?php  }?>                                
                            </div>
                            <div>
                                <p>Date: <b>10/05/2022</b></p>
                            </div>
                        </div>
                    </div>
                    <div class="cf_wrapper" style="color:gray">
                    <?php echo $product['work_discription'];?>
                    </div>
                </div>
                <div class="cf_wrapper" style="width:33%;margin-right:0;">
                    <div class="pr_sidebar">
                        <ul>
                            <li>For sale by <b><?php echo $user_info['fullname'];?></b></li>
                            <hr>
                            <li>Contact <b><?php echo $product['contact'];?></b></li>
                        </ul>
                        <ul>
                            <li style="padding-left:15px;"><i style="color:skyblue" class="fa-solid fa-shield"></i><b> Safety tips</b></li>
                            <li style="list-style:inside;">Meet in a safe & public place</li>
                            <li style="list-style:inside;">Don’t pay in advance</li>
                            <li style="list-style:inside;">Fake payment services</li>
                            <li style="list-style:inside;">Fake information requests</li>
                            <li style="list-style:inside;">Fake fee requests</li>
                            <li style="list-style:inside;">Use common sense</li>
                            <li style="list-style:inside;">Never give out financial information</li>
                        </ul>
                    </div>
                </div>
        </div>

<script>

$(document).ready(function(){

    $("#img1").click(function(){
      var img1 = $(this).attr("src");
    $("#main_img").attr("src",img1);
    }); 
    
    $("#img2").click(function(){
      var img1 = $(this).attr("src");
    $("#main_img").attr("src",img1);
    }); 
    
    $("#img3").click(function(){
      var img1 = $(this).attr("src");
    $("#main_img").attr("src",img1);
    }); 
    
    $("#img4").click(function(){
      var img1 = $(this).attr("src");
    $("#main_img").attr("src",img1);
    });    
});



</script>









        <?php include"common/footer.php"; ?>
