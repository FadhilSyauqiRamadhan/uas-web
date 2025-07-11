@extends('layouts.app')

@section('content')
<h3 class="mb-4"><i class="bi bi-journal-text"></i> Daftar Tugas</h3>

{{-- Filter Mata Kuliah --}}
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

@php
    use App\Models\FadhilPengumpulanTugas;
@endphp

@forelse ($tugas as $t)
    @if(!request('mata_kuliah_id') || (optional($t->mataKuliah)->id == request('mata_kuliah_id')))
    <div class="card mb-3 shadow-sm ">
        <div class="card-body d-flex flex-column flex-md-row align-items-md-center justify-content-between">
            <div>
                <h5 class="card-title mb-2 ">{{ $t->judul }}</h5>
                <div class="mb-1"><span class="badge bg-info text-dark"><i class="bi bi-book"></i> Mata Kuliah: {{ $t->mataKuliah->nama_mata_kuliah ?? '-' }}</span></div>
                <div class="mb-1"><span class="badge bg-secondary"><i class="bi bi-tags"></i> Kategori: {{ $t->kategori->nama_kategori ?? '-' }}</span></div>
                <div class="mb-1"><span class="badge bg-warning text-dark"><i class="bi bi-calendar-event"></i> Deadline: {{ $t->deadline }}</span></div>
                @auth
                    @if(Auth::user()->role === 'mahasiswa')
                        @php
                            $sudahKumpul = FadhilPengumpulanTugas::where('user_id', Auth::id())
                                ->where('tugas_id', $t->id)
                                ->exists();
                        @endphp
                        <div class="mb-1">
                            <span class="badge {{ $sudahKumpul ? 'bg-success' : 'bg-danger' }}">
                                <i class="bi {{ $sudahKumpul ? 'bi-check-circle' : 'bi-x-circle' }}"></i>
                                Status: {{ $sudahKumpul ? 'Sudah dikumpulkan' : 'Belum dikumpulkan' }}
                            </span>
                        </div>
                    @endif
                @endauth
            </div>
            <div class="mt-3 mt-md-0 text-md-center text-end" style="min-width: 150px;">
                <a href="{{ route('mahasiswa.tugas.show', $t->id) }}" class="btn btn-outline-primary btn-sm">
                    <i class="bi bi-eye"></i> Lihat Detail
                </a>
            </div>
        </div>
    </div>
    @endif
@empty
    <div class="alert alert-info">Belum ada tugas.</div>
@endforelse
@endsection
