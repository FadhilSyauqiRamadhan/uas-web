<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\FadhilTugas;
use App\Models\FadhilKategori;
use App\Models\FadhilMataKuliah;
use App\Models\User;
use App\Models\FadhilPengumpulanTugas;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardAdminController extends Controller
{
    public function index()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses hanya untuk admin.');
        }

        $totalTugas = FadhilTugas::count();
        $totalKategori = FadhilKategori::count();
        $totalMataKuliah = FadhilMataKuliah::count();
        $totalMahasiswa = User::where('role', 'mahasiswa')->count();

        // Tugas terbaru
        $tugasTerbaru = FadhilTugas::with(['mataKuliah', 'kategori'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get()
            ->map(function ($tugas) {
                $tugas->formatted_deadline = Carbon::parse($tugas->deadline)->format('d M Y');
                return $tugas;
            });

        // Statistik tugas per kategori (opsional untuk grafik)
        $kategoriLabels = [];
        $kategoriCounts = [];
        foreach (FadhilKategori::withCount('tugas')->get() as $kategori) {
            $kategoriLabels[] = $kategori->nama_kategori;
            $kategoriCounts[] = $kategori->tugas_count;
        }

        // Hitung tugas yang sudah dan belum dikumpulkan
        $tugasSudahDikumpulkan = FadhilPengumpulanTugas::count();

        $tugasBelumDikumpulkan = FadhilTugas::count() - $tugasSudahDikumpulkan;

        // Hitung tugas terlambat (deadline lewat dan belum dikumpulkan)
        $tugasTerlambat = FadhilTugas::whereDate('deadline', '<', now())
            ->whereDoesntHave('pengumpulanTugas') // relasi ke pengumpulan
            ->count();

            // Tugas akan datang (deadline >= hari ini)
            $tugasAkanDatang = FadhilTugas::whereDate('deadline', '>=', now())
                ->orderBy('deadline', 'asc')
                ->get()
                ->map(function ($tugas) {
                    $tugas->deadline = Carbon::parse($tugas->deadline); // ubah ke objek Carbon
                    return $tugas;
                });


        // Aktivitas terbaru dari pengumpulan tugas (asumsikan relasi ke tugas dan user)
        $aktivitasTerbaru = FadhilPengumpulanTugas::with(['tugas', 'user'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalTugas',
            'totalKategori',
            'totalMataKuliah',
            'totalMahasiswa',
            'tugasTerbaru',
            'kategoriLabels',
            'kategoriCounts',
            'tugasBelumDikumpulkan',
            'tugasSudahDikumpulkan',
            'tugasTerlambat',
            'tugasAkanDatang',
            'aktivitasTerbaru'
        ));
    }

   public function lihatPengumpulan()
{
    // Ambil semua mahasiswa
    $mahasiswaList = User::where('role', 'mahasiswa')->get();

    // Ambil semua tugas beserta mata kuliahnya
    $tugasList = FadhilTugas::with('mataKuliah')->orderBy('deadline')->get();

    // Ambil semua pengumpulan tugas dalam bentuk map
    $pengumpulan = FadhilPengumpulanTugas::all()->groupBy(function ($item) {
        return $item->user_id . '_' . $item->tugas_id;
    });

    return view('admin.mahasiswa_tugas', compact('mahasiswaList', 'tugasList', 'pengumpulan'));
}

}
