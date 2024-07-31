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
    public function generateNumericPassword($length = 8)
    {
        $chars = '0123456789';
        $password = '';

        for ($i = 0; $i < $length; $i++) {
            $password .= $chars[rand(0, strlen($chars) - 1)];
        }

        return $password;
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
        $password = $this->generateNumericPassword(8);


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
        $user = User::find($siswa->user_id);
        if ($user) {
            $user->delete();
        }
        $siswa->delete();
        toastr()->success('Data berhasil dihapus');

        return redirect()->route('homesiswa');
    }
    public function siswadelete(Request $request)
    {
        $ids = $request->input('ids');

        if (!is_array($ids) || count($ids) == 0) {
            return response()->json(['success' => false, 'message' => 'No IDs provided.']);
        }

        try {
            // Mengambil semua siswa yang akan dihapus
            $siswaRecords = Siswa::whereIn('id', $ids)->get();

            // Menghapus data user yang terkait
            foreach ($siswaRecords as $siswa) {
                if ($siswa->user) {
                    $siswa->user->delete();
                }
            }

            // Menghapus data siswa
            Siswa::whereIn('id', $ids)->delete();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function exportDataSiswa()
    {
        return Excel::download(new SiswaExport, 'data_siswa.xlsx');
    }
}
