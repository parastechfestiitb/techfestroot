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