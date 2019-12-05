<!DOCTYPE html>
<html lang="en">
<head>
    <title>Create Team | Techfest, IIT Bombay</title>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="image/x-icon" href="/2019/ca/images/favicon_logo.png" />

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
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
        p{
            color: #ffffff!important;
        }

    </style>
</head>
<body>

<div class="container-contact100">

    <div class="wrap-contact100">
        <form class="contact100-form validate-form" method="post" action="/competitions/{{$form}}/createteam">
            {{csrf_field()}}
            <span class="contact100-form-title" style="color: white!important;">
					Create a Team
				</span>
            <p>Hi {{$current_user_data->name}},  After successfully submitting this form, you will become the <b>TEAM LEADER</b>. Now use the Registered Email Ids of your friends to add them in your team.</p>
            <p>Note that you need not add all the team members at once, and can add them in at later dates.</p>
            <p><br>DO MAKE SURE TO READ THE EXAMPLES BEFORE CREATING YOUR TEAM.<br></p>
            <p>Case 1:  In case you only added 2 members to your team and later, you want to add one more member to your team.<br></p>
            <p>The new member should join the existing team using the Registered Mail Id of any member of the existing team (not necessarily team leader) by clicking on Join a Team Button. Or, the Team leader can dissolve the existing Team and Form a New team.</p>
            <p><br>Case 2:  In case you have no team member to add in your team at the stage of registration.<br></p>
            <p>You shall still have to Create a Team and submit the form without filling the other details, since only registering, does not form your team even though you are a single member team. Team ID will be generated after team formation which is very important and will be used in future. Later you can add more members using the steps stated in Case 1.</p>
            @if($errors->any())
                <div class="alert">
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                    {{$errors->first()}}
                </div>
            @endif

            <div class="wrap-input100 validate-input" data-validate = "Please enter your email: e@a.x">
                <input class="input100" type="text" name="email2" placeholder="E-mail" value="{{$current_user_data->email}}(TEAM LEADER)" disabled>
                <span class="focus-input100"></span>
            </div>
            <div class="wrap-input100 validate-input" data-validate = "Please enter your email: e@a.x">
                <input class="input100" type="text" name="email2" placeholder="E-mail ID of member 2" >
                <span class="focus-input100"></span>
            </div>
            


            <div class="container-contact100-form-btn">
                <button class="contact100-form-btn">
						<span>
							<i class="fa fa-paper-plane-o m-r-6" aria-hidden="true"></i>
							Submit
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
