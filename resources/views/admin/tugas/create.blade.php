@extends('layouts.app')

@section('content')
    <h2>Tambah Tugas</h2>

    @if ($errors->any())
    <div class="alert alert-danger">
        <strong><i class="bi bi-exclamation-circle"></i> Terdapat kesalahan pada input:</strong>
        <ul class="mb-0 mt-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.tugas.store') }}" method="POST" enctype="multipart/form-data">

        @csrf

        <div class="mb-3">
            <label>Judul</label>
            <input type="text" name="judul" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" required></textarea>
        </div>

        <div class="mb-3">
            <label>Deadline</label>
            <input type="date" name="deadline" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Mata Kuliah</label>
            <select name="mata_kuliah_id" class="form-control" required>
                @foreach($mataKuliahs as $mk)
                    <option value="{{ $mk->id }}">{{ $mk->nama_mata_kuliah }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Kategori</label>
            <select name="kategori_id" class="form-control" required>
                @foreach($kategoris as $kat)
                    <option value="{{ $kat->id }}">{{ $kat->nama_kategori }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>File Pendukung (Opsional)</label>
            <input type="file" name="file" class="form-control">
            @error('file')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>


        <button class="btn btn-primary">Simpan</button>
    </form>
@endsection
