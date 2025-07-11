@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-white d-flex align-items-center">
                <i class="bi bi-speedometer2 me-2"></i>
                <h4 class="mb-0">Dashboard Admin (Ketua Kelas)</h4>
            </div>
            <div class="card-body">
                <p class="lead mb-4">
                    Selamat datang, <strong>{{ Auth::user()->name }}</strong>!<br>
                    Di sini Anda dapat mengelola seluruh tugas, kategori, dan mata kuliah untuk kelas Anda.
                </p>
                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <a href="{{ route('admin.tugas.index') }}" class="btn btn-outline-primary w-100 py-3">
                            <i class="bi bi-journal-text fs-4"></i><br>
                            Kelola Tugas
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('admin.kategori.index') }}" class="btn btn-outline-success w-100 py-3">
                            <i class="bi bi-tags fs-4"></i><br>
                            Kelola Kategori
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('admin.mata-kuliah.index') }}" class="btn btn-outline-warning w-100 py-3">
                            <i class="bi bi-book fs-4"></i><br>
                            Kelola Mata Kuliah
                        </a>
                    </div>
                </div>
                <div class="alert alert-info mt-4">
                    <i class="bi bi-info-circle"></i>
                    Tips: Pastikan data tugas, kategori, dan mata kuliah selalu terupdate agar mahasiswa tidak ketinggalan informasi!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
