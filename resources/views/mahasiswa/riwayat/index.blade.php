@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-3">Riwayat Pengumpulan Tugas</h3>

    @if($riwayat->count())
        <ul class="list-group">
            @foreach($riwayat as $r)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <strong>{{ $r->tugas->judul }}</strong><br>
                        <small>Dikumpulkan: {{ \Carbon\Carbon::parse($r->tanggal_kumpul)->format('d M Y') }}</small>
                    </div>
                    <a href="{{ asset('storage/'.$r->file_tugas) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                        <i class="bi bi-file-earmark-text"></i> Lihat File
                    </a>
                </li>
            @endforeach
        </ul>
    @else
        <div class="alert alert-secondary mt-3">Belum ada pengumpulan.</div>
    @endif
</div>
@endsection
