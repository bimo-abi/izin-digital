<?php

namespace App\Http\Controllers;

use App\Models\Letter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MahasiswaDashboardController extends Controller
{
    public function index()
    {
        // Mahasiswa hanya lihat surat mereka sendiri
        $letters = Letter::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('mahasiswa.dashboard', compact('letters'));
    }
}