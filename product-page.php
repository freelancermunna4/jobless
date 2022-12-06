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
            <div class="page_content pr_page">
                <div class="pr_page_div1">
                    <div class="cf_wrapper">
                        <img id="main_img" style="width:100%;height:400px;display:block;border-radius:5px;object-fit:contain" src="upload/<?php echo $product['file'];?>">                        
                        <br>
                        <div style="display:flex;gap:10px;justify-content:center;">
                        <img id="img1" class="pr_box" src="upload/<?php echo $product['file'];?>">
                        <?php if($product['file2'] == 'no-photo-available.png'){ ?><?php }else{?>
                        <img id="img2" class="pr_box" src="upload/<?php echo $product['file2'];?>">
                        <?php }?>
                        <?php if($product['file3'] == 'no-photo-available.png'){ ?><?php }else{?>
                        <img id="img3" class="pr_box" src="upload/<?php echo $product['file3'];?>">
                        <?php }?>
                        <?php if($product['file4'] == 'no-photo-available.png'){ ?><?php }else{?>
                        <img id="img4" class="pr_box" src="upload/<?php echo $product['file4'];?>">
                        <?php }?>
                        </div>
                        <br>
                        <h4 style="text-align:center"><b><?php echo $product['product_title'];?></b></h4>
                    </div>
                    <div class="cf_wrapper" style="color:gray;overflow:auto;">
                        <pre><?php echo $product['work_discription'];?></pre>
                    </div>
                </div>
                <div class="cf_wrapper pr_page_div2" >
                    <div class="pr_sidebar">
                        <ul>
                            <li>For sale by <b><?php echo $user_info['fullname'];?></b></li>
                            <hr>
                            <li>Price: <b><?php echo $product['amount'];?></b></li>
                            <?php if(empty($product['web_link'])){  }else{ ?>
                            <li>URL: <b><a target="_blank" href="<?php echo $product['web_link'];?>"><?php echo $product['web_link'];?></a></b></li>
                            <?php  }?>
                            <li>Category: <b><?php echo $product['category'];?></b></li>
                            
                            <?php 
                            if(is_numeric($product['contact'])){ ?>
                            <li>Contact: <b><a href="tel:<?php echo $product['contact'];?>"><?php echo $product['contact'];?></a></b></li>
                            <?php  }else{?>
                                <li>Contact: <b><a href="mailto:<?php echo $product['contact'];?>"><?php echo $product['contact'];?></a></b></li>
                                <?php }?>
                            <li>Date: <b><?php echo $product['job_time'];?></b></li>
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
