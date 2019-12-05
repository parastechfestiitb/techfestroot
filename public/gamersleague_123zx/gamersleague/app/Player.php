<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Player extends Model
{
    protected $fillable = ['email','phone','csgo_id'];
    public function who($steamId){
        return DB::table('players')->where('steamid',$steamId)->first();
    }
    public function has($steamId){
        return DB::table('players')->where('steamid',$steamId)->count()!==0;
    }
    public function csgo()
    {
        return $this->belongsTo('App\csgo');
    }
    public function pubg()
    {
        return $this->belongsTo('App\pubg');
    }
    public function dota()
    {
        return $this->belongsTo('App\dota');
    }
}
