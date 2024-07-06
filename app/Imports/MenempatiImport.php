<?php

namespace App\Imports;

use App\Models\menempati;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class MenempatiImport implements ToModel, WithHeadingRow
{
    protected $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }
    public function model(array $row)
    {
        return new menempati([
            'user_id' => $this->userId,
            'siswa_id' => $row['siswa_id'],
            'instansi_id' => $row['instansi_id'],
        ]);

    }
}
