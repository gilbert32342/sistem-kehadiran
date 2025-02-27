<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Absensi; // Pastikan kamu punya model Absensi yang sesuai
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatistikKehadiranController extends Controller
{
    public function index()
    {
        // Ambil data statistik kehadiran berdasarkan periode (harian, mingguan, atau bulanan)
        $attendanceData = Absensi::select(DB::raw('DATE(created_at) as tanggal'),
                                          DB::raw('SUM(CASE WHEN status = "hadir" THEN 1 ELSE 0 END) as hadir'),
                                          DB::raw('SUM(CASE WHEN status = "izin" THEN 1 ELSE 0 END) as izin'),
                                          DB::raw('SUM(CASE WHEN status = "sakit" THEN 1 ELSE 0 END) as sakit'),
                                          DB::raw('SUM(CASE WHEN status = "alpha" THEN 1 ELSE 0 END) as alpha'))
                                 ->groupBy(DB::raw('DATE(created_at)'))
                                 ->orderBy(DB::raw('DATE(created_at)'), 'desc')
                                 ->limit(30)
                                 ->get();
    
        // Hitung total per status
        $totalHadir = $attendanceData->sum('hadir');
        $totalIzin = $attendanceData->sum('izin');
        $totalSakit = $attendanceData->sum('sakit');
        $totalAlpha = $attendanceData->sum('alpha');
    
        // Kirim data ke view
        return view('admin.statistik-kehadiran', compact('attendanceData', 'totalHadir', 'totalIzin', 'totalSakit', 'totalAlpha'));
    }
    
}
