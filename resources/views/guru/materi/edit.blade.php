@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10">
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-gray-700 mb-5">✏️ Edit Materi</h2>

        <form action="{{ route('guru.materi.update', $materi) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Judul -->
            <div class="mb-4">
                <label for="judul" class="block text-gray-600 font-semibold mb-2">Judul</label>
                <input type="text" id="judul" name="judul" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" value="{{ $materi->judul }}" required>
            </div>

            <!-- Deskripsi -->
            <div class="mb-4">
                <label for="deskripsi" class="block text-gray-600 font-semibold mb-2">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi" rows="4" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>{{ $materi->deskripsi }}</textarea>
            </div>

            <!-- File Materi -->
            <div class="mb-4">
                <label for="file" class="block text-gray-600 font-semibold mb-2">Upload File (Opsional)</label>
                <input type="file" id="file" name="file" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                
                @if ($materi->file_path)
                    <p class="text-gray-600 mt-2">📁 File saat ini: 
                        <a href="{{ asset('storage/' . $materi->file_path) }}" class="text-blue-500 underline" target="_blank">
                            {{ basename($materi->file_path) }}
                        </a>
                    </p>
                @endif
            </div>

            <!-- Tombol Submit -->
            <button type="submit" class="w-full py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 transition">
                ✅ Update Materi
            </button>
        </form>
    </div>
</div>
@endsection
