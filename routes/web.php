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
    return view('index');
});
Route::get('/login','UserController@login');
Route::get('/register','UserController@register');
Route::post('/login','UserController@loginProcess');
Route::post('/register','UserController@registerProcess');
Route::get('/verification/{user}/{code}','RegisterUserController@verification');
Route::get('/sign-out','UserController@signOut');
Route::get('/update-password','UserController@updatePassword')->middleware(['user.auth']);
Route::put('/update-password','UserController@updatePasswordProcess')->middleware(['user.auth']);
