<?php
require_once"system/functions.php";  
if(!$is_online){ header("Location: index");}   
	
	if(isset($_GET['num']) && is_numeric($_GET['num'])&&isset($_GET['Rand']) && is_numeric($_GET['Rand']))
	{
		
		$num = $db->EscapeString($_GET['num']);
    
		$ad_pack =_getData($db,"SELECT * FROM `web_surfing` WHERE id=$num");
    
		if($ad_pack){
			$webid=$ad_pack['id'];
			$uid=$data['id'];			
			$dummy = _getData($db,"SELECT * FROM `dummy_websurf` WHERE web_id=$num AND user_id=$uid");			

            $Webinfo= _getData($db,"SELECT * FROM `web_surfing` WHERE id=$webid");
			$url=$Webinfo['web_link'];
			$title=$Webinfo['title'];
			$point=$Webinfo['point'];
			$cid=$Webinfo['user_id'];
     
    }

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>JoblessBD - Earn money with easy tasks</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="HandheldFriendly" content="true" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/favicon.ico" type="image/x-icon" />

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Merienda:wght@400;700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Oswald:wght@200;300;400;500;600;700&display=swap"
        rel="stylesheet" />

    <!-- FONT-AWESOME -->
    <script src="https://kit.fontawesome.com/6788eb3be6.js" crossorigin="anonymous"></script>

    <!-- BEGIN CSS STYLES -->
    <link rel="stylesheet" href="assets/css/style.css" type="text/css" media="all" />
    <!-- END CSS STYLES -->
</head>

<style>
.webview_header_right {
    height: 100%;
    display: flex;
    align-items: center;
    color: #ff7c87;
    max-width: 600px;

}

.webview_header_left {
    display: flex;
    flex-direction: column;
    gap: 1.4px 0;
    justify-content: flex-start;
}

.webview_header_title {
    font-size: 18px;
    font-weight: 500;
}

.webview_header_report {
    background: #c90000;
    color: #fff;
    font-size: 12px;
    padding: 3px 6px;
    border-radius: 3px;
    width: fit-content;
}
</style>

<body style="min-width:100%">


    <!-- Header -->
    <header class="header" style="height:90px; position: fixed;z-index: 9999 !important;">
        <div class="container">
            <div class="header_left">
                <a href="index.html" class="logo">
                    <img src="assets/icons/working.png" alt="" />
                    <span><?php echo $config['site_name'] ?></span>
                </a>

                <div class="webview_header_left">
                    <h6 class="webview_header_title" style="margin:0px;line-height:9px;">
                        <?php echo $title ?>
                    </h6>
                    <p style="color:#008a45; margin:0px;padding:0px;">You got <?php echo $point ?> points / <span
                            class="timer">00</span> </p>

                    <button class="webview_header_report" onclick="report()">Report site</button>
                </div>
            </div>

            <div class="webview_header_right">JoblessBD will never ask you for your password.
                We also do not SELL or GIVE FREE Points through the websites section.</div>
        </div>
    </header>
    <div style="height:90px"></div>
    <div>

        <div id="webloader">
            <div id="webloaderfinal">
                <?php 
             if($Webinfo){	
                  $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, $url);
                        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        $response = curl_exec($ch);
                        $request= curl_getinfo($ch, CURLINFO_HTTP_CODE) . PHP_EOL; 
                        curl_close($ch);
                  
                
                }            
                echo  $response;
             ?>
            </div>
        </div>


    </div>



</body>

</html>

<script type="text/javascript">
function Loder() {
    var e = "<?php echo $Webinfo['watch_time'];?>";
    $(".timer").html(e + " Second");
    var t = e,
        o = setInterval((function() {
            document.hasFocus() ? (console.log(t--), $(".timer").html(t + " Second")) : $(".timer").html(
                " Focus this page......"), t < 1 && (clearInterval(o), $(".timer").html(
                " <b>SUCCESS:</b> Now You Can Close the Tab"), finishLoad())
        }), 1e3)
}

function finishLoad() {
    $.ajax({
        type: "POST",
        url: "system/ajax",
        data: "id=<?php echo $dummy['id'];?>&hash=<?php echo $dummy['hash'];?>",
        success: function(e) {
            console.log(e)
        }
    })
}
$("#webloader").ready((function() {
    $(".timer").html("Wating....")
})), $("#webloaderfinal").ready((function() {
    $(this).text("Wating...").delay(2e3).queue((function() {
        Loder()
    }))
}));
var webid = 0;

function report() {
    $("#reportPage").css("display", "flex")
}

function reportdone(e, t) {
    var o = $("#report").val(),
        a = $("#err");
    e ? o.length < 1 ? a.html("Write Something About Report") : $.ajax({
        type: "POST",
        url: "system/ajax",
        data: "repo=repo&id=" + e + "&msg=" + o + "&wid=" + t,
        success: function(e) {
            window.close()
        }
    }) : a.html("Something Error")
}
</script>
<?php  } ?>

<!-- Login Popup -->
<div class="full_screen_popup" id="reportPage" data-ref="login">
    <div class="fsp_overlay"></div>
    <div class="fsp_content">
        <div>
            <label for="password" id="err"><small>Type About Repot This Page</small></label>
            <div class="base_input_icon">
                <textarea id="report" style="width: 100% !important;height: 250px;"></textarea>
            </div>
        </div>

        <button class="base_btn reportButton" onclick="reportdone(<?php echo $num; ?>,<?php echo $cid; ?>)"
            style="margin-left: auto;">Submit Report</button>
    </div>
</div>