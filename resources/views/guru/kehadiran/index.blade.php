@extends('layouts.guru')

@section('content')
<div class="container mx-auto px-4 py-6 animate-fade-in">
    <h2 class="text-2xl font-bold text-gray-800 mb-4 animate-fade-in-up">📋 Riwayat Kehadiran Siswa</h2>

    <!-- Filter -->
    <form method="GET" action="{{ route('guru.kehadiran.index') }}" class="mb-6 flex items-center gap-4 animate-fade-in-up">
        <div>
            <label for="kelas" class="mr-2 text-gray-700">Filter Kelas:</label>
            <select name="kelas" id="kelas" class="border rounded p-2 focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out">
                <option value="">Semua Kelas</option>
                @foreach ($kelasRomawi as $angka => $romawi)
                    <option value="{{ $angka }}" {{ request('kelas') == $angka ? 'selected' : '' }}>
                        Kelas {{ $romawi }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <div>
            <label for="status" class="mr-2 text-gray-700">Filter Status:</label>
            <select name="status" id="status" class="border rounded p-2 focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out">
                <option value="">Semua Status</option>
                <option value="hadir" {{ request('status') == 'hadir' ? 'selected' : '' }}>Hadir</option>
                <option value="izin" {{ request('status') == 'izin' ? 'selected' : '' }}>Izin</option>
                <option value="alpha" {{ request('status') == 'alpha' ? 'selected' : '' }}>Alpha</option>
            </select>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-300 ease-in-out transform hover:scale-105">
            Filter
        </button>
    </form>

    <!-- Export Buttons -->
    <div class="mb-6 flex gap-2 animate-fade-in-up">
        <a href="{{ route('guru.kehadiran.exportExcel') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition duration-300 ease-in-out transform hover:scale-105">
            Export Excel
        </a>
        <a href="{{ route('guru.kehadiran.exportPDF') }}" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition duration-300 ease-in-out transform hover:scale-105">
            Export PDF
        </a>
    </div>

    <!-- Table -->
    <div class="bg-white shadow-lg rounded-lg overflow-hidden animate-fade-in-up">
        <table class="min-w-full bg-white border border-gray-200">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="py-3 px-4 text-left">Nama</th>
                    <th class="py-3 px-4 text-left">NIS</th>
                    <th class="py-3 px-4 text-left">Kelas</th>
                    <th class="py-3 px-4 text-left">Tanggal</th>
                    <th class="py-3 px-4 text-left">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($absensi as $data)
                <tr class="border-b border-gray-200 hover:bg-gray-50 transition duration-200">
                    <td class="py-3 px-4">{{ $data->nama }}</td>
                    <td class="py-3 px-4">{{ $data->nis }}</td>
                    <td class="py-3 px-4">{{ $data->kelas }}</td>
                    <td class="py-3 px-4">{{ \Carbon\Carbon::parse($data->tanggal)->format('d M Y') }}</td>
                    <td class="py-3 px-4">
                        <span class="px-3 py-1 rounded-full text-white 
                            {{ $data->status == 'hadir' ? 'bg-green-500' : ($data->status == 'izin' ? 'bg-yellow-500' : 'bg-red-500') }}">
                            {{ ucfirst($data->status) }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6 animate-fade-in">
        {{ $absensi->links('vendor.pagination.default') }}
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