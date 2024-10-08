<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class absensisiswa extends Model
{
    use HasFactory;
    protected $table = 'absensisiswas';

    protected $fillable = [
        'user_id', 'latitude', 'longitude', 'keterangan','jarak', 'jam_masuk','jam_pulang','tanggal','siswa_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'user_id');
    }

}
