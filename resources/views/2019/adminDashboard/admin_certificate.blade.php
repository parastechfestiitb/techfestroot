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
                                        <th class="th-sm">Certificate ID</th>
                                        <th class="th-sm">Name</th>
                                        <th class="th-sm">Email</th>
                                        <th class="th-sm">Certificate</th>
                                        <th class="th-sm">Certificate Url</th>
                                        <th class="th-sm">Inserted by</th>
                                        <th class="th-sm">Downloaded</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($eligible_user_for_certi as $i)
                                        <tr>
                                            <td class="th-sm">{{$i->id}}</td>
                                            <td class="th-sm">{{$i->name}}</td>
                                            <td class="th-sm">{{$i->email}}</td>
                                            <?php
                                            $Certificate_row = DB::table('certificates')->where(['id'=>$i->certificate_id])->first();
                                            $random_text = "K7lxDTZLUvAFm6noUG7O";
                                            $url = md5($i->id.$random_text);
                                            ?>
                                            <td class="th-sm">{{$Certificate_row->name}}</td>
                                            <td class="th-sm"><a target="_blank" href="http://techfest.org/2019/certificate/{{$i->id}}/{{$url}}">http://techfest.org/2019/certificate/{{$i->id}}/{{$url}}</a></td>
                                            <td class="th-sm">{{$i->admin}}</td>
                                            <td class="th-sm">{{$i->name_update}}</td>

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