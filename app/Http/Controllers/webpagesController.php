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

class webpagesController extends Controller
{
    //
    public function robowars_form(){
        return view('2019.robowars.robowars_form');
    }

    public function robowars_form_reg(Request $data){
        DB::table('robowars')->insert([
            'category'=>$data->category,
            'team_name'=>$data->team_name,
            'country'=>$data->country,
            'college'=>$data->college,
            'pincode'=>$data->pincode,
            'name_0'=>$data->name_0,
            'email_0'=>$data->email_0,
            'number_0'=>$data->number_0,
            'name_1'=>$data->name_1,
            'email_1'=>$data->email_1,
            'number_1'=>$data->number_1,
            'name_2'=>$data->name_2,
            'email_2'=>$data->email_2,
            'number_2'=>$data->number_2,
            'name_3'=>$data->name_3,
            'email_3'=>$data->email_3,
            'number_3'=>$data->number_3,
            'name_4'=>$data->name_4,
            'email_4'=>$data->email_4,
            'number_4'=>$data->number_4,
            'name_5'=>$data->name_5,
            'email_5'=>$data->email_5,
            'number_5'=>$data->number_5,
        ]);
//        $team_row = DB::table('robowars')->
        $user_row = DB::table('robowars')->where(['email_0' => "$data->email_0"])->first();// return the first row containing the user(session wala user)

        $a = 190000;
        $b = $user_row->id;
//        return "$user_row->id";
        $team_id = $a + $b;
        $subject = "Techfest International Robowars Registration Successful";
        $txt = "Dear $data->name_0,

Congratulations! You have been successfully registered for Techfest International Robowars.

Please note your Team id is RW-$team_id, 
All the further communications will be done with respect to your Team ID provided above and not by your team name.

Also, the deadline for submission of both Written and Video abstract is 17th Dec and it will not be extended in any case. Hence it is suggested to submit your abstract as soon as possible to akshat@techfest.org.

Any further changes and information will be communicated via email. Hence keep checking your email at regular intervals.

For any further help contact-

Akshat Johri
+91 98928 97448";

        mail($data->email_0, $subject, $txt, "From:robowars@techfest.org" );
        return Redirect::back()->withErrors(["Thanks for registering! Check your Email (Spam too!) to know your Team ID."]);


}
    public function ift_form_reg(Request $data){
        DB::table('ift_form')->insert([
            'name_0'=>$data->name_0,
            'email_0'=>$data->email_0,
            'number_0'=>$data->number_0,
            'college_0'=>$data->college_0,
            'pincode_0'=>$data->pincode_0,
            'college_address_0'=>$data->college_address_0,

            'name_1'=>$data->name_1,
            'email_1'=>$data->email_1,
            'number_1'=>$data->number_1,
            'college_1'=>$data->college_1,
            'pincode_1'=>$data->pincode_1,
            'college_address_1'=>$data->college_address_1,

            'name_2'=>$data->name_2,
            'email_2'=>$data->email_2,
            'number_2'=>$data->number_2,
            'college_2'=>$data->college_2,
            'pincode_2'=>$data->pincode_2,
            'college_address_2'=>$data->college_address_2,

            'name_3'=>$data->name_3,
            'email_3'=>$data->email_3,
            'number_3'=>$data->number_3,
            'college_3'=>$data->college_3,
            'pincode_3'=>$data->pincode_3,
            'college_address_3'=>$data->college_address_3,

        ]);
//        $team_row = DB::table('ift_form')->
        $user_row = DB::table('ift_form')->where(['email_0' => "$data->email_0"])->first();// return the first row containing the user(session wala user)

        $a = 190000;
        $b = $user_row->id;
//        return "$user_row->id";
        $team_id = $a + $b;
        $subject = "Techfest International Full Throttle Registration Successful";
        $txt = "Dear $data->name_0,

Congratulations! You have been successfully registered for Techfest International Full Throttle.

Please note your Team id is IFT-$team_id, 
All the further communications will be done with respect to your Team ID provided above and not by your team name.

Also, the deadline for submission of both Written and Video abstract is 30th November and it will not be extended in any case. Hence it is suggested to submit your abstract as soon as possible to fullthrottle@techfest.org.

Any further changes and information will be communicated via email. Hence keep checking your email at regular intervals.

For any further help contact-

Om Jaiswal
+91 74004 00933";

        mail($data->email_0, $subject, $txt, "From:fullthrottle@techfest.org" );
        return Redirect::back()->withErrors(["Thanks for registering! Check your Email (Spam too!). Please note your Team id is IFT-$team_id"]);


    }
    public function exhibitions_form(Request $data){
        DB::table('tf_exhibitions')->insert([
            'exhibit_name'=>$data->exhibit_name,
            'institute_name'=>$data->institute_name,
            'website'=>$data->website,
            'address'=>$data->address,
            'pincode'=>$data->pincode,
            'country'=>$data->country,
            'name'=>$data->name,
            'email'=>$data->email,
            'number'=>$data->number,
            'number_of_exhibitor'=>$data->number_of_exhibitor,
            'area'=>$data->area,
            'any_special'=>$data->any_special,
            'needed_services'=>$data->needed_services,
            'message'=>$data->message,
        ]);
        return redirect('/exhibitions');

    }

    public function initiative_fin_lit_form(Request $data){
        DB::table('initiatives_financial')->insert([
            'name'=>$data->name,
            'email'=>$data->email,
            'college'=>$data->college,
            'number'=>$data->number,
        ]);
        return redirect('http://techfest.org/initiatives/financial_literacy');
    }

    public function summit_post(Request $data){
        DB::table('tf_summit')->insert([
            'summit'=>$data->summit,
            'name'=>$data->name,
            'student_professional'=>$data->student_professional,
            'number'=>$data->number,
            'email'=>$data->email,
            'company_college'=>$data->company_college,
            'city'=>$data->city,
            'pincode'=>$data->pincode
        ]);
        if($data->summit === "Industry" and $data->student_professional === "Student"){
            $payment_link = "https://www.thecollegefever.com/events/techfest-summit-industry-40-student";
            return view('2019.summit.redirect')->with(['payment_link' =>$payment_link]);
        }
        if($data->summit == "Industry" and $data->student_professional == "Professional" ){
            $payment_link = "https://www.thecollegefever.com/events/techfest-summit-industry-40-professional";
            return view('2019.summit.redirect')->with(['payment_link' =>$payment_link]);
        }
        if($data->summit == "Media" and $data->student_professional == "Professional" ){
            $payment_link = "https://www.thecollegefever.com/events/techfest-mediasummit-professional";
            return view('2019.summit.redirect')->with(['payment_link' =>$payment_link]);
        }
        if($data->summit == "Media" and $data->student_professional == "Student" ){
            $payment_link = "https://www.thecollegefever.com/events/techfest-mediasummit-student";
            return view('2019.summit.redirect')->with(['payment_link' =>$payment_link]);
        }
    }

    public function technoholix(){
        return view('2019.technoholix.technoholix');
    }
    public function technoholix_reg(Request $data){
        DB::table('tf_techx')->insert([
            'name'=>$data->name,
            'email'=>$data->email,
            'college_institute'=>$data->college_institute,
            'city'=>$data->city,
            'age'=>$data->age,
            'created_at'=>Carbon::now()->addHours(5)->addMinutes(30)
        ]);
        $subject = "Techfest Gymkhana Night | 5th January,2020- IIT Bombay Gymkhana Grounds | Asia's Largest Science and Technology Festival";
        $txt = "Dear $data->name,

Thank you for registering for Technoholix Gymkhana Night!

The utopia of technology, entertainment and glamour, Techfest is back with  Technoholix Gymkhana Night. Mark you calendars, set your reminders for the greatest night you'll ever witness! With our headliner Afishal ready to set the stage on fire, we have more surprises   to get you on the dance floor! Join 10,000 other people to conclude Techfest 2019-20 in grandest way possible.
Venue : Gymkhana Grounds, IIT Bombay Campus
Date : 5th January 
Time : Evening (exact details to be uploaded soon)

Use the unique id allotted to you to get you passes free of cost from the hospitality desk at Techfest ,IIT Bombay. The exact details and timings of pass distribution will be uploaded soon on the Technoholix website!

When Technology meets Entertainment, the only possible result is a night to remember! See you soon.

";

        mail($data->email, $subject, $txt, "From:adamya@techfest.org" );
        return Redirect::back()->withErrors(["Thanks for registering!"]);
    }
}
