<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log; 
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{

    public function index()
    {
        $users = User::whereIn('role', ['guru', 'siswa', 'admin'])->paginate(10);
        return view('admin.users.index', compact('users'));
    }    

    public function create()
    {
        return view('admin.users.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nis' => 'nullable|string|max:20|unique:users,nis',
            'nip' => 'nullable|string|max:20|unique:users,nip',
            'role' => 'required|in:admin,guru,siswa',
            'password' => 'required|min:6',
            'kelas' => 'nullable|string|max:50', // ✅ Pastikan kelas divalidasi
        ]);
    
        User::create([
            'name' => $request->name,
            'nis' => $request->role === 'siswa' ? $request->nis : null, // NIS hanya untuk siswa
            'nip' => $request->role === 'guru' ? $request->nip : null, // NIP hanya untuk guru
            'role' => $request->role,
            'password' => bcrypt($request->password),
            'kelas' => $request->role == 'siswa' ? $request->kelas : null,
        ]);
    
        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan.');
    }    

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        Log::info('Data Diterima:', $request->all());
    
        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|in:guru,siswa',
            'nip'  => 'nullable|required_if:role,guru|unique:users,nip,' . $user->id,
            'nis'  => 'nullable|required_if:role,siswa|unique:users,nis,' . $user->id,
            'kelas' => 'nullable|string|max:50', // ✅ Pastikan kelas divalidasi
        ]);
    
        $user->update([
            'name' => $request->name,
            'role' => $request->role,
            'nip' => $request->role == 'guru' ? $request->nip : null,
            'nis' => $request->role == 'siswa' ? $request->nis : null,
            'kelas' => $request->role == 'siswa' ? $request->kelas : null, // ✅ Pastikan `kelas` ikut diupdate
        ]);
    
        return redirect()->route('admin.users.index')->with('success', 'Data berhasil diperbarui!');
    }
       

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Data berhasil dihapus!');
    }
    
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv'
        ]);
    
        try {
            Excel::import(new UsersImport, $request->file('file'));
            return back()->with('success', 'Data berhasil diimport!');
        } catch (\Exception $e) {
            return back()->with('error', 'Beberapa data sudah ada dan tidak dapat dimport!');
        }
    }
    
}
