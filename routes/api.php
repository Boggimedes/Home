<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('home/command', 'HomeController@command');
Route::post('home/play/{data}', 'HomeController@play');
Route::post('home/resume/{data}', 'HomeController@resume');
Route::post('home/restart/{data}', 'HomeController@restart');
Route::post('home/pause', 'HomeController@pause');
Route::post('home/stop', 'HomeController@stop');
Route::post('home/stopAll', 'HomeController@stopAll');
Route::post('home/movieTime', 'HomeController@movieTime');
Route::post('home/projOff', 'HomeController@projOff');
Route::post('home/camille', 'HomeController@camille');
Route::post('home/ir', 'HomeController@ir');

Route::resource('user', 'UserController');
Route::resource('drink', 'DrinkController');
