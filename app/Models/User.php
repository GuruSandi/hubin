<?php

namespace App\Models;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    /**
     * Determine if the user should have their password reset.
     *
     * @return bool
     */
    public function shouldRenewPassword()
    {
        
        return false;
    }
    protected $guarded = [];

    public function siswa()
    {
        return $this->hasOne(Siswa::class);
    }

    public function membimbing()
    {
        return $this->belongsTo(membimbing::class);
    }
    public function menempati()
    {
        return $this->belongsTo(menempati::class);
    }
    public function guru_mapel_pkl()
    {
        return $this->belongsTo(guru_mapel_pkl::class);
    }
    public function jurnal()
    {
        return $this->belongsTo(jurnal::class);
    }
    public function nilai_pkl()
    {
        return $this->belongsTo(nilai_pkl::class);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'password',
        'role',
        'encrypted_password',
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
   
   
}
