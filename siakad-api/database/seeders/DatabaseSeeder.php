<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Admin;
use App\Models\Dosen;
use App\Models\Riwayat;
use App\Models\Ruangan;
use App\Models\Tagihan;
use App\Models\Fakultas;
use App\Models\Mengajar;
use App\Models\ListBiaya;
use App\Models\TahunAjar;
use App\Models\Matakuliah;
use App\Models\JadwalKuliah;
use App\Models\KartuStudiTetap;
use App\Models\RegistrasiUlang;
use Illuminate\Database\Seeder;
use App\Models\RegistrasiMatakuliah;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        ListBiaya::create([
            'harga_sks' => 225000,
            'harga_spp' => 1000000,
            'harga_layanan_kh' => 334000,
        ]);

        Fakultas::create([
            'nama_fakultas' => 'Fakultas Teknologi Informasi',
            'program_studi' => 'Teknik Informatika',
            'akreditasi_fakultas' => 'A',
        ]);
        Fakultas::create([
            'nama_fakultas' => 'Fakultas Teknologi Informasi',
            'program_studi' => 'Sistem Informasi',
            'akreditasi_fakultas' => 'A',
        ]);

        Fakultas::create([
            'nama_fakultas' => 'Fakultas Ekonomi dan Bisnis',
            'program_studi' => 'Manajemen',
            'akreditasi_fakultas' => 'A',
        ]);
        Fakultas::create([
            'nama_fakultas' => 'Fakultas Ekonomi dan Bisnis',
            'program_studi' => 'Ilmu Ekonomi',
            'akreditasi_fakultas' => 'A',
        ]);

        User::create([
            'nama_siswa' => 'Dinda Azis',
            'ttl_siswa' => 'Salatiga, 19-05-2001', 
            'agama' => 'Kristen',
            'nim' => '672019078',
            'alamat' => 'Jl. Kurniadi Salomo No.4, Salatiga',
            'nik' => '9802915419581',
            'no_kk' => '9802915419511',
            'no_hp' => '089694771643',
            'email' => 'dinda.azis@student.uksw.edu',
            'beban_sks' => 18,
            'fakultas_id' => 1,
            'tahun_ajar_id' => 1,
            'password' => Hash::make('dinda123')
        ]);
        User::create([
            'nama_siswa' => 'Gading Jurino',
            'ttl_siswa' => 'Salatiga, 19-05-2001', 
            'agama' => 'Kristen',
            'nim' => '692019079',
            'alamat' => 'Jl. Kurniadi Salomo No.4, Salatiga',
            'nik' => '9802915419580',
            'no_kk' => '9802915419512',
            'no_hp' => '0896947716555',
            'email' => 'gading.jurino@student.uksw.edu',
            'beban_sks' => 20,
            'fakultas_id' => 2,
            'tahun_ajar_id' => 1,
            'password' => Hash::make('gading123')
        ]);
        User::create([
            'nama_siswa' => 'Budi Yurdino',
            'ttl_siswa' => 'Salatiga, 19-05-2001', 
            'agama' => 'Kristen',
            'nim' => '672019011',
            'alamat' => 'Jl. Kurniadi Salomo No.4, Salatiga',
            'nik' => '9802915419892',
            'no_kk' => '9802915419888',
            'no_hp' => '0896947716111',
            'email' => 'budi.yurdino@student.uksw.edu',
            'beban_sks' => 16,            
            'fakultas_id' => 1,
            'tahun_ajar_id' => 1,
            'password' => Hash::make('budi123')
        ]);

        Dosen::create([
            'nama_dosen' => 'Agus Haryono',
            'nid' => '61532',
            'ttl_dosen' => 'Salatiga, 19-05-1995', 
            'agama' => 'Kristen',
            'nik' => '9802915411123',
            'no_kk' => '980291541156',
            'no_hp' => '0896947716098',
            'alamat' => 'Jl. Kurniadi Salomo No.4, Salatiga',
            'email' => 'agus.haryono@student.uksw.edu',
            'fakultas_id' => 1,
            'password' => Hash::make('agus123')
        ]);
        Dosen::create([
            'nama_dosen' => 'Doni Sudrajat',
            'nid' => '61500',
            'ttl_dosen' => 'Ketapang, 20-05-1997', 
            'agama' => 'Kristen',
            'nik' => '98029154112345',
            'no_kk' => '9802915445601',
            'no_hp' => '0896947716098',
            'alamat' => 'Jl. Masjid Babul Khair No.4, Ketapang',
            'email' => 'doni.sudrajat@student.uksw.edu',
            'fakultas_id' => 1,
            'password' => Hash::make('doni123')
        ]);
        Dosen::create([
            'nama_dosen' => 'Albertus Hornandes',
            'nid' => '32455',
            'ttl_dosen' => 'Salatiga, 19-08-1980', 
            'agama' => 'Kristen',
            'nik' => '98029154100145',
            'no_kk' => '9802915400187',
            'no_hp' => '0896947716098',
            'alamat' => 'Jl. Kurniadi Salomo No.4, Salatiga',
            'email' => 'albertus.hornandes@student.uksw.edu',
            'fakultas_id' => 1,
            'password' => Hash::make('agus123')
        ]);
        Dosen::create([
            'nama_dosen' => 'Taruna Purinusa',
            'nid' => '35021',
            'ttl_dosen' => 'Banten, 23-09-1989', 
            'agama' => 'Kristen',
            'nik' => '98029154134512',
            'no_kk' => '9802915440942',
            'no_hp' => '0896947716098',
            'alamat' => 'Jl. Kurniadi Salomo No.4, Salatiga',
            'email' => 'taruna.purinusa@student.uksw.edu',
            'fakultas_id' => 1,
            'password' => Hash::make('taruna123')
        ]);
        
        Admin::create([
            'username' => 'admin',
            'password' => Hash::make('admin123')
        ]);

        TahunAjar::create([
            'semester' => 1,
            'tahun_ajar' => '2021-2022',
        ]);

        Matakuliah::create([
            'kode_matkul' => 'IN332',
            'kode_huruf' => 'A',
            'nama_matkul' => 'SISTEM DIGITAL',
            'jumlah_sks' => 3,
            'sks_a' => 3,
            'sks_b' => 4,
        ]);
        Matakuliah::create([
            'kode_matkul' => 'IN392',
            'kode_huruf' => 'C',
            'nama_matkul' => 'ALGORITMA STRUKTUR DATA',
            'jumlah_sks' => 3,
            'sks_a' => 3,
            'sks_b' => 4,
        ]);
        Matakuliah::create([
            'kode_matkul' => 'IN322',
            'kode_huruf' => 'H',
            'nama_matkul' => 'REKAYASA PERANGKAT LUNAK',
            'jumlah_sks' => 3,
            'sks_a' => 3,
            'sks_b' => 3,
        ]);
        Matakuliah::create([
            'kode_matkul' => 'IN221',
            'kode_huruf' => 'F',
            'nama_matkul' => 'GRAFIKA KOMPUTER',
            'jumlah_sks' => 3,
            'sks_a' => 3,
            'sks_b' => 3,
        ]);

        RegistrasiUlang::create([
            'waktu_mulai' => date('Y-m-d', strtotime('27-03-2022')),
            'waktu_berakhir' => date('Y-m-d', strtotime('01-04-2022')),
            'semester' => 1,
            'tahun_ajar' => '2021-2022',
            'user_id' => 1,
        ]);
        RegistrasiUlang::create([
            'waktu_mulai' => date('Y-m-d', strtotime('27-03-2022')),
            'waktu_berakhir' => date('Y-m-d', strtotime('01-04-2022')),
            'semester' => 1,
            'tahun_ajar' => '2021-2022',
            'user_id' => 2,
        ]);
        RegistrasiUlang::create([
            'waktu_mulai' => date('Y-m-d', strtotime('27-03-2022')),
            'waktu_berakhir' => date('Y-m-d', strtotime('01-04-2022')),
            'semester' => 1,
            'tahun_ajar' => '2021-2022',
            'user_id' => 3,
        ]);

        RegistrasiMatakuliah::create([
            'waktu_mulai' => date('Y-m-d h:i:s ', strtotime('30-03-2022 09:00:00')),
            'waktu_berakhir' => date('Y-m-d h:i:s', strtotime('30-03-2022 11:00:00')),
            'fakultas_id' => 1,
        ]);

        Ruangan::create([
            'nomor_ruangan' => 'FTI445'
        ]);
        Ruangan::create([
            'nomor_ruangan' => 'FTI446'
        ]);
        Ruangan::create([
            'nomor_ruangan' => 'FTI447'
        ]);
        Ruangan::create([
            'nomor_ruangan' => 'FTI448'
        ]);
        
        Mengajar::create([
            'hari_kuliah' => 'Senin',
            'jam_kuliah' => date('h', strtotime('16:00:00')).date('\_h', strtotime('18:00:00')),
            'kursi_tersedia' => 40,
            'kursi_terpilih' => 0,
            'dosen_id' => 1,
            'matakuliah_id' => 1,
            'ruangan_id' => 1,
        ]);
        Mengajar::create([
            'hari_kuliah' => 'Selasa',
            'jam_kuliah' => date('h', strtotime('16:00:00')).date('\_h', strtotime('18:00:00')),
            'kursi_tersedia' => 40,
            'kursi_terpilih' => 0,
            'dosen_id' => 2,
            'matakuliah_id' => 2,
            'ruangan_id' => 2,
        ]);
        Mengajar::create([
            'hari_kuliah' => 'Kamis',
            'jam_kuliah' => date('h', strtotime('12:00:00')).date('\_h', strtotime('14:00:00')),
            'kursi_tersedia' => 40,
            'kursi_terpilih' => 12,
            'dosen_id' => 3,
            'matakuliah_id' => 3,
            'ruangan_id' => 3,
        ]);
        Mengajar::create([
            'hari_kuliah' => 'Jumat',
            'jam_kuliah' => date('h', strtotime('16:00:00')).date('\_h', strtotime('18:00:00')),
            'kursi_tersedia' => 40,
            'kursi_terpilih' => 0,
            'dosen_id' => 4,
            'matakuliah_id' => 4,
            'ruangan_id' => 4,
        ]);

        KartuStudiTetap::create([
            'b/u' => 'b',
            'mengajar_id' => 1,
            'user_id' => 1,
        ]);
        KartuStudiTetap::create([
            'b/u' => 'b',
            'mengajar_id' => 2,
            'user_id' => 1,
        ]);
        KartuStudiTetap::create([
            'b/u' => 'b',
            'mengajar_id' => 3,
            'user_id' => 1,
        ]);
        KartuStudiTetap::create([
            'b/u' => 'b',
            'mengajar_id' => 4,
            'user_id' => 1,
        ]);

        KartuStudiTetap::create([
            'b/u' => 'b',
            'mengajar_id' => 1,
            'user_id' => 2,
        ]);
        KartuStudiTetap::create([
            'b/u' => 'b',
            'mengajar_id' => 2,
            'user_id' => 2,
        ]);
        KartuStudiTetap::create([
            'b/u' => 'b',
            'mengajar_id' => 3,
            'user_id' => 2,
        ]);

        JadwalKuliah::create([
            'kartu_studi_tetap_id' => 1,
            'user_id' => 1,
        ]);
        JadwalKuliah::create([
            'kartu_studi_tetap_id' => 2,
            'user_id' => 1,
        ]);
        JadwalKuliah::create([
            'kartu_studi_tetap_id' => 3,
            'user_id' => 1,
        ]);
        JadwalKuliah::create([
            'kartu_studi_tetap_id' => 4,
            'user_id' => 1,
        ]);

        $user = User::find(1)->kartu_studi_tetap->pluck('mengajar_id')->toArray();
        $uang_kuliah = 0;
        foreach ($user as $usr) {
            $uang_kuliah += Mengajar::find($usr)->matakuliah->sks_b * ListBiaya::first()->harga_sks;
        }
        
        Tagihan::create([
            'uang_kuliah' => $uang_kuliah,
            'uang_spp' => ListBiaya::first()->harga_spp,
            'uang_denda' => 0,
            'layanan_kh' => ListBiaya::first()->harga_layanan_kh,
            'total_hutang' => $uang_kuliah+ListBiaya::first()->harga_spp+ListBiaya::first()->harga_layanan_kh,
            'harus_dibayar' => 1800000,
            'sudah_dibayar' => 2684000,
            'jatuh_tempo' => '07 Jan 2022',
            'tempo_pelunasan' => '18 Feb 2022',
            'user_id' => 1,
        ]);
    }
}
