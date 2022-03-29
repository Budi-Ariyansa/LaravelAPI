<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mengajar extends Model
{
    use HasFactory;

    protected $fillable = [
        'hari_kuliah','jam_kuliah','kursi_tersedia',
        'kursi_terpilih','dosen_id','matkul_id','ruangan_id',
    ];

    public function kartu_studi_tetap() {
        return $this->hasMany(KartuStudiTetap::class);
    }
    public function matakuliah() {
        return $this->belongsTo(Matakuliah::class);
    }
    public function dosen() {
        return $this->belongsTo(Dosen::class);
    }
    public function ruangan() {
        return $this->belongsTo(Ruangan::class);
    }
}
