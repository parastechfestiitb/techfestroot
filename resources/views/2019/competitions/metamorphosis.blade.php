<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Civilisational Metamorphosis | Techfest, IIT Bombay</title>

    <link rel="shortcut icon" type="image/x-icon" href="/2019/ca/images/favicon_logo.png" />
    <meta property="og:image" content="https://techfest.org/2019/compi/metamorphosis.jpg" />

    <meta name="viewport" content="width=device-width, initial-scale=1">

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
                background-color: transparent;

                background-size: cover;
                background-image: url(/2019/compi/images/metamorphosis.jpg) ;
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
            right: 0;
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
            min-width: 250px;
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
        <nav id="colorlib-main-menu" role="navigation" style="margin-top: 150%; font-size: medium; ">
            <ul>
                <li ><a href="/competitions">Home</a></li>
                <li ><a onclick="myFunction0()">General</a></li>
                <li ><a onclick="myFunction2()">FaQs</a></li>
                <li ><a onclick="myFunction1()">Structure</a></li>
                <li ><a onclick="myFunction3()">Judging</a></li>
                <li ><a onclick="myFunction4()">Contact Us</a></li>

            </ul>
        </nav>


    </aside>

    <div id="colorlib-main">
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
                            <h2 style="color: white; font-weight: bold">Civilisational Metamorphosis</h2>
                            <hr style="color: white; border: 1px solid white">
                            <h3 style="color: white">Prize Money: INR 70,000/- </h3>

                            <p style=" font-size: 15px; width:90%; font-family: Lato;color: white ">
{{--                                @if(!empty($user_row->name))--}}
{{--                                    {{$user_row->name}}, @endif--}}
                                Innovation is the vital spark of all human change, improvement and progress<br>
                                The sole motto of Ideate is to encourage youth to come up with innovative ideas to reform and transfigure the present situation in the world! Ideate provides a platform for young minds to showcase their talent through novel ideas having the potential to become the harbinger of change and crusader of the cause. Let’s bring a change in the world!
                            <p></p>

                            @if(!empty($user_row->email))
                                <?php

                                $team =  DB::table('tf_reg')->where(['metamorphosis_team' => $user_row->metamorphosis_team])->get();
                                $team_leader_row = DB::table('tf_reg')->where(['email' => $team[0]->metamorphosis_team])->first();

                                if($user_row->metamorphosis_team == $user_row->email ){
                                    $team_leader = $user_row->name;
                                }
                                ?>
                            @endif

{{--                            <a href="/2019/compi/ps/civilisationalmetamorphosis.pdf" target="_blank" class="btn btn-primary btn-learn">Problem Statement</a>--}}

                            @if(!empty($user_row->email))
                                @if($user_row->metamorphosis == 0 or empty($user_row->metamorphosis))
                                    {{--                                        if he is not registered--}}
{{--                                    <a href="/competitions/metamorphosis/reg" class="btn btn-primary btn-learn" >Register</a>--}}
                                    <a href="#" class="btn btn-primary btn-learn" >Registrations Closed</a>
                                @endif
                                @if($user_row->metamorphosis == 1 && empty($user_row->metamorphosis_team))
                                    <div class="dropdown ">
                                        <button class=" btn btn-primary btn-learn"><b>Team</b></button>
                                        <div class="dropdown-content">
                                            <a href="/competitions/metamorphosis/createteam">Create Team</a>
                                            <a href="/competitions/metamorphosis/jointeam">Join Team</a>
                                        </div>
                                    </div>
                                @endif

                                @if(!empty($user_row->metamorphosis_team))
                                    @if($user_row->metamorphosis_team != $user_row->email )
                                        <a href="/competitions/metamorphosis/leaveteam" class="btn btn-primary btn-learn" >Leave current Team</a>
                                    @endif
                                    @if($user_row->metamorphosis_team == $user_row->email )
                                        <a href="/competitions/metamorphosis/dissolveteam" class="btn btn-primary btn-learn" >Dissolve the team</a>
                                        <div class="dropdown ">
                                            <button class=" btn btn-primary btn-learn">Remove a Member</button>
                                            <div class="dropdown-content">
                                                @if(!empty($team[0]->name) and ($team[0]->email != $team_leader_row->email) )
                                                    <a href="/competitions/metamorphosis/remove/{{$team[0]->id}}">{{$team[0]->name}}</a>
                                                @endif
                                                @if(!empty($team[1]->name) and ($team[1]->email != $team_leader_row->email) )
                                                    <a href="/competitions/metamorphosis/remove/{{$team[1]->id}}">{{$team[1]->name}}</a>
                                                @endif
                                                @if(!empty($team[2]->name) and ($team[2]->email != $team_leader_row->email) )
                                                    <a href="/competitions/metamorphosis/remove/{{$team[2]->id}}">{{$team[2]->name}}</a>
                                                @endif
                                                @if(!empty($team[3]->name) and ($team[3]->email != $team_leader_row->email) )
                                                    <a href="/competitions/metamorphosis/remove/{{$team[2]->id}}">{{$team[3]->name}}</a>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            @endif
                            @if(empty($user_row->email))
                                <button class="btn btn-primary btn-learn" >Registrations Closed</button>
{{--                                <a href="/2019/compi/ps/How to register.pdf" style="color: white">Want to know how to register - Click here</a>--}}

                            @endif
                            <div id="snackbar">Registeration is closed</div>
                            @if(!empty($user_row))
                                @if($user_row->metamorphosis > 0 && empty($user_row->metamorphosis_team))
                                    <div class="alert alert-success">
                                        <p><strong>Hi {{$user_row->name}}, you are successfully registered for Civilisation Metamorphosis with <b>{{$user_row->email}}</b> as your Registered email id , now you must create/join a team.</strong></p>
                                    </div>
                                @endif
                                @if($user_row->metamorphosis > 0 && !empty($user_row->metamorphosis_team))
                                    <div class="" style="    border: solid 2px white;border-radius: 6px;padding: 2%;width: 95%">
                                        <p style="color: white">
                                            Team Leader : {{$team_leader_row->name}}<br>
                                            Team ID :CM- {{$team_leader_row->metamorphosis_team_id}}
                                            @if(!empty($team[0]->name) )
                                                Member1 : {{$team[0]->name}} |
                                            @endif
                                            @if(!empty($team[1]->name) )
                                                Member2 : {{$team[1]->name}}
                                            @endif

                                        </p>

                                        <p style="color: white; margin-bottom: 0px;">
                                            @if(!empty($team[2]->name))
                                                Member3 : {{$team[2]->name}} |
                                            @endif

                                            @if(!empty($team[3]->name))
                                                Member4 : {{$team[3]->name}}
                                            @endif

                                        </p>
                                    </div>
                                    <br>
                                @endif
                            @endif


                        </div>

                    </div>
                </div>
            </div>

        </div>

        {{--        <div class="scroll box123">--}}
        <div id="text_change" class="col-md-12 animate-box scroll_inside" data-animate-effect="fadeInLeft" style="
            width: 80%;
            display:block;
            border-radius: 5px;
            /*background-color: #fff;*/
            margin-bottom: 1%;
            height:20%;
            left: 5%;
            color: white;
            border: 1px solid white;
            font-size: 17px;
            font-family: 'Muli', sans-serif;">
            <p id="text_change" style="margin-bottom: 0px; color: white">
                <br>Participants are invited to come up with innovative technological solutions to tackle any of the problems listed below:<br>
                The following themes(bulleted points) are just guidelines to help you. You are free to think like an unconventional
                thinker and come up with great innovations.
                <br><br>Handicraft Sector
                <br>▪ Indian handicrafts and traditional crafts showcase the rich heritage and true culture of our nation. Due to unorganized production, outdated production methods, financial incapability of artisans to upgrade technology in production, lack of market linkages and lack of interest by new generation, handicraft sector is facing many challenges and losing its value.
                <br>Participants are invited to come up with innovative technological ideas that can help artisans in overcoming these challenges

                <br><br> OR
                <br><br>Drug and Substance Abuse
                <br>▪ Over the last few decades, the consumption of drugs has become one of the biggest problems in the country. A study showed that 83% of drug addicts in Punjab are well-educated and 83% have jobs. A survey conducted in Delhi revealed that children in the age group of 9-10 have already started consuming tobacco or alcohol.
                <br>Participants are invited to come up with innovative technological ideas that help drug addicts in giving up drug or substance abuse, gradually, and prevent such cases.

                <br><br> OR
                <br><br>Cyber Security
                <br>▪ Cyber security is a top concern for today’s business owners and technology executives. The cyber security landscape in India is intended to witness several cloud computing security challenges. 76% Indian businesses were hit by cyber attacks in the last year. 14% IT managers who were victim to one or two of these attacks can’t pinpoint how the attackers gained entry and 17% don’t know how long the threat was in the environment before it was detected.
                <br>As the cyber attacks will become worse and worse in upcoming time, participants are invited to come up with solutions that can provide security against cyber crimes.

                <br><br> OR
                <br><br>Agriculture
                <br>▪ Agriculture plays a critical role in food security, political stability and world peace, yet it leaves a big environmental footprint. Agriculture accounts for greenhouse gas emissions and nitric oxide emissions. It is also responsible for waste of water when used carelessly, top layer soil loss and drives 80% of the tropical deforestation.
                <br>Participants are invited to come up with innovative technological solutions for irrigation management, to decide which are the best yielding crops for the soil, to provide the better market for agricultural products, to get more production using small strips of land and to solve the problem of water wastage.

                <br><br> OR
                <br><br>Women Safety
                <br>▪ According to the WHO, one in three women globally has been sexually or physically abused. Around 70% women in India are victims of domestic violence. Women’s safety is a key issue and tech seems to be a potential solution. A study found that 80% of women of India had experienced sexual harassment ranging from unwanted comments, being groped or assaulted.
                <br>The participants are invited to come up with innovative ideas that can help in preventing crimes against women and spreading awareness about women’s rights, help them in reporting such crimes.
                <br><br> OR
                <br><br>Transportation & Traffic Management
                <br>▪ Transportation and distribution of all resources and products are an integral part of any economy and any improvement in this sector directly manifests as an improvement in life. According to a WHO report, more than 1.35 lakh lives are lost a year due to road accidents. Innovative ideas of road traffic patterns and transportation need to be encouraged in order to lessen the accidents.
                <br>Participants are invited to come up with innovative technological solutions for better management of transport systems.<br>


                <br></p>
        </div>
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

<script>
    function myFunction() {
        var x = document.getElementById("snackbar");
        x.className = "show";
        setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
    }
</script>
<script>
    function myFunction0() {
        document.getElementById("text_change").innerHTML = "<br>Participants are invited to come up with innovative technological solutions to tackle any of the problems listed below:<br>\n" +
            "                The following themes(bulleted points) are just guidelines to help you. You are free to think like an unconventional\n" +
            "                thinker and come up with great innovations.\n" +
            "                <br><br>Handicraft Sector\n" +
            "                <br>▪ Indian handicrafts and traditional crafts showcase the rich heritage and true culture of our nation. Due to unorganized production, outdated production methods, financial incapability of artisans to upgrade technology in production, lack of market linkages and lack of interest by new generation, handicraft sector is facing many challenges and losing its value.\n" +
            "                <br>Participants are invited to come up with innovative technological ideas that can help artisans in overcoming these challenges\n" +
            "\n" +
            "                <br><br> OR\n" +
            "                <br><br>Drug and Substance Abuse\n" +
            "                <br>▪ Over the last few decades, the consumption of drugs has become one of the biggest problems in the country. A study showed that 83% of drug addicts in Punjab are well-educated and 83% have jobs. A survey conducted in Delhi revealed that children in the age group of 9-10 have already started consuming tobacco or alcohol.\n" +
            "                <br>Participants are invited to come up with innovative technological ideas that help drug addicts in giving up drug or substance abuse, gradually, and prevent such cases.\n" +
            "\n" +
            "                <br><br> OR\n" +
            "                <br><br>Cyber Security\n" +
            "                <br>▪ Cyber security is a top concern for today’s business owners and technology executives. The cyber security landscape in India is intended to witness several cloud computing security challenges. 76% Indian businesses were hit by cyber attacks in the last year. 14% IT managers who were victim to one or two of these attacks can’t pinpoint how the attackers gained entry and 17% don’t know how long the threat was in the environment before it was detected.\n" +
            "                <br>As the cyber attacks will become worse and worse in upcoming time, participants are invited to come up with solutions that can provide security against cyber crimes.\n" +
            "\n" +
            "                <br><br> OR\n" +
            "                <br><br>Agriculture\n" +
            "                <br>▪ Agriculture plays a critical role in food security, political stability and world peace, yet it leaves a big environmental footprint. Agriculture accounts for greenhouse gas emissions and nitric oxide emissions. It is also responsible for waste of water when used carelessly, top layer soil loss and drives 80% of the tropical deforestation.\n" +
            "                <br>Participants are invited to come up with innovative technological solutions for irrigation management, to decide which are the best yielding crops for the soil, to provide the better market for agricultural products, to get more production using small strips of land and to solve the problem of water wastage.\n" +
            "\n" +
            "                <br><br> OR\n" +
            "                <br><br>Women Safety\n" +
            "                <br>▪ According to the WHO, one in three women globally has been sexually or physically abused. Around 70% women in India are victims of domestic violence. Women’s safety is a key issue and tech seems to be a potential solution. A study found that 80% of women of India had experienced sexual harassment ranging from unwanted comments, being groped or assaulted.\n" +
            "                <br>The participants are invited to come up with innovative ideas that can help in preventing crimes against women and spreading awareness about women’s rights, help them in reporting such crimes.\n" +
            "                <br><br> OR\n" +
            "                <br><br>Transportation & Traffic Management\n" +
            "                <br>▪ Transportation and distribution of all resources and products are an integral part of any economy and any improvement in this sector directly manifests as an improvement in life. According to a WHO report, more than 1.35 lakh lives are lost a year due to road accidents. Innovative ideas of road traffic patterns and transportation need to be encouraged in order to lessen the accidents.\n" +
            "                <br>Participants are invited to come up with innovative technological solutions for better management of transport systems.<br>\n" +
            "\n" +
            "\n" +
            "                <br>";
        // document.getElementById("text_change").innerHTML = "";
    }
</script>

<script>
    function myFunction1() {
        document.getElementById("text_change").innerHTML = "<br><u>ABSTRACT FORMAT</u>\n <br>" +
            "\n" +
            "<br>1. Title\n" +
            "\n" +
            "<br><br>2. Abstract\n" +
            "<br>Objectives\n" +
            "<br>Beneficiaries (For whom)\n" +
            " <br>Value of results (Use)\n" +
            "<br><br>3. Background\n" +
            "\n" +
            "<br><br>4. Statement of Problem - A Succinct definition of the problem (follows from material in the background section)\n" +
            "\n" +
            "<br><br>5. Research\n" +
            " <br> Present methods of tackling the problem (if any)\n" +
            " <br>Proposed Solution\n" +
            " <br>Alternate solutions/approaches\n" +
            "<br>Novelty of Approach: How is or will be your solution better than existing products that address the same problem?\n" +
            "<br><br>6. Technical Report\n" +
            "  <br>Description of concepts, theories or approaches involved in the proposed solution.\n" +
            " <br>Technical aspect of the proposed solution.\n" +
            "<br>Detailed technical specifications and pictorial representations (block diagrams/ flow chart)\n" +
            " <br>Description of the flow of operations demonstrating key features and functionality.\n" +
            " <br>Performance estimate of the solution.\n" +
            " <br>Experimentation done to establish the workability of the above.\n" +
            "<br> A link to the video of the working model/ prototype.\n" +
            "<br><br>7. Results\n" +
            " <br> Actual findings, a significant output of tests and analysis (Must be readable)\n" +
            "<br> Include problems encountered, the credibility of results, accuracy estimates\n" +
            "<br>Pros and cons of your solution   Utility of results\n" +
            "<br><br>8. A link of the Google Drive Folder which contains Pictures and Video of the   working model/ prototype.\n" +
            "\n" +
            "<br><br>9. Application\n" +
            "<br>Your idea as a solution to the problem\n" +
            " <br>Additional applications\n" +
            " <br>Benefits to the users\n" +
            "<br><br>10. Future prospects and research in it and further development (in brief)\n" +
            "\n" +
            "<br><br>11. Any other Details: (Patent/ Business plan etc.)\n" +
            "\n" +
            "<br><br><u>SUBMISSION FORMAT</u>\n" +
            "\n" +
            "<br><br>The project report should be emailed to metamorphosis@techfest.org with the subject ‘Ideate: ‘’Civilisational Metamorphosis’’ Project Report: Team Id’ (for eg. Ideate: ‘’Civilisational Metamorphosis’’ Project Report: CM1234).\n" +
            "All the submissions should be emailed to metamorphosis@techfest.org. Teams must follow the following details for the submission:\n" +
            "<br>The abstract must be submitted in pdf format only\n" +
            " <br>Font: Arial\n" +
            " <br>Size: 11\n" +
            " <br>Spacing between two lines: 6 pts\n" +
            " <br>Spacing between two paragraphs: 10 pts\n" +
            " <br>Bottom margin: 1 inch\n<br>" +
            "<br><u>PROTOTYPE AND FINAL PRESENTATION\n</u>" +
            "\n" +
            "<br><br>After declaration of the finalists, participants are required to improve upon the prototype/ working model of their project. They will also have to make a presentation covering the technical and financial aspects of their product in a detailed manner. This final presentation and the video will have to be submitted at metamorphosis@techfest.org before 10th December 2019. The shortlisted teams can however, continue to work on their prototypes till 2nd January, 2020. The teams will have to bring their prototypes to be judged and showcased at Techfest 2019-20 during 3rd to 5th January, 2020. The working prototype should be as close as possible to the product that the team intends to present to the end user. This would also help in deciding a better estimate of the cost of the prototype, reflecting closely the actual cost of the product\n" +
            "<br> <br><u>TIMELINE</u>" +
            "<br><br>First Project Report Submission: 25 September,2019\n" +
            "<br>Mentorship Stage: 1 October-30 October, 2019\n" +
            "<br>Last Date of Registration:2 November, 2019\n" +
            "<br>Final Project Report Submission: 3 November, 2019\n" +
            "<br>Declaration of Result:8 November, 2019\n" +
            "<br>Improvisation Stage:9 November-9 December, 2019\n" +
            "<br>Final presentation & video submission:10 December, 2019\n" +
            "<br>Presentation Stage:3-5 January, 2020\n" +
            "<br>Exhibition:3-5 January, 2020\n<br><br>";
    }
</script>

<script>
    function myFunction2() {
        document.getElementById("text_change").innerHTML = "<br>Q. Who can participate ?\n" +
            "  <br>Any individual with a valid ID card\n" +
            " <br>Early stage startups \n" +
            "     <br>Upto 3 years old college passouts can participate in the competition.\n" +
            "<br><br>Q. Is there any mentor panel?\n" +
            "<br>Yes, there will be a mentor panel who will help you to clear your doubts.\n <br>" +
            "<br>Q. How to register?<br>Follow this steps for registration :\n" +
            "www.techfest.org > Ideates > Civilisational Metamorphosis > Explore More -> Register > Fill all your details > You will be registered and now you must either Create a team/Join a team<br>" +
            "<br>Q. How many people can be there in one team?\n" +
            "<br>One team can have maximum of 4 members.<br>" +
            "<br>Q. What is the Registered Mail Id of a person?\n" +
            "<br>The Gmail Id which was used to Sign In is the Registered mail Id. It is an Unique Identity of any participant. " +
            "<br>And will be used in Adding Team members in a Team, Joining a Pre-existing team, availing accommodation, etc. <br>" +
            "<br>Q. Can anyone add members in a team?\n" +
            "<br>No, only the team leader has the right to add members in a team. But others can join an existing team by clicking on Join a Team button. <br>" +
            "<br>Q. Can we add ourselves in any existing team?\n" +
            "<br>Yes, follow these steps to get added in a team. Join a team -> Enter required details -> You will be added in that team<br>" +
            "<br>Q. How can I make my own team (as team leader)?\n" +
            "<br>You can choose any of the two ways to form your own team: \n" +
            "Follow this process:- www.techfest.org -> Competitions -> Civilisational Metamorphosis  -> Explore More -> Register -> Fill all your details -> Team -> Create a team -> Use the Registered Mail Id of other participants to add them in your team. They must be already registered before adding them in your Team. \n<br>" +
            "<br>Q. How can a team leader remove members from the team? <br>" +
            "Click on Remove Member button and then remove the member you want to remove. <br>" +
            "<br>Q. Is it nessecary for the team leader to add all the team members at once? <br>" +
            "No, it is not necessary. Team leader can add 3 members or less than 3, only once which is while creating the team but if the team is not full and he/she wants to add more members afterwards, then members (to be added) will have to use the Join Team button to join team <br>" +
            "<br>Q. How can a team member(other than team leader) leave his/her team? <br>"+
            "Click on Leave Team button and you will be removed from the registered team.<br>" +
            "<br>Q. Who can delete a team?<br>" +
            "Only team leader can delete the team using the Dissolve Team button.<br>" +
            "<br>Q. Can we change the team leader of our team?<br>" +
            "No, you can’t change team leader of your team. But, you can dissolve the team and form a new one.<br>" +
            "<br>Q. Can a team have members from different colleges?\n" +
            "<br>Yes, students from different colleges can form a team.<br>" +
            "<br>Q. How many stages does the competition have?\n" +
            "<br>Please go to the structure for this answer" +
            "<br><br>Q. Can I register in more than one competition?\n" +
            "<br>Yes, you can participate in more than one competition. However, it is recommended to focus on one competition as there may be some chances of slots clashing." +
            "<br>Participants can participate in multiple ideates but they can't present the same model/prototype/solution in more than one ideate. In such a case, they will be disqualified." +
            "<br><br>";
    }
</script>


<script>
    function myFunction3() {

        document.getElementById("text_change").innerHTML = "<br>GENERAL RULES\n" +
            "\n" +
            "<br><br>1. All projects being displayed will have a fair chance of receiving further   development opportunities offered by funding organizations and Venture capitalists.\n" +
            "<br>2. Every team has to register online on our website for the competition. A Team ID will be allocated to the team on registration which shall be used for future references.\n" +
            "<br>3. A team can register at any point of time before 2nd November 2019 and can submit final abstract and video (as mentioned in the structure).\n" +
            "<br>4. The decision of the organizers or judges shall be treated as final and binding on all. Techfest has all the rights to verify the identity and accuracy of the details provided by the participants.\n" +
            "<br>5. No responsibility will be held by Techfest, IIT Bombay for any late, lost or misdirected entries.\n" +
            "<br>6. The idea presented by the teams should be original (not protected by means of patent/copyright/technical publication by anyone).\n" +
            "<br>7. Note that at any point of time the latest information will be that which is on the website. However, registered participants will be informed through mail about any changes on the Website.\n" +
            "<br>8. All mode of official communication will be through the techfest e-mail.\n" +
            "\n" +
            "<br><br>EVALUATION\n" +
            "\n" +
            "<br><br>Civilisational Metamorphosis abstracts will be judged by a panel of experts. Following are the broad guidelines for judging:\n" +
            "<br>Creativity and Novelty: How novel is the idea? How different is it from the current solutions available? The innovation must be ingenious and novel in its area of application and should have a high potential for leaving an impact on the society.\n" +
            " <br>Originality: The innovation should not, by any means,  include copied or stolen work, such applications will be disqualified immediately.\n" +
            " <br>Performance\n" +
            " <br>Cost/Market Value and Acceptance\n" +
            " <br>Durability and Usability: Durability of the prototype/method proposed.\n" +
            " <br>Implementation ability: Is the solution implementable as described? Is it repeatable? Is the solution feasible for diverse and changing conditions?\n" +
            " <br>Scalability: Is the solution scalable to a higher level, how easy is it to scale up and what are the factors affecting it?\n" +
            " <br>Potential of Impact: How does it benefit society? The Scale of problem it solves, Intensity of the solution and number of people catered from the solution directly and indirectly.\n" +
            " <br>Design: Has the design been taken into consideration? How optimized is the product?\n" +
            " <br>Ergonomics If the team decides to make a well-designed product\n" +
            "<br>In case of any discrepancies, the decision of the Organizers or Judges will be final and binding on all.\n<br><br>";
    }
</script>

<script>
    function myFunction4() {
        document.getElementById("text_change").innerHTML = "<br> Preet Shah <br>+91 8080577349 <br> preets.techfest@gmail.com<br><br> ";
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

