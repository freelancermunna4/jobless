<?php
  require_once"common/header.php";
  $err="";
  if(isset($_POST['pSubmit'])){
    $pName=$db->EscapeString($_POST['pName']);
    $pvalue=$db->EscapeString($_POST['pvalue']);
    $pPrice=$db->EscapeString($_POST['pPrice']);
    $pTime=$db->EscapeString($_POST['pTime']);
    $pOption=$db->EscapeString($_POST['pOption']);

    if(empty($pName) || empty($pvalue) ||empty($pPrice) ||empty($pTime) ||empty($pOption) ){
      $err="All Field Required";

    }else{



      $tim=time();
      if($pOption==1){
        $wtime=$tim+($pTime*60);
      }else if($pOption==2){
        $wtime=$tim+($pTime*60*60);
      }else if($pOption==3){
        $wtime=$tim+($pTime*60*60*24);
      }else if($pOption==4){
        $wtime=$tim+($pTime*60*60*24*30);
      }else{
        $wtime=$tim;
      }



    /**  image */
    $fileName=$_FILES['img']['name'];
    $fileTempName=$_FILES['img']['tmp_name'];
    $fileSize=$_FILES['img']['size'];
    $fileError=$_FILES['img']['error'];
    $fileType=$_FILES['img']['type'];
    $fileExt=explode('.',$fileName);
    $fileActualExt=strtolower(end($fileExt));
    $allaowed=array('jpeg', 'jpg', 'png', 'gif');
    if(in_array($fileActualExt,$allaowed)){
        if ($fileError===0) {
          if($fileSize<1000000){
            $fileNameNew=uniqid('',true).".".$fileActualExt;
            $fileDestination="../assets/images/".$fileNameNew;
            move_uploaded_file( $fileTempName,$fileDestination);

            $ins=_insertData($db,"UPDATE `tottery` SET `name`='$pName',`price`='$pvalue',`img`='$fileNameNew',`lprice`='$pPrice',`wintime`='$wtime',`time`='$tim' WHERE id=1");
            $ins=_insertData($db,"DELETE FROM `lottarybuy`");
            $insrt=_insertData($db,"UPDATE `tottery` SET `name`='' WHERE id=2");

            $err="Successfully Aded New Lottery";

          }else{
            $err="Your file is too big!";

          }

        }else{
          $err="There is an Error uploading your file!";

        }
    }else{
      $err= "You cannot upload files this type !";

    }
  }
  }

  if(isset($_GET['ids']) && is_numeric($_GET['ids'])){
    $lt=_getData($db,"SELECT * FROM `tottery` WHERE id=1");
  }else{
    $lt=0;
  }
  ?>
      <div class="x_container space-y-10 py-10">
        <form class="grid grid-cols-2 gap-y-8 gap-x-12"  action="" method="POST" enctype="multipart/form-data">
          <div class="col-span-2">
            <h2 class="text-xl font-semibold text-cyan-800" style="text-align: center;">Add New Lottery</h2>
            <h3 class="text-xl font-semibold text-cyan-800" style="color: red;text-align: center;" ><?= $err; ?></h3>
          </div>

          <div class="col-span-2 lg:col-span-1 flex flex-col gap-y-1">
            <label for="Price Name">Price Name</label>
            <input name="pName" value="<?php if($lt !=0){echo $lt['name'];} ?>" class="input" type="text" id="Price Name" placeholder="Price Name" required>
          </div>

          <div class="col-span-2 lg:col-span-1 flex flex-col gap-y-1">
            <label for="Price Value">Price Value</label>
            <input  name="pvalue" value="<?php if($lt !=0){echo $lt['price'];} ?>" class="input" type="text" id="Price Value" placeholder="Price Value" required>
          </div>

          <div class="col-span-2 lg:col-span-1 flex flex-col gap-y-1">
            <label for="Price Value">Tiket Price</label>
            <input  name="pPrice" value="<?php if($lt !=0){echo $lt['lprice'];} ?>" class="input" type="text" id="Price Value" placeholder="Price Value" required>
          </div>

          <div class="col-span-2 lg:col-span-1 flex flex-col gap-y-1">
            <label for="Select Image">Select Image</label>
            <input  name="img" class="input py-2" type="file" id="Select Image" placeholder="Select Image" required>
          </div>

          <div class="col-span-2 lg:col-span-1 flex flex-col gap-y-1">
            <label for="Price Value">Time</label>
            <input  name="pTime" class="input" type="Number" id="Time" placeholder="Price Value" required>
          </div>

          <div class="col-span-2 lg:col-span-1col-span-2 lg:col-span-1 flex flex-col gap-y-1">
            <label for="UserUser">Select</label>
            <select  name="pOption" class="select" name="" id="UserUser" required>
              <option value="1">Minute</option>
              <option value="2">Hour</option>
              <option value="3">Days</option>
              <option value="4">Month</option>
            </select>
          </div>


          <div class="col-span-2 flex justify-start">
            <div class="w-fit">
              <button name="pSubmit" class="button">Submit</button>
            </div>
          </div>

        </form>
      </div>
    </div>
  </main>

  <script src="js/app.js"></script>
</body>

</html>