<?php

namespace App\Exports;

use App\Models\pembimbing;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
class PembimbingExport implements FromView,  WithDrawings, WithColumnWidths
{
    protected $pembimbing;

    public function __construct($pembimbing)
    {
        $this->pembimbing = $pembimbing;
    }

    public function view(): View
    {
        return view('exports.datapembimbing', [
            'dataPembimbing' => pembimbing::all()
            
        ]);
    }
    public function drawings()
    {
        $drawings = [];

        // Logika untuk menambahkan gambar ke dalam ekspor
        foreach ($this->pembimbing as $index => $item) {
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
