@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">

        {{-- Greeting --}}
        <div class="card shadow-sm mb-4">
            <div class="card-body text-center">
                <h2 class="mb-3">Selamat Datang di Dashboard Mahasiswa!</h2>
                <p class="lead mb-4">
                    Kelola dan pantau semua tugas kuliah Anda di sini.<br>
                    Jangan lupa cek deadline dan kumpulkan tugas tepat waktu!
                </p>
                <a href="{{ route('mahasiswa.tugas.index') }}" class="btn btn-primary btn-lg mb-3">
                    <i class="bi bi-journal-text"></i> Lihat Daftar Tugas
                </a>
            </div>
        </div>

        {{-- Statistik --}}
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card border-start border-primary shadow-sm">
                    <div class="card-body text-center">
                        <h6 class="text-muted"><i class="bi bi-book"></i> Total Tugas</h6>
                        <h3>{{ $totalTugas }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-start border-success shadow-sm">
                    <div class="card-body text-center">
                        <h6 class="text-muted"><i class="bi bi-check-circle"></i> Sudah Dikumpul</h6>
                        <h3>{{ $totalSudah }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-start border-danger shadow-sm">
                    <div class="card-body text-center">
                        <h6 class="text-muted"><i class="bi bi-clock-history"></i> Belum Dikumpul</h6>
                        <h3>{{ $totalBelum }}</h3>
                    </div>
                </div>
            </div>
        </div>

        {{-- Kalender Tugas --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-warning text-dark">
                <i class="bi bi-calendar-event"></i> Kalender Tugas (7 Hari ke Depan)
            </div>
            <div class="card-body">
                @if($tugasDekat->count())
                    <ul class="list-group">
                        @foreach($tugasDekat as $tugas)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ $tugas->judul }}</strong>
                                    <div class="small text-muted">
                                        Mata Kuliah: {{ $tugas->mataKuliah->nama_mata_kuliah ?? '-' }}<br>
                                        Kategori: {{ $tugas->kategori->nama_kategori ?? '-' }}
                                    </div>
                                </div>
                                <span class="badge bg-danger">
                                    <i class="bi bi-clock"></i> {{ \Carbon\Carbon::parse($tugas->deadline)->format('d M Y') }}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="alert alert-success mb-0">
                        Tidak ada tugas dengan deadline dekat.
                    </div>
                @endif
            </div>
        </div>

        {{-- Riwayat Pengumpulan --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-info text-white">
                <i class="bi bi-upload"></i> Riwayat Pengumpulan Terakhir
            </div>
            <div class="card-body">
                @if($riwayat->count())
                    <ul class="list-group">
                        @foreach($riwayat as $r)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ $r->tugas->judul }}</strong>
                                    <div class="text-muted small">Dikumpulkan: {{ \Carbon\Carbon::parse($r->tanggal_kumpul)->format('d M Y') }}</div>
                                </div>
                                <a href="{{ asset('storage/'.$r->file_tugas) }}" class="btn btn-outline-secondary btn-sm" target="_blank">
                                    <i class="bi bi-file-earmark"></i> Lihat
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="alert alert-secondary mb-0">
                        Belum ada tugas yang dikumpulkan.
                    </div>
                @endif
            </div>
        </div>

        {{-- Motivasi --}}
        <div class="alert alert-light text-center mt-3">
            <i class="bi bi-lightbulb"></i> <em>"Sukses itu milik mereka yang tidak menunda tugas!"</em>
        </div>

    </div>
</div>
@endsection
