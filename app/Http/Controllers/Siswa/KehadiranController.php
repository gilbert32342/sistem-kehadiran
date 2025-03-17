<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Absensi;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\KehadiranExport;

class KehadiranController extends Controller
{
    public function index()
    {
        $siswa = Auth::user(); // Ambil siswa yang login
        $kehadiran = Absensi::where('user_id', $siswa->id)
                            ->orderBy('tanggal', 'desc')
                            ->paginate(10); // Pagination 10 data per halaman
    
        return view('siswa.kehadiran.index', compact('kehadiran', 'siswa'));
    }
       
    public function export()
    {
        $siswa = Auth::user(); // Ambil data siswa yang sedang login
        $fileName = 'kehadiran_' . str_replace(' ', '_', strtolower($siswa->name)) . '.xlsx'; // Nama file dinamis
    
        return Excel::download(new KehadiranExport($siswa->id), $fileName);
    }    
}
