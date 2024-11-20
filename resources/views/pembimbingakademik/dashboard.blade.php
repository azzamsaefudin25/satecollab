<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pembimbing Akademik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
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
            font-size: 30px;
            margin-left: 120px;
            /* Tambahkan margin-left untuk menggeser teks */
        }

        .logo-text p {
            margin: 0;
            font-size: 14px;
        }

        .sidebar {
            width: 230px;
            background-color: #fff;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 85 px;
            padding: 20px;
            border-right: 2px solid green;
            height: 589px;
            position: absolute;
            right: 10%;
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

        .empty-section {
            background-color: #658345;
            color: black;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
        }

        .profile {
            position: fixed;
            bottom: 20px;
            left: 70px;
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
        <h2>Dashboard</h2>
        <a href="#">Profile</a> <!-- Profile disamakan -->
        <a href="#">Notifikasi</a> <!-- Notifikasi disamakan -->
    </div>

    <div class="main-content">
        <div class="status-section">
            <div class="status-details">
                <h3>Status Pegawai</h3>
                <p><strong>Nama Pegawai: </strong>{{ $nama ?? 'User tidak ditemukan' }}</p>
                <p><strong>NIDN: </strong>{{ $nidn ?? 'NIDN tidak ditemukan' }}</p>
                <p><strong>Masa Jabatan:</strong> 2018 - 2038</p>
                <p><strong>Fakultas:</strong> Fakultas Sains Matematika</p>
            </div>
        </div>

        <div class="empty-section">
            VERIFIKASI IRS
        </div>
    </div>

<div class="profile">
    <img src="{{ asset('backend/img/profile img.jpg') }}" alt="Profile Photo">
    <div class="profile-name">
        <p>{{ $nama ?? 'User tidak ditemukan' }}</p>
        <p>{{ $nip ?? 'NIP tidak ditemukan' }}</p>
        <p>Informatika</p>
    </div>
    <div class="btn-container">
        <button type="button" class="btn btn-outline-secondary"
            onclick="window.location.href='{{ route('logout') }}'">Logout</button>
    </div>
</div>

</body>
</html>