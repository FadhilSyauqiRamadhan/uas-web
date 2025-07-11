<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardMahasiswaController extends Controller
{
    public function index()
    {
        $tugasDekat = \App\Models\FadhilTugas::where('deadline', '>=', now())
        ->where('deadline', '<=', now()->addDays(7))
        ->orderBy('deadline', 'asc')
        ->get();


        return view('mahasiswa.dashboard', compact('tugasDekat'));
    }
}

