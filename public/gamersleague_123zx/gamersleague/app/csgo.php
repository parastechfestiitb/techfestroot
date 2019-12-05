<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class csgo extends Model
{
    protected $fillable = ['name','image','details'];
    public function players()
    {
        return $this->hasMany('App\Player');
    }
    public function detach(array $a=null){
        if($a===null)  $a = $this->players()->get();
        foreach($a as $p){
            $p->update(['csgo_id'=>null]);
        }
        return $this->get();
    }
}
