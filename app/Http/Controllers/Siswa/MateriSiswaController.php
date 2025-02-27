<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MateriSiswaController extends Controller
{
    
    // Fungsi untuk menampilkan daftar materi
    public function index(Request $request)
    {
        $sortOrder = $request->input('sort', 'asc');
    
        // Pastikan memuat data pembuat materi (guru/admin)
        $materis = Materi::with('creator')->orderBy('judul', $sortOrder)->paginate(5);
    
        return view('siswa.materi.index', compact('materis', 'sortOrder'));
    }
          

    // Fungsi untuk menampilkan detail materi
    public function show(Materi $materi)
    {
        $materi->deskripsi = Str::of($materi->deskripsi)->markdown();
        return view('siswa.materi.show', compact('materi'));
    }
    

    // ✅ Fungsi untuk mengunduh materi dengan nama yang sesuai
    public function download(Materi $materi)
    {
        $filePath = storage_path('app/public/' . $materi->file_path);

        if (file_exists($filePath)) {
            $namaFile = $materi->judul . '.' . pathinfo($filePath, PATHINFO_EXTENSION);
            return response()->download($filePath, $namaFile);
        } else {
            return redirect()->route('siswa.materi.index')->with('error', 'File tidak ditemukan');
        }
    }
}
