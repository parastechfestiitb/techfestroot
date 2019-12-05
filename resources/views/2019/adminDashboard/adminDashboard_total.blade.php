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
                                        <th class="th-sm">SN.</th>
                                        <th class="th-sm">Name</th>
                                        <th class="th-sm">Email</th>
                                        <th class="th-sm">Number</th>
                                        <th class="th-sm">Institute Name</th>
                                        <th class="th-sm">Institute address</th>
                                        <th class="th-sm">City</th>
                                        <th class="th-sm">Country</th>
                                        <th class="th-sm">Year</th>
                                        <th class="th-sm">Gender</th>
                                        <th class="th-sm">Residential Address</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $sn = 1;
                                    ?>
                                    @foreach($big_data as $i)
                                        <tr>
                                            <td>{{$sn}}</td>
                                            <td>{{$i->name}}</td>
                                            <td>{{$i->email}}</td>
                                            <td>{{$i->number}}</td>
                                            <td>{{$i->institute_name}}</td>
                                            <td>{{$i->institute_address}}</td>
                                            <td>{{$i->zonal}}</td>
                                            <td>{{$i->country}}</td>
                                            <td>{{$i->year_of_study}}</td>
                                            <td>{{$i->gender}}</td>
                                            <td>{{$i->residential_address}}</td>
                                        </tr>
                                        <?php
                                        $sn = $sn + 1;
                                        ?>
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
