<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FadhilTugas;
use App\Models\FadhilKategori;
use App\Models\FadhilMataKuliah;
use Illuminate\Support\Facades\Auth;

class FadhilTugasController extends Controller
{
  public function index()
{
    if (Auth::user()->role !== 'admin') {
        abort(403);
    }

    $tugas = FadhilTugas::with(['mataKuliah', 'kategori'])->get();
    return view('admin.tugas.index', compact('tugas'));
}

        public function pengumpulan($id)
    {
        $tugas = FadhilTugas::with(['pengumpulanTugas.user'])->findOrFail($id);
        $pengumpulans = $tugas->pengumpulanTugas()->with('user')->get();
        return view('admin.tugas.pengumpulan', compact('tugas', 'pengumpulans'));
    }

    public function create()
    {
        if (Auth::user()->role !== 'admin') {
        abort(403);
    }

        $kategoris = FadhilKategori::all();
        $mataKuliahs = FadhilMataKuliah::all();
        return view('admin.tugas.create', compact('kategoris', 'mataKuliahs'));
    }


public function edit($id)
{
    if (Auth::user()->role !== 'admin') {
        abort(403);
    }
    $tugas = FadhilTugas::findOrFail($id);
    $kategoris = FadhilKategori::all();
    $mataKuliahs = FadhilMataKuliah::all();
    return view('admin.tugas.edit', compact('tugas', 'kategoris', 'mataKuliahs'));
}

public function update(Request $request, $id)
{
    if (Auth::user()->role !== 'admin') {
        abort(403);
    }

    $request->validate([
        'judul' => 'required',
        'deskripsi' => 'required',
        'deadline' => 'required|date',
        'mata_kuliah_id' => 'required|exists:fadhil_mata_kuliahs,id',
        'kategori_id' => 'required|exists:fadhil_kategoris,id',
    ]);

    $tugas = FadhilTugas::findOrFail($id);
    $tugas->update([
        'judul' => $request->judul,
        'deskripsi' => $request->deskripsi,
        'deadline' => $request->deadline,
        'mata_kuliah_id' => $request->mata_kuliah_id,
        'kategori_id' => $request->kategori_id,
    ]);

    return redirect()->route('admin.tugas.index')->with('success', 'Tugas berhasil diupdate.');
}

    public function store(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
        abort(403);
    }

        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'deadline' => 'required|date',
            'mata_kuliah_id' => 'required|exists:fadhil_mata_kuliahs,id',
            'kategori_id' => 'required|exists:fadhil_kategoris,id',
        ]);

        FadhilTugas::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'deadline' => $request->deadline,
            'mata_kuliah_id' => $request->mata_kuliah_id,
            'kategori_id' => $request->kategori_id,
            'dibuat_oleh_user_id' => Auth::id(),
        ]);

        return redirect()->route('admin.tugas.index')->with('success', 'Tugas berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        if (Auth::user()->role !== 'admin') {
        abort(403);
    }
        FadhilTugas::destroy($id);
        return back()->with('success', 'Tugas berhasil dihapus.');
    }
}
