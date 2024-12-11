<?php

namespace App\Http\Controllers;

use App\Exports\DataNilaiSiswaExport;
use App\Models\nilai_pkl;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DataNilaiController extends Controller
{
    public function datanilaisiswa()
    {
        $nilaisiswa = DB::table('siswas')
            ->leftJoin('nilai_pkls', 'siswas.id', '=', 'nilai_pkls.siswa_id')
            ->leftJoin('membimbings', 'siswas.id', '=', 'membimbings.siswa_id')  // Join with membimbing to get the teacher
            ->leftJoin('guru_mapel_pkls', 'membimbings.guru_mapel_pkl_id', '=', 'guru_mapel_pkls.id')
            
            ->select(
                'siswas.id as siswa_id',
                'siswas.nama',
                'siswas.kelas',
                'nilai_pkls.id',
                'nilai_pkls.nilai1',
                'nilai_pkls.nilai2',
                'nilai_pkls.nilai3',
                'nilai_pkls.nilai4',
                'guru_mapel_pkls.nama as guru_mapel_pkl',
            )
            ->get();
            // dd($nilaisiswa);


        return view('datanilaisiswa.homedatanilai', compact('nilaisiswa'));
    }
    public function posteditdatanilaisiswa(Request $request, nilai_pkl $nilai_pkl)
    {
        $data = $request->validate([
            'nilai1' => 'required|numeric|between:1,100',
            'nilai2' => 'required|numeric|between:1,100',
            'nilai3' => 'required|numeric|between:1,100',
            'nilai4' => 'required|numeric|between:1,100',
        ]);
        $nilai_pkl->update($data);
        toastr()->success('Data berhasil disimpan!');
        return redirect()->route('datanilaisiswa');
    }
    public function hapusdatanilaisiswa(nilai_pkl $nilai_pkl)
    {
        $nilai_pkl->delete();
        toastr()->success('Data berhasil dihapus');
        return redirect()->route('datanilaisiswa');
    }
    public function datanilaidelete(Request $request)
    {
        $ids = $request->input('ids');

        if (!is_array($ids) || count($ids) == 0) {
            return response()->json(['success' => false, 'message' => 'No IDs provided.']);
        }

        try {
            nilai_pkl::whereIn('id', $ids)->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function exportDataNilaiSiswa()
    {
        return Excel::download(new DataNilaiSiswaExport, 'data_nilai_siswa.xlsx');
    }
}
