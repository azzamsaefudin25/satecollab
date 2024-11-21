<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Approve Jadwal Kuliah</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #fff;
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

    .search-box {
        margin-top: 20px;
        padding: 15px;
        background-color: white;
        border-radius: 5px;
    }

    .table-container {
        margin-top: 20px;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: rgba(0, 0, 0, 0.05);
    }

    .table-striped tbody tr:nth-of-type(even) {
        background-color: #e9ecef;
    }
</style>

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

    <div class="container mt-4">
        <div class="search-box">
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Cari Jadwal Kuliah" aria-label="Search">
                <button class="btn btn-outline-secondary" type="submit">
                    <i class="bi bi-search"></i> <!-- Bootstrap Icons -->
                </button>
            </form>
        </div>
        <div class="table-container">
            <h4 class="mt-4">Daftar Pengajuan Jadwal Kuliah</h4>

            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
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
                        <th>Nama Dosen Pengampu</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pengajuans as $index => $pengajuan)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $pengajuan->kode_mk }}</td>
                            <td>{{ $pengajuan->mataKuliah->nama_mk ?? 'mata kuliah tidak ditemukan' }}</td>
                            <td>{{ $pengajuan->kode_ruang }}</td>
                            <td>{{ $pengajuan->nama_kelas }}</td>
                            <td>{{ $pengajuan->mataKuliah->semester ?? 'N/A' }}</td>
                            <td>{{ $pengajuan->mataKuliah->sks ?? 'N/A' }}</td>
                            <td>{{ $pengajuan->mataKuliah->jenis ?? 'N/A' }}</td>
                            <td>{{ $pengajuan->mataKuliah->semester_aktif ?? 'N/A' }}</td>
                            <td>{{ $pengajuan->tahun_ajaran }}</td>
                            <td>{{ $pengajuan->hari }}</td>
                            <td>{{ $pengajuan->jam_mulai }}</td>
                            <td>{{ $pengajuan->jam_selesai }}</td>
                            <!-- Menampilkan daftar dosen pengampu -->
                            <td>
                                <ol>
                                    @if ($pengajuan->dosen1)
                                        <li>{{ $pengajuan->dosen1->dosen->nama_dosen }}</li>
                                    @endif
                                    @if ($pengajuan->dosen2)
                                        <li>{{ $pengajuan->dosen2->dosen->nama_dosen }}</li>
                                    @endif
                                    @if ($pengajuan->dosen3)
                                        <li>{{ $pengajuan->dosen3->dosen->nama_dosen }}</li>
                                    @endif
                                    @if ($pengajuan->dosen4)
                                        <li>{{ $pengajuan->dosen4->dosen->nama_dosen }}</li>
                                    @endif
                                    @if ($pengajuan->dosen5)
                                        <li>{{ $pengajuan->dosen5->dosen->nama_dosen }}</li>
                                    @endif
                                </ol>
                            </td>

                            <td>
                                @if ($pengajuan->status === 'disetujui')
                                    <span class="text-success">Disetujui</span>
                                @elseif ($pengajuan->status === 'ditolak')
                                    <span class="text-danger">Ditolak</span>
                                @else
                                    <form action="{{ route('pengajuan.updatejadwal', $pengajuan->id_jadwal) }}"
                                        method="POST" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="_method" value="PATCH">
                                        <!-- Menyatakan metode PATCH -->
                                        <input type="hidden" name="action" value="setuju">
                                        <button type="submit" class="btn btn-success btn-sm">Setuju</button>
                                    </form>
                                    <form action="{{ route('pengajuan.updatejadwal', $pengajuan->id_jadwal) }}"
                                        method="POST" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="_method" value="PATCH">
                                        <!-- Menyatakan metode PATCH -->
                                        <input type="hidden" name="action" value="tolak">
                                        <button type="submit" class="btn btn-danger btn-sm">Tolak</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    @if ($pengajuans->isEmpty())
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada pengajuan jadwal kuliah.</td>
                        </tr>
                    @endif
                </tbody>
            </table>

            <div class="btn-container">
                <button type="button" class="btn btn-outline-secondary"
                    onclick="window.location.href='{{ route('dekan') }}'">←</button>
            </div>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
