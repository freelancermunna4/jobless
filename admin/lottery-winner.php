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
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase lg:p-5"> User Name
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase lg:p-5"> Price Name
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase lg:p-5"> Price
                                    Value </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase lg:p-5"> Lottery
                                    Number </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase lg:p-5"> Time </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase lg:p-5"> Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php
                    $dt=_getAllData($db,"SELECT * FROM `lotterywinner` WHERE ativity=0 ORDER BY id DESC LIMIT 25");
                    foreach($dt as $d){ ?>
                            <tr class="hover:bg-gray-100">
                                <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap lg:p-5">
                                    <?= $d['uname'] ?> </td>
                                <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap lg:p-5">
                                    <?= $d['pricename'] ?> </td>
                                <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap lg:p-5">
                                    <?= $d['price'] ?> </td>

                                <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap lg:p-5">
                                    <?= $d['number'] ?> </td>

                                <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap lg:p-5">
                                    <?= date('d-m-Y',$d['time']) ?> </td>
                                <td class="p-4 space-x-2 whitespace-nowrap lg:p-5">

                                    <button onclick="aprovewinner(<?= $d['id'] ?>)" id="<?= $r['id'] ?>hd" type="button"
                                        class="btn bg-green-600 w-fit text-white">Aprove</button>

                                    <button data-target="delete_lottery" type="button"
                                        onclick="deletewinner(<?= $d['id'] ?>)"
                                        class="popup_show btn bg-red-500 w-fit text-white">Delete</button>

                                </td>
                            </tr>

                            <?php } ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>



    <form class="grid grid-cols-2 gap-y-8 gap-x-12">
        <div class="col-span-2">
            <h2 class="text-xl font-semibold text-cyan-800">Add New Winner</h2>
            <h4 class="username text-xl font-semibold text-cyan-800" style="color: green;"></h4>
        </div>

        <div class="col-span-2 flex flex-col gap-y-1">
            <label for="First Winner Number"> Winner Number</label>
            <input id="lnumber" class="input" type="number" id="First Winner Number" placeholder="23231">
        </div>

        <div class="col-span-2 flex justify-start">

        </div>


        <div class="col-span-2 flex justify-start">
            <div class="w-fit">
                <button id="genaret" type="button" class="button">Genaret Winner</button>
            </div>&nbsp;&nbsp;&nbsp;
            <div class="w-fit">
                <button id="lsubmit" type="button" class="button">Submit</button>
            </div>
        </div>

    </form>
</div>
</div>
</main>

<script src="js/app.js"></script>
<script>
$('#genaret').click(() => {
    $.ajax({
        type: "POST",
        url: "common/ajax",
        data: 'genaretlotteryWinner=' + "number",
        success: function(z) {
            var obj = JSON.parse(z);
            if (obj.err === false) {
                $('.username').html(obj.uname);
                $('#lnumber').val(obj.number);

            } else {
                $('.username').html(obj.messeg);
            }


        }
    })


})





$('#lsubmit').click(() => {
    var number = $('#lnumber').val();

    $.ajax({
        type: "POST",
        url: "common/ajax",
        data: 'lotteryWinner=' + number,
        success: function(z) {
            if (z.trim() == "success") {
                swal("Success!", "Winner Set Successfully", "success");
                location.reload(true);
            } else {
                swal(z);
                $('#dlt').show();
            }

        }
    })


})




function deletewinner(id) {
    $.ajax({
        type: "POST",
        url: "common/ajax",
        data: 'Deletewinner=' + id,
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
}


function aprovewinner(id) {
    $.ajax({
        type: "POST",
        url: "common/ajax",
        data: 'aprovewinner=' + id,
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
}
</script>
</body>

</html>