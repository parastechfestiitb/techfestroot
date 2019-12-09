<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Boeing Aeromodelling Competition | Techfest, IIT Bombay</title>
    <meta property="og:image" content="https://www.techfest.org/2019/compi/images/boeing.jpg"/>

    <link rel="shortcut icon" type="image/x-icon" href="/2019/ca/images/favicon_logo.png" />

    <meta name="viewport" content="width=device-width, initial-scale=1">
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

    <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700" rel="stylesheet">

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
            background-color: #275E80;
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


                background-image: url(/2019/compi/images/boeing.jpg) ;
                box-shadow: 3px 3px 8px black;
                background-size: 100% 100%;
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

<style>
    .disable-link{
        cursor:not-allowed;
    }
</style>

{{--<img class="bg_1" src="/2019/compi/images/web_backgrounds_1.png"  alt="">--}}
<img class="mandala1" src="/2019/homepage/images/b_mandala.png" >

<div id="colorlib-page"  >
    <a href="#" class="js-colorlib-nav-toggle colorlib-nav-toggle"><i></i></a>
    <aside id="colorlib-aside" role="complementary" class="border js-fullheight" >
        <a href="/"><img src="/2019/homepage/logo_edit.png" alt="" style="width: 130%; margin-left:-15%"></a>
{{--        <a href="https://www.boeing.com"><img  src="/2019/compi/images/boeing_logo.png" alt="" style="width: 100%; padding-top: 10%;"></a>--}}

        <nav id="colorlib-main-menu" role="navigation" style="margin-top: 25vh; font-size: medium; ">
            <ul>
                <li ><a href="/competitions">Home</a></li>
{{--                <li ><a onclick="myFunction1()">Task</a></li>--}}
                <li ><a onclick="myFunction2()">FaQs</a></li>
                <li ><a onclick="myFunction3()">Rules</a></li>
                <li ><a onclick="myFunction5()">Abstract Submission</a></li>
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
                            <h2 style="color: white; font-weight: bold">Boeing Aeromodelling Competition</h2>
                            <hr style="color: white; border: 1px solid white">
                            <h3 style="color: white">Prize Money: INR 2,40,000/- </h3>

                            <p style=" font-size: 15px; width:90%; font-family: Lato;color: white ">
                                The competition requires the participants to design and fabricate a RC plane (ready made Planes are not allowed) and perform a set of maneuvers.
                                <br><br><strong>THERE IS NO REGISTRATION FEE</strong>
                            </p>

                            @if(!empty($user_row->email))
                                <?php
                                $team =  DB::table('tf_reg')->where(['boeing_team' => $user_row->boeing_team])->get();
                                $team_leader_row = DB::table('tf_reg')->where(['email' => $team[0]->boeing_team])->first();

                                if($user_row->boeing_team == $user_row->email ){
                                    $team_leader = $user_row->name;
                                }
                                ?>
                            @endif

                            <a href="/2019/compi/ps/Boeing Aeromodelling.pdf" target="_blank" class="btn btn-primary btn-learn">Problem Statement</a>

                            @if(!empty($user_row->email))
                                @if($user_row->boeing == 0 or empty($user_row->boeing))
                                    {{--                                        if he is not registered--}}
                                    <a href="/competitions/boeing/reg" class="btn btn-primary btn-learn" >Register</a>
                                @endif
                                @if($user_row->boeing == 1 && empty($user_row->boeing_team))
                                    <div class="dropdown ">
                                        <button class=" btn btn-primary btn-learn"><b>Team</b></button>
                                        <div class="dropdown-content">
                                            <a href="/competitions/boeing/createteam">Create Team</a>
                                            <a href="/competitions/boeing/jointeam">Join Team</a>
                                        </div>
                                    </div>
                                @endif

                                @if(!empty($user_row->boeing_team))
                                    @if($user_row->boeing_team != $user_row->email )
                                        <a href="/competitions/boeing/leaveteam" class="btn btn-primary btn-learn" >Leave current Team</a>
                                    @endif
                                    @if($user_row->boeing_team == $user_row->email )
                                        <a href="/competitions/boeing/dissolveteam" class="btn btn-primary btn-learn" >Dissolve the team</a>
                                        <div class="dropdown ">
                                            <button class=" btn btn-primary btn-learn">Remove a Member</button>
                                            <div class="dropdown-content">
                                                @if(!empty($team[0]->name) and ($team[0]->email != $team_leader_row->email))
                                                    <a href="/competitions/boeing/remove/{{$team[0]->id}}">{{$team[0]->name}}</a>
                                                @endif
                                                @if(!empty($team[1]->name)  and ($team[1]->email != $team_leader_row->email))
                                                    <a href="/competitions/boeing/remove/{{$team[1]->id}}">{{$team[1]->name}}</a>
                                                @endif
                                                @if(!empty($team[2]->name)  and ($team[2]->email != $team_leader_row->email))
                                                    <a href="/competitions/boeing/remove/{{$team[2]->id}}">{{$team[2]->name}}</a>
                                                @endif
                                                @if(!empty($team[3]->name) and ($team[3]->email != $team_leader_row->email))
                                                    <a href="/competitions/boeing/remove/{{$team[2]->id}}">{{$team[3]->name}}</a>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            @endif
                            @if(empty($user_row->email))
                                <button class="btn btn-primary btn-learn " >Registration closed</button>
                                <a href="/2019/compi/ps/How to register.pdf" style="color: white">Want to know how to register - Click here</a>

                            @endif
{{--                            <div id="snackbar">Sign in to register</div>--}}
                            @if(!empty($user_row))
                                @if($user_row->boeing > 0 && empty($user_row->boeing_team))
                                    <div class="alert alert-success">
                                        <p><strong>Hi {{$user_row->name}}, you are successfully registered for Boeing  with <b>{{$user_row->email}}</b> as your Registered email id , now you must create/join a team.</strong></p>
                                    </div>
                                @endif
                                @if($user_row->boeing > 0 && !empty($user_row->boeing_team))
                                    <div class="" style="    border: solid 2px white;border-radius: 6px;padding: 2%;width: 95%">
                                        <p style="color: white">
                                            Team Leader : {{$team_leader_row->name}}<br>
                                            Team ID :BA- {{$team_leader_row->boeing_team_id}}
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
            font-family: Lato">
            <p id="text_change" style="margin-bottom: 0px; color: white">
                </p>
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
        document.getElementById("text_change").innerHTML = "<br>Top 5 teams of from each Zonal Qualifier will qualify for Grand Finale to be held during Techfest 2019-20 (provided their score is more than a minimum cut-off score which will be decided later).<br>";
        // document.getElementById("text_change").innerHTML = "";
    }
</script>

<script>
    function myFunction1() {
        document.getElementById("text_change").innerHTML = "<br>The competition requires the participants to design and fabricate a RC plane (ready made Planes are not allowed) and perform a set of maneuvers.<br><br>";
    }
</script>

<script>
    function myFunction2() {
        document.getElementById("text_change").innerHTML = "" +
            "<br>Who can participate?" +
"<br>Anyone having a valid student ID card of their college or university is eligible to participate in this competition" +
"<br>" +
"<br>How to register?" +
"<br>Please follow this process:- www.techfest.org -> Competitions -> Boeing Aeromodelling -> Register" +
"<br>" +
"<br>How many persons can be there in one team?" +
"<br>One team can have a maximum of 4 members." +
"<br>" +
"<br>Can a team have a person from different colleges?" +
"<br>Yes." +
"<br>" +
"<br>What should I do if I want to change my team member?" +
"<br>The participants who wish to change their team member will have to register once again with the details about their new team member, the new team formed will be provided with a different team id." +
"<br>" +
"<br>How to register?" +
"<br>Visit www.techfest.org -> Competition -> Boeing Aeromodelling ->  Register" +
"<br>" +
"<br>Can I register in more than one competition?" +
"<br>Yes, you can participate in more than one competition. it is recommended to focus on one competition as there can be some chances of slot clash.<br><br>";
    }
</script>


<script>
    function myFunction3() {

        document.getElementById("text_change").innerHTML = " <br>" +
            "Rules" +
            "<br>1. Each team would be given two attempts in Qualifier round and two attempts in Payload Round. Best score from both attempts will be considered as a score for each round.\n" +
            "<br>2. The timer will start after 30 seconds of the previous team completing their attempt. The participants need to be prepared in time and launch without delay after entering the take-off zone.\n" +
            "<br>3. The teams would lose their turn if they are not ready in time.\n" +
            "<br>4. The same aircraft should be used in both the rounds and it should be the same one in the abstract. In case of damages during the competition, teams can repair the same aircraft but are not allowed to use a replacement. The repaired aircraft should be ready in time for the turn.\n" +
            "\n" +
            "<br><br>Revisions: <br>Any revisions to the Scope of the Competition would be intimated to all the participants via registered email and the same would be updated on the websites of the respective technical festivals.\n" +
            "<br>General Guidelines" +
            "<br>1. The use of 2.4 GHz radio is required for all aircraft competing in the competition. If the participants want to use any other frequency, they will have to inform the organizers in advance.\n" +
            "<br>2. A limited number of 2.4 GHz radios will be available with the organizers for use by the teams. Teams who do not have access to radios can inform the organizers in advance to request use of these radios.\n" +
            "<br>3. Receivers installed in the aircraft must be in 'receiver mode only'.\n" +
            "<br>4. All the systems (Servos, motor, etc.) will be checked by organizers for functionality before the\n" +
            "competition. If found not working, teams will be dismissed from the competition.\n" +
            "<br>5. A pilot can position himself at any point in the arena to fly the aircraft during the rounds\n" +
            "<br>6. In view of stringent safety requirements, if a pilot flies out of the designated flying zone which\n" +
            "includes the overhead of the event organizing and control section, as mentioned at the venue, he/ she is disqualified and must immediately turn back and land safely.\n" +
            "<br>7. Teams are suggested to carry additional components (motors, batteries, propellers etc.) as needed to avoid last-minute surprises at the venue. You will lose time/ attempt if you are not ready at the time of your turn.\n" +
            "<br>8. Please do not share any part of your aircraft (motors, ESC, Battery etc.) with other teams. Each\n" +
            "team is expected to carry all the equipment needed to participate in the competition.\n" +
            "<br>9. Metal propellers are not allowed\n" +
            "<br>10. The models can have powered take-off with landing gear or can be launched manually by a person standing at ground level\n" +
            "<br>11. A team member cannot be a part of more than one team.\n" +
            "<br> <br>Participation in multiple zonal events/finals:\n" +
            "<br>1. Teams can participate in more than one zonal event if they are not qualified for the finals already\n" +
            "<br>2. Teams that claimed a reimbursement in one zonal event cannot claim the same in any other zonal\n" +
            "event.\n" +
            "<br>3. The same team that participated in the zonal should participate in the final. No member can be replaced by another.\n" +
            "<br><br> ";
    }
</script>
<script>
    function myFunction5() {
        document.getElementById("text_change").innerHTML = "<br>Abstract Submission:" +
"<br><br>1. All the participants need to submit an abstract to boeing@techfest.org on their aircraft, with standard formatting given in point 4. The Abstract must document the basic design of the aircraft (dimensions, wing areas, velocity, etc.) and should also explain how their design is suitable for given problem." +
"<br><br>2. Along with the abstract, Participants also have to send a zip file containing at-least 5 and no more than 10 photographs of the aircraft while it is being built." +
"<br><br>3. The Abstract and the zip file has to be submitted by 5th December 2019 containing the photographs for teams participating in IIT-Bombay Zonal round have to be sent by email to boeing@techfest.org with the team details clearly mentioned in the email. The Team ID should be explicitly mentioned in the email subject as well as the filename for both Abstract and zip file." +
"<br><br>4. Link for Abstract Format- <a style='color: white' href='https://drive.google.com/file/d/1DpuDhjjnotDaha42BG_q-X3u_GdFxm46/view'> <u>BoeingAbstract</u></a> <br><br> ";
    }
</script>
<script>
    function myFunction4() {
        document.getElementById("text_change").innerHTML = "<br>Vineet Bhat | +91 9769801936 | vineet.techfest@gmail.com <br>Deepanshu Mathankar | +91 9967221353 | deepanshu.techfest@gmail.com <br><br> ";
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
{{--                                <li>Q. Why should I participate in boeing?</li>--}}
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

