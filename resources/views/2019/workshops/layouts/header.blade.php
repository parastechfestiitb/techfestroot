<style>
    .header {
        width: 100%;
        position: fixed;
        z-index: 8;
    }
    .footer_left {
        bottom: -4.1vh;
        width: 32vw;
        position: fixed;
        z-index: 8;
    }
    .footer_right {
        transform: rotateY(180deg);
        right: 0;
        bottom: -4.1vh;
        width: 32vw;
        position: fixed;
        z-index: 8;
    }
    .footer_center {
        left: 34.7vw;
        bottom: 0px;
        width: 32vw;
        position: fixed;
        z-index: 8;
    }
</style>
<style>
    .box{
        position:fixed;
        z-index: 20;

    }
    .links {
        font-size: 1.2vw;
        color: white!important;
        /*letter-spacing: 1px;*/
    }

    .topright{
        top:0px;
        right:0px;
        width: 33%;
        text-align: right;
        padding-right: 2%;
    }
    .topright_links {
        padding-top: 2.5%;
        line-height: 3.9vh;
    }
    .topleft{
        top:0px;
        left:0px;
        width: 33%;
        text-align: left;
        padding-left: 2%;
    }
    .topleft_links{
        padding-top: 2.5%;
        line-height: 3.9vh;
    }
    .bottomright{
        bottom: -2.1vh;
        right: 8vh;
        height: 11%;
        width: 26%;
    }
    .bottomleft{
        bottom: -1vh;
        left:0px;
        height: 10%;
        width: 30%;
        padding-left: 2%;

    }
    .bottomleft_link{
        text-align: left;
        line-height: 3.9vh;
    }
    .bottomcentre{
        left: calc(50% - 30vh);
        bottom:5px;
        width: 60vh;
        color: white;
        text-align: center;

    }
    .topcentre{
        top: 0.7%;
        left: 43%;
        max-width: 24%;
        max-height: 50px;

    }
    .logo {
        height: 5.2vh;
    }
    i {
        padding: 5px;
        size: 27px;
    }
</style>


<img class="header" src="/2019/homepage/images/Header.png" alt="" >
<img class="footer_left" src="/2019/homepage/images/Footer_Side.png" alt="" >
<img class="footer_right" src="/2019/homepage/images/Footer_Side.png" alt="" >
<img class="footer_center" src="/2019/homepage/images/Footer_middle.png" alt="" >

<div>
    <div class="box topleft">
        <div class="row">
            <div class="col-md-3 topleft_links" id=Links">
                <a class="links " href="/about-us" >About</a><br>
                <a class="links" href="/initiative">Initiatives</a><br>

            </div>
            <div class="col-md-3 topleft_links">
                <a class="links" href="/lectures/" >Lectures</a><br>
                <a class="links" href="/exhibitions/" >Exhibitions</a><br>
            </div>
            <div class="col-md-3 topleft_links">
                <a class="links" href="/summit19" >Summit</a><br>
                <a class="links" href="/mun" >TWMUN</a><br>

            </div>

            <div class="col-md-3 topleft_links" style="padding-left: 0px;">
                <a class="links"  href="/workshops" >Workshops</a><br>
            </div>


        </div>
    </div>
    <div class="box topright">
        <div class="row" >
            <div class="col-md-2 topright_links" style="padding-right: 2.5%;padding-left: 8.4%;">
                <a class="links" href="/competitions#ideate-section" >Ideate</a><br>

            </div>
            <div class="col-md-4 topright_links" id="Links" style="padding-right: 4px;">
                <a class="links" href="/competitions/" >Competitions</a><br>
                <a class="links" href="/esports" >Esports</a><br>

            </div>
            <div class="col-md-3 topright_links" style="padding-left: 0px;    padding-right: 1.1%;">
                <a class="links" style="letter-spacing: 0px" href="/ift/" >Full Throttle</a><br>
                <a class="links " href="/robowars/" >Robowars</a><br>

            </div>
            <div class="col-md-3 topright_links" style="padding-right: 0px;">
                <a class="links" href="/technoholix/" >Technoholix</a><br>
                <a class="links" href="/ozone" >Ozone</a><br>

            </div>
        </div>

    </div>
    <div class="box bottomright">
        <div class="row">
            <div class="col-sm-12 " style="text-align: right; font-size: 3vh">
                <div class="center_notification ">
                    <a href="/hospitality" class="" style="color: white">Accommodation portal is live!</a><br>
                    <a href="/summit" class="" style="color: white">Summit registration are now open!</a><br>


                    {{--                    <a href="/robowars" class="blinking2">Robowars is live now!</a>--}}
                </div>

            </div>
        </div>
    </div>
    <div class="box bottomleft">
        <div class="row ">
            <div class="col-md-4 bottomleft_link" style="    width: 30%;">
                <a class="links" href="/media/" >Media</a><br>
                <a class="links " href="/sponsors/" >Sponsors</a><br>


            </div>
            <div class="col-md-4 bottomleft_link " style="    padding-left: 0px;    width: 30%;">
                <a class="links " href="/legals/" >Legals</a><br>
                <a class="links " href="/hospitality" >Hospitality</a><br>

            </div>
            <div class="col-md-4 bottomleft_link" style="padding-left: 0px;">
                <a class="links" href="/theme" >Theme</a><br>

                <a class="links " href="/contact-us" style="padding-right: 0.4vw;">Contact Us</a><br>


            </div>

        </div>
    </div>
    <div class="box bottomcentre" style="font-size: 16px;">

        <a style="color: white" href="https://www.facebook.com/iitbombaytechfest" target="_blank"><i class="fab fa-facebook-f fa-lg" style=""></i></a>
        <a style="color: white" href="https://www.instagram.com/techfest_iitbombay/" target="_blank"><i class="fab fa-instagram fa-lg"></i></a>
        <a style="color: white" href="https://twitter.com/Techfest_IITB" target="_blank"><i class="fab fa-twitter fa-lg"></i></a>
        <a style="color: white" href="https://in.linkedin.com/company/techfest" target="_blank"><i class="fab fa-linkedin-in fa-lg"></i></a>
        <a style="color: white" href="https://in.pinterest.com/techfestiitbombay/" target="_blank"><i class="fab fa-pinterest-p fa-lg"></i></a>
        <a style="color: white" href="https://www.youtube.com/user/techfestiitbombay" target="_blank"><i class="fab fa-youtube fa-lg"></i></a>

    </div>
    <div class="box topcentre" >
        <a href="/tf"><img class="logo" src="/2019/tf_date.png" alt=""></a>

    </div>
</div>

