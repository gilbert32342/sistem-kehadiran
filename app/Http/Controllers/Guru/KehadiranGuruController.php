<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Absensi;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\GuruAbsensiExport;

class KehadiranGuruController extends Controller
{
    public function index()
    {
        $guru = Auth::user(); // Ambil data guru yang login
        $kehadiran = Absensi::where('user_id', $guru->id)
                            ->where('role', 'guru') // Pastikan hanya untuk guru
                            ->orderBy('tanggal', 'desc')
                            ->paginate(10); // Pagination 10 data per halaman
    
        return view('guru.kehadiran.guru', compact('kehadiran', 'guru'));
    }    
       
    public function exportGuruExcel()
    {
        $guru = Auth::user(); // Ambil data guru yang sedang login
        $fileName = 'kehadiran_' . str_replace(' ', '_', strtolower($guru->name)) . '.xlsx'; // Nama file dinamis
    
        return Excel::download(new GuruAbsensiExport($guru->id), $fileName);
    }    
}
