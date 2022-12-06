<?php
	require_once"common/sidebar.php";
    if(!$is_online){ header("Location: index");}


    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }


    $product =$db->Query("SELECT * FROM product_system WHERE id=$id");  
    $product = mysqli_fetch_assoc($product);


    if(isset($_POST['submit'])){
        $condition=$db->EscapeString($_POST['condition']);
        $update = $db->Query("UPDATE product_system SET conditions='$condition' WHERE id=$id");
        if($update){
            header("Location:aprove-product");
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
                <form action="" class="common_form" method="post" enctype="multipart/form-data">
                    
                    <div class="form_item full_col">
                        <img style="width:100%;height:300px;display:block;margin:0 auto;object-fit:cover" src="upload/<?php echo $product['file']?>" alt="">
                    </div>

                    <div class="form_item">
                        <label for="product_title">Product Title</label>
                        <input disabled type="text" name="product_title" id="product_title"
                            placeholder="Product Title ... " value="<?php echo $product['product_title']?>"  />
                    </div>

                    <div class="form_item">
                        <label for="product_url">Product URL</label>
                        <input disabled type="url" name="product_url" id="product_url"
                            placeholder="https://domain.com" value="<?php echo $product['web_link']?>" />
                    </div>                  

                    <div class="form_item full_col">
                        <label for="category">Price</label>
                        <select disabled required name="category" id="category">
                            <option selected><?php echo $product['amount']?></option>
                        </select>
                    </div>              

                    <div class="form_item full_col">
                        <label for="category">Category</label>
                        <select disabled required name="category" id="category">
                            <option selected><?php echo $product['category']?></option>
                        </select>
                    </div>

                    <div class="form_item full_col">
                        <label for="status">Status</label>
                        <select disabled name="status" id="status">
                            <option selected><?php echo $product['status']?></option>
                        </select>
                    </div>

                    <div class="form_item price_contact">
                        <label for="coin_per_product">Enter Your Price
                        </label>
                        <input disabled type="number" name="coin_per_product"  id="coin_per_product"
                            placeholder="200"  value="<?php echo $product['amount']?>" />
                    </div>

                    <div class="form_item price_contact">
                        <label for="contact_info">Contact Info</label>
                        <input disabled type="text" name="contact_info" id="contact_info" placeholder="Phone Number Or Email" value="<?php echo $product['contact']?>" />
                    </div>

                    <div class="form_item full_col">
                        <label for="condition">Condition</label>
                        <select  name="condition" id="condition">
                            <option value="Running">Running</option>
                            <option value="Completed">Completed</option>
                        </select>
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

$('#summernote').summernote({
        placeholder: 'Write something about your product',
        tabsize: 2,
        height: 200,
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'picture', 'video']],
          ['view', ['fullscreen', 'codeview', 'help']]
        ]
      });

</script>


    <?php include"common/footer.php"; ?>







