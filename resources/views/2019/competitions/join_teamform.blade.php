<!DOCTYPE html>
<html lang="en">
<head>
    <title>Join A Team | Techfest, IIT Bombay</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="shortcut icon" type="image/x-icon" href="/2019/ca/images/favicon_logo.png" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/2019/compi/ContactFrom_v10/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/2019/compi/ContactFrom_v10/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/2019/compi/ContactFrom_v10/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/2019/compi/ContactFrom_v10/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/2019/compi/ContactFrom_v10/vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/2019/compi/ContactFrom_v10/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/2019/compi/ContactFrom_v10/vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/2019/compi/ContactFrom_v10/css/util.css">
    <link rel="stylesheet" type="text/css" href="/2019/compi/ContactFrom_v10/css/main.css">
    <!--===============================================================================================-->
    <style>
        body{
            background-color: #275E80; /* For browsers that do not support gradients */
            background-image: linear-gradient(to right, #5F4A85 , #70427D);
        }
        .alert {
            padding: 20px;
            background-color: #f44336;
            color: white;
        }

        .closebtn {
            margin-left: 15px;
            color: white;
            font-weight: bold;
            float: right;
            font-size: 22px;
            line-height: 20px;
            cursor: pointer;
            transition: 0.3s;
        }

        .closebtn:hover {
            color: black;
        }
    </style>
</head>
<body>


<div class="container-contact100">

    <div class="wrap-contact100" >
        <form class="contact100-form validate-form" method="post" action="/competitions/{{$form}}/jointeam">
            {{csrf_field()}}
            <span class="contact100-form-title" style="color: black">
					Join a Team
				</span>
            <p style="color: black">Hi {{$current_user_data->name}}, you can join the team using registered email id of any of your preregistering member who already have a team and a vacancy in that.

            </p>
            @if($errors->any())
                <div class="alert">
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                    {{$errors->first()}}
                </div>
            @endif

            <div class="wrap-input100 validate-input" data-validate = "Please enter your email: e@a.x">
                <input class="input100" type="text" name="email" placeholder="E-mail" required>
                <span class="focus-input100"></span>
            </div>

            <div class="container-contact100-form-btn">
                <button class="contact100-form-btn">
						<span>
							<i class="fa fa-paper-plane-o m-r-6" aria-hidden="true"></i>
							Send
						</span>
                </button>
            </div>
        </form>
    </div>
</div>



<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
<script src="/2019/compi/ContactFrom_v10/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="/2019/compi/ContactFrom_v10/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="/2019/compi/ContactFrom_v10/vendor/bootstrap/js/popper.js"></script>
<script src="/2019/compi/ContactFrom_v10/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="/2019/compi/ContactFrom_v10/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="/2019/compi/ContactFrom_v10/vendor/daterangepicker/moment.min.js"></script>
<script src="/2019/compi/ContactFrom_v10/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
<script src="/2019/compi/ContactFrom_v10/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
<script src="/2019/compi/ContactFrom_v10/js/main.js"></script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-23581568-13');
</script>

</body>
</html>
