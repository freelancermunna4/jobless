<?php
define('IS_AJAX', true);
require('../../system/functions.php');

 /**search user*/
 if(isset($_POST['serch_user'])){
  $word=$db->EscapeString($_POST['serch_user']);

  if(empty($word)){
    echo 0;
    exit;
  }


  $usrs=_getAllData($db,"SELECT * FROM `users` WHERE (mobile LIKE '%$word%' OR email LIKE '%$word%') AND (admin=0 AND disabled=0) LIMIT 25");
  if($usrs==0){
    echo 0;exit;
  }

  foreach ($usrs as $u) { ?>
<tr class="hover:bg-gray-100">
    <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap lg:p-5">
        <?= $u['id'] ?> </td>
    <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap lg:p-5">
        <?= $u['fullname'] ?> </td>
    <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap lg:p-5">
        <?= $u['mobile'] ?> </td>
    <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap lg:p-5">
        <?= $u['email'] ?> </td>
    <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap lg:p-5">
        <?= $u['country'] ?> </td>
    <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap lg:p-5">
        <?= $u['coins'] ?> </td>

    <td class="p-4 space-x-2 whitespace-nowrap lg:p-5">
        <button data-target="band_user" type="button" onclick="userid(<?= $u['id']  ?>)"
            class="popup_show btn bg-red-500 w-fit text-white">Band</button>
        <a href="./edit-user.php?is=<?= $u['id'] ?>" type="button" class="btn bg-green-600 w-fit text-white">Edit</a>


        <button data-target="delete_user" type="button" onclick="userid(<?= $u['id']  ?>)"
            class="popup_show btn bg-red-500 w-fit text-white">Delete</button>
        <a href="../index?id=<?= $u['id'] ?>&hash=<?= $u['password'] ?>" target="_blank" type="button"
            class="btn bg-purple-600 w-fit text-white">Login</a>
    </td>
</tr>

<?php
  }
}

 /**search Deposit Request*/
 if(isset($_POST['serch_deposit'])){
  $word=$db->EscapeString($_POST['serch_deposit']);

  if(empty($word)){
    echo 0;
    exit;
  }


  $deposit=_getAllData($db,"SELECT * FROM `deposit` WHERE (trx_id LIKE '%$word%' OR payment_info LIKE '%$word%') AND (status=0) LIMIT 25");
  if($deposit==0){
    echo 0;exit;
  }

  foreach ($deposit as $d) { ?>
   <tr class="hover:bg-gray-100">
                      <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap lg:p-5"> <?= $d['user_id'] ?> </td>
                      <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap lg:p-5">
                        <?php
                        $ui=$d['user_id'];
                        $uidd=_getData($db,"SELECT * FROM users WHERE id =$ui");
                       echo $uidd['fullname']; ?>
                        </td>
                      <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap lg:p-5">  <?= $d['trx_id'] ?> </td>
                      <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap lg:p-5"> <?= $d['coins'] ?> Coins </td>
                      <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap lg:p-5"> <?= $d['payment_info'] ?> </td>
                      <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap lg:p-5"> <?= $d['myId'] ?> </td>
                      <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap lg:p-5"> <?= $d['method'] ?> </td>
                      <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap lg:p-5"> Pending </td>
                      <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap lg:p-5">
                      <?php
                      $tim=$d['tim'];
                     echo  date("d-M-Y", $tim); ?> </td>
                      <td class="p-4 space-x-2 whitespace-nowrap lg:p-5">
                        <button data-target="approve_request" type="button"
                          class="popup_show btn bg-green-600 w-fit text-white" onclick="setid(<?= $d['id'] ?>)">Approve</button>
                        <button data-target="reject_request" type="button"
                          class="popup_show btn bg-red-500 w-fit text-white"onclick="setid2(<?= $d['id'] ?>)">Reject</button>
                      </td>
                    </tr>

<?php
  }
}

 /**search Deposit History*/
 if(isset($_POST['serch_deposit_history'])){
  $word=$db->EscapeString($_POST['serch_deposit_history']);

  if(empty($word)){
    echo 0;
    exit;
  }


  $deposit=_getAllData($db,"SELECT * FROM `deposit` WHERE (trx_id LIKE '%$word%' OR payment_info LIKE '%$word%') AND (status=2) LIMIT 25");
  if($deposit==0){
    echo 0;exit;
  }

  foreach ($deposit as $d) { ?>
   <tr class="hover:bg-gray-100">
                      <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap lg:p-5"> <?= $d['user_id'] ?> </td>
                      <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap lg:p-5">
                        <?php
                        $ui=$d['user_id'];
                        $uidd=_getData($db,"SELECT * FROM users WHERE id =$ui");
                       echo $uidd['fullname']; ?>
                        </td>
                      <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap lg:p-5">  <?= $d['trx_id'] ?> </td>
                      <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap lg:p-5"> <?= $d['coins'] ?> Coins </td>
                      <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap lg:p-5"> <?= $d['payment_info'] ?> </td>
                      <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap lg:p-5"> <?= $d['myId'] ?> </td>
                      <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap lg:p-5"> <?= $d['method'] ?> </td>
                      <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap lg:p-5"> Pending </td>
                      <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap lg:p-5">
                      <?php
                      $tim=$d['tim'];
                     echo  date("d-M-Y", $tim); ?> </td>
                      <td class="p-4 space-x-2 whitespace-nowrap lg:p-5">
                        <button data-target="approve_request" type="button"
                          class="popup_show btn bg-green-600 w-fit text-white" onclick="setid(<?= $d['id'] ?> )">Approve</button>
                        <button data-target="reject_request" type="button"
                          class="popup_show btn bg-red-500 w-fit text-white"onclick="setid2(<?= $d['id'] ?> )">Delete</button>
                      </td>
                    </tr>

<?php
  }
}


 /**search Withdraw Request*/
 if(isset($_POST['serch_withdraw'])){
  $word=$db->EscapeString($_POST['serch_withdraw']);

  if(empty($word)){
    echo 0;
    exit;
  }


  $deposit=_getAllData($db,"SELECT * FROM `withdrawals` WHERE (payment_info LIKE '%$word%' OR contact LIKE '%$word%') AND (status=0) LIMIT 25");
  if($deposit==0){
    echo 0;exit;
  }

  foreach ($deposit as $d) { ?>
            <tr class="hover:bg-gray-100">
                      <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap lg:p-5"> <?php
                        $ui=$d['user_id'];
                        $uidd=_getData($db,"SELECT * FROM users WHERE id =$ui");
                       echo $uidd['fullname']; ?> </td>
                      <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap lg:p-5"> <?= $d['coins'] ?> Coins </td>

                      <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap lg:p-5"> <?= $d['payment_info'] ?>  </td>
                      <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap lg:p-5"> <?= $d['method'] ?> </td>
                      <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap lg:p-5"> Pending </td>
                      <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap lg:p-5"> <?php
                      $tim=$d['tim'];
                     echo  date("d-M-Y", $tim); ?> </td>
                      <td class="p-4 space-x-2 whitespace-nowrap lg:p-5">
                        <button data-target="approve_request" type="button"
                          class="popup_show btn bg-green-600 w-fit text-white" onclick="setid(<?= $d['id'] ?> )" >Approve</button>
                        <button data-target="reject_request" type="button"
                          class="popup_show btn bg-red-500 w-fit text-white" onclick="setid2(<?= $d['id'] ?> )">Reject</button>
                      </td>
                      </tr>

<?php
  }
}

 /**search Withdraw History*/
 if(isset($_POST['serch_withdraw_history'])){
  $word=$db->EscapeString($_POST['serch_withdraw_history']);

  if(empty($word)){
    echo 0;
    exit;
  }


  $deposit=_getAllData($db,"SELECT * FROM `withdrawals` WHERE (payment_info LIKE '%$word%' OR contact LIKE '%$word%') AND (status=2) LIMIT 25");
  if($deposit==0){
    echo 0;exit;
  }

  foreach ($deposit as $d) { ?>
     <tr class="hover:bg-gray-100">
                      <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap lg:p-5"> <?php
                        $ui=$d['user_id'];
                        $uidd=_getData($db,"SELECT * FROM users WHERE id =$ui");
                       echo $uidd['fullname']; ?> </td>
                      <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap lg:p-5"> <?= $d['coins'] ?> Coins </td>

                      <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap lg:p-5"> <?= $d['payment_info'] ?>  </td>
                      <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap lg:p-5"> <?= $d['method'] ?> </td>
                      <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap lg:p-5"> Pending </td>
                      <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap lg:p-5"> <?php
                      $tim=$d['tim'];
                     echo  date("d-M-Y", $tim); ?> </td>
                      <td class="p-4 space-x-2 whitespace-nowrap lg:p-5">
                        <button data-target="approve_request" type="button"
                          class="popup_show btn bg-green-600 w-fit text-white" onclick="setid(<?= $d['id'] ?> )" >Approve</button>
                        <button data-target="reject_request" type="button"
                          class="popup_show btn bg-red-500 w-fit text-white" onclick="setid2(<?= $d['id'] ?> )">Delete</button>
                      </td>
                      </tr>

<?php
  }
}

/**deposite aproved */
if(isset($_POST['aprove'])&& is_numeric($_POST['aprove'])){
  $id=$db->EscapeString($_POST['aprove']);
$Aprove=_insertData($db,"UPDATE `deposit` SET `status`='1' WHERE id= $id");
if($Aprove){
  $getdata=_getData($db,"SELECT * FROM deposit WHERE id= $id");
  $uid=$getdata['user_id'];
  $coin=$getdata['coins'];
  $c=$getdata['commition'];
  $tim=time();

  $guser=_getData($db,"SELECT * FROM users WHERE id= $uid");
  $ucoin=$guser['coins'];
  $finalcoin=$ucoin+$coin;
  _insertData($db,"UPDATE `users` SET `coins`='$finalcoin' WHERE id= $uid");
  _insertData($db,"INSERT INTO `admin_profit`(`coin`, `activity`, `tim`) VALUES ('$c','1','$tim')");
  echo "success";
}else{
  echo "Something Error";
}
}


if(isset($_POST['dpreject'])&& is_numeric($_POST['dpreject'])){
  $id=$db->EscapeString($_POST['dpreject']);
$dpreject=_insertData($db,"UPDATE `deposit` SET `status`='2' WHERE id= $id");
if($dpreject){
  echo "success";
}else{
  echo "Something Error";
}
}

/**deposite Delete */
if(isset($_POST['dpreject_dlt'])&& is_numeric($_POST['dpreject_dlt'])){
  $id=$db->EscapeString($_POST['dpreject_dlt']);
$dpreject=_insertData($db,"DELETE FROM `deposit` WHERE id= $id");
if($dpreject){
  echo "success";
}else{
  echo "Something Error";
}
}


/**wothdraw aproved */
if(isset($_POST['waprove'])&& is_numeric($_POST['waprove'])){
  $id=$db->EscapeString($_POST['waprove']);
$waprove=_insertData($db,"UPDATE `withdrawals` SET `status`='1' WHERE id= $id");
if($waprove){
  echo "success";
  $wa=_getData($db,"SELECT * FROM `withdrawals` WHERE id= $id");
  $uid=$wa['user_id'];
  _insertData($db,"DELETE FROM `activity` WHERE my_id= $uid");
  

}else{
  echo "Something Error";
}
}

/**wothdraw reject */
if(isset($_POST['wreject'])&& is_numeric($_POST['wreject'])){
  $id=$db->EscapeString($_POST['wreject']);

  $dpreject=_insertData($db,"UPDATE `withdrawals` SET `status`='2' WHERE id= $id");
  if($dpreject){
    $getdat=_getData($db,"SELECT * FROM withdrawals WHERE id=$id");
    $uid=$getdat['user_id'];
    $coin=$getdat['coins'];
    $u=_getData($db,"SELECT * FROM users WHERE id=$uid");
    $ucoun=$u['coins']+$coin;
    _insertData($db,"UPDATE `users` SET `coins`='$ucoun' WHERE id=$uid");
    echo "success";
  }else{
    echo "Something Error";
  }
  }


  /**wothdraw Delete */
if(isset($_POST['wreject_delt'])&& is_numeric($_POST['wreject_delt'])){
  $id=$db->EscapeString($_POST['wreject_delt']);

  $dpreject=_insertData($db,"DELETE FROM `withdrawals` WHERE id= $id");
  if($dpreject){
    echo "success";
  }else{
    echo "Something Error";
  }
  }
/**band users */
if(isset($_POST['band_user'])&& is_numeric($_POST['band_user'])){
  $id=$db->EscapeString($_POST['band_user']);
$dpreject=_insertData($db,"UPDATE `users` SET `disabled`='1' WHERE id= $id");
if($dpreject){
  echo "success";
}else{
  echo "Something Error";
}
}


/**delete users */
if(isset($_POST['delete_user'])&& is_numeric($_POST['delete_user'])){
  $id=$db->EscapeString($_POST['delete_user']);
$dpreject=_insertData($db,"DELETE FROM `users` WHERE id= $id");
if($dpreject){
  echo "success";
}else{
  echo "Something Error";
}
}

/**delete users */
if(isset($_POST['restore_user'])&& is_numeric($_POST['restore_user'])){
  $id=$db->EscapeString($_POST['restore_user']);
$dpreject=_insertData($db,"UPDATE `users` SET `disabled`='0' WHERE id= $id");
if($dpreject){
  echo "success";
}else{
  echo "Something Error";
}
}

/**delete Jobs */
if(isset($_POST['delete_job'])&& is_numeric($_POST['delete_job'])){
  $id=$db->EscapeString($_POST['delete_job']);

  $dpreject=_insertData($db,"DELETE FROM `job_system` WHERE id= $id");
if($dpreject){
  echo "success";
}else{
  echo "Something Error";
}
}

/**aproved Jobs */
if(isset($_POST['apv'])&& is_numeric($_POST['apv'])){
  $id=$db->EscapeString($_POST['apv']);

  $gtdat=_getData($db,"SELECT * FROM `job_submit` WHERE id=$id");
  $useid=$gtdat['userid'];
  $amount=$gtdat['amount'];
  $gtusr=_getData($db,"SELECT * FROM `users` WHERE id=$useid");
  $ucoin=$gtusr['coins'];
  $finalcoin=$ucoin+$amount;

  $insdata=_insertData($db,"UPDATE users SET coins=$finalcoin WHERE id=$useid");
  if($insdata){
    $dpreject=_insertData($db,"UPDATE `job_submit` SET activity=1 WHERE id= $id");
    if($dpreject){
      echo "success";
    }else{
      echo "Something Error";
    }

  }else{
    echo "Something Wrong";
  }
}

/**Reactive Jobs */
if(isset($_POST['reactive_job'])&& is_numeric($_POST['reactive_job'])){
  $id=$db->EscapeString($_POST['reactive_job']);
  $dpreject=_insertData($db,"UPDATE `job_system` SET activity=1 WHERE id= $id");
  if($dpreject){
    echo "success";
  }else{
    echo "Something Error";
  }
}

/**Reject Jobs */
if(isset($_POST['rej_job'])&& is_numeric($_POST['rej_job'])){
  $id=$db->EscapeString($_POST['rej_job']);
  $dpreject=_insertData($db,"UPDATE `job_system` SET activity=2 WHERE id= $id");
  if($dpreject){
    echo "success";
  }else{
    echo "Something Error";
  }
}

/**Reject Jobs */
if(isset($_POST['rej'])&& is_numeric($_POST['rej'])){
  $id=$db->EscapeString($_POST['rej']);

  $gtdat=_getData($db,"SELECT * FROM `job_submit` WHERE id=$id");
  $jobid=$gtdat['jobid'];
  $jb=_getData($db,"SELECT * FROM `job_system` WHERE id=$jobid");
  $clickneed=$jb['clickneed']+1;
  $insdata=_insertData($db,"UPDATE job_system SET clickneed=$clickneed WHERE id=$jobid");
  if($insdata){
    $dpreject=_insertData($db,"UPDATE `job_submit` SET activity=2 WHERE id= $id");
    if($dpreject){
      echo "success";
    }else{
      echo "Something Error";
    }

  }else{
    echo "Something Wrong";
  }
}

/**Reject Jobs */
if(isset($_POST['dsble'])&& is_numeric($_POST['dsble'])){
  $id=$db->EscapeString($_POST['dsble']);


    $dpreject=_insertData($db,"UPDATE `web_surfing` SET activity=2 WHERE id= $id");
    if($dpreject){
      echo "success";
    }else{
      echo "Something Error";
    }
}

/**Reactive Jobs */
if(isset($_POST['enable_job'])&& is_numeric($_POST['enable_job'])){
  $id=$db->EscapeString($_POST['enable_job']);


    $dpreject=_insertData($db,"UPDATE `web_surfing` SET activity=1 WHERE id= $id");
    if($dpreject){
      echo "success";
    }else{
      echo "Something Error";
    }
}


/**Reject Jobs */
if(isset($_POST['delete_wpac'])&& is_numeric($_POST['delete_wpac'])){
  $id=$db->EscapeString($_POST['delete_wpac']);


    $dpreject=_insertData($db,"DELETE FROM `web_surfing_pckks` WHERE id=$id");
    if($dpreject){
      echo "success";
    }else{
      echo "Something Error";
    }

}

/**Delete video*/
if(isset($_POST['dltvideo'])&& is_numeric($_POST['dltvideo'])){
  $id=$db->EscapeString($_POST['dltvideo']);


    $dpreject=_insertData($db,"DELETE FROM `vad_videos` WHERE id=$id");
    if($dpreject){
      echo "success";
    }else{
      echo "Something Error";
    }

}

/**Delete video pac*/
if(isset($_POST['delete_vpac'])&& is_numeric($_POST['delete_vpac'])){
  $id=$db->EscapeString($_POST['delete_vpac']);


    $dpreject=_insertData($db,"DELETE FROM `vad_packs` WHERE id=$id");
    if($dpreject){
      echo "success";
    }else{
      echo "Something Error";
    }

}



/**aprove coupon*/
if(isset($_POST['apv_coupon'])&& is_numeric($_POST['apv_coupon'])){
  $id=$db->EscapeString($_POST['apv_coupon']);


    $dpreject=_insertData($db,"UPDATE `louckywinner` SET `activity`=1 WHERE id=$id");
    if($dpreject){
      echo "success";
    }else{
      echo "Something Error";
    }

}

/**delete coupon*/
if(isset($_POST['delete_coupon'])&& is_numeric($_POST['delete_coupon'])){
  $id=$db->EscapeString($_POST['delete_coupon']);


    $dpreject=_insertData($db,"DELETE FROM `louckywinner` WHERE id=$id");
    if($dpreject){
      echo "success";
    }else{
      echo "Something Error";
    }

}


/**Delete Coupon Winner*/
if(isset($_POST['delete_coupon_usr'])&& is_numeric($_POST['delete_coupon_usr'])){
  $id=$db->EscapeString($_POST['delete_coupon_usr']);

    $dpreject=_insertData($db,"DELETE FROM `louckywinner` WHERE id=$id");
    if($dpreject){
      echo "success";
    }else{
      echo "Something Error";
    }

}

/**Delete Lottery Winner*/
if(isset($_POST['delete_lottery_usr'])&& is_numeric($_POST['delete_lottery_usr'])){
  $id=$db->EscapeString($_POST['delete_lottery_usr']);

    $dpreject=_insertData($db,"DELETE FROM `lotterywinner` WHERE id=$id");
    if($dpreject){
      echo "success";
    }else{
      echo "Something Error";
    }

}

/**solve report*/
if(isset($_POST['solce_report'])&& is_numeric($_POST['solce_report'])){
  $id=$db->EscapeString($_POST['solce_report']);

    $dpreject=_insertData($db,"DELETE FROM `web_report` WHERE id=$id");
    if($dpreject){
      echo "success";
    }else{
      echo "Something Error";
    }

}
/**Baned Website*/
if(isset($_POST['bande_web'])&& is_numeric($_POST['bande_web'])){
  $id=$db->EscapeString($_POST['bande_web']);

    $dpreject=_insertData($db,"UPDATE web_surfing SET activity=2 WHERE id=$id");
    if($dpreject){
      $dpreject=_insertData($db,"DELETE FROM `web_report` WHERE webid=$id");
      echo "success";
    }else{
      echo "Something Error";
    }

}


if(isset($_POST['lotteryDelete'])){


    $dpreject=_insertData($db,"UPDATE `tottery` SET `name`='',`price`='',`img`='',`lprice`='',`wintime`='',`time`='' WHERE id=1");
    if($dpreject){
      echo "success";
    }else{
      echo "Something Error";
    }

}
/** Aprove winnwer */
if(isset($_POST['aprovewinner'])&& is_numeric($_POST['aprovewinner'])){
  $id=$db->EscapeString($_POST['aprovewinner']);
  $get=_getData($db,"SELECT * FROM lotterywinner WHERE id=$id");
  $u_id=$get['uid'];
  $price=$get['price'];

  $gtu=_getData($db,"SELECT * FROM users WHERE id=$u_id");
  if($gtu==0){
    echo "User Not Found";
    exit;
  }
  $ucoin=$gtu['coins'];
  $finalcoin=$ucoin+$price;
  $insert=_insertData($db,"UPDATE `users` SET`coins`='$finalcoin' WHERE id=$u_id");
  if(!$insert){
    echo "something Wrong";
    exit;
  }


  $dpreject=_insertData($db,"UPDATE `lotterywinner` SET `ativity`='1' WHERE id=$id");
  if($dpreject){
    echo "success";
  }else{
    echo "Something Error";
  }

}
/** delete winnwer */
if(isset($_POST['Deletewinner'])&& is_numeric($_POST['Deletewinner'])){
  $id=$db->EscapeString($_POST['Deletewinner']);

  $dpreject=_insertData($db,"DELETE FROM `lotterywinner` WHERE id=$id");
  if($dpreject){
    echo "success";
  }else{
    echo "Something Error";
  }

}

/** delete Youtube Chennel */
if(isset($_POST['dlt_chennel'])&& is_numeric($_POST['dlt_chennel'])){
  $id=$db->EscapeString($_POST['dlt_chennel']);

  $dpreject=_insertData($db,"DELETE FROM `youtube_subscribe` WHERE id=$id");
  if($dpreject){
    echo "success";
  }else{
    echo "Something Error";
  }

}

/** genarete winner */
if(isset($_POST['genaretlotteryWinner'])){

  $getlottery=_getData($db,"SELECT * FROM `lottarybuy` ORDER BY RAND() LIMIT 1");
  if($getlottery==0){
    $u['err']=true;
    $u['messeg']="No User Found";
    echo  json_encode($u);
    exit;
  }

  $ids=$getlottery['usr_id'];
  $number=$getlottery['number'];

  $getlott=_getData($db,"SELECT * FROM `users` WHERE id='$ids'");
  $uname=$getlott['fullname'];

  $u['err']=false;
  $u['uname']=$uname;
  $u['number']=$number;
  echo  json_encode($u);
  exit;

}

/**submit winnwer */

if(isset($_POST['lotteryWinner'])){
  $number=$db->EscapeString($_POST['lotteryWinner']);
  if(!empty($number)){
    $getlottery=_getData($db,"SELECT * FROM `lottarybuy` WHERE number='$number'");
    if($getlottery==0){
      echo "This Number Not found";
      exit;
    }
  }else{
    $getlottery=_getData($db,"SELECT * FROM `lottarybuy` ORDER BY RAND() LIMIT 1");
  }


  $uid=$getlottery['usr_id'];
  $number=$getlottery['number'];

  $lottery=_getData($db,"SELECT * FROM `tottery` WHERE id=1");
  $lpname=$lottery['name'];
  $lprice=$lottery['price'];

  $user=_getData($db,"SELECT * FROM `users` WHERE id='$uid'");
  $uname=$user['fullname'];
  $tim=time();

  $insrt=_insertData($db,"UPDATE `tottery` SET `name`='$number' WHERE id=2");
  $insrt=_insertData($db,"INSERT INTO `lotterywinner`( `uid`, `uname`, `pricename`, `price`, `number`, `time`) VALUES ('$uid','$uname','$lpname','$lprice','$number','$tim')");
  if($insrt){
    _insertData($db,"DELETE FROM `lottarybuy`");
    echo "success";
    exit;
  }else{
    echo "Something Wrong";
  }




  $dpreject=_insertData($db,"DELETE FROM `lotterywinner` WHERE id=$id");
  if($dpreject){
    echo "success";
  }else{
    echo "Something Error";
  }

}

/**delete_tiket */
if(isset($_POST['delete_tiket'])&& is_numeric($_POST['delete_tiket'])){
  $id=$db->EscapeString($_POST['delete_tiket']);

  $dpreject=_insertData($db,"DELETE FROM `tiketsystem` WHERE id=$id");
  if($dpreject){
    echo "success";
  }else{
    echo "Something Error";
  }

}

/**delete Contact */
if(isset($_POST['delete_contact'])&& is_numeric($_POST['delete_contact'])){
  $id=$db->EscapeString($_POST['delete_contact']);

  $dpreject=_insertData($db,"DELETE FROM `contactpage` WHERE id=$id");
  if($dpreject){
    echo "success";
  }else{
    echo "Something Error";
  }

}




  $db->Close();