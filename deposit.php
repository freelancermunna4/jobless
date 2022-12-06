<?php
	require_once"common/sidebar.php";

?>

<!--===== main page content =====-->
<div class="content">
    <div class="container">
        <form class="deposit">
            <h3>DEPOSIT <small style="color: #0898ff;"><small>(1 COIN = 1 BDT)</small></small>
                <br />
                <small><small><small>Advertise Fees <?php echo $config['DepositCommition'] ?> %</small></small></small>
            </h3>

            <div class="deposit_input">
                <label for="coins_amount">Coins Amount</label>
                <div class="input_wrapper">
                    <div class="icon">
                        <img src="https://cdn-icons-png.flaticon.com/512/1024/1024929.png" alt="" />
                    </div>
                    <input type="number" placeholder="100" id="coins_amount" required />
                </div>
            </div>

            <div class="deposit_input">
                <label>Payment Method</label>
                <div class="input_wrapper">
                    <select name="method" required id="select_payment_method" class="select">
                        <option id="0" selected disabled>Select</option>
                        <?php
                        $dpconig=_getAllData($db,"SELECT * FROM `deposit_config` WHERE activity=1 ORDER BY id ASC");
                        foreach($dpconig as $dp){

                        ?>

                        <option data-text=" <?= $dp['payment_discription'] ?>" id="<?= $dp['id'] ?>"
                            value="<?= $dp['accaunt'] ?>">
                            <?= $dp['name'] ?>
                        </option>

                        <?php } ?>



                    </select>
                </div>
            </div>



            <div class="wallet_details full_col" id="wallet_details">
                <p id="wallet_details_text"></p>
                <div class="copy_input">
                    <input id="wallet_value" disabled type="text" value="" />
                    <div class="copy_wrapper">
                        <button id="copy_wallet" class="copy_icon" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M7 9a2 2 0 012-2h6a2 2 0 012 2v6a2 2 0 01-2 2H9a2 2 0 01-2-2V9z" />
                                <path d="M5 3a2 2 0 00-2 2v6a2 2 0 002 2V5h8a2 2 0 00-2-2H5z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <div class="deposit_input full_col">
                <label id="deposit_wallet_label" for="wallet">Enter Your Wallet ID/Number/Email</label>
                <div class="input_wrapper">
                    <div class="icon">
                        <img src="https://cdn-icons-png.flaticon.com/512/679/679879.png" alt="" />
                    </div>
                    <input type="text" placeholder="Wallet" id="deposit_wallet_input" required />
                </div>
            </div>

            <div class="deposit_input full_col">
                <label for="trx">Transaction ID</label>
                <div class="input_wrapper">
                    <div class="icon">
                        <img src="https://cdn-icons-png.flaticon.com/512/1751/1751805.png" alt="" />
                    </div>
                    <input type="text" placeholder="Transaction ID" id="trx" required />
                </div>
            </div>

            <button onclick="deposit()" type="button">Request</button>
        </form>
    </div>











    <!--===== main page content =====-->
    <div class="content">
        <div class="container">
            <div class="page_content">
                <div class="cf_wrapper" style="padding: 0px">
                    <div class="table_wrapper">
                        <div class="table">
                            <table>
                                <caption>
                                    Deposit History
                                </caption>
                                <thead>
                                    <tr>
                                        <th class="col">Payment method</th>
                                        <th class="col">Payment Riciver</th>
                                        <th class="col">Amount</th>
                                        <th class="col">Transection id</th>
                                        <th class="col">Time</th>
                                        <th class="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                $uid=$data['id'];
                                $gt=_getAllData($db,"SELECT * FROM deposit WHERE user_id= $uid ORDER BY id DESC LIMIT 25");
                                foreach($gt as $d){
                                ?>


                                    <tr>
                                        <td>
                                            <p><?= $d['method'] ?></p>
                                        </td>
                                        <td>
                                            <p><?= $d['payment_info'] ?></p>
                                        </td>
                                        <td>
                                            <p><?= $d['coins'] ?></p>
                                        </td>
                                        <td>
                                            <p><?= $d['trx_id'] ?></p>
                                        </td>
                                        <td>
                                            <p><?= $d['tim'] ?></p>
                                        </td>
                                        <td>
                                            <p>
                                                <?php
                                        $st= $d['status'];
                                        if($st==1){
                                            echo "Success";
                                        }else if($st==2){
                                            echo "Reject";
                                        }else{
                                            echo "Pending";
                                        }


                                    ?>
                                            </p>
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
        function deposit() {
            var payId = $('#select_payment_method').children(":selected").attr('id');
            const coins_amount = $('#coins_amount').val();
            const deposit_wallet_input = $('#deposit_wallet_input').val();
            const trx = $('#trx').val();

            if (!coins_amount || coins_amount < 100) {
                simplealert("Please Enter minimum 100 Coins");
            } else if (payId == 0) {
                simplealert("Please Select Pament Option");
            } else if (!deposit_wallet_input) {
                simplealert("Please Enter Your Sender Mobile/ Email/ Bank Info");
            } else if (!trx) {
                simplealert("Please Enter Transection Id / Email/ Bank Info");
            } else {

                $.ajax({
                    type: "POST",
                    url: "system/ajax",
                    data: 'payId=' + payId + '&coins=' + coins_amount + '&wallet=' + deposit_wallet_input +
                        '&trx=' + trx,
                    success: function(z) {
                        if (z.trim() == "Success") {
                            simplealert(z);
                            setTimeout(function() {
                                location.reload(true);
                            }, 1000);
                        } else {
                            simplealert(z);
                        }



                    }
                })
            }



        }
        </script>





        <?php include"common/footer.php"; ?>