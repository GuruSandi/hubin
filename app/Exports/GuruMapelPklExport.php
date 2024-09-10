<?php

namespace App\Exports;

use App\Models\guru_mapel_pkl;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
class GuruMapelPklExport implements FromView, WithColumnWidths
{
    
    public function view(): View
    {
        return view('exports.dataGuruMapelPkl', [
            'dataGuruMapelPkl' => guru_mapel_pkl::all()
            
        ]);
    }
    
   

    public function columnWidths(): array
    {
        return [
            'A' => 15,
            'B' => 20,
            'C' => 30,
            'D' => 20,
        ];
    }
}
