<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectByRole
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $role = Auth::user()->role;

            if ($role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($role === 'dosen') {
                return redirect()->route('dosen.dashboard');
            } elseif ($role === 'mahasiswa') {
                return redirect()->route('mahasiswa.dashboard');
            }
        }

        return $next($request);
    }
}
