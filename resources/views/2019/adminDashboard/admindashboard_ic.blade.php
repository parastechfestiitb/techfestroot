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
                    <button id="btnExport" onclick="javascript:xport.toCSV('Untitled');"> Export to CSV</button>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive table--no-card m-b-40">
                                <table id="Untitled" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th class="th-sm">Name</th>
                                        <th class="th-sm">Roll Number</th>
                                        <th class="th-sm">Email</th>
                                        <th class="th-sm">hashed_random_password</th>
                                        <th class="th-sm">number</th>
                                        <th class="th-sm">dob</th>
                                        <th class="th-sm">school</th>
                                        <th class="th-sm">state</th>
                                        <th class="th-sm">address</th>
                                        <th class="th-sm">pincode</th>
                                        <th class="th-sm">class</th>
                                        <th class="th-sm">city</th>
                                        <th class="th-sm">zone</th>
                                        <th class="th-sm">zone2	</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($big_data as $i)
                                        <?php
                                        if($i->zone == "Zone 1"){
                                            $zone_coeff = "1";
                                        }
                                        if($i->zone == "Zone 2"){
                                            $zone_coeff = "2";
                                        }
                                        if($i->zone == "Zone 3"){
                                            $zone_coeff = "3";
                                        }
                                        if($i->zone == "Zone 4"){
                                            $zone_coeff = "4";
                                        }
                                        ?>
                                        <tr>
                                            {{--                                            <td class="th-sm">{{$i->category}}</td>--}}
                                            <td class="th-sm">{{$i->name}}</td>
                                            <td class="th-sm">{{$zone_coeff}}{{$i->id}}</td>
                                            <td class="th-sm">{{$i->email}}</td>
                                            <td class="th-sm">{{$i->hashed_random_password}}</td>
                                            <td class="th-sm">{{$i->number}}</td>
                                            <td class="th-sm">{{$i->dob}}</td>
                                            <td class="th-sm">{{$i->school}}</td>
                                            <td class="th-sm">{{$i->state}}</td>
                                            <td class="th-sm">{{$i->address}}</td>
                                            <td class="th-sm">{{$i->pincode}}</td>
                                            <td class="th-sm">{{$i->class}}</td>
                                            <td class="th-sm">{{$i->city}}</td>
                                            <td class="th-sm">{{$i->zone}}</td>
                                            <td class="th-sm">{{$i->zone2	}}</td>

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
<!-- end document-->