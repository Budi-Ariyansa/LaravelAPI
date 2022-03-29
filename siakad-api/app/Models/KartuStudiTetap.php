<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KartuStudiTetap extends Model
{
    use HasFactory;

    protected $fillable = [
        'b/u','mengajar_id','user_id',
    ];

    public function mengajar() {
        return $this->belongsTo(Mengajar::class);
    }
    public function jadwal_kuliah() {
        return $this->hasOne(JadwalKuliah::class);
    }
}
