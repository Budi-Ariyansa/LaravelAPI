<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalKuliah extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','kartu_studi_tetap_id',
    ];

    public function kartu_studi_tetap() {
        return $this->belongsTo(KartuStudiTetap::class);
    }
}
