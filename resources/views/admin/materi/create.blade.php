@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10">
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-5 text-gray-700">📚 Tambah Materi</h2>

        <form action="{{ route('admin.materi.store') }}" method="POST" enctype="multipart/form-data">
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
                <input type="file" id="fileInput" name="file" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                
                <!-- Tempat menampilkan file yang dipilih -->
                <div id="fileContainer" class="mt-2 hidden">
                    <p class="text-gray-600">📁 File dipilih: 
                        <span id="fileName" class="text-blue-500"></span>
                    </p>
                    <button type="button" id="deleteFileBtn" class="ml-2 text-red-500 hover:text-red-700 text-lg font-bold">
                        ❌
                    </button>
                </div>
            </div>

            <!-- Tombol Submit -->
            <button type="submit" class="w-full py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 transition">
                🚀 Simpan Materi
            </button>
        </form>
    </div>
</div>

<!-- Script untuk Menampilkan dan Menghapus File yang Dipilih -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    const fileInput = document.getElementById("fileInput");
    const fileContainer = document.getElementById("fileContainer");
    const fileName = document.getElementById("fileName");
    const deleteFileBtn = document.getElementById("deleteFileBtn");

    fileInput.addEventListener("change", function () {
        if (fileInput.files.length > 0) {
            fileName.textContent = fileInput.files[0].name;
            fileContainer.classList.remove("hidden");
        }
    });

    deleteFileBtn.addEventListener("click", function () {
        fileInput.value = "";  // Reset input file
        fileContainer.classList.add("hidden");
        fileName.textContent = "";
    });
});
</script>
@endsection
