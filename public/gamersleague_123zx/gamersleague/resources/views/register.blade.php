<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="_nK">
    <title>Register | Gamersleague | Techfest IIT Bombay</title>
    <link rel="icon" type="image/png" href="assets/images/favicon.png">

    <!-- START: Styles -->

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300i,400,700%7cMarcellus+SC" rel="stylesheet">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="assets/bower_components/bootstrap/dist/css/bootstrap.min.css">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="assets/bower_components/fontawesome/css/font-awesome.min.css">

    <!-- IonIcons -->
    <link rel="stylesheet" href="assets/bower_components/ionicons/css/ionicons.min.css">

    <!-- Revolution Slider -->
    <link rel="stylesheet" type="text/css" href="assets/plugins/revolution/css/settings.css">
    <link rel="stylesheet" type="text/css" href="assets/plugins/revolution/css/layers.css">
    <link rel="stylesheet" type="text/css" href="assets/plugins/revolution/css/navigation.css">

    <!-- Flickity -->
    <link rel="stylesheet" href="assets/bower_components/flickity/dist/flickity.min.css">

    <!-- Photoswipe -->
    <link rel="stylesheet" type="text/css" href="assets/bower_components/photoswipe/dist/photoswipe.css">
    <link rel="stylesheet" type="text/css" href="assets/bower_components/photoswipe/dist/default-skin/default-skin.css">

    <!-- DateTimePicker -->
    <link rel="stylesheet" type="text/css" href="assets/bower_components/datetimepicker/build/jquery.datetimepicker.min.css">

    <!-- Revolution Slider -->
    <link rel="stylesheet" type="text/css" href="assets/plugins/revolution/css/settings.css">
    <link rel="stylesheet" type="text/css" href="assets/plugins/revolution/css/layers.css">
    <link rel="stylesheet" type="text/css" href="assets/plugins/revolution/css/navigation.css">

    <!-- Prism -->
    <link rel="stylesheet" type="text/css" href="assets/bower_components/prism/themes/prism-tomorrow.css">

    <!-- Summernote -->
    <link rel="stylesheet" type="text/css" href="assets/bower_components/summernote/dist/summernote.css">

    <!-- GODLIKE -->
    <link rel="stylesheet" href="assets/css/godlike.css">

    <!-- Custom Styles -->
    <link rel="stylesheet" href="assets/css/custom.css">

    <!-- END: Styles -->

    <!-- jQuery -->
    <script src="assets/bower_components/jquery/dist/jquery.min.js"></script>



</head>
<body>
@include('layouts.preloader')
<div class="nk-page-background op-5" data-bg-mp4="assets/video/bg-2.mp4" data-bg-webm="assets/video/bg-2.webm" data-bg-ogv="assets/video/bg-2.ogv" data-bg-poster="assets/video/bg-2.jpg"></div>
<div class="nk-page-border">
    <div class="nk-page-border-t"></div>
    <div class="nk-page-border-r"></div>
    <div class="nk-page-border-b"></div>
    <div class="nk-page-border-l"></div>
</div>
@include('header')
<div class="nk-main">
    <div class="nk-header-title nk-header-title-md nk-header-title-parallax-opacity">
        <div class="bg-image">
            <div style="background-image: url('assets/images/image-1.jpg');"></div>
        </div>
        <div class="nk-header-table">
            <div class="nk-header-table-cell">
                <div class="container">


                    <h1 class="nk-title">Forms</h1>


                    <h2 class="nk-sub-title">Working AJAX Forms</h2>



                </div>
            </div>
        </div>

    </div>
    <!-- END: Header Title -->





    <div class="nk-gap-4"></div>

    <div class="container">

        <div class="row vertical-gap">
            <div class="col-md-6">
                <div class="nk-box-3 bg-dark-1">
                    <h2 class="nk-title h3 text-xs-center">Contact Form</h2>
                    <div class="nk-gap-1"></div>

                    <!-- START: Form 1 -->
                    <form action="php/contact.php" class="nk-form nk-form-ajax">
                        <input type="email" class="form-control required" name="email" placeholder="Email *">
                        <div class="nk-gap"></div>
                        <input type="text" class="form-control required" name="name" placeholder="Name *">
                        <div class="nk-gap"></div>
                        <textarea class="form-control required" name="message" rows="5" placeholder="Message *"></textarea>
                        <div class="nk-gap"></div>
                        <div class="nk-form-response-success"></div>
                        <div class="nk-form-response-error"></div>
                        <button class="nk-btn nk-btn-lg link-effect-4">Send</button>
                    </form>
                    <!-- END: Form 1 -->

                </div>
            </div>
            <div class="col-md-6">
                <div class="nk-box-3">
                    <h2 class="nk-title h3 text-xs-center">Contact Form</h2>
                    <div class="nk-gap-1"></div>

                    <!-- START: Form 2 -->
                    <form action="php/contact.php" class="nk-form nk-form-ajax nk-form-style-1">
                        <input type="email" class="form-control required" name="email" placeholder="Email *">
                        <div class="nk-gap"></div>
                        <input type="text" class="form-control required" name="name" placeholder="Name *">
                        <div class="nk-gap"></div>
                        <textarea class="form-control required" name="message" rows="5" placeholder="Message *"></textarea>
                        <div class="nk-gap"></div>
                        <div class="nk-form-response-success"></div>
                        <div class="nk-form-response-error"></div>
                        <button class="nk-btn nk-btn-lg link-effect-4">Send</button>
                    </form>
                    <!-- END: Form 2 -->

                </div>
            </div>
        </div>

        <div class="clearfix"></div>
        <div class="nk-gap-1"></div>

        <!-- START: Mailchimp Subscribe Form -->
        <div class="row vertical-gap">
            <div class="col-md-6">
                <div class="nk-box-3 bg-dark-1">
                    <h2 class="nk-title h3 text-xs-center">MailChimp Subscribe Form</h2>
                    <div class="nk-gap-1"></div>

                    <!-- START: MailChimp Signup Form -->
                    <form action="//nkdev.us11.list-manage.com/subscribe/post?u=d433160c0c43dcf8ecd52402f&amp;id=7eafafe8f0" method="post" class="nk-mchimp validate" target="_blank">
                        <input type="email" value="" name="EMAIL" class="required email form-control text-xs-center" placeholder="Email *">
                        <div class="nk-gap"></div>
                        <button class="nk-btn nk-btn-lg nk-btn-block link-effect-4">Subscribe</button>

                        <div class="nk-form-response-success"></div>
                        <div class="nk-form-response-error"></div>
                        <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                        <div style="position: absolute; left: -5000px;" aria-hidden="true">
                            <input type="text" name="b_d433160c0c43dcf8ecd52402f_7eafafe8f0" tabindex="-1" value="">
                        </div>
                    </form>
                    <!-- END: MailChimp Signup Form -->
                </div>
            </div>
            <div class="col-md-6">
                <div class="nk-box-3">
                    <h2 class="nk-title h3 text-xs-center">Alternate Style for Subscribe Form</h2>
                    <div class="nk-gap-1"></div>

                    <!-- START: MailChimp Signup Form -->
                    <form action="//nkdev.us11.list-manage.com/subscribe/post?u=d433160c0c43dcf8ecd52402f&amp;id=7eafafe8f0" method="post" class="nk-mchimp nk-form nk-form-style-1 validate" target="_blank">
                        <div class="input-group">
                            <input type="email" value="" name="EMAIL" class="required email form-control" placeholder="Email *">
                            <span class="nk-input-group-btn">
                                    <button class="nk-btn nk-btn-lg link-effect-4">Subscribe</button>
                                </span>
                        </div>
                        <div class="nk-form-response-success"></div>
                        <div class="nk-form-response-error"></div>
                        <small>We'll never share your email with anyone else.</small>
                        <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                        <div style="position: absolute; left: -5000px;" aria-hidden="true">
                            <input type="text" name="b_d433160c0c43dcf8ecd52402f_7eafafe8f0" tabindex="-1" value="">
                        </div>
                    </form>
                    <!-- END: MailChimp Signup Form -->

                </div>
            </div>
        </div>
        <!-- END: Mailchimp Subscribe Form -->

    </div>

    <div class="nk-gap-4"></div>
    <div class="nk-gap-4"></div>
    @include('layouts.footer')
</div>
<div class="nk-share-buttons nk-share-buttons-left">
    <ul>
        <li>
                <span class="nk-share-icon" title="Share page on Facebook" data-share="facebook">
                    <span class="icon fa fa-facebook"></span>
                </span>
            <span class="nk-share-name">Facebook</span>
        </li>
        <li>
                <span class="nk-share-icon" title="Share page on Twitter" data-share="twitter">
                    <span class="icon fa fa-twitter"></span>
                </span>
            <span class="nk-share-name">Twitter</span>
        </li>
        <li>
                <span class="nk-share-icon" title="Share page on Google+" data-share="google-plus">
                    <span class="icon fa fa-google-plus"></span>
                </span>
            <span class="nk-share-name">Google Plus</span>
        </li>
        <!--
    <li>
        <span class="nk-share-icon" title="Share page on Pinterest" data-share="pinterest">
            <span class="icon fa fa-pinterest"></span>
        </span>
        <span class="nk-share-name">Pinterest</span>
    </li>
    <li>
        <span class="nk-share-icon" title="Share page on LinkedIn" data-share="linkedin">
            <span class="icon fa fa-linkedin"></span>
        </span>
        <span class="nk-share-name">LinkedIn</span>
    </li>
    <li>
        <span class="nk-share-icon" title="Share page on VK" data-share="vk">
            <span class="icon fa fa-vk"></span>
        </span>
        <span class="nk-share-name">Vkontakte</span>
    </li>
    -->
    </ul>
</div>
<div class="nk-side-buttons nk-side-buttons-visible">
    <ul>
        <li>
            <a href="https://nkdev.info" target="_blank" class="nk-btn nk-btn-lg link-effect-4">Keep in Touch</a>
        </li>
        <li>
                <span class="nk-btn nk-btn-lg nk-btn-icon nk-bg-audio-toggle">
                    <span class="icon">
                        <span class="ion-android-volume-up nk-bg-audio-pause-icon"></span>
                        <span class="ion-android-volume-off nk-bg-audio-play-icon"></span>
                    </span>
                </span>
        </li>
        <li class="nk-scroll-top">
                <span class="nk-btn nk-btn-lg nk-btn-icon">
                    <span class="icon ion-ios-arrow-up"></span>
                </span>
        </li>
    </ul>
</div>
<div class="nk-search">
    <div class="container">
        <form action="#">
            <fieldset class="form-group nk-search-field">
                <input type="text" class="form-control" id="searchInput" placeholder="Search..." name="s">
                <label for="searchInput"><i class="ion-ios-search"></i></label>
            </fieldset>
        </form>
    </div>
</div>
<div class="nk-cart">
    <div class="nk-gap-2"></div>
    <div class="container">
        <div class="nk-store nk-store-cart">
            <div class="table-responsive">
                <table class="table nk-store-cart-products">
                    <tbody>

                    <tr>
                        <td class="nk-product-cart-thumb">
                            <a href="store-product.html" class="nk-post-image">
                                <img src="assets/images/product-2-sm.png" alt="Men Tshirt" class="nk-img">
                            </a>
                        </td>
                        <td class="nk-product-cart-title">
                            <h2 class="nk-post-title h5">
                                <a href="store-product.html">Men Tshirt</a>
                            </h2>
                        </td>
                        <td class="nk-product-cart-price">$67.00</td>
                        <td class="nk-product-cart-quantity">
                            1
                        </td>
                        <td class="nk-product-cart-total">
                            $67.00
                        </td>
                        <td class="nk-product-cart-remove">
                            <a href="#">
                                <span class="ion-trash-b"></span>
                            </a>
                        </td>
                    </tr>

                    <tr>
                        <td class="nk-product-cart-thumb">
                            <a href="store-product.html" class="nk-post-image">
                                <img src="assets/images/product-4-sm.png" alt="Men Hoodie" class="nk-img">
                            </a>
                        </td>
                        <td class="nk-product-cart-title">
                            <h2 class="nk-post-title h5">
                                <a href="store-product.html">Men Hoodie</a>
                            </h2>
                        </td>
                        <td class="nk-product-cart-price">$125.00
                            <del>$145.00</del>
                        </td>
                        <td class="nk-product-cart-quantity">
                            2
                        </td>
                        <td class="nk-product-cart-total">
                            $250.00
                        </td>
                        <td class="nk-product-cart-remove">
                            <a href="#">
                                <span class="ion-trash-b"></span>
                            </a>
                        </td>
                    </tr>

                    </tbody>
                </table>
            </div>

            <div class="nk-gap-2"></div>
            <div class="nk-cart-total">
                Total
                <span>$317</span>
            </div>

            <div class="nk-gap-3"></div>
            <div class="nk-cart-btns">
                <a href="#" class="nk-btn nk-btn-lg nk-btn-color-main-1 link-effect-4">
                    Go to Checkout
                </a> &nbsp;&nbsp;&nbsp;&nbsp;
                <a href="#" class="nk-btn nk-btn-lg link-effect-4 nk-cart-toggle">
                    Continue Shopping
                </a>
            </div>
        </div>
    </div>
    <div class="nk-gap-5"></div>
</div>
<script src="assets/bower_components/gsap/src/minified/TweenMax.min.js"></script>
<script src="assets/bower_components/gsap/src/minified/plugins/ScrollToPlugin.min.js"></script>
<script src="assets/bower_components/tether/dist/js/tether.min.js"></script>
<script src="assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="assets/bower_components/sticky-kit/dist/sticky-kit.min.js"></script>
<script src="assets/bower_components/jarallax/dist/jarallax.min.js"></script>
<script src="assets/bower_components/jarallax/dist/jarallax-video.min.js"></script>
<script src="assets/bower_components/flickity/dist/flickity.pkgd.min.js"></script>
<script src="assets/bower_components/isotope/dist/isotope.pkgd.min.js"></script>
<script src="assets/bower_components/photoswipe/dist/photoswipe.min.js"></script>
<script src="assets/bower_components/photoswipe/dist/photoswipe-ui-default.min.js"></script>
<script src="assets/bower_components/typed.js/dist/typed.min.js"></script>
<script src="assets/bower_components/jquery-form/jquery.form.js"></script>
<script src="assets/bower_components/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="assets/bower_components/jquery.countdown/dist/jquery.countdown.min.js"></script>
<script src="assets/bower_components/moment/min/moment.min.js"></script>
<script src="assets/bower_components/moment-timezone/builds/moment-timezone-with-data.js"></script>
<script src="assets/bower_components/hammer.js/hammer.min.js"></script>
<script src="assets/plugins/nk-share/nk-share.js"></script>
<script src="assets/bower_components/nanoscroller/bin/javascripts/jquery.nanoscroller.min.js"></script>
<script src="assets/bower_components/SoundManager2/script/soundmanager2-nodebug-jsmin.js"></script>
<script src="assets/bower_components/datetimepicker/build/jquery.datetimepicker.full.min.js"></script>
<script type="text/javascript" src="assets/plugins/revolution/js/jquery.themepunch.tools.min.js"></script>
<script type="text/javascript" src="assets/plugins/revolution/js/jquery.themepunch.revolution.min.js"></script>
<script type="text/javascript" src="assets/plugins/revolution/js/extensions/revolution.extension.video.min.js"></script>
<script type="text/javascript" src="assets/plugins/revolution/js/extensions/revolution.extension.carousel.min.js"></script>
<script type="text/javascript" src="assets/plugins/revolution/js/extensions/revolution.extension.navigation.min.js"></script>
<script src="assets/bower_components/keymaster/keymaster.js"></script>
<script src="assets/bower_components/summernote/dist/summernote.min.js"></script>
<script src="assets/bower_components/prism/prism.js"></script>
<script src="assets/js/godlike.min.js"></script>
<script src="assets/js/godlike-init.js"></script>
</body>
</html>