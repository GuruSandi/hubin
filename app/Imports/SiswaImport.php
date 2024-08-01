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
    public function generateNumericPassword($length = 8)
    {
        $chars = '0123456789';
        $password = '';
        
        for ($i = 0; $i < $length; $i++) {
            $password .= $chars[rand(0, strlen($chars) - 1)];
        }
        
        return $password;
    }
    public function model(array $row)
    {
        $siswa= new siswa([
            'nis' => $row['nis'],
            'nama' => $row['nama'],
            'jenkel' => $row['jenkel'],
            'kelas' => $row['kelas'],
            'tahun_ajar' => $row['tahun_ajar'],
            'status' => 'aktif',
        ]);
        $password = $this->generateNumericPassword(8);
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
