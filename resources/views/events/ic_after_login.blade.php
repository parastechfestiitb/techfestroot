<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" type="image/x-icon" href="/2019/ca/images/favicon_logo.png" />
    <!-- Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="#000000">

    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#000000">

    <!-- iOS Safari -->
    <link rel="stylesheet" href="/2018/Ic/css/bootstrap.css">

    <meta name="apple-mobile-web-app-status-bar-style" content="#000000">
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-81222017-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-81222017-1');
    </script>

    <!-- Title Page-->
    <title>Registeration Forms</title>


    <style>
        .box {
            position: relative;
            top: 80px;
            opacity: 0.9;
            float: left;
            padding: 60px 50px 40px 50px;
            width: 100%;
            background: #fff;
            border-radius: 10px;
            transform: scale(1);
            -webkit-transform: scale(1);
            -ms-transform: scale(1);
            z-index: 5;
        }

        .box.back {
            transform: scale(.95);
            -webkit-transform: scale(.95);
            -ms-transform: scale(.95);
            top: -20px;
            opacity: .8;
            z-index: -1;
        }

        .box:before {
            content: "";
            width: 100%;
            height: 30px;
            border-radius: 10px;
            position: absolute;
            top: -10px;
            background: rgba(255, 255, 255, .6);
            left: 0;
            transform: scale(.95);
            -webkit-transform: scale(.95);
            -ms-transform: scale(.95);
            z-index: -1;
        }

        .overbox .title {
            color: #fff;
        }

        .overbox .title:before {
            background: #fff;
        }

        .title {
            width: 100%;
            float: left;
            line-height: 46px;
            font-size: 34px;
            font-weight: 700;
            letter-spacing: 2px;
            color: #ED2553;
            position: relative;
        }

        .title:before {
            content: "";
            width: 5px;
            height: 100%;
            position: absolute;
            top: 0;
            left: -50px;
            background: #ED2553;
        }

        .input,
        .input label,
        .input input,
        .input .spin,
        .button,
        .button button .button.login button i.fa,
        .material-button .shape:before,
        .material-button .shape:after,
        .button.login button {
            transition: 300ms cubic-bezier(.4, 0, .2, 1);
            -webkit-transition: 300ms cubic-bezier(.4, 0, .2, 1);
            -ms-transition: 300ms cubic-bezier(.4, 0, .2, 1);
        }

        .material-button,
        .alt-2,
        .material-button .shape,
        .alt-2 .shape,
        .box {
            transition: 400ms cubic-bezier(.4, 0, .2, 1);
            -webkit-transition: 400ms cubic-bezier(.4, 0, .2, 1);
            -ms-transition: 400ms cubic-bezier(.4, 0, .2, 1);
        }

        .input,
        .input label,
        .input input,
        .input .spin,
        .button,
        .button button {
            width: 100%;
            float: left;
        }

        .input,
        .button {
            margin-top: 30px;
            height: 70px;
        }

        .input,
        .input input,
        .button,
        .button button {
            position: relative;
        }

        .input input {
            height: 60px;
            top: 10px;
            border: none;
            background: transparent;
        }

        .input input,
        .input label,
        .button button {
            font-family: 'Roboto', sans-serif;
            /*font-size: 24px;*/
            color: rgba(0, 0, 0, 0.8);
            font-weight: 300;
        }

        .input:before,
        .input .spin {
            width: 100%;
            height: 1px;
            position: absolute;
            bottom: 0;
            left: 0;
        }

        .input:before {
            content: "";
            background: rgba(0, 0, 0, 0.1);
            z-index: 3;
        }

        .input .spin {
            background: #ED2553;
            z-index: 4;
            width: 0;
        }

        .overbox .input .spin {
            background: rgba(255, 255, 255, 1);
        }

        .overbox .input:before {
            background: rgba(255, 255, 255, 0.5);
        }

        .input label {
            /*position: absolute;*/
            top: 10px;
            left: 0;
            z-index: 2;
            cursor: pointer;
            /*line-height: 60px;*/
        }

        .button.login {
            width: 60%;
            left: 20%;
        }

        .button.login button,
        .button button {
            width: 100%;
            line-height: 64px;
            left: 0%;
            background-color: transparent;
            border: 3px solid rgba(0, 0, 0, 0.1);
            font-weight: 900;
            font-size: 18px;
            color: rgba(0, 0, 0, 0.2);
        }

        .button.login {
            margin-top: 30px;
        }

        .button {
            margin-top: 20px;
        }

        .button button {
            background-color: #fff;
            color: #ED2553;
            border: none;
        }

        .button.login button.active {
            border: 3px solid transparent;
            color: #fff !important;
        }

        .button.login button.active span {
            opacity: 0;
            transform: scale(0);
            -webkit-transform: scale(0);
            -ms-transform: scale(0);
        }

        .button.login button.active i.fa {
            opacity: 1;
            transform: scale(1) rotate(-0deg);
            -webkit-transform: scale(1) rotate(-0deg);
            -ms-transform: scale(1) rotate(-0deg);
        }

        .button.login button i.fa {
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            line-height: 60px;
            transform: scale(0) rotate(-45deg);
            -webkit-transform: scale(0) rotate(-45deg);
            -ms-transform: scale(0) rotate(-45deg);
        }

        .button.login button:hover {
            color: #ED2553;
            border-color: #ED2553;
        }

        .button {
            margin: 40px 0;
            overflow: hidden;
            z-index: 2;
        }

        .button button {
            cursor: pointer;
            position: relative;
            z-index: 2;
        }

        .pass-forgot {
            width: 100%;
            float: left;
            text-align: center;
            color: rgba(0, 0, 0, 0.4);
            font-size: 18px;
        }

        .click-efect {
            position: absolute;
            top: 0;
            left: 0;
            background: #ED2553;
            border-radius: 50%;
        }

        .overbox {
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            overflow: inherit;
            border-radius: 10px;
            padding: 60px 50px 40px 50px;
        }

        .overbox .title,
        .overbox .button,
        .overbox .input {
            z-index: 111;
            position: relative;
            color: #fff !important;
            display: none;
        }

        .overbox .title {
            width: 80%;
        }

        .overbox .input {
            margin-top: 20px;
        }

        .overbox .input input,
        .overbox .input label {
            color: #fff;
        }

        .overbox .material-button,
        .overbox .material-button .shape,
        .overbox .alt-2,
        .overbox .alt-2 .shape {
            display: block;
        }

        .material-button,
        .alt-2 {
            width: 140px;
            height: 140px;
            border-radius: 50%;
            background: #ED2553;
            position: absolute;
            top: 40px;
            right: -70px;
            cursor: pointer;
            z-index: 100;
            transform: translate(0%, 0%);
            -webkit-transform: translate(0%, 0%);
            -ms-transform: translate(0%, 0%);
        }

        .material-button .shape,
        .alt-2 .shape {
            position: absolute;
            top: 0;
            right: 0;
            width: 100%;
            height: 100%;
        }

        .material-button .shape:before,
        .alt-2 .shape:before,
        .material-button .shape:after,
        .alt-2 .shape:after {
            content: "";
            background: #fff;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(360deg);
            -webkit-transform: translate(-50%, -50%) rotate(360deg);
            -ms-transform: translate(-50%, -50%) rotate(360deg);
        }

        .material-button .shape:before,
        .alt-2 .shape:before {
            width: 25px;
            height: 4px;
        }

        .material-button .shape:after,
        .alt-2 .shape:after {
            height: 25px;
            width: 4px;
        }

        .material-button.active,
        .alt-2.active {
            top: 50%;
            right: 50%;
            transform: translate(50%, -50%) rotate(0deg);
            -webkit-transform: translate(50%, -50%) rotate(0deg);
            -ms-transform: translate(50%, -50%) rotate(0deg);
        }

        body {
            background-image: url(/2019/ic/background2.jpg);
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            min-height: 100vh;
            font-family: 'Roboto', sans-serif;
            overflow-y: scroll;
            background-attachment: fixed;
        }

        body,


        .materialContainer {
            width: 100%;
            max-width: 90%;
            position: absolute;
            /* top: 50%; */
            left: 5%;
            /* transform: translate(-50%, -50%); */
            /* -webkit-transform: translate(-50%, -50%); */
            -ms-transform: translate(-50%, -50%);
        }

        *,
        *:after,
        *::before {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            text-decoration: none;
            list-style-type: none;
            outline: none;
        }
    </style>
</head>

<body>
<div class="materialContainer">
    <div class="box">
        <?php
        use Carbon\Carbon;
        if($user_row->zone == "Zone 1"){
            $zone_coeff = "1";
        }
        if($user_row->zone == "Zone 2"){
            $zone_coeff = "2";
        }
        if($user_row->zone == "Zone 3"){
            $zone_coeff = "3";
        }
        if($user_row->zone == "Zone 4"){
            $zone_coeff = "4";
        }
        ?>
        {{--        <div class="title">Your Exam Credentials</div>--}}
        <div class="row">
            <div class="col-md-4">
                <div class="input">
                    <p>Name</p>
                    <label for="name">{{$user_row->name}}</label>
                    <span class="spin"></span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="input">
                    <p>Roll Number</p>
                    <label for="name">IC-{{$zone_coeff}}{{$user_row->id}}</label>
                    <span class="spin"></span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="input">
                    <p>Zone</p>
                    <label for="name">{{$user_row->zone}}</label>
                    <span class="spin"></span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="input">
                    <p>Date and Time of submission</p>
                    <label for="name">{{$user_row->zone2}}</label>
                    <span class="spin"></span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="input">
                    <p>Registered Email</p>
                    <label for="name">{{$user_row->email}}</label>
                    <span class="spin"></span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="input">
                    <p>Registered Number</p>
                    <label for="name">{{$user_row->number}}</label>
                    <span class="spin"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div>
                <br>
                <h2 style="text-align: center;">INNOVATION CHALLENGE 2019-20</h2>
                <br>
                <p style="text-align: center;">PROBLEM STATEMENT - WATER CRISIS</p>
                <br>
                Water, covering over 71% of the Earth's surface is essential for all living organisms. Out of this only 2.5% of water is available as freshwater suitable to meet basic human needs. On average, every human being requires 20 to 50 litres of water to meet his/her everyday requirements.
                <br>
                With increasing human population and degrading environmental conditions, the availability of usable water is decreasing. According to a UN report on the state of the world’s water, more than 5 billion people could suffer water shortages by 2050 due to climate change, increased demand and polluted supplies
                <br>
                To ensure water security for all take part in this year’s Innovation Challenge presented by Techfest, IIT Bombay in association with Unified Council and thinking out of the box, suggest a solution to overcome the problem of shortage of usable water, thereby ensuring water security for all.
                <br>
                <br>Your proposed solution should be in the following format:
                <br>Title of the proposed solution (in 20 words):  A heading that best describes your solution.
                <br>The aspect of the problem being targeted (in about 50 words): Identify the particular aspect of water crisis your solution is for
                <br>The proposed solution of the problem (in 150-200 words): Propose a solution and explain how your solution is going to solve the water crisis
                <br>Expectation and conclusion (in about 50 words): Justify why you think your idea will be a success in terms of the impact that it will create.
                <br>
                <br>Your idea will be judged on the basis of:
                <br>Feasibility: Whether your idea can be brought to life and be implemented
                <br>Impact: Whether your idea can have a real impact or bring about a change in society
                <br>Scalability: Whether your idea could be scaled from the smallest level to the largest level
                <br>Originality: Whether your idea is self-inspired

            </div>

            <div class="col-md-12">
                <br>
                <a href="/2019/ic/ProblemStatement.pdf">To download Problem Statement click here</a>
            </div>
        </div>

    </div>

    <section>

    </section>
    <script>
   $(function() {

   $(".input input").focus(function() {

      $(this).parent(".input").each(function() {
         $("label", this).css({
            "line-height": "18px",
            "font-size": "18px",
            "font-weight": "100",
            "top": "0px"
         })
         $(".spin", this).css({
            "width": "100%"
         })
      });
   }).blur(function() {
      $(".spin").css({
         "width": "0px"
      })
      if ($(this).val() == "") {
         $(this).parent(".input").each(function() {
            $("label", this).css({
               "line-height": "60px",
               "font-size": "24px",
               "font-weight": "300",
               "top": "10px"
            })
         });

      }
   });

   $(".button").click(function(e) {
      var pX = e.pageX,
         pY = e.pageY,
         oX = parseInt($(this).offset().left),
         oY = parseInt($(this).offset().top);

      $(this).append('<span class="click-efect x-' + oX + ' y-' + oY + '" style="margin-left:' + (pX - oX) + 'px;margin-top:' + (pY - oY) + 'px;"></span>')
      $('.x-' + oX + '.y-' + oY + '').animate({
         "width": "500px",
         "height": "500px",
         "top": "-250px",
         "left": "-250px",

      }, 600);
      $("button", this).addClass('active');
   })

   $(".alt-2").click(function() {
      if (!$(this).hasClass('material-button')) {
         $(".shape").css({
            "width": "100%",
            "height": "100%",
            "transform": "rotate(0deg)"
         })

         setTimeout(function() {
            $(".overbox").css({
               "overflow": "initial"
            })
         }, 600)

         $(this).animate({
            "width": "140px",
            "height": "140px"
         }, 500, function() {
            $(".box").removeClass("back");

            $(this).removeClass('active')
         });

         $(".overbox .title").fadeOut(300);
         $(".overbox .input").fadeOut(300);
         $(".overbox .button").fadeOut(300);

         $(".alt-2").addClass('material-buton');
      }

   })

   $(".material-button").click(function() {

      if ($(this).hasClass('material-button')) {
         setTimeout(function() {
            $(".overbox").css({
               "overflow": "hidden"
            })
            $(".box").addClass("back");
         }, 200)
         $(this).addClass('active').animate({
            "width": "700px",
            "height": "700px"
         });

         setTimeout(function() {
            $(".shape").css({
               "width": "50%",
               "height": "50%",
               "transform": "rotate(45deg)"
            })

            $(".overbox .title").fadeIn(300);
            $(".overbox .input").fadeIn(300);
            $(".overbox .button").fadeIn(300);
         }, 700)

         $(this).removeClass('material-button');

      }

      if ($(".alt-2").hasClass('material-buton')) {
         $(".alt-2").removeClass('material-buton');
         $(".alt-2").addClass('material-button');
      }

   });

});
</script>
</body>

</html>
<!-- end document-->