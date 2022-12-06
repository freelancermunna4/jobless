<?php
	require_once"common/sidebar.php";
    $err="";
    if(isset($_POST['btnsubmit'])){
        $subject = $db->EscapeString($_POST['subject']);
        $msg = $db->EscapeString($_POST['msg']);
        if(empty($subject)){
            $err="Please Type Subject";
        }else if(empty($msg)){
            $err="Please Type Message";
        }else{
            $fileDestination="";
            if(!empty($_FILES['img'])){
                /**  image */
                $fileName=$_FILES['img']['name'];
                $fileTempName=$_FILES['img']['tmp_name'];
                $fileSize=$_FILES['img']['size'];
                $fileError=$_FILES['img']['error'];
                $fileType=$_FILES['img']['type'];
                $fileExt=explode('.',$fileName);
                $fileActualExt=strtolower(end($fileExt));
                $allaowed=array('jpeg', 'jpg', 'png', 'gif');
                if(in_array($fileActualExt,$allaowed)){
                    if ($fileError===0) {
                        if($fileSize<1000000){
                        $fileNameNew=uniqid('',true).".".$fileActualExt;
                        $fileDestination="upload/".$fileNameNew;
                        move_uploaded_file( $fileTempName,$fileDestination);

                        }else{
                            $err= "Your file is too big!";

                        }

                    }else{
                        $err= "There is an Error uploading your file!";

                    }
                }else{
                    $err= "You cannot upload files this type !";

                }
            }

            $uid=$data['id'];
            $uname=$data['fullname'];
            $time=time();
            $tid=time();
            $insrt=_insertData($db,"INSERT INTO `tiketsystem`(`tiketid`, `uid`, `uname`, `subject`, `replymsg`, `close`, `time`) VALUES ('$tid','$uid','$uname','$subject','0','0','$time')");

           $insrt=_insertData($db,"INSERT INTO `all_tiket`(`sender`, `tiketid`, `msg`, `img`, `tim`) VALUES ('$uid','$tid','$msg','$fileDestination','$time')");

           $err= "Successfully Submited Tikets !";

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
                                    <span class="text"> +SUBMIT NEW TICKET </span>
                                </h6>
                                <p><?=  $err ?></p>
                            </div>
                        </div>
                        <form class="dc_box_container" action="" method="post" enctype="multipart/form-data">
                            <div class="input_area">
                                <label for="subject">Subject</label>
                                <input name="subject" required id="subject" type="text" class="base_input" placeholder="Subject" />
                            </div>

                            <br />
                            <div class="input_area">
                                <label for="message">Message</label>
                                <textarea name="msg" id="" cols="30" rows="10" class="base_textarea" placeholder="Message..."
                                    required></textarea>
                            </div>
                            <br />
                            <div class="input_area">
                                <label for="file">Choose File</label>
                                <input name="img" id="file" type="file" class="base_input"
                                    style="height: fit-content; padding: 12px" />
                            </div>
                            <br />
                            <button name="btnsubmit" type="submit" class="base_btn">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include"common/footer.php"; ?>