<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Akademik Terpadu Efisien</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        header {
            font-size: 1.2rem;
        }

        aside .form-select,
        aside .btn {
            font-size: 0.9rem;
        }

        aside .user-info img {
            width: 80px;
            border-radius: 50%;
        }

        main h2 {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .table-secondary {
            background-color: #D3D3D3 !important;
        }
    </style>
</head>

<!-- Tambahkan link ke Select2 CSS dan JS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<body class="bg-dark">
    <div class="container-fluid vh-100 d-flex flex-column">
        <!-- Header -->
        <header class="bg-success text-white text-center py-3">
            <h1 class="mb-0">SATE</h1>
            <p class="mb-0">SISTEM AKADEMIK TERPADU EFISIEN</p>
        </header>

        <div class="row flex-grow-1">
            <!-- Main Content -->
            <main class="col-0 col-md-0 p-4 bg-white">
                <h2 class="text-center">IRS</h2>
                <h3 class="text-center mt-5">Daftar Mata Kuliah</h3>
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
                            <th>Status Approve</th>
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
                                <td>{{ $irs->status_approve ?? 'N/A' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="text-center mt-4">
                    <button type="button" class="btn btn-outline-secondary"
                        onclick="window.location.href='{{ route('IRS.create') }}'">←</button>
                </div>

            </main>
        </div>
    </div>
</body>

</html>
