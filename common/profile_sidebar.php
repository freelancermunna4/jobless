<div class="dashboard_sidebar">
    <div class="dashboard_sidebar_item">
        <h6 class="ds_title" data-ref="my-profile">
            <span class="text"> MY PROFILE </span>
            <span class="icon"><i class="fa-solid fa-chevron-down"></i></span>
        </h6>
        <ul class="ds_ul" data-ref="my-profile">
            <li>
                <a href="my-account">
                    <i class="fa fa-dashboard"></i> <span>DASHBOARD</span>
                </a>
            </li>
            <li>
                <a href="tickets">
                    <i class="fa fa-support"></i>
                    <span>SUPPORT TICKETS</span>
                </a>
            </li>
            <li>
                <a href="referrals">
                    <i class="fa fa-user-plus"></i> <span>REFERRALS</span>
                </a>
            </li>
            <li>
                <a href="activities">
                    <i class="fa-solid fa-chart-line"></i>
                    <span>ACTIVITIES</span>
                </a>
            </li>
        </ul>
    </div>

    <div class="dashboard_sidebar_item">
        <h6 class="ds_title" data-ref="setting">
            <span class="text"> SETTING </span>
            <span class="icon"><i class="fa-solid fa-chevron-down"></i></span>
        </h6>
        <ul class="ds_ul" data-ref="setting">
            <li>
                <a href="profile">
                    <i class="fa fa-user"></i> <span>PROFILE</span>
                </a>
            </li>
            <li>
                <a href="security">
                    <i class="fa fa-shield"></i> <span>SECURITY</span>
                </a>
            </li>

        </ul>
    </div>

    <div class="dashboard_sidebar_item">
        <h6 class="ds_title" data-ref="terminate_account">
            <span class="text"> TERMINATE ACCOUNT </span>
            <span class="icon">
                <i class="fa-solid fa-chevron-down"></i>
            </span>
        </h6>
        <ul class="ds_ul" data-ref="terminate_account">
            <li>
                <a href="#" onclick="closeaccaunt(<?= $data['id'] ?>)">
                    <i class="icon-cancel-circled"></i>
                    <span>CLOSE ACCOUNT</span>
                </a>
            </li>
        </ul>
    </div>
</div>

<script>
    function closeaccaunt(data){
        swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this Accaunt!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                        type: "POST",
                        url: "system/ajax",
                        data: "deleteaccaunt=" + data,

                        success: function (z) {
                            if(z.trim()=="success"){
                                swal("Poof! Your Profile has been deleted!", {
                                icon: "success",
                                });
                                location.reload(1);
                            }else{
                                swal(z);
                            }



                        },
                    });




        } else {
            swal("Your Accaunt is safe!");
        }
        });
    }
</script>