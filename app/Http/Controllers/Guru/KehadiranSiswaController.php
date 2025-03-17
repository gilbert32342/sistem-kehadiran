<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Absensi;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AbsensiExport;
use App\Exports\SiswaAbsensiExport;
use Barryvdh\DomPDF\Facade\Pdf;

class KehadiranSiswaController extends Controller
{
    public function index(Request $request)
    {
        
        $kelas = $request->get('kelas');
        $status = $request->get('status');

        
        $kelasList = Absensi::where('role', 'siswa')->select('kelas')->distinct()->pluck('kelas')->toArray();
        $kelasRomawi = $this->convertKelasToRoman($kelasList);

        
        $query = Absensi::where('role', 'siswa');

        if ($kelas) {
            $query->where('kelas', $kelas);
        }

        if ($status) {
            $query->where('status', $status);
        }

        
        $absensi = $query->orderBy('tanggal', 'desc')->paginate(5);

        return view('guru.kehadiran.index', compact('absensi', 'kelasRomawi', 'kelas'));
    }

    
    private function convertKelasToRoman($kelasList)
    {
        $map = [
            1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV', 5 => 'V',
            6 => 'VI', 7 => 'VII', 8 => 'VIII', 9 => 'IX', 10 => 'X',
            11 => 'XI', 12 => 'XII'
        ];

        $kelasRomawi = [];
        foreach ($kelasList as $kelas) {
            $kelasRomawi[$kelas] = $map[$kelas] ?? $kelas; 
        }

        return $kelasRomawi;
    }

    
    public function exportExcel(Request $request)
    {
        $kelas = $request->get('kelas');
        $status = $request->get('status');

        $query = Absensi::where('role', 'siswa');
        if ($kelas) {
            $query->where('kelas', $kelas);
        }
        if ($status) {
            $query->where('status', $status);
        }

        $absensi = $query->get();

        return Excel::download(new SiswaAbsensiExport(), 'riwayat-kehadiran-siswa.xlsx');
    }

    
    public function exportPDF(Request $request)
    {
        $kelas = $request->get('kelas');
        $status = $request->get('status');

        $query = Absensi::where('role', 'siswa');
        if ($kelas) {
            $query->where('kelas', $kelas);
        }
        if ($status) {
            $query->where('status', $status);
        }

        $absensi = $query->get();
        $pdf = Pdf::loadView('guru.kehadiran.pdf', compact('absensi'));

        return $pdf->download('riwayat-kehadiran-siswa.pdf');
    }
}
