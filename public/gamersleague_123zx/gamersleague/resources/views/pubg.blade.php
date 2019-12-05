<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>PUBG | Gamersleague | Techfest IIT Bombay</title>
    @include('layouts.meta')
    <link rel="icon" type="image/png" href="http://techfest.org/gamersleague/images/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300i,400,700%7cMarcellus+SC" rel="stylesheet">
    <link rel="stylesheet" href="http://techfest.org/gamersleague/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://techfest.org/gamersleague/bower_components/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://techfest.org/gamersleague/bower_components/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" type="text/css" href="http://techfest.org/gamersleague/plugins/revolution/css/settings.css">
    <link rel="stylesheet" type="text/css" href="http://techfest.org/gamersleague/plugins/revolution/css/layers.css">
    <link rel="stylesheet" type="text/css" href="http://techfest.org/gamersleague/plugins/revolution/css/navigation.css">
    <link rel="stylesheet" href="http://techfest.org/gamersleague/bower_components/flickity/dist/flickity.min.css">
    <link rel="stylesheet" type="text/css" href="http://techfest.org/gamersleague/bower_components/photoswipe/dist/photoswipe.css">
    <link rel="stylesheet" type="text/css" href="http://techfest.org/gamersleague/bower_components/photoswipe/dist/default-skin/default-skin.css">
    <link rel="stylesheet" type="text/css" href="http://techfest.org/gamersleague/bower_components/datetimepicker/build/jquery.datetimepicker.min.css">
    <link rel="stylesheet" type="text/css" href="http://techfest.org/gamersleague/plugins/revolution/css/settings.css">
    <link rel="stylesheet" type="text/css" href="http://techfest.org/gamersleague/plugins/revolution/css/layers.css">
    <link rel="stylesheet" type="text/css" href="http://techfest.org/gamersleague/plugins/revolution/css/navigation.css">
    <link rel="stylesheet" type="text/css" href="http://techfest.org/gamersleague/bower_components/prism/themes/prism-tomorrow.css">
    <link rel="stylesheet" type="text/css" href="http://techfest.org/gamersleague/bower_components/summernote/dist/summernote.css">
    <link rel="stylesheet" href="http://techfest.org/gamersleague/css/godlike.css">
    <link rel="stylesheet" href="http://techfest.org/gamersleague/css/custom.css">
    <script src="http://techfest.org/gamersleague/bower_components/jquery/dist/jquery.min.js"></script>
    <style>
        .text-center{
            text-align: center !important;
        }
        .tgroup{
            table-layout: fixed;
        }
        .tgroup td{
            width:14.5%;
        }
        .max-600{
            max-width: 600px;
            margin:auto;
        }
        .text-right{
            text-align: right;
        }
        label,.w-100{
            width: 100%;
        }
        .pointer{
            cursor: pointer;
        }
        .float-right{
            float: right;
            font-weight: lighter;
        }
    </style>
</head>
<body>
@include('layouts.preloader')
<div class="nk-page-background op-5" data-bg-mp4="http://techfest.org/gamersleague/video/bg-2.mp4" data-bg-webm="http://techfest.org/gamersleague/video/bg-2.webm" data-bg-ogv="http://techfest.org/gamersleague/video/bg-2.ogv" data-bg-poster="http://techfest.org/gamersleague/video/bg-2.jpg"></div>
<div class="nk-page-border">
    <div class="nk-page-border-t"></div>
    <div class="nk-page-border-r"></div>
    <div class="nk-page-border-b"></div>
    <div class="nk-page-border-l"></div>
</div>
@include('header2')
<div class="nk-main">
    <div class="container">
        <div class="nk-gap-4"></div>
        <div class="nk-store-product">
            <div class="row xl-gap equal-height vertical-gap">
                <div class="col-md-5">
                    <div class="nk-vertical-center">
                        <div>
                            <div class="nk-carousel-3" data-size="1">
                                <div class="nk-carousel-inner nk-popup-gallery">
                                    <div>
                                        <div>
                                            <a href="http://techfest.org/gamersleague/images/pubg.png" class="nk-gallery-item" data-size="780x990">
                                                <img src="http://techfest.org/gamersleague/images/pubg.png" alt="">
                                            </a>
                                        </div>
                                    </div>
                                    <div>
                                        <div>
                                            <a href="http://techfest.org/gamersleague/images/pubg.png" class="nk-gallery-item" data-size="780x990" style="background:black">
                                                <img src="http://techfest.org/gamersleague/images/pubg.png" alt="">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="nk-vertical-center">
                        <div>
                            <h2 class="nk-product-title">PUBG Mobile : PlayerUnknown's Battlegrounds Mobile</h2>
                            <div class="nk-product-description">
                                <p>
                                    The event consists of both online qualifiers followed by finals at Techfest, IIT Bombay. All Teams will play knockout matches online and top 4 teams from each room will progress to further rounds. Top 16 teams will then be invited for the final Playoffs at Techfest, IIT Bombay during 3rd-5th January 2020.

                                </p>

                            </div>
                            {{--                            @if(!session()->has('steamid'))--}}
                            {{--                                <form action="{{route('redirector')}}" class="nk-form nk-product-addtocart">--}}
                            {{--                                    <input type="hidden" name="link" value="{{url()->current()}}">--}}
                            {{--                                    <button class="nk-btn nk-btn-x2" data-toggle="modal" data-target=".manage-team">Register</button>--}}
                            {{--                                    <span class="nk-product-price">INR 2,00,000</span>--}}
                            {{--                                </form>--}}
                            {{--                            @elseif($player!==null && $pubg!==null)--}}

                            {{--                                <form action="#" class="nk-form nk-product-addtocart">--}}
                            {{--                                    <a href="https://www.sostronk.com/welcome">--}}
                            {{--                                        <button class="nk-btn nk-btn-x2" data-toggle="modal" data-target=".manage-team">Thanks for registering, Manage your team at SoStronk </button>--}}
                            {{--                                    </a>--}}
                            {{--                                    <span class="nk-product-price">INR 2,00,000</span>--}}
                            {{--                                </form>--}}

                            {{--                                <div class="modal nk-modal fade manage-team" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" style="display: none;" aria-hidden="true">--}}
                            {{--                                    <div class="modal-dialog modal-lg">--}}
                            {{--                                        <div class="modal-content">--}}
                            {{--                                            <div class="modal-header">--}}
                            {{--                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
                            {{--                                                    <span class="ion-android-close"></span>--}}
                            {{--                                                </button>--}}
                            {{--                                                <h4 class="modal-title nk-title display-4" id="myLargeModalLabel">Manage Team 2</h4>--}}
                            {{--                                            </div>--}}
                            {{--                                            <div class="modal-body">--}}
                            {{--                                                @if($pubg->leader===$player->steamid)--}}
                            {{--                                                    <h4>Copy &amp; Share this link with players you want to add to your team</h4>--}}
                            {{--                                                    <input type="text" id="team" class="form-control required text-warning" value="http://techfest.org/gamersleague/joinpubg/{{$pubg->id}}/{{md5($pubg->image.$key)}}" readonly>--}}
                            {{--                                                @endif--}}
                            {{--                                                <div class="nk-gap"></div>--}}
                            {{--                                                <div class="bg-dark-1">--}}
                            {{--                                                    <h3 class="nk-title h4 text-xs-center">{{$pubg->name}}</h3>--}}
                            {{--                                                    <img src="http://techfest.org/gamersleague{{Storage::url( $pubg->image ) }}" class="nk-img" alt="">--}}
                            {{--                                                    <div class="nk-gap"></div>--}}
                            {{--                                                    <h4>Team Members:</h4>--}}
                            {{--                                                    <table style="width: 100%;text-align: center;">--}}
                            {{--                                                        @if($pubg->leader===$player->steamid)--}}
                            {{--                                                            <tr>--}}
                            {{--                                                                @foreach($team as $member)--}}
                            {{--                                                                    <td>--}}
                            {{--                                                                        <img src="{{$member->avatarfull}}" class="nk-img-fit" alt="">--}}
                            {{--                                                                        <br>--}}
                            {{--                                                                        <span>{{$member->personaname}}</span>--}}
                            {{--                                                                        <br>--}}
                            {{--                                                                        @if($pubg->leader!==$member->steamid)<span class="text-warning pointer" onclick="window.location.href='http://techfest.org/gamersleague/removepubg/{{$member->steamid}}'">Remove</span>@endif--}}
                            {{--                                                                    </td>--}}
                            {{--                                                                @endforeach--}}
                            {{--                                                            </tr>--}}
                            {{--                                                        @else--}}
                            {{--                                                            <tr>--}}
                            {{--                                                                @foreach($team as $member)--}}
                            {{--                                                                    <td>--}}
                            {{--                                                                        <img src="{{$member->avatarfull}}" class="nk-img-fit" alt="">--}}
                            {{--                                                                        <br>--}}
                            {{--                                                                        <span>{{$member->personaname}}</span>--}}
                            {{--                                                                    </td>--}}
                            {{--                                                                @endforeach--}}
                            {{--                                                            </tr>--}}
                            {{--                                                        @endif--}}
                            {{--                                                    </table>--}}
                            {{--                                                    @if($pubg->leader === $player->steamid)--}}
                            {{--                                                        <a class="float-right text-danger" href="http://techfest.org/gamersleague/removepubg/{{$player->steamid}}">Delete Team</a>--}}
                            {{--                                                    @else--}}
                            {{--                                                        <a href="http://techfest.org/gamersleague/removepubg/{{$player->steamid}}" class="float-right text-danger">Leave Team</a>--}}
                            {{--                                                    @endif--}}
                            {{--                                                </div>--}}
                            {{--                                                <div class="nk-gap"></div>--}}
                            {{--                                            </div>--}}
                            {{--                                        </div>--}}
                            {{--                                    </div>--}}
                            {{--                                </div>--}}
                            {{--                            @else--}}
                            <form action="#" class="nk-form nk-product-addtocart">
                                <button class="nk-btn nk-btn-x2" data-toggle="modal" data-target=".bd-example-modal-lg">Create Team</button>
                                {{--                                    <button class="nk-btn nk-btn-x2" data-toggle="modal" data-target=".join-modal-lg">Join Team</button>--}}
                                <span class="nk-product-price">
                                        INR 2,00,000
                                    </span>
                            </form>
                            <div class="modal nk-modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" style="display: none;" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span class="ion-android-close"></span>
                                            </button>
                                            <h4 class="modal-title nk-title" id="myLargeModalLabel">Register for PUBG</h4>
                                        </div>
                                        <div class="modal-body">
                                            <h3>Make a new team:</h3>
                                            <form action="{!! route('registerPUBG') !!}" method="POST" id="formUpload" enctype="multipart/form-data">
                                                @csrf
                                                <p class="text-white-50">Team Leader Details</p>
                                                <input type="text" id="team" class="form-control required" name="team_leader_name" placeholder="Team Leader Name">
                                                <div class="nk-gap"></div>
                                                <input type="text" id="tl" class="form-control " name="nickname" placeholder="Nickname">
                                                <div class="nk-gap"></div>
                                                <input type="text" id="tl" class="form-control " name="p1_id" placeholder="Player 1 Character ID">
                                                <div class="nk-gap"></div>
                                                <input type="text" id="tl" class="form-control required" name="team_leader_number" placeholder="Phone number">
                                                <div class="nk-gap"></div>
                                                <input type="email" id="tl" class="form-control required" name="team_leader_email" placeholder="Email address">
                                                <div class="nk-gap"></div>
                                                <p class="text-white-50">Team Crew Details</p>
                                                <input type="text" id="tl" class="form-control required" name="crew_name" placeholder="Crew name">
                                                <div class="nk-gap"></div>
                                                <input type="text" id="tl" class="form-control required" name="p2_id" placeholder="Player 2 Character ID">
                                                <div class="nk-gap"></div>
                                                <input type="text" id="tl" class="form-control required" name="p2_number" placeholder="Player 2 Phone number">
                                                <div class="nk-gap"></div>
                                                <input type="text" id="tl" class="form-control required" name="p3_id" placeholder="Player 3 Character ID">
                                                <div class="nk-gap"></div>
                                                <input type="text" id="tl" class="form-control required" name="p3_number" placeholder="Player 3 Phone number">
                                                <div class="nk-gap"></div>
                                                <input type="text" id="tl" class="form-control required" name="p4_id" placeholder="Player 4 Character ID">
                                                <div class="nk-gap"></div>
                                                <input type="text" id="tl" class="form-control required" name="p4_number" placeholder="Player 4 Phone number">
                                                <div class="nk-gap"></div>
                                                <div class="col-sm-6 text-right">
                                                    <label>
                                                        <button class="nk-btn nk-btn-x2 w-100" id="submitBtn">Submit</button>
                                                    </label>
                                                </div>
                                            </form>
                                            <div class="nk-gap"></div>
                                            <div class="nk-gap"></div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal nk-modal fade join-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span class="ion-android-close"></span>
                                        </button>
                                        <h4 class="modal-title nk-title" id="myLargeModalLabel">Join an already existing team</h4>
                                    </div>
                                    <div class="modal-body">
                                        <h3>Ask your team leader to create a team and share the invitation link with you!</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--                            @endif--}}
                        <br>
                    </div>
                </div>
            </div>
        </div>
        <div class="nk-gap-3"></div>
        <div class="nk-tabs">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" href="#tab-details" role="tab" data-toggle="tab">Details</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#tab-format" role="tab" data-toggle="tab">Format</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#tab-rules" role="tab" data-toggle="tab">Rules</a>
                </li>
                {{--                    <li class="nav-item">--}}
                {{--                        <a class="nav-link" href="#tab-teams" role="tab" data-toggle="tab">Teams <small>({{count($teams)}})</small></a>--}}
                {{--                    </li>--}}
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active" id="tab-details">
                    <div class="nk-gap-3"></div>
                    <div class="nk-box-3 bg-dark-1">
                        <div class="row">
                            <div class="col-md-6">
                                <h1>Timeline</h1>
                                <ul>
                                    <li>Registrations Close: 14th December 2019</li>
                                    <li>Brackets and Schedule release: 16th December 2019</li>
                                    <li>Online Qualifiers Starts: 17th December 2019</li>
                                    <li>LAN Playoffs: 3rd-5th January</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <h1>Important Details</h1>
                                <ul>
                                    <li>Prizes Worth for PUBG: INR 2 Lakhs</li>
                                    <li>Top 16 Teams to invited at Techfest, IIT Bombay for finals</li>
                                    <li>Finals will Bo10</li>
                                    <li>Eligibility: Open for all</li>
                                    <li>Kindly read and follow all rules of the tournament</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade in" id="tab-format">
                    <div class="nk-gap-3"></div>
                    <div class="nk-box-3 bg-dark-1">
                        <div class="row">
                            <div class="col-md-6">
                                <ul>
                                    <li>Maps: Standard Valve Active Duty Maps</li>
                                    <li>Gameplay: Standard Competitive Gameplay</li>
                                    <li>Format: Semi-Finals and Finals will be Bo3, rest Bo1</li>
                                    <li>Venue: Indian Institute of Technology, Bombay- 400076</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade in" id="tab-rules">
                    <div class="nk-gap-3"></div>
                    <div class="nk-box-3 bg-dark-1">
                        <ul>
                            <li>General Game Specific Rules for Counter-Strike: Global Offensive should be followed</li>
                            <li>Major penalties are given for major incidents such as deliberately deceiving admins, failing to show up formatches, repeated rule breaking, and any activities will violate the General Code of Conduct</li>
                            <li>All broadcasting rights of the Tournament are owned by the tournament organizers</li>
                            <li>All matches in the Tournament should start as stated on the website, no changes to the time can be requested. All Teams and Players in a match should be on the server or in the game lobby and ready to go at the latest 15 minutes before the match is to start</li>
                            <li>When cheating is uncovered, The Team will be disqualified from the current Tournament. The use of the following programs will result in a cheat ban: Multihacks, Wallhack, Aimbot, Coloured Models, NoRecoil, No-Flash and Sound changes. These are only examples, other programs or methods may be considered cheats as well like- using different players account.</li>
                            <li>To make any changes in the team roster, Team leader needs to send a mail at prateek@techfest.org for the same before the registrations are closed</li>
                            <li>Just in case any team is unable to make it to the lan final venue. The next best contender will replace that team</li>
                            <li>In case of any dispute, Organizers decision will be final and binding for all</li>
                            <li>For any queries or reporting of any incidents in-game, kindly drop a mail at prateek@techfest.org</li>
                        </ul>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab-teams">
                    <div class="nk-gap-3"></div>
                    <div class="row vertical-gap lg-gap equal-height">
                        @foreach($teams as $t)
                            <div class="col-md-6">
                                <div class="nk-box-3 bg-dark-1">
                                    <h3 class="nk-title h4 text-center">{{$t->name}}</h3>
                                    <div class="nk-gap"></div>
                                    <div class="img-container" style="text-align:center">
                                        <img src="http://techfest.org/gamersleague{{Storage::url( $t->image ) }}" class="nk-img" alt="" style="margin:auto;height:300px;width: 300px;object-fit:cover;">
                                    </div>
                                    <div class="nk-gap"></div>
                                    <h4 class="text-center">Team Members:</h4>
                                    <table class="tgroup">
                                        <tr>
                                            @for($x = 0; $x<count($t->players);$x+=1)
                                                <td><a href="{{$t->players[$x]->profileurl}}" target="_blank"><img src="{{$t->players[$x]->avatarfull}}" class="nk-img-fit" alt="{{$t->players[$x]->personaname}}"></a></td>
                                            @endfor
                                            @for($x=0;$x<5-count($t->players);$x+=1)
                                                <td></td>
                                            @endfor
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Tabs -->
    </div>
</div>
<div class="nk-gap-4"></div>
@include('layouts.footer')
</div>
@include('layouts.socials')
@include('layouts.floater')
<!-- GSAP -->
<script src="http://techfest.org/gamersleague/bower_components/gsap/src/minified/TweenMax.min.js"></script>
<script src="http://techfest.org/gamersleague/bower_components/gsap/src/minified/plugins/ScrollToPlugin.min.js"></script>

<!-- Bootstrap -->
<script src="http://techfest.org/gamersleague/bower_components/tether/dist/js/tether.min.js"></script>
<script src="http://techfest.org/gamersleague/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Sticky Kit -->
<script src="http://techfest.org/gamersleague/bower_components/sticky-kit/dist/sticky-kit.min.js"></script>

<!-- Jarallax -->
<script src="http://techfest.org/gamersleague/bower_components/jarallax/dist/jarallax.min.js"></script>
<script src="http://techfest.org/gamersleague/bower_components/jarallax/dist/jarallax-video.min.js"></script>

<!-- Flickity -->
<script src="http://techfest.org/gamersleague/bower_components/flickity/dist/flickity.pkgd.min.js"></script>

<!-- Isotope -->
<script src="http://techfest.org/gamersleague/bower_components/isotope/dist/isotope.pkgd.min.js"></script>

<!-- Photoswipe -->
<script src="http://techfest.org/gamersleague/bower_components/photoswipe/dist/photoswipe.min.js"></script>
<script src="http://techfest.org/gamersleague/bower_components/photoswipe/dist/photoswipe-ui-default.min.js"></script>

<!-- Typed.js -->
<script src="http://techfest.org/gamersleague/bower_components/typed.js/dist/typed.min.js"></script>

<!-- Jquery Form -->
<script src="http://techfest.org/gamersleague/bower_components/jquery-form/jquery.form.js"></script>

<!-- Jquery Validation -->
<script src="http://techfest.org/gamersleague/bower_components/jquery-validation/dist/jquery.validate.min.js"></script>

<!-- Jquery Countdown + Moment -->
<script src="http://techfest.org/gamersleague/bower_components/jquery.countdown/dist/jquery.countdown.min.js"></script>
<script src="http://techfest.org/gamersleague/bower_components/moment/min/moment.min.js"></script>
<script src="http://techfest.org/gamersleague/bower_components/moment-timezone/builds/moment-timezone-with-data.js"></script>

<!-- Hammer.js -->
<script src="http://techfest.org/gamersleague/bower_components/hammer.js/hammer.min.js"></script>

<!-- nK Share -->
<script src="http://techfest.org/gamersleague/plugins/nk-share/nk-share.js"></script>

<!-- NanoSroller -->
<script src="http://techfest.org/gamersleague/bower_components/nanoscroller/bin/javascripts/jquery.nanoscroller.min.js"></script>

<!-- SoundManager2 -->
<script src="http://techfest.org/gamersleague/bower_components/SoundManager2/script/soundmanager2-nodebug-jsmin.js"></script>

<!-- DateTimePicker -->
<script src="http://techfest.org/gamersleague/bower_components/datetimepicker/build/jquery.datetimepicker.full.min.js"></script>
<script type="text/javascript" src="http://techfest.org/gamersleague/plugins/revolution/js/jquery.themepunch.tools.min.js"></script>
<script type="text/javascript" src="http://techfest.org/gamersleague/plugins/revolution/js/jquery.themepunch.revolution.min.js"></script>
<script type="text/javascript" src="http://techfest.org/gamersleague/plugins/revolution/js/extensions/revolution.extension.video.min.js"></script>
<script type="text/javascript" src="http://techfest.org/gamersleague/plugins/revolution/js/extensions/revolution.extension.carousel.min.js"></script>
<script type="text/javascript" src="http://techfest.org/gamersleague/plugins/revolution/js/extensions/revolution.extension.navigation.min.js"></script>
<script src="http://techfest.org/gamersleague/bower_components/keymaster/keymaster.js"></script>
<script src="http://techfest.org/gamersleague/bower_components/summernote/dist/summernote.min.js"></script>
<script src="http://techfest.org/gamersleague/bower_components/prism/prism.js"></script>
<script src="http://techfest.org/gamersleague/js/godlike.min.js"></script>
<script src="http://techfest.org/gamersleague/js/godlike-init.js"></script>
<script>
    $('#fileupload').change(function(){
        $('#fileBtn').text($(this).val().split('\\').pop());
    });
    $('#submitBtn').bind("click",function()
    {

        var imgVal = $('#fileupload').val();
        if(imgVal=='')
        {
            alert("You need to upload a team image");
            return false;
        }


    });
</script>
</body>
</html>