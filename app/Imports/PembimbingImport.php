<?php

namespace App\Imports;
use Illuminate\Support\Facades\Crypt;
use App\Models\guru_mapel_pkl;
use App\Models\pembimbing;
use App\Models\User;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PembimbingImport implements ToModel, WithHeadingRow
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
       
        $username = substr( $row['nama'], 0, 3) . mt_rand(10, 99); // Generate username
        
        // Simpan data ke dalam database
        $pembimbing = new pembimbing([
            'nama' => $row['nama'],
            'foto' => 'img/account.png', // Simpan path relatif ke foto
            'no_hp' => $row['no_hp'],
        ]);
    
        $pembimbing->save();
    
        // Simpan juga ke tabel user
        $password = $this->generateNumericPassword(8);


        $user = new User();
        $user->username = $username;
        $user->password = bcrypt($password); 
        $user->encrypted_password = $password;
        $user->role = 'guru';
        $user->save();
    
        // Simpan relasi ke tabel guru_mapel_pkl
        $gurumapelpkl = new guru_mapel_pkl();
        $gurumapelpkl->nama = $row['nama'];
        $gurumapelpkl->foto = 'img/account.png'; // Simpan path relatif ke foto
        $gurumapelpkl->no_hp = $row['no_hp'];
        $gurumapelpkl->user_id = $user->id;
        $gurumapelpkl->save();
    
        return $pembimbing;
    }
    
}
