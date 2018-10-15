<?php

Auth::routes();

Route::get('/', 'DashboardController@index');

Route::get('profile', 'AnggotaController@profile');
Route::get('profile/edit', 'AnggotaController@edit');
Route::post('profile/store', 'AnggotaController@store');
Route::post('profile/store-password','AnggotaController@storePassword');
Route::get('history-piket','AnggotaController@indexPiketHarian');

// Route::get('piket-harian','PiketHarianController@index');
// Route::post('piket-harian/piket/{denda}/{id}','PiketHarianController@piket');

Route::get('user-management', 'AdminController@getAllUser');
Route::post('user-management/delete/{id}','AdminController@deleteUser');
Route::post('user-management/restore/{id}','AdminController@restoreUser');
Route::get('user-management/config/{id}','AdminController@showJadwalPiket');
Route::post('user-management/config/store','AdminController@storeJadwalPiket');
Route::get('user-management/reset-password/{id}','AdminController@resetPassword');
Route::post('user-management/change-role/{id}','AdminController@changeRole');
Route::get('admin/history-piket','AdminController@indexPiketHarian');

Route::get('anggota-hmsi','AnggotaController@getAllUser');

Route::get('inventaris','InventarisController@index');
Route::get('inventaris/create','InventarisController@create');
Route::post('inventaris/store','InventarisController@store');
Route::get('inventaris/update/{id}','InventarisController@update');
Route::post('inventaris/update','InventarisController@storeUpdate');
Route::get('inventaris/delete/{id}','InventarisController@delete');

Route::post('jenis-inventaris/store','InventarisController@storeJenis');
Route::get('jenis-inventaris/delete/{id}','InventarisController@deleteJenis');

Route::get('inventaris/peminjaman/{id}','PeminjamanController@index');
Route::post('inventaris/peminjaman/store','PeminjamanController@store');

Route::get('peminjaman','PeminjamanController@showAll');
Route::get('peminjaman/pengembalian/{id}','PeminjamanController@updatePengembalian');
