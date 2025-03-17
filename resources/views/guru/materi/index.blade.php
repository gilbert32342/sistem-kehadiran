@extends('layouts.guru')

@section('content')
<div class="max-w-6xl mx-auto p-6 bg-white shadow-lg rounded-lg animate-fade-in">
    <h1 class="text-2xl font-semibold text-gray-800 mb-4">📚 Materi Saya</h1>

    {{-- Tombol Tambah dan Sorting --}}
    <div class="flex justify-between items-center mb-4 animate-fade-in-up">
        <a href="{{ route('guru.materi.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition duration-300 ease-in-out transform hover:scale-105">
            + Tambah Materi
        </a>

        {{-- Dropdown Sorting --}}
        <form method="GET" action="{{ route('guru.materi.index') }}" class="flex items-center">
            <label class="mr-2 text-gray-700">Urutkan:</label>
            <select name="sort" class="border rounded px-3 py-1 transition duration-300 ease-in-out hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500" onchange="this.form.submit()">
                <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>A-Z</option>
                <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>Z-A</option>
            </select>
        </form>
    </div>

    {{-- Tabel Materi --}}
    <div class="overflow-x-auto animate-fade-in-up">
        <table class="w-full border-collapse border border-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-4 py-2">Judul</th>
                    <th class="border px-4 py-2">Deskripsi</th>
                    <th class="border px-4 py-2">File</th>
                    <th class="border px-4 py-2">Pembuat</th>
                    <th class="border px-4 py-2 text-center w-40">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($materis as $materi)
                <tr class="hover:bg-gray-50 transition duration-200">
                    <td class="border px-4 py-2">{{ $materi->judul }}</td>
                    <td class="border px-4 py-2">{{ Str::limit($materi->deskripsi, 50) }}</td>
                    <td class="border px-4 py-2 text-center">
                        @if ($materi->file_path)
                            <a href="{{ asset('storage/' . $materi->file_path) }}" class="text-blue-600 underline hover:text-blue-800 transition duration-300 ease-in-out" target="_blank">
                                📂 Lihat File
                            </a>
                        @else
                            <span class="text-gray-500">Tidak Ada File</span>
                        @endif
                    </td>
                    <td class="border px-4 py-2">{{ $materi->creator->name ?? 'Tidak Diketahui' }}</td>
                    <td class="border px-4 py-2 text-center">
                        <div class="flex justify-center items-center space-x-2">
                            <a href="{{ route('guru.materi.edit', $materi->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded-md hover:bg-yellow-600 transition duration-300 ease-in-out transform hover:scale-105">
                                Edit
                            </a>
                            <form action="{{ route('guru.materi.destroy', $materi->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600 transition duration-300 ease-in-out transform hover:scale-105">
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

    {{-- Pagination --}}
    <div class="mt-4 animate-fade-in">
        {{ $materis->links() }}
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