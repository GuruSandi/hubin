<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'AuthController@login')->name('login');
Route::post('/postlogin', 'AuthController@postlogin')->name('postlogin');
Route::get('/logout', 'AuthController@logout')->name('logout');

Route::get('/home', 'HomeController@home')->name('home');

//fitursiswa
Route::get('/dashboardsiswa', 'FiturSiswaController@dashboardsiswa')->name('dashboardsiswa');
Route::get('/tambahlokasi', 'FiturSiswaController@tambahlokasi')->name('tambahlokasi');
Route::post('/simpanlokasi', 'FiturSiswaController@simpanlokasi')->name('simpanlokasi');

//akunsisiwa
Route::get('/homeakunsiswa', 'AuthController@homeakunsiswa')->name('homeakunsiswa');
Route::get('/tambahakunsiswa', 'AuthController@tambahakunsiswa')->name('tambahakunsiswa');
Route::post('/posttambahakunsiswa', 'AuthController@posttambahakunsiswa')->name('posttambahakunsiswa');
Route::get('/editakunsiswa/{user}', 'AuthController@editakunsiswa')->name('editakunsiswa');
Route::post('/posteditakunsiswa/{user}', 'AuthController@posteditakunsiswa')->name('posteditakunsiswa');
Route::get('/hapusakunsiswa/{user}', 'AuthController@hapusakunsiswa')->name('hapusakunsiswa');

//siswa
Route::get('/homesiswa', 'SiswaController@homesiswa')->name('homesiswa');
Route::get('/tambahsiswa', 'SiswaController@tambahsiswa')->name('tambahsiswa');
Route::post('/posttambahsiswa', 'SiswaController@posttambahsiswa')->name('posttambahsiswa');
Route::get('/editsiswa/{siswa}', 'SiswaController@editsiswa')->name('editsiswa');
Route::post('/posteditsiswa/{siswa}', 'SiswaController@posteditsiswa')->name('posteditsiswa');
Route::get('/hapussiswa/{siswa}', 'SiswaController@hapussiswa')->name('hapussiswa');

//import
Route::post('/importsiswa', 'ImportController@importsiswa')->name('importsiswa');
Route::post('/importinstansi', 'ImportController@importinstansi')->name('importinstansi');
Route::post('/importpembimbing', 'ImportController@importpembimbing')->name('importpembimbing');

//instansi
Route::get('/homeinstansi', 'InstansiController@homeinstansi')->name('homeinstansi');
Route::get('/tambahinstansi', 'InstansiController@tambahinstansi')->name('tambahinstansi');
Route::post('/posttambahinstansi', 'InstansiController@posttambahinstansi')->name('posttambahinstansi');
Route::get('/editinstansi/{instansi}', 'InstansiController@editinstansi')->name('editinstansi');
Route::post('/posteditinstansi/{instansi}', 'InstansiController@posteditinstansi')->name('posteditinstansi');
Route::get('/hapusinstansi/{instansi}', 'InstansiController@hapusinstansi')->name('hapusinstansi');

//pembimbing
Route::get('/homepembimbing', 'PembimbingController@homepembimbing')->name('homepembimbing');
Route::get('/tambahpembimbing', 'PembimbingController@tambahpembimbing')->name('tambahpembimbing');
Route::post('/posttambahpembimbing', 'PembimbingController@posttambahpembimbing')->name('posttambahpembimbing');
Route::get('/editpembimbing/{pembimbing}', 'PembimbingController@editpembimbing')->name('editpembimbing');
Route::post('/posteditpembimbing/{pembimbing}', 'PembimbingController@posteditpembimbing')->name('posteditpembimbing');
Route::get('/hapuspembimbing/{pembimbing}', 'PembimbingController@hapuspembimbing')->name('hapuspembimbing');

//menempati
Route::get('/search-instansi', 'MenempatiController@search')->name('search');
Route::get('/search-siswa', 'MenempatiController@searchsiswa')->name('searchsiswa');
Route::get('/homemenempati', 'MenempatiController@homemenempati')->name('homemenempati');
Route::get('/tambahmenempati', 'MenempatiController@tambahmenempati')->name('tambahmenempati');
Route::post('/posttambahmenempati', 'MenempatiController@posttambahmenempati')->name('posttambahmenempati');
Route::get('/editmenempati/{menempati}', 'MenempatiController@editmenempati')->name('editmenempati');
Route::post('/posteditmenempati/{menempati}', 'MenempatiController@posteditmenempati')->name('posteditmenempati');
Route::get('/hapusmenempati/{menempati}', 'MenempatiController@hapusmenempati')->name('hapusmenempati');

//membimbing
Route::get('/homemembimbing', 'MembimbingController@homemembimbing')->name('homemembimbing');
Route::get('/tambahmembimbing', 'MembimbingController@tambahmembimbing')->name('tambahmembimbing');
Route::post('/posttambahmembimbing', 'MembimbingController@posttambahmembimbing')->name('posttambahmembimbing');
Route::get('/editmembimbing/{membimbing}', 'MembimbingController@editmembimbing')->name('editmembimbing');
Route::post('/posteditmembimbing/{membimbing}', 'MembimbingController@posteditmembimbing')->name('posteditmembimbing');
Route::get('/hapusmembimbing/{membimbing}', 'MembimbingController@hapusmembimbing')->name('hapusmembimbing');

//data penempatan
Route::get('/dataPenempatan', 'DataPenempatanController@dataPenempatan')->name('dataPenempatan');
Route::get('/exportDataPenempatan', 'DataPenempatanController@exportDataPenempatan')->name('exportDataPenempatan');


Route::get('/homeabsen', 'AbsenController@homeabsen')->name('homeabsen');
Route::get('/absensi', 'AbsenController@absensi')->name('absensi');
Route::post('/postabsensi', 'AbsenController@postabsensi')->name('postabsensi');
Route::get('/editabsensi/{id}', 'AbsenController@editabsensi')->name('editabsensi');
Route::post('/updateabsensi/{id}', 'AbsenController@updateabsensi')->name('updateabsensi');
Route::get('/deleteabsensi/{id}', 'AbsenController@deleteabsensi')->name('deleteabsensi');

