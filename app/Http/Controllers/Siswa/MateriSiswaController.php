<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MateriSiswaController extends Controller
{
    
    
    public function index(Request $request)
    {
        $sortOrder = $request->input('sort', 'asc');
    
        
        $materis = Materi::with('creator')->orderBy('judul', $sortOrder)->paginate(5);
    
        return view('siswa.materi.index', compact('materis', 'sortOrder'));
    }
          

    
    public function show(Materi $materi)
    {
        $materi->deskripsi = Str::of($materi->deskripsi)->markdown();
        return view('siswa.materi.show', compact('materi'));
    }
    

    
    public function download(Materi $materi)
    {
        $filePath = storage_path('app/public/' . $materi->file_path);
    
        if (file_exists($filePath)) {
            return response()->download($filePath, basename($materi->file_path)); 
        } else {
            return redirect()->route('siswa.materi.index')->with('error', 'File tidak ditemukan');
        }
    }     
     
}
