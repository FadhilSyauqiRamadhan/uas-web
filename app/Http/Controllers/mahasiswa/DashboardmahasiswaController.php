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

        // Ambil ID tugas yang sudah dikumpulkan user
        $tugasSudahKumpul = FadhilPengumpulanTugas::where('user_id', $user->id)
                            ->pluck('tugas_id')
                            ->toArray();

        // Hitung total tugas, sudah & belum
        $totalTugas = FadhilTugas::count();
        $totalSudah = count($tugasSudahKumpul);
        $totalBelum = $totalTugas - $totalSudah;

        // Ambil parameter filter dari URL
        $filter = request('filter');
        $query = FadhilTugas::with(['mataKuliah', 'kategori'])
                    ->whereNotIn('id', $tugasSudahKumpul) // <-- Filter yg belum dikumpulkan
                    ->orderBy('deadline');

        // Terapkan filter deadline
        if ($filter === 'today') {
            $query->whereDate('deadline', today());
        } elseif ($filter === '7days') {
            $query->whereDate('deadline', '>=', today())
                ->whereDate('deadline', '<=', now()->addDays(7));
        } elseif ($filter === 'overdue') {
            $query->whereDate('deadline', '<', today());
        }

        $tugasDekat = $query->get();

        // Riwayat pengumpulan tugas
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
