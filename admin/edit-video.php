<?php
  require_once"common/header.php";
  if(isset($_GET['id'])&& is_numeric($_GET['id'])){
  $id=$_GET['id'];
  }else{
    header('location:active-videos.php');
    exit;
  }

  if(isset($_POST['submit'])){
    $uid=$db->EscapeString($_POST['uid']);
    $vid=$db->EscapeString($_POST['vid']);
    $vtitle=$db->EscapeString($_POST['vtitle']);
    $views=$db->EscapeString($_POST['views']);
    $pack=$db->EscapeString($_POST['pack']);
    $pacl=_getData($db,"SELECT * FROM `vad_packs` WHERE id=$pack");
    $coin=$pacl['coins'];


     $insert=_insertData($db,"UPDATE `vad_videos` SET `user_id`='$uid',`video_id`='$vid',`title`='$vtitle',`ad_pack`='$pack',`clickneed`='$views',`coins`='$coin' WHERE id=$id");


  }

  $v=_getData($db,"SELECT * FROM vad_videos WHERE id=$id AND status=1");
  if($v==0){ header('location:active-videos.php'); exit;}

?>
      <div class="x_container space-y-10 py-10">
        <form class="grid grid-cols-2 gap-y-8 gap-x-12"  action="" method="POST">
          <div class="col-span-2">
            <h2 class="text-xl font-semibold text-cyan-800">Edit Video</h2>
          </div>

          <div class="col-span-2 lg:col-span-1 flex flex-col gap-y-1">
            <label for="User ID">User ID</label>
            <input name="uid" value="<?= $v['user_id'] ?>" class="input" type="text" id="User ID" placeholder="User ID" required>
          </div>

          <div class="col-span-2 lg:col-span-1 flex flex-col gap-y-1">
            <label for="Video ID">Video ID</label>
            <input name="vid" value="<?= $v['video_id'] ?>" class="input" type="text" id="Video ID" placeholder="Video ID" required>
          </div>


          <div class="col-span-2 lg:col-span-1 flex flex-col gap-y-1">
            <label for="Title">Title</label>
            <input name="vtitle" value="<?= $v['title'] ?>" class="input" type="text" id="Title" placeholder="Title" required>
          </div>

          <div class="col-span-2 lg:col-span-1 flex flex-col gap-y-1">
            <label for="Remaining Views">Remaining Views</label>
            <input name="views" value="<?= $v['clickneed'] ?>" class="input" type="text" id="Remaining Views" placeholder="Remaining Views" required>
          </div>


          <div class="col-span-2 lg:col-span-1col-span-2 lg:col-span-1 flex flex-col gap-y-1">
            <label for="UserUser">Add Pack</label>
            <select class="select" name="pack" id="UserUser" required>
              <?php $pc=_getAllData($db,"SELECT * FROM `vad_packs` WHERE activity=1 ORDER BY id ASC");
              foreach($pc as $p){
                $pp=$p['id'];
                $dpc=$v['ad_pack'];
                if($pp==$dpc){
                  echo '<option selected value="'.$p['id'].'">'.$p['coins'].' Coin ('.$p['time'].' seconds)</option>';
                }else{
                echo '<option value="'.$p['id'].'">'.$p['coins'].' Coin ('.$p['time'].' seconds)</option>';
                }
              }
              ?>

            </select>
          </div>



          <div class="col-span-2 flex justify-end">
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