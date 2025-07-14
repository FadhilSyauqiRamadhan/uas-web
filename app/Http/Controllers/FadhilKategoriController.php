<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FadhilKategori;

class FadhilKategoriController extends Controller
{
    public function index()
    {
        $kategoris = FadhilKategori::all();
        return view('admin.kategori.index', compact('kategoris'));
    }

    public function create()
    { 
        return view('admin.kategori.create');
    }

    public function edit($id)
{
    $kategori = FadhilKategori::findOrFail($id);
    return view('admin.kategori.edit', compact('kategori'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'nama_kategori' => 'required|string|unique:fadhil_kategoris,nama_kategori,' . $id,
    ]);

    $kategori = FadhilKategori::findOrFail($id);
    $kategori->update([
        'nama_kategori' => $request->nama_kategori,
    ]);

    return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil diupdate.');
}

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|unique:fadhil_kategoris,nama_kategori',
        ]);

        FadhilKategori::create([
            'nama_kategori' => $request->nama_kategori,
        ]);

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        FadhilKategori::destroy($id);
        return back()->with('success', 'Kategori berhasil dihapus.');
    }
}

