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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.css"
        rel="stylesheet">
    <title>Profile Dekan</title>

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
            padding: 30px;
            text-align: left;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .header h1 {
            margin: 0;
            font-size: 30px;
            color: black;
        }

        .header img {
            height: 60px;
            margin-right: 20px;
        }

        .header-content {
            display: flex;
            align-items: center;
            padding: 0 40px;
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
            border-right: 2px solid green;
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

        .student-performance {
            background-color: #d1d7b4;
            padding: 15px;
            border-radius: 5px;
            text-align: center;
            margin-bottom: 20px;
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
            font-size: 10px;
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
                    <p>{{ $nidn ?? 'NIP tidak ditemukan' }}</p>
                    <p>Informatika</p>
                </div>
                <div class="btn-container">
                    <button type="button" class="btn btn-outline-secondary"
                        onclick="window.location.href='{{ route('logout') }}'">Logout</button>
                </div>
            </div>
        </div>


        <div class="main-content">
            <div class="card mx-auto shadow">
                <div class="row">
                    <div class="col-md-4 d-flex justify-content-center align-items-center">
                        <div class="profile-picture rounded"></div>
                    </div>
                    <div class="col-md-8">
                        <h5 class="card-title">Informasi Dekan</h5>
                        <p><strong>NIP</strong> {{ $nidn ?? 'NIP tidak ditemukan' }}</p>
                        <p><strong>Nama</strong> {{ $nama ?? 'User tidak ditemukan' }}</p>
                        <p><strong>Fakultas</strong> : Fakultas Sains dan Matematika</p>
                        <hr>
                        <p><strong>Tempat lahir</strong>: Manchester</p>
                        <p><strong>Tanggal lahir</strong>: 01 Januari 1970</p>
                        <p><strong>Kode Kewarganegaraan</strong>: 666666</p>
                        <p><strong>Nomor HP</strong>: 081206060606</p>
                        <p><strong>Email SSO</strong>:budi@students.ac.id</p>
                        <p><strong>Email pribadi</strong>:budi@gmail.com</p>
                        <p><strong>Alamat</strong>: Manchester</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
        <h3>SATE</h3>
        <p>Sistem Terpadu Akademik. Contact for more Questions below</p>
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
