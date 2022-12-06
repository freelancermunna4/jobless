<?php
  require_once"common/header.php";

?>



<div class="x_container space-y-10 py-10">

    <!-- Users Statistics -->
    <div class="shadow bg-white rounded w-fulls overflow-hidden">
        <h3 class="p-4 gap-x-3 flex border-b border-gray-100 items-center font-semibold text-cyan-900">
            <i class="fa-solid fa-users"></i>
            <span>Users Statistics</span>
        </h3>
        <div class="p-5 flex flex-wrap gap-5">
            <div
                class="bg-purple-600 text-white p-4 rounded shadow w-full sm:w-64 flex flex-col items-center justify-center gap-2">
                <h3 class="text-xl font-bold">

                    <?php
              $userd=_getAllData($db,"SELECT * FROM `users` WHERE admin =0");
             echo  count($userd);
             ?>

                </h3>
                <h5 class="text-base">All Users</h5>
            </div>



            <div
                class="bg-blue-700 text-white p-4 rounded shadow w-full sm:w-64 flex flex-col items-center justify-center gap-2">
                <h3 class="text-xl font-bold">
                    <?php
                $time=time()+86400;
              $userd=_getAllData($db,"SELECT * FROM `users` WHERE admin =0 AND reg_time>$time");
              if($userd !=0){ echo  count($userd);}else{echo 0;}
             ?>
                </h3>
                <h5 class="text-base">Registered Today</h5>
            </div>

            <div
                class="bg-amber-600 text-white p-4 rounded shadow w-full sm:w-64 flex flex-col items-center justify-center gap-2">
                <h3 class="text-xl font-bold">
                    <?php
              $userd=_getAllData($db,"SELECT * FROM `users` WHERE admin =0 AND disabled=1");
              if($userd !=0){ echo  count($userd);}else{echo 0;}
             ?>
                </h3>
                <h5 class="text-base">Banned Users</h5>
            </div>

        </div>
    </div>

    <!--  Balence -->
    <div class="shadow bg-white rounded w-fulls overflow-hidden">
        <h3 class="p-4 gap-x-3 flex border-b border-gray-100 items-center font-semibold text-cyan-900">
            <i class="fa-solid fa-users"></i>
            <span>Balence</span>
        </h3>
        <div class="p-5 flex flex-wrap gap-5">
            <div
                class="bg-purple-600 text-white p-4 rounded shadow w-full sm:w-64 flex flex-col items-center justify-center gap-2">
                <h3 class="text-xl font-bold">

                    <?php
              $userd=_getAllData($db,"SELECT * FROM `users` WHERE disabled=0 AND admin =0");
              $balence=0;
              foreach($userd as $d){
                $balence= $balence+$d['coins'];
              }
             echo  $balence;
             ?>

                </h3>
                <h5 class="text-base">Users Total Balence</h5>
            </div>



            <div
                class="bg-blue-700 text-white p-4 rounded shadow w-full sm:w-64 flex flex-col items-center justify-center gap-2">
                <h3 class="text-xl font-bold">
                    <?php
              $userd=_getAllData($db,"SELECT * FROM `users` WHERE disabled=0 AND admin =1");
              $balence=0;
              foreach($userd as $d){
                $balence= $balence+$d['coins'];
              }
             echo  $balence;
             ?>
                </h3>
                <h5 class="text-base">Admin Total Balence</h5>
            </div>

            <div
                class="bg-amber-600 text-white p-4 rounded shadow w-full sm:w-64 flex flex-col items-center justify-center gap-2">
                <h3 class="text-xl font-bold">

                    <?php
              $userd=_getAllData($db,"SELECT * FROM `withdrawals` WHERE status=1");
              $balence=0;
              foreach($userd as $d){
                $balence= $balence+$d['coins'];
              }
             echo  $balence;
             ?>
                </h3>
                <h5 class="text-base">Total Withdraw</h5>
            </div>

            <!--  Balence -->

            <div
                class="bg-purple-600 text-white p-4 rounded shadow w-full sm:w-64 flex flex-col items-center justify-center gap-2">
                <h3 class="text-xl font-bold">

                    <?php
              $userd=_getAllData($db,"SELECT * FROM `deposit` WHERE status=1");
              $balenced=0;
              foreach($userd as $d){
                $balenced= $balenced+$d['coins'];
              }
             echo  $balenced;
             ?>
                </h3>
                <h5 class="text-base">Total Deposit Balence</h5>
            </div>



            <div
                class="bg-amber-600 text-white p-4 rounded shadow w-full sm:w-64 flex flex-col items-center justify-center gap-2">
                <h3 class="text-xl font-bold">

                    <?php
             $p= $balenced-$balence;
             echo $p;
             ?>
                </h3>
                <h5 class="text-base">Total Profit</h5>
            </div>



        </div>
    </div>

    <!--Deposit Withdraw Stats -->
    <div class="shadow bg-white rounded w-fulls overflow-hidden">
        <h3 class="p-4 gap-x-3 flex border-b border-gray-100 items-center font-semibold text-cyan-900">
            <i class="fa-solid fa-briefcase"></i>
            <span>Deposit & Withdraw Profit</span>
        </h3>
        <div class="p-5 flex flex-wrap gap-5">

            <div
                class="bg-cyan-700 text-white p-4 rounded shadow w-full sm:w-64 flex flex-col items-center justify-center gap-2">
                <h3 class="text-xl font-bold">
                    <?php
                  $pr=_getAllData($db,"SELECT * FROM `admin_profit` WHERE activity=1 ORDER BY id ASC");
                  $profitd=0;
                  foreach($pr as $p){
                    $profitd=$profitd+$p['coin'];
                  }
                  echo $profitd;                  
                ?>
                </h3>
                <h5 class="text-base">Deposit Profit</h5>
            </div>
            <div
                class="bg-orange-400 text-white p-4 rounded shadow w-full sm:w-64 flex flex-col items-center justify-center gap-2">
                <h3 class="text-xl font-bold">
                    <?php
                  $pr=_getAllData($db,"SELECT * FROM `admin_profit` WHERE activity=2 ORDER BY id ASC");
                  $profitw=0;
                  foreach($pr as $p){
                    $profitw=$profitw+$p['coin'];
                  }
                  echo $profitw;                  
                ?>
                </h3>
                <h5 class="text-base">Withdraw Profit</h5>
            </div>
            <div
                class="bg-green-600 text-white p-4 rounded shadow w-full sm:w-64 flex flex-col items-center justify-center gap-2">
                <h3 class="text-xl font-bold">
                    <?php
                     echo $profitd+$profitw;    
                    ?>
                </h3>
                <h5 class="text-base">Total Profit</h5>
            </div>

        </div>
    </div>



    <!-- Job Stats -->
    <div class="shadow bg-white rounded w-fulls overflow-hidden">
        <h3 class="p-4 gap-x-3 flex border-b border-gray-100 items-center font-semibold text-cyan-900">
            <i class="fa-solid fa-briefcase"></i>
            <span>Job Stats</span>
        </h3>
        <div class="p-5 flex flex-wrap gap-5">

            <div
                class="bg-cyan-700 text-white p-4 rounded shadow w-full sm:w-64 flex flex-col items-center justify-center gap-2">
                <h3 class="text-xl font-bold">
                    <?php
              $jobs=_getAllData($db,"SELECT * FROM `job_system`");
              if($jobs !=0){ echo  count($jobs);}else{echo 0;}
             ?>
                </h3>
                <h5 class="text-base">Total Jobs</h5>
            </div>
            <div
                class="bg-orange-400 text-white p-4 rounded shadow w-full sm:w-64 flex flex-col items-center justify-center gap-2">
                <h3 class="text-xl font-bold">
                    <?php
              $jobs=_getAllData($db,"SELECT * FROM `job_system` WHERE activity =0");
              if($jobs !=0){ echo  count($jobs);}else{echo 0;}
             ?>
                </h3>
                <h5 class="text-base">Request Jobs</h5>
            </div>
            <div
                class="bg-green-600 text-white p-4 rounded shadow w-full sm:w-64 flex flex-col items-center justify-center gap-2">
                <h3 class="text-xl font-bold">
                    <?php
              $jobs=_getAllData($db,"SELECT * FROM `job_submit` WHERE activity =1");
              if($jobs !=0){ echo  count($jobs);}else{echo 0;}
             ?>
                </h3>
                <h5 class="text-base">Success Jobs</h5>
            </div>

        </div>
    </div>

    <!-- Video Ads Stats -->
    <div class="shadow bg-white rounded w-fulls overflow-hidden">
        <h3 class="p-4 gap-x-3 flex border-b border-gray-100 items-center font-semibold text-cyan-900">
            <i class="fa-solid fa-play"></i>
            <span>Video Ads Stats</span>
        </h3>
        <div class="p-5 flex flex-wrap gap-5">

            <div
                class="bg-[#E038B1] text-white p-4 rounded shadow w-full sm:w-64 flex flex-col items-center justify-center gap-2">
                <h3 class="text-xl font-bold">
                    <?php
                $vad_videos=_getAllData($db,"SELECT * FROM `vad_videos`");
                if($vad_videos !=0){ echo  count($vad_videos);}else{echo 0;}
              ?>
                </h3>
                <h5 class="text-base">Total Videos</h5>
            </div>

            <div
                class="bg-[#F6AB2F] text-white p-4 rounded shadow w-full sm:w-64 flex flex-col items-center justify-center gap-2">
                <h3 class="text-xl font-bold">
                    <?php
                $vad_videos=_getAllData($db,"SELECT * FROM `vad_videos` WHERE status =1");
                if($vad_videos !=0){ echo  count($vad_videos);}else{echo 0;}
              ?>
                </h3>
                <h5 class="text-base">Active Videos</h5>
            </div>

            <div
                class="bg-[#34AA44] text-white p-4 rounded shadow w-full sm:w-64 flex flex-col items-center justify-center gap-2">
                <h3 class="text-xl font-bold">
                    <?php
                $vad_videos_done=_getAllData($db,"SELECT * FROM `vad_videos_done`");
                if($vad_videos_done !=0){ echo  count($vad_videos_done);}else{echo 0;}
              ?>
                </h3>
                <h5 class="text-base">Finished</h5>
            </div>

        </div>
    </div>
    <!-- Game Stats -->
    <div class="shadow bg-white rounded w-fulls overflow-hidden">
        <h3 class="p-4 gap-x-3 flex border-b border-gray-100 items-center font-semibold text-cyan-900">
            <i class="fa-solid fa-play"></i>
            <span>Game Stats</span>
        </h3>
        <div class="p-5 flex flex-wrap gap-5">

            <div
                class="bg-[#E038B1] text-white p-4 rounded shadow w-full sm:w-64 flex flex-col items-center justify-center gap-2">
                <h3 class="text-xl font-bold">
                    <?php
                  $p=_getAllData($db,"SELECT * FROM `admin_activity` WHERE win_lose='1'");
                  if($p !=0){
                    $pr=0;
                    foreach($p as $ps){
                      $pr=$pr+$ps['coin'];
                    }
                    echo $pr;
                    
                    }else{echo 0;}
                ?>
                </h3>
                <h5 class="text-base">Total Win</h5>
            </div>

            <div
                class="bg-[#F6AB2F] text-white p-4 rounded shadow w-full sm:w-64 flex flex-col items-center justify-center gap-2">
                <h3 class="text-xl font-bold">
                    <?php
                  $p=_getAllData($db,"SELECT * FROM `admin_activity` WHERE win_lose='2'");
                  if($p !=0){
                    $pl=0;
                    foreach($p as $ps){
                      $pl=$pl+$ps['coin'];
                    }
                    echo $pl;
                    
                    }else{echo 0;}
                ?>
                </h3>
                <h5 class="text-base">Total Lose</h5>
            </div>

            <div
                class="bg-[#34AA44] text-white p-4 rounded shadow w-full sm:w-64 flex flex-col items-center justify-center gap-2">
                <h3 class="text-xl font-bold">
                    <?php
                    echo $pl-$pr;
                   ?>
                </h3>
                <h5 class="text-base">Total Profit</h5>
            </div>

            <!--  Balence -->

            <div
                class="bg-purple-600 text-white p-4 rounded shadow w-full sm:w-64 flex flex-col items-center justify-center gap-2">
                <h3 class="text-xl font-bold">

                    <?php
                 $profit=0;
                 $lose=0;   
                 $time=time()-604800;
                $pr=_getAllData($db,"SELECT * FROM `admin_activity` WHERE win_lose='2' AND time>$time");
                foreach($pr as $p){
                  $profit= $profit+$p['coin'];
                }
                $ls=_getAllData($db,"SELECT * FROM `admin_activity` WHERE win_lose='1' AND time>$time");
                foreach($ls as $l){
                  $lose= $lose+$l['coin'];
                }
                $balenced= $profit-$lose;               
                echo  $balenced;
              ?>
                </h3>
                <h5 class="text-base">7 Days Profit</h5>
            </div>



            <div
                class="bg-amber-600 text-white p-4 rounded shadow w-full sm:w-64 flex flex-col items-center justify-center gap-2">
                <h3 class="text-xl font-bold">

                    <?php
                 $profit=0;
                 $lose=0;   
                 $time=time()-2592000;
                $pr=_getAllData($db,"SELECT * FROM `admin_activity` WHERE win_lose='2' AND time>$time");
                foreach($pr as $p){
                  $profit= $profit+$p['coin'];
                }
                $ls=_getAllData($db,"SELECT * FROM `admin_activity` WHERE win_lose='1' AND time>$time");
                foreach($ls as $l){
                  $lose= $lose+$l['coin'];
                }
                $balenced= $profit-$lose;               
                echo  $balenced;
              ?>
                </h3>
                <h5 class="text-base">30 Days Profit</h5>
            </div>


        </div>
    </div>

    <!-- Deposite Stats -->
    <div class="shadow bg-white rounded w-fulls overflow-hidden">
        <h3 class="p-4 gap-x-3 flex border-b border-gray-100 items-center font-semibold text-cyan-900">
            <i class="fa-solid fa-money-bill-transfer"></i>
            <span>Deposite Stats</span>
        </h3>
        <div class="p-5 flex flex-wrap gap-5">

            <div
                class="bg-pink-600 text-white p-4 rounded shadow w-full sm:w-64 flex flex-col items-center justify-center gap-2">
                <h3 class="text-xl font-bold">
                    <?php
                $Withdrawals=_getAllData($db,"SELECT * FROM `deposit` WHERE status=0");
                if($Withdrawals !=0){
                  $total=0;
                  foreach($Withdrawals as $w){
                    $total=$total+$w['coins']." Coins ";

                  }
                  echo  $total;
                }else{echo 0;}
              ?>

                </h3>
                <h5 class="text-base">Total Pending</h5>
            </div>

            <div
                class="bg-green-600 text-white p-4 rounded shadow w-full sm:w-64 flex flex-col items-center justify-center gap-2">
                <h3 class="text-xl font-bold">
                    <?php
                $Withdrawals=_getAllData($db,"SELECT * FROM `deposit` WHERE status=1");
                if($Withdrawals !=0){
                  $total=0;
                  foreach($Withdrawals as $w){
                    $total=$total+$w['coins']." Coins ";

                  }
                  echo  $total;
                }else{echo 0;}
              ?>
                </h3>
                <h5 class="text-base">Total Paid</h5>
            </div>

            <div
                class="bg-red-600 text-white p-4 rounded shadow w-full sm:w-64 flex flex-col items-center justify-center gap-2">
                <h3 class="text-xl font-bold"> <?php
                $Withdrawals=_getAllData($db,"SELECT * FROM `deposit` WHERE status=2");
                if($Withdrawals !=0){
                  $total=0;
                  foreach($Withdrawals as $w){
                    $total=$total+$w['coins']." Coins ";

                  }
                  echo  $total;
                }else{echo 0;}
              ?></h3>
                <h5 class="text-base">Total Rejected</h5>
            </div>

        </div>
    </div>


    <!-- Withdrawals Stats -->
    <div class="shadow bg-white rounded w-fulls overflow-hidden">
        <h3 class="p-4 gap-x-3 flex border-b border-gray-100 items-center font-semibold text-cyan-900">
            <i class="fa-solid fa-money-bill-transfer"></i>
            <span>Withdrawals Stats</span>
        </h3>
        <div class="p-5 flex flex-wrap gap-5">

            <div
                class="bg-pink-600 text-white p-4 rounded shadow w-full sm:w-64 flex flex-col items-center justify-center gap-2">
                <h3 class="text-xl font-bold">
                    <?php
                $Withdrawals=_getAllData($db,"SELECT * FROM `withdrawals` WHERE status=0");
                if($Withdrawals !=0){
                  $total=0;
                  foreach($Withdrawals as $w){
                    $total=$total+$w['coins']." Coins ";

                  }
                  echo  $total;
                }else{echo 0;}
              ?>

                </h3>
                <h5 class="text-base">Total Pending</h5>
            </div>

            <div
                class="bg-green-600 text-white p-4 rounded shadow w-full sm:w-64 flex flex-col items-center justify-center gap-2">
                <h3 class="text-xl font-bold">
                    <?php
                $Withdrawals=_getAllData($db,"SELECT * FROM `withdrawals` WHERE status=1");
                if($Withdrawals !=0){
                  $total=0;
                  foreach($Withdrawals as $w){
                    $total=$total+$w['coins']." Coins ";

                  }
                  echo  $total;
                }else{echo 0;}
              ?>
                </h3>
                <h5 class="text-base">Total Paid</h5>
            </div>

            <div
                class="bg-red-600 text-white p-4 rounded shadow w-full sm:w-64 flex flex-col items-center justify-center gap-2">
                <h3 class="text-xl font-bold"> <?php
                $Withdrawals=_getAllData($db,"SELECT * FROM `withdrawals` WHERE status=2");
                if($Withdrawals !=0){
                  $total=0;
                  foreach($Withdrawals as $w){
                    $total=$total+$w['coins']." Coins ";

                  }
                  echo  $total;
                }else{echo 0;}
              ?></h3>
                <h5 class="text-base">Total Rejected</h5>
            </div>

        </div>
    </div>

    <!-- Other Stats -->
    <div class="shadow bg-white rounded w-fulls overflow-hidden">
        <h3 class="p-4 gap-x-3 flex border-b border-gray-100 items-center font-semibold text-cyan-900">
            <i class="fa-solid fa-circle-info"></i>
            <span>Other Stats</span>
        </h3>
        <div class="p-5 flex flex-wrap gap-5">

            <div
                class="bg-blue-600 text-white p-4 rounded shadow w-full sm:w-64 flex flex-col items-center justify-center gap-2">
                <h3 class="text-xl font-bold">
                    <?php
                $Withdrawals=_getAllData($db,"SELECT * FROM `users` WHERE disabled=0 AND admin=0 AND coins>0");
                if($Withdrawals !=0){
                  $total=0;
                  foreach($Withdrawals as $w){
                    $total=$total+$w['coins']." Coins ";

                  }
                  echo  $total;
                }else{echo 0;}
              ?>

                </h3>
                <h5 class="text-base">Total Users Coins</h5>
            </div>


        </div>
    </div>
</div>
</div>
</main>

<script src="js/app.js"></script>

</body>

</html>