@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0"><i class="bi bi-book"></i> Daftar Mata Kuliah</h3>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Kembali ke Dashboard
        </a>
    </div>

    <a href="{{ route('admin.mata-kuliah.create') }}" class="btn btn-success mb-3">
        <i class="bi bi-plus-circle"></i> Tambah Mata Kuliah
    </a>

    @forelse ($mataKuliahs as $mk)
        <div class="card mb-2 shadow-sm">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <strong>{{ $mk->nama_mata_kuliah }}</strong>
                    @if($mk->dosen_pengampu)
                        <div class="text-muted small"><i class="bi bi-person-badge"></i> Dosen: {{ $mk->dosen_pengampu }}</div>
                    @endif
                </div>
                <div>
                    <a href="{{ route('admin.mata-kuliah.edit', $mk->id) }}" class="btn btn-warning btn-sm me-2">
                        <i class="bi bi-pencil"></i> Edit
                    </a>
                    <form action="{{ route('admin.mata-kuliah.destroy', $mk->id) }}" method="POST" class="d-inline"
                          onsubmit="return confirm('Yakin ingin menghapus?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">
                            <i class="bi bi-trash"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-info">Belum ada mata kuliah.</div>
    @endforelse
@endsection
