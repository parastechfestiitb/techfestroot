<!DOCTYPE html>
<html lang="en">
<head>
    @include('2019.workshops.layouts.workshop_detail_meta')
    <script type="text/javascript">
        if (screen.width > 992) {
            document.location = "/workshops";
        }
    </script>
    <style>
        @media screen and (max-width: 992px){
            .description{
                font-size: 1.6em;
                visibility: hidden;
                display: none;
            }
            .content__footer{
                display: none;
            }
        }
    </style>
</head>
<body style="margin: 0px; overflow-x: hidden">
@include('2019.mobile.layouts.header')

<div class="row" style="position: absolute; margin-top: 16vw;overflow-y: scroll; ">
    @include('2019.workshops.reg_form_box')
</div>
@include('2019.workshops.layouts.footer')
</body>