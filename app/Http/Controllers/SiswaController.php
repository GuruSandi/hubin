<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Crypt;
use App\Exports\SiswaExport;
use App\Models\siswa;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

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
        $password = Str::random(8); 
       
        DB::transaction(function () use ($request,  $password) {
            // Membuat data pengguna (user) terkait
            $user = User::create([
                'username' => $request->nis,
                'password' => bcrypt($password),
                'encrypted_password' => $password,
                'role' => 'siswa',
            ]);
    
            // Membuat data siswa dengan menetapkan user_id yang baru dibuat
            Siswa::create([
                'user_id' => $user->id,
                'nis' => $request->nis,
                'nama' => $request->nama,
                'jenkel' => $request->jenkel,
                'kelas' => $request->kelas,
                'tahun_ajar' => $request->tahun_ajar,
            ]);
        });
        toastr()->success('Data berhasil ditambahkan!');
    
        return redirect()->route('homesiswa');
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
        toastr()->success('Data berhasil di update!');
        return redirect()->route('homesiswa');
    }
    public function hapussiswa(siswa $siswa)
    {
        $siswa->delete();
        toastr()->success('Data berhasil dihapus');

        return redirect()->route('homesiswa');
    }
    public function exportDataSiswa()
    {
        return Excel::download(new SiswaExport, 'data_siswa.xlsx');
    }
}
