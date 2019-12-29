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
                    <h1 style="display: inline">{{$competition}}</h1>
                    <button id="btnExport" onclick="javascript:xport.toCSV('Untitled');" style="border: 1px solid;border-radius: 2px;"> Export to CSV</button>

                    <?php
                    $sn = 1;
                    $_team_id = "_team_id";
                    $team = $competition.$_team_id;

                    $_team = "_team";
                    $competition_team = $competition.$_team;

                    $_team_email = "_team_email";
                    $competition_team_email = $competition.$_team_email;

                    if( $competition == "cozmo"){$coeff = "CZ-";}
                    if( $competition == "wcozmo"){$coeff = "WCZ-";}
                    if( $competition == "meshmerize"){$coeff = "MH-";}
                    if( $competition == "wmeshmerize"){$coeff = "WMH-";}
                    if( $competition == "micromouse"){$coeff = "CZ-";}
                    if( $competition == "codecode"){$coeff = "CO-";}
                    if( $competition == "wcodecode"){$coeff = "WCO-";}
                    if( $competition == "tso"){$coeff = "TO-";}
                    if( $competition == "earthmatters"){$coeff = "EM-";}
                    if( $competition == "metamorphosis"){$coeff = "CM-";}
                    if( $competition == "innovationeering"){$coeff = "IN-";}
                    if( $competition == "indiachallenge"){$coeff = "IC-";}
                    if( $competition == "rowboatics"){$coeff = "RB-";}
                    if( $competition == "oprahat"){$coeff = "OP-";}
                    if( $competition == "bugbounty"){$coeff = "BB-";}
                    if( $competition == "fintech"){$coeff = "FT-";}
                    if( $competition == "wpc"){$coeff = "WPC-";}
                    if( $competition == "craneomania"){$coeff = "CR-";}
                    if( $competition == "boeing"){$coeff = "BA-";}
                    if( $competition == "gopynq"){$coeff = "GP-";}
                    if( $competition == "dronechallenge"){$coeff = "DR-";}
                    if( $competition == "inspire"){$coeff = "WC-";}
                    if( $competition == "makerthon"){$coeff = "PR-";}
                    if( $competition == "transportation"){$coeff = "UT-";}
                    if( $competition == "codebuzz"){$coeff = "CB-";}

                    $total_reg = count($big_data);

                    $cozmo_4_team_count = 0;
                    $ar_0 = 0;
                    $ar_1 = 0;
                    $ar_2 = 0;
                    $ar_3 = 0;
                    $ar_4 = 0;
                    $arr_0 = [];
                    $arr_1 = [];
                    $arr_2 = [];
                    $arr_3 = [];
                    $arr_4 = [];
                    //                    $zonal = ["Mumbai","Lucknow","Jaipur"];
                    $zonal_number = 0;
                    //                    foreach ($zonal as $zonal){
                    for($r=0; $r < $total_reg; $r++){
                        $competition_team_email = $big_data[$r]->$competition_team;
                        if(!empty($competition_team_email)){
                            $team_var_count = DB::table('tf_reg')->where([$competition_team => $competition_team_email])->count();
//                            print $team_var_count;
//                            if($team_var_count == 0){
////                                $arr_0[$ar_0] = $competition_team_email;
//                                $ar_0 = $ar_0 + 1;
//                            }
                            if($team_var_count == 1){
//                                $arr_1[$ar_1] = $competition_team_email;
                                $ar_1 = $ar_1 + 1;
                            }
                            if($team_var_count == 2){
//                                $arr_2[$ar_2] = $competition_team_email;
                                $ar_2 = $ar_2 + 1;
                            }
                            if($team_var_count == 3){
//                                $arr_3[$ar_3] = $competition_team_email;
                                $ar_3 = $ar_3 + 1;
                            }
                            if($team_var_count == 4){
//                                $arr_4[$ar_4] = $competition_team_email;
                                $ar_4 = $ar_4 + 1;
                            }

                        }
                        if(empty($competition_team_email)){
                            $ar_0 = $ar_0 + 1;
                        }
//                    }
                    //                        $zonal_count[$zonal_number] = [count($arr_1), count($arr_2)/2, count($arr_3)/3, count($arr_4)/4, (count($arr_1) + count($arr_2)/2 + count($arr_3)/3 + count($arr_4)/4)];
                    //                        $zonal_number = $zonal_number +1;
                    //                        $arr_1 = [];
                    //                        $arr_2 = [];
                    //                        $arr_3 = [];
                    //                        $arr_4 = [];
                                        }
                    //                    $sum = $total_competition_1_team + $total_competition_2_team + $total_competition_3_team + $total_competition_4_team;

                    ?>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive table--no-card m-b-40">
                                <table class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th class="th-sm">Teams</th>
                                        <th class="th-sm">Count</th>
                                    {{--                                        <th class="th-sm">{{$zonal}}</th>--}}
                                    {{--                                        <th class="th-sm">Lucknow</th>--}}
                                    {{--                                        <th class="th-sm">Jaipur</th>--}}
                                    {{--                                        <th class="th-sm">Kolkata</th>--}}
                                    {{--                                        <th class="th-sm">Bhopal</th>--}}
                                    {{--                                        <th class="th-sm">Banglore</th>--}}
                                    {{--                                        <th class="th-sm">Madagascar</th>--}}
                                    {{--                                        <th class="th-sm">Kathmandu</th>--}}
                                    {{--                                        <th class="th-sm">Sum</th>--}}

                                    {{--                                    </tr>--}}
                                    {{--                                    </thead>--}}
                                    <tbody>
                                    {{--                                    @for($team_var_int = 0; $team_var_int < 5; $team_var_int ++ )--}}
                                    <tr>
{{--                                                                                <td>Team of {{$team_var_int +1}}</td>--}}
                                        <td>Team Of 0</td>
                                        <td>{{$ar_0}}</td>
                                    </tr>
                                    <tr>
                                        {{--                                        <td>Team of {{$team_var_int +1}}</td>--}}
                                        <td>Team Of 1</td>
                                        <td>{{$ar_1}}</td>
                                    </tr>
                                    <tr>
                                        <td>Team Of 2</td>
                                        <td>{{$ar_2/2}}</td>
                                    </tr>
                                    <tr>
                                        <td>Team Of 3</td>
                                        <td>{{$ar_3/3}}</td>
                                    </tr>
                                    <tr>
                                        <td>Team Of 4</td>
                                        <td>{{$ar_4/4}}</td>
                                        {{--                                        <td>{{$zonal_count[0][$team_var_int]}}</td>--}}
                                        {{--                                        <td>{{$zonal_count[1][$team_var_int]}}</td>--}}
                                        {{--                                        <td>{{$zonal_count[2][$team_var_int]}}</td>--}}
                                        {{--                                        <td>{{$zonal_count[3][$team_var_int]}}</td>--}}
                                        {{--                                        <td>{{$zonal_count[4][$team_var_int]}}</td>--}}
                                        {{--                                        <td>{{$zonal_count[5][$team_var_int]}}</td>--}}
                                        {{--                                        <td>{{$zonal_count[6][$team_var_int]}}</td>--}}
                                        {{--                                        <td>{{$zonal_count[7][$team_var_int]}}</td>--}}
                                        {{--                                        <td>{{$zonal_count[8][0]}}</td>--}}
                                    </tr>
                                    {{--                                    @endfor--}}
                                    </tbody>
                                </table>
                                <table id="Untitled" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">



                                    Teams formed in respective city<br>

                                    {{$total_reg}}<br>
                                    <thead>
                                    <tr>
                                        <th class="th-sm">SN.</th>
                                        <th class="th-sm">Name</th>
                                        <th class="th-sm">Email</th>
                                        <th class="th-sm">Number</th>
                                        <th class="th-sm">Team</th>
                                        <th class="th-sm">Team Leader Name</th>
                                        <th class="th-sm">Team Leader email ID</th>
                                        <th class="th-sm">Institute Name</th>
                                        <th class="th-sm">Institute address</th>
                                        <th class="th-sm">City</th>
                                        {{--                                        <th class="th-sm">Zonal</th>--}}
                                        <th class="th-sm">Country</th>
                                        <th class="th-sm">Year</th>
                                        <th class="th-sm">Gender</th>
                                        <th class="th-sm">Residential Address</th>
                                        {{--                                        <th class="th-sm">Residential Pincode</th>--}}
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($big_data as $i)
                                        @if($i->$competition >= 1 or !empty($i->$competition_team) )
                                            <tr>
                                                <td>{{$sn}}</td>
                                                <td>{{$i->name}}</td>
                                                <td>{{$i->email}}</td>
                                                <td>{{$i->number}}</td>
                                                <?php
                                                if(!empty($i->$competition_team)){
                                                    $team_leader_row_ = DB::table('tf_reg')->where(['email' => $i->$competition_team])->first();//get team leader row
                                                    $team_leader_team_id = $team_leader_row_->$team;
                                                    $team_leader_name = $team_leader_row_->name;
                                                }
                                                else{
                                                    $team_leader_name = "Team Not Formed Yet";
                                                    $team_leader_team_id = "000000";
                                                }
                                                ?>
                                                <td>{{$coeff}} {{$team_leader_team_id}}</td>

                                                <td>{{$team_leader_name}}</td>
                                                <td>{{$i->$competition_team}}</td>
                                                <td>{{$i->institute_name}}</td>
                                                <td>{{$i->institute_address}}</td>
                                                <td>{{$i->	zonal}}</td>
                                                <td>{{$i->country}}</td>
                                                <td>{{$i->year_of_study}}</td>
                                                <td>{{$i->gender}}</td>
                                                <td>{{$i->residential_address}}</td>
                                                {{--                                                <td>{{$i->residential_pincode}}</td>--}}
                                            </tr>
                                            <?php
                                            $sn = $sn + 1;
                                            ?>
                                        @endif
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