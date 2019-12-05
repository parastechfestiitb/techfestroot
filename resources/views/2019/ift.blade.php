<!DOCTYPE html>
<html lang="en">
<head>
    <title>IFT | Techfest, IIT Bombay</title>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="image/x-icon" href="/2019/ca/images/favicon_logo.png" />

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/2019/coming_soon/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/2019/coming_soon/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/2019/coming_soon/fonts/iconic/css/material-design-iconic-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/2019/coming_soon/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/2019/coming_soon/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/2019/coming_soon/css/util.css">
    <link rel="stylesheet" type="text/css" href="/2019/coming_soon/css/main.css">
    <!--===============================================================================================-->
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
        ::-webkit-scrollbar {
            width: 0px;  /* Remove scrollbar space */
            background: transparent;  /* Optional: just make scrollbar invisible */
        }
    </style>
</head>
<body>



<div class="flex-w flex-str size1 overlay1">
    <div class="flex-w flex-col-sb wsize1 bg0 p-l-70 p-t-37 p-b-52 p-r-50 respon1">
        <div class="wrappic1">
            <a href="/">
                <img class="logo"  style="max-height: 60px" src="/2019/tf_date_black.png" alt="IMG">
            </a>
        </div>

        <div class="w-full p-t-100 p-b-90 p-l-48 p-l-0-md">

            <h3 class="l1-txt1 p-b-34 respon3">
                Coming Soon
            </h3>
            @if($errors->any())
                <p class="m2-txt1 p-b-46">
                    {{$errors->first()}}
                </p>
            @endif
            <p>
                International Full Throttle is an event where you will feel the roaring nitro-buggy engines as adrenaline rush gets the best of you. It is something more than a competition, it is a feeling which you shall cherish forever. Stay tuned for more updates!
            </p>
            <br>
            <p class="m2-txt1 p-b-46">
                Follow us for update now!
            </p>


            <form class="contact100-form validate-form m-t-10 m-b-10">
                <div class="wrap-input100 validate-input m-lr-auto-lg" data-validate = "Email required">
                    <input class="s2-txt1 placeholder0 input100 trans-04" type="text" name="email" placeholder="Email Address">

                    <button class="flex-c-m ab-t-r size2 hov1 respon5">
                        <i class="zmdi zmdi-long-arrow-right fs-30 cl1 trans-04"></i>
                    </button>

                    <div class="flex-c-m ab-t-l s2-txt1 size4 bor1 respon4">
                        <span>Subscribe Now:</span>
                    </div>
                </div>
            </form>

        </div>

        <div>

            <div style="height: 36px">
                <span class="m2-txt2 p-r-73">
					Name
				</span>
                <a href="" style="padding: 10px;color: black">Om Jaiswal</a>

            </div>

            <div style="height: 36px">
                <span class="m2-txt2 p-r-58">
					Call Us
				</span>
                <a href="tel:+917400400933" style="padding: 10px;color: black">+91 74004 00933</a>

            </div>

            <div style="height: 36px">
                <span class="m2-txt2 p-r-59">
					Mail Us
				</span>
                <a href="mailto:omjaiswal@techfest.org" target="_top" style="padding: 10px;color: black">omjaiswal@techfest.org</a>

            </div>



            <div class="flex-w flex-m" style="height: 36px">
				<span class="m2-txt2 p-r-42" style="  position: center">
					Follow us
				</span>

                <a href="https://www.facebook.com/iitbombaytechfest/" class="size3 flex-c-m how-social trans-04 m-r-15 m-b-5 m-t-5">
                    <i class="fa fa-facebook"></i>
                </a>

                <a href="https://www.instagram.com/techfest_iitbombay/" class="size3 flex-c-m how-social trans-04 m-r-15 m-b-5 m-t-5">
                    <i class="fa fa-instagram"></i>
                </a>

                <a href="https://twitter.com/Techfest_IITB" class="size3 flex-c-m how-social trans-04 m-r-15 m-b-5 m-t-5">
                    <i class="fa fa-twitter"></i>
                </a>
                {{--            <a href="#" class="size3 flex-c-m how-social trans-04 m-r-15 m-b-5 m-t-5">--}}
                {{--                <i class="fa fa-youtube-play"></i>--}}
                {{--            </a>--}}
            </div>



        </div>

    </div>


    <div class="wsize2 bg-img1 respon2" style="background-image: url('/2019/ift.jpg');">
    </div>
</div>





<!--===============================================================================================-->
<script src="/2019/coming_soon/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="/2019/coming_soon/vendor/bootstrap/js/popper.js"></script>
<script src="/2019/coming_soon/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="/2019/coming_soon/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="/2019/coming_soon/vendor/tilt/tilt.jquery.min.js"></script>
<!--===============================================================================================-->
<script src="/2019/coming_soon/js/main.js"></script>

</body>
</html>