<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Absensi;
use Carbon\Carbon;

class AbsensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data siswa
        Absensi::create([
            'user_id' => 3, // Sesuaikan dengan ID siswa di database
            'nis' => '2200112233', 
            'nama' => 'Siswa A',
            'kelas' => 'X IPA 1',
            'status' => 'hadir',
            'jumlah' => 1,
            'tanggal' => Carbon::now()->toDateString(),
            'siswa_id' => 3, // Sesuaikan dengan ID siswa di tabel users
            'role' => 'siswa',
        ]);

        // Data guru (Pastikan nis diisi NULL agar tidak error)
        Absensi::create([
            'user_id' => 2, // Sesuaikan dengan ID guru di database
            'nip' => '9876543210',
            'nama' => 'Guru Matematika',
            'kelas' => null, // Guru tidak punya kelas
            'status' => 'hadir',
            'jumlah' => 1,
            'tanggal' => Carbon::now()->toDateString(),
            'siswa_id' => null, // Guru tidak punya siswa_id
            'role' => 'guru',
        ]);

        // Data siswa izin
        Absensi::create([
            'user_id' => 3,
            'nis' => '2200112233', 
            'nama' => 'Siswa A',
            'kelas' => 'X IPA 1',
            'status' => 'izin',
            'jumlah' => 1,
            'tanggal' => Carbon::yesterday()->toDateString(),
            'siswa_id' => 3,
            'role' => 'siswa',
        ]);
    }
}
