<?php

namespace App\Exports;

use App\Models\guru_mapel_pkl;
use App\Models\membimbing;
use App\Models\nilai_pkl;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromView;

class DataNilaiSiswaExport implements  FromView
{
    public function view(): View
    {
        $nilaisiswa = nilai_pkl::with(['siswa', 'guru_mapel_pkl'])->get();

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
