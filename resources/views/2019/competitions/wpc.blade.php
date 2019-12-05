<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>World Programming Championship | Techfest, IIT Bombay</title>

    <link rel="shortcut icon" type="image/x-icon" href="/2019/ca/images/favicon_logo.png" />
    <meta property="og:image" content="http://techfest.org/2019/compi/wpc.jpg" />

    <meta name="viewport" content= "width=device-width, user-scalable=no">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="" />

    <!-- Facebook and Twitter integration -->
    <meta property="og:title" content=""/>
    <meta property="og:image" content=""/>
    <meta property="og:url" content=""/>
    <meta property="og:site_name" content=""/>
    <meta property="og:description" content=""/>
    <meta name="twitter:title" content="" />
    <meta name="twitter:image" content="" />
    <meta name="twitter:url" content="" />
    <meta name="twitter:card" content="" />


    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->


    <!-- Animate.css -->
    <link rel="stylesheet" href="/2019/compi/cozmo/css/animate.css">
    <!-- Icomoon Icon Fonts-->
    <link rel="stylesheet" href="/2019/compi/cozmo/css/icomoon.css">
    <!-- Bootstrap  -->
    <link rel="stylesheet" href="/2019/compi/cozmo/css/bootstrap.css">
    <!-- Flexslider  -->
    <link rel="stylesheet" href="/2019/compi/cozmo/css/flexslider.css">
    <!-- Theme style  -->
    <link rel="stylesheet" href="/2019/compi/cozmo/css/style.css">

    {{--    <!-- Modernizr JS -->--}}
    <script src="/2019/compi/cozmo/js/modernizr-2.6.2.min.js"></script>
    {{--    <!-- FOR IE9 below -->--}}
<!--[if lt IE 9]>-->
    <script src="/2019/compi/cozmo/js/respond.min.js"></script>
    <link href="https://cdn.jsdelivr.net/foundation/5.3.3/css/foundation.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
    {{--    <![endif]-->--}}
    <style>
        #toast {
            visibility: hidden;
            max-width: 50px;
            height: 50px;
            /*margin-left: -125px;*/
            margin: auto;
            background-color: #333;
            color: #fff;
            text-align: center;
            border-radius: 2px;

            position: fixed;
            z-index: 1;
            left: 0;right:0;
            bottom: 30px;
            font-size: 17px;
            white-space: nowrap;
        }
        #toast #img{
            width: 50px;
            height: 50px;

            float: left;

            padding-top: 16px;
            padding-bottom: 16px;

            box-sizing: border-box;


            background-color: #111;
            color: #fff;
        }
        #toast #desc{


            color: #fff;

            padding: 16px;

            overflow: hidden;
            white-space: nowrap;
        }

        #toast.show {
            visibility: visible;
            -webkit-animation: fadein 0.5s, expand 0.5s 0.5s,stay 3s 1s, shrink 0.5s 2s, fadeout 0.5s 2.5s;
            animation: fadein 0.5s, expand 0.5s 0.5s,stay 3s 1s, shrink 0.5s 4s, fadeout 0.5s 4.5s;
        }

        @-webkit-keyframes fadein {
            from {bottom: 0; opacity: 0;}
            to {bottom: 30px; opacity: 1;}
        }

        @keyframes fadein {
            from {bottom: 0; opacity: 0;}
            to {bottom: 30px; opacity: 1;}
        }

        @-webkit-keyframes expand {
            from {min-width: 50px}
            to {min-width: 350px}
        }

        @keyframes expand {
            from {min-width: 50px}
            to {min-width: 350px}
        }
        @-webkit-keyframes stay {
            from {min-width: 350px}
            to {min-width: 350px}
        }

        @keyframes stay {
            from {min-width: 350px}
            to {min-width: 350px}
        }
        @-webkit-keyframes shrink {
            from {min-width: 350px;}
            to {min-width: 50px;}
        }

        @keyframes shrink {
            from {min-width: 350px;}
            to {min-width: 50px;}
        }

        @-webkit-keyframes fadeout {
            from {bottom: 30px; opacity: 1;}
            to {bottom: 60px; opacity: 0;}
        }

        @keyframes fadeout {
            from {bottom: 30px; opacity: 1;}
            to {bottom: 60px; opacity: 0;}
        }

    </style>
    <style>
        .bg_1 {
            position: fixed;
            top: 00vw;
            height: calc(200vw + 4px);
            overflow: hidden;
        }
        body{
            font-family: Lato;
            background-color: #275E80; /* For browsers that do not support gradients */
            background-image: linear-gradient(to right, #5F4A85 , #70427D);
        }
        .border {
            scrollbar-width: none;
        }



        scroll_inside{
            width: 90%;
            display:block;
            border-radius: 20px;
            background-color: #fff;
            margin-bottom: 1%;
            overflow-y: scroll;
            height:20%;
            border: 1px solid #000000;
            font-size: 17px;
            font-family: Lato;

        }

        @media (min-width:992px) {

            .mobile_hide{
                /*background-color: transparent;*/

                background-size: 100% 100%;
                background-image: url(/2019/compi/wpc.jpg) ;
                box-shadow: 3px 3px 8px black;
                /*border: solid 2.5px;*/
                /*border-radius: 5px;*/

            }
            .about-img{

            }
        }
        @media (max-width:992px) {

            .mobile_hide{
                height: 0px;
            }
            .about-img{

            }
        }



    </style>
    <style>

        @-webkit-keyframes rotation {
            from {
                -webkit-transform: rotateZ(0deg);
            }
            to {
                -webkit-transform: rotateZ(359deg);
            }
        }
        .mandala1 {
            position: fixed;
            top: calc(30% - 140px);
            left: calc(2% - 330px);
            height: 900px;
            /*width: 680px;*/
            z-index:0;
            overflow-x: hidden;
            opacity: 0.2;
            /*transform: rotateY(45deg) rotateX(45deg);*/
            /*transform-style: preserve-3d;*/
            /*animation: rotation 30s infinite linear;*/
            /*rotation: 20deg;*/
        }
        .mandala2 {
            position: fixed;
            top: calc(15% - 140px);
            left: calc(90% - 330px);
            height: 300px;
            z-index:0;
            overflow-x: hidden;
            opacity: 0.2;
            /*transform: rotateY(45deg) rotateX(45deg);*/
            /*transform-style: preserve-3d;*/
            animation: rotation 10s infinite linear;
            /*rotation: 20deg;*/
        }
        .mandala3 {
            position: fixed;
            top: calc(75% - 140px);
            left: calc(102% - 330px);
            height: 450px;
            /*width: 680px;*/
            z-index:0;
            overflow-x: hidden;
            opacity: 0.2;
            /*transform: rotateY(45deg) rotateX(45deg);*/
            /*transform-style: preserve-3d;*/
            animation: rotation reverse 15s infinite linear;
            /*rotation: 20deg;*/
        }

    </style>
    <style>
        .dropbtn {
            background-color: transparent;
            color: white;
            padding: 16px;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            right: 4px;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 4px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {background-color: #f1f1f1;}

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown:hover .dropbtn {
            background-color: black;
        }
    </style>
    <style>
        .sign_in{
            /*margin: 0%;*/
            float: right;
        }
        .mandala1 {
            position: absolute;
            top: calc(30% - 140px);
            left: calc(32% - 330px);
            height: 600px;
            z-index:0;
            overflow: hidden;
            opacity: 0.2;
            /*transform: rotateY(45deg) rotateX(45deg);*/
            /*transform-style: preserve-3d;*/
            /*animation: rotation 30s infinite linear;*/
            /*rotation: 20deg;*/
        }
    </style>
    <style>
        #snackbar {
            visibility: hidden;
            width: 250px;
            margin-left: -125px;
            background-color: #333;
            color: #fff;
            text-align: center;
            border-radius: 2px;
            padding: 16px;
            position: fixed;
            z-index: 1;
            left: 50%;
            bottom: 30px;
            font-size: 17px;
        }

        #snackbar.show {
            visibility: visible;
            -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
            animation: fadein 0.5s, fadeout 0.5s 2.5s;
        }

        @-webkit-keyframes fadein {
            from {bottom: 0; opacity: 0;}
            to {bottom: 30px; opacity: 1;}
        }

        @keyframes fadein {
            from {bottom: 0; opacity: 0;}
            to {bottom: 30px; opacity: 1;}
        }

        @-webkit-keyframes fadeout {
            from {bottom: 30px; opacity: 1;}
            to {bottom: 0; opacity: 0;}
        }

        @keyframes fadeout {
            from {bottom: 30px; opacity: 1;}
            to {bottom: 0; opacity: 0;}
        }
    </style>
</head>

<body>

{{--<img class="bg_1" src="/2019/compi/images/web_backgrounds_1.png"  alt="">--}}
<img class="mandala1" src="/2019/homepage/images/b_mandala.png" >

<div id="colorlib-page"  >

    <a href="#" class="js-colorlib-nav-toggle colorlib-nav-toggle"><i></i></a>
    <aside id="colorlib-aside" role="complementary" class="border js-fullheight" >
        <a href="/"><img src="/2019/homepage/logo_edit.png" alt="" style="width: 130%; margin-left:-15%"></a>
        <a href="https://www.codingninjas.in/"><img src="/2019/compi/images/Asset 3.png" alt="" style="width: 65%; margin-top: 10%;"></a>
        <a href="https://www.pitneybowes.com/in/"><img  src="/2019/compi/images/int_pb_hor_rgb_grd_pos.png" alt="" style="width: 65%; margin-top: 10%;background-color: white"></a>

        <nav id="colorlib-main-menu" role="navigation" style="margin-top: 20vh; font-size: medium; ">
            <ul>
                <li ><a href="/competitions">Home</a></li>
{{--                <li ><a onclick="myFunction1()">Structure</a></li>--}}
                <li ><a onclick="myFunction5()">Results</a></li>
                <li ><a onclick="myFunction2()">Judging</a></li>
                <li ><a onclick="myFunction3()">FAQs</a></li>
                <li ><a onclick="myFunction4()">Contact Us</a></li>

            </ul>
        </nav>


    </aside>
    <style>


        .cover {
            height: 100%;
            width: 100%;
            position: absolute;
            z-index: 1;
        }

        .blur-in {
            -webkit-animation: blur 2s forwards;
            -moz-animation: blur 2s forwards;
            -o-animation: blur 2s forwards;
            animation: blur 2s forwards;
        }

        .blur-out {
            -webkit-animation: blur-out 2s forwards;
            -moz-animation: blur-out 2s forwards;
            -o-animation: blur-out 2s forwards;
            animation: blur-out 2s forwards;
        }

        @-webkit-keyframes blur {
            0% {
                -webkit-filter: blur(0px);
                -moz-filter: blur(0px);
                -o-filter: blur(0px);
                -ms-filter: blur(0px);
                filter: blur(0px);
            }

            100% {
                -webkit-filter: blur(4px);
                -moz-filter: blur(4px);
                -o-filter: blur(4px);
                -ms-filter: blur(4px);
                filter: blur(4px);
            }
        }

        @-moz-keyframes blur {
            0% {
                -webkit-filter: blur(0px);
                -moz-filter: blur(0px);
                -o-filter: blur(0px);
                -ms-filter: blur(0px);
                filter: blur(0px);
            }

            100% {
                -webkit-filter: blur(4px);
                -moz-filter: blur(4px);
                -o-filter: blur(4px);
                -ms-filter: blur(4px);
                filter: blur(4px);
            }
        }

        @-o-keyframes blur {
            0% {
                -webkit-filter: blur(0px);
                -moz-filter: blur(0px);
                -o-filter: blur(0px);
                -ms-filter: blur(0px);
                filter: blur(0px);
            }

            100% {
                -webkit-filter: blur(4px);
                -moz-filter: blur(4px);
                -o-filter: blur(4px);
                -ms-filter: blur(4px);
                filter: blur(4px);
            }
        }

        @keyframes blur {
            0% {
                -webkit-filter: blur(0px);
                -moz-filter: blur(0px);
                -o-filter: blur(0px);
                -ms-filter: blur(0px);
                filter: blur(0px);
            }

            100% {
                -webkit-filter: blur(4px);
                -moz-filter: blur(4px);
                -o-filter: blur(4px);
                -ms-filter: blur(4px);
                filter: blur(4px);
            }
        }

        @-webkit-keyframes blur-out {
            0% {
                -webkit-filter: blur(4px);
                -moz-filter: blur(4px);
                -o-filter: blur(4px);
                -ms-filter: blur(4px);
                filter: blur(4px);
            }

            100% {
                -webkit-filter: blur(0px);
                -moz-filter: blur(0px);
                -o-filter: blur(0px);
                -ms-filter: blur(0px);
                filter: blur(0px);
            }
        }

        @-moz-keyframes blur-out {
            0% {
                -webkit-filter: blur(4px);
                -moz-filter: blur(4px);
                -o-filter: blur(4px);
                -ms-filter: blur(4px);
                filter: blur(4px);
            }

            100% {
                -webkit-filter: blur(0px);
                -moz-filter: blur(0px);
                -o-filter: blur(0px);
                -ms-filter: blur(0px);
                filter: blur(0px);
            }
        }

        @-o-keyframes blur-out {
            0% {
                -webkit-filter: blur(4px);
                -moz-filter: blur(4px);
                -o-filter: blur(4px);
                -ms-filter: blur(4px);
                filter: blur(4px);
            }

            100% {
                -webkit-filter: blur(0px);
                -moz-filter: blur(0px);
                -o-filter: blur(0px);
                -ms-filter: blur(0px);
                filter: blur(0px);
            }
        }

        @keyframes blur-out {
            0% {
                -webkit-filter: blur(4px);
                -moz-filter: blur(4px);
                -o-filter: blur(4px);
                -ms-filter: blur(4px);
                filter: blur(4px);
            }

            100% {
                -webkit-filter: blur(0px);
                -moz-filter: blur(0px);
                -o-filter: blur(0px);
                -ms-filter: blur(0px);
                filter: blur(0px);
            }
        }

        .content {
            width: 650px;
            margin: 0 auto;
            padding-top: 100px;
        }



        .pop-up {
            position: fixed;
            margin: 5% auto;
            left: 0;
            right: 0;
            z-index: 2;
        }

        .box {
            background-color: whitesmoke;
            text-align: center;
            margin-left: auto;
            margin-right: auto;
            margin-top: 10%;
            position: relative;
            -webkit-box-shadow: 0px 4px 6px 0px rgba(0,0,0,0.1);
            -moz-box-shadow: 0px 4px 6px 0px rgba(0,0,0,0.1);
            box-shadow: 0px 4px 6px 0px rgba(0,0,0,0.1);
        }

        .button {
            margin 0 auto;
            background-color: #FF8566;
            margin-bottom: 33px;
        }

        .button:hover {
            background-color: #7CCF29;
            -webkit-box-shadow: 0px 4px 6px 0px rgba(0,0,0,0.1);
            -moz-box-shadow: 0px 4px 6px 0px rgba(0,0,0,0.1);
            box-shadow: 0px 4px 6px 0px rgba(0,0,0,0.1);
        }

        .close-button {
            transition: all 0.5s ease;
            position: absolute;
            background-color: #FF9980;
            padding: 1.5px 7px;
            left: 0;
            margin-left: -10px;
            margin-top: -9px;
            border-radius: 50%;
            border: 2px solid #fff;
            color: white;
            -webkit-box-shadow: -4px -2px 6px 0px rgba(0,0,0,0.1);
            -moz-box-shadow: -4px -2px 6px 0px rgba(0,0,0,0.1);
            box-shadow: -3px 1px 6px 0px rgba(0,0,0,0.1);
        }

        .close-button:hover {
            background-color: tomato;
            color: #fff;
        }



    </style>
    <div class="row pop-up " >
        <div class="box small-6 large-centered " style="border-radius: 10px; ">
            <a href="#" class="close-button">&#10006;</a>
            <br>

{{--            <h4>Check the "Results" section for Top Champions of<br> World Programming Championship </h4>--}}
             <h4>Check the "Results" section<br> for the Top Champions of<br> World Programming Championship </h4>
{{--            <p>2. Ajay Gunjal | Walchand College of Engineering, Sangli<br></p>--}}
{{--            <p>3. Aman Bansal | Indian Institute of Technology, Bombay<br></p>--}}
{{--            <p>4. Rahul Bhardwaj | Indian Institute of Technology, Bombay<br></p>--}}
{{--            <p>5. Abhishek Vanjani | Netaji Subhas Institute of Technology, Delhi<br></p>--}}
{{--            <p>6. Tanmay Santosh Pandit | Indian Institute of Technology, Jodhpur<br></p>--}}
{{--            <p>7. Shubham Gupta | Indian Institute of Technology, Bombay<br></p>--}}
{{--            <p>8. Kalash Gupta | Indian Institute of Technology, Delhi<br></p>--}}
{{--            <p>9. Mradul Bhatnagar | BITS Pilani K K Birla, Goa Campus<br></p>--}}
{{--            <p>10. Rishabh Agrawal | National Institute of Technology, Nagpur<br></p>--}}

{{--            <a href="https://codingninjas.in/events/world-programming-championship" class="button">Register</a>--}}

{{--            <h4>Those who have registered, they can directly go to this link</h4>--}}
{{--            <a href="https://classroom.codingninjas.in/app/classroom/me/1326/content/21045/offering/204496" class="button">Test Link</a>--}}

            <br>
        </div>
    </div>
    <div id="colorlib-main">
        {{--        <button class="btn-learn js-colorlib-nav-toggle colorlib-nav-toggle"  style="float: left;margin-top: 4px"><i></i></button>--}}

        @if(empty($user_row->email))
            <button class="btn btn-primary btn-learn  sign_in" id="signinButton" style="float: right;margin-top: 4px">Sign In</button>
        @endif

        @if(!empty($user_row->email))
            <button class="btn btn-primary btn-learn  sign_in" style="float: right;margin-top: 4px"><a href="/competitions/logout" >Sign Out</a></button>
        @endif
        @include('2019.competitions.layouts.all_competitions')



        {{--        <button class="btn sign_in">Sign-In</button>--}}


        <div class="colorlib-about" style="margin-top: -20px;padding-top: 0px;">
            <div class="container-fluid">
                <div class="row ">
                    <div class="col-md-4 " style="margin-left: 4%; width: 30%; height: 50%">
                        <div class="about-img animate-box mobile_hide" data-animate-effect="fadeInLeft"></div>
                    </div>
                    <div class="col-md-8 animate-box" data-animate-effect="fadeInLeft" style="margin-right:-1%; padding-left:2.5% ;padding-right: -50%">
                        <div class="about-desc" style="margin-right: 0%; padding: 0px" >
                            {{--                            <span class="heading-meta">Welcome &amp; Introduce</span>--}}
                            <div style="display: inline">
                                <h2 style="color: white; font-weight: bold;display: inline">World Programming Championship</h2>
                                {{--                                <a href="https://www.jlt.com/"><img  src="/2019/compi/images/jlt_logo.png" alt="" style="max-height: 6vh;margin-top: -13px;"></a>--}}
                            </div>

                            <hr style="color: white; border: 1px solid white">
                            <h3 style="color: white">Prizes Worth: INR 1,00,000/- </h3>
                            <h3 style="color: white">Date: 3rd November, 2019 </h3>


                            <p style=" font-size: 15px; width:90%; font-family: Lato;color: white; text-align: justify ">
                                Participants are required to solve some of the most innovative problems through coding. Programming and algorithmic skills of the participants will be tested.
                                <br>Date for the competition is 3rd November, 2019.
                                <br>Sit back at your home and conquer the challenge.
                            </p>

{{--                            <a href="/2019/compi/ps/JLT-India-Challenge-PS.pdf" target="_blank" class="btn btn-primary btn-learn">Problem Statement</a>--}}

                            @if(!empty($user_row->email))
                                @if($user_row->wpc == 0 or empty($user_row->wpc))
                                    {{--                                        if he is not registered--}}
{{--                                    <a href="/competitions/wpc/reg" class="btn btn-primary btn-learn" >Register</a>--}}
                                    <a href="#" class="btn btn-primary btn-learn" >Registration Closed</a>
                                @endif



                            @endif
                            @if(empty($user_row->email))
                                <button class="btn btn-primary btn-learn" >Registration Closed</button>
                            @endif
                            @if(!empty($user_row))
                                @if($user_row->wpc > 0 )
                                    <div class="alert alert-success">
                                        <p><strong>Hi {{$user_row->name}}, you are successfully registered for World Programming Championship with <b>{{$user_row->email}}</b> as your Registered email id.</strong></p>
                                    </div>
                                @endif
                            @endif


                        </div>

                    </div>
                </div>
            </div>

        </div>

        {{--        <div class="scroll box123">--}}
        <div id="text_change" class="col-md-12 animate-box scroll_inside" data-animate-effect="fadeInLeft" style="
            width: 90%;
            display:block;
            border-radius: 5px;
            /*background-color: #fff;*/
            margin-bottom: 1%;
            height:auto;
            left: 5%;
            color: white;
            border: 1px solid white;
            font-size: 17px;
            margin-left: -9px;
            margin-top: 8px;
            font-family: Lato;">
            <p id="text_change" style="margin-bottom: 0px; color: white">
                <br>
                Format: It is an online programming contest. There will be multiple problems and points would be allotted on solving the problems. Each question may have different points depending on the difficulty level of the problem.
                <br> <br>You can sit back in your homes and give this test online. All you need is a good internet connectivity and a quiet environment.
                <br><br>
                Interface: Coding Ninjas will provide the interface using which the teams will submit their codes online and their codes will be evaluated on the same interface.
                <br> <br>
                Programming language: C, C++, PYTHON, JAVA.
                <br> <br>
            </p>
        </div>
        <div id="snackbar" style="z-index: 10;">You must be SIGNED IN to register</div>
        {{--        </div>--}}
    </div>
</div>

<form action="" method="post" id="h-form" class="">
    {{csrf_field()}}
    <input type="hidden" name ="code" id="name2" style="background-color: blue">
</form>

<!-- jQuery -->
<script src="/2019/compi/cozmo/js/jquery.min.js"></script>
<!-- jQuery Easing -->
<script src="/2019/compi/cozmo/js/jquery.easing.1.3.js"></script>
<!-- Bootstrap -->
<script src="/2019/compi/cozmo/js/bootstrap.min.js"></script>
<!-- Waypoints -->
<script src="/2019/compi/cozmo/js/jquery.waypoints.min.js"></script>
<!-- Flexslider -->
<script src="/2019/compi/cozmo/js/jquery.flexslider-min.js"></script>
<!-- Sticky Kit -->
<script src="/2019/compi/cozmo/js/sticky-kit.min.js"></script>


<!-- MAIN JS -->
<script src="/2019/compi/cozmo/js/main.js"></script>

<script>
    function launch_toast() {
        var x = document.getElementById("toast")
        x.className = "show";
        setTimeout(function(){ x.className = x.className.replace("show", ""); }, 5000);
    }
</script>

{{--<script>--}}
{{--    function myFunction0() {--}}
{{--        document.getElementById("text_change").innerHTML = "<br>Teams must build a manually controlled bot which can do simple tasks of gripping blocks while overcoming the obstacles and completing the run by earning maximum points in minimum time. The bot can be wired or wireless. In case the participants use a wireless mechanism, they must use a dual frequency remote.<br>";--}}
{{--        // document.getElementById("text_change").innerHTML = "";--}}
{{--    }--}}
{{--</script>--}}

<script>
    function myFunction1() {
        document.getElementById("text_change").innerHTML = "<br>Stage 1 - Submission of detailed functional description of the solution including proposed technical approach to develop it. Successful submissions must include detailed technical Specifications.<br>" +
        "<br>Stage 2 - Selected teams will move to Stage 2. Here the proposed solution needs to be developed (prototyped) for alpha testing. The selected teams will have an opportunity to submit proposed approach and present their solution to JLT team to receive feedback. Successful\n" +
            "submissions must have clearly outlined approach to develop the prototype along with an\n" +
            "initial version of their prototype. <br>" +
            "<br>Stage 3 - Top 15 teams will be selected and would get the chance to participate in the Grand Finale at Techfest, IIT Bombay which is from 3rd-5th January. Here, the\n" +
            "proposed prototype will be developed into working application for beta testing and demonstrated to a panel of judges. <br>";
        document.body.click("body");
    }
</script>

<script>
    function myFunction3() {

        document.getElementById("text_change").innerHTML = "<br>Q. Why should I participate in World Programming Championship?<br>" +
            "This Game of Codes provides the participants with amazing coding challenges and an international platform to showcase their coding skills.<br>" +
            "<br>Q. Who can participate?" +
            "<br>Student from any college and university can participate. The students must have a valid college/ school ID." +
            "<br> <br>Q. How to register for WPC?" +
            "<br>Please follow these steps: www.techfest.org -> Competitions -> World Programming Championship -> Register" +
            "<br> <br>Q. Where should I report to give this test?" +
            "<br>You can sit back in your homes and give this test online. All you need is a good internet connectivity and a quiet environment."+
            "<br> <br>Q. How many members should be there in a group?" +
            "<br>A team should have only one member<br> <br>" ;
        document.body.click("body");

    }
</script>


<script>
    function myFunction2() {

        document.getElementById("text_change").innerHTML = " <br>" +
            "Evaluation: Evaluation will be done online and the winner will be declared on the basis of maximum points scored. Time taken to solve a problem will be recorded. In case of a tie, the time taken would be the criterion to decide the winner. Complete marking scheme will be declared along with the problems.<br>" +
            "<br>General Rules: The organizers reserve the rights to change any or all of the above rules as they deem fit. Change in rules, if any, will be highlighted on the website and notified to the registered participants.<br>" +
            "<br>Note that at any point of time, the latest information will be that which is on the website. The information provided in the PDF downloaded earlier may not be the latest. However, registered participants will be informed through the mail about any such changes.<br>" +
            "<br>Team Specifications: A team should consist of only one member.<br>" +
            "<br>Certificate Policy: Certificate of excellence will be awarded to the top 15 winners.<br><br>";
        document.body.click("body");

    }
</script>
<script>
    function myFunction5() {

        document.getElementById("text_change").innerHTML = " <br>" +
                "Top Champions of World Programming Championship"+
             "<br><br>1. Chandan Agrawal  |  Poornima College of Engineering, Jaipur<br>"+
            "2. Ajay Gunjal | Walchand College of Engineering, Sangli<br>"+
                    "3. Aman Bansal | Indian Institute of Technology, Bombay<br>"+
                    "4. Rahul Bhardwaj | Indian Institute of Technology, Bombay<br>"+
                    "5. Abhishek Vanjani | Netaji Subhas Institute of Technology, Delhi<br>"+
                    "6. Tanmay Santosh Pandit | Indian Institute of Technology, Jodhpur<br>"+
                    "7. Shubham Gupta | Indian Institute of Technology, Bombay<br>"+
                    "8. Kalash Gupta | Indian Institute of Technology, Delhi<br>"+
                    "9. Mradul Bhatnagar | BITS Pilani K K Birla, Goa Campus<br>"+
                    "10. Rishabh Agrawal | National Institute of Technology, Nagpur<br><br>"
        document.body.click("body");

    }
</script>
<script>
    function myFunction4() {
        document.getElementById("text_change").innerHTML = "<br>Abhinav Kumar<br>+91 8299544527 <br>abhinav@techfest.org<br><br> ";
        document.body.click("body");

    }
</script>
<style>
    $(".modal-backdrop").click()
</style>
<script>
    function loadScript( url, callback ){
        script = document.createElement("script");
        script.type = "text/javascript";
        if(script.readyState) {
            script.onreadystatechange = function() {
                if ( script.readyState === "loaded" || script.readyState === "complete" ) {
                    script.onreadystatechange = null;
                    callback();
                }
            };
        } else {
            script.onload = function() {
                callback();
            };
        }
        script.src = url;
    }
    function start() {
        gapi.load('auth2', function() {
            auth2 = gapi.auth2.init({
                client_id: '218886856483-4lnh6s9mvguid18098antfdltvosd7ln.apps.googleusercontent.com',
            });
        });

    }
    function authCheck(){
        console.log('called');
        auth2.grantOfflineAccess().then(response => {
            $('#name2').val(response.code);
            $("#h-form").submit();
        });

    }
    loadScript("https://apis.google.com/js/client:platform.js",function(){
        start();
        $('#signinButton, #googleLogin').click(function(){

            authCheck();
        });

    });
    document.getElementsByTagName( "head" )[0].appendChild( script );

    // $("#h-form").submit();
    // document.getElementById("h-form").submit();// Form submission


</script>
<script>
    function myFunction() {
        var x = document.getElementById("snackbar");
        x.className = "show";
        setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
    }
</script>
<script>
    $(function() {
  $('.pop-up').hide();
  $('.pop-up').fadeIn(1000);

      $('.close-button').click(function (e) {

      $('.pop-up').fadeOut(700);
      $('#overlay').removeClass('blur-in');
      $('#overlay').addClass('blur-out');
      e.stopPropagation();

    });
 });
</script>
</body>
</html>




{{--        <div class="fancy-collapse-panel">--}}
{{--            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">--}}
{{--                <div class="panel panel-default">--}}
{{--                    <div class="panel-heading" role="tab" id="headingOne">--}}
{{--                        <h4 class="panel-title">--}}
{{--                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Why choose me?--}}
{{--                            </a>--}}
{{--                        </h4>--}}
{{--                    </div>--}}
{{--                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">--}}
{{--                        <div class="panel-body">--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. </p>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <p>Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="panel panel-default">--}}
{{--                    <div class="panel-heading" role="tab" id="headingTwo">--}}
{{--                        <h4 class="panel-title">--}}
{{--                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">What I do?--}}
{{--                            </a>--}}
{{--                        </h4>--}}
{{--                    </div>--}}
{{--                    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">--}}
{{--                        <div class="panel-body">--}}
{{--                            <!--									            <p>Far far away, behind the word <strong>mountains</strong>, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>-->--}}
{{--                            <ul>--}}
{{--                                <li>Q. Why should I participate in Cozmo Clench?</li>--}}
{{--                                <li>A. The competition provides its participants with a reasonable grasp of important mechanical and programming principles that will take them in the direction of being able to design and construct their own gripping robot. Participants work together to design and build a robotic vehicle that can navigate on an obstacle-filled course while moving blocks from one location to another.</li>--}}
{{--                                <li>Q. How to register?</li>--}}
{{--                                <li>A. Follow these steps for registration :</li>--}}
{{--                                <p>   www.techfest.org -> Competitions > Cozmo Clench -> Explore More -> Register -> Fill all your details -> Your team will be formed and now you can add other team members </p>--}}
{{--                                <li>Q. How many people can be there in one team?</li>--}}
{{--                                <li>A. One team can have maximum of 4 members.</li>--}}
{{--                                <li>Q. Can a team have members from different colleges?</li>--}}
{{--                                <li>A. Yes, students from different college can form a team.</li>--}}
{{--                                <li>Q. How many stages does the competition have?</li>--}}
{{--                                <li>A. Two, namely zonal qualifier and finale. Top five teams from Each Zonal Qualifier will qualify for the Grand Finale at Techfest 2019-20.</li>--}}
{{--                                <li>Q. Can I register in more than one competition?</li>--}}
{{--                                <li>A. Yes, you can participate in more than one competition. However, it is recommended to focus on one competition as there may be some chances of slot clash.</li>--}}
{{--                                <li>Q. Will any charging facility for our equipment be provided at the venue?</li>--}}
{{--                                <li>A. Any kind of charging facility will not be provided to the participants at the venue. The bot must have an onboard power supply.</li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="panel panel-default">--}}
{{--                    <div class="panel-heading" role="tab" id="headingThree">--}}
{{--                        <h4 class="panel-title">--}}
{{--                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">My Specialties--}}
{{--                            </a>--}}
{{--                        </h4>--}}
{{--                    </div>--}}
{{--                    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">--}}
{{--                        <div class="panel-body">--}}
{{--                            <p>Far far away, behind the word <strong>mountains</strong>, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

