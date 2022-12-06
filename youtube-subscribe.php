<?php
	require_once"common/sidebar.php";
    if(isset($_GET['page'])&&is_numeric($_GET['page'])){
        $start=$_GET['page'];
    }else{
        $start=0;
    }
?>

<!--===== main page content =====-->
<div class="content">
    <div class="container">
    <div style="text-align: center;">
        <?php if(!empty($top_ad['code'])){  echo base64_decode($top_ad['code']);} ?>
        </div>
     <!-- Notification  -->
     <div class="notify_wrapper">
            <div class="notify_icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                width="24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                </svg>

            </div>

            <div class="notify_text">
                <small><?php
               $d=_getData($db,"SELECT * FROM `notice` WHERE name='subs'");
               echo $d['notice'];
                ?></small>
            </div>
            </div
    <br/><br/>
    <!-- Notification -->
    <div id="waitcontainer"style="display: none;">
  <p id="waiter" style="text-align: center;">Please Wait.....</p>
  <img src="assets/images/images.gif" alt="Joblessbd" style="display: block;margin-left: auto;margin-right: auto;width: 25%;" width="100px" height="80px">
     <br>
  </div>
        <div class="social_views">
        <?php
                        $total=0;
                        $uid=$data['id'];
                        $start_page=$start*10;
                        $c_web=_getAllData($db,"SELECT * FROM `youtube_subscribe`  ORDER BY id DESC LIMIT $start_page,25");

                        foreach ($c_web as $web) {
                            if($total>9){break; }
                            $idd=$web['youtube_link'];
                            $pac=_getData($db,"SELECT * FROM `youtube_sub_done` WHERE channel_id='$idd' AND user_id=$uid");

                            if($pac==0){
                         ?>


            <div class="view">
                <div class="view_container">
                    <div class="thumbnail">
                        <img src="<?= $web['image_link']?>"
                            alt="<?= $web['title']?>" />
                    </div>
                    <h6 class="title">
                    <?= $web['title']?>
                    </h6>
                    <div class="reward-badge">Earn Coins: <b><?= $web['point']?></b></div>
                    <div class="buttons">
                        <button href="javascript:void(0);" onclick="ModulePopup('<?php echo $web['id']; ?>','https://www.youtube.com/channel/<?php echo $web['youtube_link'];  ?>','Youtube','<?php echo $web['youtube_link'];  ?>');" style="background: #cc0000; text-transform: uppercase">
                            <b>Subscribe</b>
                        </button>
                        <button href="javascript:void(0);" onclick="skipuser('<?php echo $d;?>','<?php echo $web['youtube_link'];?>');" class="skip">Skip</button>
                    </div>
                </div>
            </div>



<?php
$total++;
} }?>

        </div>

        <br />
         <!-- Paginations -->
         <div class="paginations">
                <?php
                $Jb=_getAllData($db,"SELECT*  FROM youtube_subscribe WHERE user_id='$uid'");

                 $totalPage=ceil(count($Jb)/10);

                ?>
                <div class="badge">Page <?php echo  $start  ?> of <?php echo  $totalPage ?></div>
                <span class="paginaton-appender">
                    <?php ?>
                    <a href="?page=<?php if($start>0){ echo $start-1; }else{echo 0; } ?>">
                        <button>Previous</button></a>
                    <?php
                    for ($i=0; $i <=6 ; $i++) {
                        if($start<$totalPage-1){
                        $start++;
                        echo '<a href="?page='.$start.'"> <button>'.$start.'</button></a>';
                        }
                    } ?>


                    <a href="?page=<?php if($start<=$totalPage-1){ echo $start+1; }else{echo $totalPage-1; } ?>">
                        <button>Next</button></a>
                </span>
                <!-- Paginations -->
        </div>
        <br />
        <br />
    </div>

    <script>
        var start_click = 1;
	var end_click = <?=count($sites)?>;

function click_refresh() {
    if (start_click < end_click) {
        start_click = start_click + 1
    } else {
        location.reload(true)
    }
}
var targetWin;

function getRandomPosition(a, b) {
    return parseFloat(Math.random() * (b - a) + a).toFixed(2)
}
    function ModulePopup(a, b, c,d) {
    if (!targetWin || targetWin.closed) {
		var subscribe=0;
        $('#waitcontainer').show();
        $("#waiter").html('Please Wait...');
        var f = (screen.width / 1.9) - (screen.width / getRandomPosition(3, 4));
        var g = (screen.height / 1.9) - (screen.height / getRandomPosition(3, 4));
			var csub=a;
			var i=1;
			$.ajax({
					type: "POST",
					url: "system/ajax",
					data : 'csub='+csub+'&i='+i,
					success: function(z) {
						if(z !="privet"){
							subscribe=z;
							}else{
								subscribe=0;
							}
						console.log(subscribe);
					}


				});

        targetWin = window.open(b, c, "toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, copyhistory=no, width=" + screen.width / 1.9 + ", height=" + screen.height / 1.9 + ", top=" + g + ", left=" + f)
		var pollTimer = window.setInterval(function() {
        if (targetWin.closed !== false) {

            window.clearInterval(pollTimer);
            setTimeout(function () {
				catchsubscribe(a,subscribe,d);
            }, 1000);

        }



    }, 200);

	}
}
/**22222222222222 */

function catchsubscribe(a,b,d){
 $("#waiter").html('Please Wait Maximum..25 seconds');
var request=25;
var subscibecount=0;
 var intervalId = window.setInterval(function(){
  if(request>0){
            if(subscibecount<=b){
                var get=a;
				var pid=b;
				var cid=d;
				$.ajax({
					type: "POST",
					url: "system/ajax",
					data : 'get='+get+'&pid='+pid+'&cid='+cid,
					success: function(z) {
                        subscibecount=z;
                        if(z===1){

                            clearInterval(intervalId);


                        }else{

                           request=request-5;
                           $("#waiter").html('Please Wait Maximum..'+request+' seconds');

                        }


					}

			});
          }else{
              $('#waitcontainer').hide();
              clearInterval(intervalId);
              popup_message("Subscribe", "error");
               setTimeout(function () {
								click_refresh();
							}, 1000);
          }

    }
     else{
          $('#waitcontainer').hide();
          clearInterval(intervalId);
          popup_message("Not Subscribe!", "error");
          setTimeout(function () {
								click_refresh();
							}, 1000);

     }

}, 5000);

}





function skipuser(b,c) {

	var ii=c;
	var tt="skip";
    $.ajax({
        type: "POST",
        url: "system/ajax",
		data : 'ii='+ii+'&tt='+tt,
        success: function(a) {
            $("#Hint").html(a);

            click_refresh()
        }
    })
}




    </script>





    <?php include"common/footer.php"; ?>