<?php
  require_once"common/header.php";
  ?>
      <div class="x_container space-y-10 py-10">


        <div class="flex flex-col rounded-lg shadow-md border border-[
    ] shadow-gray-200 bg-white">
          <div class="overflow-x-auto rounded-lg">
            <div class="inline-block min-w-full align-middle">
              <div class="overflow-auto bg-white">
                <!-- Table -->
                <table class="min-w-full divide-y divide-gray-200 table-fixed">
                  <thead class="bg-white">
                    <tr>
                      <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase lg:p-5"> Price Name
                      </th>
                      <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase lg:p-5"> Price
                      Value </th>
                      <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase lg:p-5">Tiket Price
                         </th>
                      <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase lg:p-5"> Time
                      </th>
                      <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase lg:p-5"> Actions
                      </th>
                    </tr>
                  </thead>
                  <tbody class="bg-white divide-y divide-gray-200">
                    <?php
                    $pr=_getData($db,"SELECT * FROM `tottery` WHERE id=1");
                    ?>
                    <tr class="hover:bg-gray-100">
                      <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap lg:p-5">
                        <?= $pr['name'] ?> </td>
                      <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap lg:p-5">
                      <?= $pr['price'] ?> </td>
                      <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap lg:p-5">
                      <?= $pr['lprice'] ?> </td>
                      <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap lg:p-5">
                      <?= date('d-m-Y',$pr['time']) ?> </td>
                      <td class="p-4 space-x-2 whitespace-nowrap lg:p-5">
                        <a href="add-new-lottery.php?ids=1" type="button"
                          class="popup_show btn bg-green-600 w-fit text-white">Edit</a>
                        <button data-target="delete_lottery" type="button"
                          class="popup_show btn bg-red-500 w-fit text-white">Delete</button>
                      </td>
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
  <!-- Delete Popup -->
  <div data-target="delete_lottery"
    class="popup_wrapper overflow-y-auto overflow-x-hidden fixed right-0 left-0 top-4 z-50 justify-center items-center md:inset-0 sm:h-full flex"
    id="delete-product-modal" style="z-index: 111; display: none;">
    <div data-target="delete_lottery"
      class="popup_remove w-full h-screen bg-black bg-opacity-50 z-40 fixed inset-0 m-auto"></div>
    <div class="relative px-4 w-full max-w-md h-full md:h-auto z-50">
      <div class="relative bg-white rounded-2xl shadow-lg">
        <div class="flex justify-end p-2"><button type="button" data-target="delete_lottery"
            class="popup_remove text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-2xl text-sm w-8 h-8 flex items-center justify-center ml-auto"
            data-modal-toggle="delete-product-modal"> <i class="fa-solid fa-xmark"></i> </button></div>
        <div class="p-6 pt-0 text-center text-5xl text-red-500"> <i class="fa-solid fa-circle-exclamation"></i>
          <h3 class="my-9 text-base font-normal text-gray-500">Want to Delete Lottery?
          </h3>

          <div class="w-full flex justify-between items-center gap-x-2"><a href="#" data-target="delete_lottery"
              class="popup_remove text-white bg-red-400 border border-gray-200 font-medium inline-flex items-center rounded-lg text-sm px-3 py-2.5 text-center hover:scale-[1.02] transition-transform"
              data-modal-toggle="delete-product-modal">No, cancel</a>

            <button id="dlt"
              class="disabled:opacity-70 disabled:cursor-not-allowed text-white bg-red-500 font-medium rounded-lg text-sm inline-flex items-center px-3 py-2.5 text-center mr-2 shadow-md shadow-gray-300 hover:scale-[1.02] transition-transform"><span>Yes,
                Delete</span></button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="js/app.js"></script>
  <script>
     $('#dlt').click(()=>{
      $('#dlt').hide();
      $.ajax({
              type: "POST",
              url: "common/ajax",
              data: 'lotteryDelete='+"id",
              success: function(z) {
                if(z.trim()=="success"){
                swal("Success!", "Successfully Delete", "success");
                location.reload(true);
                }
                else{
                  swal(z);
                  $('#dlt').show();
                }

              }
          })
      })
  </script>
</body>

</html>