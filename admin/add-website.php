<?php
  require_once"common/header.php";
    $uid=$data['id'];

  if(isset($_POST['submit'])){

    $title=$db->EscapeString($_POST['title']);
    $url=$db->EscapeString($_POST['url']);
    $coin=$db->EscapeString($_POST['coin']);
    $visitor=$db->EscapeString($_POST['visitor']);

    if (!filter_var($url, FILTER_VALIDATE_URL)) {
      echo "Not Valid Url";
      exit;
    }

    $c=_getData($db,"SELECT * FROM `web_surfing_pckks` WHERE id=$coin");
    $point=$c['coins'];
    $wtime=$c['time'];

    $tim=time();

    $insert=_insertData($db,"INSERT INTO `web_surfing`(`user_id`, `title`, `web_link`, `click_need`, `point`, `watch_time`,`activity`, `time`) VALUES ('$uid','$title','$url','$visitor','$point','$wtime','1','$tim')");
    if($insert){
      echo '<h4 style="text-align: center;color: blue;">success</h4>';
      $url="url";
    }else{echo '<p style="text-align: center;color: red;">Something Wrong</p>';}
   }



  ?>
      <div class="x_container space-y-10 py-10">
        <form class="grid grid-cols-2 gap-y-8 gap-x-12" action="" method="POST">
          <div class="col-span-2">
            <h2 class="text-xl font-semibold text-cyan-800">Add Webste</h2>
          </div>

          <div class="col-span-2 lg:col-span-1 flex flex-col gap-y-1">
            <label for="Website Title">Website Title</label>
            <input name="title" class="input" type="text" id="Website Title" placeholder="Website Title" required>
          </div>

          <div class="col-span-2 lg:col-span-1 flex flex-col gap-y-1">
            <label for="Website Address">Website Address</label>
            <input name="url" class="input" type="text" id="Website Address" placeholder="Website Address" required>
          </div>

          <div class="col-span-2 lg:col-span-1 flex flex-col gap-y-1">
            <label for="Visits">Visits</label>
            <input name="visitor" class="input" type="text" id="Visits" placeholder="1000" required>
          </div>

          <div class="col-span-2 lg:col-span-1col-span-2 lg:col-span-1 flex flex-col gap-y-1">
            <label for="UserUser">Add Pack</label>
            <select name="coin" class="select" name="" id="UserUser" required>
              <?php
              $coin=_getAllData($db,"SELECT * FROM `web_surfing_pckks` WHERE activity=1 ORDER BY coins ASC");
              if($coin !=0){
                foreach($coin as $c){
                  echo '<option value="'.$c['id'].'"> '.$c['name'].'- '.$c['coins'].' Coin ('.$c['time'].' seconds)</option>';
                }
              }?>

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