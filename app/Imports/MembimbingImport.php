<?php

namespace App\Imports;
use App\Models\membimbing;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MembimbingImport implements ToModel, WithHeadingRow
{
    protected $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }
    public function model(array $row)
    {
        return new membimbing([
            'user_id' => $this->userId,
            'siswa_id' => $row['siswa_id'],
            'pembimbing_id' => $row['pembimbing_id'],
            'guru_mapel_pkl_id' => $row['guru_mapel_pkl_id'],
        ]);

    }
}
