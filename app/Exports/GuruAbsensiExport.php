<?php

namespace App\Exports;

use App\Models\Absensi;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class GuruAbsensiExport implements FromArray, WithHeadings, WithStyles
{
    protected $guru;

    public function __construct($guruId)
    {
        $this->guru = User::find($guruId); // Ambil data guru berdasarkan ID
    }

    public function array(): array
    {
        $data = Absensi::where('user_id', $this->guru->id)
                      ->where('role', 'guru')
                      ->orderBy('tanggal', 'desc')
                      ->get(['tanggal', 'status']);

        // Data awal dengan nama & NIP guru
        $result[] = ["Nama Guru: " . $this->guru->name, '', ''];
        $result[] = ["NIP: " . $this->guru->nip, '', ''];
        $result[] = ["Tanggal", "Status"];

        // Jika tidak ada data, tambahkan placeholder
        if ($data->isEmpty()) {
            $result[] = ['Data tidak tersedia', ''];
        } else {
            foreach ($data as $item) {
                $result[] = [
                    'Tanggal' => $item->tanggal,
                    'Status' => $item->status,
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
            1 => ['font' => ['bold' => true, 'size' => 14]], // Nama guru lebih besar & bold
            2 => ['font' => ['bold' => true]], // NIP bold
            3 => ['font' => ['bold' => true]], // Heading tabel bold
        ];
    }
}
