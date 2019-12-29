<?php
$admin = DB::table('admins')->where(['email' => session()->get('user')->email])->first();// row ko array bana ke return ki;
?>
<header class="header-mobile d-block d-lg-none">
    <div class="header-mobile__bar">
        <div class="container-fluid">
            <div class="header-mobile-inner">
                <a href="#">
                    <img src="/2019/ca/images/favicon_logo.png" alt="Techfest Admin" style="max-height: 7vh"/>
                </a>
                <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                </button>
            </div>
        </div>
    </div>
    <nav class="navbar-mobile">
        <div class="container-fluid">
            <ul class="navbar-mobile__list list-unstyled">
{{--                <li class="has-sub">--}}
{{--                    <a class="js-arrow" href="#">--}}
{{--                        <i class="fas fa-tachometer-alt"></i>Select Zonal</a>--}}
{{--                    <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">--}}
{{--                        <li><a href="/admindashboard/Mumbai/cozmo">Mumbai</a></li>--}}
{{--                        <li><a href="/admindashboard/Lucknow/cozmo">Lucknow</a></li>--}}
{{--                        <li><a href="/admindashboard/Jaipur/cozmo">Jaipur</a></li>--}}
{{--                        <li><a href="/admindashboard/Kolkata/cozmo">Kolkata</a></li>--}}
{{--                        <li><a href="/admindashboard/Bhopal/cozmo">Bhopal</a></li>--}}
{{--                        <li><a href="/admindashboard/Banglore/cozmo">Banglore</a></li>--}}
{{--                    </ul>--}}
{{--                </li>--}}
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-tachometer-alt"></i>Competitions</a>
                    <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                        <li><a href="/admindashboard-total">Toatal Reg</a></li>
                        <li><a href="/admindashboard/cozmo">Cozmo</a></li>
                        <li><a href="/admindashboard/meshmerize">meshmerize</a></li>
                        <li><a href="/admindashboard/codecode">codecode</a></li>
                        <li><a href="/admindashboard/tso">tso</a></li>
                        <li><a href="/admindashboard/earthmatters">earth matters</a></li>
                        <li><a href="/admindashboard/metamorphosis">civilimeta</a></li>
                        <li><a href="/admindashboard/innovationeering">innovationeering</a></li>
                        <li><a href="/admindashboard/micromouse">micromouse</a></li>
                        <li><a href="/admindashboard/indiachallenge">JLT India Challenge</a></li>
                        <li><a href="/admindashboard/rowboatics">Rowboatics</a></li>
                        <li><a href="/admindashboard/oprahat">OP Rahat</a></li>
                        <li><a href="/admindashboard/bugbounty">bugbounty</a></li>
                        <li><a href="/admindashboard/fintech">fintech</a></li>
                        <li><a href="/admindashboard/wpc">wpc</a></li>
                        <li><a href="/admindashboard/boeing">Boeing</a></li>
                        <li><a href="/admindashboard/gopynq">gopynq</a></li>
                        <li><a href="/admindashboard/craneomania">cranomania</a></li>
                        <li><a href="/admindashboard/dronechallenge">dronechallenge</a></li>
                        <li><a href="/admindashboard/inspire">inspire</a></li>
                        <li><a href="/admindashboard/makerthon">makerthon</a></li>
                        <li><a href="/admindashboard/codebuzz">codebuzz</a></li>

                    </ul>
                </li>
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-tachometer-alt"></i>CA Dashboard</a>
                    <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                        <li><a href="http://techfest.org/admins">CA Data</a></li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a class="" href="/admindashboard_robowars"><i class="fas fa-tachometer-alt"></i>Robowars</a>

                </li>
                <li class="has-sub">
                    <a class="" href="/admindashboard_ift"><i class="fas fa-tachometer-alt"></i>IFT</a>
                </li>
                <li class="has-sub">
                    <a class="" href="/admindashboard_ic"><i class="fas fa-tachometer-alt"></i>IC</a>
                </li>
                <li class="has-sub">
                    <a class="" href="/admindashboard_exhibitions"><i class="fas fa-tachometer-alt"></i>Exhibitions</a>
                </li>
                <li class="has-sub">
                    <a class="" href="/admindashboard_subscribe"><i class="fas fa-tachometer-alt"></i>Subscribe</a>
                </li>

            </ul>
        </div>
    </nav>
</header>
<aside class="menu-sidebar d-none d-lg-block">
    <div class="logo">
        <a href="#">
            <img src="/2019/ca/images/favicon_logo.png" alt="Techfest Admin" style="max-height: 7vh"/>
        </a>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list">
{{--                <li class="active has-sub">--}}
{{--                    <a class="js-arrow" href="#"><i class="fas fa-tachometer-alt"></i>Select Zonal</a>--}}
{{--                    <ul class="list-unstyled navbar__sub-list js-sub-list">--}}
{{--                        <li><a href="/admindashboard/Mumbai/cozmo">Mumbai</a></li>--}}
{{--                        <li><a href="/admindashboard/Lucknow/cozmo">Lucknow</a></li>--}}
{{--                        <li><a href="/admindashboard/Jaipur/cozmo">Jaipur</a></li>--}}
{{--                        <li><a href="/admindashboard/Kolkata/cozmo">Kolkata</a></li>--}}
{{--                        <li><a href="/admindashboard/Bhopal/cozmo">Bhopal</a></li>--}}
{{--                        <li><a href="/admindashboard/Banglore/cozmo">Banglore</a></li>--}}
{{--                    </ul>--}}
{{--                </li>--}}
                <li class="active has-sub">
                    <a class="js-arrow" href="#"><i class="fas fa-tachometer-alt"></i>Competitions</a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li><a href="/admindashboard-total">Toatal Reg</a></li>
                        <li><a href="/admindashboard/cozmo">Cozmo</a></li>
                        <li><a href="/admindashboard/wcozmo">Cozmo(wild card)</a></li>
                        <li><a href="/admindashboard/meshmerize">meshmerize</a></li>
                        <li><a href="/admindashboard/wmeshmerize">meshmerize(wild card)</a></li>
                        <li><a href="/admindashboard/codecode">codecode</a></li>
                        <li><a href="/admindashboard/wcodecode">codecode(wild card)</a></li>
                        <li><a href="/admindashboard/tso">tso</a></li>
                        <li><a href="/admindashboard/earthmatters">earth matters</a></li>
                        <li><a href="/admindashboard/metamorphosis">civilimeta</a></li>
                        <li><a href="/admindashboard/innovationeering">innovationeering</a></li>
                        <li><a href="/admindashboard/micromouse">micromouse</a></li>
                        <li><a href="/admindashboard/indiachallenge">JLT India Challenge</a></li>
                        <li><a href="/admindashboard/rowboatics">Rowboatics</a></li>
                        <li><a href="/admindashboard/oprahat">OP Rahat</a></li>
                        <li><a href="/admindashboard/bugbounty">bugbounty</a></li>
                        <li><a href="/admindashboard/fintech">fintech</a></li>
                        <li><a href="/admindashboard/wpc">wpc</a></li>
                        <li><a href="/admindashboard/boeing">Boeing</a></li>
                        <li><a href="/admindashboard/gopynq">gopynq</a></li>
                        <li><a href="/admindashboard/craneomania">cranomania</a></li>
                        <li><a href="/admindashboard/dronechallenge">dronechallenge</a></li>
                        <li><a href="/admindashboard/inspire">inspire</a></li>
                        <li><a href="/admindashboard/makerthon">makerthon</a></li>
                        <li><a href="/admindashboard/transportation">transportation</a></li>
                        <li><a href="/admindashboard/codebuzz">codebuzz</a></li>

                    </ul>
                </li>

                <li class="active has-sub">
                    <a class="js-arrow" href="#"><i class="fas fa-tachometer-alt"></i>CA Dashboard</a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li><a href="http://techfest.org/admins">CA Data</a></li>
                        {{--                            <li><a href="https://techfest.org/adminca">CA Events</a></li>--}}
                    </ul>
                </li>
                <li class="active has-sub">
                    <a class="js-arrow" href="#"><i class="fas fa-tachometer-alt"></i>Certificate</a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li><a href="/admindashboard_certificate">Eligible Participant</a></li>
                        <li><a href="/admindashboard_certificate/insert">Insert Participant</a></li>
                    </ul>
                </li>
                <li class="active has-sub" >
                    <a class="" href="/admindashboard_robowars"><i class="fas fa-tachometer-alt"></i>Robowars</a>
                </li>
                <li class="active has-sub">
                    <a class="" href="/admindashboard_ift"><i class="fas fa-tachometer-alt"></i>IFT</a>
                </li>
                <li class="has-sub">
                    <a class="" href="/admindashboard_ic"><i class="fas fa-tachometer-alt"></i>IC</a>
                </li>
                <li class="active has-sub">
                    <a class="" href="/admindashboard_summit"><i class="fas fa-tachometer-alt"></i>Summit</a>
                </li>
                <li class="active has-sub">
                    <a class="" href="/admindashboard_exhibitions"><i class="fas fa-tachometer-alt"></i>Exhibitions</a>
                </li>
                <li class="active has-sub">
                    <a class="" href="/admindashboard_subscribe"><i class="fas fa-tachometer-alt"></i>Subscribe</a>
                </li>

{{--                @if( $admin->access_workshops == "1")--}}
                    <li class="active has-sub">
                        <a class="js-arrow" href="#"><i class="fas fa-tachometer-alt"></i>Workshops</a>
                        <ul class="list-unstyled navbar__sub-list js-sub-list">
                            <li><a href="/admindashboard_workshops/Automobile">Automobile</a></li>
                            <li><a href="/admindashboard_workshops/EthicalHacking">EthicalHacking</a></li>
                            <li><a href="/admindashboard_workshops/Solarizer">Solarizer</a></li>
                            <li><a href="/admindashboard_workshops/6thSenseRobotics">6thSenseRobotics</a></li>
                            <li><a href="/admindashboard_workshops/GestureRobotics">GestureRobotics</a></li>
                            <li><a href="/admindashboard_workshops/NanoTechnology">NanoTechnology</a></li>
                            <li><a href="/admindashboard_workshops/UnderwaterRobotics">UnderwaterRobotics</a></li>
                            <li><a href="/admindashboard_workshops/ZeroEnergyBuilding">ZeroEnergyBuilding</a></li>
                            <li><a href="/admindashboard_workshops/AndroidDevelopment">AndroidDevelopment</a></li>
                            <li><a href="/admindashboard_workshops/GoogleCloudPlatform ">GoogleCloudPlatform</a></li>
                            <li><a href="/admindashboard_workshops/MachineLearning ">MachineLearning</a></li>
                            <li><a href="/admindashboard_workshops/Internetofthings ">Internetofthings</a></li>
                            <li><a href="/admindashboard_workshops/ArtificialIntelligence  ">ArtificialIntelligence</a></li>
                            <li><a href="/admindashboard_workshops/EmbeddedSystems  ">EmbeddedSystems</a></li>
                            <li><a href="/admindashboard_workshops/DataAnalytics  ">DataAnalytics</a></li>
                            <li><a href="/admindashboard_workshops/DigitalMarketing">DigitalMarketing</a></li>
                            <li><a href="/admindashboard_workshops/Quadcopter  ">Quadcopter</a></li>
                            <li><a href="/admindashboard_workshops/AlexaEverywhere  ">AlexaEverywhere</a></li>
                            <li><a href="/admindashboard_workshops/Cybersecurity  ">Cybersecurity</a></li>
                            <li><a href="/admindashboard_workshops/WaterPositiveBuildings  ">WaterPositiveBuildings</a></li>
                            <li><a href="/admindashboard_workshops/UltrasonicTesting  ">UltrasonicTesting</a></li>
                            <li><a href="/admindashboard_workshops/MachineLearning2  ">MachineLearning2</a></li>
                            <li><a href="/admindashboard_workshops/WirelessRobotics  ">WirelessRobotics</a></li>
                            <li><a href="/admindashboard_workshops/Blockchain  ">Blockchain</a></li>
                            <li><a href="/admindashboard_workshops/CapgeminiArtificialIntelligence  ">CapgeminiArtificialIntelligence</a></li>
                        </ul>
                    </li>

{{--                @endif--}}
{{--                @if( $admin->access_mun == "1")--}}
                    <li class="active has-sub">
                        <a class="" href="/admindashboard_payment_mun"><i class="fas fa-tachometer-alt"></i>Mun Payments</a>
                    </li>
                <li class="active has-sub">
                        <a class="" href="/admindashboard_technoholix"><i class="fas fa-tachometer-alt"></i>Techx</a>
                    </li>
                <li class="active has-sub">
                        <a class="" href="/admindashboard_aiflt"><i class="fas fa-tachometer-alt"></i>AIFLT</a>
                    </li>
{{--                @endif--}}
            </ul>
        </nav>
    </div>
</aside>
