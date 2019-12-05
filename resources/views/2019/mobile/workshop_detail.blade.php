<!DOCTYPE html>
<html lang="en">
<head>
    @include('2019.workshops.layouts.workshop_detail_meta')
    <script type="text/javascript">
        if (screen.width >= 992) {
            document.location = "/workshops/{{$workshops_info->link}}";
        }
    </script>


</head>
<body style="margin: 0px; overflow-x: hidden">
@include('2019.mobile.layouts.header')

<div class="row" style="position: absolute; margin-top: 6vw;height: 100vh;overflow-y: scroll; ">

    @include('2019.workshops.center_box')
</div>
</body>
<!--   Core JS Files   -->

</html>