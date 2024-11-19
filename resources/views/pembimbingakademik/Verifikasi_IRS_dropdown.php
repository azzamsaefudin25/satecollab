<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
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
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
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
            .button1 {background-color: #14F400;} /* Green */
            .button2 {background-color: #0014CB;} /* Blue */
            .button3 {background-color: #218838;} /* Red */
    </style>
</head>
<body>

<div class="header">
    <div>
        <img src="sate_logo.png" alt="SATE Logo">
        <h1>SATE <br><small>Sistem Akademik Terpadu Efisien</small></h1>
    </div>
</div>

<div class="container">
    <div class="content">
        <h2>VERIFIKASI IRS</h2>

    <div class="statistik">
    <section>
    <span><h5><b>Statistik Mahasiswa</b><br></h5>Informasi selengkapnya mengenai statistik mahasiswa  seperti mahasiswa aktif,  mahasiswa yang telah mengisi IRS, dan mahasiswa yang menunggu verifikasi.</span></section>
        <div>Mahasiswa Aktif<br><b>4</b></div>
        <div>Mahasiswa Yang Sudah Diverifikasi<br><b>2</b></div>
        <div>Mahasiswa Yang Sudah Mengisi IRS<br><b>3</b></div>
    </div>

    <div class="search-container">
        <input type="text" placeholder="CARI MAHASISWA">
        <button>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0016 9.5 6.5 6.5 0 109.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C8.01 14 6 11.99 6 9.5S8.01 5 10.5 5 15 7.01 15 9.5 12.99 14 10.5 14z"/>
            </svg>
        </button>
    </div>

    <table>
        <tr>
            <th>No</th>
            <th>NIM</th>
            <th>Nama</th>
            <th>Angkatan</th>
            <th>Tahun Akademik</th>
            <th>Status Pengisian IRS</th>
            <th>Aksi</th>
            <th></th>
        </tr>
        <tr>
            <td>1</td>
            <td>24060122130076</td>
            <td>Azzam Saefudin Rosyidi</td>
            <td>2022</td>
            <td>2024/2025 Gasal/5</td>
            <td><span class="approved">Sudah Mengisi</span></td>
            <td><button class="button button1">Lihat</button></div></td>
            <td><button class="button button1">Lihat</button></td>
        </tr>
        <tr>
            <td>2</td>
            <td>240601221....</td>
            <td>Muhammad</td>
            <td>2022</td>
            <td>2024/2025 Gasal/5</td>
            <td><span class="approved">Sudah Mengisi</span></td>
            <td><button class="button button1">Lihat</button></div></td>
            <td><button class="button button1">Lihat</button></td>
        </tr>
        <tr>
            <td>3</td>
            <td>240601221....</td>
            <td>Abdul</td>
            <td>2021</td>
            <td>2024/2025 Gasal/7</td>
            <td><span class="not-approved">Belum Mengisi</span></td>
            <td><button class="button button1">Lihat</button></div></td>
            <td><button class="button button1">Lihat</button></td>
        </tr>
        <tr>
            <td>4</td>
            <td>240601221....</td>
            <td>Bakir</td>
            <td>2023</td>
            <td>2024/2025 Gasal/3</td>
            <td><span class="approved">Sudah Mengisi</span></td>
            <td><button class="button button1">Lihat</button></div></td>
            <td><button class="button button1">Lihat</button></td>
        </tr>
    </table>

    <!-- Back Button -->
<a href="#" class="btn btn-dark back-button">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
      <path fill-rule="evenodd" d="M15 8a.5.5 0 0 1-.5.5H3.707l3.147 3.146a.5.5 0 0 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 0 1 .708.708L3.707 7.5H14.5A.5.5 0 0 1 15 8z"/>
    </svg>
    Back
  </a>
</div>

</body>
</html>
