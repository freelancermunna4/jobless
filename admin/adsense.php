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
              class="p-4 gap-x-3 flex items-center bg-white cursor-pointer font-medium text-cyan-800">
              <span class="text-orange-600"><i class="fa-brands fa-google"></i></span>
              <span>Adsense</span>
            </a>
          </ul>
        </div>
        <div class="w-full space-y-10 p-6 lg:p-12 bg-white border border-gray-200 rounded">
          <?php
          if(isset($_POST['topsubmit'])){
            $code=$_POST['code'];
            $code=base64_encode($code);
            _insertData($db,"UPDATE ads SET code='$code' WHERE name='top'");

          }
          $ad=_getData($db,"SELECT * FROM `ads` WHERE name='top'");
          ?>
          <form class="space-y-6" action="" method="POST">
            <div class="flex flex-col gap-y-1">
              <label for="Your Top Ads Code Hare">Your Top Ads Code Hare</label>
              <textarea name="code" class="input p-3 min-h-[100px]" id="Your Top Ads Code Hare
              " placeholder="Ads Code Here..." ><?= base64_decode($ad['code']) ?></textarea>
            </div>

            <div class="col-span-2 flex justify-start">
              <div class="w-fit">
                <button name="topsubmit" class="button">Submit</button>
              </div>
            </div>
          </form>

          <?php
          if(isset($_POST['bottomsubmit'])){
            $code=$_POST['code'];
            $code=base64_encode($code);
            _insertData($db,"UPDATE ads SET code='$code' WHERE name='bottom'");

          }
          $ad=_getData($db,"SELECT * FROM `ads` WHERE name='bottom'");
          ?>
          <hr class="my-6" />
          <form class="space-y-6" action="" method="POST">
            <div class="flex flex-col gap-y-1">
              <label for="Your Bottom Ads Code Hare">Your Bottom Ads Code Hare</label>
              <textarea name="code" class="input p-3 min-h-[100px]" id="Your Top Ads Code Hare
              " placeholder="Ads Code Here..." ><?= base64_decode($ad['code']) ?></textarea> </div>

            <div class="col-span-2 flex justify-start">
              <div class="w-fit">
                <button name="bottomsubmit" class="button">Submit</button>
              </div>
            </div>
          </form>


          <?php
          if(isset($_POST['sidesubmit'])){
            $code=$_POST['code'];
            $code=base64_encode($code);
            _insertData($db,"UPDATE ads SET code='$code' WHERE name='side'");

          }
          $ad=_getData($db,"SELECT * FROM `ads` WHERE name='side'");
          ?>
          <hr class="my-6" />
          <form class="space-y-6" action="" method="POST">
            <div class="flex flex-col gap-y-1">
              <label for="Your Sidebar Ads Code Hare">Your Sidebar Ads Code Hare</label>
              <textarea name="code" class="input p-3 min-h-[100px]" id="Your Top Ads Code Hare
              " placeholder="Ads Code Here..." ><?= base64_decode($ad['code']) ?></textarea> </div>

            <div class="col-span-2 flex justify-start">
              <div class="w-fit">
                <button name="sidesubmit" class="button">Submit</button>
              </div>
            </div>
          </form>
        </div>



      </div>
  </main>

  <script src="js/app.js"></script>
</body>

</html>