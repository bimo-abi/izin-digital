<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /**
     * Tampilkan form register
     */
    public function show()
    {
        return view('auth.register');
    }

    /**
     * Proses register
     */
    public function register(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'nim' => 'required|string|max:20|regex:/^[A-Z][0-9]{8,}$/',
            'password' => 'required|string|min:8|confirmed',
            'program_studi' => 'required|string|max:100',
            'golongan' => 'nullable|string|max:50',
        ], [
            'name.required' => 'Nama lengkap wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'nim.required' => 'NIM wajib diisi',
            'nim.regex' => 'Format NIM tidak valid. Contoh: E41250904 (Huruf kapital diikuti angka)',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
            'program_studi.required' => 'Program studi wajib diisi',
        ]);

        // 2. Buat user baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'mahasiswa', // Default role untuk register publik
            'nim' => $request->nim,
            'program_studi' => $request->program_studi,
            'golongan' => $request->golongan,
        ]);

        // 3. Auto login setelah register
        Auth::login($user);

        // 4. Redirect ke dashboard mahasiswa
        return redirect()->route('mahasiswa.dashboard')
            ->with('success', 'Registrasi berhasil! Selamat datang, ' . $user->name);
    }
}
