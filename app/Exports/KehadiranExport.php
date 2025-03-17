<?php

namespace App\Exports;

use App\Models\Absensi;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class KehadiranExport implements FromArray, WithStyles
{
    protected $siswa;

    public function __construct($siswaId)
    {
        $this->siswa = User::find($siswaId); // Ambil data siswa
    }

    public function array(): array
    {
        $data = Absensi::where('user_id', $this->siswa->id)->get(['tanggal', 'status', 'jumlah']);
    
        // Nama siswa berada di bawah label "Nama Siswa:"
        $result[] = ['Nama Siswa:', '', '']; // Label
        $result[] = [$this->siswa->name, '', '']; // Nama siswa di baris bawahnya
        $result[] = ['', '', '']; // Baris kosong untuk pemisah

        // Heading tabel
        $result[] = ['Tanggal', 'Status', 'Jumlah'];
    
        // Jika tidak ada data, tambahkan placeholder
        if ($data->isEmpty()) {
            $result[] = ['Data tidak tersedia', '', ''];
        } else {
            // Tambahkan data absensi ke array
            foreach ($data as $item) {
                $result[] = [
                    $item->tanggal,
                    $item->status,
                    $item->jumlah,
                ];
            }
        }
    
        return $result;
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14); // Label "Nama Siswa:" lebih besar
        $sheet->getStyle('A2')->getFont()->setBold(true)->setSize(12); // Nama siswa bold lebih kecil
        $sheet->getStyle('A4:C4')->getFont()->setBold(true); // Heading tabel bold
        
        return [];
    }
}
