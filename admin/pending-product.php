<?php
  require_once"common/header.php";
  if(isset($_GET['strt'])&& is_numeric($_GET['strt'])){
  $start=$_GET['strt'];
  }else{
    $start=0;
  }

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
                                <th scope="col" class="p-4 text-xs font-medium text-left text-center text-gray-500 uppercase lg:p-5">Image</th>
                                <th scope="col" class="p-4 text-xs font-medium text-left text-center text-gray-500 uppercase lg:p-5">User Name</th>
                                <th scope="col" class="p-4 text-xs font-medium text-left text-center text-gray-500 uppercase lg:p-5">User Email</th>
                                <th scope="col" class="p-4 text-xs font-medium text-left text-center text-gray-500 uppercase lg:p-5">Product Name</th>
                                <th scope="col" class="p-4 text-xs font-medium text-left text-center text-gray-500 uppercase lg:p-5">Price</th>
                                <th scope="col" class="p-4 text-xs font-medium text-left text-center text-gray-500 uppercase lg:p-5">Url</th>
                                <th scope="col" class="p-4 text-xs font-medium text-left text-center text-gray-500 uppercase lg:p-5">Category</th>
                                <th scope="col" class="p-4 text-xs font-medium text-left text-center text-gray-500 uppercase lg:p-5">Contact</th>
                                <th scope="col" class="p-4 text-xs font-medium text-left text-center text-gray-500 uppercase lg:p-5">Date</th>
                                <th scope="col" class="p-4 text-xs font-medium text-left text-center text-gray-500 uppercase lg:p-5">Status</th>
                                <th scope="col" class="p-4 text-xs font-medium text-left text-center text-gray-500 uppercase lg:p-5">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">

                                <?php
                                if (isset($_GET['page_no']) && $_GET['page_no']!="") {
                                $page_no = $_GET['page_no'];} else {$page_no = 1;}
                                $total_records_per_page = 8;
                                $offset = ($page_no-1) * $total_records_per_page;
                                $previous_page = $page_no - 1;
                                $next_page = $page_no + 1;
                                $adjacents = "2"; 

                                $products =$db->Query("SELECT * FROM product_system WHERE activity=0 ORDER BY id DESC LIMIT $offset, $total_records_per_page");                                
                                
                                $result_count = $db->Query("SELECT * FROM product_system WHERE activity=0");                       
                                $total_records = mysqli_num_rows($result_count);
                                $total_no_of_pages = ceil($total_records / $total_records_per_page);
                                $second_last = $total_no_of_pages - 1;
                                while($product = mysqli_fetch_assoc($products)){
                                 $user_id = $product['uid'];
                                 $user_info = $db->Query("SELECT * FROM users WHERE id=$user_id");
                                 $user_info = mysqli_fetch_assoc($user_info);
                                ?>
                            <tr class="hover:bg-gray-100">
                                <td class="p-4 text-sm font-normal text-gray-500 text-center whitespace-nowrap lg:p-5">
                                    <img style="width:100px;height:50px;margin:0 auto" src="../upload/<?php echo $product['file']?>" alt="">
                                </td>
                                <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap text-center lg:p-5"><?php echo $user_info['fullname'];?></td>
                                <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap text-center lg:p-5"><?php echo $user_info['email'];?></td>
                                <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap text-center lg:p-5"><?php echo $product['product_title'];?></td>
                                <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap text-center lg:p-5"><?php echo $product['amount'];?></td>
                                <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap text-center lg:p-5"><?php echo $product['web_link']?></td>
                                <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap text-center lg:p-5"><?php echo $product['category']?></td>
                                <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap text-center lg:p-5"><?php echo $product['contact']?></td>
                                <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap text-center lg:p-5"><?php echo $product['job_time']?></td>
                                <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap text-center lg:p-5"><?php echo $product['status']?></td>
                                <td class="p-4 text-sm font-normal text-gray-500 text-center whitespace-nowrap lg:p-5">
                                    <a class="list_btn" style="background:#EF4444;" href="product-edit.php?id=<?php echo $product['id'];?>">Edit</a>
                                    <a class="list_btn" style="background:#EF4444;" href="delete.php?src=pending-product&&id=<?php echo $product['id'];?>">Delete</a>
                                    <a class="list_btn" style="background:#007bff;" target="_blank" href="../product-page?id=<?php echo $product['id'];?>">View</a>
                                </td>
                            </tr>

                            <?php } ?>
                        </tbody>
                    </table>

                <div style="padding:20px 10px;">
                <!-- /* ----------paginations----------- */ -->
                <style>
                .paginations>ul{box-shadow: 0 0 1px gray;margin: 0;padding: 10px;}
                .paginations>ul>li{list-style: none;display: inline-block;line-height: 2.5;}
                .paginations>ul>li>a{padding: 5px 10px;margin:5px;background: #fff;font-weight: bolder;box-shadow: 0px 0px 2px gray;}
                .paginations>ul>li>a:hover{background: #209300;color: #fff;}
                .active>a{background: #209300 !important;color: #fff !important;}
                .page_of{padding-top: 10px;}
                @media only screen and (max-width: 850px){.page_of{display: none;}}
              </style>

              <div style="display:flex;justify-content:space-between;padding:10px 20px;">
                  <div class="paginations">
                    <ul>
                      <?php // if($page_no > 1){ echo "<li><a href='?page_no=1'>First Page</a></li>"; } ?>
                        
                      <li <?php if($page_no <= 1){ echo "class=''"; } ?>>
                      <a <?php if($page_no > 1){ echo "href='?page_no=$previous_page'"; } ?>>Previous</a>
                      </li>
                          
                        <?php 
                      if ($total_no_of_pages <= 10){  	 
                        for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
                          if ($counter == $page_no) {
                          echo "<li class=''><a>$counter</a></li>";	
                            }else{
                              echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                            }
                            }
                      }
                      elseif($total_no_of_pages > 10){
                        
                      if($page_no <= 4) {			
                      for ($counter = 1; $counter < 8; $counter++){		 
                          if ($counter == $page_no) {
                          echo "<li class='active'><a>$counter</a></li>";	
                            }else{
                              echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                            }
                            }
                        echo "<li><a>...</a></li>";
                        echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
                        echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
                        }

                      elseif($page_no > 4 && $page_no < $total_no_of_pages - 4) {		 
                        echo "<li><a href='?page_no=1'>1</a></li>";
                        echo "<li><a href='?page_no=2'>2</a></li>";
                            echo "<li><a>...</a></li>";
                            for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {			
                              if ($counter == $page_no) {
                          echo "<li class='active'><a>$counter</a></li>";	
                            }else{
                              echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                            }                  
                          }
                          echo "<li><a>...</a></li>";
                        echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
                        echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";      
                                }
                        
                        else {
                            echo "<li><a href='?page_no=1'>1</a></li>";
                        echo "<li><a href='?page_no=2'>2</a></li>";
                            echo "<li><a>...</a></li>";

                            for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
                              if ($counter == $page_no) {
                          echo "<li class='active'><a>$counter</a></li>";	
                            }else{
                              echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                            }                   
                                    }
                                }
                      }
                    ?>
                        
                      <li <?php if($page_no >= $total_no_of_pages){ echo "class='disabled'"; } ?>>
                      <a <?php if($page_no < $total_no_of_pages) { echo "href='?page_no=$next_page'"; } ?>>Next</a>
                      </li>
                        <?php if($page_no < $total_no_of_pages){
                        echo "<li><a href='?page_no=$total_no_of_pages'>Last</a></li>";
                        } ?>
                    </ul>
                  </div>
                  <div class="page_of">
                    <div><strong>Page <?php echo $page_no." of ".$total_no_of_pages; ?></strong></div>
                  </div>
                </div>
                <!-- /* ----------paginations----------- */ -->
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
</div>
</main>

<!-- All Popup -->
<!-- Approve Job -->
<div data-target="approve_job"
    class="popup_wrapper overflow-y-auto overflow-x-hidden fixed right-0 left-0 top-4 z-50 justify-center items-center md:inset-0 sm:h-full flex"
    id="delete-product-modal" style="z-index: 111; display: none;">
    <div data-target="approve_job"
        class="popup_remove w-full h-screen bg-black bg-opacity-50 z-40 fixed inset-0 m-auto">
    </div>
    <div class="relative px-4 w-full max-w-md h-full md:h-auto z-50">
        <div class="relative bg-white rounded-2xl shadow-lg">
            <div class="flex justify-end p-2"><button type="button" data-target="approve_job"
                    class="popup_remove text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-2xl text-sm w-8 h-8 flex items-center justify-center ml-auto"
                    data-modal-toggle="delete-product-modal"> <i class="fa-solid fa-xmark"></i> </button></div>
            <div class="p-6 pt-0 text-center text-5xl text-green-500"> <i class="fa-solid fa-circle-exclamation"></i>
                <h3 class="my-9 text-base font-normal text-gray-500">Want to approve this job?
                </h3>
                <div class="w-full flex justify-between items-center gap-x-2"><a href="#" data-target="approve_job"
                        class="popup_remove text-white bg-red-400 border border-gray-200 font-medium inline-flex items-center rounded-lg text-sm px-3 py-2.5 text-center hover:scale-[1.02] transition-transform"
                        data-modal-toggle="delete-product-modal">No, cancel</a>

                    <button id="apv"
                        class="disabled:opacity-70 disabled:cursor-not-allowed text-white bg-gradient-to-br from-green-600 to-green-500 font-medium rounded-lg text-sm inline-flex items-center px-3 py-2.5 text-center mr-2 shadow-md shadow-gray-300 hover:scale-[1.02] transition-transform"><span>Yes,
                            Confirm</span></button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Reject Job -->
<div data-target="reject_job"
    class="popup_wrapper overflow-y-auto overflow-x-hidden fixed right-0 left-0 top-4 z-50 justify-center items-center md:inset-0 sm:h-full flex"
    id="delete-product-modal" style="z-index: 111; display: none;">
    <div data-target="reject_job" class="popup_remove w-full h-screen bg-black bg-opacity-50 z-40 fixed inset-0 m-auto">
    </div>
    <div class="relative px-4 w-full max-w-md h-full md:h-auto z-50">
        <div class="relative bg-white rounded-2xl shadow-lg">
            <div class="flex justify-end p-2"><button type="button" data-target="reject_job"
                    class="popup_remove text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-2xl text-sm w-8 h-8 flex items-center justify-center ml-auto"
                    data-modal-toggle="delete-product-modal"> <i class="fa-solid fa-xmark"></i> </button></div>
            <div class="p-6 pt-0 text-center text-5xl text-red-500"> <i class="fa-solid fa-circle-exclamation"></i>
                <h3 class="my-9 text-base font-normal text-gray-500">Want to reject this job?
                </h3>
                <div class="w-full flex justify-between items-center gap-x-2"><a href="#" data-target="reject_job"
                        class="popup_remove text-white bg-red-400 border border-gray-200 font-medium inline-flex items-center rounded-lg text-sm px-3 py-2.5 text-center hover:scale-[1.02] transition-transform"
                        data-modal-toggle="delete-product-modal">No, cancel</a>

                    <button id="rej"
                        class="disabled:opacity-70 disabled:cursor-not-allowed text-white bg-gradient-to-br from-red-600 to-red-500 font-medium rounded-lg text-sm inline-flex items-center px-3 py-2.5 text-center mr-2 shadow-md shadow-gray-300 hover:scale-[1.02] transition-transform"><span>Yes,
                            Reject</span></button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="js/app.js"></script>
<script>
id = 0;

function reqid(data) {
    id = data;
    console.log(id);
}

$('#apv').click(() => {
    $('#apv').hide();
    $.ajax({
        type: "POST",
        url: "common/ajax",
        data: 'apv=' + id,
        success: function(z) {
            if (z.trim() == "success") {
                swal("Success!", "Successfully Aprove", "success");
                location.reload(true);
            } else {
                swal(z);
                $('#apv').show();
            }

        }
    })
})

$('#rej').click(() => {
    $('#rej').hide();
    $.ajax({
        type: "POST",
        url: "common/ajax",
        data: 'rej=' + id,
        success: function(z) {
            if (z.trim() == "success") {
                swal("Success!", "Successfully Rejected", "success");
                location.reload(true);
            } else {
                swal(z);
                $('#rej').show();
            }

        }
    })
})
</script>


</body>

</html>