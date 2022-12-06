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
              class="p-4 gap-x-3 flex items-center border-b border-gray-200 hover:bg-white cursor-pointer text-base font-medium text-cyan-800">
              <span class="text-red-600"><i class="fa-solid fa-chart-line"></i></span>
              <span>Limit Setting</span>
            </a>

            <a href="./mailing-setting.php"
              class="p-4 gap-x-3 flex items-center border-b border-gray-200 bg-white cursor-pointer font-medium text-cyan-800">
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
          if(isset($_POST['smtp_submit'])){
            $host=$db->EscapeString($_POST['host']);
            $port=$db->EscapeString($_POST['port']);
            $user=$db->EscapeString($_POST['user']);
            $pass=$db->EscapeString($_POST['pass']);
            $smtp_auth=$db->EscapeString($_POST['smtp_auth']);

            _insertData($db,"UPDATE site_config SET config_value ='$host' WHERE config_name='smtp_host'");
            _insertData($db,"UPDATE site_config SET config_value ='$port' WHERE config_name='smtp_port'");
            _insertData($db,"UPDATE site_config SET config_value ='$user' WHERE config_name='smtp_username'");
            _insertData($db,"UPDATE site_config SET config_value ='$pass' WHERE config_name='smtp_password'");
            _insertData($db,"UPDATE site_config SET config_value ='$smtp_auth' WHERE config_name='smtp_auth'");
            header('location:mailing-setting');


          }  ?>
          <form class="grid grid-cols-2 gap-y-8 gap-x-12" action="" method="POST">
            <div class="col-span-2">
              <h2 class="text-xl font-semibold text-cyan-800">Mailing System</h2>
            </div>

            <div class="col-span-2 lg:col-span-1 flex flex-col gap-y-1">
              <label for="SMTP Host">SMTP Host</label>
              <input name="host" value="<?=$config['smtp_host'] ?>" class="input" type="text" id="SMTP Host" placeholder="SMTP Host" required>
            </div>

            <div class="col-span-2 lg:col-span-1 flex flex-col gap-y-1">
              <label for="SMTP Port">SMTP Port</label>
              <input name="port" value="<?=$config['smtp_port'] ?>" class="input" type="text" id="SMTP Port" placeholder="SMTP Port" required>
            </div>

            <div class="col-span-2 lg:col-span-1 flex flex-col gap-y-1">
              <label for="SMTP Username">SMTP Username</label>
              <input name="user" value="<?=$config['smtp_username'] ?>" class="input" type="text" id="SMTP Username" placeholder="SMTP Username" required>
            </div>

            <div class="col-span-2 lg:col-span-1 flex flex-col gap-y-1">
              <label for="SMPT Password">SMPT Password</label>
              <input name="pass" value="<?=$config['smtp_password'] ?>" class="input" type="text" id="SMPT Password" placeholder="SMPT Password" required>
            </div>

            <div class="col-span-2 lg:col-span-1col-span-2 lg:col-span-1 flex flex-col gap-y-1">
              <label for="smtp_auto">SMTP Auth</label>
              <select class="select" name="smtp_auth" id="smtp_auto" required>
                <?php $c=$config['smtp_auth'];
                if(empty($c) || $c=="ssl"){ ?>
                <option value="ssl">SSL</option>
                <option value="tsl">TSL</option>
                <?php } else{ ?>
                <option value="tsl">TSL</option>
                <option value="ssl">SSL</option>
                <?php } ?>

              </select>
            </div>

            <div class="col-span-2 flex justify-start">
              <div class="w-fit">
                <button name="smtp_submit" class="button">Submit</button>
              </div>
            </div>

          </form>

          <hr class="my-6" />
          <?php
          if(isset($_POST['mailSubmit'])){
            $cMail=$db->EscapeString($_POST['cMail']);
            $nMail=$db->EscapeString($_POST['nMail']);

            _insertData($db,"UPDATE site_config SET config_value ='$cMail' WHERE config_name='site_email'");
            _insertData($db,"UPDATE site_config SET config_value ='$nMail' WHERE config_name='noreply_email'");
            header('location:mailing-setting');


          }  ?>
          <form class="grid grid-cols-2 gap-y-8 gap-x-12" action="" method="POST">
            <div class="col-span-2">
              <h2 class="text-xl font-semibold text-cyan-800">eMail Settings</h2>
            </div>

            <div class="col-span-2 lg:col-span-1 flex flex-col gap-y-1">
              <label for="Contact Email">Contact Email</label>
              <input name="cMail" value="<?=$config['site_email'] ?>" class="input" type="text" id="Contact Email" placeholder="Contact Email" required>
            </div>

            <div class="col-span-2 lg:col-span-1 flex flex-col gap-y-1">
              <label for="NoReply Email">NoReply Email</label>
              <input name="nMail" value="<?=$config['noreply_email'] ?>" class="input" type="text" id="NoReply Email" placeholder="NoReply Email" required>
            </div>

            <div class="col-span-2 flex justify-start">
              <div class="w-fit">
                <button name="mailSubmit" class="button">Submit</button>
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