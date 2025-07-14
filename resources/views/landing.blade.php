@extends('layouts.app')

@section('content')
{{-- HERO SECTION --}}
<div class="bg-light p-5 rounded mb-4 shadow-sm">
    <div class="row align-items-center">
        <div class="col-md-8">
            <h1 class="display-5 fw-bold">Selamat Datang di Manajemen Tugas MI2A</h1>
            <p class="lead">Pantau, kelola, dan kumpulkan tugas kuliah dengan mudah.<br>Jangan biarkan deadline mengejar kamu!</p>
            <a href="{{ route('mahasiswa.tugas.index') }}" class="btn btn-primary btn-lg mt-3">
                <i class="bi bi-clipboard-check"></i> Lihat Semua Tugas
            </a>
        </div>
        <div class="col-md-4 text-center">
            <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Mahasiswa" width="180" class="img-fluid">
        </div>
    </div>
</div>

{{-- TUGAS TERBARU --}}
<h3 class="mb-3"><i class="bi bi-stars"></i>Tugas Terbaru</h3>
<div class="row">
    @forelse($tugas as $item)
        <div class="col-md-6 col-lg-4 mb-3">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div>
                        <h5 class="card-title">{{ $item->judul }}</h5>
                        <p class="text-muted mb-2">
                            <i class="bi bi-calendar-event"></i> Deadline: {{ \Carbon\Carbon::parse($item->deadline)->translatedFormat('d F Y') }}
                        </p>
                        <p class="mb-0"><i class="bi bi-book"></i> {{ $item->mataKuliah->nama_mata_kuliah ?? '-' }}</p>
                    </div>
                    <a href="{{ route('mahasiswa.tugas.show', $item->id) }}" class="btn btn-outline-primary mt-3">
                        <i class="bi bi-eye"></i> Lihat Detail
                    </a>
                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-info">Belum ada tugas.</div>
    @endforelse
</div>

{{-- FITUR --}}
<hr class="my-5">
<h3 class="mb-4 text-center">Kenapa Pakai Aplikasi Ini?</h3>
<div class="row">
    @php
        $features = [
            ['icon' => 'bi-alarm', 'title' => 'Pantau Deadline', 'desc' => 'Jangan sampai telat! Semua deadline tugas ada di sini.'],
            ['icon' => 'bi-upload', 'title' => 'Kumpulkan Online', 'desc' => 'Upload file tugas dengan mudah dan aman.'],
            ['icon' => 'bi-lightbulb', 'title' => 'Lebih Produktif', 'desc' => 'Fokus belajar, sistem bantu atur tugas kuliah.'],
        ];
    @endphp
    @foreach($features as $f)
    <div class="col-md-4 mb-3">
        <div class="card h-100 text-center border-0 shadow-sm">
            <div class="card-body">
                <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width:70px; height:70px;">
                    <i class="bi {{ $f['icon'] }}" style="font-size:1.8rem; color: #0d6efd;"></i>
                </div>
                <h5>{{ $f['title'] }}</h5>
                <p class="text-muted">{{ $f['desc'] }}</p>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
