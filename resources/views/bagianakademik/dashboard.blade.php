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
    <title>Dashboard Bagian Akademik</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fff;

        }

        .header {
            background-color: #658345;
            color: black;
            padding: 30px;
            text-align: left;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .header h1 {
            margin: 0;
            font-size: 30px;
            margin-left: 120px;
        }

        .header img {
            height: 60px;
            margin-right: 20px;
        }

        .sidebar {
            width: 230px;
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
            left: 70px;
            text-align: center;
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
        <div>
            <img src="sate_logo.png" alt="SATE Logo">
            <h1>SATE <br><small>Sistem Akademik Terpadu Efisien</small></h1>
        </div>
    </div>

    <div class="sidebar">
        <h2>Dashboard</h2>
        <a href="#">Profile</a>
        <a href="#">Notifikasi</a>
    </div>

    <div class="main-content">
        <div class="status-section">
            <div class="status-details">
                <h3>Status Pegawai</h3>
                <p><strong>Nama Pegawai: </strong>{{ $user->name ?? 'User tidak ditemukan' }}</p>
                <p><strong>NIP: </strong>{{ $nip ?? 'NIP tidak ditemukan' }}</p>


                <p><strong>Masa Jabatan:</strong> 2018 - 2038</p>
                <p><strong>Fakultas:</strong> Fakultas Sains Matematika</p>
            </div>
            <a href="#" class="status-button">AKTIF</a>
        </div>

        <div class="d-grid gap-4">
            <button type="button" class="btn btn-outline-success btn-lg"
                onclick="window.location.href='{{ route('penyusunanruang.create') }}'">Penyusunan Ruang
                Perkuliahan</button>
            <button type="button" class="btn btn-outline-success btn-lg"
                onclick="window.location.href='{{ route('pengalokasianruang.create') }}'">Pengalokasian Ruang
                Perkuliahan</button>
        </div>
    </div>


    <div class="profile">
        <img src="profile.png" alt="Profile Image">
        <div class="profile-name">
            <p>Nama: {{ $user->name ?? 'User tidak ditemukan' }}</p>
            <p>NIP: {{ $nip ?? 'NIP tidak ditemukan' }}</p>
            <p>Informatika</p>
        </div>
        <div class="btn-container">
            <button type="button" class="btn btn-outline-secondary"
                onclick="window.location.href='{{ route('logout') }}'">Logout</button>
        </div>
    </div>

</body>

</html>
