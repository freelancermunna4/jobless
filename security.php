<?php
	require_once"common/sidebar.php";
    if(!$is_online){ header("Location: index");}
    $uid=$data['id'];  
    $err="";  
    if(isset($_POST['submit'])){
        $current_p=$db->EscapeString($_POST['current_p']);
        $new_p=$db->EscapeString($_POST['new_p']);
        $confirm_p=$db->EscapeString($_POST['confirm_p']);

        $current_p=md5( $current_p);               
        $pass=$data['password'];        
        if($current_p != $pass){
            $err='<p style="color: red;margin-left: 25px;">Wrong Password</p>';
        }
        else if($new_p !==$confirm_p){
            $err='<p style="color: red;margin-left: 25px;">Confirm password not matched</p>';
        }else{
            $new_p=md5($new_p);
            $qu=_insertData($db,"UPDATE `users` SET `password`='$new_p' WHERE id='$uid'");
            if($qu){
                $err='<p style="color: green;margin-left: 25px;">Your Password are Succefully Change</p>';
            }else{
                $err='<p style="color: red;margin-left: 25px;">You Cannot Change Password at the Movement</p>';
            }

        }

        
        
    }
    
?>

<!--===== main page content =====-->
<div class="content">
    <div class="container">
        <div class="page_content">
            <div class="dashboard_layout">
                <?php require_once('common/profile_sidebar.php'); ?>

                <div class="dashboard_content">
                    <div class="dc_box">
                        <div class="dc_box_header">
                            <div class="dc_box_container">
                                <h6>
                                    <span class="icon">
                                        <i class="fa fa-user"></i>
                                    </span>
                                    <span class="text"> Change Password </span>
                                </h6>

                            </div>
                            <span><?php echo $err ?></span>
                        </div>


                        <div class="dc_box_container">
                            <form action="" method="post">
                                <div class="input_area">
                                    <label for="current_p">Current Password</label>
                                    <input required name="current_p" id="current_p" type="password" class="base_input"
                                        placeholder="Current Password" />
                                </div>
                                <br />

                                <div class="input_area">
                                    <label for="new_p">New Password</label>
                                    <input required name="new_p" id="new_p" type="password" class="base_input"
                                        placeholder="New Password" />
                                </div>
                                <br />
                                <div class="input_area">
                                    <label for="confirm_p">Confirm Password</label>
                                    <input required name="confirm_p" id="confirm_p" type="password" class="base_input"
                                        placeholder="Confirm Password" />
                                </div>
                                <br />

                                <button type="submit" name="submit" class="base_btn">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include"common/footer.php"; ?>