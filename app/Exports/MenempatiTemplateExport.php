<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MenempatiTemplateExport implements FromArray, WithHeadings
{
    /**
     * @return array
     */
    public function array(): array
    {
        return [
            ['1', '5'],
        ];
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'siswa_id', 'instansi_id'
        ];
    }
}
