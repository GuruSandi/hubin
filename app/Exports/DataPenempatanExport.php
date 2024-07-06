<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;



class DataPenempatanExport implements FromView
{
    
    public function view(): View
    {
        return view('exports.datapenempatan', [
            'dataPenempatan' => DB::table('menempatis')
            ->join('siswas', 'menempatis.siswa_id', '=', 'siswas.id')
            ->join('instansis', 'menempatis.instansi_id', '=', 'instansis.id')
            ->join('membimbings', 'menempatis.siswa_id', '=', 'membimbings.siswa_id')
            ->join('pembimbings', 'membimbings.pembimbing_id', '=', 'pembimbings.id')
            ->join('guru_mapel_pkls', 'membimbings.guru_mapel_pkl_id', '=', 'guru_mapel_pkls.id')
            ->select('siswas.nama as nama_siswa', 'siswas.nis as nis', 'siswas.jenkel as jenis_kelamin', 'siswas.kelas as kelas', 'instansis.instansi as nama_instansi', 'instansis.alamat', 'pembimbings.nama as nama_pembimbing','guru_mapel_pkls.nama as nama_gurumapel')
            ->orderBy('instansis.instansi')
            ->groupBy('siswas.nama', 'siswas.nis', 'siswas.jenkel', 'siswas.kelas', 'instansis.instansi', 'instansis.alamat', 'pembimbings.nama','guru_mapel_pkls.nama')
            ->get()
        ]);
    }
    public function columnWidths(): array
    {
        return [
            'A' => 100,
            'B' => 100, 
            'C' => 100, 
            'D' => 100, 
            'E' => 100, 
            'F' => 100, 
            'G' => 100, 
            'H' => 100, 
            // Tambahkan baris ini untuk setiap kolom yang ingin Anda atur lebarnya
        ];
    }
}
