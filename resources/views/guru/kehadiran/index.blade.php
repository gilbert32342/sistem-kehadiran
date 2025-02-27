@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">Riwayat Kehadiran Siswa</h2>

    <!-- Filter -->
    <form method="GET" action="{{ route('guru.kehadiran.index') }}" class="mb-4 flex items-center gap-4">
        <div>
            <label for="kelas" class="mr-2">Filter Kelas:</label>
            <select name="kelas" id="kelas" class="border rounded p-2">
                <option value="">Semua Kelas</option>
                @foreach ($kelasRomawi as $angka => $romawi)
                    <option value="{{ $angka }}" {{ request('kelas') == $angka ? 'selected' : '' }}>
                        Kelas {{ $romawi }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <div>
            <label for="status" class="mr-2">Filter Status:</label>
            <select name="status" id="status" class="border rounded p-2">
                <option value="">Semua Status</option>
                <option value="hadir" {{ request('status') == 'hadir' ? 'selected' : '' }}>Hadir</option>
                <option value="izin" {{ request('status') == 'izin' ? 'selected' : '' }}>Izin</option>
                <option value="alpha" {{ request('status') == 'alpha' ? 'selected' : '' }}>Alpha</option>
            </select>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded">Filter</button>
    </form>

    <!-- Export Buttons -->
    <div class="mb-4 flex gap-2">
        <a href="{{ route('guru.kehadiran.exportExcel') }}" class="bg-green-500 text-white px-4 py-2 rounded">Export Excel</a>
        <a href="{{ route('guru.kehadiran.exportPDF') }}" class="bg-red-500 text-white px-4 py-2 rounded">Export PDF</a>
    </div>

    <!-- Table -->
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
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
                <tr class="border-b border-gray-200 hover:bg-gray-100">
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
    <div class="mt-4">
        {{ $absensi->links() }}
    </div>
</div>
@endsection
