<?php

namespace App\Http\Controllers;

use App\Models\Letter;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalLetters = Letter::count();
        $pendingLetters = Letter::where('status', 'pending')->count();
        $approvedLetters = Letter::where('status', 'approved')->count();
        $totalStudents = User::where('role', 'mahasiswa')->count();

        return view('admin.dashboard', compact('totalLetters', 'pendingLetters', 'approvedLetters', 'totalStudents'));
    }
}