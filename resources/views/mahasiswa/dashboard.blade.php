@extends('layouts.app')

@section('content')
<body style="background-color: #f8f9fa;">
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

        {{-- Notifikasi Deadline Hari Ini --}}
        @if($tugasDekat->where(fn($t) => \Carbon\Carbon::parse($t->deadline)->isToday())->count())
            <div class="alert alert-danger">
                <i class="bi bi-exclamation-triangle"></i> Ada tugas yang harus dikumpulkan <strong>hari ini</strong>!
            </div>
        @endif

        {{-- Statistik --}}
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card border-start border-primary shadow-sm">
                    <div class="card-body text-center">
                        <h6 class="text-muted"><i class="bi bi-book text-primary"></i> Total Tugas</h6>
                        <h3 data-bs-toggle="tooltip" title="Jumlah seluruh tugas aktif">{{ $totalTugas }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-start border-success shadow-sm">
                    <div class="card-body text-center">
                        <h6 class="text-muted"><i class="bi bi-check-circle text-success"></i> Sudah Dikumpul</h6>
                        <h3 data-bs-toggle="tooltip" title="Tugas yang sudah Anda kumpulkan">{{ $totalSudah }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-start border-danger shadow-sm">
                    <div class="card-body text-center">
                        <h6 class="text-muted"><i class="bi bi-clock-history text-danger"></i> Belum Dikumpul</h6>
                        <h3 data-bs-toggle="tooltip" title="Tugas yang belum Anda kumpulkan">{{ $totalBelum }}</h3>
                    </div>
                </div>
            </div>
        </div>

        {{-- Progress Bar --}}
        <div class="mb-4">
            <h6 class="text-muted"><i class="bi bi-bar-chart-line"></i> Progress Pengumpulan Tugas</h6>
            <div class="progress">
                @php
                    $progress = $totalTugas > 0 ? round(($totalSudah / $totalTugas) * 100) : 0;
                @endphp
                <div class="progress-bar bg-success" role="progressbar" style="width: {{ $progress }}%;">
                    {{ $progress }}%
                </div>
            </div>
        </div>

        {{-- Filter Deadline --}}
        <form method="GET" class="mb-3">
            <select name="filter" onchange="this.form.submit()" class="form-select form-select-sm w-auto">
                <option value="">Semua</option>
                <option value="today" {{ request('filter') == 'today' ? 'selected' : '' }}>Hari Ini</option>
                <option value="7days" {{ request('filter') == '7days' ? 'selected' : '' }}>7 Hari ke Depan</option>
                <option value="overdue" {{ request('filter') == 'overdue' ? 'selected' : '' }}>Terlambat</option>
            </select>
        </form>

        {{-- Kalender Tugas --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-warning text-dark">
                <i class="bi bi-calendar-event"></i> Kalender Tugas
            </div>
            <div class="card-body">
                @if($tugasDekat->count())
                    <ul class="list-group">
                        @foreach($tugasDekat as $tugas)
                            @php
                                $deadline = \Carbon\Carbon::parse($tugas->deadline);
                                $today = \Carbon\Carbon::today();
                            @endphp
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ $tugas->judul }}</strong>
                                    <div class="small text-muted">
                                        Mata Kuliah: {{ $tugas->mataKuliah->nama_mata_kuliah ?? '-' }}<br>
                                        Kategori: {{ $tugas->kategori->nama_kategori ?? '-' }}
                                    </div>
                                    @if($deadline->isToday())
                                        <span class="badge bg-danger">Deadline Hari Ini</span>
                                    @elseif($deadline->isPast())
                                        <span class="badge bg-secondary">
                                            Terlambat {{ $deadline->diffInDays($today) }} hari
                                        </span>
                                    @elseif($deadline->isFuture())
                                        <span class="badge bg-success">
                                            Sisa {{ $today->diffInDays($deadline) }} hari lagi
                                        </span>
                                    @endif
                                </div>
                                <span class="badge bg-dark">
                                    <i class="bi bi-clock"></i> {{ $deadline->format('d M Y') }}
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

        {{-- Riwayat Accordion --}}
        <div class="accordion mb-4" id="riwayatAccordion">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                        <i class="bi bi-upload"></i> Riwayat Pengumpulan Terakhir
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse">
                    <div class="accordion-body">
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
            </div>
        </div>

        {{-- Motivasi --}}
        <div class="alert alert-light text-center mt-3">
            <i class="bi bi-lightbulb"></i> <em>"Sukses itu milik mereka yang tidak menunda tugas!"</em>
        </div>

    </div>
</div>
</body>
@endsection

@push('scripts')
<script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    tooltipTriggerList.forEach(tooltip => new bootstrap.Tooltip(tooltip))
</script>
@endpush
