<?php

Auth::routes();

Route::get('/', 'AnggotaController@index');
Route::get('profile', 'AnggotaController@profile');
Route::get('profile/edit', 'AnggotaController@edit');
Route::post('profile/store', 'AnggotaController@store');
Route::post('profile/store-password','AnggotaController@storePassword');

Route::get('piket-harian','PiketHarianController@index');
Route::post('piket-harian/piket/{denda}/{id}','PiketHarianController@piket');

Route::get('piket-blog','PiketBulananController@index');
Route::post('piket-blog/piket','PiketBulananController@piket');

Route::get('user-management', 'AdminController@getAllUser');
Route::post('user-management/delete/{id}','AdminController@deleteUser');
Route::post('user-management/restore/{id}','AdminController@restoreUser');
Route::get('user-management/config/{id}','AdminController@showJadwalPiket');
Route::post('user-management/config/store','AdminController@storeJadwalPiket');
Route::get('user-management/reset-password/{id}','AdminController@resetPassword');

Route::get('anggota-hmsi','AnggotaController@getAllUser');

Route::get('inventaris','InventarisController@index');
Route::get('inventaris/create','InventarisController@create');
Route::post('inventaris/store','InventarisController@store');
Route::get('inventaris/update/{id}','InventarisController@update');
Route::post('inventaris/update','InventarisController@storeUpdate');
Route::get('inventaris/delete/{id}','InventarisController@delete');

Route::post('jenis-inventaris/store','InventarisController@storeJenis');
Route::get('jenis-inventaris/delete/{id}','InventarisController@deleteJenis');

// Route::get('{username_edit}/profile','AnggotaController@edit');
// Route::get('{username}','AnggotaController@index');

// Route::group(['middleware' => ['auth','admin']], function(){
//
// });
