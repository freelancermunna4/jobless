<?php
	require_once"common/sidebar.php";
    if(!$is_online){ header("Location: index");}
    $err="";
    if(isset($_SESSION['err'])){$err=$_SESSION['err'];unset($_SESSION['err']);} 
    if(isset($_POST['submit'])){
        $product_title=$db->EscapeString($_POST['product_title']);
        $product_url=$db->EscapeString($_POST['product_url']);
        $status=$db->EscapeString($_POST['status']);
        $coin_per_product=$db->EscapeString($_POST['coin_per_product']);
        $contact_info=$db->EscapeString($_POST['contact_info']);
        $category=$db->EscapeString($_POST['category']);
        $product_description=$db->EscapeString($_POST['product_description']);

        $file_name = $_FILES['file']['name'];
        $file_tmp = $_FILES['file']['tmp_name'];
        move_uploaded_file($file_tmp,"upload/$file_name");

        $file_name2 = $_FILES['file2']['name'];
        $file_tmp2 = $_FILES['file2']['tmp_name'];
        move_uploaded_file($file_tmp2,"upload/$file_name2"); 

        $file_name3 = $_FILES['file3']['name'];
        $file_tmp3 = $_FILES['file3']['tmp_name'];
        move_uploaded_file($file_tmp3,"upload/$file_name3");

        $file_name4 = $_FILES['file4']['name'];
        $file_tmp4 = $_FILES['file4']['tmp_name'];
        move_uploaded_file($file_tmp4,"upload/$file_name4");

        if(empty($file_name)){
            $file_name = 'no-photo-available.png';
        }
        if(empty($file_name2)){
            $file_name2 = 'no-photo-available.png';
        }
        if(empty($file_name3)){
            $file_name3 = 'no-photo-available.png';
        }
        if(empty($file_name4)){
            $file_name4 = 'no-photo-available.png';
        }
 

        if(empty($contact_info)){ $contact_info = $config['site_email'];}
        $totalCoinNeed=$coin_per_product;
        $userid=$data['id'];
        $u_name=$data['fullname'];
        $usercoin=$data['coins'];
        $tim=time();

        if($status == 'Premium' && empty($coin_per_product)){
            $err="Please fill up Price field";
        }else{
            if($totalCoinNeed > $usercoin){$err= "Not Enough Coins";}
            else{
                $finalcoin=$usercoin-$totalCoinNeed;
                $submitproduct=_insertData($db,"INSERT INTO `product_system` (`uid`, `product_title`, `amount`, `activity`, `work_discription`, `web_link`, `job_time`, `contact`, `category`, `file`, `file2`, `file3`, `file4`, `status`, `time`) VALUES ('$userid', '$product_title', '$coin_per_product', '0', '$product_description', '$product_url', current_timestamp(), '$contact_info', '$category', '$file_name', '$file_name2', '$file_name3', '$file_name4', '$status', '$tim');");
                
                if($submitproduct){
                    $submitproduct=_insertData($db,"UPDATE `users` SET `coins`='$finalcoin' WHERE id=$userid");
                    $j_update=_insertData($db,"INSERT INTO `activity`(`my_id`, `my_name`, `clint_id`, `clint_name`, `middle_name`, `last_name`, `image`,`tim`)
                    VALUES ('$userid','$u_name','$userid','Your','Succesfully Publish','Product','assets/icons/work.svg','$tim')");

                    $_SESSION['err']="Successfully Publish Your product ";
                    header('location:add-product');
                    die();
                }else{
                    $err="ERROR: Something Wrong";
                }
            }
        }

    }
?>

<!--===== main page content =====-->
<div class="content">
    <div class="container">
        <div class="page_content">
        <div style="text-align: center;">
        <?php if(!empty($top_ad['code'])){  echo base64_decode($top_ad['code']);} ?>
        </div>
            <div class="cf_wrapper">
                <h4 style="text-align: center;border-bottom: 2px dotted;margin-bottom: 5px;">ADD PRODUCT</h4>
                <p style="margin-left: 25px;color: #ff1477;text-align: center;"> <?php echo $err; ?> </p>
                <form action="" class="common_form" method="post" enctype="multipart/form-data">
                    <div class="form_item">
                        <label for="product_title">Product Title</label>
                        <input type="text" name="product_title" id="product_title"
                            placeholder="Product Title ... " required />
                    </div>
                    <div class="form_item">
                        <label for="product_url">Product URL</label>
                        <input type="url" name="product_url" id="product_url"
                            placeholder="https://domain.com" />
                    </div>                  

                    <div class="form_item full_col">
                        <label for="category">Category</label>
                        <select required name="category" id="category">
                            <option value="Website">Website</option>
                            <option value="Graphic">Graphic</option>
                            <option value="Digital Marketing">Digital Marketing</option>
                            <option value="Video">Video</option>
                            <option value="Audio">Audio</option>
                            <option value="Others">Others</option>
                        </select>
                    </div>

                    <div class="form_item full_col">
                        <label for="status">Status</label>
                        <select name="status" id="status">
                            <option value="Free">Free</option>
                            <option value="Premium">Premium</option>
                        </select>
                    </div>

                    <div class="form_item price_contact">
                        <label for="coin_per_product">Enter Your Price
                        </label>
                        <input type="number" name="coin_per_product"  id="coin_per_product"
                            placeholder="200"  />
                    </div>

                    <div class="form_item price_contact">
                        <label for="contact_info">Contact Info</label>
                        <input type="text" name="contact_info" id="contact_info" placeholder="Phone Number Or Email" />
                    </div>                        

                    <div class="form_item full_col">
                        <label for="product_description">Enter Your Product Description</label>
                        <textarea required id="summernote" name="product_description" placeholder="Product Description..." ></textarea>
                    </div>

                    <div class="form_item full_col">
                        <label for="add_image">Upload Some Image For Product</label>
                        <div style="display:flex;gap:15px;">
                        <input type="file" name="file" style="margin:0;padding:10px 10px;"/>
                        <input type="file" name="file2" style="margin:0;padding:10px 10px;"/>
                        <input type="file" name="file3" style="margin:0;padding:10px 10px;"/>
                        <input type="file" name="file4" style="margin:0;padding:10px 10px;"/>
                        </div>
                    </div>

                    <div class="full_col">
                        <button type="submit" name="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<script>
$(document).ready(function() {
$(".price_contact").hide();
$("#status").change(function(){
    $(".price_contact").slideToggle("fast");
});

});


</script>


    <?php include"common/footer.php"; ?>







