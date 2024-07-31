<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MembimbingTemplateExport implements  FromArray, WithHeadings
{
    /**
     * @return array
     */
    public function array(): array
    {
        return [
            ['1', '5','3'],
        ];
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'siswa_id', 'pembimbing_id','guru_mapel_pkl_id'
        ];
    }
}
