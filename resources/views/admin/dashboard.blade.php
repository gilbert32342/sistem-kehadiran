@extends('layouts.admin')

@section('page_title', 'Dashboard Admin')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    
    <a href="{{ route('admin.users.index') }}" class="bg-white shadow-md rounded-lg p-6 flex items-center space-x-4 hover:shadow-lg transition">
        <i class="fas fa-users text-blue-500 text-3xl"></i>
        <div>
            <h3 class="text-lg font-semibold">Manajemen Pengguna</h3>
            <p class="text-gray-500 text-sm">Kelola data pengguna dan perannya.</p>
        </div>
    </a>

    
    <a href="{{ route('admin.statistik') }}" class="bg-white shadow-md rounded-lg p-6 flex items-center space-x-4 hover:shadow-lg transition">
        <i class="fas fa-chart-bar text-green-500 text-3xl"></i>
        <div>
            <h3 class="text-lg font-semibold">Statistik Kehadiran</h3>
            <p class="text-gray-500 text-sm">Lihat statistik kehadiran siswa dan guru.</p>
        </div>
    </a>

    
    <a href="{{ route('admin.rekap.index') }}" class="bg-white shadow-md rounded-lg p-6 flex items-center space-x-4 hover:shadow-lg transition">
        <i class="fas fa-file-alt text-yellow-500 text-3xl"></i>
        <div>
            <h3 class="text-lg font-semibold">Rekap & Laporan</h3>
            <p class="text-gray-500 text-sm">Unduh laporan kehadiran.</p>
        </div>
    </a>

    
    <a href="{{ route('admin.materi.index') }}" class="bg-white shadow-md rounded-lg p-6 flex items-center space-x-4 hover:shadow-lg transition">
        <i class="fas fa-book text-purple-500 text-3xl"></i>
        <div>
            <h3 class="text-lg font-semibold">Manajemen Materi</h3>
            <p class="text-gray-500 text-sm">Kelola materi pembelajaran.</p>
        </div>
    </a>
</div>
@endsection
