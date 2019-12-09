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
use Illuminate\Http\Response;



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
            $data = DB::table('tf_certificate')->where(['id'=>$id])->first();
            return $this->generate_certificate($data);
        }
        else return abort(404,'Certificate Not Found');
    }

    public function generate_certificate($data){
        $certificate = DB::table('certificates')->where(['id'=>$data->certificate_id])->first();
        $image = Image::make(public_path('2018/Certificate/2019/participation.png'))->resize(3500,2475);
        $qr_content = QR::size(1000)->format('png')->generate("This is certified by Techfest IIT Bombay 2019-20 to Mr./Mrs.$data->name for $certificate->name.");
        $qr = Image::make("$qr_content")->resize(250,250);
        $image->insert($qr,"bottom-right",150,150);
        $image->text(ucwords(strtolower($data->name)),1500,1300, function($font) {
            $font->file(public_path('/fonts/Play/play.ttf'));
            $font->size(90);
            $font->color('#000000');
        });
        return $image->response('png');
    }
}