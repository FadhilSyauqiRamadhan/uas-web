<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\FadhilPengumpulanTugas;

class RiwayatController extends Controller
{
    public function index()
    {
        $riwayat = FadhilPengumpulanTugas::with('tugas')
                    ->where('user_id', Auth::id())
                    ->latest()
                    ->get();

        return view('mahasiswa.riwayat.index', compact('riwayat'));
    }
}
