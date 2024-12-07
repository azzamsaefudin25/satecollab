<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Monitoring IRS Kaprodi</title>
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
            height: 100%;
            transition: background-color .5s;
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

        .container {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
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



        .content {
            flex-grow: 1;
            padding: 20px;
            overflow-y: auto;
            /* Allow content scrolling */
            background-color: white;
        }

        h4 {
            text-align: center;
            font-size: 23px;
            font-weight: 600;
        }

        h5 {
            margin-top: 30px;
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
            <a href="#dashboard" class="menu-item active" data-menu="dashboard">
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
            <a href="#Penyusunan Ruang Perkuliahan" class="menu-item" data-menu="Penyusunan Ruang Perkuliahan">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-journal-check" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M10.854 6.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 8.793l2.646-2.647a.5.5 0 0 1 .708 0" />
                    <path
                        d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2" />
                    <path
                        d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1z" />
                </svg>
                Verifikasi IRS
            </a>
        </div>



        <div class="container">
            <div class="content">
                <h2>VERIFIKASI IRS</h2>

                <div class="statistik">
                    <section>
                        <span>
                            <h5><b>Statistik Mahasiswa</b><br></h5>Informasi selengkapnya mengenai statistik mahasiswa
                            seperti mahasiswa aktif, mahasiswa yang telah mengisi IRS, dan mahasiswa yang menunggu
                            verifikasi.
                        </span>
                    </section>
                    <div>Mahasiswa Aktif<br><b>4</b></div>
                    <div>Mahasiswa Yang Sudah Diverifikasi<br><b>2</b></div>
                    <div>Mahasiswa Yang Sudah Mengisi IRS<br><b>3</b></div>
                </div>

                <form action="{{ route('pembimbingakademik.verifikasiirs') }}" method="GET">
                    <div class="search-container">
                        <input type="text" name="search" placeholder="CARI MAHASISWA"
                            value="{{ request('search') }}">
                        <button type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path
                                    d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0016 9.5 6.5 6.5 0 109.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C8.01 14 6 11.99 6 9.5S8.01 5 10.5 5 15 7.01 15 9.5 12.99 14 10.5 14z" />
                            </svg>
                        </button>
                    </div>
                </form>

                <table id="mahasiswaTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Semester</th>
                            <th>Status IRS</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($mahasiswaCollection as $index => $data)
                            <?php $i = $data['mahasiswa']->firstItem(); ?>
                            @foreach ($data['mahasiswa'] as $mhs)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $mhs->nim }}</td>
                                    <td>{{ $mhs->nama_mahasiswa }}</td>
                                    <td>{{ $mhs->semester }}</td>
                                    <td>
                                        @if ($mhs->irs && $mhs->irs->status_approve === 'disetujui')
                                            <span class="approved">Disetujui</span>
                                        @elseif($mhs->irs)
                                            <span class="waiting-approved">Menunggu</span>
                                        @else
                                            <span class="not-approved">Belum Ada IRS</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('pembimbingakademik.lihatverifikasi', ['nim' => $mhs->nim]) }}"
                                            class="btn btn-outline-info">Lihat</a>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            @endforeach
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Data Mahasiwa Tidak Ditemukan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $data['mahasiswa']->withQueryString()->links() }}

                <!-- Back Button -->
                <a onclick="window.location.href='{{ route('pembimbingakademik') }}'" class="btn btn-dark back-button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-arrow-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M15 8a.5.5 0 0 1-.5.5H3.707l3.147 3.146a.5.5 0 0 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 0 1 .708.708L3.707 7.5H14.5A.5.5 0 0 1 15 8z" />
                    </svg>
                    Back
                </a>
            </div>
            <div class="footer">
                <h3>SATE</h3>
                <p>Sistem Terpadu Akademik. Contact for more Questions below</p>
                <div class="footer-icons">
                    <a href="#"><i class="bi bi-facebook"></i></a>
                    <a href="#"><i class="bi bi-twitter"></i></a>
                    <a href="#"><i class="bi bi-google"></i></a>
                    <a href="#"><i class="bi bi-youtube"></i></a>
                    <a href="#"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>
            <!-- Bootstrap JS & Icons -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
            <script src="https://stackport.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Persistent menu item selection
    $(document).ready(function() {
        // Retrieve the last selected menu from localStorage
        const lastSelectedMenu = localStorage.getItem('selectedMenu') || 'dashboard';
        
        // Remove active class from all menu items
        $('.menu-item').removeClass('active');
        
        // Add active class to the last selected menu item
        $(`.menu-item[data-menu="${lastSelectedMenu}"]`).addClass('active');
        
        // Handle menu item click
        $('.menu-item').on('click', function() {
            // Remove active class from all menu items
            $('.menu-item').removeClass('active');
            
            // Add active class to clicked menu item
            $(this).addClass('active');
            
            // Store the selected menu in localStorage
            const selectedMenu = $(this).data('menu');
            localStorage.setItem('selectedMenu', selectedMenu);
        });
    });
</script>
</body>

</html>
