<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class membimbing extends Model
{
    use HasFactory;
    protected $guarded=['1'];
    public function pembimbing()
    {
        return $this->belongsTo(pembimbing::class);
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
