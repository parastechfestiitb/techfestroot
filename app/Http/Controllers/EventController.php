<?php

namespace App\Http\Controllers;

use App\Certificate;
use App\Participant;
use App\Teams;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Event;
use DB;
use Redirect;
use Mail;
use App\Ca;
use App\User;
use Google_Client;
use Google_Service_Oauth2;
use Illuminate\Session;
use Illuminate\Support\Facades\Storage;
use test\Mockery\TraitWithAbstractMethod;
use Illuminate\Support\Facades\Hash;


class EventController extends Controller
{


    public function hospitality_pc_reg(Request $number_of_people){
        return view('2019.hospitality.hospitality_reg_layout')->with(['number_of_people' => $number_of_people]);
    }
    public function hospitality_mobile_reg(Request $number_of_people){
        return view('2019.hospitality.mobile.hospitality_form_layout')->with(['number_of_people' => $number_of_people]);
    }
    public function hospitality_form_submit(Request $data){
        for( $i=0; $i< $data->number_of_people; $i++){
            $name = "name"; $input_name = $name.$i;
            $email = "email"; $input_email = $email.$i;
            $number = "number"; $input_number = $number.$i;
            $team_id = "team_id"; $team_id = $team_id.$i;
            $gender = "gender"; $input_gender = $gender.$i;
            DB::table('tf_accommodation')->insert([
                'name'=>$data->$input_name,
                'email'=> $data->$input_email,
                'number'=> $data->$input_number,
                'gender'=> $data->$input_gender,
                'team_id'=> $data->$team_id
            ]);
        }
        return view('2019.hospitality.redirect');
    }
    public function twmunGet(){
        return view('events.twmun');
    }
    public function competitionsPost(){
        return Event::where(['category'=>'Competition'])->orderBy('order_by','DESC')->orderBy('id')->get();
    }
    public function zonalsPost(){
        return Event::where(['category'=>'Competition','zonal'=>1])->get();
    }
    public function ideatesPost(){
        return Event::where(['category'=>'Ideate'])->orderBy('order_by','DESC')->orderBy('id')->get();
    }
    public function getIdPost($id){
        return Event::whereId($id)->first();
    }
    public function getEvent($name){
    }
    public function nameEventPost($event){
        return Event::where(['category'=>$event])->first();
    }
    public function apiSearchPost(Request $r){
        $query = strtolower($r->q);
        return DB::table('search')->where('key','like',"%{$query}%")->select(['url','name'])->limit(10)->distinct()->get();
    }
    public function namePost(Request $r){
            return Event::where(['name'=>$r->name])->first();
    }
    public function apiRegisterLeaderPost(Request $r){
        $event = Event::where('name',$r->event)->first();
        $teamId = null;
//        if($event->zonal===2) return "Sorry, registrations have closed for these zonals";
        if(!$event) return "No Such Event Exists";
        else if($event->registration>Carbon::today() && $event->category==='Workshop') return "Sorry, registerations have not started yet";
        else if(!session()->has('participant')) return "Not logged in";
        else if(DB::table('event_participant')->where(['event_id'=>$event->id,'participant_id'=>session()->get('participant')->id])->count()>0) return "Already Exists";
        else{
            $participant = Participant::where('email',session()->get('participant')->email)->first();
            $id = DB::table('teams')->insertGetId(['leader_id'=>session()->get('participant')->id]);
//            if($event->zonal===0) $teamId = DB::table('event_participant')->insertGetId(['event_id'=>$event->id,'participant_id'=>session()->get('participant')->id,'is_leader'=>1,'team_id'=>$id]);
            $teamId = DB::table('event_participant')->insertGetId(['event_id'=>$event->id,'participant_id'=>session()->get('participant')->id,'is_leader'=>1,'team_id'=>$id,'zonal'=>$r->zonal]);
            $teamId = DB::table('event_participant')->whereId($teamId)->first()->team_id;
            Mail::send('admin.mail.eventRegistered',['participant'=>$participant,'teamId'=>$teamId,'event'=>$event],function($message) use ($participant){
                $message->from('register@techfest.org','Techfest-NoReply');
                $message->to($participant->email);
                $message->subject("You are now registered");
            });
            return "Success";
        }
    }
    public function apiRegisterCheckPost(Request $r){
        $e = Event::where('name',$r->event)->first();
        if(!$e) return abort(405);
        $rel = DB::table('event_participant')->where(['event_id'=>$e->id,'participant_id'=>session()->get('participant')->id])->first();
        if(!$rel) return response()->json(['isRegistered'=>false,'isLeader'=>false]);
        else if($rel->is_leader===0) return response()->json(['isRegistered'=>true,'isLeader'=>false]);
        else return response()->json(['isRegistered'=>true,'isLeader'=>true]);
    }
    public function apiTeamGet(Request $r){
//        $name = $r->name;
//        $event = Event::where("name",$name)->first();
    }
    public function apiRegisterGetTeamPost(Request $r){
        $e = Event::where('name',$r->event)->first();
        $inviteLink = 'https://techfest.org/register/';
        if(!$e) return abort(404,'No Event');
        else{
            $team = DB::table('event_participant')->where(['event_id'=>$e->id,'participant_id'=>session()->get('participant')->id])->first();
            if(!$team) return abort(404);
            $team_id = DB::table('teams')->whereId($team->team_id)->first()->id;
            $ids = DB::table('event_participant')->where('team_id',$team_id)->get();
            $teamMembers = [];
            foreach($ids as $k=>$id){
                $teamMembers[$k]=Participant::whereId($id->participant_id)->first();
                if($id->is_leader===1) {
                    $teamMembers[$k]->isLeader = true;
                    $inviteLink .= md5($teamMembers[$k]->email).'/'.$team_id;
                }
                else $teamMembers[$k]->isLeader = false;
            }
            return ['team'=>$teamMembers,'isLeader'=>$team->is_leader,'myEmail'=>session()->get('participant')->email,'inviteLink'=>$inviteLink,'team_id'=>$team->team_id];
        }
    }
    public function apiRegisterRemovePost(Request $r){
        $e = Event::where('name',$r->event)->first();
        $z = (new Participant())->zonal($e);
        if(!$e) return abort(404,'No Event');
        else if(DB::table('event_participant')->where(['event_id'=>$e->id,'participant_id'=>$r->id])->count()===0) return "No such member exists, refresh the page";
        else {
            $t = DB::table('event_participant')->where(['event_id'=>$e->id,'participant_id'=>$r->id])->first();
            if($t)
                DB::table('deleted_teams')->insert(['participant_id'=>$t->participant_id,'event_id'=>$t->event_id]);
            DB::table('event_participant')->where(['event_id'=>$e->id,'participant_id'=>$r->id])->delete();
            return "Success";
        }
    }
    public function apiRegisterAddMemberPost(Request $r){
        $e = Event::where('name',$r->event)->first();
        $p = session()->get('participant');
        $tf = (int) substr($r->tfID,2);
        $newParticipant = Participant::where(['email'=>$r->email,'id'=>$tf])->first();
        if(!$e) return abort(404,'No Event');
//        if($e->zonal===1) return "Registrations closed for zonals";
        if(!$newParticipant || !$newParticipant->phone) return "No such participant, exists! Ask your friend to sign-in at techfest first";
        else if($e->registration>Carbon::today()) return "Registration has not been started yet!";
        else if(DB::table('event_participant')->where(['event_id'=>$e->id,'participant_id'=>$newParticipant->id])->count()) return "This email is already registered for this event";
        else if(DB::table('event_participant')->where(['event_id'=>$e->id,'participant_id'=>$p->id])->count()===0) return "No registration, refresh the page";
        else{
            $ep = DB::table('event_participant')->where(['event_id'=>$e->id,'participant_id'=>$p->id])->first();
            if(!$ep->is_leader===1) return "Sorry, you are not a leader, you can not add members";
            $teamCount = DB::table('event_participant')->where(['team_id'=>$ep->team_id])->count();
            if($teamCount>=$e->participants) return "Sorry, you can not any more members";
            else {
                $participant = $newParticipant;
                $event = $e;
                $teamId = DB::table('event_participant')->insertGetId(['event_id'=>$e->id,'participant_id'=>$newParticipant->id,'team_id'=>$ep->team_id,'is_leader'=>0]);
                $teamId = DB::table('event_participant')->whereId($teamId)->first()->team_id;
                Mail::send('admin.mail.eventRegistered',['participant'=>$participant,'teamId'=>$teamId,'event'=>$event],function($message) use ($participant){
                    $message->from('register@techfest.org','Techfest-NoReply');
                    $message->to($participant->email);
                    $message->subject("You are now registered");
                });
                return "Success";
            }
        }
    }
    public function apiRegisterDeletePost(Request $r){
        $e = Event::where('name',$r->event)->first();
        $z = (new Participant())->zonal($e);
//        if($e->zonal === 1) return "Sorry, you can not change for your team anymore";
        if(!$e) return "No Such Event Exists";
        $t = DB::table('event_participant')->where(['event_id'=>$e->id,'participant_id'=>session()->get('participant')->id,'is_leader'=>1])->first();
        if(Teams::whereId($t->team_id)->ticket_id!==null) return "Sorry, payment is already done for your team, you can not leave this team";
        if(!$t){
            $t = DB::table('event_participant')->where(['event_id'=>$e->id,'participant_id'=>session()->get('participant')->id])->first();
            DB::table('deleted_teams')->insert(['participant_id'=>$t->participant_id,'event_id'=>$t->event_id]);
            DB::table('event_participant')->where(['event_id'=>$e->id,'participant_id'=>session()->get('participant')->id])->delete();
        }
        else{
            DB::table('teams')->whereId($t->team_id)->delete();
            $t = DB::table('event_participant')->where(['event_id'=>$e->id,'participant_id'=>session()->get('participant')->id])->first();
            DB::table('deleted_teams')->insert(['participant_id'=>$t->participant_id,'event_id'=>$t->event_id]);
            DB::table('event_participant')->where(['event_id'=>$e->id,'team_id'=>$t->team_id])->delete();
        }
        return "Success";
    }
    public function apiRegisterTechnoholix(){
        if(!session()->has('participant')) return "Need to login first!";
        else {
            DB::table('participants')->whereId(session()->get('participant')->id)->update(['technoholix'=>1]);
            return "Success";
        }
    }
    public function apiRegisterTechnoholixCheckPost(){
        return Participant::whereId(session()->get('participant')->id)->whereNotNull('technoholix')->count()===1?
                response()->json(['isRegistered'=>true,'isLeader'=>true,'participant'=>session()->get('participant')->id]):
                response()->json(['isRegistered'=>false,'isLeader'=>false,'participant'=>null]);
    }
    //Robowars
    public function robowarsGet(){
        return view('events.robowars');
    }
//    public function icGet2(){
//        return view('events.ic');
//    }

    public function google_auth(Request $request){
        $client = new Google_Client();
        $client->setApplicationName('All Auths');
        $client->setClientId('218886856483-4lnh6s9mvguid18098antfdltvosd7ln.apps.googleusercontent.com');
        $client->setClientSecret('3U0LIJc7Iq_EYmPex07c7X7m');
        $client->setRedirectUri($request->root());
        $client->setScopes(array(
            'https://www.googleapis.com/auth/plus.me',
            'https://www.googleapis.com/auth/userinfo.email',
            'https://www.googleapis.com/auth/userinfo.profile',
            'https://www.googleapis.com/auth/userinfo.profile',
        ));
        if (session()->has('google_token') && session('google_token'))
            $client->setAccessToken(session('google_token'));

        else if (isset($request->code)) {
            $client->authenticate($request->code);

            $client->setAccessType("offline");
            $access_token = $client->getAccessToken();
            session(['google_token'=>$access_token]);
        }
        if($client->getAccessToken())
            return $client;
        else return false;
    }

//    public function icGet3(Request $request){
//        if(!isset($request->code) && !session()->has('user')) return view('events.ic');
//        $client = $this->google_auth($request);
//        if ($client) {
//            $oauth2 = new Google_Service_Oauth2($client);
//            $userInfo = $oauth2->userinfo->get();
//            $user = DB::table('tf_ic')->where(['email'=>$userInfo->email])->first();
//            session(['user'=>$user]);  //todo session started
//            if(!$user){
//                DB::table('tf_ic')->insert(['email'=>$userInfo->email, 'name'=>$userInfo->name, 'picture'=>$userInfo->picture]);
//            }
//            return redirect("/innovationchallenge/login");
//        }
////        return redirect("/dashboard/");
//    }

    public function icGet( ){
        return view('events.ic');
    }
    public function icLogin(){
//        $user_row = DB::table('tf_ic')->where(['email'=>session()->get('user')->email])->first();// return the first row containing the user(session wala user)
//        if(empty($user_row->number)){
            return view('/events/icLogin');
//        }
//        if(!empty($user_row->number)){
//            return view('/events/ic_test')->with(['user_row'=>$user_row]);
//        }
    }
    public function ic_password_Login(){
        return view('events.ic_password_Login');
    }
    public function ic_Login_success(Request $data){
        $id_without_zone = substr($data->email, -5);
        $user_row = DB::table('tf_ic')->where(['id'=>$id_without_zone])->get()->first();
        if(empty($user_row->email)){
            return Redirect::back()->withErrors(["$data->email is not registered"]);
        }
        if(!empty($user_row->email)){
            if( $user_row->hashed_random_password == $data->key){
                return view('events.ic_after_login')->with(['user_row'=>$user_row]);
            }
            else return Redirect::back()->withErrors(["Wrong Password"]);
        }
    }

    public function ic_reg(Request $data){
        if($data->state == "JammuandKashmir" or $data->state == "Himachal" or $data->state ==  "Uttarakhand" or $data->state ==  "Punjab" or $data->state ==  "Haryana" or $data->state == "UttarPradesh" or $data->state ==  "Chandigarh" or $data->state ==  "Delhi"){
            $zone = "Zone 2";
            $zone2 = "18th December | 2pm to 8pm ";
        }
        if($data->state == "Rajasthan" or $data->state ==  "MadhyaPradesh" or $data->state ==  "Maharashtra" or $data->state ==  "Gujarat" or $data->state ==  "Goa" or $data->state ==  "DadarandNagarhaveli" or $data->state ==  "Daman&Diu"){
            $zone = "Zone 1";
            $zone2 = "17th December | 2pm to 8pm";
        }
        if($data->state ==  "Telangana" or $data->state ==  "AndhraPradesh" or $data->state ==  "Kerala" or $data->state ==  "Karnataka" or $data->state ==  "TamilNadu" or $data->state ==  "Lakshwadweep" or $data->state ==  "Andaman&Nicobar" or $data->state ==  "Puducherry"){
            $zone = "Zone 4";
            $zone2 = "20th December | 2pm to 8pm";
        }
        if($data->state == "Odisha" or  $data->state ==  "Jharkhand" or $data->state ==  "Bihar" or $data->state ==  "WestBengal" or $data->state ==  "Sikkim" or $data->state ==  "Assam" or $data->state ==  "ArunachalPradesh" or $data->state ==  "Meghalaya" or $data->state ==  "Manipur" or $data->state ==  "Mizoram" or $data->state ==  "Nagaland" or $data->state ==  "Tripura"){
            $zone = "Zone 3";
            $zone2 = "19th December | 2pm to 8pm";
        }
        $hashed_random_password = str_random(8);
        $user_row = DB::table('tf_ic')->where(['email'=>$data->email])->get()->first();
        if(empty($user_row->email)) {
            DB::table('tf_ic')->insert([
                'email' => $data->email,
                'name' => $data->name,
                'hashed_random_password' => $hashed_random_password,
                'number' => $data->number,
                'dob' => $data->dob,
                'class' => $data->class,
                'school' => $data->school,
                'state' => $data->state,
                'address' => $data->number,
                'city' => $data->city,
                'pincode' => $data->pincode,
                'zone' => $zone,
                'zone2' => $zone2,
            ]);
        }
        $user_row = DB::table('tf_ic')->where(['email'=>$data->email])->get()->first();

//         welcome mail
        if($user_row->zone == "Zone 1"){
            $zone_coeff = "1";
        }
        if($user_row->zone == "Zone 2"){
            $zone_coeff = "2";
        }
        if($user_row->zone == "Zone 3"){
            $zone_coeff = "3";
        }
        if($user_row->zone == "Zone 4"){
            $zone_coeff = "4";
        }
                $subject = " Innovation Challenge | Techfest, IIT Bombay ";
                $txt = "Dear $user_row->name,

Greetings! 
You have successfully registered in Innovation Challenge with $user_row->email as your registered mail Id.

Following are your registration details:

Roll No: IC-$zone_coeff$user_row->id
Password: $user_row->hashed_random_password
Zone: $user_row->zone
Date and Time of Submission: $user_row->zone2
Innovation Challenge 2019-20 Problem Statement : https://techfest.org/2019/ic/ProblemStatement.pdf

Please note down your these details for further use.
For more details visit : https://techfest.org/innovationchallenge
Regards
Team Techfest
";

                mail($user_row->email, $subject, $txt, "From:innovationchallenge@techfest.org" );

        return view('/events/ic_test')->with(['data'=>$data,'hashed_random_password'=>$hashed_random_password,'zone'=>$zone,'zone2'=>$zone2,'user_row'=>$user_row ]);
    }

    public function exam(Request $data){
        return redirect("http://techfest.justexam.in/student/denter?rollno=$data->roll_number");
    }
    public function finlitGet( ){
        return view('events.finlit');
    }
    public function finlitregister(){
        return view('/events/finlitLogin');
    }
    public function finlit_reg(Request $data){
        $hashed_random_password = str_random(8);
        $user_row = DB::table('tf_finlit')->where(['email'=>$data->email])->get()->first();
            if(empty($user_row->email)){
                DB::table('tf_finlit')->insert([
                    'email'=>$data->email,
                    'name'    =>$data->name,
                    'hashed_random_password'=>$hashed_random_password,
                    'number'  =>$data->number,
                    'zone'  =>$data->zone,
                    'school'  =>$data->school,
                    'address'  =>$data->number,
                    'city'   =>$data->city,
                    'pincode'   =>$data->pincode,
                ]);
            }
        $user_row = DB::table('tf_finlit')->where(['email'=>$data->email])->get()->first();

//         welcome mail

        $subject = " Financial Literacy test | Techfest, IIT Bombay ";
        $txt = "Dear $user_row->name,

Greetings! 
You have successfully registered in Financial Literacy test with $user_row->email as your registered mail Id.

Following are your registration details:

Roll No: FINLIT$user_row->id
Password: $user_row->hashed_random_password

Please note down your these details for further use.

Regards
Team Techfest
";
        mail($user_row->email, $subject, $txt, "From:adamya@techfest.org" );

        return view('/events/finlit_test')->with(['user_row'=>$user_row,'data'=>$data,'hashed_random_password'=>$hashed_random_password]);
    }

    public function finlitlogin(){
        return view('events.finlit_password_login');
    }
    public function finlitlogin_success(Request $data){
        $id_without_zone = substr($data->email, -5);
        $user_row = DB::table('tf_finlit')->where(['id'=>$id_without_zone])->get()->first();
        if(empty($user_row->email)){
            return Redirect::back()->withErrors(["$data->email is not registered"]);
        }
        if(!empty($user_row->email)){
            if( $user_row->hashed_random_password == $data->key){
                return view('events.ic_after_login')->with(['user_row'=>$user_row]);
            }
            else return Redirect::back()->withErrors(["Wrong Password"]);
        }
    }




















    public function cyclothonGet(){
        return view('events.cyclothon');
    }
    public function robowarsPost(Request $r){
        $vars = ['category','count','botName','achivement',
            'leaderName','leaderEmail','leaderPhone','leaderAddress','leaderDob','leaderSchool','leaderZip',
            'member2Name','member2Email','member2Phone','member2Address','member2Dob','member2School','member2Zip',
            'member3Name','member3Email','member3Phone','member3Address','member3Dob','member3School','member3Zip',
            'member4Name','member4Email','member4Phone','member4Address','member4Dob','member4School','member4Zip',
            'member5Name','member5Email','member5Phone','member5Address','member5Dob','member5School','member5Zip',
            'member6Name','member6Email','member6Phone','member6Address','member6Dob','member6School','member6Zip'
        ];

        $countStart = 4;
        if($r->category!=='R2'&&$r->category!=='R3')
            return view('events.robowars')->with(['regError'=>$r,'errorReg'=>'Sorry, not a proper category.']);
        for($p=0;$p<$countStart+7*$r->count;$p++){
            if(!isset($r[$vars[$p]])){
                $error=$vars[$p];
                return view('events.robowars')->with(['regError'=>$r,'errorReg'=>$error]);
            }
        }
        $request = $r;
        $event = Event::where('code',$r->category)->first();
        $e = $event->id;
        $participants = [];
        $tId = null;
        for($x=0;$x<$r->count;$x++){
            $b = $countStart + $x*7;
            if(Participant::where('email',$r[$vars[$b+1]])->count()===0) continue;
            else if(DB::table('event_participant')->where(['event_id'=>$e,'participant_id'=>Participant::where('email',$r[$vars[$b+1]])->first()->id])->count()===0) continue;
            else return view('events.robowars')->with(['regError'=>$r,'errorReg'=>"Member ".($x+1)." is already registered"]);
        }
        for($x=0;$x<$r->count;$x++){
            $b = $countStart + $x*7;
            $inserted = 0;
            if(Participant::where('email',$r[$vars[$b+1]])->count()===0) {
                Participant::insert([
                    'name' => $r[$vars[$b]],
                    'email' => $r[$vars[$b + 1]],
                    'phone' => $r[$vars[$b + 2]],
                    'address' => $r[$vars[$b + 3]],
                    'dob' => Carbon::parse($r[$vars[$b + 4]]),
                    'college' => $r[$vars[$b + 5]],
                    'pin' => $r[$vars[$b + 6]]
                ]);
                $inserted = 1;
            }
            $participant = Participant::where('email',$r[$vars[$b + 1]])->first();
            $participants[] = $participant;
            if($inserted ===1){
                Mail::send('admin.mail.userRegistered',['participant'=>$participant],function($message) use ($request,$participant){
                    $message->from('register@techfest.org','Techfest-NoReply');
                    $message->to($participant->email);
                    $message->subject("User registration successful");
                });
            }
        }
        $leaderId = $participants[0]->id;
        $tId = DB::table('teams')->insertGetId(['leader_id'=>$leaderId]);
        $robotId = DB::table('robowars')->insertGetId(['name'=>$r->teamName,'achivements'=>$r->achivement,'id'=>$tId,'bot_name'=>$r->botName]);
        $bot = DB::table('robowars')->whereId($robotId)->first();
        foreach($participants as $k=>$participant){
            DB::table('event_participant')->insertGetId(['event_id'=>$e,'participant_id'=>$participant->id,'team_id'=>$tId,'is_leader'=>$k===0?1:0]);
            Mail::send('admin.mail.robowars',['participant'=>$participant,'bot'=>$bot],function($message) use ($participant){
                $message->from('register@techfest.org','Techfest-NoReply');
                $message->to($participant->email);
                $message->subject("You are now registered");
            });
        }
        $event->participants = $participants;
        return view('events.successfulyRegistered')->with(['e'=>$event]);
    }

    //Summit
    public function summitPost(Request $r){
        $r->validate(['name'=>'required','category'=>'required','phone'=>'required','email'=>'required|email','college'=>'required','pin'=>'required|digits:6']);
        if(Participant::where('email',$r->email)->count()===0){
            $p = new Participant();
            $p->name = $r->name;
            $p->email = $r->email;
            $p->phone = $r->phone;
            $p->college = $r->college;
            $p->address = $r->college;
            $p->dob = Carbon::now();
            $p->gender = 'male';
            $p->pin = $r->pin;
            $p->save();
        }
        $cat = ['S1'=>79,'S2'=>80,'S3'=>81];
        $participant = Participant::where('email',$r->email)->first();
        $t = Teams::insertGetId(['leader_id'=>$participant->id]);
        $event = Event::where('id',$cat[$r->category])->first();
        DB::table('event_participant')->insert(['event_id'=>$cat[$r->category],'participant_id'=>$participant->id,'team_id'=>$t,'is_leader'=>1]);
        Mail::send('admin.mail.workshop',['participant'=>$participant,'teamId'=>$t,'event'=>$event],function($message) use ($participant){
            $message->from('register@techfest.org','Techfest-NoReply');
            $message->to($participant->email);
            $message->subject("You are now registered");
        });
        return redirect('https://techfest.org/payment/direct/'.$t);
    }
}
