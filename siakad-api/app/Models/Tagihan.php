<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    use HasFactory;

    protected $fillable = [
        'uang_kuliah','uang_spp','uang_denda',
        'layanan_kh','total_hutang','harus_dibayar',
        'sudah_dibayar','jatuh_tempo','tempo_pelunasan',
        'user_id',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
