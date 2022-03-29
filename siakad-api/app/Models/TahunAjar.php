<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunAjar extends Model
{
    use HasFactory;

    protected $fillable = [
        'semester','tahun_ajar',
    ];

    public function registrasi_ulang() {
        return $this->hasMany(RegistrasiUlang::class);
    }
    public function user() {
        return $this->hasMany(User::class);
    }
}
