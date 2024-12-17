<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\JenisUser;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        $jenisUsers = JenisUser::where('ID_JENIS_USER', '!=', 1)->get();
        return view('auth.register', compact('jenisUsers'));
    }

    public function register(Request $request)
    {
        Log::info('Registration attempt', $request->except(['password', 'password_confirmation']));

        $validatedData = $request->validate([
            'name' => 'required|string|max:60',
            'username' => 'required|string|max:60|unique:users',
            'email' => 'required|string|email|max:60|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'wa' => 'required|string|max:15',
            'ID_JENIS_USER' => 'required|integer|exists:jenis_users,ID_JENIS_USER',
        ]);

        try {
            $user = User::create([
                'name' => $validatedData['name'],
                'username' => $validatedData['username'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'wa' => $validatedData['wa'],
                'ID_JENIS_USER' => $validatedData['ID_JENIS_USER'],
                'STATUS_USER' => 'Active',
            ]);

            Log::info('User created', ['user_id' => $user->ID_USER]);

            return redirect()->route('login')
                ->with('success', 'Registration successful! Please login.');

        } catch (\Exception $e) {
            Log::error('Registration failed', ['error' => $e->getMessage()]);
            return back()
                ->withInput($request->except(['password', 'password_confirmation']))
                ->withErrors(['error' => 'Registration failed. Please try again.']);
        }
    }
}