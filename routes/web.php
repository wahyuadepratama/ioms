<?php

Route::get('/', function () { return view('guest.welcome'); });

Auth::routes();
Route::get('home', 'HomeController@index');
// Route::group(['middleware' => ['auth','admin']], function(){
//
// });
Route::get('1970', 'AdminController@index');
Route::get('admin/user-management', 'AdminController@getAllUser');
Route::post('admin/user-management/delete/{id}','AdminController@deleteUser');
Route::post('admin/user-management/restore/{id}','AdminController@restoreUser');

Route::get('{username_edit}/profile','UserController@edit');
Route::get('{username}','UserController@index');
