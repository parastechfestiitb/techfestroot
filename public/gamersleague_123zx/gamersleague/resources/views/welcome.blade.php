<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>  Techfest Gamers' League | Techfest IIT Bombay</title>
    @include('layouts.meta')
    <link rel="icon" type="image/png" href="http://techfest.org/gleague/images/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300i,400,700%7cMarcellus+SC" rel="stylesheet">
    <link rel="stylesheet" href="http://techfest.org/gleague/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://techfest.org/gleague/bower_components/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://techfest.org/gleague/bower_components/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" type="text/css" href="http://techfest.org/gleague/plugins/revolution/css/settings.css">
    <link rel="stylesheet" type="text/css" href="http://techfest.org/gleague/plugins/revolution/css/layers.css">
    <link rel="stylesheet" type="text/css" href="http://techfest.org/gleague/plugins/revolution/css/navigation.css">
    <link rel="stylesheet" href="http://techfest.org/gleague/bower_components/flickity/dist/flickity.min.css">
    <link rel="stylesheet" type="text/css" href="http://techfest.org/gleague/bower_components/photoswipe/dist/photoswipe.css">
    <link rel="stylesheet" type="text/css" href="http://techfest.org/gleague/bower_components/photoswipe/dist/default-skin/default-skin.css">
    <link rel="stylesheet" type="text/css" href="http://techfest.org/gleague/bower_components/datetimepicker/build/jquery.datetimepicker.min.css">
    <link rel="stylesheet" type="text/css" href="http://techfest.org/gleague/plugins/revolution/css/settings.css">
    <link rel="stylesheet" type="text/css" href="http://techfest.org/gleague/plugins/revolution/css/layers.css">
    <link rel="stylesheet" type="text/css" href="http://techfest.org/gleague/plugins/revolution/css/navigation.css">
    <link rel="stylesheet" type="text/css" href="http://techfest.org/gleague/bower_components/prism/themes/prism-tomorrow.css">
    <link rel="stylesheet" type="text/css" href="http://techfest.org/gleague/bower_components/summernote/dist/summernote.css">
    <link rel="stylesheet" href="http://techfest.org/gleague/css/godlike.css">
    <link rel="stylesheet" href="http://techfest.org/gleague/css/custom.css">
    <script src="http://techfest.org/gleague/bower_components/jquery/dist/jquery.min.js"></script>
</head>
<body>
@include('layouts.preloader')
<div class="nk-page-background op-5" data-bg-mp4="http://techfest.org/gleague/video/bg-2.mp4" data-bg-webm="http://techfest.org/gleague/video/bg-2.webm" data-bg-ogv="http://techfest.org/gleague/video/bg-2.ogv" data-bg-poster="http://techfest.org/gleague/video/bg-2.jpg"></div>
<div class="nk-page-border">
    <div class="nk-page-border-t"></div>
    <div class="nk-page-border-r"></div>
    <div class="nk-page-border-b"></div>
    <div class="nk-page-border-l"></div>
</div>
@include('header')
<div class="nk-main">
    <!--Additional Classes: .nk-header-title-sm .nk-header-title-md .nk-header-title-lg .nk-header-title-xl .nk-header-title-full .nk-header-title-parallax .nk-header-title-parallax-opacity .nk-header-title-boxed-->
    <div class="nk-header-title nk-header-title-lg nk-header-title-parallax-opacity">
        <div class="bg-image">
            <div style="background-image: url('http://techfest.org/gamersleague/images/CSGO Landing Page Photo.jpg');"></div>
        </div>
        <div class="nk-header-table">
            <div class="nk-header-table-cell">
                <div class="container">
                    <div class="nk-header-text">
                        <h1 class="nk-title display-3"> Techfest <br> Gamers' League</h1>
                        <div class="nk-gap-2"></div>
{{--                        @if(session()->has('player'))--}}
{{--                            <a href="#" class="nk-btn nk-btn-lg nk-btn-color-main-1 link-effect-4" data-nav-toggle="#nk-side"> <span>Dashboard</span> </a> &nbsp;&nbsp;&nbsp;&nbsp;--}}
{{--                        @else--}}
{{--                        <a href="http://techfest.org/gamersleague/steam/auth" class="nk-btn nk-btn-lg nk-btn-color-main-1 link-effect-4"> <span>Steam Login</span> </a> &nbsp;&nbsp;&nbsp;&nbsp;--}}
{{--                        @endif--}}
{{--                        <a href="documentation.html" class="nk-btn nk-btn-lg link-effect-4"> <span>Documentation</span> </a>--}}
                        <div class="nk-gap-4"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mnt-80">
        <div id="rev_slider_50_1_wrapper" class="rev_slider_wrapper fullscreen-container" data-alias="photography-carousel48" style="padding:0px;">
            <div id="rev_slider_50_1" class="rev_slider fullscreenbanner" style="display:none;" data-version="5.0.7">
                <ul>
                    <li data-index="rs-192" data-transition="slideoververtical" data-slotamount="7" data-easein="default" data-easeout="default" data-masterspeed="1500" data-thumb="http://techfest.org/gleague/images/gallery-1-thumb.jpg" data-rotate="0" data-saveperformance="off"> <img src="http://techfest.org/gleague/images/gallery-1.jpg" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina> </li>
                    <li data-index="rs-186" data-transition="slideoverhorizontal" data-slotamount="7" data-easein="default" data-easeout="default" data-masterspeed="1500" data-thumb="http://techfest.org/gleague/images/gallery-4-thumb.jpg" data-rotate="0" data-saveperformance="off"> <img src="http://techfest.org/gleague/images/gallery-4.jpg" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina> </li>
                    <li data-index="rs-183" data-transition="slideoververtical" data-slotamount="7" data-easein="default" data-easeout="default" data-masterspeed="1500" data-thumb="http://techfest.org/gleague/images/gallery-5-thumb.jpg" data-rotate="0" data-fstransition="fade" data-fsmasterspeed="1500" data-fsslotamount="7" data-saveperformance="off"> <img src="http://techfest.org/gleague/images/gallery-5.jpg" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina> </li>
                </ul>
                <div class="tp-bannertimer tp-bottom" style="visibility: hidden !important;"></div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="nk-gap-6"></div>
        <div class="nk-gap-2"></div>
        <div class="row vertical-gap lg-gap">
            <div class="col-md-4">
                <div class="nk-ibox">
                    <div class="nk-ibox-icon nk-ibox-icon-circle"> <span class="ion-ios-game-controller-b"></span> </div>
                    <div class="nk-ibox-cont">
                        <h2 class="nk-ibox-title"><h2 class="nk-ibox-title">Biggest League</h2>
                            Witness the biggest league at the most premier institute of India once again</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="nk-ibox">
                    <div class="nk-ibox-icon nk-ibox-icon-circle"> <span class="ion-fireball"></span> </div>
                    <div class="nk-ibox-cont">
                        <h2 class="nk-ibox-title">Catchy Battles</h2>
                        Get ready to battle it out for the hottest esports titles amongst best teams
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="nk-ibox">
                    <div class="nk-ibox-icon nk-ibox-icon-circle"> <span class="ion-ribbon-a"></span> </div>
                    <div class="nk-ibox-cont">
                        <h2  class="nk-ibox-title">Prizes Worth 4 Lakh</h2>
                        The biggest prize worth among any college esports tournament in India
                    </div>
                </div>
            </div>
        </div>
        <div class="nk-gap-2"></div>
        <div class="nk-gap-6"></div>
    </div>
    <div class="nk-box bg-dark-1">
        <div class="container text-xs-center">
            <div class="nk-gap-6"></div>
            <div class="nk-gap-2"></div>
            <h2 class="nk-title h1">About Gamer's League</h2>
            <div class="nk-gap-3"></div>
            <p class="lead">
                Techfest 2019-20 is proud to present the Biggest College Gaming Event in India - Techfest Gamers League.
                <br>
                The online qualifiers for CSGO have been launched which will be followed by a LAN event at Techfest, IIT Bombay during 3rd-5th January 2020.
                <br>
                Registration is FREE for everyone. Last date for registrations for online qualifiers is 11th December 2019!
            </p>
            <div class="nk-gap-6"></div>
        </div>
    </div>
    <div class="nk-gap-2"></div>
    @include('layouts.footer')
</div>
@include('layouts.socials')
@include('layouts.floater')

<script src="http://techfest.org/gleague/bower_components/gsap/src/minified/TweenMax.min.js"></script>
<script src="http://techfest.org/gleague/bower_components/gsap/src/minified/plugins/ScrollToPlugin.min.js"></script>
<script src="http://techfest.org/gleague/bower_components/tether/dist/js/tether.min.js"></script>
<script src="http://techfest.org/gleague/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="http://techfest.org/gleague/bower_components/sticky-kit/dist/sticky-kit.min.js"></script>
<script src="http://techfest.org/gleague/bower_components/jarallax/dist/jarallax.min.js"></script>
<script src="http://techfest.org/gleague/bower_components/jarallax/dist/jarallax-video.min.js"></script>
<script src="http://techfest.org/gleague/bower_components/flickity/dist/flickity.pkgd.min.js"></script>
<script src="http://techfest.org/gleague/bower_components/isotope/dist/isotope.pkgd.min.js"></script>
<script src="http://techfest.org/gleague/bower_components/photoswipe/dist/photoswipe.min.js"></script>
<script src="http://techfest.org/gleague/bower_components/photoswipe/dist/photoswipe-ui-default.min.js"></script>
<script src="http://techfest.org/gleague/bower_components/typed.js/dist/typed.min.js"></script>
<script src="http://techfest.org/gleague/bower_components/jquery-form/jquery.form.js"></script>
<script src="http://techfest.org/gleague/bower_components/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="http://techfest.org/gleague/bower_components/jquery.countdown/dist/jquery.countdown.min.js"></script>
<script src="http://techfest.org/gleague/bower_components/moment/min/moment.min.js"></script>
<script src="http://techfest.org/gleague/bower_components/moment-timezone/builds/moment-timezone-with-data.js"></script>
<script src="http://techfest.org/gleague/bower_components/hammer.js/hammer.min.js"></script>
<script src="http://techfest.org/gleague/plugins/nk-share/nk-share.js"></script>
<script src="http://techfest.org/gleague/bower_components/nanoscroller/bin/javascripts/jquery.nanoscroller.min.js"></script>
<script src="http://techfest.org/gleague/bower_components/SoundManager2/script/soundmanager2-nodebug-jsmin.js"></script>
<script src="http://techfest.org/gleague/bower_components/datetimepicker/build/jquery.datetimepicker.full.min.js"></script>
<script type="text/javascript" src="http://techfest.org/gleague/plugins/revolution/js/jquery.themepunch.tools.min.js"></script>
<script type="text/javascript" src="http://techfest.org/gleague/plugins/revolution/js/jquery.themepunch.revolution.min.js"></script>
<script type="text/javascript" src="http://techfest.org/gleague/plugins/revolution/js/extensions/revolution.extension.video.min.js"></script>
<script type="text/javascript" src="http://techfest.org/gleague/plugins/revolution/js/extensions/revolution.extension.carousel.min.js"></script>
<script type="text/javascript" src="http://techfest.org/gleague/plugins/revolution/js/extensions/revolution.extension.navigation.min.js"></script>
<script src="http://techfest.org/gleague/bower_components/keymaster/keymaster.js"></script>
<script src="http://techfest.org/gleague/bower_components/summernote/dist/summernote.min.js"></script>
<script src="http://techfest.org/gleague/bower_components/prism/prism.js"></script>
<script src="http://techfest.org/gleague/js/godlike.min.js"></script>
<script src="http://techfest.org/gleague/js/godlike-init.js"></script>
<script type="text/javascript">
    var tpj = jQuery;
    var revapi50;
    tpj(document).ready(function() {
        if (tpj("#rev_slider_50_1").revolution == undefined) {
            revslider_showDoubleJqueryError("#rev_slider_50_1");
        } else {
            revapi50 = tpj("#rev_slider_50_1").show().revolution({
                sliderType: "carousel",
                jsFileLocation: "http://techfest.org/gleague/plugins/revolution/js/",
                sliderLayout: "auto",
                dottedOverlay: "none",
                delay: 9000,
                navigation: {
                    keyboardNavigation: "off",
                    keyboard_direction: "horizontal",
                    onHoverStop: "off",
                },
                carousel: {
                    maxRotation: 8,
                    vary_rotation: "off",
                    minScale: 20,
                    vary_scale: "off",
                    horizontal_align: "center",
                    vertical_align: "center",
                    fadeout: "off",
                    vary_fade: "off",
                    maxVisibleItems: 3,
                    infinity: "on",
                    space: -90,
                    stretch: "off"
                },
                responsiveLevels: [1240, 1024, 778, 480],
                gridwidth: [800, 600, 400, 320],
                gridheight: [600, 400, 320, 280],
                lazyType: "none",
                shadow: 0,
                spinner: "off",
                stopLoop: "on",
                stopAfterLoops: 0,
                stopAtSlide: 1,
                shuffle: "off",
                autoHeight: "off",
                fullScreenAlignForce: "off",
                fullScreenOffsetContainer: "",
                fullScreenOffset: "",
                disableProgressBar: "on",
                hideThumbsOnMobile: "off",
                hideSliderAtLimit: 0,
                hideCaptionAtLimit: 0,
                hideAllCaptionAtLilmit: 0,
                debugMode: false,
                fallbacks: {
                    simplifyAll: "off",
                    nextSlideOnWindowFocus: "off",
                    disableFocusListener: false,
                }
            });
        }
    });
</script>
</body>

</html>