<?php

namespace App\Http\Controllers;

use App\Certificate;
use App\Event;
use App\Teams;
use App\User;
use Carbon\Carbon;
//use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;
use DB;
use App\Participant;
use QR;
use Mail;
//use Illuminate\Http\Response;
use Illuminate\Support\Facades\Response;



class CertificateController_2019 extends Controller
{
    public function insert(Request $data){
        DB::table('tf_certificate')->insert([
            'name'=>$data->name,
            'email'=>$data->email,
            'certificate_id'=>$data->certificate_id,
            'admin'=>session()->get('user')->email,
        ]);
        return "success";
    }
    public function certificate_get($id,$key){
        $random_text = "K7lxDTZLUvAFm6noUG7O";
        if($key == md5($id.$random_text)){
            $certificate_row = DB::table('tf_certificate')->where(['id'=>$id])->first();
            if($certificate_row->name_update != "1"){
                return view('2019.Certificate.certificate_name_update')->with(['id'=>$id,'key'=>$key,'name'=>$certificate_row->name]);
            }
            $data = DB::table('tf_certificate')->where(['id'=>$id])->first();
            return $this->generate_certificate($data, $certificate_row);
        }
        else return abort(404,'Certificate Not Found');
    }

    public function generate_certificate($data, $certificate_row){
        $random_text = "K7lxDTZLUvAFm6noUG7O";
        $url = md5($certificate_row->id.$random_text);
        $certificate = DB::table('certificates')->where(['id'=>$data->certificate_id])->first();
        $image = Image::make(public_path("$certificate->image"))->resize(3500,2475);
        $qr_content = QR::size(1000)->format('png')->generate("This is certified by Techfest IIT Bombay 2019-20 to Mr./Mrs.$data->name for $certificate->name. Certificate ID - $certificate_row->id. Link -  https://techfest.org/2019/certificate/{$certificate_row->id}/{$url}");
        $qr = Image::make("$qr_content")->resize(250,250);
        $image->insert($qr,"bottom-left",1600,250);
        $image->text(ucwords(strtolower($data->name)),1500,1300, function($font) {
            $font->file(public_path('/fonts/Play/play.ttf'));
            $font->size(90);
            $font->color('#000000');
        });
        return $image->response('png');
    }
    public function nameUpdate(Request $data){
        $certificate_row = DB::table('tf_certificate')->where(['id'=>$data->id])->first();
        if($certificate_row->name_update != "1"){
            DB::table('tf_certificate')->where(['id'=>$data->id])->update([
                'name'=>$data->name,
                'name_update'=>'1'
            ]);
        }
        return redirect("https://techfest.org/2019/certificate/{$data->id}/{$data->key}");
    }
}