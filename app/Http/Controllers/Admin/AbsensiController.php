<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\User;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function index()
    {
        $absensi = Absensi::with('siswa')->orderBy('tanggal', 'desc')->get();
        return view('admin.absensi.index', compact('absensi'));
    }
}
