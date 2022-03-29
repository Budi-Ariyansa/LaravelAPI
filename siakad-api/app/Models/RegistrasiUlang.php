<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistrasiUlang extends Model
{
    use HasFactory;

    protected $fillable = [
        'jenis_registrasi','status','waktu_mulai',
        'waktu_berakhir','user_id','semester',
        'tahun_ajar',
    ];
}
