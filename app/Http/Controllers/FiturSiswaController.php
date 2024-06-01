<?php

namespace App\Http\Controllers;

use App\Models\absensisiswa;
use App\Models\instansi;
use App\Models\menempati;
use App\Models\siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FiturSiswaController extends Controller
{
    public function dashboardsiswa()
    {

        // Ambil ID siswa yang sedang login
        $user = User::find(Auth::id());
        $siswa = siswa::where('user_id', $user->id)->first();

        $absensisiswa = absensisiswa::where('user_id', $user->id)->get();
        
        // Dapatkan data siswa berdasarkan ID
        return view('fitursiswa.homesiswa', compact('siswa', 'absensisiswa'));
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
