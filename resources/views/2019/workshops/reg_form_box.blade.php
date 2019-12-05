<div class="col-md-1"></div>
<div class="col-md-10">
    <div class="wizard-container">
        <div class="card wizard-card" data-color="purple" id="wizard" style="min-height: 73vh;">
            <div class="wizard-header">
                <div class="row">
                    <div class="col-md-6">
                        <a href="{{ url()->previous() }}"><i class="fas fa-arrow-left" style="float: left"></i></a>
                        <h3 class="wizard-title" style="display: inline">{{$workshops_info->name}}
                            {{--                            <img src="{{$workshops_info->image}}" alt="" style="height: 1em; border-radius: 5%;">--}}
                        </h3>

                        <h5>{!! $workshops_info->description !!}</h5>
                    </div>
                    <div class="col-md-4">
                        @if(!empty(session()->get('user')->email))
                            {{--        Hi {{session()->get('user')->name}}--}}
                            <?php
                            $user_row = DB::table('tf_reg')->where(['email'=> session()->get('user')->email,])->first();
                            $workshop_link = $workshops_info->link;
                            if($user_row->$workshop_link > 0){
                                $team_members = DB::table('tf_workshops_participants_2019')->where(['registered_by'=>session()->get('user')->email, 'workshop'=>$workshops_info->link])->get();
                                $payment_row = DB::table('payment_log_2019')->where(['email'=>session()->get('user')->email, 'subProgramName'=>$workshops_info->name])->get()->first();
                            }
                            ?>
                            @if(!empty($team_members))
                                @if(!empty($team_members[0]))
                                    <br>You are already registered
                                    <br>Team ID-{{$workshops_info->coeff}}-{{$team_members[0]->id}}
                                    @if(!empty($payment_row->ticketId))
                                        <br>Payment Done
                                        <br>Ticket ID-{{$payment_row->ticketId}}
                                    @endif
                                    @if(empty($payment_row->ticketId))
                                        {{$payment_row}}
                                        <br>Payment Not Done Yet
                                        <button><a href="{{$workshops_info->payment_link}}">Pay Now</a></button>
                                    @endif
                                @endif
                                @foreach($team_members as $member)
                                    @if(!empty($member->name))
                                        <br>Member - {{$member->name}}
                                    @endif
                                @endforeach
                            @endif
                            {{--        @if(empty($team_members))--}}
                            {{--            <input type='button' class='btn btn-fill btn-primary btn-wd' id="signinButton" name='next' value='Register' />--}}
                            {{--        @endif--}}
                        @endif
                        @if(empty(session()->get('user')->email))
                            {{--                                    <span class="d-block d-lg-none"><img src="/2019/ca/ca_images_upload/google.svg" id="signinButton" style="max-height: 37px "> </span>--}}
                            {{--                                    Please <a href="" id="signinButton">Sign</a> in to register--}}
                        @endif
                    </div>
                    <div class="col-md-2">
                        @if(empty(session()->get('user')->email))
                            <input type='button' class='btn btn-fill btn-primary btn-wd' id="signinButton" name='next' value='Register' />
                        @endif
                        @if(!empty(session()->get('user')->email))
                            <a href="/workshops_/logout" class='btn btn-fill btn-primary btn-wd'>Logout</a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="wizard-navigation">
                <ul>
                    <li><a href="#register" data-toggle="tab">Register</a></li>
                </ul>
            </div>
            <div class="tab-content" style="min-height: 33vh;">
                <div class="tab-pane" id="register">
                    @if(!empty(session()->get('user')->email))
                        <?php
                        $user_row = DB::table('tf_reg')->where(['email'=> session()->get('user')->email,])->first();
                        $workshop_link = $workshops_info->link;
                        if($user_row->$workshop_link > 0){
                            $team_members = DB::table('tf_workshops_participants_2019')->where(['registered_by'=>session()->get('user')->email, 'workshop'=>$workshops_info->link])->get();
                        }
                        ?>
                        @if(empty($team_members[0]))
                            <form action="/workshops_reg/{{$workshops_info->link}}" method="post" id="center_box_form">
                                {{ csrf_field() }}
                                Member 1 Details
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="label-floating">
                                            <label class="control-label">Name</label>
                                            <input class="form-control"  name ="name0" value="{{$user_row->name}}" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Email</label>
                                            <input type="email" class="form-control"  id="email0" name ="email0" value="{{$user_row->email}}" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Contact Number</label>
                                            <input type="number" class="form-control" name ="number0" value="{{$user_row->number}}" max="9999999999" min="1000000000" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Gender</label>
                                            <select name="gender0" class="form-control" required>
                                                <option disabled="" selected=""></option>
                                                <option value="Male"> Male </option>
                                                <option value="Female"> Female </option>
                                                <option value="Other"> Other </option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group label-floating">
                                            <label class="control-label">College</label>
                                            <input class="form-control" name ="college0" value="" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Year of study</label>
                                            <input class="form-control" name ="year0" value="" >
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Address</label>
                                            <input class="form-control" name ="address0" value="" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group label-floating">
                                            <label class="control-label">City</label>
                                            <input class="form-control" name ="city0" value="" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Pincode</label>
                                            <input class="form-control" name ="pincode0" max="999999" min="100000" value="" required>
                                        </div>
                                    </div>
                                </div>
                                <hr style="background-color: black; height: 2px">
                                @for($i = 1; $i < $workshops_info->no_of_team_member; $i++)
                                    Member {{$i+1}} Details
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="label-floating">
                                                <label class="control-label">Name</label>
                                                <input class="form-control"  name ="name{{$i}}" value="" >
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Email</label>
                                                <input type="email" class="form-control"  id="email{{$i}}"name ="email{{$i}}" value="">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Contact Number</label>
                                                <input class="form-control" max="9999999999" min="1000000000" name ="number{{$i}}" value="" >
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Gender</label>
                                                <select name="gender{{$i}}" class="form-control">
                                                    <option disabled="" selected=""></option>
                                                    <option value="Male"> Male </option>
                                                    <option value="Female"> Female </option>
                                                    <option value="Other"> Other </option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group label-floating">
                                                <label class="control-label">College</label>
                                                <input class="form-control" name ="college{{$i}}" value="" >
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Year of study</label>
                                                <input class="form-control" name ="year{{$i}}" value="" >
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Address</label>
                                                <input class="form-control" name ="address{{$i}}" value="" >
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group label-floating">
                                                <label class="control-label">City</label>
                                                <input class="form-control" name ="city{{$i}}" value="" >
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Pincode</label>
                                                <input class="form-control" name ="pincode{{$i}}" value="" >
                                            </div>
                                        </div>
                                    </div>
                                    <hr style="background-color: black; height: 2px">
                            @endfor
                        @endif
                    @endif

                </div>
            </div>
            <div class="wizard-footer">
                <div class="pull-right">
                    <input type='button' class='btn btn-next btn-fill btn-primary btn-wd' name='next' value='Next' />
                    @if(!empty(session()->get('user')->email))
                        <?php
                        $user_row = DB::table('tf_reg')->where(['email'=> session()->get('user')->email])->first();
                        $workshop_link = $workshops_info->link;
                        ?>
                        {{--                        <a href="https://www.thecollegefever.com/events/techfest-workshops-mI7ysmIWna">--}}
                        {{--                            <input type='' class='btn btn-finish btn-fill btn-primary btn-wd' name='finish' value='PayNow' />--}}
                        {{--                        </a>--}}
                        @if(!empty(session()->get('user')->email))
                            <?php
                            $user_row = DB::table('tf_reg')->where(['email'=> session()->get('user')->email,])->first();
                            $workshop_link = $workshops_info->link;
                            if($user_row->$workshop_link > 0){
                                $team_members = DB::table('tf_workshops_participants_2019')->where(['registered_by'=>session()->get('user')->email, 'workshop'=>$workshops_info->link])->get();
                            }
                            ?>
                            @if(empty($team_members[0]))
                                <input type='submit' class='btn btn-finish btn-fill btn-primary btn-wd' name='finish' value='Register' />
                            @endif
                            {{--                                @if(empty($payment))--}}
                            {{--                                    <a href="{{$workshops_info->payment_link}}" class='btn btn-fill btn-primary btn-wd'>Pay Now</a>--}}
                            {{--                                @endif--}}
                        @endif
                    @endif


                </div>
                <div class="pull-left">
                    <input type='button' class='btn btn-previous btn-fill btn-default btn-wd' name='previous' value='Previous' />
                </div>
                <div class="clearfix"></div>
            </div>
            </form>
        </div>
    </div> <!-- wizard container -->
</div>
<div class="col-md-1">
    <form action="" method="post" id="h-form" class="d-none">
        {{csrf_field()}}
        <input type="hidden" name ="code" id="name2" style="background-color: blue">
    </form>
</div>