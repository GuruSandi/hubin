<?php

namespace App\Http\Controllers;

use App\Models\absensisiswa;
use App\Models\instansi;
use App\Models\menempati;
use App\Models\siswa;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FiturSiswaController extends Controller
{
    public function dashboardsiswa()
    {

        // Ambil ID siswa yang sedang login
        $user = User::find(Auth::id());
        $siswa = siswa::where('user_id', $user->id)->first();

        $user = Auth::user();
        $bulanIndonesia = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember'
        ];
        $siswa = siswa::where('user_id', $user->id)->first();
        date_default_timezone_set('Asia/Jakarta');
        Carbon::setLocale('id_ID');
        $jamSekarang = Carbon::now()->format('H.i');
        $absensisiswa = AbsensiSiswa::where('absensisiswas.user_id', $user->id)
            ->select('absensisiswas.tanggal', 'absensisiswas.jam_masuk', 'absensisiswas.jam_pulang', 'jurnals.deskripsi_jurnal',  'jurnals.validasi', 'jurnals.id')
            ->leftJoin('jurnals', function ($join) {
                $join->on('absensisiswas.user_id', '=', 'jurnals.user_id')
                    ->whereDate('jurnals.created_at', '=', DB::raw('DATE(absensisiswas.tanggal)'));
            })
            ->orderBy('absensisiswas.tanggal', 'desc')  // Mengurutkan berdasarkan tanggal descending
            ->limit(5)
            ->get();
        //  $absensisiswa = AbsensiSiswa::where('user_id', $user->id)->get();
        foreach ($absensisiswa as $item) {
            $item->tanggal = Carbon::parse($item->tanggal)->translatedFormat('l, j F Y');
            $item->jam_masuk = Carbon::parse($item->jam_masuk)->format('H.i');
        
            // Periksa jika jam_pulang tidak kosong sebelum memformatnya
            if ($item->jam_pulang) {
                $item->jam_pulang = Carbon::parse($item->jam_pulang)->format('H.i');
            } else {
                $item->jam_pulang = 'Belum Absen Pulang'; 
            }
        }

        $tanggal = date('d');
        $bulan = $bulanIndonesia[date('m')];
        $tahun = date('Y');
        $siswa = siswa::where('user_id', $user->id)->first();
        // Mendapatkan data absensi berdasarkan user_id siswa yang sedang login
        // $absensisiswa = AbsensiSiswa::where('user_id', $user->id)->get();

        $hadir = $absensisiswa->where('keterangan', 'hadir')->count();
        $libur = $absensisiswa->where('keterangan', 'libur')->count();
        $absen = $absensisiswa->where('keterangan', 'absen')->count();
        // Dapatkan data siswa berdasarkan ID
        return view('fitursiswa.homesiswa', compact('siswa','jamSekarang', 'absensisiswa', 'hadir', 'libur', 'absen', 'tanggal', 'bulan', 'tahun'));
    }
    public function tambahlokasi()
    {
        $user = Auth::user();


        $user = User::find(auth()->id());

        // Ambil siswa terkait dari user
        $siswa = $user->siswa;
        return view('fitursiswa.tambahlokasi', compact('siswa'));
    }
    public function simpanlokasi(Request $request)
    {
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        // Ambil data siswa yang sedang login
        $user = Auth::user();

        // Periksa apakah siswa sudah memiliki lokasi instansi
        if (!$user->siswa) {
            return redirect()->route('dashboardsiswa')->with('error', 'Lokasi instansi anda belum ditentukan hubungi admin!.');
        }

        // Ambil data instansi yang terkait dengan siswa melalui relasi menempati
        $menempati = $user->siswa->menempati->first();

        if (!$menempati) {
            return redirect()->route('dashboardsiswa')->with('error', 'Anda belum ditentukan sebagai bagian dari suatu instansi. Hubungi admin!');
        }

        // Ambil instansi terkait dari relasi menempati
        $instansi = $menempati->instansi;

        // Update lokasi instansi
        $instansi->update([
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        return redirect()->route('dashboardsiswa')->with('status', 'Lokasi instansi berhasil disimpan.');
    }
}
