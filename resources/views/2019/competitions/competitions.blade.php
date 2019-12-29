<!DOCTYPE html>
<html lang="en">
<head>
    <title>Competitions | Techfest, IIT Bombay</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="shortcut icon" type="image/x-icon" href="/2019/ca/images/favicon_logo.png" />
    <meta property="og:image" content="https://techfest.org/2019/compi/compppetitions.jpg" />


    {{--    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800&display=swap" rel="stylesheet">--}}
    {{--    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">--}}
    {{--    <link href="https://fonts.googleapis.com/css?family=Great+Vibes&display=swap" rel="stylesheet">--}}
    <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/2019/compi/css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="/2019/compi/css/animate.css">

    <link rel="stylesheet" href="/2019/compi/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/2019/compi/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="/2019/compi/css/magnific-popup.css">

    <link rel="stylesheet" href="/2019/compi/css/aos.css">

    <link rel="stylesheet" href="/2019/compi/css/ionicons.min.css">

    <link rel="stylesheet" href="/2019/compi/css/flaticon.css">
    <link rel="stylesheet" href="/2019/compi/css/icomoon.css">
    <link rel="stylesheet" href="/2019/compi/css/style.css">


    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-81222017-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-81222017-1');
    </script>
    <!-- Global site tag (gtag.js) - Google Analytics -->



    <!--	  &lt;!&ndash; Icon css link &ndash;&gt;-->
    <!--	  <link href="vendors3/material-icon/css/materialdesignicons.min.css" rel="stylesheet">-->
    <!--	  <link href="/2019/compi/css3/font-awesome.min.css" rel="stylesheet">-->
    <!--	  <link href="vendors3/linears-icon/style.css" rel="stylesheet">-->
    <!--	  &lt;!&ndash; Bootstrap &ndash;&gt;-->
    <!--	  <link href="/2019/compi/css3/bootstrap.min.css" rel="stylesheet">-->

    <!--	  &lt;!&ndash; Rev slider css &ndash;&gt;-->
    <!--	  <link href="vendors3/revolution/css/settings.css" rel="stylesheet">-->
    <!--	  <link href="vendors3/revolution/css/layers.css" rel="stylesheet">-->
    <!--	  <link href="vendors3/revolution/css/navigation.css" rel="stylesheet">-->

    <!--	  &lt;!&ndash; Extra plugin css &ndash;&gt;-->
    <!--	  <link href="vendors3/bootstrap-selector/bootstrap-select.css" rel="stylesheet">-->
    <!--	  <link href="vendors3/bootatrap-date-time/bootstrap-datetimepicker.min.css" rel="stylesheet">-->
    <!--	  <link href="vendors3/owl-carousel/assets/owl.carousel.css" rel="stylesheet">-->

    <link href="/2019/compi/css3/style.css" rel="stylesheet">
    <!--	  <link href="/2019/compi/css3/responsive.css" rel="stylesheet">-->

    <style>
        ::-webkit-scrollbar {
            width: 0px;  /* Remove scrollbar space */
            background: transparent;  /* Optional: just make scrollbar invisible */
        }
        body{
            font-family: Lato!important;
            overflow-x: hidden;
            background-color: #275E80; /* For browsers that do not support gradients */
            background-image: linear-gradient(to right, #5F4A85 , #70427D);
        }

        .owl-carousel .owl-stage, .owl-carousel.owl-drag .owl-item{
            -ms-touch-action: auto;
            touch-action: auto;
        }
    </style>
    <style>


        .mandala1 {
            position: absolute;
            top: calc(110% - 17%);
            left: calc(-8% - 20%);
            height: 950px;
            /*width: 680px;*/
            z-index:0;
            overflow: hidden;
            opacity: 0.2;
            /*transform: rotateY(45deg) rotateX(45deg);*/
            /*transform-style: preserve-3d;*/
            animation: rotation 30s infinite linear;
            /*rotation: 20deg;*/
        }
        .ansh {
            position: absolute;
            z-index:0;
            overflow: hidden;
            /*opacity: 0.2;*/
            /*animation: rotation 30s infinite linear;*/
            /*!*rotation: 20deg;*!*/
        }
        .mandala2 {
            position: absolute;
            bottom: calc(-245% - 140px);
            left: calc(90% - 330px);
            height: 800px;
            z-index:0;
            overflow: hidden;
            opacity: 0.2;
            /*transform: rotateY(45deg) rotateX(45deg);*/
            /*transform-style: preserve-3d;*/
            animation: rotation reverse 20s infinite linear;
            /*rotation: 20deg;*/
        }
        .mandala3 {
            position: fixed;
            top: calc(750% - 140px);
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

        .recent_blog_text_inner {
            opacity: 1;
            display: block;
            /*background: white;*/
            width: 100%;
            height: 129px;
            transition: .5s ease;
            backface-visibility: hidden;
            z-index: 3;
        }

        .middle {
            transition: .5s ease;
            opacity: 0;
            position: absolute;
            /*background: white;*/
            top: 35%;
            left: 50%;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            text-align: center;
            z-index: 3;
        }

        .recent_bloger_area .recent_blog_item .blog_img:before{
            background-color: white;
            opacity: 0.7;
            /*border: black solid 5px;*/
        }

        .recent_blog_item:hover .blog_img{
            opacity: 1;
            webkit-filter: blur(8px); /* Chrome, Safari, Opera */
            filter: blur(8px);
        }


        .recent_blog_item:hover .recent_blog_text_inner {
            opacity: 1;
        }

        .recent_blog_item:hover .middle {
            opacity: 1;
        }

        .ram1{
            padding: 0px 0px;
            margin:-50px 0px 0px 0px;
            /*background: white;*/
            font-size: 15px;
            /*font-weight: bold;*/
            color:black;
            text-align: left;
            width: 250px;
            height: 100px;
            opacity:1;
            z-index: 5;

        }

        .ram2{
            padding: 0px 0px;
            margin:-40px 0px 0px 0px;
            /*background: white;*/
            font-size: 15px;
            /*font-weight: bold;*/
            color:black;
            text-align: left;
            width: 250px;
            height: 100px;
            opacity:1;
            z-index: 5;

        }
        .fevicol{
            background-color:  #5F4A85 ;
            opacity: 1;
        }


        .textcompi {
            background: rgba(255, 255, 255, 0);
            font-size: 20px;
            color: #ff6111;
        }
        .arrow1{
            margin-top: 2%;
            margin-left: -107%;
            color: white;
            margin-bottom: 13%;
            height: 60px;
            z-index: 2;
        }
        .arrow2{
            margin-top: 2%;
            margin-left: -62%;
            color: white;
            margin-bottom: 13%;
            height: 60px;
            z-index: 2;
        }

        .arrow3{
            margin-top: 2%;
            margin-left: -58%;
            color: white;
            margin-bottom: 13%;
            height: 60px;
            z-index: 2;
        }
        .arrow4{
            margin-top: 2%;
            margin-left: -130%;
            color: white;
            margin-bottom: 13%;
            height: 60px;
            z-index: 2;
        }
        .arrow5{
            /*margin-top: 2%;*/
            margin-left: 25%;
            color: white;
            margin-bottom: 2%;
            height: 170px;
            /*z-index: 1;*/
        }

        .card{
            width: 100%;
            z-index: 3;
        }
        .img_compi{
            width: 100%;
        }
        .img_c{
            width: 100%;
        }
        .techno_text{
            width: 100%;
            color: white;
            /* background-color: white; */
            padding: 5%;
            border: solid;
            /*border-radius: 10px;*/
            z-index: 2;
            text-align: left;
        }
        .layout{
            max-width: 50%;
            z-index: 1;
            padding: 3%;
        }
        .ftco-counter{
            background-color: #fff;
        }
        .recent_blog_text {
            padding: 0px 0px!important;
        }

    </style>
    <style>
        .bg_1 {
            position: fixed;
            width: 100vw;
            top: 00vw;
            height: 200vw;
        }

    </style>
    <style>
        .arrow
        {
            position: absolute;
            bottom: 2rem;
            left: 50%;
            margin-left:-20px;
            width: 40px;
            height: 40px;
            z-index: 10;

            /**
             * Dark Arrow Down
             */
            background-image: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxNi4wLjAsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+DQo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkxheWVyXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4IiB3aWR0aD0iNTEycHgiIGhlaWdodD0iNTEycHgiIHZpZXdCb3g9IjAgMCA1MTIgNTEyIiBlbmFibGUtYmFja2dyb3VuZD0ibmV3IDAgMCA1MTIgNTEyIiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxwYXRoIGZpbGw9IiNGRkZGRkYiIGQ9Ik0yOTMuNzUxLDQ1NS44NjhjLTIwLjE4MSwyMC4xNzktNTMuMTY1LDE5LjkxMy03My42NzMtMC41OTVsMCwwYy0yMC41MDgtMjAuNTA4LTIwLjc3My01My40OTMtMC41OTQtNzMuNjcyICBsMTg5Ljk5OS0xOTBjMjAuMTc4LTIwLjE3OCw1My4xNjQtMTkuOTEzLDczLjY3MiwwLjU5NWwwLDBjMjAuNTA4LDIwLjUwOSwyMC43NzIsNTMuNDkyLDAuNTk1LDczLjY3MUwyOTMuNzUxLDQ1NS44Njh6Ii8+DQo8cGF0aCBmaWxsPSIjRkZGRkZGIiBkPSJNMjIwLjI0OSw0NTUuODY4YzIwLjE4LDIwLjE3OSw1My4xNjQsMTkuOTEzLDczLjY3Mi0wLjU5NWwwLDBjMjAuNTA5LTIwLjUwOCwyMC43NzQtNTMuNDkzLDAuNTk2LTczLjY3MiAgbC0xOTAtMTkwYy0yMC4xNzgtMjAuMTc4LTUzLjE2NC0xOS45MTMtNzMuNjcxLDAuNTk1bDAsMGMtMjAuNTA4LDIwLjUwOS0yMC43NzIsNTMuNDkyLTAuNTk1LDczLjY3MUwyMjAuMjQ5LDQ1NS44Njh6Ii8+DQo8L3N2Zz4=);
            background-size: contain;
        }

        .bounce { z-index: 1;
            /*transition :0.5s;*/
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-30px);
            }
            60% {
                transform: translateY(-15px);
            }
        }
    </style>
    <style>
        .bg_1 {
            position: fixed;
            width: 100vw;
            top: 00vw;
            height: 220vw;
        }
        .mandala1 {
            position: absolute;
            top: calc(130% - 140px);
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
    </style>
    <style>
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,1);
            padding: 12px 16px;
            z-index: 1;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }
        .motion_bounce {
            transition: 2s;
        }
        p{
            font-family: Lato!important;
            font-size: 14px;
        }
        h5{
            font-family: Lato!important;
        }
    </style>
    <style>
        @media(max-width: 991px) {
            .desktop_logo{
                display: none;
            }
        }
        @media(min-width: 991px) {
            .mobile_logo{
                display: none;
            }
        }
    </style>
</head>
<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
{{--<img class="bg_1" src="/2019/compi/images/web_backgrounds_1.png" alt="">--}}
{{--<img class="bg_2" src="/2019/compi/images/web_backgrounds_1.png" alt="">--}}
<a class="motion_bounce" href="#techno-section"><div  class="arrow bounce"></div></a>

<img class="mandala1" src="/2019/homepage/images/b_mandala.png" >
<img class="mandala2" src="/2019/homepage/images/b_mandala.png" >

<img class="desktop_logo" src="/2019/summit/images/sbi.png" alt="" style="max-height: 200px;position: absolute;z-index: 1;right: 1%;top: 1%;" >
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light site-navbar-target" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="/" style="font-family: Lato"><img src="/2019/tf_date.png" alt="" style="max-height: 50px; z-index: 2; "></a>
        <button class="navbar-toggler js-fh5co-nav-toggle fh5co-nav-toggle" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav nav ml-auto">
                <li class="nav-item"><a href="#home-section" class="nav-link"><span>Home</span></a></li>
                <li class="nav-item"><a href="#techno-section" class="nav-link"><span>Technorion</span></a></li>
                <li class="nav-item"><a href="#compi-section" class="nav-link"><span>Competitions</span></a></li>
                <li class="nav-item"><a href="#ideate-section" class="nav-link"><span>Ideate</span></a></li>
                {{--                <li class="nav-item"><a href="#contact-section" class="nav-link"><span>Contact Us</span></a></li>--}}
                <li class="nav-item"><a href="#section-counter" class="nav-link"><span>Stats</span></a></li>

                @if(empty( $user_row->email))
                    <li class="nav-item" id="signinButton">
                        <a href="#" class="nav-link" id="signinButton"><span> Sign In</span></a>
                    </li>
                    <form action="" method="post" id="h-form" class="">
                        {{csrf_field()}}
                        <input type="hidden" name ="code" id="name2" style="background-color: blue">
                    </form>
                @endif
                @if(!empty($user_row->email))

                    <li class="nav-item dropdown">
                        <span class="nav-link">PROFILE</span>

                        <div class="dropdown-content">
                            <a href="/competitions/details_form" style="color: black">Personal Details</a><br>
{{--                            @if($user_row->cozmo > 0)--}}
{{--                                <a href="/competitions/cozmo/" style="color: black">Cozmo Clench</a><br>--}}
{{--                            @endif--}}
{{--                            @if($user_row->meshmerize > 0)--}}
{{--                                <a href="/competitions/meshmerize/" style="color: black">Meshmerize</a><br>--}}
{{--                            @endif--}}
{{--                            @if($user_row->micromouse > 0)--}}
{{--                                <a href="/competitions/micromouse/" style="color: black">Micromouse</a><br>--}}
{{--                            @endif--}}
{{--                            @if($user_row->tso > 0)--}}
{{--                                <a href="/competitions/tso/" style="color: black">Techfest Olympiad</a><br>--}}
{{--                            @endif--}}
{{--                            @if($user_row->codecode > 0)--}}
{{--                                <a href="/competitions/codecode/" style="color: black">Codecode</a><br>--}}
{{--                            @endif--}}
{{--                            @if($user_row->earthmatters > 0)--}}
{{--                                <a href="/competitions/earthmatters/" style="color: black">Earth Matters</a><br>--}}
{{--                            @endif--}}
{{--                            @if($user_row->innovationeering > 0)--}}
{{--                                <a href="/competitions/innovationeering/" style="color: black">Innovationeering</a><br>--}}
{{--                            @if($user_row->innovationeering > 0)--}}
{{--                            @endif--}}
{{--                                <a href="/competitions/innovationeering/" style="color: black">Civilisation Metamorphosis</a><br>--}}
{{--                            @endif--}}
                            <a href="/competitions/logout" style="color: black">Logout</a>
                        </div>
                    </li>
                @endif




            </ul>
        </div>
    </div>
</nav>

<section class="home-slider js-fullheight owl-carousel" style="pointer-events: none;">

    <div class="slider-item js-fullheight fevicol" style="background-image:url(/2019/compi/images/irc-min.png); background-repeat: no-repeat; z-index: 2; " >
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center" data-scrollax-parent="true">
                <div class="col-md-8 text-center ftco-animate mt-5">
                    <div class="text" style="z-index: 3">
                        <div class="subheading">
                            <p>Techfest Presents</p>
                        </div>
                        <h1 class="mb-4" style="font-size: 4.4vh">Competitions</h1>
                        <p>A series of mind-boggling competitions involving creative and scientific thinking fusion of which results in impactful innovations</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


</section>



<section class="recent_bloger_area" id="techno-section" style="z-index: 2; padding:0px;    background: transparent;">
    <div class="container" style="z-index: 2;left: 0px">
        <div class="col-xs-8 col-sm-5" style="z-index: 2;">
            <div style="z-index: 2;">
                <h2 style="position: absolute; margin-top: 15px; z-index: 2; font-weight: bold; color: black">Technorion</h2>
                <img style="z-index: 2;" class="arrow1" src="/2019/Heading.svg" alt="" >

            </div>
        </div>
        <div class="row">
            <div class="col-md-5" style="z-index: 1;">
                <div class="techno_text">

                    <img  style="z-index: 2;" class="arrow5" src="/2019/compi/images/techno-min.png" alt="" >
                    <p>
                        With an aim to promote creative, innovative and technical skills amongst the youth, Techfest is expanding its reach by conducting Technorion, our Zonal competitions in multiple cities. We don’t want distance to play a role in hindering innovative minds from participating in Techfest Competitions. This year Technorion will be conducted in the following cities:
                    </p>
                    <div class="row" style="padding-left: 4.5%; ">
                        <div class="col-xs-12" >
                            <ul>
                                <li><br>University of Engineering and Management, Kolkata: <br>28 <sup>th</sup>  September</li>
                                <li><br>Oriental Institute of Science and Technology, Bhopal: <br>29 <sup>th</sup>  September</li>
                                <li><br>B.N College of Engineering and Technology. Lucknow: <br>13 <sup>th</sup>  October </li>
                                <li><br>B.M.S Institute of Technology and Management, Bangalore:<br> 6 <sup>th</sup>  October</li>
                                <li><br>Swami Keshvanand Institute of Technology, Jaipur:<br> 6 <sup>th</sup>  October</li>
                                <li><br>Indian Institute of Technology Bombay:<br> 6 <sup>th</sup>  October</li>
                            </ul>
                        </div>
                        <div class="co0xs-1"></div>
{{--                        <div class="col-xs-6">--}}
{{--                            <ul>--}}
{{--                                <li><br>   : </li>--}}
{{--                                <li><br>   : </li>--}}
{{--                                <li><br>   : </li>--}}
{{--                                <li><br>   : </li>--}}
{{--                                <li><br>   : </li>--}}
{{--                                <li><br>   : </li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
                    </div>
                </div><br>
            </div>
            <div class="col-md-7">
                <div class="row">
                    <div class="col-xs-3 col-md-6" style="z-index: 1" >
                        <div class="recent_blog_item " style="margin-bottom: 0px">
                            <div class="blog_img shadow  " >
                                <img src="/2019/compi/images/cozmo2.jpeg" style="background-size: cover; width: 100%; height: "  alt="">

                            </div>
                            <div class="middle">
                                <div class="text ram1" >Build a manually controlled gripper bot to do simple tasks and complete the run by earning maximum points in minimum time</div>
                                {{--                                 Two statements likho--}}
                            </div>
                            <div class="recent_blog_text" >
                                <div class="recent_blog_text_inner" >
                                    <h6><a href="/competitions/wcozmo" style="font-family: Lato;font-weight: bold;color: white!important;">Explore</a></h6>
                                    <a ><h5 style="padding: 0px; font-size: 20px;"style="font-family: Lato">Cozmo Clench(wild card)</h5></a>
                                    <p style="padding: 0px; font-family: Lato">PRIZE MONEY: INR 82,500/- </p>

                                    <!--                                    <a href="#">Feb 11,ac 2017 <span>/</span></a>-->
                                    <!--                                    <a href="#">No Comments</a>-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-3 col-md-6" style="z-index: 1">
                        <div class="recent_blog_item" style="margin-bottom: 0px">
                            <div class="blog_img shadow">
                                <img src="/2019/compi/images/meshme.jpg" style="background-size: cover; width: 100%" alt="">

                            </div>
                            <div class="middle">
                                <div class="text ram1" >Build a line follower bot which navigates through the maze and completes the task in minimum time</div>
                            </div>
                            <div class="recent_blog_text">
                                <div class="recent_blog_text_inner">
                                    <h6><a href="/competitions/wmeshmerize" style="font-family: Lato;font-weight: bold; color: white!important;">Explore</a></h6>
                                    <a href="/competitions/wmeshmerize"><h5 style="padding: 0px; font-family: Lato">Meshmerize(wild card)</h5></a>
                                    <p style="padding: 0px; font-family: Lato" >PRIZE MONEY: INR 82,500/- </p>
                                    <!--                                    <a href="#">Feb 11,ac 2017 <span>/</span></a>-->
                                    <!--                                    <a href="#">No Comments</a>-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-3 col-md-6" style="z-index: 1">
                        <div class="recent_blog_item" style="margin-bottom: 0px">
                            <div class="blog_img shadow">
                                <img src="/2019/compi/images/codecode2.jpeg" style="background-size: cover; width: 100%" alt="">
                            </div>
                            <div class="middle">
                                <div class="text ram1" >Teams are required to solve real-life problems through coding. Challenge yourself to efficiently solve coding questions</div>
                            </div>
                            <div class="recent_blog_text">
                                <div class="recent_blog_text_inner">
                                    <h6><a href="/competitions/wcodecode" style="font-family: Lato;font-weight: bold; color: white!important;">Explore</a></h6>
                                    <a href="/competitions/wcodecode"><h5 style="padding: 0px; font-family: Lato">CoDecode(wild card)</h5></a>
                                    <p style="padding: 0px; font-family: Lato">PRIZE MONEY: INR 37,000/- </p>
                                    <!--                                    <a href="#">Feb 11,ac 2017 <span>/</span></a>-->
                                    <!--                                    <a href="#">No Comments</a>-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-3 col-md-6" style="z-index: 1">
                        <div class="recent_blog_item " style="margin-bottom: 0px">
                            <div class="blog_img shadow ">
                                <img src="/2019/compi/images/School2.jpeg" style="background-size: cover; width: 100%" alt="">
                            </div>
                            <div class="middle">
                                <div class="text ram1">Competition aimed towards nurturing young minds of young School students to test their mental, creative and analytical skills</div>
                            </div>
                            <div class="recent_blog_text" >
                                <div class="recent_blog_text_inner" >
                                    <h6><a href="/competitions/tso" style="font-family: Lato;font-weight: bold; color: white!important;">Explore</a></h6>
                                    <a ><h5 style="padding: 0px; font-family: Lato">Techfest Olympiad</h5></a>
                                    <p style="padding: 0px; font-family: Lato">PRIZES WORTH INR 25,000/- </p>
                                    <!--                                    <a href="#">Feb 11,ac 2017 <span>/</span></a>-->
                                    <!--                                    <a href="#">No Comments</a>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!--================End Recent Blog Area =================-->
<section class="recent_bloger_area"  style="padding-top: 0px;background: transparent;">
    <div class="container" style="z-index: 2">
        <div class="col-xs-8 col-sm-5">
            <div>
                <h2 style="position: absolute; margin-left: -18px;margin-top: 15px; font-weight: bold; color:black ;">International Competitions</h2>
                <img class="arrow2" src="/2019/Heading.svg" alt="" >
            </div>
        </div>
        <div class="row">
            {{--            wpc--}}
            <div class="col-xs-3 col-md-4" style="z-index: 1" >
                <div class="recent_blog_item" style="margin-bottom: 0px">
                    <div class="blog_img shadow">
                        <img src="/2019/compi/wpc.jpg" style="background-size: cover;width: 100%" alt="">
                    </div>
                    <div class="middle">
                        <div class="text ram2" >Battle out with the top programmers of the world in this competitive coding war.</div>
                    </div>
                    <div class="recent_blog_text">
                        <div class="recent_blog_text_inner">
                            <h6><a href="/competitions/wpc" style="font-family: Lato;font-weight: bold; color: white!important;">Explore</a></h6>
                            <a href="/competitions/wpc"><h5 style="padding: 0px">World Programming Championship</h5></a>
                            <p style="padding: 0px">PRIZES WORTH : INR 1,00,000/- </p>
                            <!--                                    <a href="#">Feb 11,ac 2017 <span>/</span></a>-->
                            <!--                                    <a href="#">No Comments</a>-->
                        </div>
                    </div>
                </div>
            </div>
            {{--            ift--}}
            <div class="col-xs-3 col-md-4" style="z-index: 1" >
                <div class="recent_blog_item" style="margin-bottom: 0px">
                    <div class="blog_img shadow">
                        <img src="/2019/ift_image.jpeg" style="background-size: cover;width: 100%" alt="">
                    </div>
                    <div class="middle">
                        <div class="text ram2" >Operate remote controlled nitro-buggy cars on an off-road dirt track to dominate the Techfest International Full Throttle circuit. </div>
                    </div>
                    <div class="recent_blog_text">
                        <div class="recent_blog_text_inner">
                            <h6><a href="/ift" style="font-family: Lato;font-weight: bold; color: white!important;">Explore</a></h6>
                            <a href="/ift"><h5 style="padding: 0px">International Full Throttle</h5></a>
                            <p style="padding: 0px">PRIZES WORTH: INR 1,30,000/-</p>
                        {{--                            <p style="padding: 0px">PRIZE MONEY </p>--}}
                        <!--                                    <a href="#">Feb 11,ac 2017 <span>/</span></a>-->
                            <!--                                    <a href="#">No Comments</a>-->
                        </div>
                    </div>
                </div>
            </div>
            {{--            micromouse--}}
            <div class="col-xs-3 col-md-4" style="z-index: 1" >
                <div class="recent_blog_item" style="margin-bottom: 0px">
                    <div class="blog_img shadow">
                        <img src="/2019/compi/images/micro2.jpg" style="background-size: cover;width: 100%" alt="">
                    </div>
                    <div class="middle">
                        <div class="text ram2" >Build an autonomous self-contained robot, Micromouse, which can get to the centre of a maze in the shortest possible time.</div>
                    </div>
                    <div class="recent_blog_text">
                        <div class="recent_blog_text_inner">
                            <h6><a href="/competitions/micromouse" style="font-family: Lato;font-weight: bold; color: white!important;">Explore</a></h6>
                            <a href="/competitions/micromouse"><h5 style="padding: 0px">International Micromouse Challenge</h5></a>
                            <p style="padding: 0px">PRIZE MONEY: INR 2,25,000/- </p>
                            <!--                                    <a href="#">Feb 11,ac 2017 <span>/</span></a>-->
                            <!--                                    <a href="#">No Comments</a>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>

<section class="recent_bloger_area" id="compi-section" style="padding-top: 0px;background: transparent;">
    <div class="container" style="z-index: 2">
        <div class="col-xs-8 col-sm-5">
            <div>
                <h2 style="position: absolute; margin-left: -18px;margin-top: 15px; font-weight: bold; color:black ;">Competitions</h2>
                <img class="arrow2" src="/2019/Heading.svg" alt="" >
            </div>
        </div>

        <div class="row">
            <div class="col-xs-3 col-md-3" style="z-index: 1" >
                <div class="recent_blog_item" style="margin-bottom: 0px">
                    <div class="blog_img shadow">
                        <img src="/2019/compi/images/codebuzz_new.jpg" style="background-size: cover;width: 100%" alt="">
                    </div>
                    <div class="middle">
                        <div class="text ram2" >Battle out to become the Coding Champion in this three hour contest</div>
                    </div>
                    <div class="recent_blog_text">
                        <div class="recent_blog_text_inner">
                            <h6><a href="/competitions/codebuzz" style="font-family: Lato;font-weight: bold; color: white!important;">Explore</a></h6>
                            <a href="/competitions/codebuzz"><h5 style="padding: 0px">GEHC CodeBuzz</h5></a>
                            <p style="padding: 0px">PRIZE MONEY: INR 50,000/- </p>
                            <!--                                    <a href="#">Feb 11,ac 2017 <span>/</span></a>-->
                            <!--                                    <a href="#">No Comments</a>-->
                        </div>
                    </div>
                </div>
            </div>

{{--            <div class="row">--}}
            <div class="col-xs-3 col-md-3" style="z-index: 1" >
                <div class="recent_blog_item" style="margin-bottom: 0px">
                    <div class="blog_img shadow">
                        <img src="/2019/compi/inspire.png" style="background-size: cover;width: 100%" alt="">
                    </div>
                    <div class="middle">
                        <div class="text ram2" >Create a one page website on a .ORG domain</div>
                    </div>
                    <div class="recent_blog_text">
                        <div class="recent_blog_text_inner">
                            <h6><a href="/competitions/inspire" style="font-family: Lato;font-weight: bold; color: white!important;">Explore</a></h6>
                            <a href="/competitions/inspire"><h5 style="padding: 0px">Inspire with .ORG</h5></a>
                            <p style="padding: 0px">PRIZE MONEY: INR 2,50,000/- </p>
                            <!--                                    <a href="#">Feb 11,ac 2017 <span>/</span></a>-->
                            <!--                                    <a href="#">No Comments</a>-->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-3 col-md-3" style="z-index: 1" >
                <div class="recent_blog_item" style="margin-bottom: 0px">
                    <div class="blog_img shadow">
                        <img src="/2019/compi/makerthon.png" style="background-size: cover;width: 100%" alt="">
                    </div>
                    <div class="middle">
                        <div class="text ram2" >Design a Robotic Arm to modulate the throttle of the 2wheele</div>
                    </div>
                    <div class="recent_blog_text">
                        <div class="recent_blog_text_inner">
                            <h6><a href="/competitions/makerthon" style="font-family: Lato;font-weight: bold; color: white!important;">Explore</a></h6>
                            <a href="/competitions/makerthon"><h5 style="padding: 0px">Pulsar Makerthon</h5></a>
                            <p style="padding: 0px">PRIZE MONEY: INR 85,000/- </p>
                            <!--                                    <a href="#">Feb 11,ac 2017 <span>/</span></a>-->
                            <!--                                    <a href="#">No Comments</a>-->
                        </div>
                    </div>
                </div>
            </div>
            {{--            fintech--}}
            <div class="col-xs-3 col-md-3" style="z-index: 1" >
                <div class="recent_blog_item" style="margin-bottom: 0px">
                    <div class="blog_img shadow">
                        <img src="/2019/compi/images/gopynq.jpg" style="background-size: cover;width: 100%" alt="">
                    </div>
                    <div class="middle">
                        <div class="text ram2" >Build sports robots that will compete with other robots in 30+ human sports like archery, basketball, boxing, cricket, golf, tug of war & more.</div>
                    </div>
                    <div class="recent_blog_text">
                        <div class="recent_blog_text_inner">
                            <h6><a href="/gopynq" style="font-family: Lato;font-weight: bold; color: white!important;">Explore</a></h6>
                            <a href="/gopynq"><h5 style="padding: 0px">GoPYNQ</h5></a>
                            <p style="padding: 0px">PRIZE MONEY: INR 90,000/- </p>
                            <!--                                    <a href="#">Feb 11,ac 2017 <span>/</span></a>-->
                            <!--                                    <a href="#">No Comments</a>-->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-3 col-md-3" style="z-index: 1" >
                <div class="recent_blog_item" style="margin-bottom: 0px">
                    <div class="blog_img shadow">
                        <img src="/2019/compi/images/boeing.jpg" style="background-size: cover;width: 100%" alt="">
                    </div>
                    <div class="middle">
                        <div class="text ram2" >Design and fabricate a RC plane which can perform a set of maneuvers</div>
                    </div>
                    <div class="recent_blog_text">
                        <div class="recent_blog_text_inner">
                            <h6><a href="/boeing" style="font-family: Lato;font-weight: bold; color: white!important;">Explore</a></h6>
                            <a href="/boeing"><h5 style="padding: 0px">Boeing Aeromodelling Competition</h5></a>
                            <p style="padding: 0px">PRIZE MONEY: INR 2,40,000/- </p>
                            <!--                                    <a href="#">Feb 11,ac 2017 <span>/</span></a>-->
                            <!--                                    <a href="#">No Comments</a>-->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-3 col-md-3" style="z-index: 1" >
                <div class="recent_blog_item" style="margin-bottom: 0px">
                    <div class="blog_img shadow">
                        <img src="/2019/compi/oppo_fintech.png" style="background-size: cover;width: 100%" alt="">
                    </div>
                    <div class="middle">
                        <div class="text ram2" >Innovate to make the processes in fintech world simpler and more efficient. </div>
                    </div>
                    <div class="recent_blog_text">
                        <div class="recent_blog_text_inner">
                            <h6><a href="/competitions/fintech" style="font-family: Lato;font-weight: bold; color: white!important;">Explore</a></h6>
                            <a href="/competitions/fintech"><h5 style="padding: 0px">OPPO FinTech Contest</h5></a>
                            <p style="padding: 0px">PRIZE MONEY: INR 1,00,000/-</p>
                        {{--                            <p style="padding: 0px">PRIZE MONEY </p>--}}
                        <!--                                    <a href="#">Feb 11,ac 2017 <span>/</span></a>-->
                            <!--                                    <a href="#">No Comments</a>-->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-3 col-md-3" style="z-index: 1" >
                <div class="recent_blog_item" style="margin-bottom: 0px">
                    <div class="blog_img shadow">
                        <img src="/2019/compi/drone.png" style="background-size: cover;width: 100%" alt="">
                    </div>
                    <div class="middle">
                        <div class="text ram2" >To design a drone of given dimensions which can cross the obstacles</div>
                    </div>
                    <div class="recent_blog_text">
                        <div class="recent_blog_text_inner">
                            <h6><a href="/dronechallenge" style="font-family: Lato;font-weight: bold; color: white!important;">Explore</a></h6>
                            <a href="/dronechallenge"><h5 style="padding: 0px">Drone Challenge</h5></a>
                            <p style="padding: 0px">PRIZE MONEY: INR 60,000/- </p>
                            <!--                                    <a href="#">Feb 11,ac 2017 <span>/</span></a>-->
                            <!--                                    <a href="#">No Comments</a>-->
                        </div>
                    </div>
                </div>
            </div>
            {{--            crane--}}
            <div class="col-xs-3 col-md-3" style="z-index: 1" >
                <div class="recent_blog_item" style="margin-bottom: 0px">
                    <div class="blog_img shadow">
                        <img src="/2019/compi/craneomania.png" style="background-size: cover;width: 100%" alt="">
                    </div>
                    <div class="middle">
                        <div class="text ram2" >Design a Tower Crane using popsicle sticks cotton strings and Fevicol as adhesive that can sustain the maximum possible load</div>
                    </div>
                    <div class="recent_blog_text">
                        <div class="recent_blog_text_inner">
                            <h6><a href="/competitions/craneomania" style="font-family: Lato;font-weight: bold; color: white!important;">Explore</a></h6>
                            <a href="/competitions/craneomania"><h5 style="padding: 0px">Craneomania</h5></a>
                            <p style="padding: 0px">PRIZE MONEY: INR 50,000/-</p>
                        {{--                            <p style="padding: 0px">PRIZE MONEY </p>--}}
                        <!--                                    <a href="#">Feb 11,ac 2017 <span>/</span></a>-->
                            <!--                                    <a href="#">No Comments</a>-->
                        </div>
                    </div>
                </div>
            </div>
            {{--            bugbounty--}}
            <div class="col-xs-3 col-md-3" style="z-index: 1" >
                <div class="recent_blog_item" style="margin-bottom: 0px">
                    <div class="blog_img shadow">
                        <img src="/2019/compi/bugbounty.jpg" style="background-size: cover;width: 100%" alt="">
                    </div>
                    <div class="middle">
                        <div class="text ram2" >An ethical hacking competition requiring to discover security vulnerability in on a OS/server.</div>
                    </div>
                    <div class="recent_blog_text">
                        <div class="recent_blog_text_inner">
                            <h6><a href="/competitions/bugbounty" style="font-family: Lato;font-weight: bold; color: white!important;">Explore</a></h6>
                            <a href="/competitions/bugbounty"><h5 style="padding: 0px">Bug Bounty Contest</h5></a>
                            <p style="padding: 0px">PRIZE MONEY: INR 2,00,000/- </p>
                            <!--                                    <a href="#">Feb 11,ac 2017 <span>/</span></a>-->
                            <!--                                    <a href="#">No Comments</a>-->
                        </div>
                    </div>
                </div>
            </div>
{{--            indiachallenge--}}
            <div class="col-xs-3 col-md-3" style="z-index: 1" >
                <div class="recent_blog_item" style="margin-bottom: 0px">
                    <div class="blog_img shadow">
                        <img src="/2019/compi/images/indiachallenge.png" style="background-size: cover;width: 100%" alt="">
                    </div>
                    <div class="middle">
                        <div class="text ram2" >Develop an application which assists in document creation involving Data analytics.</div>
                    </div>
                    <div class="recent_blog_text">
                        <div class="recent_blog_text_inner">
                            <h6><a href="/indiachallenge" style="font-family: Lato;font-weight: bold; color: white!important;">Explore</a></h6>
                            <a href="/indiachallenge"><h5 style="padding: 0px">JLT India Challenge</h5></a>
                            <p style="padding: 0px">PRIZE MONEY: INR 1,75,000/- </p>
                            <!--                                    <a href="#">Feb 11,ac 2017 <span>/</span></a>-->
                            <!--                                    <a href="#">No Comments</a>-->
                        </div>
                    </div>
                </div>
            </div>
            {{--            robovr--}}

            {{--            rowboatics--}}
            <div class="col-xs-3 col-md-3" style="z-index: 1" >
                <div class="recent_blog_item" style="margin-bottom: 0px">
                    <div class="blog_img shadow">
                        <img src="/2019/compi/rowboatics.jpg" style="background-size: cover;width: 100%" alt="">
                    </div>
                    <div class="middle">
                        <div class="text ram2" >Design and build a manually controlled boat which has to sail through the obstacles in the arena and complete the race</div>
                    </div>
                    <div class="recent_blog_text">
                        <div class="recent_blog_text_inner">
                            <h6><a href="/rowboatics" style="font-family: Lato;font-weight: bold; color: white!important;">Explore</a></h6>
                            <a href="/rowboatics"><h5 style="padding: 0px">RowBoatics</h5></a>
                            <p style="padding: 0px">PRIZE MONEY: INR 70,000/- </p>
                            <!--                                    <a href="#">Feb 11,ac 2017 <span>/</span></a>-->
                            <!--                                    <a href="#">No Comments</a>-->
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-xs-3 col-md-3" style="z-index: 1" >
                <div class="recent_blog_item" style="margin-bottom: 0px">
                    <div class="blog_img shadow">
                        <img src="/2019/compi/robovr.jpg" style="background-size: cover;width: 100%" alt="">
                    </div>
                    <div class="middle">
                        <div class="text ram2" >Build sports robots that will compete with other robots in 30+ human sports like archery, basketball, boxing, cricket, golf, tug of war & more.</div>
                    </div>
                    <div class="recent_blog_text">
                        <div class="recent_blog_text_inner">
                            <h6><a href="/robovr" style="font-family: Lato;font-weight: bold; color: white!important;">Explore</a></h6>
                            <a href="/robovr"><h5 style="padding: 0px">RoboVR</h5></a>
                            <p style="padding: 0px">Medals of Honor: Gold, Silver & Bronze</p>
                            <!--                                    <a href="#">Feb 11,ac 2017 <span>/</span></a>-->
                            <!--                                    <a href="#">No Comments</a>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>


<section class="recent_bloger_area" id="ideate-section" style="padding-top: 0px;background: transparent;">
    <div class="container" style="z-index: 2">
        <div class="col-xs-8 col-sm-5">
            <div>
                <h2 style="position: absolute; margin-left: -15px;margin-top: 15px; font-weight: bold; color:black ">Ideate</h2>
                <img class="arrow4" src="/2019/Heading.svg" alt="" >
            </div>
        </div>
        <div class="row">
            <div class="col-xs-3 col-md-3" style="z-index: 1" >
                <div class="recent_blog_item" style="margin-bottom: 0px">
                    <div class="blog_img shadow">
                        <img src="/2019/compi/images/transportation.jpg" style="background-size: cover;width: 100%" alt="">
                    </div>
                    <div class="middle">
                        <div class="text ram2" >Innovate to improve the Traffic and Transportation system</div>
                    </div>
                    <div class="recent_blog_text">
                        <div class="recent_blog_text_inner">
                            <h6><a href="/competitions/transportation" style="font-family: Lato;font-weight: bold; color: white!important;">Explore</a></h6>
                            <a href="/competitions/transportation"><h5 style="padding: 0px">Unravelling Transportation</h5></a>
                            <p style="padding: 0px">PRIZE MONEY: INR 1,25,000/- </p>
                            <!--                                    <a href="#">Feb 11,ac 2017 <span>/</span></a>-->
                            <!--                                    <a href="#">No Comments</a>-->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-3 col-md-3" style="z-index: 1" >
                <div class="recent_blog_item" style="margin-bottom: 0px">
                    <div class="blog_img shadow">
                        <img src="/2019/compi/images/earth.jpg" style="background-size: cover;width: 100%" alt="">
                    </div>
                    <div class="middle">
                        <div class="text ram2" >Come up with innovative technological ideas to solve problems of water shortage, waste management and degrading environment</div>
                    </div>
                    <div class="recent_blog_text">
                        <div class="recent_blog_text_inner">
                            <h6><a href="/competitions/earthmatters" style="font-family: Lato;font-weight: bold; color: white!important;">Explore</a></h6>
                            <a href="/competitions/earthmatters"><h5 style="padding: 0px">Earth Matters</h5></a>
                            <p style="padding: 0px">PRIZE MONEY: INR 1,25,000/- </p>
                            <!--                                    <a href="#">Feb 11,ac 2017 <span>/</span></a>-->
                            <!--                                    <a href="#">No Comments</a>-->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-3 col-md-3" style="z-index: 1" >
                <div class="recent_blog_item" style="margin-bottom: 0px">
                    <div class="blog_img shadow">
                        <img src="/2019/compi/images/bulb.jpg" style="background-size: cover;width: 100%"  alt="">
                    </div>
                    <div class="middle">
                        <div class="text ram2" >Nurture the next billion by ensuring healthcare, electricity and education facilities for the underpriviledged</div>
                    </div>
                    <div class="recent_blog_text">
                        <div class="recent_blog_text_inner">
                            <h6><a href="/competitions/innovationeering" style="font-family: Lato;font-weight: bold; color: white!important;">Explore</a></h6>
                            <a href="/competitions/innovationeering"><h5 style="padding: 0px">Innovationeering</h5></a>
                            <p style="padding: 0px">PRIZE MONEY: INR 1,25,000/- </p>
                            <!--                                    <a href="#">Feb 11,ac 2017 <span>/</span></a>-->
                            <!--                                    <a href="#">No Comments</a>-->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-3 col-md-3" style="z-index: 1" >
                <div class="recent_blog_item" style="margin-bottom: 0px">
                    <div class="blog_img shadow">
                        <img src="/2019/compi/images/metamorphosis2.jpg" style="background-size: cover;width: 100%" alt="">
                    </div>
                    <div class="middle">
                        <div class="text ram2" >Innovate for a better civilisation by solving problems in areas such as cyber security, handicraft sector, drug abuse</div>
                    </div>
                    <div class="recent_blog_text">
                        <div class="recent_blog_text_inner">
                            <h6><a href="/competitions/metamorphosis" style="font-family: Lato;font-weight: bold; color: white!important;">Explore</a></h6>
                            <a href="/competitions/metamorphosis"><h5 style="padding: 0px">Civilisational Metamorphosis</h5></a>
                            <p style="padding: 0px">PRIZE MONEY: INR 70,000/- </p>
                            <!--                                    <a href="#">Feb 11,ac 2017 <span>/</span></a>-->
                            <!--                                    <a href="#">No Comments</a>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>


<div class="col-xs-8 col-sm-5" style="z-index: 2;">
    <div style="z-index: 2;">
        <h2 style="position: absolute; margin-top: 15px;margin-left: -17px; z-index: 2; font-weight: bold;padding-left: 23%;color: black">Past Statistics</h2>
        <img style="z-index: 2;" class="arrow3" src="/2019/Heading.svg" alt="" >

    </div>
</div>
<section class="ftco-counter" id="section-counter" style="z-index: 2">
    <div class="container-fluid px-0" style="z-index: 2">

        <div class="row no-gutters animation-timing-function: linear;" style="z-index: 2">
            <div class="col-md-4 justify-content-center counter-wrap ftco-animate " style="z-index: 2">
                <div class="block-18 text-center py-5" style="z-index: 2">
                    <div class="text" style="z-index: 2">
                        <div class="icon d-flex justify-content-center align-items-center" style="z-index: 2">
                            <span class="icon-users" style="z-index: 2"></span>
                        </div>
                        <strong class="number" data-number="20" style="z-index: 2">0</strong>
                        <span>Competitions</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4 justify-content-center counter-wrap ftco-animate">
                <div class="block-18 text-center py-5">
                    <div class="text">
                        <div class="icon d-flex justify-content-center align-items-center">
                            <span class="icon-money"></span>
                        </div>
                        <strong class="number" data-number="5120000">0</strong>
                        <span>Prize Money (INR)</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4 justify-content-center counter-wrap ftco-animate">
                <div class="block-18 text-center py-5">
                    <div class="text">
                        <div class="icon d-flex justify-content-center align-items-center">
                            <span class="icon-user"></span>
                        </div>
                        <strong class="number" data-number="32000">0</strong>
                        <span>Participants</span>
                    </div>
                </div>
            </div>
            {{--            <div class="col-md-3 justify-content-center counter-wrap ftco-animate">--}}
            {{--                <div class="block-18 text-center py-5">--}}
            {{--                    <div class="text">--}}
            {{--                        <div class="icon d-flex justify-content-center align-items-center">--}}
            {{--                            <span class="icon-home"></span>--}}
            {{--                        </div>--}}
            {{--                        <strong class="number" data-number="206">0</strong>--}}
            {{--                        <span>Churches</span>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </div>--}}
            {{--        </div>--}}
        </div>
    </div>
</section>


<section class="recent_bloger_area mobile_logo" id="ideate-section" style="padding-top: 0px;background: transparent;">
    <div class="container" style="z-index: 2">
        <div class="col-xs-8 col-sm-5">
            <div>
                <h2 style="position: absolute; margin-left: -15px;margin-top: 15px; font-weight: bold; color:black ">Sponsor</h2>
                <img class="arrow4" src="/2019/Heading.svg" alt="" >
            </div>
        </div>
        <div class="row">
            <div class="col-md" style="z-index: 1; text-align: center;" >
                <img src="/2019/summit/images/sbi.png" alt="" style="max-height: 200px" >
            </div>

        </div>

    </div>
</section>




<!-- loader -->
<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

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


<script src="/2019/compi/js/jquery.min.js"></script>
<script src="/2019/compi/js/jquery-migrate-3.0.1.min.js"></script>
<script src="/2019/compi/js/popper.min.js"></script>
<script src="/2019/compi/js/bootstrap.min.js"></script>
<script src="/2019/compi/js/jquery.easing.1.3.js"></script>
<script src="/2019/compi/js/jquery.waypoints.min.js"></script>
<script src="/2019/compi/js/jquery.stellar.min.js"></script>
<script src="/2019/compi/js/owl.carousel.min.js"></script>
<script src="/2019/compi/js/jquery.magnific-popup.min.js"></script>
<script src="/2019/compi/js/aos.js"></script>
<script src="/2019/compi/js/jquery.animateNumber.min.js"></script>
<script src="/2019/compi/js/scrollax.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
<script src="/2019/compi/js/google-map.js"></script>

<script src="/2019/compi/js/main.js"></script>







</body>
</html>