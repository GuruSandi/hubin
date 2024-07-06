<?php

namespace App\Http\Controllers;

use App\Exports\DataPenempatanExport;
use App\Models\datapenempatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class DataPenempatanController extends Controller
{
    public function dataPenempatan()
    {
        $dataPenempatan =  DB::table('menempatis')
            ->join('siswas', 'menempatis.siswa_id', '=', 'siswas.id')
            ->join('instansis', 'menempatis.instansi_id', '=', 'instansis.id')
            ->join('membimbings', 'menempatis.siswa_id', '=', 'membimbings.siswa_id')
            ->join('pembimbings', 'membimbings.pembimbing_id', '=', 'pembimbings.id')
            ->join('guru_mapel_pkls', 'membimbings.guru_mapel_pkl_id', '=', 'guru_mapel_pkls.id')
            ->select('siswas.nama as nama_siswa', 'siswas.nis as nis', 'siswas.jenkel as jenis_kelamin', 'siswas.kelas as kelas', 'instansis.instansi as nama_instansi', 'instansis.alamat', 'pembimbings.nama as nama_pembimbing','guru_mapel_pkls.nama as nama_gurumapel')
            ->orderBy('instansis.instansi')
            ->groupBy('siswas.nama', 'siswas.nis', 'siswas.jenkel', 'siswas.kelas', 'instansis.instansi', 'instansis.alamat', 'pembimbings.nama','guru_mapel_pkls.nama')
            ->get();
        return view('data.datapenempatan', compact('dataPenempatan'));

    
    
    }
    public function exportDataPenempatan()
    {
            return Excel::download(new DataPenempatanExport, 'data_penempatan.xlsx');
    }
}
