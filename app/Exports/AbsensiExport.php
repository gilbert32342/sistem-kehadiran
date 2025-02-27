<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AbsensiExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        // Ambil data absensi siswa
        $siswa = DB::table('absensis')
            ->join('users', 'users.id', '=', 'absensis.user_id')
            ->select(
                DB::raw("'Siswa' as peran"), // Tandai sebagai siswa
                'users.nis as identifier', // Gunakan NIS untuk siswa
                'users.name',
                'users.kelas',
                'absensis.status',
                'absensis.tanggal',
                DB::raw('COUNT(*) as jumlah')
            )
            ->where('users.role', 'siswa')
            ->groupBy('absensis.user_id', 'users.nis', 'users.name', 'users.kelas', 'absensis.status', 'absensis.tanggal');

        // Ambil data absensi guru
        $guru = DB::table('absensis')
            ->join('users', 'users.id', '=', 'absensis.user_id')
            ->select(
                DB::raw("'Guru' as peran"), // Tandai sebagai guru
                'users.nip as identifier', // Gunakan NIP untuk guru
                'users.name',
                DB::raw("NULL as kelas"), // Guru tidak memiliki kelas
                'absensis.status',
                'absensis.tanggal',
                DB::raw('COUNT(*) as jumlah')
            )
            ->where('users.role', 'guru')
            ->groupBy('absensis.user_id', 'users.nip', 'users.name', 'absensis.status', 'absensis.tanggal');

        // Gabungkan data siswa & guru
        return $siswa->union($guru)->orderBy('tanggal', 'desc')->get();
    }
    
    public function headings(): array
    {
        return ["Peran", "NIS/NIP", "Nama", "Kelas", "Status", "Tanggal", "Jumlah"];
    }
}
