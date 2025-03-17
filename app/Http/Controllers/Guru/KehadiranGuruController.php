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
        $guru = Auth::user(); 
        $kehadiran = Absensi::where('user_id', $guru->id)
                            ->where('role', 'guru') 
                            ->orderBy('tanggal', 'desc')
                            ->paginate(10); 
    
        return view('guru.kehadiran.guru', compact('kehadiran', 'guru'));
    }    
       
    public function exportGuruExcel()
    {
        $guru = Auth::user(); 
        $fileName = 'kehadiran_' . str_replace(' ', '_', strtolower($guru->name)) . '.xlsx'; 
    
        return Excel::download(new GuruAbsensiExport($guru->id), $fileName);
    }    
}
