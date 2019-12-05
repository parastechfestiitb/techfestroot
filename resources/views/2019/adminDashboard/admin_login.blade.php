<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Title Page-->
    <title>Admin Dashboard</title>
    <!-- Fontfaces CSS-->
    <link href="/2019/adminDashboard/css/font-face.css" rel="stylesheet" media="all">
    <link href="/2019/adminDashboard/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="/2019/adminDashboard/vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="/2019/adminDashboard/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <!-- Bootstrap CSS-->
    <link href="/2019/adminDashboard/vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">
    <!-- Vendor CSS-->
    <link href="/2019/adminDashboard/vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="/2019/adminDashboard/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="/2019/adminDashboard/vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="/2019/adminDashboard/vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="/2019/adminDashboard/vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="/2019/adminDashboard/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="/2019/adminDashboard/vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">
    <!-- Main CSS-->
    <link href="/2019/adminDashboard/css/theme.css" rel="stylesheet" media="all">
    <script src="/2019/ca/js/excellentexport.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pixi.js/4.5.1/pixi.min.js"></script>

{{--    <script src="/2019/adminDashboard/js/mouse-trail.js"></script>--}}

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-81222017-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-81222017-1');
    </script>


    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="/2019/MDB-Free_4.8.8/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="/2019/MDB-Free_4.8.8/css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="/2019/MDB-Free_4.8.8/css/style.css" rel="stylesheet">
    <!-- MDBootstrap Datatables  -->
    <link href="/2019/MDB-Free_4.8.8/css/addons/datatables.min.css" rel="stylesheet">
</head>


<body class="animsition">
<div class="page-wrapper">
    <!-- MENU SIDEBAR-->
    <aside class="menu-sidebar d-none d-lg-block">
        <div class="logo">
            <a href="#">
                <img src="/2019/adminDashboard/images/icon/logo.png" alt="Cool Admin" />
            </a>
        </div>
        <div class="menu-sidebar__content js-scrollbar1">
            <nav class="navbar-sidebar">
                <ul class="list-unstyled navbar__list">

                </ul>
            </nav>
        </div>
    </aside>
    <!-- END MENU SIDEBAR-->

    <!-- PAGE CONTAINER-->
    <div class="page-container">
        <!-- HEADER DESKTOP-->
        <header class="header-desktop">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="header-wrap">
                        <form class="form-header" action="" method="POST">
                            <!--                                <input class="au-input au-input&#45;&#45;xl" type="text" name="search" placeholder="Search for datas &amp; reports..." />-->
                            <!--                                <button class="au-btn&#45;&#45;submit" type="submit">-->
                            <!--                                    <i class="zmdi zmdi-search"></i>-->
                            <!--                                </button>-->
                        </form>
                        <div class="header-button">
                            <div class="noti-wrap">
                                <div class="noti__item js-item-menu">
                                    <i class="zmdi zmdi-comment-more"></i>
                                    <span class="quantity">1</span>
                                    <div class="mess-dropdown js-dropdown">
                                        <div class="mess__title">
                                            <p>You have 2 news message</p>
                                        </div>
                                        <div class="mess__item">
                                            <div class="image img-cir img-40">
                                                <img src="images/icon/avatar-06.jpg" alt="Michelle Moreno" />
                                            </div>
                                            <div class="content">
                                                <h6>Michelle Moreno</h6>
                                                <p>Have sent a photo</p>
                                                <span class="time">3 min ago</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="account-wrap">
                                <div class="account-item clearfix js-item-menu">
                                    <div class="image">
                                        <img src="/2019/adminDashboard/images/icon/avatar-01.jpg"  />
                                    </div>
                                    <div class="content">
                                        <a class="js-acc-btn" href="#"></a>
                                    </div>
                                    <div class="account-dropdown js-dropdown">
                                        <div class="info clearfix">
                                            <div class="image">
                                                <a href="#">
                                                    <img src="/2019/adminDashboard/images/icon/avatar-01.jpg" alt="" />
                                                </a>
                                            </div>
                                            <div class="content">
                                                <h5 class="name">
                                                    <a href="#"></a>
                                                </h5>
                                                <span class="email"></span>
                                            </div>
                                        </div>
                                        {{--                                        <div class="account-dropdown__body">--}}
                                        {{--                                            <div class="account-dropdown__item">--}}
                                        {{--                                                <a href="#">--}}
                                        {{--                                                    <i class="zmdi zmdi-account"></i>Account</a>--}}
                                        {{--                                            </div>--}}
                                        {{--                                            <div class="account-dropdown__item">--}}
                                        {{--                                                <a href="#">--}}
                                        {{--                                                    <i class="zmdi zmdi-settings"></i>Setting</a>--}}
                                        {{--                                            </div>--}}
                                        {{--                                            <div class="account-dropdown__item">--}}
                                        {{--                                                <a href="#">--}}
                                        {{--                                                    <i class="zmdi zmdi-money-box"></i>Billing</a>--}}
                                        {{--                                            </div>--}}
                                        {{--                                        </div>--}}
                                        <div class="account-dropdown__footer">
                                            <a href="https://techfest.org/logout">
                                                <i class="zmdi zmdi-power"></i>Logout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- HEADER DESKTOP-->

        <!-- MAIN CONTENT-->
        <div class="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <img src="/2019/ca/ca_images_upload/google.svg" id="signinButton" style="max-height: 37px ">

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive table--no-card m-b-40">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MAIN CONTENT-->
        <!-- END PAGE CONTAINER-->
    </div>

</div>
<form action="" method="post" id="h-form" class="d-none">
    {{csrf_field()}}
    <input type="hidden" name ="code" id="name2" style="background-color: blue">

</form>

<!-- Jquery JS-->
<script src="/2019/adminDashboard/vendor/jquery-3.2.1.min.js"></script>
<!-- Bootstrap JS-->
<script src="/2019/adminDashboard/vendor/bootstrap-4.1/popper.min.js"></script>
<script src="/2019/adminDashboard/vendor/bootstrap-4.1/bootstrap.min.js"></script>
<!-- Vendor JS       -->
<script src="/2019/adminDashboard/vendor/slick/slick.min.js"></script>
<script src="/2019/adminDashboard/vendor/wow/wow.min.js"></script>
<script src="/2019/adminDashboard/vendor/animsition/animsition.min.js"></script>
<script src="/2019/adminDashboard/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
<script src="/2019/adminDashboard/vendor/counter-up/jquery.waypoints.min.js"></script>
<script src="/2019/adminDashboard/vendor/counter-up/jquery.counterup.min.js"></script>
<script src="/2019/adminDashboard/vendor/circle-progress/circle-progress.min.js"></script>
<script src="/2019/adminDashboard/vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="/2019/adminDashboard/vendor/chartjs/Chart.bundle.min.js"></script>
<script src="/2019/adminDashboard/vendor/select2/select2.min.js"></script>
<!-- Main JS-->
<script src="/2019/adminDashboard/js/main.js"></script>
<script>
    var xport = {
        _fallbacktoCSV: true,
        toXLS: function(tableId, filename) {
            this._filename = (typeof filename == 'undefined') ? tableId : filename;

            //var ieVersion = this._getMsieVersion();
            //Fallback to CSV for IE & Edge
            if ((this._getMsieVersion() || this._isFirefox()) && this._fallbacktoCSV) {
                return this.toCSV(tableId);
            } else if (this._getMsieVersion() || this._isFirefox()) {
                alert("Not supported browser");
            }

            //Other Browser can download xls
            var htmltable = document.getElementById(tableId);
            var html = htmltable.outerHTML;

            this._downloadAnchor("data:application/vnd.ms-excel" + encodeURIComponent(html), 'xls');
        },
        toCSV: function(tableId, filename) {
            this._filename = (typeof filename === 'undefined') ? tableId : filename;
            // Generate our CSV string from out HTML Table
            var csv = this._tableToCSV(document.getElementById(tableId));
            // Create a CSV Blob
            var blob = new Blob([csv], { type: "text/csv" });

            // Determine which approach to take for the download
            if (navigator.msSaveOrOpenBlob) {
                // Works for Internet Explorer and Microsoft Edge
                navigator.msSaveOrOpenBlob(blob, this.filename + ".csv");
            } else {
                this._downloadAnchor(URL.createObjectURL(blob), 'csv');
            }
        },
        _getMsieVersion: function() {
            var ua = window.navigator.userAgent;

            var msie = ua.indexOf("MSIE ");
            if (msie > 0) {
                // IE 10 or older => return version number
                return parseInt(ua.substring(msie + 5, ua.indexOf(".", msie)), 10);
            }

            var trident = ua.indexOf("Trident/");
            if (trident > 0) {
                // IE 11 => return version number
                var rv = ua.indexOf("rv:");
                return parseInt(ua.substring(rv + 3, ua.indexOf(".", rv)), 10);
            }

            var edge = ua.indexOf("Edge/");
            if (edge > 0) {
                // Edge (IE 12+) => return version number
                return parseInt(ua.substring(edge + 5, ua.indexOf(".", edge)), 10);
            }

            // other browser
            return false;
        },
        _isFirefox: function(){
            if (navigator.userAgent.indexOf("Firefox") > 0) {
                return 1;
            }

            return 0;
        },
        _downloadAnchor: function(content, ext) {
            var anchor = document.createElement("a");
            anchor.style = "display:none !important";
            anchor.id = "downloadanchor";
            document.body.appendChild(anchor);

            // If the [download] attribute is supported, try to use it

            if ("download" in anchor) {
                anchor.download = this._filename + "." + ext;
            }
            anchor.href = content;
            anchor.click();
            anchor.remove();
        },
        _tableToCSV: function(table) {
            // We'll be co-opting `slice` to create arrays
            var slice = Array.prototype.slice;

            return slice
                .call(table.rows)
                .map(function(row) {
                    return slice
                        .call(row.cells)
                        .map(function(cell) {
                            return '"t"'.replace("t", cell.textContent);
                        })
                        .join(",");
                })
                .join("\r\n");
        }
    };

</script>


<!-- SCRIPTS -->
<!-- JQuery -->
<script type="text/javascript" src="/2019/MDB-Free_4.8.8/js/jquery-3.4.1.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="/2019/MDB-Free_4.8.8/js/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="/2019/MDB-Free_4.8.8/js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="/2019/MDB-Free_4.8.8/js/mdb.min.js"></script>
<!-- MDBootstrap Datatables  -->
<script type="text/javascript" src="/2019/MDB-Free_4.8.8/js/addons/datatables.js"></script>
<script>
    $(document).ready(function () {
        $('#compi').DataTable();
        $('.dataTables_length').addClass('bs-select');
    });
</script>
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
<!-- end document-->