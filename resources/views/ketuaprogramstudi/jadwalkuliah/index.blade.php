<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SATE - Sistem Akademik Terpadu dan Efisien</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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

        .content {
            flex-grow: 1;
            padding: 20px;
            overflow-y: auto;
            /* Allow content scrolling */
            background-color: white;
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

        .search-box {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
        }

        .table-responsive {
            max-height: 600px;
            overflow-y: auto;
        }

        .sticky-header th {
            position: sticky;
            top: 0;
            background-color: #343a40;
            color: white;
            z-index: 10;
        }

        .btn-toggle-dosen {
            cursor: pointer;
            color: #007bff;
        }

        .dosen-dropdown {
            display: none;
            background-color: #f8f9fa;
            padding: 5px;
            border-radius: 5px;
        }

        .btn-custom-secondary {
            background: linear-gradient(135deg, #6c757d, #495057);
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            font-size: 1rem;
            font-weight: bold;
            border-radius: 25px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease-in-out;
        }

        .btn-custom-secondary:hover {
            background: linear-gradient(135deg, #495057, #343a40);
            color: #f8f9fa;
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
            cursor: pointer;
        }

        .btn-custom-secondary:focus {
            outline: none;
            box-shadow: 0 0 0 4px rgba(108, 117, 125, 0.5);
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

        .back-btn {
            position: absolute;
            bottom: 20px;
            left: 20px;
            font-size: 24px;
            color: #5e2d91;
        }



        tr[data-status="disetujui"] td:nth-child(16):empty {
            display: none;
        }
    </style>
</head>

<body>


    <!-- Header -->
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
            <a href="{{ route('ketuaprogramstudi') }}" class="menu-item " data-menu="dashboard">
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
            <a href="#monitoring-irs" class="menu-item" data-menu="Monitoring IRS">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-pc-display-horizontal" viewBox="0 0 16 16">
                    <path
                        d="M1.5 0A1.5 1.5 0 0 0 0 1.5v7A1.5 1.5 0 0 0 1.5 10H6v1H1a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1h-5v-1h4.5A1.5 1.5 0 0 0 16 8.5v-7A1.5 1.5 0 0 0 14.5 0zm0 1h13a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-7a.5.5 0 0 1 .5-.5M12 12.5a.5.5 0 1 1 1 0 .5.5 0 0 1-1 0m2 0a.5.5 0 1 1 1 0 .5.5 0 0 1-1 0M1.5 12h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1M1 14.25a.25.25 0 0 1 .25-.25h5.5a.25.25 0 1 1 0 .5h-5.5a.25.25 0 0 1-.25-.25" />
                </svg>
                Monitoring IRS
            </a>
            <a href="{{ route('jadwalkuliah.index') }}" class="menu-item" data-menu="Penyusunan jadwal">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-calendar3" viewBox="0 0 16 16">
                    <path
                        d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2M1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857z" />
                    <path
                        d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2" />
                </svg>
                Penyusunan Jadwal
            </a>

            <a href="{{ route('memilihmatakuliah.index') }}" class="menu-item" data-menu="Penyusunan Mata Kuliah">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-journal-bookmark" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M6 8V1h1v6.117L8.743 6.07a.5.5 0 0 1 .514 0L11 7.117V1h1v7a.5.5 0 0 1-.757.429L9 7.083 6.757 8.43A.5.5 0 0 1 6 8" />
                    <path
                        d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2" />
                    <path
                        d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1z" />
                </svg>
                Penyusunan Mata Kuliah
            </a>

            <a href="#Daftar Alokasi Ruang Perkuliahan" class="menu-item"
                data-menu="Daftar Alokasi Ruang Perkuliahan  ">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-door-closed" viewBox="0 0 16 16">
                    <path
                        d="M3 2a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v13h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3zm1 13h8V2H4z" />
                    <path d="M9 9a1 1 0 1 0 2 0 1 1 0 0 0-2 0" />
                </svg>
                Daftar Alokasi Ruang Perkuliahan
            </a>
        </div>

        <div class="content">
            <!-- Center "Daftar Jadwal Kuliah" -->
            <h4 class="text-center">Daftar Jadwal Kuliah</h4>

            <div class="container mt-4">
                <!-- Search Box -->
                <div class="search-box d-flex justify-content-between align-items-center">
                    <input type="text" id="searchInput" class="form-control me-2"
                        placeholder="CARI JADWAL KULIAH" aria-label="Search">
                    <button class="btn">
                        <i class="bi bi-search"></i>
                    </button>
                </div>


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
                <!-- Table Container -->
                <div class="pb-3">
                    <a href="{{ route('jadwalkuliah.create') }}" class="btn btn-primary"> + Tambah
                        Data</a>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="sticky-header">
                            <tr>
                                <th>No</th>
                                <th>Kode MK</th>
                                <th>Nama Mata Kuliah</th>
                                <th>Ruang</th>
                                <th>Kelas</th>
                                <th>Semester</th>
                                <th>SKS</th>
                                <th>Jenis</th>
                                <th>Semester Aktif</th>
                                <th>Tahun Ajaran</th>
                                <th>Hari</th>
                                <th>Jam Mulai</th>
                                <th>Jam Selesai</th>
                                <th>Dosen Pengampu</th>
                                <th>Status</th>
                                <th>Aksi</th> <!-- Selalu tampilkan kolom Aksi -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jadwal as $index => $item)
                                <tr data-status="{{ $item->status }}">
                                    <td>{{ $jadwal->firstItem() + $index }}</td>
                                    <td>{{ $item->kode_mk }}</td>
                                    <td>{{ $item->mataKuliah->nama_mk ?? 'N/A' }}</td>
                                    <td>{{ $item->kode_ruang }}</td>
                                    <td>{{ $item->nama_kelas }}</td>
                                    <td>{{ $item->mataKuliah->semester ?? 'N/A' }}</td>
                                    <td>{{ $item->mataKuliah->sks ?? 'N/A' }}</td>
                                    <td>{{ $item->mataKuliah->jenis ?? 'N/A' }}</td>
                                    <td>{{ $item->mataKuliah->semester_aktif ?? 'N/A' }}</td>
                                    <td>{{ $item->tahun_ajaran }}</td>
                                    <td>{{ $item->hari }}</td>
                                    <td>{{ $item->jam_mulai }}</td>
                                    <td>{{ $item->jam_selesai }}</td>
                                    <td>
                                        <span class="btn-toggle-dosen" onclick="toggleDosen(this)">
                                            Lihat Dosen <i class="bi bi-chevron-down"></i>
                                        </span>
                                        <div class="dosen-dropdown">
                                            <ol class="ps-3">
                                                @if ($item->dosen1)
                                                    <li>{{ $item->dosen1->dosen->nama_dosen }}</li>
                                                @endif
                                                @if ($item->dosen2)
                                                    <li>{{ $item->dosen2->dosen->nama_dosen }}</li>
                                                @endif
                                                @if ($item->dosen3)
                                                    <li>{{ $item->dosen3->dosen->nama_dosen }}</li>
                                                @endif
                                                @if ($item->dosen4)
                                                    <li>{{ $item->dosen4->dosen->nama_dosen }}</li>
                                                @endif
                                                @if ($item->dosen5)
                                                    <li>{{ $item->dosen5->dosen->nama_dosen }}</li>
                                                @endif
                                            </ol>
                                        </div>
                                    </td>
                                    <td>{{ $item->status }}</td>
                                    <td>
                                        @if ($item->status == 'menunggu konfirmasi')
                                            <form action="{{ route('jadwalkuliah.destroy', $item->id_jadwal) }}"
                                                method="POST"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                            </form>
                                        @else
                                            <!-- Tambahkan spasi atau placeholder jika tidak ada aksi -->
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                disabled>Hapus</button>
                                            &nbsp;
                                        @endif
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-3">
                    <!-- Back Button on the Left -->
                    <button type="button" class="btn btn-dark back-button"
                        onclick="window.location.href='{{ route('ketuaprogramstudi') }}'">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-arrow-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M15 8a.5.5 0 0 1-.5.5H3.707l3.147 3.146a.5.5 0 0 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 0 1 .708.708L3.707 7.5H14.5A.5.5 0 0 1 15 8z" />
                        </svg>
                        BACK
                    </button>

                    <!-- Paginator on the Right -->
                    <div>
                        {{ $jadwal->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
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
    <!-- Bootstrap & jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function toggleDosen(element) {
            const dropdown = element.nextElementSibling;
            const icon = element.querySelector('i');

            if (dropdown.style.display === 'block') {
                dropdown.style.display = 'none';
                icon.classList.remove('bi-chevron-up');
                icon.classList.add('bi-chevron-down');
            } else {
                dropdown.style.display = 'block';
                icon.classList.remove('bi-chevron-down');
                icon.classList.add('bi-chevron-up');
            }
        }

        $(document).ready(function() {
            // Simple search functionality
            $("#searchInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("table tbody tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
</body>

</html>
