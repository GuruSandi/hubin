<?php

namespace App\Http\Controllers;

use App\Models\absensisiswa;
use App\Models\jurnal;
use App\Models\membimbing;
use App\Models\menempati;
use App\Models\siswa;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AbsenController extends Controller
{
    public function absensipulang()
    {
        $siswa = Siswa::where('user_id', auth()->id())->first();

        $absensiHariIni = AbsensiSiswa::where('user_id', $siswa->user_id)
            ->whereDate('created_at', Carbon::today())
            ->first();
        if (!empty($absensiHariIni->jam_pulang)) {
            // Jika sudah ada jam pulang, redirect ke route 'tambahabsensipulang' dengan parameter $absensiHariIni->id
            return redirect()->route('editabsensipulang', $absensiHariIni->id);
        } else {
            // Jika belum ada jam pulang, tampilkan pesan kesalahan atau lakukan hal lainnya
            // Misalnya, tampilkan pesan kesalahan
            return redirect()->route('tambahabsensipulang', $absensiHariIni->id);
        }


        toastr()->warning('Anda belum Melakukan Absensi Datang');
    }

    public function tambahabsensipulang($id)
    {
        $absensisiswa = absensisiswa::findOrFail($id);
        date_default_timezone_set('Asia/Jakarta');
        Carbon::setLocale('id_ID');
        $jam= Carbon::now();
        $tanggal = Carbon::parse($absensisiswa->tanggal)->translatedFormat('l, j F Y');
        $jamsekarang = Carbon::parse($jam)->format('H.i');
        return view('absensi.absensipulang', compact('absensisiswa','tanggal','jamsekarang'));
    }

    public function postabsensipulang(Request $request, $id)
    {
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'keterangan' => 'required',
            'deskripsi_jurnal' => 'required',
        ]);
        $siswa = Siswa::where('user_id', auth()->id())->first();
        $menempati = menempati::where('siswa_id', $siswa->id)->first();
        $membimbing = membimbing::where('siswa_id', $siswa->id)->first();
        $gurumapel = $membimbing->guru_mapel_pkl_id;
        $instansi = $menempati->instansi;

        $jarak_meter = $this->haversineDistance($request->latitude, $request->longitude, $instansi->latitude, $instansi->longitude);
        $jarak_formatted = '';

        if ($jarak_meter < 1000) {
            $jarak_formatted = round($jarak_meter) . ' Meter';
        } else {
            $jarak_formatted = round($jarak_meter / 1000, 2) . ' KM';
        }
         date_default_timezone_set('Asia/Jakarta');
        Carbon::setLocale('id_ID');
        $jamSekarang = Carbon::now();
        $tanggalSekarang = Carbon::now();
        jurnal::create([
            'user_id' => Auth::id(),
            'guru_mapel_pkl_id' => $gurumapel,
            'siswa_id' => $siswa->id,
            'deskripsi_jurnal' => $request->deskripsi_jurnal,
            'validasi' => 'belum_tervalidasi',
            'tanggal' => $tanggalSekarang,

        ]);
       
        $absensisiswa = absensisiswa::findOrFail($id);
        $absensisiswa->update([
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'keterangan' => $request->keterangan,
            'jarak' => $jarak_formatted,
            'jam_pulang' => $jamSekarang,
        ]);



        return redirect()->route('dashboardsiswa')->with('status', 'Berhasil Mengupdate absensi.');
    }

    public function editabsensipulang($id)
    {
        $absensisiswa = absensisiswa::findOrFail($id);
        date_default_timezone_set('Asia/Jakarta');
        Carbon::setLocale('id_ID');
        $tanggal = Carbon::parse($absensisiswa->tanggal)->translatedFormat('l, j F Y');
        $jam_pulang = Carbon::parse($absensisiswa->jam_pulang)->format('H.i');
        return view('absensi.editabsensipulang', compact('absensisiswa','tanggal','jam_pulang'));
    }

    public function posteditabsensipulang(Request $request, $id)
    {
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'keterangan' => 'required',
        ]);
        $siswa = Siswa::where('user_id', auth()->id())->first();
        $menempati = menempati::where('siswa_id', $siswa->id)->first();
        $membimbing = membimbing::where('siswa_id', $siswa->id)->first();
        $gurumapel = $membimbing->guru_mapel_pkl_id;
        $instansi = $menempati->instansi;

        $jarak_meter = $this->haversineDistance($request->latitude, $request->longitude, $instansi->latitude, $instansi->longitude);
        $jarak_formatted = '';

        if ($jarak_meter < 1000) {
            $jarak_formatted = round($jarak_meter) . ' Meter';
        } else {
            $jarak_formatted = round($jarak_meter / 1000, 2) . ' KM';
        }

        date_default_timezone_set('Asia/Jakarta');
        Carbon::setLocale('id_ID');
        $jamSekarang = Carbon::now();
        $absensisiswa = absensisiswa::findOrFail($id);
        $absensisiswa->update([
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'keterangan' => $request->keterangan,
            'jarak' => $jarak_formatted,
            'jam_pulang' => $jamSekarang,
        ]);



        return redirect()->route('dashboardsiswa')->with('status', 'Berhasil Mengupdate absensi.');
    }

    public function jurnal()
    {
        date_default_timezone_set('Asia/Jakarta');
        Carbon::setLocale('id_ID');
        $user=Auth::user();
        $jurnal = jurnal::where('user_id', $user->id)->get();
        foreach ($jurnal as $item) {
            $item->tanggal = Carbon::parse($item->tanggal)->translatedFormat('l, j F Y');

        }
       
       

        return view('jurnal.jurnal', compact('jurnal'));
    }
    public function editjurnal($id)
    {
        $jurnal = Jurnal::findOrFail($id);
        date_default_timezone_set('Asia/Jakarta');
        Carbon::setLocale('id_ID');
        $tanggal = Carbon::parse($jurnal->tanggal)->translatedFormat('l, j F Y');
        if ($jurnal->user_id != auth()->user()->id) {
            abort(403, 'Unauthorized action.');
        }

        return view('jurnal.editjurnal', compact('jurnal','tanggal'));
    }
    public function updatejurnal(Request $request, $id)
{
    $request->validate([
        'deskripsi_jurnal' => 'required', 
    ]);

    $jurnal = jurnal::findOrFail($id);

    if ($jurnal->user_id != auth()->user()->id) {
        abort(403, 'Unauthorized action.');
    }

    $jurnal->deskripsi_jurnal = $request->deskripsi_jurnal;
    $jurnal->save();

    return redirect()->route('dashboardsiswa')->with('success', 'Jurnal berhasil diperbarui.');
}


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
        date_default_timezone_set('Asia/Jakarta');
        Carbon::setLocale('id_ID');
        
        $absensiSiswa = AbsensiSiswa::where('user_id', $user->id)->get();
        $absensisiswa = AbsensiSiswa::where('absensisiswas.user_id', $user->id)
            ->select('absensisiswas.tanggal', 'absensisiswas.jam_masuk', 'absensisiswas.jam_pulang', 'jurnals.deskripsi_jurnal',  'jurnals.validasi', 'jurnals.id')
            ->leftJoin('jurnals', function ($join) {
                $join->on('absensisiswas.user_id', '=', 'jurnals.user_id')
                    ->whereDate('jurnals.created_at', '=', DB::raw('DATE(absensisiswas.tanggal)'));
            })
            ->get();
        //  $absensisiswa = AbsensiSiswa::where('user_id', $user->id)->get();
        foreach ($absensisiswa as $item) {
            $item->tanggal = Carbon::parse($item->tanggal)->translatedFormat('l, j F Y');
            $item->jam_masuk = Carbon::parse($item->jam_masuk)->format('H.i');
            $item->jam_pulang = Carbon::parse($item->jam_pulang)->format('H.i');
        }
        $hadir = $absensisiswa->where('keterangan', 'hadir')->count();
        $libur = $absensisiswa->where('keterangan', 'libur')->count();
        $absen = $absensisiswa->where('keterangan', 'absen')->count();

        return view('absensi.homeabsen', compact('absensisiswa', 'hadir', 'libur', 'siswa', 'absen', 'tanggal', 'bulan', 'tahun'));
    }

    public function absensi()
    {
        $siswa = Siswa::where('user_id', auth()->id())->first();
        date_default_timezone_set('Asia/Jakarta');
        Carbon::setLocale('id_ID');
        $tanggal= Carbon::now();
        $jam= Carbon::now();
        $tanggalsekarang = Carbon::parse($tanggal)->translatedFormat('l, j F Y');
        $jamsekarang = Carbon::parse($jam)->format('H.i');
        $absensiHariIni = AbsensiSiswa::where('user_id', $siswa->user_id)
            ->whereDate('created_at', Carbon::today())
            ->first();

        if ($absensiHariIni) {
            // Jika sudah, tampilkan pesan kesalahan
            return redirect()->route('editabsensi', $absensiHariIni->id);
        }
        return view('absensi.absensiswa', compact('tanggalsekarang','jamsekarang'));
    }
    public function postabsensi(Request $request)
    {
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'keterangan' => 'required',
        ]);

        $user = User::find(auth()->id());

        // Find the student based on user_id
        $siswa = Siswa::where('user_id', auth()->id())->first();

        if (!$siswa) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk melakukan absensi.');
        }

        // Find the placement of the student
        $menempati = Menempati::where('siswa_id', $siswa->id)->first();

        if (!$menempati) {
            return redirect()->back()->with('error', 'Anda belum di tempatkan di Instansi manapun. Silahkan hubungi admin!.');
        }

        // Ensure institution's location is set and valid
        if (!$siswa->menempati()->exists() || !$siswa->menempati()->first()->instansi || is_null($siswa->menempati()->first()->instansi->latitude) || is_null($siswa->menempati()->first()->instansi->longitude)) {
            return redirect()->route('tambahlokasi')->with('warning', 'Anda belum menambahkan lokasi instansi. Silakan tambahkan lokasi instansi terlebih dahulu.');
        }

        // Get institution details
        $instansi = $menempati->instansi;

        $jarak_meter = $this->haversineDistance($request->latitude, $request->longitude, $instansi->latitude, $instansi->longitude);
        $jarak_formatted = '';

        if ($jarak_meter < 1000) {
            $jarak_formatted = round($jarak_meter) . ' Meter';
        } else {
            $jarak_formatted = round($jarak_meter / 1000, 2) . ' KM';
        }
        date_default_timezone_set('Asia/Jakarta');
        Carbon::setLocale('id_ID'); 
        $jamSekarang = Carbon::now();
        $tanggalSekarang = Carbon::now();
        absensisiswa::create([
            'user_id' => auth()->id(),
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'keterangan' => $request->keterangan,
            'jarak' => $jarak_formatted,
            'jam_masuk' => $jamSekarang,
            'tanggal' => $tanggalSekarang,
        ]);


        return redirect()->route('dashboardsiswa')->with('status', 'Berhasil Melakukan Absen.');
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
        date_default_timezone_set('Asia/Jakarta');
        Carbon::setLocale('id_ID');
        $tanggal = Carbon::parse($absensisiswa->tanggal)->translatedFormat('l, j F Y');
        $jam_masuk = Carbon::parse($absensisiswa->jam_masuk)->format('H.i');

        return view('absensi.editabsensi', compact('absensisiswa','tanggal','jam_masuk'));
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

        $jarak_meter = $this->haversineDistance($request->latitude, $request->longitude, $instansi->latitude, $instansi->longitude);
        $jarak_formatted = '';

        if ($jarak_meter < 1000) {
            $jarak_formatted = round($jarak_meter) . ' Meter';
        } else {
            $jarak_formatted = round($jarak_meter / 1000, 2) . ' KM';
        }
        $absensisiswa = absensisiswa::findOrFail($id);

        $absensisiswa->update([
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'keterangan' => $request->keterangan,
            'jarak' => $jarak_formatted,
        ]);



        return redirect()->route('dashboardsiswa')->with('status', 'Berhasil Mengupdate absensi.');
    }



    // public function admineditabsensi($id)
    // {
    //     $absensisiswa = absensisiswa::findOrFail($id);
    //     return view('absensi.admineditabsensi', compact('absensisiswa'));
    // }

    // public function adminabsensi(Request $request, $id)
    // {
    //     $request->validate([
    //         'latitude' => 'required|numeric',
    //         'longitude' => 'required|numeric',
    //         'keterangan' => 'required',
    //     ]);
    //     // Dapatkan entri menempati yang sesuai

    //     $absensisiswa = absensisiswa::findOrFail($id);
    //     $absensisiswa->update([
    //         'latitude' => $request->latitude,
    //         'longitude' => $request->longitude,
    //         'keterangan' => $request->keterangan
    //     ]);

    //     return redirect()->route('homeabsen')->with('status', 'Berhasil Mengupdate absensi.');
    // }

    // public function deleteabsensi($id)
    // {
    //     $absensisiswa = absensisiswa::findOrFail($id);
    //     $absensisiswa->delete();

    //     return redirect()->route('homeabsen')->with('status', 'Berhasil Hapus absensi.');
    // }
}
