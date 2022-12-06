<?php
	require_once"system/functions.php";
  if(!$is_online){ header("Location: index");}
  if($config['gameStatus']==0){ header("Location: index");}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $config['site_name']; ?>- Earn money with easy tasks</title>
    <!--=== Google Font  ===-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/images/<?= $config['favicon']; ?>" type="image/x-icon" />

    <!--=== FONT-AWESOME  ===-->
    <script src="https://kit.fontawesome.com/6788eb3be6.js" crossorigin="anonymous"></script>

    <!--=== StyleSheet  ===-->
    <link rel="stylesheet" href="./css/tailwind-output.css" />
    <!-- coustom by arif -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>
    /* coustom by arif  */

    .containertimercard {
        box-sizing: border-box;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 1.66rem;
        color: #fff;
        margin-top: 39px;
    }

    .flip-card {
        position: relative;
        display: inline-flex;
        flex-direction: column;
        box-shadow: 0 2px 3px 0 rgba(0, 0, 0, 0.2);
        border-radius: 0.1em;
    }

    .top,
    .bottom,
    .flip-card .top-flip,
    .flip-card .bottom-flip {
        height: 0.75em;
        line-height: 1;
        padding: 0.25em;
        overflow: hidden;
    }

    .top,
    .flip-card .top-flip {
        background-color: #222;
        border-top-right-radius: 0.1em;
        border-top-left-radius: 0.1em;
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    }

    .bottom,
    .flip-card .bottom-flip {
        background-color: #222;
        display: flex;
        align-items: flex-end;
        border-bottom-right-radius: 0.1em;
        border-bottom-left-radius: 0.1em;
    }

    .flip-card .top-flip {
        position: absolute;
        width: 100%;
        animation: flip-top 250ms ease-in;
        transform-origin: bottom;
    }

    @keyframes flip-top {
        100% {
            transform: rotateX(90deg);
        }
    }

    .flip-card .bottom-flip {
        position: absolute;
        bottom: 0;
        width: 100%;
        animation: flip-bottom 250ms ease-out 250ms;
        transform-origin: top;
        transform: rotateX(90deg);
    }

    @keyframes flip-bottom {
        100% {
            transform: rotateX(0deg);
        }
    }

    .containertimercard {
        display: flex;
        gap: 0.5em;
        justify-content: center;
    }

    .container-segment {
        display: flex;
        flex-direction: column;
        gap: 0.1em;
        align-items: center;
    }

    .segment {
        display: flex;
        gap: 0.1em;
    }

    .segment-title {
        font-size: 1rem;
        color: #000;
    }

    .timerbox {
        font: 25px arial;
        font-weight: normal;
        text-indent: 0 !important;
        color: #ffffff;
        text-align: center;
        font-weight: bold !important;
        text-shadow: 1px 1px #ffe778;
        max-width: 200px;
        display: block;
        padding: 0;
        margin: 10px auto;
    }

    /* coustom css */
    .btns button {
        padding: 8px 12px;
        background: #2350f3;
        color: #fff;
        border-radius: 3px;
    }

    .notify_wrapper {
        background: #ffcb69;
        color: #7a5f24;
        display: flex;
        justify-content: start;
        width: 100%;
        border-radius: 3px;
    }

    .notify_icon {
        background: #ecb44b;
        padding: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .notify_text {
        padding: 8px;
        display: flex;
        flex-direction: column;
        gap: 2px 0;
    }

    .notify_text>p {
        font-weight: bold;
        font-size: 16px;
    }

    .notify_text>small {
        font-size: 14px;
    }
    </style>

</head>

<body>
    <div class="notify_wrapper" style="margin: 12px 25px 0px 25px;width: 90% !important;">
        <div class="notify_icon">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" width="24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z">
                </path>
            </svg>

        </div>

        <div class="notify_text">
            <small><?php
               $d=_getData($db,"SELECT * FROM `notice` WHERE name='game'");
               echo $d['notice'];
                ?></small>
        </div>
    </div>

    <div
        class="flex flex-col lg:items-center lg:flex-row w-[96%] mx-auto sm:w-[400px] md:w-[500px] lg:w-[1000px] py-12">


        <div class="bg-gray-100 rounded-l-2xl w-full lg:w-6/12 relative">


            <div class="p-6">

                <div class="p-4 rounded shadow text-white  mb-5" style="background: #311c1ce0; color: #00f3ff;">
                    Ballence: <span id="ballence">
                        <?= $data['coins'] ?></span> coins</div>

                <div class="p-4 rounded shadow text-white bg-[#00000080] mb-5" id="final-value">Press "▶" to spin the
                    wheel</div>
                <form id="field_val_form" class="space-y-5">
                    <div class="wheel_input_wrapper h-fit">
                        <div class="wheel_input_span">Field 1:</div>
                        <input id="wheel_input1" value="0" type="number"
                            class="wheel_input bg-[#8d01f8]  bg-opacity-90 text-white">
                    </div>

                    <div class="wheel_input_wrapper h-fit">
                        <div class="wheel_input_span">Field 3:</div>
                        <input id="wheel_input3" value="0" type="number"
                            class="wheel_input bg-[#fb3501] bg-opacity-90  text-white">
                    </div>


                    <div class="wheel_input_wrapper h-fit">
                        <div class="wheel_input_span">Field 5:</div>
                        <input id="wheel_input5" value="0" type="number"
                            class="wheel_input bg-[#f1dc19] bg-opacity-90  text-white">
                    </div>


                    <div class="wheel_input_wrapper h-fit">
                        <div class="wheel_input_span">Field 7:</div>
                        <input id="wheel_input7" value="0" type="number"
                            class="wheel_input bg-[#0760ed] bg-opacity-90  text-white">
                    </div>
                    <button id="spin-submit"
                        class="px-4 py-2 rounded shadow focus:ring bg-purple-600 text-white font-medium">Submit</button>
                </form>
            </div>
            <div class="h-full w-24 -mr-24 bg-gray-100 absolute inset-y-0 right-0 my-0"></div>
        </div>

        <div class="w-full lg:w-6/12 -ml-5">
            <div class="relative border-[20px] border-gray-100 rounded-full">

                <canvas class="wheel bg-gray-100 rounded-full" id="wheel"></canvas>

                <button
                    class="absolute disabled:cursor-wait z-50 inset-0 m-auto w-16 h-16 bg-blue-500 text-white rounded-full border-[6px] text-xl border-white shadow-lg shadow-gray-700"
                    id="spin-btn" style="display: none;"> <i class="fa fa-play"></i>
                </button>

                <img class="absolute z-50 left-[7%] top-[7%] transform rotate-[10deg]"
                    src="./assets/images/line-star.svg" alt="arrow" />

                <div class="opacityEffect absolute inset-0 w-full h-full m-auto rounded-full z-40"></div>
            </div>
        </div>
    </div>

    <div id="popup_message"></div>
    <!-- Chart JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.1.0/chartjs-plugin-datalabels.min.js">
    </script>
    <script src="./js/app.js"></script>


</body>

</html>