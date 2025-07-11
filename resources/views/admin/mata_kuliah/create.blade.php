@extends('layouts.app')

@section('content')
    <h3>Tambah Mata Kuliah</h3>

    <form method="POST" action="{{ route('admin.mata-kuliah.store') }}">
        @csrf

        <div class="mb-3">
            <label>Kode Mata Kuliah</label>
            <input type="text" name="kode" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Nama Mata Kuliah</label>
            <input type="text" name="nama_mata_kuliah" class="form-control" required>
        </div>

         <div class="mb-3">
            <label>Dosen Pengampu</label>
            <input type="text" name="dosen_pengampu" class="form-control">
        </div>

        <button class="btn btn-primary">Simpan</button>
    </form>
@endsection
