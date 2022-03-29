<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fakultas extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_fakultas', 'program_studi',
        'akreditasi_fakultas',
    ];

    public function user() {
        return $this->hasMany(User::class);
    }
    public function dosen() {
        return $this->hasMany(Dosen::class);
    }
    public function registrasi_matakuliah() {
        return $this->hasMany(RegistrasiMatakuliah::class);
    }
}
