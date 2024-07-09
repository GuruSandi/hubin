<?php

namespace App\Imports;
use Illuminate\Support\Facades\Crypt;
use App\Models\guru_mapel_pkl;
use App\Models\pembimbing;
use App\Models\User;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class GuruMapelImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Mendapatkan data gambar dari kolom 'foto' Excel (misalnya dalam format base64)
        $base64Image = $row['foto'];
        
        
        $username = substr( $row['nama'], 0, 3) . mt_rand(10, 99); // Generate username
        
       
        $password = Str::random(8); 
        $user = new User();
        $user->username = $username;
        $user->password = bcrypt($password); 
        $user->encrypted_password = $password;
        $user->role = 'guru';
        $user->save();
    
        $gurumapelpkl = new guru_mapel_pkl();
        $gurumapelpkl->nama = $row['nama'];
        $gurumapelpkl->foto = 'img/account.png'; 
        $gurumapelpkl->no_hp = $row['no_hp'];
        $gurumapelpkl->user_id = $user->id;
        $gurumapelpkl->save();

        $pembimbing = new pembimbing([
            'nama' => $row['nama'],
            'foto' => 'img/account.png', 
            'no_hp' => $row['no_hp'],
        ]);
    
        $pembimbing->save();
        
        return $gurumapelpkl;
    }
}
