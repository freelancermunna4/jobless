<?php
  require_once"common/header.php";

?>


<div class="x_container space-y-10 py-10">

    <div class="w-full space-y-10 p-6 lg:p-12 bg-white border border-gray-200 rounded">
        <?php
            if(isset($_POST['Payoneer_s'])){
              $activity=$db->EscapeString($_POST['activity']);

              _insertData($db,"UPDATE `site_config` SET `config_value`='$activity' WHERE config_name='gameStatus'");
              header('location:game-settings');
            }
           
            ?>

        <form class="grid grid-cols-2 gap-y-6 gap-x-12" action="" method="POST">
            <div class="col-span-2">
                <h2 class="text-xl font-semibold text-cyan-800">Game ON/OFF</h2>
            </div>

            <!-- selected -->
            <div class="flex flex-col gap-y-1">
                <label for="Status">Status</label>
                <select class="select" name="activity" id="Status" required>
                    <?php
                $o=$config['gameStatus'];
                if($o==1){
                  echo '<option value="1">Enable</option>
                  <option value="0">Disabled</option>';

                }else{
                  echo '<option value="0">Disabled</option>
                  <option value="1">Enable</option>';
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


    </div>
</div>
</main>

<script src="js/app.js"></script>
</body>

</html>