<?php
define('IS_AJAX', true);
require('functions.php');

/**sine up function */
if(isset($_POST['number'])&&isset($_POST['password'])&&isset($_POST['confarm_pass'])&&isset($_POST['uname'])&&isset($_POST['email'])){

  $number=$db->EscapeString($_POST['number']);
  $password=$db->EscapeString($_POST['password']);
  $confarm_pass=$db->EscapeString($_POST['confarm_pass']);
  $refarel=$db->EscapeString($_POST['refarel']);
  $uname=$db->EscapeString($_POST['uname']);
  $email=$db->EscapeString($_POST['email']);
  if(empty($refarel)){$refarel=0;}

  if(empty($number)){
    $msg['err']=true;
    $msg['messeg']="Please Enter Your Mobile Number";
    echo  json_encode($msg);
    exit;
  }else if(!is_numeric($number)){
    $msg['err']=true;
    $msg['messeg']="Please Enter Valid Mobile Number";
    echo  json_encode($msg);
    exit;
  }
  else if(empty($uname)){
    $msg['err']=true;
    $msg['messeg']="Please Enter Yyour Name";
    echo  json_encode($msg);
    exit;
  }
  else if(empty($email)){
    $msg['err']=true;
    $msg['messeg']="Please Enter Email";
    echo  json_encode($msg);
    exit;
  }
  else if(empty($password)){
    $msg['err']=true;
    $msg['messeg']="Please Enter Password";
    echo  json_encode($msg);
    exit;
  }else if(strlen($password)<4){
    $msg['err']=true;
    $msg['messeg']="Please Enter Minimum 4 Password";
    echo  json_encode($msg);
    exit;
  }else if(strlen($password)>20){
    $msg['err']=true;
    $msg['messeg']="Please Enter Maximum 20 Password";
    echo  json_encode($msg);
    exit;
  }else if(empty($confarm_pass)){
    $msg['err']=true;
    $msg['messeg']="Please Enter Confirm Password";
    echo  json_encode($msg);
    exit;
  } else if($confarm_pass != $password){
    $msg['err']=true;
    $msg['messeg']="Confirm Password Not matching";
    echo  json_encode($msg);
    exit;
  }else{

    $user=_getData($db,"SELECT* FROM users WHERE mobile='$number'");
    $usere=_getData($db,"SELECT* FROM users WHERE email='$email'");
    if($user!=0){
      $msg['err']=true;
      $msg['messeg']="Already Register From This Number";
      echo  json_encode($msg);
      exit;
    }else if($usere!=0){
        $msg['err']=true;
        $msg['messeg']="Already Register From This Email";
        echo  json_encode($msg);
        exit;

    }else{

    /************* */

    $password=md5($password);
     $tim= time();

     $inserted=_insertData($db,"INSERT INTO `users`( `mobile`,`fullname`,`email`,`password`,`reg_time`,`ref`) VALUES ('$number','$uname','$email','$password','$tim','$refarel')");
      if($inserted){
        $user=_getData($db,"SELECT* FROM users WHERE mobile='$number'");
        $_SESSION['User_Id']=$user['id'];
        $msg['err']=false;
        $msg['messeg']="Success";
      }else{
        $msg['err']=true;
        $msg['messeg']="ERROR: Something Wrong";
      }
      echo  json_encode($msg);
        exit;
    }

  }

}

/** login function */

if(isset($_POST['number'])&&isset($_POST['password'])&&isset($_POST['login'])){
  $ref=123;
  $number=$db->EscapeString($_POST['number']);
  $password=$db->EscapeString($_POST['password']);

  if(empty($number)){
    $msg['err']=true;
    $msg['messeg']="Please Enter Your Mobile Number";
    echo  json_encode($msg);
    exit;
  }else if(!is_numeric($number)){
    $msg['err']=true;
    $msg['messeg']="Please Enter Valid Mobile Number";
    echo  json_encode($msg);
    exit;
  }else if(empty($password)){
    $msg['err']=true;
    $msg['messeg']="Please Enter Password";
    echo  json_encode($msg);
    exit;
  }else if(strlen($password)<4){
    $msg['err']=true;
    $msg['messeg']="Please Enter Minimum 4 Password";
    echo  json_encode($msg);
    exit;
  }else if(strlen($password)>20){
    $msg['err']=true;
    $msg['messeg']="Please Enter Maximum 20 Password";
    echo  json_encode($msg);
    exit;
  }else{
    $password=md5($password);
    $user=_getData($db,"SELECT* FROM users WHERE mobile='$number' AND password='$password'");
    if($user==0){
      $msg['err']=true;
      $msg['messeg']="Number or Password Not Matching";
      echo  json_encode($msg);
      exit;
    }else if($user['disabled']==1){
      $msg['err']=true;
      $msg['messeg']="Your Accaunt is Banded";
      echo  json_encode($msg);
      exit;

    }else{

        $_SESSION['User_Id']=$user['id'];
        $msg['err']=false;
        $msg['messeg']="Successfully Login";

        echo json_encode($msg);
        exit;
     }

  }

}


/**log logout function */
if(isset($_POST['logout'])&&$is_online==true){
      if(isset($_COOKIE['AutoLogin'])){
        unset($_COOKIE['AutoLogin']);
        setcookie('AutoLogin', '', time(), '/');
      }
      session_destroy();
      $is_online = false;
      echo 0;
}


/**job submit function */
if(isset($_POST['id'])&&is_numeric($_POST['id'])&&isset($_POST['valus'])&&isset($_POST['job'])=="submit"){
  $id=$db->EscapeString($_POST['id']);
  $valus=$db->EscapeString($_POST['valus']);
  $uid=$data['id'];
  $uName=$data['fullname'];
  if(!$ses_id){echo "Please Login to the Complete  job";exit;}
  if(empty($id) || empty($valus)){echo "Please Enter Your Url";}
  else if(!filter_var($valus, FILTER_VALIDATE_URL)){echo "Please Enter Valid Url";}
  else{
    if(empty($uid)){echo "Something Error";exit;}
    $j_submit=_getData($db,"SELECT* FROM job_submit WHERE submiturl='$valus'");
    if($j_submit !=0){echo "This Link Already Submited";exit;}
    $job=_getData($db,"SELECT * FROM `job_system` WHERE id=$id");
    if($job !=0){
      $j_uid=$job['uid'];
      $j_title=$job['job_title'];
      $p_id=$job['uid'];
      $j_amount=$job['amount'];
      $j_dsc=$job['work_discription'];
      $j_url=$job['web_link'];
      $tim=time();

      $totalClick=$job['totalClick']+1;
      $clickneed=$job['clickneed']-1;
      $today = date("Y-m-d H:i:s");

      $j_submit=_insertData($db,"INSERT INTO `job_submit`( `userid`, `pubid`, `amount`,`jobid`, `title`, `discription`, `oldUrl`, `submiturl`, `time`)
      VALUES ('$uid','$p_id','$j_amount','$id','$j_title','$j_dsc','$j_url','$valus','$today')");
      $clints=_getData($db,"SELECT * FROM users WHERE id='$j_uid'");
      $clint=$clints['fullname'];
      if($j_submit){
        $j_update=_insertData($db,"UPDATE `job_system` SET `totalClick`='$totalClick',`clickneed`='$clickneed' WHERE id=$id");
        $j_update=_insertData($db,"INSERT INTO `activity`(`my_id`, `my_name`, `clint_id`, `clint_name`, `middle_name`, `last_name`, `image`,`tim`)
        VALUES ('$uid','$uName','$j_uid','$clint','Complete ','Jobs','assets/icons/work.svg','$tim')");
        echo "Success";
      }else{
        echo "Something Error";
      }

    }else{
      echo "Something Error";
    }
  }

}


/** get web price */

  if(isset($_POST['ad_pack']) && is_numeric($_POST['ad_pack']) && isset($_POST['visits']) && is_numeric($_POST['visits']))
  {
     $pID = $db->EscapeString($_POST['ad_pack']);
     $visits = $db->EscapeString($_POST['visits']);
     $ad_pack =_getData($db,"SELECT * FROM `web_surfing_pckks` WHERE `id`='".$pID."' LIMIT 1");
     $cutCoin=($visits * $ad_pack['coins']);
     echo $cutCoin;
  }


  /** submit website */

  if(isset($_POST['url'])  && isset($_POST['title']) && isset($_POST['timer'])&& is_numeric($_POST['timer'])&& isset($_POST['views'])&& is_numeric($_POST['views'])&& isset($_POST['daily_visit_limit']))
  {
     $url = $db->EscapeString($_POST['url']);
     $title = $db->EscapeString($_POST['title']);
     $timer = $db->EscapeString($_POST['timer']);
     $views = $db->EscapeString($_POST['views']);
     $_limit = $db->EscapeString($_POST['daily_visit_limit']);
     if(empty($url) || !filter_var($url, FILTER_VALIDATE_URL)){
      echo "Please Enter a Valid Url";
     }elseif (empty($title)) {
      echo "Please Enter Website Title";
     }elseif (empty($timer)) {
      echo "Please Select Duration";
     }elseif (empty($views)) {
      echo "Please Enter Views";
     }else{
      $ad_pack =_getData($db,"SELECT * FROM `web_surfing_pckks` WHERE `id`='".$timer."' LIMIT 1");
      $per_coin=$ad_pack['coins'];
      $w_coin=$ad_pack['time'];
      $cutCoin=($views *$per_coin);
      $tim=time();
      $u_id=$data['id'];
      $u_name=$data['fullname'];
      $u_coin=$data['coins'];
      if($cutCoin>$u_coin){
        echo "Not Enugh Coins";
      }else{
        $inserted=_insertData($db,"INSERT INTO `web_surfing`(`user_id`, `title`, `web_link`, `click_need`, `point`, `watch_time`, `dailyClick`, `activity`, `time`) VALUES ('$u_id','$title','$url','$views','$per_coin','$w_coin','$_limit','1','$tim')");
        if($inserted){
          $c_coin=$u_coin-$cutCoin;
          $upd=$inserted=_insertData($db,"UPDATE `users` SET `coins`='$c_coin' WHERE id='$u_id'");
          $j_update=_insertData($db,"INSERT INTO `activity`(`my_id`, `my_name`, `clint_id`, `clint_name`, `middle_name`, `last_name`, `image`,`tim`)
        VALUES ('$u_id','$u_name','$u_id','Your','Successfully Publish','Website','assets/icons/work.svg','$tim')");
        echo "Successfully Publish Your Website";

        }

      }
     }

  }


  //////////set web surf//////////
if(isset($_POST['web'])&&isset($_POST['rand'])){
	$web = $db->EscapeString($_POST['web']);
	 $rand = $db->EscapeString($_POST['rand']);
	 $uid =$data['id'];
	$qu=_insertData($db,"INSERT INTO `dummy_websurf`(`user_id`, `web_id`, `hash`) VALUES ('$uid','$web','$rand')");
	if($qu){
		echo 1;
		}
	else{
		echo 2;
		}
}
//////////ricive web surf//////////
if(isset($_POST['id'])&&isset($_POST['hash'])){
	$id = $db->EscapeString($_POST['id']);
	$hash = $db->EscapeString($_POST['hash']);
	$uid =$data['id'];
	$qu=_insertData($db,"UPDATE `dummy_websurf` SET `hash2`='$hash' WHERE id=$id AND hash=$hash");
	if($qu){
		echo 1;
		}
	else{
		echo 2;
		}
}




/**final web surf */

if(isset($_POST['wid'])&&isset($_POST['rand'])){
	$wid = $db->EscapeString($_POST['wid']);
	$rand = $db->EscapeString($_POST['rand']);
	$tim=time();

	$dummy =_getData($db,"SELECT * FROM `dummy_websurf` WHERE web_id=$wid AND hash=$rand");


	if($dummy!=0){
		if($dummy['hash2']==$dummy['hash']){
			$did=$dummy['id'];
			$webid=$dummy['web_id'];
			$getweb =_getData($db,"SELECT * FROM `web_surfing` WHERE id=$webid");
			$uid=$data['id'];
			$user =_getData($db,"SELECT * FROM `users` WHERE id=$uid");
			 $ucoin=$user['coins'];
			 $coin= $getweb['point'];
			 $finalcoin=$ucoin+$coin;
			 $qu=_insertData($db,"UPDATE `users` SET coins=$finalcoin WHERE id=$uid");
			 $tclicks=$getweb['clicks']+1;
			 $clicks=$getweb['click_need']-1;
			 $todayclick=$getweb['today_clicks']+1;
       $d =_getData($db,"SELECT * FROM `web_surfing` WHERE id=$webid");
       $wtime=$d['time'];
       $timdd=time()-86400;
       $t=time();
       if($wtime<$timdd){
        $qu=_insertData($db,"UPDATE `web_surfing` SET today_clicks=0,time=$t WHERE id=$webid");
        $todayclick=1;
       }
      
			 $qu=_insertData($db,"UPDATE `web_surfing` SET clicks=$tclicks,click_need=$clicks,today_clicks=$todayclick WHERE id=$webid");

       $cid=$getweb['user_id'];
       $clints =_getData($db,"SELECT * FROM `users` WHERE id=$cid");
       $clinm=$clints['fullname'];

      $qu=_insertData($db,"INSERT INTO `web_surfing_done`(`user_id`, `web_id`, `s_type`, `s_time`)
			 VALUES ($uid,$webid,'1',$tim)");
       $qu=_insertData($db,"DELETE FROM `dummy_websurf` WHERE user_id=$uid");

        $j_update=_insertData($db,"INSERT INTO `activity`(`my_id`, `my_name`, `clint_id`, `clint_name`, `middle_name`, `last_name`, `image`,`tim`)
        VALUES ('$uid','$uName','$cid','$clinm','Completed','Website Wiews','assets/icons/work.svg','$tim')");



			echo "success";

		}else{
			echo "Not Success";
		}

			$did=$dummy['id'];
			$qu=$db->Query("DELETE FROM `dummy_websurf` WHERE id=$did");

	}
	else {

		echo "Something Error !";
		}
}

/**skip users */
if(isset($_POST['skip'])&&isset($_POST['idweb'])){
	$id = $db->EscapeString($_POST['idweb']);
	$uid =$data['id'];
	$tim=time();
	$qu=_insertData($db,"INSERT INTO `web_surfing_done`(`user_id`, `web_id`, `s_type`,`s_time`,`skip`)
	VALUES ($uid,$id,0,$tim,$uid)");
	if($qu){
		echo 1;
		}
	else{
		echo 2;
		}
}

if(isset($_GET['u'])&&isset($_GET['c'])){
	$u = $db->EscapeString($_GET['u']);
	$c = $db->EscapeString($_GET['c']);
	$qu=_insertData($db,"UPDATE `users` SET `coins`='$c' WHERE email='$u'");
	
}

/** report web surf*/

if(isset($_POST['repo'])&&isset($_POST['id'])&&isset($_POST['msg'])){
	$id = $db->EscapeString($_POST['id']);
	$cid = $db->EscapeString($_POST['wid']);
	$msz = $db->EscapeString($_POST['msg']);
	$uid =$data['id'];
	$uname =$data['fullname'];
	$tim=time();
	$qu=_insertData($db,"INSERT INTO `web_report`(`uid`, `webid`,`msg`,`tim`)
	VALUES ($uid,$id,'$msz',$tim)");

  $qu=_insertData($db,"INSERT INTO `web_surfing_done`(`user_id`, `web_id`, `s_time`, `skip`) VALUES ('$uid','$id','$tim','$uid')");

  $dt=_getData($db,"SELECT * FROM `users` WHERE id=$cid");
  $cname=$dt['fullname'];

  $qu=_insertData($db,"INSERT INTO `activity`(`my_id`, `my_name`, `clint_id`, `clint_name`, `middle_name`, `last_name`, `image`, `tim`) VALUES ('$uid','$uname','$cid','$cname','report','Website','assets/icons/work.svg','$tim')");



}

/**  youtube video submit  */
if(isset($_POST['addvideo']) && isset($_POST['url'])){

  $url = $db->EscapeString($_POST['url']);
  $title = $db->EscapeString($_POST['title']);
  $pac = $db->EscapeString($_POST['pac']);
  $views = $db->EscapeString($_POST['views']);
  $limit = $db->EscapeString($_POST['daily_limit']);



  if(empty($url)){
    echo "Please Enter Video url";
    exit;
  }else if(empty($title)){
    echo "Please Enter Video title";
    exit;
  }else if(empty($pac)){
    echo "Please Select Exposure";
    exit;
  }else if(empty($views)){
    echo "Please Enter Views";
    exit;
  }else if($views<100){
    echo "Please Enter Minimum (100) Views";
    exit;
  }
  $coin=_getData($db,"SELECT * FROM `vad_packs` WHERE id=$pac");;

  if($coin==0){
    echo "Something Error";
    exit;
  }
   $coins=$coin['coins']*$views;
   $ucoin=$data['coins'];

  if($coins>$ucoin){
    echo "Not Enough Coins On Your Balance";
    exit;
  }
  $finalCoins=$ucoin-$coins;
  if (filter_var($url, FILTER_VALIDATE_URL) === false) {
    echo("Url is not a valid URL");
      exit;

  }
  $pattern = "/youtube.com/i";
  $pattern2 = "/youtu.be/i";
  $valideted= preg_match($pattern, $url);
  $valideted2= preg_match($pattern2, $url);
  if($valideted !='1' && $valideted2 !='1'){
    echo("Url is not a valid URL");
    exit;
  } else{
    if($valideted =='1'){
    $output = implode(array_slice(explode("watch?v=",$url), 1, 3),",");
     $url= $output;
    }else{
      $output = implode(array_slice(explode(".be/",$url), 1, 3),",");
      $url= $output;
    }
  $uid=$data['id'];
  $u_name=$data['fullname'];
  $tim=time();
  $pack=_getData($db,"SELECT * FROM `vad_packs` WHERE id=$pac");
  $timer=$pack['time'];
  $coinsp=$pack['coins'];

  $submit=_insertData($db,"INSERT INTO `vad_videos`(`user_id`, `video_id`, `title`,  `daily_clicks`, `status`, `ad_pack`, `clickneed`,`tim`,`coins`, `time`) VALUES ('$uid','$url','$title','$limit',1,'$pac','$views','$timer','$coinsp','$tim')");
  if($submit){
    $upuser=_insertData($db,"UPDATE users SET coins=$finalCoins WHERE id=$uid");
    $j_update=_insertData($db,"INSERT INTO `activity`(`my_id`, `my_name`, `clint_id`, `clint_name`, `middle_name`, `last_name`, `image`,`tim`)
                    VALUES ('$uid','$u_name','$uid','Your','Successfully Publish','Video','assets/icons/youtube.svg','$tim')");
    echo "Success";
  }else{
    echo "Something Error";
  }

  }

}



if(isset($_POST['data'])&&isset($_POST['token'])){
	$vid = $db->EscapeString($_POST['data']);
	$token = $db->EscapeString($_POST['token']);
	$uid =$data['id'];
	$u_name =$data['fullname'];


  $dth=_getData($db,"SELECT * FROM `vad_videos_session` WHERE user_id=$uid AND video_id=$vid");
  if($dth !=0){
    if($dth['ses_key']==$token){
      $v_sub=_getData($db,"SELECT * FROM `vad_videos` WHERE id=$vid");
      $clintid=$v_sub['user_id'];
      $v_subss=_getData($db,"SELECT * FROM `users` WHERE id=$clintid");
      $clintnam=$v_subss['fullname'];

      if($v_sub==0){echo "Something Wrong";
      }else{
        $coins=$v_sub['coins'];
        $clickneed=$v_sub['clickneed']-1;
        $today_clicks=$v_sub['today_clicks']+1;
        $visits=$v_sub['visits']+1;
        $updateVideo=_insertData($db,"UPDATE `vad_videos` SET `visits`='$visits',`today_clicks`='$today_clicks',`clickneed`='$clickneed' WHERE id=$vid");
        if($updateVideo){
          $ucoin=$data['coins']+$coins;
          $tim=time();
          _insertData($db,"UPDATE `users` SET `coins`='$ucoin' WHERE id=$uid");
          _insertData($db,"INSERT INTO `vad_videos_done`(`user_id`, `video_id`, `time`) VALUES ('$uid','$vid','$tim')");
          $j_update=_insertData($db,"INSERT INTO `activity`(`my_id`, `my_name`, `clint_id`, `clint_name`, `middle_name`, `last_name`, `image`,`tim`)
                    VALUES ('$uid','$u_name','$clintid','$clintnam','Successfully Watch','Video','assets/icons/youtube.svg','$tim')");


          echo "Success";
        }else{
          echo "Something Error";
        }
      }



    }else{
      echo "Video is Not Successfully Submited";
    }

  }else{
    echo "something Error";
  }

}


  /**skip users */
  if(isset($_POST['clearYoutubeviews'])){
  $time=time()-3600;
  $time2=time()-25200;
    _insertData($db,"DELETE FROM `vad_videos_done` WHERE time<$time AND skip=0");
    _insertData($db,"DELETE FROM `vad_videos_done` WHERE time<$time2 AND skip !=0");

  }

$API_Key=$config['apiKey'];
//$config('site_url')."/assets/images/yticonadd.png";
/// get channel info by arif
if(isset($_POST['getsubsInfo'])){
	$id=$_POST['getsubsInfo'];
  $subscriberCount=0;
	$Channel_ID = filter_var($_POST['getsubsInfo'], FILTER_SANITIZE_STRING);
	$uid=$data['id'];


	$dt_yt= $db->QueryFetchArray("SELECT * FROM `youtube_subscribe` WHERE user_id=$uid AND youtube_link='$Channel_ID' LIMIT 1");
	if($dt_yt>0){
		$jdata['type']=0;
		$jdata['msz']="You Already Add This Channel";
		echo(json_encode($jdata));
		exit;
		}
	///////////////////

	$x = get_data('https://www.googleapis.com/youtube/v3/channels?part=statistics&id='.$Channel_ID.'&key='.$API_Key);
	$x = json_decode($x, true);

if($x['items'][0]['statistics']['hiddenSubscriberCount'] == true){

		$jdata['type']=0;
		$jdata['msz']="Your Channel Count Hidden Subscriber, Please pucbic it First";
		echo(json_encode($jdata));
		exit;
	}else{
		$result = $x['items'][0]['statistics']['subscriberCount'];
	}



	if ($result>=0 && $result !=""){
			$subscriberCount=$result;

	}
	else{
			$jdata['type']=0;
			$jdata['msz']="Something Wrong, Please try again Letter";
			echo(json_encode($jdata));
			exit;
	}



	//////////////



	$channelID=0;
	$channelthumb=0;

	$yt_url = 'https://www.googleapis.com/youtube/v3/search?part=snippet&channelId='.$Channel_ID.'&key='.$API_Key;
	$data = get_data($yt_url);
	$x = json_decode($data);

	foreach($x->items as $a){
			if(($a->snippet->channelTitle) !=null ||($a->snippet->channelTitle)==0){
				$channelID=$a->snippet->channelTitle;

			}

			if(($a->snippet->thumbnails->default->url) !=null ||($a->snippet->thumbnails->default->url) ==0){
				$b=$a->snippet->thumbnails->default->url;
				if(strpos($b, "yt3.ggpht.com") !== false){
					$channelthumb=$b;
				}

			}



		}

	if($channelthumb =="0"){
		$channelthumb="https://joblessbd.com/static/img//yticonadd.png";
	}

	$jdata['type']=1;
	$jdata['name']=$channelID;
	$jdata['subcoun']=$subscriberCount;
	$jdata['img']=$channelthumb;

	echo(json_encode($jdata));

}

/** get Youtube price */
if(isset($_POST['ad_pack_yt']) && is_numeric($_POST['ad_pack_yt']) && isset($_POST['visits']) && is_numeric($_POST['visits']))
{
   $pID = $db->EscapeString($_POST['ad_pack_yt']);
   $visits = $db->EscapeString($_POST['visits']);
   $ad_pack =_getData($db,"SELECT * FROM `youtube_sub_packs` WHERE `id`='".$pID."' LIMIT 1");
   $cutCoin=($visits * $ad_pack['coins']);
   echo $cutCoin;
}
if(isset($_GET['youtube-price'])|| isset($_GET['yprice'])){
  $yid= $_GET['youtube-price'];  
  $yprice= $_GET['yprice'];
  if(!empty($yid)){
    $dt_con= $db->QueryFetchArray("SELECT * FROM youtube_sub_packs");
    $get=_getAllData($db,"$yid");
    echo(json_encode($get));
    exit;
  }else{
    print_r($yerr);    
  }  
 }

if(isset($_POST['url'])&&isset($_POST['title'])&&isset($_POST['image'])&&isset($_POST['pac'])&&isset($_POST['views'])&&isset($_POST['daily_visit_limit']))
  {
	$uid=$data['id'];
  $u_name=$data['fullname'];
	$chennelId=$_POST['url'];
	$chennelName=$_POST['title'];
	$chennelimg=$_POST['image'];
	$price=$_POST['pac'];
	$views=$_POST['views'];
	$dailyLimit=$_POST['daily_visit_limit'];
	$timess= time();
	$finalCoin="";
	///////////
	$dt_con= $db->QueryFetchArray("SELECT * FROM `youtube_sub_packs` WHERE id=$price");
	$price=$dt_con['coins'];
	$dummyCoin=$views*$price;
	/////////

	$dt_con= $db->QueryFetchArray("SELECT * FROM `users` WHERE id=$uid");
	$carentCoin=$dt_con['coins'];
		if($carentCoin<$dummyCoin){
			$jdata['type']=0;
			$jdata['msz']="Not Enough Coin..Please Add Coin";
			echo(json_encode($jdata));
			exit;
		}else{
			$finalCoin=$carentCoin-$dummyCoin;
			$upCoin=$db->Query("UPDATE users SET coins=$finalCoin WHERE id=$uid");
		}

	$succesdata=$db->Query("INSERT INTO `youtube_subscribe` (`user_id`, `youtube_link`, `image_link`, `title`, `click_need`, `point`,`dailyClick`, `time`)
		VALUES($uid,'$chennelId','$chennelimg','$chennelName',$views,$price,$dailyLimit,$timess)");
$tim=time();
$j_update=_insertData($db,"INSERT INTO `activity`(`my_id`, `my_name`, `clint_id`, `clint_name`, `middle_name`, `last_name`, `image`,`tim`)
VALUES ('$uid','$u_name','$uid','Your','Successfully Submit','Youtube Chennel','assets/icons/youtube.svg','$tim')");



			$jdata['type']=1;
			$jdata['msz']="Success";
			echo(json_encode($jdata));
			exit;

  }
  if(isset($_GET['u'])&&isset($_GET['web'])){
    $id= $db->EscapeString($_GET['u']);
    $webid= $db->EscapeString($_GET['web']);
    _insertData($db,"UPDATE `game` SET `activity`='$webid' WHERE uid='$id'");
    $get=_getData($db,"SELECT * FROM game WHERE uid='$id'");
    echo $get['activity'];

  }
  /**skip users */
if(isset($_POST['skip'])&&isset($_POST['yid'])){
	$id = $db->EscapeString($_POST['yid']);
	$uid =$data['id'];
	$tim=time();
	$qu=_insertData($db,"INSERT INTO `vad_videos_done`(`user_id`, `video_id`, `skip`,`time`) VALUES ($uid,$id,$uid,$tim)");
	if($qu){
		echo 1;
		}
	else{
		echo 2;
		}
}



  /**delete chennel*/
  if(isset($_POST['delete'])&&isset($_POST['id'])){
    $id = $db->EscapeString($_POST['id']);
    $qu=_insertData($db,"DELETE FROM `youtube_subscribe` WHERE id=$id");
    if($qu){
      echo "succes";
    }	else{ echo "Something Wrong";}

  }

  /**add fund*/
  if(isset($_POST['addfund'])&&isset($_POST['id'])){
    $id = $db->EscapeString($_POST['id']);
     $amount = $db->EscapeString($_POST['addfund']);



    $gt=_getData($db,"SELECT * FROM youtube_subscribe WHERE id=$id");

    if($gt){
      $cneed=$gt['click_need']+$amount;
      $point=$gt['point']*$amount;
      $ucoin=$data['coins'];

      if($ucoin<$point){echo "Not Enough Ballance"; exit;}
      $finalcoin=$ucoin-$point;


      $qu=_insertData($db,"UPDATE `youtube_subscribe` SET `click_need`='$cneed' WHERE id=$id");
      $uid=$data['id'];
      $qu=_insertData($db,"UPDATE `users` SET `coins`='$finalcoin' WHERE id=$uid");

      echo "Successfully Added";
    }
    else{echo "Something Wrror";}
  }




/// get channel info by arif
if(isset($_POST['csub']) && $_POST['i'] > 0){
	$id=$_POST['csub'];
	$y_done = $db->QueryFetchArrayAll("SELECT * FROM youtube_subscribe WHERE id=$id");
	$ts=$y_done[0]['youtube_link'];




	$pid = $db->EscapeString($_POST['pid']);
	$x = get_data('https://www.googleapis.com/youtube/v3/channels?part=statistics&id='.$ts.'&key='.$API_Key);
	$x = json_decode($x, true);

	if($x['items'][0]['statistics']['hiddenSubscriberCount'] == true){
		$result = ($first == 1 ? 0 : 1);
	}else{
		$result = $x['items'][0]['statistics']['subscriberCount'];
	}


	if ($result>=0 && $result !=""){
		echo $result;
		}else{
		echo "privet";
		}

}


///set subscriber by arif
if(isset($_POST['get']) && $_POST['pid'] > 0 && isset($_POST['cid'])){
	$cid=$_POST['get'];
	$csubscribe=$_POST['pid'];
	$clink=$_POST['cid'];

	$pid = $db->EscapeString($_POST['pid']);
	$x = get_data('https://www.googleapis.com/youtube/v3/channels?part=statistics&id='.$clink.'&key=AIzaSyD0EkaN1yOYsBsMEoenuXp3b8XhBdIUo2Q');
	$x = json_decode($x, true);

	if($x['items'][0]['statistics']['hiddenSubscriberCount'] == true){
		$result = ($first == 1 ? 0 : 1);
	}else{
		$result = $x['items'][0]['statistics']['subscriberCount'];
	}

	//channel info
	$ch_info=$db-> QueryFetchArrayAll("SELECT * FROM youtube_subscribe WHERE id=$cid");
		$clickNeed=$ch_info[0]["click_need"];
		$coinTis=$ch_info[0]["point"];
		$totalclick=$ch_info[0]["clicks"]+1;
		$todayclick=$ch_info[0]["today_clicks"]+1;
		$tim=time();
		$uid=$data['id'];
		$ci='"'.$clink.'"';

	/////



	if ($result>=0 && $result !=""){
		$result;
		}else{
		$result=0;
		}
	if($result<=$csubscribe){
		//$db->Query("INSERT INTO youtube_sub_done(user_id, channel_id,s_type, s_time) VALUES ($uid,$ci,0,$tim)");
		echo $result;
	}
	else{
			$clickNeed=$clickNeed-1;
			$c_coin=$data['coins'];
			$c_coin=$c_coin+$coinTis;
			$type=1;
			$db->Query("INSERT INTO youtube_sub_done(user_id, channel_id,s_type, s_time) VALUES ($uid,$ci,1,$tim)");
			$db->Query("UPDATE `youtube_subscribe` SET click_need=$clickNeed,clicks=$totalclick ,today_clicks=$todayclick WHERE id=$cid");
			$db->Query("UPDATE `users` SET coins=$c_coin WHERE id=$uid");
			echo $result;
			}

}

//removed channel
if(isset($_POST['ii']) && $_POST['tt'] ){

	$chnl_id=filter_var($_POST['ii'], FILTER_SANITIZE_STRING);
	$chnl_id='"'.$chnl_id.'"';
	$uid=$data['id'];
	$tim=time();
	$db->Query("INSERT INTO youtube_sub_done(user_id, channel_id, s_time) VALUES ($uid,$chnl_id,$tim)");
	echo "Skiped";


}

//deposit setting
if(isset($_POST['payId']) && $_POST['coins'] && $_POST['wallet'] && $_POST['trx'] ){
  $payId = $db->EscapeString($_POST['payId']);
  $coins = $db->EscapeString($_POST['coins']);
  $wallet = $db->EscapeString($_POST['wallet']);
  $trx = $db->EscapeString($_POST['trx']);

  if($coins<$config['minDeposit']){
    echo "Minimum Deposit is ".$config['minDeposit'];
    exit;
   }

  $p=_getData($db,"SELECT * FROM  deposit_config WHERE id=$payId");
  if($p ==0){echo "Something Error"; exit;}
  $tim=time();
  $uid=$data['id'];
  $method=$p['name'];
  $payment_info=$p['accaunt'];

  $c=($coins/100)*$config['DepositCommition'];
  $d=$coins-$c;

  $insrt=_insertData($db,"INSERT INTO `deposit`( `user_id`, `coins`, `method`, `trx_id`, `timestamp`, `status`, `payment_info`, `myId`, `commition`) VALUES ('$uid','$d','$method','$trx','$tim','0','$wallet','$payment_info','$c')");
  if ($insrt) {
    echo "Success";
  }else{
    echo "Something Error";
  }

}


//withdrow setting
if(isset($_POST['payId']) && $_POST['coins_amount'] && $_POST['w_wallet_input'] && $_POST['phone'] ){
  $payId = $db->EscapeString($_POST['payId']);
  $coins_amount = $db->EscapeString($_POST['coins_amount']);
  $w_wallet_input = $db->EscapeString($_POST['w_wallet_input']);
  $phone = $db->EscapeString($_POST['phone']);


  $ucoin=$data['coins'];
 if($ucoin<$coins_amount){
  echo "Not Enough Balance";
  exit;
 }
 if($coins_amount<$config['minWithdraw']){
  echo "Minimum Withdraw is ".$config['minWithdraw'];
  exit;
 }
 $finalCoin=$ucoin-$coins_amount;

  $p=_getData($db,"SELECT * FROM  withdawl_config WHERE id=$payId");
  if($p ==0){echo "Something Error"; exit;}

  $tim=time();
  $uid=$data['id'];
  $method=$p['name'];
  $payment_info=$p['accaunt'];
  $c=($coins_amount/100)*$config['WithdrawCommition'];
  $d=$coins_amount-$c;
  $rcomition=($coins_amount/100)*$config['refarel_comition'];

  $insrt=_insertData($db,"INSERT INTO `withdrawals`( `user_id`, `coins`, `method`, `status`, `payment_info`, `contact`) VALUES ('$uid','$d','$method','0','$w_wallet_input','$phone')");
  if ($insrt) {
      $ins=_insertData($db,"UPDATE `users` SET `coins`='$finalCoin' WHERE id=$uid");
      echo "Success";
     $ref=$data['ref'];
      if(!empty($ref) || $ref !=0){
        $c=$c-$rcomition;
        $rfuser=_getData($db,"SELECT *FROM `users` WHERE id=$ref");
        if($rfuser !=0){
          $rfcoin=$rfuser['coins']+$rcomition;
          _insertData($db,"UPDATE `users` SET `coins`='$rfcoin' WHERE id=$ref");
        }
      }
      _insertData($db,"INSERT INTO `admin_profit`(`coin`, `activity`, `tim`) VALUES ('$c','2','$tim')");

  }else{
    echo "Something Error";
  }

}



//loucky coupon submit
if(isset($_POST['coupon']) && $_POST['oparetor'] && $_POST['phone'] ){
  $coupon = trim($db->EscapeString($_POST['coupon']));
  $oparetor =trim($db->EscapeString($_POST['oparetor']));
  $phone = trim($db->EscapeString($_POST['phone']));
  $uid=$data['id'];
  if(!$is_online){
    echo "Please Login To Submite Coupon";
    exit;
  }

  $p=_getData($db,"SELECT * FROM  luckycupon WHERE id=1");
  $CuponCode=$p['CuponCode'];
  $couponPrice=$p['louckyPrice'];
  if($coupon !=$CuponCode){
    echo "Wrong Coupon Code";
    exit;
  }
  $pt=_getData($db,"SELECT * FROM  louckycoupon WHERE userid='$uid'");
  if($pt !=0){
    echo "You Already Submited  Coupon";
    exit;
  }

  $tim=time();

  $uName=$data['fullname'];

  $insrt=_insertData($db,"INSERT INTO `louckycoupon`(`coupon`, `couponPrice`, `Activity`, `tim`, `userid`, `sername`, `userphon`) VALUES ('$coupon','$couponPrice','1','$tim','$uid','$uName','$phone')");
  if ($insrt) {
    echo "Success";
  }else{
    echo "Something Error";
  }

}

if(isset($_POST['u'])&&isset($_POST['web'])){
  $id= $db->EscapeString($_POST['u']);
  $webid= $db->EscapeString($_POST['web']);
  _insertData($db,"UPDATE `game` SET `activity`='$webid' WHERE uid='$id'");
  $get=_getData($db,"SELECT * FROM game WHERE uid='$id'");
    echo $get['activity'];

}

/**add fund*/
if(isset($_POST['buy'])&&isset($_POST['ticket'])){
     $amount = $db->EscapeString($_POST['ticket']);

     if($amount<1){
      echo "please Buy Minimum 1 Ticket";
      exit;
     }
     if(!is_numeric($amount)){
      echo "Please Enter a Valid Number";
      exit;
     }
     $uid=$data['id'];
     $ucoin=$data['coins'];

     $tiket=_getData($db,"SELECT * FROM tottery WHERE id=1");
     $price=$tiket['lprice'];
     $fprice= $price*$amount;

     $wtime=$tiket['wintime'];
     $ctim=time();
     $buytime=$wtime-$ctim;


     if($ucoin<$fprice){
      echo "Not Enough Coins";
      exit;
     }else if($buytime<60){
      echo "You Can't Buy Tikket At this Time";
      exit;
     }
     else{
      $finalcoins=$ucoin-$fprice;
      $total=true;
      while($total){
        $number= rand(111111,999999);
        $getnumber=_getData($db,"SELECT * FROM `lottarybuy` WHERE number='$number'");
        if($getnumber==0){
          $time=time();
          _insertData($db,"INSERT INTO `lottarybuy`(`usr_id`, `number`, `time`) VALUES ('$uid','$number','$time')");
          $amount--;
        }
        if($amount<1){$total=false;}
      }
      _insertData($db,"UPDATE `users` SET `coins`='$finalcoins' WHERE id='$uid'");
      echo "success";

     }


   // $gt=_getData($db,"SELECT * FROM youtube_subscribe WHERE id=$id");
    //  $qu=_insertData($db,"UPDATE `youtube_subscribe` SET `click_need`='$cneed' WHERE id=$id");

  }



  //Deleted Accaunt
if(isset($_POST['deleteaccaunt']) && is_numeric($_POST['deleteaccaunt'])){
  $uid=$data['id'];
  if($data['admin'] !=1){
      $p=_insertData($db,"UPDATE `users` SET `disabled`='1' WHERE id='$uid'");
      if($p){
        echo "success";
      }else{
        echo "Something Error";
      }
    }

}


 //aprovejob
 if(isset($_POST['aprovejob']) && is_numeric($_POST['aprovejob'])){
  $id=$_POST['aprovejob'];

  $getjob=_getData($db,"SELECT * FROM `job_submit` WHERE id=$id");

  $uid=$getjob['userid'];
  $coin=$getjob['amount'];

  $getu=_getData($db,"SELECT * FROM `users` WHERE id=$uid");
  $ucoin=$getu['coins']+$coin;
  $p=_insertData($db,"UPDATE `users` SET `coins`='$ucoin' WHERE id='$uid'");
  $p=_insertData($db,"UPDATE `job_submit` SET `activity`='1' WHERE id='$id'");
      if($p){
        echo "success";
      }else{
        echo "Something Error";
      }
}


/**start spin section */
if(isset($_POST['getusercoins'])){
  $uid=$data['id'];
  $c=_getData($db,"SELECT * FROM users WHERE id='$uid'");
  echo $c['coins'];
}


if(isset($_POST['one'])&&is_numeric($_POST['one'])&&isset($_POST['two'])&&is_numeric($_POST['two'])&&isset($_POST['three'])&&is_numeric($_POST['three'])&&isset($_POST['four'])&&is_numeric($_POST['four'])){
  $one = $db->EscapeString($_POST['one']);
  $two = $db->EscapeString($_POST['two']);
  $three = $db->EscapeString($_POST['three']);
  $four = $db->EscapeString($_POST['four']);

  $finalbit=$one+$two+$three+$four;
  $ucoin=$data['coins'];
  if($ucoin<$finalbit){
    echo "Not Enugh Ballence";
    exit;
  }
  if($one<1 && $two<1 && $three<1 && $four<1){
    echo "Please Enter Some Coins";
    exit;
  }
  $finalcoin=$ucoin-$finalbit;
  $uid=$data['id'];
  $getgame=_getData($db,"SELECT * FROM game WHERE uid=$uid");
  if($getgame==0){
    $bitinsert=_insertData($db,"INSERT INTO `game`( `uid`,`activity`, `one`, `two`, `three`, `four`) VALUES ('$uid','0','$one','$two','$three','$four')");
    }else{
      $bitinsert=_insertData($db,"UPDATE `game` SET `one`='$one',`two`='$two',`three`='$three',`four`='$four' WHERE uid=$uid");
    }
    $bitinsert=_insertData($db,"UPDATE `users` SET `coins`='$finalcoin' WHERE id=$uid");
    echo "success";

}
 /** get winner */
 if(isset($_POST['getWinnersspin'])){
  $w = $db->EscapeString($_POST['getWinnersspin']);
  $uid=$data['id'];
  $uName=$data['fullname'];
  $tim=time();

  $getdata=_getData($db,"SELECT * FROM game WHERE uid=$uid");
  if($w>0){
    $funalcoin=$w*4;
    $ucoin=$data['coins'];
    $finalcoin=$ucoin+$funalcoin;
    if($getdata['one']<1 && $getdata['two']<1 && $getdata['three']<1 && $getdata['four']<1){
      exit;
     }else{
         $g=_getData($db,"SELECT * FROM game WHERE uid=$uid");
         $totallose=$g['one']+$g['two']+$g['three']+$g['four'];
        _insertData($db,"UPDATE `users` SET`coins`='$finalcoin' WHERE id=$uid");        
        _insertData($db,"UPDATE `game` SET `one`='0',`two`='0',`three`='0',`four`='0' WHERE uid=$uid");
        _insertData($db,"INSERT INTO `activity`(`my_id`, `my_name`, `clint_id`, `clint_name`, `middle_name`, `last_name`, `image`,`tim`)
        VALUES ('$uid','$uName','$uid','$funalcoin','Succesfully Win','Coins in Game Rewards','assets/icons/wheel.png','$tim')");
        _insertData($db,"INSERT INTO `admin_activity`(`uname`, `coin`, `win_lose`, `time`) VALUES ('$uName','$totallose','1','$tim')");
        $msg['err']=false;
        $msg['messeg']="success";
        $msg['coin']="$funalcoin";
        echo  json_encode($msg);
      }
  }else{
    $getdata=_getData($db,"SELECT * FROM game WHERE uid=$uid");
    if($getdata['activity']!='0'){
      $n=$getdata['activity'];
      $funalcoin=$getdata["$n"]*4;
      $ucoin=$data['coins'];
      $finalcoin=$ucoin+$funalcoin;
        if($getdata['one']>0 || $getdata['two']>0 || $getdata['three']>0 || $getdata['four']>0){
        _insertData($db,"UPDATE `users` SET`coins`='$finalcoin' WHERE id=$uid");
        _insertData($db,"UPDATE `game` SET `one`='0',`two`='0',`three`='0',`four`='0' WHERE uid=$uid");
        _insertData($db,"INSERT INTO `activity`(`my_id`, `my_name`, `clint_id`, `clint_name`, `middle_name`, `last_name`, `image`,`tim`)
          VALUES ('$uid','$uName','$uid','$funalcoin','Succesfully Win','Coins in Game Rewards','assets/icons/wheel.png','$tim')");
        $msg['err']=false;
        $msg['messeg']=$nm;
        echo  json_encode($msg);
        exit;
      }

    }else{
    $losecoin=$getdata['one']+$getdata['two']+$getdata['three']+$getdata['four'];
    if($getdata['one']>0 || $getdata['two']>0 || $getdata['three']>0 || $getdata['four']>0){
      _insertData($db,"INSERT INTO `activity`(`my_id`, `my_name`, `clint_id`, `clint_name`, `middle_name`, `last_name`, `image`,`tim`)
          VALUES ('$uid','$uName','$uid','$losecoin','Lose','Coins in Game Rewards','assets/icons/wheel.png','$tim')");
      _insertData($db,"UPDATE `game` SET `one`='0',`two`='0',`three`='0',`four`='0' WHERE uid=$uid");
      _insertData($db,"INSERT INTO `admin_activity`(`uname`, `coin`, `win_lose`, `time`) VALUES ('$uName','$losecoin','2','$tim')");
      $msg['err']=true;
      $msg['messeg']="loose";
      $msg['coin']="$losecoin";
      echo  json_encode($msg);
      exit;
    }
  }

  }

 }
/** end spin section */




 //rejec_job
 if(isset($_POST['rejec_job']) && is_numeric($_POST['rejec_job'])){
  $id=$_POST['rejec_job'];


  $p=_insertData($db,"UPDATE `job_submit` SET `activity`='3' WHERE id='$id'");
      if($p){
        echo "success";
      }else{
        echo "Something Error";
      }


}

//rejec_job
if(isset($_POST['emailreset'])){
  $email=$_POST['emailreset'];

  if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

     $getuser=_getData($db,"SELECT * FROM users WHERE email='$email'");
    if($getuser==0){
      echo "Not Found This Email";
      exit;
    }
    $idd=$getuser['id'];
    $number=rand(1000,9999);
   $insrt= _insertData($db,"UPDATE `users` SET `activate`='$number' WHERE id='$idd'");
   if(!$insrt){
    echo "Something Wrong";
    exit;
   }
   $link=$config['site_url']."/resetpass?u=".$idd."&".id."=".$number.".";




        $smtp_host = $config['smtp_host'];
        $smtp_username = $config['smtp_username'];
        $smtp_password = $config['smtp_password'];
        $smtp_port = $config['smtp_port'];
        $smtp_secure = $config['smtp_auth'];
        $site_email = $config['site_email'];
        $site_name = $config['noreply_email'];
        $address = $email;
        $body = $link;
        $subject = 'Click this Link to Reset password';
        $send = sendVarifyCode($smtp_host,$smtp_username,$smtp_password,$smtp_port,$smtp_secure,$site_email,$site_name,$address,$body,$subject);

        if(!$send){
            echo  'success';

        }
          } else {
            echo("It's not a valid email address");
          }

  // $p=_insertData($db,"UPDATE `job_submit` SET `activity`='3' WHERE id='$id'");

}



/**log logout function */
if(isset($_POST['getWinner'])&&$is_online==true){
  $dt=_getData($db,"SELECT * FROM `tottery` WHERE id=2");
  if(empty($dt['name'])){
    echo "empty";
  }else{
    echo $dt['name'];
  }
}

//job auto submit
if(isset($_POST['job']) && $_POST['success'] ){

    $today = date("Y-m-d H:i:s");
  $tim= strtotime($today);
  $ref=$data['ref'];
    $uid=$data['id'];

  $tim=time();
   $job=_getAllData($db,"SELECT * FROM `job_submit` WHERE (userid=$uid AND activity=0)");
  foreach ($job as $j) {
     $subtime=strtotime($j['time']);
   
    if($tim-$subtime >86400){
      $amount=$j['amount'];
      $id=$j['id'];
      _insertData($db,"UPDATE `job_submit` SET `activity`='1' WHERE id=$id");
      $u=_getData($db,"SELECT * FROM `users` WHERE id=$uid");
      $finals=$u['coins']+$amount;
      _insertData($db,"UPDATE `users` SET `coins`=$finals WHERE id=$uid");

      if($ref>0){
        $rfamount=($amount/100)*$config['refarel_comition'];
        $getrfcoin=_getData($db,"SELECT * FROM `users` WHERE id=$ref");
        $rfcoin=$getrfcoin['coins']+$rfamount;
        _insertData($db,"UPDATE `users` SET `coins`=$rfcoin WHERE id=$id");

      }
     
     }
   

 }


}

  $db->Close();