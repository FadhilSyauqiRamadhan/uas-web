@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0"><i class="bi bi-people"></i> Pengumpulan Tugas: <span class="text-primary">{{ $tugas->judul }}</span></h3>
        <a href="{{ route('admin.tugas.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th scope="col"><i class="bi bi-person"></i> Nama Mahasiswa</th>
                            <th scope="col"><i class="bi bi-calendar-event"></i> Tanggal Kumpul</th>
                            <th scope="col"><i class="bi bi-file-earmark"></i> File</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pengumpulans as $p)
                            <tr>
                                <td>
                                    <span class="fw-semibold">{{ $p->user->name ?? '-' }}</span>
                                    <div class="text-muted small">{{ $p->user->email ?? '' }}</div>
                                </td>
                                <td>
                                    <span class="badge bg-info text-dark">{{ \Carbon\Carbon::parse($p->tanggal_kumpul)->format('d M Y H:i') }}</span>
                                </td>
                                <td>
                                    <a href="{{ asset('storage/' . $p->file_tugas) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                        <i class="bi bi-file-earmark-arrow-down"></i> Lihat File
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted">Belum ada yang mengumpulkan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
