<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_siswa','ttl_siswa',
        'agama','nim',
        'alamat','nik',
        'no_kk','no_hp',
        'email','beban_sks',
        'fakultas_id','tahun_ajar_id','password',
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function registrasi_ulang() {
        return $this->hasMany(RegistrasiUlang::class);
    }
    public function kartu_studi_tetap() {
        return $this->hasMany(KartuStudiTetap::class);
    }
    public function tagihan() {
        return $this->hasMany(Tagihan::class);
    }
    public function jadwal_kuliah() {
        return $this->hasMany(JadwalKuliah::class);
    }
    public function tahun_ajar() {
        return $this->belongsTo(TahunAjar::class);
    }
    public function fakultas() {
        return $this->belongsTo(Fakultas::class);
    }
}
