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
              class="p-4 gap-x-3 flex items-center border-b border-gray-200 bg-white cursor-pointer font-medium text-cyan-800">
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

          <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <?php
            if(isset($_POST['j_submit'])){
              $notice=$db->EscapeString($_POST['notice']);
              _insertData($db,"UPDATE `notice` SET notice='$notice' WHERE name='job'");
            }
            $nt=_getData($db,"SELECT * FROM `notice` WHERE name='job'");
            ?>
            <form class="grid grid-cols-2 gap-y-6" action="" method="POST">
              <div class="col-span-2 flex flex-col gap-y-1">
                <label for="Job Notice">Job Notice</label>
                <textarea name="notice" class="input p-3 min-h-[70px]" type="text" id="Job Notice" placeholder="Job Notice"
                  required><?= $nt['notice'] ?></textarea>
              </div>
              <div class="col-span-2 flex justify-start">
                <div class="w-fit">
                  <button name="j_submit" class="button">Submit</button>
                </div>
              </div>
            </form>

            <?php
            if(isset($_POST['w_submit'])){
              $notice=$db->EscapeString($_POST['notice']);
              _insertData($db,"UPDATE `notice` SET notice='$notice' WHERE name='web'");
            }
            $nt=_getData($db,"SELECT * FROM `notice` WHERE name='web'");
            ?>

            <form class="grid grid-cols-2 gap-y-6" action="" method="POST">
              <div class="col-span-2 flex flex-col gap-y-1">
                <label for="Website Notice">Website Notice</label>
                <textarea name="notice" class="input p-3 min-h-[70px]" type="text" id="Website Notice" placeholder="Website Notice"
                  required><?= $nt['notice'] ?></textarea>
              </div>
              <div class="col-span-2 flex justify-start">
                <div class="w-fit">
                  <button name="w_submit" class="button">Submit</button>
                </div>
              </div>
            </form>

            <?php
            if(isset($_POST['v_submit'])){
              $notice=$db->EscapeString($_POST['notice']);
              _insertData($db,"UPDATE `notice` SET notice='$notice' WHERE name='video'");
            }
            $nt=_getData($db,"SELECT * FROM `notice` WHERE name='video'");
            ?>

            <form class="grid grid-cols-2 gap-y-6" action="" method="POST">
              <div class="col-span-2 flex flex-col gap-y-1">
                <label for="Video Notice">Video Notice</label>
                <textarea  name="notice" class="input p-3 min-h-[70px]" type="text" id="Video Notice" placeholder="Video Notice"
                  required><?= $nt['notice'] ?></textarea>
              </div>
              <div class="col-span-2 flex justify-start">
                <div class="w-fit">
                  <button name="v_submit" class="button">Submit</button>
                </div>
              </div>
            </form>

            <?php
            if(isset($_POST['vs_submit'])){
              $notice=$db->EscapeString($_POST['notice']);
              _insertData($db,"UPDATE `notice` SET notice='$notice' WHERE name='subs'");
            }
            $nt=_getData($db,"SELECT * FROM `notice` WHERE name='subs'");
            ?>

            <form class="grid grid-cols-2 gap-y-6" action="" method="POST">
              <div class="col-span-2 flex flex-col gap-y-1">
                <label for="Video Notice">Subscriber Notice</label>
                <textarea  name="notice" class="input p-3 min-h-[70px]" type="text" id="Video Notice" placeholder="Video Notice"
                  required><?= $nt['notice'] ?></textarea>
              </div>
              <div class="col-span-2 flex justify-start">
                <div class="w-fit">
                  <button name="vs_submit" class="button">Submit</button>
                </div>
              </div>
            </form>

            <?php
            if(isset($_POST['r_submit'])){
              $notice=$db->EscapeString($_POST['notice']);
              _insertData($db,"UPDATE `notice` SET notice='$notice' WHERE name='recharge'");
            }
            $nt=_getData($db,"SELECT * FROM `notice` WHERE name='recharge'");
            ?>

            <form class="grid grid-cols-2 gap-y-6" action="" method="POST">
              <div class="col-span-2 flex flex-col gap-y-1">
                <label for="Gift Recharge Notice">Gift Recharge Notice</label>
                <textarea  name="notice" class="input p-3 min-h-[70px]" type="text" id="Gift Recharge Notice"
                  placeholder="Gift Recharge Notice" required><?= $nt['notice'] ?></textarea>
              </div>
              <div class="col-span-2 flex justify-start">
                <div class="w-fit">
                  <button name="r_submit" class="button">Submit</button>
                </div>
              </div>
            </form>

            <?php
            if(isset($_POST['rw_submit'])){
              $notice=$db->EscapeString($_POST['notice']);
              _insertData($db,"UPDATE `notice` SET notice='$notice' WHERE name='reword'");
            }
            $nt=_getData($db,"SELECT * FROM `notice` WHERE name='reword'");
            ?>
            <form class="grid grid-cols-2 gap-y-6" action="" method="POST">
              <div class="col-span-2 flex flex-col gap-y-1">
                <label for="Gift Rewards Notice">Gift Rewards Notice</label>
                <textarea name="notice" class="input p-3 min-h-[70px]" type="text" id="Gift Rewards Notice"
                  placeholder="Gift Rewards Notice" required><?= $nt['notice'] ?></textarea>
              </div>
              <div class="col-span-2 flex justify-start">
                <div class="w-fit">
                  <button  name="rw_submit" class="button">Submit</button>
                </div>
              </div>
            </form>

            <?php
            if(isset($_POST['g_submit'])){
              $notice=$db->EscapeString($_POST['notice']);
              _insertData($db,"UPDATE `notice` SET notice='$notice' WHERE name='game'");
            }
            $nt=_getData($db,"SELECT * FROM `notice` WHERE name='game'");
            ?>
            <form class="grid grid-cols-2 gap-y-6" action="" method="POST">
              <div class="col-span-2 flex flex-col gap-y-1">
                <label for="Game Rewards Notice">Game Rewards Notice</label>
                <textarea name="notice" class="input p-3 min-h-[70px]" type="text" id="Game Rewards Notice" placeholder="Job Notice"
                  required><?= $nt['notice'] ?></textarea>
              </div>
              <div class="col-span-2 flex justify-start">
                <div class="w-fit">
                  <button name="g_submit" class="button">Submit</button>
                </div>
              </div>
            </form>


            <?php
            if(isset($_POST['sub_submit'])){
              $notice=$db->EscapeString($_POST['notice']);
              _insertData($db,"UPDATE `notice` SET notice='$notice' WHERE name='subs'");
            }
            $nt=_getData($db,"SELECT * FROM `notice` WHERE name='subs'");
            ?>
            <form class="grid grid-cols-2 gap-y-6" action="" method="POST">
              <div class="col-span-2 flex flex-col gap-y-1">
                <label for="Game Rewards Notice">Game Rewards Notice</label>
                <textarea name="notice" class="input p-3 min-h-[70px]" type="text" id="Game Rewards Notice" placeholder="Youtube Subscriber Notice"
                  required><?= $nt['notice'] ?></textarea>
              </div>
              <div class="col-span-2 flex justify-start">
                <div class="w-fit">
                  <button name="sub_submit" class="button">Submit</button>
                </div>
              </div>
            </form>
          </div>


        </div>
      </div>
    </div>
  </main>

  <script src="js/app.js"></script>
</body>

</html>