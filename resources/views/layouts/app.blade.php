<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Tugas Kelas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Bootstrap & Icon --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <style>
        body {
            padding-top: 70px;
            background-color: #f8f9fa;
        }
        .navbar {
            backdrop-filter: blur(5px);
            background-color: rgba(33, 37, 41, 0.95);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }
        .dropdown-menu a:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top px-4">
        <a class="navbar-brand d-flex align-items-center" href="/">
            <i class="bi bi-journal-bookmark-fill me-2"></i> TugasKelas
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                @auth
                    {{-- Nama dan Role --}}
                    <li class="nav-item me-3 text-white">
                        <i class="bi bi-person-circle"></i> {{ Auth::user()->name }} ({{ Auth::user()->role }})
                    </li>

                    {{-- Dropdown Dashboard --}}
                    <li class="nav-item dropdown me-2">
                        <a class="btn btn-sm btn-primary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                            @if(Auth::user()->role === 'admin')
                                <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i class="bi bi-columns-gap"></i> Dashboard Admin</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.tugas.index') }}"><i class="bi bi-list-task"></i> Kelola Tugas</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.kategori.index') }}"><i class="bi bi-tags"></i> Kategori</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.mata-kuliah.index') }}"><i class="bi bi-journal-code"></i> Mata Kuliah</a></li>

                                {{-- ✅ Tambahan menu --}}
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{ route('admin.mahasiswa.tugas') }}"><i class="bi bi-table"></i> Status Tugas Mahasiswa</a></li>

                            @elseif(Auth::user()->role === 'mahasiswa')
                                <li><a class="dropdown-item" href="{{ route('mahasiswa.dashboard') }}"><i class="bi bi-house-door"></i> Beranda Mahasiswa</a></li>
                                <li><a class="dropdown-item" href="{{ route('mahasiswa.tugas.index') }}"><i class="bi bi-journal-text"></i> Daftar Tugas</a></li>
                            @endif
                        </ul>

                    </li>

                    {{-- Logout --}}
                    <li class="nav-item">
                        <a href="{{ route('logout') }}" class="btn btn-sm btn-outline-light"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="btn btn-sm btn-outline-light">
                            <i class="bi bi-box-arrow-in-right"></i> Login
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </nav>

    {{-- Konten Utama --}}
    <div class="container mt-4">
        @yield('content')
    </div>

    {{-- Script Bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
