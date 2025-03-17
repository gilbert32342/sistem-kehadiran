<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use Illuminate\Http\Request;

class StatistikKehadiranController extends Controller
{
    public function index()
    {
        return $this->statistik(); // Arahkan ke fungsi statistik()
    }

    public function statistik()
    {
        $totalSiswaHadir = Absensi::where('role', 'siswa')->where('status', 'hadir')->count();
        $totalGuruHadir = Absensi::where('role', 'guru')->where('status', 'hadir')->count();

        $labels = [];
        $dataSiswa = [];
        $dataGuru = [];

        for ($i = 6; $i >= 0; $i--) {
            $tanggal = now()->subDays($i)->toDateString();
            $labels[] = now()->subDays($i)->format('D');

            $dataSiswa[] = Absensi::whereDate('created_at', $tanggal)
                ->where('role', 'siswa')
                ->where('status', 'hadir')
                ->count();

            $dataGuru[] = Absensi::whereDate('created_at', $tanggal)
                ->where('role', 'guru')
                ->where('status', 'hadir')
                ->count();
        }

        return view('admin.statistik', compact('totalSiswaHadir', 'totalGuruHadir', 'labels', 'dataSiswa', 'dataGuru'));
    }
}
