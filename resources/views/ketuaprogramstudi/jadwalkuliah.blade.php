<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SATE - Sistem Akademik Terpadu dan Efisien</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        header {
            background-color: #5c6f3d;
            /* Header color */
            padding: 15px;
            display: flex;
            align-items: center;
        }

        header img {
            height: 50px;
            margin-right: 10px;
        }

        header h1 {
            font-size: 24px;
            color: white;
            margin: 0;
            font-weight: 600;
        }

        header h2 {
            font-size: 14px;
            color: white;
            margin: 0;
            font-weight: 400;
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
    <header>
        <img src="logo.png" alt="Logo SATE">
        <div>
            <h1>SATE</h1>
            <h2>SISTEM AKADEMIK TERPADU DAN EFISIEN</h2>
        </div>
    </header>

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
                <select id="programstudi" name="programstudi" class="form-control">
                    <option value="">-- Pilih Program Studi --</option>
                    @foreach ($programstudi as $ps)
                        <option value="{{ $ps->id_programstudi }}">{{ $ps->nama_programstudi }}</option>
                    @endforeach
                </select>

                <select name="kode_ruang" id="ruangan">
                    @foreach ($ruangperkuliahan as $ruang)
                        <option value="{{ $ruang->kode_ruang }}">{{ $ruang->nama_ruangan }}</option>
                    @endforeach
                </select>


                <!-- Mata Kuliah -->
                <select id="kode_mk" name="kode_mk" required>
                    <option value="">Pilih Nama Mata Kuliah</option>
                    @foreach ($matakuliah as $mk)
                        <option value="{{ $mk->kode_mk }}">{{ $mk->nama_mk }}</option>
                    @endforeach
                </select>

                <!-- Pilih Hari -->
                <select id="hari" name="hari" required>
                    <option value="">Pilih Hari</option>
                    <option value="senin">Senin</option>
                    <option value="selasa">Selasa</option>
                    <option value="rabu">Rabu</option>
                    <option value="kamis">Kamis</option>
                    <option value="jumat">Jumat</option>
                </select>

                <!-- Jam Mulai dan Berakhir -->
                <div class="time-select">
                    <select id="jam_mulai" name="jam" required>
                        <option value="">Pilih Jam Mulai</option>
                        <option value="07:00">07:00</option>
                        <option value="09:00">09:00</option>
                        <option value="13:00">13:00</option>
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

                <label for="dosen">Pilih Dosen:</label>
                <select id="dosen-select">
                    <option value="">-- Pilih Dosen --</option>
                    @foreach($dosen as $dosen)
                        <option value="{{ $dosen->nidn_dosen }}">{{ $dosen->nama_dosen }}</option>
                    @endforeach
                </select>
                
                <div id="selected-dosen-list"></div>
                    <!-- Daftar dosen yang dipilih akan muncul di sini -->
                </div>
                <input type="hidden" name="nidn_dosen[]" value="id_dosen_terpilih">
                <div class="action-buttons">

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
            $('#programstudi').on('change', function() {
                var id_programstudi = $(this).val();
                if (id_programstudi) {
                    $.ajax({
                        url: '/getRuangan/' + id_programstudi,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#ruangan').empty();
                            $('#ruangan').append(
                                '<option value="">-- Pilih Ruangan --</option>');
                            $.each(data, function(key, value) {
                                $('#ruangan').append('<option value="' + value
                                    .kode_ruang + '">' + value.kode_ruang +
                                    '</option>');
                            });
                        }
                    });
                } else {
                    $('#ruangan').empty().append('<option value="">-- Pilih Ruangan --</option>');
                }
            });

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

              // Event saat dosen dipilih
              $(document).ready(function() {
                $('#dosen-select').on('change', function() {
        var dosenId = $(this).val(); // Mendapatkan nidn_dosen yang valid
        var dosenNama = $('#dosen-select option:selected').text(); // Mendapatkan nama dosen

        // Pastikan hanya nidn_dosen yang valid yang ditambahkan
        if (dosenId && dosenId !== "id_dosen_terpilih" && !$('#selected-dosen-list').find(`[data-dosen-id="${dosenId}"]`).length) {
            $('#selected-dosen-list').append(`
                <div class="selected-dosen-item" data-dosen-id="${dosenId}">
                    <span>${dosenNama}</span>
                    <span class="remove-dosen-btn" data-dosen-id="${dosenId}">&times;</span>
                    <input type="hidden" name="nidn_dosen[]" value="${dosenId}">
                </div>
            `);
        }
    });

    // Menghapus dosen yang dipilih
    $(document).on('click', '.remove-dosen-btn', function() {
        $(this).closest('.selected-dosen-item').remove();
    });

    // Sebelum mengirimkan form, hapus input hidden yang tidak valid
    $('form').submit(function() {
        $('input[type="hidden"][value="id_dosen_terpilih"]').remove();
    });
});

        });
    </script>
</body>

</html>
