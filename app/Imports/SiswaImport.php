<?php

namespace App\Imports;

use Illuminate\Support\Facades\Crypt;
use App\Models\siswa;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SiswaImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $siswa= new siswa([
            'nis' => $row['nis'],
            'nama' => $row['nama'],
            'jenkel' => $row['jenkel'],
            'kelas' => $row['kelas'],
            'tahun_ajar' => $row['tahun_ajar'],
        ]);
        $password = Str::random(8); 
        $user = new User();
        $user->username = $row['nis'];
        $user->password = bcrypt($password); 
        $user->encrypted_password = $password;

        $user->role = 'siswa';
        $user->save();

        $siswa->user_id = $user->id;
        $siswa->save();
        return $siswa;
    }
}
