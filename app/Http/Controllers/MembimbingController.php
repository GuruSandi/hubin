<?php

namespace App\Http\Controllers;

use App\Exports\MembimbingExport;
use App\Models\instansi;
use App\Models\guru_mapel_pkl;
use App\Models\membimbing;
use App\Models\pembimbing;
use App\Models\siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
class MembimbingController extends Controller
{
    public function homemembimbing()
    {
        
        $membimbing = membimbing::all();
        
        $membimbing_sorted = $membimbing->sortBy('pembimbing');
        return view('membimbing.homemembimbing', compact('membimbing_sorted'));
    }
    public function tambahmembimbing()
    {
        $pembimbing=pembimbing::all();
        $gurumapel=guru_mapel_pkl::all();
        $siswa=siswa::all();
        $siswa_terpilih = membimbing::pluck('siswa_id')->toArray();
        $siswa_tersedia = $siswa->whereNotIn('id', $siswa_terpilih);
        return view('membimbing.tambahmembimbing', compact('siswa_tersedia','pembimbing','gurumapel'));
    }
    public function posttambahmembimbing(Request $request)
    {
        $request->validate([
            'siswa_ids' => 'required|array',
            'pembimbing_id' => 'required|exists:pembimbings,id',
            'guru_mapel_pkl_id' => 'required|exists:guru_mapel_pkls,id',
        ]);
        foreach ($request->siswa_ids as $siswaId) {
            membimbing::create([
                'siswa_id' => $siswaId,
                'pembimbing_id' => $request->pembimbing_id,
                'guru_mapel_pkl_id' => $request->guru_mapel_pkl_id,
                'user_id' => Auth::id(),
            ]);
        }
        toastr()->success('Data berhasil ditambahkan!');
        
        return redirect()->route('homemembimbing');
    }
    public function editmembimbing(membimbing $membimbing)
    {
        $pembimbing = pembimbing::all();
        $gurumapel = guru_mapel_pkl::all();
        $siswa = siswa::all();
        $selectsiswa = $membimbing->siswa_id;
        $selectpembimbing = $membimbing->pembimbing_id;
        $selectgurumapel = $membimbing->guru_mapel_pkl_id;
        return view('membimbing.editmembimbingsatu', compact('selectgurumapel','membimbing','pembimbing','siswa','selectsiswa','selectpembimbing','gurumapel'));
    }
   
   
    public function posteditmembimbing(Request $request, membimbing $membimbing)
    {
        $data=$request->validate([
            'pembimbing_id' => 'required',
            'guru_mapel_pkl_id' => 'required',
            'siswa_id' => 'required',
        ]);
        $membimbing->update($data);
        toastr()->success('Data berhasil di update!');
        return redirect()->route('homemembimbing');
    }
    public function hapusmembimbing(membimbing $membimbing)
    {
        $membimbing->delete();
        toastr()->success('Data berhasil dihapus');
        
        return redirect()->route('homemembimbing');
    }
    public function membimbingdelete(Request $request)
    {
        $ids = $request->input('ids');

        if (!is_array($ids) || count($ids) == 0) {
            return response()->json(['success' => false, 'message' => 'No IDs provided.']);
        }

        try {
            membimbing::whereIn('id', $ids)->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
    public function exportDataMembimbing()
    {
            return Excel::download(new MembimbingExport, 'data_membimbing.xlsx');
    }
}
