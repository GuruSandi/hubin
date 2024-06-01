<?php

namespace App\Models;

use Illuminate\Support\Carbon;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class siswa extends Model
{
    use HasFactory;
    protected $guarded=['1'];

    public function user()
    {
    return $this->belongsTo(user::class);
    }
    public function menempati()
    {
        return $this->hasMany(menempati::class);
    }

    public function absensisiswa()
    {
        return $this->hasMany(absensisiswa::class);
    }
    // public static function updateStatus()
    // {
    //     // Ambil semua siswa yang belum diubah statusnya menjadi alumni
    //     $tahunSekarang = Carbon::now()->format('Y'); // Dapatkan tahun sekarang

    //     // Ambil daftar siswa
    //     $siswa = Siswa::all();
        
    //     // Iterasi setiap siswa
    //     foreach ($siswa as $siswa) {
    //         // Ambil tahun ajar siswa
    //         $tahunAjarSiswa = $siswa->tahun_ajar;
        
    //         // Periksa apakah tahun ajar siswa lebih rendah dari tahun sekarang
    //         if ($tahunAjarSiswa < $tahunSekarang) {
    //             // Jika iya, atur status siswa menjadi "alumni"
    //             $siswa->status = 'alumni';
    //             $siswa->save();
    //         }
    //     }
    // }
    
}
