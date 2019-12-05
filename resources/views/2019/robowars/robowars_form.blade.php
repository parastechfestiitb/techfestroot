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
           background-image: url("/2019/robowars.jpg");
        }
    </style>
</head>
<body>
<h1 class="header-w3ls">Registration Form</h1>
<!-- multistep form -->
<div class="main-bothside">
    <form action="/robowars/form" method="post">
    {{csrf_field()}}
        @if($errors->any())

            <div class="main-title " style="text-align: center;">
                <h2 style="text-align: center;"> Thanks for registering! Check your Email (Spam too!) to know your Team ID.</h2>
            </div>
{{--                {{$errors->first()}}--}}

        @endif

        <div class="form-group">
            <div class="form-mid-w3ls">
                <select name="category" class="form-control buttom" required>
                    <option value="">Category</option>
                    <option value="8KG">8 kg</option>
                </select>
            </div>
            <div class="form-mid-w3ls">
                <input type="text" class="form-control" name="team_name"  placeholder="Team Name" required>
            </div>
            <div class="form-mid-w3ls">
                <input type="text" class="form-control" name="country"  placeholder="Country" required>
            </div>
        </div>
        <div class="form-group">
            <div class="form-grid-w3ls">
                <input type="text" class="" name="college"  placeholder="College Name" required>
            </div>
            <div class="form-grid-w3ls">
                <input type="text" name="pincode"  placeholder="Pincode" required>
            </div>
        </div>
        <div class="form-group">
            <h2>Team Leader Details:</h2>
        </div>
        <br>
        <div class="form-group">
            <div class="form-mid-w3ls">
                <input type="text" class="form-control" name="name_0"  placeholder="Name - Team Leader" required>
            </div>
            <div class="form-mid-w3ls">
                <input type="text" class="form-control" name="email_0"  placeholder="Email" required>
            </div>
            <div class="form-mid-w3ls">
                <input type="text" class="form-control" name="number_0"  placeholder="Phone Number" required>
            </div>
        </div>
        <div class="form-group" >
            <h2>Other Team Member details:</h2>

        </div>
        <br>
        <div class="form-group">
            <div class="form-mid-w3ls">
                <input type="text" class="form-control" name="name_1"  placeholder="Name - Team Member 2" >
            </div>
            <div class="form-mid-w3ls">
                <input type="text" class="form-control" name="email_1"  placeholder="Email" >
            </div>
            <div class="form-mid-w3ls">
                <input type="text" class="form-control" name="number_1"  placeholder="Phone Number" >
            </div>
        </div>
        <div class="form-group">
            <div class="form-mid-w3ls">
                <input type="text" class="form-control" name="name_2"  placeholder="Name - Team Member 3" >
            </div>
            <div class="form-mid-w3ls">
                <input type="text" class="form-control" name="email_2"  placeholder="Email" >
            </div>
            <div class="form-mid-w3ls">
                <input type="text" class="form-control" name="number_2"  placeholder="Phone Number" >
            </div>
        </div>
        <div class="form-group">
            <div class="form-mid-w3ls">
                <input type="text" class="form-control" name="name_3"  placeholder="Name - Team Member 4" >
            </div>
            <div class="form-mid-w3ls">
                <input type="text" class="form-control" name="email_3"  placeholder="Email" >
            </div>
            <div class="form-mid-w3ls">
                <input type="text" class="form-control" name="number_3"  placeholder="Phone Number" >
            </div>
        </div>
        <div class="form-group">
            <div class="form-mid-w3ls">
                <input type="text" class="form-control" name="name_4"  placeholder="Name - Team Member 5" >
            </div>
            <div class="form-mid-w3ls">
                <input type="text" class="form-control" name="email_4"  placeholder="Email" >
            </div>
            <div class="form-mid-w3ls">
                <input type="text" class="form-control" name="number_4"  placeholder="Phone Number" >
            </div>
        </div>
        <div class="form-group">
            <div class="form-mid-w3ls">
                <input type="text" class="form-control" name="name_5"  placeholder="Name - Team Member 6" >
            </div>
            <div class="form-mid-w3ls">
                <input type="text" class="form-control" name="email_5"  placeholder="Email" >
            </div>
            <div class="form-mid-w3ls">
                <input type="text" class="form-control" name="number_5"  placeholder="Phone Number " >
            </div>
        </div>

        <div >
            <input type="hidden" name="url" value="{{url()->current()}}">
        </div>

        <input type="submit" value="Submit">
    </form>
</div>


</body>
</html>