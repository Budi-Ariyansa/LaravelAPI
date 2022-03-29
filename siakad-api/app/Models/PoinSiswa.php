<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoinSiswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'jenis_poin','waktu_kegiatan','nama_kegiatan',
        'posisi','tingkat_kegiatan','user_id',
    ];
}
