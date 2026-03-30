<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Menampilkan halaman Kelola User
    public function index()
    {
        $users = User::all();
        return view('user.index', compact('users'));
    }

    // Menyimpan pegawai/user baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:Super Admin,Admin,Operator',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            // Hash::make wajib agar password dienkripsi rahasia ke database
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return back()->with('success', 'Akun pegawai baru berhasil ditambahkan!');
    }

    // Menghapus akun pegawai
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Mencegah Super Admin menghapus akunnya sendiri yang sedang dipakai
        if ($user->id == Auth::id()) {
            return back()->with('error', 'Gagal! Anda tidak bisa menghapus akun Anda sendiri.');
        }

        $user->delete();
        return back()->with('success', 'Akun pegawai berhasil dihapus permanen.');
    }
}