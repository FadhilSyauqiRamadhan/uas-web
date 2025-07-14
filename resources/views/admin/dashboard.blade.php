@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-11 col-md-12">
            <div class="card shadow-sm mb-4 border-0">
                <div class="card-header bg-primary text-white d-flex align-items-center">
                    <i class="bi bi-speedometer2 me-2 fs-4"></i>
                    <h5 class="mb-0">Dashboard Admin (Ketua Kelas)</h5>
                </div>
                <div class="card-body">

                    {{-- Sambutan --}}
                    <div class="mb-4">
                        <p class="fs-5 mb-0">
                            Selamat datang, <strong>{{ Auth::user()->name }}</strong> 👋
                        </p>
                        <p class="text-muted">Kelola data tugas, kategori, dan mata kuliah untuk kelas Anda secara efisien.</p>
                    </div>

                    {{-- Akses Cepat --}}
                    <div class="mb-4">
                        <h6 class="text-muted mb-2">📌 Akses Cepat</h6>
                        <div class="row g-3">
                            <div class="col-sm-6 col-md-3">
                                <a href="{{ route('admin.mahasiswa.tugas') }}" class="btn btn-outline-dark w-100 py-3 shadow-sm">
                                    <i class="bi bi-table fs-3 mb-2"></i><br> Status Tugas Mahasiswa
                                </a>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <a href="{{ route('admin.tugas.index') }}" class="btn btn-outline-primary w-100 py-3 shadow-sm">
                                    <i class="bi bi-journal-text fs-3 mb-2"></i><br> Kelola Tugas
                                </a>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <a href="{{ route('admin.kategori.index') }}" class="btn btn-outline-success w-100 py-3 shadow-sm">
                                    <i class="bi bi-tags fs-3 mb-2"></i><br> Kelola Kategori
                                </a>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <a href="{{ route('admin.mata-kuliah.index') }}" class="btn btn-outline-warning w-100 py-3 shadow-sm">
                                    <i class="bi bi-book fs-3 mb-2"></i><br> Kelola Mata Kuliah
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- Statistik --}}
                    <div class="mb-4">
                        <h6 class="text-muted mb-2">📊 Statistik</h6>
                        <div class="row g-3 text-center">
                            @php
                                $stats = [
                                    ['label' => 'Total Tugas', 'icon' => 'journal-text', 'color' => 'primary', 'value' => $totalTugas ?? 0],
                                    ['label' => 'Kategori', 'icon' => 'tags', 'color' => 'success', 'value' => $totalKategori ?? 0],
                                    ['label' => 'Mata Kuliah', 'icon' => 'book', 'color' => 'warning', 'value' => $totalMataKuliah ?? 0],
                                    ['label' => 'Mahasiswa', 'icon' => 'people', 'color' => 'info', 'value' => $totalMahasiswa ?? 0],
                                ];
                            @endphp

                            @foreach ($stats as $stat)
                                <div class="col-sm-6 col-md-3">
                                    <div class="card h-100 border-0 shadow-sm">
                                        <div class="card-body">
                                            <div class="text-muted small mb-1">
                                                <i class="bi bi-{{ $stat['icon'] }} text-{{ $stat['color'] }}"></i>
                                                {{ $stat['label'] }}
                                            </div>
                                            <h3 class="fw-bold text-{{ $stat['color'] }}">{{ $stat['value'] }}</h3>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Aktivitas Terbaru --}}
                    <div class="mb-4">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-light d-flex align-items-center">
                                <i class="bi bi-activity me-2"></i> Aktivitas Terbaru
                            </div>
                            <div class="card-body">
                                @forelse ($aktivitasTerbaru as $aktivitas)
                                    <div class="mb-3 pb-2 border-bottom">
                                        <div class="d-flex justify-content-between align-items-start flex-wrap">
                                            <div>
                                                <strong>{{ $aktivitas->user->name }}</strong>
                                                <span class="text-muted">mengumpulkan tugas</span><br>
                                                <span class="badge bg-primary me-1">{{ $aktivitas->tugas->judul }}</span>
                                                <span class="badge bg-warning text-dark">{{ $aktivitas->tugas->mataKuliah->nama_mata_kuliah ?? 'Tidak Ada MK' }}</span>
                                            </div>
                                            <small class="text-muted text-end mt-1 mt-md-0">{{ $aktivitas->created_at->diffForHumans() }}</small>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-muted mb-0">Belum ada aktivitas terbaru.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    {{-- Tips --}}
                    <div class="alert alert-info d-flex align-items-center" role="alert">
                        <i class="bi bi-info-circle me-2 fs-5"></i>
                        <div>
                            Tips: Perbarui data tugas dan mata kuliah secara berkala agar mahasiswa tidak ketinggalan informasi.
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
