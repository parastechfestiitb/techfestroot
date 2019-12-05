<!DOCTYPE html>
<html lang="en">
<head>
    @include('2019.workshops.layouts.workshop_detail_meta')
    <script type="text/javascript">
        if (screen.width <= 992) {
            document.location = "/m/workshops_signin/{{$workshops_info->link}}";
        }
    </script>

</head>
<body style="margin: 0px; overflow-x: hidden">
<div class="hexit"></div>

@include('2019.workshops.layouts.header')
@include('2019.workshops.layouts.footer')
<div class="row" style="position: absolute; margin-top: 6vw;height: 75vh;overflow-y: scroll; ">
    @include('2019.workshops.reg_form_box')

</div>
<script>
    function loadScript( url, callback ){
        script = document.createElement("script");
        script.type = "text/javascript";
        if(script.readyState) {
            script.onreadystatechange = function() {
                if ( script.readyState === "loaded" || script.readyState === "complete" ) {
                    script.onreadystatechange = null;
                    callback();
                }
            };
        } else {
            script.onload = function() {
                callback();
            };
        }
        script.src = url;
    }
    function start() {
        gapi.load('auth2', function() {
            auth2 = gapi.auth2.init({
                client_id: '218886856483-4lnh6s9mvguid18098antfdltvosd7ln.apps.googleusercontent.com',
            });
        });

    }
    function authCheck(){
        console.log('called');
        auth2.grantOfflineAccess().then(response => {
            $('#name2').val(response.code);
            $("#h-form").submit();
        });

    }
    loadScript("https://apis.google.com/js/client:platform.js",function(){
        start();
        $('#signinButton, #googleLogin').click(function(){

            authCheck();
        });

    });
    document.getElementsByTagName( "head" )[0].appendChild( script );

    // $("#h-form").submit();
    // document.getElementById("h-form").submit();// Form submission


</script>
</body>

</html>







