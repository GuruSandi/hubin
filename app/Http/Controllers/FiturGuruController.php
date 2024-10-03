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
use Illuminate\Support\Facades\Hash;

class FiturGuruController extends Controller
{
    public function dashboardguru()
    {
        date_default_timezone_set('Asia/Jakarta');
        Carbon::setLocale('id_ID');
        $user = User::find(Auth::id());
        $guru_mapel_pkl = guru_mapel_pkl::where('user_id', $user->id)->first();
        $jurnalterbaru = DB::table('membimbings')
            ->select('membimbings.*',  'siswas.nama as nama_siswa', 'siswas.kelas as kelas_siswa', 'jurnals.deskripsi_jurnal',  'jurnals.id', 'jurnals.tanggal', 'jurnals.validasi', 'instansis.instansi',  'pembimbings.nama as nama_pembimbing')
            ->join('siswas', 'membimbings.siswa_id', '=', 'siswas.id')
            ->join('menempatis', 'membimbings.siswa_id', '=', 'menempatis.siswa_id')
            ->join('instansis', 'menempatis.instansi_id', '=', 'instansis.id')
            ->join('jurnals', 'membimbings.siswa_id', '=', 'jurnals.siswa_id')
            ->join('pembimbings', 'membimbings.pembimbing_id', '=', 'pembimbings.id')
            ->where('membimbings.guru_mapel_pkl_id', $guru_mapel_pkl->id)
            ->orderBy('jurnals.created_at', 'desc')
            ->limit(5)
            ->get();
        foreach ($jurnalterbaru as $item) {
            $item->tanggal = Carbon::parse($item->tanggal)->translatedFormat('l, j F Y');
        }
        $absensiterbaru = DB::table('membimbings')
            ->select('membimbings.*', 'siswas.nama as nama_siswa', 'absensisiswas.keterangan', 'siswas.kelas as kelas_siswa', 'absensisiswas.tanggal', 'absensisiswas.created_at', 'absensisiswas.jam_masuk', 'absensisiswas.jam_pulang', 'absensisiswas.jarak', 'instansis.instansi',  'pembimbings.nama as nama_pembimbing')
            ->join('siswas', 'membimbings.siswa_id', '=', 'siswas.id')
            ->join('menempatis', 'membimbings.siswa_id', '=', 'menempatis.siswa_id')
            ->join('instansis', 'menempatis.instansi_id', '=', 'instansis.id')
            ->join('absensisiswas', 'membimbings.siswa_id', '=', 'absensisiswas.siswa_id')
            ->join('pembimbings', 'membimbings.pembimbing_id', '=', 'pembimbings.id')
            ->where('membimbings.guru_mapel_pkl_id', $guru_mapel_pkl->id)
            ->orderBy('absensisiswas.created_at', 'desc')
            ->limit(5)
            ->get();
        foreach ($absensiterbaru as $item) {
            $item->tanggal = Carbon::parse($item->tanggal)->translatedFormat('l, j F Y');

            // Format jam_masuk jika ada
            if ($item->jam_masuk) {
                $item->jam_masuk = Carbon::parse($item->jam_masuk)->format('H.i');
            } else {
                $item->jam_masuk = 'Belum Absen Datang';
            }

            // Format jam_pulang jika ada
            if ($item->jam_pulang) {
                $item->jam_pulang = Carbon::parse($item->jam_pulang)->format('H.i');
            } else {
                $item->jam_pulang = 'Belum Absen Pulang';
            }
        }
        $jumlahsiswa = DB::table('membimbings')
            ->join('siswas', 'membimbings.siswa_id', '=', 'siswas.id')
            ->join('menempatis', 'membimbings.siswa_id', '=', 'menempatis.siswa_id')
            ->join('instansis', 'menempatis.instansi_id', '=', 'instansis.id')
            ->join('pembimbings', 'membimbings.pembimbing_id', '=', 'pembimbings.id')
            ->where('membimbings.guru_mapel_pkl_id', $guru_mapel_pkl->id)
            ->orderBy('membimbings.created_at', 'desc')
            ->count();

        $jurnalsiswa = DB::table('membimbings')
            ->join('siswas', 'membimbings.siswa_id', '=', 'siswas.id')
            ->join('menempatis', 'membimbings.siswa_id', '=', 'menempatis.siswa_id')
            ->join('instansis', 'menempatis.instansi_id', '=', 'instansis.id')
            ->join('absensisiswas', 'membimbings.siswa_id', '=', 'absensisiswas.siswa_id')
            ->leftJoin('jurnals', function ($join) {
                $join->on('absensisiswas.user_id', '=', 'jurnals.user_id')
                    ->whereDate('jurnals.created_at', '=', DB::raw('DATE(absensisiswas.tanggal)'));
            })
            ->join('pembimbings', 'membimbings.pembimbing_id', '=', 'pembimbings.id')
            ->where('membimbings.guru_mapel_pkl_id', $guru_mapel_pkl->id)
            ->whereDate('jurnals.created_at', Carbon::now()->toDateString())
            ->count();
        $sudahabsen = DB::table('membimbings')
            ->join('siswas', 'membimbings.siswa_id', '=', 'siswas.id')
            ->join('menempatis', 'membimbings.siswa_id', '=', 'menempatis.siswa_id')
            ->join('instansis', 'menempatis.instansi_id', '=', 'instansis.id')
            ->join('absensisiswas', 'membimbings.siswa_id', '=', 'absensisiswas.siswa_id')

            ->join('pembimbings', 'membimbings.pembimbing_id', '=', 'pembimbings.id')
            ->where('membimbings.guru_mapel_pkl_id', $guru_mapel_pkl->id)
            ->whereDate('absensisiswas.created_at', Carbon::now()->toDateString())
            ->count();
        $belumabsen = DB::table('membimbings')
            ->join('siswas', 'membimbings.siswa_id', '=', 'siswas.id')
            ->leftJoin('absensisiswas', function ($join) {
                $join->on('membimbings.siswa_id', '=', 'absensisiswas.siswa_id')
                    ->whereDate('absensisiswas.created_at', Carbon::now()->toDateString());
            })
            ->join('pembimbings', 'membimbings.pembimbing_id', '=', 'pembimbings.id')
            ->where('membimbings.guru_mapel_pkl_id', $guru_mapel_pkl->id)
            ->whereNull('absensisiswas.id')  // Menyaring siswa yang belum absen
            ->select('siswas.id', 'siswas.nama', 'siswas.nis')  // Ambil kolom yang diinginkan
            ->count();


        return view('fiturguru.dashboardguru', compact('sudahabsen', 'belumabsen', 'guru_mapel_pkl', 'jurnalterbaru', 'absensiterbaru', 'jumlahsiswa', 'jurnalsiswa'));
    }
    public function validasisetuju($id, Request $request)
    {
        $jurnal = jurnal::findOrFail($id);

        $jurnal->update([
            'validasi' => 'tervalidasi'
        ]);
        return redirect()->route('datajurnal', ['page' => $request->input('page', 1)]);
    }

    public function validasiditolak($id, Request $request)
    {
        $jurnal = jurnal::findOrFail($id);
        $jurnal->update([
            'validasi' => 'ditolak'
        ]);
        return redirect()->route('datajurnal', ['page' => $request->input('page', 1)]);
    }
    public function detailabsen(Request $request, $siswa_id)
    {
        $tanggalMulai = $request->input('tanggal_mulai');
        $tanggalAkhir = $request->input('tanggal_akhir');
        date_default_timezone_set('Asia/Jakarta');
        Carbon::setLocale('id_ID');
        $user = User::find(Auth::id());
        $guru_mapel_pkl = guru_mapel_pkl::where('user_id', $user->id)->first();
        $siswa = siswa::findOrFail($siswa_id);


        $detailAbsensi = DB::table('membimbings')
            ->select(
                'siswas.id as siswa_id',
                'siswas.nama as nama_siswa',
                'siswas.kelas as kelas_siswa',
                'instansis.instansi as instansi_siswa',
                'absensisiswas.tanggal',
                'absensisiswas.keterangan',

            )
            ->join('siswas', 'membimbings.siswa_id', '=', 'siswas.id')
            ->join('menempatis', 'membimbings.siswa_id', '=', 'menempatis.siswa_id')
            ->join('instansis', 'menempatis.siswa_id', '=', 'instansis.id')
            ->join('absensisiswas', 'membimbings.siswa_id', '=', 'absensisiswas.siswa_id')
            ->leftJoin('jurnals', function ($join) {
                $join->on('absensisiswas.user_id', '=', 'jurnals.user_id')
                    ->whereDate('jurnals.created_at', '=', DB::raw('DATE(absensisiswas.tanggal)'));
            })
            ->join('pembimbings', 'membimbings.pembimbing_id', '=', 'pembimbings.id')
            ->where('membimbings.guru_mapel_pkl_id', $guru_mapel_pkl->id)
            ->where('siswas.id', $siswa_id)
            ->whereIn('absensisiswas.keterangan', ['hadir', 'libur', 'absen', 'tidak_masuk_pkl'])
            ->when($tanggalMulai && $tanggalAkhir, function ($query) use ($tanggalMulai, $tanggalAkhir) {
                $query->whereBetween('absensisiswas.tanggal', [$tanggalMulai, $tanggalAkhir]);
            })
            ->orderBy('siswas.nama')
            ->orderBy('absensisiswas.tanggal')
            ->get();

        $rekapabsen = DB::table('membimbings')
            ->select(
                'siswas.id as siswa_id',
                'siswas.nama as nama_siswa',
                'siswas.kelas as kelas_siswa',
                'instansis.instansi as instansi_siswa',
                DB::raw('(SELECT COUNT(*) FROM absensisiswas WHERE absensisiswas.siswa_id = siswas.id AND absensisiswas.keterangan = "hadir") as total_hadir'),
                DB::raw('(SELECT COUNT(*) FROM absensisiswas WHERE absensisiswas.siswa_id = siswas.id AND absensisiswas.keterangan = "libur") as total_libur'),
                DB::raw('(SELECT COUNT(*) FROM absensisiswas WHERE absensisiswas.siswa_id = siswas.id AND absensisiswas.keterangan = "absen") as total_absen'),
                DB::raw('(SELECT COUNT(*) FROM absensisiswas WHERE absensisiswas.siswa_id = siswas.id AND absensisiswas.keterangan = "tidak_masuk_pkl") as total_tidak_hadir_pkl')
            )
            ->join('siswas', 'membimbings.siswa_id', '=', 'siswas.id')
            ->join('menempatis', 'membimbings.siswa_id', '=', 'menempatis.siswa_id')
            ->join('instansis', 'menempatis.siswa_id', '=', 'instansis.id')
            ->join('pembimbings', 'membimbings.pembimbing_id', '=', 'pembimbings.id')
            ->join('absensisiswas', 'membimbings.siswa_id', '=', 'absensisiswas.siswa_id')
            ->where('membimbings.guru_mapel_pkl_id', $guru_mapel_pkl->id)
            ->where('absensisiswas.siswa_id', $siswa->id)
            ->groupBy('siswas.id', 'siswas.nama', 'siswas.kelas', 'instansis.instansi')
            ->orderBy('siswas.nama')
            ->when($tanggalMulai && $tanggalAkhir, function ($query) use ($tanggalMulai, $tanggalAkhir) {
                return $query->whereBetween('absensisiswas.tanggal', [$tanggalMulai, $tanggalAkhir]);
            })
            ->get();
        foreach ($detailAbsensi as $item) {
            $item->tanggal = Carbon::parse($item->tanggal)->translatedFormat('l, j F Y');
        }
        // dd($rekapabsen);

        return view('fiturguru.detailabsensi', compact('rekapabsen', 'guru_mapel_pkl', 'detailAbsensi'));
    }
    public function seachdetailrekapabsen(Request $request, $siswa_id)
    {
        $tanggalMulai = $request->input('tanggal_mulai');
        $tanggalAkhir = $request->input('tanggal_akhir');

        date_default_timezone_set('Asia/Jakarta');
        Carbon::setLocale('id_ID');

        $user = User::find(Auth::id());
        $guru_mapel_pkl = guru_mapel_pkl::where('user_id', $user->id)->first();
        $siswa = siswa::findOrFail($siswa_id);

        $detailAbsensi = DB::table('membimbings')
            ->select(
                'siswas.id as siswa_id',
                'siswas.nama as nama_siswa',
                'siswas.kelas as kelas_siswa',
                'instansis.instansi as instansi_siswa',
                'absensisiswas.tanggal',
                'absensisiswas.keterangan'
            )
            ->join('siswas', 'membimbings.siswa_id', '=', 'siswas.id')
            ->join('menempatis', 'membimbings.siswa_id', '=', 'menempatis.siswa_id')
            ->join('instansis', 'menempatis.siswa_id', '=', 'instansis.id')
            ->join('absensisiswas', 'membimbings.siswa_id', '=', 'absensisiswas.siswa_id')
            ->leftJoin('jurnals', function ($join) {
                $join->on('absensisiswas.user_id', '=', 'jurnals.user_id')
                    ->whereDate('jurnals.created_at', '=', DB::raw('DATE(absensisiswas.tanggal)'));
            })
            ->join('pembimbings', 'membimbings.pembimbing_id', '=', 'pembimbings.id')
            ->where('membimbings.guru_mapel_pkl_id', $guru_mapel_pkl->id)
            ->where('siswas.id', $siswa_id)
            ->whereIn('absensisiswas.keterangan', ['hadir', 'libur', 'absen', 'tidak_masuk_pkl'])
            ->when($tanggalMulai && $tanggalAkhir, function ($query) use ($tanggalMulai, $tanggalAkhir) {
                $query->whereBetween('absensisiswas.tanggal', [$tanggalMulai, $tanggalAkhir]);
            })
            ->orderBy('siswas.nama')
            ->orderBy('absensisiswas.tanggal')
            ->get();

        $rekapabsenQuery = "
    SELECT
        siswas.id as siswa_id,
        siswas.nama as nama_siswa,
        siswas.kelas as kelas_siswa,
        instansis.instansi as instansi_siswa,
        (SELECT COUNT(*) FROM absensisiswas 
            WHERE absensisiswas.siswa_id = siswas.id 
            AND absensisiswas.keterangan = 'hadir'
            AND absensisiswas.tanggal BETWEEN ? AND ?) as total_hadir,
        (SELECT COUNT(*) FROM absensisiswas 
            WHERE absensisiswas.siswa_id = siswas.id 
            AND absensisiswas.keterangan = 'libur'
            AND absensisiswas.tanggal BETWEEN ? AND ?) as total_libur,
        (SELECT COUNT(*) FROM absensisiswas 
            WHERE absensisiswas.siswa_id = siswas.id 
            AND absensisiswas.keterangan = 'absen'
            AND absensisiswas.tanggal BETWEEN ? AND ?) as total_absen,
        (SELECT COUNT(*) FROM absensisiswas 
            WHERE absensisiswas.siswa_id = siswas.id 
            AND absensisiswas.keterangan = 'tidak_masuk_pkl'
            AND absensisiswas.tanggal BETWEEN ? AND ?) as total_tidak_hadir_pkl
    FROM membimbings
    INNER JOIN siswas ON membimbings.siswa_id = siswas.id
    INNER JOIN menempatis ON membimbings.siswa_id = menempatis.siswa_id
    INNER JOIN instansis ON menempatis.siswa_id = instansis.id
    INNER JOIN pembimbings ON membimbings.pembimbing_id = pembimbings.id
    INNER JOIN absensisiswas ON membimbings.siswa_id = absensisiswas.siswa_id
    WHERE membimbings.guru_mapel_pkl_id = ?
    AND siswas.id = ?
    AND absensisiswas.tanggal BETWEEN ? AND ?
    GROUP BY siswas.id, siswas.nama, siswas.kelas, instansis.instansi
    ORDER BY siswas.nama
    ";

        $rekapabsen = DB::select($rekapabsenQuery, [
            $tanggalMulai,
            $tanggalAkhir,
            $tanggalMulai,
            $tanggalAkhir,
            $tanggalMulai,
            $tanggalAkhir,
            $tanggalMulai,
            $tanggalAkhir,
            $guru_mapel_pkl->id,
            $siswa_id,
            $tanggalMulai,
            $tanggalAkhir
        ]);
        foreach ($detailAbsensi as $item) {
            $item->tanggal = Carbon::parse($item->tanggal)->translatedFormat('l, j F Y');
        }
        return view('fiturguru.detailabsensi', compact('rekapabsen', 'guru_mapel_pkl', 'detailAbsensi'));
    }

    public function rekapabsen(Request $request)
    {
        $tanggalMulai = $request->input('tanggal_mulai');
        $tanggalAkhir = $request->input('tanggal_akhir');
        date_default_timezone_set('Asia/Jakarta');
        Carbon::setLocale('id_ID');
        $user = User::find(Auth::id());
        $guru_mapel_pkl = guru_mapel_pkl::where('user_id', $user->id)->first();

        $detailAbsensi = DB::table('membimbings')
            ->select(
                'siswas.id as siswa_id',
                'siswas.nama as nama_siswa',
                'siswas.kelas as kelas_siswa',
                'instansis.instansi as instansi_siswa',
                'absensisiswas.tanggal',
                'absensisiswas.keterangan'
            )
            ->join('siswas', 'membimbings.siswa_id', '=', 'siswas.id')
            ->join('menempatis', 'membimbings.siswa_id', '=', 'menempatis.siswa_id')
            ->join('instansis', 'menempatis.siswa_id', '=', 'instansis.id')
            ->join('absensisiswas', 'membimbings.siswa_id', '=', 'absensisiswas.siswa_id')
            ->leftJoin('jurnals', function ($join) {
                $join->on('absensisiswas.user_id', '=', 'jurnals.user_id')
                    ->whereDate('jurnals.created_at', '=', DB::raw('DATE(absensisiswas.tanggal)'));
            })
            ->join('pembimbings', 'membimbings.pembimbing_id', '=', 'pembimbings.id')
            ->where('membimbings.guru_mapel_pkl_id', $guru_mapel_pkl->id)
            ->whereIn('absensisiswas.keterangan', ['hadir', 'libur', 'absen', 'tidak_hadir_pkl'])
            ->orderBy('siswas.nama')
            ->orderBy('absensisiswas.tanggal')
            ->get();

        // $rekapabsen = DB::table('membimbings')
        //     ->select(
        //         'siswas.id as siswa_id',
        //         'siswas.nama as nama_siswa',
        //         'siswas.kelas as kelas_siswa',
        //         'instansis.instansi as instansi_siswa',
        //         DB::raw('(SELECT COUNT(*) FROM absensisiswas WHERE absensisiswas.siswa_id = siswas.id AND absensisiswas.keterangan = "hadir") as total_hadir'),
        //         DB::raw('(SELECT COUNT(*) FROM absensisiswas WHERE absensisiswas.siswa_id = siswas.id AND absensisiswas.keterangan = "libur") as total_libur'),
        //         DB::raw('(SELECT COUNT(*) FROM absensisiswas WHERE absensisiswas.siswa_id = siswas.id AND absensisiswas.keterangan = "absen") as total_absen'),
        //         DB::raw('(SELECT COUNT(*) FROM absensisiswas WHERE absensisiswas.siswa_id = siswas.id AND absensisiswas.keterangan = "tidak_masuk_pkl") as total_tidak_hadir_pkl')
        //     )
        //     ->join('siswas', 'membimbings.siswa_id', '=', 'siswas.id')
        //     ->join('menempatis', 'membimbings.siswa_id', '=', 'menempatis.siswa_id')
        //     ->join('instansis', 'menempatis.siswa_id', '=', 'instansis.id')
        //     ->join('pembimbings', 'membimbings.pembimbing_id', '=', 'pembimbings.id')
        //     ->join('absensisiswas', 'membimbings.siswa_id', '=', 'absensisiswas.siswa_id')
        //     ->where('membimbings.guru_mapel_pkl_id', $guru_mapel_pkl->id)
        //     ->groupBy('siswas.id', 'siswas.nama', 'siswas.kelas', 'instansis.instansi')
        //     ->orderBy('siswas.nama')
        //     ->get();
        $rekapabsen = DB::table('siswas')
            ->select(
                'siswas.id as siswa_id',
                'siswas.nama as nama_siswa',
                'siswas.kelas as kelas_siswa',
                DB::raw('(SELECT COUNT(*) FROM absensisiswas WHERE absensisiswas.siswa_id = siswas.id AND absensisiswas.keterangan = "hadir") as total_hadir'),
                DB::raw('(SELECT COUNT(*) FROM absensisiswas WHERE absensisiswas.siswa_id = siswas.id AND absensisiswas.keterangan = "libur") as total_libur'),
                DB::raw('(SELECT COUNT(*) FROM absensisiswas WHERE absensisiswas.siswa_id = siswas.id AND absensisiswas.keterangan = "absen") as total_absen'),
                DB::raw('(SELECT COUNT(*) FROM absensisiswas WHERE absensisiswas.siswa_id = siswas.id AND absensisiswas.keterangan = "tidak_hadir_pkl") as total_tidak_hadir_pkl')
            )
            ->leftJoin('absensisiswas', 'siswas.id', '=', 'absensisiswas.siswa_id')
            ->whereIn('siswas.id', function ($query) use ($guru_mapel_pkl) {
                $query->select('siswa_id')
                    ->from('membimbings')
                    ->where('guru_mapel_pkl_id', $guru_mapel_pkl->id);
            })
            ->groupBy('siswas.id', 'siswas.nama', 'siswas.kelas')
            ->orderBy('siswas.nama')
            ->get();

        foreach ($detailAbsensi as $item) {
            $item->tanggal = Carbon::parse($item->tanggal)->translatedFormat('l, j F Y');
        }
        // dd($rekap);

        return view('fiturguru.rekapabsen', compact('rekapabsen', 'guru_mapel_pkl', 'detailAbsensi', 'tanggalMulai', 'tanggalAkhir'));
    }
    public function seachrekapabsen(Request $request)
    {
        $tanggalMulai = $request->input('tanggal_mulai');
        $tanggalAkhir = $request->input('tanggal_akhir');

        if (!$tanggalMulai) {
            $tanggalMulai = null;
        }

        if (!$tanggalAkhir) {
            $tanggalAkhir = null;
        }

        date_default_timezone_set('Asia/Jakarta');
        Carbon::setLocale('id_ID');

        $user = User::find(Auth::id());
        $guru_mapel_pkl = guru_mapel_pkl::where('user_id', $user->id)->first();

        // Detail absensi
        $detailAbsensi = DB::table('membimbings')
            ->select(
                'siswas.id as siswa_id',
                'siswas.nama as nama_siswa',
                'siswas.kelas as kelas_siswa',
                'instansis.instansi as instansi_siswa',
                'absensisiswas.tanggal',
                'absensisiswas.keterangan'
            )
            ->join('siswas', 'membimbings.siswa_id', '=', 'siswas.id')
            ->join('menempatis', 'membimbings.siswa_id', '=', 'menempatis.siswa_id')
            ->join('instansis', 'menempatis.siswa_id', '=', 'instansis.id')
            ->join('absensisiswas', 'membimbings.siswa_id', '=', 'absensisiswas.siswa_id')
            ->leftJoin('jurnals', function ($join) {
                $join->on('absensisiswas.user_id', '=', 'jurnals.user_id')
                    ->whereDate('jurnals.created_at', '=', DB::raw('DATE(absensisiswas.tanggal)'));
            })
            ->join('pembimbings', 'membimbings.pembimbing_id', '=', 'pembimbings.id')
            ->where('membimbings.guru_mapel_pkl_id', $guru_mapel_pkl->id)
            ->whereIn('absensisiswas.keterangan', ['hadir', 'libur', 'absen', 'tidak_masuk_pkl'])
            ->when($tanggalMulai && $tanggalAkhir, function ($query) use ($tanggalMulai, $tanggalAkhir) {
                $query->whereBetween('absensisiswas.tanggal', [$tanggalMulai, $tanggalAkhir]);
            })
            ->orderBy('siswas.nama')
            ->orderBy('absensisiswas.tanggal')
            ->get();

        // Rekap absensi
        $rekapabsenQuery = "
        SELECT
            siswas.id as siswa_id,
            siswas.nama as nama_siswa,
            siswas.kelas as kelas_siswa,
            instansis.instansi as instansi_siswa,
            (SELECT COUNT(*) FROM absensisiswas 
                WHERE absensisiswas.siswa_id = siswas.id 
                AND absensisiswas.keterangan = 'hadir'
                AND absensisiswas.tanggal BETWEEN ? AND ?) as total_hadir,
            (SELECT COUNT(*) FROM absensisiswas 
                WHERE absensisiswas.siswa_id = siswas.id 
                AND absensisiswas.keterangan = 'libur'
                AND absensisiswas.tanggal BETWEEN ? AND ?) as total_libur,
            (SELECT COUNT(*) FROM absensisiswas 
                WHERE absensisiswas.siswa_id = siswas.id 
                AND absensisiswas.keterangan = 'absen'
                AND absensisiswas.tanggal BETWEEN ? AND ?) as total_absen,
            (SELECT COUNT(*) FROM absensisiswas 
                WHERE absensisiswas.siswa_id = siswas.id 
                AND absensisiswas.keterangan = 'tidak_masuk_pkl'
                AND absensisiswas.tanggal BETWEEN ? AND ?) as total_tidak_hadir_pkl
        FROM membimbings
        INNER JOIN siswas ON membimbings.siswa_id = siswas.id
        INNER JOIN menempatis ON membimbings.siswa_id = menempatis.siswa_id
        INNER JOIN instansis ON menempatis.siswa_id = instansis.id
        INNER JOIN pembimbings ON membimbings.pembimbing_id = pembimbings.id
        INNER JOIN absensisiswas ON membimbings.siswa_id = absensisiswas.siswa_id
        WHERE membimbings.guru_mapel_pkl_id = ?
        AND absensisiswas.tanggal BETWEEN ? AND ?
        GROUP BY siswas.id, siswas.nama, siswas.kelas, instansis.instansi
        ORDER BY siswas.nama
    ";

        $rekapabsen = DB::select($rekapabsenQuery, [
            $tanggalMulai,
            $tanggalAkhir,
            $tanggalMulai,
            $tanggalAkhir,
            $tanggalMulai,
            $tanggalAkhir,
            $tanggalMulai,
            $tanggalAkhir,
            $guru_mapel_pkl->id,
            $tanggalMulai,
            $tanggalAkhir
        ]);

        // Format tanggal untuk detail absensi
        foreach ($detailAbsensi as $item) {
            $item->tanggal = Carbon::parse($item->tanggal)->translatedFormat('l, j F Y');
        }

        return view('fiturguru.rekapabsen', compact('rekapabsen', 'guru_mapel_pkl', 'detailAbsensi', 'tanggalMulai', 'tanggalAkhir'));
    }

    public function absensisiswa()
    {
        date_default_timezone_set('Asia/Jakarta');
        Carbon::setLocale('id_ID');
        $user = User::find(Auth::id());
        $guru_mapel_pkl = guru_mapel_pkl::where('user_id', $user->id)->first();
        $siswa = DB::table('membimbings')
            ->select('membimbings.*', 'instansis.instansi', 'siswas.nama as nama_siswa', 'siswas.kelas as kelas_siswa', 'absensisiswas.tanggal', 'absensisiswas.created_at', 'absensisiswas.keterangan', 'absensisiswas.jam_masuk', 'absensisiswas.jam_pulang', 'absensisiswas.jarak', 'pembimbings.nama as nama_pembimbing')
            ->join('siswas', 'membimbings.siswa_id', '=', 'siswas.id')
            ->join('menempatis', 'membimbings.siswa_id', '=', 'menempatis.siswa_id')
            ->join('instansis', 'menempatis.instansi_id', '=', 'instansis.id')
            ->join('absensisiswas', 'membimbings.siswa_id', '=', 'absensisiswas.siswa_id')
            ->join('pembimbings', 'membimbings.pembimbing_id', '=', 'pembimbings.id')
            ->where('membimbings.guru_mapel_pkl_id', $guru_mapel_pkl->id)
            ->orderBy('absensisiswas.created_at', 'desc');
        $siswa = $siswa->paginate(100);

        foreach ($siswa as $item) {
            $item->tanggal = Carbon::parse($item->tanggal)->translatedFormat('l, j F Y');

            // Format jam_masuk jika ada
            if ($item->jam_masuk) {
                $item->jam_masuk = Carbon::parse($item->jam_masuk)->format('H.i');
            } else {
                $item->jam_masuk = 'Belum Absen Datang';
            }

            // Format jam_pulang jika ada
            if ($item->jam_pulang) {
                $item->jam_pulang = Carbon::parse($item->jam_pulang)->format('H.i');
            } else {
                $item->jam_pulang = 'Belum Absen Pulang';
            }
        }

        return view('fiturguru.absensisiswa', compact('siswa', 'guru_mapel_pkl'));
    }
    public function searchabsensisiswa(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        date_default_timezone_set('Asia/Jakarta');
        Carbon::setLocale('id_ID');
        $user = User::find(Auth::id());
        $guru_mapel_pkl = guru_mapel_pkl::where('user_id', $user->id)->first();
        $siswa = DB::table('membimbings')
            ->select('membimbings.*', 'instansis.instansi', 'absensisiswas.keterangan', 'siswas.nama as nama_siswa', 'siswas.kelas as kelas_siswa', 'absensisiswas.tanggal', 'absensisiswas.created_at', 'absensisiswas.jam_masuk', 'absensisiswas.jam_pulang', 'jurnals.deskripsi_jurnal',  'jurnals.id', 'jurnals.validasi', 'absensisiswas.jarak', 'pembimbings.nama as nama_pembimbing')
            ->join('siswas', 'membimbings.siswa_id', '=', 'siswas.id')
            ->join('menempatis', 'membimbings.siswa_id', '=', 'menempatis.siswa_id')
            ->join('instansis', 'menempatis.siswa_id', '=', 'instansis.id')
            ->join('absensisiswas', 'membimbings.siswa_id', '=', 'absensisiswas.siswa_id')
            ->leftJoin('jurnals', function ($join) {
                $join->on('absensisiswas.user_id', '=', 'jurnals.user_id')
                    ->whereDate('jurnals.created_at', '=', DB::raw('DATE(absensisiswas.tanggal)'));
            })
            ->join('pembimbings', 'membimbings.pembimbing_id', '=', 'pembimbings.id')
            ->where('membimbings.guru_mapel_pkl_id', $guru_mapel_pkl->id)
            ->orderBy('absensisiswas.created_at', 'desc');

        // Filter berdasarkan tanggal jika start_date dan end_date disediakan
        if ($start_date && $end_date) {
            $siswa->whereBetween('absensisiswas.tanggal', [$start_date, $end_date]);
        }

        $siswa = $siswa->get();
        foreach ($siswa as $item) {
            $item->tanggal = Carbon::parse($item->tanggal)->translatedFormat('l, j F Y');

            // Format jam_masuk jika ada
            if ($item->jam_masuk) {
                $item->jam_masuk = Carbon::parse($item->jam_masuk)->format('H.i');
            } else {
                $item->jam_masuk = 'Belum Absen Datang';
            }

            // Format jam_pulang jika ada
            if ($item->jam_pulang) {
                $item->jam_pulang = Carbon::parse($item->jam_pulang)->format('H.i');
            } else {
                $item->jam_pulang = 'Belum Absen Pulang';
            }
        }

        return view('fiturguru.absensisiswa', compact('siswa', 'guru_mapel_pkl'));
    }

    public function jurnalsiwa()
    {
        date_default_timezone_set('Asia/Jakarta');
        Carbon::setLocale('id_ID');
        $user = User::find(Auth::id());
        $guru_mapel_pkl = guru_mapel_pkl::where('user_id', $user->id)->first();
        $siswa = DB::table('membimbings')
            ->select('membimbings.*', 'instansis.instansi', 'siswas.nama as nama_siswa', 'siswas.kelas as kelas_siswa', 'jurnals.deskripsi_jurnal', 'jurnals.tanggal',  'jurnals.id', 'jurnals.validasi', 'pembimbings.nama as nama_pembimbing')
            ->join('siswas', 'membimbings.siswa_id', '=', 'siswas.id')
            ->join('menempatis', 'membimbings.siswa_id', '=', 'menempatis.siswa_id')
            ->join('instansis', 'menempatis.instansi_id', '=', 'instansis.id')
            ->join('jurnals', 'membimbings.siswa_id', '=', 'jurnals.siswa_id')
            ->join('pembimbings', 'membimbings.pembimbing_id', '=', 'pembimbings.id')
            ->where('membimbings.guru_mapel_pkl_id', $guru_mapel_pkl->id)
            ->orderBy('jurnals.created_at', 'desc');
        
        $siswa = $siswa->paginate(10);

        foreach ($siswa as $item) {
            $item->tanggal = Carbon::parse($item->tanggal)->translatedFormat('l, j F Y');
        }
        return view('fiturguru.jurnalsiwa', compact('siswa', 'guru_mapel_pkl'));
    }
    public function searchjurnalsiwa(Request $request)
    {
        // Ambil input dari form
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        // Atur zona waktu dan locale Carbon
        date_default_timezone_set('Asia/Jakarta');
        Carbon::setLocale('id_ID');

        // Ambil user yang sedang login
        $user = User::find(Auth::id());

        // Ambil guru_mapel_pkl berdasarkan user_id
        $guru_mapel_pkl = guru_mapel_pkl::where('user_id', $user->id)->first();

        $siswa = DB::table('membimbings')
            ->select('membimbings.*', 'instansis.instansi', 'siswas.nama as nama_siswa', 'siswas.kelas as kelas_siswa', 'jurnals.deskripsi_jurnal',  'jurnals.id', 'jurnals.validasi', 'jurnals.tanggal', 'pembimbings.nama as nama_pembimbing')
            ->join('siswas', 'membimbings.siswa_id', '=', 'siswas.id')
            ->join('menempatis', 'membimbings.siswa_id', '=', 'menempatis.siswa_id')
            ->join('instansis', 'menempatis.siswa_id', '=', 'instansis.id')
            ->join('pembimbings', 'membimbings.pembimbing_id', '=', 'pembimbings.id')
            ->join('jurnals', 'membimbings.siswa_id', '=', 'jurnals.siswa_id')

            ->where('membimbings.guru_mapel_pkl_id', $guru_mapel_pkl->id);

        if ($start_date && $end_date) {
            $siswa->whereDate('jurnals.tanggal', '>=', $start_date)
                ->whereDate('jurnals.tanggal', '<=', $end_date);
        }

        $siswa = $siswa->orderBy('jurnals.tanggal', 'desc')
            ->get();



        foreach ($siswa as $item) {
            $item->tanggal = Carbon::parse($item->tanggal)->translatedFormat('l, j F Y');
        }

        return view('fiturguru.jurnalsiwa', compact('siswa', 'guru_mapel_pkl'));
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
            ->join('menempatis', 'membimbings.siswa_id', '=', 'menempatis.siswa_id')
            ->join('instansis', 'menempatis.instansi_id', '=', 'instansis.id')
            ->join('pembimbings', 'membimbings.pembimbing_id', '=', 'pembimbings.id')
            ->where('membimbings.guru_mapel_pkl_id', $guru_mapel_pkl->id)
            ->orderBy('membimbings.created_at', 'desc')
            ->get();

        return view('fiturguru.datasiswa', compact('siswa', 'guru_mapel_pkl'));
    }
    public function sudahabsen()
    {
        date_default_timezone_set('Asia/Jakarta');
        Carbon::setLocale('id_ID');
        $user = User::find(Auth::id());
        $guru_mapel_pkl = guru_mapel_pkl::where('user_id', $user->id)->first();

        $sudahabsen = DB::table('membimbings')
            ->select('membimbings.*', 'siswas.nama as nama_siswa', 'absensisiswas.keterangan', 'siswas.kelas as kelas_siswa', 'absensisiswas.tanggal', 'absensisiswas.created_at', 'absensisiswas.jam_masuk', 'absensisiswas.jam_pulang', 'absensisiswas.jarak', 'instansis.instansi',  'pembimbings.nama as nama_pembimbing')
            ->join('siswas', 'membimbings.siswa_id', '=', 'siswas.id')
            ->join('menempatis', 'membimbings.siswa_id', '=', 'menempatis.siswa_id')
            ->join('instansis', 'menempatis.instansi_id', '=', 'instansis.id')
            ->join('absensisiswas', 'membimbings.siswa_id', '=', 'absensisiswas.siswa_id')
            ->join('pembimbings', 'membimbings.pembimbing_id', '=', 'pembimbings.id')
            ->where('membimbings.guru_mapel_pkl_id', $guru_mapel_pkl->id)
            ->whereDate('absensisiswas.created_at', Carbon::now()->toDateString())
            ->orderBy('absensisiswas.created_at', 'desc')
            ->limit(5)
            ->get();
        foreach ($sudahabsen as $item) {
            $item->tanggal = Carbon::parse($item->tanggal)->translatedFormat('l, j F Y');

            // Format jam_masuk jika ada
            if ($item->jam_masuk) {
                $item->jam_masuk = Carbon::parse($item->jam_masuk)->format('H.i');
            } else {
                $item->jam_masuk = 'Belum Absen Datang';
            }

            // Format jam_pulang jika ada
            if ($item->jam_pulang) {
                $item->jam_pulang = Carbon::parse($item->jam_pulang)->format('H.i');
            } else {
                $item->jam_pulang = 'Belum Absen Pulang';
            }
        }
        return view('fiturguru.sudahabsen', compact('sudahabsen', 'guru_mapel_pkl'));
    }
    public function belumabsen()
    {
        date_default_timezone_set('Asia/Jakarta');
        Carbon::setLocale('id_ID');
        $user = User::find(Auth::id());
        $guru_mapel_pkl = guru_mapel_pkl::where('user_id', $user->id)->first();

        $belumabsen = DB::table('membimbings')
            ->join('siswas', 'membimbings.siswa_id', '=', 'siswas.id')
            ->join('menempatis', 'membimbings.siswa_id', '=', 'menempatis.siswa_id')
            ->join('instansis', 'menempatis.instansi_id', '=', 'instansis.id')
            ->leftJoin('absensisiswas', function ($join) {
                $join->on('membimbings.siswa_id', '=', 'absensisiswas.siswa_id')
                    ->whereDate('absensisiswas.created_at', Carbon::now()->toDateString());
            })
            ->join('pembimbings', 'membimbings.pembimbing_id', '=', 'pembimbings.id')
            ->where('membimbings.guru_mapel_pkl_id', $guru_mapel_pkl->id)
            ->whereNull('absensisiswas.id')  // Menyaring siswa yang belum absen
            ->select('siswas.id', 'siswas.nama', 'siswas.nis', 'siswas.kelas', 'instansis.instansi',  'pembimbings.nama as nama_pembimbing')  // Ambil kolom yang diinginkan
            ->get();
        return view('fiturguru.belumabsen', compact('belumabsen', 'guru_mapel_pkl'));
    }
    public function jurnalhariini()
    {
        date_default_timezone_set('Asia/Jakarta');
        Carbon::setLocale('id_ID');
        $user = User::find(Auth::id());
        $guru_mapel_pkl = guru_mapel_pkl::where('user_id', $user->id)->first();

        $jurnalsiswa = DB::table('membimbings')
            ->select('membimbings.*', 'instansis.instansi', 'siswas.nama as nama_siswa', 'siswas.kelas as kelas_siswa', 'jurnals.deskripsi_jurnal', 'jurnals.tanggal',  'jurnals.id', 'jurnals.validasi', 'pembimbings.nama as nama_pembimbing')

            ->join('siswas', 'membimbings.siswa_id', '=', 'siswas.id')
            ->join('menempatis', 'membimbings.siswa_id', '=', 'menempatis.siswa_id')
            ->join('instansis', 'menempatis.instansi_id', '=', 'instansis.id')
            ->join('jurnals', 'membimbings.siswa_id', '=', 'jurnals.siswa_id')
            ->join('pembimbings', 'membimbings.pembimbing_id', '=', 'pembimbings.id')
            ->where('membimbings.guru_mapel_pkl_id', $guru_mapel_pkl->id)
            ->whereDate('jurnals.created_at', Carbon::now()->toDateString())
            ->orderBy('jurnals.created_at', 'desc')
            ->get();
        foreach ($jurnalsiswa as $item) {
            $item->tanggal = Carbon::parse($item->tanggal)->translatedFormat('l, j F Y');
        }
        return view('fiturguru.jurnalhariini', compact('jurnalsiswa', 'guru_mapel_pkl'));
    }
    public function editpassword()
    {
        $user = User::find(Auth::id());
        $guru_mapel_pkl = guru_mapel_pkl::where('user_id', $user->id)->first();

        return view('fiturguru.editpassword', compact('guru_mapel_pkl'));
    }
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|different:current_password|confirmed',
            'new_password_confirmation' => 'required|string|min:8|same:new_password',
        ]);

        $user = auth()->user();
        $edituser = User::where('id', $user->id)->first();
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Password yang Anda masukkan tidak sesuai dengan password lama.'])->withInput();
        }
        if ($request->new_password !== $request->new_password_confirmation) {
            return redirect()->back()->withErrors(['new_password_confirmation' => 'Konfirmasi password baru tidak cocok'])->withInput();
        }
        $edituser->update([
            'password' => bcrypt($request->new_password),
            'encrypted_password' => $request->new_password,
        ]);
        $request->session()->regenerate();

        return redirect()->route('dashboardguru.editpassword')->with('success', 'Password berhasil diperbarui.');
    }
    public function editfoto(Request $request)
    {
        $data = $request->validate([
            'foto' => 'file',
        ]);
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->foto->store('img/fotoguru');
        } else {
            unset($data['foto']);
        }
        $user = User::find(Auth::id());
        $guru_mapel_pkl = guru_mapel_pkl::where('user_id', $user->id)->first();
        $guru_mapel_pkl->update($data);

        return redirect()->route('dashboardguru.editpassword')->with('status', 'berhasil mengubah foto profile');
    }
}
