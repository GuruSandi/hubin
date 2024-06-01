<?php

namespace App\Http\Controllers;

use App\Models\siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{

    public function homesiswa()
    {
        $totalSiswa = Siswa::count();

        // Hitung jumlah siswa per kelas
        $siswaPerKelas = Siswa::select('kelas', DB::raw('count(*) as total'))
            ->groupBy('kelas')
            ->pluck('total', 'kelas');

        // Hitung jumlah siswa per jenis kelamin
        $siswaPerJenkel = Siswa::select('jenkel', DB::raw('count(*) as total'))
            ->groupBy('jenkel')
            ->pluck('total', 'jenkel');
        $siswa = siswa::all();
        return view('siswa.homesiswa', compact('siswa', 'totalSiswa', 'siswaPerKelas', 'siswaPerJenkel'));
    }
    public function tambahsiswa()
    {
        return view('siswa.tambahsiswa');
    }
    public function posttambahsiswa(Request $request)
    {
        $request->validate([
            'nis' => 'required',
            'nama' => 'required',
            'jenkel' => 'required',
            'kelas' => 'required',
            'tahun_ajar' => 'required',
        ]);
       
        DB::transaction(function () use ($request) {
            // Membuat data pengguna (user) terkait
            $user = User::create([
                'username' => $request->nis, // Atau gunakan informasi lain yang sesuai
                'password' => bcrypt($request->nis), // Sesuaikan dengan kebutuhan Anda
                'role' => 'siswa',
                // Tambahkan kolom lain yang sesuai dengan kebutuhan Anda
            ]);
    
            // Membuat data siswa dengan menetapkan user_id yang baru dibuat
            $siswa = Siswa::create([
                'user_id' => $user->id,
                'nis' => $request->nis,
                'nama' => $request->nama,
                'jenkel' => $request->jenkel,
                'kelas' => $request->kelas,
                'tahun_ajar' => $request->tahun_ajar,
            ]);
        });
    
        return redirect()->route('homesiswa')->with('status', 'Berhasil Menambah data');
    }
    public function editsiswa(siswa $siswa)
    {
        return view('siswa.editsiswa', compact('siswa'));
    }
    public function posteditsiswa(Request $request, siswa $siswa)
    {
        $data =  $request->validate([
            'nis' => 'required',
            'nama' => 'required',
            'jenkel' => 'required',
            'kelas' => 'required',
            'tahun_ajar' => 'required',
        ]);

        $siswa->update($data);

        return redirect()->route('homesiswa')->with('status', 'Berhasil Mengedit data');
    }
    public function hapussiswa(siswa $siswa)
    {
        $siswa->delete();

        return redirect()->route('homesiswa')->with('status', 'Berhasil Menghapus data');
    }
}
