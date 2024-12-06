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
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fff;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
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
            <img src="{{ asset('sate_logo.png') }}" alt="SATE Logo">
            <h1>SATE <br><small>Sistem Akademik Terpadu Efisien</small></h1>
        </div>
    </div>

    <div class="container">
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

        <div id="approval-buttons">
            {{-- Tombol "Setuju" jika ada IRS yang menunggu konfirmasi --}}
            @if ($irs->contains('status_approve', 'menunggu konfirmasi'))
                <form method="POST" action="{{ route('pembimbingakademik.persetujuanirs') }}" class="mb-2">
                    @csrf
                    <input type="hidden" name="nim" value="{{ $mahasiswa->nim }}">
                    <button type="submit" name="action" value="setuju"
                        class="btn btn-outline-success btn-lg">Setuju</button>
                </form>
            @endif

            {{-- Tombol "Ubah Persetujuan IRS" jika sudah disetujui --}}
            @if ($irs->contains('status_approve', 'disetujui'))
                <form method="POST" action="{{ route('pembimbingakademik.persetujuanirs') }}">
                    @csrf
                    <input type="hidden" name="nim" value="{{ $mahasiswa->nim }}">
                    <button type="submit" name="action" value="ubah" class="btn btn-outline-warning btn-lg">Ubah
                        Persetujuan IRS</button>
                </form>
            @endif
        </div>
        <footer>
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
        </footer>
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
