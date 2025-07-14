@extends('layouts.app')

@section('content')
    <h2>Edit Tugas</h2>

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

    <form action="{{ route('admin.tugas.update', $tugas->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Judul</label>
            <input type="text" name="judul" class="form-control" value="{{ old('judul', $tugas->judul) }}" required>
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" required>{{ old('deskripsi', $tugas->deskripsi) }}</textarea>
        </div>

        <div class="mb-3">
            <label>Deadline</label>
            <input type="date" name="deadline" class="form-control" value="{{ old('deadline', $tugas->deadline ? \Carbon\Carbon::parse($tugas->deadline)->format('Y-m-d') : '') }}" required>
        </div>

        <div class="mb-3">
            <label>Mata Kuliah</label>
            <select name="mata_kuliah_id" class="form-control" required>
                @foreach($mataKuliahs as $mk)
                    <option value="{{ $mk->id }}" {{ old('mata_kuliah_id', $tugas->mata_kuliah_id) == $mk->id ? 'selected' : '' }}>
                        {{ $mk->nama_mata_kuliah }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Kategori</label>
            <select name="kategori_id" class="form-control" required>
                @foreach($kategoris as $kat)
                    <option value="{{ $kat->id }}" {{ old('kategori_id', $tugas->kategori_id) == $kat->id ? 'selected' : '' }}>
                        {{ $kat->nama_kategori }}
                    </option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('admin.tugas.index') }}" class="btn btn-secondary">Batal</a>
    </form>
@endsection
