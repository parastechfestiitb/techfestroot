<!DOCTYPE html>
<html lang="en">
<head>
    <title>Hospitality | Techfest IIT Bombay</title>

    @include('2019.workshops.layouts.meta')
    <script type="text/javascript">
        if (screen.width <= 992) {
            document.location = "/m/hospitality";
        }
    </script>
    <link href="/2019/workshops/assets/css/material-bootstrap-wizard.css" rel="stylesheet" />

</head>
<body >
<div class="hexit"></div>
@include('2019.workshops.layouts.header')
<div class="row" style="position: absolute; margin-top: 6vw;height: 75vh;overflow-y: scroll; ">
    @include('2019.hospitality.center_box')
</div>
@include('2019.workshops.layouts.footer')


</body>