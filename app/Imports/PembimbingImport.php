<?php

namespace App\Imports;

use App\Models\guru_mapel_pkl;
use App\Models\pembimbing;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PembimbingImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Mendapatkan data gambar dari kolom 'foto' Excel (misalnya dalam format base64)
        $base64Image = $row['foto'];
        
        // Decode base64 ke data biner gambar
        $imageData = base64_decode($base64Image);
    
        // Menyimpan file gambar ke dalam direktori public/fotoguru dengan nama unik
        $fotoPath = 'fotoguru/';
        $fotoFileName = time() . '_gambar.jpg'; // Ganti ekstensi sesuai format gambar yang diharapkan
        file_put_contents(public_path($fotoPath . $fotoFileName), $imageData);
        $username = substr( $row['nama'], 0, 3) . mt_rand(10, 99); // Generate username
        
        // Simpan data ke dalam database
        $pembimbing = new pembimbing([
            'nama' => $row['nama'],
            'foto' => 'img/account.png', // Simpan path relatif ke foto
            'no_hp' => $row['no_hp'],
        ]);
    
        $pembimbing->save();
    
        // Simpan juga ke tabel user
        $password = $row['no_hp'];
        $user = new User();
        $user->username = $username;
        $user->password = bcrypt($password); // Anda mungkin perlu memvalidasi dan mengenkripsi password
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
