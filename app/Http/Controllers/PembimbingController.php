<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Crypt;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use App\Exports\PembimbingExport;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\guru_mapel_pkl;
use App\Models\pembimbing;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Maatwebsite\Excel\Facades\Excel;

class PembimbingController extends Controller
{
    public function homepembimbing()
    {
        $pembimbing = pembimbing::all();
        return view('pembimbing.homepembimbing', compact('pembimbing'));
    }
    public function tambahpembimbing()
    {
        return view('pembimbing.tambahpembimbing');
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
    public function posttambahpembimbing(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'no_hp' => 'required',
            'foto' => 'required|file',
        ]);
        pembimbing::create([
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
            'foto' => $request->foto->store('img/fotoguru'),
        ]);
        $username = substr($request->nama, 0, 3) . mt_rand(10, 99); 
        $password = $this->generateNumericPassword(8);

        DB::transaction(function () use ($request, $username, $password,  ) {
            $user = User::create([
                'username' => $username, 
                'password' => bcrypt($request->no_hp), 
                'encrypted_password' => $password,
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

        toastr()->success('Data berhasil ditambahkan!');

        return redirect()->route('homepembimbing');
    }
    public function editpembimbing(pembimbing $pembimbing)
    {
        return view('pembimbing.editpembimbing', compact('pembimbing'));
    }
    public function posteditpembimbing(Request $request, pembimbing $pembimbing)
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
        guru_mapel_pkl::where('id', $pembimbing->id)->update($data);

        $pembimbing->update($data);

        toastr()->success('Data berhasil di update!');

        return redirect()->route('homepembimbing');
    }
    public function hapuspembimbing(pembimbing $pembimbing)
    {
        DB::transaction(function () use ($pembimbing) {
            // Mengambil data guru_mapel_pkl yang akan dihapus
            $gurumapel = guru_mapel_pkl::where('no_hp', $pembimbing->no_hp)->first();
    
            if ($gurumapel) {
                // Menghapus guru_mapel_pkl
                $gurumapel->delete();
    
                // Jika ada, maka hapus juga user yang sesuai
                $user = User::find($gurumapel->user_id);
                if ($user) {
                    $user->delete();
                }
            }
    
            // Hapus juga pembimbing
            $pembimbing->delete();
        });
        
        toastr()->success('Data berhasil dihapus');
        return redirect()->route('homepembimbing');
    }
    public function exportDataPembimbing()
    {
        $sheet = new Worksheet();
        $export = new PembimbingExport($sheet);
        return Excel::download($export, 'Data_Pembimbing.xlsx');
    }
    
}
