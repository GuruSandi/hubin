<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nilai_pkl extends Model
{
    use HasFactory;
    protected $guarded=['1'];

    public function user()
    {
    return $this->belongsTo(user::class);
    }
    public function guru_mapel_pkl()
    {
        return $this->belongsTo(guru_mapel_pkl::class);
    }
    public function siswa()
    {
        return $this->belongsTo(siswa::class);
    }
}
