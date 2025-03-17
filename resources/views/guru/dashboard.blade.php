@extends('layouts.guru')

@section('page_title', 'Dashboard Guru')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <!-- Materi Pembelajaran -->
    <a href="{{ route('guru.materi.index') }}" class="bg-white shadow-md rounded-lg p-6 flex items-center space-x-4 hover:shadow-lg transition">
        <i class="fas fa-book text-blue-500 text-3xl"></i>
        <div>
            <h3 class="text-lg font-semibold">Materi Pembelajaran</h3>
            <p class="text-gray-500 text-sm">Kelola dan unggah materi pembelajaran.</p>
        </div>
    </a>

    <!-- Presensi Guru -->
    <a href="{{ route('guru.absensi.index') }}" class="bg-white shadow-md rounded-lg p-6 flex items-center space-x-4 hover:shadow-lg transition">
        <i class="fas fa-user-check text-green-500 text-3xl"></i>
        <div>
            <h3 class="text-lg font-semibold">Presensi Guru</h3>
            <p class="text-gray-500 text-sm">Lakukan absensi harian Anda.</p>
        </div>
    </a>

    <!-- Presensi Siswa -->
    <a href="{{ route('guru.absensi.siswa') }}" class="bg-white shadow-md rounded-lg p-6 flex items-center space-x-4 hover:shadow-lg transition">
        <i class="fas fa-users text-yellow-500 text-3xl"></i>
        <div>
            <h3 class="text-lg font-semibold">Presensi Siswa</h3>
            <p class="text-gray-500 text-sm">Lihat dan kelola kehadiran siswa.</p>
        </div>
    </a>

    <!-- Riwayat Kehadiran Siswa -->
    <a href="{{ route('guru.kehadiran.index') }}" class="bg-white shadow-md rounded-lg p-6 flex items-center space-x-4 hover:shadow-lg transition">
        <i class="fas fa-history text-purple-500 text-3xl"></i>
        <div>
            <h3 class="text-lg font-semibold">Riwayat Kehadiran Siswa</h3>
            <p class="text-gray-500 text-sm">Tinjau kehadiran siswa selama periode tertentu.</p>
        </div>
    </a>

    <!-- Riwayat Kehadiran Guru -->
    <a href="{{ route('guru.kehadiran.guru') }}" class="bg-white shadow-md rounded-lg p-6 flex items-center space-x-4 hover:shadow-lg transition">
        <i class="fas fa-user-clock text-red-500 text-3xl"></i>
        <div>
            <h3 class="text-lg font-semibold">Riwayat Kehadiran Guru</h3>
            <p class="text-gray-500 text-sm">Lihat histori kehadiran Anda.</p>
        </div>
    </a>
</div>
@endsection
