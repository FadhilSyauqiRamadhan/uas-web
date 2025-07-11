@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
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

        <div class="card shadow-sm">
            <div class="card-header bg-warning text-dark">
                <i class="bi bi-calendar-event"></i> Kalender Tugas (7 Hari ke Depan)
            </div>
            <div class="card-body">
                @if(isset($tugasDekat) && count($tugasDekat))
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
    </div>
</div>
@endsection
