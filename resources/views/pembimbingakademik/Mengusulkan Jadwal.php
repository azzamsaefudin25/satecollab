<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>SATE - Sistem Akademik Terpadu dan Efisien</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fff;
            
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
            color: black;
        }
        .header img {
            height: 60px;
            margin-right: 20px;
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
        .content {
            width: 80%;
            margin: 0 auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 15px;
            text-align: left;
        }
        th {
            background-color: #f5f5f5;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .actions {
            display: block;
            justify-content: space-between;
        }
        .actions a {
            padding: 10px 20px;
            border-radius: 25px;
            text-decoration: none;
            color: white;
            text-align: center;
            float:right;
            margin-left: 20px;

        }
        .back-button {
            position: fixed;
            bottom: 50px;
            left: 50px;
            }
        .green-btn {
            background-color: #3AC547;
        }
        .blue-btn {
            background-color: #327AFF;
        }
        footer {
            position: fixed;
            bottom: 10px;
            left: 20px;
        }
    </style>
</head>
<body>

<div class="header">
    <div>
        <img src="sate_logo.png" alt="SATE Logo">
        <h1>SATE <br><small>Sistem Akademik Terpadu Efisien</small></h1>
    </div>
</div>


    <div class="search-container">
        <input type="text" placeholder="CARI JADWAL PERKULIAHAN">
        <button>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0016 9.5 6.5 6.5 0 109.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C8.01 14 6 11.99 6 9.5S8.01 5 10.5 5 15 7.01 15 9.5 12.99 14 10.5 14z"/>
            </svg>
        </button>
    </div>

    <div class="content">
        <h2>Daftar Jadwal Perkuliahan</h2>
        <table>
            <tr>
                <th>No</th>
                <th>Mata Kuliah</th>
                <th>Ruang Kelas</th>
                <th>Kelas</th>
                <th>Dosen Pengampu</th>
                <th>Hari</th>
                <th>Jam Perkuliahan</th>
            </tr>
            <tr>
                <td>1</td>
                <td>Struktur Data</td>
                <td>E101</td>
                <td>A</td>
                <td>Sandy Kurniawan...</td>
                <td>Senin</td>
                <td>07.00 s/d 09.30</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Sistem Cerdas</td>
                <td>A303</td>
                <td>B</td>
                <td>Sandy Kurniawan...</td>
                <td>Selasa</td>
                <td>07.00 s/d 09.30</td>
            </tr>
        </table>

        <div class="actions">
            <a href="#" class="blue-btn">USULKAN JADWAL</a>
            <a href="#" class="green-btn">LIHAT RUANG PERKULIAHAN</a>
            
        </div>
    </div>

    <footer>
       <!-- Back Button -->
<a href="#" class="btn btn-dark back-button">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
      <path fill-rule="evenodd" d="M15 8a.5.5 0 0 1-.5.5H3.707l3.147 3.146a.5.5 0 0 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 0 1 .708.708L3.707 7.5H14.5A.5.5 0 0 1 15 8z"/>
    </svg>
    Back
  </a>
    </footer>

</body>
</html>
