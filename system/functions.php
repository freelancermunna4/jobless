<?php
require_once"include/int.php";
function _getData($db,$queary){
    $data=$db->QueryFetchArray($queary);
    return  $data==null?0:$data;
}

function _getAllData($db,$queary){
    $data=$db->QueryFetchArrayAll($queary);
    return $data==null? 0:$data;


}
function _insertData($db,$queary){
    $data=$db->Query($queary);
    return $data?true:false;

}

function get_data($url, $timeout = 15, $header = array(), $options = array()){
	if(!function_exists('curl_init')){
        return file_get_contents($url);
    }elseif(!function_exists('file_get_contents')){
        return '';
    }

	if(empty($options)){
		$options = array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4,
			CURLOPT_TIMEOUT => $timeout
		);
	}

	if(empty($header)){
		$header = array(
			"Accept: text/xml,application/xml,application/xhtml+xml,text/html;q=0.9,text/plain;q=0.8,image/png,*\/*;q=0.5",
			"Accept-Language: en-us,en;q=0.5",
			"Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7",
			"Cache-Control: must-revalidate, max-age=0",
			"Connection: keep-alive",
			"Keep-Alive: 300",
			"Pragma: public"
		);
	}

	if($header != 'NO_HEADER'){
		$options[CURLOPT_HTTPHEADER] = $header;
	}

	$ch = curl_init();
	curl_setopt_array($ch, $options);
	$data = curl_exec($ch);
	curl_close($ch);
	return $data;
}




function randomString($length = 6) {
	// Set the chars
	$chars='ABCDEFGHIJKLMNOPQRSTUVWXYZ';

	// Count the total chars
	$totalChars = strlen($chars);

	// Get the total repeat
	$totalRepeat = ceil($length/$totalChars);

	// Repeat the string
	$repeatString = str_repeat($chars, $totalRepeat);

	// Shuffle the string result
	$shuffleString = str_shuffle($repeatString);

	// get the result random string
    return substr($shuffleString,1,$length);
}


$uid=$data['id'];







// <!-- ===================php mailer=========== -->

function sendVarifyCode($smtp_host, $smtp_username, $smtp_password, $smtp_port, $smtp_secure, $site_email, $sitename, $addres, $body, $subject)
{

		require 'PHPMailer/PHPMailerAutoload.php';
		$mail = new PHPMailer;
		$mail->SMTPDebug = 0;                           // Enable verbose debug output

		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = $smtp_host;  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = $smtp_username;                 // SMTP username
		$mail->Password = $smtp_password;                           // SMTP password
		$mail->Port = $smtp_port;                                    // TCP port to connect to
		$mail->SMTPSecure = $smtp_secure;                            // Enable TLS encryption, ssl also accepted

		$mail->setFrom($site_email, $sitename);
		$mail->addAddress($addres);     // Add a recipient
		$mail->addReplyTo($site_email, 'Noreplay');

		//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
		$mail->isHTML(true);                                  // Set email format to HTML

		$mail->Subject = $subject;
		$mail->Body    = $body;

		if (!$mail->send()) {
				echo 'Code could not be sent.';
				echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
		}
}

// <!-- ===================php mailer=========== -->
?>