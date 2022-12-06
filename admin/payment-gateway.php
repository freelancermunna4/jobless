<?php
  require_once"common/header.php";
  ?>
      <div class="x_container py-10 flex items-start relative">
        <div style="width:300px;" class="h-screen sticky top-0 left-0 right-0 hidden md:block">
          <ul
            class="-mr-[1px] h-fit bg-gray-100 sticky top-[80px] left-0 border border-r-0 border-gray-200 border-r-transparent rounded-l overflow-hidden">
            <a href="./settings.php"
              class="p-4 gap-x-3 flex items-center border-b border-gray-200 hover:bg-white cursor-pointer text-base font-medium text-cyan-800">
              <span><i class="fa-solid fa-screwdriver-wrench"></i></span>
              <span>General Setting</span>
            </a>

            <a href="./payment-gateway.php"
              class="p-4 gap-x-3 flex items-center border-b border-gray-200 bg-white cursor-pointer text-base font-medium text-cyan-800">
              <span class="text-purple-600"><i class="fa-brands fa-amazon-pay"></i></span>
              <span>Payment Gateway</span>
            </a>

            <a href="./limit-setting.php"
              class="p-4 gap-x-3 flex items-center border-b border-gray-200 hover:bg-white cursor-pointer text-base font-medium text-cyan-800">
              <span class="text-red-600"><i class="fa-solid fa-chart-line"></i></span>
              <span>Limit Setting</span>
            </a>

            <a href="./mailing-setting.php"
              class="p-4 gap-x-3 flex items-center border-b border-gray-200 hover:bg-white cursor-pointer font-medium text-cyan-800">
              <span class="text-orange-600"><i class="fa-brands fa-mailchimp"></i></span>
              <span>Mailing Setting</span>
            </a>
            <a href="./all-notice-setting.php"
              class="p-4 gap-x-3 flex items-center border-b border-gray-200 hover:bg-white cursor-pointer font-medium text-cyan-800">
              <span class="text-blue-600"><i class="fa-solid fa-circle-info"></i></span>
              <span>All Notice Setting</span>
            </a>

            <a href="./social-setting.php"
              class="p-4 gap-x-3 flex items-center border-b border-gray-200 hover:bg-white cursor-pointer font-medium text-cyan-800">
              <span class="text-blue-600"><i class="fa-solid fa-share-nodes"></i></i></span>
              <span>Social Setting</span>
            </a>

            <a href="./adsense.php"
              class="p-4 gap-x-3 flex items-center hover:bg-white cursor-pointer font-medium text-cyan-800">
              <span class="text-orange-600"><i class="fa-brands fa-google"></i></span>
              <span>Adsense</span>
            </a>
          </ul>
        </div>

        <div class="w-full space-y-10 p-6 lg:p-12 bg-white border border-gray-200 rounded">
            <?php
            if(isset($_POST['Payoneer_s'])){
              $Payoneer=$db->EscapeString($_POST['Payoneer']);
              $activity=$db->EscapeString($_POST['activity']);

              _insertData($db,"UPDATE `deposit_config` SET `accaunt`='$Payoneer',`activity`='$activity' WHERE id=4");
            }
            $v=_getData($db,"SELECT * FROM `deposit_config` WHERE id=4");
            ?>

          <form class="grid grid-cols-2 gap-y-6 gap-x-12"  action="" method="POST">
            <div class="col-span-2">
              <h2 class="text-xl font-semibold text-cyan-800">Payoneer</h2>
            </div>

            <div class="flex flex-col gap-y-1">
              <label for="Payoneer Email">Payoneer Email</label>
              <input name="Payoneer" value="<?= $v['accaunt'] ?>"  class="input" type="text" id="Payoneer Email" placeholder="Payoneer Email" required>
            </div>
            <!-- selected -->
            <div class="flex flex-col gap-y-1">
              <label for="Status">Status</label>
              <select class="select" name="activity" id="Status" required>
                <?php
                $o=$v['activity'];
                if($o==1){
                  echo '<option value="1">Enable</option><option value="0">Disabled</option>';

                }else{
                  echo '<option value="0">Disabled</option><option value="1">Enable</option>';
                }
                ?>

              </select>
            </div>

            <div class="col-span-2 flex justify-start">
              <div class="w-fit">
                <button name="Payoneer_s" class="button">Submit</button>
              </div>
            </div>
          </form>



          <hr class="my-6" />
          <?php
            if(isset($_POST['Paypal_s'])){
              $Paypal=$db->EscapeString($_POST['Paypal']);
              $activity=$db->EscapeString($_POST['activity']);

              _insertData($db,"UPDATE `deposit_config` SET `accaunt`='$Paypal',`activity`='$activity' WHERE id=5");
            }
            $v=_getData($db,"SELECT * FROM `deposit_config` WHERE id=5");
            ?>
          <form class="grid grid-cols-2 gap-y-6 gap-x-12" action="" method="POST">
            <div class="col-span-2">
              <h2 class="text-xl font-semibold text-cyan-800">Paypal</h2>
            </div>

            <div class="flex flex-col gap-y-1">
              <label for="Paypal Email">Paypal Email</label>
              <input name="Paypal" value="<?= $v['accaunt'] ?>" class="input" type="text" id="Paypal Email" placeholder="Paypal Email" required>
            </div>

            <div class="flex flex-col gap-y-1">
              <label for="Status">Status</label>
              <select class="select" name="activity" id="Status" required>
              <?php
                $o=$v['activity'];
                if($o==1){
                  echo '<option value="1">Enable</option><option value="0">Disabled</option>';

                }else{
                  echo '<option value="0">Disabled</option><option value="1">Enable</option>';
                }
                ?>
              </select>
            </div>

            <div class="col-span-2 flex justify-start">
              <div class="w-fit">
                <button name="Paypal_s" class="button">Submit</button>
              </div>
            </div>

          </form>

          <hr class="my-6" />
          <?php
            if(isset($_POST['bkash_s'])){
              $bkash=$db->EscapeString($_POST['bkash']);
              $activity=$db->EscapeString($_POST['activity']);

              _insertData($db,"UPDATE `deposit_config` SET `accaunt`='$bkash',`activity`='$activity' WHERE id=1");
            }
            $v=_getData($db,"SELECT * FROM `deposit_config` WHERE id=1");
            ?>
          <form class="grid grid-cols-2 gap-y-6 gap-x-12"  action="" method="POST">
            <div class="col-span-2">
              <h2 class="text-xl font-semibold text-cyan-800">Bkash</h2>
            </div>
            <div class="flex flex-col gap-y-1">
              <label for="Bkash Number">Bkash Number</label>
              <input name="bkash" value="<?= $v['accaunt'] ?>" class="input" id="Bkash Number" placeholder="Bkash Number" required>
            </div>

            <div class="flex flex-col gap-y-1">
              <label for="Status">Status</label>
              <select class="select" name="activity" id="Status" required>
              <?php
                $o=$v['activity'];
                if($o==1){
                  echo '<option value="1">Enable</option><option value="0">Disabled</option>';

                }else{
                  echo '<option value="0">Disabled</option><option value="1">Enable</option>';
                }
                ?>
              </select>
            </div>

            <div class="col-span-2 flex justify-start">
              <div class="w-fit">
                <button name="bkash_s" class="button">Submit</button>
              </div>
            </div>
          </form>

          <hr class="my-6" />

          <?php
            if(isset($_POST['roket_s'])){
              $roket=$db->EscapeString($_POST['roket']);
              $activity=$db->EscapeString($_POST['activity']);

              _insertData($db,"UPDATE `deposit_config` SET `accaunt`='$roket',`activity`='$activity' WHERE id=2");
            }
            $v=_getData($db,"SELECT * FROM `deposit_config` WHERE id=2");
            ?>

          <form class="grid grid-cols-2 gap-y-6 gap-x-12" action="" method="POST">
            <div class="col-span-2">
              <h2 class="text-xl font-semibold text-cyan-800">Rocket</h2>
            </div>
            <div class="flex flex-col gap-y-1">
              <label for="Rocket Number">Rocket Number</label>
              <input name="roket" value="<?=$v['accaunt'] ?>" class="input" id="Rocket Number" placeholder="Rocket Number" required>
            </div>

            <div class="flex flex-col gap-y-1">
              <label for="Status">Status</label>
              <select class="select" name="activity" id="Status" required>
              <?php
                $o=$v['activity'];
                if($o==1){
                  echo '<option value="1">Enable</option><option value="0">Disabled</option>';

                }else{
                  echo '<option value="0">Disabled</option><option value="1">Enable</option>';
                }
                ?>
              </select>
            </div>

            <div class="col-span-2 flex justify-start">
              <div class="w-fit">
                <button name="roket_s" class="button">Submit</button>
              </div>
            </div>
          </form>


          <hr class="my-6" />

          <?php
            if(isset($_POST['Nagat_s'])){
              $Nagat=$db->EscapeString($_POST['Nagat']);
              $activity=$db->EscapeString($_POST['activity']);

              _insertData($db,"UPDATE `deposit_config` SET `accaunt`='$Nagat',`activity`='$activity' WHERE id=3");
            }
            $v=_getData($db,"SELECT * FROM `deposit_config` WHERE id=3");
            ?>
          <form class="grid grid-cols-2 gap-y-6 gap-x-12" action="" method="POST">
            <div class="col-span-2">
              <h2 class="text-xl font-semibold text-cyan-800">Nagat</h2>
            </div>
            <div class="flex flex-col gap-y-1">
              <label for="Nagat Number">Nagat Number</label>
              <input name="Nagat" value="<?=$v['accaunt'] ?>" class="input" id="Nagat Number" placeholder="Nagat Number" required>
            </div>

            <div class="flex flex-col gap-y-1">
              <label for="Status">Status</label>
              <select class="select" name="activity" id="Status" required>
              <?php
                $o=$v['activity'];
                if($o==1){
                  echo '<option value="1">Enable</option><option value="0">Disabled</option>';

                }else{
                  echo '<option value="0">Disabled</option><option value="1">Enable</option>';
                }
                ?>
              </select>
            </div>

            <div class="col-span-2 flex justify-start">
              <div class="w-fit">
                <button name="Nagat_s" class="button">Submit</button>
              </div>
            </div>
          </form>

          <hr class="my-6" />
          <?php
            if(isset($_POST['bank_s'])){
              $bank=$db->EscapeString($_POST['bank']);
              $activity=$db->EscapeString($_POST['activity']);

              _insertData($db,"UPDATE `deposit_config` SET `accaunt`='$bank',`activity`='$activity' WHERE id=6");
            }
            $v=_getData($db,"SELECT * FROM `deposit_config` WHERE id=6");
            ?>
          <form class="grid grid-cols-2 gap-y-6 gap-x-12" action="" method="POST">
            <div class="col-span-2">
              <h2 class="text-xl font-semibold text-cyan-800">Bank Details</h2>
            </div>

            <div class="flex flex-col gap-y-1">
              <label for="Bank Details">Bank Details</label>
              <textarea name="bank" class="input p-3 min-h-[100px]" id="Bank Details" placeholder="Bank Details"
                required><?=$v['accaunt'] ?></textarea>
            </div>

            <div class="flex flex-col gap-y-1">
              <label for="Status">Status</label>
              <select class="select" name="activity" id="Status" required>
              <?php
                $o=$v['activity'];
                if($o==1){
                  echo '<option value="1">Enable</option><option value="0">Disabled</option>';

                }else{
                  echo '<option value="0">Disabled</option><option value="1">Enable</option>';
                }
                ?>
              </select>
              </select>
            </div>

            <div class="col-span-2 flex justify-start">
              <div class="w-fit">
                <button name="bank_s" class="button">Submit</button>
              </div>
            </div>

          </form>


        </div>
      </div>
  </main>

  <script src="js/app.js"></script>
</body>

</html>