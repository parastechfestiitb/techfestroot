<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" type="image/x-icon" href="/2019/ca/images/favicon_logo.png" />
    <!-- Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="#000000">

    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#000000">

    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#000000">
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-81222017-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-81222017-1');
    </script>

    <!-- Title Page-->
    <title>Registeration Forms</title>

    <!-- Icons font CSS-->
    <link href="/2019/ca/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="/2019/ca/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="/2019/ca/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="/2019/ca/vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="/2019/ca/css/main.css" rel="stylesheet" media="all">
</head>

<body>
<div class="page-wrapper bg-red p-t-180 p-b-100 font-robo">
    <div class="wrapper wrapper--w960">
        <div class="card card-2">
            <div class="card-heading"></div>
            <div class="card-body">
                <h2 class="title">Update Profile</h2>
                <form method="POST" action="/initiatives/financial_literacy/post">
                    {!! csrf_field() !!}
                    <div class="row row-space">
                        <div class="col-2">
                            <div class="input-group">
                                <input class="input--style-2" type="text" placeholder="Name" name="name" value="" required>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="input-group">
                                {{--                                 todo referto this--}}
                                <input class="input--style-2" type="text" placeholder="Email"  name="email" value="" required>
                            </div>
                        </div>
                    </div>
                    <div class="row row-space">
                        <div class="col-2">
                            <div class="input-group">
                                <input class="input--style-2" type="number" placeholder="Mobile Number" required name="number" value="" max="9999999999" min="1000000000">
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="input-group">
                                <div class="rs-select2 js-select-simple select--no-search">
                                    <select name="zone" required>
                                        <option disabled="disabled" selected="selected" value="">Zone</option>
                                        <option>Zone 1</option>
                                        <option>Zone 2</option>
                                        <option>Zone 3</option>
                                        <option>Zone 4</option>
                                    </select>
                                    <div class="select-dropdown"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="rs-select2 js-select-simple select--no-search">
                                <div class="input-group">

                                    <input class="input--style-2" type="text" placeholder="School/College Name :" required  name="school" value="">
                                </div>
                            </div>
                        </div>
{{--                        <div class="col-2">--}}
{{--                            <div class="input-group">--}}
{{--                                <div class="rs-select2 js-select-simple select--no-search">--}}
{{--                                    <select name="state" required>--}}
{{--                                        <option disabled="disabled" selected="selected" value="">State</option>--}}
{{--                                        <option value="AndhraPradesh">Andhra Pradesh</option>--}}
{{--                                        <option value="ArunachalPradesh">Arunachal Pradesh</option>--}}
{{--                                        <option value="Andaman&Nicobar">Andaman & Nicobar</option>--}}
{{--                                        <option value="Assam">Assam</option>--}}
{{--                                        <option value="Bihar">Bihar</option>--}}
{{--                                        <option value="Chandigarh">Chandigarh</option>--}}
{{--                                        <option value="Chhattisgarh">Chhattisgarh</option>--}}
{{--                                        <option value="DadarandNagarhaveli">DadarandNagarhaveli</option>--}}
{{--                                        <option value="Delhi">Delhi</option>--}}
{{--                                        <option value="Daman&Diu">Daman&Diu</option>--}}
{{--                                        <option value="Goa">Goa</option>--}}
{{--                                        <option value="Gujarat">Gujarat</option>--}}
{{--                                        <option value="Haryana">Haryana</option>--}}
{{--                                        <option value="Himachal">Himachal Pradesh</option>--}}
{{--                                        <option value="JammuandKashmir">Jammu and Kashmir</option>--}}
{{--                                        <option value="Jharkhand">Jharkhand</option>--}}
{{--                                        <option value="Karnataka">Karnataka</option>--}}
{{--                                        <option value="Kerala">Kerala</option>--}}
{{--                                        <option value="Lakshwadweep">Lakshwadweep</option>--}}
{{--                                        <option value="MadhyaPradesh">Madhya Pradesh</option>--}}
{{--                                        <option value="Maharashtra">Maharashtra</option>--}}
{{--                                        <option value="Manipur">Manipur</option>--}}
{{--                                        <option value="Meghalaya">Meghalaya</option>--}}
{{--                                        <option value="Mizoram">Mizoram</option>--}}
{{--                                        <option value="Nagaland">Nagaland</option>--}}
{{--                                        <option value="Odisha">Odisha</option>--}}
{{--                                        <option value="Punjab">Punjab</option>--}}
{{--                                        <option value="Puducherry">Puducherry</option>--}}
{{--                                        <option value="Rajasthan">Rajasthan</option>--}}
{{--                                        <option value="Sikkim">Sikkim</option>--}}
{{--                                        <option value="TamilNadu">Tamil Nadu</option>--}}
{{--                                        <option value="Telangana">Telangana</option>--}}
{{--                                        <option value="Tripura">Tripura</option>--}}
{{--                                        <option value="UttarPradesh">Uttar Pradesh</option>--}}
{{--                                        <option value="Uttarakhand">Uttarakhand</option>--}}
{{--                                        <option value="WestBengal">West Bengal</option>--}}
{{--                                    </select>--}}
{{--                                    <div class="select-dropdown"></div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-2">--}}
{{--                            <div class="input-group">--}}
{{--                                <div class="rs-select2 js-select-simple select--no-search">--}}
{{--                                    <select name="class" required>--}}
{{--                                        <option disabled="disabled" selected="selected" value="">Class</option>--}}
{{--                                        <option>8th Standard</option>--}}
{{--                                        <option>9th Standard</option>--}}
{{--                                        <option>10th Standard</option>--}}
{{--                                    </select>--}}
{{--                                    <div class="select-dropdown"></div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="col-2">
                            <div class="input-group">
                                <input class="input--style-2" type="text" placeholder="Address" required name="address" value="">
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="input-group">
                                <input class="input--style-2" type="text" placeholder="City" required name="city" value="">
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="input-group">
                                <input class="input--style-2" type="number" placeholder="Pincode" required name="pincode" value=""  max="999999" min="100000">
                            </div>
                        </div>
                    </div>
                    <div class="p-t-30">
                        <button class="btn btn--radius btn--green" type="submit" name="reg-submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Jquery JS-->
<script src="/2019/ca/vendor/jquery/jquery.min.js"></script>
<!-- Vendor JS-->
<script src="/2019/ca/vendor/select2/select2.min.js"></script>
<script src="/2019/ca/vendor/datepicker/moment.min.js"></script>
<script src="/2019/ca/vendor/datepicker/daterangepicker.js"></script>

<!-- Main JS-->
<script src="/2019/ca/js/global.js"></script>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->