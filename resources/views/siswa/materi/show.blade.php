@extends('layouts.siswa')

@section('content')
<div class="container mx-auto p-5 animate-fade-in">
    
    <h2 class="text-3xl font-bold mb-6 text-gray-800">{{ $materi->judul }}</h2>
    <p class="text-gray-600 mb-4">Diunggah oleh: <strong class="text-blue-600">{{ $materi->creator->name ?? 'Admin' }}</strong></p>
    
    
    <div class="bg-gradient-to-r from-blue-50 to-purple-50 p-8 rounded-xl shadow-lg mb-6 transition duration-300 ease-in-out hover:shadow-xl animate-fade-in-up">
        <div class="prose max-w-none text-gray-700 space-y-4">
            {!! $materi->deskripsi !!}
        </div>
    </div>    

    
    @if($materi->file_path)
    <div class="bg-gradient-to-r from-blue-50 to-purple-50 p-8 rounded-xl shadow-lg mb-6 transition duration-300 ease-in-out hover:shadow-xl animate-fade-in-up">
        <h3 class="text-xl font-semibold mb-4 text-gray-800">Unduh Materi</h3>
        
        
        <p class="text-gray-600 mb-2"><strong>File:</strong> {{ basename($materi->file_path) }}</p>
        
        <a href="{{ route('siswa.materi.download', $materi->id) }}" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300 ease-in-out transform hover:scale-105">
            <i class="fas fa-download mr-2"></i> Unduh File
        </a>
    </div>
    @else
    <div class="bg-gradient-to-r from-blue-50 to-purple-50 p-8 rounded-xl shadow-lg mb-6 transition duration-300 ease-in-out hover:shadow-xl animate-fade-in-up">
        <p class="text-gray-600">Tidak ada file untuk materi ini.</p>
    </div>
    @endif

    
    <div class="mt-8 animate-fade-in">
        <a href="{{ route('siswa.materi.index') }}" class="inline-flex items-center px-6 py-3 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition duration-300 ease-in-out transform hover:scale-105">
            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Materi
        </a>
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

    /* Custom spacing for paragraphs inside prose */
    .prose p {
        margin-bottom: 1.5rem; /* Jarak antar paragraf */
    }

    /* Custom spacing for other elements if needed */
    .prose ul, .prose ol {
        margin-bottom: 1.5rem; /* Jarak antar list */
    }

    .prose h1, .prose h2, .prose h3, .prose h4, .prose h5, .prose h6 {
        margin-top: 2rem; /* Jarak di atas heading */
        margin-bottom: 1rem; /* Jarak di bawah heading */
    }
</style>
@endpush

@push('scripts')
<!-- FontAwesome jika belum ada di layouts.siswa -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>
@endpush
