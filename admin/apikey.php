<?php
  require_once"common/header.php";
  if(isset($_GET['id'])&& is_numeric($_GET['id'])){
  $id=$_GET['id'];
  }else{
    $id=0;
  }
$err="";
  if(isset($_POST['submit'])){
    $pname=$db->EscapeString($_POST['pname']);


    $insert=_insertData($db,"UPDATE `site_config` SET `config_value`='$pname' WHERE config_name='apiKey'");
    if($insert){
      $err= "Success";
      header('location:apiKey');
    }else{
      $err="Something Wrong";

    }

  }



?>
      <div class="x_container space-y-10 py-10">
        <form class="grid grid-cols-2 gap-y-8 gap-x-12" action="" method="POST">
          <div class="col-span-2">
            <h2 class="text-xl font-semibold text-cyan-800">Edit Website Pack</h2>
            <p style="color: green;"><?= $err ?></p>
          </div>


          <div class="col-span-2 lg:col-span-1 flex flex-col gap-y-1">
            <label for="Pack Name">Api Key</label>
            <input name="pname" value="<?= $config['apiKey'] ?>"  class="input" type="text" id="Pack Name" placeholder="Pack Name" required>
          </div>



          <div class="col-span-2 flex justify-start">
            <div class="w-fit">
              <button name="submit" class="button">Submit</button>
            </div>
          </div>

        </form>
      </div>
    </div>
  </main>

  <script src="js/app.js"></script>
</body>

</html>