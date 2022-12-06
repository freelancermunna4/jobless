<?php
	require_once"common/sidebar.php";
    if($ses_id){$uid=$data['id'];}
    if(isset($_GET['id'])&&is_numeric($_GET['id'])){
        $yid=$_GET['id'];
    }else{
        $start=0;
    }



?>

<!--===== main page content =====-->
<?php
$video=_getData($db,"SELECT * FROM `vad_videos` WHERE id=$yid");
$key = $video['time']+time();
	$db->Query("INSERT INTO `vad_videos_session` (`user_id`,`video_id`,`ses_key`,`time`)VALUES('".$data['id']."','".$video['id']."','".$key."','".time()."') ON DUPLICATE KEY UPDATE `ses_key`='".$key."'");
?>
<div class="content">
    <div class="container">
        <div class="page_content">
            <div class="cf_wrapper" style="max-width: fit-content">
                <h6 class="text-primary">Watch Video</h6>
                <div class="watch-video">
                    <p class="watch-title">
                        <span><i class="fa-solid fa-play"></i></span>
                        <?php echo $video['title'] ?>
                    </p>
                    <p id="error"> &nbsp;

                    </p>

                    <p class="duration-title">
                        Must play this video for <b><span id="played">0</span>/<?php echo $video['tim'] ?> seconds</b>
                    </p>
                    <div id="ytPlayer">You need Flash player 8+ and JavaScript enabled to view this video.</div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://www.youtube.com/iframe_api"></script>
    <script type="text/javascript">
    var token = '<?= $key ?>';
    var playing = false;
    var fullyPlayed = false;
    var interval = '';
    var played = 0;
    var length = '<?= $video['tim']?>';
    var response = '<?= $video['id']?>';
    var player, playing = false;

    function onYouTubeIframeAPIReady() {
        player = new YT.Player('ytPlayer', {
            width: '95%',
            videoId: '<?=$video['video_id']?>',
            events: {
                'onStateChange': onYouTubePlayerStateChange
            }
        });
    }

    function YouTubePlaying() {
        played += 0.1;
        roundedPlayed = Math.ceil(played);
        var a = document.getElementById("played").innerHTML = Math.min(roundedPlayed, length);
        console.log(a);
        if (roundedPlayed == length) {
            if (fullyPlayed == false) {
                YouTubePlayed();
                fullyPlayed = true
            }
        }
    }

    function YouTubePlayed() {
        $.ajax({
            type: "POST",
            url: "system/ajax",
            data: "data=" + response + "&token=" + token,
            success: function(a) {
                popup_message(a, "error");

                if (a.trim() == "Success") {
                    popup_message(a, "success");
                    setTimeout(alertFunc, 1000);

                    function alertFunc() {
                        window.location.href = 'youtube-views';

                    }

                } else {
                    $('#error').html(a);
                }

                // $('#countdown').html(
                //     '<a href="?page=videos" style="font-weight:600;color:red"><b></b></a>'
                // );
            }
        })
    }

    function onYouTubePlayerReady(a) {
        ytplayer = document.getElementById("myytplayer");
        ytplayer.addEventListener("onStateChange", "onYouTubePlayerStateChange")
    }

    function onYouTubePlayerStateChange(a) {
        if (a.data == YT.PlayerState.PLAYING) {
            playing = true;
            interval = window.setInterval("YouTubePlaying()", 100)
        } else {
            if (playing) {
                window.clearInterval(interval)
            }
            playing = false
        }
    }
    </script>

    <?php include"common/footer.php"; ?>