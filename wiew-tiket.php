<?php
	require_once"common/sidebar.php";
    $err="";
    if(!$is_online){ header("Location: index");}
	include_once"system/time_ago.php";

    $uid=$data['id'];
    if(isset($_GET['id'])&&is_numeric($_GET['id'])){
        $id=$_GET['id'];
    }else{
       header('location:tickets.php');
    }
    $tiket=_getData($db,"SELECT * FROM `tiketsystem` WHERE id=$id");
    $yid=$tiket['uid'];
    $colse=$tiket['close'];
    if(($uid !=$yid) ||$tiket==0){
        header('location:tickets.php');
    }
    $tid=$tiket['tiketid'];
    $ryply=_getAllData($db,"SELECT * FROM `all_tiket` WHERE tiketid=$tid");

    if(isset($_POST['btnsubmit'])){       
        $msg = $db->EscapeString($_POST['msg']);
       
       
       if(empty($msg)){
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
          
           $insrt=_insertData($db,"INSERT INTO `all_tiket`(`sender`, `tiketid`, `msg`, `img`, `tim`) VALUES ('$uid','$tid','$msg','$fileDestination','$time')");
           if($insrt){
            $err= "Successfully Submited Tikets !";
            header('location:tickets');           
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
                        <div class="activities">
                            <h5 class="title">Your  Tikets</h5>



                            <div class="activity">
                                <div>
                                    <b class="username"><?php echo $tiket['subject'] ?></b>
                                    <span class="action"> </span>  

                                </div>

                            </div>
                            <?php
                            foreach ($ryply as $r) { ?>

                            <div class="activity">
                                <div>
                                        <b class="username">
                                        <?php 
                                        if($r['sender']==0){
                                            echo "Replay";
                                        }else{
                                            echo "Messege";
                                        }
                                        ?>
                                        </b>
                                        <span class="action"> </span>
                                        <p class="username">
                                            <?php
                                            $rp= $r['msg'];
                                            if(empty($rp)){
                                                echo "No Replay !";
                                            }else{
                                               echo $rp;
                                            }
                                            ?></p>
                                </div>
                             </div>

                             <?php
                            $img=$r['img'];
                            if(!empty($img)){
                                echo '<img src="'. $img.'" alt="" style="max-width: 350px;" height="333px">';

                            } 
                        }?>


        <br /> <br />
        <?php   if($colse==0){ ?>
        <div class="dashboard_content">
                    <div class="dc_box">
                        <div class="dc_box_header">
                            <div class="dc_box_container">
                                <h6>
                                    <span class="text"> Replay </span>
                                </h6>
                                <p><?=  $err ?></p>
                            </div>
                        </div>
                        <form class="dc_box_container" action="" method="post" enctype="multipart/form-data">                           

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

            <?php } ?>







                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include"common/footer.php"; ?>