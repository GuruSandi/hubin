<?php

namespace App\Imports;

use App\Models\pembimbing;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PembimbingImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new pembimbing([
            'nama' => $row['nama'],
        ]);
    }
}
