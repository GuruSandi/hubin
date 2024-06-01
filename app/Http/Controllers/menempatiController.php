<?php

namespace App\Http\Controllers;

use App\Models\datapenempatan;
use App\Models\instansi;
use App\Models\menempati;
use App\Models\siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class menempatiController extends Controller
{
   
    public function homemenempati()
    {
        $menempati = menempati::all();
        $menempatis_sorted = $menempati->sortBy('instansi');
        return view('menempati.homemenempati', compact('menempatis_sorted'));
    }
    public function tambahmenempati()
    {
        $instansi=instansi::all();
        $siswa=siswa::all();
        $siswa_terpilih = menempati::pluck('siswa_id')->toArray();
        $siswa_tersedia = $siswa->whereNotIn('id', $siswa_terpilih);
        return view('menempati.tambahmenempati', compact('siswa_tersedia','instansi'));
    }
    public function posttambahmenempati(Request $request)
    {
        $request->validate([
            'siswa_ids' => 'required|array',
            'instansi_id' => 'required|exists:instansis,id',
        ]);
        foreach ($request->siswa_ids as $siswaId) {
            Menempati::create([
                'siswa_id' => $siswaId,
                'instansi_id' => $request->instansi_id,
                'user_id' => Auth::id(),
            ]);
        }
        // $menempatiIds = menempati::latest()->pluck('id');
        // foreach ($menempatiIds as $menempatiId) {
        //     datapenempatan::create([
        //         'menempati_id' =>$menempatiId,
        //         'user_id' => Auth::id(),
        //     ]);
        // }
        
        return redirect()->route('homemenempati')->with('status', 'Berhasil Menambah data');
    }
    public function editmenempati(menempati $menempati)
    {
        $siswa = siswa::all();
        $instansi = instansi::all();
        $selectinstansi = $menempati->instansi_id;
        $selectsiswa = $menempati->siswa_id;
        return view('menempati.editmenempatisatu', compact('menempati','siswa','instansi','selectinstansi','selectsiswa'));
    }
   
   
    public function posteditmenempati(Request $request, menempati $menempati)
    {
        $data=$request->validate([
            'siswa_id' => 'required',
            'instansi_id' => 'required',
        ]);
        $menempati->update($data);
        // $dataPenempatan = DataPenempatan::where('instansi_id', $request->instansi_id)->first();
        // $dataPenempatan->update([
        //     'user_id' => Auth::id(),
        //     'instansi_id' => $request->instansi_id,
        //     'siswa_id' => $request->siswa_id,
        // ]);
        return redirect()->route('homemenempati')->with('status', 'Berhasil Mengedit data');
    }
    public function hapusmenempati(menempati $menempati)
    {
        // $dataPenempatan = DataPenempatan::where('instansi_id', $menempati->instansi_id)
        // ->where('siswa_id', $menempati->siswa_id)
        // ->first();

        // if ($dataPenempatan) {
        //     $dataPenempatan->delete();
        // }
        $menempati->delete();
      
        return redirect()->route('homemenempati')->with('status', 'Berhasil Menghapus data');
    }
}
