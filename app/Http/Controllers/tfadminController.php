<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Event;
use App\Participant;
use Google_Client;
use Google_Service_Oauth2;
//use DB;
use Mail;
use Carbon\Carbon;
use Image;
use Illuminate\Support\Facades\DB;
use Redirect;


class tfadminController extends Controller
{
    //
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

    public function indexPost(Request $request){
        if(!isset($request->code) && !session()->has('user')) return view('2019.adminDashboard.admin_login');
        $client = $this->google_auth($request);
        if ($client) {
            $oauth2 = new Google_Service_Oauth2($client);
            $userInfo = $oauth2->userinfo->get();
            $user = DB::table('ca_reg')->where(['email'=>$userInfo->email])->first();
            session(['user'=>$user]);  //todo session started
            return redirect("/admindashboard_subscribe");
        }

        return redirect("/admindashboard_subscribe");

    }
    public function adminDashboard($competition){
        if(session()->has('user')) {
            $current_user = session()->get('user');
            $admin = DB::table('admins')->where('email', '=', $current_user->email)->first();// row ko array bana ke return ki;
            if(!empty($admin)){
                if ($admin->email == $current_user->email) {
                    $big_data = DB::table('tf_reg')->get();
                    return view('2019.adminDashboard.adminDashboard')->with(['big_data' => $big_data, 'admin'=>$current_user, 'competition'=>$competition]);
                }
            }
            else return "you are not admin";
        }
        else return redirect("/admindashboard_login");
    }
    public function adminDashboard_total(){
        if(session()->has('user')) {
            $current_user = session()->get('user');
            $admin = DB::table('admins')->where('email', '=', $current_user->email)->first();// row ko array bana ke return ki;
            if ($admin->email == $current_user->email) {
                $big_data = DB::table('tf_reg')->get();
                return view('2019.adminDashboard.adminDashboard_total')->with(['big_data' => $big_data, 'admin'=>$current_user]);
            }
            else return "you are not admin";
        }
        else return "sign in to ca portal first";
    }
    public function adminDashboard_subscribe(){
        if(session()->has('user')) {
            $current_user = session()->get('user');
            $admin = DB::table('admins')->where('email', '=', $current_user->email)->first();// row ko array bana ke return ki;
            if ($admin->email == $current_user->email) {
                $big_data = DB::table('tf_subscribe')->get();
                return view('2019.adminDashboard.adminDashboard_subscribe')->with(['big_data' => $big_data, 'admin'=>$current_user]);
            }
            else return "you are not admin";
        }
        else return "sign in to ca portal first";
    }
    public function adminDashboard_robowars(){
        if(session()->has('user')) {
            $current_user = session()->get('user');
            $admin = DB::table('admins')->where('email', '=', $current_user->email)->first();// row ko array bana ke return ki;
            if(!empty($admin)) {
                if ($admin->email == $current_user->email) {
                    $big_data = DB::table('robowars')->get();
                    return view('2019.adminDashboard.robowars_admin')->with(['big_data' => $big_data, 'admin' => $current_user]);
                }
            }
            else return "you are not admin";
        }
        else return "sign in to ca portal first";
    }
    public function adminDashboard_ift(){
        if(session()->has('user')) {
            $current_user = session()->get('user');
            $admin = DB::table('admins')->where('email', '=', $current_user->email)->first();// row ko array bana ke return ki;
            if(!empty($admin)) {
                if ($admin->email == $current_user->email) {
                    $big_data = DB::table('ift_form')->get();
                    return view('2019.adminDashboard.ift_admin')->with(['big_data' => $big_data, 'admin' => $current_user]);
                }
            }
            else return "you are not admin";
        }
        else return "sign in to ca portal first";
    }
    public function adminDashboard_hospitality(){
        if(session()->has('user')) {
            $current_user = session()->get('user');
            $admin = DB::table('admins')->where('email', '=', $current_user->email)->first();// row ko array bana ke return ki;
            if(!empty($admin)) {
                if ($admin->email == $current_user->email) {
                    $big_data = DB::table('tf_accommodation')->get()->unique('email');
                    return view('2019.adminDashboard.hospitality')->with(['big_data' => $big_data, 'admin' => $current_user]);
                }
            }
            else return "you are not admin";
        }
        else return "sign in to ca portal first";
    }
    public function adminDashboard_ic(){
        if(session()->has('user')) {
            $current_user = session()->get('user');
            $admin = DB::table('admins')->where('email', '=', $current_user->email)->first();// row ko array bana ke return ki;
            if(!empty($admin)) {
                if ($admin->email == $current_user->email) {
                    $big_data = DB::table('tf_ic')->get()->unique('email');
                    return view('2019.adminDashboard.admindashboard_ic')->with(['big_data' => $big_data, 'admin' => $current_user]);
                }
            }
            else return "you are not admin";
        }
        else return "sign in to ca portal first";
    }
    public function adminDashboard_summit(){
        if(session()->has('user')) {
            $current_user = session()->get('user');
            $admin = DB::table('admins')->where('email', '=', $current_user->email)->first();// row ko array bana ke return ki;
            if(!empty($admin)) {
                if ($admin->email == $current_user->email) {
                    $big_data = DB::table('tf_summit')->get();
                    return view('2019.adminDashboard.summit_admin')->with(['big_data' => $big_data, 'admin' => $current_user]);
                }
            }
            else return "you are not admin";
        }
        else return "sign in to ca portal first";
    }
    public function adminDashboard_exhibitions(){
        if(session()->has('user')) {
            $current_user = session()->get('user');
            $admin = DB::table('admins')->where('email', '=', $current_user->email)->first();// row ko array bana ke return ki;
            if(!empty($admin)) {
                if ($admin->email == $current_user->email) {
                    $big_data = DB::table('tf_exhibitions')->get();
                    return view('2019.adminDashboard.admin_exhibitions')->with(['big_data' => $big_data, 'admin' => $current_user]);
                }
            }
            else return "you are not admin";
        }
        else return "sign in to ca portal first";
    }
    public function adminDashboard_payment_mun(){
        if(session()->has('user')) {
            $current_user = session()->get('user');
            $admin = DB::table('admins')->where('email', '=', $current_user->email)->first();// row ko array bana ke return ki;
            if(!empty($admin)) {
                if ($admin->email == $current_user->email and $admin->access_mun == "1") {
                    $mun_payment_data = DB::table('payment_mun_19')->get()->unique('ticketId');
                    return view('2019.adminDashboard.adminDashboard_payment')->with(['mun_payment_data' => $mun_payment_data, 'admin' => $current_user]);
                }
            }
            else return "you are not admin access to this page, Contact OCs for more details";
        }
        else return "sign in to ca portal first";
    }
    public function adminDashboard_workshops($workshop){
        if(session()->has('user')) {
            $current_user = session()->get('user');
            $admin = DB::table('admins')->where('email', '=', $current_user->email)->first();// row ko array bana ke return ki;
            if(!empty($admin)) {
                if ($admin->email == $current_user->email ) {
                    $workshops_participants_data = DB::table('tf_workshops_participants_2019')->where(['workshop'=>$workshop])->get()->unique('number');
                    return view('2019.adminDashboard.adminDashboard_workshops')->with(['workshops_participants_data' => $workshops_participants_data, 'admin' => $current_user]);
                }
            }
            else return "you are not admin access to this page, Contact OCs for more details";
        }
        else return "sign in to ca portal first";
    }
    public function adminDashboard_certificate(){
        if(session()->has('user')) {
            $current_user = session()->get('user');
            $admin = DB::table('admins')->where('email', '=', $current_user->email)->first();// row ko array bana ke return ki;
            if(!empty($admin)) {
                if ($admin->email == $current_user->email ) {
                    $eligible_user_for_certi = DB::table('tf_certificate')->get();
                    return view('2019.adminDashboard.admin_certificate')->with(['eligible_user_for_certi' => $eligible_user_for_certi, 'admin' => $current_user]);
                }
            }
            else return "you are not admin access to this page, Contact OCs for more details";
        }
        else return "sign in to ca portal first";
    }
    public function adminDashboard_certificate_insert_get(){
        if(session()->has('user')) {
            $current_user = session()->get('user');
            $admin = DB::table('admins')->where('email', '=', $current_user->email)->first();// row ko array bana ke return ki;
            if(!empty($admin)) {
                if ($admin->email == $current_user->email ) {
                    $all_certificate = DB::table('certificates')->skip(82)->take(200)->get();
                    return view('2019.adminDashboard.admin_certificate_insert')->with(['admin' => $current_user,'all_certificate'=>$all_certificate]);
                }
            }
            else return "you are not admin access to this page, Contact OCs for more details";
        }
        else return "sign in to ca portal first";
    }
    public function payment_fix(Request $data){
//        DB::table('payment_log_2019')->where(['ticketId'=>$data->ticketId,])->update([
//            'email'=>$data->email,
//            'email_payment'=>$data->email_payment
//        ]);

        if(!empty($data)){
            $payment_row = DB::table('payment_log_2019')->where(['ticketId'=>$data->ticketId])->get()->first();
            return view('2019.adminDashboard.payment_fix')->with(['id'=>$payment_row->id]);
        }
        return view('2019.adminDashboard.payment_fix');
    }
//    public function payment_fix(){
//        for($i=3990;$i<8000;$i++ ){
//            $payment_row = DB::table('payment_log_2019')->where(['id'=>$i])->get()->first();
//            if(!empty($payment_row->ticketId)){
//                $payment_ticket_count = DB::table('payment_log_2019')->where(['ticketId'=>$payment_row->ticketId])->count();
//                if($payment_ticket_count>1){
//                    DB::table('payment_log_2019')->where(['id'=>$i])->delete();
////                    return "$payment_ticket_count, $payment_row->ticketId, $payment_row->id";
//                }
//            }
//        }
//        return "success";
//    }
}
