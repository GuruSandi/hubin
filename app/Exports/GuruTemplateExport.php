<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class GuruTemplateExport implements FromArray, WithHeadings
{
    /**
     * @return array
     */
    public function array(): array
    {
        return [
            ['Prof. Ahmad Farhan', '0888777887788'],
        ];
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'nama', 'no_hp'
        ];
    }
}
