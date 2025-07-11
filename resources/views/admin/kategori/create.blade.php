@extends('layouts.app')

@section('content')
    <h3>Tambah Kategori Tugas</h3>

    <form method="POST" action="{{ route('admin.kategori.store') }}">
        @csrf

        <div class="mb-3">
            <label>Nama Kategori</label>
            <input type="text" name="nama_kategori" class="form-control" required>
        </div>

        <button class="btn btn-primary">Simpan</button>
    </form>
@endsection
