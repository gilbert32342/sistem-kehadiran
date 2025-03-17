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
        $siswa = Auth::user(); 
        $kehadiran = Absensi::where('user_id', $siswa->id)
                            ->orderBy('tanggal', 'desc')
                            ->paginate(10); 
    
        return view('siswa.kehadiran.index', compact('kehadiran', 'siswa'));
    }
       
    public function export()
    {
        $siswa = Auth::user(); 
        $fileName = 'kehadiran_' . str_replace(' ', '_', strtolower($siswa->name)) . '.xlsx'; 
    
        return Excel::download(new KehadiranExport($siswa->id), $fileName);
    }    
}
