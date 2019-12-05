<title>Workshops | Techfest, IIT Bombay</title>
<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
<meta name="viewport" content="width=device-width" />
<meta property="og:image" content="http://techfest.org/2019/workshops/images/thumbnail.png" />

<link rel="shortcut icon" type="image/x-icon" href="/2019/ca/images/favicon_logo.png" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="/2019/workshops/js/hexit.js"></script>
<style>
    body {
        margin: 0;
    }
    .hexit {
        background-color: #003270;
        position: absolute;
        width: 100vw;
        height: 100vh;
        border: 0;
        margin: 0;
    }
    ::-webkit-scrollbar { width: 0 !important }

</style>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-81222017-1"></script>
<script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-81222017-1');
</script>
<link rel="stylesheet" href="https://anandchowdhary.github.io/ionicons-3-cdn/icons.css" integrity="sha384-+iqgM+tGle5wS+uPwXzIjZS5v6VkqCUV7YQ/e/clzRHAxYbzpUJ+nldylmtBWCP0" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    body{
        font-family: Lato;
        background-color: #275E80; /* For browsers that do not support gradients */
        background-image: linear-gradient(#275E80 , #2C2F7A);
    }
    @import url("https://fonts.googleapis.com/css?family=Josefin+Sans:100,300,400,600,700|Work+Sans:100,200,300,400,500,600");
    :root {
        --headlinesFont: 'Josefin Sans', sans-serif;
        --bodyFont: 'Work Sans', sans-serif;
        --wildWatermelon: #7d277e;
        --fuelYellow: #f0a035;
        --textColor: #323232;
        --bodyBg: #d6d6d6;
        --white: #fff;
        --black: #000;
    }

    html {
        box-sizing: border-box;
    }

    body {
        font-family: var(--bodyFont);
        color: var(--textColor);
        line-height: 1.5;
    }

    * {
        box-sizing: inherit;
    }

    img {
        vertical-align: text-bottom;
    }

    a {
        color: inherit;
        /*text-decoration: none;*/
    }

    .ft-recipe {
        width: 100%;
        background: var(--white);
        display: flex;
        flex-direction: column;
        box-shadow: 0 0 88px 0 rgba(0, 0, 0, 0.1607843137);
        overflow: hidden;
        top: 50%;
        right: 50%;
        bottom: 50%;
        left: 50%;
        border-radius: 11px;

    }
    .ft-recipe .ft-recipe__thumb {
        position: relative;
        box-shadow: 0px 0px 130px 0 rgba(0, 0, 0, 0.38);
    }
    .ft-recipe .ft-recipe__thumb #close-modal {
        position: absolute;
        top: 0;
        right: 0;
        width: 36px;
        height: 36px;
        background: #000;
        color: var(--white);
        text-align: center;
        line-height: 36px;
        font-size: 22px;
        cursor: pointer;
        z-index: 1;
        transition: all 200ms ease;
    }
    .ft-recipe .ft-recipe__thumb #close-modal:hover {
        background: transparent;
        color: var(--black);
    }
    .ft-recipe .ft-recipe__thumb h3 {
        text-align: center;
        position: absolute;
        margin: 0;
        width: 100%;
        color: var(--white);
        font-family: var(--headlinesFont);
        font-size: 25px;
        height: 100%;
        background: linear-gradient(to bottom, rgba(0, 0, 0, 0.25), transparent);
        padding: 2.4rem 0 0;
    }
    .ft-recipe .ft-recipe__thumb img {
        width: 100%;
        height: 100%;
        -o-object-fit: cover;
        object-fit: cover;
        -o-object-position: 50% 50%;
        object-position: 50% 50%;
    }
    .ft-recipe .ft-recipe__content {
        flex: 1;
        padding: 0 0em 1em;
    }
    .ft-recipe .ft-recipe__content .content__header .row-wrapper {
        display: flex;
        padding: .55em 0 .3em;
        border-bottom: 1px solid #d8d8d8;
    }
    .ft-recipe .ft-recipe__content .content__header .row-wrapper .recipe-title {
        font-family: var(--headlinesFont);
        font-weight: 600;
    }
    .ft-recipe .ft-recipe__content .content__header .recipe-details {
        display: flex;
        list-style: none;
        margin: 0;
        justify-content: space-between;
    }
    .ft-recipe .ft-recipe__content .content__header .recipe-details .recipe-details-item {
        flex: 1;
    }
    .ft-recipe .ft-recipe__content .content__header .recipe-details .recipe-details-item i {
        font-size: 30px;
    }
    .ft-recipe .ft-recipe__content .content__header .recipe-details .recipe-details-item .value {
        color: #ff4f87;
        margin-left: .35em;
        vertical-align: bottom;
        font-size: 24px;
        font-weight: 600;
    }
    .ft-recipe .ft-recipe__content .content__header .recipe-details .recipe-details-item .title {
        display: block;
        margin-top: -4px;
        font-family: var(--headlinesFont);
        font-size: 21px;
        font-weight: 300;
    }

    .ft-recipe .ft-recipe__content .content__footer {
        text-align: center;
        margin: 0 3rem;
    }
    .ft-recipe .ft-recipe__content .content__footer a {
        font-family: var(--headlinesFont);
        display: inline-block;
        background: var(--wildWatermelon);
        background: var(--wildWatermelon);
        padding: 0px;
        /*width: 100%;*/
        text-align: center;
        border-radius: 5px;
        color: #fff;
        font-weight: 500;
        letter-spacing: .2px;
        font-size: 17px;
        transition: box-shadow 250ms ease, -webkit-transform 250ms ease;
        transition: transform 250ms ease, box-shadow 250ms ease;
        transition: transform 250ms ease, box-shadow 250ms ease, -webkit-transform 250ms ease;
    }
    .ft-recipe .ft-recipe__content .content__footer a:hover {
        -webkit-transform: translateY(-3px);
        transform: translateY(-3px);
        box-shadow: 0 10px 34px 0 rgba(255, 79, 135, 0.32);
    }
    .description{
        text-align: center;
        font-size: 13px;
        line-height: 17px;
        min-height: 2em;
        overflow: scroll;
    }

</style>
<style>
    .row{
        width: 100%;margin-right: 0px; margin-left: 0px;
    }
</style>
<!--   Core JS Files   -->
<script src="/2019/workshops/assets/js/jquery-2.2.4.min.js" type="text/javascript"></script>
<script src="/2019/workshops/assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/2019/workshops/assets/js/jquery.bootstrap.js" type="text/javascript"></script>

<!--  Plugin for the Wizard -->
<script src="/2019/workshops/assets/js/material-bootstrap-wizard.js"></script>

<!--  More information about jquery.validate here: http://jqueryvalidation.org/	 -->
<script src="/2019/workshops/assets/js/jquery.validate.min.js"></script>



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
