<?php

namespace App\Http\Controllers;

use App\Exports\MenempatiExport;
use App\Models\datapenempatan;
use App\Models\instansi;
use App\Models\menempati;
use App\Models\siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

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
        toastr()->success('Data berhasil ditambahkan!');
        return redirect()->route('homemenempati');
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
        toastr()->success('Data berhasil di update!');

        return redirect()->route('homemenempati');
    }
    public function hapusmenempati(menempati $menempati)
    {
       
        $menempati->delete();
        toastr()->success('Data berhasil dihapus');
        
        return redirect()->route('homemenempati');
    }
    public function menempatidelete(Request $request)
    {
        $ids = $request->input('ids');

        if (!is_array($ids) || count($ids) == 0) {
            return response()->json(['success' => false, 'message' => 'No IDs provided.']);
        }

        try {
            menempati::whereIn('id', $ids)->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
    public function exportDataMenempati()
    {
            return Excel::download(new MenempatiExport, 'data_menempati.xlsx');
    }
}
