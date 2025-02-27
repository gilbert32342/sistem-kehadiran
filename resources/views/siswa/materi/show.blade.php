@extends('layouts.app')

@section('content')
<div class="container mx-auto p-5">
    <h2 class="text-2xl font-bold mb-4">{{ $materi->judul }}</h2>
    <p class="text-gray-600 mb-2">Diuplode oleh: <strong>{{ $materi->creator->name ?? 'Admin' }}</strong></p>
    <div class="text-gray-600 mb-4 prose">
        {!! $materi->deskripsi !!}
    </div>    
    

    @if($materi->file_path)
    <div>
        <h3 class="text-lg font-semibold mb-2">Unduh Materi</h3>
        <a href="{{ route('siswa.materi.download', $materi->id) }}" class="text-blue-500 flex items-center">
            <i class="fas fa-download mr-2"></i> Unduh File ({{ strtoupper(pathinfo($materi->file_path, PATHINFO_EXTENSION)) }})
        </a>
    </div>
    @else
    <p>Tidak ada file untuk materi ini.</p>
    @endif

    <div class="mt-4">
        <a href="{{ route('siswa.materi.index') }}" class="text-blue-500">Kembali ke Daftar Materi</a>
    </div>
</div>
@endsection
