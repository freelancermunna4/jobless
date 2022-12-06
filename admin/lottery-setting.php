<?php
  require_once"common/header.php";
  ?>
      <div class="x_container space-y-10 py-10">

      <?php
      if(isset($_POST['lotteryProfit_s'])){
        $percent=$db->EscapeString($_POST['lotteryProfit']);
        _insertData($db,"UPDATE `site_config` SET `config_value`='$percent' WHERE config_name='lotteryProfit'");
        header('location:lottery-setting');



      }
      ?>

        <hr class="my-6" />
        <form class="grid grid-cols-2 gap-y-6 gap-x-12" action="" method="POST">
          <div class="col-span-2">
            <h2 class="text-xl font-semibold text-cyan-800">Change Profile Percentage</h2>
          </div>

          <div class="col-span-2 lg:col-span-1 flex flex-col gap-y-1">
            <label for="Profit By">Profit By %</label>
            <input name="lotteryProfit"  value="<?= $config['lotteryProfit'] ?>" class="input" type="number" id="Profit By" placeholder="10" required>
          </div>

          <div class="col-span-2 flex justify-start">
            <div class="w-fit">
              <button name="lotteryProfit_s" class="button">Change</button>
            </div>
          </div>
        </form>
      <?php
        if(isset($_POST['option_submit'])){
          $option=$db->EscapeString($_POST['option']);
          $tim=time()+(60*60*$option);
          _insertData($db,"UPDATE `tottery` SET `wintime`='$tim' WHERE id=1");
          echo "<p>Sucess</p>";

        }

        ?>

        <hr class="my-6" />
        <form class="grid grid-cols-2 gap-y-6 gap-x-12" action="" method="POST">
          <div class="col-span-2">
            <h2 class="text-xl font-semibold text-cyan-800">Add More Withdraw Time</h2>
          </div>


          <div class="col-span-2 lg:col-span-1col-span-2 lg:col-span-1 flex flex-col gap-y-1">
            <label for="UserUser">Add Time</label>
            <select class="select" name="option" id="UserUser" required>
              <option value="1">1 Hour</option>
              <option value="2">2 Hour</option>
              <option value="3">3 Hour</option>
              <option value="4">4 Hour</option>
              <option value="5">5 Hour</option>
              <option value="6">6 Hour</option>
              <option value="7">7 Hour</option>
              <option value="8">8 Hour</option>
              <option value="9">9 Hour</option>
              <option value="10">10 Hour</option>
              <option value="11">11 Hour</option>
              <option value="12">12 Hour</option>
              <option value="13">13 Hour</option>
              <option value="14">14 Hour</option>
              <option value="15">15 Hour</option>
              <option value="16">16 Hour</option>
              <option value="17">17 Hour</option>
              <option value="18">18 Hour</option>
              <option value="19">19 Hour</option>
              <option value="20">20 Hour</option>
              <option value="21">21 Hour</option>
              <option value="22">22 Hour</option>
              <option value="23">23 Hour</option>
              <option value="24">24 Hour</option>
            </select>
          </div>

          <div class="col-span-2 flex justify-start">
            <div class="w-fit">
              <button name="option_submit" class="button">Change</button>
            </div>
          </div>
        </form>

      </div>
    </div>
  </main>

  <script src="js/app.js"></script>
</body>

</html>