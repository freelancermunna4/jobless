<?php
  require_once"common/header.php";
    $uid=$data['id'];

  if(isset($_POST['submit'])){

    $time=$db->EscapeString($_POST['time']);
    $opt=$db->EscapeString($_POST['opt']);
    $amount=$db->EscapeString($_POST['amount']);

    if($opt=="minute"){
      $option=$time*60;
    }else if($opt=="hour"){
      $option=$time*60*60;
    }else if($opt=="days"){
      $option=$time*60*60*24;
    }else{
      $option=$time;
    }


    $insert=_insertData($db,"UPDATE `site_config` SET `config_value`='$option' WHERE config_name='gifttimer'");
    $upd=_insertData($db,"UPDATE `luckycupon` SET `louckyPrice`=' $amount' WHERE id=1");
    if($insert && $upd){

      echo '<h4 style="text-align: center;color: blue;">success</h4>';
    }else{
      echo '<p style="text-align: center;color: red;">Something Wrong</p>';}
   }

  ?>
      <div class="x_container space-y-10 py-10">
        <form class="grid grid-cols-2 gap-y-8 gap-x-12" action="" method="POST">
          <div class="col-span-2">
            <h2 class="text-xl font-semibold text-cyan-800">Add New Gift Recharge</h2>
          </div>

          <div class="col-span-2 lg:col-span-1col-span-2 lg:col-span-1 flex flex-col gap-y-1">
          <label for="Visits">Amount (Coins)</label>
            <input name="amount" class="input" type="number" id="Visits" placeholder="1000" required>
            <br/>
            <br/>

            <label for="Visits">Time</label>
            <input name="time" class="input" type="number" id="Visits" placeholder="1000" required>
            <br/>
            <br/>

            <label for="UserUser">Option</label>
            <select name="opt" class="select" name="" id="UserUser" required>

                 <option value="minute">Minute</option>
                 <option value="hour">Hour</option>
                 <option value="days">Days</option>


            </select>
            <br/>
            <br/>

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