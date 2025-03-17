@extends('layouts.admin')

@section('title', isset($user) ? 'Edit Pengguna' : 'Tambah Pengguna')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 shadow rounded-lg">
    <h2 class="text-2xl font-semibold mb-4">{{ isset($user) ? 'Edit Pengguna' : 'Tambah Pengguna' }}</h2>

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

    <form action="{{ isset($user) ? route('admin.users.update', $user->id) : route('admin.users.store') }}" method="POST">
        @csrf
        @if(isset($user)) @method('PUT') @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            
            <div>
                <label class="block font-semibold">Nama:</label>
                <input type="text" name="name" value="{{ old('name', $user->name ?? '') }}" required class="w-full p-2 border rounded">
            </div>

            
            <div>
                <label class="block font-semibold">Role:</label>
                <select name="role" id="roleSelect" class="w-full p-2 border rounded" required>
                    <option value="guru" {{ old('role', $user->role ?? '') == 'guru' ? 'selected' : '' }}>Guru</option>
                    <option value="siswa" {{ old('role', $user->role ?? '') == 'siswa' ? 'selected' : '' }}>Siswa</option>
                </select>
            </div>

           
            <div id="nisInput" class="{{ old('role', $user->role ?? '') == 'siswa' ? '' : 'hidden' }}">
                <label class="block font-semibold">NIS:</label>
                <input type="text" name="nis" value="{{ old('nis', $user->nis ?? '') }}" class="w-full p-2 border rounded">
            </div>

            <div id="nipInput" class="{{ old('role', $user->role ?? '') == 'guru' ? '' : 'hidden' }}">
                <label class="block font-semibold">NIP:</label>
                <input type="text" name="nip" value="{{ old('nip', $user->nip ?? '') }}" class="w-full p-2 border rounded">
            </div>

            
            <div id="kelasInput" class="{{ old('role', $user->role ?? '') == 'siswa' ? '' : 'hidden' }}">
                <label class="block font-semibold">Kelas:</label>
                <input type="text" name="kelas" value="{{ old('kelas', $user->kelas ?? '') }}" class="w-full p-2 border rounded">
            </div> 

            
            <div>
                <label class="block font-semibold">Password:</label>
                <input type="password" name="password" class="w-full p-2 border rounded" {{ isset($user) ? '' : 'required' }}>
                @if(isset($user)) 
                    <small class="text-gray-500">Kosongkan jika tidak ingin mengubah</small> 
                @endif
            </div>
        </div>

        
        <button type="submit" class="mt-4 w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
            {{ isset($user) ? 'Update' : 'Tambah' }}
        </button>
    </form>

    
    <div class="mt-6">
        <a href="{{ route('admin.users.index') }}" class="block text-center text-blue-600 hover:underline">Kembali ke daftar pengguna</a>
    </div>
</div>


<script>
document.getElementById('roleSelect').addEventListener('change', function() {
    let role = this.value;
    document.getElementById('nisInput').classList.toggle('hidden', role !== 'siswa');
    document.getElementById('nipInput').classList.toggle('hidden', role !== 'guru');
    document.getElementById('kelasInput').classList.toggle('hidden', role !== 'siswa'); // ✅ Tambahkan kelas
});

</script>

@endsection
