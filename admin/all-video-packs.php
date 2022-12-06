<?php
  require_once"common/header.php";
  if(isset($_GET['strt'])&& is_numeric($_GET['strt'])){
  $start=$_GET['strt'];
  }else{
    $start=0;
  }
$uid=$data['id'];
  $videopc=_getAllData($db,"SELECT * FROM vad_packs WHERE activity=1 ORDER BY id ASC LIMIT $start,25");

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
                                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase lg:p-5"> ID </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase lg:p-5"> Pack
                                    Name </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase lg:p-5"> Award
                                    Coins </th>

                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase lg:p-5"> Time
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase lg:p-5"> Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php
                    foreach($videopc as $p){ ?>



                            <tr class="hover:bg-gray-100">
                                <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap lg:p-5">
                                    <?= $p['id'] ?> </td>
                                <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap lg:p-5">
                                    <?= $p['name'] ?> </td>
                                <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap lg:p-5">
                                    <?= $p['coins'] ?> Coin </td>

                                <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap lg:p-5">
                                    <?= $p['time'] ?> seconds </td>
                                <td class="p-4 space-x-2 whitespace-nowrap lg:p-5">
                                    <a href="./edit-video-pack.php?id=<?=$p['id'] ?>" type="button"
                                        class="btn bg-green-600 w-fit text-white">Edit</a>
                                    <button onclick="userid(<?= $p['id'] ?>)" data-target="delete_pack" type="button"
                                        class="popup_show btn bg-red-500 w-fit text-white">Delete</button>
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
                                    Total Users
                                    <span class="font-medium"><?php
                         $videopc=_getAllData($db,"SELECT * FROM vad_packs WHERE activity=1 ORDER BY id ASC");
                         echo count($videopc);
                          ?></span>

                                </p>
                            </div>
                            <div class="w-fit">
                                <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm"
                                    aria-label="Pagination">
                                    <a href="my-jobs?strt=<?php
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

                                    <a href="my-jobs?strt=<?php if($totaluser>$start){ echo ($start+25);
                        }else{
                          echo $start;
                        }?>" class="relative inline-flex items-center rounded-r-md border border-gray-300 bg-white px-2 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-20">
                                        <span>Next</span>
                                        <!-- Heroicon name: mini/chevron-right -->
                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                            fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                                                clip-rule="evenodd" />
                                        </svg>
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

<!-- Add New Pack Popup -->
<div data-target="add_pack"
    class="popup_wrapper overflow-y-auto overflow-x-hidden fixed right-0 left-0 top-4 z-50 justify-center items-center md:inset-0 sm:h-full flex"
    id="delete-product-modal" style="z-index: 111; display: none;">
    <div data-target="add_pack" class="popup_remove w-full h-screen bg-black bg-opacity-50 z-40 fixed inset-0 m-auto">
    </div>
    <div class="relative p-4 w-full max-w-md h-full md:h-auto z-50">
        <div class="relative bg-white rounded-2xl shadow-lg p-6 pt-4">
            <div class="flex justify-end">
                <button type="button" data-target="add_pack"
                    class="popup_remove text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-2xl text-sm w-8 h-8 flex items-center justify-center ml-auto"
                    data-modal-toggle="delete-product-modal"> <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <form class="flex flex-col gap-y-6">
                <h2 class="text-lg font-semibold text-cyan-900">Add Pack</h2>
                <div class="flex flex-col gap-y-1">
                    <label for="Pack Name">Pack Name</label>
                    <input type="text" id="Pack Name" placeholder="Pack Name" class="input" required>
                </div>
                <div class="flex flex-col gap-y-1">
                    <label for="Coins Per Visit">Coins Per Visit</label>
                    <input type="text" id="Coins Per Visit" placeholder="Coins Per Visit" class="input" required>
                </div>
                <div class="flex flex-col gap-y-1">
                    <label for="Price Per Visit">Price Per Visit</label>
                    <input type="text" id="Price Per Visit" placeholder="Price Per Visit" class="input" required>
                </div>
                <div class="flex flex-col gap-y-1">
                    <label for="Time">Time</label>
                    <input type="text" id="Time" placeholder="Time" class="input" required>
                </div>
                <div class="flex justify-end">
                    <button class="button">Submit</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- Delete Pack Popup -->
<div data-target="delete_pack"
    class="popup_wrapper overflow-y-auto overflow-x-hidden fixed right-0 left-0 top-4 z-50 justify-center items-center md:inset-0 sm:h-full flex"
    id="delete-product-modal" style="z-index: 111; display: none;">
    <div data-target="delete_pack"
        class="popup_remove w-full h-screen bg-black bg-opacity-50 z-40 fixed inset-0 m-auto"></div>
    <div class="relative px-4 w-full max-w-md h-full md:h-auto z-50">
        <div class="relative bg-white rounded-2xl shadow-lg">
            <div class="flex justify-end p-2"><button type="button" data-target="delete_pack"
                    class="popup_remove text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-2xl text-sm w-8 h-8 flex items-center justify-center ml-auto"
                    data-modal-toggle="delete-product-modal"> <i class="fa-solid fa-xmark"></i> </button></div>
            <div class="p-6 pt-0 text-center text-5xl text-red-500"> <i class="fa-solid fa-circle-exclamation"></i>
                <h3 class="my-9 text-base font-normal text-gray-500">Are You Sure, Want to delete this pack?
                </h3>
                <div class="w-full flex justify-between items-center gap-x-2"><a href="#" data-target="delete_pack"
                        class="popup_remove text-white bg-red-400 border border-gray-200 font-medium inline-flex items-center rounded-lg text-sm px-3 py-2.5 text-center hover:scale-[1.02] transition-transform"
                        data-modal-toggle="delete-product-modal">No, cancel</a>

                    <button id="dlt"
                        class="disabled:opacity-70 disabled:cursor-not-allowed text-white bg-gradient-to-br from-red-600 to-red-500 font-medium rounded-lg text-sm inline-flex items-center px-3 py-2.5 text-center mr-2 shadow-md shadow-gray-300 hover:scale-[1.02] transition-transform"><span>Yes,
                            Confirm</span></button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="js/app.js"></script>
<script>
id = 0;

function userid(data) {
    id = data;
    console.log(id);
}

$('#dlt').click(() => {
    $('#dlt').hide();
    $.ajax({
        type: "POST",
        url: "common/ajax",
        data: 'delete_vpac=' + id,
        success: function(z) {
            if (z.trim() == "success") {
                swal("Success!", "Successfully Delete", "success");
                location.reload(true);
            } else {
                swal(z);
                $('#dlt').show();
            }

        }
    })
})
</script>
</body>

</html>