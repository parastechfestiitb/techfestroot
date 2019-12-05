<!DOCTYPE html>
<html lang="en">
<head>
    <title>Registration Form Techfest, IIT Bombay </title>
    <!-- Meta tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" type="image/x-icon" href="/2019/ca/images/favicon_logo.png" />

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <script>
        addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); }
    </script>
    <!-- Meta tags -->
    <!-- Calendar -->
    <link rel="stylesheet" href="css/jquery-ui.css" />
    <!-- //Calendar -->
    <!--stylesheets-->
    <link href="/2019/registration/css/style.css" rel='stylesheet' type='text/css' media="all">
    <!--//style sheet end here-->
    <!-- Google fonts here-->
    <!--//Google fonts here-->
    <style>
        body{
            background-color: #275E80; /* For browsers that do not support gradients */
            background-image: linear-gradient(to right, #5F4A85 , #70427D);
        }
    </style>
</head>
<body>
<h1 class="header-w3ls">Registration Form</h1>
<!-- multistep form -->
<div class="main-bothside">
    <form action="/competitions/details_form" method="post">
    {{csrf_field()}}

    <!--            <div class="main-title">-->
        <!--               <h2> Parents/Guardian Details</h2>-->
        <!--            </div>-->
        <div class="form-group">
            <div class="form-grid-w3ls">
                <input type="text" class="form-control" name="name"  placeholder="Name" value="{{$current_user_data->name}}" required="">
            </div>
            <div class="form-grid-w3ls">
                <input type="email" class="form-control" name="email" value="{{$current_user_data->email}}" placeholder="Email" required="">
            </div>
        </div>
        <div class="form-group">
            <div class="form-grid-w3ls">
                <input type="number" class="" name="number" value="{{$current_user_data->number}}" placeholder="Phone Number" required="" min="1000000000" max="9999999999">
            </div>
            <div class="form-grid-w3ls">
                <input type="text" name="country" value="{{$current_user_data->country}}" name="country" placeholder="Country" required="">
            </div>

        </div>
        <div class="form-group">
            <div class="form-mid-w3ls">
                <input type="text" name="city" value="{{$current_user_data->city}}" placeholder="City Name" required="">
            </div>
{{--            <div class="form-mid-w3ls">--}}
{{--                <select name="zonal" class="form-control buttom"  value="{{$current_user_data->zonal}}" required>--}}
{{--                    <option disabled="disabled" selected="selected">Zonals</option>--}}
{{--                    <option value="Delhi">Delhi</option>--}}
{{--                    <option value="Kolkata">Kolkata</option>--}}
{{--                    <option value="Bhopal">Bhopal</option>--}}
{{--                    <option value="Lucknow">Lucknow</option>--}}
{{--                    <option value="Jaipur">Jaipur</option>--}}
{{--                    <option value="Banglore">Banglore</option>--}}
{{--                    <option value="Mumbai">Mumbai</option>--}}
{{--                    <option value="Madagascar">Madagascar</option>--}}
{{--                    <option value="Kathmandu">Kathmandu, Nepal</option>--}}
{{--                    <option value="None">None</option>--}}
{{--                </select>--}}
{{--            </div>--}}
            <div class="form-mid-w3ls">
                <select name="gender" class="form-control buttom"  value="{{$current_user_data->gender}}" required>
                    <option disabled="disabled" selected="selected">Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="other">Other</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="form-mid-w3ls">
                <input type="text" name="institute_name" value="{{$current_user_data->institute_name}}" placeholder="Institute Name" required="">
            </div>
            <div class="form-mid-w3ls">
                <input type="text" name="institute_address" value="{{$current_user_data->institute_address}}" placeholder="Institute Address" required="">
            </div>
            <div class="form-mid-w3ls">
                <select name="year_of_study" class="form-control buttom"  value="{{$current_user_data->year_of_study}}" required>
                    <option disabled="disabled" selected="selected">Year of study/ Standard</option>
                    <option value="8">8th Standard</option>
                    <option value="9">9th Standard</option>
                    <option value="10">10th Standard</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="form-grid-w3ls">
                <input type="text" name="residential_address" value="{{$current_user_data->residential_address}}" placeholder="Residential Address" required="">
            </div>
            <div class="form-grid-w3ls">
                <input type="number" name="residential_pincode" value="{{$current_user_data->residential_pincode}}" placeholder="Residential Pincode" required="" min="100000" max="999999">
            </div>

        </div>
        <div class="form-group">

        </div>
        <div >
            <input type="hidden" name="url" value="{{url()->current()}}">
        </div>

        <input type="submit" value="Submit">
    </form>
</div>


</body>
</html>