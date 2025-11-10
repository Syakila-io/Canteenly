<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        try {
            $users = User::all();
            return view('admin.users', compact('users'));
        } catch (\Exception $e) {
            return view('admin.users', ['users' => []]);
        }
    }

    public function create()
    {
        return view('admin.tambah-user');
    }

    public function store(Request $request)
    {
        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'gender' => $request->gender,
                'kelas' => $request->role === 'siswa' ? $request->kelas : null,
                'jabatan' => $request->role !== 'siswa' ? $request->jabatan : null,
                'role' => $request->role,
                'no_hp' => $request->no_hp
            ]);
            return redirect()->route('admin.users')->with('success', 'User berhasil ditambahkan');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal menambahkan user']);
        }
    }

    public function edit($id)
    {
        try {
            $user = User::findOrFail($id);
            return view('admin.edit-user', compact('user'));
        } catch (\Exception $e) {
            return redirect()->route('admin.users')->withErrors(['error' => 'User tidak ditemukan']);
        }
    }

    public function update(Request $request)
    {
        try {
            $user = User::findOrFail($request->id);
            $updateData = [
                'name' => $request->name,
                'email' => $request->email,
                'gender' => $request->gender,
                'kelas' => $request->role === 'siswa' ? $request->kelas : null,
                'jabatan' => $request->role !== 'siswa' ? $request->jabatan : null,
                'role' => $request->role,
                'no_hp' => $request->no_hp
            ];

            if ($request->password) {
                $updateData['password'] = $request->password;
            }

            $user->update($updateData);
            return redirect()->route('admin.users')->with('success', 'User berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            User::findOrFail($id)->delete();
            return redirect()->route('admin.users')->with('success', 'User berhasil dihapus');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal menghapus user']);
        }
    }
}