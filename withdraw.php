<?php
	require_once"common/sidebar.php";
?>

<!--===== main page content =====-->
<div class="content">
    <div class="container">
        <form class="deposit">
            <h3>WITHDRAW MONEY<small style="color: #0898ff;"><small>(1 COIN = 1 BDT)</small></small>
            <br/>
            <small><small><small>Website Maintence Charge <?php echo $config['WithdrawCommition'] ?> %</small></small></small>
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
                    <select name="method" required id="withdraw_payment_method" class="select">
                    <option id="0" selected disabled>Select</option>

                    <?php
                        $dpconig=_getAllData($db,"SELECT * FROM `withdawl_config` ORDER BY id ASC");
                        foreach($dpconig as $dp){

                        ?>

                        <option data-text="<?= $dp['payment_discription'] ?>" id="<?= $dp['id'] ?>">
                        <?= $dp['name'] ?>
                        </option>
                      <?php } ?>

                    </select>
                </div>
            </div>

            <div class="deposit_input full_col">
                <label id="withdraw_wallet_label" for="withdraw_wallet">Enter Your Received Wallet Number</label>
                <div class="input_wrapper">
                    <div class="icon">
                        <img src="https://cdn-icons-png.flaticon.com/512/679/679879.png" alt="" />
                    </div>
                    <input type="text" placeholder="Wallet" id="withdraw_wallet" required />
                </div>
            </div>

            <div class="deposit_input full_col">
                <label for="phone">Enter Your Phone Number <small>(Optional)</small>
                </label>
                <div class="input_wrapper">
                    <div class="icon">
                        <img src="assets/images/phone.png" alt="" />
                    </div>
                    <input type="text" placeholder="Phone Number" id="phone" required />
                </div>
            </div>

            <button onclick="withdrow()" type="button">Request</button>
        </form>
    </div>






<!--===== main page content =====-->
<div class="content"style="margin-left: 85px;">
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
                                    <th class="col">Time</th>
                                    <th class="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $gt=_getAllData($db,"SELECT * FROM withdrawals ORDER BY id DESC LIMIT 25");
                                foreach($gt as $d){
                                ?>


                                <tr>
                                    <td><p><?= $d['method'] ?></p></td>
                                    <td><p><?= $d['payment_info'] ?></p></td>
                                    <td><p><?= $d['coins'] ?></p></td>
                                    <td><p><?= $d['tim'] ?></p></td>
                                    <td><p>
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
                                    </p></td>
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
        function withdrow(){
          var payId= $('#withdraw_payment_method').children(":selected").attr('id');
          const coins_amount=$('#coins_amount').val();
          const w_wallet_input=$('#withdraw_wallet').val();
          const phone=$('#phone').val();

           if(!coins_amount  ){
            simplealert("Please Enter Coins");
          }else if(payId==0){
            simplealert("Please Select Pament Option");
          }else if(!w_wallet_input){
            simplealert("Please Enter Your Sender Mobile/ Email/ Bank Info");
          }else{

                $.ajax({
                        type: "POST",
                        url: "system/ajax",
                        data : 'payId='+payId+'&coins_amount='+coins_amount+'&w_wallet_input='+w_wallet_input+'&phone='+phone,
                        success: function(z) {
                            if(z.trim()=="Success"){
                                simplealert(z);
                                setTimeout(function () {
								location.reload(true);
							    }, 1000);
                            }else{
                                simplealert(z);
                            }



                        }
                    })
          }



        }

    </script>







    <?php include"common/footer.php"; ?>