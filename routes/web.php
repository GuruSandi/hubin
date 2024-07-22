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
Route::middleware(['guest'])->group(function () {
    
});
Route::middleware(['auth'])->group(function () {
    Route::get('/logout', 'AuthController@logout')->name('logout');


    Route::group(['middleware' => ['auth', 'role:admin']], function () {
        //DashboardAdmin
        Route::get('/DashboardAdmin', 'DashboardController@DashboardAdmin')->name('DashboardAdmin');
        Route::get('/setting', 'DashboardController@setting')->name('setting');
        Route::post('/posteditprofile/{user}', 'DashboardController@posteditprofile')->name('posteditprofile');
        Route::get('/pklluarkota', 'DashboardController@pklluarkota')->name('pklluarkota');
        Route::get('/pkldalamkota', 'DashboardController@pkldalamkota')->name('pkldalamkota');
        Route::get('/belumditempatkan', 'DashboardController@belumditempatkan')->name('belumditempatkan');
        Route::get('/tempatkan/{siswa}', 'DashboardController@tempatkan')->name('tempatkan');

        //siswa
        Route::get('/homesiswa', 'SiswaController@homesiswa')->name('homesiswa');
        Route::get('/tambahsiswa', 'SiswaController@tambahsiswa')->name('tambahsiswa');
        Route::post('/posttambahsiswa', 'SiswaController@posttambahsiswa')->name('posttambahsiswa');
        Route::get('/editsiswa/{siswa}', 'SiswaController@editsiswa')->name('editsiswa');
        Route::post('/posteditsiswa/{siswa}', 'SiswaController@posteditsiswa')->name('posteditsiswa');
        Route::get('/hapussiswa/{siswa}', 'SiswaController@hapussiswa')->name('hapussiswa');

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

        //GuruMapelPKL
        Route::get('/homegurumapel', 'GuruMapelController@homegurumapel')->name('homegurumapel');
        Route::get('/tambahgurumapel', 'GuruMapelController@tambahgurumapel')->name('tambahgurumapel');
        Route::post('/posttambahgurumapel', 'GuruMapelController@posttambahgurumapel')->name('posttambahgurumapel');
        Route::get('/editgurumapel/{gurumapel}', 'GuruMapelController@editgurumapel')->name('editgurumapel');
        Route::post('/posteditgurumapel/{gurumapel}', 'GuruMapelController@posteditgurumapel')->name('posteditgurumapel');
        Route::get('/hapusgurumapel/{gurumapel}', 'GuruMapelController@hapusgurumapel')->name('hapusgurumapel');

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

        //import
        Route::post('/importsiswa', 'ImportController@importsiswa')->name('importsiswa');
        Route::post('/importinstansi', 'ImportController@importinstansi')->name('importinstansi');
        Route::post('/importpembimbing', 'ImportController@importpembimbing')->name('importpembimbing');
        Route::post('/importgurumapel', 'ImportController@importgurumapel')->name('importgurumapel');
        Route::post('/importmembimbing', 'ImportController@importmembimbing')->name('importmembimbing');
        Route::post('/importmenempati', 'ImportController@importmenempati')->name('importmenempati');

        //export
        Route::get('/exportDataMembimbing', 'MembimbingController@exportDataMembimbing')->name('exportDataMembimbing');
        Route::get('/exportDataMenempati', 'menempatiController@exportDataMenempati')->name('exportDataMenempati');
        Route::get('/exportDataSiswa', 'SiswaController@exportDataSiswa')->name('exportDataSiswa');
        Route::get('/exportDataInstansi', 'InstansiController@exportDataInstansi')->name('exportDataInstansi');
        Route::get('/exportDataPembimbing', 'PembimbingController@exportDataPembimbing')->name('exportDataPembimbing');
        Route::get('/exportDataGuruMapelPkl', 'GuruMapelController@exportDataGuruMapelPkl')->name('exportDataGuruMapelPkl');

        //akunsiswa
        Route::get('/homeakunsiswa', 'AuthController@homeakunsiswa')->name('homeakunsiswa');
        Route::post('/posteditakunsiswa/{user}', 'AuthController@posteditakunsiswa')->name('posteditakunsiswa');
        Route::get('/hapusakunsiswa/{user}', 'AuthController@hapusakunsiswa')->name('hapusakunsiswa');
        Route::get('/unduhAkunsiswa', 'AuthController@unduhAkunsiswa')->name('unduhAkunsiswa');

        //akunGuruMapelPKL
        Route::get('/homeGuruMapelPkl', 'AuthController@homeGuruMapelPkl')->name('homeGuruMapelPkl');
        Route::post('/posteditakunGuruMapelPkl/{user}', 'AuthController@posteditakunGuruMapelPkl')->name('posteditakunGuruMapelPkl');
        Route::get('/hapusakunGuruMapelPkl/{user}', 'AuthController@hapusakunGuruMapelPkl')->name('hapusakunGuruMapelPkl');
        Route::get('/unduhGuruMapelPkl', 'AuthController@unduhGuruMapelPkl')->name('unduhGuruMapelPkl');
        //akunadmin
        Route::get('/homeakunadmin', 'AuthController@homeakunadmin')->name('homeakunadmin');
        Route::post('/posttambahakunadmin', 'AuthController@posttambahakunadmin')->name('posttambahakunadmin');
        Route::post('/posteditakunadmin/{user}', 'AuthController@posteditakunadmin')->name('posteditakunadmin');
        Route::get('/hapusakunadmin/{user}', 'AuthController@hapusakunadmin')->name('hapusakunadmin');
        Route::get('/unduhakunadmin', 'AuthController@unduhakunadmin')->name('unduhakunadmin');
    });

    Route::group(['middleware' => ['role:siswa']], function () {
        //fitursiswa
        Route::get('/dashboardsiswa', 'FiturSiswaController@dashboardsiswa')->name('dashboardsiswa');
        Route::get('/tambahlokasi', 'FiturSiswaController@tambahlokasi')->name('tambahlokasi');
        Route::post('/simpanlokasi', 'FiturSiswaController@simpanlokasi')->name('simpanlokasi');

        //absensiswa
        Route::get('/homeabsen', 'AbsenController@homeabsen')->name('homeabsen');
        //absen datang
        Route::get('/absensi', 'AbsenController@absensi')->name('absensi');
        Route::post('/postabsensi', 'AbsenController@postabsensi')->name('postabsensi');
        Route::get('/editabsensi/{id}', 'AbsenController@editabsensi')->name('editabsensi');
        Route::post('/updateabsensi/{id}', 'AbsenController@updateabsensi')->name('updateabsensi');

        //absen Pulang
        Route::get('/absensipulang', 'AbsenController@absensipulang')->name('absensipulang');
        Route::get('/absensipulang/{id}', 'AbsenController@tambahabsensipulang')->name('tambahabsensipulang');
        Route::post('/postabsensipulang/{id}', 'AbsenController@postabsensipulang')->name('postabsensipulang');
        Route::get('/editabsensipulang/{id}', 'AbsenController@editabsensipulang')->name('editabsensipulang');
        Route::post('/posteditabsensipulang/{id}', 'AbsenController@posteditabsensipulang')->name('posteditabsensipulang');
        Route::get('/jurnal', 'AbsenController@jurnal')->name('jurnal');
        Route::get('/jurnaledit/{id}', 'AbsenController@editjurnal')->name('jurnal.edit');
        Route::post('/jurnalupdate/{id}', 'AbsenController@updatejurnal')->name('jurnal.update');
        Route::get('/jurnal/search', 'AbsenController@search')->name('jurnal.search');
        Route::get('/absensi/search', 'AbsenController@searchabsen')->name('searchabsen');
        Route::get('/jurnal/belumdivalidasi', 'AbsenController@jurnalbelumdivalidasi')->name('jurnalbelumdivalidasi');
        Route::get('/jurnal/ditolak', 'AbsenController@jurnalditolak')->name('jurnalditolak');
        Route::get('/jurnal/tervalidasi', 'AbsenController@jurnaltervalidasi')->name('jurnaltervalidasi');
        Route::get('/profile/siswa', 'FiturSiswaController@profilesiswa')->name('profilesiswa');
        Route::get('/profile/guruMapelPkl', 'FiturSiswaController@profilegurumapel')->name('profilegurumapel');
        Route::get('/profile/pembimbing', 'FiturSiswaController@profilepembimbing')->name('profilepembimbing');
        Route::post('/change-password','FiturSiswaController@changePassword')
        ->name('change.password');
        Route::get('/edit-password','FiturSiswaController@editpassword')
        ->name('editpassword');


    });

    Route::group(['middleware' => ['auth', 'role:guru']], function () {
       
    });
    
    Route::get('/dashboardguru', 'FiturGuruController@dashboardguru')->name('dashboardguru');
    Route::get('/dataabsensi', 'FiturGuruController@absensisiswa')->name('dataabsensi');
    Route::get('/datasiswa', 'FiturGuruController@datasiswa')->name('datasiswa');
    Route::get('/datajurnal', 'FiturGuruController@jurnalsiwa')->name('datajurnal');
    Route::get('/validasisetuju/{jurnal}', 'FiturGuruController@validasisetuju')->name('validasisetuju');
    Route::get('/validasiditolak/{jurnal}', 'FiturGuruController@validasiditolak')->name('validasiditolak');
    Route::post('/validasi/{jurnal}', 'FiturGuruController@validasi')->name('validasi');
    
});
