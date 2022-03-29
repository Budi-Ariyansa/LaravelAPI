<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Mengajar;
use App\Models\TahunAjar;
use Illuminate\Http\Request;
use App\Models\RegistrasiUlang;
use App\Http\Controllers\Controller;
use App\Models\RegistrasiMatakuliah;

class SiswaController extends Controller
{
    public function profileSiswa(Request $request) {
        $tahun_ajar = TahunAjar::firstWhere('id', auth()->user()->tahun_ajar_id);
        return response()->json([
            'nama_siswa' => auth()->user()->nama_siswa,
            'nim' => auth()->user()->nim,
            'semester' => $tahun_ajar->semester,
            'tahun_ajar' => $tahun_ajar->tahun_ajar,
            'email' => auth()->user()->email,
            'beban_sks' => auth()->user()->beban_sks,
            'nik' => auth()->user()->nik,
            'no_hp' => auth()->user()->no_hp,
            'no_kk' => auth()->user()->no_kk,
            'fakultas' => auth()->user()->fakultas->nama_fakultas,
            'program_studi' => auth()->user()->fakultas->program_studi,
        ]);
    }
    
    public function statusRegistrasiUlang() {
        $regisUlangSiswa = auth()->user()->registrasi_ulang->where('semester', auth()->user()->tahun_ajar->semester)
        ->firstWhere('tahun_ajar', auth()->user()->tahun_ajar->tahun_ajar);

        if(date('Y-m-d', time()) < $regisUlangSiswa->waktu_mulai) {
            return ['kondisi' => 'False'];
        } else {
            return [
                'kondisi' => 'True',
                'status' => $regisUlangSiswa->status,
            ];
        }
    }

    public function registrasiUlang(Request $request) {
        if($request->jenis_registrasi != null) {
            $tahun_ajar = TahunAjar::firstWhere('id', auth()->user()->tahun_ajar_id);
            RegistrasiUlang::where('user_id', auth()->user()->id)->where('semester', $tahun_ajar->semester)->where('tahun_ajar', $tahun_ajar->tahun_ajar)
            ->update([
                'jenis_registrasi' => $request->jenis_registrasi,
                'status' => 'SUDAH',
            ]);
            
            return ['success' => 'Berhasil Registrasi Ulang'];
        } else {
            return ['failed' => 'Gagal Registrasi Ulang'];
        }
    }

    public function kartuStudiSiswa() {
        $kst = auth()->user()->kartu_studi_tetap;
        $mengajar = $kst->pluck('mengajar_id')->toArray();
        $bu = $kst->pluck('b/u')->toArray();
        
        $data = [
            'bu'=> $bu,
            'hari_kuliah' => array(),
            'jam_kuliah' => array(),
            'dosen' => array(),
            'kode_dosen' => array(),
            'matkul' => array(),
            'kode_matkul' => array(),
            'sksa' => array(),
            'sksb' => array(),
            'ruangan' => array(),
        ];
        foreach ($mengajar as $var) {
            array_push($data['hari_kuliah'], Mengajar::firstWhere('id', $var)->hari_kuliah);
            array_push($data['jam_kuliah'], Mengajar::firstWhere('id', $var)->jam_kuliah);
            array_push($data['dosen'], Mengajar::firstWhere('id', $var)->dosen->nama_dosen);
            array_push($data['kode_dosen'], Mengajar::firstWhere('id', $var)->dosen->nid);
            array_push($data['matkul'], Mengajar::firstWhere('id', $var)->matakuliah->nama_matkul);
            array_push($data['kode_matkul'], Mengajar::firstWhere('id', $var)->matakuliah->kode_matkul.Mengajar::firstWhere('id', $var)->matakuliah->kode_huruf);
            array_push($data['sksa'], Mengajar::firstWhere('id', $var)->matakuliah->sks_a);
            array_push($data['sksb'], Mengajar::firstWhere('id', $var)->matakuliah->sks_b);
            array_push($data['ruangan'], Mengajar::firstWhere('id', $var)->ruangan->nomor_ruangan);
        }

        return $data;
    }

    public function statusRegistrasiMatakuliah(Request $request) {
        $regisUlangSiswa = auth()->user()->registrasi_ulang->where('semester', auth()->user()->tahun_ajar->semester)
        ->firstWhere('tahun_ajar', auth()->user()->tahun_ajar->tahun_ajar);

        if(RegistrasiMatakuliah::first()->waktu_mulai < date('Y-m-d h:i:s', time())) {
            return ['belum'];
        } else {
            return date('Y-m-d h:i:s', time());
        }
    }

    public function hapusKartuStudi(Request $request) {
        
    }

    public function jadwalKuliah() {
        $jadwal = auth()->user()->kartu_studi_tetap;
        $mengajar = $jadwal->pluck('mengajar_id')->toArray();

        $data = [
            'hari_kuliah' => array(),
            'jam_kuliah' => array(),
            'dosen' => array(),
            'kode_dosen' => array(),
            'ruangan' => array(),
            'matkul' => array(),
            'kode_matkul' => array(),
        ];

        foreach($mengajar as $var) {
            array_push($data['hari_kuliah'], Mengajar::firstWhere('id', $var)->hari_kuliah);
            array_push($data['jam_kuliah'], Mengajar::firstWhere('id', $var)->jam_kuliah);
            array_push($data['dosen'], Mengajar::firstWhere('id', $var)->dosen->nama_dosen);
            array_push($data['kode_dosen'], Mengajar::firstWhere('id', $var)->dosen->nid);
            array_push($data['matkul'], Mengajar::firstWhere('id', $var)->matakuliah->nama_matkul);
            array_push($data['kode_matkul'], Mengajar::firstWhere('id', $var)->matakuliah->kode_matkul.Mengajar::firstWhere('id', $var)->matakuliah->kode_huruf);
            array_push($data['ruangan'], Mengajar::firstWhere('id', $var)->ruangan->nomor_ruangan);
        }
        return $data;
    }

    public function registrasiMatakuliah() {

        $matakuliah = Matakuliah::all()->pluck('id')->toArray;

       $data = [
           'kode_matkul' => array(),
           'nama_matkul' => array(),
           'jumlah_sks' => array(),
       ];

       foreach ($matakuliah as $var) {
            array_push($data['kode_matkul'], Matakuliah::firstWhere('id', $var)->kode_matkul);
            array_push($data['nama_matkul'], Matakuliah::firstWhere('id', $var)->nama_matkul);
            array_push($data['jumlah_sks'], Matakuliah::firstWhere('id', $var)->jumlah_sks);
       }

       return $data;
    }

}
