<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SATE - Sistem Akademik Terpadu dan Efisien</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.css"
        rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html,
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fff;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: background-color .5s;
        }

        .header {
            background-color: #658345;
            padding: 15px 30px;
            display: flex;
            align-items: center;
            height: 80px;
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

        .logo-text {
            color: black;
            line-height: 1.2;
        }

        .logo-text p {
            margin: 0;
            font-size: 14px;
        }

        .main-wrapper {
            display: flex;
            height: calc(100vh - 140px);
        }

        .sidebar {
            width: 250px;
            background-color: #fff;
            padding: 20px;
            border-right: 1px solid #ddd;
            overflow-y: auto;
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

        .content {
            flex-grow: 1;
            padding: 20px;
            overflow-y: auto;
            /* Allow content scrolling */
            background-color: white;
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

        .content-wrapper {
            display: flex;
            flex: 1;
            position: relative;
        }

        .container {
            /* width: 80%; */
            margin: 20px auto;
            background-color: #fff;
            padding: 10px;
            border-radius: 10px;
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
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .menu-item:hover {
            background-color: #e9ecef;
        }

        .menu-item.active {
            background-color: #658345;
            color: white;
        }

        .menu-item svg {
            flex-shrink: 0;
            /* Prevent icon from shrinking */
        }

        .statistik {
            display: flex;
            justify-content: space-between;
            padding: 20px;
            background-color: #658345;
            margin-bottom: 20px;

        }

        .statistik div {
            width: 30%;
            text-align: center;
            padding: 10px;
            background-color: #658345;
            border-radius: 0;
            border-right: 2px solid black;
            height: 1;
        }

        .search-container {
            display: flex;
            justify-content: center;
            margin: 20px 0;
        }

        .search-container input {
            width: 50%;
            padding: 15px;
            border: 2px solid #ccc;
            border-radius: 25px;
            font-size: 16px;
        }

        .search-container button {
            background: none;
            border: none;
            margin-left: -50px;
            cursor: pointer;
        }

        .search-container svg {
            width: 24px;
            height: 24px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #BFCAB7;
        }

        .approved {
            background-color: #14F400;
            color: black;
            padding: 5px 10px;
            border-radius: 25px;
        }

        .not-approved {
            background-color: #F4000F;
            color: black;
            padding: 5px 10px;
            border-radius: 25px;
        }

        .waiting-approved {
            background-color: #BFCAB7;
            color: black;
            padding: 5px 10px;
            border-radius: 25px;
        }

        .back-button {
            padding: 10px 20px;
            background-color: black;
            color: white;
            border: none;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
        }

        select {
            width: 80%;
            padding: 16px 20px;
            border: none;
            border-radius: 4px;
            background-color: #f1f1f1;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .button {
            border: none;
            color: black;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 25px;
        }

        .button1 {
            background-color: #14F400;
        }

        /* Green */
        .button2 {
            background-color: #0014CB;
        }

        /* Blue */
        .button3 {
            background-color: #218838;
        }


        .footer {
            background-color: #658345;
            color: white;
            text-align: center;
            padding: 10px 0;
            margin-top: auto;
            width: 1;
        }

        .footer-icons {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 10px;
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


        .button-grid {
            display: grid;
            grid-template-columns: 1fr;
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

        .search-box {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
        }

        .search-box input {
            border-radius: 5px;
        }

        .search-box button {
            background-color: #ffffff;
            border: 1px solid #ced4da;
            border-radius: 5px;
            padding: 6px 12px;
        }

        .search-box i {
            color: #6c757d;
        }

        h4 {
            text-align: center;
            font-size: 23px;
            font-weight: 600;
        }

        h5 {
            margin-top: 30px;
        }

        .table-container {
            margin-top: 20px;
        }

        .table th {
            white-space: nowrap;
        }

        .table thead {
            background-color: #343a40;
            color: white;
        }

        .btn-container {
            display: flex;
            justify-content: space-between;
            /* Tombol Back di kiri dan simpan di */
            margin-top: 50px;
        }

        .btn-right {
            display: flex;
        }

        .btn-custom {
            background-color: #007bff;
            /* Warna biru */
            color: white;
            border-radius: 8px;
            margin-right: 10px;
        }

        .btn-custom:hover {
            background-color: #0056b3;
        }

        .capacity-btn {
            background-color: white;
            border: 1px solid #ced4da;
            border-radius: 5px;
            padding: 5px;
            color: #6c757d;
            display: inline-block;
            text-align: center;
        }

        .back-button {
            padding: 10px 20px;
            border-radius: 8px;
            background-color: black;
            color: white;
            border: none;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
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

        .logout-button {
            display: block;
            margin-top: 10px;
            width: 45%;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="logo-container">
            <a href="{{ route('ketuaprogramstudi') }}">
                <img src="{{ asset('backend/img/logoSate-removebg-preview.png') }}" alt="SATE Logo">
            </a>
            <a href="{{ route('ketuaprogramstudi') }}" style="text-decoration: none;">
                <div class="logo-text">
                    <h1>SATE</h1>
                    <p>SISTEM AKADEMIK TERPADU EFISIEN</p>
                </div>
            </a>
        </div>
    </div>
    <div class="main-wrapper">
        <div class="sidebar">
            <a href="{{ route('pembimbingakademik') }}" class="menu-item ">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="18" height="18" rx="2" />
                    <path d="M9 3v18" />
                    <path d="M3 9h18" />
                </svg>
                Dashboard
            </a>
            <a href="{{ route('pembimbingakademik.profile') }}" class="menu-item">
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
            <a href="{{ route('pembimbingakademik.verifikasiirs') }}" class="menu-item"
                data-menu="Penyusunan Ruang Perkuliahan">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-door-closed" viewBox="0 0 16 16">
                    <path
                        d="M3 2a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v13h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3zm1 13h8V2H4z" />
                    <path d="M9 9a1 1 0 1 0 2 0 1 1 0 0 0-2 0" />
                </svg>
                Verifikasi IRS
            </a>
            <div class="profile">
                <img src="{{ asset('backend/img/profile img.jpg') }}" alt="Profile Image">
                <div class="profile-name">
                    <p>{{ $nama ?? 'User tidak ditemukan' }}</p>
                    <p>{{ $nidn ?? 'NIP tidak ditemukan' }}</p>
                    <p>Informatika</p>
                </div>
                <div class="logout-button">
                    <button type="button" class="btn btn-outline-secondary"
                        onclick="window.location.href='{{ route('logout') }}'">Logout</button>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container">
                @include('komponen.pesan')
                @yield('content')
            </div>
        </div>
    </div>

    <div>
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
    </div>

    <!-- Bootstrap JS & Icons -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html
