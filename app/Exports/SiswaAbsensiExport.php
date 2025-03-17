<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SiswaAbsensiExport implements FromArray, WithHeadings, WithStyles
{
    public function array(): array
    {
        // Ambil data absensi siswa
        $data = DB::table('absensis')
            ->join('users', 'users.id', '=', 'absensis.user_id')
            ->select(
                'users.nis as identifier', // Gunakan NIS untuk siswa
                'users.name',
                'users.kelas',
                'absensis.status',
                'absensis.tanggal'
            )
            ->where('users.role', 'siswa')
            ->orderBy('absensis.tanggal', 'desc')
            ->get();

        $result[] = ["LAPORAN ABSENSI SISWA", '', '', '', ''];
        $result[] = ["NIS", "Nama", "Kelas", "Status", "Tanggal"];

        // Jika tidak ada data, tambahkan placeholder
        if ($data->isEmpty()) {
            $result[] = ['Tidak ada data', '', '', '', ''];
        } else {
            foreach ($data as $item) {
                $result[] = [
                    $item->identifier,
                    $item->name,
                    $item->kelas,
                    $item->status,
                    $item->tanggal
                ];
            }
        }

        return $result;
    }

    public function headings(): array
    {
        return []; // Heading diatur di dalam array(), agar bisa ada baris tambahan
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'size' => 14]], // Judul besar & bold
            2 => ['font' => ['bold' => true]], // Heading tabel bold
        ];
    }
}
