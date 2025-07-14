<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\FadhilTugas;
use App\Models\FadhilPengumpulanTugas;

class DashboardMahasiswaController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Total semua tugas
        $totalTugas = FadhilTugas::count();

        // Tugas yang sudah dikumpulkan oleh user saat ini
        $totalSudah = FadhilPengumpulanTugas::where('user_id', $user->id)->count();

        // Tugas yang belum dikumpulkan
        $totalBelum = $totalTugas - $totalSudah;

        // Tugas dengan deadline dalam 7 hari ke depan
        $tugasDekat = FadhilTugas::with(['mataKuliah', 'kategori'])
            ->whereDate('deadline', '>=', now())
            ->whereDate('deadline', '<=', now()->addDays(7))
            ->orderBy('deadline')
            ->get();

        // Riwayat pengumpulan tugas terakhir user
        $riwayat = FadhilPengumpulanTugas::with('tugas')
            ->where('user_id', $user->id)
            ->latest()
            ->take(3)
            ->get();

        return view('mahasiswa.dashboard', compact(
            'totalTugas',
            'totalSudah',
            'totalBelum',
            'tugasDekat',
            'riwayat'
        ));
    }
}
