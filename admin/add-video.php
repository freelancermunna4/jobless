<?php
  require_once"common/header.php";
    $uid=$data['id'];

  if(isset($_POST['submit'])){

    $url=$db->EscapeString($_POST['vid']);
    $title=$db->EscapeString($_POST['title']);
    $views=$db->EscapeString($_POST['visitor']);
    $pac=$db->EscapeString($_POST['coin']);

    if (!filter_var($url, FILTER_VALIDATE_URL)) {
      echo "Not Valid Url";
      exit;
    }

    $pattern = "/youtube.com/i";
    $pattern2 = "/youtu.be/i";
    $valideted= preg_match($pattern, $url);
    $valideted2= preg_match($pattern2, $url);
    if($valideted !='1' && $valideted2 !='1'){
      echo("Url is not a valid URL");
      exit;
    } else{
      if($valideted =='1'){
        $output = implode(array_slice(explode("watch?v=",$url), 1, 3),",");
         $url= $output;
        }else{
          $output = implode(array_slice(explode(".be/",$url), 1, 3),",");
          $url= $output;
        }
        $uid=$data['id'];
        $u_name=$data['fullname'];
        $tim=time();
        $pack=_getData($db,"SELECT * FROM `vad_packs` WHERE id=$pac");
        $timer=$pack['time'];
        $coinsp=$pack['coins'];
        $submit=_insertData($db,"INSERT INTO `vad_videos`(`user_id`, `video_id`, `title`,  `daily_clicks`, `status`, `ad_pack`, `clickneed`,`tim`,`coins`, `time`) VALUES ('$uid','$url','$title','$limit',1,'$pac','$views','$timer','$coinsp','$tim')");
        if($submit){

          echo '<h4 style="text-align: center;color: blue;">success</h4>';
        }else{
          echo '<p style="text-align: center;color: red;">Something Wrong</p>';
        }


     }

   }

  ?>
      <div class="x_container space-y-10 py-10">
        <form class="grid grid-cols-2 gap-y-8 gap-x-12" action="" method="POST">
          <div class="col-span-2">
            <h2 class="text-xl font-semibold text-cyan-800">Add Video</h2>
          </div>

          <div class="col-span-2 lg:col-span-1 flex flex-col gap-y-1">
            <label for="Video ID">Video ID</label>
            <input name="vid" class="input" type="text" id="Video ID" placeholder="Video ID" required>
          </div>


          <div class="col-span-2 lg:col-span-1 flex flex-col gap-y-1">
            <label for="Video Title">Video Title</label>
            <input  name="title" class="input" type="text" id="Video Title" placeholder="Video Title" required>
          </div>


          <div class="col-span-2 lg:col-span-1 flex flex-col gap-y-1">
            <label for="Visits">Visits</label>
            <input  name="visitor" class="input" type="text" id="Visits" placeholder="1000" required>
          </div>


          <div class="col-span-2 lg:col-span-1col-span-2 lg:col-span-1 flex flex-col gap-y-1">
            <label for="UserUser">Add Pack</label>
            <select  name="coin" class="select" name="" id="UserUser" required>
              <?php
              $pac=_getAllData($db,"SELECT * FROM `vad_packs` ORDER BY id ASC");
              foreach($pac as $p){
                echo '<option value="'.$p['id'] .'">'.$p['coins'] .' Coin ('.$p['time'] .' seconds)</option>';

              } ?>

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