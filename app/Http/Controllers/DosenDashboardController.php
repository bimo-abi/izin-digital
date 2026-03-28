<?php

namespace App\Http\Controllers;

use App\Models\Letter;
use Illuminate\Http\Request;

class DosenDashboardController extends Controller
{
    public function index()
    {
        // Dosen hanya lihat surat yang sudah approved admin
        $letters = Letter::where('status', 'approved')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('dosen.dashboard', compact('letters'));
    }
}