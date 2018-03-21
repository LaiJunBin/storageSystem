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

Route::get('/', 'MainController@index');
Route::get('/login','UserController@login');
Route::get('/register','UserController@register');
Route::post('/login','UserController@loginProcess');
Route::post('/register','UserController@registerProcess')->middleware(['user.sign.up']);
Route::get('/verification/{user}/{code}','RegisterUserController@verification');
Route::get('student/verification/{user}/{code}','RegisterUserController@studentVerification');
Route::get('/sign-out','UserController@signOut');
Route::get('/update-password','UserController@updatePassword')->middleware(['user.auth']);
Route::put('/update-password','UserController@updatePasswordProcess')->middleware(['user.auth']);
Route::get('/forgetPassword','UserController@forgetPassword');
Route::post('/forgetPassword','UserController@forgetPasswordProcess');
Route::get('/forgetPassword/verification/{user}/{code}','UserController@forgetPasswordVerification');

Route::post('/addClass','ManagerController@addClassProcess')->middleware(['user.admin.auth']);
Route::group(['prefix'=>'/managerClass'],function(){
    Route::get('','ManagerController@managerClass')->middleware(['user.admin.auth']);
    Route::delete('delete/{id}','ManagerController@deleteClass')->middleware(['user.admin.auth']);
    Route::get('update/{id}','ManagerController@updateClass')->middleware(['user.admin.auth']);
    Route::put('update/{id}','ManagerController@updateClassProcess')->middleware(['user.admin.auth']);
});

Route::group(['prefix'=>'material'],function(){
    Route::get('/','UserFunctionController@material');
    Route::post('/','UserFunctionController@materialProcess');
    Route::get('/manager','ManagerController@material');
    Route::post('/manager','ManagerController@materialAddProcess');
    Route::get('/update/{id}','ManagerController@materialUpdate');
    Route::put('/update/{id}','ManagerController@materialUpdateProcess');
    Route::delete('/delete/{id}','ManagerController@materialDeleteProcess');
});


Route::get('verificationUser','ManagerController@verificationUser')->middleware(['user.admin.auth']);
Route::put('verificationUser/{email}','ManagerController@verificationUserOK')->middleware(['user.admin.auth']);
Route::delete('verificationUser/delete/{email}','ManagerController@verificationUserDelete')->middleware(['user.admin.auth']);