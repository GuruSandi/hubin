<?php

namespace App\Imports;

use App\Models\instansi;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class InstansiImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new instansi([
            'instansi' => $row['instansi'],
            'latitude' => $row['latitude'],
            'longitude' => $row['longitude'],
            'alamat' => $row['alamat'],
            'domisili' => $row['domisili'],
        ]);
    }
}
