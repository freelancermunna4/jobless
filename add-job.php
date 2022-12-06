<?php
	require_once"common/sidebar.php";
    if(!$is_online){ header("Location: index");}
    $err="";
    if(isset($_SESSION['err'])){$err=$_SESSION['err'];unset($_SESSION['err']);}
    $job_title="";
    $job_url="";
    $coin_per_job="";
    $visitor_per_job="";
    $contact_info="";
    $job_discription="";
    if(isset($_POST['jobsubmit'])){
        $job_title=$db->EscapeString($_POST['job_title']);
        $job_url=$db->EscapeString($_POST['job_url']);
        $coin_per_job=$db->EscapeString($_POST['coin_per_job']);
        $visitor_per_job=$db->EscapeString($_POST['visitor_per_job']);
        $contact_info=$db->EscapeString($_POST['contact_info']);
        $job_discription=$db->EscapeString($_POST['job_discription']);

        if(empty($job_title)){$err="Please Entere Title";}
        else if(empty($job_url)|| !filter_var($job_url, FILTER_VALIDATE_URL)){$err="Please Entere Correct Url";}
        else if(empty($coin_per_job)|| !is_numeric($coin_per_job)){$err="Please Entere Your Price";}
        else if($coin_per_job < 10){$err="Minimum 10 Coin Need Per Job";}
        else if(empty($visitor_per_job)|| !is_numeric($visitor_per_job)){$err="Please Entere Hoe many Visitor Need";}
        else if($visitor_per_job < 5){$err="Minimum 5 Visitor Need";}
        else if(empty($contact_info)){$err="Please Entere Your Contact Number";}
        else if(empty($job_discription)){$err="Please Entere Job Discription";}
        else{
            $totalCoinNeed=$coin_per_job*$visitor_per_job;
            $userid=$data['id'];
            $u_name=$data['fullname'];
            $usercoin=$data['coins'];
            $tim=time();
            if($totalCoinNeed > $usercoin){$err= "Not Enough Coins";}
            else{
                $finalcoin=$usercoin-$totalCoinNeed;
                $submitjob=_insertData($db,"INSERT INTO `job_system`(`uid`, `job_title`, `amount`, `clickneed`, `work_discription`, `web_link`,  `activity`,`contact`)VALUES ('$userid','$job_title','$coin_per_job','$visitor_per_job','$job_discription','$job_url','1','$contact_info')");
                if($submitjob){
                    $submitjob=_insertData($db,"UPDATE `users` SET `coins`='$finalcoin' WHERE id=$userid");
                    $j_update=_insertData($db,"INSERT INTO `activity`(`my_id`, `my_name`, `clint_id`, `clint_name`, `middle_name`, `last_name`, `image`,`tim`)
                    VALUES ('$userid','$u_name','$userid','Your','Succesfully Publish','Jobs','assets/icons/work.svg','$tim')");

                    $_SESSION['err']="Successfully Publish Your Job ";
                    header('location:add-job');
                    die();


                }else{
                    $err="ERROR: Something Wrong";
                }
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
            <div class="cf_wrapper">
                <h4 style="text-align: center;border-bottom: 2px dotted;margin-bottom: 5px;">ADD JOB</h4>
                <p style="margin-left: 25px;color: #ff1477;text-align: center;"> <?php echo $err; ?> </p>
                <form action="" class="common_form" method="post">
                    <div class="form_item">
                        <label for="job_title">Job Title</label>
                        <input type="text" name="job_title" value="<?php echo  $job_title; ?>" id="job_title"
                            placeholder="Job Title ... " required />
                    </div>
                    <div class="form_item">
                        <label for="job_url">Job URL</label>
                        <input type="url" name="job_url" value="<?php echo  $job_url; ?>" id="job_url"
                            placeholder="https://domain.com" required />
                    </div>

                    <div class="form_item">
                        <label for="coin_per_job">Enter Your Price <small>(Coin per Job, Minimum 10 Coin)</small>
                        </label>
                        <input type="number" name="coin_per_job" value="<?php echo  $coin_per_job; ?>" id="coin_per_job"
                            placeholder="200" required />
                    </div>

                    <div class="form_item">
                        <label for="visitor_per_job">Total Visitor <small>(Minimum 5)</small>
                        </label>
                        <input type="number" name="visitor_per_job" value="<?php echo  $visitor_per_job; ?>"
                            id="visitor_per_job" placeholder="100" required />
                    </div>

                    <div class="form_item full_col">
                        <label for="contact_info">Contact Info</label>
                        <input type="text" name="contact_info" value="<?php echo  $contact_info; ?>" id="contact_info"
                            placeholder="Number/Email" required />
                    </div>

                    <div class="form_item full_col">
                        <label for="des">Enter Your Job Discription</label>
                        <textarea id="des" name="job_discription" placeholder="Job Description..."
                            required><?php echo  $job_discription; ?></textarea>
                    </div>

                    <div class="full_col">
                        <button type="submit" name="jobsubmit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include"common/footer.php"; ?>