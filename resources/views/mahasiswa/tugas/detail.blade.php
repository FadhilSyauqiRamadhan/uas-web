@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0"><i class="bi bi-journal-text"></i> {{ $tugas->judul }}</h4>
                <a href="{{ route('mahasiswa.tugas.index') }}" class="btn btn-outline-light btn-sm">
                    <i class="bi bi-arrow-left"></i> Kembali ke Daftar Tugas
                </a>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush mb-3">
                    <li class="list-group-item">
                        <strong><i class="bi bi-book"></i> Mata Kuliah:</strong> {{ $tugas->mataKuliah->nama_mata_kuliah ?? '-' }}
                    </li>
                    <li class="list-group-item">
                        <strong><i class="bi bi-person-badge"></i> Dosen:</strong> {{ $tugas->mataKuliah->dosen_pengampu ?? '-' }}
                    </li>
                    <li class="list-group-item">
                        <strong><i class="bi bi-tags"></i> Kategori:</strong> {{ $tugas->kategori->nama_kategori ?? '-' }}
                    </li>
                    <li class="list-group-item">
                        <strong><i class="bi bi-calendar-event"></i> Deadline:</strong> {{ $tugas->deadline }}
                    </li>
                </ul>
                <div class="mb-3">
                    <strong><i class="bi bi-info-circle"></i> Deskripsi:</strong>
                    <div class="border rounded p-2 bg-light mt-1">{{ $tugas->deskripsi }}</div>
                </div>

                @if ($pengumpulan)
                    <div class="alert alert-success">
                        <strong><i class="bi bi-check-circle"></i> Sudah dikumpulkan:</strong> {{ $pengumpulan->tanggal_kumpul }}<br>
                        <a href="{{ asset('storage/' . $pengumpulan->file_tugas) }}" target="_blank" class="btn btn-outline-success btn-sm mt-2">
                            <i class="bi bi-file-earmark-arrow-down"></i> Lihat File
                        </a>
                    </div>
                @else
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @auth
                        @if(Auth::user()->role === 'mahasiswa')
                            <form action="{{ route('mahasiswa.tugas.kumpul', $tugas->id) }}" method="POST" enctype="multipart/form-data" class="mt-3">
                                @csrf
                                <div class="mb-3">
                                    <label for="file_tugas" class="form-label">Upload Tugas (PDF, DOC, DOCX)</label>
                                    <input type="file" name="file_tugas" class="form-control" required>
                                </div>
                                <button class="btn btn-success">
                                    <i class="bi bi-upload"></i> Kumpulkan
                                </button>
                            </form>
                        @endif
                    @else
                        <div class="alert alert-info mt-3">
                            <i class="bi bi-info-circle"></i> Silakan login sebagai mahasiswa untuk mengumpulkan tugas.
                        </div>
                    @endauth
                @endif
            </div>
        </div>
    </div>
