<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matakuliah extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_matakuliah','kode_huruf','nama_matkul',
        'jumlah_sks','sks_a','sks_b','sks_id',
    ];
    public function mengajar() {
        return $this->hasOne(Mengajar::class);
    }
    
}
