<!DOCTYPE html>
<html>
<head>
    <title>Manajemen Tugas Kelas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <style>
        body { padding-top: 70px; }
        .navbar-brand { font-weight: bold; font-size: 1.5rem; }
        .navbar { box-shadow: 0 2px 8px rgba(0,0,0,0.07); }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top px-4">
    <a class="navbar-brand d-flex align-items-center" href="/">
        <i class="bi bi-journal-bookmark-fill me-2"></i> TugasKelas
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto align-items-center">
            @auth
                <li class="nav-item me-2">
                    <span class="text-white">
                        <i class="bi bi-person-circle"></i>
                        {{ Auth::user()->name }} ({{ Auth::user()->role ?? '-' }})
                    </span>
                </li>
                <li class="nav-item me-2">
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-primary">
                            <i class="bi bi-speedometer2"></i> Dashboard Admin
                        </a>
                    @elseif(Auth::user()->role === 'mahasiswa')
                        <a href="{{ route('mahasiswa.dashboard') }}" class="btn btn-sm btn-primary">
                            <i class="bi bi-speedometer2"></i> Dashboard Mahasiswa
                        </a>
                    @endif
                </li>
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

    <div class="container mt-4">
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
