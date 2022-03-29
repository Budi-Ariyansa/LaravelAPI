<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pertemuan','link_meet','link_materi',
        'jam_masuk','rps_materi','jadwal_id',
    ];
}
