//Verifikasi IRS


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
        
        .batalkan-btn {
            background-color: #0000FF;
            color: white;
            padding: 8px 20px;
            border: none;
            border-radius: 25px;
            font-family: Arial, sans-serif;
            font-size: 16px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            display: inline-block;
        }

        .batalkan-btn:hover {
            background-color: #0000DD;
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
            .button2 {
                background-color: #2c3ee1;
                color :#f1f1f1;
            } /* Blue */
            .button3 {background-color: #F4000F;} /* Red */
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
            <td><button class="button button2">Batalkan Persetujuan</button></td>
            <td><button class="button button1">Lihat</button></td>
        </tr>
        <tr>
            <td>2</td>
            <td>240601221....</td>
            <td>Muhammad</td>
            <td>2022</td>
            <td>2024/2025 Gasal/5</td>
            <td><span class="approved">Sudah Mengisi</span></td>
            <td><button class="button button2">Batalkan Persetujuan</button></td>
            <td><button class="button button1">Lihat</button></td>
        </tr>
        <tr>
            <td>3</td>
            <td>240601221....</td>
            <td>Abdul</td>
            <td>2021</td>
            <td>2024/2025 Gasal/7</td>
            <td><span class="not-approved">Belum Mengisi</span></td>
            <td><button class="button button1">Setuju</button> <button class="button button3">Tolak</button></div></td>
            <td><button class="button button1">Lihat</button></td>
        </tr>
        <tr>
            <td>4</td>
            <td>240601221....</td>
            <td>Bakir</td>
            <td>2023</td>
            <td>2024/2025 Gasal/3</td>
            <td><span class="approved">Sudah Mengisi</span></td>
            <td><button class="button button3">Ditolak</button></div></td>
            <td><button class="button button1">Lihat</button></td>
        </tr>
    </table>

    <!-- Back Button -->
    <div class="btn-container">
        <button type="button" class="btn btn-outline-secondary"
            onclick="window.location.href='{{ route('pembimbingakademik') }}'">←</button>
    </div>
</div>

  </a>
</div>

</body>
</html>
