<?php
	require_once"common/sidebar.php";

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
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" width="24">
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
            </div <br /><br />
            <!-- Notification -->
            <div class="cf_wrapper" id="srcdiv">
                <p id="waiter" style="text-align: center;">Notice:- Sometime Remove Subscriber For Other Website, So be
                    Careful</p>
                <h4 style="text-align: center;">SEARCH YOUTUBE CHANNEL</h4>
                <p class="err1" style="margin-left: 25px;color: #ff1477;text-align: center;"></p>
                <form action="" class="common_form">
                    <div class="form_item">
                        <label for="youtube_url">Your Channel ID can be found here
                            <a target="_blank"
                                href="https://www.youtube.com/account_advanced">https://www.youtube.com/account_advanced</a>
                            Enter Your Channel ID</label>
                        <input type="text" id="youtube_url" placeholder="RRgzLnaCAU" required />
                    </div>

                    <div class="full_col">
                        <button onclick="getYoutubeInfo()" type="button">Submit</button>
                    </div>
                </form>
            </div>
            <div class="cf_wrapper" id="finaldiv" style="display: none;">
                <h4 id="cname" style="text-align: center;  color: #ee0a8a;margin-bottom: 5px;">ADD COINS
                    FOR
                    SUBSCRIBER
                </h4>
                <p class="err" style="margin-left: 25px;color: #ff1477;text-align: center;"></p>
                <form class="common_form reset_form">
                    <div class="form_item">
                        <label for="exposure">Exposure</label>
                        <select required id="ad_pack" name="timer" onchange="get_price(this.value)">
                            <?php
                            $web_pac=_getAllData($db,"SELECT * FROM `youtube_sub_packs` ORDER BY id ASC");
                            foreach ($web_pac as $pac) { ?>

                            <option value="<?php echo $pac['id'] ?>"><?php echo $pac['name'] ?> -
                                <?php echo $pac['coins'] ?> Coin (<?php echo $pac['time'] ?> Seconds)</option>


                            <?php } ?>
                        </select>
                    </div>

                    <div class="form_item">
                        <label for="views">Subscriber(minimum 100 Subscriber Need)</label>
                        <input type="number" name="views" id="ad_visits" placeholder="200" required
                            onkeyup="get_price(this.value)" />
                    </div>

                    <div class="form_item">
                        <label for="daily_visit_limit">Daily Visits Limit</label>
                        <div class="input_select">
                            <input type="number" id="daily_visit_limit" placeholder="200" disabled />
                            <select name="limit" id="daily_visit_limit_select">
                                <option value="disabled">Disabled</option>
                                <option value="enabled">Enabled</option>
                            </select>
                        </div>
                    </div>

                    <div class="full_col" id="price_block"> </div>

                </form>
            </div>
        </div>
    </div>

    <script>
    var tt = "",
        title = "",
        image = "";

    function get_price() {
        var t = $("#ad_visits").val(),
            i = $("#ad_pack").val();
        i > 0 && t > 0 && $.ajax({
            type: "POST",
            url: "system/ajax",
            data: "ad_pack_yt=" + i + "&visits=" + t,
            success: function(t) {
                $("#price_block").html(
                    '<p for="daily_visit_limit" style="color: #1c00dd;margin-bottom: 10px;">This website ad will cost you <strong><span class="total">' +
                    t +
                    '</span></strong> coins</p><button id="btn_Submit" type="button">Submit</button>')
            }
        })
    }

    function getYoutubeInfo() {
        console.log("p"), tt = $("#youtube_url").val();
        $.ajax({
            type: "POST",
            url: "system/ajax",
            data: "getsubsInfo=" + tt + "&i1",
            success: function(t) {
                let i = JSON.parse(t);
                0 != i.type ? (title = i.name, image = i.img, $("#cname").html(i.name), $("#srcdiv").hide(),
                    $("#finaldiv").show()) : popup_message(i.msz, "error")
            }
        })
    }
    $(document).on("blur", "#ad_visits", (function() {
        var t = $(this).val();
        t && (t = Math.floor(t), $(this).val(t), get_price())
    })), $(document).on("blur", "#daily_visit_limit", (function() {
        var t = $(this).val();
        t && (t = Math.floor(t), $(this).val(t), get_price())
    })), $(document).on("click", "#btn_Submit", (() => {
        var t = $(".err"),
            i = "0";
        let a = $("#ad_pack").val();
        var e = $("#ad_visits").val();
        t.html(""), $("#btn_Submit").hide(), "disabled" != $("#daily_visit_limit_select").val() && "" != $(
                "#daily_visit_limit").val() && (i = $("#daily_visit_limit").val()), !e || e < 100 ?
            popup_message("Minimum 100 Subscriber Need !", "error") : $.ajax({
                type: "POST",
                url: "system/ajax",
                data: "url=" + tt + "&title=" + title + "&image=" + image + "&pac=" + a + "&views=" +
                    e + "&daily_visit_limit=" + i,
                success: function(t) {
                    let i = JSON.parse(t);
                    0 != i.type ? (popup_message(i.msz, "success"), setTimeout((function() {
                        location.reload(!0)
                    }), 500)) : popup_message(i.msz, "error")
                }
            })
    }));
    </script>
    <?php include"common/footer.php"; ?>