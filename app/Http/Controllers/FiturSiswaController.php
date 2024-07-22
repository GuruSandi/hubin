<?php

namespace App\Http\Controllers;

use App\Models\absensisiswa;
use App\Models\instansi;
use App\Models\membimbing;
use App\Models\menempati;
use App\Models\siswa;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
class FiturSiswaController extends Controller
{
    public function editpassword()
    {
        return view('gantipassword.changepassword');
    }
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|different:current_password|confirmed',
            'new_password_confirmation' => 'required|string|min:8|same:new_password',
        ]);

        $user = auth()->user();
        $edituser= User::where('id',$user->id)->first();
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Password yang Anda masukkan tidak sesuai dengan password lama.'])->withInput();
        }
        if ($request->new_password !== $request->new_password_confirmation) {
            return redirect()->back()->withErrors(['new_password_confirmation' => 'Konfirmasi password baru tidak cocok'])->withInput();
        }
        $edituser->update([
            'password' => bcrypt($request->new_password),
            'encrypted_password' =>$request->new_password,
        ]);
        $request->session()->regenerate();

        return redirect()->route('editpassword')->with('success', 'Password berhasil diperbarui.');
    }
    public function profilesiswa()
    {
        $user = User::find(Auth::id());
        $siswa = siswa::where('user_id', $user->id)->first();
        $menempati = Menempati::where('siswa_id', $siswa->id)->first();
        $membimbing = membimbing::where('siswa_id', $siswa->id)->first();

        return view('fiturSiswa.profilesiswa', compact('siswa','menempati','membimbing'));
    }
    public function profilegurumapel()
    {
        $user = User::find(Auth::id());
        $siswa = siswa::where('user_id', $user->id)->first();
        $membimbing = membimbing::where('siswa_id', $siswa->id)->first();

        return view('fiturSiswa.profilegurumapel', compact('membimbing'));
    }
    public function profilepembimbing()
    {
        $user = User::find(Auth::id());
        $siswa = siswa::where('user_id', $user->id)->first();
        $membimbing = membimbing::where('siswa_id', $siswa->id)->first();

        return view('fiturSiswa.profilepembimbing', compact('membimbing'));
    }
    public function dashboardsiswa()
    {

        // Ambil ID siswa yang sedang login
        $user = User::find(Auth::id());
        $siswa = siswa::where('user_id', $user->id)->first();

        $user = Auth::user();
       
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
            ->orderBy('absensisiswas.tanggal', 'desc') 
            ->limit(5)
            ->get();
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

      
        return view('fitursiswa.homesiswa', compact('siswa','jamSekarang', 'absensisiswa'));
    }
    public function tambahlokasi()
    {
        $user = Auth::user();
        $user = User::find(auth()->id());
        $siswa = $user->siswa;
        $menempati = $user->siswa->menempati->first();
        $instansi = $menempati->instansi->latitude;
        if ($instansi) {
            toastr()->error('Lokasi Instansi Sudah Ada!');
            return redirect()->route('dashboardsiswa');
        }
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
            toastr()->error('Lokasi instansi anda belum ditentukan hubungi admin!.');

            return redirect()->route('dashboardsiswa');
        }

        // Ambil data instansi yang terkait dengan siswa melalui relasi menempati
        $menempati = $user->siswa->menempati->first();

        if (!$menempati) {
            toastr()->error('Instansi yang Anda tempati belum ditentukan. Hubungi admin!');

            return redirect()->route('dashboardsiswa');
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
