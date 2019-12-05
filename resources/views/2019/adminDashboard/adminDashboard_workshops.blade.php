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
                                        <th class="th-sm">Workshop</th>
                                        <th class="th-sm">Team ID</th>
                                        <th class="th-sm">Payment</th>
                                        <th class="th-sm">Ticket Id</th>
                                        <th class="th-sm">Name</th>
                                        <th class="th-sm">Email</th>
                                        <th class="th-sm">Number</th>
                                        <th class="th-sm">Leader</th>
                                        <th class="th-sm">college</th>
                                        <th class="th-sm">Gender</th>
                                        <th class="th-sm">Address</th>
                                        <th class="th-sm">city</th>
                                        <th class="th-sm">Pincode</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($workshops_participants_data as $i)
                                        <?php

                                        $workshops_info = DB::table('tf_workshops_2019')->where(['link'=>$i->workshop])->get()->first();
                                        $leader_row = DB::table('tf_workshops_participants_2019')->where(['workshop'=>$i->workshop, 'registered_by'=>$i->registered_by])->get()->first();
//                                        $payment_data = DB::table('payment_workshop_19')->where(['subProgramName' => $i->workshop])->get();
                                        $payment_row = DB::table('payment_log_2019')->where(['email'=>$i->registered_by, 'subProgramName'=>$workshops_info->name])->get()->first();

                                        ?>
                                        <tr>
                                            <td class="th-sm">{{$i->workshop}}</td>
                                            <td class="th-sm">{{$workshops_info->coeff}}{{$leader_row->id}}</td>
                                            @if(!empty($payment_row))
                                            <td class="th-sm">Paid</td>
                                            <td class="th-sm">{{$payment_row->ticketId}}</td>
                                            @endif

                                            @if(empty($payment_row))
                                                <td class="th-sm"></td>
                                                <td class="th-sm"></td>
                                            @endif
                                            <td class="th-sm">{{$i->name}}</td>
                                            <td class="th-sm">{{$i->email}}</td>
                                            <td class="th-sm">{{$i->number}}</td>
                                            <td class="th-sm">{{$i->registered_by}}</td>
                                            <td class="th-sm">{{$i->college}}</td>
                                            <td class="th-sm">{{$i->gender}}</td>
                                            <td class="th-sm">{{$i->address}}</td>
                                            <td class="th-sm">{{$i->city}}</td>
                                            <td class="th-sm">{{$i->pincode}}</td>
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