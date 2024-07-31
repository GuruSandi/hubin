<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SiswaTemplateExport implements FromArray, WithHeadings
{
    /**
     * @return array
     */
    public function array(): array
    {
        return [
            ['12345', 'John Doe', 'L', '10A', '2024/2025'],
        ];
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'nis', 'nama', 'jenkel', 'kelas', 'tahun_ajar'
        ];
    }
}
