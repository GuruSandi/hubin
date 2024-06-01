<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class instansi extends Model
{
    use HasFactory;
    protected $guarded=['1'];
    public function menempati()
    {
        return $this->hasMany(menempati::class);
    }
    public function membimbing()
    {
        return $this->hasMany(membimbing::class);
    }
   
   
}
