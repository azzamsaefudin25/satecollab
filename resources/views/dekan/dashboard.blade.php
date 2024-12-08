<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.css"
        rel="stylesheet">
    <title>Dashboard Bagian Akademik</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fff;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .header {
            background-color: #658345;
            color: black;
            padding: 30px 0;
            width: 100%;
            margin: 0;
        }

        .header-content {
            display: flex;
            align-items: center;
            padding: 0 40px;
        }

        .header h1 {
            margin: 0;
            font-size: 30px;
            margin-left: 20px;
            color: black;
        }

        .header img {
            height: 60px;
        }

        .content-wrapper {
            display: flex;
            flex: 1;
            position: relative;
        }

        .sidebar {
            width: 230px;
            background-color: #fff;
            padding: 20px;
            border-right: 2px solid #dddddd;
            display: flex;
            flex-direction: column;
        }

        .sidebar h2,
        .sidebar a {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 20px;
            color: black;
            text-decoration: none;
        }

        .sidebar a {
            display: block;
        }

        .main-content {
            flex: 1;
            padding: 30px;
            margin-left: 40px;
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

        .profile {
            margin-top: auto;
            padding: 20px;
            text-align: left;
            font-size: 12px;
        }

        .profile img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            margin-bottom: 10px;
        }

        .profile-name {
            font-size: 15px;
            margin-bottom: 10px;
        }

        .btn-container button {
            display: block;
            margin-top: 10px;
            width: 45%;
        }

        .footer {
            background-color: #658345;
            color: white;
            text-align: center;
            padding: 6px 0;
            margin-top: auto;
        }

        .footer h3 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .footer p {
            font-size: 14px;
            margin-bottom: 20px;
        }

        .footer-icons {
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        .footer-icons a {
            color: white;
            text-decoration: none;
            font-size: 20px;
            width: 40px;
            height: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            border: 2px solid white;
            border-radius: 50%;
            transition: 0.3s;
        }

        .footer-icons a:hover {
            color: #658345;
            background-color: white;
        }

        .button-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            /* 2 kolom */
            gap: 20px;
            /* Jarak antar tombol */
            margin-top: 20px;
        }

        .btn-green {
            background-color: #658345;
            /* Warna hijau yang sama dengan header */
            color: white;
            /* Warna teks putih agar kontras */
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-green:hover {
            background-color: #567539;
            /* Warna hijau sedikit lebih gelap untuk efek hover */
        }

        .btn2 {
            width: 100%;
            /* Agar tombol mengikuti lebar kolom */
        }

        .status {
            background-color: white;
            color: black;
            padding: 2px 8px;
            border-radius: 5px;
        }
    </style>
</head>

<body>

    <header class="header">
        <div class="header-content">
            <a href="{{ route('dekan') }}">
                <img src="{{ asset('backend\img\logoSate-removebg-preview.png') }}" alt="SATE Logo">
            </a>
            <a href="{{ route('dekan') }}" style="text-decoration: none;">
                <h1>SATE <br><small>Sistem Akademik Terpadu Efisien</small></h1>
            </a>
        </div>
    </header>

    <div class="content-wrapper">
        <div class="sidebar">
            <a href="{{ route('dekan') }}" class="menu-item active">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="18" height="18" rx="2" />
                    <path d="M9 3v18" />
                    <path d="M3 9h18" />
                </svg>
                Dashboard
            </a>
            <a href="{{ route('dekan.profile') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                    <circle cx="12" cy="7" r="4" />
                </svg>
                Profile</a>
            <a href="#" class="menu-item">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9" />
                    <path d="M13.73 21a2 2 0 0 1-3.46 0" />
                </svg>
                Notifikasi
            </a>

            <div class="profile">
                <img src="{{ asset('backend/img/profile img.jpg') }}" alt="Profile Image">
                <div class="profile-name">
                    <p>{{ $nama ?? 'User tidak ditemukan' }}</p>
                    <p>{{ $nidn ?? 'NIDN tidak ditemukan' }}</p>
                    <p>Informatika</p>
                </div>
                <div class="btn-container">
                    <button type="button" class="btn btn-outline-secondary w-75"
                        onclick="window.location.href='{{ route('logout') }}'">Logout</button>
                </div>
            </div>
        </div>

        <div class="main-content">
            <div class="status-card">
                <h2>Status Pegawai</h2>
                <div class="status-content">
                    <div class="status-info">
                        <p>Nama: {{ $nama ?? 'Nama si Pegawai nya' }}</p>
                        <p>NIDN: {{ $nidn ?? 'NIDN si Pegawai nya' }}</p>

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
            <div class="button-grid">
                <button class="btn-green" onclick="window.location.href='{{ route('dekan.approvejadwal') }}'">
                    Jadwal Perkuliahan
                </button>
                <button class="btn-green" onclick="window.location.href='{{ route('dekan.approveruang') }}'">
                    Ruang Perkuliahan
                </button>
            </div>

        </div>
    </div>

    <footer class="footer">
        <h3>SATE</h3>
        <p>Sistem Terpadu Akademik.Contact for more Questions below</p>
        <div class="footer-icons">
            <a href="#"><i class="bi bi-facebook"></i></a>
            <a href="#"><i class="bi bi-twitter"></i></a>
            <a href="#"><i class="bi bi-google"></i></a>
            <a href="#"><i class="bi bi-youtube"></i></a>
            <a href="#"><i class="bi bi-linkedin"></i></a>
        </div>
    </footer>

</body>

</html>
