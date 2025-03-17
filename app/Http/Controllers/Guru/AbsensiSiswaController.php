<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Absensi;
use Illuminate\Support\Facades\Auth;

class AbsensiSiswaController extends Controller
{
    public function index(Request $request)
    {
        $kelasList = User::where('role', 'siswa')->distinct()->pluck('kelas'); // Ambil daftar kelas unik
        $query = User::where('role', 'siswa');
    
        if ($request->has('kelas') && $request->kelas != '') {
            $query->where('kelas', $request->kelas);
        }
    
        $siswa = $query->get();
        
        return view('guru.absensi.siswa', compact('siswa', 'kelasList'));
    }    

    public function store(Request $request)
    {
        $request->validate([
            'absensi' => 'required|array',
            'absensi.*' => 'in:hadir,izin,sakit,alpha',
        ]);
    
        $guruId = Auth::id(); // ID guru yang login
        $tanggalHariIni = now()->toDateString();
        $errors = [];
    
        foreach ($request->absensi as $nis => $status) {
            $siswa = User::where('nis', $nis)->first();
    
            if ($siswa) {
                // Cek apakah siswa sudah diabsen hari ini
                $sudahAbsen = Absensi::where('user_id', $siswa->id)
                    ->where('tanggal', $tanggalHariIni)
                    ->exists();
    
                if ($sudahAbsen) {
                    // Tambahkan ke daftar error jika sudah absen
                    $errors[] = "Siswa dengan NIS {$siswa->nis} sudah diabsen hari ini.";
                    continue;
                }
    
                // Jika belum absen, simpan data absensi
                Absensi::create([
                    'user_id' => $siswa->id,
                    'nama' => $siswa->name,
                    'nis' => $siswa->nis,
                    'kelas' => $siswa->kelas, // ✅ Tambahkan kelas
                    'status' => $status,
                    'tanggal' => now(),
                    'role' => 'siswa',
                    'guru_id' => $guruId
                ]);                
            }
        }
    
        // Jika ada error, tampilkan pesan
        if (!empty($errors)) {
            return redirect()->route('guru.absensi.siswa')
                ->with('error', implode('<br>', $errors));
        }
    
        return redirect()->route('guru.absensi.siswa')->with('success', 'Absensi siswa berhasil disimpan.');
    }
    
}
