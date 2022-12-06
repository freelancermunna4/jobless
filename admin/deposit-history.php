
<?php
  require_once"common/header.php";

?>
      <div class="x_container space-y-10 py-10">


        <div class="flex flex-col rounded-lg shadow-md border border-[
        ] shadow-gray-200 bg-white">
          <div class="overflow-x-auto rounded-lg">
            <div class="inline-block min-w-full align-middle">
              <div class="overflow-auto bg-white">
                   <div style="text-align: right;margin: 5px;padding-top: 10px;">
                        <input type="text" id="srcvalue" placeholder="Transaction ID / Mobile No"
                            style="padding: 8px;border: 1px solid;">
                        <button
                            style="padding: 10px 15px 10px 15px;margin-right: 12px;background: #0e33f78a;box-sizing: border-box;border-radius: 7px;"
                            onclick="getsearch()">Search</button>
                    </div>
                <!-- Table -->
                <table class="min-w-full divide-y divide-gray-200 table-fixed">
                  <thead class="bg-white">
                    <tr>
                      <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase lg:p-5"> User ID
                      </th>
                      <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase lg:p-5"> Username
                      </th>
                      <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase lg:p-5">
                        Transaction ID </th>
                      <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase lg:p-5"> Coin
                      </th>
                      <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase lg:p-5"> User Accaunt
                      </th>
                      <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase lg:p-5"> Admin Account
                      </th>
                      <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase lg:p-5"> Gateway
                      </th>
                      <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase lg:p-5"> Status
                      </th>
                      <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase lg:p-5"> Date
                      </th>

                      <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase lg:p-5"> Actions
                      </th>
                    </tr>
                  </thead>
                  <tbody class="bg-white divide-y divide-gray-200" id="addresult">

                  <?php
                  $deposit=_getAllData($db,"SELECT * FROM `deposit` WHERE status=2 ORDER BY id ASC LIMIT 50");
                  if($deposit !=0){
                    foreach($deposit as $d){?>

                      <tr class="hover:bg-gray-100">
                      <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap lg:p-5"> <?= $d['user_id'] ?> </td>
                      <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap lg:p-5">
                        <?php
                        $ui=$d['user_id'];
                        $uidd=_getData($db,"SELECT * FROM users WHERE id =$ui");
                       echo $uidd['fullname']; ?>
                        </td>
                      <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap lg:p-5">  <?= $d['trx_id'] ?> </td>
                      <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap lg:p-5"> <?= $d['coins'] ?> Coins </td>
                      <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap lg:p-5"> <?= $d['payment_info'] ?> </td>
                      <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap lg:p-5"> <?= $d['myId'] ?> </td>
                      <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap lg:p-5"> <?= $d['method'] ?> </td>
                      <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap lg:p-5"> Pending </td>
                      <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap lg:p-5">
                      <?php
                      $tim=$d['tim'];
                     echo  date("d-M-Y", $tim); ?> </td>
                      <td class="p-4 space-x-2 whitespace-nowrap lg:p-5">
                        <button data-target="approve_request" type="button"
                          class="popup_show btn bg-green-600 w-fit text-white" onclick="setid(<?= $d['id'] ?> )">Approve</button>
                        <button data-target="reject_request" type="button"
                          class="popup_show btn bg-red-500 w-fit text-white"onclick="setid2(<?= $d['id'] ?> )">Delete</button>
                      </td>



                  <?php } } ?>




                    </tr>
                  </tbody>
                </table>


              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- All Popup -->
  <!-- Approve Request -->
  <div data-target="approve_request"
    class="popup_wrapper overflow-y-auto overflow-x-hidden fixed right-0 left-0 top-4 z-50 justify-center items-center md:inset-0 sm:h-full flex"
    id="delete-product-modal" style="z-index: 111; display: none;">
    <div data-target="approve_request"
      class="popup_remove w-full h-screen bg-black bg-opacity-50 z-40 fixed inset-0 m-auto"></div>
    <div class="relative px-4 w-full max-w-md h-full md:h-auto z-50">
      <div class="relative bg-white rounded-2xl shadow-lg">
        <div class="flex justify-end p-2"><button type="button" data-target="approve_request"
            class="popup_remove text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-2xl text-sm w-8 h-8 flex items-center justify-center ml-auto"
            data-modal-toggle="delete-product-modal"> <i class="fa-solid fa-xmark"></i> </button></div>
        <div class="p-6 pt-0 text-center text-5xl text-green-600"> <i class="fa-solid fa-circle-exclamation"></i>
          <h3 class="my-9 text-base font-normal text-gray-500">Want to approve?
          </h3>
          <div class="w-full flex justify-between items-center gap-x-2"><a href="#" data-target="approve_request"
              class="popup_remove text-white bg-red-400 border border-gray-200 font-medium inline-flex items-center rounded-lg text-sm px-3 py-2.5 text-center hover:scale-[1.02] transition-transform"
              data-modal-toggle="delete-product-modal">No, cancel</a>

            <button
              class="disabled:opacity-70 disabled:cursor-not-allowed text-white bg-green-600 font-medium rounded-lg text-sm inline-flex items-center px-3 py-2.5 text-center mr-2 shadow-md shadow-gray-300 hover:scale-[1.02] transition-transform" id="dpaprove"><span>Yes,
                Approve</span></button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Reject Request -->
  <div data-target="reject_request"
    class="popup_wrapper overflow-y-auto overflow-x-hidden fixed right-0 left-0 top-4 z-50 justify-center items-center md:inset-0 sm:h-full flex"
    id="delete-product-modal2" style="z-index: 111; display: none;">
    <div data-target="reject_request"
      class="popup_remove w-full h-screen bg-black bg-opacity-50 z-40 fixed inset-0 m-auto"></div>
    <div class="relative px-4 w-full max-w-md h-full md:h-auto z-50">
      <div class="relative bg-white rounded-2xl shadow-lg">
        <div class="flex justify-end p-2"><button type="button" data-target="reject_request"
            class="popup_remove text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-2xl text-sm w-8 h-8 flex items-center justify-center ml-auto"
            data-modal-toggle="delete-product-modal2"> <i class="fa-solid fa-xmark"></i> </button></div>
        <div class="p-6 pt-0 text-center text-5xl text-red-500"> <i class="fa-solid fa-circle-exclamation"></i>
          <h3 class="my-9 text-base font-normal text-gray-500">Want to Delete?
          </h3>
          <div class="w-full flex justify-between items-center gap-x-2"><a href="#" data-target="reject_request"
              class="popup_remove text-white bg-red-400 border border-gray-200 font-medium inline-flex items-center rounded-lg text-sm px-3 py-2.5 text-center hover:scale-[1.02] transition-transform"
              data-modal-toggle="delete-product-modal2">No, cancel</a>

            <button
              class="disabled:opacity-70 disabled:cursor-not-allowed text-white bg-gradient-to-br from-red-600 to-red-500 font-medium rounded-lg text-sm inline-flex items-center px-3 py-2.5 text-center mr-2 shadow-md shadow-gray-300 hover:scale-[1.02] transition-transform" id="dpreject"><span>Yes,
                Delete</span></button>
          </div>
        </div>
      </div>
    </div>
  </div>



  <script src="js/app.js"></script>
  <script>
var idd=0;
function setid(data){
  idd=data;
  $('#delete-product-modal').show();
  
}
function setid2(data){
  idd=data;
  $('#delete-product-modal2').show();
  
}


// aproved
    $('#dpaprove').click(()=>{
      $('#dpaprove').hide();
      if(idd==0){
        simpleAlert("Something Wrong");
      }else{
          $.ajax({
              type: "POST",
              url: "common/ajax",
              data: 'aprove='+idd,
              success: function(z) {
                if(z.trim()=="success"){
                swal("Success!", "Successfully Approve", "success");
                location.reload(true);
                }
                else{
                  swal(z);
                  $('#dpaprove').show();
                }

              }
          })
      }
    })

    // reject
    $('#dpreject').click(()=>{
      $('#dpreject').hide();
      if(idd==0){
        simpleAlert("Something Wrong");
      }else{
          $.ajax({
              type: "POST",
              url: "common/ajax",
              data: 'dpreject_dlt='+idd,
              success: function(z) {
                if(z.trim()=="success"){
                swal("Success!", "Successfully Reject", "success");
                location.reload(true);
                }
                else{
                  swal(z);
                  $('#dpreject').show();
                }

              }
          })
      }
    })


    

function getsearch() {
    var keyword = $('#srcvalue').val().trim();
    if (keyword.length > 0) {
        $.ajax({
            type: "POST",
            url: "common/ajax",
            data: 'serch_deposit_history=' + keyword,
            success: function(z) {
                if (z.trim() != "0") {
                
                    $('#addresult').html(z);

                } else {
                    swal("Deposit Not Found !");

                }

            }
        })

    }
}





  </script>
</body>

</html>