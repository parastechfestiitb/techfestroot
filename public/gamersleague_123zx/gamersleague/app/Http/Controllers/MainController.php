<?php

namespace App\Http\Controllers;

use App\csgo;
use App\dota;
use App\pubg;
use App\Player;
use Validator;
use Crypt;
use DB;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function __construct()
    {$this->middleware('register')->except(['registerGet','registerPost']);}
    protected $key = 'base64:vJ4TlCCoaw76CdtIBXHa+WOudcotULYo0pi3oduZ9EY=';
    private function steamApi($l){
        if($l==null) return json_encode(["response"=>["players"=>null]]);
        $api = 'http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=7379B477C4D6DDC6F62E434A19CB8D96&steamids='.implode(',',$l);
        return file_get_contents($api);
    }

    public function Get(Request $r){
        if($r->has('openid_claimed_id')){
//            return "hello4";
            $claimedId = $r->openid_claimed_id;
            $id =  array_values(array_slice(explode('/',$claimedId), -1))[0];
            $api = 'http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=7379B477C4D6DDC6F62E434A19CB8D96&steamids='.$id;
            $l = file_get_contents($api);
            $data =  json_decode($l,true);
            $steamid = $data['response']['players'][0]['steamid'];
            if((new \App\Player)->has($steamid)){
//                            return "hello5";
                session(['player'=> (new \App\Player)->who($steamid),'current'=>$data['response']['players'][0],'steamid'=>$data['response']['players'][0]['steamid']]);
                if(session()->has('redirect')) return redirect(session()->pull('redirect'),302);
                return redirect('http://techfest.org/gamersleague/csgo');
            }
            else{
                $p = new Player();
                $p->steamid = $steamid;
                $p->name = $data['response']['players'][0]['personaname'];
                $p->csgo_id = session()->pull('newcsgosave');
                $p->save();
                session(['player'=> (new \App\Player)->who($steamid),'current'=>$data['response']['players'][0],'steamid'=>$steamid]);
                if(session()->has('redirect')) return redirect(session()->pull('redirect'));
                return redirect('http://techfest.org/gamersleague');
            }
        }
        else {
            if(session()->has('player')){
                if(session()->has('redirect')) return redirect(session()->pull('redirect'));
                return view('welcome')->with(['player'=>session()->get('player'),'current'=>session()->get('current')]);
            }
            else{
                if(session()->has('redirect')) return redirect(session()->pull('redirect'));
                return view('welcome');
            }
        }
    }
    public function registerGet(){
        if(!session()->has('player')) return redirect()->route('index');
        else if(Player::where('steamid',session()->get('steamid'))->first()->email!==null) return redirect()->route('index');
        return view('auth.register');
    }
    public function registerPost(Request $r){
        if(!session()->has('player')) return redirect()->route('index');
        $r->validate([
            'name'=>'required',
            'email'=>'required|email',
            'phone'=>'required'
        ]);
        DB::table('players')->where('steamid',session()->get('steamid'))->update(['name'=>$r->name,'email'=>$r->email,'phone'=>$r->phone]);
        return redirect()->route('csgo');
    }

    public function csgoGet(Request $r){
        if(session()->has('steamid') && Player::where('steamid',session()->get('steamid'))->first()!==null) {
            $player = Player::where('steamid',session()->get('steamid'))->first();
            $csgo = $player->csgo()->first();
            if($csgo===null)
                $team = null;
            else
                $team = json_decode($this->steamApi($csgo->players()->pluck('steamid')->toArray()))->response->players;
        }
        else {
            $player = null;
            $csgo = null;
            $team = null;
        }
        $temp = Csgo::get();
        $teams = [];
        foreach($temp as $t){
            if($t->players()->count()!==0) $teams[] = $t;
        }
        foreach($teams as $k=>$t){
            $teams[$k]->players = json_decode($this->steamApi($t->players()->pluck('steamid')->toArray()))->response->players;
        }
        return view('csgo')->with(['player'=>$player,'current'=>session()->get('current'),'key'=>$this->key,'csgo'=>$csgo,'team'=>$team,'teams'=>$teams]);
    }
    public function registerCSGO(Request $r){
//        $file = $r->file('teamimg')->store('public/csgo');
        $team = new csgo();
        $team->name = $r->team;
//        $team->image = $file;
        $team->team_link = $r->tl;
        $team->leader = session()->get('steamid');
        $team->save();
        $team->players()->save(Player::where('steamid',session()->get('steamid'))->first());
        return redirect()->route('csgo');
    }
    public function joinMyTeamCsgo($id,$code){
        $cs = csgo::where('id',$id)->first();
        if($cs===null) return abort(404,"Sorry no such team exists");
        if($cs->players()->count()>=7) return "Sorry, no more players can be added to this team";
        if(md5($cs->image.$this->key) !== $code) return abort(403,'Invalid Url');
        if($cs===null) return abort(404);
        session(['redirect'=>url()->current(),'newcsgosave'=>$cs->id]);
        if(!session()->has('player'))
            return redirect()->route('auth.steam');
        else {
            if(Player::where('steamid',session()->get('steamid'))->first()->csgo_id!==null) return "You are already in a team";
            $cs->players()->save(Player::where('steamid',session()->get('steamid'))->first());
            return redirect()->route('csgo');
        }
    }
    public function removePersonCsgo($id){
        if(
            (Player::whereSteamid(session()->get('steamid'))->first()===null) ||
            (Player::whereSteamid(session()->get('steamid'))->first()->csgo()->first()===null)
        )
            return "Sorry, you are not logged in, login before leaving the team";
        $current = Player::whereSteamid(session()->get('steamid'))->first();
        $player = Player::whereSteamid($id)->first();
        $cs = $player->csgo()->first();
        $leader = Player::whereSteamid($cs->leader)->first();
        if($leader->steamid === $current->steamid){
            if($leader->steamid === $player->steamid){
                DB::table('players')->where('csgo_id',$cs->id)->update(['csgo_id'=>null]);
                DB::table('csgos')->where('id',$cs->id)->delete();
            }
            else {
                DB::table('players')->whereId($player->id)->update(['csgo_id'=>null]);
            }
        }
        else if($player->steamid===$current->steamid){
            DB::table('players')->whereId($player->id)->update(['csgo_id'=>null]);
        }
        else
            return abort(403);
        return redirect()->route('csgo');
    }

    public function pubgGet(Request $r){
        if(session()->has('steamid') && Player::where('steamid',session()->get('steamid'))->first()!==null) {
            $player = Player::where('steamid',session()->get('steamid'))->first();
            $pubg = $player->pubg()->first();
            if($pubg===null)
                $team = null;
            else
                $team = json_decode($this->steamApi($pubg->players()->pluck('steamid')->toArray()))->response->players;
        }
        else {
            $player = null;
            $pubg = null;
            $team = null;
        }
        $temp = PUBG::get();
        $teams = [];
        foreach($temp as $t){
            if($t->players()->count()!==0) $teams[] = $t;
        }
        foreach($teams as $k=>$t){
            $teams[$k]->players = json_decode($this->steamApi($t->players()->pluck('steamid')->toArray()))->response->players;
        }
        return view('pubg')->with(['player'=>$player,'current'=>session()->get('current'),'key'=>$this->key,'pubg'=>$pubg,'team'=>$team,'teams'=>$teams]);
    }
    public function registerPUBG(Request $r){
        DB::table('pubg_form_reg')->insert([
        'team_leader_name'=>$r->team_leader_name,
        'nickname'=>$r->nickname,
        'p1_id'=>$r->p1_id,
        'team_leader_number'=>$r->team_leader_number,
        'team_leader_email'=>$r->team_leader_email,
        'crew_name'=>$r->crew_name,
        'p2_id'=>$r->p2_id,
        'p2_number'=>$r->p2_number,
        'p3_id'=>$r->p3_id,
        'p3_number'=>$r->p3_number,
        'p4_id'=>$r->p4_id,
        'p4_number'=>$r->p4_number,
        ]);
        return redirect()->route('pubg');
    }

    public function dotaGet(Request $r){
        if(session()->has('steamid') && Player::where('steamid',session()->get('steamid'))->first()!==null) {
            $player = Player::where('steamid',session()->get('steamid'))->first();
            $dota = $player->dota()->first();
            if($dota===null)
                $team = null;
            else
                $team = json_decode($this->steamApi($dota->players()->pluck('steamid')->toArray()))->response->players;
        }
        else {
            $player = null;
            $dota = null;
            $team = null;
        }
        $temp = dota::get();
        $teams = [];
        foreach($temp as $t){
            if($t->players()->count()!==0) $teams[] = $t;
        }
        foreach($teams as $k=>$t){
            $teams[$k]->players = json_decode($this->steamApi($t->players()->pluck('steamid')->toArray()))->response->players;
        }
        return view('dota')->with(['player'=>$player,'current'=>session()->get('current'),'key'=>$this->key,'dota'=>$dota,'team'=>$team,'teams'=>$teams]);
    }
    public function registerDOTA(Request $r){
        $file = $r->file('teamimg')->store('public/dota');
        $team = new dota();
        $team->name = $r->team;
        $team->image = $file;
        $team->leader = session()->get('steamid');
        $team->save();
        $team->players()->save(Player::where('steamid',session()->get('steamid'))->first());
        return redirect()->route('dota');
    }
    public function joinMyTeamDota($id,$code){
        $dt = dota::where('id',$id)->first();
        if(md5($dt->image.$this->key) !== $code) return abort(403,'Invalid Url');
        if($dt===null) return abort(404);
        session(['redirect'=>url()->current(),'newdotasave'=>$dt->id]);
        if(!session()->has('player'))
            return redirect()->route('auth.steam');
        else {
            $dt->players()->save(Player::where('steamid',session()->get('steamid'))->first());
            return redirect()->route('dota');
        }
    }
    public function removePersonDota($id){
        if(
            (Player::whereSteamid(session()->get('steamid'))->count()==0) ||
            (Player::whereSteamid(session()->get('steamid'))->first()->dota()->first()===null)
        )
            return "Sorry, you are not logged in, login before leaving the team";
        $current = Player::whereSteamid(session()->get('steamid'))->first();
        $player = Player::whereSteamid($id)->first();
        $dt = $player->dota()->first();
        $leader = Player::whereSteamid($dt->leader)->first();
        if($leader->steamid === $current->steamid){
            if($leader->steamid === $player->steamid) {
                DB::table('players')->where('dota_id',$dt->id)->update(['dota_id'=>null]);
                DB::table('dotas')->where('id',$dt->id)->delete();
            }
            else {
                DB::table('players')->whereId($player->id)->update(['dota_id'=>null]);
            }
        }
        else if($player->steamid===$current->steamid) {
            DB::table('players')->whereId($player->id)->update(['dota_id'=>null]);
        }
        else return abort(403);
        return redirect()->route('dota');
    }

    public function makeAdmin(){
        session(['admin'=>'Hello']);
        return redirect('http://techfest.org/gamersleague');
    }
    public function redirector(Request $r){
        if($r->link!==null) session(['redirect'=>$r->link]);
        return redirect()->route('auth.steam');
    }
}
