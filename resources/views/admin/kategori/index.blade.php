@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0"><i class="bi bi-tags"></i> Kategori Tugas</h3>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Kembali ke Dashboard
        </a>
    </div>

    <a href="{{ route('admin.kategori.create') }}" class="btn btn-success mb-3">
        <i class="bi bi-plus-circle"></i> Tambah Kategori
    </a>

    @forelse ($kategoris as $kategori)
        <div class="card mb-2 shadow-sm">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <strong>{{ $kategori->nama_kategori }}</strong>
                </div>
                <div>
                    <a href="{{ route('admin.kategori.edit', $kategori->id) }}" class="btn btn-warning btn-sm me-2">
                        <i class="bi bi-pencil"></i> Edit
                    </a>
                    <form action="{{ route('admin.kategori.destroy', $kategori->id) }}" method="POST" class="d-inline"
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
        <div class="alert alert-info">Belum ada kategori.</div>
    @endforelse
@endsection
