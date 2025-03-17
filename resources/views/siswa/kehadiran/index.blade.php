@extends('layouts.siswa')

@section('content')
<div class="p-5 animate-fade-in">
    <!-- Judul Halaman -->
    <h2 class="text-2xl font-bold mt-4 mb-2 text-gray-800">📜 Riwayat Kehadiran</h2>

    <!-- Menampilkan Nama Siswa -->
    <p class="text-lg font-semibold text-gray-700 mb-4">👤 Nama: {{ $siswa->name }}</p>

    <!-- Tabel Rekap Kehadiran -->
    <div class="overflow-x-auto bg-white shadow-lg rounded-lg p-4 animate-fade-in-up">
        <table class="table-auto w-full border-collapse border">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border p-3 text-left text-gray-700">Tanggal</th>
                    <th class="border p-3 text-left text-gray-700">Status</th>
                    <th class="border p-3 text-left text-gray-700">Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kehadiran as $data)
                <tr class="hover:bg-gray-50 transition duration-200">
                    <td class="border p-3 text-gray-600">{{ \Carbon\Carbon::parse($data->tanggal)->format('d M Y') }}</td>
                    <td class="border p-3 text-gray-600">{{ ucfirst($data->status) }}</td>
                    <td class="border p-3 text-gray-600">{{ $data->jumlah }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Tombol Aksi -->
    <div class="mt-5 mb-4 flex justify-between items-center w-full animate-fade-in-up">
    
        <!-- Tombol Export -->
        <a href="{{ route('siswa.kehadiran.export') }}" 
            class="bg-blue-600 text-white py-2 px-6 rounded-md hover:bg-blue-700 transition duration-200 flex items-center transform hover:scale-105">
            📤 Ekspor Laporan Absensi
        </a>
    </div>

    <!-- Navigasi Pagination -->
    <div class="mt-5 animate-fade-in">
        {{ $kehadiran->links('pagination::tailwind') }}
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