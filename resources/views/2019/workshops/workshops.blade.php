<!DOCTYPE html>
<html lang="en">
<head>
    @include('2019.workshops.layouts.meta')
    <script type="text/javascript">
        if (screen.width <= 992) {
            document.location = "/m/workshops";
        }
    </script>
</head>
<body >
<div class="hexit"></div>
    @include('2019.workshops.layouts.header')
    <div class="row" style="position: absolute; margin-top: 6vw;height: 75vh;overflow-y: scroll; ">
        @include('2019.workshops.all_workshops')
    </div>
    @include('2019.workshops.layouts.footer')


</body>