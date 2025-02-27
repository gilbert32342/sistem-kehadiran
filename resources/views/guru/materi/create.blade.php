@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10">
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-5 text-gray-700">📚 Tambah Materi</h2>

        <form action="{{ route('guru.materi.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Judul -->
            <div class="mb-4">
                <label class="block text-gray-600 font-semibold mb-2">Judul Materi</label>
                <input type="text" name="judul" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Masukkan judul materi" required>
            </div>

            <!-- Deskripsi -->
            <div class="mb-4">
                <label class="block text-gray-600 font-semibold mb-2">Deskripsi</label>
                <textarea name="deskripsi" rows="4" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Tambahkan deskripsi materi..." required></textarea>
            </div>

            <!-- Upload File -->
            <div class="mb-4">
                <label class="block text-gray-600 font-semibold mb-2">Upload File (Opsional)</label>
                <input type="file" name="file" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <!-- Tombol Submit -->
            <button type="submit" class="w-full py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 transition">
                🚀 Simpan Materi
            </button>
        </form>
    </div>
</div>
@endsection
