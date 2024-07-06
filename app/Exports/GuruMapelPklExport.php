<?php

namespace App\Exports;

use App\Models\guru_mapel_pkl;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
class GuruMapelPklExport implements FromView,  WithDrawings, WithColumnWidths
{
    protected $gurumapelpkl;

    public function __construct($gurumapelpkl)
    {
        $this->gurumapelpkl = $gurumapelpkl;
    }
    public function view(): View
    {
        return view('exports.dataGuruMapelPkl', [
            'dataGuruMapelPkl' => guru_mapel_pkl::all()
            
        ]);
    }
    public function drawings()
    {
        $drawings = [];

        // Logika untuk menambahkan gambar ke dalam ekspor
        foreach ($this->gurumapelpkl as $index => $item) {
            $drawings[] = $this->drawingsForItem($item->foto, 'E' . ($index + 2));
        }

        return $drawings;
    }
    protected function drawingsForItem($imagePath, $coordinate)
    {
        $drawing = new Drawing();
        $drawing->setPath(public_path($imagePath));
        $drawing->setCoordinates($coordinate);

        return $drawing;
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
