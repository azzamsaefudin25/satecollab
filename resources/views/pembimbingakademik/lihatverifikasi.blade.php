<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.css"
        rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.css" rel="stylesheet">
   <title>Monitoring IRS Kaprodi</title>
    <style>
       html, body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fff;
            height: 100%;
            transition: background-color .5s;
        }

        .content {
            flex-grow: 1;
            padding: 20px;
            overflow-y: auto; /* Allow content scrolling */
            background-color: white;
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

         .header {
            background-color: #658345;
            padding: 15px 30px;
            display: flex;
            align-items: center;
            height: 80px;
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
            height: calc(100vh - 140px);
        }

        .sidebar {
            width: 250px; 
            background-color: #fff;
            padding: 20px;
            border-right: 1px solid #ddd;
            overflow-y: auto; 
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
            flex-shrink: 0; /* Prevent icon from shrinking */
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
            <a href="#dashboard" class="menu-item " data-menu="dashboard">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="18" height="18" rx="2" />
                    <path d="M9 3v18" />
                    <path d="M3 9h18" />
                </svg>
                Dashboard
            </a>
            <a href="#profile" class="menu-item" data-menu="profile">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                    <circle cx="12" cy="7" r="4" />
                </svg>
                Profile
            </a>
            <a href="#notification" class="menu-item" data-menu="notification">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9" />
                    <path d="M13.73 21a2 2 0 0 1-3.46 0" />
                </svg>
                Notifikasi
            </a>
            <a href="#Verifikasi-irs" class="menu-item" data-menu="Verifikasi IRS">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pc-display-horizontal" viewBox="0 0 16 16">
                    <path d="M1.5 0A1.5 1.5 0 0 0 0 1.5v7A1.5 1.5 0 0 0 1.5 10H6v1H1a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1h-5v-1h4.5A1.5 1.5 0 0 0 16 8.5v-7A1.5 1.5 0 0 0 14.5 0zm0 1h13a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-7a.5.5 0 0 1 .5-.5M12 12.5a.5.5 0 1 1 1 0 .5.5 0 0 1-1 0m2 0a.5.5 0 1 1 1 0 .5.5 0 0 1-1 0M1.5 12h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1M1 14.25a.25.25 0 0 1 .25-.25h5.5a.25.25 0 1 1 0 .5h-5.5a.25.25 0 0 1-.25-.25"/>
                </svg>
                Verifikasi IRS
            </a>
        </div>

    <div class="content">
        {{-- Tampilkan pesan status --}}
        @if ($errors->any())
            <div class="pt-3">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif


        <h2>Detail IRS Mahasiswa: {{ $mahasiswa->nama_mahasiswa ?? 'N/A' }}</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Kode Mata Kuliah</th>
                    <th>Nama Mata Kuliah</th>
                    <th>Kode Ruang</th>
                    <th>Nama Kelas</th>
                    <th>Semester</th>
                    <th>Sks</th>
                    <th>Jenis</th>
                    <th>Semester Aktif</th>
                    <th>Tahun Ajaran</th>
                    <th>Hari</th>
                    <th>Jam Mulai</th>
                    <th>Jam Selesai</th>
                    <th>Status</th>
                    <th>Status Approve</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($irs as $item)
                    <tr>
                        <td>{{ $item->kode_mk ?? '-' }}</td>
                        <td>{{ $item->jadwalkuliah->mataKuliah->nama_mk ?? '-' }}</td>
                        <td>{{ $item->kode_ruang ?? '-' }}</td>
                        <td>{{ $item->nama_kelas ?? '-' }}</td>
                        <td>{{ $item->jadwalKuliah->semester ?? '-' }}</td>
                        <td>{{ $item->sks ?? '-' }}</td>
                        <td>{{ $item->jadwalKuliah->jenis ?? '-' }}</td>
                        <td>{{ $item->jadwalKuliah->semester_aktif ?? '-' }}</td>
                        <td>{{ $item->jadwalKuliah->tahun_ajaran ?? '-' }}</td>
                        <td>{{ $item->hari ?? '-' }}</td>
                        <td>{{ $item->jam_mulai ?? '-' }}</td>
                        <td>{{ $item->jam_selesai ?? '-' }}</td>
                        <td>{{ $item->status ?? '-' }}</td>
                        <td>
                            @if ($item->status_approve == 'disetujui')
                                <span class="approved">{{ $item->status_approve }}</span>
                            @elseif ($item->status_approve == 'menunggu konfirmasi')
                                <span class="not-approved">{{ $item->status_approve }}</span>
                            @else
                                {{ $item->status_approve ?? '-' }}
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Data IRS tidak tersedia</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <footer>
            <div class="d-flex justify-content-between align-items-center">
                <!-- Back Button -->
                <a onclick="window.location.href='{{ route('pembimbingakademik.verifikasiirs') }}'"
                    class="btn btn-dark back-button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-arrow-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M15 8a.5.5 0 0 1-.5.5H3.707l3.147 3.146a.5.5 0 0 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 0 1 .708.708L3.707 7.5H14.5A.5.5 0 0 1 15 8z" />
                    </svg>
                    Back
                </a>
        
                <!-- Approval Buttons -->
                <div>
                    {{-- Tombol "Setuju" jika ada IRS yang menunggu konfirmasi --}}
                    @if ($irs->contains('status_approve', 'menunggu konfirmasi'))
                        <form method="POST" action="{{ route('pembimbingakademik.persetujuanirs') }}" class="d-inline mr-2">
                            @csrf
                            <input type="hidden" name="nim" value="{{ $mahasiswa->nim }}">
                            <button type="submit" name="action" value="setuju"
                                class="btn btn-outline-success btn-lg">Setuju</button>
                        </form>
                    @endif
        
                    {{-- Tombol "Ubah Persetujuan IRS" jika sudah disetujui --}}
                    @if ($irs->contains('status_approve', 'disetujui'))
                        <form method="POST" action="{{ route('pembimbingakademik.persetujuanirs') }}" class="d-inline">
                            @csrf
                            <input type="hidden" name="nim" value="{{ $mahasiswa->nim }}">
                            <button type="submit" name="action" value="ubah" class="btn btn-outline-warning btn-lg">Ubah
                                Persetujuan IRS</button>
                        </form>
                    @endif
                </div>
            </div>
        </footer>
        
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>


</html>
