<div class="col-md-1"></div>
<div class="col-md-10">
    <div class="wizard-container">
        <div class="card wizard-card" data-color="purple" id="wizard" style="min-height: 73vh;">
            <form action="" method="">
                <!--        You can switch " data-color="rose" "  with one of the next bright colors: "blue", "green", "orange", "purple"        -->
                <div class="wizard-header">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="/workshops"><i class="fas fa-arrow-left" style="float: left"></i></a>
                            <h3 class="wizard-title" style="display: inline">{{$workshops_info->name}}
                                {{--                                    <img src="{{$workshops_info->image}}" alt="" style="height: 1em; border-radius: 5%;">--}}
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
                                        <br>Team ID-{{$workshops_info->coeff}}{{$team_members[0]->id}}
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
                                        @if(empty($team_members))
                                            <input type='button' class='btn btn-fill btn-primary btn-wd' id="signinButton" name='next' value='Register' />
                                        @endif
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
                        @if(!empty($workshops_info->about))
                            <li><a href="#location" data-toggle="tab">About</a></li>
                        @endif
                        <li><a href="#type" data-toggle="tab">Details</a></li>
                        <li><a href="#facilities" data-toggle="tab">Rules</a></li>
                        <li><a href="#description" data-toggle="tab">Contact Us</a></li>
                    </ul>
                </div>
                <div class="tab-content" style="min-height: 33vh;">
                    <div class="tab-pane" id="location">
                        <div class="row">
                            <div class="col-sm-3">
                                <img src="{{$workshops_info->image}}" alt="" style="width: 100%; border-radius: 10px;">
                            </div>
                            <div class="col-sm-9" style="">
                                <div>
                                    <p class="description">{{$workshops_info->about}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="type">
                        {{--                                                <h4 class="info-text">What type of location do you have? </h4>--}}
                        <div class="row" >
                            <div class="col-sm-3">
                                <h6>Duration Of Workshop</h6>
                                <h6>{{$workshops_info->details_duration}}</h6>
                                <hr>
                            </div>

                            <div class="col-sm-3 ">
                                <h6>Venue</h6>
                                <h6>{{$workshops_info->details_venue}}</h6>
                                <hr>
                            </div>

                            <div class="col-sm-3 ">
                                <h6>Team Members Required</h6>
                                <h6>{{$workshops_info->no_of_team_member}}</h6>
                                <hr>
                            </div>
                            <div class="col-sm-3 ">
                                <h6>Total cost of Workshop</h6>
                                <h6>INR-{{$workshops_info->details_cost}} per team</h6>
                                <hr>
                            </div>
                            <div class="col-sm-6 ">
                                <h6>Date of Workshop</h6>
                                <h6>{{$workshops_info->date}}</h6>
                                <hr>
                            </div>
                            @if(!empty($workshops_info->pdfs))
                                <div class="col-sm-6 ">
                                    <a href="{{$workshops_info->pdfs}}" target="_blank" class='btn btn-fill btn-primary btn-wd'>Content of the Workshop</a>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="tab-pane" id="facilities">
                        <div class="row">
                            <div class="col-sm-10 col-sm-offset-1">
                                {!! $workshops_info->eligibility !!}

                                <br>
                                <br>
                                <br>
                                {!! $workshops_info->extra_detail !!}

                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="description">
                        <div class="row">
                            <h4 class="info-text"> Feel Free to contact us </h4>
                            <p class="description">{{$workshops_info->contact_us_name}}</p>
                            <p class="description">{{$workshops_info->contact_us_email}}</p>
                            <p class="description">{{$workshops_info->contact_us_number}}</p>

                        </div>
                    </div>
                </div>
                <div class="wizard-footer">
                    <div class="pull-right">
                        <a class="btn btn-primary" href="/hospitality">Apply for accommodation</a>
                        <input type='button' class='btn btn-next btn-fill btn-primary btn-wd' name='next' value='Next' />

                    </div>
                    <div class="pull-left">
                        <input type='button' class='btn btn-previous btn-fill btn-primary btn-wd' name='previous' value='Previous' />
                    </div>
                    <div class="clearfix"></div>
                </div>
            </form>
        </div>
    </div> <!-- wizard container -->
</div>
<div class="col-md-1">
    <form action="/workshops_signin/{{$workshops_info->link}}" method="post" id="h-form" class="d-none">
        {{csrf_field()}}
        <input type="hidden" name ="code" id="name2" style="background-color: blue">
    </form>
</div>
