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

    <title>Dashboard Dosen Pengampu</title>

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
            width: 270px;
            background-color: #fff;
            height: 100vh;
            position: fixed;
            top: 10;
            left: 0;
            color: black;
            padding: 20px;
            border-right: 2px solid green;
            height: 1;
            position: absolute;
            right: 10%;

        }

        .sidebar h2,
        .sidebar a {
            font-size: 18px;
            /* Ukuran font yang sama */
            font-weight: bold;
            /* Ketebalan font yang sama */
            margin-bottom: 20px;
            /* Jarak yang sama antar elemen */
            color: black;
            text-decoration: none;
        }

        .sidebar a {
            display: block;
        }

        .main-content {
            margin-left: 270px;
            padding: 30px;
        }

        .status-section {
            background-color: #658345;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .status-section h3 {
            margin: 0 0 15px 0;
        }

        .status-details {
            display: flex;
            flex-direction: column;
        }

        .status-details p {
            margin: 5px 0;
        }

        .status-section .status-button {
            background-color: #0014CB;
            color: black;
            padding: 10px;
            border-radius: 5px;
            text-decoration: none;
        }

        .profile {
            position: fixed;
            bottom: 20px;
            left: 30px;
            text-align: left;
        }

        .profile img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
        }

        .profile-name {
            margin-top: 10px;
            font-size: 14px;
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
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M9 3v18"/><path d="M3 9h18"/></svg>
            Dashboard
        </a>
        <a href="#" class="menu-item">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
            Profile
        </a>
        <a href="#" class="menu-item">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
            Notifikasi
        </a>
    </div>

    <div class="main-content">
        <div class="status-section">
            <div class="status-details">
                <h3> <strong>Status Jabatan</strong></h3>
                <h4>Ketua Program Studi</h4>
                <p><strong>Nama Pegawai: </strong>{{ $nama ?? 'User tidak ditemukan' }}</p>
                <p><strong>NIDN: </strong>{{ $nidn ?? 'NIDN tidak ditemukan' }}</p>
                <p><strong>Masa Jabatan: </strong> 2020 - 2025</p>
                <p><strong>Fakultas: </strong>Fakultas Sains dan Matematika</p>
                <p><strong>Status Akademik </strong><button type="button" class="btn btn-info btn-sm">AKTIF</button>
                </p>
            </div>
        </div>

        <div class="d-grid gap-4">
            <button type="button" class="btn btn-outline-success btn-lg">Lihat Jadwal</button>
            <button type="button" class="btn btn-outline-success btn-lg">Entry Nilai</button>
            <button type="button" class="btn btn-outline-success btn-lg">Daftar Peserta</button>
        </div>
    </div>

    <div class="profile">
        <img src="{{ asset('backend/img/profile img.jpg') }}" alt="Profile Photo">
        <div class="profile-name">
            <p>{{ $nama ?? 'User tidak ditemukan' }}</p>
            <p>{{ $nidn ?? 'NIDN tidak ditemukan' }}</p>
            <p>Informatika</p>
        </div>
        <div class="btn-container">
            <button type="button" class="btn btn-outline-secondary"
                onclick="window.location.href='{{ route('logout') }}'">Logout</button>
        </div>
    </div>

</body>

</html>
