<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    Public function FormRegis(){
        return view('auth.register');
    }
    Public function Register(Request $request){
        // dd($request->all());
        $request->validate([
            'role_id' => 'required|exists:roles,role_id',
            'nama' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'no_hp' => 'required',

        ]);

        User::create([
            'role_id' => $request->role_id,
            'nama' => $request->nama,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'password' => Hash::make($request->password),
        ]);
        return redirect()->route('login')->with('success', 'Registrasi berhasil!');
    }

    public function FormLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validasi inputan login
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        // Cek kredensial login
        if (Auth::attempt($credentials)) {
            // Regenerasi session setelah login
            $request->session()->regenerate();
    
            // Cek role user yang login
            $role = Auth::user()->role->nama_role;
            Log::info('Login successful for user: ' . Auth::user()->email);
            Log::info('Role: ' . $role);
    
            // Redirect berdasarkan role
            if ($role === 'Admin') {
                return redirect()->route('main');
            } elseif ($role === 'Penjual') {
                return redirect()->route('main');
            } elseif ($role === 'Pembeli') {
                return redirect()->route('main');
            }
        }
    
        // Jika login gagal, kembali dengan error
        Log::warning('Login failed for email: ' . $request->email);
        return back()->withInput()->withErrors([
            'email' => 'The provided credentials do not match our records. Please check your email and password.',
        ]);
    }
    
    public function layout(){
        return view('layout.main');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }


}
