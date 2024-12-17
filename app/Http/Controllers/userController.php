<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\JenisUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('jenisUser')->paginate(10);
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $roles = JenisUser::all();
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:60',
            'username' => 'required|string|max:60|unique:users',
            'email' => 'required|string|email|max:60|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'wa' => 'required|string|max:15',
            'ID_JENIS_USER' => 'required|exists:jenis_users,ID_JENIS_USER',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'username' => $validatedData['username'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'wa' => $validatedData['wa'],
            'ID_JENIS_USER' => $validatedData['ID_JENIS_USER'],
            'STATUS_USER' => 'Active',
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $jenisUsers = JenisUser::all();
        return view('users.edit', compact('user', 'jenisUsers'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:60',
            'username' => 'required|string|max:60|unique:users,username,' . $id . ',ID_USER',
            'email' => 'required|string|email|max:60|unique:users,email,' . $id . ',ID_USER',
            'wa' => 'required|string|max:15',
            'ID_JENIS_USER' => 'required|exists:jenis_users,ID_JENIS_USER',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->name = $validatedData['name'];
        $user->username = $validatedData['username'];
        $user->email = $validatedData['email'];
        $user->wa = $validatedData['wa'];
        $user->ID_JENIS_USER = $validatedData['ID_JENIS_USER'];

        if (!empty($validatedData['password'])) {
            $user->password = Hash::make($validatedData['password']);
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}

