<?php
	require_once"common/sidebar.php";
    if(!$is_online){ header("Location: index");}
    $uid=$data['id'];

?>

<!--===== main page content =====-->
<div class="content">
    <div class="container">
        <div class="page_content">
        <div style="text-align: center;">
        <?php if(!empty($top_ad['code'])){  echo base64_decode($top_ad['code']);} ?>
        </div>
            <div class="cf_wrapper">
                <h4 style="text-align: center;border-bottom: 2px dotted;margin-bottom: 5px;">ADD WEBSITE</h4>
                <p class="err" style="margin-left: 25px;color: #ff1477;text-align: center;"></p>
                <form class="common_form reset_form">
                    <div class="form_item">
                        <label for="website_url">Website URL</label>
                        <input type="text" id="you_url" maxlength="500" placeholder="https://example.com" required />
                    </div>

                    <div class="form_item">
                        <label for="website_title">Website Title</label>
                        <input required type="text" id="title" maxlength="50" placeholder="Website title" />
                    </div>

                    <div class="form_item">
                        <label for="exposure">Exposure</label>
                        <select required id="ad_pack" name="timer" onchange="get_price(this.value)">
                            <?php
                            $web_pac=_getAllData($db,"SELECT * FROM `web_surfing_pckks` ORDER BY id ASC");
                            foreach ($web_pac as $pac) { ?>

                            <option value="<?php echo $pac['id'] ?>"><?php echo $pac['name'] ?> -
                                <?php echo $pac['coins'] ?> Coin (<?php echo $pac['time'] ?> Seconds)</option>


                            <?php } ?>
                        </select>
                    </div>

                    <div class="form_item">
                        <label for="views">Views(minimum 100 Coins)</label>
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

    <script type="text/javascript">
    $('#progressdiv').hide();
    $(document).on('click', '#btn_Submit', () => {


        var err = $('.err');
        var daily_visit_limit = "0";
        let url = $('#you_url').val();
        let title = $('#title').val();
        let timer = $('#ad_pack').val();
        var views = $('#ad_visits').val();
        err.html("");
        $('#btn_Submit').hide();

        if ($('#daily_visit_limit_select').val() != 'disabled' && ($('#daily_visit_limit').val() != "")) {
            daily_visit_limit = $('#daily_visit_limit').val();
        }

        if (!url) {
            err.html("Please Inpute Website Url !");

        } else if (!title) {
            err.html("Please Inpute Website Title !");
        } else if (!views || views < 100) {
            err.html("Minimum 100 Visitor Need !");
        } else {


            $.ajax({
                type: "POST",
                url: "system/ajax",
                data: 'url=' + url + '&title=' + title + '&timer=' + timer + '&views=' + views +
                    '&daily_visit_limit=' + daily_visit_limit,

                success: function(z) {
                    $('#btn_Submit').show();
                    err.html(z);
                    setTimeout(function() {
                        if (err.html().trim() == "Successfully Publish Your Website") {
                            location.reload(true)
                        }
                    }, 500);






                }

            })
        }




    })

    $(document).on('blur', '#ad_visits', function() {
        var value = $(this).val();
        if (!value) return;
        value = Math.floor(value);
        $(this).val(value);
        get_price();

    });


    $(document).on('blur', '#daily_visit_limit', function() {
        var value = $(this).val();
        if (!value) return;
        value = Math.floor(value);
        $(this).val(value);
        get_price();

    });


    function get_price() {
        var clicks = $('#ad_visits').val();
        var pack = $('#ad_pack').val();

        if (pack > 0 && clicks > 0) {

            $.ajax({
                type: "POST",
                url: "system/ajax",
                data: 'ad_pack=' + pack + '&visits=' + clicks,

                success: function(price) {

                    $('#price_block').html(
                        '<p for="daily_visit_limit" style="color: #1c00dd;margin-bottom: 10px;">This website ad will cost you <strong><span class="total">' +
                        price +
                        '</span></strong> coins</p><button id="btn_Submit" type="button">Submit</button>'
                    );

                }

            })


        }
    }
    </script>







    <?php include"common/footer.php"; ?>