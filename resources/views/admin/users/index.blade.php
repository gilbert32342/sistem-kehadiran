@extends('layouts.admin')

@section('page_title', 'Managemen Pengguna')

@section('content')
<div class="container mx-auto p-5">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Manajemen Guru & Siswa</h2>
    
    
    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    @if (session('error'))
        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-6" role="alert">
            <p>{{ session('error') }}</p>
        </div>
    @endif

    
    <div class="flex flex-wrap gap-4 mb-6">
        <a href="{{ route('admin.users.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition-transform transform hover:scale-105 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 3a1 1 0 00-1 1v5H4a1 1 0 100 2h5v5a1 1 0 102 0v-5h5a1 1 0 100-2h-5V4a1 1 0 00-1-1z" clip-rule="evenodd" />
            </svg>
            Tambah Data
        </a>
        
        <form action="{{ route('admin.users.import') }}" method="POST" enctype="multipart/form-data" class="flex gap-2 items-center">
            @csrf
            <input type="file" name="file" class="border p-2 rounded-md bg-white shadow-sm" required>
            <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 transition-transform transform hover:scale-105 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-1 1h-1v6a1 1 0 01-1 1H6a1 1 0 01-1-1V7H4a1 1 0 01-1-1V3zm4 10h8V7H7v6z" clip-rule="evenodd" />
                </svg>
                Import Akun
            </button>
        </form>
    </div>

    
    <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
        <table class="min-w-full border-collapse">
            <thead>
                <tr class="bg-gray-100 text-gray-700">
                    <th class="border p-3 text-left">Nama</th>
                    <th class="border p-3 text-left">NIP/NIS</th>
                    <th class="border p-3 text-left">Role</th>
                    <th class="border p-3 text-left">Kelas</th>
                    <th class="border p-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-900">
                @foreach($users as $user)
                <tr class="hover:bg-gray-50 transition">
                    <td class="border p-3">{{ $user->name }}</td>
                    <td class="border p-3">
                        {{ $user->nip ?? $user->nis ?? '-' }}
                    </td>
                    <td class="border p-3">{{ ucfirst($user->role) }}</td>
                    <td class="border p-3">
                        {{ $user->role == 'siswa' ? $user->kelas : '-' }}
                    </td>
                    <td class="border p-3">
                        <div class="flex justify-center gap-2">
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded-md hover:bg-yellow-600 transition-transform transform hover:scale-105 flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                </svg>
                                Edit
                            </a>
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600 transition-transform transform hover:scale-105 flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
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

    
    <div class="mt-6">
        {{ $users->links('vendor.pagination.default') }}
    </div>
</div>
@endsection