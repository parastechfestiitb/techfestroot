<!DOCTYPE html>
<html lang="en">

<head>
    @include('2019.adminDashboard.head')

</head>


<body class="animsition">
<div class="page-wrapper">
    <!-- MENU SIDEBAR-->
@include('2019.adminDashboard.sidepanel_layout')

<!-- END MENU SIDEBAR-->

    <!-- PAGE CONTAINER-->
    <div class="page-container">
        <!-- MAIN CONTENT-->
        <div class="main-content" style="padding-top: 0px">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive table--no-card m-b-40">
                                <button id="btnExport" onclick="javascript:xport.toCSV('Untitled');"> Export to CSV</button>
                                <table id="Untitled" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th class="th-sm">ID</th>
                                        <th class="th-sm">Rank</th>
                                        <th class="th-sm">Name</th>
                                        <th class="th-sm">Contact no.</th>
                                        <th class="th-sm">Email ID</th>
                                        <th class="th-sm">Pincode</th>
                                        <th class="th-sm">Points</th>
                                        <th class="th-sm">No. of referral</th>
                                        <th class="th-sm">Loyalty Points</th>
                                        <th class="th-sm">Verification Button(still working)</th>
                                        <th class="th-sm">referred by</th>
                                        <th class="th-sm">College</th>
                                        <th class="th-sm">Address</th>
                                        <th class="th-sm">No. of logins</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $i = 0;
                                    ?>
                                    @foreach($t as $t1)

                                        <?php
                                        $i ++;
                                        ?>
                                        <tr>
                                            <td>{{$t1->ca_id}}</td>
                                            <td>{{$i}}</td>
                                            <td>{{$t1->name}}</td>
                                            <td>{{$t1->number}}</td>
                                            <td>{{$t1->email}}</td>
                                            <td>{{$t1->pincode}}</td>
                                            <td>{{$t1->points}}</td>
                                            <td>{{$t1->no_of_referral}}</td>
                                            <td>{{$t1->loyalty_points}}</td>
                                            <td><a href="https://techfest.org/penaltymail/{{$t1->email}}">Verify</a></td>
                                            <td>{{$t1->referred_by}}</td>
                                            <td>{{$t1->college}}</td>
                                            <td>{{$t1->address}}</td>
                                            <td>{{$t1->no_of_login}}</td>

                                        </tr>
                                    @endforeach
                                    </tbody>

                                </table>
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

@include('2019.adminDashboard.foot')

</body>
</html>

</html>
