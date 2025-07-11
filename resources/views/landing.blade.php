{{-- filepath: resources/views/landing.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h1 class="mb-3">Selamat Datang di Manajemen Tugas Kelas MI2A</h1>
        <p class="lead">
            Platform sederhana untuk memantau, mengumpulkan, dan mengelola tugas kuliah Anda.<br>
            Mudahkan hidupmu, jangan sampai lupa deadline!
        </p>
        <a href="{{ route('mahasiswa.tugas.index') }}" class="btn btn-primary btn-lg mt-2">
            Lihat Semua Tugas
        </a>
    </div>
    <div class="col-md-4 text-center">
        <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Mahasiswa" width="180">
    </div>
</div>

<hr>

<h3 class="mb-3">Tugas Terbaru</h3>
@forelse($tugas as $item)
    <div class="card mb-2">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div>
                <strong>{{ $item->judul }}</strong><br>
                <small>Deadline: {{ $item->deadline }}</small>
            </div>
            <a href="{{ route('mahasiswa.tugas.show', $item->id) }}" class="btn btn-outline-primary btn-sm">Lihat Detail</a>
        </div>
    </div>
@empty
    <div class="alert alert-info">Belum ada tugas.</div>
@endforelse

<hr>

<div class="row mt-4">
    <div class="col-md-4">
        <div class="card h-100 shadow-sm">
            <div class="card-body text-center">
                <i class="bi bi-alarm" style="font-size:2rem"></i>
                <h5 class="mt-2">Pantau Deadline</h5>
                <p class="text-muted">Jangan sampai telat! Semua deadline tugas ada di sini.</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100 shadow-sm">
            <div class="card-body text-center">
                <i class="bi bi-upload" style="font-size:2rem"></i>
                <h5 class="mt-2">Kumpulkan Online</h5>
                <p class="text-muted">Upload file tugas dengan mudah dan aman.</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100 shadow-sm">
            <div class="card-body text-center">
                <i class="bi bi-emoji-smile" style="font-size:2rem"></i>
                <h5 class="mt-2">Motivasi Kuliah</h5>
                <p class="text-muted">"Sukses itu milik mereka yang tidak menunda tugas!"</p>
            </div>
        </div>
    </div>
</div>
@endsection
