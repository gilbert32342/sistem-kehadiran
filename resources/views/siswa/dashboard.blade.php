@extends('layouts.siswa')

@section('page_title', 'Dashboard Siswa')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

    <!-- Riwayat Kehadiran -->
    <a href="{{ route('siswa.kehadiran.index') }}" class="bg-white shadow-md rounded-lg p-6 flex items-center space-x-4 hover:shadow-lg transition">
        <i class="fas fa-history text-purple-500 text-3xl"></i>
        <div>
            <h3 class="text-lg font-semibold">Riwayat Kehadiran</h3>
            <p class="text-gray-500 text-sm">Tinjau kehadiran Anda selama periode tertentu.</p>
        </div>
    </a>

    <!-- Materi Pembelajaran -->
    <a href="{{ route('siswa.materi.index') }}" class="bg-white shadow-md rounded-lg p-6 flex items-center space-x-4 hover:shadow-lg transition">
        <i class="fas fa-book text-blue-500 text-3xl"></i>
        <div>
            <h3 class="text-lg font-semibold">Materi Pembelajaran</h3>
            <p class="text-gray-500 text-sm">Akses materi yang diberikan oleh guru.</p>
        </div>
    </a>
</div>
@endsection
