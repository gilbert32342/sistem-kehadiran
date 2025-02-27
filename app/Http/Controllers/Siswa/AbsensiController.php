<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsensiController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $absensi = Absensi::where('user_id', $user->id)
                          ->where('role', 'siswa') // Pastikan role siswa
                          ->orderBy('tanggal', 'desc')
                          ->get();
        

        return view('siswa.absensi.index', compact('absensi'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'status' => 'required|in:hadir,izin,sakit,alpha',
        ]);
    
        $user = Auth::user(); // Ambil data user yang sedang login
    
        if ($user->role !== 'siswa') {
            return redirect()->route('siswa.absensi.index')->with('error', 'Hanya siswa yang bisa melakukan absensi.');
        }
    
        // Simpan data absensi
        Absensi::create([
            'user_id' => $user->id,
            'nama' => $user->name ?? 'Tidak diketahui',  // Pastikan nama diisi
            'nis' => $user->nis ?? null, // Simpan NIS
            'kelas' => $user->kelas ?? 'Tidak diketahui', // Simpan Kelas
            'status' => $request->status,
            'tanggal' => now(),
            'role' => 'siswa',
        ]);        
    
        return redirect()->route('siswa.absensi.index')->with('success', 'Absensi berhasil disimpan.');
    }
}
