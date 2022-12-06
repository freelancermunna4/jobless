<?php
  require_once"common/header.php";
    $uid=$data['id'];

    if(isset($_GET['id']) &&is_numeric($_GET['id'])){
      $id=$_GET['id'];
      $ti=_getData($db,"SELECT * FROM `tiketsystem` WHERE id=$id");
      $tid=$ti['tiketid'];
    }else{
      header('location:all-tiket');
    }


  if(isset($_POST['msg_s'])){
    $msg=$db->EscapeString($_POST['msg']);
    $fileNameNew="";
            if(!empty($_FILES['img'])){
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
                        $fileDestination="../upload/".$fileNameNew;
                        move_uploaded_file( $fileTempName,$fileDestination);

                        }else{
                            $err= "Your file is too big!";
                        }

                    }else{
                        $err= "There is an Error uploading your file!";
                    }
                }else{
                    $err= "You cannot upload files this type !";
                }
              }
    $time=time();
    if(empty($fileNameNew)){
      $filelocation="";
    }else{
      $filelocation="upload/$fileNameNew";
    }
    $insrt=_insertData($db,"INSERT INTO `all_tiket`(`sender`, `tiketid`, `msg`, `img`, `tim`) VALUES ('0','$tid','$msg','$filelocation','$time')");


    $insrt=_insertData($db,"UPDATE `tiketsystem` SET `replymsg`='1' WHERE tiketid='$tid'");

      if($insrt){
      echo '<h4 style="text-align: center;color: blue;">success</h4>';
      header('location:all-tiket');
          }else{echo '<p style="text-align: center;color: red;">Something Wrong</p>';}
  }

  if(isset($_POST['msg_close'])){
    $msg=$db->EscapeString($_POST['msg']);
    $fileNameNew="";
            if(!empty($_FILES['img'])){
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
                        $fileDestination="../upload/".$fileNameNew;
                        move_uploaded_file( $fileTempName,$fileDestination);

                        }else{
                            $err= "Your file is too big!";
                        }

                    }else{
                        $err= "There is an Error uploading your file!";
                    }
                }else{
                    $err= "You cannot upload files this type !";
                }
              }
    $time=time();
    if(empty($fileNameNew)){
      $filelocation="";
    }else{
      $filelocation="upload/$fileNameNew";
    }
    $insrt=_insertData($db,"INSERT INTO `all_tiket`(`sender`, `tiketid`, `msg`, `img`, `tim`) VALUES ('0','$tid','$msg','$filelocation','$time')");


    $insrt=_insertData($db,"UPDATE `tiketsystem` SET `replymsg`='1',`close`='1' WHERE tiketid='$tid'");

      if($insrt){
      echo '<h4 style="text-align: center;color: blue;">success</h4>';
      header('location:all-tiket');
          }else{echo '<p style="text-align: center;color: red;">Something Wrong</p>';}
  }


  ?>
      <div class="x_container space-y-10 py-10">

          <div class="col-span-2">
            <h2 class="text-xl font-semibold text-cyan-800"><?= $ti['uname'] ?></h2>
          </div>
          <div class="col-span-2">
            <p class="text-sm font-semibold text-cyan-800"><?= $ti['subject'] ?></p>
          </div>
          <?php 
            $tikets=_getAllData($db,"SELECT * FROM `all_tiket` WHERE tiketid=$tid");         
            foreach($tikets as $t){          
          ?>

          
          <div class="col-span-2">
            <p class="text-sm font-semibold"><?= $t['msg'] ?></p>
          </div>
          <?php
          $img=$t['img'];
          if(!empty($img)){
            echo '<div class="col-span-2"><img src="../'.$img.'" alt=""  style="max-width: 250px;" height="250px"></div>';
          } ?>
          </div>

          <div class="w-full space-y-10 p-6 lg:p-12 bg-white border border-gray-200 rounded">

        
        <?php } ?>








          <hr class="my-6">
                    <form class="grid grid-cols-2 gap-y-6 gap-x-12" action="" method="POST" enctype="multipart/form-data">
            <div class="col-span-2">
              <h2 class="text-xl font-semibold text-cyan-800">Repley Tiket</h2>
            </div>

            <div class="flex flex-col gap-y-1">
              <label for="Bank Details">Messege</label>
              <textarea name="msg" class="input p-3 min-h-[100px]" id="Bank Details" placeholder="Bank Details" required></textarea>

              <label for="Status">Image File</label>
              <input style="height:fit-content;padding: 8px;" name="img" type="file" class="input" id="img" placeholder="Nagat Number" >
            </div>



            <div class="col-span-2 flex justify-start">
              <div class="w-fit" style="display: block ruby;">
                <button name="msg_s" class="button">Submit</button>
                <button name="msg_close" class="button" style="background: #000;">Submit & Close</button>
              </div>
            </div>

          </form>


        </div>


      </div>
    </div>
  </main>

  <script src="js/app.js"></script>
</body>

</html>