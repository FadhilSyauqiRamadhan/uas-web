@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
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

                {{-- Navigasi --}}
                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <a href="{{ route('admin.tugas.index') }}" class="btn btn-outline-primary w-100 py-3">
                            <i class="bi bi-journal-text fs-4"></i><br> Kelola Tugas
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('admin.kategori.index') }}" class="btn btn-outline-success w-100 py-3">
                            <i class="bi bi-tags fs-4"></i><br> Kelola Kategori
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('admin.mata-kuliah.index') }}" class="btn btn-outline-warning w-100 py-3">
                            <i class="bi bi-book fs-4"></i><br> Kelola Mata Kuliah
                        </a>
                    </div>
                </div>

                {{-- Statistik --}}
                <div class="row text-center mb-4">
                    @php
                        $stats = [
                            ['label' => 'Total Tugas', 'icon' => 'journal-text', 'color' => 'primary', 'value' => $totalTugas ?? '-'],
                            ['label' => 'Total Kategori', 'icon' => 'tags', 'color' => 'success', 'value' => $totalKategori ?? '-'],
                            ['label' => 'Total Mata Kuliah', 'icon' => 'book', 'color' => 'warning', 'value' => $totalMataKuliah ?? '-'],
                            ['label' => 'Total Mahasiswa', 'icon' => 'people', 'color' => 'info', 'value' => $totalMahasiswa ?? '-'],
                        ];
                    @endphp

                    @foreach ($stats as $stat)
                        <div class="col-md-3">
                            <div class="card border-start border-{{ $stat['color'] }} shadow-sm">
                                <div class="card-body">
                                    <h6 class="text-muted"><i class="bi bi-{{ $stat['icon'] }} text-{{ $stat['color'] }}"></i> {{ $stat['label'] }}</h6>
                                    <h3>{{ $stat['value'] }}</h3>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>


                {{-- Aktivitas Terbaru --}}
                <div class="card mt-4">
                    <div class="card-header bg-light">
                        <i class="bi bi-activity"></i> Aktivitas Terbaru
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            @forelse ($aktivitasTerbaru as $aktivitas)
                                <li class="list-group-item">
                                    <strong>{{ $aktivitas->user->name }}</strong> mengumpulkan tugas <em>{{ $aktivitas->tugas->judul }}</em><br>
                                    <small class="text-muted">{{ $aktivitas->created_at->diffForHumans() }}</small>
                                </li>
                            @empty
                                <li class="list-group-item text-muted">Belum ada aktivitas terbaru.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>



                {{-- Tips --}}
                <div class="alert alert-info mt-4">
                    <i class="bi bi-info-circle"></i>
                    Tips: Pastikan data tugas, kategori, dan mata kuliah selalu terupdate agar mahasiswa tidak ketinggalan informasi!
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
