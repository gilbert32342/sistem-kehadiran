<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            return match (Auth::user()->role) {
                'admin' => redirect()->route('admin.dashboard'),
                'guru' => redirect()->route('guru.dashboard'),
                'siswa' => redirect()->route('siswa.dashboard'),
                default => redirect('/'),
            };
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'nis_nip' => 'required',
            'password' => 'required',
        ]);

        
        $user = User::where('nis', $credentials['nis_nip'])
                    ->orWhere('nip', $credentials['nis_nip'])
                    ->first();

        if ($user && Auth::attempt([
            'id' => $user->id, 
            'password' => $credentials['password']
        ])) {
            $request->session()->regenerate();

            return match ($user->role) {
                'admin' => redirect()->route('admin.dashboard'),
                'guru' => redirect()->route('guru.dashboard'),
                'siswa' => redirect()->route('siswa.dashboard'),
                default => redirect('/'),
            };
        }

        return back()->with('error', 'NIS/NIP atau password salah');
    }    

    public function logout()
    {
        Auth::logout();
        return redirect('/login')->with('success', 'Anda telah logout.');
    }
}
