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

Route::middleware(['guest'])->group(function () {
});
Route::get('/', 'AuthController@login')->name('login');
Route::post('/postlogin', 'AuthController@postlogin')->name('postlogin');
Route::middleware(['auth'])->group(function () {
    Route::get('/logout', 'AuthController@logout')->name('logout');


    Route::group(['middleware' => ['auth', 'role:admin']], function () {
        //DashboardAdmin
        Route::get('/DashboardAdmin', 'DashboardController@DashboardAdmin')->name('DashboardAdmin');
        Route::get('/setting', 'DashboardController@setting')->name('setting');
        Route::post('/nonaktif', 'DashboardController@nonaktif')->name('setting.nonaktif');
        Route::post('/aktifkan', 'DashboardController@aktifkan')->name('setting.aktifkan');

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
        Route::delete('/siswadelete', 'SiswaController@siswadelete')->name('siswa.delete');
        Route::get('/unduhformatsiswa', 'SiswaController@unduhformatsiswa')->name('unduhformatsiswa');


        //instansi
        Route::get('/homeinstansi', 'InstansiController@homeinstansi')->name('homeinstansi');
        Route::get('/tambahinstansi', 'InstansiController@tambahinstansi')->name('tambahinstansi');
        Route::post('/posttambahinstansi', 'InstansiController@posttambahinstansi')->name('posttambahinstansi');
        Route::get('/editinstansi/{instansi}', 'InstansiController@editinstansi')->name('editinstansi');
        Route::post('/posteditinstansi/{instansi}', 'InstansiController@posteditinstansi')->name('posteditinstansi');
        Route::get('/hapusinstansi/{instansi}', 'InstansiController@hapusinstansi')->name('hapusinstansi');
        Route::delete('/intansidelete', 'InstansiController@intansidelete')->name('intansi.delete');
        Route::get('/unduhformatinstansi', 'InstansiController@unduhformatinstansi')->name('unduhformatinstansi');

        //pembimbing
        Route::get('/homepembimbing', 'PembimbingController@homepembimbing')->name('homepembimbing');
        Route::get('/tambahpembimbing', 'PembimbingController@tambahpembimbing')->name('tambahpembimbing');
        Route::post('/posttambahpembimbing', 'PembimbingController@posttambahpembimbing')->name('posttambahpembimbing');
        Route::get('/editpembimbing/{pembimbing}', 'PembimbingController@editpembimbing')->name('editpembimbing');
        Route::post('/posteditpembimbing/{pembimbing}', 'PembimbingController@posteditpembimbing')->name('posteditpembimbing');
        Route::get('/hapuspembimbing/{pembimbing}', 'PembimbingController@hapuspembimbing')->name('hapuspembimbing');
        Route::delete('/pembimbingdelete', 'PembimbingController@pembimbingdelete')->name('pembimbing.delete');
        Route::get('/unduhformatguru', 'PembimbingController@unduhformatguru')->name('unduhformatguru');

        //GuruMapelPKL
        Route::get('/homegurumapel', 'GuruMapelController@homegurumapel')->name('homegurumapel');
        Route::get('/tambahgurumapel', 'GuruMapelController@tambahgurumapel')->name('tambahgurumapel');
        Route::post('/posttambahgurumapel', 'GuruMapelController@posttambahgurumapel')->name('posttambahgurumapel');
        Route::get('/editgurumapel/{gurumapel}', 'GuruMapelController@editgurumapel')->name('editgurumapel');
        Route::post('/posteditgurumapel/{gurumapel}', 'GuruMapelController@posteditgurumapel')->name('posteditgurumapel');
        Route::get('/hapusgurumapel/{gurumapel}', 'GuruMapelController@hapusgurumapel')->name('hapusgurumapel');
        Route::delete('/gurumapeldelete', 'GuruMapelController@gurumapeldelete')->name('gurumapel.delete');

        //menempati
        Route::get('/search-instansi', 'MenempatiController@search')->name('search');
        Route::get('/search-siswa', 'MenempatiController@searchsiswa')->name('searchsiswa');
        Route::get('/homemenempati', 'MenempatiController@homemenempati')->name('homemenempati');
        Route::get('/tambahmenempati', 'MenempatiController@tambahmenempati')->name('tambahmenempati');
        Route::post('/posttambahmenempati', 'MenempatiController@posttambahmenempati')->name('posttambahmenempati');
        Route::get('/editmenempati/{menempati}', 'MenempatiController@editmenempati')->name('editmenempati');
        Route::post('/posteditmenempati/{menempati}', 'MenempatiController@posteditmenempati')->name('posteditmenempati');
        Route::get('/hapusmenempati/{menempati}', 'MenempatiController@hapusmenempati')->name('hapusmenempati');
        Route::delete('/menempatidelete', 'MenempatiController@menempatidelete')->name('menempati.delete');
        Route::get('/unduhformatmenempati', 'MenempatiController@unduhformatmenempati')->name('unduhformatmenempati');

        //membimbing
        Route::get('/homemembimbing', 'MembimbingController@homemembimbing')->name('homemembimbing');
        Route::get('/tambahmembimbing', 'MembimbingController@tambahmembimbing')->name('tambahmembimbing');
        Route::post('/posttambahmembimbing', 'MembimbingController@posttambahmembimbing')->name('posttambahmembimbing');
        Route::get('/editmembimbing/{membimbing}', 'MembimbingController@editmembimbing')->name('editmembimbing');
        Route::post('/posteditmembimbing/{membimbing}', 'MembimbingController@posteditmembimbing')->name('posteditmembimbing');
        Route::get('/hapusmembimbing/{membimbing}', 'MembimbingController@hapusmembimbing')->name('hapusmembimbing');
        Route::delete('/membimbingdelete', 'MembimbingController@membimbingdelete')->name('membimbing.delete');
        Route::get('/unduhformatmembimbing', 'MembimbingController@unduhformatmembimbing')->name('unduhformatmembimbing');

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

        //dataabsensi
        Route::get('/dataabsensisiswa', 'DataAbsensiController@dataabsensisiswa')->name('dataabsensisiswa');
        Route::post('/posteditdataabsensisiswa/{absensisiswa}', 'DataAbsensiController@posteditdataabsensisiswa')->name('posteditdataabsensisiswa');
        Route::get('/hapusdataabsensisiswa/{absensisiswa}', 'DataAbsensiController@hapusdataabsensisiswa')->name('hapusdataabsensisiswa');
        Route::delete('/dataabsensidelete', 'DataAbsensiController@dataabsensidelete')->name('dataabsensi.delete');

        //datajurnal
        Route::get('/datajurnalsiswa', 'DataJurnalController@datajurnalsiswa')->name('datajurnalsiswa');
        Route::post('/posteditdatajurnalsiswa/{jurnal}', 'DataJurnalController@posteditdatajurnalsiswa')->name('posteditdatajurnalsiswa');
        Route::get('/hapusdatajurnalsiswa/{jurnal}', 'DataJurnalController@hapusdatajurnalsiswa')->name('hapusdatajurnalsiswa');
        Route::delete('/datajurnaldelete', 'DataJurnalController@datajurnaldelete')->name('datajurnal.delete');
        Route::get('/datajurnalbelumdivalidasi', 'DataJurnalController@datajurnalbelumdivalidasi')->name('datajurnalbelumdivalidasi');
        Route::post('/validasijurnal', 'DataJurnalController@jurnalvalidasisiswa')->name('datajurnal.validasi');

        //datanilaisiswa
        Route::get('/datanilaisiswa', 'DataNilaiController@datanilaisiswa')->name('datanilaisiswa');
        Route::post('/posteditdatanilaisiswa/{nilai_pkl}', 'DataNilaiController@posteditdatanilaisiswa')->name('posteditdatanilaisiswa');
        Route::get('/hapusdatanilaisiswa/{nilai_pkl}', 'DataNilaiController@hapusdatanilaisiswa')->name('hapusdatanilaisiswa');
        Route::delete('/datanilaidelete', 'DataNilaiController@datanilaidelete')->name('datanilai.delete');
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
        Route::post('/change-passwordsiswa', 'FiturSiswaController@changePassword')
            ->name('change.password');
        Route::get('/edit-passwordsiswa', 'FiturSiswaController@editpassword')
            ->name('editpassword');
    });

    Route::group(['middleware' => ['auth', 'role:guru']], function () {
        Route::get('/dashboardguru', 'FiturGuruController@dashboardguru')->name('dashboardguru');
        Route::get('/dataabsensi', 'FiturGuruController@absensisiswa')->name('dataabsensi');
        Route::get('/searchabsensisiswa', 'FiturGuruController@searchabsensisiswa')->name('dataabsensi.searchabsensisiswa');
        Route::get('/rekapabsen', 'FiturGuruController@rekapabsen')->name('dataabsensi.rekapabsen');
        Route::get('/seachrekapabsen', 'FiturGuruController@seachrekapabsen')->name('dataabsensi.seachrekapabsen');
        Route::get('/seachdetailrekapabsen/{siswa_id}', 'FiturGuruController@seachdetailrekapabsen')->name('dataabsensi.seachdetailrekapabsen');
        Route::get('/detailrekapabsen/{siswa_id}', 'FiturGuruController@detailabsen')->name('dataabsensi.detailrekapabsensi');
        Route::get('/jurnalhariini', 'FiturGuruController@jurnalhariini')->name('dashboardguru.jurnalhariini');
        Route::get('/belumabsen', 'FiturGuruController@belumabsen')->name('dashboardguru.belumabsen');
        Route::get('/sudahabsen', 'FiturGuruController@sudahabsen')->name('dashboardguru.sudahabsen');
        Route::get('/datasiswa', 'FiturGuruController@datasiswa')->name('datasiswa');
        Route::get('/datajurnal', 'FiturGuruController@jurnalsiwa')->name('datajurnal');
        Route::get('/searchdatajurnal', 'FiturGuruController@searchjurnalsiwa')->name('datajurnal.search');
        Route::get('/validasisetuju/{id}', 'FiturGuruController@validasisetuju')->name('validasisetuju');
        Route::get('/validasiditolak/{id}', 'FiturGuruController@validasiditolak')->name('validasiditolak');
        Route::post('/validasi/{id}', 'FiturGuruController@validasi')->name('validasi');
        Route::get('/nilaisiswa', 'NilaiSiswaController@nilaisiswa')->name('nilaisiswa');
        Route::get('/exportnilaisiswa', 'NilaiSiswaController@exportnilaisiswa')->name('exportnilaisiswa');
        Route::post('/tambahnilaisiswa', 'NilaiSiswaController@posttambahnilaisiswa')->name('nilaisiswa.tambahnilaisiswa');
        Route::post('/editnilaisiswa/{id}', 'NilaiSiswaController@editnilaisiswa')->name('nilaisiswa.editnilaisiswa');
        Route::post('/change-password', 'FiturGuruController@changePassword')
            ->name('dashboardguru.changepassword');
        Route::post('/editfoto', 'FiturGuruController@editfoto')
            ->name('dashboardguru.editfoto');
        Route::get('/edit-password', 'FiturGuruController@editpassword')
            ->name('dashboardguru.editpassword');
    });
});
