<!DOCTYPE html>
<html lang="zxx" class="no-js">
<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon-->
    <link rel="shortcut icon" href="/2018/Ic/img/fav.png"><!-- Meta Description -->
{{--">--}}
    <!-- Meta Keyword -->
{{--    <meta name="keywords" content="innovation challenge by techfest, innovationchallenge,innovation, challenge, olympiad, science, technology, russia, moscow, winter, camp, isro, school, Techfest, largest festival. young minds, prizes, trip to isro, asia's largest, IIT Bombay, sof, nso, Science olympiad foundation, National science Olympiad ">--}}
    <!-- meta character set -->
    <meta charset="UTF-8">
    <!-- Site Title -->
    <title>Innovation Challenge 2019 | Techfest, IIT Bombay</title>
    <link rel="shortcut icon" type="image/x-icon" href="https://techfest.org/img/2018/icon.ico" />

    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">

    <meta property="og:url" content="{{url()->current()}}">
    <meta property="og:image" content="{{asset('asset/img/Ic.jpg')}}">
    <meta property="og:title" content="Innovation Challenge 2019-20 | Techfest, IIT Bombay">
    <meta property="og:site_name" content="Techfest 2019-20">
{{--    <meta property="og:see_also" content="https://m.techfest.org">--}}
    <!--
    CSS
    ============================================= -->
    <link rel="stylesheet" href="/2018/Ic/css/linearicons.css">
    <link rel="stylesheet" href="/2018/Ic/css/owl.carousel.css">
    <link rel="stylesheet" href="/2018/Ic/css/font-awesome.min.css">
    <link rel="stylesheet" href="/2018/Ic/css/nice-select.css">
    <link rel="stylesheet" href="/2018/Ic/css/magnific-popup.css">
    <link rel="stylesheet" href="/2018/Ic/css/bootstrap.css">
    <link rel="stylesheet" href="/2018/Ic/css/main.css">
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-81222017-1"></script>
    <script>window.dataLayer = window.dataLayer || [];function gtag(){dataLayer.push(arguments);}gtag('js', new Date());gtag('config', 'UA-81222017-1');</script>
    <style>
        html {
            overflow-x:hidden;
            overflow-y: auto;
        }
        ::-webkit-scrollbar {
            width: 0px;
            background: transparent; /* make scrollbar transparent */
        }
        html {
            scroll-behavior: smooth;
        }
        body{
            font-family: "Open Sans", Sans-Serif;
            background-color: #275E80; /* For browsers that do not support gradients */
            background-image: linear-gradient(#275E80 , #2C2F7A);
        }

        .work-arrow{
            display: none;
        }
        .text-white-50{
            opacity: 0.5;
        }
        .container1 {
            position: relative;
            margin-top: 50px;
            width: 100%;
            height: auto;
        }

        .overlay1 {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0);
            transition: background 0.5s ease;
        }

        .container1:hover .overlay1 {
            display: block;
            background: rgba(0, 0, 0, .3);
        }

        img.abc {
            position: relative;
            width: 100%;
            height: auto;
            left: 0;
        }

        .gg *{
            color: #ffffff!important;
        }

        .title1 {
            position: absolute;
            width: 100%;
            left: 0;
            top: 40%;
            font-weight: 700;
            font-size: 30px;
            text-align: center;
            text-transform: uppercase;
            color: white;
            z-index: 1;
            transition: top .5s ease;
        }

        .container1:hover .title1 {
            transform:scale(1.4);
        }
        .container1{
            overflow: hidden;
        }
        .container1:hover *{
            transform:scale(1.2);
            transition: all 1s;
        }
        .container1:hover img{
            filter: blur(1px);
        }

        .button1 {
            position: absolute;
            width: 100%;
            left: 0;
            top: 130px;
            text-align: center;
            opacity: 0;
            transition: all .35s ease;
        }

        .button1 a {
            width: 200px;
            padding: 12px 48px;
            text-align: center;
            color: white;
            border: solid 2px white;
            z-index: 1;
        }

        .container1:hover .button1 {
            opacity: 1;

        }
        .spon{
            display: block;
            margin: auto;
        }
        .sched{
            padding: 10px;
            margin: 10px;
            box-shadow: 0px 0px 5px 0px black;
        }
        .sched1{
            width: 362px;
            margin:auto;
        }
        @media (max-width: 772px){
            .sched1{
                width: auto;
            }
            .footer2{
                display:block;
            }
            .footer3{
                display: none;
            }
            .hide1{
                display:none;
            }
            .spon{
                /*width: 200px;*/
                display: block;
                padding-left: 30vw;
                margin: auto;
            }
            .bajaj{
                padding-left: 38vw;
                padding-top: 3vh;
            }
            .smrt{
                padding-bottom: 2vh;
                padding-left: -10vw;
            }
        }
        @media(max-width:992px){
            .smrt{
                padding-left:0;
                padding-right:0;
            }
            .spon{
                width: 90% !important;
                padding: 0 !important;
            }
            .bajaj{
                padding-left: 0;
            }


        }
        @media(min-width:992px){
            .bottom_div{

                margin-top: -100px;
            }
        }
    </style>
</head>
<body style="overflow-x: hidden;">
<div class="main-wrapper-first">
    <div class="hero-area relative">
        <header>
            <div class="container">
                <div class="header-wrap">
                    <div class="header-top d-flex justify-content-between align-items-center">
                        <div class="logo">
                            <a href="https://techfest.org/"><img src="/2019/tf_date.png" alt="" style="height: 55px;"></a>
                        </div>
                        <div class="main-menubar d-flex align-items-center">
                            <nav class="hide">
                                <a href="#abt" style="font-size:1em;">About</a>
                                <a href="#schd" style="font-size:1em;">Schedule</a>
                                <a href="#inct" style="font-size:1em;">Incentives</a>
                                <a href="#cnt" style="font-size:1em;">Contact</a>
                            </nav>
                            <div class="menu-bar">
                                <span class="lnr lnr-menu"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="banner-area">
            <div class="container">
                <div class="row height align-items-center">
                    <div class="col-lg-7">
                        <div class="banner-content" data-aos="zoom-in" style=" overflow: visible">
                            <img src="/2019/ic/Unified Logo_2015_ISO.jpg" alt="" style="max-height: 60px; margin: auto">
                            <img src="/2019/ic/NSTSE_Logo.jpg" alt="" style="max-height: 60px; margin: auto">
                            <a href="https://www.justexam.in/"><img title="Portal Partner" src="/2019/ic/exam.png" alt="" style="max-height: 60px; margin: auto"></a>
                            <h1 class="text-white text-uppercase mb-10">INNOVATION CHALLENGE</h1>
                            <p class="text-white mb-30" style="font-size:1.1em;"><span class="text-white-50">Brought to you by</span > Techfest 2019-20, IIT Bombay<br><br><br><span class="text-white-50">In collaboration with Unified Council</span></p>
                            <a href="/innovationchallenge/login" target="_blank" class="primary-btn d-inline-flex align-items-center" style="margin-bottom: 10px;overflow: visible"><span class="mr-10">Login</span></a>
                            <a href="/innovationchallenge/register" target="_blank" class="primary-btn d-inline-flex align-items-center" style="margin-bottom: 10px;overflow: visible"><span class="mr-10">Register</span></a>
{{--                            <p class="primary-btn ml-2 d-inline-flex align-items-center" id="signinButton" style="margin-bottom: 10px;overflow: visible"><span class="mr-10">Login/Register</span></p>--}}
                            <h4 class="text-warning mb-10" style="font-weight: bold"></h4>
                        </div>
                     </div>
                    <div class="col-lg-5 afty hide1" data-aos="zoom-in" style="pointer-events: none; overflow: visible;background-size: 80%;"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="main-wrapper">
    <section class="working-process-area" style="padding-bottom: 48px;padding-top: 0;">
        <div class="container">
            <div class="row">
                <div class="col-md-2" ></div>
                <div class="col-md-4" data-aos="zoom-in">
                    <div class="single-feature">
                        <div class="container1">
                            <img class="abc" src="/2018/Ic/TF_schools-min.jpeg" alt="">
                            <p class="title1">42,000+<br><span style="line-height: 35px;">SCHOOLS</span></p>
                            <div class="overlay1"></div>

                        </div>
                    </div>
                </div>
                <div class="col-md-4" data-aos="zoom-in">
                    <div class="single-feature">
                        <div class="container1">
                            <img class="abc" src="/2018/Ic/TF_students-min.jpeg" alt="">
                            <p class="title1">300,000+<br><span style="line-height: 35px;">STUDENTS</span></p>
                            <div class="overlay1"></div>

                        </div>
                    </div>
                </div>
{{--                <div class="col-md-4" data-aos="zoom-in">--}}
{{--                    <div class="single-feature">--}}
{{--                        <div class="container1">--}}
{{--                            <img class="abc" src="/2018/Ic/TF_countries-min.jpeg" alt="">--}}
{{--                            <p class="title1">25<br><span style="line-height: 35px;">COUNTRIES</span></p>--}}
{{--                            <div class="overlay1"></div>--}}

{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
        </div>
    </section>
</div>
<div class="main-wrapper">
    <section id="abt" class="story-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-1"></div>
                <div class="col-lg-7">
                    <div class="story-box" data-aos="fade-right" style="font-size:1.1em;">
                        <h4 class="text-uppercase">About INNOVATION CHALLENGE</h4><br>
                        <p style="text-align: justify;">
                            Techfest is the annual science and technology festival of IIT Bombay. It has been well established as Asia’s Largest Science and Technology Festival. International Exhibits like Sophia, Nao Robots, Competitions like Robowars, Lecturers like His Holiness The Dalai Lama, Dr. APJ Abdul Kalam, Dr. Rakesh Sharma are just the highlights of Techfest, and there is a lot more to explore here at Techfest, IIT Bombay!

                            <br>
                            <br>
                            To foster innovative thinking among students Techfest, IIT Bombay conducts Innovation Challenge this year in collaboration with Unified Council. The students will be asked to present an out of the box idea on a given problem statement, that can change the world.

                            <br> <br>
                            <strong>
                                <a href=""><u>Register yourself to view this year’s problem statement.</u></a>
                            </strong>
                        <ul><strong>
                            <li>Your idea will be judged on the basis of:</li>
                                <li><strong>Feasibility:</strong> Whether your idea can be brought to life and be implemented</li>
                                <li><strong>Impact:</strong> Whether your idea can have a real impact or bring about a change in the society</li>
                                <li><strong>Scalability:</strong> Whether your idea could be scaled from the smallest level to the largest level</li>
                                <li><strong>Originality:</strong> Whether your idea is self-inspired</li>
                            <br>
                                <li><strong>Note:</strong> Students have to submit their solution to the given problem. They are expected to think of new innovative ideas and should not be copied from the internet.</li>
                            </strong>
                        </ul>
                        </p>
                        <a href="#schd" class="primary-btn d-inline-flex align-items-center"><span class="mr-10">Schedule</span><span class="lnr lnr-arrow-down"></span></a>
                    </div>
                </div>
                <div class="col-md-12">

                </div>
            </div>
        </div>
    </section>
    <section style="background-color: white">
        <br>
        <div class="row">
            <h3 style=" text-align: center;width:100%;padding: 0px 14px;">Glimpses of Innovation challenge 2018-19</h3>
            <div class="col-md-12">
                <h2 style="text-align: center;"></h2>
            </div>

            <div class="col-md-7" style="padding: 40px">
                <div>
                    <img src="/2019/ic/russia camp.png" alt="" style="max-height: 250px; margin: auto;max-width: 100%;">

                </div>
                <div class="bottom_div" style="text-align: right; ">
                    <img src="/2019/ic/vssc.jpg" alt="" style="max-height: 250px; margin: auto;max-width: 100%;">

                </div>
            </div>
            <div class="col-md-4">

                <br>
                <p style="text-align: justify;    padding: 4%;">Top 20 students from all across the country were selected for the finale of Innovation Challenge 2018 held at IIT Bombay during Techfest 2018-19. The top 12 winners of Innovation Challenge 2018 were awarded an Educational Trip to Russia supported by ROSATOM where they witnessed the scope of Atomic Energy. The winners had to pay nothing for the trip but a lot of enthusiasm to absorb every single experience the trip was going to offer them. The other 8 winners were awarded a trip to Vikram Sarabhai Space Station, Thiruvananthapuram, where they witnessed the cutting edge Space technologies and observed what ISRO has to offer to the young innovative minds. They also got a chance to meet and interact with Shri S. Somnath the Director of VSSC, ISRO.</p>
            </div>
        </div>
    </section>
    <section class="remarkable-area" style="padding-bottom: 0;padding-top: 30px;">
        <div class="container">
            <div class="row justify-content-center aos-init aos-animate" data-aos="fade-up" style="padding-bottom: 0px;">
                <div class="col-lg-12">
                    <div class="section-title text-center" style="padding-bottom: 8px;">
{{--                        <h2>Structure</h2>--}}
{{--                        <p>The examination portal will open on different days for different regions as mentioned below. Students will submit their proposed solution after they have gone through a series of MCQ questions.</p>--}}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-7 " data-aos="fade-up-right" style="padding: 50px; font-size:1.1em;/* box-shadow: 0 0 5px black; */background: linear-gradient(to right, #3e69fe 0%, #4cd4e3 100%);color: white;">
                    <h4 style="color: white;text-align: center;">Structure</h4>
                    <p class="libre-text mt-50" style="text-align: justify;">
                        <li>Problem Statement: Register yourself on the link given above to view the Innovation Challenge Problem Statement.</li>
                        <li>Online Submission: Submit your solution online after going through a series of mcq questions. Portal will open on different days for different region according to the schedule given below.</li>
                        <li>Finale: Top 20 students will be invited to IIT Bombay during Techfest 2019-20 for the Innovation Challenge finale where they will have to present their solution to a panel of judges.</li>
                    </p>
                </div>
                <div class="col-lg-5 " data-aos="fade-up-left" style="padding: 45px; font-size:1.1em; background: linear-gradient(to right , #3e69fe 0%, #4cd4e3 100%);color: white;">
                    <p style="text-align: center;">SAMPLE MCQ QUESTION</p>
                    <p class="libre-text mb-5" style="padding-top: 50px;">If in some code TECHFEST is written as UDDGGDTS then what will be code for WATER in that language?
                    <p>A: VBSFQ</p>
                    <p>B: XBUFS</p>
                    <p>C: XZUDS</p>
                    <p>D: VBTEQ</p>
                </div>
            </div>
        </div>
    </section>
    <section id="schd" class="remarkable-area" style="padding-bottom: 30px;padding-top: 30px;">
        <div class="container">
            <div class="row justify-content-center aos-init aos-animate" data-aos="fade-up" style="padding-bottom: 0px;">
                <div class="col-lg-12">
                    <div class="section-title text-center" style="padding-bottom: 8px;">
                        <h2>Schedule</h2>
                        <p>The examination portal will open on different days for different regions as mentioned below. Students will submit their proposed solution after they have gone through a series of MCQ questions.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6" style="margin-bottom: 30px;">
                    <div class="sched" data-aos="flip-left">
                        <h3 style="text-align: center">ZONE-1</h3>
                        <h2 style="text-align: center">17th December, 2019</h2>
                        <p style="text-align: center;color: black">2pm - 8pm</p>
                        <p> Rajasthan, Gujarat, Maharashtra, Madhya Pradesh, Goa, Dadar and Nagar Haveli, Daman and Diu</p>

                    </div>
                </div>
                <div class="col-lg-6"  style="margin-bottom: 30px;">
                    <div class="sched" data-aos="flip-up">
                        <h3 style="text-align: center">ZONE-2</h3>
                        <h2 style="text-align: center">18th December, 2019</h2>
                        <p style="text-align: center;color: black">2pm - 8pm</p>
                        <P>Jammu and Kashmir, Haryana, Utrakhand, Punjab, Chandigarh, Delhi, Uttar Pradesh</P>

                    </div>
                </div>
                <div class="col-lg-6" style="margin-bottom: 30px;">
                    <div class="sched" data-aos="flip-right">
                        <h3 style="text-align: center">ZONE-3</h3>
                        <h2 style="text-align: center">19th December, 2019</h2>
                        <p style="text-align: center;color: black">2pm - 8pm</p>
                        <p>Bihar, Jharkhand, Chattisgarh, Odisha, West Bengal, Sikkim, Assam, Arunachal Pradesh, Mizoram, Tripura, Meghalaya, Manipur, Nagaland</p>
                    </div>
                </div>
                <div class="col-lg-6" style="margin-bottom: 30px;">
                    <div class="sched " data-aos="flip-up">
                        <h3 style="text-align: center">ZONE-4</h3>
                        <h2 style="text-align: center">20th December, 2019</h2>
                        <p style="text-align: center;color: black">2pm - 8pm</p>
                        <P>Karnataka, Telangana, Andhra Pradesh, Tamil Nadu, Kerala, Puducherry, Andaman and Nicobar Islands, Lakshdweep</P>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <div id="inct" class="working-process-area" style="padding-top: 50px;padding-bottom: 50px;">
        <div class="container">
            <div class="row justify-content-center" data-aos="zoom-in-up">
                <div class="col-lg-6">
                    <div class="section-title text-center">
                        <h2>AWARDS AND INCENTIVES</h2>
{{--                        <p style="font-size:1.2em;">Coming to the interesting part now, the prizes that await the students….</p>--}}
                    </div>
                </div>
            </div>
            <div class="total-work-process d-lg-flex flex-wrap justify-content-around align-items-center" >
                <div class="row" style="padding: 0px 14px;">
{{--                   Stay tuned for this year’s Rewards and incentives.--}}


{{--                    To stay updated get yourself registered.--}}

{{--                    For more details, visit- https://techfest.org and like our Facebook Page to stay updated.--}}
{{--                    <ul>--}}
                        <li>Winners will get a chance to visit Vikram Sarabhai Space Centre, Thiruvananthapuram and witness the state of the art technologies being used by ISRO.</li>
                        <li>Top 20 students will be invited to IIT Bombay during Techfest 2019-20 and will get opportunity to attend all programs.</li>
                        <li>Winners will get merit certificates and medals from Techfest, IIT Bombay.</li>
                        <li>Participation Certificates will be given to all the students who a submit a valuable solution.</li>
{{--                    </ul>--}}

                </div>

                {{--<div class="single-work-process">--}}
                    {{--<div class="work-icon-box" data-aos="zoom-in-right">--}}
                        {{--<img  src="/2018/Ic/Icon_1-min.png" style="width: 100px;height: 100px; margin-top: 7px;">--}}
                    {{--</div>--}}
                    {{--<span class="caption" style=" DISPLAY: inherit; font-size: 14px; width: 150px;    margin: auto;" data-aos="zoom-in-right">Top 10 students to visit Vikram Sarabhai Space Centre, ISRO, Kerala<br><br></span>--}}
                {{--</div>--}}
                {{--<div class="work-arrow">--}}
                {{--<img class="lnr lnr-layers" src="/2018/Ic/img/elements/work-arrow.png" alt="">--}}
                {{--</div>--}}
                <div class="single-work-process">
                    <div class="work-icon-box" data-aos="zoom-in-right">
                        <img  src="/2018/Ic/Icon_2-min.png" style="width: 100px;height: 100px; margin-top: 10px;">
                    </div>
                    <span class="caption" style=" DISPLAY: inherit; font-size: 14px; width: 150px;    margin: auto;" data-aos="zoom-in-right">Merit Certificate for toppers of the Innovation Challenge<br><br></span>
                </div>
                <div class="work-arrow">
                    <img src="/2018/Ic/img/elements/work-arrow.png" alt="">
                </div>
{{--                <div class="single-work-process" >--}}
{{--                    <div class="work-icon-box" data-aos="zoom-in-up">--}}
{{--                        <img  src="/2018/Ic/Icon_3-min.png" style="width: 100px;height: 100px; margin-top: 10px;">--}}
{{--                    </div>--}}
{{--                    <span class="caption" style=" DISPLAY: inherit; font-size: 14px; width: 150px;    margin: auto;" data-aos="zoom-in-up">Tablets for all 20 students qualified for 2nd level.<br><br><br></span>--}}
{{--                </div>--}}
                <div class="work-arrow">
                    <img src="/2018/Ic/img/elements/work-arrow.png" alt="">
                </div>
                <div class="single-work-process">
                    <div class="work-icon-box" data-aos="zoom-in-left">
                        <img  src="/2018/Ic/Icon_4-min.png" style="width: 100px;height: 100px; margin-top: 10px;">
                    </div>
                    <span class="caption" style=" DISPLAY: inherit; font-size: 14px; width: 150px;    margin: auto;" data-aos="zoom-in-left">Opportunity to attend all programs at Techfest, IIT Bombay on 3rd to 5th January.</span>
                </div>
                <div class="single-work-process">
                    <div class="work-icon-box" data-aos="zoom-in-left">
                        <img  src="/2018/Ic/Icon_5-min.png" style="width: 100px;height: 100px; margin-top: 10px;">
                    </div>
                    <span class="caption" style=" DISPLAY: inherit; font-size: 14px; width: 150px;    margin: auto;" data-aos="zoom-in-left">Participation Certificate to students who submit valuable solutions<br><br></span>
                </div>

            </div>
        </div>
    </div>
{{--    <section class="sponsor" style="background: #fff">--}}
{{--        <div class="container">--}}
{{--            <div class="row justify-content-center" data-aos="zoom-in-up">--}}
{{--                <div class="col-lg-6">--}}
{{--                    <div class="section-title text-center">--}}
{{--                        <h2>POWERED BY</h2>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="d-lg-flex justify-content-center" style="padding-bottom: 30px;">--}}
{{--                <div class="spon smrt"  style="width: 30%;text-align: center;" >--}}
{{--                    <img src="/2018/Ic/smrtbook.png" alt="" style="height: 42px;">--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="container">--}}
{{--            <div class="row justify-content-center" data-aos="zoom-in-up">--}}
{{--                <div class="col-lg-6">--}}
{{--                    <div class="section-title text-center">--}}
{{--                        <h2>SPONSORS</h2>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="d-lg-flex justify-content-center" style="padding-bottom: 30px;">--}}
{{--                <div class="spon" style="width:30%;text-align: center;">--}}
{{--                    <img src="https://techfest.org/2018/Sponsors/topper.png" alt="" style="height: 42px;">--}}
{{--                </div>--}}
{{--                <div class="spon bajaj" style="width:30%;text-align: center;">--}}
{{--                    <img src="https://techfest.org/2018/Sponsors/bajaj.jpg" alt="" style="height: 70px;">--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
</div>
<div class="main-wrapper">
    <section id="cnt" class="footer-widget-area">
        <div class="container">
            <div class="row" style="margin-top: 10px;">
                <div class="col-md-2 "data-aos="fade-right" data-aos="fade-down-left">
                    <div class="single-widget">
                        <div class="desc">
                            <div class="logo">
                                <a href="https://techfest.org/"><img src="/2019/tf_date.png" alt="" style="height: 40px;"></a>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
                <div class="col-md-6" data-aos="fade-down">
                    <div class="single-widget">
                        <div class="desc">
                            <h6 class="title">Contact Us</h6>
                            <div class="row gg">
                                <div class="col-sm-6" style=" color: white;font-size: 19px;text-align: center;">
                                    <b>Abhyuday Chauhan</b><br>+91 7700901981<br>
                                    <a href="mailto:abhyuday@techfest.org" style="text-decoration: none;">
                                        <p style="text-align: center;font-size: 19px ; margin-top: 14px;">abhyuday@techfest.org</p>
                                    </a>
                                </div>
                                <div class="col-sm-6" style="font-size: 19px;text-align: center;">
                                    <b>Prafull Gupta</b><br>+91 7985743808<br>
                                    <a href="mailto:prafull@techfest.org" style="text-decoration: none;">
                                        <p style="text-align: center;font-size: 19px ; margin-top: 14px;">prafull@techfest.org</p>
                                    </a>
                                </div>
                                <div class="col-sm-12">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 gg" style="padding-top: 18px;" data-aos="fade-down-right">
                    <h3 style="font-weight: bold;text-align: center;"><a href="https://techfest.org/">Techfest</a></h3>
                    <ul class="contact" style="text-align: center;">
                        <li style="text-align: center;"><a style="font-size: 19px;text-align: center;" href="https://techfest.org/about-us" target="_blank">About</a></li>
                        <li style="text-align: center;"><a style="font-size: 19px;text-align: center;" href="https://techfest.org/initiatives" target="_blank">Initiatives</a></li>
                        <li style="text-align: center;"><a style="font-size: 19px;text-align: center;" href="https://techfest.org/competitions" target="_blank">Competitions</a></li>
                        <li style="text-align: center;"><a style="font-size: 19px;text-align: center;" href="https://techfest.org/contact-us" target="_blank">Team</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <footer style="margin-top: 15px;">
            <div class="container">
                <div class="footer-content d-flex justify-content-between align-items-center flex-wrap">
{{--                    <p style="text-align: centre;"><br>Designed & developed by Amey & Mohit</p>--}}
                    <div class="copy-right-text">Copyright © 2019-20 <span style="font-weight: bold;"><a href="https://techfest.org/legal" style="color: white!important;">Techfest</a></span><span class="footer2"><span class="footer3"> - </span>All Rights Reserved</span></div>
                    <div class="footer-social" >
                        <a href="https://www.facebook.com/iitbombaytechfest/"><i class="fa fa-facebook"></i></a>
                        <a href="https://twitter.com/Techfest_IITB"><i class="fa fa-twitter"></i></a>
                        <a href="https://www.youtube.com/user/techfestiitbombay"><i class="fa fa-youtube-play"></i></a>
                        <a href="https://www.linkedin.com/company/techfest/"><i class="fa fa-linkedin"></i></a>
                        <a href="https://www.instagram.com/techfest_iitbombay/"><i class="fa fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </footer>
    </section>
    <form action="" method="post" id="h-form" class="d-none">
        {{csrf_field()}}
        <input type="hidden" name ="code" id="name2" style="background-color: blue">

    </form>

</div>
<script src="/2018/Ic/js/vendor/jquery-2.2.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="/2018/Ic/js/vendor/bootstrap.min.js"></script>
<script src="/2018/Ic/js/jquery.ajaxchimp.min.js"></script>
<script src="/2018/Ic/js/owl.carousel.min.js"></script>
<script src="/2018/Ic/js/jquery.nice-select.min.js"></script>
<script src="/2018/Ic/js/jquery.magnific-popup.min.js"></script>
<script src="/2018/Ic/js/main.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>
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

</body>
</html>
