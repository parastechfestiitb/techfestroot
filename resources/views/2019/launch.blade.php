<!doctype html>
<html>
<head>
    <title>Techfest | IIT Bombay</title>
    <meta charset="utf-8">
    <meta property="og:url" content="https://techfest.org/" />
    <meta property="" content="https://techfest.org/" />
    <meta property="og:title" content=" Techfest, IIT Bombay Asia's Largest Science and Technology Festival" />
    <meta property="og:image" content="https://techfest.org/2019/share.png" />
    <link rel="shortcut icon" type="image/x-icon" href="/2019/ca/images/favicon_logo.png" />
    <meta name="description" content="Techfest, IIT Bombay Asia's Largest Science and Technology Festival">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Techfest">
    <meta name="keywords" content="">
    <meta name="viewport" content= "width=device-width, user-scalable=no">

    <script type="text/javascript">
        if (screen.width <= 992) {
            document.location = "/m";
        }
    </script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="shortcut icon" type="image/x-icon" href="/2019/ca/images/favicon_logo.png" />

    <script type="text/javascript" src="https://code.jquery.com/jquery-1.9.1.js"></script>
    <script type="text/javascript" src="/2019/homepage/js/jquery.onepage-scroll.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
    <link href='/2019/homepage/css/onepage-scroll.css' rel='stylesheet' type='text/css'>
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
        body{
            font-family: Lato;
            background-color: #275E80; /* For browsers that do not support gradients */
            background-image: linear-gradient(#275E80 , #2C2F7A);
        }

        .wrapper {
            height: 100% !important;
            height: 100%;
            margin: 0 auto;
            overflow: hidden;
        }




    </style>
    <script>
        $(document).ready(function(){
            $(".main").onepage_scroll({
                sectionContainer: "section",
                responsiveFallback: 600,
                loop: false
            });
        });

    </script>
    <style>
        .box{
            position:fixed;
            z-index: 20;

        }
        .links {
            font-size: 1.2vw;
            color: white!important;
            letter-spacing: 1px;
        }

        .topright{
            top:0px;
            right:0px;
            width: 33%;
            text-align: right;
            padding-right: 2%;
        }
        .topright_links {
            padding-top: 2.5%;
            line-height: 3.9vh;
        }
        .topleft{
            top:0px;
            left:0px;
            width: 33%;
            text-align: left;
            padding-left: 2%;
        }
        .topleft_links{
            padding-top: 2.5%;
            line-height: 3.9vh;
        }
        .bottomright{
            bottom: -2.1vh;
            right: 8vh;
            height: 11%;
            width: 26%;
        }
        .bottomleft{
            bottom: -1vh;
            left:0px;
            height: 10%;
            width: 30%;
            padding-left: 2%;

        }
        .bottomleft_link{
            text-align: left;
            line-height: 3.9vh;
        }
        .bottomcentre{
            left: calc(50% - 30vh);
            bottom:5px;
            width: 60vh;
            color: white;
            text-align: center;

        }
        .topcentre{
            top: 0.7%;
            left: 43%;
            max-width: 24%;
            max-height: 50px;

        }
        .logo {
            height: 5.2vh;
        }


        .header {
            width: 100%;
            position: fixed;
            z-index: 8;
        }
        .footer_left {
            bottom: -4.1vh;
            width: 32vw;
            position: fixed;
            z-index: 8;
        }
        .footer_right {
            transform: rotateY(180deg);
            right: 0;
            bottom: -4.1vh;
            width: 32vw;
            position: fixed;
            z-index: 8;
        }
        .footer_center {
            left: 34.7vw;
            bottom: 0px;
            width: 32vw;
            position: fixed;
            z-index: 8;
        }
        .center_notification {
            right: 2vw;
            bottom: 0.9vh;
            position:fixed;
            text-align: center;
            width: 25vw;
            color: white!important;
            font-size: 20px;
            z-index:10000;
        }
        .blinking{
            animation:blinkingText1 2.1s infinite;

        }
        .blinking{
            animation:blinkingText2 2.1s infinite;
            animation-delay: 2.1s;
        }

        @keyframes blinkingText1{
            0%{ color: white;    }
            50%{ opacity:0;color: white;}
            51%{color:white;}

        }
           @keyframes blinkingText2{

            0%{     color: white;    }
            50%{   opacity:0;
                color: white;}
            51%{color:white;}

        }


        i {
            padding: 5px;
            size: 27px;
        }
        a{
            color: white!important;
        }

        @-webkit-keyframes rotate {

            to {
                -webkit-transform: rotateZ(359deg);
            }
        }
        .background {
            position: absolute;
            width: 100vw;
            height: -webkit-fill-available;

        }
        .background_layer {
            position: absolute;
            width: 120vw;
            left: -10vw;
            top: calc(50vh - 60vw);
            /*transform: scale(0.9);*/
            opacity: 0.2;
            animation: rotate reverse 300s infinite linear;

        }
        .mandala{
            left: 31.5vw;
            width: 37vw;
            position: absolute;
            margin: auto;
            top: calc(50vh - 18.5vw);

            animation: rotate 60s infinite linear;

        }
        .page1:hover #mandala_1 {
            animation: axis_1 4s;
            animation-iteration-count: 3;
        }

        @keyframes axis_1 {
            to {
                transform: rotateX(180deg) ;
            }
        }
        .page1:hover #mandala_2 {
            animation: axis_2 4s;
            animation-iteration-count: 3;
        }

        @keyframes axis_2 {
            to {
                transform: rotateY(180deg);
            }
        }
        .page1:hover #mandala_3 {
            animation: axis_3 4s;
            animation-iteration-count: 3;
        }

        @keyframes axis_3 {
            to {
                transform: rotateY(180deg) rotateX(180deg);
            }
        }
        .page1:hover #mandala_4 {
            animation: axis_4 4s;
            animation-iteration-count: 3;
        }

        @keyframes axis_4 {
            to {
                transform: rotateY(180deg) rotateX(-180deg);
            }
        }
        .page1:hover #mandala_6 {
            animation: speed 4s;
            animation-play-state: inherit;

            animation-iteration-count: infinite;
        }

        @keyframes speed {
            to {
                transform: rotatez(360deg);
            }
        }


        .black_blurr {
            transform: scale(1.8);
        }
        .left_eye {
            position: absolute;
            top: calc(50vh - 19.2vw);
            width: 30vw;
            left: 9.9vw;
            -webkit-user-drag: none;
        }
        .right_eye {
            position: absolute;
            top: calc(50vh - 19.2vw);
            width: 30vw;
            right: 9.9vw;
            -webkit-user-drag: none;

        }

        .page1:hover #right_eye {
            animation: bounce_right 2s;
            animation-iteration-count: infinite;
        }

        .page1:hover #left_eye {
            animation: bounce_left 2s;
            animation-iteration-count: infinite;
        }

        @keyframes bounce_right {
            0%, 20%, 50%, 80%, 100% {transform: translateY(0);}
            20% {transform: translateX(30px);}
            50% {transform: translateX(20px);}
        }
        @keyframes bounce_left {
            0%, 20%, 50%, 80%, 100% {transform: translateY(0);}
            20% {transform: translateX(-30px);}
            50% {transform: translateX(-20px);}
        }
    </style>
    <style>
        .guine_box{
            padding-top: 13.1vh;
            padding-bottom: 15.2vh;
            text-align: right;

        }
        a:hover {
            text-shadow: #ffffff 0px 0px 4px;
            color: #ffffff!important;
            text-decoration: none;
        }
    </style>

</head>
<body>
<script>
    (function($){
        $(document).on('contextmenu', 'img', function() {
            return false;
        })
    })(jQuery);
</script>

<img class="header" src="/2019/homepage/images/Header.png" alt="" >
<img class="footer_left" src="/2019/homepage/images/Footer_Side.png" alt="" >
<img class="footer_right" src="/2019/homepage/images/Footer_Side.png" alt="" >
<img class="footer_center" src="/2019/homepage/images/Footer_middle.png" alt="" >
<!--<img class="background" src="/2019/homepage/images/Background_3.png" alt="" >-->
<img class="background_layer" src="/2019/homepage/images/mandala_6.png" >
<img class="background_layer" src="/2019/homepage/images/mandala_5c.png" >
<img class="background_layer" src="/2019/homepage/images/mandala_4c.png" >
<img class="background_layer" src="/2019/homepage/images/mandala_3.png" >
<img class="background_layer" src="/2019/homepage/images/mandala_2c.png" >
<img class="background_layer" src="/2019/homepage/images/mandala_1.png" >
<div>



    <div class="box topleft">
        <div class="row">
            <div class="col-md-3 topleft_links" id=Links">
                <a class="links " href="/about-us" >About Us</a><br>
                <a class="links" href="/initiative">Initiatives</a><br>

            </div>
            <div class="col-md-3 topleft_links">
                <a class="links" href="/lectures/" >Lectures</a><br>
                <a class="links" href="/exhibitions/" >Exhibitions</a><br>
            </div>
            <div class="col-md-3 topleft_links">
                <a class="links" href="/summit" >Summit</a><br>
                <a class="links" href="/mun" >TWMUN</a><br>

            </div>

            <div class="col-md-3 topleft_links" style="padding-left: 0px;">
                <a class="links"  href="/workshops" >Workshops</a><br>
            </div>


        </div>
    </div>
    <div class="box topright">
        <div class="row" >
            <div class="col-md-2 topright_links" style="padding-right: 2.5%;padding-left: 8.4%;">
                <a class="links" href="/schedule" title="Schedule 2020">Schedule</a><br>

            </div>
            <div class="col-md-4 topright_links" id="Links" style="padding-right: 4px;">
                <a class="links" href="/competitions/" >Competitions</a><br>
                <a class="links" href="/esports" >Esports</a><br>

            </div>
            <div class="col-md-3 topright_links" style="padding-left: 0px;    padding-right: 1.1%;">
                <a class="links" style="letter-spacing: 0px" href="/ift/" >Full Throttle</a><br>
                <a class="links " href="/robowars/" >Robowars</a><br>

            </div>
            <div class="col-md-3 topright_links" style="padding-right: 0px;">
                <a class="links" href="/technoholix/" >Technoholix</a><br>
                <a class="links" href="/ozone" >Ozone</a><br>

            </div>
        </div>

    </div>
    <div class="box bottomright">
        <div class="row">
            <div class="col-sm-12 " style="text-align: right; font-size: 3vh">
                <div class="center_notification ">
                    <a href="/workshops" class="blinking">Workshops are now live!</a><br>
                    <a href="/summit" class="blinking">Summit registration are now open!</a><br>

                    {{--                    <a href="/robowars" class="blinking2">Robowars is live now!</a>--}}
                </div>

            </div>
        </div>
    </div>
    <div class="box bottomleft">
        <div class="row ">
            <div class="col-md-4 bottomleft_link" style="    width: 30%;">
                <a class="links" href="/media/" >Media</a><br>
                <a class="links " href="/sponsors/" >Sponsors</a><br>


            </div>
            <div class="col-md-4 bottomleft_link " style="    padding-left: 0px;    width: 30%;">
                <a class="links " href="/legals/" >Legals</a><br>
                <a class="links " href="/hospitality" >Hospitality</a><br>

            </div>
            <div class="col-md-4 bottomleft_link" style="padding-left: 0px;">
                <a class="links" href="/theme" >Theme</a><br>

                <a class="links " href="/contact-us" style="padding-right: 0.4vw;">Contact Us</a><br>


            </div>

        </div>
    </div>
    <div class="box bottomcentre" style="font-size: 16px;">

        <a style="color: white" href="https://www.facebook.com/iitbombaytechfest" target="_blank"><i class="fab fa-facebook-f fa-lg" style=""></i></a>
        <a style="color: white" href="https://www.instagram.com/techfest_iitbombay/" target="_blank"><i class="fab fa-instagram fa-lg"></i></a>
        <a style="color: white" href="https://twitter.com/Techfest_IITB" target="_blank"><i class="fab fa-twitter fa-lg"></i></a>
        <a style="color: white" href="https://in.linkedin.com/company/techfest" target="_blank"><i class="fab fa-linkedin-in fa-lg"></i></a>
        <a style="color: white" href="https://in.pinterest.com/techfestiitbombay/" target="_blank"><i class="fab fa-pinterest-p fa-lg"></i></a>
        <a style="color: white" href="https://www.youtube.com/user/techfestiitbombay" target="_blank"><i class="fab fa-youtube fa-lg"></i></a>

    </div>
    <div class="box topcentre" >
        <a href="/tf"><img class="logo" src="/2019/tf_date.png" alt=""></a>

    </div>
</div>
<div class="wrapper">
    <div class="main">
        <section class="page1" id="page1">
{{--            <img id="black_blurr" class="mandala black_blurr" src="/2019/homepage/images/Background_Blur-min.png" alt="" style="opacity: 0.5">--}}
            <img id="mandala_6" class="mandala mandala_6" src="/2019/homepage/images/mandala_6.png" >
            <img id="mandala_5" class="mandala mandala_5" src="/2019/homepage/images/mandala_5c.png" >
            <img id="mandala_4" class="mandala mandala_4" src="/2019/homepage/images/mandala_4c.png" >
            <img id="mandala_3" class="mandala mandala_3" src="/2019/homepage/images/mandala_3.png" >
            <img id="mandala_2" class="mandala mandala_2" src="/2019/homepage/images/mandala_2c.png" >
            <img id="mandala_1" class="mandala mandala_1" src="/2019/homepage/images/mandala_1.png" >

            <img id="left_eye" class="left_eye" src="/2019/homepage/images/Eye_Left.png" alt="">
            <img id="right_eye" class="right_eye" src="/2019/homepage/images/Eye_Right-min.png" alt="" >

        </section>
        <section class="page2">
            <div class="row ">
                <div class="col-md-4">
                    <div class="guine_box" style="padding-top: 15.6vh">
                        <img class="guine zoom" src="/2019/homepage/images/gunnessc.jpg" alt="" style="    height: 70.7vh;">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="center_letter_box" style="padding-top: 15.6vh;padding-bottom: 23%;text-align: left;width: 16.4vw;height: 100vh;">
                        <img class=" zoom" src="/2019/homepage/images/letter-min.png" alt="" style="width: 100%;  margin: auto; " >
                        <img class=" zoom" src="/2019/homepage/images/apjc.png" alt="" style="width: 97.4%;bottom: 13.7vh;margin-top: 3vh;">

                    </div>

                </div>
                <div class="col-md-6">
                    <div class="text_box"  style="    height: 100vh;padding-top: 12.1vh;padding-bottom: 16vh;padding-right: 4vw;padding-left: 3vw;text-align: left;color: white;font-size: 2.7vh;">
                        <div class="text zoom" style="padding-top: 4px;">
                            <h1><b> 3<sup>rd</sup> - 5<sup>th</sup> January, 2020</b></h1>
                            <p style="font-size: 2.2vh;">
                                Welcome to the Official Website of the 23rd Edition of Asia's Largest Science and Technology Festival - Techfest 2019-2020: Da Vincian Spectacle!
                                This website was created to help you find information about each and every aspect of Techfest 2019-20 as well as the various other events and initiatives Techfest, IIT Bombay conducts all year round.
                                <br>
                                We have restructured the website to reflect the diversity and range of events Techfest has to offer. So make sure to explore the site! Who knows what may catch your fancy?
                                <br>
                                DreamOn
                                <br>
                            </p>
                            <p style="text-align: right; font-size: 20px;">
                                ~ Team Techfest

                            </p>
                            <a href="https://www.youtube.com/watch?v=jZt53MjhiX4" title="Official Aftermovie">
                                <img src="/2019/homepage/aftermovie.png" alt="" style="height: 30.5vh; width: auto; position: absolute; bottom: 13.8vh;">

                            </a>
                            {{--                            <iframe style="height: 30.7vh; width: 37vw;"  src="https://www.youtube.com/embed/2z3CEBv8PLI?start=160;autoplay=0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>--}}
                        </div>
                    </div>
                </div>
            </div>
            <a style="position: absolute;bottom: 17vh;right: 2.2vw;" href="/tf"><img class="" src="/2019/iitblogowhite.png" alt="" style="height: 8vh;"></a>
            <h5 style="position: absolute;color: white;top: 83.1vh;right: 1.2vw;"><i class="far fa-copyright"></i>TECHFEST, IIT BOMBAY</h5>

        </section>
    </div>
</div>
<a title="Dark Mode" href="/2019/homepage/dark.html"><i class="fas fa-moon" style="position: absolute; top: 50vh;opacity: 0" ></i></a>
<a href="/theme" title="Click Here to Explore Theme">
    <button style="width: 7vw;
    height: 7vw;
    top: 43.8vh;
    position: absolute;
    left: 46.5vw;
    border-radius: 50%;
    opacity: 0;
"></button>
</a>
<script>
    $(".page1").bind("webkitAnimationEnd mozAnimationEnd animationend", function(){
        $(this).removeClass("#mandala_1")
    })

    $(".page1").hover(function(){
        $(this).addClass("#mandala_1");
    })
</script>

</body>
</html>