<?php
	require_once"common/sidebar.php";

    $err="";
    if(isset($_POST['submit'])){
        $name_n = $db->EscapeString($_POST['name_n']);
        $email = $db->EscapeString($_POST['email']);
        $message = $db->EscapeString($_POST['message']);
        $tim=time();

        if(!empty($name_n)||!empty($email)||!empty($message)){
            $ins=_insertData($db,"INSERT INTO `contactpage`(`name`, `email`, `msg`, `time`) VALUES ('$name_n','$email','$message','$tim')");

            if($ins){
                $err="Successfully Send Messege ";
            }else{
                $err="Something Error !";
            }

        }
    }

?>

<!--===== main page content =====-->
<div class="content">
    <div class="container">
        <div class="page_content">
        <div style="text-align: center;">
        <?php if(!empty($top_ad['code'])){  echo base64_decode($top_ad['code']);} ?>
        </div>
            <div class="contact contact_container">
            <p style="text-align: center;color: darkblue;"><?= $err ?></p>
                <form action="" method="POST">
                    <div class="form">
                        <div class="form-txt">
                            <h1>Contact Us</h1>
                            <span>As you might expect of a company that began as a high-end
                                interiors contractor, we pay strict attention.</span>

                        </div>
                        <div class="form-details">
                            <input type="text" name="name_n" id="name" placeholder="Name" required />
                            <input type="email" name="email" id="email" placeholder="Email" required />
                            <textarea name="message" id="message" cols="52" rows="7" placeholder="Message"
                                required></textarea>
                            <button name="submit" type="submit"> SEND MESSAGE</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include"common/footer.php"; ?>