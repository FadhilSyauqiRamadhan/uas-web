<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FadhilTugas;
use App\Models\FadhilPengumpulanTugas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FadhilPengumpulanTugasController extends Controller
{

    public function landing()
{
    // Ambil 3 tugas terbaru berdasarkan waktu dibuat
    $tugas = FadhilTugas::orderBy('created_at', 'desc')->take(5)->get();
    return view('landing', compact('tugas'));
}
    public function index()
    {
        $tugas = FadhilTugas::with(['mataKuliah', 'kategori'])
                ->orderBy('created_at', 'desc')
                ->get();
        return view('mahasiswa.tugas.index', compact('tugas'));
    }

    public function show($id)
{
    $tugas = FadhilTugas::findOrFail($id);

    // Jika user sudah login dan mahasiswa, cek pengumpulan
    $pengumpulan = null;
    if (Auth::check() && Auth::user()->role === 'mahasiswa') {
        $pengumpulan = FadhilPengumpulanTugas::where('user_id', Auth::id())
            ->where('tugas_id', $id)
            ->first();
    }

    return view('mahasiswa.tugas.detail', compact('tugas', 'pengumpulan'));
}

    public function store(Request $request, $id)
    {
        if (Auth::user()->role !== 'mahasiswa') {
            abort(403, 'Akses hanya untuk mahasiswa.');
        }
        $request->validate([
            'file_tugas' => 'required|mimes:pdf,doc,docx|max:10240',
        ]);

        $filePath = $request->file('file_tugas')->store('tugas', 'public');

        FadhilPengumpulanTugas::create([
            'user_id' => Auth::id(),
            'tugas_id' => $id,
            'file_tugas' => $filePath,
            'tanggal_kumpul' => now(),
        ]);

        return back()->with('success', 'Tugas berhasil dikumpulkan!');

        if (FadhilPengumpulanTugas::where('user_id', Auth::id())->where('tugas_id', $id)->exists()) {
        return back()->withErrors(['file_tugas' => 'Kamu sudah mengumpulkan tugas ini.'])->withInput();
}
    }
}
