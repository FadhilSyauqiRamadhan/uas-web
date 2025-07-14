@extends('layouts.app')

@section('content')
<div class="container-fluid">
    {{-- Header Halaman --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">
            <i class="bi bi-journal-text me-2"></i> Status Pengumpulan Tugas Mahasiswa
        </h4>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Kembali ke Dashboard
        </a>
    </div>

    {{-- Tabel Status Pengumpulan --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center">
                    <thead class="table-primary text-dark">
                        <tr>
                            <th class="text-start bg-light">Nama Mahasiswa</th>
                            @foreach ($tugasList as $tugas)
                                <th style="min-width: 180px;">
                                    <div class="fw-semibold">{{ $tugas->judul }}</div>
                                    <div class="text-muted small">
                                        <i></i>{{ $tugas->mataKuliah->nama_mata_kuliah ?? '-' }}
                                    </div>
                                    <div class="text-muted small">
                                        <i></i>{{ \Carbon\Carbon::parse($tugas->deadline)->format('d M Y') }}
                                    </div>
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mahasiswaList as $mahasiswa)
                            <tr>
                                <td class="text-start fw-semibold">{{ $mahasiswa->name }}</td>
                                @foreach ($tugasList as $tugas)
                                    @php
                                        $key = $mahasiswa->id . '_' . $tugas->id;
                                        $sudah = $pengumpulan->has($key);
                                    @endphp
                                    <td class="{{ $sudah ? 'table-success' : 'table-danger' }}">
                                        <span class="fw-bold">
                                            {{ $sudah ? 'Sudah' : 'Belum' }}
                                        </span>
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
