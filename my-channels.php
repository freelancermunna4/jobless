<?php
	require_once"common/sidebar.php";
    if(!$is_online){ header("Location: index");}
    if(isset($_GET['page'])&&is_numeric($_GET['page'])){
        $start=$_GET['page'];
    }else{
        $start=0;
    }
?>

<!--===== main page content =====-->
<div class="content">
    <div class="container">
        <div class="page_content">
        <div style="text-align: center;">
        <?php if(!empty($top_ad['code'])){  echo base64_decode($top_ad['code']);} ?>
        </div>
            <div class="table_wrapper">
                <div class="table">
                    <table>
                        <caption>
                            My Channels
                            <small>(Promoted Channels)</small>
                        </caption>
                        <thead>
                            <tr>
                                <th class="col">Poster</th>
                                <th class="col">Chennel</th>
                                <th class="col">Remaining Subscribe</th>
                                <th class="col">Received Subscribe</th>
                                <th class="col">Todays Subscribe</th>
                                <th class="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $uid=$data['id'];
                            $start_page=$start*10;
                            $c_web=_getAllData($db,"SELECT * FROM `youtube_subscribe` WHERE user_id=$uid ORDER BY id DESC LIMIT $start_page,10");
                            foreach ($c_web as $web) {
                            ?>
                            <tr>
                                <td class="channel-logo">
                                    <img src="<?= $web['image_link']  ?>" alt="" />
                                </td>
                                <td>
                                    <p><?= $web['title']  ?></p>
                                </td>
                                <td><?= $web['click_need']  ?></td>
                                <td>
                                    <p><?= $web['clicks']  ?></p>
                                </td>
                                <td>
                                    <p><?= $web['today_clicks']  ?></p>
                                </td>
                                <td class="action">
                                    <div>
                                        <button onclick="AddFund(<?= $web['id']  ?>)" class="show_fsp" data-ref="add-subscribe">
                                            Add
                                        </button>
                                        <button onclick="deleteyt(<?= $web['id']  ?>)" class="show_fsp" data-ref="delete-confirm">
                                            Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
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
    </div>

    <script>
      function deleteyt(id){
                    console.log(id);
                    $.confirm({
                    title: 'ALERT!',
                    content: "If You Delete Chennel, You Can't Refund!",
                    buttons: {
                    confirm: function () {

                        $.ajax({
                                type: "POST",
                                url: "system/ajax",
                                data: 'delete=' + 1 + '&id=' + id,

                                success: function (z) {

                                    $.alert(z);
                                    location.reload(1);


                                }
                            })

                },
                cancel: function () {

                },

            }
        });
     }



    function AddFund(id){

    $.confirm({
        title: 'Prompt!',
        content: '' +
        '<form action="" class="formName">' +
        '<div class="form-group">' +
        '<label>Enter Amount here</label>' +
        '<input type="number" placeholder="Your name" class="name form-control" required />' +
        '</div>' +
        '</form>',
        buttons: {
            formSubmit: {
                text: 'Submit',
                btnClass: 'btn-blue',
                action: function () {
                    var name = this.$content.find('.name').val();
                    if(!name){
                        $.alert('provide a valid name');
                        return false;
                    }

                    $.ajax({
                                type: "POST",
                                url: "system/ajax",
                                data: 'addfund=' + name + '&id=' + id,

                                success: function (z) {

                                    $.alert(z);
                                    location.reload(1);


                                }
                            })


                }
            },
            cancel: function () {
                //close
            },
        },
        onContentReady: function () {
            // bind to events
            var jc = this;
            this.$content.find('form').on('submit', function (e) {
                // if the user submits the form by pressing enter in the field.
                e.preventDefault();
                jc.$$formSubmit.trigger('click'); // reference the button and click it
            });
        }
    });

    }


    </script>





    <?php include"common/footer.php"; ?>