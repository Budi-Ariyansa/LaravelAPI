<?php

namespace App\Http\Controllers\API;

use App\Models\Dosen;
use App\Models\Riwayat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DosenController extends Controller
{
    public function profileDosen(Request $request) {
        return auth()->user();
    }
}
