<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Register | Gamersleague | Techfest IIT Bombay</title>
    @include('layouts.meta')
    <link rel="icon" type="image/png" href="https://techfest.org/gamersleague/images/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300i,400,700%7cMarcellus+SC" rel="stylesheet">
    <link rel="stylesheet" href="https://techfest.org/gamersleague/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://techfest.org/gamersleague/bower_components/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://techfest.org/gamersleague/bower_components/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" type="text/css" href="https://techfest.org/gamersleague/plugins/revolution/css/settings.css">
    <link rel="stylesheet" type="text/css" href="https://techfest.org/gamersleague/plugins/revolution/css/layers.css">
    <link rel="stylesheet" type="text/css" href="https://techfest.org/gamersleague/plugins/revolution/css/navigation.css">
    <link rel="stylesheet" href="https://techfest.org/gamersleague/bower_components/flickity/dist/flickity.min.css">
    <link rel="stylesheet" type="text/css" href="https://techfest.org/gamersleague/bower_components/photoswipe/dist/photoswipe.css">
    <link rel="stylesheet" type="text/css" href="https://techfest.org/gamersleague/bower_components/photoswipe/dist/default-skin/default-skin.css">
    <link rel="stylesheet" type="text/css" href="https://techfest.org/gamersleague/bower_components/datetimepicker/build/jquery.datetimepicker.min.css">
    <link rel="stylesheet" type="text/css" href="https://techfest.org/gamersleague/plugins/revolution/css/settings.css">
    <link rel="stylesheet" type="text/css" href="https://techfest.org/gamersleague/plugins/revolution/css/layers.css">
    <link rel="stylesheet" type="text/css" href="https://techfest.org/gamersleague/plugins/revolution/css/navigation.css">
    <link rel="stylesheet" type="text/css" href="https://techfest.org/gamersleague/bower_components/prism/themes/prism-tomorrow.css">
    <link rel="stylesheet" type="text/css" href="https://techfest.org/gamersleague/bower_components/summernote/dist/summernote.css">
    <link rel="stylesheet" href="https://techfest.org/gamersleague/css/godlike.css">
    <link rel="stylesheet" href="https://techfest.org/gamersleague/css/custom.css">
    <script src="https://techfest.org/gamersleague/bower_components/jquery/dist/jquery.min.js"></script>
</head>
<body>
@include('layouts.preloader')
<div class="nk-page-background op-5" data-bg-mp4="https://techfest.org/gamersleague/video/bg-2.mp4" data-bg-webm="https://techfest.org/gamersleague/video/bg-2.webm" data-bg-ogv="https://techfest.org/gamersleague/video/bg-2.ogv" data-bg-poster="https://techfest.org/gamersleague/video/bg-2.jpg"></div>
<div class="nk-page-border">
    <div class="nk-page-border-t"></div>
    <div class="nk-page-border-r"></div>
    <div class="nk-page-border-b"></div>
    <div class="nk-page-border-l"></div>
</div>
@include('header')
<div class="nk-main">
    <div class="nk-gap-4"></div>
    <div class="container">
        <div class="row vertical-gap">
            <div class="col-md-6 offset-md-3">
                <div class="nk-box-3 bg-dark-2">
                    <h2 class="nk-title h3 text-xs-center">Enter your details</h2>
                    <div class="nk-gap-1"></div>
                    <form action="{{route('register')}}" method="POST" class="nk-form">
                        @csrf<label for="name">Name *</label>
                        <input type="text" class="form-control required" id="name" name="name">
                        <div class="nk-gap"></div>
                        <label for="email">Email *</label>
                        <input type="email" id="email" class="form-control required" name="email" >
                        <div class="nk-gap"></div>
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control required" id="phone" name="phone" placeholder="Mobile *">
                        <div class="nk-gap"></div>
                        <div class="nk-form-response-success"></div>
                        <div class="nk-form-response-error"></div>
                        <div class="nk-gap"></div>
                        <button class="nk-btn nk-btn-lg link-effect-4 w-100">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="nk-gap-4"></div>
    <div class="nk-gap-4"></div>

    @include('layouts.footer')

</div>
@include('layouts.socials')
@include('layouts.floater')
<script src="https://techfest.org/gamersleague/bower_components/gsap/src/minified/TweenMax.min.js"></script>
<script src="https://techfest.org/gamersleague/bower_components/gsap/src/minified/plugins/ScrollToPlugin.min.js"></script>
<script src="https://techfest.org/gamersleague/bower_components/tether/dist/js/tether.min.js"></script>
<script src="https://techfest.org/gamersleague/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="https://techfest.org/gamersleague/bower_components/sticky-kit/dist/sticky-kit.min.js"></script>
<script src="https://techfest.org/gamersleague/bower_components/jarallax/dist/jarallax.min.js"></script>
<script src="https://techfest.org/gamersleague/bower_components/jarallax/dist/jarallax-video.min.js"></script>
<script src="https://techfest.org/gamersleague/bower_components/flickity/dist/flickity.pkgd.min.js"></script>
<script src="https://techfest.org/gamersleague/bower_components/isotope/dist/isotope.pkgd.min.js"></script>
<script src="https://techfest.org/gamersleague/bower_components/photoswipe/dist/photoswipe.min.js"></script>
<script src="https://techfest.org/gamersleague/bower_components/photoswipe/dist/photoswipe-ui-default.min.js"></script>
<script src="https://techfest.org/gamersleague/bower_components/typed.js/dist/typed.min.js"></script>
<script src="https://techfest.org/gamersleague/bower_components/jquery-form/jquery.form.js"></script>
<script src="https://techfest.org/gamersleague/bower_components/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="https://techfest.org/gamersleague/bower_components/jquery.countdown/dist/jquery.countdown.min.js"></script>
<script src="https://techfest.org/gamersleague/bower_components/moment/min/moment.min.js"></script>
<script src="https://techfest.org/gamersleague/bower_components/moment-timezone/builds/moment-timezone-with-data.js"></script>
<script src="https://techfest.org/gamersleague/bower_components/hammer.js/hammer.min.js"></script>
<script src="https://techfest.org/gamersleague/plugins/nk-share/nk-share.js"></script>
<script src="https://techfest.org/gamersleague/bower_components/nanoscroller/bin/javascripts/jquery.nanoscroller.min.js"></script>
<script src="https://techfest.org/gamersleague/bower_components/SoundManager2/script/soundmanager2-nodebug-jsmin.js"></script>
<script src="https://techfest.org/gamersleague/bower_components/datetimepicker/build/jquery.datetimepicker.full.min.js"></script>
<script type="text/javascript" src="https://techfest.org/gamersleague/plugins/revolution/js/jquery.themepunch.tools.min.js"></script>
<script type="text/javascript" src="https://techfest.org/gamersleague/plugins/revolution/js/jquery.themepunch.revolution.min.js"></script>
<script type="text/javascript" src="https://techfest.org/gamersleague/plugins/revolution/js/extensions/revolution.extension.video.min.js"></script>
<script type="text/javascript" src="https://techfest.org/gamersleague/plugins/revolution/js/extensions/revolution.extension.carousel.min.js"></script>
<script type="text/javascript" src="https://techfest.org/gamersleague/plugins/revolution/js/extensions/revolution.extension.navigation.min.js"></script>
<script src="https://techfest.org/gamersleague/bower_components/keymaster/keymaster.js"></script>
<script src="https://techfest.org/gamersleague/bower_components/summernote/dist/summernote.min.js"></script>
<script src="https://techfest.org/gamersleague/bower_components/prism/prism.js"></script>
<script src="https://techfest.org/gamersleague/js/godlike.min.js"></script>
<script src="https://techfest.org/gamersleague/js/godlike-init.js"></script>
<script src="https://techfest.org/gamersleague/js/cleave.min.js"></script>
<script src="https://techfest.org/gamersleague/js/cleave-phone.in.js"></script>
<script>
    $(document).ready(function(){
        new Cleave('#phone',{
            phone:true,
            prefix: '+91-',
            delimiter: '-',
            phoneRegionCode:'in'
        });
    });
</script>
</body>
</html>