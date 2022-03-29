<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $guard = "admin";

    protected $fillable = [
        'username','password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
