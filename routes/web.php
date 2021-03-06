<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\entertainmentController;
use App\Http\Controllers\ChatController;

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
//for admin/type
// Route::get('/', function () {
//     return view('welcome');
// });




//for inertia//
Route::get('/user/index',[inertiacontroller::class,'index'])->name('user.index');

// for Anime
Route::view('/animeframe','laravel+vue/uiux');
Route::view('/','laravel+vue/uiux');
Route::view('/animeframe/myprojects','laravel+vue/uiux');
Route::view('/animeframe/team','laravel+vue/uiux');
Route::match(['get','post'],'/animeframe/createdata',[entertainmentController::class,'createdata']);
Route::get('/getdata',[entertainmentController::class,'getdata']); 
Route::delete('/deleteitem/{id}',[entertainmentController::class,'deleteitem']);
Route::view('/animeframe/register','laravel+vue/uiux');
Route::match(['get','post'],'/animeframe/register/add',[entertainmentController::class,'teamregister']);
Route::view('/animeframe/login','laravel+vue/uiux');
Route::match(['get','post'],'/animeframe/login/accept',[entertainmentController::class,'login']);
Route::put('/animeframe/editdata/{id}',[entertainmentController::class,'edit']);
Route::get('/animeframe/teamlist',[entertainmentController::class,'getTeam']);
Route::get('/animeframe/getproject/{id}',[entertainmentController::class,'getproject']);
Route::view('/animeframe/myprojects/viewseason/{id}','laravel+vue/uiux');
Route::get('/animeframe/getdata/{id}',[entertainmentController::class,'getanimedata']);
Route::match(['get','post'],'/animeframe/addseason/{id}',[entertainmentController::class,'addseason']);
Route::get('/animeframe/getseason/{id}',[entertainmentController::class,'getseason']);
Route::view('/animeframe/myprojects/viewseason/{mid}/viewepisode/{sid}','laravel+vue/uiux');
Route::get('/animeframe/geteachseason/{id}',[entertainmentController::class,'geteachseason']);
Route::match(['get','post'],'/animeframe/addepisode',[entertainmentController::class,'addepisode']);
Route::get('/animeframe/getepisode/{id}',[entertainmentController::class,'getepisode']);
Route::match(['get','post'],'/animeframe/addtype',[entertainmentController::class,'addtype']);
Route::get('/animeframe/getType',[entertainmentController::class,'getType']);
Route::view('/aframe/admin/watch/{id}','laravel+vue/uiux');

//for aseriesworld
Route::view('/aframe','laravel+vue/aseriesworld');
Route::view('/aframe/home','laravel+vue/aseriesworld');
Route::get('/aframe/getdata',[entertainmentController::class,'getaframedata']);
Route::view('/aframe/info/{id}','laravel+vue/aseriesworld');
Route::get('/aframe/info/geteachinfo/{id}',[entertainmentController::class,'geteachinfo']);
Route::get('/aframe/info/getseasoninfo/{id}',[entertainmentController::class,'getseasoninfo']);
Route::get('/aframe/info/getseasonbyid/{id}',[entertainmentController::class,'calldata']);
Route::get('/aframe/getType',[entertainmentController::class,'getaframeType']);
Route::get('/aframe/getdatabytype/{name}',[entertainmentController::class,'getdatabytype']);
Route::get('/aframe/getsearchdata',[entertainmentController::class,'getsearchdata']);
Route::view('/aframe/register','laravel+vue/aseriesworld');
Route::match(['get','post'],'/aframe/register/adduser',[entertainmentController::class,'adduser']);
Route::view('/aframe/login','laravel+vue/aseriesworld');
Route::match(['get','post'],'/aframe/login/matchuser',[entertainmentController::class,'aframelogin']);
Route::view('/aframe/home/{type}/{id}','laravel+vue/aseriesworld');
Route::get('/aframe/getTypedata/{type}',[entertainmentController::class,'getTypedata']);
Route::view('/aframe/typeinfo/{type}/{id}','laravel+vue/aseriesworld');
Route::view('/aframe/contact','laravel+vue/aseriesworld');
Route::match(['get','post'],'/aframe/contact/addfeedback',[entertainmentController::class,'addfeedback']);
Route::delete('/aframe/episode/delete/{id}',[entertainmentController::class,'delep']);
Route::put('/aframe/episode/update/{id}',[entertainmentController::class,'epupdate']);
Route::match(['get','post'],'/aframe/send',[entertainmentController::class,'chatting']);
Route::get('/check/{id}',function($id){
    return session("chat$id");
});
Route::get('/getOldMessage/{id}',[entertainmentController::class,'getOldMessage']);
Route::delete('/delsession/{id}',[entertainmentController::class,'delsession']);
Route::match(['get','post'],'/saveToSession/{id}',[entertainmentController::class,'saveToSession']);
Route::view('/aframe/about','laravel+vue/aseriesworld');
Route::view('/aframe/portfolio','laravel+vue/aseriesworld');
Route::get('/aframe/getediticon/{id}',[entertainmentController::class,'getediticon']);
Route::put('/aframe/updateicon/{id}',[entertainmentController::class,'updateicon']);
Route::get('/aframe/admin/getediticon/{id}',[entertainmentController::class,'getadminicon']);
Route::put('/aframe/admin/updateicon/{id}',[entertainmentController::class,'updateadminicon']);

//for chat
Route::view('/animeframe/chatpage','laravel+vue/chat');
Route::match(['get','post'],'/animeframe/chatpage/send',[ChatController::class,'chatting']);
Route::match(['get','post'],'/animeframe/teamlist/addprivate',[ChatController::class,'addprivate']);
Route::view('/animeframe/privatechat','laravel+vue/uiux');
Route::match(['get','post'],'/animeframe/addroom',[ChatController::class,'addroom']);
Route::get('/animeframe/getroom/{id}',[ChatController::class,'getroom']);
Route::get('/animeframe/getroombyid/{id}',[ChatController::class,'getroombyid']);
Route::get('/animeframe/teamchat/{id}',[ChatController::class,'getTeam']);
Route::match(['get','post'],'/animeframe/senduser',[ChatController::class,'senduser']);
Route::get('/animeframe/getroomuser/{id}',[ChatController::class,'getroomuser']);
Route::view('/animeframe/admin/chatting','laravel+vue/uiux');