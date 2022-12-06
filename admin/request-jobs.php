<?php
  require_once"common/header.php";
  if(isset($_GET['strt'])&& is_numeric($_GET['strt'])){
  $start=$_GET['strt'];
  }else{
    $start=0;
  }
$uid=$data['id'];
  $jobs=_getAllData($db,"SELECT * FROM job_submit WHERE activity=3 ORDER BY id ASC LIMIT $start,25");
  


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

                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase lg:p-5"> Amount
                                </th>

                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase lg:p-5"> Title
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase lg:p-5">
                                    Description </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase lg:p-5"> Old Link
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase lg:p-5"> Submited
                                    Link
                                </th>

                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase lg:p-5"> Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">

                            <?php
                   foreach($jobs as $r){ ?>

                            <tr class="hover:bg-gray-100">
                                <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap lg:p-5">
                                    <?= $r['amount'] ?> </td>
                                <td class="p-4 text-sm font-normal text-gray-500 lg:p-5">
                                    <div class="max-w-[300px]"><?= $r['title'] ?></div>
                                </td>
                                <td class="p-4 text-sm font-normal text-gray-500 lg:p-5">
                                    <div class="w-[360px] break-words">
                                        <?= $r['discription'] ?>
                                    </div>
                                </td>
                                <td class="p-4 space-x-2 whitespace-nowrap lg:p-5">
                                    <a target="_blank" href="<?= $r['oldUrl'] ?>"
                                        class="text-blue-600 hover:underline"><?= substr($r['oldUrl'], 0, 25); ?>...
                                    </a>
                                </td>
                                <td class="p-4 space-x-2 whitespace-nowrap lg:p-5">
                                    <a target="_blank" href="<?= $r['submiturl'] ?>"
                                        class="text-blue-600 hover:underline"><?=  substr($r['submiturl'], 0, 25); ?>...
                                    </a>
                                </td>
                                <td class="p-4 space-x-2 whitespace-nowrap lg:p-5">
                                    <button onclick="reqid(<?= $r['id'] ?>)" data-target="reject_job" type="button"
                                        class="popup_show btn bg-red-500 w-fit text-white">Reject</button>
                                    <button onclick="reqid(<?= $r['id'] ?>)" data-target="approve_job" type="button"
                                        class="popup_show btn bg-green-600 w-fit text-white">Approve</button>
                                </td>
                            </tr>

                            <?php } ?>
                        </tbody>
                    </table>

                    <!-- Paginations -->
                    <div class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6">

                        <div
                            class="flex flex-col sm:flex-row gap-3 py-3 items-center justify-center sm:justify-between w-full">
                            <div class="w-fit">
                                <p class="text-sm text-gray-700">
                                    Total Request
                                    <span class="font-medium"><?php
                                      $jobs=_getAllData($db,"SELECT * FROM job_submit WHERE activity=3 ORDER BY id ASC");
                                      echo count($jobs);
                                        ?></span>

                                </p>
                            </div>
                            <div class="w-fit">
                                <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm"
                                    aria-label="Pagination">
                                    <a href="users?strt=<?php
                        if($start>24){
                          echo $start-25;
                        }else{
                          echo 0;
                        }
                        ?>
                        " class="relative inline-flex items-center rounded-l-md border border-gray-300 bg-white px-2 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-20">
                                        <span>Previous</span>
                                        <!-- Heroicon name: mini/chevron-left -->
                                    </a>
                                    &nbsp;&nbsp;&nbsp;

                                    <a href="users?strt=<?php if($totaluser>$start){ echo ($start+25);
                        }else{
                          echo $start;
                        }?>" class="relative inline-flex items-center rounded-r-md border border-gray-300 bg-white px-2 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-20">
                                        <span>Next</span>
                                        <!-- Heroicon name: mini/chevron-right -->

                                    </a>
                                </nav>
                            </div>
                        </div>
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