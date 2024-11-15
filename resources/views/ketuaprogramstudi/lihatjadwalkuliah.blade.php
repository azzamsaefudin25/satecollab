<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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

        .table-container {
            margin-top: 20px;
        }

        .table thead {
            background-color: #343a40;
            color: white;
        }

        .back-btn {
            position: absolute;
            bottom: 20px;
            left: 20px;
            font-size: 24px;
            color: #5e2d91;
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

    <!-- Container -->
    <div class="container mt-4">
        <!-- Search Box -->
        <div class="search-box d-flex justify-content-between align-items-center">
            <input type="text" class="form-control me-2" placeholder="CARI JADWAL KULIAH" aria-label="Search">
            <button class="btn">
                <i class="bi bi-search"></i>
            </button>
        </div>

        <!-- Table -->
        <div class="table-container">
            <h4 class="mt-4">Daftar Jadwal Kuliah</h4>

            @if ($errors->any())
                <div class="pt-3">
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $item)
                                <li>{{ $item }}</li>
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
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Mata Kuliah</th>
                        <th>Nama Mata Kuliah</th>
                        <th>Kode Ruang</th>
                        <th>Hari</th>
                        <th>Jam Mulai</th>
                        <th>Jam Selesai</th>
                        <th>Nama Kelas</th>
                        <th>Nama Dosen Pengampu</th>
                        <th>Status</th>
                    </tr> 
                </thead>
                <tbody>
                    @foreach ($jadwal as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->kode_mk }}</td>
                        <td>{{ $item->mataKuliah->nama_mk ?? 'N/A' }}</td> 
                        <td>{{ $item->kode_ruang }}</td>
                        <td>{{ $item->hari }}</td>
                        <td>{{ $item->jam_mulai }}</td>
                        <td>{{ $item->jam_selesai }}</td>
                        <td>{{ $item->nama_kelas }}</td>
                
                        <!-- Menampilkan daftar dosen pengampu -->
                        <td>
                            <ol>
                                @if ($item->dosen1) <li>{{ $item->dosen1->nama_dosen }}</li> @endif
                                @if ($item->dosen2) <li>{{ $item->dosen2->nama_dosen }}</li> @endif
                                @if ($item->dosen3) <li>{{ $item->dosen3->nama_dosen }}</li> @endif
                                @if ($item->dosen4) <li>{{ $item->dosen4->nama_dosen }}</li> @endif
                                @if ($item->dosen5) <li>{{ $item->dosen5->nama_dosen }}</li> @endif
                            </ol>
                        </td>
                
                        <td>{{ $item->status }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
        </div>

        <div class="btn-container">
            <button type="button" class="btn btn-outline-secondary"
                onclick="window.location.href='{{ route('jadwalkuliah.create') }}'">←</button>
        </div>
    </div>

    <!-- Bootstrap JS & Icons -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
