<?php
  require_once"common/header.php";

if(isset($_GET['id'])){
  $id = $_GET['id'];
}

  $product = $db->Query("SELECT * FROM product_system WHERE id=$id;");
  $product = mysqli_fetch_assoc($product);
  $user_id = $product['uid'];
  $user_info = $db->Query("SELECT * FROM users WHERE id=$user_id");
  $user_info = mysqli_fetch_assoc($user_info);

  if(isset($_POST['submit'])){
     $activity=$db->EscapeString($_POST['activity']);

    if($activity == '0'){
      $conditions = '';
    }else{
      $conditions = 'Running';
    }

    $update = $db->Query("UPDATE product_system SET activity='$activity', conditions='$conditions' WHERE id=$id");
   if($update){
      header("Location:pending-product.php");
   }

  }
  ?>


   <section>
    <div class="main_div" style="width:70%;margin:25px auto;">
      <form action="" method="POST">
        <div><img style="width:70%;height:300px;margin:0 auto;" src="../upload/2017-10-14.png"></div>
<br>
            <div style="width:70%;margin:0 auto;padding:5px 0;">
              <label for="">User Name</label>
              <input disabled type="text" class="input" value="<?php echo $user_info['fullname']?>">
            </div>
            <div style="width:70%;margin:0 auto;padding:5px 0;">
              <label for="">User Email</label>
              <input disabled type="text" class="input" value="<?php echo $user_info['email']?>">
            </div>
            <div style="width:70%;margin:0 auto;padding:5px 0;">
              <label for="">Product Name</label>
              <input disabled type="text" class="input" value="<?php echo $product['product_title']?>">
            </div>

            <div style="width:70%;margin:0 auto;padding:5px 0;">
              <label for="">Product Price</label>
              <input disabled type="text" class="input" value="<?php echo $product['amount']?>">
            </div>

            <div style="width:70%;margin:0 auto;padding:5px 0;">
              <label for="">Product Url</label>
              <input disabled type="text" class="input" value="<?php echo $product['web_link']?>">
            </div>

            <div style="width:70%;margin:0 auto;padding:5px 0;">
              <label for="">Product Category</label>
              <input disabled type="text" class="input" value="<?php echo $product['category']?>">
            </div>

            <div style="width:70%;margin:0 auto;padding:5px 0;">
              <label for="">Product Contact</label>
              <input disabled type="text" class="input" value="<?php echo $product['contact']?>">
            </div>

            <div style="width:70%;margin:0 auto;padding:5px 0;">
              <label for="">Product Amount</label>
              <input disabled type="text" class="input" value="<?php echo $product['amount']?>">
            </div>

            <div style="width:70%;margin:0 auto;padding:5px 0;">
              <label for="">Product Status</label>
              <input disabled type="text" class="input" value="<?php echo $product['status']?>">
            </div>

            <div style="width:70%;margin:0 auto;padding:5px 0;">
              <label for="">Activity</label>
              <select  name="activity" class="input" >
                <option value="1">Active</option>
                <option value="0">Disabled</option> 
              </select>
            </div>
          <br>
            <div style="width:70%;margin:0 auto;padding:5px 0;">
              <input type="submit" name="submit" class="button">
            </div>


      </form>
    </div>
   </section>

































      
    </div>
  </main>

  <script src="js/app.js"></script>
</body>

</html>