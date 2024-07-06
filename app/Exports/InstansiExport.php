<?php

namespace App\Exports;

use App\Models\instansi;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class InstansiExport implements FromView
{
    public function view(): View
    {
        return view('exports.datainstansi', [
            'dataInstansi' => instansi::all()
            
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
