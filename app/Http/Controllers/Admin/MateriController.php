<?php

namespace App\Http\Controllers\Admin;

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
    
        $materis = Materi::with('creator') // Tambahkan eager loading user
            ->orderBy('judul', $sortOrder)
            ->paginate(5);
    
        return view('admin.materi.index', compact('materis', 'sortOrder'));
    }    
    
    public function create()
    {
        return view('admin.materi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,xlsx,txt,jpg,png|max:2048',
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = $file->getClientOriginalName(); // Gunakan nama asli tanpa tambahan angka
            $filePath = $file->storeAs('materi_files', $filename, 'public');            
        }

        Materi::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'file_path' => $filePath, 
            'created_by' => Auth::id(), // ✅ Simpan ID pembuat materi
        ]);

        return redirect()->route('admin.materi.index')->with('success', '✅ Materi berhasil ditambahkan!');
    }

    public function edit(Materi $materi)
    {
        return view('admin.materi.edit', compact('materi'));
    }

    public function update(Request $request, Materi $materi)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,xlsx,txt,jpg,png|max:2048',
        ]);

        if ($request->hasFile('file')) {
            if ($materi->file_path) {
                Storage::disk('public')->delete($materi->file_path);
            }
            $file = $request->file('file');
            $filename = $file->getClientOriginalName(); // Gunakan nama asli tanpa tambahan angka
            $filePath = $file->storeAs('materi_files', $filename, 'public');            
            $materi->file_path = $filePath;            
        }

        $materi->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'file_path' => $materi->file_path,
        ]);

        return redirect()->route('admin.materi.index')->with('success', '✅ Materi berhasil diperbarui!');
    }

    public function deleteFile($id)
    {
        $materi = Materi::findOrFail($id);
    
        if ($materi->file_path) {
            // Hapus file dari storage
            Storage::delete('public/' . $materi->file_path);
    
            // Set kolom file_path menjadi null
            $materi->file_path = null;
            $materi->save();
    
            return response()->json(['success' => true, 'message' => 'File berhasil dihapus.']);
        }
    
        return response()->json(['success' => false, 'message' => 'File tidak ditemukan.'], 404);
    }

    public function destroy(Materi $materi)
    {
        if ($materi->file_path) {
            Storage::disk('public')->delete($materi->file_path);
        }
        $materi->delete();

        return redirect()->route('admin.materi.index')->with('success', '❌ Materi berhasil dihapus!');
    }
}
