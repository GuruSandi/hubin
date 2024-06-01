<?php

namespace App\Http\Controllers;

use App\Models\absensisiswa;
use App\Models\menempati;
use App\Models\siswa;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsenController extends Controller
{
    public function homeabsen()
    {
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
    
        $tanggal = date('d');
        $bulan = $bulanIndonesia[date('m')];
        $tahun = date('Y');
        $siswa = siswa::where('user_id', $user->id)->first();
        // Mendapatkan data absensi berdasarkan user_id siswa yang sedang login
        $absensisiswa = AbsensiSiswa::where('user_id', $user->id)->get();

        $hadir = $absensisiswa->where('keterangan', 'hadir')->count();
        $libur = $absensisiswa->where('keterangan', 'libur')->count();
        $absen = $absensisiswa->where('keterangan', 'absen')->count();

        return view('absensi.homeabsen', compact('absensisiswa', 'hadir', 'libur','siswa','absen','tanggal','bulan','tahun'));
    }

    public function absensi()
    {
        $siswa = Siswa::where('user_id', auth()->id())->first();

        $absensiHariIni = AbsensiSiswa::where('user_id', $siswa->user_id)
            ->whereDate('created_at', Carbon::today())
            ->first();

        if ($absensiHariIni) {
            // Jika sudah, tampilkan pesan kesalahan
            return redirect()->route('editabsensi', $absensiHariIni->id);
        }
        return view('absensi.absensiswa');
    }

    public function postabsensi(Request $request)
    {
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'keterangan' => 'required',
        ]);

        $user = User::find(auth()->id());

        // Ambil siswa terkait dari user
       
        // Temukan siswa yang sedang melakukan absensi berdasarkan user_id
        $siswa = Siswa::where('user_id', auth()->id())->first();

        if (!$siswa) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk melakukan absensi.');
        }
        // $absensiHariIni = AbsensiSiswa::where('user_id', $siswa->user_id)
        //     ->whereDate('created_at', Carbon::today())
        //     ->first();

        // if ($absensiHariIni) {
        //     // Jika sudah, tampilkan pesan kesalahan
        //     return redirect()->route('editabsensi', $absensiHariIni->id)->with('error', 'Anda sudah melakukan absensi hari ini.');
        // }
        // Dapatkan entri menempati yang sesuai
        $menempati = menempati::where('siswa_id', $siswa->id)->first();

        if (!$menempati) {
            return redirect()->back()->with('error', 'Anda belum di tempatkan di Instansi manapun. Silahkan hubungi admin!.');
        }
        $siswa = $user->siswa;
        if (!$siswa->menempati()->exists() || !$siswa->menempati()->first()->instansi || is_null($siswa->menempati()->first()->instansi->latitude) || is_null($siswa->menempati()->first()->instansi->longitude)) {
            return redirect()->route('tambahlokasi')->with('warning', 'Anda belum menambahkan lokasi instansi. Silakan tambahkan lokasi instansi terlebih dahulu.');
        }
        // Dapatkan instansi yang terkait
        $instansi = $menempati->instansi;


        if ($request->keterangan == 'libur') {
            // Simpan data absensi
            AbsensiSiswa::create([
                'user_id' => auth()->id(),
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'keterangan' => $request->keterangan
            ]);

            return redirect()->route('homeabsen')->with('status', 'Berhasil Melakukan Absen.');
        }

        // Hitung jarak antara lokasi siswa dengan lokasi instansi menggunakan rumus Haversine
        $jarak = $this->haversineDistance($request->latitude, $request->longitude, $instansi->latitude, $instansi->longitude);

        // Tentukan ambang batas jarak (misalnya, 100 meter)
        $ambangBatas =  0.5; // Anda dapat menyesuaikan ambang batas sesuai kebutuhan

        // Periksa apakah siswa berada dalam jarak yang diizinkan dari instansi
        if ($jarak <= $ambangBatas) {
            // Jika iya, simpan data absensi
            AbsensiSiswa::create([
                'user_id' => auth()->id(),
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'keterangan' => $request->keterangan
            ]);

            return redirect()->route('homeabsen')->with('status', 'Berhasil Melakukan Absen.');
        } else {
            // Jika tidak, beri pesan kesalahan
            return redirect()->back()->with('error', 'Anda tidak berada dalam jarak yang diizinkan dari instansi.');
        }
    }
    private function haversineDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371; // Radius bumi dalam kilometer

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) * sin($dLat / 2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon / 2) * sin($dLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        $distance = $earthRadius * $c;

        return $distance;
    }



    public function editabsensi($id)
    {
        $absensisiswa = absensisiswa::findOrFail($id);
        return view('absensi.editabsensi', compact('absensisiswa'));
    }

    public function updateabsensi(Request $request, $id)
    {
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'keterangan' => 'required',
        ]);
        $siswa = Siswa::where('user_id', auth()->id())->first();

        // Dapatkan entri menempati yang sesuai
        $menempati = menempati::where('siswa_id', $siswa->id)->first();

        // Dapatkan instansi yang terkait
        $instansi = $menempati->instansi;


        if ($request->keterangan == 'libur') {
            // Simpan data absensi
            $absensisiswa = absensisiswa::findOrFail($id);
            $absensisiswa->update([
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'keterangan' => $request->keterangan
            ]);


            return redirect()->route('homeabsen')->with('status', 'Berhasil Melakukan Absen.');
        }

        // Hitung jarak antara lokasi siswa dengan lokasi instansi menggunakan rumus Haversine
        $jarak = $this->haversineDistance($request->latitude, $request->longitude, $instansi->latitude, $instansi->longitude);

        // Tentukan ambang batas jarak (misalnya, 100 meter)
        $ambangBatas =  0.3; // Anda dapat menyesuaikan ambang batas sesuai kebutuhan

        // Periksa apakah siswa berada dalam jarak yang diizinkan dari instansi
        if ($jarak <= $ambangBatas) {
            // Jika iya, simpan data absensi
            $absensisiswa = absensisiswa::findOrFail($id);
            $absensisiswa->update([
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'keterangan' => $request->keterangan
            ]);

            return redirect()->route('homeabsen')->with('status', 'Berhasil Melakukan Absen.');
        } else {
            // Jika tidak, beri pesan kesalahan
            return redirect()->back()->with('error', 'Anda tidak berada dalam jarak yang diizinkan dari instansi.');
        }


        return redirect()->route('homeabsen')->with('status', 'Berhasil Mengupdate absensi.');
    }
    public function admineditabsensi($id)
    {
        $absensisiswa = absensisiswa::findOrFail($id);
        return view('absensi.admineditabsensi', compact('absensisiswa'));
    }

    public function adminabsensi(Request $request, $id)
    {
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'keterangan' => 'required',
        ]);
        // Dapatkan entri menempati yang sesuai
       
            $absensisiswa = absensisiswa::findOrFail($id);
            $absensisiswa->update([
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'keterangan' => $request->keterangan
            ]);

        return redirect()->route('homeabsen')->with('status', 'Berhasil Mengupdate absensi.');
    }

    public function deleteabsensi($id)
    {
        $absensisiswa = absensisiswa::findOrFail($id);
        $absensisiswa->delete();

        return redirect()->route('homeabsen')->with('status', 'Berhasil Hapus absensi.');
    }
}
