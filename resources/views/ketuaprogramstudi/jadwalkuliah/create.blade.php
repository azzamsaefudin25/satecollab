<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SATE - Sistem Akademik Terpadu dan Efisien</title>
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

        .container {
            width: 100%;
            max-width: 700px;
            background-color: white;
            margin: 50px auto;
            padding: 30px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        select {
            padding: 12px;
            margin-bottom: 20px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
        }

        button {
            padding: 12px 0;
            font-size: 16px;
            font-weight: 600;
            border-radius: 5px;
            cursor: pointer;
        }

        .back-btn {
            position: fixed;
            bottom: 20px;
            left: 20px;
            /* Ubah dari 'right' ke 'left' */
            background-color: #4c4c4c;
            border: none;
            padding: 10px 20px;
            border-radius: 50px;
            color: white;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            display: flex;
            align-items: center;
            gap: 10px;
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


        .btn-custom {
            background-color: #007bff;
            /* Warna biru */
            color: white;
            border-radius: 8px;
            margin-right: 10px;
        }

        .btn-custom:hover {
            background-color: #0056b3;
        }

        .action-buttons button {
            width: 48%;
            padding: 10px;
            border: none;
            font-size: 14px;
            font-weight: bold;
            color: white;
        }

        /* Adjust jam mulai and jam berakhir styles */
        .time-select {
            display: flex;
            justify-content: space-between;
        }

        .time-select select {
            width: 48%;
        }

        #selected-dosen-list {
            margin-top: 10px;
        }

        .selected-dosen-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 5px;
            background-color: #e9ecef;
        }

        .selected-dosen-item span {
            font-size: 14px;
            color: #333;
        }

        .remove-dosen-btn {
            color: red;
            cursor: pointer;
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

        .sidebar a {
            display: block;
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


        h4 {
            text-align: center;
            font-size: 23px;
            font-weight: 600;
        }

        h5 {
            margin-top: 30px;
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
            <a href="{{ route('monitoringirs.index') }}" class="menu-item" data-menu="Monitoring IRS">
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

            <a href="{{ route('alokasiruangan.index') }}" class="menu-item"
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
            <main>
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
                <h3>PENYUSUNAN JADWAL KULIAH</h3>
                <form action="{{ route('jadwalkuliah.store') }}" method="POST">
                    @csrf <!-- Token CSRF untuk keamanan -->

                    <!-- Dropdown untuk Program Studi -->
                    <div class="form-group">
                        <label for="programstudi">Program Studi</label>
                        <input type="text" id="programstudi" name="programstudi" class="form-control"
                            value="{{ $programStudi->nama_programstudi }}" readonly>
                        <input type="hidden" name="id_programstudi" value="{{ $programStudi->id_programstudi }}">
                    </div>


                    <!-- Dropdown Ruangan -->
                    <select name="kode_ruang" id="ruangan" required>
                        <option value="">Pilih Ruangan</option>
                        @foreach ($ruangperkuliahan as $ruang)
                            <option value="{{ $ruang->kode_ruang }}">{{ $ruang->kode_ruang }}</option>
                        @endforeach
                    </select>

                    <!-- Dropdown Mata Kuliah -->
                    <select name="kode_mk" id="kode_mk" required>
                        <option value="">Pilih Mata Kuliah</option>
                        @foreach ($matakuliah as $mk)
                            <option value="{{ $mk->kode_mk }}">{{ $mk->nama_mk }}</option>
                        @endforeach
                    </select>


                    <!-- Pilih Hari -->
                    <select id="hari" name="hari" required>
                        <option value="">Pilih Hari</option>
                        <option value="Senin">Senin</option>
                        <option value="Selasa">Selasa</option>
                        <option value="Rabu">Rabu</option>
                        <option value="Kamis">Kamis</option>
                        <option value="Jumat">Jumat</option>
                    </select>

                    <!-- Jam Mulai dan Berakhir -->
                    <div class="time-select">
                        <select id="jam_mulai" name="jam_mulai" required>
                            <option value="">Pilih Jam Mulai</option>
                        </select>


                        <select name="jam_selesai_displayphp" id="jam_selesai_display" required>
                            <option value="">Jam Berakhir (otomatis)</option>
                        </select>
                    </div>

                    <!-- Input Hidden untuk Jam Mulai dan Selesai -->
                    <input type="hidden" id="jam_mulai_hidden" name="jam_mulai">
                    <input type="hidden" id="jam_selesai_hidden" name="jam_selesai">

                    <!-- Kelas -->
                    <select id="nama_kelas" name="nama_kelas" required>
                        <option value="">Pilih Kelas</option>
                        @foreach ($kelas as $kelas)
                            <option value="{{ $kelas->nama_kelas }}">{{ $kelas->nama_kelas }}</option>
                        @endforeach
                    </select>

                    <div class="form-group">
                        <label for="tahun_ajaran">Tahun Ajaran</label>
                        <input type="text" id="tahun_ajaran" name="tahun_ajaran" class="form-control" readonly>
                    </div>

                    <div class="btn-container">
                        <button type="button" class="btn btn-dark back-button"
                            onclick="window.location.href='{{ route('jadwalkuliah.index') }}'">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M15 8a.5.5 0 0 1-.5.5H3.707l3.147 3.146a.5.5 0 0 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 0 1 .708.708L3.707 7.5H14.5A.5.5 0 0 1 15 8z" />
                            </svg>
                            BACK
                        </button>

                        <div class="btn-right">
                            <button type="submit" class="btn btn-custom">AJUKAN</button>
                        </div>
                    </div>
                </form>
            </main>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            // Ambil ID Program Studi dari backend
            var id_programstudi = "{{ $programStudi->id_programstudi }}";

            if (id_programstudi) {
                // Mendapatkan ruangan
                $.ajax({
                    url: '/getRuangan/' + id_programstudi,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#ruangan').empty();
                        if (data.length === 0) {
                            $('#ruangan').append(
                                '<option value="">-- Tidak ada ruangan tersedia --</option>');
                        } else {
                            $('#ruangan').append('<option value="">-- Pilih Ruangan --</option>');
                            $.each(data, function(key, value) {
                                $('#ruangan').append(
                                    `<option value="${value.kode_ruang}">${value.kode_ruang}</option>`
                                );
                            });
                        }
                    },
                    error: function() {
                        $('#ruangan').append('<option value="">-- Gagal memuat ruangan --</option>');
                    }
                });

                // Mendapatkan mata kuliah
                $.ajax({
                    url: '/getMatakuliah/' + id_programstudi,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#kode_mk').empty();
                        if (data.length === 0) {
                            $('#kode_mk').append(
                                '<option value="">-- Tidak ada mata kuliah tersedia --</option>');
                        } else {
                            $('#kode_mk').append('<option value="">-- Pilih Mata Kuliah --</option>');
                            $.each(data, function(key, value) {
                                $('#kode_mk').append(
                                    `<option value="${value.kode_mk}">${value.nama_mk}</option>`
                                );
                            });
                        }
                    },
                    error: function() {
                        $('#kode_mk').append(
                            '<option value="">-- Gagal memuat mata kuliah --</option>');
                    }
                });
            }
        });
        // Fungsi untuk menghasilkan array waktu dengan interval 10 menit
        function generateTimeOptions() {
            const times = [];
            for (let hour = 6; hour < 21; hour++) {
                for (let minute = 0; minute < 60; minute += 10) {
                    const formattedHour = hour.toString().padStart(2, '0');
                    const formattedMinute = minute.toString().padStart(2, '0');
                    times.push(`${formattedHour}:${formattedMinute}`);
                }
            }
            return times;
        }

        $(document).ready(function() {
            const jamMulaiOptions = generateTimeOptions();
            const jamMulaiDropdown = $('#jam_mulai');

            // Tambahkan opsi waktu ke dropdown jam_mulai
            jamMulaiOptions.forEach(time => {
                jamMulaiDropdown.append(`<option value="${time}">${time}</option>`);
            });

            // Perbarui logika saat jam_mulai berubah
            $('#jam_mulai').on('change', function() {
                const jamMulai = $(this).val();
                const kodeMk = $('#kode_mk').val();

                $.ajax({
                    url: '{{ route('jadwalkuliah.hitungJamSelesai') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        jam: jamMulai,
                        kode_mk: kodeMk
                    },
                    success: function(response) {
                        // Mengganti opsi dalam select untuk jam selesai dengan hasil dari AJAX
                        $('#jam_selesai_display').empty().append('<option value="' + response
                            .jam_selesai + '">' + response.jam_selesai + '</option>');

                        // Menyimpan nilai jam mulai dan jam selesai di input hidden
                        $('#jam_mulai_hidden').val(jamMulai);
                        $('#jam_selesai_hidden').val(response.jam_selesai);
                    }
                });
            });
        });
        $(document).ready(function() {
            // Mendapatkan bulan saat ini (0 = Januari, 1 = Februari, ..., 9 = Oktober, ...)
            const currentMonth = new Date().getMonth() + 1; // `getMonth()` mengembalikan 0-11, jadi tambahkan 1
            let tahunAjaran;

            if (currentMonth >= 8) {
                // Jika bulan Oktober hingga Desember, tahun ajaran adalah tahun ini dan tahun depan
                tahunAjaran = `${new Date().getFullYear()}/${new Date().getFullYear() + 1}`;
            } else {
                // Jika bulan Januari hingga September, tahun ajaran adalah tahun sebelumnya dan tahun ini
                tahunAjaran = `${new Date().getFullYear() - 1}/${new Date().getFullYear()}`;
            }

            // Menetapkan nilai otomatis pada input dengan jQuery
            $('#tahun_ajaran').val(tahunAjaran);
        });
    </script>
</body>

</html>
