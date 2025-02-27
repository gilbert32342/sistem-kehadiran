<?php

namespace App\Http\Controllers\Guru;

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
                          ->where('role', 'guru') // Pastikan role guru
                          ->orderBy('tanggal', 'desc')
                          ->get();
    
        return view('guru.absensi.index', compact('absensi'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'status' => 'required|in:hadir,izin,sakit,alpha',
        ]);
    
        $user = Auth::user();
    
        if ($user->role !== 'guru') {
            return redirect()->route('guru.absensi.index')->with('error', 'Hanya guru yang bisa melakukan absensi.');
        }
    
        // ✅ Cek apakah guru sudah absen hari ini
        $tanggalHariIni = now()->toDateString();
        $existingAbsensi = Absensi::where('user_id', $user->id)
            ->whereDate('tanggal', $tanggalHariIni)
            ->first();
    
        if ($existingAbsensi) {
            return redirect()->route('guru.absensi.index')->with('error', 'kamu udah absen hari ini.');
        }
    
        // ✅ Simpan absensi jika belum ada
        Absensi::create([
            'user_id' => $user->id,
            'nama' => $user->name ?? 'Tidak diketahui',
            'nip' => $user->nip ?? 'Tidak ada NIP', // Tambahkan NIP jika diperlukan
            'status' => $request->status,
            'tanggal' => now(),
            'role' => 'guru',
        ]);
    
        return redirect()->route('guru.absensi.index')->with('success', 'Absensi berhasil disimpan.');
    }    
}
