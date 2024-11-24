<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Bagian Akademik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fff;
        }

        .header {
            background-color: #658345;
            padding: 15px 30px;
            display: flex;
            align-items: center;
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo-container img {
            width: 50px;
            height: auto;
        }

        .logo-text {
            color: black;
            line-height: 1.2;
        }

        .logo-text h1 {
            margin: 0;
            font-size: 24px;
            font-weight: bold;
        }

        .logo-text p {
            margin: 0;
            font-size: 14px;
        }

        .sidebar {
            width: 200px;
            background-color: #fff;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 85 px;
            padding: 20px;
            border-right: 1px solid #ddd;
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px;
            margin-bottom: 10px;
            color: black;
            text-decoration: none;
            font-size: 16px;
        }

        .menu-item.active {
            background-color: #658345;
            color: white;
            border-radius: 5px;
        }

        .main-content {
            margin-left: 200px;
            padding: 20px;
        }

        .status-card {
            background-color: #658345;
            padding: 20px;
            border-radius: 8px;
            color: black;
            margin-bottom: 20px;
        }

        .status-card h2 {
            font-size: 18px;
            margin-bottom: 15px;
        }

        .status-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
        }

        .status-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-top: 15px;
        }

        .status-item {
            text-align: center;
        }

        .status-item h3 {
            font-size: 16px;
            margin-bottom: 5px;
        }

        .status-item p {
            margin: 0;
        }

        .status-badge {
            background-color: blue;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            display: inline-block;
        }

        .action-buttons {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .action-button {
            background-color: #658345;
            color: white;
            padding: 15px;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            border: none;
            font-size: 16px;
        }

        .action-button:hover {
            background-color: #4f6434;
            color: white;
        }

        .profile {
            position: fixed;
            bottom: 20px;
            left: 20px;
            width: 160px;
            text-align: center;
        }

        .profile img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin-bottom: 10px;
        }

        .profile-info {
            font-size: 14px;
            line-height: 1.4;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="logo-container">
            <img src="{{ asset('backend/img/logoSate-removebg-preview.png') }}" alt="SATE Logo">
            <div class="logo-text">
                <h1>SATE</h1>
                <p>SISTEM AKADEMIK TERPADU EFISIEN</p>
            </div>
        </div>
    </div>

    <div class="sidebar">
        <a href="#" class="menu-item active">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="3" width="18" height="18" rx="2" />
                <path d="M9 3v18" />
                <path d="M3 9h18" />
            </svg>
            Dashboard
        </a>
        <a href="#" class="menu-item">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                <circle cx="12" cy="7" r="4" />
            </svg>
            Profile
        </a>
        <a href="#" class="menu-item">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9" />
                <path d="M13.73 21a2 2 0 0 1-3.46 0" />
            </svg>
            Notifikasi
        </a>
    </div>

    <div class="main-content">
        <div class="status-card">
            <h2>Status Pegawai</h2>
            <div class="status-content">
                <div class="status-info">
                    <p>Nama: {{ $nama ?? 'Nama si Pegawai nya' }}</p>
                    <p>NIDN: {{ $nidn ?? 'N/A' }}</p>

                    <div class="status-grid">
                        <div class="status-item">
                            <h3>Masa Jabatan</h3>
                            <p>2018-2038</p>
                        </div>
                        <div class="status-item">
                            <h3>Fakultas</h3>
                            <p>Fakultas Sains Matematika</p>
                        </div>
                        <div class="status-item">
                            <h3>Status Pegawai</h3>
                            <span class="status-badge">AKTIF</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="action-buttons">
            <button type="button" class="btn btn-outline-success btn-lg"
                onclick="window.location.href='{{ route('pembimbingakademik.verifikasiirs') }}'">VERIFIKASI IRS</button>
            {{-- <a href="{{ route('verifikasiirs') }}" class="action-button">
                Verifikasi irs
            </a> --}}
        </div>

        <div class="profile">
            <img src="{{ asset('backend/img/profile img.jpg') }}" alt="Profile Photo">
            <div class="profile-name">
                <p>{{ $nama ?? 'User tidak ditemukan' }}</p>
                <p>{{ $nidn ?? 'N/A' }}</p>
                <p>Informatika</p>
            </div>
            <div class="btn-container">
                <button type="button" class="btn btn-outline-secondary"
                    onclick="window.location.href='{{ route('logout') }}'">Logout</button>
            </div>
        </div>

</body>

</html>
