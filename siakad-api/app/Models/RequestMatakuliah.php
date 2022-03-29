<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestMatakuliah extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_matakuliah','alasan',
        'nim',
    ];
}
