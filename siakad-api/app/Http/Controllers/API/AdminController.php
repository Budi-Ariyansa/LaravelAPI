<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Dosen;
use App\Models\Riwayat;
use App\Models\Fakultas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function cariSiswa(Request $request) {
        date_default_timezone_set('Asia/Jakarta');
        
        Riwayat::create([
            'user' => 'Admin',
            'kegiatan' => 'Telah mencari data : '.$request->nim,
            'waktu' => date('Y-m-d', time()),
            'status' => 'SUCCESS'
        ]);
        
        return User::with('fakultas')->firstWhere('nim', $request->nim);
    }
    public function updateSiswa(Request $request) {

        $validator = Validator::make($request->all(),[
            'nama_siswa' => 'required|string',
            'ttl_siswa' => 'required|string',
            'agama' => 'required|string',
            'nim' => 'required|string|between:9,9',
            'fakultas' => 'required|string',
            'program_studi' => 'required|string',
            'alamat' => 'required|string',
            'nik' => 'required|string|between:16,16',
            'no_kk' => 'required|string|between:16,16',
            'no_hp' => 'required|string|between:11,12',
            'beban_sks' => 'required|integer',
            'email' => 'required|string|email|max:255|unique:users',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        $fakultas = Fakultas::where('nama_fakultas', $request->fakultas)->firstWhere('program_studi', $request->program_studi);
        
        $siswa = User::where('nim',$request->nim)->update([
            'nama_siswa' => $request->nama_siswa,
            'ttl_siswa' => $request->ttl_siswa, 
            'agama' => $request->agama,
            'nim' => $request->nim,
            'alamat' => $request->alamat,
            'nik' => $request->nik,
            'no_kk' => $request->no_kk ,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'beban_sks' => $request->beban_sks,
            'fakultas_id' => $fakultas->id,
        ]);

        date_default_timezone_set('Asia/Jakarta');

        Riwayat::create([
            'user' => 'Admin',
            'kegiatan' => 'Telah mengupdate data : '.$request->nim,
            'waktu' => date('Y-m-d', time()),
            'status' => 'SUCCESS'
        ]);
        return response()->json(['message','Data Berhasil diupdate.']);
    }
    public function updateDosen(Request $request) {

        $validator = Validator::make($request->all(),[
            'nama_dosen' => 'required|string',
            'ttl_dosen' => 'required|string',
            'agama' => 'required|string',
            'nid' => 'required|string|between:9,9|unique:dosens',
            'fakultas' => 'required|string',
            'program_studi' => 'required|string',
            'alamat' => 'required|string',
            'nik' => 'required|string|between:16,16',
            'no_kk' => 'required|string|between:16,16',
            'no_hp' => 'required|string|between:11,12',
            'email' => 'required|string|email|max:255|unique:dosens',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $fakultas = Fakultas::where('nama_fakultas', $request->fakultas)->firstWhere('program_studi', $request->program_studi);

        $dosen = Dosen::where('nid',$request->nid)->update([
            'nama_dosen' => $request->nama_dosen,
            'ttl_dosen' => $request->ttl_dosen, 
            'agama' => $request->agama,
            'nid' => $request->nid,
            'alamat' => $request->alamat,
            'nik' => $request->nik,
            'no_kk' => $request->no_kk,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'fakultas_id' => $fafkultas->id,
        ]);
        
        date_default_timezone_set('Asia/Jakarta');

        Riwayat::create([
            'user' => 'Admin',
            'kegiatan' => 'Telah mengupdate data : '.$request->nim,
            'waktu' => date('Y-m-d', time()),
            'status' => 'SUCCESS'
        ]);
        return response()->json(['message','Data Berhasil diupdate.']);
    }
    
    public function hapusSiswa(Request $request) {
        $siswa = User::where('nim', $request->nim);
        
        if(!$siswa->delete()) {
            return response()->json(['message','NIM tidak ditemukan']);
        }
        date_default_timezone_set('Asia/Jakarta');
        
        Riwayat::create([
            'user' => 'Admin',
            'kegiatan' => 'Telah menghapus data : '.$request->nim,
            'waktu' => date('Y-m-d', time()),
            'status' => 'SUCCESS'
        ]);
        return response()->json(['message','Data Berhasil dihapus.']);
    }

    public function cariDosen(Request $request) {
        date_default_timezone_set('Asia/Jakarta');
        
        Riwayat::create([
            'user' => 'Admin',
            'kegiatan' => 'Telah mencari data : '.$request->nid,
            'waktu' => date('Y-m-d', time()),
            'status' => 'SUCCESS'
        ]);
        
        return Dosen::with('fakultas')->firstWhere('nid', $request->nid);
    }

    public function hapusDosen(Request $request) {
        $dosen = Dosen::where('nid', $request->nid);
        
        if(!$dosen->delete()) {
            return response()->json(['message','NID tidak ditemukan']);
        }
        date_default_timezone_set('Asia/Jakarta');
        
        Riwayat::create([
            'user' => 'Admin',
            'kegiatan' => 'Telah menghapus data : '.$request->nid,
            'waktu' => date('Y-m-d', time()),
            'status' => 'SUCCESS'
        ]);

        return response()->json(['message','Data Berhasil dihapus.']);
    }

    public function ambilRiwayat(Request $request) {
        return Riwayat::latest()->take(25)->get();
    }

    public function tampilTA (Request $request) {

        return TahunAjar::first();
    }

    public function updateTA (Request $request) {

        
        $validator = Validator::make($request->all(),[
            'semester' => 'required|integer',
            'tahun_ajar' => 'required|string',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $tahunAjar = TahunAjar::first()->update([

            'semester' => $request->semester,
            'tahun_ajar' => $request->tahun_ajar,

        ]);

        date_default_timezone_set('Asia/Jakarta');
        
        Riwayat::create([
            'user' => 'Admin',
            'kegiatan' => 'Telah mengganti Tahun Ajaran : Semester'.$request->semester.'dan Tahun Ajar'.$request->tahun_ajar,
            'waktu' => date('Y-m-d', time()),
            'status' => 'SUCCESS'
        ]);

        return response()->json(['message','Data Berhasil diubah.']);

    }

}
