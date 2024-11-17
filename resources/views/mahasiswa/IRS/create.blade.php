<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Akademik Terpadu Efisien</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
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
            <!-- Sidebar -->
            <aside class="col-3 col-md-2 bg-light p-3">
                <div class="btn btn-secondary w-100 mb-3">Tambahkan Jadwal Perkuliahan</div>
                <div class="dropdown">
                    <select id="matkul" class="form-select mb-4">
                        <option value="">-- Pilih Mata Kuliah --</option>
                    </select>
                </div>
                <div class="text-center">
                    <img src="crown-icon.png" alt="user-icon" class="img-fluid rounded-circle mb-3"
                        style="width: 60px;">
                    <p>Nama: {{ $user->name ?? 'User tidak ditemukan' }}</p>
                    <p id="nim">NIM: {{ $nim ?? 'NIM tidak ditemukan' }}</p>
                    <p>Informatika</p>
                </div>

            </aside>

            <!-- Main Content -->
            <main class="col-9 col-md-10 p-4 bg-white">
                <h2 class="text-center">IRS</h2>
                <h3 class="text-center mt-5">Daftar Mata Kuliah</h3>
                <table class="table table-bordered mt-3 text-center" id="jadwalTable" border="1">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Kode MK</th>
                            <th>Nama Mata Kuliah</th>
                            <th>Jenis</th>
                            <th>Sks</th>
                            <th>Tahun Ajaran</th>
                            <th>Semester</th>
                            <th>Nama Kelas</th>
                            <th>Hari</th>
                            <th>Jam Mulai</th>
                            <th>Jam Selesai</th>
                            <th>Kode Ruang</th>
                            <th>Nama Dosen Pengampu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($irsData as $index => $irs)
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
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="text-center mt-4">
                    <button type="button" class="btn btn-outline-secondary"
                        onclick="window.location.href='{{ route('mahasiswa') }}'">←</button>
                    <button id="btnAjukan" class="btn btn-primary mx-2">Ajukan</button>
                    <button class="btn btn-success mx-2"
                        onclick="window.location.href='{{ route('IRS.index') }}'">Lihat</button>
                </div>

            </main>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Inisialisasi Select2
            $('#matkul').select2({
                placeholder: 'Pilih Mata Kuliah',
                allowClear: true,
                ajax: {
                    url: "{{ route('search.Mahasiswa') }}", // URL endpoint untuk mencari data matkul
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            query: params.term
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.results // Data hasil dari backend
                        };
                    },
                    cache: true
                }
            });

            // Event ketika mata kuliah dipilih
            $('#matkul').on('select2:select', function(e) {
                const selectedMatkul = e.params.data;
                const kodeMk = selectedMatkul.id; // Kode mata kuliah
                const kelas = selectedMatkul.text.split('- kelas ')[1]?.trim(); // Ambil kelas dari teks
                console.log("Data yang dipilih:", selectedMatkul);
                if (!kelas) {
                    alert("Nama kelas tidak boleh kosong");
                    return;
                }
                // Cek apakah mata kuliah sudah ada di tabel berdasarkan kode_mk
                const exists = $('#jadwalTable tbody tr').filter(function() {
                    return $(this).find('td:eq(1)').text() === kodeMk; // Cek berdasarkan kode_mk
                }).length;

                if (exists === 0) {
                    // Ambil detail mata kuliah dan cek kuota ruangan
                    $.ajax({
                        url: "{{ route('get.matkul.details') }}", // Endpoint untuk mendapatkan detail mata kuliah
                        method: "GET",
                        data: {
                            kode_mk: kodeMk,
                            nama_kelas: kelas
                        },
                        success: function(matkul) {
                            if (matkul) {
                                // Cek apakah jumlah pendaftar sudah mencapai kapasitas
                                if (matkul.jumlah_pendaftar >= matkul.kapasitas) {
                                    alert(
                                        `Kuota untuk mata kuliah ${matkul.nama_mk} kelas ${matkul.nama_kelas} sudah penuh.`
                                    );
                                    return;
                                }

                                // Validasi konflik jadwal (hari dan jam)
                                const conflictExists = $('#jadwalTable tbody tr').filter(
                                    function() {
                                        const existingHari = $(this).find('td:eq(7)')
                                            .text(); // Kolom hari
                                        const existingJamMulai = $(this).find('td:eq(8)')
                                            .text(); // Kolom jam mulai
                                        const existingJamSelesai = $(this).find('td:eq(9)')
                                            .text(); // Kolom jam selesai

                                        return (
                                            existingHari === matkul.hari &&
                                            (
                                                (matkul.jam_mulai >= existingJamMulai &&
                                                    matkul.jam_mulai <
                                                    existingJamSelesai) ||
                                                (matkul.jam_selesai >
                                                    existingJamMulai && matkul
                                                    .jam_selesai <= existingJamSelesai
                                                ) ||
                                                (matkul.jam_mulai <= existingJamMulai &&
                                                    matkul.jam_selesai >=
                                                    existingJamSelesai)
                                            )
                                        );
                                    }).length;

                                if (conflictExists > 0) {
                                    alert(
                                        `Mata kuliah ${matkul.nama_mk} kelas ${matkul.nama_kelas} bertabrakan dengan jadwal yang sudah ada.`
                                    );
                                    return;
                                }

                                // Tambahkan data mata kuliah ke tabel
                                const rowCount = $('#jadwalTable tbody tr').length + 1;
                                $('#jadwalTable tbody').append(`
                            <tr>
                                <td>${rowCount}</td>
                                <td>${matkul.kode_mk}</td>
                                <td>${matkul.nama_mk}</td>
                                <td>${matkul.jenis}</td>
                                <td>${matkul.sks}</td>
                                <td>${matkul.semester}</td>
                                <td>${matkul.nama_kelas}</td>
                                <td>${matkul.hari}</td>
                                <td>${matkul.jam_mulai}</td>
                                <td>${matkul.jam_selesai}</td>
                                <td>${matkul.kode_ruang}</td>
                                <td>
                                    ${matkul.nama_dosen1 || ''}<br>
                                    ${matkul.nama_dosen2 || ''}<br>
                                    ${matkul.nama_dosen3 || ''}<br>
                                    ${matkul.nama_dosen4 || ''}<br>
                                    ${matkul.nama_dosen5 || ''}
                                </td>
                                <td>
                                    <button class="btn btn-danger btn-hapus">Hapus</button>
                                </td>
                            </tr>
                        `);
                            } else {
                                alert('Detail mata kuliah tidak ditemukan.');
                            }
                        },
                        error: function(xhr) {
                            console.error("Error:", xhr.responseText);
                            alert("Terjadi kesalahan saat mengambil detail mata kuliah.");
                        }
                    });
                } else {
                    alert('Mata kuliah ini sudah ditambahkan ke tabel.');
                }
            });



            // Event untuk menghapus baris mata kuliah dari tabel
            $(document).on('click', '.btn-hapus', function() {
                $(this).closest('tr').remove();
            });

            // Event untuk mengajukan IRS
            $('#btnAjukan').click(function(e) {
                e.preventDefault();

                // Ambil NIM dari elemen <p id="nim">
                const nimText = document.getElementById('nim').innerText;
                const nim = nimText.replace('NIM: ',
                    ''); // Hapus teks "NIM: " untuk mendapatkan hanya nilai NIM

                // Ambil data dari tabel
                const irsData = [];
                $('#jadwalTable tbody tr').each(function() {
                    const row = $(this).find('td');
                    irsData.push({
                        nim: nim, // Gunakan NIM yang sudah diambil dari elemen <p>
                        kode_mk: row.eq(1).text(),
                        nama_kelas: row.eq(3).text(),
                        sks: row.eq(4).text(),
                        kode_ruang: row.eq(5).text(),
                        hari: row.eq(6).text(),
                        jam_mulai: row.eq(7).text(),
                        jam_selesai: row.eq(8).text(),
                        tahun_ajaran: row.eq(9).text(),
                        nidn_pembimbingakademik: row.eq(10).text(),
                        status: "baru",
                        status_approve: "menunggu konfirmasi"
                    });
                });

                // Kirim data ke server menggunakan AJAX
                $.ajax({
                    url: "{{ route('irs.store') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        irsData: irsData
                    },
                    success: function(response) {
                        let message = "";
                        response.messages.forEach(function(msg) {
                            message += msg + "\n";
                        });
                        alert(message); // Menampilkan pesan error atau sukses

                        if (response.messages.every(msg => msg.includes("berhasil"))) {
                            $('#jadwalTable tbody')
                                .empty(); // Hapus semua data dari tabel jika berhasil
                        }
                    },
                    error: function(xhr) {
                        alert("Terjadi kesalahan: " + xhr.responseText);
                    }
                });
            });
        });
    </script>
</body>

</html>
