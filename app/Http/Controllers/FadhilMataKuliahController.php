<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FadhilMataKuliah;

class FadhilMataKuliahController extends Controller
{
    public function index()
    {
        $mataKuliahs = FadhilMataKuliah::all();
        return view('admin.mata_kuliah.index', compact('mataKuliahs'));
    }

    public function create()
    {
        return view('admin.mata_kuliah.create');
    }

    public function edit($id)
{
    $mataKuliah = FadhilMataKuliah::findOrFail($id);
    return view('admin.mata_kuliah.edit', compact('mataKuliah'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'kode' => 'required|string|unique:fadhil_mata_kuliahs,kode,' . $id,
        'nama_mata_kuliah' => 'required|string|unique:fadhil_mata_kuliahs,nama_mata_kuliah,' . $id,
        'dosen_pengampu' => 'nullable|string',
    ]);

    $mataKuliah = FadhilMataKuliah::findOrFail($id);
    $mataKuliah->update([
        'kode' => $request->kode,
        'nama_mata_kuliah' => $request->nama_mata_kuliah,
        'dosen_pengampu' => $request->dosen_pengampu,
    ]);

    return redirect()->route('admin.mata-kuliah.index')->with('success', 'Mata kuliah berhasil diupdate.');
}

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|string|unique:fadhil_mata_kuliahs,kode',
            'nama_mata_kuliah' => 'required|string|unique:fadhil_mata_kuliahs,nama_mata_kuliah',
            'dosen_pengampu' => 'nullable|string',
        ]);

        FadhilMataKuliah::create([
            'kode' => $request->kode,
            'nama_mata_kuliah' => $request->nama_mata_kuliah,
            'dosen_pengampu' => $request->dosen_pengampu,
        ]);

        return redirect()->route('admin.mata-kuliah.index')->with('success', 'Mata kuliah berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        FadhilMataKuliah::destroy($id);
        return back()->with('success', 'Mata kuliah berhasil dihapus.');
    }
}
