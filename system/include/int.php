<?php
define('BASEPATH', true);
ob_start();
	/* Error Reporting */
	error_reporting(0);
	ini_set('display_errors', 0);

	/* Server configuration & optimisation */
	ini_set('implicit_flush', 1);
	set_time_limit(0);

	/* Starting session */
	session_start();
	/* Define Base Path */
	define('BASE_PATH', realpath(dirname(__FILE__).'/..'));

	/* Define Database Extension (MySQL or MySQLi) */
	$config['sql_extenstion']  = 'MySQLi';

	/* Load required files */
	require(BASE_PATH.'/include/database.php');	
	require(BASE_PATH.'/include/libs/database/'.$config['sql_extenstion'].'.php');

	/* Database connection */
	$db = new MySQLConnection($config['sql_host'], $config['sql_username'], $config['sql_password'], $config['sql_database']);$yerr = $db;$db->Connect();
	
	 
	unset($config['sql_password']);
	// $IP = VisitorIP();
	// $IP = ($IP != '' ? $IP : 0);
	/* Load website settings */
	$config = array();
	$configs = $db->QueryFetchArrayAll("SELECT config_name,config_value FROM `site_config`");
	foreach ($configs as $con)
	{
		$config[$con['config_name']] = $con['config_value'];
	}
	unset($configs);
	
	
	/* Script Version */
	$config['version'] = '1.0';	
	//$_SESSION['User_Id']=1;
	/* User Session */
	$is_online = false;
	if(isset($_SESSION['User_Id'])){
		$ses_id = $_SESSION['User_Id'];				
		$data = $db->QueryFetchArray("SELECT * FROM `users` WHERE `id`='".$ses_id."' AND `disabled`='0' LIMIT 1");
		$is_online = true;		
		if(empty($data['id']))
		{
			session_destroy();
			$is_online = false;
		}
		elseif($data['last_activity']+60 < time() && !defined('IS_AJAX'))
		{
			$db->Query("UPDATE `users` SET `last_activity`='".time()."' WHERE `id`='".$data['id']."'");
			$_SESSION['User_Id'] = $data['id'];
		}
	}
	elseif(isset($_COOKIE['AutoLogin']))
	{
		/** user login by coci */
		$sesCookie = $db->EscapeString($_COOKIE['AutoLogin'], 0);
	
		$ses_user 	= '';
		$ses_hash 	= '';
		$sesCookie_exp = explode('&', $sesCookie);
		foreach($sesCookie_exp as $sesCookie_part){
			$find_ses_exp = explode('=', $sesCookie_part);
			if($find_ses_exp[0] == 'ses_user'){
				$ses_user = $db->EscapeString($find_ses_exp[1]);
			}elseif($find_ses_exp[0] == 'ses_hash'){
				$ses_hash = $db->EscapeString($find_ses_exp[1]);
			}
		}
	
		if(!empty($ses_user) && !empty($ses_hash))
		{

			$data = $db->QueryFetchArray("SELECT * FROM `users` WHERE (`username`='".$ses_user."' OR `email`='".$ses_user."') AND (`password`='".$ses_hash."' AND `disabled`='0') LIMIT 1");
			
			if(empty($data['id']))
			{
				unset($_COOKIE['AutoLogin']); 
			}
			else
			{
				$_SESSION['User_Id'] = $data['id'];
				$is_online = true;
				
				$check_activity = $db->QueryGetNumRows("SELECT * FROM `user_logins` WHERE `uid`='".$data['id']."' AND DATE(`time`) = DATE(NOW()) LIMIT 1");
				if($check_activity == 0){
					$ip_address = ip2long(VisitorIP());
					$browser = $db->EscapeString($_SERVER['HTTP_USER_AGENT']);
					$db->Query("INSERT INTO `user_logins` (`uid`,`ip`,`info`,`time`) VALUES ('".$data['id']."','".$ip_address."','".$browser."',NOW())");
				}
			}
		}
		else
		{
			unset($_COOKIE['AutoLogin']); 
		}
	}

	
?>