<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Dosen extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $guard = "dosen";

    protected $fillable = [
        'nama_dosen','nid','alamat',
        'ttl_dosen','agama','no_hp',
        'nik','no_kk','email','password'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function mengajar() {
        return $this->hasMany(Mengajar::class);
    }
    public function fakultas() {
        return $this->belongsTo(Fakultas::class);
    }
}
