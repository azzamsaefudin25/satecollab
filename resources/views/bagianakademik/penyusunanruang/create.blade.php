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
            display: flex;
            flex-direction: column;
            min-height: 100vh;
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

        .main-wrapper {
            display: flex;
            flex-grow: 1;
        }

        .sidebar {
            width: 200px;
            background-color: #fff;
            padding: 20px;
            border-right: 1px solid #ddd;
        }

        .content {
            flex-grow: 1;
            padding: 20px;
        }

        .container {
            margin-top: 30px;
            margin-bottom: 30px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 10px;
            min-height: calc(100vh - 30vh);
            overflow: auto;
            position: relative;
        }

        .footer {
            background-color: #658345;
            color: white;
            text-align: center;
            padding: 20px 0;
            width: 100%;
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

        /* Rest of the existing styles remain the same */
        .btn-container {
            display: flex;
            justify-content: space-between;
            margin-top: 50px;
        }

        .btn-right {
            display: flex;
        }

        .btn-custom {
            background-color: #007bff;
            color: white;
            border-radius: 8px; 
            margin-right: 10px; 
        }

        .btn-custom:hover {
            background-color: #0056b3;
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
    <div class="header">
        <div class="logo-container">
            <img src="{{ asset('backend/img/logoSate-removebg-preview.png') }}" alt="SATE Logo">
            <div class="logo-text">
                <h1>SATE</h1>
                <p>SISTEM AKADEMIK TERPADU EFISIEN</p>
            </div>
        </div>
    </div>

    <div class="main-wrapper">
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

        <div class="content">
            <div class="container">
                <br>
                <h4>Penyusunan Ruang Perkuliahan</h4>

                <h5>Pengisian Data Ruangan: </h5>
                <br>

                <div class="form">
                    <form action="{{ route('penyusunanruang.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="kode_ruang">Kode Ruang</label>
                            <input type="text" class="form-control" value="{{ old('kode_ruang', Session::get('kode_ruang')) }}"
                                id="kode_ruang" name="kode_ruang" placeholder="Masukkan Kode Ruang">
                        </div>
                        <div class="form-group">
                            <label for="gedung">Gedung</label>
                            <input type="text" class="form-control" value="{{ old('gedung', Session::get('gedung')) }}"
                                id="gedung" name="gedung" placeholder="Masukkan Nama Gedung">
                        </div>
                        <div class="form-group">
                            <label for="kapasitas">Kapasitas</label>
                            <input type="number" class="form-control" value="{{ old('kapasitas', Session::get('kapasitas')) }}"
                                id="kapasitas" name="kapasitas" placeholder="Masukkan Kapasitas">
                        </div>

                        <div class="btn-container">
                            <button type="button" class="btn btn-dark back-button"
                                onclick="window.location.href='{{ route('penyusunanruang.index') }}'"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-arrow-left" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M15 8a.5.5 0 0 1-.5.5H3.707l3.147 3.146a.5.5 0 0 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 0 1 .708.708L3.707 7.5H14.5A.5.5 0 0 1 15 8z" />
                                </svg>
                                BACK
                            </button>
                            <div class="btn-right">
                                <button type="submit" class="btn btn-custom">SIMPAN</button>
                            </div>
                        </div>
                    </form>
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

    <!-- Bootstrap JS & Icons -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>