<?php

namespace App\Exports;

use App\Models\Absensi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\Auth;

class KehadiranExport implements FromCollection
{
    protected $siswaId;

    public function __construct($siswaId)
    {
        $this->siswaId = $siswaId;
    }

    public function collection()
    {
        return Absensi::where('siswa_id', $this->siswaId)->get(['tanggal', 'status', 'jumlah']);
    }
}

