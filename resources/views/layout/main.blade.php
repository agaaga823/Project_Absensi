<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ngabsen.in - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f5f9;
        }
        .sidebar {
            background-color: #0f2c63;
            color: white;
            height: 100vh;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
        }
        .sidebar a.active {
            background-color: #fbb03b;
            color: black;
        }
        .card-info {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 col-lg-2 p-3 sidebar">
            <h5 class="fw-bold mb-4">ngabsen <span style="color: #fbb03b;">in</span></h5>
            <a href="{{ route('dashboard') }}" class="d-block p-2 rounded mb-2 {{ request()->is('dashboard') ? 'active' : '' }}">
                <i class="bi bi-house-door-fill me-2"></i> Beranda
            </a>
            <a href="{{ route('presensi') }}" class="d-block p-2 rounded mb-2 {{ request()->is('presensi') ? 'active' : '' }}">
                <i class="bi bi-bar-chart-fill me-2"></i> Presensi
            </a>
        </div>

        <!-- Main content -->
        <div class="col-md-9 col-lg-10 p-4">
            <div class="d-flex justify-content-end mb-3">
                <span class="me-2">Agnes</span>
                <i class="bi bi-person"></i>
            </div>
            @yield('content')
            <footer class="text-center text-muted mt-5 small">
                Copyright © ngabsen.in 2025
            </footer>
        </div>
    </div>
</div>
</body>
</html>