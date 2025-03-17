@extends('layouts.guru')

@section('content')
<div class="max-w-4xl mx-auto mt-10 animate-fade-in">
    <div class="bg-white p-6 rounded-lg shadow-lg transform transition duration-300 ease-in-out hover:shadow-xl">
        <h2 class="text-2xl font-bold text-gray-700 mb-5 animate-fade-in-up">✏️ Edit Materi</h2>

        <form action="{{ route('guru.materi.update', $materi) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            
            <div class="mb-4 animate-fade-in-up">
                <label for="judul" class="block text-gray-600 font-semibold mb-2">Judul</label>
                <input type="text" id="judul" name="judul" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 transition duration-300 ease-in-out" value="{{ $materi->judul }}" required>
            </div>

            
            <div class="mb-4 animate-fade-in-up">
                <label for="deskripsi" class="block text-gray-600 font-semibold mb-2">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi" rows="4" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 transition duration-300 ease-in-out" required>{{ $materi->deskripsi }}</textarea>
            </div>

            
            <div class="mb-4 animate-fade-in-up">
                <label for="file" class="block text-gray-600 font-semibold mb-2">Upload File (Opsional)</label>
                <input type="file" id="file" name="file" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 transition duration-300 ease-in-out">
                
                @if ($materi->file_path)
                    <p class="text-gray-600 mt-2">📁 File saat ini: 
                        <a href="{{ asset('storage/' . $materi->file_path) }}" class="text-blue-500 underline hover:text-blue-700 transition duration-300 ease-in-out" target="_blank">
                            {{ basename($materi->file_path) }}
                        </a>
                    </p>
                @endif
            </div>

            
            <button type="submit" class="w-full py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 transition duration-300 ease-in-out transform hover:scale-105 animate-fade-in-up">
                ✅ Update Materi
            </button>
        </form>
    </div>
</div>
@endsection

@push('styles')
<style>
    .animate-fade-in {
        animation: fadeIn 0.6s ease-in-out;
    }

    .animate-fade-in-up {
        animation: fadeInUp 0.6s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
@endpush