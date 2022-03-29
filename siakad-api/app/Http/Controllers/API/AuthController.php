<?php

namespace App\Http\Controllers\API;

use Auth;
use Validator;
use App\Models\User;
use App\Models\Admin;
use App\Models\Dosen;
use App\Models\Riwayat;
use App\Models\Fakultas;
use App\Models\TahunAjar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function tambahSiswa(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nama_siswa' => 'required|string',
            'ttl_siswa' => 'required|string',
            'agama' => 'required|string',
            'nim' => 'required|string|between:9,9|unique:users',
            'fakultas' => 'required|string',
            'program_studi' => 'required|string',
            'alamat' => 'required|string',
            'semester' => 'required|integer',
            'tahun_ajar' => 'required|string',
            'nik' => 'required|string|between:16,16',
            'no_kk' => 'required|string|between:16,16',
            'no_hp' => 'required|string|between:11,12',
            'email' => 'required|string|email|max:255|unique:users',
            'beban_sks' => 'required|integer',
            'password' => 'required|string|min:8'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $tahun_ajar = TahunAjar::where('semester', $request->semester)->firstWhere('tahun_ajar', $request->tahun_ajar)->id;
        $fakultas = Fakultas::where('nama_fakultas', $request->fakultas)->firstWhere('program_studi', $request->program_studi)->id;

        $user = User::create([
            'nama_siswa' => $request->nama_siswa,
            'ttl_siswa' => $request->ttl_siswa, 
            'agama' => $request->agama,
            'nim' => $request->nim,
            'alamat' => $request->alamat,
            'nik' => $request->nik,
            'no_kk' => $request->no_kk,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'fakultas_id' => $fakultas,
            'tahun_ajar_id' => $tahun_ajar,
            'beban_sks' => $request->beban_sks,
            'password' => Hash::make($request->password)
        ]);
        date_default_timezone_set('Asia/Jakarta');
        Riwayat::create([
            'user' => 'Admin',
            'kegiatan' => 'Telah menambahkan data mahasiswa baru',
            'waktu' => date('Y-m-d', time()),
            'status' => 'SUCCESS'
        ]);

        return response()
            ->json(['message' => 'Berhasil Menambahkan Data Mahasiswa Baru']);
    }

    public function tambahDosen(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nama_dosen' => 'required|string',
            'ttl_dosen' => 'required|string',
            'agama' => 'required|string',
            'nid' => 'required|string|between:5,5|unique:dosens',
            'fakultas' => 'required|string',
            'program_studi' => 'required|string',
            'alamat' => 'required|string',
            'nik' => 'required|string|between:16,16',
            'no_kk' => 'required|string|between:16,16',
            'no_hp' => 'required|string|between:11,12',
            'email' => 'required|string|email|max:255|unique:dosens',
            'password' => 'required|string|min:8'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $fakultas = Fakultas::where('nama_fakultas', $request->fakultas)->firstWhere('program_studi', $request->program_studi);

        $dosen = Dosen::create([
            'nama_dosen' => $request->nama_dosen,
            'ttl_dosen' => $request->ttl_dosen, 
            'agama' => $request->agama,
            'nid' => $request->nid,
            'alamat' => $request->alamat,
            'nik' => $request->nik,
            'no_kk' => $request->no_kk,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'fakultas_id' => $fakultas->id,
            'password' => Hash::make($request->password)
        ]);
        
        date_default_timezone_set('Asia/Jakarta');
        Riwayat::create([
            'user' => 'Admin',
            'kegiatan' => 'Telah menambahkan data dosen baru',
            'waktu' => date('Y-m-d', time()),
            'status' => 'SUCCESS'
        ]);

        return response()
            ->json(['message' => 'Berhasil Menambahkan Data Dosen Baru']);
    }
    
    public function loginSiswa(Request $request)
    {
        if (!Auth::attempt($request->only('nim', 'password')))
        {
            return response()
                ->json(['message' => 'Unauthorized'], 401);
        }

        $user = User::where('nim', $request['nim'])->firstOrFail();

        date_default_timezone_set('Asia/Jakarta');
        
        Riwayat::create([
            'user' => $user->nama_siswa.'-'.$user->nim,
            'kegiatan' => 'Telah Login',
            'waktu' => date('Y-m-d', time()),
            'status' => 'SUCCESS'
        ]);
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()
            ->json(['access_token' => $token, 'token_type' => 'Bearer', ]);
    }

    public function loginDosen(Request $request)
    {
        if (!Auth::guard('dosen')->attempt($request->only('nid', 'password')))
        {
            return response()
                ->json(['message' => 'Unauthorized'], 401);
        }

        $dosen = Dosen::where('nid', $request['nid'])->firstOrFail();

        $token = $dosen->createToken('auth_token')->plainTextToken;
        date_default_timezone_set('Asia/Jakarta');
        Riwayat::create([
            'user' => $dosen->nama_dosen.'-'.$dosen->nid,
            'kegiatan' => 'Telah Login',
            'waktu' => date('Y-m-d', time()),
            'status' => 'SUCCESS'
        ]);
        return response()
            ->json(['access_token' => $token, 'token_type' => 'Bearer', ]);
    }
    
    public function loginAdmin(Request $request)
    {
        if (!Auth::guard('admin')->attempt($request->only('username', 'password')))
        {
            return response()
                ->json(['message' => 'Unauthorized'], 401);
        }

        $admin = Admin::where('username', $request['username'])->firstOrFail();

        $token = $admin->createToken('auth_token')->plainTextToken;
        date_default_timezone_set('Asia/Jakarta');
        Riwayat::create([
            'user' => 'Admin',
            'kegiatan' => 'Telah Login',
            'waktu' => date('Y-m-d', time()),
            'status' => 'SUCCESS'
        ]);
        return response()
            ->json(['access_token' => $token, 'token_type' => 'Bearer', ]);
    }

    // method for user logout and delete token
    public function logout()
    {
        auth()->user()->tokens()->delete();

        return [
            'success' => 'Berhasil Logout'
        ];
    }
}
