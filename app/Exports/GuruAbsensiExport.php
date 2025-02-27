<?php

namespace App\Exports;

use App\Models\Absensi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class GuruAbsensiExport implements FromCollection, WithHeadings
{
    protected $guruId;

    public function __construct($guruId)
    {
        $this->guruId = $guruId;
    }

    public function collection()
    {
        return Absensi::where('user_id', $this->guruId)
                      ->where('role', 'guru')
                      ->orderBy('tanggal', 'desc')
                      ->select('tanggal', 'nama', 'nip', 'status')
                      ->get();
    }

    public function headings(): array
    {
        return ["Tanggal", "Nama", "NIP", "Status"];
    }
}
