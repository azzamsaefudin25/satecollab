<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Akademik Terpadu Efisien</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.css"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fff;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .header {
            background-color: #658345;
            color: black;
            padding: 30px 0;
            width: 100%;
            margin: 0;
        }

        .header-content {
            display: flex;
            align-items: center;
            padding: 0 40px;
        }

        .header h1 {
            margin: 0;
            font-size: 30px;
            margin-left: 20px;
        }

        .header img {
            height: 60px;
        }

        .footer {
            background-color: #658345;
            color: white;
            text-align: center;
            padding: 6px 0;
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

        .sidenav {
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #111;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
        }

        .sidenav a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 25px;
            color: #818181;
            display: block;
            transition: 0.3s;
        }

        .sidenav a:hover {
            color: #f1f1f1;
        }

        .sidenav .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
        }

        #main {
            transition: margin-left .5s;
            padding: 16px;
        }

        @media screen and (max-height: 450px) {
            .sidenav {
                padding-top: 15px;
            }

            .sidenav a {
                font-size: 18px;
            }
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header class="header">
        <div class="header-content">
            <img src="{{ asset('backend\img\logoSate-removebg-preview.png') }}" alt="SATE Logo">
            <h1>SATE <br><small>Sistem Akademik Terpadu Efisien</small></h1>
        </div>
    </header>

    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="#">Dashboard</a>
        <a href="#">Registrasi</a>
        <a href="#">Pengisian IRS</a>
        <a href="#">Jadwal Perkuliahan</a>
        <a href="#">KHS</a>
        <a href="#">Profile</a>
        <a href="#">Notifikasi</a>
        <a href="#">Log Out</a>
    </div>

    <div id="main">
        <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; </span>
    </div>

    <script>
        function openNav() {
            document.getElementById("mySidenav").style.width = "250px";
            document.getElementById("main").style.marginLeft = "250px";
            document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
            document.getElementById("main").style.marginLeft = "0";
            document.body.style.backgroundColor = "white";
        }
    </script>

    <div class="container-fluid flex-grow-1">
        <div class="row flex-grow-1">
            <!-- Sidebar -->
            <aside class="col-3 col-md-2 bg-light p-3">
                <div class="btn btn-secondary w-100 mb-3">Daftar Mata Kuliah</div>
                <div class="dropdown">
                    <select id="matkul" class="form-select mb-4">
                        <option value="">-- Pilih Mata Kuliah --</option>
                    </select>
                </div>
                <div class="text-center">
                    <img src="{{ asset('backend/img/profile img.jpg') }}" alt="user-icon" class="img-fluid rounded-circle mb-3"
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
                {{-- @include('komponen.pesan') --}}
                <table class="table table-bordered mt-3 text-center" id="jadwalTable" border="1">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Kode MK</th>
                            <th>Nama Mata Kuliah</th>
                            <th>Jenis</th>
                            <th>Sks</th>
                            <th>Semester</th>
                            <th>Tahun Ajaran</th>
                            <th>Nama Kelas</th>
                            <th>Hari</th>
                            <th>Jam Mulai</th>
                            <th>Jam Selesai</th>
                            <th>Kode Ruang</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- {{ dd($mahasiswa) }} --}}
                        @foreach ($irsData as $index => $irs)
                            <tr data-kode-mk="{{ $irs->kode_mk }}" data-nama-kelas="{{ $irs->nama_kelas }}"
                                data-status="{{ $irs->status_approve }}">
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
                                    @if ($irs->status_approve === 'menunggu konfirmasi')
                                        <button class="btn btn-danger btn-hapus">Hapus</button>
                                    @else
                                        <button class="btn btn-danger" disabled>Sudah Dikonfirmasi</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        {{-- {{ dd($mahasiswa) }} --}}
                    </tbody>
                </table>

                <div class="text-center mt-4">
                    <button type="button" class="btn btn-dark back-button"
                        onclick="window.location.href='{{ route('mahasiswa') }}'"><svg
                            xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-arrow-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M15 8a.5.5 0 0 1-.5.5H3.707l3.147 3.146a.5.5 0 0 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 0 1 .708.708L3.707 7.5H14.5A.5.5 0 0 1 15 8z" />
                        </svg>
                        BACK
                    </button>
                    <button class="btn btn-success mx-2"
                        onclick="window.location.href='{{ route('irs.index') }}'">LIHAT</button>
                </div>

            </main>
        </div>
    </div>
    <footer class="footer">
        <h3>SATE</h3>
        <p>Sistem Terpadu Akademik. Contact for more Questions below</p>
        <div class="footer-icons">
            <a href="#"><i class="bi bi-facebook"></i></a>
            <a href="#"><i class="bi bi-twitter"></i></a>
            <a href="#"><i class="bi bi-google"></i></a>
            <a href="#"><i class="bi bi-youtube"></i></a>
            <a href="#"><i class="bi bi-linkedin"></i></a>
        </div>
    </footer>

    <script>
        $(document).ready(function() {
            // Inisialisasi Select2
            $('#matkul').select2({
                placeholder: 'Pilih Mata Kuliah',
                allowClear: true,
                ajax: {
                    url: "{{ route('search.Mahasiswa') }}",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            query: params.term
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.results
                        };
                    },
                    cache: true
                }
            });

            // Event ketika mata kuliah dipilih
            $('#matkul').on('select2:select', function(e) {
                const selectedMatkul = e.params.data;
                const kodeMk = selectedMatkul.id;
                const kelasMatch = selectedMatkul.text.match(/- kelas ([^-]+)/);
                const kelas = kelasMatch ? kelasMatch[1].trim() : null;

                if (!kelas) {
                    alert("Nama kelas tidak boleh kosong");
                    return;
                }

                const exists = $('#jadwalTable tbody tr').filter(function() {
                    return $(this).find('td:eq(1)').text() === kodeMk;
                }).length;

                if (exists === 0) {
                    // Get NIM from the page
                    const nimText = document.getElementById('nim').innerText;
                    const nim = nimText.replace('NIM: ', '');

                    $.ajax({
                        url: "{{ route('get.matkul.details') }}",
                        method: "GET",
                        data: {
                            kode_mk: kodeMk,
                            nama_kelas: kelas
                        },
                        success: function(matkul) {
                            if (matkul) {
                                if (matkul.terisi >= matkul.kapasitas) {
                                    alert(
                                        `Kuota untuk mata kuliah ${matkul.nama_mk} kelas ${matkul.nama_kelas} sudah penuh.`
                                    );
                                    return;
                                }

                                // Check for schedule conflicts
                                const conflictExists = $('#jadwalTable tbody tr').filter(
                                    function() {
                                        const existingHari = $(this).find('td:eq(8)').text()
                                            .trim();
                                        const existingJamMulai = $(this).find('td:eq(9)')
                                            .text().trim();
                                        const existingJamSelesai = $(this).find('td:eq(10)')
                                            .text().trim();

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

                                // Save to database immediately
                                $.ajax({
                                    url: "{{ route('irs.store') }}",
                                    method: "POST",
                                    data: {
                                        _token: "{{ csrf_token() }}",
                                        irsData: [{
                                            nim: nim,
                                            kode_mk: matkul.kode_mk,
                                            nama_kelas: matkul.nama_kelas,
                                            sks: matkul.sks,
                                            kode_ruang: matkul.kode_ruang,
                                            hari: matkul.hari,
                                            jam_mulai: matkul.jam_mulai,
                                            jam_selesai: matkul.jam_selesai,
                                            tahun_ajaran: matkul.tahun_ajaran,
                                            status: "baru",
                                            status_approve: "menunggu konfirmasi"
                                        }]
                                    },
                                    success: function(response) {
                                        if (response.messages.every(msg => msg
                                                .includes("berhasil"))) {
                                            // Add to table only after successful database insertion
                                            // Add to table only after successful database insertion
                                            const rowCount = $(
                                                    '#jadwalTable tbody tr')
                                                .length + 1;
                                            const newRow = `
                                                <tr data-kode-mk="${matkul.kode_mk}" data-nama-kelas="${matkul.nama_kelas}" data-status="menunggu konfirmasi">
                                                    <td>${rowCount}</td>
                                                    <td>${matkul.kode_mk}</td>
                                                    <td>${matkul.nama_mk}</td>
                                                    <td>${matkul.jenis}</td>
                                                    <td>${matkul.sks}</td>
                                                    <td>${matkul.semester}</td>
                                                    <td>${matkul.tahun_ajaran}</td>
                                                    <td>${matkul.nama_kelas}</td>
                                                    <td>${matkul.hari}</td>
                                                    <td>${matkul.jam_mulai}</td>
                                                    <td>${matkul.jam_selesai}</td>
                                                    <td>${matkul.kode_ruang}</td>
                                                    <td>
                                                        <button class="btn btn-danger btn-hapus">Hapus</button>
                                                    </td>
                                                </tr>
                                            `;
                                            $('#jadwalTable tbody').append(newRow);

                                        } else {
                                            alert(response.messages.join("\n"));
                                        }
                                    },
                                    error: function(xhr) {
                                        alert("Terjadi kesalahan: " + xhr
                                            .responseText);
                                    }
                                });
                            }
                        },
                        error: function(xhr) {
                            console.error("Error:", xhr.responseText);
                            alert("Terjadi kesalahan saat mengambil detail mata kuliah.");
                        }
                    });
                } else {
                    alert('Mata kuliah yang sama sudah dipilih.');
                }
            });

            // Modified delete handler
            $(document).ready(function() {
                $(document).on('click', '.btn-hapus', function() {
                    const row = $(this).closest('tr');
                    const kodeMk = row.data('kode-mk');
                    const namaKelas = row.data('nama-kelas');
                    const nimText = document.getElementById('nim').innerText;
                    const nim = nimText.replace('NIM: ', '').trim();
                    const status = row.data('status');
                    console.log('Status:', status);
                    // Cek status approve
                    if (status !== 'menunggu konfirmasi') {
                        alert('Mata kuliah yang sudah dikonfirmasi tidak dapat dihapus');
                        return;
                    }

                    // Debug log
                    console.log('Data yang akan dihapus:', {
                        nim: nim,
                        kode_mk: kodeMk,
                        nama_kelas: namaKelas,
                        status: status
                    });

                    // Konfirmasi penghapusan
                    if (!confirm(
                            `Apakah Anda yakin ingin menghapus mata kuliah ini?\n\nKode MK: ${kodeMk}\nKelas: ${namaKelas}`
                        )) {
                        return;
                    }

                    // Disable button dan tampilkan loading
                    const button = $(this);
                    button.prop('disabled', true);
                    button.html(
                        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Menghapus...'
                    );

                    $.ajax({
                        url: "{{ route('irs.delete') }}",
                        method: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            nim: nim,
                            kode_mk: kodeMk,
                            nama_kelas: namaKelas
                        },
                        success: function(response) {
                            console.log('Response:', response);
                            if (response.success) {
                                row.fadeOut(400, function() {
                                    row.remove();
                                    // Update nomor urut
                                    $('#jadwalTable tbody tr').each(function(
                                        index) {
                                        $(this).find('td:first').text(
                                            index + 1);
                                    });
                                });
                                alert("Mata kuliah berhasil dihapus dari IRS.");
                            } else {
                                alert(response.message);
                                button.prop('disabled', false);
                                button.html('Hapus');
                            }
                        },
                        error: function(xhr) {
                            console.error('Error Response:', xhr.responseJSON);
                            const response = xhr.responseJSON;
                            alert(response?.message ||
                                "Terjadi kesalahan saat menghapus mata kuliah");
                            button.prop('disabled', false);
                            button.html('Hapus');
                        }
                    });
                });
            });
        });
        // Di dalam script JavaScript Anda
$.ajax({
    url: '{{ route("irs.store") }}',
    method: 'POST',
    data: formData,
    success: function(response) {
        // Tampilkan pesan sukses
        let successMessage = response.messages.join('<br>');
        Swal.fire({
            icon: 'success',
            title: 'Pengajuan IRS Berhasil',
            html: successMessage
        }).then(() => {
            // Refresh halaman atau redirect
            window.location.reload();
        });
    },
    error: function(xhr) {
        // Tangani error
        let errorMessage = xhr.responseJSON.message || 'Terjadi kesalahan dalam pengajuan IRS';
        Swal.fire({
            icon: 'error',
            title: 'Pengajuan IRS Gagal',
            text: errorMessage
        });
    }
});
    </script>
</body>

</html>
