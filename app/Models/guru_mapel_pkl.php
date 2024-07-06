<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class guru_mapel_pkl extends Model
{
    use HasFactory;
    protected $guarded=['1'];
   
    public function membimbing()
    {
        return $this->hasMany(membimbing::class);
    }
    public function jurnal()
    {
        return $this->hasMany(jurnal::class);
    }
    public function nilai_pkl()
    {
        return $this->hasMany(nilai_pkl::class);
    }
    public function user()
    {
    return $this->belongsTo(user::class);
    }
   
}
