<?php

namespace App\Http\Controllers;

use App\Models\absensisiswa;
use App\Models\guru_mapel_pkl;
use App\Models\jurnal;
use App\Models\membimbing;
use App\Models\siswa;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FiturGuruController extends Controller
{
    public function dashboardguru()
    {
        date_default_timezone_set('Asia/Jakarta');
        Carbon::setLocale('id_ID');
        $user = User::find(Auth::id());
        $guru_mapel_pkl = guru_mapel_pkl::where('user_id', $user->id)->first();
        $siswa = DB::table('membimbings')
            ->select('membimbings.*', 'siswas.nama as nama_siswa', 'siswas.kelas as kelas_siswa', 'absensisiswas.tanggal', 'absensisiswas.created_at', 'absensisiswas.jam_masuk', 'absensisiswas.jam_pulang', 'jurnals.deskripsi_jurnal',  'jurnals.id', 'jurnals.validasi', 'absensisiswas.jarak', 'instansis.instansi',  'pembimbings.nama as nama_pembimbing')
            ->join('siswas', 'membimbings.siswa_id', '=', 'siswas.id')
            ->join('menempatis', 'membimbings.siswa_id', '=', 'menempatis.siswa_id',)
            ->join('instansis', 'menempatis.siswa_id', '=', 'instansis.id',)
            ->join('absensisiswas', 'membimbings.siswa_id', '=', 'absensisiswas.siswa_id')
            ->leftJoin('jurnals', function ($join) {
                $join->on('absensisiswas.user_id', '=', 'jurnals.user_id')
                    ->whereDate('jurnals.created_at', '=', DB::raw('DATE(absensisiswas.tanggal)'));
            })
            ->join('pembimbings', 'membimbings.pembimbing_id', '=', 'pembimbings.id')
            ->where('membimbings.guru_mapel_pkl_id', $guru_mapel_pkl->id)
            ->orderBy('absensisiswas.created_at', 'desc')
            ->limit(5)
            ->get();
            foreach ($siswa as $item) {
                $item->tanggal = Carbon::parse($item->tanggal)->translatedFormat('l, j F Y');
                $item->jam_masuk = Carbon::parse($item->jam_masuk)->format('H.i');
            
                // Periksa jika jam_pulang tidak kosong sebelum memformatnya
                if ($item->jam_pulang) {
                    $item->jam_pulang = Carbon::parse($item->jam_pulang)->format('H.i');
                } else {
                    $item->jam_pulang = 'Belum Absen Pulang'; 
                }
            }
        return view('fiturguru.dashboardguru', compact('guru_mapel_pkl', 'siswa'));
    }
    public function validasisetuju(jurnal $jurnal)
    {

        $jurnal->update([
            'validasi' => 'tervalidasi'
        ]);
        return redirect()->back();
    }
    public function validasi(Request $request, jurnal $jurnal)
    {
        $request->validate([
            'validasi' => 'required'
        ]);
        $jurnal->update([
            'validasi' => $request->validasi
        ]);
        return redirect()->back();
    }
    public function validasiditolak(jurnal $jurnal)
    {

        $jurnal->update([
            'validasi' => 'ditolak'
        ]);
        return redirect()->back();
    }
    public function absensisiswa()
    {
        date_default_timezone_set('Asia/Jakarta');
        Carbon::setLocale('id_ID');
        $user = User::find(Auth::id());
        $guru_mapel_pkl = guru_mapel_pkl::where('user_id', $user->id)->first();
        $siswa = DB::table('membimbings')
            ->select('membimbings.*', 'instansis.instansi', 'siswas.nama as nama_siswa', 'siswas.kelas as kelas_siswa', 'absensisiswas.tanggal', 'absensisiswas.created_at', 'absensisiswas.jam_masuk', 'absensisiswas.jam_pulang', 'jurnals.deskripsi_jurnal',  'jurnals.id', 'jurnals.validasi', 'absensisiswas.jarak', 'pembimbings.nama as nama_pembimbing')
            ->join('siswas', 'membimbings.siswa_id', '=', 'siswas.id')
            ->join('menempatis', 'membimbings.siswa_id', '=', 'menempatis.siswa_id',)
            ->join('instansis', 'menempatis.siswa_id', '=', 'instansis.id',)
            ->join('absensisiswas', 'membimbings.siswa_id', '=', 'absensisiswas.siswa_id')
            ->leftJoin('jurnals', function ($join) {
                $join->on('absensisiswas.user_id', '=', 'jurnals.user_id')
                    ->whereDate('jurnals.created_at', '=', DB::raw('DATE(absensisiswas.tanggal)'));
            })
            ->join('pembimbings', 'membimbings.pembimbing_id', '=', 'pembimbings.id')
            ->where('membimbings.guru_mapel_pkl_id', $guru_mapel_pkl->id)
            ->orderBy('absensisiswas.created_at', 'desc')
            ->limit(5)
            ->get();
            foreach ($siswa as $item) {
                $item->tanggal = Carbon::parse($item->tanggal)->translatedFormat('l, j F Y');
                $item->jam_masuk = Carbon::parse($item->jam_masuk)->format('H.i');
            
                // Periksa jika jam_pulang tidak kosong sebelum memformatnya
                if ($item->jam_pulang) {
                    $item->jam_pulang = Carbon::parse($item->jam_pulang)->format('H.i');
                } else {
                    $item->jam_pulang = 'Belum Absen Pulang'; 
                }
            }
        return view('fiturguru.absensisiswa', compact('siswa'));
    }
    public function jurnalsiwa()
    {
        date_default_timezone_set('Asia/Jakarta');
        Carbon::setLocale('id_ID');
        $user = User::find(Auth::id());
        $guru_mapel_pkl = guru_mapel_pkl::where('user_id', $user->id)->first();
        $siswa = DB::table('membimbings')
            ->select('membimbings.*', 'instansis.instansi', 'siswas.nama as nama_siswa', 'siswas.kelas as kelas_siswa', 'absensisiswas.tanggal', 'absensisiswas.created_at', 'absensisiswas.jam_masuk', 'absensisiswas.jam_pulang', 'jurnals.deskripsi_jurnal',  'jurnals.id', 'jurnals.validasi', 'absensisiswas.jarak', 'pembimbings.nama as nama_pembimbing')
            ->join('siswas', 'membimbings.siswa_id', '=', 'siswas.id')
            ->join('menempatis', 'membimbings.siswa_id', '=', 'menempatis.siswa_id',)
            ->join('instansis', 'menempatis.siswa_id', '=', 'instansis.id',)
            ->join('absensisiswas', 'membimbings.siswa_id', '=', 'absensisiswas.siswa_id')
            ->leftJoin('jurnals', function ($join) {
                $join->on('absensisiswas.user_id', '=', 'jurnals.user_id')
                    ->whereDate('jurnals.created_at', '=', DB::raw('DATE(absensisiswas.tanggal)'));
            })
            ->join('pembimbings', 'membimbings.pembimbing_id', '=', 'pembimbings.id')
            ->where('membimbings.guru_mapel_pkl_id', $guru_mapel_pkl->id)
            ->orderBy('absensisiswas.created_at', 'desc')
            ->limit(5)
            ->get();
            foreach ($siswa as $item) {
                $item->tanggal = Carbon::parse($item->tanggal)->translatedFormat('l, j F Y');
                $item->jam_masuk = Carbon::parse($item->jam_masuk)->format('H.i');
            
                // Periksa jika jam_pulang tidak kosong sebelum memformatnya
                if ($item->jam_pulang) {
                    $item->jam_pulang = Carbon::parse($item->jam_pulang)->format('H.i');
                } else {
                    $item->jam_pulang = 'Belum Absen Pulang'; 
                }
            }
        return view('fiturguru.jurnalsiwa', compact('siswa'));
    }
    public function datasiswa()
    {
        date_default_timezone_set('Asia/Jakarta');
        Carbon::setLocale('id_ID');
        $user = User::find(Auth::id());
        $guru_mapel_pkl = guru_mapel_pkl::where('user_id', $user->id)->first();
        $siswa = DB::table('membimbings')
            ->select('membimbings.*', 'instansis.instansi', 'siswas.nama as nama_siswa', 'siswas.kelas as kelas_siswa', 'pembimbings.nama as nama_pembimbing')
            ->join('siswas', 'membimbings.siswa_id', '=', 'siswas.id')
            ->join('menempatis', 'membimbings.siswa_id', '=', 'menempatis.siswa_id',)
            ->join('instansis', 'menempatis.siswa_id', '=', 'instansis.id',)
            ->join('pembimbings', 'membimbings.pembimbing_id', '=', 'pembimbings.id')
            ->where('membimbings.guru_mapel_pkl_id', $guru_mapel_pkl->id)
            ->orderBy('membimbings.created_at', 'desc')
            ->limit(5)
            ->get();
           
        return view('fiturguru.datasiswa', compact('siswa'));
    }
}
