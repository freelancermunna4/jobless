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
              class="p-4 gap-x-3 flex items-center border-b border-gray-200 hover:bg-white cursor-pointer text-base font-medium text-cyan-800">
              <span class="text-purple-600"><i class="fa-brands fa-amazon-pay"></i></span>
              <span>Payment Gateway</span>
            </a>

            <a href="./limit-setting.php"
              class="p-4 gap-x-3 flex items-center border-b border-gray-200 bg-white cursor-pointer text-base font-medium text-cyan-800">
              <span class="text-red-600"><i class="fa-solid fa-chart-line"></i></span>
              <span>Limit Setting</span>
            </a>

            <a href="./mailing-setting.php"
              class="p-4 gap-x-3 flex items-center border-b border-gray-200 hover:bg-white cursor-pointer font-medium text-cyan-800">
              <span class="text-orange-600"><i class="fa-brands fa-mailchimp"></i></span>
              <span>Mailing Setting</span>
            </a>
            <a href="./social-setting.php"
              class="p-4 gap-x-3 flex items-center border-b border-gray-200 hover:bg-white cursor-pointer font-medium text-cyan-800">
              <span class="text-blue-600"><i class="fa-solid fa-share-nodes"></i></i></span>
              <span>Social Setting</span>
            </a>

            <a href="./all-notice-setting.php"
              class="p-4 gap-x-3 flex items-center border-b border-gray-200 hover:bg-white cursor-pointer font-medium text-cyan-800">
              <span class="text-blue-600"><i class="fa-solid fa-circle-info"></i></span>
              <span>All Notice Setting</span>
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
          if(isset($_POST['fb'])){
            $lnk=$db->EscapeString($_POST['lnk']);
              _insertData($db,"UPDATE site_config SET config_value ='$lnk' WHERE config_name='fb'");
              header('location:social-setting');
          }
          ?>
          <form class="grid grid-cols-2 gap-y-6 gap-x-12"  action="" method="POST">
            <div class="col-span-2">
              <h2 class="text-xl font-semibold text-cyan-800">Social Setting</h2>
            </div>
            <div class="flex flex-col gap-y-1">
              <label for="Minimum Withdraw">Facebook</label>
              <input name="lnk" value="<?= $config['fb'] ?>" class="input" id="Minimum Withdraw" placeholder="Facebook Link" required>
            </div>

            <div class="col-span-2 flex justify-start">
              <div class="w-fit">
                <button name="fb" class="button">Submit</button>
              </div>
            </div>
          </form>

          <hr class="my-6" />
          <?php
          if(isset($_POST['tw'])){
            $lnk=$db->EscapeString($_POST['lnk']);
              _insertData($db,"UPDATE site_config SET config_value ='$lnk' WHERE config_name='tw'");
              header('location:social-setting');
          }
          ?>
          <form class="grid grid-cols-2 gap-y-6 gap-x-12"  action="" method="POST">
            <div class="flex flex-col gap-y-1">
              <label for="Minimum Withdraw">Twitter</label>
              <input name="lnk" value="<?= $config['tw'] ?>" class="input" id="Minimum Withdraw" placeholder="Twitter Link" required>
            </div>

            <div class="col-span-2 flex justify-start">
              <div class="w-fit">
                <button name="tw" class="button">Submit</button>
              </div>
            </div>
          </form>

          <hr class="my-6" />
          <?php
          if(isset($_POST['yt'])){
            $lnk=$db->EscapeString($_POST['lnk']);
              _insertData($db,"UPDATE site_config SET config_value ='$lnk' WHERE config_name='yt'");
              header('location:social-setting');
          }
          ?>
          <form class="grid grid-cols-2 gap-y-6 gap-x-12"  action="" method="POST">
            <div class="flex flex-col gap-y-1">
              <label for="Minimum Withdraw">Youtube</label>
              <input name="lnk" value="<?= $config['yt'] ?>" class="input" id="Minimum Withdraw" placeholder="Youtube Link" required>
            </div>

            <div class="col-span-2 flex justify-start">
              <div class="w-fit">
                <button name="yt" class="button">Submit</button>
              </div>
            </div>
          </form>

          <hr class="my-6" />
          <?php
          if(isset($_POST['ld'])){
            $lnk=$db->EscapeString($_POST['lnk']);
              _insertData($db,"UPDATE site_config SET config_value ='$lnk' WHERE config_name='ld'");
              header('location:social-setting');
          }
          ?>
          <form class="grid grid-cols-2 gap-y-6 gap-x-12"  action="" method="POST">
            <div class="flex flex-col gap-y-1">
              <label for="Minimum Withdraw">Linkedin</label>
              <input name="lnk" value="<?= $config['ld'] ?>" class="input" id="Minimum Withdraw" placeholder="Linkedin Link" required>
            </div>

            <div class="col-span-2 flex justify-start">
              <div class="w-fit">
                <button name="ld" class="button">Submit</button>
              </div>
            </div>
          </form>

          <hr class="my-6" />
          <?php
          if(isset($_POST['foder'])){
            $lnk=$db->EscapeString($_POST['lnk']);
              _insertData($db,"UPDATE site_config SET config_value ='$lnk' WHERE config_name='foder'");
              header('location:social-setting');
          }
          ?>
          <form class="grid grid-cols-2 gap-y-6 gap-x-12"  action="" method="POST">
            <div class="flex flex-col gap-y-1">
              <label for="Minimum Withdraw">Linkedin</label>
              <input name="lnk" value="<?= $config['foder'] ?>" class="input" id="Minimum Withdraw" placeholder="Linkedin Link" required>
            </div>

            <div class="col-span-2 flex justify-start">
              <div class="w-fit">
                <button name="foder" class="button">Submit</button>
              </div>
            </div>
          </form>



        </div>
      </div>
  </main>

  <script src="js/app.js"></script>
</body>

</html>