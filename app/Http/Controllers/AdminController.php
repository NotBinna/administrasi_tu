<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Prodi;


class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function index()
    {
        $users = User::with('role', 'prodi')->get();
        return view('admin.users.index', compact('users'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = \App\Models\Role::all();
        $prodis = \App\Models\Prodi::all();

        return view('admin.users.edit', compact('user', 'roles', 'prodis'));
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

        return redirect()->route('admin.users.index')->with('success', 'User berhasil diperbarui.');
    }
    public function createUser()
    {
        $roles = Role::all();
        $prodis = Prodi::all();
        return view('admin.users.create', compact('roles', 'prodis'));
    }

    public function storeUser(Request $request)
    {
        $validated = $request->validate([
            'idUser' => 'required|unique:users,idUser|max:7',
            'name' => 'required|string|max:255|max:45',
            'alamat' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:45',
            'password' => 'required|string|min:8|confirmed|max:100',
            'role_idRole' => 'required|exists:roles,idRole',
            'prodi_idProdi' => 'required|exists:prodi,idProdi',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan!');
    }
}

