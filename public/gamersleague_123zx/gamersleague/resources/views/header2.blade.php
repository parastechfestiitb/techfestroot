
<header class="nk-header nk-header-opaque">
    {{--    <div class="nk-contacts-top hidden-sm-down">--}}
    {{--        <div class="container">--}}
    {{--            <div class="nk-contacts-left">--}}
    {{--                <div class="nk-navbar">--}}
    {{--                    <ul class="nk-nav">--}}
    {{--                        <li> <a href="http://techfest.org">Techfest 2019-20</a></li>--}}
    {{--                        <li><a href="http://techfest.org/competitions">Competitions</a></li>--}}
    {{--                        <li><a href="http://techfest.org/workshops">Workshops</a></li>--}}
    {{--                    </ul>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--            <div class="nk-contacts-right">--}}
    {{--                <div class="nk-navbar">--}}
    {{--                    <ul class="nk-nav">--}}
    {{--                        <li>--}}
    {{--                            <a href="https://twitter.com/techfest_iitb/" target="_blank"> <span class="ion-social-twitter"></span> </a>--}}
    {{--                        </li>--}}
    {{--                        <li>--}}
    {{--                            <a href="https://www.facebook.com/iitbombaytechfest/" target="_blank"> <span class="ion-social-facebook"></span> </a>--}}
    {{--                        </li>--}}
    {{--                        <li>--}}
    {{--                            <a href="https://www.instagram.com/techfest_iitbombay/"> <span class="ion-social-instagram-outline"></span> </a>--}}
    {{--                        </li>--}}
    {{--                        <li>--}}
    {{--                            <a href="https://in.pinterest.com/techfestiitbombay/"> <span class="ion-social-pinterest"></span> </a>--}}
    {{--                        </li>--}}
    {{--                    </ul>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
    <nav class="nk-navbar nk-navbar-top nk-navbar-sticky nk-navbar-transparent nk-navbar-autohide">
        <div class="container">
            <div class="nk-nav-table">
                <a href="http://techfest.org/gamersleague/" class="nk-nav-logo" style="white-space: nowrap;"> <img src="http://techfest.org/gamersleague/images/gl.png" style="height:60px" alt="Gamersleague"> </a>
                <ul class="nk-nav nk-nav-right hidden-md-down" data-nav-mobile="#nk-nav-mobile">
{{--                    <li style="text-align: center;">--}}
{{--                        <p style="margin: 0px">Title Sponsor</p>--}}
{{--                        <a target="_blank" href="https://www.oneplus.in/" class="nk-nav-logo" style="white-space: nowrap;">--}}
{{--                            <img src="http://techfest.org/gamersleague/images/oneplus.png" style="height:60px; transform: scale(1.4)" alt="oneplus">--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li style="text-align: center;">--}}
{{--                        <p style="margin: 0px"> Server partner</p>--}}
{{--                        <a target="_blank" href="https://www.sostronk.com/welcome" class="nk-nav-logo" style="white-space: nowrap;">--}}
{{--                            <img src="http://techfest.org/gamersleague/images/Sostronk Logo white.png" style="height:60px;  transform: scale(0.85)" alt="Sostronk">--}}
{{--                        </a>--}}
{{--                    </li>--}}
                    <li style="text-align: center;">
                        <p style="margin: 0px">Network partner </p>
                        <a target="_blank" href="https://www.tp-link.com/in/" class="nk-nav-logo" style="white-space: nowrap;">
                            <img src="http://techfest.org/gamersleague/images/TP-Link OG logo.png" style="height:60px" alt="TPLink">
                        </a>
                    </li>
                    <li> <a href="http://techfest.org/gamersleague/"> Home</a> </li>
                    <li> <a href="{{route('csgo')}}"> CS GO </a></li>
{{--                    <li> <a href="{{route('pubg')}}"> PUBG </a></li>--}}
                    {{--                    <li> <a href="{{route('dota')}}"> DOTA 2 </a></li>--}}
                    <li class=" nk-mega-item nk-drop-item">
                        <a href="#">Contact Us</a>
                        <div class="dropdown">
                            <div class="bg-image" style="background-image: url('http://techfest.org/gamersleague/assets/images/bg-menu.jpg')"></div>
                            <ul>
                                <li>
                                    <ul>
                                        <li class=""><a href="mailto:gamersleague@techfest.org">prateek@techfest.org</a></li>
                                        <li class=""><a href="tel:+919460313067">+91 704 540 9458</a></li>
                                    </ul>

                                </li>
                            </ul>
                        </div>
                    </li>

                </ul>
                <ul class="nk-nav nk-nav-right nk-nav-icons">
                    <li>
                        <div>
                            <ul class="nk-nav nk-nav-right nk-nav-icons">
                                <li class="single-icon hidden-lg-up">
                                    <a href="#" class="no-link-effect" data-nav-toggle="#nk-nav-mobile"> <span class="nk-icon-burger"> <span class="nk-t-1"></span> <span class="nk-t-2"></span> <span class="nk-t-3"></span> </span></a>
                                </li>
                                @if(isset($current))
                                    <li class="single-icon">
                                        <a href="#" class="no-link-effect" data-nav-toggle="#nk-side"> <span class="nk-icon-burger"> <span class="nk-t-1"></span> <span class="nk-t-2"></span> <span class="nk-t-3"></span> </span></a>
                                    </li>
                                @else
                                    {{--                                    <li class="single-icon">--}}
                                    {{--                                        <a href="{{route('redirector')}}?link={{urlencode(url()->current())}}" class="no-link-effect"> <span class="nk-icon-burger"> <span class="nk-t-1"></span> <span class="nk-t-2"></span> <span class="nk-t-3"></span> </span>--}}
                                    {{--                                        </a>--}}
                                    {{--                                    </li>--}}
                                @endif
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<nav class="nk-navbar nk-navbar-side nk-navbar-right-side nk-navbar-lg nk-navbar-align-center nk-navbar-overlay-content" id="nk-side">
    <div class="nk-navbar-bg">
        <div class="bg-image" style="background:#000"></div>
    </div>
    @if(isset($current))
        <div class="nano">
            <div class="nano-content">
                <div class="nk-nav-table">
                    <div class="nk-nav-row">
                        <a href="{{$current['profileurl']}}" target="_blank" class="nk-nav-logo">
                            <img src="{!! $current['avatarfull'] !!}" alt="" width="150">
                        </a>
                    </div>
                    <div class="nk-nav-row nk-nav-row-full nk-nav-row-center">
                        <ul class="nk-nav" style="vertical-align: unset">
                            <li class=" "> <a href="{{$current['profileurl']}}" target="_blank">{{$current['personaname']}}</a> </li>
                            <li><a href="{{route('csgo')}}">CSGO</a></li>
{{--                            <li><a href="{{route('pubg')}}">PUBG</a></li>--}}
                            {{--                            <li><a href="{{route('dota')}}">DOTA 2</a></li>--}}
                            <li class="text-danger"> <a href="http://techfest.org/gamersleague/logout" class="text-danger"> Logout</a> </li>
                        </ul>
                    </div>
                    <div class="nk-nav-row">
                        <div class="nk-nav-footer"> &copy; 2019 Techfest IIT Bombay. All Rights Reserved. </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</nav>
<div id="nk-nav-mobile" class="nk-navbar nk-navbar-side nk-navbar-left-side nk-navbar-overlay-content hidden-lg-up">
    <div class="nano">
        <div class="nano-content">
            <a href="/" class="nk-nav-logo"> <img src="http://techfest.org/2019/tf_date.png" alt="" style="width: 100%"> </a>
            <div class="nk-navbar-mobile-content">
                <ul class="nk-nav"> </ul>
            </div>
        </div>
    </div>
</div>