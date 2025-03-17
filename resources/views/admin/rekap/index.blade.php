@extends('layouts.admin')

@section('page_title', 'Rekap dan Laporan')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-6">📌 Rekap Absensi</h2>

    {{-- Filter Status --}}
    <form action="{{ route('admin.rekap.index') }}" method="GET" class="flex gap-3 mb-6">
        <select name="status" class="border p-2 rounded-lg shadow-sm">
            <option value="">Pilih Status</option>
            <option value="hadir" {{ request('status') == 'hadir' ? 'selected' : '' }}>Hadir</option>
            <option value="izin" {{ request('status') == 'izin' ? 'selected' : '' }}>Izin</option>
            <option value="sakit" {{ request('status') == 'sakit' ? 'selected' : '' }}>Sakit</option>
            <option value="alpha" {{ request('status') == 'alpha' ? 'selected' : '' }}>Alpha</option>
        </select>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow-sm hover:bg-blue-600 transition-transform transform hover:scale-105">
            🔍 Filter
        </button>
    </form>

    {{-- Export Button --}}
    <div class="flex gap-3 mb-6">
        <a href="{{ route('admin.rekap.export') }}" class="bg-green-500 text-white px-4 py-2 rounded-lg shadow-sm hover:bg-green-600 transition-transform transform hover:scale-105">
            📥 Export Excel
        </a>
    </div>

    {{-- Tabel Absensi Siswa --}}
    <h3 class="text-xl font-semibold mb-4">📚 Absensi Siswa</h3>
    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="w-full border-collapse">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border p-3">Nama</th>
                    <th class="border p-3">NIS</th>
                    <th class="border p-3">Kelas</th>
                    <th class="border p-3">Status</th>
                    <th class="border p-3">Tanggal</th>
                    <th class="border p-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rekapSiswa as $siswa)
                <tr class="hover:bg-gray-50 transition duration-200">
                    <td class="border p-3">{{ $siswa->nama }}</td>
                    <td class="border p-3">{{ $siswa->nis }}</td>
                    <td class="border p-3">{{ $siswa->kelas }}</td>
                    <td class="border p-3">{{ ucfirst($siswa->status) }}</td>
                    <td class="border p-3">{{ $siswa->tanggal }}</td>
                    <td class="border p-3">
                        <div class="flex gap-2">
                            <button onclick="openModalEdit({{ $siswa->id }}, '{{ $siswa->status }}')" class="text-blue-500 hover:text-blue-700 transition duration-200" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button onclick="openModalDelete({{ $siswa->id }})" class="text-red-500 hover:text-red-700 transition duration-200" title="Hapus">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{-- Pagination --}}
        <div class="mt-4 p-3">
            {{ $rekapSiswa->links('vendor.pagination.default') }}
        </div>
    </div>

    {{-- Tabel Absensi Guru --}}
    <h3 class="text-xl font-semibold mt-8 mb-4">👨‍🏫 Absensi Guru</h3>
    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="w-full border-collapse">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border p-3">Nama</th>
                    <th class="border p-3">NIP</th>
                    <th class="border p-3">Status</th>
                    <th class="border p-3">Tanggal</th>
                    <th class="border p-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rekapGuru as $guru)
                <tr class="hover:bg-gray-50 transition duration-200">
                    <td class="border p-3">{{ $guru->nama }}</td>
                    <td class="border p-3">{{ $guru->nip }}</td>
                    <td class="border p-3">{{ ucfirst($guru->status) }}</td>
                    <td class="border p-3">{{ $guru->tanggal }}</td>
                    <td class="border p-3">
                        <div class="flex gap-2">
                            <button onclick="openModalEdit({{ $guru->id }}, '{{ $guru->status }}')" class="text-blue-500 hover:text-blue-700 transition duration-200" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button onclick="openModalDelete({{ $guru->id }})" class="text-red-500 hover:text-red-700 transition duration-200" title="Hapus">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{-- Pagination --}}
        <div class="mt-4 p-3">
            {{ $rekapGuru->links('vendor.pagination.default') }}
        </div>
    </div>
</div>

{{-- Modal Edit --}}
<div id="modalEdit" class="fixed inset-0 bg-black bg-opacity-50 justify-center items-center hidden">
    <div class="bg-white p-6 rounded-lg shadow-xl w-96 transform transition-all duration-300 scale-95 opacity-0 modal-content">
        <h2 class="text-xl font-bold mb-4">Edit Absensi</h2>
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" id="editId" name="id">
            <select name="status" id="editStatus" class="border p-2 rounded-lg shadow-sm w-full mb-4">
                <option value="hadir">Hadir</option>
                <option value="izin">Izin</option>
                <option value="sakit">Sakit</option>
                <option value="alpha">Alpha</option>
            </select>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow-sm hover:bg-blue-600 transition duration-200 w-full">
                <i class="fas fa-save mr-2"></i> Simpan
            </button>
            <button type="button" onclick="closeModal('modalEdit')" class="bg-gray-500 text-white px-4 py-2 rounded-lg shadow-sm hover:bg-gray-600 transition duration-200 w-full mt-2">
                <i class="fas fa-times mr-2"></i> Batal
            </button>
        </form>
    </div>
</div>

{{-- Modal Hapus --}}
<div id="modalDelete" class="fixed inset-0 bg-black bg-opacity-50 justify-center items-center hidden">
    <div class="bg-white p-6 rounded-lg shadow-xl w-96 transform transition-all duration-300 scale-95 opacity-0 modal-content">
        <h2 class="text-xl font-bold mb-4">Yakin ingin menghapus?</h2>
        <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg shadow-sm hover:bg-red-600 transition duration-200 w-full">
                <i class="fas fa-trash-alt mr-2"></i> Hapus
            </button>
            <button type="button" onclick="closeModal('modalDelete')" class="bg-gray-500 text-white px-4 py-2 rounded-lg shadow-sm hover:bg-gray-600 transition duration-200 w-full mt-2">
                <i class="fas fa-times mr-2"></i> Batal
            </button>
        </form>
    </div>
</div>

<script>
    function openModalEdit(id, status) {
        const modal = document.getElementById('modalEdit');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.classList.add('overflow-hidden');
        setTimeout(() => {
            modal.querySelector('div').classList.remove('scale-95', 'opacity-0');
        }, 10);
        document.getElementById('editId').value = id;
        document.getElementById('editStatus').value = status;
        document.getElementById('editForm').action = "/admin/rekap/" + id;
    }

    function openModalDelete(id) {
        const modal = document.getElementById('modalDelete');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.classList.add('overflow-hidden');
        setTimeout(() => {
            modal.querySelector('div').classList.remove('scale-95', 'opacity-0');
        }, 10);
        document.getElementById('deleteForm').action = "/admin/rekap/" + id;
    }

    function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        modal.querySelector('div').classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.classList.remove('overflow-hidden');
        }, 300);
    }
</script>

<style>
    body.overflow-hidden {
        overflow: hidden;
    }

    .modal-content {
        max-height: 90vh;
        overflow-y: auto;
    }

    .modal-content::-webkit-scrollbar {
        display: none;
    }

    .modal-content {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>
@endsection