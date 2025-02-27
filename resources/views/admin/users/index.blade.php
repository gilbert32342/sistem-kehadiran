@extends('layouts.app')

@section('page_title', 'Dashboard User')

@section('content')
<div class="container mx-auto p-5">
    <h2 class="text-2xl font-bold mb-4">Manajemen Guru & Siswa</h2>
    
    <!-- Tombol Tambah Data -->
    <a href="{{ route('admin.users.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition">
        Tambah Data
    </a>
    
    <!-- Tabel User -->
    <div class="overflow-x-auto mt-4">
        <table class="w-full border border-collapse">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border p-2">Nama</th>
                    <th class="border p-2">NIS/NIP</th>
                    <th class="border p-2">Role</th>
                    <th class="border p-2">Kelas</th>
                    <th class="border p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td class="border p-2">{{ $user->name }}</td>
                    <td class="border p-2">
                        {{ $user->role == 'guru' ? $user->nip : $user->nis }}
                    </td>
                    <td class="border p-2">{{ ucfirst($user->role) }}</td>
                    <td class="border p-2">
                        {{ $user->role == 'siswa' ? $user->kelas : '-' }}
                    </td>
                    <td class="border p-2 flex gap-2">
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="bg-yellow-500 text-white px-2 py-1 rounded-md">Edit</a>
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded-md">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>            
        </table>
    </div>

    <!-- Tombol Kembali -->
    <div class="mt-4">
        <a href="{{ route('admin.dashboard') }}" class="bg-gray-300 text-gray-800 py-2 px-4 rounded-md hover:bg-gray-400 transition">
            &larr; Kembali ke Dashboard
        </a>
    </div>
</div>
@endsection
