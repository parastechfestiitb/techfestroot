<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use kanalumaddela\LaravelSteamLogin\Http\Controllers\SteamLoginHandlerController;
use kanalumaddela\LaravelSteamLogin\SteamUser;

class SteamLoginController extends SteamLoginHandlerController
{
    public function authenticated(Request $request, SteamUser $steamUser)
    {
        // find user by steam account id
        $user = User::where('steam_account_id', $steamUser->accountId);

        // if the user doesn't exist, create them
        if (!$user) {
            $user = User::create([
                'name' => $steamUser->name,
                'steam_account_id' => $steamUser->accountId,
            ]);
        }

        Auth::login($user);
    }
}