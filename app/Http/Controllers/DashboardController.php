<?php

namespace App\Http\Controllers;

use App\Models\instansi;
use App\Models\menempati;
use App\Models\siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function DashboardAdmin()
    {
        $dalamkota = DB::table('menempatis')
        ->join('instansis', 'menempatis.instansi_id', '=', 'instansis.id')
        ->where('instansis.domisili', 'Sukabumi')
        ->count();
        $luarkota = DB::table('menempatis')
        ->join('instansis', 'menempatis.instansi_id', '=', 'instansis.id')
        ->where('instansis.domisili', 'Luar Kota')
        ->count();
        $siswas = siswa::all();
        $siswa_terpilih = menempati::pluck('siswa_id')->toArray();
        $siswa_tersedia = $siswas->whereNotIn('id', $siswa_terpilih);
        $belumditempatkan = $siswa_tersedia->count();
        $siswa = siswa::count();
        $dataterbaru = Menempati::latest()->limit(5)->get();

        return view('DashboardAdmin.dashboard', compact('dataterbaru','siswa', 'luarkota','dalamkota','belumditempatkan'));
    }
    public function pklluarkota()
    {
        $luarkota = DB::table('menempatis')
        ->join('instansis', 'menempatis.instansi_id', '=', 'instansis.id')
        ->join('siswas', 'menempatis.siswa_id', '=', 'siswas.id')
        ->where('instansis.domisili', 'Luar Kota')
        ->get();

        // dd($luarkota);

        return view('DashboardAdmin.pklluarkota', compact('luarkota'));
    }
    public function pkldalamkota()
    {
        $dalamkota = DB::table('menempatis')
        ->join('instansis', 'menempatis.instansi_id', '=', 'instansis.id')
        ->join('siswas', 'menempatis.siswa_id', '=', 'siswas.id')
        ->where('instansis.domisili', 'Sukabumi')
        ->get();


        return view('DashboardAdmin.pkldalamkota', compact('dalamkota'));
    }
    public function belumditempatkan()
    {
        $siswas = siswa::all();
        $siswa_terpilih = menempati::pluck('siswa_id')->toArray();
        $siswa_tersedia = $siswas->whereNotIn('id', $siswa_terpilih);
        $belumditempatkan = $siswa_tersedia;


        return view('DashboardAdmin.belumditempatkan', compact('belumditempatkan'));
    }
    public function tempatkan(siswa $siswa)
    {
        $instansi=instansi::all();
        $siswa=siswa::all();
        $siswa_terpilih = menempati::pluck('siswa_id')->toArray();
        $siswa_tersedia = $siswa->whereNotIn('id', $siswa_terpilih);
        return view('DashboardAdmin.tempatkan', compact('siswa_tersedia','instansi','siswa'));
    }
    public function setting()
    {
        
        $user = Auth::user();

        return view('DashboardAdmin.setting', compact('user'));
    }
    public function posteditprofile(Request $request, User $user)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
       
        $user->update([
            'username'=>$request->username,
            'password'=>bcrypt($request->password),
            'encrypted_password' => $request->password,
            
        ]);
        toastr()->success('Data berhasil di update!');

        return redirect()->route('setting');
    }
}
