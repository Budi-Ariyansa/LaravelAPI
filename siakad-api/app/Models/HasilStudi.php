<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilStudi extends Model
{
    use HasFactory;

    protected $fillable =[
        'nilai','angka_kredit',
        'tahun_ambil','ips',
        'matakuliah_id','user_id',
    ];
}
