<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('tu.dashboard');
    }

    public function index()
    {
        $users = User::with('role', 'prodi')->get();
        return view('tu.users.index', compact('users'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = [
            1 => 'Mahasiswa',
            2 => 'Kaprodi',
            3 => 'TU',
        ];

        $prodis = [
            1 => 'Teknik Informatika',
            2 => 'Sistem Informasi',
        ];

        return view('tu.users.edit', compact('user', 'roles', 'prodis'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'role_idRole' => 'required|integer'
        ]);

        $user = User::findOrFail($id);
        $user->update($request->all());

        return redirect()->route('tu.users.index')->with('success', 'User berhasil diperbarui.');
    }
}

