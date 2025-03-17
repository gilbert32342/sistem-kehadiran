@extends('layouts.admin')

@section('page_title', 'Manajemen Materi')

@section('content')

<div class="max-w-6xl mx-auto p-6 bg-white shadow-md rounded-lg">
    <h1 class="text-2xl font-semibold text-gray-800 mb-4">Manajemen Materi</h1>

    
    <div class="flex justify-between items-center mb-4">
        
        <a href="{{ route('admin.materi.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition-transform transform hover:scale-105">
            + Tambah Materi
        </a>
    
        
        <form method="GET" action="{{ route('admin.materi.index') }}" class="flex items-center">
            <label class="mr-2 text-gray-700">Urutkan:</label>
            <select name="sort" class="border rounded px-3 py-1 transition-transform transform hover:scale-105" onchange="this.form.submit()">
                <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>A-Z</option>
                <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>Z-A</option>
            </select>
        </form>
    </div>

    
    <div class="overflow-x-auto">
        <table class="w-full border-collapse border border-gray-200 shadow-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-4 py-2 text-left w-12">#</th>
                    <th class="border px-4 py-2 text-left">Judul</th>
                    <th class="border px-4 py-2 text-left">Deskripsi</th>
                    <th class="border px-4 py-2 text-left">File</th>
                    <th class="border px-4 py-2 text-left">Diuplode Oleh</th>
                    <th class="border px-4 py-2 text-center w-40">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($materis as $index => $materi)
                <tr class="hover:bg-gray-50">
                    <td class="border px-4 py-2 text-center">{{ $materis->firstItem() + $index }}</td>
                    <td class="border px-4 py-2">{{ $materi->judul }}</td>
                    <td class="border px-4 py-2">{{ Str::limit($materi->deskripsi, 50) }}</td>
                    <td class="border px-4 py-2">
                        @if ($materi->file_path)
                            <a href="{{ Storage::url($materi->file_path) }}" target="_blank" class="text-blue-600 underline hover:text-blue-800 transition-colors">
                                📂 Lihat File
                            </a>
                        @else
                            <span class="text-gray-500">Tidak Ada File</span>
                        @endif
                    </td>
                    <td class="border px-4 py-2">
                        {{ $materi->creator->name ?? 'Admin' }}
                    </td>
                    <td class="border px-4 py-2 text-center">
                        <div class="flex justify-center items-center space-x-2">
                            
                            <a href="{{ route('admin.materi.edit', $materi->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded-md hover:bg-yellow-600 transition-transform transform hover:scale-105">
                                Edit
                            </a>
                            
                            <form action="{{ route('admin.materi.destroy', $materi->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600 transition-transform transform hover:scale-105">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    
    <div class="mt-4">
        {{ $materis->links('vendor.pagination.default') }}
    </div>    
</div>

@endsection