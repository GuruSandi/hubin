<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InstansiTemplateExport implements FromArray, WithHeadings
{
    /**
     * @return array
     */
    public function array(): array
    {
        return [
            ['ATR BPN Kabupaten Sukabumi', 'Jl. Suryakencana No. 2 Sukabumi', 'Sukabumi'],
        ];
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'instansi', 'alamat', 'domisili'
        ];
    }
}
