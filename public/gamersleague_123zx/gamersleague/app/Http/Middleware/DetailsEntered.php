<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;

class DetailsEntered
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(session()->has('player')) {
            $d = DB::table('players')->where('steamid', session()->get('player')->steamid)->first();
            if($d->email===null || $d->phone===null) {
                return redirect()->route('register');
            };
        }
        return $next($request);
    }
}
