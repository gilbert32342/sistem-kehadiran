@extends('layouts.admin')

@section('title', 'Edit Pengguna')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6 max-w-lg mx-auto">
    <h2 class="text-2xl font-bold mb-4 text-center">Edit Data Pengguna</h2>

    @if ($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">
            <p><strong>Terjadi kesalahan!</strong> Mohon periksa input Anda.</p>
            <ul class="mt-2">
                @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <!-- Nama -->
        <div>
            <label class="block text-gray-700 font-semibold">Nama:</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" 
                class="border p-2 w-full rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <!-- Role -->
        <div>
            <label class="block text-gray-700 font-semibold">Role:</label>
            <select name="role" id="roleSelect" class="border p-2 w-full rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <option value="guru" {{ old('role', $user->role) == 'guru' ? 'selected' : '' }}>Guru</option>
                <option value="siswa" {{ old('role', $user->role) == 'siswa' ? 'selected' : '' }}>Siswa</option>
            </select>
        </div>

        <!-- NIS/NIP -->
        <div id="nipInput" class="{{ old('role', $user->role) == 'guru' ? '' : 'hidden' }}">
            <label class="block text-gray-700 font-semibold">NIP (Nomor Induk Pegawai):</label>
            <input type="text" name="nip" value="{{ old('nip', $user->nip ?? '') }}" 
                class="border p-2 w-full rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div id="nisInput" class="{{ old('role', $user->role) == 'siswa' ? '' : 'hidden' }}">
            <label class="block text-gray-700 font-semibold">NIS (Nomor Induk Siswa):</label>
            <input type="text" name="nis" value="{{ old('nis', $user->nis ?? '') }}" 
                class="border p-2 w-full rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Kelas (hanya untuk siswa) -->
        <div id="kelasInput" class="{{ old('role', $user->role ?? '') == 'siswa' ? '' : 'hidden' }}">
            <label class="block font-semibold">Kelas:</label>
            <input type="text" name="kelas" value="{{ old('kelas', $user->kelas ?? '') }}" class="w-full p-2 border rounded">
        </div> 

        <!-- Tombol -->
        <div class="flex justify-between">
            <a href="{{ route('admin.users.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">Kembali</a>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Simpan Perubahan</button>
        </div>
    </form>
</div>

<!-- JavaScript untuk Menampilkan/Menyembunyikan Input NIS/NIP -->
<script>
document.getElementById('roleSelect').addEventListener('change', function() {
    let role = this.value;
    document.getElementById('nisInput').classList.toggle('hidden', role !== 'siswa');
    document.getElementById('nipInput').classList.toggle('hidden', role !== 'guru');
    document.getElementById('kelasInput').classList.toggle('hidden', role !== 'siswa');
});
</script>

@endsection
