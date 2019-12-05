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
]                                        <th class="th-sm">exhibit_name </th>
                                        <th class="th-sm">institute_name  </th>
                                        <th class="th-sm"> 	website  </th>
                                        <th class="th-sm">address  </th>
                                        <th class="th-sm">pincode  </th>
                                        <th class="th-sm">country  </th>
                                        <th class="th-sm">name  </th>
                                        <th class="th-sm">email </th>
                                        <th class="th-sm">number </th>
                                        <th class="th-sm">number_of_exhibitor </th>
                                        <th class="th-sm">exhibit_name </th>
                                        <th class="th-sm">area  </th>
                                        <th class="th-sm">any_special  </th>
                                        <th class="th-sm">needed_services </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($big_data as $i)
                                        <?php
                                        $a = 190000;
                                        $b = $i->id;
                                        $team_id = $a + $b;
                                        ?>
                                        <tr>
                                            <td class="th-sm">{{$i->exhibit_name }}</td>
                                            <td class="th-sm">{{$i->institute_name  }}</td>
                                            <td class="th-sm">{{$i-> 	website  }}</td>
                                            <td class="th-sm">{{$i->address  }}</td>
                                            <td class="th-sm">{{$i->pincode  }}</td>
                                            <td class="th-sm">{{$i->country  }}</td>
                                            <td class="th-sm">{{$i->name  }}</td>
                                            <td class="th-sm">{{$i->email }}</td>
                                            <td class="th-sm">{{$i->number }}</td>
                                            <td class="th-sm">{{$i->number_of_exhibitor }}</td>
                                            <td class="th-sm">{{$i->exhibit_name }}</td>
                                            <td class="th-sm">{{$i->area  }}</td>
                                            <td class="th-sm">{{$i->any_special  }}</td>
                                            <td class="th-sm">{{$i->needed_services }}</td>
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