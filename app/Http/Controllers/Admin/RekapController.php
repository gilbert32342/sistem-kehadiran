<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AbsensiExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RekapController extends Controller
{
    public function index(Request $request)
    {
        
        $querySiswa = Absensi::query()
            ->join('users', 'absensis.user_id', '=', 'users.id')
            ->select(
                'absensis.id',
                'users.name as nama',
                'users.nis',
                'users.kelas',
                'absensis.status',
                'absensis.tanggal'
            )
            ->where('users.role', 'siswa');

        
        $queryGuru = Absensi::query()
            ->join('users', 'absensis.user_id', '=', 'users.id')
            ->select(
                'absensis.id',
                'users.name as nama',
                'users.nip',
                'absensis.status',
                'absensis.tanggal'
            )
            ->where('users.role', 'guru');

        
        if ($request->filled('status')) {
            $querySiswa->where('absensis.status', $request->status);
            $queryGuru->where('absensis.status', $request->status);
        }

        
        $rekapSiswa = $querySiswa->orderBy('absensis.tanggal', 'desc')->paginate(5, ['*'], 'siswa_page');
        $rekapGuru = $queryGuru->orderBy('absensis.tanggal', 'desc')->paginate(5, ['*'], 'guru_page');

        return view('admin.rekap.index', compact('rekapSiswa', 'rekapGuru'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:hadir,izin,sakit,alpha',
        ]);

        
        $absensi = Absensi::findOrFail($id);
        $absensi->update([
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Status berhasil diperbarui!');
    }


    public function destroy($id)
    {
        $absensi = Absensi::findOrFail($id);
        $absensi->delete();

        return redirect()->route('admin.rekap.index')->with('success', 'Data absensi berhasil dihapus!');
    }


    public function export()
    {
        return Excel::download(new AbsensiExport, 'absensi.xlsx');
    }
}
