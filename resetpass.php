<?php
	require_once"common/sidebar.php";

                    if(isset($_GET['u'])&&is_numeric($_GET['u'])&&isset($_GET['id'])&&is_numeric($_GET['id'])){
                        $uid=$_GET['u'];
                        $code=$_GET['id'];
                       $getuser=_getData($db,"SELECT * FROM users WHERE id=$uid AND activate=$code");


                    }else{
                        header('location:index');
                    }
                    $err ="";
                    if(isset($_POST['psubmit'])){
                        $pass = $db->EscapeString($_POST['pass']);
                        $rpass = $db->EscapeString($_POST['rpass']);
                        if($pass != $rpass){
                            $err ="Password And Confirm Password Not Matching";
                        }else{
                            $npass=md5($pass);
                            $insert=_insertData($db,"UPDATE `users` SET `password`='$npass',`activate`='' WHERE id=$uid");
                            if($insert){
                                $err ="Password Reset Successfully Now You Can Login";
                            }else{
                                $err ="Opps ! Something Wrong, Send a Link Again";
                            }
                        }

                    }


?>

<!--===== main page content =====-->
<div class="content">
    <div class="container">
        <div class="page_content">
            <div class="cf_wrapper">
                <h4 style="text-align: center;margin-bottom: 5px;">Reset Password</h4>
                <p style="margin-left: 25px;color: #ff1477;text-align: center;"><?= $err ?></p>

                <?php
                if($getuser !=0){ ?>
                <form action="" class="common_form" method="post">
                    <div class="form_item full_col">
                        <label for="contact_info">New Password</label>
                        <input type="text" name="pass"  id="contact_info"
                            placeholder="New Password" required />
                    </div>

                    <div class="form_item full_col">
                        <label for="contact_info">Confirm Password</label>
                        <input type="text" name="rpass"  id="contact_info"
                            placeholder="Confirm Password" required />
                    </div>


                    <div class="full_col">
                        <button type="submit" name="psubmit">Submit</button>
                    </div>
                </form>
                <?php }else{ ?>
                    <p style="margin-left: 25px;color: #ff1477;text-align: center;">Wrong Code OR Expaire Link</p>

               <?php } ?>
            </div>
        </div>
    </div>

    <?php include"common/footer.php"; ?>