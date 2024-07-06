<?php

namespace App\Http\Controllers;

use App\Exports\GuruMapelPklExport;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\guru_mapel_pkl;
use App\Models\pembimbing;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class GuruMapelController extends Controller
{
    public function homegurumapel()
    {
        $gurumapel = guru_mapel_pkl::all();
        return view('guru_mapel.homegurumapel', compact('gurumapel'));
    }
   
    public function posttambahgurumapel(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'no_hp' => 'required',
            'foto' => 'required|file',
        ]);
        $username = substr($request->nama, 0, 3) . mt_rand(10, 99); // Generate username
        $password = Str::random(8); // Generate password
        DB::transaction(function () use ($request, $username, $password,  ) {
            // Membuat data pengguna (user) terkait
            $user = User::create([
                'username' => $username, // Atau gunakan informasi lain yang sesuai
                'password' => bcrypt($request->no_hp), // Sesuaikan dengan kebutuhan Anda
                'role' => 'guru',
            ]);

            guru_mapel_pkl::create([
                'user_id' => $user->id,
                'nama' => $request->nama,
                'nip' => $request->nip,
                'no_hp' => $request->no_hp,
                'foto' => $request->foto->store('img/fotoguru'),
            ]);
            // $nama = $request->nama;
            // $pdf = FacadePdf::loadView('pembimbing.akun', compact('nama','username', 'password'));
            // $pdf->save(public_path('dataakun/akun.pdf'));
        });
        pembimbing::create([
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
            'foto' => $request->foto->store('img/fotoguru'),
        ]);
       

        toastr()->success('Data berhasil ditambahkan!');

        return redirect()->route('homegurumapel');
    }
    
    public function posteditgurumapel(Request $request, guru_mapel_pkl $gurumapel)
    {
        $data =  $request->validate([
            'nama' => 'required',
            'no_hp' => 'required',
            'foto' => 'file',
        ]);
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->foto->store('img/fotoguru');
        } else {
            unset($data['foto']);
        }
        pembimbing::where('id', $gurumapel->id)->update($data);

        $gurumapel->update($data);

        toastr()->success('Data berhasil di update!');

        return redirect()->route('homegurumapel');
    }
    public function hapusgurumapel(guru_mapel_pkl $gurumapel)
    {
        $pembimbing = pembimbing::where('no_hp', $gurumapel->no_hp)->first();
        $pembimbing->delete();

        DB::transaction(function () use ($gurumapel) {
            // Mengambil data guru_mapel_pkl yang akan dihapus
            $gurumapel = guru_mapel_pkl::where('no_hp', $gurumapel->no_hp)->first();
    
            if ($gurumapel) {
                // Menghapus guru_mapel_pkl
                $gurumapel->delete();
    
                // Jika ada, maka hapus juga user yang sesuai
                $user = User::find($gurumapel->user_id);
                if ($user) {
                    $user->delete();
                }
            }
           
        });
        
        toastr()->success('Data berhasil dihapus');
        return redirect()->route('homegurumapel');
    }
    public function exportDataGuruMapelPkl()
    {
        $sheet = new Worksheet();
        $export = new GuruMapelPklExport($sheet);
        return Excel::download($export, 'Data_GuruMapelPkl.xlsx');
    }
}
