<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MateriSeeder extends Seeder
{
    /**
     * Jalankan database seeders.
     */
    public function run(): void
    {
        DB::table('materis')->insert([
            [
                'judul' => 'Pengenalan Laravel',
                'deskripsi' => 'Materi ini membahas dasar-dasar Laravel dan bagaimana cara menggunakannya.',
                'file_path' => 'uploads/materi/laravel.pdf',
                'created_by' => 2, // ID guru
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Struktur Database MySQL',
                'deskripsi' => 'Materi ini menjelaskan struktur tabel dan hubungan antar tabel dalam database MySQL.',
                'file_path' => 'uploads/materi/mysql.pdf',
                'created_by' => 2, // ID guru
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Dasar-dasar JavaScript',
                'deskripsi' => 'Materi ini membahas sintaks dasar dan konsep JavaScript untuk pemula.',
                'file_path' => 'uploads/materi/javascript.pdf',
                'created_by' => 3, // ID guru lain
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
