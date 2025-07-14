@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0"><i class="bi bi-journal-text"></i> Daftar Tugas</h2>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Kembali ke Dashboard
        </a>
    </div>
    <a href="{{ route('admin.tugas.create') }}" class="btn btn-success mb-3">
        <i class="bi bi-plus-circle"></i> Tambah Tugas
    </a>
    <form method="GET" class="mb-4">
        <div class="row g-2 align-items-center">
            <div class="col-auto">
                <label for="mata_kuliah_id" class="col-form-label"><i class="bi bi-book"></i> Filter Mata Kuliah:</label>
            </div>
            <div class="col-auto">
                <select name="mata_kuliah_id" id="mata_kuliah_id" class="form-select">
                    <option value="">Semua Mata Kuliah</option>
                    @php
                        $listMataKuliah = $tugas->pluck('mataKuliah')->unique('id')->filter();
                    @endphp
                    @foreach($listMataKuliah as $mk)
                        <option value="{{ $mk->id }}" {{ request('mata_kuliah_id') == $mk->id ? 'selected' : '' }}>
                            {{ $mk->nama_mata_kuliah }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-auto">
                <button class="btn btn-outline-primary btn-sm" type="submit">
                    <i class="bi bi-funnel"></i> Filter
                </button>
            </div>
        </div>
    </form>

    @forelse($tugas->sortByDesc('created_at') as $t)
    <div class="card mb-3 shadow-sm">
        <div class="card-body">
            <h5 class="card-title">{{ $t->judul }}</h5>
            <p class="mb-1"><strong><i class="bi bi-book"></i> Mata Kuliah:</strong> {{ $t->mataKuliah->nama_mata_kuliah }}</p>
            <p class="mb-1"><strong><i class="bi bi-tags"></i> Kategori:</strong> {{ $t->kategori->nama_kategori }}</p>
            <p class="mb-2"><strong><i class="bi bi-calendar-event"></i> Deadline:</strong> {{ $t->deadline }}</p>

            @if($t->file)
                <p class="mb-2">
                    <strong><i class="bi bi-paperclip"></i> File:</strong>
                    <a href="{{ asset('storage/' . $t->file) }}" target="_blank" class="text-decoration-underline">
                        Download
                    </a>
                </p>
            @endif

            <a href="{{ route('admin.tugas.edit', $t->id) }}" class="btn btn-warning btn-sm me-2">
                <i class="bi bi-pencil"></i> Edit
            </a>
            <a href="{{ route('admin.tugas.pengumpulan', $t->id) }}" class="btn btn-info btn-sm">
                <i class="bi bi-people"></i> Lihat Pengumpul
            </a>
            <form action="{{ route('admin.tugas.destroy', $t->id) }}" method="POST" class="d-inline"
                  onsubmit="return confirm('Yakin hapus tugas ini?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm">
                    <i class="bi bi-trash"></i> Hapus
                </button>
            </form>
        </div>
    </div>
    @empty
        <div class="alert alert-info">Belum ada tugas.</div>
    @endforelse
@endsection
