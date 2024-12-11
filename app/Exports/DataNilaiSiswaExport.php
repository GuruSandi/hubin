<?php

namespace App\Exports;


use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DataNilaiSiswaExport implements  FromView
{
    public function view(): View
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

        return view('exports.data_nilai_siswa', [
            'nilaisiswa'  => $nilaisiswa
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
