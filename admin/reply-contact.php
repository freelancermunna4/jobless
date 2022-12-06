<?php
  require_once"common/header.php";
    $uid=$data['id'];

    if(isset($_GET['id']) &&is_numeric($_GET['id'])){
      $id=$_GET['id'];
      $ti=_getData($db,"SELECT * FROM `contactpage` WHERE id=$id");
    }else{
      header('location:all-tiket');
    }


  if(isset($_POST['msg_s'])){

    $title=$db->EscapeString($_POST['msg']);
    $getu=_getData($db,"SELECT * FROM `contactpage` WHERE id=$id");
    $usermail=$getu['email'];


     $smtp_host = $config['smtp_host'];

    $smtp_username = $config['smtp_username'];
    $smtp_password = $config['smtp_password'];
    $smtp_port = $config['smtp_port'];
    $smtp_secure = $config['smtp_auth'];
    $site_email = $config['site_email'];
    $site_name = $config['site_name'];
    $address = $usermail;
    $body = $title;
     $subject = 'Repley by'.$site_name;
     $send = sendVarifyCodemail($smtp_host,$smtp_username,$smtp_password,$smtp_port,$smtp_secure,$site_email,$site_name,$address,$body,$subject);

    if(!$send){
      _insertData($db,"UPDATE `contactpage` SET `riply`='1' WHERE id=$id");
      echo '<h4 style="text-align: center;color: blue;">success</h4>';
      header('location:all-contact');
    }

  }








// <!-- ===================php mailer=========== -->

function sendVarifyCodemail($smtp_host, $smtp_username, $smtp_password, $smtp_port, $smtp_secure, $site_email, $sitename, $addres, $body, $subject)
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
<div class="x_container space-y-10 py-10">

    <div class="col-span-2">
        <h2 class="text-xl font-semibold text-cyan-800">Repley Contact</h2>
    </div>


    <div class="col-span-2">
        <p class="text-sm font-semibold"><?= $ti['msg'] ?></p>
    </div>

</div>

<div class="w-full space-y-10 p-6 lg:p-12 bg-white border border-gray-200 rounded">








    <hr class="my-6">
    <form class="grid grid-cols-2 gap-y-6 gap-x-12" action="" method="POST" enctype="multipart/form-data">
        <div class="col-span-2">
            <h2 class="text-xl font-semibold text-cyan-800">Bank Details</h2>
        </div>

        <div class="flex flex-col gap-y-1">
            <label for="Bank Details">Messege</label>
            <textarea name="msg" class="input p-3 min-h-[100px]" id="Bank Details" placeholder="Bank Details"
                required></textarea>


        </div>



        <div class="col-span-2 flex justify-start">
            <div class="w-fit">
                <button name="msg_s" class="button">Submit</button>
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