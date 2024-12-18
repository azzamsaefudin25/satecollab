<!DOCTYPE html>
<html>

<head>
    <title>IRS</title>
    <style>
        /* CSS untuk halaman PDF */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            font-size: 12px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h3,
        .header h4 {
            margin: 5px;
        }

        .header img {
            width: 90px;
            height: auto;
            position: absolute;
            /* left: 20px; */
            right: 10px;
            top: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th,
        table td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
            vertical-align: middle;
        }

        table th {
            background-color: #f2f2f2;
        }

        .signature {
            width: 100%;
            margin-top: 50px;
            text-align: center;
        }

        .signature .column {
            display: inline-block;
            width: 48%;
            text-align: left;
        }

        @page {
            margin: 50px 25px;
        }

        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 10px;
            color: #000;
        }

        .footer p {
            margin: 0;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <div class="header">
        <h4>KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET DAN TEKNOLOGI</h4>
        <h4>FAKULTAS SAINS DAN MATEMATIKA</h4>
        <h4>UNIVERSITAS DIPONEGORO</h4>
        <h4>ISIAN RENCANA STUDI</h4>
        <h4>Semester Ganjil TA 2024/2025</h4>
        <img src="{{ public_path('/backend/img/profile img.jpg') }}" alt="Profile Image">
    </div>

    <!-- Data Mahasiswa -->
    <table style="margin-bottom: 10px; border: none;">
        <tr>
            <td style="border: none; text-align: left;">NIM</td>
            <td style="border: none; text-align: left;">: {{ $nim ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td style="border: none; text-align: left;">Nama Mahasiswa</td>
            <td style="border: none; text-align: left;">: {{ $nama ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td style="border: none; text-align: left;">Program Studi</td>
            <td style="border: none; text-align: left;">: {{ $prodi ?? 'N/A' }} S1</td>
        </tr>
        <tr>
            <td style="border: none; text-align: left;">Dosen Wali</td>
            <td style="border: none; text-align: left;">: {{ $pa ?? 'N/A' }}</td>
        </tr>
    </table>

    <!-- Tabel IRS -->
    <table>
        <thead>
            <tr>
                <th>NO</th>
                <th>KODE</th>
                <th>MATA KULIAH</th>
                <th>KELAS</th>
                <th>SKS</th>
                <th>RUANG</th>
                <th>STATUS</th>
                <th>NAMA DOSEN</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($irs as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item->kode_mk ?? 'N/A' }}</td>
                    <td>{{ $item->jadwalKuliah->mataKuliah->nama_mk ?? 'N/A' }}</td>
                    <td>{{ $item->nama_kelas ?? 'N/A' }}</td>
                    <td>{{ $item->sks ?? 'N/A' }}</td>
                    <td>{{ $item->kode_ruang ?? 'N/A' }}</td>
                    <td>{{ $item->status ?? 'N/A' }}</td>
                    <td>
                        @if ($item->jadwalKuliah->dosen1)
                            {{ $item->jadwalKuliah->dosen1->dosen->nama_dosen }}<br>
                        @endif
                        @if ($item->jadwalKuliah->dosen2)
                            {{ $item->jadwalKuliah->dosen2->dosen->nama_dosen }}<br>
                        @endif
                        @if ($item->jadwalKuliah->dosen3)
                            {{ $item->jadwalKuliah->dosen3->dosen->nama_dosen }}<br>
                        @endif
                        @if ($item->jadwalKuliah->dosen4)
                            {{ $item->jadwalKuliah->dosen4->dosen->nama_dosen }}<br>
                        @endif
                        @if ($item->jadwalKuliah->dosen5)
                            {{ $item->jadwalKuliah->dosen5->dosen->nama_dosen }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td colspan="8" style="text-align: left; border-top: none;">
                        {{ $item->hari ?? 'N/A' }} pukul {{ $item->jam_mulai ?? 'N/A' }} -
                        {{ $item->jam_selesai ?? 'N/A' }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Footer -->
    <div class="signature">
        <div class="column">
            <p>Pembimbing Akademik (Dosen Wali)</p>
            <br><br>
            <p>{{ $pa ?? 'N/A' }}</p>
            <p>NIP: 199603032024061003</p>
        </div>
        <div class="column">
            <p>Semarang, {{ \Carbon\Carbon::now()->format('d F Y') }}</p>
            <p>Nama Mahasiswa,</p>
            <br><br>
            <p>{{ $nama ?? 'N/A' }}</p>
            <p>NIM: 24060122130076</p>
        </div>
    </div>

    <div class="footer"></div>
</body>

</html>
