<?php
	require_once"common/sidebar.php";
    if(!$is_online){ header("Location: index");}
?>

<!--===== main page content =====-->
<div class="content">
    <div class="container">
        <div class="page_content">
            <div class="dashboard_layout">
                <?php require_once('common/profile_sidebar.php'); ?>

                <div class="dashboard_content">
                    <div class="dc_box">
                        <div class="dc_box_header">
                            <div class="dc_box_container">
                                <h6>
                                    <span class="icon">
                                        <i class="fa fa-support"></i>
                                    </span>
                                    <span class="text"> SUPPORT TICKETS </span>
                                </h6>

                                <a href="new-ticket">+ SUBMIT A TICKET</a>
                            </div>
                        </div>

                        <div class="dc_box_container">
                            <div class="table_wrapper">
                                <div class="table" style="width: 100%">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th class="col">Subject</th>
                                                <th class="col">Last update</th>
                                                <th class="col">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $uid=$data['id'];
                                            $mtiket=_getAllData($db,"SELECT * FROM `tiketsystem` WHERE uid=$uid ORDER BY id DESC LIMIT 25");
                                            foreach($mtiket as $m){ ?>

                                            <tr>
                                                <td>
                                                    </a><p><a href="wiew-tiket.php?id=<?= $m['id'] ?>" target="_blank"><?= $m['subject'] ?></a></p>
                                                </td>
                                                <td>
                                                    <p><?= date('d-m-Y',$m['time']) ?></p>
                                                </td>
                                                <td class="status">
                                                <?php 
                                                $status=$m['close'];
                                                $status2=$m['replymsg'];

                                                if($status==1){
                                                    echo '<p style="color: #ffb300;">Closed</p>';

                                                }else if($status2==1){
                                                    echo '<p>Replied</p>';

                                                }
                                                else{
                                                    echo '<p style="color: red">Pending</p>';
                                                }
                                                ?>
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
            </div>
        </div>
    </div>

    <?php include"common/footer.php"; ?>