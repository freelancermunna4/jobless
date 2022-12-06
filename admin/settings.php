<?php
  require_once"common/header.php";
  ?>


      <div class="x_container py-10 flex items-start relative">
        <div style="width:300px;" class="h-screen sticky top-0 left-0 right-0 hidden md:block">
          <ul
            class="-mr-[1px] h-fit bg-gray-100 sticky top-[80px] left-0 border border-r-0 border-gray-200 border-r-transparent rounded-l overflow-hidden">
            <a href="./settings.php"
              class="p-4 gap-x-3 flex items-center border-b border-gray-200 bg-white cursor-pointer text-base font-medium text-cyan-800">
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
              class="p-4 gap-x-3 flex items-center hover:bg-white cursor-pointer font-medium text-cyan-800">
              <span class="text-orange-600"><i class="fa-brands fa-google"></i></span>
              <span>Adsense</span>
            </a>
          </ul>
        </div>

        <?php
        if(isset($_POST['submitSiteconfig'])){
          $site_name=$db->EscapeString($_POST['site_name']);
          $site_url=$db->EscapeString($_POST['site_url']);
          $site_description=$db->EscapeString($_POST['site_description']);
          $site_keywords=$db->EscapeString($_POST['site_keywords']);

          _insertData($db,"UPDATE site_config SET config_value ='$site_name' WHERE config_name='site_name'");
          _insertData($db,"UPDATE site_config SET config_value ='$site_url' WHERE config_name='site_url'");
          _insertData($db,"UPDATE site_config SET config_value ='$site_description' WHERE config_name='site_description'");
          _insertData($db,"UPDATE site_config SET config_value ='$site_keywords' WHERE config_name='site_keywords'");
          header('location:settings');
        }
        ?>

        <div class="w-full space-y-10 p-6 lg:p-12 bg-white border border-gray-200 rounded">
          <form class="grid grid-cols-2 gap-y-6 gap-x-12" action="" method="POST">
            <div class="col-span-2">
              <h2 class="text-xl font-semibold text-cyan-800">Website Info</h2>
            </div>

            <div class="col-span-2 lg:col-span-1 flex flex-col gap-y-1">
              <label for="Site Title">Site Title</label>
              <input name="site_name" value="<?= $config['site_name'] ?>" class="input" type="text" id="Site Title" placeholder="Site Title" required>
            </div>


            <div class="col-span-2 lg:col-span-1 flex flex-col gap-y-1">
              <label for="Site URL">Site URL</label>
              <input name="site_url" value="<?= $config['site_url'] ?>" class="input" type="text" id="Site URL" placeholder="Site URL" required>
            </div>


            <div class="col-span-2 lg:col-span-1 flex flex-col gap-y-1">
              <label for="Site Description">Site Description <small>(Website Meta Description)</small> </label>
              <input name="site_description" value="<?= $config['site_description'] ?>" class="input" type="text" id="Site Description" placeholder="Site Description" required>
            </div>

            <div class="col-span-2 lg:col-span-1 flex flex-col gap-y-1">
              <label for="Site Keywords">Site Keywords <small>(Meta Keywords)</small> </label>
              <input name="site_keywords" value="<?= $config['site_keywords'] ?>" class="input" type="text" id="Site Keywords" placeholder="Site Keywords" required>
            </div>



            <div class="col-span-2 flex justify-start">
              <div class="w-fit">
                <button name="submitSiteconfig" class="button">Submit</button>
              </div>
            </div>
          </form>




          <?php
            if(isset($_POST['fav_upload'])){
              $profilepic=$_FILES['img'];
              if(!empty($profilepic)){
                  /**  image */
                  $fileName=$_FILES['img']['name'];
                  $fileTempName=$_FILES['img']['tmp_name'];
                  $fileSize=$_FILES['img']['size'];
                  $fileError=$_FILES['img']['error'];
                  $fileType=$_FILES['img']['type'];
                  $fileExt=explode('.',$fileName);
                  $fileActualExt=strtolower(end($fileExt));
                  $allaowed=array('ico');
                  if(in_array($fileActualExt,$allaowed)){
                  if ($fileError===0) {
                      if($fileSize<1000000){
                      $fileNameNew=uniqid('',true).".".$fileActualExt;
                      $fileDestination="../assets/images/".$fileNameNew;
                      move_uploaded_file( $fileTempName,$fileDestination);


                      _insertData($db,"UPDATE site_config SET config_value ='$fileNameNew' WHERE config_name='favicon'");
                      // header('location:settings');


                         }else{
                                echo "Your file is too big!";

                               }

                              }else{
                                  echo "There is an Error uploading your file!";

                              }
                          }else{
                              echo "You cannot upload files this type !";

                          }

              }



            }
          ?>

          <hr class="my-6" />
          <form class="grid grid-cols-2 gap-y-6 gap-x-12" action="" method="POST" enctype="multipart/form-data">
            <div class="col-span-2">
              <h2 class="text-xl font-semibold text-cyan-800"> Favicon</h2>
            </div>

            <div class="col-span-2 lg:col-span-1 flex flex-col gap-y-1">
              <label for="Comission">Upload Favicon(.ico)</label>
              <input name="img" class="input" type="file" id="Comission" placeholder="10" style="padding: 10px;" required>
            </div>

            <div class="col-span-2 flex justify-start">
              <div class="w-fit">
                <button name="fav_upload" class="button">Submit</button>
              </div>
            </div>

          </form>





          <?php
            if(isset($_POST['ref_comition'])){
              $refarel_comition=$db->EscapeString($_POST['refarel_comition']);
              _insertData($db,"UPDATE site_config SET config_value ='$refarel_comition' WHERE config_name='refarel_comition'");
              header('location:settings');
            }
          ?>

          <hr class="my-6" />
          <form class="grid grid-cols-2 gap-y-6 gap-x-12" action="" method="POST">
            <div class="col-span-2">
              <h2 class="text-xl font-semibold text-cyan-800"> Referral System </h2>
            </div>

            <div class="col-span-2 lg:col-span-1 flex flex-col gap-y-1">
              <label for="Comission">User Commission <small>(% of coins earned by referral)</small></label>
              <input name="refarel_comition" value="<?=$config['refarel_comition'] ?>" class="input" type="text" id="Comission" placeholder="10" required>
            </div>

            <div class="col-span-2 flex justify-start">
              <div class="w-fit">
                <button name="ref_comition" class="button">Submit</button>
              </div>
            </div>

          </form>






          <?php
            if(isset($_POST['WithdrawCommition'])){
              $apiKey=$db->EscapeString($_POST['WithdrawCommition']);
              _insertData($db,"UPDATE site_config SET config_value ='$apiKey' WHERE config_name='WithdrawCommition'");
              header('location:settings');
            }
          ?>

          <hr class="my-6" />
          <form class="grid grid-cols-2 gap-y-6 gap-x-12" action="" method="POST">
            <div class="col-span-2">
              <h2 class="text-xl font-semibold text-cyan-800"> Withdraw Commition % </h2>
            </div>

            <div class="col-span-2 lg:col-span-1 flex flex-col gap-y-1">
              <label for="Comission">Withdraw Commition</label>
              <input name="WithdrawCommition" value="<?=$config['WithdrawCommition'] ?>" class="input" type="text" id="Comission" placeholder="10" required>
            </div>

            <div class="col-span-2 flex justify-start">
              <div class="w-fit">
                <button name="wcommition" class="button">Submit</button>
              </div>
            </div>

          </form>



          <?php
            if(isset($_POST['DepositCommition'])){
              $apiKey=$db->EscapeString($_POST['DepositCommition']);
              _insertData($db,"UPDATE site_config SET config_value ='$apiKey' WHERE config_name='DepositCommition'");
              header('location:settings');
            }
          ?>

          <hr class="my-6" />
          <form class="grid grid-cols-2 gap-y-6 gap-x-12" action="" method="POST">
            <div class="col-span-2">
              <h2 class="text-xl font-semibold text-cyan-800"> Deposit Commition % </h2>
            </div>

            <div class="col-span-2 lg:col-span-1 flex flex-col gap-y-1">
              <label for="Comission">Deposit Commition</label>
              <input name="DepositCommition" value="<?=$config['DepositCommition'] ?>" class="input" type="text" id="Comission" placeholder="10" required>
            </div>

            <div class="col-span-2 flex justify-start">
              <div class="w-fit">
                <button name="wcommition" class="button">Submit</button>
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