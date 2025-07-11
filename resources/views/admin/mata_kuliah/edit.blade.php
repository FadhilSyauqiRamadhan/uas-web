@extends('layouts.app')

@section('content')
    <h3>Edit Mata Kuliah</h3>

    <form method="POST" action="{{ route('admin.mata-kuliah.update', $mataKuliah->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Kode Mata Kuliah</label>
            <input type="text" name="kode" class="form-control" value="{{ old('kode', $mataKuliah->kode) }}" required>
        </div>

        <div class="mb-3">
            <label>Nama Mata Kuliah</label>
            <input type="text" name="nama_mata_kuliah" class="form-control" value="{{ old('nama_mata_kuliah', $mataKuliah->nama_mata_kuliah) }}" required>
        </div>

        <div class="mb-3">
            <label>Dosen Pengampu</label>
            <input type="text" name="dosen_pengampu" class="form-control" value="{{ old('dosen_pengampu', $mataKuliah->dosen_pengampu) }}">
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('admin.mata-kuliah.index') }}" class="btn btn-secondary">Batal</a>
    </form>
@endsection
