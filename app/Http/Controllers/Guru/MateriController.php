<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MateriController extends Controller
{

    public function index(Request $request)
    {
        $sortOrder = $request->input('sort', 'asc'); 
        $materis = Materi::where('created_by', Auth::id()) 
            ->orderBy('judul', $sortOrder)
            ->paginate(5); 

        return view('guru.materi.index', compact('materis', 'sortOrder'));
    }

    public function create()
    {
        return view('guru.materi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,xlsx,txt|max:2048',
        ]);
    
        $filePath = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = $file->getClientOriginalName(); 
            $filePath = $file->storeAs('materi_files', $filename, 'public');
        }
    
        Materi::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'file_path' => $filePath, 
            'created_by' => Auth::id(),
        ]);
    
        return redirect()->route('guru.materi.index')->with('success', '✅ Materi berhasil ditambahkan!');
    }
    

    public function edit(Materi $materi)
    {
        if ($materi->created_by !== Auth::id()) {
            return redirect()->route('guru.materi.index')->with('error', '❌ Anda tidak diizinkan mengedit materi ini.');
        }

        return view('guru.materi.edit', compact('materi'));
    }

    public function update(Request $request, Materi $materi)
    {
        if ($materi->created_by !== Auth::id()) {
            return redirect()->route('guru.materi.index')->with('error', '❌ Anda tidak diizinkan mengedit materi ini.');
        }

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,xlsx|max:2048',
        ]);

        if ($request->hasFile('file')) {
            if ($materi->file_path) {
                Storage::disk('public')->delete($materi->file_path);
            }
            $file = $request->file('file');
            $filename = $file->getClientOriginalName(); 
            $filePath = $file->storeAs('materi_files', $filename, 'public');            
            $materi->file_path = $filePath;
        }

        $materi->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'file_path' => $materi->file_path,
        ]);

        return redirect()->route('guru.materi.index')->with('success', '✅ Materi berhasil diperbarui!');
    }

    public function destroy(Materi $materi)
    {
        if ($materi->created_by !== Auth::id()) {
            return redirect()->route('guru.materi.index')->with('error', '❌ Anda tidak diizinkan menghapus materi ini.');
        }

        if ($materi->file_path) {
            Storage::disk('public')->delete($materi->file_path);
        }
        $materi->delete();

        return redirect()->route('guru.materi.index')->with('success', '❌ Materi berhasil dihapus!');
    }
}
