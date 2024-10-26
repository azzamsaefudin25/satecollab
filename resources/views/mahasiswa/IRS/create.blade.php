<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Akademik</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f8f8;
        }

        header {
            background-color: #5d7630;
            color: white;
            padding: 10px 20px;
            text-align: left;
            display: flex;
            align-items: center;
        }

        header img {
            width: 60px;
            margin-right: 20px;
        }

        header h1 {
            font-size: 24px;
            margin: 0;
        }

        #sidebar {
            width: 250px;
            background-color: #d0d0d0;
            padding: 20px;
            float: left;
            height: 100vh;
        }

        #sidebar h2 {
            font-size: 18px;
            margin-top: 0;
        }

        .dropdown {
            margin-bottom: 20px;
        }

        .dropdown select {
            width: 100%;
            padding: 8px;
            margin-top: 10px;
        }

        .dropdown input {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 10px;
        }

        .dropdown .list {
            background-color: white;
            border: 1px solid #ccc;
            padding: 10px;
            max-height: 200px;
            overflow-y: auto;
        }

        .dropdown .list div {
            padding: 5px;
            margin-bottom: 5px;
            border: 1px solid #ccc;
            background-color: #f4f4f4;
        }

        #content {
            margin-left: 270px;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #f4f4f4;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table tr:nth-child(odd) {
            background-color: white;
        }

        .btn-container {
            margin-top: 20px;
            text-align: right;
        }

        .btn-container button {
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }

        .btn-primary {
            background-color: #0033cc;
            color: white;
        }

        .btn-success {
            background-color: #00cc00;
            color: white;
        }

        #profile {
            text-align: center;
            margin-top: 30px;
        }

        #profile img {
            width: 50px;
            margin-bottom: 10px;
        }

        #profile h3 {
            margin: 0;
            font-size: 16px;
        }

        #profile h4 {
            margin: 0;
            font-size: 14px;
            color: gray;
        }
    </style>
</head>
<!-- Tambahkan link ke Select2 CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

<!-- Tambahkan jQuery (jika belum ada) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Tambahkan link ke Select2 JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<body>

<header>
    <img src="logo.png" alt="SATE Logo">
    <h1>SISTEM AKADEMIK TERPADU EFISIEN</h1>
</header>

<div id="sidebar">
    <h2>Tambahkan Jadwal Perkuliahan</h2>

    <div class="dropdown">
        <label for="matkul">Daftar Mata Kuliah</label>
        <select id="matkul" class="form-control">
            <option value="">-- Pilih Mata Kuliah --</option>
        </select>
    </div>
    

    <div id="profile">
        <img src="profile.png" alt="Profile">
        <h3>King Azzam</h3>
        <h4>Informatika SI</h4>
    </div>
</div>



    <div class="btn-container">
        <button class="btn-primary">AJUKAN</button>
        <button class="btn-success">LIHAT</button>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#matkul').select2({
            placeholder: 'Pilih Mata Kuliah',
            allowClear: true,
            ajax: {
                url: "{{ route('search.Mahasiswa') }}",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return { query: params.term };
                },
                processResults: function(data) {
                    return { results: data.results };
                },
                cache: true
            }
        });
    });
    </script>
    
</body>
</html>
