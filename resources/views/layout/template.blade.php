<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SATE - Sistem Akademik Terpadu dan Efisien</title>
    <!-- Bootstrap CSS -->
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
            display: flex;
            background-color: #658345;
            color: black;
            padding: 30px;
            text-align: left;
            display: flex;
            align-items: center;
        }

        header img {
            height: 60px;
            margin-right: 20px;
        }

        .header h1 {
            margin: 0;
        }

        h1 {
            margin: 0;
            font-size: 30px;
            margin-right: 70px;
            font-weight: bold;
        }

        h2 {
            margin: 0;
            font-size: 25px;
            font-weight: 600;
            margin-right: 70px;
        }

        .container {
            margin-top: 30px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 20px;
        }

        h4 {
            text-align: center;
            font-size: 23px;
            font-weight: 600;
        }

        h5 {
            margin-top: 30px;
        }

        .search-box {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
        }

        .search-box input {
            border-radius: 5px;
        }

        .search-box button {
            background-color: #ffffff;
            border: 1px solid #ced4da;
            border-radius: 5px;
            padding: 6px 12px;
        }

        .search-box i {
            color: #6c757d;
        }

        .table-container {
            margin-top: 20px;
        }

        .table thead {
            background-color: #343a40;
            color: white;
        }

        .back-btn {
            position: absolute;
            bottom: 20px;
            left: 20px;
            font-size: 24px;
            color: #5e2d91;
        }

        .capacity-btn {
            background-color: white;
            border: 1px solid #ced4da;
            border-radius: 5px;
            padding: 5px;
            color: #6c757d;
            display: inline-block;
            text-align: center;
        }

        .btn-custom {
            background-color: #007bff;
            /* Warna biru */
            color: white;
            border-radius: 8px;
            /* Border radius untuk memperhalus tombol */
            margin-right: 10px;
            /* Jarak antara tombol SIMPAN dan LIHAT */
        }

        .btn-custom-secondary {
            background-color: #28a745;
            /* Warna hijau */
            color: white;
            border-radius: 8px;
        }

        .btn-custom:hover {
            background-color: #0056b3;
        }

        .btn-custom-secondary:hover {
            background-color: #218838;
        }

        .btn-outline-secondary {
            border-radius: 8px;
        }

        .btn-container {
            display: flex;
            justify-content: space-between;
            /* Tombol Back di kiri, SIMPAN dan LIHAT di kanan */
            margin-bottom: 20px;
            /* Jarak keseluruhan di bawah tombol */
        }

        .btn-right {
            display: flex;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="sate_logo.png" alt="SATE Logo">
        <div>
            <h1>SATE</h1>
            <h2>Sistem Akademik Terpadu Efisien</h2>
        </div>
    </div>

    <div class="container">
        @include('komponen.pesan')
        @yield('content')
    </div>

    <!-- Bootstrap JS & Icons -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>
