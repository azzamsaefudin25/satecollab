<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Akademik Terpadu Efisien</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.css"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

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

        .main-container {
            flex: 1;
            width: 100%;
            padding: 20px;
            max-width: 1400px;
            margin: 0 auto;
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

        .student-performance {
            background-color: #d1d7b4;
            padding: 15px;
            border-radius: 5px;
            text-align: center;
            margin-bottom: 20px;
        }

        main h2 {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .table-secondary {
            background-color: #D3D3D3 !important;
        }

        .footer {
            background-color: #658345;
            color: white;
            text-align: center;
            padding: 20px 0;
            width: 100%;
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
            margin-bottom: 10px;
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

        .table-responsive {
            overflow-x: auto;
        }

        #main {
            transition: margin-left .5s;
            padding: 16px;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header class="header">
        <div class="header-content">
            <a href="{{ route('mahasiswa') }}" style="text-decoration: none;">
                <img src="{{ asset('backend\img\logoSate-removebg-preview.png') }}" alt="SATE Logo">
            </a>
            <a href="{{ route('mahasiswa') }}" style="text-decoration: none;">
                <h1>SATE <br><small>Sistem Akademik Terpadu Efisien</small></h1>
            </a>
        </div>
    </header>

    <div class="content-wrapper">
        <div class="sidebar">
            <a href="{{ route('mahasiswa') }}" class="menu-item active">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="18" height="18" rx="2" />
                    <path d="M9 3v18" />
                    <path d="M3 9h18" />
                </svg>
                Dashboard
            </a>
            <a href="{{ route('mahasiswa.profile') }}">
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
            <a href="{{ route('mahasiswa.registrasi') }}" class="menu-item" data-menu="Registrasi">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-door-closed" viewBox="0 0 16 16">
                    <path
                        d="M3 2a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v13h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3zm1 13h8V2H4z" />
                    <path d="M9 9a1 1 0 1 0 2 0 1 1 0 0 0-2 0" />
                </svg>
                Registrasi
            </a>
            <a href="{{ route('jadwal.index') }}" class="menu-item" data-menu="Jadwal Perkuliahan">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-door-closed" viewBox="0 0 16 16">
                    <path
                        d="M3 2a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v13h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3zm1 13h8V2H4z" />
                    <path d="M9 9a1 1 0 1 0 2 0 1 1 0 0 0-2 0" />
                </svg>
                Jadwal Perkuliahan
            </a>
            <a href="{{ route('mahasiswa.khs') }}" class="menu-item" data-menu="KHS">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-door-closed" viewBox="0 0 16 16">
                    <path
                        d="M3 2a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v13h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3zm1 13h8V2H4z" />
                    <path d="M9 9a1 1 0 1 0 2 0 1 1 0 0 0-2 0" />
                </svg>
                KHS
            </a>
            <a href="{{ route('irs.create') }}" class="menu-item" data-menu="Pengisian IRS">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-door-closed" viewBox="0 0 16 16">
                    <path
                        d="M3 2a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v13h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3zm1 13h8V2H4z" />
                    <path d="M9 9a1 1 0 1 0 2 0 1 1 0 0 0-2 0" />
                </svg>
                Pengisian IRS
            </a>

            <div class="student-performance">
                <h3>Prestasi Mahasiswa</h3>
                <p>IPK:{{ $ipk ?? 'N/A' }}</p>
                <p>SKS: 79</p>
            </div>

            <div class="profile">
                <img src="{{ asset('backend/img/profile img.jpg') }}" alt="Profile Image">
                <div class="profile-name">
                    <p>{{ $nama ?? 'User tidak ditemukan' }}</p>
                    <p>{{ $nim ?? 'NIM tidak ditemukan' }}</p>
                    <p>Informatika</p>
                </div>
                <div class="btn-container">
                    <button type="button" class="btn btn-outline-secondary w-75"
                        onclick="window.location.href='{{ route('logout') }}'">Logout</button>
                </div>
            </div>
        </div>
        <!-- Main Content -->
        <div class="main-container">
            <main>
                <h2 class="text-center">Jadwal Kuliah</h2>
                <h3 class="text-center mt-5">Daftar Mata Kuliah</h3>
                <div class="table-responsive">
                    <table class="table table-bordered mt-3 text-center" id="jadwalTable" border="1">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Kode MK</th>
                                <th>Nama Mata Kuliah</th>
                                <th>Jenis</th>
                                <th>Semester</th>
                                <th>Sks</th>
                                <th>Tahun Ajaran</th>
                                <th>Nama Kelas</th>
                                <th>Hari</th>
                                <th>Jam Mulai</th>
                                <th>Jam Selesai</th>
                                <th>Kode Ruang</th>
                                <th>Nama Dosen Pengampu</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($irsIndex as $index => $irs)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $irs->kode_mk }}</td>
                                    <td>{{ $irs->jadwalKuliah->mataKuliah->nama_mk ?? 'N/A' }}</td>
                                    <td>{{ $irs->jadwalKuliah->jenis ?? 'N/A' }}</td>
                                    <td>{{ $irs->jadwalKuliah->semester ?? 'N/A' }}</td>
                                    <td>{{ $irs->sks ?? 'N/A' }}</td>
                                    <td>{{ $irs->tahun_ajaran ?? 'N/A' }}</td>
                                    <td>{{ $irs->nama_kelas }}</td>
                                    <td>{{ $irs->hari ?? 'N/A' }}</td>
                                    <td>{{ $irs->jam_mulai ?? 'N/A' }}</td>
                                    <td>{{ $irs->jam_selesai ?? 'N/A' }}</td>
                                    <td>{{ $irs->kode_ruang ?? 'N/A' }} </td>
                                    <td>
                                        @if ($irs->jadwalKuliah->dosen1)
                                            {{ $irs->jadwalKuliah->dosen1->dosen->nama_dosen }}<br>
                                        @endif
                                        @if ($irs->jadwalKuliah->dosen2)
                                            {{ $irs->jadwalKuliah->dosen2->dosen->nama_dosen }}<br>
                                        @endif
                                        @if ($irs->jadwalKuliah->dosen3)
                                            {{ $irs->jadwalKuliah->dosen3->dosen->nama_dosen }}<br>
                                        @endif
                                        @if ($irs->jadwalKuliah->dosen4)
                                            {{ $irs->jadwalKuliah->dosen4->dosen->nama_dosen }}<br>
                                        @endif
                                        @if ($irs->jadwalKuliah->dosen5)
                                            {{ $irs->jadwalKuliah->dosen5->dosen->nama_dosen }}
                                        @endif
                                    </td>
                                    <td>{{ $irs->status ?? 'N/A' }}</td>
                                </tr>
                            @endforeach
                            @if ($irsIndex->isEmpty())
                                <tr>
                                    <td colspan="20" class="text-center">IRS belum disetujui</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <div class="text-center mt-4">
                    <button type="button" class="btn btn-dark back-button"
                        onclick="window.location.href='{{ route('mahasiswa') }}'"><svg
                            xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-arrow-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M15 8a.5.5 0 0 1-.5.5H3.707l3.147 3.146a.5.5 0 0 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 0 1 .708.708L3.707 7.5H14.5A.5.5 0 0 1 15 8z" />
                        </svg>
                        BACK
                    </button>
                </div>
            </main>
        </div>
    </div>
    <!-- Footer -->
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
