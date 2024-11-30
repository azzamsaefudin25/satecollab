<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SATE - Sistem Akademik Terpadu dan Efisien</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
        .container {
            width: 100%;
            max-width: 700px;
            background-color: white;
            margin: 50px auto;
            padding: 30px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        h3 {
            font-size: 20px;
            text-align: left;
            margin-bottom: 30px;
            color: #333;
            font-weight: 600;
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

        /* Ajukan button (blue) */
        .ajukan-btn {
            background-color: #007bff;
            color: white;
        }

        .ajukan-btn:hover {
            background-color: #0056b3;
        }

        /* Lihat button (green) */
        .lihat-btn {
            background-color: #28a745;
            color: white;
        }

        .lihat-btn:hover {
            background-color: #218838;
        }

        .action-buttons {
            display: flex;
            justify-content: space-between;
        }

        .action-buttons button {
            width: 48%;
        }

        /* Back Button */
        .back-btn {
            position: fixed;
            bottom: 20px;
            left: 20px;
            background-color: #4c4c4c;
            border: none;
            padding: 15px;
            border-radius: 50%;
            color: white;
            font-size: 24px;
            cursor: pointer;
        }

        .back-btn:hover {
            background-color: #333;
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

    <div class="container">
        <main>
            <h3>PENYUSUNAN JADWAL KULIAH</h3>
            <form action="{{ route('jadwalkuliah.store') }}" method="POST">
                @csrf <!-- Token CSRF untuk keamanan -->

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
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
                <!-- Dropdown untuk Program Studi -->
                <div class="form-group">
                    <label for="programstudi">Program Studi</label>
                    <input type="text" id="programstudi" name="programstudi" class="form-control" value="{{ $programStudi->nama_programstudi }}" readonly>
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

                <button type="submit" class="ajukan-btn">Ajukan</button>
                <button type="button" class="lihat-btn"
                    onclick="window.location.href='{{ route('lihatjadwalkuliah.lihat') }}'">Lihat</button>
    </div>
    </form>
    </main>
    </div>


    <button class="back-btn" onclick="window.location.href='{{ route('ketuaprogramstudi') }}'">&larr;</button>

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
            $('#ruangan').append('<option value="">-- Tidak ada ruangan tersedia --</option>');
        } else {
            $('#ruangan').append('<option value="">-- Pilih Ruangan --</option>');
            $.each(data, function(key, value) {
                $('#ruangan').append(`<option value="${value.kode_ruang}">${value.kode_ruang}</option>`);
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
                    $('#kode_mk').append('<option value="">-- Tidak ada mata kuliah tersedia --</option>');
                } else {
                    $('#kode_mk').append('<option value="">-- Pilih Mata Kuliah --</option>');
                    $.each(data, function(key, value) {
                        $('#kode_mk').append(`<option value="${value.kode_mk}">${value.nama_mk}</option>`);
                    });
                }
            },
            error: function() {
                $('#kode_mk').append('<option value="">-- Gagal memuat mata kuliah --</option>');
            }
        });
    }
});
        // Fungsi untuk menghasilkan array waktu dengan interval 15 menit
        function generateTimeOptions() {
            const times = [];
            for (let hour = 0; hour < 24; hour++) {
                for (let minute = 0; minute < 60; minute += 15) {
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