@extends('layouts.app')

@section('content')
    <h3>Edit Kategori Tugas</h3>

    <form method="POST" action="{{ route('admin.kategori.update', $kategori->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Kategori</label>
            <input type="text" name="nama_kategori" class="form-control" value="{{ old('nama_kategori', $kategori->nama_kategori) }}" required>
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary">Batal</a>
    </form>
@endsection
