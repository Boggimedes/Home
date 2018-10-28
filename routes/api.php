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

Route::post('family/command', 'FamilyController@command');
Route::post('family/play/{data}', 'FamilyController@play');
Route::post('family/resume/{data}', 'FamilyController@resume');
Route::post('family/restart/{data}', 'FamilyController@restart');
Route::post('family/netflixMovie/{data}', 'FamilyController@netflixMovie');
Route::post('family/pause', 'FamilyController@pause');
Route::post('family/stop', 'FamilyController@stop');
Route::post('family/stopAll', 'FamilyController@stopAll');
Route::post('family/movieTime', 'FamilyController@movieTime');
Route::post('family/projOff', 'FamilyController@projOff');
Route::post('family/camille', 'FamilyController@camille');
Route::post('family/ir', 'FamilyController@ir');
Route::resource('user', 'UserController');
Route::resource('drink', 'DrinkController');
Route::resource('family', 'FamilyController');
