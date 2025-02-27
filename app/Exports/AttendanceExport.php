<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class AttendanceExport implements FromCollection
{
    public function collection()
    {
        return User::all(); // Gantilah dengan query kehadiran sesuai kebutuhan
    }
}
