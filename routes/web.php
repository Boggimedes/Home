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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/something', function () {
    return view('welcome');
});
Route::post('home/command', 'HomeController@command');

// Route::get('/coffee-tracker', function () {
//     return view('coffee-tracker');
// });
// Route::get('/coffee-tracker/{a?}/{b?}/{c?}', function () {
//     return view('coffee-tracker');
// });
