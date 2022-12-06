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
            <div class="cf_wrapper">
                <h4>ADD VIDEO</h4>
                <p id="err" style="margin-left: 25px;color: #ff1477;text-align: center;"></p>
                <form action="" class="common_form">
                    <div class="form_item">
                        <label for="youtube_url">Youtube URL</label>
                        <input type="text" id="youtube_urls" placeholder="https://www.youtube.com/watch?v=RgzLnaCAU"
                            required /> 
                    </div>

                    <div class="form_item">
                        <label for="video_title">Video Title</label>
                        <input type="text" id="video_title" placeholder="Video title" />
                    </div>

                    <div class="form_item">
                        <label for="exposure">Exposure</label>
                        <select id="video_pac">
                            <?php
                                $getcoin=_getAllData($db,"SELECT * FROM `vad_packs` ORDER BY id ASC");
                                foreach($getcoin as $c){
                                    echo '<option value="'.$c['id'].'">'.$c['name'].' ('.$c['time'].' Seconds)</option>';

                                }
                            ?>

                        </select>
                    </div>

                    <div class="form_item">
                        <label for="views">Views</label>
                        <input type="number" id="views" placeholder="200" required />
                    </div>

                    <div class="form_item">
                        <label for="daily_visit_limit">Daily Visits Limit</label>
                        <div class="input_select">
                            <input type="number" id="daily_visit_limit" placeholder="200" disabled />
                            <select id="daily_visit_limit_select">
                                <option value="Disabled">Disabled</option>
                                <option value="Enabled">Enabled</option>
                            </select>
                        </div>
                    </div>




                    <div class="full_col">
                        <button type="button" onclick="submitVideo()">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php include"common/footer.php"; ?>


    <script>
    function submitVideo() {
        var url = $('#youtube_urls').val();
        var title = $('#video_title').val();
        var pac = $('#video_pac').val();
        var views = $('#views').val();
        var daily_limit = $('#daily_visit_limit').val();
        var visit_limit = $('#daily_visit_limit_select').val();
        if (visit_limit != "Enabled") {
            daily_limit = 0;
        }

        $.ajax({
            type: "POST",
            url: "system/ajax",
            data: 'addvideo=' + "addvideo" + '&url=' + url + '&title=' + title + '&pac=' + pac + '&views=' +
                views +
                '&daily_limit=' + daily_limit,
            success: function(z) {
                if (z.trim() != "Success") {
                    $('#err').html(z);
                } else {
                    alert("Successfully Publish Your Video");
                    location.reload(true);
                }
                console.log(z);
            }
        })
    }
    </script>
