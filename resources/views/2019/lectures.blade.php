<!DOCTYPE html>
<html lang="en">
<head>
    <title>Lectures | Techfest, IIT Bombay</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0'/>

    <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">

    <link rel="shortcut icon" type="image/x-icon" href="/2019/ca/images/favicon_logo.png" />


    <link rel="stylesheet" href="/2019/lectures/css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="/2019/lectures/css/animate.css">
    <link rel="stylesheet" href="/2019/lectures/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/2019/lectures/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="/2019/lectures/css/magnific-popup.css">
    <link rel="stylesheet" href="/2019/lectures/css/aos.css">
    <link rel="stylesheet" href="/2019/lectures/css/ionicons.min.css">
    <link rel="stylesheet" href="/2019/lectures/css/flaticon.css">
    <link rel="stylesheet" href="/2019/lectures/css/icomoon.css">
    <link rel="stylesheet" href="/2019/lectures/css/style.css">

    <link rel="stylesheet" href="/2019/robowars/css/footer_with_3_col.css">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-81222017-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-81222017-1');
    </script>
    <!-- Global site tag (gtag.js) - Google Analytics -->



    <style>

        body {
            background-color: #275E80; /* For browsers that do not support gradients */
            background-image: linear-gradient(to right, #5F4A85 , #70427D);
        }
        ::-webkit-scrollbar {
            width: 0px;  /* Remove scrollbar space */
            background: transparent;  /* Optional: just make scrollbar invisible */
        }
    </style>

    <style>
        .owl-carousel .owl-stage, .owl-carousel.owl-drag .owl-item{
            -ms-touch-action: auto;
            touch-action: auto;
        }
        body{
            overflow-x: hidden;
        }
    </style>
    <style>
        .colors{
            font-size: 18px;
            font-weight: bold;
            margin-top: 290px;
            margin-bottom: -5px;
            margin-left: 13px;
            color: #000;
            /*-webkit-mask-image: -webkit-gradient(linear, left bottom, left top,*/
            /*from(rgba(0,0,0,1)), to(rgba(0,0,0,0)));*/
        }
        .desc_text {
            color: white;
            font-size: 14px;
        }
        .colors1{
            background-color: white;
            -webkit-mask-image: -webkit-gradient(linear, left bottom, left top,
            from(rgba(0,0,0,1)), to(rgba(0,0,0,0.4)));
            /*padding-top: 10px;*/
        }
        .faded{
            font-size: 11px;
            text-align: justify;
        }
        .img{
            border: solid 10px;
            border-color: white;
        }
        .arrow1{
            margin-top: -0%;
            margin-left: -42%;
            color: white;
            margin-bottom: 9%;
            height: 60px;
            z-index: 1;
        }
        .arrow2{
            margin-top: -7%;
            margin-left: -27%;
            color: white;
            margin-bottom: 5%;
            height: 60px;
            z-index: 2;
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
            animation: rotation 30s infinite linear;
            /*rotation: 20deg;*/
        }
        .mandala2 {
            position: absolute;
            top: calc(380% - 140px);
            left: calc(90% - 330px);
            height: 900px;
            /*width: 680px;*/
            z-index:0;
            overflow-x: hidden;
            opacity: 0.2;
            /*transform: rotateY(45deg) rotateX(45deg);*/
            /*transform-style: preserve-3d;*/
            animation: rotation 30s infinite linear;
            /*rotation: 20deg;*/
        }

    </style>
</head>
<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
{{--<img class="bg_1" src="/2019/compi/images/back-min.jpeg" alt="">--}}
<img src="//2019/lectures/images/Shadow.png" alt="" style="position: absolute; top: 99vh; width: 100vw; max-height: 50px">
<img class="mandala1" src="/2019/homepage/images/b_mandala.png" >
<img class="mandala2" src="/2019/homepage/images/b_mandala.png" >




<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light site-navbar-target" id="ftco-navbar">
    <div class="container">

        <a class="navbar-brand" href="/tf" style="font-family: Lato"><img src="/2019/tf_date.png" alt="" style="max-height: 50px; z-index: 2; "></a>
        <!--          <a class="navbar-brand" href="index.html" style="font-family: Lato">Techfest</a>-->
        <button class="navbar-toggler js-fh5co-nav-toggle fh5co-nav-toggle" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav nav ml-auto">
                <li class="nav-item"><a href="#home-section" class="nav-link"><span>Home</span></a></li>
                <li class="nav-item"><a href="#about-section" class="nav-link"><span>About</span></a></li>
                <li class="nav-item"><a href="#pastlec-section" class="nav-link"><span>Previous Lineup</span></a></li>
                <li class="nav-item"><a href="#contact-section" class="nav-link"><span>Contact Us</span></a></li>

            </ul>
        </div>
    </div>
</nav>
<section class="home-slider js-fullheight owl-carousel" style="pointer-events: none">
    <div class="slider-item js-fullheight" style="background-image:url(/2019/lectures/images/background_final.jpg);">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center" data-scrollax-parent="true">
                <div class="col-md-8 text-center ftco-animate mt-5">
                    <div class="text">
                        <div class="subheading">
                            <p>Techfest Presents</p>
                        </div>
                        <h1 class="mb-4">lecture Series</h1>
                        <p>Glean wisdom from some of the most brilliant personalities of our time!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


</section>

<section class="ftco-section ftco-no-pt ftco-no-pb ftco-about-section" id="about-section">
    <div class="col-xs-8 col-sm-5" >
        <div>
            <img class="arrow1" src="/2019/Heading.svg" alt="" style="padding-top: 0px" >
            <h2 style="padding-bottom: 10%;color: #0b0b0b;font-size: 29px;margin-left: 10%;margin-top: -19%; z-index: 2;"><b>About Lecture Series</b></h2>


        </div>
        <div>

        </div>
    </div>
    <div class="container-fluid px-0">
        <div class="row d-md-flex text-wrapper">
            <div class="one-half img" style="background-image: url(/2019/lectures/images/sophia_long.jpeg);"></div>
            <div class="one-half half-text d-flex justify-content-end align-items-center ftco-animate">
                <div class="text-inner pl-md-5">
                    <h3 class="heading"></h3>
{{--                    <br>--}}
{{--                    <br>--}}
                    <p style="text-align: justify; color: white;">Always a crowd favourite, the Techfest Lecture Series is one of the gems of the festival. Year after year, Techfest puts together a stellar lineup of speakers from diverse walks of life, speaking on pressing world issues: a commentary on history, as it unfolds. An annual constant since our initiation in 1998, the series has inspired millions of minds till date.
                        Listen to and interact with eminent personalities from diverse fields, glean insights from their profound wisdom and bear witness to their sheer mental prowess right here, at Techfest, IIT Bombay.
                        Come, join the next generation of thinkers, innovators and leaders from 3rd to 5th January at the Techfest Lecture Series.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
$lectures_row = DB::table('lectures')->where(['year'=>"2019"])->get();
$past_lectures_row = DB::table('lectures')->where(['year'=>null])->get();
?>

<section class="ftco-section" id="pastlec-section">
    <div class="container-fluid px-5">
        <div class="col-xs-8 col-sm-12">
            <div>
                <h2 style="margin-top: -6.5%; position: absolute;color: #0b0b0b; font-size: 29px;"><b>Lecturers</b></h2>
                <img class="arrow2" src="/2019/Heading.svg" alt="" style="padding-top: 0px" >
            </div>
        </div>
        <div class="row">

            @foreach( $lectures_row as $i)
                <div class="col-md-6 col-lg-3 ftco-animate zoom " style="margin-bottom: 35px">
                    <div class="staff zoom">
                        <div class="img-wrap d-flex align-items-stretch">
                            <div class="img align-self-stretch shadow" style="background-image: url('{{$i->image}}');position: absolute; z-index: -1;" ></div>
                        </div>
                        <div class="colors1">
                            <h3 class="colors" >{{$i->name}}</h3>
                            <span class="colors2" style="margin-left: 13px;color: #1d2124">{{$i->designation}}</span>
                        </div>
                    </div>
                </div>

            @endforeach




        </div>
    </div>
</section>
<section class="ftco-section" id="pastlec-section">
    <div class="container-fluid px-5">
        <div class="col-xs-8 col-sm-12">
            <div>
                <h2 style="margin-top: -6.5%; position: absolute;color: #0b0b0b; font-size: 29px;"><b>Previous Lecturers</b></h2>
                <img class="arrow2" src="/2019/Heading.svg" alt="" style="padding-top: 0px" >

            </div>
            <div>

            </div>
        </div>
        <div class="row">

            @foreach( $past_lectures_row as $i)
                <div class="col-md-6 col-lg-3 ftco-animate zoom ">
                    <div class="staff zoom">
                        <div class="img-wrap d-flex align-items-stretch">
                            <div class="img align-self-stretch shadow" style="background-image: url('{{$i->image}}');position: absolute; z-index: -1;" ></div>
                        </div>
                        <div class="colors1">
                            <h3 class="colors" >{{$i->name}}</h3>
                            <span class="colors2" style="margin-left: 13px;color: #1d2124">{{$i->designation}}</span>
                        </div>

                        <div class="text pt-3 text-center" style="padding-bottom: 10%;">
                            <div class="faded">
                                <p class="desc_text">{{$i->description}}</p>
                            </div>
                        </div>



                    </div>
                </div>

            @endforeach






        </div>
    </div>
</section>




<style>
    .col-md-4 {
        padding: 5% 5% 5% 12%
    }
    .col-md-3 {
        padding: 5%
    }
    .col-md-5 {
        padding: 5%
    }
    .imput_box {
        border-radius: 8px;padding: 7px; width: 60%;
    }
    .text_box {
        border-radius: 8px;padding: 7px; width: 60%;margin-top: 4%;
    }
    .button_style {
        border-radius: 10px; background-color:  white;color:  rgb(153,50,204);border: 0;padding: 5px 10px; margin-left: 40%;width: 20%;font-weight: bold;box-shadow: 1px 1px 0 0 rgba(255, 255, 255, 0.5);cursor: pointer;
    }
    @media (max-width: 991.98px) {
        .col-md-4 {
            text-align: center;
            padding: 5% 5% 5% 5%
        }
        .col-md-3 {
            text-align: center;
            /*padding: 5%*/
        }
        .col-md-5 {
            text-align: center;
            padding: 5%
        }
        .imput_box {
            border-radius: 8px;padding: 7px; width: 60%;
        }
        .text_box {
            border-radius: 8px;padding: 7px; width: 60%;margin-top: 4%;
        }
        .button_style {
            border-radius: 10px; background-color:  white;color:  rgb(153,50,204);border: 0;padding: 5px 10px; margin-left: auto;
            margin-right: auto;width: 20%;font-weight: bold;box-shadow: 1px 1px 0 0 rgba(255, 255, 255, 0.5);cursor: pointer;
        }
    }
</style>
<footer id="contact-section">
    <div class="row" style="background-color: rgba(0,0,0,0.5);">
        <div class="col-md-4 center" style="padding: 5% 5% 5% 12%">
            <h2>Contact Us</h2>
            <p style="font-size: 16px; color: #fff; color: white;">  Naman Agarwal</p>
            <p style="font-size: 16px"><a href="tel:7700906731"> +91 7700906731</a></p>
            <p style="font-size: 16px"><a href="mailto:naman@techfest.org">naman@techfest.org</a> <br/></p>
        </div>


        <div class="col-md-3">

        </div>

        <div class="col-md-5" style="padding: 5%">
            <form action="mailto:naman@techfest.org" method="post" enctype="text/plain">
                <input type="text" name="email" placeholder="Email" style="border-radius: 8px;padding: 7px; width: 60%;">
                <textarea name="message" placeholder="Message" style=" border-radius: 8px;padding: 7px; width: 60%;margin-top: 4%;"></textarea><br>
                <button style="border-radius: 10px; background-color:  white;color:  rgb(153,50,204);border: 0;padding: 5px 10px; margin-left: 40%;width: 20%;font-weight: bold;box-shadow: 1px 1px 0 0 rgba(255, 255, 255, 0.5);cursor: pointer;">Send</button>
            </form>
        </div>
    </div>

</footer>



<!-- loader -->
<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


<script src="/2019/lectures/js/jquery.min.js"></script>
<script src="/2019/lectures/js/jquery-migrate-3.0.1.min.js"></script>
<script src="/2019/lectures/js/popper.min.js"></script>
<script src="/2019/lectures/js/bootstrap.min.js"></script>
<script src="/2019/lectures/js/jquery.easing.1.3.js"></script>
<script src="/2019/lectures/js/jquery.waypoints.min.js"></script>
<script src="/2019/lectures/js/jquery.stellar.min.js"></script>
<script src="/2019/lectures/js/owl.carousel.min.js"></script>
<script src="/2019/lectures/js/jquery.magnific-popup.min.js"></script>
<script src="/2019/lectures/js/aos.js"></script>
<script src="/2019/lectures/js/jquery.animateNumber.min.js"></script>
<script src="/2019/lectures/js/scrollax.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
<script src="/2019/lectures/js/google-map.js"></script>

<script src="/2019/lectures/js/main.js"></script>





<!--    <script src="/2019/lectures/js2/jquery.min.js"></script>-->
<script src="/2019/lectures/js2/jquery-migrate-3.0.1.min.js"></script>
<script src="/2019/lectures/js2/popper.min.js"></script>
<!--    <script src="/2019/lectures/js2/bootstrap.min.js"></script>-->
<script src="/2019/lectures/js2/jquery.easing.1.3.js"></script>
<script src="/2019/lectures/js2/jquery.waypoints.min.js"></script>
<script src="/2019/lectures/js2/jquery.stellar.min.js"></script>
<script src="/2019/lectures/js2/owl.carousel.min.js"></script>
<script src="/2019/lectures/js2/jquery.magnific-popup.min.js"></script>
<script src="/2019/lectures/js2/aos.js"></script>
<script src="/2019/lectures/js2/jquery.animateNumber.min.js"></script>
<script src="/2019/lectures/js2/scrollax.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
<script src="/2019/lectures/js2/google-map.js"></script>

<script src="/2019/lectures/js2/main.js"></script>

</body>
</html>