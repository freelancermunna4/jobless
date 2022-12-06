<?php
  require_once"common/header.php";
    $uid=$data['id'];
    if(isset($_GET['id'])&& is_numeric($_GET['id'])){
      $jid=$_GET['id'];
    }
    if(empty($jid)){
      header('location:active-jobs');
    }
    $j=_getData($db,"SELECT * FROM job_system WHERE id='$jid'");
  if(isset($_POST['submit'])){

    $title=$db->EscapeString($_POST['title']);
    $url=$db->EscapeString($_POST['url']);
    $coin=$db->EscapeString($_POST['coin']);
    $visitor=$db->EscapeString($_POST['visitor']);
    $desc=$db->EscapeString($_POST['desc']);

    if (!filter_var($url, FILTER_VALIDATE_URL)) {
      echo "Not Valid Url";
      exit;

    }
    $tim=time();
    $insert=_insertData($db,"UPDATE `job_system` SET `job_title`=' $title',`amount`='$coin',`clickneed`='$visitor',`activity`='1',`work_discription`='$desc',`web_link`='$url' WHERE id=' $jid'");
    if($insert){
      echo '<h4 style="text-align: center;color: blue;">success</h4>';
      $url="url";
    }else{echo '<p style="text-align: center;color: red;">Something Wrong</p>';}
   }

  ?>

      <div class="x_container space-y-10 py-10">
        <form class="grid grid-cols-2 gap-y-8 gap-x-12"  action="" method="POST">
          <div class="col-span-2">
            <h2 class="text-xl font-semibold text-cyan-800">Add New Job</h2>
          </div>

          <div class="col-span-2 lg:col-span-1 flex flex-col gap-y-1">
            <label for="Job Title">Job Title</label>
            <input name="title" value="<?= $j['job_title'] ?>" class="input" type="text" id="Job Title" placeholder="Job Title" required>
          </div>

          <div class="col-span-2 lg:col-span-1 flex flex-col gap-y-1">
            <label for="Job Link">Job Link</label>
            <input name="url" class="input" value="<?= $j['web_link'] ?>" type="text" id="Job Link" placeholder="Job Link" required>
          </div>

          <div class="col-span-2 lg:col-span-1 flex flex-col gap-y-1">
            <label for="Reward Coin">Reward Coin</label>
            <input name="coin" class="input" value="<?= $j['amount'] ?>" type="text" id="Reward Coin" placeholder="Reward Coin" required>
          </div>

          <div class="col-span-2 lg:col-span-1 flex flex-col gap-y-1">
            <label for="Visitor">Visitor</label>
            <input name="visitor" class="input" value="<?= $j['clickneed'] ?>" type="text" id="Visitor" placeholder="Visitor" required>
          </div>

          <div class="col-span-2 lg:col-span-1 flex flex-col gap-y-1">
            <label for="Job Description">Job Description</label>
            <textarea name="desc" class="input p-3 min-h-[100px]" type="text" id="Job Description" placeholder="Job Description"
              required><?= $j['work_discription'] ?></textarea>
          </div>

          <div class="col-span-2 flex justify-start">
            <div class="w-fit">
              <button name="submit" type="submit" class="button">Submit</button>
            </div>
          </div>

        </form>
      </div>
    </div>
  </main>

  <script src="js/app.js"></script>
</body>

</html>