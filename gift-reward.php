<?php
	require_once"common/sidebar.php";
    $lottinfo=_getData($db,"SELECT * FROM `tottery` WHERE id=1") ;
    $uid=$data['id'];
?>

<!--===== main page content =====-->
<div class="content">
    <div class="container">
    <div class="page_content">
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
               $d=_getData($db,"SELECT * FROM `notice` WHERE name='reword'");
               echo $d['notice'];
                ?></small>
            </div>
            </div
    <br/><br/>
    <!-- Notification -->

            <div class="cf_wrapper" style="background: #fff">
                <div class="lottery">
                    <h6 class="title text-primary">Gift Reward</h6>
                    <br />


                        <div class="lottery_boxes">
                            <div class="lottery_box">
                                <div class="lottery_header">
                                    <p><?= $lottinfo['name'] ?></p>
                                    <div class="gift_icon">
                                        <i class="fa-solid fa-gifts"></i>
                                    </div>
                                </div>
                                <div class="lottery_img">
                                    <img src="assets/images/<?= $lottinfo['img'] ?>" alt="" />
                                </div>
                                <div class="lottery_footer">
                                    <span>Coins:</span> <b><?= $lottinfo['price'] ?></b>
                                </div>
                            </div>
                        </div>


                    <br />
                    <div class="lottery_timer">

                <!-- timer start -->
					<div class="container containertimercard">
					<div class="container-segment">
						<div class="segment">
							<div class="flip-card" data-days-tens>
							<div class="top">0</div>
							<div class="bottom">0</div>
							</div>
							<div class="flip-card" data-days-ones>
							<div class="top">0</div>
							<div class="bottom">0</div>
							</div>
						</div>
						<div class="segment-title">Days</div>
						</div>

						<div class="container-segment">
						<div class="segment">
							<div class="flip-card" data-hours-tens>
							<div class="top">0</div>
							<div class="bottom">0</div>
							</div>
							<div class="flip-card" data-hours-ones>
							<div class="top">0</div>
							<div class="bottom">0</div>
							</div>
						</div>
						<div class="segment-title">Hours</div>
						</div>
						<div class="container-segment">

						<div class="segment">
							<div class="flip-card" data-minutes-tens>
							<div class="top">0</div>
							<div class="bottom">0</div>
							</div>
							<div class="flip-card" data-minutes-ones>
							<div class="top">0</div>
							<div class="bottom">0</div>
							</div>
						</div>
						<div class="segment-title">Minutes</div>
						</div>
						<div class="container-segment">
						<div class="segment">
							<div class="flip-card" data-seconds-tens>
							<div class="top">0</div>
							<div class="bottom">0</div>
							</div>
							<div class="flip-card" data-seconds-ones>
							<div class="top">0</div>
							<div class="bottom">0</div>
							</div>

						</div>
						<div class="segment-title">Seconds</div>
						</div>

					</div>
					<br>
					<!-- end timer-->
                    </div>
                    <br />
                    <div class="lottery_tickets">
                        <div>
                            <div class="badge">Total Sold Tickets</div>
                            <div class="info">
                                <span>
                                    <i class="fa-solid fa-ticket"></i>
                                </span>
                                <span><?php
                                $sell= _getAllData($db,"SELECT * FROM `lottarybuy` ORDER BY id ASC");
                                if($sell==0){
                                    echo 0;
                                }else{
                                    $cn=count($sell);
                                    $percent=($cn/100)*$config['lotteryProfit'];
                                    echo $npercent=$cn-$percent;
                                }
                                ?>
                                 Tickets</span>
                            </div>
                        </div>
                        <div>
                            <div class="badge">You Sold Tickets</div>
                            <div class="info">
                                <i class="fa-solid fa-ticket"></i>
                                <?php
                                $msell= _getAllData($db,"SELECT * FROM `lottarybuy` WHERE usr_id='$uid' ORDER BY id ASC");
                                if($msell==0){
                                    echo 0;
                                }else{
                                    echo count($msell);
                                }
                                ?>
                                Tickets
                            </div>
                        </div>
                    </div>
                    <br />
                    <br />
                    <div class="button show_fsp" data-ref="buy-ticket">
                        <button class="btnbuy">Buy a tickets (<?= $lottinfo['lprice'] ?> Coins)</button>
                    </div>
                </div>
            </div>
            <p id="demo"></p>
            <div class="cf_wrapper" style="background: #fff">
            <div class="table_wrapper">
                    <div class="table">
                        <table>
                            <caption>
                                Lucky Winners
                            </caption>
                            <thead>
                                <tr>
                                    <th class="col">User Name</th>
                                    <th class="col">Price Name</th>
                                    <th class="col">Price Lottery</th>
                                    <th class="col">Number</th>
                                    <th class="col">Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $winner=_getAllData($db,"SELECT * FROM `lotterywinner` WHERE ativity=1 ORDER BY id DESC LIMIT 3");
                                foreach($winner as $wn){ ?>
                                <tr>
                                    <td>
                                        <p><?= $wn['uname'] ?></p>
                                    </td>
                                    <td>
                                        <p><?= $wn['pricename'] ?></p>
                                    </td>
                                    <td>
                                        <p><?= $wn['price'] ?></p>
                                    </td>
                                    <td>
                                        <p><?= $wn['number'] ?></p>
                                    </td>
                                    <td>
                                        <p><?= date('d-m-Y',$wn['time']) ?></p>
                                    </td>
                                </tr>
                               <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <br />
                <br />
                <div class="table_wrapper">
                    <div class="table">
                        <table>
                            <caption>
                                My Lottery
                            </caption>
                            <thead>
                                <tr>

                                    <th class="col">Number</th>
                                    <th class="col">Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach($msell as $m){?>

                                <tr>
                                    <td>
                                        <p><?= $m['number'] ?></p>
                                    </td>
                                    <td>
                                        <p><?= date('d-m-Y',$m['time']) ?></p>
                                    </td>
                                </tr>

                                <?php } ?>


                            </tbody>
                        </table>
                    </div>
                </div>


            </div>
        </div>
    </div>


<script>
// timer   sss

var winnerss=false;
var winner="";

const countToDate =<?php echo $lottinfo['wintime']; ?>;
let previousTimeBetweenDates;
let tempdate=<?php echo time(); ?>;
var currentDate =<?php echo time(); ?>;
setInterval(() => {

  currentDate++;
  const timeBetweenDates = Math.ceil((countToDate - currentDate));
  if (timeBetweenDates>-1) {

	flipAllCards(timeBetweenDates)
  previousTimeBetweenDates = timeBetweenDates
  }else{
		winnerss=true;
  }

}, 1000)

function flipAllCards(time) {
  const seconds = time % 60
  const minutes = Math.floor(time / 60) % 60
  const hours = Math.floor(time / 3600)%24
  const days = Math.floor(time / 86400)

  flip(document.querySelector("[data-days-tens]"), Math.floor(days / 10))
  flip(document.querySelector("[data-days-ones]"), days % 10)
  flip(document.querySelector("[data-hours-tens]"), Math.floor(hours / 10))
  flip(document.querySelector("[data-hours-ones]"), hours % 10)
  flip(document.querySelector("[data-minutes-tens]"), Math.floor(minutes / 10))
  flip(document.querySelector("[data-minutes-ones]"), minutes % 10)
  flip(document.querySelector("[data-seconds-tens]"), Math.floor(seconds / 10))
  flip(document.querySelector("[data-seconds-ones]"), seconds % 10)
}

function flip(flipCard, newNumber) {
  const topHalf = flipCard.querySelector(".top")
  const startNumber = parseInt(topHalf.textContent)
  if (newNumber === startNumber) return

  const bottomHalf = flipCard.querySelector(".bottom")
  const topFlip = document.createElement("div")
  topFlip.classList.add("top-flip")
  const bottomFlip = document.createElement("div")
  bottomFlip.classList.add("bottom-flip")

  top.textContent = startNumber
  bottomHalf.textContent = startNumber
  topFlip.textContent = startNumber
  bottomFlip.textContent = newNumber

  topFlip.addEventListener("animationstart", e => {
    topHalf.textContent = newNumber
  })
  topFlip.addEventListener("animationend", e => {
    topFlip.remove()
  })
  bottomFlip.addEventListener("animationend", e => {
    bottomHalf.textContent = newNumber
    bottomFlip.remove()
  })
  flipCard.append(topFlip, bottomFlip)
}




setInterval(() => {

	if(winnerss){
        if(winner.length === 0){
            $('.lottery_timer').html('<p style="text-align: center;font-size: 25px;background: #0ae1eca1;">Waiting For Winner</p>');
        }else{
            $('.lottery_timer').html('<p style="text-align: center;font-size: 25px;background: #0ae1eca1;">Winner Number is:- '+winner+'</p>');
        }
		 getWinner();
	}


}, 1000)







$('.btnbuy').click(()=>{

  swal("Total Tiket:", {
  content: "input",
})
.then((value) => {
    $.ajax({
		type: "POST",
		url: "system/ajax",
		data : 'buy='+'ok'+'&ticket='+value,
		success: function(z) {
                if(z.trim()=="success"){
                    popup_message("You Successfully Buy Tikets!!", "success");
                    setTimeout(function () {
                        location.reload(true);
					}, 1000);

                }else{
                    popup_message(z, "success");

                }

            }
		});
});

});


function getWinner(){
    $.ajax({
		type: "POST",
		url: "system/ajax",
		data : 'getWinner='+'ok',
		success: function(z) {
                if(z.trim()!="empty"){
                    winner=z.trim();
                }

            }
		});

}




</script>










    <?php include"common/footer.php"; ?>