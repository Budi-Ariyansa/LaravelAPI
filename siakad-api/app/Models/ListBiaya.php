<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListBiaya extends Model
{
    use HasFactory;

    protected $fillable = [
        'harga_spp','harga_sks','harga_layanan_kh'
    ];
}
