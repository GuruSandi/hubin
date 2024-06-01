<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class menempati extends Model
{
    use HasFactory;
    protected $guarded=['1'];
    public function siswa()
    {
        return $this->belongsTo(siswa::class);
    }
    public function instansi()
    {
        return $this->belongsTo(instansi::class);
    }
    public function User()
    {
        return $this->belongsTo(User::class);
    }
    
}
