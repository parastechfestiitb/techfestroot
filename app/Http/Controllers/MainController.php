<?php
namespace App\Http\Controllers;
use App\Event;
use App\Participant;
use Illuminate\Http\Request;
use Google_Client;
use Google_Service_Oauth2;
//use DB;
use Mail;
use Carbon\Carbon;
use Image;
use Illuminate\Support\Facades\DB;
use Redirect;

class MainController extends Controller
{
    //takes request with optional code to see if google login is present
    public function google_auth(Request $request){
        $client = new Google_Client();
        $client->setApplicationName('All Auths');
        $client->setClientId('218886856483-4lnh6s9mvguid18098antfdltvosd7ln.apps.googleusercontent.com');
        $client->setClientSecret('3U0LIJc7Iq_EYmPex07c7X7m');
//        $client->setRedirectUri('https://'.request()->getHost());
        $client->setRedirectUri($request->root());
        $client->setScopes(array(
            'https://www.googleapis.com/auth/plus.me',
            'https://www.googleapis.com/auth/userinfo.email',
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
    //paras's code
//    public function compireg(){
//        return view('2019.test');
//    }

    public function compireg(Request $request){
        if(!isset($request->code) && !session()->has('user')) return view('2019.test');
        $client = $this->google_auth($request);
        $oauth2 = new Google_Service_Oauth2($client);
        $userInfo = $oauth2->userinfo->get();
        if ($client) {
            $oauth2 = new Google_Service_Oauth2($client);
            $userInfo = $oauth2->userinfo->get();
            $user = DB::table('tf_reg')->where(['email'=>$userInfo->email])->first();
            session(['user'=>$user]);  //todo session started

            if(!$user){
                DB::table('tf_reg')->insert(['email'=>$userInfo->email, 'name'=>$userInfo->name, 'picture'=>$userInfo->picture, 'gender'=>$userInfo->gender]);
            }       //If user does not exist, save him and ask for his profile update

            return view('2019.test')->with(['user'=>$user]);
        }
    }



    public function reg_logout(){
        session()->flush();
        return redirect('/compireg');
    }
    public function competitions_logout(){
        session()->flush();
        return redirect('/competitions');
    }



//individual reg button request
    public function regift(){

        if(session()->has('user')) {
            $current_user_data = DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
            DB::table('tf_reg')->where(['email'=>$current_user_data->email])->update(['ift'=>'1']);
            DB::table('tf_backup')->insert(['name'=>$current_user_data->name, 'email'=>$current_user_data->email, 'event_workshop'=>'e_ift']);
            return redirect('/compireg');
        }        else return "first signin";
    }

    public function zonals_form(){
        if (session()->has('user')) {
            $current_user_data = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();
            return view('2019.competitions.zonals')->with(['current_user_data'=>$current_user_data]);
        }

    }
    public function zonals_form_reg(Request $data){
        if (session()->has('user')) {
            DB::table('tf_reg')->where(['email' => session()->get('user')->email])->update([
                'number'=>$data->phone,
                'college'=>$data->college_name,
                'zonal'=>$data->zonal,
                'city'=>$data->city,
                'pincode'=>$data->college_pincode,
                'year'=>$data->college_year,
                'address'=>$data->student_address,
            ]);
            return redirect("/competitions/");
        }
    }
    public function details_form(){
        if (session()->has('user')) {
            $current_user_data = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();
            return view('2019.competitions.studenr_details_form')->with(['current_user_data'=>$current_user_data]);
        }
        else return redirect("/competitions/");

    }

    public function details_form_2(){
            if (session()->has('user')) {
                $current_user_data = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();
                return view('2019.competitions.studenr_details_form_2')->with(['current_user_data'=>$current_user_data]);
            }
            else return redirect("/competitions/");


     }
    public function details_form_school(){
            if (session()->has('user')) {
                $current_user_data = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();
                return view('2019.competitions.studenr_details_form_school')->with(['current_user_data'=>$current_user_data]);
            }
            else return redirect("/competitions/");

        }


    public function details_form_reg(Request $data){
//        return "$data->url";
        if (session()->has('user')) {
            DB::table('tf_reg')->where(['email' => session()->get('user')->email])->update([
                'name'=>$data->name,
                'number'=>$data->number,
                'gender'=>$data->gender,
                'institute_name'=>$data->institute_name,
                'institute_address'=>$data->institute_address,
                'year_of_study'=>$data->year_of_study,
                'residential_address'=>$data->residential_address,
                'residential_pincode'=>$data->residential_pincode,
                'country'=>$data->country,
                'zonal'=>$data->zonal,
            ]);
            return redirect("/competitions/");
        }
    }

//cozmo all functions
    public function cozmo(Request $request){
        $client = $this->google_auth($request);
        if ($client) {
            $oauth2 = new Google_Service_Oauth2($client);
            $userInfo = $oauth2->userinfo->get();
            $user = DB::table('tf_reg')->where(['email' => $userInfo->email])->first();
            session(['user' => $user]);  //todo session started
            if (!$user) {
                DB::table('tf_reg')->insert(['email' => $userInfo->email, 'name' => $userInfo->name, 'picture' => $userInfo->picture, 'no_of_login' => '1']);
            }
            if ($user) {
                DB::table('tf_reg')->where(['email' => $user->email])->update(['picture' => $userInfo->picture]);
                $user_row = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();// return the first row containing the user(session wala user)
                if($user_row->cozmo > 0 && empty($user_row->number)){
                    return redirect('/competitions/details_form');
                }
                return view("2019.competitions.cozmo")->with(['user_row' => $user_row]);
            }

        }
        if(!isset($request->code) && !session()->has('user')) return view('2019.competitions.cozmo');

        return redirect("/competitions/cozmo/");
    }
    public function regcozmo(Request $request){
        $user_row = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();// return the first row containing the user(session wala user)
        DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->update(['cozmo'=>'1']);
        $subject = "Welcome to Cosmo Clench- Techfest, IIT Bombay";
        $txt = "Dear $user_row->name,

Greetings! 
You have successfully registered in Cosmo Clench with $user_row->email as your registered mail Id. Now you must either Create a Team or Join a Team to complete the procedure.

Carefully read the FAQ’s of competitions carefully to know more.

Regards";

        mail($user_row->email, $subject, $txt, "From:competitions@techfest.org" );
        return redirect("/competitions/cozmo/");
    }
    public function cozmo_create_team_form(Request $data){
        $current_user_data = DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
        return view("2019.competitions.create_teamform")->with(['current_user_data'=>$current_user_data, 'form'=>"cozmo"]);
    }
    public function cozmo_join_team_form(Request $data){
        $current_user_data = DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
        return view("2019.competitions.join_teamform")->with(['current_user_data'=>$current_user_data,'form'=>"cozmo"]);
    }
    public function cozmo_leave_team(){
        if(session()->has('user')) {
            $current_team =  DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
            if(!empty($current_team->cozmo_team)){
                DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->update(['cozmo_team'=>'']);
                return redirect("/competitions/cozmo");
            }
            else return "you are not in a team";
        }
    }
    public function cozmo_create_team_reg(Request $data){
        if (session()->has('user')) {
            $current_user_data = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();
            $a = 190000;
            $b = $current_user_data->id;
            $team_id = $a +$b;
            DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['cozmo_team' => $current_user_data->email, 'cozmo_team_id'=> $team_id]);
            $p2_exist = DB::table('tf_reg')->where(['email'=>$data->email2])->first();
            if(!empty($data->email2)){if (!empty($p2_exist->email)) {
                $p2 = DB::table('tf_reg')->where(['email' => $data->email2])->first();
//                check if he is already in a team
                if (empty($p2->cozmo_team)) {
                    DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['cozmo_team' => $current_user_data->email, 'cozmo_team_id'=>$team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email2])->update(['cozmo_team' => $current_user_data->email, 'cozmo_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email2])->update(['cozmo' => '1']);
                    $subject2 = "CozmoClench, Techfeat IIT Bomabay";
                    $txt2 = "Dear $p2_exist->name, you have been successfully added to $current_user_data->name's team for Cozmo .
Your Team ID and Registered Mail ID are very important and will be used in future.
You can leave your current team by clicking on Leave a Team. 
Regards.";
                    mail($p2_exist->email, $subject2, $txt2, "From:competitions@techfest.org" );
                    $subject0 = "CozmoClench, Techfeat IIT Bomabay";
                    $txt0 = "Dear $current_user_data->name, your team is successfully created for CozmoClench  
You are the Team Leader, you can Remove a Team member or Dissolve the existing team. Hoping to see you at Techfest  
Regards. ";
                    mail($current_user_data->email, $subject0, $txt0, "From:competitions@techfest.org" );
                } else return Redirect::back()->withErrors(["$p2->email is already in another team, he/she must leave current team first"]);
            } else return Redirect::back()->withErrors(["$data->email2 is not registered on techfest"]);}
            $p3_exist = DB::table('tf_reg')->where(['email'=>$data->email3])->first();
            if(!empty($data->email3)){if (!empty($p3_exist->email)) {
                $p3 = DB::table('tf_reg')->where(['email' => $data->email3])->first();
//                check if he is already in a team
                if (empty($p3->cozmo_team)) {
                    DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['cozmo_team' => $current_user_data->email, 'cozmo_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email3])->update(['cozmo_team' => $current_user_data->email, 'cozmo_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email3])->update(['cozmo' => '1']);
                    $subject2 = "CozmoClench, Techfeat IIT Bomabay";
                    $txt1 = "Dear $p3_exist->name, you have been successfully added to $current_user_data->name's team for Cozmo .
Your Team ID and Registered Mail ID are very important and will be used in future.
You can leave your current team by clicking on Leave a Team. 
Regards.";
                    mail($p3_exist->email, $subject2, $txt2, "From:competitions@techfest.org" );
                } else return Redirect::back()->withErrors(["$p3->email is already in another team, he/she must leave current team first"]);
            } else return Redirect::back()->withErrors(["$data->email3 is not registered on techfest"]);}
            $p4_exist = DB::table('tf_reg')->where(['email'=>$data->email4])->first();
            if(!empty($data->email3)){if(!empty($p4_exist->email)) {
                $p4 = DB::table('tf_reg')->where(['email' => $data->email4])->first();
//                check if he is already in a team
                if (empty($p4->cozmo_team)) {
                    DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['cozmo_team' => $current_user_data->email, 'cozmo_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email4])->update(['cozmo_team' => $current_user_data->email, 'cozmo_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email4])->update(['cozmo' => '1']);
                    $subject4 = "CozmoClench, Techfeat IIT Bomabay";
                    $txt4 = "Dear $p4_exist->name, you have been successfully added to $current_user_data->name's team for Cozmo .
Your Team ID and Registered Mail ID are very important and will be used in future.
You can leave your current team by clicking on Leave a Team. 
Regards.";
                    mail($p4_exist->email, $subject4, $txt4, "From:competitions@techfest.org" );
                } else return  Redirect::back()->withErrors(["$p4->email is already in another team, he/she must leave current team first"]);
            } else return Redirect::back()->withErrors(["$data->email4 is not registered on techfest"]);}
            return redirect("/competitions/cozmo");
        } else return redirect("/competitions/cozmo");
    }
    public function cozmo_join_team_reg(Request $data){
        if(session()->has('user')) {
            $current_user_data = DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
            $team_member_row = DB::table('tf_reg')->where(['email'=>$data->email])->first();
            if(!empty($team_member_row->email)){
                $team_member_count = DB::table('tf_reg')->where(['cozmo_team' => $team_member_row->cozmo_team])->count();

                if(empty($current_user_data->cozmo_team)){
                    if($team_member_count <= 4 ){
                        if(!empty($data->email)){DB::table('tf_reg')->where(['email'=>$current_user_data->email])->update(['cozmo_team'=>$team_member_row->cozmo_team]);}
                        return redirect("/competitions/cozmo");
                    }
                    else return Redirect::back()->withErrors(["Team does not exist /Team already full"]);
                }
                else return Redirect::back()->withErrors(["you are already registered in a team, drop current team to join new one"]);
            }
            else return Redirect::back()->withErrors(["$data->email is not registered on Techfest"]);
        }
        else return Redirect::back()->withErrors(["first signin"]);
    }
    public function cozmo_remove_member (Request $request, $id){
        $user_row = DB::table('tf_reg')->where(['id' => $id])->first();
        $subject = "CozmoClench, Techfeat IIT Bomabay";
        $txt = "Dear $user_row->name, you have been removed from the CozmoClench Team by your team leader $user_row->cozmo_team which had team id zzz, you can either join another team or create your own team as a single member if you want.";

        mail($user_row->email, $subject, $txt, "From:competitions@techfest.org" );

        DB::table('tf_reg')->where(['id' => $id])->update(['cozmo_team'=> '']);

        return redirect("/competitions/cozmo");
    }
    public function cozmo_dissolve (){
        $current_user_data = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();
        $team =  DB::table('tf_reg')->where(['cozmo_team' => $current_user_data->cozmo_team])->get();
        if (!empty($team[0]->id)){DB::table('tf_reg')->where(['id' => $team[0]->id])->update(['cozmo_team'=> '']);}
        if (!empty($team[1]->id)){DB::table('tf_reg')->where(['id' => $team[1]->id])->update(['cozmo_team'=> '']);}
        if (!empty($team[2]->id)){DB::table('tf_reg')->where(['id' => $team[2]->id])->update(['cozmo_team'=> '']);}
        if (!empty($team[3]->id)){DB::table('tf_reg')->where(['id' => $team[3]->id])->update(['cozmo_team'=> '']);}
        return redirect("/competitions/cozmo");
    }

    public function wcozmo(Request $request){
        $client = $this->google_auth($request);
        if ($client) {
            $oauth2 = new Google_Service_Oauth2($client);
            $userInfo = $oauth2->userinfo->get();
            $user = DB::table('tf_reg')->where(['email' => $userInfo->email])->first();
            session(['user' => $user]);  //todo session started
            if (!$user) {
                DB::table('tf_reg')->insert(['email' => $userInfo->email, 'name' => $userInfo->name, 'picture' => $userInfo->picture, 'no_of_login' => '1']);
            }
            if ($user) {
                DB::table('tf_reg')->where(['email' => $user->email])->update(['picture' => $userInfo->picture]);
                $user_row = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();// return the first row containing the user(session wala user)
                if($user_row->wcozmo > 0 && empty($user_row->number)){
                    return redirect('/competitions/details_form');
                }
                return view("2019.competitions.wcozmo")->with(['user_row' => $user_row]);
            }

        }
        if(!isset($request->code) && !session()->has('user')) return view('2019.competitions.wcozmo');

        return redirect("/competitions/wcozmo/");
    }
    public function regwcozmo(Request $request){
        $user_row = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();// return the first row containing the user(session wala user)
        DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->update(['wcozmo'=>'1']);
        $subject = "Welcome to Cosmo Clench- Techfest, IIT Bombay";
        $txt = "Dear $user_row->name,

Greetings! 
You have successfully registered in Cosmo Clench with $user_row->email as your registered mail Id. Now you must either Create a Team or Join a Team to complete the procedure.

Carefully read the FAQ’s of competitions carefully to know more.

Regards";

        mail($user_row->email, $subject, $txt, "From:competitions@techfest.org" );
        return redirect("/competitions/wcozmo/");
    }
    public function wcozmo_create_team_form(Request $data){
        $current_user_data = DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
        return view("2019.competitions.create_teamform")->with(['current_user_data'=>$current_user_data, 'form'=>"wcozmo"]);
    }
    public function wcozmo_join_team_form(Request $data){
        $current_user_data = DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
        return view("2019.competitions.join_teamform")->with(['current_user_data'=>$current_user_data,'form'=>"wcozmo"]);
    }
    public function wcozmo_leave_team(){
        if(session()->has('user')) {
            $current_team =  DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
            if(!empty($current_team->wcozmo_team)){
                DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->update(['wcozmo_team'=>'']);
                return redirect("/competitions/wcozmo");
            }
            else return "you are not in a team";
        }
    }
    public function wcozmo_create_team_reg(Request $data){
        if (session()->has('user')) {
            $current_user_data = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();
            $a = 190000;
            $b = $current_user_data->id;
            $team_id = $a +$b;
            DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['wcozmo_team' => $current_user_data->email, 'wcozmo_team_id'=> $team_id]);
            $p2_exist = DB::table('tf_reg')->where(['email'=>$data->email2])->first();
            if(!empty($data->email2)){if (!empty($p2_exist->email)) {
                $p2 = DB::table('tf_reg')->where(['email' => $data->email2])->first();
//                check if he is already in a team
                if (empty($p2->wcozmo_team)) {
                    DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['wcozmo_team' => $current_user_data->email, 'wcozmo_team_id'=>$team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email2])->update(['wcozmo_team' => $current_user_data->email, 'wcozmo_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email2])->update(['cozmo' => '1']);
                    $subject2 = "CozmoClench, Techfeat IIT Bomabay";
                    $txt2 = "Dear $p2_exist->name, you have been successfully added to $current_user_data->name's team for Cozmo .
Your Team ID and Registered Mail ID are very important and will be used in future.
You can leave your current team by clicking on Leave a Team. 
Regards.";
                    mail($p2_exist->email, $subject2, $txt2, "From:competitions@techfest.org" );
                    $subject0 = "CozmoClench, Techfeat IIT Bomabay";
                    $txt0 = "Dear $current_user_data->name, your team is successfully created for CozmoClench  
You are the Team Leader, you can Remove a Team member or Dissolve the existing team. Hoping to see you at Techfest  
Regards. ";
                    mail($current_user_data->email, $subject0, $txt0, "From:competitions@techfest.org" );
                } else return Redirect::back()->withErrors(["$p2->email is already in another team, he/she must leave current team first"]);
            } else return Redirect::back()->withErrors(["$data->email2 is not registered on techfest"]);}
            $p3_exist = DB::table('tf_reg')->where(['email'=>$data->email3])->first();
            if(!empty($data->email3)){if (!empty($p3_exist->email)) {
                $p3 = DB::table('tf_reg')->where(['email' => $data->email3])->first();
//                check if he is already in a team
                if (empty($p3->wcozmo_team)) {
                    DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['wcozmo_team' => $current_user_data->email, 'wcozmo_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email3])->update(['wcozmo_team' => $current_user_data->email, 'wcozmo_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email3])->update(['wcozmo' => '1']);
                    $subject2 = "CozmoClench, Techfeat IIT Bomabay";
                    $txt1 = "Dear $p3_exist->name, you have been successfully added to $current_user_data->name's team for Cozmo .
Your Team ID and Registered Mail ID are very important and will be used in future.
You can leave your current team by clicking on Leave a Team. 
Regards.";
                    mail($p3_exist->email, $subject2, $txt2, "From:competitions@techfest.org" );
                } else return Redirect::back()->withErrors(["$p3->email is already in another team, he/she must leave current team first"]);
            } else return Redirect::back()->withErrors(["$data->email3 is not registered on techfest"]);}
            $p4_exist = DB::table('tf_reg')->where(['email'=>$data->email4])->first();
            if(!empty($data->email3)){if(!empty($p4_exist->email)) {
                $p4 = DB::table('tf_reg')->where(['email' => $data->email4])->first();
//                check if he is already in a team
                if (empty($p4->wcozmo_team)) {
                    DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['wcozmo_team' => $current_user_data->email, 'wcozmo_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email4])->update(['wcozmo_team' => $current_user_data->email, 'wcozmo_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email4])->update(['wcozmo' => '1']);
                    $subject4 = "CozmoClench, Techfeat IIT Bomabay";
                    $txt4 = "Dear $p4_exist->name, you have been successfully added to $current_user_data->name's team for Cozmo .
Your Team ID and Registered Mail ID are very important and will be used in future.
You can leave your current team by clicking on Leave a Team. 
Regards.";
                    mail($p4_exist->email, $subject4, $txt4, "From:competitions@techfest.org" );
                } else return  Redirect::back()->withErrors(["$p4->email is already in another team, he/she must leave current team first"]);
            } else return Redirect::back()->withErrors(["$data->email4 is not registered on techfest"]);}
            return redirect("/competitions/wcozmo");
        } else return redirect("/competitions/wcozmo");
    }
    public function wcozmo_join_team_reg(Request $data){
        if(session()->has('user')) {
            $current_user_data = DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
            $team_member_row = DB::table('tf_reg')->where(['email'=>$data->email])->first();
            if(!empty($team_member_row->email)){
                $team_member_count = DB::table('tf_reg')->where(['wcozmo_team' => $team_member_row->wcozmo_team])->count();

                if(empty($current_user_data->wcozmo_team)){
                    if($team_member_count <= 4 ){
                        if(!empty($data->email)){DB::table('tf_reg')->where(['email'=>$current_user_data->email])->update(['wcozmo_team'=>$team_member_row->wcozmo_team]);}
                        return redirect("/competitions/wcozmo");
                    }
                    else return Redirect::back()->withErrors(["Team does not exist /Team already full"]);
                }
                else return Redirect::back()->withErrors(["you are already registered in a team, drop current team to join new one"]);
            }
            else return Redirect::back()->withErrors(["$data->email is not registered on Techfest"]);
        }
        else return Redirect::back()->withErrors(["first signin"]);
    }
    public function wcozmo_remove_member (Request $request, $id){
        $user_row = DB::table('tf_reg')->where(['id' => $id])->first();
        $subject = "CozmoClench, Techfeat IIT Bomabay";
        $txt = "Dear $user_row->name, you have been removed from the CozmoClench Team by your team leader $user_row->wcozmo_team which had team id zzz, you can either join another team or create your own team as a single member if you want.";

        mail($user_row->email, $subject, $txt, "From:competitions@techfest.org" );

        DB::table('tf_reg')->where(['id' => $id])->update(['wcozmo_team'=> '']);

        return redirect("/competitions/wcozmo");
    }
    public function wcozmo_dissolve (){
        $current_user_data = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();
        $team =  DB::table('tf_reg')->where(['wcozmo_team' => $current_user_data->wcozmo_team])->get();
        if (!empty($team[0]->id)){DB::table('tf_reg')->where(['id' => $team[0]->id])->update(['wcozmo_team'=> '']);}
        if (!empty($team[1]->id)){DB::table('tf_reg')->where(['id' => $team[1]->id])->update(['wcozmo_team'=> '']);}
        if (!empty($team[2]->id)){DB::table('tf_reg')->where(['id' => $team[2]->id])->update(['wcozmo_team'=> '']);}
        if (!empty($team[3]->id)){DB::table('tf_reg')->where(['id' => $team[3]->id])->update(['wcozmo_team'=> '']);}
        return redirect("/competitions/wcozmo");
    }

    public function craneomania(Request $request){
        $client = $this->google_auth($request);
        if ($client) {
            $oauth2 = new Google_Service_Oauth2($client);
            $userInfo = $oauth2->userinfo->get();
            $user = DB::table('tf_reg')->where(['email' => $userInfo->email])->first();
            session(['user' => $user]);  //todo session started
            if (!$user) {
                DB::table('tf_reg')->insert(['email' => $userInfo->email, 'name' => $userInfo->name, 'picture' => $userInfo->picture, 'no_of_login' => '1']);
            }
            if ($user) {
                DB::table('tf_reg')->where(['email' => $user->email])->update(['picture' => $userInfo->picture]);
                $user_row = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();// return the first row containing the user(session wala user)
                if($user_row->craneomania > 0 && empty($user_row->number)){
                    return redirect('/competitions/details_form');
                }
                return view("2019.competitions.craneomania")->with(['user_row' => $user_row]);
            }
        }
        if(!isset($request->code) && !session()->has('user')) return view('2019.competitions.craneomania');

        return redirect("/competitions/craneomania/");
    }
    public function regcraneomania(Request $request){
        $user_row = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();// return the first row containing the user(session wala user)
        DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->update(['craneomania'=>'1']);
        $subject = "Welcome to Craneomania - Techfest, IIT Bombay";
        $txt = "Dear $user_row->name,

Greetings! 
You have successfully registered in Craneomania with $user_row->email as your registered mail Id. Now you must either Create a Team or Join a Team to complete the procedure.

Carefully read the FAQ’s of competitions carefully to know more.

Regards
";

        mail($user_row->email, $subject, $txt, "From:competitions@techfest.org" );
        return redirect("/competitions/craneomania/");
    }
    public function craneomania_create_team_form(Request $data){
        $current_user_data = DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
        return view("2019.competitions.create_teamform")->with(['current_user_data'=>$current_user_data, 'form'=>"craneomania"]);
    }
    public function craneomania_join_team_form(Request $data){
        $current_user_data = DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
        return view("2019.competitions.join_teamform")->with(['current_user_data'=>$current_user_data,'form'=>"craneomania"]);
    }
    public function craneomania_leave_team(){
        if(session()->has('user')) {
            $current_team =  DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
            if(!empty($current_team->craneomania_team)){
                DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->update(['craneomania_team'=>'']);
                return redirect("/competitions/craneomania");
            }
            else return "you are not in a team";
        }
    }
    public function craneomania_create_team_reg(Request $data){
        if (session()->has('user')) {
            $current_user_data = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();
            $a = 190000;
            $b = $current_user_data->id;
            $team_id = $a +$b;
            DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['craneomania_team' => $current_user_data->email, 'craneomania_team_id'=> $team_id]);

            $p2_exist = DB::table('tf_reg')->where(['email'=>$data->email2])->first();
            if(!empty($data->email2)){if (!empty($p2_exist->email)) {
                $p2 = DB::table('tf_reg')->where(['email' => $data->email2])->first();
//                check if he is already in a team
                if (empty($p2->craneomania_team)) {
                    DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['craneomania_team' => $current_user_data->email, 'craneomania_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email2])->update(['craneomania_team' => $current_user_data->email, 'craneomania_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email2])->update(['craneomania' => '1']);



                    $subject2 = "craneomania, Techfeat IIT Bomabay";
                    $txt2 = "Dear $p2_exist->name, you have been successfully added to $current_user_data->name's team for craneomania .
Your Team ID and Registered Mail ID are very important and will be used in future.
You can leave your current team by clicking on Leave a Team. 
Regards.";

                    mail($p2_exist->email, $subject2, $txt2, "From:competitions@techfest.org" );



                    $subject0 = "craneomania, Techfeat IIT Bomabay";
                    $txt0 = "Dear $current_user_data->name, your team is successfully created for craneomania  
You are the Team Leader, you can Remove a Team member or Dissolve the existing team. Hoping to see you at Techfest  
Regards. ";

                    mail($current_user_data->email, $subject0, $txt0, "From:competitions@techfest.org" );


                } else return Redirect::back()->withErrors(["$p2->email is already in another team, he/she must leave current team first"]);

            } else return Redirect::back()->withErrors(["$data->email2 is not registered on techfest"]);}


            $p3_exist = DB::table('tf_reg')->where(['email'=>$data->email3])->first();
            if(!empty($data->email3)){if (!empty($p3_exist->email)) {
                $p3 = DB::table('tf_reg')->where(['email' => $data->email3])->first();
//                check if he is already in a team
                if (empty($p3->craneomania_team)) {
                    DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['craneomania_team' => $current_user_data->email, 'craneomania_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email3])->update(['craneomania_team' => $current_user_data->email, 'craneomania_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email3])->update(['craneomania' => '1']);



                    $subject2 = "craneomania, Techfeat IIT Bomabay";
                    $txt1 = "Dear $p3_exist->name, you have been successfully added to $current_user_data->name's team for craneomania .
Your Team ID and Registered Mail ID are very important and will be used in future.
You can leave your current team by clicking on Leave a Team. 
Regards.";

                    mail($p3_exist->email, $subject2, $txt2, "From:competitions@techfest.org" );


                } else return Redirect::back()->withErrors(["$p3->email is already in another team, he/she must leave current team first"]);

            } else return Redirect::back()->withErrors(["$data->email3 is not registered on techfest"]);}

            $p4_exist = DB::table('tf_reg')->where(['email'=>$data->email4])->first();
            if(!empty($data->email3)){if(!empty($p4_exist->email)) {
                $p4 = DB::table('tf_reg')->where(['email' => $data->email4])->first();
//                check if he is already in a team
                if (empty($p4->craneomania_team)) {
                    DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['craneomania_team' => $current_user_data->email, 'craneomania_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email4])->update(['craneomania_team' => $current_user_data->email, 'craneomania_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email4])->update(['craneomania' => '1']);



                    $subject4 = "craneomania, Techfeat IIT Bomabay";
                    $txt4 = "Dear $p4_exist->name, you have been successfully added to $current_user_data->name's team for craneomania .
Your Team ID and Registered Mail ID are very important and will be used in future.
You can leave your current team by clicking on Leave a Team. 
Regards.";

                    mail($p4_exist->email, $subject4, $txt4, "From:competitions@techfest.org" );



                } else return  Redirect::back()->withErrors(["$p4->email is already in another team, he/she must leave current team first"]);

            } else return Redirect::back()->withErrors(["$data->email4 is not registered on techfest"]);}

            return redirect("/competitions/craneomania");

        } else return redirect("/competitions/craneomania");
    }
    public function craneomania_join_team_reg(Request $data){
        if(session()->has('user')) {
            $current_user_data = DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
            $team_member_row = DB::table('tf_reg')->where(['email'=>$data->email])->first();
            if(!empty($team_member_row->email)){
                $team_member_count = DB::table('tf_reg')->where(['craneomania_team' => $team_member_row->craneomania_team])->count();

                if(empty($current_user_data->craneomania_team)){
                    if($team_member_count <= 4 ){
                        if(!empty($data->email)){DB::table('tf_reg')->where(['email'=>$current_user_data->email])->update(['craneomania_team'=>$team_member_row->craneomania_team]);}
                        return redirect("/competitions/craneomania");
                    }
                    else return Redirect::back()->withErrors(["Team does not exist /Team already full"]);
                }
                else return Redirect::back()->withErrors(["you are already registered in a team, drop current team to join new one"]);
            }
            else return Redirect::back()->withErrors(["$data->email is not registered on Techfest"]);


        }
        else return Redirect::back()->withErrors(["first signin"]);
    }
    public function craneomania_remove_member (Request $request, $id){
        $user_row = DB::table('tf_reg')->where(['id' => $id])->first();
        $subject = "craneomania, Techfeat IIT Bomabay";
        $txt = "Dear $user_row->name, you have been removed from the craneomania Team by your team leader $user_row->craneomania_team which had team id zzz, you can either join another team or create your own team as a single member if you want.";

        mail($user_row->email, $subject, $txt, "From:competitions@techfest.org" );

        DB::table('tf_reg')->where(['id' => $id])->update(['craneomania_team'=> '']);

        return redirect("/competitions/craneomania");
    }
    public function craneomania_dissolve (){
        $current_user_data = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();
        $team =  DB::table('tf_reg')->where(['craneomania_team' => $current_user_data->craneomania_team])->get();
        if (!empty($team[0]->id)){DB::table('tf_reg')->where(['id' => $team[0]->id])->update(['craneomania_team'=> '']);}
        if (!empty($team[1]->id)){DB::table('tf_reg')->where(['id' => $team[1]->id])->update(['craneomania_team'=> '']);}
        if (!empty($team[2]->id)){DB::table('tf_reg')->where(['id' => $team[2]->id])->update(['craneomania_team'=> '']);}
        if (!empty($team[3]->id)){DB::table('tf_reg')->where(['id' => $team[3]->id])->update(['craneomania_team'=> '']);}
        return redirect("/competitions/craneomania");
    }


    public function codecode(Request $request){
        $client = $this->google_auth($request);
        if ($client) {
            $oauth2 = new Google_Service_Oauth2($client);
            $userInfo = $oauth2->userinfo->get();
            $user = DB::table('tf_reg')->where(['email' => $userInfo->email])->first();
            session(['user' => $user]);  //todo session started
            if (!$user) {
                DB::table('tf_reg')->insert(['email' => $userInfo->email, 'name' => $userInfo->name, 'picture' => $userInfo->picture, 'no_of_login' => '1']);
            }
            if ($user) {
                DB::table('tf_reg')->where(['email' => $user->email])->update(['picture' => $userInfo->picture]);
                $user_row = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();// return the first row containing the user(session wala user)
                if($user_row->codecode > 0 && empty($user_row->number)){
                    return redirect('/competitions/details_form');
                }
                return view("2019.competitions.codecode")->with(['user_row' => $user_row]);
            }
        }
        if(!isset($request->code) && !session()->has('user')) return view('2019.competitions.codecode');

        return redirect("/competitions/codecode/");
    }
    public function regcodecode(Request $request){
        $user_row = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();// return the first row containing the user(session wala user)
        DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->update(['codecode'=>'1']);
        $subject = "Welcome to CoDecode - Techfest, IIT Bombay";
        $txt = "Dear $user_row->name,

Greetings! 
You have successfully registered in CoDecode with $user_row->email as your registered mail Id. Now you must either Create a Team or Join a Team to complete the procedure.

Carefully read the FAQ’s of competitions carefully to know more.

Regards
";

        mail($user_row->email, $subject, $txt, "From:competitions@techfest.org" );
        return redirect("/competitions/codecode/");
    }
    public function codecode_create_team_form(Request $data){
        $current_user_data = DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
        return view("2019.competitions.create_teamform2")->with(['current_user_data'=>$current_user_data, 'form'=>"codecode"]);
    }
    public function codecode_join_team_form(Request $data){
        $current_user_data = DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
        return view("2019.competitions.join_teamform")->with(['current_user_data'=>$current_user_data,'form'=>"codecode"]);
    }
    public function codecode_leave_team(){
        if(session()->has('user')) {
            $current_team =  DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
            if(!empty($current_team->codecode_team)){
                DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->update(['codecode_team'=>'']);
                return redirect("/competitions/codecode");
            }
            else return "you are not in a team";
        }
    }
    public function codecode_create_team_reg(Request $data){
        if (session()->has('user')) {
            $current_user_data = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();
            $a = 190000;
            $b = $current_user_data->id;
            $team_id = $a +$b;
            DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['codecode_team' => $current_user_data->email, 'codecode_team_id'=> $team_id]);

            $p2_exist = DB::table('tf_reg')->where(['email'=>$data->email2])->first();
            if(!empty($data->email2)){if (!empty($p2_exist->email)) {
                $p2 = DB::table('tf_reg')->where(['email' => $data->email2])->first();
//                check if he is already in a team
                if (empty($p2->codecode_team)) {
                    DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['codecode_team' => $current_user_data->email, 'codecode_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email2])->update(['codecode_team' => $current_user_data->email, 'codecode_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email2])->update(['codecode' => '1']);



                    $subject2 = "CoDecode, Techfeat IIT Bomabay";
                    $txt2 = "Dear $p2_exist->name, you have been successfully added to $current_user_data->name's team for codecode .
Your Team ID and Registered Mail ID are very important and will be used in future.
You can leave your current team by clicking on Leave a Team. 
Regards.";

                    mail($p2_exist->email, $subject2, $txt2, "From:competitions@techfest.org" );



                    $subject0 = "CoDecode, Techfeat IIT Bomabay";
                    $txt0 = "Dear $current_user_data->name, your team is successfully created for codecode  
You are the Team Leader, you can Remove a Team member or Dissolve the existing team. Hoping to see you at Techfest  
Regards. ";

                    mail($current_user_data->email, $subject0, $txt0, "From:competitions@techfest.org" );


                } else return Redirect::back()->withErrors(["$p2->email is already in another team, he/she must leave current team first"]);

            } else return Redirect::back()->withErrors(["$data->email2 is not registered on techfest"]);}


            $p3_exist = DB::table('tf_reg')->where(['email'=>$data->email3])->first();
            if(!empty($data->email3)){if (!empty($p3_exist->email)) {
                $p3 = DB::table('tf_reg')->where(['email' => $data->email3])->first();
//                check if he is already in a team
                if (empty($p3->codecode_team)) {
                    DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['codecode_team' => $current_user_data->email, 'codecode_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email3])->update(['codecode_team' => $current_user_data->email, 'codecode_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email3])->update(['codecode' => '1']);



                    $subject2 = "CoDecode, Techfeat IIT Bomabay";
                    $txt1 = "Dear $p3_exist->name, you have been successfully added to $current_user_data->name's team for codecode .
Your Team ID and Registered Mail ID are very important and will be used in future.
You can leave your current team by clicking on Leave a Team. 
Regards.";

                    mail($p3_exist->email, $subject2, $txt2, "From:competitions@techfest.org" );


                } else return Redirect::back()->withErrors(["$p3->email is already in another team, he/she must leave current team first"]);

            } else return Redirect::back()->withErrors(["$data->email3 is not registered on techfest"]);}

            $p4_exist = DB::table('tf_reg')->where(['email'=>$data->email4])->first();
            if(!empty($data->email3)){if(!empty($p4_exist->email)) {
                $p4 = DB::table('tf_reg')->where(['email' => $data->email4])->first();
//                check if he is already in a team
                if (empty($p4->codecode_team)) {
                    DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['codecode_team' => $current_user_data->email, 'codecode_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email4])->update(['codecode_team' => $current_user_data->email, 'codecode_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email4])->update(['codecode' => '1']);



                    $subject4 = "CoDecode, Techfeat IIT Bomabay";
                    $txt4 = "Dear $p4_exist->name, you have been successfully added to $current_user_data->name's team for codecode .
Your Team ID and Registered Mail ID are very important and will be used in future.
You can leave your current team by clicking on Leave a Team. 
Regards.";

                    mail($p4_exist->email, $subject4, $txt4, "From:competitions@techfest.org" );



                } else return  Redirect::back()->withErrors(["$p4->email is already in another team, he/she must leave current team first"]);

            } else return Redirect::back()->withErrors(["$data->email4 is not registered on techfest"]);}

            return redirect("/competitions/codecode");

        } else return redirect("/competitions/codecode");
    }
    public function codecode_join_team_reg(Request $data){
        if(session()->has('user')) {
            $current_user_data = DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
            $team_member_row = DB::table('tf_reg')->where(['email'=>$data->email])->first();
            if(!empty($team_member_row->email)){
                $team_member_count = DB::table('tf_reg')->where(['codecode_team' => $team_member_row->codecode_team])->count();
                if(empty($current_user_data->codecode_team)){
                    if($team_member_count <= 1 ){
                        if(!empty($data->email)){DB::table('tf_reg')->where(['email'=>$current_user_data->email])->update(['codecode_team'=>$team_member_row->codecode_team]);}
                        return redirect("/competitions/codecode");
                    }
                    else return Redirect::back()->withErrors(["Team does not exist /Team already full"]);
                }
                else return Redirect::back()->withErrors(["you are already registered in a team, drop current team to join new one"]);
            }
            else return Redirect::back()->withErrors(["$data->email is not registered on Techfest"]);
        }
        else return Redirect::back()->withErrors(["first signin"]);
    }
    public function codecode_remove_member (Request $request, $id){
        $user_row = DB::table('tf_reg')->where(['id' => $id])->first();
        $subject = "codecode, Techfeat IIT Bomabay";
        $txt = "Dear $user_row->name, you have been removed from the codecode Team by your team leader $user_row->codecode_team which had team id zzz, you can either join another team or create your own team as a single member if you want.";

        mail($user_row->email, $subject, $txt, "From:competitions@techfest.org" );

        DB::table('tf_reg')->where(['id' => $id])->update(['codecode_team'=> '']);

        return redirect("/competitions/codecode");
    }
    public function codecode_dissolve (){
        $current_user_data = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();
        $team =  DB::table('tf_reg')->where(['codecode_team' => $current_user_data->codecode_team])->get();
        if (!empty($team[0]->id)){DB::table('tf_reg')->where(['id' => $team[0]->id])->update(['codecode_team'=> '']);}
        if (!empty($team[1]->id)){DB::table('tf_reg')->where(['id' => $team[1]->id])->update(['codecode_team'=> '']);}
        if (!empty($team[2]->id)){DB::table('tf_reg')->where(['id' => $team[2]->id])->update(['codecode_team'=> '']);}
        if (!empty($team[3]->id)){DB::table('tf_reg')->where(['id' => $team[3]->id])->update(['codecode_team'=> '']);}
        return redirect("/competitions/codecode");
    }

    public function wcodecode(Request $request){
        $client = $this->google_auth($request);
        if ($client) {
            $oauth2 = new Google_Service_Oauth2($client);
            $userInfo = $oauth2->userinfo->get();
            $user = DB::table('tf_reg')->where(['email' => $userInfo->email])->first();
            session(['user' => $user]);  //todo session started
            if (!$user) {
                DB::table('tf_reg')->insert(['email' => $userInfo->email, 'name' => $userInfo->name, 'picture' => $userInfo->picture, 'no_of_login' => '1']);
            }
            if ($user) {
                DB::table('tf_reg')->where(['email' => $user->email])->update(['picture' => $userInfo->picture]);
                $user_row = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();// return the first row containing the user(session wala user)
                if($user_row->wcodecode > 0 && empty($user_row->number)){
                    return redirect('/competitions/details_form');
                }
                return view("2019.competitions.wcodecode")->with(['user_row' => $user_row]);
            }
        }
        if(!isset($request->code) && !session()->has('user')) return view('2019.competitions.wcodecode');

        return redirect("/competitions/wcodecode/");
    }
    public function regwcodecode(Request $request){
        $user_row = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();// return the first row containing the user(session wala user)
        DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->update(['wcodecode'=>'1']);
        $subject = "Welcome to Codecode - Techfest, IIT Bombay";
        $txt = "Dear $user_row->name,

Greetings! 
You have successfully registered in CoDecode with $user_row->email as your registered mail Id. Now you must either Create a Team or Join a Team to complete the procedure.

Carefully read the FAQ’s of competitions carefully to know more.

Regards
";

        mail($user_row->email, $subject, $txt, "From:competitions@techfest.org" );
        return redirect("/competitions/wcodecode/");
    }
    public function wcodecode_create_team_form(Request $data){
        $current_user_data = DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
        return view("2019.competitions.create_teamform2")->with(['current_user_data'=>$current_user_data, 'form'=>"wcodecode"]);
    }
    public function wcodecode_join_team_form(Request $data){
        $current_user_data = DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
        return view("2019.competitions.join_teamform")->with(['current_user_data'=>$current_user_data,'form'=>"wcodecode"]);
    }
    public function wcodecode_leave_team(){
        if(session()->has('user')) {
            $current_team =  DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
            if(!empty($current_team->wcodecode_team)){
                DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->update(['wcodecode_team'=>'']);
                return redirect("/competitions/wcodecode");
            }
            else return "you are not in a team";
        }
    }
    public function wcodecode_create_team_reg(Request $data){
        if (session()->has('user')) {
            $current_user_data = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();
            $a = 190000;
            $b = $current_user_data->id;
            $team_id = $a +$b;
            DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['wcodecode_team' => $current_user_data->email, 'wcodecode_team_id'=> $team_id]);

            $p2_exist = DB::table('tf_reg')->where(['email'=>$data->email2])->first();
            if(!empty($data->email2)){if (!empty($p2_exist->email)) {
                $p2 = DB::table('tf_reg')->where(['email' => $data->email2])->first();
//                check if he is already in a team
                if (empty($p2->wcodecode_team)) {
                    DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['wcodecode_team' => $current_user_data->email, 'wcodecode_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email2])->update(['wcodecode_team' => $current_user_data->email, 'wcodecode_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email2])->update(['wcodecode' => '1']);



                    $subject2 = "CoDecode, Techfeat IIT Bomabay";
                    $txt2 = "Dear $p2_exist->name, you have been successfully added to $current_user_data->name's team for codecode .
Your Team ID and Registered Mail ID are very important and will be used in future.
You can leave your current team by clicking on Leave a Team. 
Regards.";

                    mail($p2_exist->email, $subject2, $txt2, "From:competitions@techfest.org" );



                    $subject0 = "CoDecode, Techfeat IIT Bomabay";
                    $txt0 = "Dear $current_user_data->name, your team is successfully created for codecode  
You are the Team Leader, you can Remove a Team member or Dissolve the existing team. Hoping to see you at Techfest  
Regards. ";

                    mail($current_user_data->email, $subject0, $txt0, "From:competitions@techfest.org" );


                } else return Redirect::back()->withErrors(["$p2->email is already in another team, he/she must leave current team first"]);

            } else return Redirect::back()->withErrors(["$data->email2 is not registered on techfest"]);}


            $p3_exist = DB::table('tf_reg')->where(['email'=>$data->email3])->first();
            if(!empty($data->email3)){if (!empty($p3_exist->email)) {
                $p3 = DB::table('tf_reg')->where(['email' => $data->email3])->first();
//                check if he is already in a team
                if (empty($p3->wcodecode_team)) {
                    DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['wcodecode_team' => $current_user_data->email, 'wcodecode_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email3])->update(['wcodecode_team' => $current_user_data->email, 'wcodecode_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email3])->update(['wcodecode' => '1']);



                    $subject2 = "CoDecode, Techfeat IIT Bomabay";
                    $txt1 = "Dear $p3_exist->name, you have been successfully added to $current_user_data->name's team for codecode .
Your Team ID and Registered Mail ID are very important and will be used in future.
You can leave your current team by clicking on Leave a Team. 
Regards.";

                    mail($p3_exist->email, $subject2, $txt2, "From:competitions@techfest.org" );


                } else return Redirect::back()->withErrors(["$p3->email is already in another team, he/she must leave current team first"]);

            } else return Redirect::back()->withErrors(["$data->email3 is not registered on techfest"]);}

            $p4_exist = DB::table('tf_reg')->where(['email'=>$data->email4])->first();
            if(!empty($data->email3)){if(!empty($p4_exist->email)) {
                $p4 = DB::table('tf_reg')->where(['email' => $data->email4])->first();
//                check if he is already in a team
                if (empty($p4->wcodecode_team)) {
                    DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['wcodecode_team' => $current_user_data->email, 'wcodecode_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email4])->update(['wcodecode_team' => $current_user_data->email, 'wcodecode_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email4])->update(['wcodecode' => '1']);



                    $subject4 = "CoDecode, Techfeat IIT Bomabay";
                    $txt4 = "Dear $p4_exist->name, you have been successfully added to $current_user_data->name's team for codecode .
Your Team ID and Registered Mail ID are very important and will be used in future.
You can leave your current team by clicking on Leave a Team. 
Regards.";

                    mail($p4_exist->email, $subject4, $txt4, "From:competitions@techfest.org" );



                } else return  Redirect::back()->withErrors(["$p4->email is already in another team, he/she must leave current team first"]);

            } else return Redirect::back()->withErrors(["$data->email4 is not registered on techfest"]);}

            return redirect("/competitions/wcodecode");

        } else return redirect("/competitions/wcodecode");
    }
    public function wcodecode_join_team_reg(Request $data){
        if(session()->has('user')) {
            $current_user_data = DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
            $team_member_row = DB::table('tf_reg')->where(['email'=>$data->email])->first();
            if(!empty($team_member_row->email)){
                $team_member_count = DB::table('tf_reg')->where(['wcodecode_team' => $team_member_row->wcodecode_team])->count();
                if(empty($current_user_data->wcodecode_team)){
                    if($team_member_count <= 1 ){
                        if(!empty($data->email)){DB::table('tf_reg')->where(['email'=>$current_user_data->email])->update(['wcodecode_team'=>$team_member_row->wcodecode_team]);}
                        return redirect("/competitions/wcodecode");
                    }
                    else return Redirect::back()->withErrors(["Team does not exist /Team already full"]);
                }
                else return Redirect::back()->withErrors(["you are already registered in a team, drop current team to join new one"]);
            }
            else return Redirect::back()->withErrors(["$data->email is not registered on Techfest"]);
        }
        else return Redirect::back()->withErrors(["first signin"]);
    }
    public function wcodecode_remove_member (Request $request, $id){
        $user_row = DB::table('tf_reg')->where(['id' => $id])->first();
        $subject = "codecode, Techfeat IIT Bomabay";
        $txt = "Dear $user_row->name, you have been removed from the codecode Team by your team leader $user_row->wcodecode_team which had team id zzz, you can either join another team or create your own team as a single member if you want.";

        mail($user_row->email, $subject, $txt, "From:competitions@techfest.org" );

        DB::table('tf_reg')->where(['id' => $id])->update(['wcodecode_team'=> '']);

        return redirect("/competitions/wcodecode");
    }
    public function wcodecode_dissolve (){
        $current_user_data = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();
        $team =  DB::table('tf_reg')->where(['wcodecode_team' => $current_user_data->wcodecode_team])->get();
        if (!empty($team[0]->id)){DB::table('tf_reg')->where(['id' => $team[0]->id])->update(['wcodecode_team'=> '']);}
        if (!empty($team[1]->id)){DB::table('tf_reg')->where(['id' => $team[1]->id])->update(['wcodecode_team'=> '']);}
        if (!empty($team[2]->id)){DB::table('tf_reg')->where(['id' => $team[2]->id])->update(['wcodecode_team'=> '']);}
        if (!empty($team[3]->id)){DB::table('tf_reg')->where(['id' => $team[3]->id])->update(['wcodecode_team'=> '']);}
        return redirect("/competitions/wcodecode");
    }

    public function inspire(Request $request){
        $client = $this->google_auth($request);
        if ($client) {
            $oauth2 = new Google_Service_Oauth2($client);
            $userInfo = $oauth2->userinfo->get();
            $user = DB::table('tf_reg')->where(['email' => $userInfo->email])->first();
            session(['user' => $user]);  //todo session started
            if (!$user) {
                DB::table('tf_reg')->insert(['email' => $userInfo->email, 'name' => $userInfo->name, 'picture' => $userInfo->picture, 'no_of_login' => '1']);
            }
            if ($user) {
                DB::table('tf_reg')->where(['email' => $user->email])->update(['picture' => $userInfo->picture]);
                $user_row = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();// return the first row containing the user(session wala user)
                if($user_row->inspire > 0 && empty($user_row->number)){
                    return redirect('/competitions/details_form');
                }
                return view("2019.competitions.inspire")->with(['user_row' => $user_row]);
            }
        }
        if(!isset($request->code) && !session()->has('user')) return view('2019.competitions.inspire');

        return redirect("/competitions/inspire/");
    }
    public function reginspire(Request $request){
        $user_row = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();// return the first row containing the user(session wala user)
        DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->update(['inspire'=>'1']);
        $subject = "Welcome to Codecode - Techfest, IIT Bombay";
        $txt = "Dear $user_row->name,

Greetings! 
You have successfully registered in Inspire with. ORG with $user_row->email as your registered mail Id. Now you must either Create a Team or Join a Team to complete the procedure.

Carefully read the FAQ’s of competitions carefully to know more.

Regards
";

        mail($user_row->email, $subject, $txt, "From:competitions@techfest.org" );
        return redirect("/competitions/inspire/");
    }
    public function inspire_create_team_form(Request $data){
        $current_user_data = DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
        return view("2019.competitions.create_teamform2")->with(['current_user_data'=>$current_user_data, 'form'=>"inspire"]);
    }
    public function inspire_join_team_form(Request $data){
        $current_user_data = DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
        return view("2019.competitions.join_teamform")->with(['current_user_data'=>$current_user_data,'form'=>"inspire"]);
    }
    public function inspire_leave_team(){
        if(session()->has('user')) {
            $current_team =  DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
            if(!empty($current_team->inspire_team)){
                DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->update(['inspire_team'=>'']);
                return redirect("/competitions/inspire");
            }
            else return "you are not in a team";
        }
    }
    public function inspire_create_team_reg(Request $data){
        if (session()->has('user')) {
            $current_user_data = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();
            $a = 190000;
            $b = $current_user_data->id;
            $team_id = $a +$b;
            DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['inspire_team' => $current_user_data->email, 'inspire_team_id'=> $team_id]);

            $p2_exist = DB::table('tf_reg')->where(['email'=>$data->email2])->first();
            if(!empty($data->email2)){if (!empty($p2_exist->email)) {
                $p2 = DB::table('tf_reg')->where(['email' => $data->email2])->first();
//                check if he is already in a team
                if (empty($p2->inspire_team)) {
                    DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['inspire_team' => $current_user_data->email, 'inspire_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email2])->update(['inspire_team' => $current_user_data->email, 'inspire_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email2])->update(['inspire' => '1']);



                    $subject2 = "Inspire with. ORG, Techfeat IIT Bomabay";
                    $txt2 = "Dear $p2_exist->name, you have been successfully added to $current_user_data->name's team for Inspire with. ORG .
Your Team ID and Registered Mail ID are very important and will be used in future.
You can leave your current team by clicking on Leave a Team. 
Regards.";

                    mail($p2_exist->email, $subject2, $txt2, "From:competitions@techfest.org" );



                    $subject0 = "Inspire with. ORG, Techfeat IIT Bomabay";
                    $txt0 = "Dear $current_user_data->name, your team is successfully created for Inspire with. ORG  
You are the Team Leader, you can Remove a Team member or Dissolve the existing team. Hoping to see you at Techfest  
Regards. ";

                    mail($current_user_data->email, $subject0, $txt0, "From:competitions@techfest.org" );


                } else return Redirect::back()->withErrors(["$p2->email is already in another team, he/she must leave current team first"]);

            } else return Redirect::back()->withErrors(["$data->email2 is not registered on techfest"]);}


            $p3_exist = DB::table('tf_reg')->where(['email'=>$data->email3])->first();
            if(!empty($data->email3)){if (!empty($p3_exist->email)) {
                $p3 = DB::table('tf_reg')->where(['email' => $data->email3])->first();
//                check if he is already in a team
                if (empty($p3->inspire_team)) {
                    DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['inspire_team' => $current_user_data->email, 'inspire_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email3])->update(['inspire_team' => $current_user_data->email, 'inspire_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email3])->update(['inspire' => '1']);



                    $subject2 = "Inspire with. ORG, Techfeat IIT Bomabay";
                    $txt1 = "Dear $p3_exist->name, you have been successfully added to $current_user_data->name's team for Inspire with. ORG .
Your Team ID and Registered Mail ID are very important and will be used in future.
You can leave your current team by clicking on Leave a Team. 
Regards.";

                    mail($p3_exist->email, $subject2, $txt2, "From:competitions@techfest.org" );


                } else return Redirect::back()->withErrors(["$p3->email is already in another team, he/she must leave current team first"]);

            } else return Redirect::back()->withErrors(["$data->email3 is not registered on techfest"]);}

            $p4_exist = DB::table('tf_reg')->where(['email'=>$data->email4])->first();
            if(!empty($data->email3)){if(!empty($p4_exist->email)) {
                $p4 = DB::table('tf_reg')->where(['email' => $data->email4])->first();
//                check if he is already in a team
                if (empty($p4->inspire_team)) {
                    DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['inspire_team' => $current_user_data->email, 'inspire_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email4])->update(['inspire_team' => $current_user_data->email, 'inspire_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email4])->update(['inspire' => '1']);



                    $subject4 = "Inspire with. ORG, Techfeat IIT Bomabay";
                    $txt4 = "Dear $p4_exist->name, you have been successfully added to $current_user_data->name's team for Inspire with. ORG .
Your Team ID and Registered Mail ID are very important and will be used in future.
You can leave your current team by clicking on Leave a Team. 
Regards.";

                    mail($p4_exist->email, $subject4, $txt4, "From:competitions@techfest.org" );



                } else return  Redirect::back()->withErrors(["$p4->email is already in another team, he/she must leave current team first"]);

            } else return Redirect::back()->withErrors(["$data->email4 is not registered on techfest"]);}

            return redirect("/competitions/inspire");

        } else return redirect("/competitions/inspire");
    }
    public function inspire_join_team_reg(Request $data){
        if(session()->has('user')) {
            $current_user_data = DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
            $team_member_row = DB::table('tf_reg')->where(['email'=>$data->email])->first();
            if(!empty($team_member_row->email)){
                $team_member_count = DB::table('tf_reg')->where(['inspire_team' => $team_member_row->inspire_team])->count();
                if(empty($current_user_data->inspire_team)){
                    if($team_member_count <= 1 ){
                        if(!empty($data->email)){DB::table('tf_reg')->where(['email'=>$current_user_data->email])->update(['inspire_team'=>$team_member_row->inspire_team]);}
                        return redirect("/competitions/inspire");
                    }
                    else return Redirect::back()->withErrors(["Team does not exist /Team already full"]);
                }
                else return Redirect::back()->withErrors(["you are already registered in a team, drop current team to join new one"]);
            }
            else return Redirect::back()->withErrors(["$data->email is not registered on Techfest"]);
        }
        else return Redirect::back()->withErrors(["first signin"]);
    }
    public function inspire_remove_member (Request $request, $id){
        $user_row = DB::table('tf_reg')->where(['id' => $id])->first();
        $subject = "Inspire with. ORG, Techfeat IIT Bomabay";
        $txt = "Dear $user_row->name, you have been removed from the Inspire with. ORG Team by your team leader $user_row->inspire_team which had team id zzz, you can either join another team or create your own team as a single member if you want.";

        mail($user_row->email, $subject, $txt, "From:competitions@techfest.org" );

        DB::table('tf_reg')->where(['id' => $id])->update(['inspire_team'=> '']);

        return redirect("/competitions/inspire");
    }
    public function inspire_dissolve (){
        $current_user_data = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();
        $team =  DB::table('tf_reg')->where(['inspire_team' => $current_user_data->inspire_team])->get();
        if (!empty($team[0]->id)){DB::table('tf_reg')->where(['id' => $team[0]->id])->update(['inspire_team'=> '']);}
        if (!empty($team[1]->id)){DB::table('tf_reg')->where(['id' => $team[1]->id])->update(['inspire_team'=> '']);}
        if (!empty($team[2]->id)){DB::table('tf_reg')->where(['id' => $team[2]->id])->update(['inspire_team'=> '']);}
        if (!empty($team[3]->id)){DB::table('tf_reg')->where(['id' => $team[3]->id])->update(['inspire_team'=> '']);}
        return redirect("/competitions/inspire");
    }


    public function tso(Request $request){
        $client = $this->google_auth($request);
        if ($client) {
            $oauth2 = new Google_Service_Oauth2($client);
            $userInfo = $oauth2->userinfo->get();
            $user = DB::table('tf_reg')->where(['email' => $userInfo->email])->first();
            session(['user' => $user]);  //todo session started
            if (!$user) {
                DB::table('tf_reg')->insert(['email' => $userInfo->email, 'name' => $userInfo->name, 'picture' => $userInfo->picture, 'no_of_login' => '1']);
            }
            if ($user) {
                DB::table('tf_reg')->where(['email' => $user->email])->update(['picture' => $userInfo->picture]);
                $user_row = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();// return the first row containing the user(session wala user)
                if($user_row->tso > 0 && empty($user_row->number)){
                    return redirect('/competitions/details_form_school');
                }
                return view("2019.competitions.tso")->with(['user_row' => $user_row]);
            }
        }
        if(!isset($request->code) && !session()->has('user')) return view('2019.competitions.tso');

        return redirect("/competitions/tso/");
    }
    public function regtso(Request $request){
        $user_row = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();// return the first row containing the user(session wala user)
        DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->update(['tso'=>'1']);
        $subject = "Welcome to the Techfest Olympiad";
        $txt = "Dear $user_row->name,

Greetings! 
You have successfully registered in Techfest Olympiad with $user_row->email as your registered mail Id. Now you must either Create a Team or Join a Team to complete the procedure.

Carefully read the FAQ’s of competitions carefully to know more.

Regards
";

        mail($user_row->email, $subject, $txt, "From:competitions@techfest.org" );
        return redirect("/competitions/tso/");
    }
    public function tso_create_team_form(Request $data){
        $current_user_data = DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
        return view("2019.competitions.create_teamform2")->with(['current_user_data'=>$current_user_data, 'form'=>"tso"]);
    }
    public function tso_join_team_form(Request $data){
        $current_user_data = DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
        return view("2019.competitions.join_teamform")->with(['current_user_data'=>$current_user_data, 'form'=>"tso"]);
    }
    public function tso_leave_team(){
        if(session()->has('user')) {
            $current_team =  DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
            if(!empty($current_team->tso_team)){
                DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->update(['tso_team'=>'']);
                return redirect("/competitions/tso");
            }
            else return "you are not in a team";
        }
    }
    public function tso_create_team_reg(Request $data){
        if (session()->has('user')) {
            $current_user_data = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();
            $a = 190000;
            $b = $current_user_data->id;
            $team_id = $a +$b;
            DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['tso_team' => $current_user_data->email, 'tso_team_id'=> $team_id]);

            $p2_exist = DB::table('tf_reg')->where(['email'=>$data->email2])->first();
            if(!empty($data->email2)){if (!empty($p2_exist->email)) {
                $p2 = DB::table('tf_reg')->where(['email' => $data->email2])->first();
//                check if he is already in a team
                if (empty($p2->tso_team)) {
                    DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['tso_team' => $current_user_data->email, 'tso_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email2])->update(['tso_team' => $current_user_data->email, 'tso_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email2])->update(['tso' => '1']);



                    $subject2 = "Techfest Olympiad - Techfeat IIT Bomabay";
                    $txt2 = "Dear $p2_exist->name, you have been successfully added to $current_user_data->name's team for tso .
Your Team ID and Registered Mail ID are very important and will be used in future.
You can leave your current team by clicking on Leave a Team. 
Regards.";

                    mail($p2_exist->email, $subject2, $txt2, "From:competitions@techfest.org" );



                    $subject0 = "Techfest Olympiad - Techfeat IIT Bomabay";
                    $txt0 = "Dear $current_user_data->name, your team is successfully created for tso  
You are the Team Leader, you can Remove a Team member or Dissolve the existing team. Hoping to see you at Techfest  
Regards. ";

                    mail($current_user_data->email, $subject0, $txt0, "From:competitions@techfest.org" );


                } else return Redirect::back()->withErrors(["$p2->email is already in another team, he/she must leave current team first"]);

            } else return Redirect::back()->withErrors(["$data->email2 is not registered on techfest"]);}

            return redirect("/competitions/tso");

        } else return redirect("/competitions/tso");
    }
    public function tso_join_team_reg(Request $data){
        if(session()->has('user')) {
            $current_user_data = DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
            $team_member_row = DB::table('tf_reg')->where(['email'=>$data->email])->first();
            if(!empty($team_member_row->email)){
                $team_member_count = DB::table('tf_reg')->where(['tso_team' => $team_member_row->tso_team])->count();

                if(empty($current_user_data->tso_team)){
                    if($team_member_count <= 1 ){
                        if(!empty($data->email)){DB::table('tf_reg')->where(['email'=>$current_user_data->email])->update(['tso_team'=>$team_member_row->tso_team]);}
                        return redirect("/competitions/tso");
                    }
                    else return Redirect::back()->withErrors(["Team does not exist /Team already full"]);
                }
                else return Redirect::back()->withErrors(["you are already registered in a team, drop current team to join new one"]);
            }
            else return Redirect::back()->withErrors(["$data->email is not registered on Techfest"]);

        }
        else return Redirect::back()->withErrors(["first signin"]);
    }
    public function tso_remove_member (Request $request, $id){
        $current_user_data = DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
        $user_row = DB::table('tf_reg')->where(['id' => $id])->first();
        if($current_user_data->id != $id){
            $subject = "Techfest Olympiad - Techfeat IIT Bomabay";
            $txt = "Dear $user_row->name, you have been removed from the tso Team by your team leader $user_row->tso_team which had team id zzz, you can either join another team or create your own team as a single member if you want.";

            mail($user_row->email, $subject, $txt, "From:competitions@techfest.org" );

            DB::table('tf_reg')->where(['id' => $id])->update(['tso_team'=> '']);
        }

        return redirect("/competitions/tso");
    }
    public function tso_dissolve (){
        $current_user_data = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();
        $team =  DB::table('tf_reg')->where(['tso_team' => $current_user_data->tso_team])->get();
        if (!empty($team[0]->id)){DB::table('tf_reg')->where(['id' => $team[0]->id])->update(['tso_team'=> '']);}
        if (!empty($team[1]->id)){DB::table('tf_reg')->where(['id' => $team[1]->id])->update(['tso_team'=> '']);}
        if (!empty($team[2]->id)){DB::table('tf_reg')->where(['id' => $team[2]->id])->update(['tso_team'=> '']);}
        if (!empty($team[3]->id)){DB::table('tf_reg')->where(['id' => $team[3]->id])->update(['tso_team'=> '']);}
        return redirect("/competitions/tso");
    }


    public function micromouse(Request $request){
        $client = $this->google_auth($request);
        if ($client) {
            $oauth2 = new Google_Service_Oauth2($client);
            $userInfo = $oauth2->userinfo->get();
            $user = DB::table('tf_reg')->where(['email' => $userInfo->email])->first();
            session(['user' => $user]);  //todo session started
            if (!$user) {
                DB::table('tf_reg')->insert(['email' => $userInfo->email, 'name' => $userInfo->name, 'picture' => $userInfo->picture, 'no_of_login' => '1']);
            }
            if ($user) {
                DB::table('tf_reg')->where(['email' => $user->email])->update(['picture' => $userInfo->picture]);
                $user_row = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();// return the first row containing the user(session wala user)
                if($user_row->micromouse > 0 && empty($user_row->number)){
                    return redirect('/competitions/details_form');
                }
                return view("2019.competitions.micromouse")->with(['user_row' => $user_row]);
            }
        }
        if(!isset($request->code) && !session()->has('user')) return view('2019.competitions.micromouse');

        return redirect("/competitions/micromouse/");
    }
    public function regmicromouse(Request $request){
        $user_row = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();// return the first row containing the user(session wala user)
        DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->update(['micromouse'=>'1']);
        $subject = "Welcome to Micromouse - Techfest, IIT Bombay";
        $txt = "Dear $user_row->name,

Greetings! 
You have successfully registered in Micromouse with $user_row->email as your registered mail Id. Now you must either Create a Team or Join a Team to complete the procedure.

Carefully read the FAQ’s of competitions carefully to know more.

Regards
";

        mail($user_row->email, $subject, $txt, "From:competitions@techfest.org" );
        return redirect("/competitions/micromouse/");
    }
    public function micromouse_create_team_form(Request $data){
        $current_user_data = DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
        return view("2019.competitions.create_teamform")->with(['current_user_data'=>$current_user_data, 'form'=>"micromouse"]);
    }
    public function micromouse_join_team_form(Request $data){
        $current_user_data = DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
        return view("2019.competitions.join_teamform")->with(['current_user_data'=>$current_user_data, 'form'=>"micromouse"]);
    }
    public function micromouse_leave_team(){
        if(session()->has('user')) {
            $current_team =  DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
            if(!empty($current_team->micromouse_team)){
                DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->update(['micromouse_team'=>'']);
                return redirect("/competitions/micromouse");
            }
            else return "you are not in a team";
        }
    }
    public function micromouse_create_team_reg(Request $data){
        if (session()->has('user')) {
            $current_user_data = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();
            $a = 190000;
            $b = $current_user_data->id;
            $team_id = $a +$b;
            DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['micromouse_team' => $current_user_data->email, 'micromouse_team_id'=> $team_id]);

            $p2_exist = DB::table('tf_reg')->where(['email'=>$data->email2])->first();
            if(!empty($data->email2)){if (!empty($p2_exist->email)) {
                $p2 = DB::table('tf_reg')->where(['email' => $data->email2])->first();
//                check if he is already in a team
                if (empty($p2->micromouse_team)) {
                    DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['micromouse_team' => $current_user_data->email, 'micromouse_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email2])->update(['micromouse_team' => $current_user_data->email, 'micromouse_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email2])->update(['micromouse' => '1']);



                    $subject2 = "Micromouse, Techfeat IIT Bomabay";
                    $txt2 = "Dear $p2_exist->name, you have been successfully added to $current_user_data->name's team for micromouse .
Your Team ID and Registered Mail ID are very important and will be used in future.
You can leave your current team by clicking on Leave a Team. 
Regards.";

                    mail($p2_exist->email, $subject2, $txt2, "From:competitions@techfest.org" );



                    $subject0 = "Micromouse, Techfeat IIT Bomabay";
                    $txt0 = "Dear $current_user_data->name, your team is successfully created for micromouse  
You are the Team Leader, you can Remove a Team member or Dissolve the existing team. Hoping to see you at Techfest  
Regards. ";

                    mail($current_user_data->email, $subject0, $txt0, "From:competitions@techfest.org" );


                } else return Redirect::back()->withErrors(["$p2->email is already in another team, he/she must leave current team first"]);

            } else return Redirect::back()->withErrors(["$data->email2 is not registered on techfest"]);}


            $p3_exist = DB::table('tf_reg')->where(['email'=>$data->email3])->first();
            if(!empty($data->email3)){if (!empty($p3_exist->email)) {
                $p3 = DB::table('tf_reg')->where(['email' => $data->email3])->first();
//                check if he is already in a team
                if (empty($p3->micromouse_team)) {
                    DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['micromouse_team' => $current_user_data->email, 'micromouse_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email3])->update(['micromouse_team' => $current_user_data->email, 'micromouse_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email3])->update(['micromouse' => '1']);



                    $subject2 = "Micromouse, Techfeat IIT Bomabay";
                    $txt1 = "Dear $p3_exist->name, you have been successfully added to $current_user_data->name's team for micromouse .
Your Team ID and Registered Mail ID are very important and will be used in future.
You can leave your current team by clicking on Leave a Team. 
Regards.";

                    mail($p3_exist->email, $subject2, $txt2, "From:competitions@techfest.org" );


                } else return Redirect::back()->withErrors(["$p3->email is already in another team, he/she must leave current team first"]);

            } else return Redirect::back()->withErrors(["$data->email3 is not registered on techfest"]);}

            $p4_exist = DB::table('tf_reg')->where(['email'=>$data->email4])->first();
            if(!empty($data->email3)){if(!empty($p4_exist->email)) {
                $p4 = DB::table('tf_reg')->where(['email' => $data->email4])->first();
//                check if he is already in a team
                if (empty($p4->micromouse_team)) {
                    DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['micromouse_team' => $current_user_data->email, 'micromouse_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email4])->update(['micromouse_team' => $current_user_data->email, 'micromouse_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email4])->update(['micromouse' => '1']);



                    $subject4 = "Micromouse, Techfeat IIT Bomabay";
                    $txt4 = "Dear $p4_exist->name, you have been successfully added to $current_user_data->name's team for micromouse .
Your Team ID and Registered Mail ID are very important and will be used in future.
You can leave your current team by clicking on Leave a Team. 
Regards.";

                    mail($p4_exist->email, $subject4, $txt4, "From:competitions@techfest.org" );



                } else return  Redirect::back()->withErrors(["$p4->email is already in another team, he/she must leave current team first"]);

            } else return Redirect::back()->withErrors(["$data->email4 is not registered on techfest"]);}

            return redirect("/competitions/micromouse");

        } else return redirect("/competitions/micromouse");
    }
    public function micromouse_join_team_reg(Request $data){
        if(session()->has('user')) {
            $current_user_data = DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
            $team_member_row = DB::table('tf_reg')->where(['email'=>$data->email])->first();
            if(!empty($team_member_row->email)){
                $team_member_count = DB::table('tf_reg')->where(['micromouse_team' => $team_member_row->micromouse_team])->count();

                if(empty($current_user_data->micromouse_team)){
                    if($team_member_count <= 4 ){
                        if(!empty($data->email)){DB::table('tf_reg')->where(['email'=>$current_user_data->email])->update(['micromouse_team'=>$team_member_row->micromouse_team]);}
                        return redirect("/competitions/micromouse");
                    }
                    else return Redirect::back()->withErrors(["Team does not exist /Team already full"]);
                }
                else return Redirect::back()->withErrors(["you are already registered in a team, drop current team to join new one"]);
            }
            else return Redirect::back()->withErrors(["$data->email is not registered on Techfest"]);

        }
        else return Redirect::back()->withErrors(["first signin"]);
    }
    public function micromouse_remove_member (Request $request, $id){
        $current_user_data = DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
        if($current_user_data->id != $id) {
            $user_row = DB::table('tf_reg')->where(['id' => $id])->first();
            $subject = "Micromouse, Techfeat IIT Bomabay";
            $txt = "Dear $user_row->name, you have been removed from the micromouse Team by your team leader $user_row->micromouse_team which had team id zzz, you can either join another team or create your own team as a single member if you want.";

            mail($user_row->email, $subject, $txt, "From:competitions@techfest.org");

            DB::table('tf_reg')->where(['id' => $id])->update(['micromouse_team' => '']);
        }
        return redirect("/competitions/micromouse");
    }
    public function micromouse_dissolve (){
        $current_user_data = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();
        $team =  DB::table('tf_reg')->where(['micromouse_team' => $current_user_data->micromouse_team])->get();
        if (!empty($team[0]->id)){DB::table('tf_reg')->where(['id' => $team[0]->id])->update(['micromouse_team'=> '']);}
        if (!empty($team[1]->id)){DB::table('tf_reg')->where(['id' => $team[1]->id])->update(['micromouse_team'=> '']);}
        if (!empty($team[2]->id)){DB::table('tf_reg')->where(['id' => $team[2]->id])->update(['micromouse_team'=> '']);}
        if (!empty($team[3]->id)){DB::table('tf_reg')->where(['id' => $team[3]->id])->update(['micromouse_team'=> '']);}
        return redirect("/competitions/micromouse");
    }

    public function earthmatters(Request $request){
        $client = $this->google_auth($request);
        if ($client) {
            $oauth2 = new Google_Service_Oauth2($client);
            $userInfo = $oauth2->userinfo->get();
            $user = DB::table('tf_reg')->where(['email' => $userInfo->email])->first();
            session(['user' => $user]);  //todo session started
            if (!$user) {
                DB::table('tf_reg')->insert(['email' => $userInfo->email, 'name' => $userInfo->name, 'picture' => $userInfo->picture, 'no_of_login' => '1']);
            }
            if ($user) {
                DB::table('tf_reg')->where(['email' => $user->email])->update(['picture' => $userInfo->picture]);
                $user_row = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();// return the first row containing the user(session wala user)
                if($user_row->earthmatters > 0 && empty($user_row->number)){
                    return redirect('/competitions/details_form_2');
                }
                return view("2019.competitions.earthmatters")->with(['user_row' => $user_row]);
            }
        }
        if(!isset($request->code) && !session()->has('user')) return view('2019.competitions.earthmatters');

        return redirect("/competitions/earthmatters/");
    }
    public function regearthmatters(Request $request){
        $user_row = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();// return the first row containing the user(session wala user)
        DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->update(['earthmatters'=>'1']);
        $subject = "Welcome to Earth Matters - Techfest, IIT Bombay";
        $txt = "Dear $user_row->name,

Greetings! 
You have successfully registered in Earth Matters with $user_row->email as your registered mail Id. Now you must either Create a Team or Join a Team to complete the procedure.

Carefully read the FAQ’s of competitions carefully to know more.

Regards
";

        mail($user_row->email, $subject, $txt, "From:competitions@techfest.org" );
        return redirect("/competitions/earthmatters/");
    }
    public function earthmatters_create_team_form(Request $data){
        $current_user_data = DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
        return view("2019.competitions.create_teamform")->with(['current_user_data'=>$current_user_data, 'form'=>"earthmatters"]);
    }
    public function earthmatters_join_team_form(Request $data){
        $current_user_data = DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
        return view("2019.competitions.join_teamform")->with(['current_user_data'=>$current_user_data, 'form'=>"earthmatters"]);
    }
    public function earthmatters_leave_team(){
        if(session()->has('user')) {
            $current_team =  DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
            if(!empty($current_team->earthmatters_team)){
                DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->update(['earthmatters_team'=>'']);
                return redirect("/competitions/earthmatters");
            }
            else return "you are not in a team";
        }
    }
    public function earthmatters_create_team_reg(Request $data){
        if (session()->has('user')) {
            $current_user_data = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();
            $a = 190000;
            $b = $current_user_data->id;
            $team_id = $a +$b;
            DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['earthmatters_team' => $current_user_data->email, 'earthmatters_team_id'=> $team_id]);

            $p2_exist = DB::table('tf_reg')->where(['email'=>$data->email2])->first();
            if(!empty($data->email2)){if (!empty($p2_exist->email)) {
                $p2 = DB::table('tf_reg')->where(['email' => $data->email2])->first();
//                check if he is already in a team
                if (empty($p2->earthmatters_team)) {
                    DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['earthmatters_team' => $current_user_data->email, 'earthmatters_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email2])->update(['earthmatters_team' => $current_user_data->email, 'earthmatters_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email2])->update(['earthmatters' => '1']);



                    $subject2 = "Earth Matters, Techfeat IIT Bomabay";
                    $txt2 = "Dear $p2_exist->name, you have been successfully added to $current_user_data->name's team for earthmatters .
Your Team ID and Registered Mail ID are very important and will be used in future.
You can leave your current team by clicking on Leave a Team. 
Regards.";

                    mail($p2_exist->email, $subject2, $txt2, "From:competitions@techfest.org" );



                    $subject0 = "Earth Matters, Techfeat IIT Bomabay";
                    $txt0 = "Dear $current_user_data->name, your team is successfully created for earthmatters  
You are the Team Leader, you can Remove a Team member or Dissolve the existing team. Hoping to see you at Techfest  
Regards. ";

                    mail($current_user_data->email, $subject0, $txt0, "From:competitions@techfest.org" );


                } else return Redirect::back()->withErrors(["$p2->email is already in another team, he/she must leave current team first"]);

            } else return Redirect::back()->withErrors(["$data->email2 is not registered on techfest"]);}


            $p3_exist = DB::table('tf_reg')->where(['email'=>$data->email3])->first();
            if(!empty($data->email3)){if (!empty($p3_exist->email)) {
                $p3 = DB::table('tf_reg')->where(['email' => $data->email3])->first();
//                check if he is already in a team
                if (empty($p3->earthmatters_team)) {
                    DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['earthmatters_team' => $current_user_data->email, 'earthmatters_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email3])->update(['earthmatters_team' => $current_user_data->email, 'earthmatters_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email3])->update(['earthmatters' => '1']);



                    $subject2 = "Earth Matters, Techfeat IIT Bomabay";
                    $txt1 = "Dear $p3_exist->name, you have been successfully added to $current_user_data->name's team for earthmatters .
Your Team ID and Registered Mail ID are very important and will be used in future.
You can leave your current team by clicking on Leave a Team. 
Regards.";

                    mail($p3_exist->email, $subject2, $txt2, "From:competitions@techfest.org" );


                } else return Redirect::back()->withErrors(["$p3->email is already in another team, he/she must leave current team first"]);

            } else return Redirect::back()->withErrors(["$data->email3 is not registered on techfest"]);}

            $p4_exist = DB::table('tf_reg')->where(['email'=>$data->email4])->first();
            if(!empty($data->email3)){if(!empty($p4_exist->email)) {
                $p4 = DB::table('tf_reg')->where(['email' => $data->email4])->first();
//                check if he is already in a team
                if (empty($p4->earthmatters_team)) {
                    DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['earthmatters_team' => $current_user_data->email, 'earthmatters_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email4])->update(['earthmatters_team' => $current_user_data->email, 'earthmatters_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email4])->update(['earthmatters' => '1']);



                    $subject4 = "Earth Matters, Techfeat IIT Bomabay";
                    $txt4 = "Dear $p4_exist->name, you have been successfully added to $current_user_data->name's team for earthmatters .
Your Team ID and Registered Mail ID are very important and will be used in future.
You can leave your current team by clicking on Leave a Team. 
Regards.";

                    mail($p4_exist->email, $subject4, $txt4, "From:competitions@techfest.org" );



                } else return  Redirect::back()->withErrors(["$p4->email is already in another team, he/she must leave current team first"]);

            } else return Redirect::back()->withErrors(["$data->email4 is not registered on techfest"]);}

            return redirect("/competitions/earthmatters");

        } else return redirect("/competitions/earthmatters");
    }
    public function earthmatters_join_team_reg(Request $data){
        if(session()->has('user')) {
            $current_user_data = DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
            $team_member_row = DB::table('tf_reg')->where(['email'=>$data->email])->first();
            if(!empty($team_member_row->email)){
                $team_member_count = DB::table('tf_reg')->where(['earthmatters_team' => $team_member_row->earthmatters_team])->count();

                if(empty($current_user_data->earthmatters_team)){
                    if($team_member_count <= 4 ){
                        if(!empty($data->email)){DB::table('tf_reg')->where(['email'=>$current_user_data->email])->update(['earthmatters_team'=>$team_member_row->earthmatters_team]);}
                        return redirect("/competitions/earthmatters");
                    }
                    else return Redirect::back()->withErrors(["Team does not exist /Team already full"]);
                }
                else return Redirect::back()->withErrors(["you are already registered in a team, drop current team to join new one"]);
            }
            else return Redirect::back()->withErrors(["$data->email is not registered on Techfest"]);

        }
        else return Redirect::back()->withErrors(["first signin"]);
    }
    public function earthmatters_remove_member (Request $request, $id){
        $current_user_data = DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
        if($current_user_data->id != $id) {
            $user_row = DB::table('tf_reg')->where(['id' => $id])->first();
            $subject = "Earth Matters, Techfeat IIT Bomabay";
            $txt = "Dear $user_row->name, you have been removed from the earthmatters Team by your team leader $user_row->earthmatters_team which had team id zzz, you can either join another team or create your own team as a single member if you want.";

            mail($user_row->email, $subject, $txt, "From:competitions@techfest.org");

            DB::table('tf_reg')->where(['id' => $id])->update(['earthmatters_team' => '']);
        }
        return redirect("/competitions/earthmatters");
    }
    public function earthmatters_dissolve (){
        $current_user_data = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();
        $team =  DB::table('tf_reg')->where(['earthmatters_team' => $current_user_data->earthmatters_team])->get();
        if (!empty($team[0]->id)){DB::table('tf_reg')->where(['id' => $team[0]->id])->update(['earthmatters_team'=> '']);}
        if (!empty($team[1]->id)){DB::table('tf_reg')->where(['id' => $team[1]->id])->update(['earthmatters_team'=> '']);}
        if (!empty($team[2]->id)){DB::table('tf_reg')->where(['id' => $team[2]->id])->update(['earthmatters_team'=> '']);}
        if (!empty($team[3]->id)){DB::table('tf_reg')->where(['id' => $team[3]->id])->update(['earthmatters_team'=> '']);}
        return redirect("/competitions/earthmatters");
    }

    public function transportation(Request $request){
        $client = $this->google_auth($request);
        if ($client) {
            $oauth2 = new Google_Service_Oauth2($client);
            $userInfo = $oauth2->userinfo->get();
            $user = DB::table('tf_reg')->where(['email' => $userInfo->email])->first();
            session(['user' => $user]);  //todo session started
            if (!$user) {
                DB::table('tf_reg')->insert(['email' => $userInfo->email, 'name' => $userInfo->name, 'picture' => $userInfo->picture, 'no_of_login' => '1']);
            }
            if ($user) {
                DB::table('tf_reg')->where(['email' => $user->email])->update(['picture' => $userInfo->picture]);
                $user_row = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();// return the first row containing the user(session wala user)
                if($user_row->transportation > 0 && empty($user_row->number)){
                    return redirect('/competitions/details_form_2');
                }
                return view("2019.competitions.transportation")->with(['user_row' => $user_row]);
            }
        }
        if(!isset($request->code) && !session()->has('user')) return view('2019.competitions.transportation');

        return redirect("/competitions/transportation/");
    }
    public function regtransportation(Request $request){
        $user_row = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();// return the first row containing the user(session wala user)
        DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->update(['transportation'=>'1']);
        $subject = "Welcome to Unravelling Transportation - Techfest, IIT Bombay";
        $txt = "Dear $user_row->name,

Greetings! 
You have successfully registered in Unravelling Transportation with $user_row->email as your registered mail Id. Now you must either Create a Team or Join a Team to complete the procedure.

Carefully read the FAQ’s of competitions carefully to know more.

Regards
";

        mail($user_row->email, $subject, $txt, "From:competitions@techfest.org" );
        return redirect("/competitions/transportation/");
    }
    public function transportation_create_team_form(Request $data){
        $current_user_data = DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
        return view("2019.competitions.create_teamform")->with(['current_user_data'=>$current_user_data, 'form'=>"transportation"]);
    }
    public function transportation_join_team_form(Request $data){
        $current_user_data = DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
        return view("2019.competitions.join_teamform")->with(['current_user_data'=>$current_user_data, 'form'=>"transportation"]);
    }
    public function transportation_leave_team(){
        if(session()->has('user')) {
            $current_team =  DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
            if(!empty($current_team->transportation_team)){
                DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->update(['transportation_team'=>'']);
                return redirect("/competitions/transportation");
            }
            else return "you are not in a team";
        }
    }
    public function transportation_create_team_reg(Request $data){
        if (session()->has('user')) {
            $current_user_data = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();
            $a = 190000;
            $b = $current_user_data->id;
            $team_id = $a +$b;
            DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['transportation_team' => $current_user_data->email, 'transportation_team_id'=> $team_id]);

            $p2_exist = DB::table('tf_reg')->where(['email'=>$data->email2])->first();
            if(!empty($data->email2)){if (!empty($p2_exist->email)) {
                $p2 = DB::table('tf_reg')->where(['email' => $data->email2])->first();
//                check if he is already in a team
                if (empty($p2->transportation_team)) {
                    DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['transportation_team' => $current_user_data->email, 'transportation_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email2])->update(['transportation_team' => $current_user_data->email, 'transportation_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email2])->update(['transportation' => '1']);



                    $subject2 = "Unravelling Transportation, Techfest IIT Bomabay";
                    $txt2 = "Dear $p2_exist->name, you have been successfully added to $current_user_data->name's team for Unravelling Transportation .
Your Team ID and Registered Mail ID are very important and will be used in future.
You can leave your current team by clicking on Leave a Team. 
Regards.";

                    mail($p2_exist->email, $subject2, $txt2, "From:competitions@techfest.org" );



                    $subject0 = "Earth Matters, Techfeat IIT Bomabay";
                    $txt0 = "Dear $current_user_data->name, your team is successfully created for Unravelling Transportation  
You are the Team Leader, you can Remove a Team member or Dissolve the existing team. Hoping to see you at Techfest  
Regards. ";

                    mail($current_user_data->email, $subject0, $txt0, "From:competitions@techfest.org" );


                } else return Redirect::back()->withErrors(["$p2->email is already in another team, he/she must leave current team first"]);

            } else return Redirect::back()->withErrors(["$data->email2 is not registered on techfest"]);}


            $p3_exist = DB::table('tf_reg')->where(['email'=>$data->email3])->first();
            if(!empty($data->email3)){if (!empty($p3_exist->email)) {
                $p3 = DB::table('tf_reg')->where(['email' => $data->email3])->first();
//                check if he is already in a team
                if (empty($p3->transportation_team)) {
                    DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['transportation_team' => $current_user_data->email, 'transportation_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email3])->update(['transportation_team' => $current_user_data->email, 'transportation_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email3])->update(['transportation' => '1']);



                    $subject2 = "Unravelling Transportation, Techfeat IIT Bomabay";
                    $txt1 = "Dear $p3_exist->name, you have been successfully added to $current_user_data->name's team for Unravelling Transportation .
Your Team ID and Registered Mail ID are very important and will be used in future.
You can leave your current team by clicking on Leave a Team. 
Regards.";

                    mail($p3_exist->email, $subject2, $txt2, "From:competitions@techfest.org" );


                } else return Redirect::back()->withErrors(["$p3->email is already in another team, he/she must leave current team first"]);

            } else return Redirect::back()->withErrors(["$data->email3 is not registered on techfest"]);}

            $p4_exist = DB::table('tf_reg')->where(['email'=>$data->email4])->first();
            if(!empty($data->email3)){if(!empty($p4_exist->email)) {
                $p4 = DB::table('tf_reg')->where(['email' => $data->email4])->first();
//                check if he is already in a team
                if (empty($p4->transportation_team)) {
                    DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['transportation_team' => $current_user_data->email, 'transportation_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email4])->update(['transportation_team' => $current_user_data->email, 'transportation_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email4])->update(['transportation' => '1']);



                    $subject4 = "Earth Matters, Techfeat IIT Bomabay";
                    $txt4 = "Dear $p4_exist->name, you have been successfully added to $current_user_data->name's team for transportation .
Your Team ID and Registered Mail ID are very important and will be used in future.
You can leave your current team by clicking on Leave a Team. 
Regards.";

                    mail($p4_exist->email, $subject4, $txt4, "From:competitions@techfest.org" );



                } else return  Redirect::back()->withErrors(["$p4->email is already in another team, he/she must leave current team first"]);

            } else return Redirect::back()->withErrors(["$data->email4 is not registered on techfest"]);}

            return redirect("/competitions/transportation");

        } else return redirect("/competitions/transportation");
    }
    public function transportation_join_team_reg(Request $data){
        if(session()->has('user')) {
            $current_user_data = DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
            $team_member_row = DB::table('tf_reg')->where(['email'=>$data->email])->first();
            if(!empty($team_member_row->email)){
                $team_member_count = DB::table('tf_reg')->where(['transportation_team' => $team_member_row->transportation_team])->count();

                if(empty($current_user_data->transportation_team)){
                    if($team_member_count <= 4 ){
                        if(!empty($data->email)){DB::table('tf_reg')->where(['email'=>$current_user_data->email])->update(['transportation_team'=>$team_member_row->transportation_team]);}
                        return redirect("/competitions/transportation");
                    }
                    else return Redirect::back()->withErrors(["Team does not exist /Team already full"]);
                }
                else return Redirect::back()->withErrors(["you are already registered in a team, drop current team to join new one"]);
            }
            else return Redirect::back()->withErrors(["$data->email is not registered on Techfest"]);

        }
        else return Redirect::back()->withErrors(["first signin"]);
    }
    public function transportation_remove_member (Request $request, $id){
        $current_user_data = DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
        if($current_user_data->id != $id) {
            $user_row = DB::table('tf_reg')->where(['id' => $id])->first();
            $subject = "Earth Matters, Techfeat IIT Bomabay";
            $txt = "Dear $user_row->name, you have been removed from the transportation Team by your team leader $user_row->transportation_team which had team id zzz, you can either join another team or create your own team as a single member if you want.";

            mail($user_row->email, $subject, $txt, "From:competitions@techfest.org");

            DB::table('tf_reg')->where(['id' => $id])->update(['transportation_team' => '']);
        }
        return redirect("/competitions/transportation");
    }
    public function transportation_dissolve (){
        $current_user_data = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();
        $team =  DB::table('tf_reg')->where(['transportation_team' => $current_user_data->transportation_team])->get();
        if (!empty($team[0]->id)){DB::table('tf_reg')->where(['id' => $team[0]->id])->update(['transportation_team'=> '']);}
        if (!empty($team[1]->id)){DB::table('tf_reg')->where(['id' => $team[1]->id])->update(['transportation_team'=> '']);}
        if (!empty($team[2]->id)){DB::table('tf_reg')->where(['id' => $team[2]->id])->update(['transportation_team'=> '']);}
        if (!empty($team[3]->id)){DB::table('tf_reg')->where(['id' => $team[3]->id])->update(['transportation_team'=> '']);}
        return redirect("/competitions/transportation");
    }

    public function innovationeering(Request $request){
        $client = $this->google_auth($request);
        if ($client) {
            $oauth2 = new Google_Service_Oauth2($client);
            $userInfo = $oauth2->userinfo->get();
            $user = DB::table('tf_reg')->where(['email' => $userInfo->email])->first();
            session(['user' => $user]);  //todo session started
            if (!$user) {
                DB::table('tf_reg')->insert(['email' => $userInfo->email, 'name' => $userInfo->name, 'picture' => $userInfo->picture, 'no_of_login' => '1']);
            }
            if ($user) {
                DB::table('tf_reg')->where(['email' => $user->email])->update(['picture' => $userInfo->picture]);
                $user_row = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();// return the first row containing the user(session wala user)
                if($user_row->innovationeering > 0 && empty($user_row->number)){
                    return redirect('/competitions/details_form_2');
                }
                return view("2019.competitions.innovationeering")->with(['user_row' => $user_row]);
            }
        }
        if(!isset($request->code) && !session()->has('user')) return view('2019.competitions.innovationeering');

        return redirect("/competitions/innovationeering/");
    }
    public function reginnovationeering(Request $request){
        $user_row = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();// return the first row containing the user(session wala user)
        DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->update(['innovationeering'=>'1']);
        $subject = "Welcome to Innoationeering - Techfest, IIT Bombay";
        $txt = "Dear $user_row->name,

Greetings! 
You have successfully registered in Innoationeering with $user_row->email as your registered mail Id. Now you must either Create a Team or Join a Team to complete the procedure.

Carefully read the FAQ’s of competitions carefully to know more.

Regards
";

        mail($user_row->email, $subject, $txt, "From:competitions@techfest.org" );
        return redirect("/competitions/innovationeering/");
    }
    public function innovationeering_create_team_form(Request $data){
        $current_user_data = DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
        return view("2019.competitions.create_teamform")->with(['current_user_data'=>$current_user_data, 'form'=>"innovationeering"]);
    }
    public function innovationeering_join_team_form(Request $data){
        $current_user_data = DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
        return view("2019.competitions.join_teamform")->with(['current_user_data'=>$current_user_data, 'form'=>"innovationeering"]);
    }
    public function innovationeering_leave_team(){
        if(session()->has('user')) {
            $current_team =  DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
            if(!empty($current_team->innovationeering_team)){
                DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->update(['innovationeering_team'=>'']);
                return redirect("/competitions/innovationeering");
            }
            else return "you are not in a team";
        }
    }
    public function innovationeering_create_team_reg(Request $data){
        if (session()->has('user')) {
            $current_user_data = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();
            $a = 190000;
            $b = $current_user_data->id;
            $team_id = $a +$b;
            DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['innovationeering_team' => $current_user_data->email, 'innovationeering_team_id'=> $team_id]);
            $p2_exist = DB::table('tf_reg')->where(['email'=>$data->email2])->first();
            if(!empty($data->email2)){if (!empty($p2_exist->email)) {
                $p2 = DB::table('tf_reg')->where(['email' => $data->email2])->first();
//                check if he is already in a team
                if (empty($p2->innovationeering_team)) {
                    DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['innovationeering_team' => $current_user_data->email, 'innovationeering_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email2])->update(['innovationeering_team' => $current_user_data->email, 'innovationeering_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email2])->update(['innovationeering' => '1']);
                    $subject2 = "Innovationeering, Techfeat IIT Bomabay";
                    $txt2 = "Dear $p2_exist->name, you have been successfully added to $current_user_data->name's team for innovationeering .
Your Team ID and Registered Mail ID are very important and will be used in future.
You can leave your current team by clicking on Leave a Team. 
Regards.";
                    mail($p2_exist->email, $subject2, $txt2, "From:competitions@techfest.org" );
                    $subject0 = "Innovationeering, Techfeat IIT Bomabay";
                    $txt0 = "Dear $current_user_data->name, your team is successfully created for innovationeering  
You are the Team Leader, you can Remove a Team member or Dissolve the existing team. Hoping to see you at Techfest  
Regards. ";
                    mail($current_user_data->email, $subject0, $txt0, "From:competitions@techfest.org" );
                } else return Redirect::back()->withErrors(["$p2->email is already in another team, he/she must leave current team first"]);
            } else return Redirect::back()->withErrors(["$data->email2 is not registered on techfest"]);}
            $p3_exist = DB::table('tf_reg')->where(['email'=>$data->email3])->first();
            if(!empty($data->email3)){if (!empty($p3_exist->email)) {
                $p3 = DB::table('tf_reg')->where(['email' => $data->email3])->first();
//                check if he is already in a team
                if (empty($p3->innovationeering_team)) {
                    DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['innovationeering_team' => $current_user_data->email, 'innovationeering_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email3])->update(['innovationeering_team' => $current_user_data->email, 'innovationeering_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email3])->update(['innovationeering' => '1']);
                    $subject2 = "Innovationeering, Techfeat IIT Bomabay";
                    $txt1 = "Dear $p3_exist->name, you have been successfully added to $current_user_data->name's team for innovationeering .
Your Team ID and Registered Mail ID are very important and will be used in future.
You can leave your current team by clicking on Leave a Team. 
Regards.";
                    mail($p3_exist->email, $subject2, $txt2, "From:competitions@techfest.org" );

                } else return Redirect::back()->withErrors(["$p3->email is already in another team, he/she must leave current team first"]);
            } else return Redirect::back()->withErrors(["$data->email3 is not registered on techfest"]);}

            $p4_exist = DB::table('tf_reg')->where(['email'=>$data->email4])->first();
            if(!empty($data->email3)){if(!empty($p4_exist->email)) {
                $p4 = DB::table('tf_reg')->where(['email' => $data->email4])->first();
//                check if he is already in a team
                if (empty($p4->innovationeering_team)) {
                    DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['innovationeering_team' => $current_user_data->email, 'innovationeering_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email4])->update(['innovationeering_team' => $current_user_data->email, 'innovationeering_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email4])->update(['innovationeering' => '1']);
                    $subject4 = "innovationeering, Techfeat IIT Bomabay";
                    $txt4 = "Dear $p4_exist->name, you have been successfully added to $current_user_data->name's team for innovationeering .
Your Team ID and Registered Mail ID are very important and will be used in future.
You can leave your current team by clicking on Leave a Team. 
Regards.";
                    mail($p4_exist->email, $subject4, $txt4, "From:competitions@techfest.org" );
                } else return  Redirect::back()->withErrors(["$p4->email is already in another team, he/she must leave current team first"]);
            } else return Redirect::back()->withErrors(["$data->email4 is not registered on techfest"]);}
            return redirect("/competitions/innovationeering");
        } else return redirect("/competitions/innovationeering");
    }
    public function innovationeering_join_team_reg(Request $data){
        if(session()->has('user')) {
            $current_user_data = DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
            $team_member_row = DB::table('tf_reg')->where(['email'=>$data->email])->first();
            if(!empty($team_member_row->email)){
                $team_member_count = DB::table('tf_reg')->where(['innovationeering_team' => $team_member_row->innovationeering_team])->count();

                if(empty($current_user_data->innovationeering_team)){
                    if($team_member_count <= 4 ){
                        if(!empty($data->email)){DB::table('tf_reg')->where(['email'=>$current_user_data->email])->update(['innovationeering_team'=>$team_member_row->innovationeering_team]);}
                        return redirect("/competitions/innovationeering");
                    }
                    else return Redirect::back()->withErrors(["Team does not exist /Team already full"]);
                }
                else return Redirect::back()->withErrors(["you are already registered in a team, drop current team to join new one"]);
            }
            else return Redirect::back()->withErrors(["$data->email is not registered on Techfest"]);

        }
        else return Redirect::back()->withErrors(["first signin"]);
    }
    public function innovationeering_remove_member (Request $request, $id){
        $current_user_data = DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
        if($current_user_data->id != $id) {
            $user_row = DB::table('tf_reg')->where(['id' => $id])->first();
            $subject = "innovationeering, Techfeat IIT Bomabay";
            $txt = "Dear $user_row->name, you have been removed from the innovationeering Team by your team leader $user_row->innovationeering_team which had team id zzz, you can either join another team or create your own team as a single member if you want.";

            mail($user_row->email, $subject, $txt, "From:competitions@techfest.org");

            DB::table('tf_reg')->where(['id' => $id])->update(['innovationeering_team' => '']);
        }
        return redirect("/competitions/innovationeering");
    }
    public function innovationeering_dissolve (){
        $current_user_data = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();
        $team =  DB::table('tf_reg')->where(['innovationeering_team' => $current_user_data->innovationeering_team])->get();
        if (!empty($team[0]->id)){DB::table('tf_reg')->where(['id' => $team[0]->id])->update(['innovationeering_team'=> '']);}
        if (!empty($team[1]->id)){DB::table('tf_reg')->where(['id' => $team[1]->id])->update(['innovationeering_team'=> '']);}
        if (!empty($team[2]->id)){DB::table('tf_reg')->where(['id' => $team[2]->id])->update(['innovationeering_team'=> '']);}
        if (!empty($team[3]->id)){DB::table('tf_reg')->where(['id' => $team[3]->id])->update(['innovationeering_team'=> '']);}
        return redirect("/competitions/innovationeering");
    }

    public function metamorphosis(Request $request){
        $client = $this->google_auth($request);
        if ($client) {
            $oauth2 = new Google_Service_Oauth2($client);
            $userInfo = $oauth2->userinfo->get();
            $user = DB::table('tf_reg')->where(['email' => $userInfo->email])->first();
            session(['user' => $user]);  //todo session started
            if (!$user) {
                DB::table('tf_reg')->insert(['email' => $userInfo->email, 'name' => $userInfo->name, 'picture' => $userInfo->picture, 'no_of_login' => '1']);
            }
            if ($user) {
                DB::table('tf_reg')->where(['email' => $user->email])->update(['picture' => $userInfo->picture]);
                $user_row = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();// return the first row containing the user(session wala user)
                if($user_row->metamorphosis > 0 && empty($user_row->number)){
                    return redirect('/competitions/details_form_2');
                }
                return view("2019.competitions.metamorphosis")->with(['user_row' => $user_row]);
            }
        }
        if(!isset($request->code) && !session()->has('user')) return view('2019.competitions.metamorphosis');

        return redirect("/competitions/metamorphosis/");
    }
    public function regmetamorphosis(Request $request){
        $user_row = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();// return the first row containing the user(session wala user)
        DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->update(['metamorphosis'=>'1']);
        $subject = "Welcome to Metamorphosis - Techfest, IIT Bombay";
        $txt = "Dear $user_row->name,

Greetings! 
You have successfully registered in Metamorphosis with $user_row->email as your registered mail Id. Now you must either Create a Team or Join a Team to complete the procedure.

Carefully read the FAQ’s of competitions carefully to know more.

Regards
";

        mail($user_row->email, $subject, $txt, "From:competitions@techfest.org" );
        return redirect("/competitions/metamorphosis/");
    }
    public function metamorphosis_create_team_form(Request $data){
        $current_user_data = DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
        return view("2019.competitions.create_teamform")->with(['current_user_data'=>$current_user_data, 'form'=>"metamorphosis"]);
    }
    public function metamorphosis_join_team_form(Request $data){
        $current_user_data = DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
        return view("2019.competitions.join_teamform")->with(['current_user_data'=>$current_user_data, 'form'=>"metamorphosis"]);
    }
    public function metamorphosis_leave_team(){
        if(session()->has('user')) {
            $current_team =  DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
            if(!empty($current_team->metamorphosis_team)){
                DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->update(['metamorphosis_team'=>'']);
                return redirect("/competitions/metamorphosis");
            }
            else return "you are not in a team";
        }
    }
    public function metamorphosis_create_team_reg(Request $data){
        if (session()->has('user')) {
            $current_user_data = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();
            $a = 190000;
            $b = $current_user_data->id;
            $team_id = $a +$b;
            DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['metamorphosis_team' => $current_user_data->email, 'metamorphosis_team_id'=> $team_id]);

            $p2_exist = DB::table('tf_reg')->where(['email'=>$data->email2])->first();
            if(!empty($data->email2)){if (!empty($p2_exist->email)) {
                $p2 = DB::table('tf_reg')->where(['email' => $data->email2])->first();
//                check if he is already in a team
                if (empty($p2->metamorphosis_team)) {
                    DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['metamorphosis_team' => $current_user_data->email, 'metamorphosis_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email2])->update(['metamorphosis_team' => $current_user_data->email, 'metamorphosis_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email2])->update(['metamorphosis' => '1']);



                    $subject2 = "Metamorphosis, Techfeat IIT Bomabay";
                    $txt2 = "Dear $p2_exist->name, you have been successfully added to $current_user_data->name's team for metamorphosis .
Your Team ID and Registered Mail ID are very important and will be used in future.
You can leave your current team by clicking on Leave a Team. 
Regards.";

                    mail($p2_exist->email, $subject2, $txt2, "From:competitions@techfest.org" );



                    $subject0 = "Metamorphosis, Techfeat IIT Bomabay";
                    $txt0 = "Dear $current_user_data->name, your team is successfully created for metamorphosis  
You are the Team Leader, you can Remove a Team member or Dissolve the existing team. Hoping to see you at Techfest  
Regards. ";

                    mail($current_user_data->email, $subject0, $txt0, "From:competitions@techfest.org" );


                } else return Redirect::back()->withErrors(["$p2->email is already in another team, he/she must leave current team first"]);

            } else return Redirect::back()->withErrors(["$data->email2 is not registered on techfest"]);}


            $p3_exist = DB::table('tf_reg')->where(['email'=>$data->email3])->first();
            if(!empty($data->email3)){if (!empty($p3_exist->email)) {
                $p3 = DB::table('tf_reg')->where(['email' => $data->email3])->first();
//                check if he is already in a team
                if (empty($p3->metamorphosis_team)) {
                    DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['metamorphosis_team' => $current_user_data->email, 'metamorphosis_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email3])->update(['metamorphosis_team' => $current_user_data->email, 'metamorphosis_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email3])->update(['metamorphosis' => '1']);



                    $subject2 = "Metamorphosis, Techfeat IIT Bomabay";
                    $txt1 = "Dear $p3_exist->name, you have been successfully added to $current_user_data->name's team for metamorphosis .
Your Team ID and Registered Mail ID are very important and will be used in future.
You can leave your current team by clicking on Leave a Team. 
Regards.";

                    mail($p3_exist->email, $subject2, $txt2, "From:competitions@techfest.org" );


                } else return Redirect::back()->withErrors(["$p3->email is already in another team, he/she must leave current team first"]);

            } else return Redirect::back()->withErrors(["$data->email3 is not registered on techfest"]);}

            $p4_exist = DB::table('tf_reg')->where(['email'=>$data->email4])->first();
            if(!empty($data->email3)){if(!empty($p4_exist->email)) {
                $p4 = DB::table('tf_reg')->where(['email' => $data->email4])->first();
//                check if he is already in a team
                if (empty($p4->metamorphosis_team)) {
                    DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['metamorphosis_team' => $current_user_data->email, 'metamorphosis_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email4])->update(['metamorphosis_team' => $current_user_data->email, 'metamorphosis_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email4])->update(['metamorphosis' => '1']);



                    $subject4 = "metamorphosis, Techfeat IIT Bomabay";
                    $txt4 = "Dear $p4_exist->name, you have been successfully added to $current_user_data->name's team for metamorphosis .
Your Team ID and Registered Mail ID are very important and will be used in future.
You can leave your current team by clicking on Leave a Team. 
Regards.";

                    mail($p4_exist->email, $subject4, $txt4, "From:competitions@techfest.org" );



                } else return  Redirect::back()->withErrors(["$p4->email is already in another team, he/she must leave current team first"]);

            } else return Redirect::back()->withErrors(["$data->email4 is not registered on techfest"]);}

            return redirect("/competitions/metamorphosis");

        } else return redirect("/competitions/metamorphosis");
    }
    public function metamorphosis_join_team_reg(Request $data){
        if(session()->has('user')) {
            $current_user_data = DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
            $team_member_row = DB::table('tf_reg')->where(['email'=>$data->email])->first();
            if(!empty($team_member_row->email)){
                $team_member_count = DB::table('tf_reg')->where(['metamorphosis_team' => $team_member_row->metamorphosis_team])->count();

                if(empty($current_user_data->metamorphosis_team)){
                    if($team_member_count <= 4 ){
                        if(!empty($data->email)){DB::table('tf_reg')->where(['email'=>$current_user_data->email])->update(['metamorphosis_team'=>$team_member_row->metamorphosis_team]);}
                        return redirect("/competitions/metamorphosis");
                    }
                    else return Redirect::back()->withErrors(["Team does not exist /Team already full"]);
                }
                else return Redirect::back()->withErrors(["you are already registered in a team, drop current team to join new one"]);
            }
            else return Redirect::back()->withErrors(["$data->email is not registered on Techfest"]);

        }
        else return Redirect::back()->withErrors(["first signin"]);
    }
    public function metamorphosis_remove_member (Request $request, $id){
        $current_user_data = DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
        if($current_user_data->id != $id) {
            $user_row = DB::table('tf_reg')->where(['id' => $id])->first();
            $subject = "metamorphosis, Techfeat IIT Bomabay";
            $txt = "Dear $user_row->name, you have been removed from the metamorphosis Team by your team leader $user_row->metamorphosis_team which had team id zzz, you can either join another team or create your own team as a single member if you want.";

            mail($user_row->email, $subject, $txt, "From:competitions@techfest.org");

            DB::table('tf_reg')->where(['id' => $id])->update(['metamorphosis_team' => '']);
        }
        return redirect("/competitions/metamorphosis");
    }
    public function metamorphosis_dissolve (){
        $current_user_data = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();
        $team =  DB::table('tf_reg')->where(['metamorphosis_team' => $current_user_data->metamorphosis_team])->get();
        if (!empty($team[0]->id)){DB::table('tf_reg')->where(['id' => $team[0]->id])->update(['metamorphosis_team'=> '']);}
        if (!empty($team[1]->id)){DB::table('tf_reg')->where(['id' => $team[1]->id])->update(['metamorphosis_team'=> '']);}
        if (!empty($team[2]->id)){DB::table('tf_reg')->where(['id' => $team[2]->id])->update(['metamorphosis_team'=> '']);}
        if (!empty($team[3]->id)){DB::table('tf_reg')->where(['id' => $team[3]->id])->update(['metamorphosis_team'=> '']);}
        return redirect("/competitions/metamorphosis");
    }


    public function indiachallenge(Request $request){
        $client = $this->google_auth($request);
        if ($client) {
            $oauth2 = new Google_Service_Oauth2($client);
            $userInfo = $oauth2->userinfo->get();
            $user = DB::table('tf_reg')->where(['email' => $userInfo->email])->first();
            session(['user' => $user]);  //todo session started
            if (!$user) {
                DB::table('tf_reg')->insert(['email' => $userInfo->email, 'name' => $userInfo->name, 'picture' => $userInfo->picture, 'no_of_login' => '1']);
            }
            if ($user) {
                DB::table('tf_reg')->where(['email' => $user->email])->update(['picture' => $userInfo->picture]);
                $user_row = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();// return the first row containing the user(session wala user)
                if($user_row->indiachallenge > 0 && empty($user_row->number)){
                    return redirect('/competitions/details_form');
                }
                return view("2019.competitions.indiachallenge")->with(['user_row' => $user_row]);
            }

        }
        if(!isset($request->code) && !session()->has('user')) return view('2019.competitions.indiachallenge');

        return redirect("/competitions/indiachallenge/");
    }
    public function regindiachallenge(Request $request){
        $user_row = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();// return the first row containing the user(session wala user)
        DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->update(['indiachallenge'=>'1']);
        $subject = "Welcome to IndiaChallenge- Techfest, IIT Bombay";
        $txt = "Dear $user_row->name,

Greetings! 
You have successfully registered in IndiaChallenge with $user_row->email as your registered mail Id. Now you must either Create a Team or Join a Team to complete the procedure.

Carefully read the FAQ’s of competitions carefully to know more.

Regards
";

        mail($user_row->email, $subject, $txt, "From:competitions@techfest.org" );
        return redirect("/competitions/indiachallenge/");
    }
    public function indiachallenge_create_team_form(Request $data){
        $current_user_data = DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
        return view("2019.competitions.create_teamform")->with(['current_user_data'=>$current_user_data, 'form'=>"indiachallenge"]);
    }
    public function indiachallenge_join_team_form(Request $data){
        $current_user_data = DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
        return view("2019.competitions.join_teamform")->with(['current_user_data'=>$current_user_data,'form'=>"indiachallenge"]);
    }
    public function indiachallenge_leave_team(){
        if(session()->has('user')) {
            $current_team =  DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
            if(!empty($current_team->indiachallenge_team)){
                DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->update(['indiachallenge_team'=>'']);
                return redirect("/competitions/indiachallenge");
            }
            else return "you are not in a team";
        }
    }
    public function indiachallenge_create_team_reg(Request $data){
        if (session()->has('user')) {
            $current_user_data = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();
            $a = 190000;
            $b = $current_user_data->id;
            $team_id = $a +$b;
            DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['indiachallenge_team' => $current_user_data->email, 'indiachallenge_team_id'=> $team_id]);
            $p2_exist = DB::table('tf_reg')->where(['email'=>$data->email2])->first();
            if(!empty($data->email2)){if (!empty($p2_exist->email)) {
                $p2 = DB::table('tf_reg')->where(['email' => $data->email2])->first();
//                check if he is already in a team
                if (empty($p2->indiachallenge_team)) {
                    DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['indiachallenge_team' => $current_user_data->email, 'indiachallenge_team_id'=>$team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email2])->update(['indiachallenge_team' => $current_user_data->email, 'indiachallenge_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email2])->update(['indiachallenge' => '1']);
                    $subject2 = "India Challenge, Techfeat IIT Bomabay";
                    $txt2 = "Dear $p2_exist->name, you have been successfully added to $current_user_data->name's team for indiachallenge .
Your Team ID and Registered Mail ID are very important and will be used in future.
You can leave your current team by clicking on Leave a Team. 
Regards.";
                    mail($p2_exist->email, $subject2, $txt2, "From:competitions@techfest.org" );
                    $subject0 = "indiachallenge, Techfeat IIT Bomabay";
                    $txt0 = "Dear $current_user_data->name, your team is successfully created for indiachallenge 
You are the Team Leader, you can Remove a Team member or Dissolve the existing team. Hoping to see you at Techfest  
Regards. ";
                    mail($current_user_data->email, $subject0, $txt0, "From:competitions@techfest.org" );
                } else return Redirect::back()->withErrors(["$p2->email is already in another team, he/she must leave current team first"]);
            } else return Redirect::back()->withErrors(["$data->email2 is not registered on techfest"]);}
            $p3_exist = DB::table('tf_reg')->where(['email'=>$data->email3])->first();
            if(!empty($data->email3)){if (!empty($p3_exist->email)) {
                $p3 = DB::table('tf_reg')->where(['email' => $data->email3])->first();
//                check if he is already in a team
                if (empty($p3->indiachallenge_team)) {
                    DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['indiachallenge_team' => $current_user_data->email, 'indiachallenge_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email3])->update(['indiachallenge_team' => $current_user_data->email, 'indiachallenge_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email3])->update(['indiachallenge' => '1']);
                    $subject2 = "indiachallenge, Techfeat IIT Bomabay";
                    $txt1 = "Dear $p3_exist->name, you have been successfully added to $current_user_data->name's team for indiachallenge .
Your Team ID and Registered Mail ID are very important and will be used in future.
You can leave your current team by clicking on Leave a Team. 
Regards.";
                    mail($p3_exist->email, $subject2, $txt2, "From:competitions@techfest.org" );
                } else return Redirect::back()->withErrors(["$p3->email is already in another team, he/she must leave current team first"]);
            } else return Redirect::back()->withErrors(["$data->email3 is not registered on techfest"]);}
            $p4_exist = DB::table('tf_reg')->where(['email'=>$data->email4])->first();
            if(!empty($data->email3)){if(!empty($p4_exist->email)) {
                $p4 = DB::table('tf_reg')->where(['email' => $data->email4])->first();
//                check if he is already in a team
                if (empty($p4->indiachallenge_team)) {
                    DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['indiachallenge_team' => $current_user_data->email, 'indiachallenge_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email4])->update(['indiachallenge_team' => $current_user_data->email, 'indiachallenge_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email4])->update(['indiachallenge' => '1']);
                    $subject4 = "indiachallenge, Techfeat IIT Bomabay";
                    $txt4 = "Dear $p4_exist->name, you have been successfully added to $current_user_data->name's team for indiachallenge .
Your Team ID and Registered Mail ID are very important and will be used in future.
You can leave your current team by clicking on Leave a Team. 
Regards.";
                    mail($p4_exist->email, $subject4, $txt4, "From:competitions@techfest.org" );
                } else return  Redirect::back()->withErrors(["$p4->email is already in another team, he/she must leave current team first"]);
            } else return Redirect::back()->withErrors(["$data->email4 is not registered on techfest"]);}
            return redirect("/competitions/indiachallenge");
        } else return redirect("/competitions/indiachallenge");
    }
    public function indiachallenge_join_team_reg(Request $data){
        if(session()->has('user')) {
            $current_user_data = DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
            $team_member_row = DB::table('tf_reg')->where(['email'=>$data->email])->first();
            if(!empty($team_member_row->email)){
                $team_member_count = DB::table('tf_reg')->where(['indiachallenge_team' => $team_member_row->indiachallenge_team])->count();

                if(empty($current_user_data->indiachallenge_team)){
                    if($team_member_count < 4 ){
                        if(!empty($data->email)){DB::table('tf_reg')->where(['email'=>$current_user_data->email])->update(['indiachallenge_team'=>$team_member_row->indiachallenge_team]);}
                        return redirect("/competitions/indiachallenge");
                    }
                    else return Redirect::back()->withErrors(["Team does not exist /Team already full"]);
                }
                else return Redirect::back()->withErrors(["you are already registered in a team, drop current team to join new one"]);
            }
            else return Redirect::back()->withErrors(["$data->email is not registered on Techfest"]);

        }
        else return Redirect::back()->withErrors(["first signin"]);
    }
    public function indiachallenge_remove_member (Request $request, $id){
        $user_row = DB::table('tf_reg')->where(['id' => $id])->first();
        $subject = "indiachallenge, Techfeat IIT Bomabay";
        $txt = "Dear $user_row->name, you have been removed from the indiachallenge Team by your team leader $user_row->indiachallenge_team which had team id zzz, you can either join another team or create your own team as a single member if you want.";

        mail($user_row->email, $subject, $txt, "From:competitions@techfest.org" );

        DB::table('tf_reg')->where(['id' => $id])->update(['indiachallenge_team'=> '']);

        return redirect("/competitions/indiachallenge");
    }
    public function indiachallenge_dissolve (){
        $current_user_data = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();
        $team =  DB::table('tf_reg')->where(['indiachallenge_team' => $current_user_data->indiachallenge_team])->get();
        if (!empty($team[0]->id)){DB::table('tf_reg')->where(['id' => $team[0]->id])->update(['indiachallenge_team'=> '']);}
        if (!empty($team[1]->id)){DB::table('tf_reg')->where(['id' => $team[1]->id])->update(['indiachallenge_team'=> '']);}
        if (!empty($team[2]->id)){DB::table('tf_reg')->where(['id' => $team[2]->id])->update(['indiachallenge_team'=> '']);}
        if (!empty($team[3]->id)){DB::table('tf_reg')->where(['id' => $team[3]->id])->update(['indiachallenge_team'=> '']);}
        return redirect("/competitions/indiachallenge");
    }


    public function rowboatics(Request $request){
        $client = $this->google_auth($request);
        if ($client) {
            $oauth2 = new Google_Service_Oauth2($client);
            $userInfo = $oauth2->userinfo->get();
            $user = DB::table('tf_reg')->where(['email' => $userInfo->email])->first();
            session(['user' => $user]);  //todo session started
            if (!$user) {
                DB::table('tf_reg')->insert(['email' => $userInfo->email, 'name' => $userInfo->name, 'picture' => $userInfo->picture, 'no_of_login' => '1']);
            }
            if ($user) {
                DB::table('tf_reg')->where(['email' => $user->email])->update(['picture' => $userInfo->picture]);
                $user_row = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();// return the first row containing the user(session wala user)
                if($user_row->rowboatics > 0 && empty($user_row->number)){
                    return redirect('/competitions/details_form');
                }
                return view("2019.competitions.rowboatics")->with(['user_row' => $user_row]);
            }

        }
        if(!isset($request->code) && !session()->has('user')) return view('2019.competitions.rowboatics');

        return redirect("/competitions/rowboatics/");
    }
    public function regrowboatics(Request $request){
        $user_row = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();// return the first row containing the user(session wala user)
        DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->update(['rowboatics'=>'1']);
        $subject = "Welcome to RowBoatics- Techfest, IIT Bombay";
        $txt = "Dear $user_row->name,

Greetings! 
You have successfully registered in RowBoatics with $user_row->email as your registered mail Id. Now you must either Create a Team or Join a Team to complete the procedure.

Carefully read the FAQ’s of competitions carefully to know more.

Regards
";

        mail($user_row->email, $subject, $txt, "From:competitions@techfest.org" );
        return redirect("/competitions/rowboatics/");
    }
    public function rowboatics_create_team_form(Request $data){
        $current_user_data = DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
        return view("2019.competitions.create_teamform")->with(['current_user_data'=>$current_user_data, 'form'=>"rowboatics"]);
    }
    public function rowboatics_join_team_form(Request $data){
        $current_user_data = DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
        return view("2019.competitions.join_teamform")->with(['current_user_data'=>$current_user_data,'form'=>"rowboatics"]);
    }
    public function rowboatics_leave_team(){
        if(session()->has('user')) {
            $current_team =  DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
            if(!empty($current_team->rowboatics_team)){
                DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->update(['rowboatics_team'=>'']);
                return redirect("/competitions/rowboatics");
            }
            else return "you are not in a team";
        }
    }
    public function rowboatics_create_team_reg(Request $data){
        if (session()->has('user')) {
            $current_user_data = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();
            $a = 190000;
            $b = $current_user_data->id;
            $team_id = $a +$b;
            DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['rowboatics_team' => $current_user_data->email, 'rowboatics_team_id'=> $team_id]);
            $p2_exist = DB::table('tf_reg')->where(['email'=>$data->email2])->first();
            if(!empty($data->email2)){if (!empty($p2_exist->email)) {
                $p2 = DB::table('tf_reg')->where(['email' => $data->email2])->first();
//                check if he is already in a team
                if (empty($p2->rowboatics_team)) {
                    DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['rowboatics_team' => $current_user_data->email, 'rowboatics_team_id'=>$team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email2])->update(['rowboatics_team' => $current_user_data->email, 'rowboatics_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email2])->update(['rowboatics' => '1']);
                    $subject2 = "rowboatics, Techfeat IIT Bomabay";
                    $txt2 = "Dear $p2_exist->name, you have been successfully added to $current_user_data->name's team for rowboatics .
Your Team ID and Registered Mail ID are very important and will be used in future.
You can leave your current team by clicking on Leave a Team. 
Regards.";
                    mail($p2_exist->email, $subject2, $txt2, "From:competitions@techfest.org" );
                    $subject0 = "rowboatics, Techfeat IIT Bomabay";
                    $txt0 = "Dear $current_user_data->name, your team is successfully created for rowboatics 
You are the Team Leader, you can Remove a Team member or Dissolve the existing team. Hoping to see you at Techfest  
Regards. ";
                    mail($current_user_data->email, $subject0, $txt0, "From:competitions@techfest.org" );
                } else return Redirect::back()->withErrors(["$p2->email is already in another team, he/she must leave current team first"]);
            } else return Redirect::back()->withErrors(["$data->email2 is not registered on techfest"]);}
            $p3_exist = DB::table('tf_reg')->where(['email'=>$data->email3])->first();
            if(!empty($data->email3)){if (!empty($p3_exist->email)) {
                $p3 = DB::table('tf_reg')->where(['email' => $data->email3])->first();
//                check if he is already in a team
                if (empty($p3->rowboatics_team)) {
                    DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['rowboatics_team' => $current_user_data->email, 'rowboatics_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email3])->update(['rowboatics_team' => $current_user_data->email, 'rowboatics_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email3])->update(['rowboatics' => '1']);
                    $subject2 = "rowboatics, Techfeat IIT Bomabay";
                    $txt1 = "Dear $p3_exist->name, you have been successfully added to $current_user_data->name's team for rowboatics .
Your Team ID and Registered Mail ID are very important and will be used in future.
You can leave your current team by clicking on Leave a Team. 
Regards.";
                    mail($p3_exist->email, $subject2, $txt2, "From:competitions@techfest.org" );
                } else return Redirect::back()->withErrors(["$p3->email is already in another team, he/she must leave current team first"]);
            } else return Redirect::back()->withErrors(["$data->email3 is not registered on techfest"]);}
            $p4_exist = DB::table('tf_reg')->where(['email'=>$data->email4])->first();
            if(!empty($data->email3)){if(!empty($p4_exist->email)) {
                $p4 = DB::table('tf_reg')->where(['email' => $data->email4])->first();
//                check if he is already in a team
                if (empty($p4->rowboatics_team)) {
                    DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['rowboatics_team' => $current_user_data->email, 'rowboatics_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email4])->update(['rowboatics_team' => $current_user_data->email, 'rowboatics_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email4])->update(['rowboatics' => '1']);
                    $subject4 = "rowboatics, Techfeat IIT Bomabay";
                    $txt4 = "Dear $p4_exist->name, you have been successfully added to $current_user_data->name's team for rowboatics .
Your Team ID and Registered Mail ID are very important and will be used in future.
You can leave your current team by clicking on Leave a Team. 
Regards.";
                    mail($p4_exist->email, $subject4, $txt4, "From:competitions@techfest.org" );
                } else return  Redirect::back()->withErrors(["$p4->email is already in another team, he/she must leave current team first"]);
            } else return Redirect::back()->withErrors(["$data->email4 is not registered on techfest"]);}
            return redirect("/competitions/rowboatics");
        } else return redirect("/competitions/rowboatics");
    }
    public function rowboatics_join_team_reg(Request $data){
        if(session()->has('user')) {
            $current_user_data = DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
            $team_member_row = DB::table('tf_reg')->where(['email'=>$data->email])->first();
            if(!empty($team_member_row->email)){
                $team_member_count = DB::table('tf_reg')->where(['rowboatics_team' => $team_member_row->rowboatics_team])->count();

                if(empty($current_user_data->rowboatics_team)){
                    if($team_member_count <= 4 ){
                        if(!empty($data->email)){DB::table('tf_reg')->where(['email'=>$current_user_data->email])->update(['rowboatics_team'=>$team_member_row->rowboatics_team]);}
                        return redirect("/competitions/rowboatics");
                    }
                    else return Redirect::back()->withErrors(["Team does not exist /Team already full"]);
                }
                else return Redirect::back()->withErrors(["you are already registered in a team, drop current team to join new one"]);
            }
            else return Redirect::back()->withErrors(["$data->email is not registered on Techfest"]);

        }
        else return Redirect::back()->withErrors(["first signin"]);
    }
    public function rowboatics_remove_member (Request $request, $id){
        $user_row = DB::table('tf_reg')->where(['id' => $id])->first();
        $subject = "rowboatics, Techfeat IIT Bomabay";
        $txt = "Dear $user_row->name, you have been removed from the rowboatics Team by your team leader $user_row->rowboatics_team which had team id zzz, you can either join another team or create your own team as a single member if you want.";

        mail($user_row->email, $subject, $txt, "From:competitions@techfest.org" );

        DB::table('tf_reg')->where(['id' => $id])->update(['rowboatics_team'=> '']);

        return redirect("/competitions/rowboatics");
    }
    public function rowboatics_dissolve (){
        $current_user_data = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();
        $team =  DB::table('tf_reg')->where(['rowboatics_team' => $current_user_data->rowboatics_team])->get();
        if (!empty($team[0]->id)){DB::table('tf_reg')->where(['id' => $team[0]->id])->update(['rowboatics_team'=> '']);}
        if (!empty($team[1]->id)){DB::table('tf_reg')->where(['id' => $team[1]->id])->update(['rowboatics_team'=> '']);}
        if (!empty($team[2]->id)){DB::table('tf_reg')->where(['id' => $team[2]->id])->update(['rowboatics_team'=> '']);}
        if (!empty($team[3]->id)){DB::table('tf_reg')->where(['id' => $team[3]->id])->update(['rowboatics_team'=> '']);}
        return redirect("/competitions/rowboatics");
    }


    public function bugbounty(Request $request){
        $client = $this->google_auth($request);
        if ($client) {
            $oauth2 = new Google_Service_Oauth2($client);
            $userInfo = $oauth2->userinfo->get();
            $user = DB::table('tf_reg')->where(['email' => $userInfo->email])->first();
            session(['user' => $user]);  //todo session started
            if (!$user) {
                DB::table('tf_reg')->insert(['email' => $userInfo->email, 'name' => $userInfo->name, 'picture' => $userInfo->picture, 'no_of_login' => '1']);
            }
            if ($user) {
                DB::table('tf_reg')->where(['email' => $user->email])->update(['picture' => $userInfo->picture]);
                $user_row = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();// return the first row containing the user(session wala user)
                if($user_row->bugbounty > 0 && empty($user_row->number)){
                    return redirect('/competitions/details_form');
                }
                return view("2019.competitions.bugbounty")->with(['user_row' => $user_row]);
            }

        }
        if(!isset($request->code) && !session()->has('user')) return view('2019.competitions.bugbounty');

        return redirect("/competitions/bugbounty/");
    }
    public function regbugbounty(Request $request){
        $user_row = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();// return the first row containing the user(session wala user)
        DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->update(['bugbounty'=>'1']);
        $subject = "Welcome to Bug Bounty- Techfest, IIT Bombay";
        $txt = "Dear $user_row->name,

Greetings! 
You have successfully registered in Bug Bounty with $user_row->email as your registered mail Id. Now you must either Create a Team or Join a Team to complete the procedure.

Carefully read the FAQ’s of competitions carefully to know more.

Regards,
Team Techfest";

        mail($user_row->email, $subject, $txt, "From:competitions@techfest.org" );
        return redirect("/competitions/bugbounty/");
    }
    public function bugbounty_create_team_form(Request $data){
        $current_user_data = DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
        return view("2019.competitions.create_teamform")->with(['current_user_data'=>$current_user_data, 'form'=>"bugbounty"]);
    }
    public function bugbounty_join_team_form(Request $data){
        $current_user_data = DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
        return view("2019.competitions.join_teamform")->with(['current_user_data'=>$current_user_data,'form'=>"bugbounty"]);
    }
    public function bugbounty_leave_team(){
        if(session()->has('user')) {
            $current_team =  DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
            if(!empty($current_team->bugbounty_team)){
                DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->update(['bugbounty_team'=>'']);
                return redirect("/competitions/bugbounty");
            }
            else return "you are not in a team";
        }
    }
    public function bugbounty_create_team_reg(Request $data){
        if (session()->has('user')) {
            $current_user_data = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();
            $a = 190000;
            $b = $current_user_data->id;
            $team_id = $a +$b;
            DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['bugbounty_team' => $current_user_data->email, 'bugbounty_team_id'=> $team_id]);
            $p2_exist = DB::table('tf_reg')->where(['email'=>$data->email2])->first();
            if(!empty($data->email2)){if (!empty($p2_exist->email)) {
                $p2 = DB::table('tf_reg')->where(['email' => $data->email2])->first();
//                check if he is already in a team
                if (empty($p2->bugbounty_team)) {
                    DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['bugbounty_team' => $current_user_data->email, 'bugbounty_team_id'=>$team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email2])->update(['bugbounty_team' => $current_user_data->email, 'bugbounty_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email2])->update(['bugbounty' => '1']);
                    $subject2 = "bugbounty, Techfeat IIT Bomabay";
                    $txt2 = "Dear $p2_exist->name, you have been successfully added to $current_user_data->name's team for bugbounty .
Your Team ID and Registered Mail ID are very important and will be used in future.
You can leave your current team by clicking on Leave a Team. 
Regards.";
                    mail($p2_exist->email, $subject2, $txt2, "From:competitions@techfest.org" );
                    $subject0 = "bugbounty, Techfeat IIT Bomabay";
                    $txt0 = "Dear $current_user_data->name, your team is successfully created for bugbounty 
You are the Team Leader, you can Remove a Team member or Dissolve the existing team. Hoping to see you at Techfest  
Regards. ";
                    mail($current_user_data->email, $subject0, $txt0, "From:competitions@techfest.org" );
                } else return Redirect::back()->withErrors(["$p2->email is already in another team, he/she must leave current team first"]);
            } else return Redirect::back()->withErrors(["$data->email2 is not registered on techfest"]);}
            $p3_exist = DB::table('tf_reg')->where(['email'=>$data->email3])->first();
            if(!empty($data->email3)){if (!empty($p3_exist->email)) {
                $p3 = DB::table('tf_reg')->where(['email' => $data->email3])->first();
//                check if he is already in a team
                if (empty($p3->bugbounty_team)) {
                    DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['bugbounty_team' => $current_user_data->email, 'bugbounty_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email3])->update(['bugbounty_team' => $current_user_data->email, 'bugbounty_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email3])->update(['bugbounty' => '1']);
                    $subject2 = "bugbounty, Techfeat IIT Bomabay";
                    $txt1 = "Dear $p3_exist->name, you have been successfully added to $current_user_data->name's team for bugbounty .
Your Team ID and Registered Mail ID are very important and will be used in future.
You can leave your current team by clicking on Leave a Team. 
Regards.";
                    mail($p3_exist->email, $subject2, $txt2, "From:competitions@techfest.org" );
                } else return Redirect::back()->withErrors(["$p3->email is already in another team, he/she must leave current team first"]);
            } else return Redirect::back()->withErrors(["$data->email3 is not registered on techfest"]);}
            $p4_exist = DB::table('tf_reg')->where(['email'=>$data->email4])->first();
            if(!empty($data->email3)){if(!empty($p4_exist->email)) {
                $p4 = DB::table('tf_reg')->where(['email' => $data->email4])->first();
//                check if he is already in a team
                if (empty($p4->bugbounty_team)) {
                    DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['bugbounty_team' => $current_user_data->email, 'bugbounty_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email4])->update(['bugbounty_team' => $current_user_data->email, 'bugbounty_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email4])->update(['bugbounty' => '1']);
                    $subject4 = "bugbounty, Techfeat IIT Bomabay";
                    $txt4 = "Dear $p4_exist->name, you have been successfully added to $current_user_data->name's team for bugbounty .
Your Team ID and Registered Mail ID are very important and will be used in future.
You can leave your current team by clicking on Leave a Team. 
Regards.";
                    mail($p4_exist->email, $subject4, $txt4, "From:competitions@techfest.org" );
                } else return  Redirect::back()->withErrors(["$p4->email is already in another team, he/she must leave current team first"]);
            } else return Redirect::back()->withErrors(["$data->email4 is not registered on techfest"]);}
            return redirect("/competitions/bugbounty");
        } else return redirect("/competitions/bugbounty");
    }
    public function bugbounty_join_team_reg(Request $data){
        if(session()->has('user')) {
            $current_user_data = DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
            $team_member_row = DB::table('tf_reg')->where(['email'=>$data->email])->first();
            if(!empty($team_member_row->email)){
                $team_member_count = DB::table('tf_reg')->where(['bugbounty_team' => $team_member_row->bugbounty_team])->count();

                if(empty($current_user_data->bugbounty_team)){
                    if($team_member_count <= 4 ){
                        if(!empty($data->email)){DB::table('tf_reg')->where(['email'=>$current_user_data->email])->update(['bugbounty_team'=>$team_member_row->bugbounty_team]);}
                        return redirect("/competitions/bugbounty");
                    }
                    else return Redirect::back()->withErrors(["Team does not exist /Team already full"]);
                }
                else return Redirect::back()->withErrors(["you are already registered in a team, drop current team to join new one"]);
            }
            else return Redirect::back()->withErrors(["$data->email is not registered on Techfest"]);

        }
        else return Redirect::back()->withErrors(["first signin"]);
    }
    public function bugbounty_remove_member (Request $request, $id){
        $user_row = DB::table('tf_reg')->where(['id' => $id])->first();
        $subject = "bugbounty, Techfeat IIT Bomabay";
        $txt = "Dear $user_row->name, you have been removed from the bugbounty Team by your team leader $user_row->bugbounty_team which had team id zzz, you can either join another team or create your own team as a single member if you want.";

        mail($user_row->email, $subject, $txt, "From:competitions@techfest.org" );

        DB::table('tf_reg')->where(['id' => $id])->update(['bugbounty_team'=> '']);

        return redirect("/competitions/bugbounty");
    }
    public function bugbounty_dissolve (){
        $current_user_data = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();
        $team =  DB::table('tf_reg')->where(['bugbounty_team' => $current_user_data->bugbounty_team])->get();
        if (!empty($team[0]->id)){DB::table('tf_reg')->where(['id' => $team[0]->id])->update(['bugbounty_team'=> '']);}
        if (!empty($team[1]->id)){DB::table('tf_reg')->where(['id' => $team[1]->id])->update(['bugbounty_team'=> '']);}
        if (!empty($team[2]->id)){DB::table('tf_reg')->where(['id' => $team[2]->id])->update(['bugbounty_team'=> '']);}
        if (!empty($team[3]->id)){DB::table('tf_reg')->where(['id' => $team[3]->id])->update(['bugbounty_team'=> '']);}
        return redirect("/competitions/bugbounty");
    }


    public function fintech(Request $request){
        $client = $this->google_auth($request);
        if ($client) {
            $oauth2 = new Google_Service_Oauth2($client);
            $userInfo = $oauth2->userinfo->get();
            $user = DB::table('tf_reg')->where(['email' => $userInfo->email])->first();
            session(['user' => $user]);  //todo session started
            if (!$user) {
                DB::table('tf_reg')->insert(['email' => $userInfo->email, 'name' => $userInfo->name, 'picture' => $userInfo->picture, 'no_of_login' => '1']);
            }
            if ($user) {
                DB::table('tf_reg')->where(['email' => $user->email])->update(['picture' => $userInfo->picture]);
                $user_row = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();// return the first row containing the user(session wala user)
                if($user_row->fintech > 0 && empty($user_row->number)){
                    return redirect('/competitions/details_form');
                }
                return view("2019.competitions.fintech")->with(['user_row' => $user_row]);
            }

        }
        if(!isset($request->code) && !session()->has('user')) return view('2019.competitions.fintech');

        return redirect("/competitions/fintech/");
    }
    public function regfintech(Request $request){
        $user_row = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();// return the first row containing the user(session wala user)
        DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->update(['fintech'=>'1']);
        $subject = "Welcome to Fintech- Techfest, IIT Bombay";
        $txt = "Dear $user_row->name,

Greetings! 
You have successfully registered in Fintech with $user_row->email as your registered mail Id. Now you must either Create a Team or Join a Team to complete the procedure.

Carefully read the FAQ’s of competitions carefully to know more.

Regards
";

        mail($user_row->email, $subject, $txt, "From:competitions@techfest.org" );
        return redirect("/competitions/fintech/");
    }
    public function fintech_create_team_form(Request $data){
        $current_user_data = DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
        return view("2019.competitions.create_teamform")->with(['current_user_data'=>$current_user_data, 'form'=>"fintech"]);
    }
    public function fintech_join_team_form(Request $data){
        $current_user_data = DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
        return view("2019.competitions.join_teamform")->with(['current_user_data'=>$current_user_data,'form'=>"fintech"]);
    }
    public function fintech_leave_team(){
        if(session()->has('user')) {
            $current_team =  DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
            if(!empty($current_team->fintech_team)){
                DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->update(['fintech_team'=>'']);
                return redirect("/competitions/fintech");
            }
            else return "you are not in a team";
        }
    }
    public function fintech_create_team_reg(Request $data){
        if (session()->has('user')) {
            $current_user_data = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();
            $a = 190000;
            $b = $current_user_data->id;
            $team_id = $a +$b;
            DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['fintech_team' => $current_user_data->email, 'fintech_team_id'=> $team_id]);
            $p2_exist = DB::table('tf_reg')->where(['email'=>$data->email2])->first();
            if(!empty($data->email2)){if (!empty($p2_exist->email)) {
                $p2 = DB::table('tf_reg')->where(['email' => $data->email2])->first();
//                check if he is already in a team
                if (empty($p2->fintech_team)) {
                    DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['fintech_team' => $current_user_data->email, 'fintech_team_id'=>$team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email2])->update(['fintech_team' => $current_user_data->email, 'fintech_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email2])->update(['fintech' => '1']);
                    $subject2 = "Fintech, Techfeat IIT Bomabay";
                    $txt2 = "Dear $p2_exist->name, you have been successfully added to $current_user_data->name's team for fintech .
Your Team ID and Registered Mail ID are very important and will be used in future.
You can leave your current team by clicking on Leave a Team. 
Regards.";
                    mail($p2_exist->email, $subject2, $txt2, "From:competitions@techfest.org" );
                    $subject0 = "fintech, Techfeat IIT Bomabay";
                    $txt0 = "Dear $current_user_data->name, your team is successfully created for fintech 
You are the Team Leader, you can Remove a Team member or Dissolve the existing team. Hoping to see you at Techfest  
Regards. ";
//                    mail($current_user_data->email, $subject0, $txt0, "From:competitions@techfest.org" );
                } else return Redirect::back()->withErrors(["$p2->email is already in another team, he/she must leave current team first"]);
            } else return Redirect::back()->withErrors(["$data->email2 is not registered on techfest"]);}
            $p3_exist = DB::table('tf_reg')->where(['email'=>$data->email3])->first();
            if(!empty($data->email3)){if (!empty($p3_exist->email)) {
                $p3 = DB::table('tf_reg')->where(['email' => $data->email3])->first();
//                check if he is already in a team
                if (empty($p3->fintech_team)) {
                    DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['fintech_team' => $current_user_data->email, 'fintech_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email3])->update(['fintech_team' => $current_user_data->email, 'fintech_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email3])->update(['fintech' => '1']);
                    $subject2 = "fintech, Techfeat IIT Bomabay";
                    $txt1 = "Dear $p3_exist->name, you have been successfully added to $current_user_data->name's team for fintech .
Your Team ID and Registered Mail ID are very important and will be used in future.
You can leave your current team by clicking on Leave a Team. 
Regards.";
                    mail($p3_exist->email, $subject2, $txt2, "From:competitions@techfest.org" );
                } else return Redirect::back()->withErrors(["$p3->email is already in another team, he/she must leave current team first"]);
            } else return Redirect::back()->withErrors(["$data->email3 is not registered on techfest"]);}
            $p4_exist = DB::table('tf_reg')->where(['email'=>$data->email4])->first();
            if(!empty($data->email3)){if(!empty($p4_exist->email)) {
                $p4 = DB::table('tf_reg')->where(['email' => $data->email4])->first();
//                check if he is already in a team
                if (empty($p4->fintech_team)) {
                    DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['fintech_team' => $current_user_data->email, 'fintech_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email4])->update(['fintech_team' => $current_user_data->email, 'fintech_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email4])->update(['fintech' => '1']);
                    $subject4 = "fintech, Techfeat IIT Bomabay";
                    $txt4 = "Dear $p4_exist->name, you have been successfully added to $current_user_data->name's team for fintech .
Your Team ID and Registered Mail ID are very important and will be used in future.
You can leave your current team by clicking on Leave a Team. 
Regards.";
                    mail($p4_exist->email, $subject4, $txt4, "From:competitions@techfest.org" );
                } else return  Redirect::back()->withErrors(["$p4->email is already in another team, he/she must leave current team first"]);
            } else return Redirect::back()->withErrors(["$data->email4 is not registered on techfest"]);}
            return redirect("/competitions/fintech");
        } else return redirect("/competitions/fintech");
    }
    public function fintech_join_team_reg(Request $data){
        if(session()->has('user')) {
            $current_user_data = DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
            $team_member_row = DB::table('tf_reg')->where(['email'=>$data->email])->first();
            if(!empty($team_member_row->email)){
                $team_member_count = DB::table('tf_reg')->where(['fintech_team' => $team_member_row->fintech_team])->count();

                if(empty($current_user_data->fintech_team)){
                    if($team_member_count <= 4 ){
                        if(!empty($data->email)){DB::table('tf_reg')->where(['email'=>$current_user_data->email])->update(['fintech_team'=>$team_member_row->fintech_team]);}
                        return redirect("/competitions/fintech");
                    }
                    else return Redirect::back()->withErrors(["Team does not exist /Team already full"]);
                }
                else return Redirect::back()->withErrors(["you are already registered in a team, drop current team to join new one"]);
            }
            else return Redirect::back()->withErrors(["$data->email is not registered on Techfest"]);

        }
        else return Redirect::back()->withErrors(["first signin"]);
    }
    public function fintech_remove_member (Request $request, $id){
        $user_row = DB::table('tf_reg')->where(['id' => $id])->first();
        $subject = "fintech, Techfeat IIT Bomabay";
        $txt = "Dear $user_row->name, you have been removed from the fintech Team by your team leader $user_row->fintech_team which had team id zzz, you can either join another team or create your own team as a single member if you want.";

        mail($user_row->email, $subject, $txt, "From:competitions@techfest.org" );

        DB::table('tf_reg')->where(['id' => $id])->update(['fintech_team'=> '']);

        return redirect("/competitions/fintech");
    }
    public function fintech_dissolve (){
        $current_user_data = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();
        $team =  DB::table('tf_reg')->where(['fintech_team' => $current_user_data->fintech_team])->get();
        if (!empty($team[0]->id)){DB::table('tf_reg')->where(['id' => $team[0]->id])->update(['fintech_team'=> '']);}
        if (!empty($team[1]->id)){DB::table('tf_reg')->where(['id' => $team[1]->id])->update(['fintech_team'=> '']);}
        if (!empty($team[2]->id)){DB::table('tf_reg')->where(['id' => $team[2]->id])->update(['fintech_team'=> '']);}
        if (!empty($team[3]->id)){DB::table('tf_reg')->where(['id' => $team[3]->id])->update(['fintech_team'=> '']);}
        return redirect("/competitions/fintech");
    }


    public function wpc(Request $request){
        $client = $this->google_auth($request);
        if ($client) {
            $oauth2 = new Google_Service_Oauth2($client);
            $userInfo = $oauth2->userinfo->get();
            $user = DB::table('tf_reg')->where(['email' => $userInfo->email])->first();
            session(['user' => $user]);  //todo session started
            if (!$user) {
                DB::table('tf_reg')->insert(['email' => $userInfo->email, 'name' => $userInfo->name, 'picture' => $userInfo->picture, 'no_of_login' => '1']);
            }
            if ($user) {
                DB::table('tf_reg')->where(['email' => $user->email])->update(['picture' => $userInfo->picture]);
                $user_row = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();// return the first row containing the user(session wala user)
                if($user_row->wpc > 0 && empty($user_row->number)){
                    return redirect('/competitions/details_form');
                }
                return view("2019.competitions.wpc")->with(['user_row' => $user_row]);
            }

        }
        if(!isset($request->code) && !session()->has('user')) return view('2019.competitions.wpc');

        return redirect("/competitions/wpc/");
    }
    public function regwpc(Request $request){
        $user_row = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();// return the first row containing the user(session wala user)
        DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->update(['wpc'=>'1']);
        $subject = "Welcome to World Programming Championship | Techfest, IIT Bombay";
        $txt = "Dear $user_row->name,

Greetings! 
You have successfully registered in World Programming Championship  with $user_row->email as your registered mail Id. Now you must either Create a Team or Join a Team to complete the procedure.

Carefully read the FAQ’s of competitions carefully to know more.

Regards";

        mail($user_row->email, $subject, $txt, "From:competitions@techfest.org" );
        return redirect("/competitions/wpc/");
    }


    public function gopynq(Request $request){
        $client = $this->google_auth($request);
        if ($client) {
            $oauth2 = new Google_Service_Oauth2($client);
            $userInfo = $oauth2->userinfo->get();
            $user = DB::table('tf_reg')->where(['email' => $userInfo->email])->first();
            session(['user' => $user]);  //todo session started
            if (!$user) {
                DB::table('tf_reg')->insert(['email' => $userInfo->email, 'name' => $userInfo->name, 'picture' => $userInfo->picture, 'no_of_login' => '1']);
            }
            if ($user) {
                DB::table('tf_reg')->where(['email' => $user->email])->update(['picture' => $userInfo->picture]);
                $user_row = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();// return the first row containing the user(session wala user)
                if($user_row->gopynq > 0 && empty($user_row->number)){
                    return redirect('/competitions/details_form');
                }
                return view("2019.competitions.gopynq")->with(['user_row' => $user_row]);
            }
        }
        if(!isset($request->code) && !session()->has('user')) return view('2019.competitions.gopynq');

        return redirect("/competitions/gopynq/");
    }
    public function reggopynq(Request $request){
        $user_row = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();// return the first row containing the user(session wala user)
        DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->update(['gopynq'=>'1']);
        $subject = "Welcome to GoPynq | Techfest, IIT Bombay";
        $txt = "Dear $user_row->name,

Greetings! 
You have successfully registered in GoPynq with $user_row->email as your registered mail Id. Now you must either Create a Team or Join a Team to complete the procedure.

Carefully read the FAQ’s of competitions carefully to know more.

Regards,
";

        mail($user_row->email, $subject, $txt, "From:competitions@techfest.org" );
        return redirect("/competitions/gopynq/");
    }
    public function gopynq_create_team_form(Request $data){
        $current_user_data = DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
        return view("2019.competitions.create_teamform")->with(['current_user_data'=>$current_user_data, 'form'=>"gopynq"]);
    }
    public function gopynq_join_team_form(Request $data){
        $current_user_data = DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
        return view("2019.competitions.join_teamform")->with(['current_user_data'=>$current_user_data,'form'=>"gopynq"]);
    }
    public function gopynq_leave_team(){
        if(session()->has('user')) {
            $current_team =  DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
            if(!empty($current_team->gopynq_team)){
                DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->update(['gopynq_team'=>'']);
                return redirect("/competitions/gopynq");
            }
            else return "you are not in a team";
        }
    }
    public function gopynq_create_team_reg(Request $data){
        if (session()->has('user')) {
            $current_user_data = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();
            $a = 190000;
            $b = $current_user_data->id;
            $team_id = $a +$b;
            DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['gopynq_team' => $current_user_data->email, 'gopynq_team_id'=> $team_id]);

            $p2_exist = DB::table('tf_reg')->where(['email'=>$data->email2])->first();
            if(!empty($data->email2)){if (!empty($p2_exist->email)) {
                $p2 = DB::table('tf_reg')->where(['email' => $data->email2])->first();
//                check if he is already in a team
                if (empty($p2->gopynq_team)) {
                    DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['gopynq_team' => $current_user_data->email, 'gopynq_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email2])->update(['gopynq_team' => $current_user_data->email, 'gopynq_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email2])->update(['gopynq' => '1']);



                    $subject2 = "gopynq, Techfeat IIT Bomabay";
                    $txt2 = "Dear $p2_exist->name, you have been successfully added to $current_user_data->name's team for gopynq .
Your Team ID and Registered Mail ID are very important and will be used in future.
You can leave your current team by clicking on Leave a Team. 
Regards.";

                    mail($p2_exist->email, $subject2, $txt2, "From:competitions@techfest.org" );



                    $subject0 = "gopynq, Techfeat IIT Bomabay";
                    $txt0 = "Dear $current_user_data->name, your team is successfully created for gopynq  
You are the Team Leader, you can Remove a Team member or Dissolve the existing team. Hoping to see you at Techfest  
Regards. ";

                    mail($current_user_data->email, $subject0, $txt0, "From:competitions@techfest.org" );


                } else return Redirect::back()->withErrors(["$p2->email is already in another team, he/she must leave current team first"]);

            } else return Redirect::back()->withErrors(["$data->email2 is not registered on techfest"]);}


            $p3_exist = DB::table('tf_reg')->where(['email'=>$data->email3])->first();
            if(!empty($data->email3)){if (!empty($p3_exist->email)) {
                $p3 = DB::table('tf_reg')->where(['email' => $data->email3])->first();
//                check if he is already in a team
                if (empty($p3->gopynq_team)) {
                    DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['gopynq_team' => $current_user_data->email, 'gopynq_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email3])->update(['gopynq_team' => $current_user_data->email, 'gopynq_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email3])->update(['gopynq' => '1']);



                    $subject2 = "gopynq, Techfeat IIT Bomabay";
                    $txt1 = "Dear $p3_exist->name, you have been successfully added to $current_user_data->name's team for gopynq .
Your Team ID and Registered Mail ID are very important and will be used in future.
You can leave your current team by clicking on Leave a Team. 
Regards.";

                    mail($p3_exist->email, $subject2, $txt2, "From:competitions@techfest.org" );


                } else return Redirect::back()->withErrors(["$p3->email is already in another team, he/she must leave current team first"]);

            } else return Redirect::back()->withErrors(["$data->email3 is not registered on techfest"]);}

            $p4_exist = DB::table('tf_reg')->where(['email'=>$data->email4])->first();
            if(!empty($data->email3)){if(!empty($p4_exist->email)) {
                $p4 = DB::table('tf_reg')->where(['email' => $data->email4])->first();
//                check if he is already in a team
                if (empty($p4->gopynq_team)) {
                    DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['gopynq_team' => $current_user_data->email, 'gopynq_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email4])->update(['gopynq_team' => $current_user_data->email, 'gopynq_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email4])->update(['gopynq' => '1']);



                    $subject4 = "gopynq, Techfeat IIT Bomabay";
                    $txt4 = "Dear $p4_exist->name, you have been successfully added to $current_user_data->name's team for gopynq .
Your Team ID and Registered Mail ID are very important and will be used in future.
You can leave your current team by clicking on Leave a Team. 
Regards.";

                    mail($p4_exist->email, $subject4, $txt4, "From:competitions@techfest.org" );



                } else return  Redirect::back()->withErrors(["$p4->email is already in another team, he/she must leave current team first"]);

            } else return Redirect::back()->withErrors(["$data->email4 is not registered on techfest"]);}

            return redirect("/competitions/gopynq");

        } else return redirect("/competitions/gopynq");
    }
    public function gopynq_join_team_reg(Request $data){
        if(session()->has('user')) {
            $current_user_data = DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
            $team_member_row = DB::table('tf_reg')->where(['email'=>$data->email])->first();
            if(!empty($team_member_row->email)){
                $team_member_count = DB::table('tf_reg')->where(['gopynq_team' => $team_member_row->gopynq_team])->count();

                if(empty($current_user_data->gopynq_team)){
                    if($team_member_count <= 4 ){
                        if(!empty($data->email)){DB::table('tf_reg')->where(['email'=>$current_user_data->email])->update(['gopynq_team'=>$team_member_row->gopynq_team]);}
                        return redirect("/competitions/gopynq");
                    }
                    else return Redirect::back()->withErrors(["Team does not exist /Team already full"]);
                }
                else return Redirect::back()->withErrors(["you are already registered in a team, drop current team to join new one"]);
            }
            else return Redirect::back()->withErrors(["$data->email is not registered on Techfest"]);


        }
        else return Redirect::back()->withErrors(["first signin"]);
    }
    public function gopynq_remove_member (Request $request, $id){
        $user_row = DB::table('tf_reg')->where(['id' => $id])->first();
        $subject = "gopynq, Techfeat IIT Bomabay";
        $txt = "Dear $user_row->name, you have been removed from the gopynq Team by your team leader $user_row->gopynq_team which had team id zzz, you can either join another team or create your own team as a single member if you want.";

        mail($user_row->email, $subject, $txt, "From:competitions@techfest.org" );

        DB::table('tf_reg')->where(['id' => $id])->update(['gopynq_team'=> '']);

        return redirect("/competitions/gopynq");
    }
    public function gopynq_dissolve (){
        $current_user_data = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();
        $team =  DB::table('tf_reg')->where(['gopynq_team' => $current_user_data->gopynq_team])->get();
        if (!empty($team[0]->id)){DB::table('tf_reg')->where(['id' => $team[0]->id])->update(['gopynq_team'=> '']);}
        if (!empty($team[1]->id)){DB::table('tf_reg')->where(['id' => $team[1]->id])->update(['gopynq_team'=> '']);}
        if (!empty($team[2]->id)){DB::table('tf_reg')->where(['id' => $team[2]->id])->update(['gopynq_team'=> '']);}
        if (!empty($team[3]->id)){DB::table('tf_reg')->where(['id' => $team[3]->id])->update(['gopynq_team'=> '']);}
        return redirect("/competitions/gopynq");
    }



    public function meshmerize(Request $request){
        $client = $this->google_auth($request);
        if ($client) {
            $oauth2 = new Google_Service_Oauth2($client);
            $userInfo = $oauth2->userinfo->get();
            $user = DB::table('tf_reg')->where(['email' => $userInfo->email])->first();
            session(['user' => $user]);  //todo session started
            if (!$user) {
                DB::table('tf_reg')->insert(['email' => $userInfo->email, 'name' => $userInfo->name, 'picture' => $userInfo->picture, 'no_of_login' => '1']);
            }
            if ($user) {
                DB::table('tf_reg')->where(['email' => $user->email])->update(['picture' => $userInfo->picture]);
                $user_row = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();// return the first row containing the user(session wala user)
                if($user_row->meshmerize > 0 && empty($user_row->number)){
                    return redirect('/competitions/details_form');
                }
                return view("2019.competitions.meshmerize")->with(['user_row' => $user_row]);
            }
        }
        if(!isset($request->code) && !session()->has('user')) return view('2019.competitions.meshmerize');

        return redirect("/competitions/meshmerize/");
    }
    public function regmeshmerize(Request $request){
        $user_row = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();// return the first row containing the user(session wala user)
        DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->update(['meshmerize'=>'1']);
        $subject = "Welcome to Meshmerize - Techfest, IIT Bombay";
        $txt = "Dear $user_row->name,

Greetings! 
You have successfully registered in Meshmerize with $user_row->email as your registered mail Id. Now you must either Create a Team or Join a Team to complete the procedure.

Carefully read the FAQ’s of competitions carefully to know more.

Regards
";

        mail($user_row->email, $subject, $txt, "From:competitions@techfest.org" );
        return redirect("/competitions/meshmerize/");
    }
    public function meshmerize_create_team_form(Request $data){
        $current_user_data = DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
        return view("2019.competitions.create_teamform")->with(['current_user_data'=>$current_user_data, 'form'=>"meshmerize"]);
    }
    public function meshmerize_join_team_form(Request $data){
        $current_user_data = DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
        return view("2019.competitions.join_teamform")->with(['current_user_data'=>$current_user_data,'form'=>"meshmerize"]);
    }
    public function meshmerize_leave_team(){
        if(session()->has('user')) {
            $current_team =  DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
            if(!empty($current_team->meshmerize_team)){
                DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->update(['meshmerize_team'=>'']);
                return redirect("/competitions/meshmerize");
            }
            else return "you are not in a team";
        }
    }
    public function meshmerize_create_team_reg(Request $data){
        if (session()->has('user')) {
            $current_user_data = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();
            $a = 190000;
            $b = $current_user_data->id;
            $team_id = $a +$b;
            DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['meshmerize_team' => $current_user_data->email, 'meshmerize_team_id'=> $team_id]);

            $p2_exist = DB::table('tf_reg')->where(['email'=>$data->email2])->first();
            if(!empty($data->email2)){if (!empty($p2_exist->email)) {
                $p2 = DB::table('tf_reg')->where(['email' => $data->email2])->first();
//                check if he is already in a team
                if (empty($p2->meshmerize_team)) {
                    DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['meshmerize_team' => $current_user_data->email, 'meshmerize_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email2])->update(['meshmerize_team' => $current_user_data->email, 'meshmerize_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email2])->update(['meshmerize' => '1']);



                    $subject2 = "Meshmerize, Techfeat IIT Bomabay";
                    $txt2 = "Dear $p2_exist->name, you have been successfully added to $current_user_data->name's team for meshmerize .
Your Team ID and Registered Mail ID are very important and will be used in future.
You can leave your current team by clicking on Leave a Team. 
Regards.";

                    mail($p2_exist->email, $subject2, $txt2, "From:competitions@techfest.org" );



                    $subject0 = "Meshmerize, Techfeat IIT Bomabay";
                    $txt0 = "Dear $current_user_data->name, your team is successfully created for Meshmerize  
You are the Team Leader, you can Remove a Team member or Dissolve the existing team. Hoping to see you at Techfest  
Regards. ";

                    mail($current_user_data->email, $subject0, $txt0, "From:competitions@techfest.org" );


                } else return Redirect::back()->withErrors(["$p2->email is already in another team, he/she must leave current team first"]);

            } else return Redirect::back()->withErrors(["$data->email2 is not registered on techfest"]);}


            $p3_exist = DB::table('tf_reg')->where(['email'=>$data->email3])->first();
            if(!empty($data->email3)){if (!empty($p3_exist->email)) {
                $p3 = DB::table('tf_reg')->where(['email' => $data->email3])->first();
//                check if he is already in a team
                if (empty($p3->meshmerize_team)) {
                    DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['meshmerize_team' => $current_user_data->email, 'meshmerize_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email3])->update(['meshmerize_team' => $current_user_data->email, 'meshmerize_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email3])->update(['meshmerize' => '1']);



                    $subject2 = "Meshmerize, Techfeat IIT Bomabay";
                    $txt1 = "Dear $p3_exist->name, you have been successfully added to $current_user_data->name's team for meshmerize .
Your Team ID and Registered Mail ID are very important and will be used in future.
You can leave your current team by clicking on Leave a Team. 
Regards.";

                    mail($p3_exist->email, $subject2, $txt2, "From:competitions@techfest.org" );


                } else return Redirect::back()->withErrors(["$p3->email is already in another team, he/she must leave current team first"]);

            } else return Redirect::back()->withErrors(["$data->email3 is not registered on techfest"]);}

            $p4_exist = DB::table('tf_reg')->where(['email'=>$data->email4])->first();
            if(!empty($data->email3)){if(!empty($p4_exist->email)) {
                $p4 = DB::table('tf_reg')->where(['email' => $data->email4])->first();
//                check if he is already in a team
                if (empty($p4->meshmerize_team)) {
                    DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['meshmerize_team' => $current_user_data->email, 'meshmerize_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email4])->update(['meshmerize_team' => $current_user_data->email, 'meshmerize_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email4])->update(['meshmerize' => '1']);



                    $subject4 = "Meshmerize, Techfeat IIT Bomabay";
                    $txt4 = "Dear $p4_exist->name, you have been successfully added to $current_user_data->name's team for meshmerize .
Your Team ID and Registered Mail ID are very important and will be used in future.
You can leave your current team by clicking on Leave a Team. 
Regards.";

                    mail($p4_exist->email, $subject4, $txt4, "From:competitions@techfest.org" );



                } else return  Redirect::back()->withErrors(["$p4->email is already in another team, he/she must leave current team first"]);

            } else return Redirect::back()->withErrors(["$data->email4 is not registered on techfest"]);}

            return redirect("/competitions/meshmerize");

        } else return redirect("/competitions/meshmerize");
    }
    public function meshmerize_join_team_reg(Request $data){
        if(session()->has('user')) {
            $current_user_data = DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
            $team_member_row = DB::table('tf_reg')->where(['email'=>$data->email])->first();
            if(!empty($team_member_row->email)){
                $team_member_count = DB::table('tf_reg')->where(['meshmerize_team' => $team_member_row->meshmerize_team])->count();

                if(empty($current_user_data->meshmerize_team)){
                    if($team_member_count <= 4 ){
                        if(!empty($data->email)){DB::table('tf_reg')->where(['email'=>$current_user_data->email])->update(['meshmerize_team'=>$team_member_row->meshmerize_team]);}
                        return redirect("/competitions/meshmerize");
                    }
                    else return Redirect::back()->withErrors(["Team does not exist /Team already full"]);
                }
                else return Redirect::back()->withErrors(["you are already registered in a team, drop current team to join new one"]);
            }
            else return Redirect::back()->withErrors(["$data->email is not registered on Techfest"]);


        }
        else return Redirect::back()->withErrors(["first signin"]);
    }
    public function meshmerize_remove_member (Request $request, $id){
        $user_row = DB::table('tf_reg')->where(['id' => $id])->first();
        $subject = "meshmerize, Techfeat IIT Bomabay";
        $txt = "Dear $user_row->name, you have been removed from the meshmerize Team by your team leader $user_row->meshmerize_team which had team id zzz, you can either join another team or create your own team as a single member if you want.";

        mail($user_row->email, $subject, $txt, "From:competitions@techfest.org" );

        DB::table('tf_reg')->where(['id' => $id])->update(['meshmerize_team'=> '']);

        return redirect("/competitions/meshmerize");
    }
    public function meshmerize_dissolve (){
        $current_user_data = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();
        $team =  DB::table('tf_reg')->where(['meshmerize_team' => $current_user_data->meshmerize_team])->get();
        if (!empty($team[0]->id)){DB::table('tf_reg')->where(['id' => $team[0]->id])->update(['meshmerize_team'=> '']);}
        if (!empty($team[1]->id)){DB::table('tf_reg')->where(['id' => $team[1]->id])->update(['meshmerize_team'=> '']);}
        if (!empty($team[2]->id)){DB::table('tf_reg')->where(['id' => $team[2]->id])->update(['meshmerize_team'=> '']);}
        if (!empty($team[3]->id)){DB::table('tf_reg')->where(['id' => $team[3]->id])->update(['meshmerize_team'=> '']);}
        return redirect("/competitions/meshmerize");
    }


    public function wmeshmerize(Request $request){
        $client = $this->google_auth($request);
        if ($client) {
            $oauth2 = new Google_Service_Oauth2($client);
            $userInfo = $oauth2->userinfo->get();
            $user = DB::table('tf_reg')->where(['email' => $userInfo->email])->first();
            session(['user' => $user]);  //todo session started
            if (!$user) {
                DB::table('tf_reg')->insert(['email' => $userInfo->email, 'name' => $userInfo->name, 'picture' => $userInfo->picture, 'no_of_login' => '1']);
            }
            if ($user) {
                DB::table('tf_reg')->where(['email' => $user->email])->update(['picture' => $userInfo->picture]);
                $user_row = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();// return the first row containing the user(session wala user)
                if($user_row->wmeshmerize > 0 && empty($user_row->number)){
                    return redirect('/competitions/details_form');
                }
                return view("2019.competitions.wmeshmerize")->with(['user_row' => $user_row]);
            }
        }
        if(!isset($request->code) && !session()->has('user')) return view('2019.competitions.wmeshmerize');

        return redirect("/competitions/wmeshmerize/");
    }
    public function regwmeshmerize(Request $request){
        $user_row = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();// return the first row containing the user(session wala user)
        DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->update(['wmeshmerize'=>'1']);
        $subject = "Welcome to meshmerize - Techfest, IIT Bombay";
        $txt = "Dear $user_row->name,

Greetings! 
You have successfully registered in Meshmerize with $user_row->email as your registered mail Id. Now you must either Create a Team or Join a Team to complete the procedure.

Carefully read the FAQ’s of competitions carefully to know more.

Regards
";

        mail($user_row->email, $subject, $txt, "From:competitions@techfest.org" );
        return redirect("/competitions/wmeshmerize/");
    }
    public function wmeshmerize_create_team_form(Request $data){
        $current_user_data = DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
        return view("2019.competitions.create_teamform")->with(['current_user_data'=>$current_user_data, 'form'=>"wmeshmerize"]);
    }
    public function wmeshmerize_join_team_form(Request $data){
        $current_user_data = DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
        return view("2019.competitions.join_teamform")->with(['current_user_data'=>$current_user_data,'form'=>"wmeshmerize"]);
    }
    public function wmeshmerize_leave_team(){
        if(session()->has('user')) {
            $current_team =  DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
            if(!empty($current_team->wmeshmerize_team)){
                DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->update(['wmeshmerize_team'=>'']);
                return redirect("/competitions/wmeshmerize");
            }
            else return "you are not in a team";
        }
    }
    public function wmeshmerize_create_team_reg(Request $data){
        if (session()->has('user')) {
            $current_user_data = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();
            $a = 190000;
            $b = $current_user_data->id;
            $team_id = $a +$b;
            DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['wmeshmerize_team' => $current_user_data->email, 'wmeshmerize_team_id'=> $team_id]);

            $p2_exist = DB::table('tf_reg')->where(['email'=>$data->email2])->first();
            if(!empty($data->email2)){if (!empty($p2_exist->email)) {
                $p2 = DB::table('tf_reg')->where(['email' => $data->email2])->first();
//                check if he is already in a team
                if (empty($p2->wmeshmerize_team)) {
                    DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['wmeshmerize_team' => $current_user_data->email, 'wmeshmerize_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email2])->update(['wmeshmerize_team' => $current_user_data->email, 'wmeshmerize_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email2])->update(['wmeshmerize' => '1']);



                    $subject2 = "Meshmerize, Techfeat IIT Bomabay";
                    $txt2 = "Dear $p2_exist->name, you have been successfully added to $current_user_data->name's team for meshmerize .
Your Team ID and Registered Mail ID are very important and will be used in future.
You can leave your current team by clicking on Leave a Team. 
Regards.";

                    mail($p2_exist->email, $subject2, $txt2, "From:competitions@techfest.org" );



                    $subject0 = "Meshmerize, Techfeat IIT Bomabay";
                    $txt0 = "Dear $current_user_data->name, your team is successfully created for Meshmerize  
You are the Team Leader, you can Remove a Team member or Dissolve the existing team. Hoping to see you at Techfest  
Regards. ";

                    mail($current_user_data->email, $subject0, $txt0, "From:competitions@techfest.org" );


                } else return Redirect::back()->withErrors(["$p2->email is already in another team, he/she must leave current team first"]);

            } else return Redirect::back()->withErrors(["$data->email2 is not registered on techfest"]);}


            $p3_exist = DB::table('tf_reg')->where(['email'=>$data->email3])->first();
            if(!empty($data->email3)){if (!empty($p3_exist->email)) {
                $p3 = DB::table('tf_reg')->where(['email' => $data->email3])->first();
//                check if he is already in a team
                if (empty($p3->wmeshmerize_team)) {
                    DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['wmeshmerize_team' => $current_user_data->email, 'wmeshmerize_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email3])->update(['wmeshmerize_team' => $current_user_data->email, 'wmeshmerize_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email3])->update(['wmeshmerize' => '1']);



                    $subject2 = "Meshmerize, Techfeat IIT Bomabay";
                    $txt1 = "Dear $p3_exist->name, you have been successfully added to $current_user_data->name's team for meshmerize .
Your Team ID and Registered Mail ID are very important and will be used in future.
You can leave your current team by clicking on Leave a Team. 
Regards.";

                    mail($p3_exist->email, $subject2, $txt2, "From:competitions@techfest.org" );


                } else return Redirect::back()->withErrors(["$p3->email is already in another team, he/she must leave current team first"]);

            } else return Redirect::back()->withErrors(["$data->email3 is not registered on techfest"]);}

            $p4_exist = DB::table('tf_reg')->where(['email'=>$data->email4])->first();
            if(!empty($data->email3)){if(!empty($p4_exist->email)) {
                $p4 = DB::table('tf_reg')->where(['email' => $data->email4])->first();
//                check if he is already in a team
                if (empty($p4->wmeshmerize_team)) {
                    DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['wmeshmerize_team' => $current_user_data->email, 'wmeshmerize_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email4])->update(['wmeshmerize_team' => $current_user_data->email, 'wmeshmerize_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email4])->update(['wmeshmerize' => '1']);



                    $subject4 = "Meshmerize, Techfeat IIT Bomabay";
                    $txt4 = "Dear $p4_exist->name, you have been successfully added to $current_user_data->name's team for meshmerize .
Your Team ID and Registered Mail ID are very important and will be used in future.
You can leave your current team by clicking on Leave a Team. 
Regards.";

                    mail($p4_exist->email, $subject4, $txt4, "From:competitions@techfest.org" );



                } else return  Redirect::back()->withErrors(["$p4->email is already in another team, he/she must leave current team first"]);

            } else return Redirect::back()->withErrors(["$data->email4 is not registered on techfest"]);}

            return redirect("/competitions/wmeshmerize");

        } else return redirect("/competitions/wmeshmerize");
    }
    public function wmeshmerize_join_team_reg(Request $data){
        if(session()->has('user')) {
            $current_user_data = DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
            $team_member_row = DB::table('tf_reg')->where(['email'=>$data->email])->first();
            if(!empty($team_member_row->email)){
                $team_member_count = DB::table('tf_reg')->where(['wmeshmerize_team' => $team_member_row->wmeshmerize_team])->count();

                if(empty($current_user_data->wmeshmerize_team)){
                    if($team_member_count <= 4 ){
                        if(!empty($data->email)){DB::table('tf_reg')->where(['email'=>$current_user_data->email])->update(['wmeshmerize_team'=>$team_member_row->wmeshmerize_team]);}
                        return redirect("/competitions/wmeshmerize");
                    }
                    else return Redirect::back()->withErrors(["Team does not exist /Team already full"]);
                }
                else return Redirect::back()->withErrors(["you are already registered in a team, drop current team to join new one"]);
            }
            else return Redirect::back()->withErrors(["$data->email is not registered on Techfest"]);


        }
        else return Redirect::back()->withErrors(["first signin"]);
    }
    public function wmeshmerize_remove_member (Request $request, $id){
        $user_row = DB::table('tf_reg')->where(['id' => $id])->first();
        $subject = "meshmerize, Techfeat IIT Bomabay";
        $txt = "Dear $user_row->name, you have been removed from the meshmerize Team by your team leader $user_row->wmeshmerize_team which had team id zzz, you can either join another team or create your own team as a single member if you want.";

        mail($user_row->email, $subject, $txt, "From:competitions@techfest.org" );

        DB::table('tf_reg')->where(['id' => $id])->update(['wmeshmerize_team'=> '']);

        return redirect("/competitions/wmeshmerize");
    }
    public function wmeshmerize_dissolve (){
        $current_user_data = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();
        $team =  DB::table('tf_reg')->where(['wmeshmerize_team' => $current_user_data->wmeshmerize_team])->get();
        if (!empty($team[0]->id)){DB::table('tf_reg')->where(['id' => $team[0]->id])->update(['wmeshmerize_team'=> '']);}
        if (!empty($team[1]->id)){DB::table('tf_reg')->where(['id' => $team[1]->id])->update(['wmeshmerize_team'=> '']);}
        if (!empty($team[2]->id)){DB::table('tf_reg')->where(['id' => $team[2]->id])->update(['wmeshmerize_team'=> '']);}
        if (!empty($team[3]->id)){DB::table('tf_reg')->where(['id' => $team[3]->id])->update(['wmeshmerize_team'=> '']);}
        return redirect("/competitions/wmeshmerize");
    }

    public function boeing(Request $request){
        $client = $this->google_auth($request);
        if ($client) {
            $oauth2 = new Google_Service_Oauth2($client);
            $userInfo = $oauth2->userinfo->get();
            $user = DB::table('tf_reg')->where(['email' => $userInfo->email])->first();
            session(['user' => $user]);  //todo session started
            if (!$user) {
                DB::table('tf_reg')->insert(['email' => $userInfo->email, 'name' => $userInfo->name, 'picture' => $userInfo->picture, 'no_of_login' => '1']);
            }
            if ($user) {
//                DB::table('tf_reg')->where(['email' => $user->email])->update(['picture' => $userInfo->picture]);
                $user_row = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();// return the first row containing the user(session wala user)
                if($user_row->boeing > 0 && empty($user_row->number)){
                    return redirect('/competitions/details_form');
                }
                return view("2019.competitions.boeing")->with(['user_row' => $user_row]);
            }
        }
        if(!isset($request->code) && !session()->has('user')) return view('2019.competitions.boeing');

//        return redirect("/competitions/boeing/");
    }
    public function regboeing(Request $request){
        $user_row = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();// return the first row containing the user(session wala user)
        DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->update(['boeing'=>'1']);
        $subject = "Welcome to boeing - Techfest, IIT Bombay";
        $txt = "Dear $user_row->name,

Greetings! 
You have successfully registered in boeing with $user_row->email as your registered mail Id. Now you must either Create a Team or Join a Team to complete the procedure.

Carefully read the FAQ’s of competitions carefully to know more.

Regards
";

        mail($user_row->email, $subject, $txt, "From:competitions@techfest.org" );
        return redirect("/competitions/boeing/");
    }
    public function boeing_create_team_form(Request $data){
        $current_user_data = DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
        return view("2019.competitions.create_teamform")->with(['current_user_data'=>$current_user_data, 'form'=>"boeing"]);
    }
    public function boeing_join_team_form(Request $data){
        $current_user_data = DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
        return view("2019.competitions.join_teamform")->with(['current_user_data'=>$current_user_data,'form'=>"boeing"]);
    }
    public function boeing_leave_team(){
        if(session()->has('user')) {
            $current_team =  DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
            if(!empty($current_team->boeing_team)){
                DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->update(['boeing_team'=>'']);
                return redirect("/competitions/boeing");
            }
            else return "you are not in a team";
        }
    }
    public function boeing_create_team_reg(Request $data){
        if (session()->has('user')) {
            $current_user_data = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();
            $a = 190000;
            $b = $current_user_data->id;
            $team_id = $a +$b;
            DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['boeing_team' => $current_user_data->email, 'boeing_team_id'=> $team_id]);

            $p2_exist = DB::table('tf_reg')->where(['email'=>$data->email2])->first();
            if(!empty($data->email2)){if (!empty($p2_exist->email)) {
                $p2 = DB::table('tf_reg')->where(['email' => $data->email2])->first();
//                check if he is already in a team
                if (empty($p2->boeing_team)) {
                    DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['boeing_team' => $current_user_data->email, 'boeing_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email2])->update(['boeing_team' => $current_user_data->email, 'boeing_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email2])->update(['boeing' => '1']);



                    $subject2 = "boeing, Techfeat IIT Bomabay";
                    $txt2 = "Dear $p2_exist->name, you have been successfully added to $current_user_data->name's team for boeing .
Your Team ID and Registered Mail ID are very important and will be used in future.
You can leave your current team by clicking on Leave a Team. 
Regards.";

                    mail($p2_exist->email, $subject2, $txt2, "From:competitions@techfest.org" );



                    $subject0 = "boeing, Techfeat IIT Bomabay";
                    $txt0 = "Dear $current_user_data->name, your team is successfully created for boeing  
You are the Team Leader, you can Remove a Team member or Dissolve the existing team. Hoping to see you at Techfest  
Regards. ";

                    mail($current_user_data->email, $subject0, $txt0, "From:competitions@techfest.org" );


                } else return Redirect::back()->withErrors(["$p2->email is already in another team, he/she must leave current team first"]);

            } else return Redirect::back()->withErrors(["$data->email2 is not registered on techfest"]);}


            $p3_exist = DB::table('tf_reg')->where(['email'=>$data->email3])->first();
            if(!empty($data->email3)){if (!empty($p3_exist->email)) {
                $p3 = DB::table('tf_reg')->where(['email' => $data->email3])->first();
//                check if he is already in a team
                if (empty($p3->boeing_team)) {
                    DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['boeing_team' => $current_user_data->email, 'boeing_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email3])->update(['boeing_team' => $current_user_data->email, 'boeing_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email3])->update(['boeing' => '1']);



                    $subject2 = "boeing, Techfeat IIT Bomabay";
                    $txt1 = "Dear $p3_exist->name, you have been successfully added to $current_user_data->name's team for boeing .
Your Team ID and Registered Mail ID are very important and will be used in future.
You can leave your current team by clicking on Leave a Team. 
Regards.";

                    mail($p3_exist->email, $subject2, $txt2, "From:competitions@techfest.org" );


                } else return Redirect::back()->withErrors(["$p3->email is already in another team, he/she must leave current team first"]);

            } else return Redirect::back()->withErrors(["$data->email3 is not registered on techfest"]);}

            $p4_exist = DB::table('tf_reg')->where(['email'=>$data->email4])->first();
            if(!empty($data->email3)){if(!empty($p4_exist->email)) {
                $p4 = DB::table('tf_reg')->where(['email' => $data->email4])->first();
//                check if he is already in a team
                if (empty($p4->boeing_team)) {
                    DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['boeing_team' => $current_user_data->email, 'boeing_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email4])->update(['boeing_team' => $current_user_data->email, 'boeing_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email4])->update(['boeing' => '1']);



                    $subject4 = "boeing, Techfeat IIT Bomabay";
                    $txt4 = "Dear $p4_exist->name, you have been successfully added to $current_user_data->name's team for boeing .
Your Team ID and Registered Mail ID are very important and will be used in future.
You can leave your current team by clicking on Leave a Team. 
Regards.";

                    mail($p4_exist->email, $subject4, $txt4, "From:competitions@techfest.org" );



                } else return  Redirect::back()->withErrors(["$p4->email is already in another team, he/she must leave current team first"]);

            } else return Redirect::back()->withErrors(["$data->email4 is not registered on techfest"]);}

            return redirect("/competitions/boeing");

        } else return redirect("/competitions/boeing");
    }
    public function boeing_join_team_reg(Request $data){
        if(session()->has('user')) {
            $current_user_data = DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
            $team_member_row = DB::table('tf_reg')->where(['email'=>$data->email])->first();
            if(!empty($team_member_row->email)){
                $team_member_count = DB::table('tf_reg')->where(['boeing_team' => $team_member_row->boeing_team])->count();

                if(empty($current_user_data->boeing_team)){
                    if($team_member_count <= 4 ){
                        if(!empty($data->email)){DB::table('tf_reg')->where(['email'=>$current_user_data->email])->update(['boeing_team'=>$team_member_row->boeing_team]);}
                        return redirect("/competitions/boeing");
                    }
                    else return Redirect::back()->withErrors(["Team does not exist /Team already full"]);
                }
                else return Redirect::back()->withErrors(["you are already registered in a team, drop current team to join new one"]);
            }
            else return Redirect::back()->withErrors(["$data->email is not registered on Techfest"]);


        }
        else return Redirect::back()->withErrors(["first signin"]);
    }
    public function boeing_remove_member (Request $request, $id){
        $user_row = DB::table('tf_reg')->where(['id' => $id])->first();
        $subject = "boeing, Techfeat IIT Bomabay";
        $txt = "Dear $user_row->name, you have been removed from the boeing Team by your team leader $user_row->boeing_team which had team id zzz, you can either join another team or create your own team as a single member if you want.";

        mail($user_row->email, $subject, $txt, "From:competitions@techfest.org" );

        DB::table('tf_reg')->where(['id' => $id])->update(['boeing_team'=> '']);

        return redirect("/competitions/boeing");
    }
    public function boeing_dissolve (){
        $current_user_data = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();
        $team =  DB::table('tf_reg')->where(['boeing_team' => $current_user_data->boeing_team])->get();
        if (!empty($team[0]->id)){DB::table('tf_reg')->where(['id' => $team[0]->id])->update(['boeing_team'=> '']);}
        if (!empty($team[1]->id)){DB::table('tf_reg')->where(['id' => $team[1]->id])->update(['boeing_team'=> '']);}
        if (!empty($team[2]->id)){DB::table('tf_reg')->where(['id' => $team[2]->id])->update(['boeing_team'=> '']);}
        if (!empty($team[3]->id)){DB::table('tf_reg')->where(['id' => $team[3]->id])->update(['boeing_team'=> '']);}
        return redirect("/competitions/boeing");
    }


    public function dronechallenge(Request $request){
        $client = $this->google_auth($request);
        if ($client) {
            $oauth2 = new Google_Service_Oauth2($client);
            $userInfo = $oauth2->userinfo->get();
            $user = DB::table('tf_reg')->where(['email' => $userInfo->email])->first();
            session(['user' => $user]);  //todo session started
            if (!$user) {
                DB::table('tf_reg')->insert(['email' => $userInfo->email, 'name' => $userInfo->name, 'picture' => $userInfo->picture, 'no_of_login' => '1']);
            }
            if ($user) {
                DB::table('tf_reg')->where(['email' => $user->email])->update(['picture' => $userInfo->picture]);
                $user_row = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();// return the first row containing the user(session wala user)
                if($user_row->dronechallenge > 0 && empty($user_row->number)){
                    return redirect('/competitions/details_form');
                }
                return view("2019.competitions.dronechallenge")->with(['user_row' => $user_row]);
            }
        }
        if(!isset($request->code) && !session()->has('user')) return view('2019.competitions.dronechallenge');

        return redirect("/competitions/dronechallenge/");
    }
    public function regdronechallenge(Request $request){
        $user_row = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();// return the first row containing the user(session wala user)
        DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->update(['dronechallenge'=>'1']);
        $subject = "Welcome to dronechallenge - Techfest, IIT Bombay";
        $txt = "Dear $user_row->name,

Greetings! 
You have successfully registered in dronechallenge with $user_row->email as your registered mail Id. Now you must either Create a Team or Join a Team to complete the procedure.

Carefully read the FAQ’s of competitions carefully to know more.

Regards
";

        mail($user_row->email, $subject, $txt, "From:competitions@techfest.org" );
        return redirect("/competitions/dronechallenge/");
    }
    public function dronechallenge_create_team_form(Request $data){
        $current_user_data = DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
        return view("2019.competitions.create_teamform")->with(['current_user_data'=>$current_user_data, 'form'=>"dronechallenge"]);
    }
    public function dronechallenge_join_team_form(Request $data){
        $current_user_data = DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
        return view("2019.competitions.join_teamform")->with(['current_user_data'=>$current_user_data,'form'=>"dronechallenge"]);
    }
    public function dronechallenge_leave_team(){
        if(session()->has('user')) {
            $current_team =  DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
            if(!empty($current_team->dronechallenge_team)){
                DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->update(['dronechallenge_team'=>'']);
                return redirect("/competitions/dronechallenge");
            }
            else return "you are not in a team";
        }
    }
    public function dronechallenge_create_team_reg(Request $data){
        if (session()->has('user')) {
            $current_user_data = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();
            $a = 190000;
            $b = $current_user_data->id;
            $team_id = $a +$b;
            DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['dronechallenge_team' => $current_user_data->email, 'dronechallenge_team_id'=> $team_id]);

            $p2_exist = DB::table('tf_reg')->where(['email'=>$data->email2])->first();
            if(!empty($data->email2)){if (!empty($p2_exist->email)) {
                $p2 = DB::table('tf_reg')->where(['email' => $data->email2])->first();
//                check if he is already in a team
                if (empty($p2->dronechallenge_team)) {
                    DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['dronechallenge_team' => $current_user_data->email, 'dronechallenge_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email2])->update(['dronechallenge_team' => $current_user_data->email, 'dronechallenge_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email2])->update(['dronechallenge' => '1']);



                    $subject2 = "dronechallenge, Techfeat IIT Bomabay";
                    $txt2 = "Dear $p2_exist->name, you have been successfully added to $current_user_data->name's team for dronechallenge .
Your Team ID and Registered Mail ID are very important and will be used in future.
You can leave your current team by clicking on Leave a Team. 
Regards.";

                    mail($p2_exist->email, $subject2, $txt2, "From:competitions@techfest.org" );



                    $subject0 = "dronechallenge, Techfeat IIT Bomabay";
                    $txt0 = "Dear $current_user_data->name, your team is successfully created for dronechallenge  
You are the Team Leader, you can Remove a Team member or Dissolve the existing team. Hoping to see you at Techfest  
Regards. ";

                    mail($current_user_data->email, $subject0, $txt0, "From:competitions@techfest.org" );


                } else return Redirect::back()->withErrors(["$p2->email is already in another team, he/she must leave current team first"]);

            } else return Redirect::back()->withErrors(["$data->email2 is not registered on techfest"]);}


            $p3_exist = DB::table('tf_reg')->where(['email'=>$data->email3])->first();
            if(!empty($data->email3)){if (!empty($p3_exist->email)) {
                $p3 = DB::table('tf_reg')->where(['email' => $data->email3])->first();
//                check if he is already in a team
                if (empty($p3->dronechallenge_team)) {
                    DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['dronechallenge_team' => $current_user_data->email, 'dronechallenge_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email3])->update(['dronechallenge_team' => $current_user_data->email, 'dronechallenge_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email3])->update(['dronechallenge' => '1']);



                    $subject2 = "dronechallenge, Techfeat IIT Bomabay";
                    $txt1 = "Dear $p3_exist->name, you have been successfully added to $current_user_data->name's team for dronechallenge .
Your Team ID and Registered Mail ID are very important and will be used in future.
You can leave your current team by clicking on Leave a Team. 
Regards.";

                    mail($p3_exist->email, $subject2, $txt2, "From:competitions@techfest.org" );


                } else return Redirect::back()->withErrors(["$p3->email is already in another team, he/she must leave current team first"]);

            } else return Redirect::back()->withErrors(["$data->email3 is not registered on techfest"]);}

            $p4_exist = DB::table('tf_reg')->where(['email'=>$data->email4])->first();
            if(!empty($data->email3)){if(!empty($p4_exist->email)) {
                $p4 = DB::table('tf_reg')->where(['email' => $data->email4])->first();
//                check if he is already in a team
                if (empty($p4->dronechallenge_team)) {
                    DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['dronechallenge_team' => $current_user_data->email, 'dronechallenge_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email4])->update(['dronechallenge_team' => $current_user_data->email, 'dronechallenge_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email4])->update(['dronechallenge' => '1']);



                    $subject4 = "dronechallenge, Techfeat IIT Bomabay";
                    $txt4 = "Dear $p4_exist->name, you have been successfully added to $current_user_data->name's team for dronechallenge .
Your Team ID and Registered Mail ID are very important and will be used in future.
You can leave your current team by clicking on Leave a Team. 
Regards.";

                    mail($p4_exist->email, $subject4, $txt4, "From:competitions@techfest.org" );



                } else return  Redirect::back()->withErrors(["$p4->email is already in another team, he/she must leave current team first"]);

            } else return Redirect::back()->withErrors(["$data->email4 is not registered on techfest"]);}

            return redirect("/competitions/dronechallenge");

        } else return redirect("/competitions/dronechallenge");
    }
    public function dronechallenge_join_team_reg(Request $data){
        if(session()->has('user')) {
            $current_user_data = DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
            $team_member_row = DB::table('tf_reg')->where(['email'=>$data->email])->first();
            if(!empty($team_member_row->email)){
                $team_member_count = DB::table('tf_reg')->where(['dronechallenge_team' => $team_member_row->dronechallenge_team])->count();

                if(empty($current_user_data->dronechallenge_team)){
                    if($team_member_count <= 4 ){
                        if(!empty($data->email)){DB::table('tf_reg')->where(['email'=>$current_user_data->email])->update(['dronechallenge_team'=>$team_member_row->dronechallenge_team]);}
                        return redirect("/competitions/dronechallenge");
                    }
                    else return Redirect::back()->withErrors(["Team does not exist /Team already full"]);
                }
                else return Redirect::back()->withErrors(["you are already registered in a team, drop current team to join new one"]);
            }
            else return Redirect::back()->withErrors(["$data->email is not registered on Techfest"]);


        }
        else return Redirect::back()->withErrors(["first signin"]);
    }
    public function dronechallenge_remove_member (Request $request, $id){
        $user_row = DB::table('tf_reg')->where(['id' => $id])->first();
        $subject = "dronechallenge, Techfeat IIT Bomabay";
        $txt = "Dear $user_row->name, you have been removed from the dronechallenge Team by your team leader $user_row->dronechallenge_team which had team id zzz, you can either join another team or create your own team as a single member if you want.";

        mail($user_row->email, $subject, $txt, "From:competitions@techfest.org" );

        DB::table('tf_reg')->where(['id' => $id])->update(['dronechallenge_team'=> '']);

        return redirect("/competitions/dronechallenge");
    }
    public function dronechallenge_dissolve (){
        $current_user_data = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();
        $team =  DB::table('tf_reg')->where(['dronechallenge_team' => $current_user_data->dronechallenge_team])->get();
        if (!empty($team[0]->id)){DB::table('tf_reg')->where(['id' => $team[0]->id])->update(['dronechallenge_team'=> '']);}
        if (!empty($team[1]->id)){DB::table('tf_reg')->where(['id' => $team[1]->id])->update(['dronechallenge_team'=> '']);}
        if (!empty($team[2]->id)){DB::table('tf_reg')->where(['id' => $team[2]->id])->update(['dronechallenge_team'=> '']);}
        if (!empty($team[3]->id)){DB::table('tf_reg')->where(['id' => $team[3]->id])->update(['dronechallenge_team'=> '']);}
        return redirect("/competitions/dronechallenge");
    }

    public function makerthon(Request $request){
        $client = $this->google_auth($request);
        if ($client) {
            $oauth2 = new Google_Service_Oauth2($client);
            $userInfo = $oauth2->userinfo->get();
            $user = DB::table('tf_reg')->where(['email' => $userInfo->email])->first();
            session(['user' => $user]);  //todo session started
            if (!$user) {
                DB::table('tf_reg')->insert(['email' => $userInfo->email, 'name' => $userInfo->name, 'picture' => $userInfo->picture, 'no_of_login' => '1']);
            }
            if ($user) {
                DB::table('tf_reg')->where(['email' => $user->email])->update(['picture' => $userInfo->picture]);
                $user_row = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();// return the first row containing the user(session wala user)
                if($user_row->makerthon > 0 && empty($user_row->number)){
                    return redirect('/competitions/details_form');
                }
                return view("2019.competitions.makerthon")->with(['user_row' => $user_row]);
            }
        }
        if(!isset($request->code) && !session()->has('user')) return view('2019.competitions.makerthon');

        return redirect("/competitions/makerthon/");
    }
    public function regmakerthon(Request $request){
        $user_row = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();// return the first row containing the user(session wala user)
        DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->update(['makerthon'=>'1']);
        $subject = "Welcome to makerthon - Techfest, IIT Bombay";
        $txt = "Dear $user_row->name,

Greetings! 
You have successfully registered in makerthon with $user_row->email as your registered mail Id. Now you must either Create a Team or Join a Team to complete the procedure.

Carefully read the FAQ’s of competitions carefully to know more.

Regards
";

        mail($user_row->email, $subject, $txt, "From:competitions@techfest.org" );
        return redirect("/competitions/makerthon/");
    }
    public function makerthon_create_team_form(Request $data){
        $current_user_data = DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
        return view("2019.competitions.create_teamform")->with(['current_user_data'=>$current_user_data, 'form'=>"makerthon"]);
    }
    public function makerthon_join_team_form(Request $data){
        $current_user_data = DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
        return view("2019.competitions.join_teamform")->with(['current_user_data'=>$current_user_data,'form'=>"makerthon"]);
    }
    public function makerthon_leave_team(){
        if(session()->has('user')) {
            $current_team =  DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
            if(!empty($current_team->makerthon_team)){
                DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->update(['makerthon_team'=>'']);
                return redirect("/competitions/makerthon");
            }
            else return "you are not in a team";
        }
    }
    public function makerthon_create_team_reg(Request $data){
        if (session()->has('user')) {
            $current_user_data = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();
            $a = 190000;
            $b = $current_user_data->id;
            $team_id = $a +$b;
            DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['makerthon_team' => $current_user_data->email, 'makerthon_team_id'=> $team_id]);

            $p2_exist = DB::table('tf_reg')->where(['email'=>$data->email2])->first();
            if(!empty($data->email2)){if (!empty($p2_exist->email)) {
                $p2 = DB::table('tf_reg')->where(['email' => $data->email2])->first();
//                check if he is already in a team
                if (empty($p2->makerthon_team)) {
                    DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['makerthon_team' => $current_user_data->email, 'makerthon_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email2])->update(['makerthon_team' => $current_user_data->email, 'makerthon_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email2])->update(['makerthon' => '1']);



                    $subject2 = "makerthon, Techfeat IIT Bomabay";
                    $txt2 = "Dear $p2_exist->name, you have been successfully added to $current_user_data->name's team for makerthon .
Your Team ID and Registered Mail ID are very important and will be used in future.
You can leave your current team by clicking on Leave a Team. 
Regards.";

                    mail($p2_exist->email, $subject2, $txt2, "From:competitions@techfest.org" );



                    $subject0 = "makerthon, Techfeat IIT Bomabay";
                    $txt0 = "Dear $current_user_data->name, your team is successfully created for makerthon  
You are the Team Leader, you can Remove a Team member or Dissolve the existing team. Hoping to see you at Techfest  
Regards. ";

                    mail($current_user_data->email, $subject0, $txt0, "From:competitions@techfest.org" );


                } else return Redirect::back()->withErrors(["$p2->email is already in another team, he/she must leave current team first"]);

            } else return Redirect::back()->withErrors(["$data->email2 is not registered on techfest"]);}


            $p3_exist = DB::table('tf_reg')->where(['email'=>$data->email3])->first();
            if(!empty($data->email3)){if (!empty($p3_exist->email)) {
                $p3 = DB::table('tf_reg')->where(['email' => $data->email3])->first();
//                check if he is already in a team
                if (empty($p3->makerthon_team)) {
                    DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['makerthon_team' => $current_user_data->email, 'makerthon_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email3])->update(['makerthon_team' => $current_user_data->email, 'makerthon_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email3])->update(['makerthon' => '1']);



                    $subject2 = "makerthon, Techfeat IIT Bomabay";
                    $txt1 = "Dear $p3_exist->name, you have been successfully added to $current_user_data->name's team for makerthon .
Your Team ID and Registered Mail ID are very important and will be used in future.
You can leave your current team by clicking on Leave a Team. 
Regards.";

                    mail($p3_exist->email, $subject2, $txt2, "From:competitions@techfest.org" );


                } else return Redirect::back()->withErrors(["$p3->email is already in another team, he/she must leave current team first"]);

            } else return Redirect::back()->withErrors(["$data->email3 is not registered on techfest"]);}

            $p4_exist = DB::table('tf_reg')->where(['email'=>$data->email4])->first();
            if(!empty($data->email3)){if(!empty($p4_exist->email)) {
                $p4 = DB::table('tf_reg')->where(['email' => $data->email4])->first();
//                check if he is already in a team
                if (empty($p4->makerthon_team)) {
                    DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['makerthon_team' => $current_user_data->email, 'makerthon_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email4])->update(['makerthon_team' => $current_user_data->email, 'makerthon_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email4])->update(['makerthon' => '1']);



                    $subject4 = "makerthon, Techfeat IIT Bomabay";
                    $txt4 = "Dear $p4_exist->name, you have been successfully added to $current_user_data->name's team for makerthon .
Your Team ID and Registered Mail ID are very important and will be used in future.
You can leave your current team by clicking on Leave a Team. 
Regards.";

                    mail($p4_exist->email, $subject4, $txt4, "From:competitions@techfest.org" );



                } else return  Redirect::back()->withErrors(["$p4->email is already in another team, he/she must leave current team first"]);

            } else return Redirect::back()->withErrors(["$data->email4 is not registered on techfest"]);}

            return redirect("/competitions/makerthon");

        } else return redirect("/competitions/makerthon");
    }
    public function makerthon_join_team_reg(Request $data){
        if(session()->has('user')) {
            $current_user_data = DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
            $team_member_row = DB::table('tf_reg')->where(['email'=>$data->email])->first();
            if(!empty($team_member_row->email)){
                $team_member_count = DB::table('tf_reg')->where(['makerthon_team' => $team_member_row->makerthon_team])->count();

                if(empty($current_user_data->makerthon_team)){
                    if($team_member_count <= 4 ){
                        if(!empty($data->email)){DB::table('tf_reg')->where(['email'=>$current_user_data->email])->update(['makerthon_team'=>$team_member_row->makerthon_team]);}
                        return redirect("/competitions/makerthon");
                    }
                    else return Redirect::back()->withErrors(["Team does not exist /Team already full"]);
                }
                else return Redirect::back()->withErrors(["you are already registered in a team, drop current team to join new one"]);
            }
            else return Redirect::back()->withErrors(["$data->email is not registered on Techfest"]);


        }
        else return Redirect::back()->withErrors(["first signin"]);
    }
    public function makerthon_remove_member (Request $request, $id){
        $user_row = DB::table('tf_reg')->where(['id' => $id])->first();
        $subject = "makerthon, Techfeat IIT Bomabay";
        $txt = "Dear $user_row->name, you have been removed from the makerthon Team by your team leader $user_row->makerthon_team which had team id zzz, you can either join another team or create your own team as a single member if you want.";

        mail($user_row->email, $subject, $txt, "From:competitions@techfest.org" );

        DB::table('tf_reg')->where(['id' => $id])->update(['makerthon_team'=> '']);

        return redirect("/competitions/makerthon");
    }
    public function makerthon_dissolve (){
        $current_user_data = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();
        $team =  DB::table('tf_reg')->where(['makerthon_team' => $current_user_data->makerthon_team])->get();
        if (!empty($team[0]->id)){DB::table('tf_reg')->where(['id' => $team[0]->id])->update(['makerthon_team'=> '']);}
        if (!empty($team[1]->id)){DB::table('tf_reg')->where(['id' => $team[1]->id])->update(['makerthon_team'=> '']);}
        if (!empty($team[2]->id)){DB::table('tf_reg')->where(['id' => $team[2]->id])->update(['makerthon_team'=> '']);}
        if (!empty($team[3]->id)){DB::table('tf_reg')->where(['id' => $team[3]->id])->update(['makerthon_team'=> '']);}
        return redirect("/competitions/makerthon");
    }

    public function codebuzz(Request $request){
        $client = $this->google_auth($request);
        if ($client) {
            $oauth2 = new Google_Service_Oauth2($client);
            $userInfo = $oauth2->userinfo->get();
            $user = DB::table('tf_reg')->where(['email' => $userInfo->email])->first();
            session(['user' => $user]);  //todo session started
            if (!$user) {
                DB::table('tf_reg')->insert(['email' => $userInfo->email, 'name' => $userInfo->name, 'picture' => $userInfo->picture, 'no_of_login' => '1']);
            }
            if ($user) {
                DB::table('tf_reg')->where(['email' => $user->email])->update(['picture' => $userInfo->picture]);
                $user_row = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();// return the first row containing the user(session wala user)
                if($user_row->codebuzz > 0 && empty($user_row->number)){
                    return redirect('/competitions/details_form');
                }
                return view("2019.competitions.codebuzz")->with(['user_row' => $user_row]);
            }
        }
        if(!isset($request->code) && !session()->has('user')) return view('2019.competitions.codebuzz');

        return redirect("/competitions/codebuzz/");
    }
    public function regcodebuzz(Request $request){
        $user_row = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();// return the first row containing the user(session wala user)
        DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->update(['codebuzz'=>'1']);
        $subject = "Welcome to codebuzz - Techfest, IIT Bombay";
        $txt = "Dear $user_row->name,

Greetings! 
You have successfully registered in codebuzz with $user_row->email as your registered mail Id. Now you must either Create a Team or Join a Team to complete the procedure.

Carefully read the FAQ’s of competitions carefully to know more.

Regards
";

        mail($user_row->email, $subject, $txt, "From:competitions@techfest.org" );
        return redirect("/competitions/codebuzz/");
    }
    public function codebuzz_create_team_form(Request $data){
        $current_user_data = DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
        return view("2019.competitions.create_teamform")->with(['current_user_data'=>$current_user_data, 'form'=>"codebuzz"]);
    }
    public function codebuzz_join_team_form(Request $data){
        $current_user_data = DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
        return view("2019.competitions.join_teamform")->with(['current_user_data'=>$current_user_data,'form'=>"codebuzz"]);
    }
    public function codebuzz_leave_team(){
        if(session()->has('user')) {
            $current_team =  DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
            if(!empty($current_team->codebuzz_team)){
                DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->update(['codebuzz_team'=>'']);
                return redirect("/competitions/codebuzz");
            }
            else return "you are not in a team";
        }
    }
    public function codebuzz_create_team_reg(Request $data){
        if (session()->has('user')) {
            $current_user_data = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();
            $a = 190000;
            $b = $current_user_data->id;
            $team_id = $a +$b;
            DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['codebuzz_team' => $current_user_data->email, 'codebuzz_team_id'=> $team_id]);

            $p2_exist = DB::table('tf_reg')->where(['email'=>$data->email2])->first();
            if(!empty($data->email2)){if (!empty($p2_exist->email)) {
                $p2 = DB::table('tf_reg')->where(['email' => $data->email2])->first();
//                check if he is already in a team
                if (empty($p2->codebuzz_team)) {
                    DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['codebuzz_team' => $current_user_data->email, 'codebuzz_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email2])->update(['codebuzz_team' => $current_user_data->email, 'codebuzz_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email2])->update(['codebuzz' => '1']);



                    $subject2 = "codebuzz, Techfeat IIT Bomabay";
                    $txt2 = "Dear $p2_exist->name, you have been successfully added to $current_user_data->name's team for codebuzz .
Your Team ID and Registered Mail ID are very important and will be used in future.
You can leave your current team by clicking on Leave a Team. 
Regards.";

                    mail($p2_exist->email, $subject2, $txt2, "From:competitions@techfest.org" );



                    $subject0 = "codebuzz, Techfeat IIT Bomabay";
                    $txt0 = "Dear $current_user_data->name, your team is successfully created for codebuzz  
You are the Team Leader, you can Remove a Team member or Dissolve the existing team. Hoping to see you at Techfest  
Regards. ";

                    mail($current_user_data->email, $subject0, $txt0, "From:competitions@techfest.org" );


                } else return Redirect::back()->withErrors(["$p2->email is already in another team, he/she must leave current team first"]);

            } else return Redirect::back()->withErrors(["$data->email2 is not registered on techfest"]);}


            $p3_exist = DB::table('tf_reg')->where(['email'=>$data->email3])->first();
            if(!empty($data->email3)){if (!empty($p3_exist->email)) {
                $p3 = DB::table('tf_reg')->where(['email' => $data->email3])->first();
//                check if he is already in a team
                if (empty($p3->codebuzz_team)) {
                    DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['codebuzz_team' => $current_user_data->email, 'codebuzz_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email3])->update(['codebuzz_team' => $current_user_data->email, 'codebuzz_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email3])->update(['codebuzz' => '1']);



                    $subject2 = "codebuzz, Techfeat IIT Bomabay";
                    $txt1 = "Dear $p3_exist->name, you have been successfully added to $current_user_data->name's team for codebuzz .
Your Team ID and Registered Mail ID are very important and will be used in future.
You can leave your current team by clicking on Leave a Team. 
Regards.";

                    mail($p3_exist->email, $subject2, $txt2, "From:competitions@techfest.org" );


                } else return Redirect::back()->withErrors(["$p3->email is already in another team, he/she must leave current team first"]);

            } else return Redirect::back()->withErrors(["$data->email3 is not registered on techfest"]);}

            $p4_exist = DB::table('tf_reg')->where(['email'=>$data->email4])->first();
            if(!empty($data->email3)){if(!empty($p4_exist->email)) {
                $p4 = DB::table('tf_reg')->where(['email' => $data->email4])->first();
//                check if he is already in a team
                if (empty($p4->codebuzz_team)) {
                    DB::table('tf_reg')->where(['email' => $current_user_data->email])->update(['codebuzz_team' => $current_user_data->email, 'codebuzz_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email4])->update(['codebuzz_team' => $current_user_data->email, 'codebuzz_team_id'=> $team_id]);
                    DB::table('tf_reg')->where(['email' => $data->email4])->update(['codebuzz' => '1']);



                    $subject4 = "codebuzz, Techfeat IIT Bomabay";
                    $txt4 = "Dear $p4_exist->name, you have been successfully added to $current_user_data->name's team for codebuzz .
Your Team ID and Registered Mail ID are very important and will be used in future.
You can leave your current team by clicking on Leave a Team. 
Regards.";

                    mail($p4_exist->email, $subject4, $txt4, "From:competitions@techfest.org" );



                } else return  Redirect::back()->withErrors(["$p4->email is already in another team, he/she must leave current team first"]);

            } else return Redirect::back()->withErrors(["$data->email4 is not registered on techfest"]);}

            return redirect("/competitions/codebuzz");

        } else return redirect("/competitions/codebuzz");
    }
    public function codebuzz_join_team_reg(Request $data){
        if(session()->has('user')) {
            $current_user_data = DB::table('tf_reg')->where(['email'=>session()->get('user')->email])->first();
            $team_member_row = DB::table('tf_reg')->where(['email'=>$data->email])->first();
            if(!empty($team_member_row->email)){
                $team_member_count = DB::table('tf_reg')->where(['codebuzz_team' => $team_member_row->codebuzz_team])->count();

                if(empty($current_user_data->codebuzz_team)){
                    if($team_member_count <= 4 ){
                        if(!empty($data->email)){DB::table('tf_reg')->where(['email'=>$current_user_data->email])->update(['codebuzz_team'=>$team_member_row->codebuzz_team]);}
                        return redirect("/competitions/codebuzz");
                    }
                    else return Redirect::back()->withErrors(["Team does not exist /Team already full"]);
                }
                else return Redirect::back()->withErrors(["you are already registered in a team, drop current team to join new one"]);
            }
            else return Redirect::back()->withErrors(["$data->email is not registered on Techfest"]);


        }
        else return Redirect::back()->withErrors(["first signin"]);
    }
    public function codebuzz_remove_member (Request $request, $id){
        $user_row = DB::table('tf_reg')->where(['id' => $id])->first();
        $subject = "codebuzz, Techfeat IIT Bomabay";
        $txt = "Dear $user_row->name, you have been removed from the codebuzz Team by your team leader $user_row->codebuzz_team which had team id zzz, you can either join another team or create your own team as a single member if you want.";

        mail($user_row->email, $subject, $txt, "From:competitions@techfest.org" );

        DB::table('tf_reg')->where(['id' => $id])->update(['codebuzz_team'=> '']);

        return redirect("/competitions/codebuzz");
    }
    public function codebuzz_dissolve (){
        $current_user_data = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();
        $team =  DB::table('tf_reg')->where(['codebuzz_team' => $current_user_data->codebuzz_team])->get();
        if (!empty($team[0]->id)){DB::table('tf_reg')->where(['id' => $team[0]->id])->update(['codebuzz_team'=> '']);}
        if (!empty($team[1]->id)){DB::table('tf_reg')->where(['id' => $team[1]->id])->update(['codebuzz_team'=> '']);}
        if (!empty($team[2]->id)){DB::table('tf_reg')->where(['id' => $team[2]->id])->update(['codebuzz_team'=> '']);}
        if (!empty($team[3]->id)){DB::table('tf_reg')->where(['id' => $team[3]->id])->update(['codebuzz_team'=> '']);}
        return redirect("/competitions/codebuzz");
    }


















    //2019 controllers for links
    public function competitions(Request $request){

        $client = $this->google_auth($request);
        if ($client) {
            $oauth2 = new Google_Service_Oauth2($client);
            $userInfo = $oauth2->userinfo->get();
            $user = DB::table('tf_reg')->where(['email' => $userInfo->email])->first();
            session(['user' => $user]);  //todo session started
            if (!$user) {
                DB::table('tf_reg')->insert(['email' => $userInfo->email, 'name' => $userInfo->name, 'picture' => $userInfo->picture, 'no_of_login' => '1']);
                return redirect('/competitions');
            }
            if ($user) {
                DB::table('tf_reg')->where(['email' => $user->email])->update(['picture' => $userInfo->picture]);
                $user_row = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();// return the first row containing the user(session wala user)
                return view("2019.competitions.competitions")->with(['user_row' => $user_row]);
            }
        }
        if(!isset($request->code) && !session()->has('user')) return view('2019.competitions.competitions');
        return redirect('/competitions');
    }


    public function ideate(Request $request){
        if(!isset($request->code) && !session()->has('user')) return view('2019.ideate.ideate');
        $client = $this->google_auth($request);
        if ($client) {
            $oauth2 = new Google_Service_Oauth2($client);
            $userInfo = $oauth2->userinfo->get();
            $user = DB::table('tf_reg')->where(['email' => $userInfo->email])->first();
            session(['user' => $user]);  //todo session started
            if (!$user) {
                DB::table('tf_reg')->insert(['email' => $userInfo->email, 'name' => $userInfo->name, 'picture' => $userInfo->picture, 'no_of_login' => '1']);
            }
            if ($user) {
                DB::table('tf_reg')->where(['email' => $user->email])->update(['picture' => $userInfo->picture]);
                $user_row = DB::table('tf_reg')->where(['email' => session()->get('user')->email])->first();// return the first row containing the user(session wala user)
                return view("2019.ideate.ideate")->with(['user_row' => $user_row]);
            }
        }
        return "Your browser isn't supported, please use another browser";
//        return view('caGet');

    }



    public function summit(Request $data){
        if(!empty($data->email)){
            DB::table('tf_subscribe')->insert(['email' => $data->email, 'dept'=>'summit']);
            $subject = "Welcome to Techfest International Summit";
            $txt = "Dear $data->email,

Thank you for subscribing to notifications for Techfest International Summit. We shall be updating this page soon and as soon as we do, you shall be amongst the first to know!
Regards,
Team Techfest";

            mail($data->email, $subject, $txt, "From:techfest@techfest.org" );

            return Redirect::back()->withErrors(['Thank you for subscribing to Summit. For confirmation, please check your mail!']);

        }
        return view('2019.summit');

    }
    public function esports(Request $data){
        if(!empty($data->email)) {
            DB::table('tf_subscribe')->insert(['email' => $data->email, 'dept' => 'esports']);
            $subject = "Welcome to Techfest ESports";
            $txt = "Dear $data->email,

Thank you for subscribing to notifications for ESports. We shall be updating this page soon and as soon as we do, you shall be amongst the first to know!
Regards,
Team Techfest";

            mail($data->email, $subject, $txt, "From:techfest@techfest.org" );

            return Redirect::back()->withErrors(['Thank you for subscribing to ESports. For confirmation, please check your mail!']);

        }
        return view('2019.esports');

    }
    public function workshops(Request $data){
        if(!empty($data->email)) {

            DB::table('tf_subscribe')->insert(['email' => $data->email, 'dept' => 'workshops']);
            $subject = "Welcome to Techfest Workshops";
            $txt = "Dear $data->email,

Thank you for subscribing to notifications for Workshops. We shall be updating this page soon and as soon as we do, you shall be amongst the first to know!
Regards,
Team Techfest";

            mail($data->email, $subject, $txt, "From:techfest@techfest.org" );

            return Redirect::back()->withErrors(['Thank you for subscribing to Workshops. For confirmation, please check your mail!']);

        }
        return view('2019.workshops');

    }
    public function hospitality(Request $data){
        if(!empty($data->email)) {
            DB::table('tf_subscribe')->insert(['email' => $data->email, 'dept' => 'hospitality']);
            $subject = "Welcome to Techfest Hospitality";
            $txt = "Dear $data->email,

Thank you for subscribing to notifications for Techfest's Hospitality. We shall be updating this page soon and as soon as we do, you shall be amongst the first to know!
Regards,
Team Techfest";

            mail($data->email, $subject, $txt, "From:techfest@techfest.org" );

            return Redirect::back()->withErrors(['Thank you for subscribing to Hospitality. For confirmation, please check your mail!']);

        }
        return view('2019.hospitality');

    }
    public function schedule_extra(Request $data){
        if(!empty($data->email)) {
            DB::table('tf_subscribe')->insert(['email' => $data->email, 'dept' => 'schedule']);
            $subject = "Welcome to International Full Throttle";
            $txt = "Dear $data->email,

Thank you for subscribing to notifications for Techfest International Full Throttle. We shall be updating this page soon and as soon as we do, you shall be amongst the first to know!
Regards,
Team Techfest";

            mail($data->email, $subject, $txt, "From:techfest@techfest.org" );

            return Redirect::back()->withErrors(['Thank you for subscribing to Techfest Schedule. For confirmation, please check your mail!']);

        }
        return view('2019.schedule');

    }
    public function initiative(Request $data){
        if(!empty($data->email)) {
            DB::table('tf_subscribe')->insert(['email' => $data->email, 'dept' => 'initiative']);
            $subject = "Welcome to Techfest Initiatives";
            $txt = "Dear $data->email,

Thank you for subscribing to notifications for Techfest Initiatives. We shall be updating this page soon and as soon as we do, you shall be amongst the first to know!
Regards,
Team Techfest";

            mail($data->email, $subject, $txt, "From:techfest@techfest.org" );

            return Redirect::back()->withErrors(['Thank you for subscribing to Initiatives. For confirmation, please check your mail!']);

        }
        return view('2019.initiatives_2019.initiatives2019');

    }
    public function mun(Request $data){
        if(!empty($data->email)) {
            DB::table('tf_subscribe')->insert(['email' => $data->email, 'dept' => 'mun']);
            $subject = "Welcome to Techfest World MUN";
            $txt = "Dear $data->email,

Thank you for subscribing to notifications for Techfest World MUN. We shall be updating this page soon and as soon as we do, you shall be amongst the first to know!
Regards,
Team Techfest";

            mail($data->email, $subject, $txt, "From:techfest@techfest.org" );

            return Redirect::back()->withErrors(['Thank you for subscribing to TWMUN. For confirmation, please check your mail!']);

        }
        return view('2019.mun');

    }
    public function ift(Request $data){
        if(!empty($data->email)) {
            DB::table('tf_subscribe')->insert(['email' => $data->email, 'dept' => 'ift']);

            $subject = "Welcome to International Full Throttle";
            $txt = "Dear $data->email,

Thank you for subscribing to notifications for Techfest International Full Throttle. We shall be updating this page soon and as soon as we do, you shall be amongst the first to know!
Regards,
Team Techfest";

            mail($data->email, $subject, $txt, "From:techfest@techfest.org" );

            return Redirect::back()->withErrors(['Thank you for subscribing to International Full Throttle. For confirmation, please check your mail!']);
        }
        return view('2019.ift');

    }
    public function ozone____extra(Request $data){
        if(!empty($data->email)) {
            DB::table('tf_subscribe')->insert(['email' => $data->email, 'dept' => 'ift']);

            $subject = "Welcome to International Full Throttle";
            $txt = "Dear $data->email,

Thank you for subscribing to notifications for Techfest International Full Throttle. We shall be updating this page soon and as soon as we do, you shall be amongst the first to know!
Regards,
Team Techfest";

            mail($data->email, $subject, $txt, "From:techfest@techfest.org" );

            return Redirect::back()->withErrors(['Thank you for subscribing to International Full Throttle. For confirmation, please check your mail!']);
        }
        return view('2019.ozone');

    }
    public function technoholix(Request $data){
        if(!empty($data->email)) {
            DB::table('tf_subscribe')->insert(['email' => $data->email, 'dept' => 'technoholix']);

            $subject = "Welcome to Technoholix";
            $txt = "Dear $data->email,

Thank you for subscribing to notifications for Technoholix. We shall be updating this page soon and as soon as we do, you shall be amongst the first to know!
Regards,
Team Techfest";

            mail($data->email, $subject, $txt, "From:techfest@techfest.org" );

            return Redirect::back()->withErrors(['Thank you for subscribing to Technoholix. For confirmation, please check your mail!']);
        }
        return view('2019.technoholix');

    }
    public function exhibitions(Request $data){
        if(!empty($data->email)) {
            DB::table('tf_subscribe')->insert(['email' => $data->email, 'dept' => 'exhibitions']);

            $subject = "Welcome to Techfest International Exhibitions";
            $txt = "Dear $data->email,

Thank you for subscribing to notifications for Techfest International Exhibitions. We shall be updating this page soon and as soon as we do, you shall be amongst the first to know!
Regards,
Team Techfest";

            mail($data->email, $subject, $txt, "From:techfest@techfest.org" );

            return Redirect::back()->withErrors(['Thank you for subscribing to Exhibitions. For confirmation, please check your mail!']);
        }
        return view('2019.exhibitions');

    }
    public function robowars(Request $data){
        if(!empty($data->email)) {
            DB::table('tf_subscribe')->insert(['email' => $data->email, 'dept' => 'robowars']);

            $subject = "Welcome to Techfest International Robowars";
            $txt = "Dear $data->email,

Thank you for subscribing to notifications for Techfest International Robowars. We shall be updating this page soon and as soon as we do, you shall be amongst the first to know!
Regards,
Team Techfest";

            mail($data->email, $subject, $txt, "From:techfest@techfest.org" );

            return Redirect::back()->withErrors(['Thank you for subscribing to Techfest International Robowars. For confirmation, please check your mail!']);
        }
        return view('2019.robowars');

    }







































    public function recaptchaValidate($response){
        $curl = curl_init('https://www.google.com/recaptcha/api/siteverify');
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query(['secret'=>'6Lcyfl0UAAAAAPPn6JB9Tcv2ieJWSQxDqWoZe_Nh','response'=>$response]));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response);
        $response->success = true;
        return $response;
    }
    public function Get(){
        $urlMain = str_replace('https://techfest.org/','',url()->current());
        $urlName = strtolower($urlMain);
        $meta = [
            ''=>[
                'title'=> 'Techfest | Asia\'s Largest Science & Technology Festival',
                'description'=> 'Techfest: 14th to 16th December. IIT Bombay presents Asia\'s Largest Science and Technology Festival. Get ready for an awesome adventurous journey.',
                'keywords'=> 'techfest, largest technical fest, asia\'s largest college festival, largest science fest, largest technology fest,iit mumbai,tech fest, mumbai,techfest 2019, techfest 2018, asia, visit IIT Bombay, visit Bombay, competitions, workshops, exhibitions, lectures, fun, mumbai, festival, tf2k18, tf2k19, tech entertainment, tech extravaganza, representative, 2018, leader'
            ],
            'home'=>[
                'title'=> 'Techfest | Asia\'s Largest Science & Technology Festival',
                'description'=> 'Techfest: 14th to 16th December. IIT Bombay presents Asia\'s Largest Science and Technology Festival. Get ready for an awesome adventurous journey.',
                'keywords'=> 'techfest,iit mumbai,tech fest, mumbai,techfest 2019, techfest 2018, asia, visit IIT Bombay, visit Bombay, competitions, workshops, exhibitions, lectures, fun, mumbai, festival, tf2k18, tf2k19, tech entertainment, tech extravaganza, representative, 2018, leader'
            ],
            'competitions'=>[
                'title'=>'Competitions | Techfest 2018-19',
                'description'=>'Competitions conducted by Techfest, IIT Bombay have participation from national as well as international teams and it covers many genres including robotics, aeromodelling, aquatics, coding, image processing, structural engineering, gaming and many more',
                'keywords'=>'coding, programing, hacking,competitions,international competition, IRC, Robowar ,tech , robots,steel, making technology, electronics, technorion,Techfest competitions'
            ],
            'lectures'=>[
                'title'=>'Lectures | Techfest 2018-19',
                'description'=>' Lectures, Techfest IIT Bombay celebrates some of the most eminent personalities across the globe showcasing an array of motivational and insightful talks by them. With larger than life names, lectures has proved to be a one-stop destination to procure knowledge and inspiration.',
                'keywords' => ' lectures, lecture series,  late APJ Abdul Kalam, Hamid Karzai India, Hamid Karzai, Sophia, Pranab Mukherjee, lecturer,  academic lectures, IITB , IIT Bombay lectures, motivational lectures, Tanmay Bakshi, IBM Watson lecture, video lecture, video lectures, apple cto, Pranav Mistry, sixth sense, convo lecture, convocation lecture,  convocation lectures, pcsa lecture,  pcsa lecture, prefest, prefest lecture '
            ],
            'technoholix' =>[
                'title' => 'Technoholix | Techfest 2018-19' ,
                'description' => 'Technoholix, or TechX are the techno-cultural nights of Techfest, IIT Bombay which enthral the audience with performances from international artists, all free of cost.',
                'keywords' => 'Best late night, Best night shows, Friday night, Sunday night, Last late night, First late night , late night page, Light night show, Live night show, Night show timings, Concert, EDM, DJ marnik, Sountec, best concert, concert junkie, top concerts, amazing laser show, DJ laser show, edm laser show, biggest tech events, electronic show, new technology events, popular tech shows, best techno mix, lights, lasers, DJ music, DJ techno, artists, artists music, artist network, famous performers, performers, female artists, popular artists, performers, thrill, enthusiasm, fun, enjoy, live performance, sand show, shadow dance, LED, interactive show, laser and light, light dance show, light show event, wonderful light show, Electronic Dance Music, Electronic, Dance, Music, Popular, technology, laser, night, late, last, event, performers,'

            ],
            'media' => [
                'title' => 'Media | Techfest 2018-19',
                'description' => 'A glimpse of the Media attraction that Techfest has received in the past years, ranging from National newspapers to TV channels of various genres to a multitude of media platforms.',
                'keywords' => 'Media, TV Channels, Newspapers, Radio, Publicity, Magazines, Reporters, communication, press, press release, journalist, broadcasting, journalism, print, coverage, headlines, multicast, outreach, News, telecast, streaming, conference, press conference, advertisements'
            ],
            'ozone' => [
                'title' => 'Ozone | Techfest 2018-19',
                'description' => 'Keeping the festive spirit alive, ozone brings out the fun in Techfest in various Entertainment based gadgetry. Ozone plays host to a variety of street artists from around the globe and organises engaging workshops.',
                'keywords' => 'fun, fiesta, ozone, artists, games, ambiance, enjoy, live show, live performance, wall painting, aerial ambiance, installations, lazer tag, convo lawns, international, sac back-lawns, entertainment, VR, AR, workshops, wall art, unconventional, adrenaline, gaming, amusement, informal, stage, lively, youth'

            ],
            'twmun' => [
                'title' => ' Techfest World MUN | Techfest 2018-19' ,
                'description' => 'Techfest World MUN or TWMUN is an international conference organized by Techfest, IIT Bombay. It is an annual simulation of United Nations committees, which invites you to debate, discuss and build a better future.' ,
                'keywords' => ' conferences, meeting, meetings, committee, committees, UN, UNESCO, UNHRC, HRC, Human, Rights, Human Rights Council, COPUOS, Outer, Space, HUNSC, UNSC, Security, Council, Security Council, CSTD, SPECPOL, Police, SOCHUM, CSW, Women, UN-Habitat, DISEC, AU, African, Union, African Union, Disarmament, WTO, World, Trade, Organization, World Trade Organization, International, International Conference, Model, United, Nations, Model United Nations, United Nations, Model UN, Agenda, Agendas, TWMUN, Techfest World MUN, World MUN, TFMUN, TFWMUN, World Model United Nations '
            ],
            'robowars' => [
                'title' => 'Robowars | Techfest 2018-19' ,
                'description' => 'International Robowars is the flagship event of Techfest where two powerful robots will smash each other to pieces in the largest Robowars arena in India' ,
                'keywords' => ' Robot, war, fight, robowar, battlebots, robot wars, transformers, terminator, wall e, battle, FMB , king of bots, clash bots, largest, arena, steel, real steel, largest robowars, largest Asia, robowars, international, international robowars, cage, royal rumble, 120lbs, 120 pounds, 60 kg, 30 lbs, 30 pounds, 15kg, entertainment, flagship event'
            ],
            'ideate' => [
                'title' => 'Ideate | Techfest 2018-19',
                'description' => 'Ideate competition of Techfest IIT Bombay is to encourage youth to come up with innovative ideas to reform and transfigure the present situation in the world.' ,
                'keywords' => 'Ideate competition of Techfest IIT Bombay is to encourage youth to come up with innovative ideas to reform and transfigure the present situation in the world.'
            ],
            'initiatives' => [
                'title' => 'Initiatives | Techfest 2018-19' ,
                'description' => 'Initiatives are doing the right thing without being told. Volunteers, organizations and leaders unite to innovate, strategize and execute measures.' ,
                'keywords' => 'Initiatives, CURED, Save the Souls, Nirbhaya, SHE, Sanitary Health, Education, Taapsee Pannu, Diabetes, Self- Defense'
            ],
            'exhibitions' => [
                'title' => 'Exhbitions | Techfest 2018-19' ,
                'description' => 'Exhibitions at Techfest, IIT Bombay are one of those remarkable avenues where you can experience modern day science & technological innovations including humanoid robots' ,
                'keywords' => 'Exhibitions, Exhi, Expo, Autoexpo, Science Exhibitions,Robot, Artificial intelligence Cognitive robotics, Humanoid, Drones, AR/VR, Zero Gravity, Gaming Tech, Nanorobotics, 3d printing robot, Electronics, Science, Pure Mechanics, Simulator, army, Navy, DRDO '
            ],
            'hospitality' => [
                'title' => 'Hospitality | Techfest 2018-19' ,
                'description' => 'The hospitality of the guests in Techfest is of paramount importance. Techfest leaves no stone unturned in fulfilling the needs of a secure accommodation away from home. We strive to make your stay comfortable and your experience, a memorable one. Hospitality management would be one of the prime focuses of Team Techfest 2018-19.' ,
                'keywords' => 'Hospitality, Accommodation, Rooms, Hostels, Hotels, Hotel, Hostel, Registration, Desk, QR Code, Kits, Face-wash, Soap, Deodorants, Welcome, Home, Security, Secure, Stay, Comfortable, Unparalleled, Enjoyments, Memories, Cherish, Cafeteria, Participants, Cuisines, Experience, Management, Line, Queue, Hospi, Acco, Food, Speed, Fast, Fastest, Faster'
            ],
            'summit' => [
                'title' => 'Summit | Techfest 2018-19' ,
                'description' => 'Techfest hosts International Summits bringing together professionals, students and startups to deliberate on new and upcoming technologies in the scientific world with notable speakers sharing their thoughts on topics like AI and IoT.' ,
                'keywords' => 'Techfest Summit, Summit, International Summit, International, AI, Gaming, professional, students, startups, youth, technology, inspirational, potential, workshops, hands-on experience, lectures, keynote, speakers, panel discussions, networking'
            ],
            'cozmo%20clench/competition' => [
                'title'=>'Cozmo Clench | Competitions',
                'description'=>'While travelling in time, Nova certainly wishes to carry entities along for conservation, sustainability or even as a souvenir. How about a technological companion of Nova which can grip the object efficiently and transport it anywhere between the past, present and future time zones.',
                'keywords'=>'cozmo clench, gripper,manual bot, ViceClutch, gripping botcompi, competitions,international competition, IRC, Robowar ,tech , robots,steel, making technology, electronics, technorion,Techfest competitions'
            ],
            'codecode/competition' => [
                'title'=>'CoDecode | Competitions',
                'description'=>'The mysterious signs and illustrations of the past eras have left Nova curious. Even the language used for the interaction of robots in the future is difficult to comprehend. He strongly feels that understanding these and successfully solving the underlying problems can prove to be beneficial for mankind. Help Nova in tackling these issues through the present coding techniques and build a better civilisation',
                'keywords'=>'coding, programing, hacking,competitions,international competition, IRC, Robowar ,tech , robots,steel, making technology, electronics, technorion,Techfest competitions'
            ]

        ];
        $participant = null;
        $competition = Event::where('category','Competition')->get()->toArray();
        $ideate = Event::where('category','Ideate')->orderBy('order_by','DESC')->orderBy('id')->get()->toArray();
        array_shift($ideate);
        array_pop($ideate);
        $metaData = isset($meta[$urlName])?$meta[$urlName]:$meta[''];
        if(strpos($urlName,'competition')!==false){
            $event = Event::where(['url'=>urldecode('/'.$urlMain)])->first();
            if($event!==null){
                $description = json_decode($event->description);
                $metaData = ['title'=>$event->name.' | Competitions','description'=>$description->short_description];
            }
        }
        if(session()->has('participant') && session()->get('participant')->phone) {
            $participant = Participant::whereId(session()->get('participant')->id)->first();
            return view('Get')->with(['participant'=>$participant,'competition'=>$competition,'ideate'=>$ideate,'meta'=>$metaData]);
        }
        else if(session()->has('participant'))
            return redirect()->route('registerUrlGet');
        else return view('Get')->with(['participant'=>$participant,'competition'=>$competition,'ideate'=>$ideate,'meta'=>$metaData]);
    }
    public function alphaGet(){
        $urlName = strtolower(str_replace('https://techfest.org/','',url()->current()));
        $participant = null;
        $competition = Event::where('category','Competition')->get()->toArray();
        $ideate = Event::where('category','Ideate')->orderBy('order_by','DESC')->orderBy('id')->get()->toArray();
        if(session()->has('participant') && session()->get('participant')->phone) {
            $participant = Participant::whereId(session()->get('participant')->id)->first();
            return view('Get')->with(['participant'=>$participant,'competition'=>$competition,'ideate'=>$ideate,'meta'=>$metaData]);
        }
        else if(session()->has('participant'))
            return redirect()->route('registerUrlGet');
        else return view('alpha')->with(['participant'=>$participant,'competition'=>$competition,'ideate'=>$ideate,'meta'=>$metaData]);
    }
    public function registerUrlGet(Request $request){
        if(!session()->has('participant')) abort(404);
        $participant = Participant::where(['email'=>session()->get('participant')->email])->first();
        return view('registerGet')->with(['url'=>$request->url,'participant'=>$participant,'method'=>$request->methon]);
    }
    public function registerUrlPost(Request $request){
        $recaptcha = $this->recaptchaValidate($request['g-recaptcha-response']);
        if(!$recaptcha->success) session()->flash('recaptcha',$recaptcha->success);
        $request->validate([
            'gender'=>'in:male,female,others|required',
            'dob'=>'required|date|before: 2012-12-12|after: 1970-01-01',
            'pin'=>'digits:6|required',
            'phone'=>'confirmed|required',
            'address'=>'max:250|required',
            'college'=>'required'
        ],[
            'gender'=>'Gender is a required field',
            'dob.date'=>'Invalid date of birth format',
            'dob.required'=>'Date of birth is a required field',
            'phone.confirm'=>'Incorrect or missing mobile number confirmation',
            'phone.required'=>'Mobile number is a required field',
            'pin.digits'=>'Pincode should be of six digits',
            'college'=>'Collge is a required field'
        ]);
        if(!$recaptcha->success) return redirect()->back();
        $participant = Participant::where('email',session()->get('participant')->email)->first();
        $participant->phone = $request->phone;
        $participant->pin = $request->pin;
        $participant->gender = $request->gender;
        $participant->dob = $request->dob;
        $participant->address = $request->address;
        $participant->save();
        Mail::send('admin.mail.userRegistered',['participant'=>$participant],function($message) use ($request,$participant){
            $message->from('register@techfest.org','Techfest-NoReply');
            $message->to($participant->email);
            $message->subject("User registration successful");
        });
        session(['participant'=>$participant]);
        if(isset($request->event)) return redirect('/'); //todo update this page to use event do task that is required to be done
        if(isset($request->url) && $request->url) return redirect($request->url);
        else return redirect('/');
    }
    public function loginPost(Request $request){
        return $request;
        if(!isset($request->code)) return 'error';
        $client = $this->google_auth($request);

        if ($client) {
            $oauth2 = new Google_Service_Oauth2($client);
            $userInfo = $oauth2->userinfo->get();
            session(['googleData'=>$userInfo]);
            $participant = Participant::where('email',$userInfo->email)->first();
            if(!$participant){
                $participant = new Participant();
                $participant->email = $userInfo->email;
                if(isset($userInfo->name)) $participant->name = $userInfo->name;
                $participant->save();
                session(['participant'=>$participant]);
                return "new";
            }   //If user does not exist, save him and ask for his profile update
            else if(!($participant->phone && $participant->dob && $participant->address && $participant->gender)){
                session(['participant'=>$participant]);
                return "empty";
            }
            session(['participant'=>$participant]);
            return 'exist';
        }
        return 'error';
    }
    public function apiCheckLogin(){
        return response()->json(session()->has('participant'));
    }
    public function apiRegisterEventPost(Request $request){
        $request->validate([
            'country'=>'required',
            'gender'=>'required|in:male,female,others',
            'dob'=>'required|date|after: -40 years|before: -10 years',
            'college'=>'required',
            'phone'=>'required|confirmed',
            'pin'=>'required|digits:6',
            'address'=>'required'
        ],[
            'gender'=>'Gender is a required field',
            'country'=>'Country is a required field',
            'dob.date'=>'Invalid date of birth format',
            'dob.before'=>'You must be atleast 8 years old to register',
            'dob.after'=>'You have entered an invalid date',
            'dob.required'=>'Date of birth is a required field',
            'pin.digits'=>'ZIP Code should be of six digits'
        ]);
        $participant = Participant::where('email',session()->get('participant')->email)->first();
        $participant->phone = $request->phone;
        $participant->pin = $request->pin;
        $participant->gender = $request->gender;
        $participant->dob = $request->dob;
        $participant->address = $request->address;
        $participant->college = $request->college;
        $participant->country = $request->country;
        $participant->save();
        Mail::send('admin.mail.userRegistered',['participant'=>$participant],function($message) use ($request,$participant){
            $message->from('register@techfest.org','Techfest-NoReply');
            $message->to($participant->email);
            $message->subject("User registration successful");
        });

        session(['participant'=>Participant::where('email',$request->email)->first()]);
        return "success";
    }
    public function apiGetParticipant(){
        if(!session()->has('participant')) return "Not Logged In";
        return Participant::where(['email'=>session()->get('participant')->email])->first()->toArray();
    }
    public function apiGetDetailsPost(){
        if(!session()->has('participant')) return "Not Logged In";
        else if(!session()->get('participant')->phone) return "Empty";
        else {
            $participant = Participant::where(['email'=>session()->get('participant')->email])->first();
            $event = $participant->events()->get();
            $certi = $participant->certificates()->count();
            foreach($event as $e){
                $e->team = $participant->team($e)->first();
                $k = DB::table('event_participant')->where(['event_id'=>$e->id,'is_leader'=>1,'team_id'=>$e->team->id])->first()->zonal;
                if($k==='Balnglore') $k="Bengaluru";
                $e->region = $k;
                $e->cards = $e->tickets()->get();
            }
            $googleImg = session()->get('googleData')->picture;
            return ['participant'=>$participant,'events'=>$event,'img'=>$googleImg,'certi'=>$certi,'admin'=>session()->has('admin')];
        }
    }
    public function apiGetStatusPost(){
        if(session()->has('participant') && session()->get('participant')) {
            if(session()->get('participant')->phone) return "Exists";
            else return "New";
        }
        else return "Not Logged In";
    }
    public function apiGetAndroidStatusPost(){
        if(session()->has('participant') && session()->get('participant')) {
            if(session()->get('participant')->phone) return "Exists";
            else return "New";
        }
        else return "Not Logged In";
    }
    public function apiGetMembersPost(){
        $teams = (new Participant())->current()->teams()->get();

    }
    public function registerEventGet($test=null,$id=null){
        if($test===null||$id===null){
            if(session()->has('participant') && session()->get('participant')->phone)
                return redirect()->route('Get');
            else return view('registerEventGet');
        }
        $k = DB::table('event_participant')->where(['team_id'=>$id,'is_leader'=>1])->first();
        if(!$k) abort(500);
        $participant = Participant::whereId($k->participant_id)->first();
        if($k===null) return abort(403,'Sorry, the url does not point to any registered event. Please verify the link again with the leader');
        $event = Event::whereId($k->event_id)->first();
        if(md5(Participant::whereId($k->participant_id)->first()->email)===$test){
            $count = Event::whereId($k->event_id)->first()->participants;
            if(DB::table('event_participant')->where(['team_id'=>$id])->count()>=$count) return abort(442,'Sorry maximum number of reg reached for this team. Make a new team, or register saperately.');
            else{
                if(session()->has('participant') && session()->get('participant')->phone){
                    $participant = Participant::where('email',session()->get('participant')->email)->first();
                    if(DB::table('event_participant')->where(['team_id'=>$k->team_id])->count()>=$event->participants) return abort(403,"Max number of members in team reached. Make a new team");
                    else if(DB::table('event_participant')->where(['participant_id'=>$participant->id,'event_id'=>$event->id])->count()>0) abort(403,'Sorry, you can not register with more than one team. Leave your previous team and retry again');
                    else {
                        $teamId = DB::table('event_participant')->insertGetId(['event_id'=>$event->id,'participant_id'=>Participant::where('email',session()->get('participant')->email)->first()->id,'team_id'=>$k->team_id,'is_leader'=>0]);
                        $teamId = $k->team_id;
                        Mail::send('admin.mail.eventRegistered',['participant'=>$participant,'teamId'=>$teamId,'event'=>$event,'event_participant'=>$k],function($message) use ($participant){
                            $message->from('register@techfest.org','Techfest-NoReply');
                            $message->to($participant->email);
                            $message->subject("You are now registered");
                        });

                        return redirect($event->url);
                    }
                }
                else return view('registerEventGet')->with(['participant'=>$participant,'event'=>$event]);
            }
        }
        else return abort(403,'Sorry, the link is not correct, please ask your team leader to resend you the link');
        return abort(403,'Sorry, the link is not correct, please ask your team leader to resend you the link');
    }
    public function registerEventPost(Request $request){
        $request->validate([
            'country'=>'required',
            'gender'=>'required|in:male,female,others',
            'dob'=>'required|date|after: -40 years|before: -10 years',
            'college'=>'required',
            'phone'=>'required|confirmed',
            'pin'=>'required|digits:6',
            'address'=>'required'
        ],[
            'gender'=>'Gender is a required field',
            'country'=>'Country is a required field',
            'dob.date'=>'Invalid date of birth format',
            'dob.before'=>'You must be atleast 8 years old to register',
            'dob.after'=>'You have entered an invalid date',
            'dob.required'=>'Date of birth is a required field',
            'pin.digits'=>'ZIP Code should be of six digits'
        ]);
        $participant = Participant::where('email',session()->get('participant')->email)->first();
        $participant->phone = $request->phone;
        $participant->pin = $request->pin;
        $participant->gender = $request->gender;
        $participant->dob = $request->dob;
        $participant->address = $request->address;
        $participant->college = $request->college;
        $participant->country = $request->country;
        $participant->save();

        Mail::send('admin.mail.userRegistered',['participant'=>$participant],function($message) use ($request,$participant){
            $message->from('register@techfest.org','Techfest-NoReply');
            $message->to($participant->email);
            $message->subject("User registration successful");
        });

        session(['participant'=>Participant::where('email',$request->email)]);
    }
    public function registerPersonPost($test,$id){
        $k= DB::table('event_participant')->where(['team_id'=>$id,'is_leader'=>1])->first();
        if(md5(Participant::whereId($k->participant_id)->first()->email)===$test){
            $count = Event::whereId($k->event_id)->first()->participants;
            if(DB::table('event_participant')->where(['team_id'=>$id])->count()>=$count) return abort(442,'Sorry maximum number of reg reached for this team. Make a new team or register ssaperately.');
            else{
                $teamId= DB::table('event_participant')->insertGetId(['event_id'=>$k->event_id,'participant_id'=>Participant::where('email',session()->get('participant')->email)->first()->id,'is_leader'=>0,'team_id'=>$k->team_id]);
                $teamId = $k->team_id;
                $participant = Participant::where('email',session()->get('participant')->email)->first();
                $event = Event::whereId($k->event_id)->first();
                Mail::send('admin.mail.eventRegistered',['participant'=>$participant,'teamId'=>$teamId,'event'=>$event,'event_participant'=>$k],function($message) use ($participant){
                    $message->from('register@techfest.org','Techfest-NoReply');
                    $message->to($participant->email);
                    $message->subject("You are now registered");
                });
                return redirect()->route('Get');
            }
        }
        return abort(404);
    }
    public function apiJoinTeamPost(Request $r){
        $r->validate([
            'team'=>array(
                'required',
                'regex:/[A-Za-z]{2}-[0-9]{6}/'
            ),
            'email'=>'required|email'
        ],[
            'team.required'=>'Team Id is missing',
            'email.required'=>'No email is given',
            'email.email'=>'Email is not correct'
        ]);
        $p = session()->get('participant');
        $e = Event::where('name',$r->event)->first();
//        if($e->zonal===1) return "Sorry, registrations are closed now";
        $l = Participant::where('email',$r->email)->first();
        if(!$l) return "There is no person registered with that email";
        if(DB::table('event_participant')->where(['participant_id'=>$p->id,'event_id'=>$e->id])->count()>0) return "You are already registered in a team, delete that team to join a new team";
        else{
            $team = (int)substr($r->team,3,6);
            $k = DB::table('event_participant')->where(['team_id'=>$team,'participant_id'=>$l->id,'event_id'=>$e->id])->count();
            if($k>=$e->participants) return "Maximum number of teams has been reached";
            if($k===0) return "No such team exists";
            else {
                DB::table('event_participant')->insert(['event_id'=>$e->id,'team_id'=>$team,'participant_id'=>$p->id,'is_leader'=>0]);
                return "success";
            }
        }
        //if he is not, check if the team has total number of members
        //if total number of members in a team is more, then don't register
        //else register and add him to the team
    }
    public function error404(){
        return abort(404);
    }
    public function error404Custom($name,$score){
        return view('errors.404')->with(['name'=>base64_decode($name),'score'=>base64_decode($score)]);
    }
    public function error404Test(){
        return view('404');
    }
    public function successfullyRegistered(){
        return view('events.successfullyRegistered');
    }
    public function googleResponseGet(Request $r){
        DB::table('google_response')->insert(['response'=>json_encode($r->all())]);
        if(Participant::where('email',$r->email)->count()===0){
            $id = Participant::insert([
                'name' => $r->name,
                'dob' => Carbon::parse($r->age),
                'gender'=>$r->gender,
                'country'=>$r->country,
                'college' => $r->college,
                'email' => $r->email,
                'phone' => $r->phone,
                'address' => $r->address,
                'pin'=>$r->pin
            ]);
            $participant = Participant::where('email',$r->email)->first();
            if($participant){
                $request = $r;
                Mail::send('admin.mail.userRegistered',['participant'=>$participant],function($message) use ($request,$participant){
                    $message->from('register@techfest.org','Techfest-NoReply');
                    $message->to($participant->email);
                    $message->subject("User registration successful");
                });
            }
        }
        $participant = Participant::where('email',$r->email)->first();
        $e= Event::where('code','MD')->first();
        if(DB::table('event_participant')->where(['event_id'=>$e->id,'participant_id'=>$participant->id])->count()!==0) return ['response'=>'already registered'];
        $teamId = DB::table('teams')->insertGetId(['leader_id'=>$participant->id]);
        $jj = DB::table('event_participant')->insertGetId(['event_id'=>$e->id,'participant_id'=>$participant->id,'is_leader'=>1,'team_id'=>$teamId]);
        $k = DB::table('event_participant')->whereId($jj)->first();
        Mail::send('admin.mail.eventRegistered',['participant'=>$participant,'teamId'=>$teamId,'event'=>$e,'event_participant'=>$k],function($message) use ($participant){
            $message->from('register@techfest.org','Techfest-NoReply');
            $message->to($participant->email);
            $message->subject("You are now registered");
        });
        return ['response'=>"Success"];
    }
    public function lectureResponse2(Request $r){
        DB::table('google_response')->insert(['response'=>json_encode($r->all())]);
        if(Participant::where('email',$r->email)->count()===0){
            $id = Participant::insertGetId([
                'name' => str_replace("'",'',$r->name),
                'email' => str_replace("'",'',$r->email),
            ]);
            $participant = Participant::where('email',$r->email)->first();
            if($participant){
                $request = $r;
                Mail::send('admin.mail.lectures',['participant'=>$participant],function($message) use ($request,$participant){
                    $message->from('hhdl@techfest.org','Techfest-NoReply');
                    $message->to($participant->email);
                    $message->subject("Verification mail | Techfest IIT Bombay");
                });
            }
        }
        $participant = Participant::where('email',$r->email)->first();
        $e= Event::where('code','LV')->first();
//        if(DB::table('event_participant')->where(['event_id'=>$e->id,'participant_id'=>$participant->id])->count()!==0) return ['response'=>'already registered'];
        $teamId = DB::table('teams')->insertGetId(['leader_id'=>$participant->id]);
        $jj = DB::table('event_participant')->insertGetId(['event_id'=>$e->id,'participant_id'=>$participant->id,'is_leader'=>1,'team_id'=>$teamId]);
        $k = DB::table('event_participant')->whereId($jj)->first();
        Mail::send('admin.lectures2',['participant'=>$participant,'teamId'=>$teamId,'event'=>$e,'event_participant'=>$k],function($message) use ($participant){
            $message->from('register@techfest.org','Techfest-NoReply');
            $message->to($participant->email);
            $message->subject("You are now registered");
        });
        return ['response'=>"Success"];
    }

    public function lectureResponse(Request $r){
        DB::table('google_response')->insert(['response'=>json_encode($r->all())]);
        if(Participant::where('email',$r->email)->count()===0){
            $id = Participant::insertGetId([
                'name' => str_replace("'",'',$r->name),
                'email' => str_replace("'",'',$r->email),
            ]);
            $participant = Participant::where('email',$r->email)->first();
            if($participant){
                $request = $r;
                Mail::send('admin.mail.lectures',['participant'=>$participant],function($message) use ($request,$participant){
                    $message->from('hhdl@techfest.org','Techfest-NoReply');
                    $message->to($participant->email);
                    $message->subject("Verification mail | Techfest IIT Bombay");
                });
            }
        }
        $participant = Participant::where('email',$r->email)->first();
        $e= Event::where('code','LC')->first();
//        if(DB::table('event_participant')->where(['event_id'=>$e->id,'participant_id'=>$participant->id])->count()!==0) return ['response'=>'already registered'];
        $teamId = DB::table('teams')->insertGetId(['leader_id'=>$participant->id]);
        $jj = DB::table('event_participant')->insertGetId(['event_id'=>$e->id,'participant_id'=>$participant->id,'is_leader'=>1,'team_id'=>$teamId]);
        $k = DB::table('event_participant')->whereId($jj)->first();
        Mail::send('admin.lectures',['participant'=>$participant,'teamId'=>$teamId,'event'=>$e,'event_participant'=>$k],function($message) use ($participant){
            $message->from('register@techfest.org','Techfest-NoReply');
            $message->to($participant->email);
            $message->subject("You are now registered");
        });
        return ['response'=>"Success"];
    }

    public function sessionFlushGet(){
        session()->forget(['participant','googleData','google_token']);
        return session()->all();
    }
    public function authUser(Request $request){
        return $request->user();
    }
    public function accoDekho(){
        return Participant::whereNotNull('shirt')->count();
    }
}
