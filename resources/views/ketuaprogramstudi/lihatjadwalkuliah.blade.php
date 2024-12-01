<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SATE - Sistem Akademik Terpadu dan Efisien</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .header {
            background-color: #7A9447;
            padding: 20px;
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .header h1 {
            margin: 0;
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
    </style>
</head>
<body>

    
    <!-- Header -->
    <div class="header">
        <div class="d-flex align-items-center">
            <img src="logo.png" alt="SATE Logo" style="height: 50px; margin-right: 15px;">
            <h1>SATE</h1>
        </div>
        <h4>Sistem Akademik Terpadu dan Efisien</h4>
    </div>

    <div class="table-container mt-4">
        <!-- Center "Daftar Jadwal Kuliah" -->
        <h4 class="text-center">Daftar Jadwal Kuliah</h4>

    <div class="container mt-4">
        <!-- Search Box -->
        <div class="search-box d-flex justify-content-between align-items-center">
            <input type="text" id="searchInput" class="form-control me-2" placeholder="CARI JADWAL KULIAH" aria-label="Search">
            <button class="btn">
                <i class="bi bi-search"></i>
            </button>
        </div>

        
        <!-- Table Container -->
            <div class="pb-3">
                <a href="{{ route('jadwalkuliah.create') }}" class="btn btn-primary"> + Tambah
                        Jadwal</a>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
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
                            <th>Dosen</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jadwal as $index => $item)
                            <tr>
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
    <!-- Bootstrap & jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>

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

        // Simple search functionality
        $(document).ready(function() {
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