<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistrasiMatakuliah extends Model
{
    use HasFactory;

    protected $fillable = [
        'waktu_mulai','waktu_berakhir','fakultas_id',
    ];
}
