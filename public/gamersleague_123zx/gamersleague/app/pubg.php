<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pubg extends Model
{
    protected $fillable = ['name','image','details'];
    public function players()
    {
        return $this->hasMany('App\Player');
    }
    public function detach(array $a=null){
        if($a===null)  $a = $this->players()->get();
        foreach($a as $p){
            $p->update(['pubg_id'=>null]);
        }
        return $this->get();
    }
}
