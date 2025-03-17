<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;

class PasswordResetController extends Controller
{
    // Menampilkan form request reset password
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    // Proses reset password tanpa email
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'nis_nip' => 'required',
        ]);

        // Cari user berdasarkan NIS/NIP
        $user = User::where('nis', $request->nis_nip)
            ->orWhere('nip', $request->nis_nip)
            ->first();

        if (!$user) {
            return back()->withErrors(['nis_nip' => 'NIS/NIP tidak ditemukan.']);
        }

        // Generate token reset password
        $token = Str::random(60);

        // Simpan token dengan batas waktu 30 menit
        DB::table('password_resets')->updateOrInsert(
            ['nis_nip' => $request->nis_nip], 
            ['token' => $token, 'created_at' => now()]
        );

        // Redirect langsung ke halaman reset password
        return redirect()->route('password.reset', ['token' => $token])
                         ->with('status', 'Gunakan token ini untuk reset password.');
    }     

    // Menampilkan form reset password
    public function showResetForm($token)
    {
        // Ambil data dari database berdasarkan token
        $resetData = DB::table('password_resets')->where('token', $token)->first();

        if (!$resetData) {
            return redirect()->route('password.request')->withErrors(['error' => 'Token tidak valid atau sudah kadaluarsa.']);
        }

        return view('auth.reset-password', ['token' => $token, 'nis_nip' => $resetData->nis_nip]);
    }

    // Simpan password baru
    public function reset(Request $request)
    {
        $request->validate([
            'nis_nip' => 'required',
            'password' => 'required|min:6|confirmed',
            'token' => 'required'
        ]);

        // Cek apakah token valid dan belum expired (30 menit)
        $resetData = DB::table('password_resets')
            ->where('token', $request->token)
            ->where('nis_nip', $request->nis_nip)
            ->where('created_at', '>=', now()->subMinutes(30)) // Token berlaku 30 menit
            ->first();

        if (!$resetData) {
            return redirect()->route('password.request')->withErrors(['error' => 'Token tidak valid atau sudah kadaluarsa.']);
        }

        // Update password user
        User::where('nis', $request->nis_nip)
            ->orWhere('nip', $request->nis_nip)
            ->update([
                'password' => Hash::make($request->password),
            ]);

        // Hapus token setelah digunakan
        DB::table('password_resets')->where('nis_nip', $request->nis_nip)->delete();

        return redirect()->route('login')->with('status', 'Password berhasil diperbarui.');
    }    
}
