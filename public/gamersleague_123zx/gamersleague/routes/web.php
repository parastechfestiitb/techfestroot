<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;

Route::get('/logout',function(){
    session()->flush();
    return redirect()->route('index');
});
Route::get('/', 'MainController@Get')->name('index');
Route::redirect('/gamersleague','https://techfest.org/gamersleague');

Route::get('/csgo','MainController@csgoGet')->name('csgo');
Route::post('/csgo','MainController@registerCSGO')->name('registerCSGO');
Route::get('/joincsgo/{id}/{code}','MainController@joinMyTeamCsgo')->name('joinmyteam');
Route::get('/removecsgo/{id}','MainController@removePersonCsgo');


Route::get('/pubg','MainController@pubgGet')->name('pubg');
Route::post('/pubg','MainController@registerPUBG')->name('registerPUBG');

Route::get('/dota','MainController@dotaGet')->name('dota');
Route::post('/dota','MainController@registerDOTA')->name('registerDOTA');
Route::get('/joindota/{id}/{code}','MainController@joinMyTeamDota')->name('joinmyteam');
Route::get('/removedota/{id}','MainController@removePersonDota');

Route::get('/register','MainController@registerGet')->name('register');
Route::post('/register','MainController@registerPost')->name('register');
Route::get('redirect', 'MainController@redirector')->name('redirector');

Route::redirect('/home', '/')->name('home');
Route::get('/admin','MainController@makeAdmin')->name('admin');
Route::get('auth/steam', 'AuthController@redirectToSteam')->name('auth.steam');
Route::get('steam/auth', 'AuthController@redirectToSteam')->name('auth.steam');
Route::get('auth/steam/handle', 'AuthController@handle')->name('auth.steam.handle');
