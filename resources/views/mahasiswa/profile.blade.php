<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <title>Profile Mahasiswa</title>
    
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
            margin-left: 120px; 
        }
        .header img {
            height: 60px;
            margin-right: 20px;
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
        .sidebar h2, .sidebar a {
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

<div class="header">
    <div>
        <img src="sate_logo.png" alt="SATE Logo">
        <h1>SATE <br><small>Sistem Akademik Terpadu Efisien</small></h1>
    </div>
</div>

<div class="content-wrapper">
    <div class="sidebar">
        <h2>Dashboard</h2>
        <a href="#">Profile</a> 
        <a href="#">Notifikasi</a>
        <div class="student-performance">
            <h3>Prestasi Mahasiswa</h3>
            <p>IPK: 4.00</p>
            <p>SKS: 79</p>
        </div>

        <div class="profile">
            <img src="profile.png" alt="Profile Image">
            <div class="profile-name">
                <p>Nama: {{ $nama ?? 'User tidak ditemukan' }}</p>
                <p>NIM: {{ $nim ?? 'NIM tidak ditemukan' }}</p>
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
                    <h5 class="card-title">Informasi Mahasiswa</h5>
                    <p><strong>NIM</strong> : 24060122140108</p>
                    <p><strong>Nama</strong> : Yohanes Pannjaitan</p>
                    <p><strong>Fakultas</strong> : Fakultas Sains dan Matematika</p>
                    <p><strong>Prodi</strong> : Informatika</p>
                    <p><strong>Angkatan</strong> : 2022</p>
                    <hr>
                    <p><strong>Tempat lahir</strong>: Liverpool, Merseyside, United Kingdom</p>
                    <p><strong>Tanggal lahir</strong>: 01 Januari 2001</p>
                    <p><strong>Kode Kewarganegaraan</strong>: 666666</p>
                    <p><strong>Nomor HP</strong>: 081206060606</p>
                    <p><strong>Email SSO</strong>: cmonreds@students.ac.id</p>
                    <p><strong>Email pribadi</strong>: nunezisthegoat@gmail.com</p>
                    <p><strong>Alamat</strong>: Liverpool, Merseyside, United Kingdom</p>
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
