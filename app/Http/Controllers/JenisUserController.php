<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user;
use App\Models\jenisUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class JenisUserController extends Controller
{
    public function index()
    {
        $jenisUsers = jenisUser::all();
        return view('role.index2', compact('jenisUsers'));
    }

    public function create()
    {
        return view('role.createjenis');
    }

    public function store(Request $request)
    {
        $request->validate([
            // 'ID_JENIS_USER' => 'required|unique:jenis_users|max:30', // Update table name here if using plural
            'JENIS_USER' => 'required|max:60',
            'CREATE_BY' => 'required'
        ]);
    
        jenisUser::create($request->all());
        return redirect()->route('role.index')->with('success', 'Jenis user created successfully');
    }

    public function edit ($id)
    {
        $jenisUser = JenisUser::findOrFail($id);
        return view('role.editjenis', compact('jenisUser'));
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'JENIS_USER' => 'required|string|max:60',
        ]);
    
        $jenisUser = JenisUser::findOrFail($id);
        $jenisUser->JENIS_USER = $request->JENIS_USER;
        $jenisUser->save();
    
        return redirect()->route('role.index')->with('success', 'Jenis user berhasil diperbarui.');
    }
    
    public function destroy($id)
    {
        $jenisUser = JenisUser::findOrFail($id);
    
        // Hapus jenis user
        $jenisUser->delete();
    
        return redirect()->route('role.index')->with('success', 'Jenis user berhasil dihapus.');
    }
    
    
}
