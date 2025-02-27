@extends('layouts.app')

@section('content')
<div class="p-5">
    <h2 class="text-2xl font-bold mt-4 mb-2 text-gray-800">📜 Riwayat Kehadiran Guru</h2>

    <!-- Menampilkan Nama Guru -->
    <p class="text-lg font-semibold text-gray-700">👤 Nama: {{ $guru->name }}</p>

    <!-- Tabel Rekap Kehadiran -->
    <div class="overflow-x-auto bg-white shadow-md rounded-lg p-4">
        <table class="table-auto w-full border-collapse border">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border p-2">Tanggal</th>
                    <th class="border p-2">Status</th>
                    <th class="border p-2">Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kehadiran as $data)
                <tr>
                    <td class="border p-2">{{ \Carbon\Carbon::parse($data->tanggal)->format('d M Y') }}</td>
                    <td class="border p-2">{{ ucfirst($data->status) }}</td>
                    <td class="border p-2">{{ $data->jumlah }}</td> <!-- Perbaikan di sini -->
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-5 mb-4 flex justify-between items-center w-full">
        <!-- Tombol Kembali -->
        <a href="{{ route('guru.dashboard') }}" 
            class="bg-gray-300 text-gray-800 py-2 px-4 rounded-md hover:bg-gray-400 transition duration-200 flex items-center">
            ⬅ Kembali ke Dashboard
        </a>
    
        <!-- Tombol Export -->
        <a href="{{ route('guru.kehadiran.exportGuruExcel') }}" 
        class="bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 transition">
        📤 Ekspor Kehadiran Guru
     </a>
     
    </div>

    <!-- Navigasi Pagination -->
    <div class="mt-5">
        {{ $kehadiran->links('pagination::tailwind') }}
    </div>
</div>
@endsection
