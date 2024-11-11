@extends('layout.template')
<!-- START FORM -->
@section('content')

    <div class="container">
        <br>
        <h4>Penyusunan Mata Kuliah</h4>

        <h5>Pengisian Data Mata Kuliah: </h5>
        <br>
        <div class="form">
            <form action="{{ route('memilihmatakuliah.store') }}" method="POST">
                @csrf <!-- Token CSRF untuk keamanan -->
                <div class="form-group">
                    <label for="kode_mk">Kode Mata Kuliah</label>
                    <input id="kode_mk" class="form-control" type="text" name="kode_mk"
                        placeholder="Masukkan kode mata kuliah" required>
                </div>

                <div class="form-group">
                    <label for="nama_mk">Nama Mata Kuliah</label>
                    <input id="nama_mk" type="text" class="form-control" name="nama_mk"
                        placeholder="Masukkan nama mata kuliah" req uired>
                </div>

                <div class="form-group">
                    <label for="semester">Semester</label>
                    <input id="semester" type="number" class="form-control" name="semester"
                        placeholder="Masukkan semester" required>
                </div>

                <div class="form-group">
                    <label for="sks">Jumlah SKS</label>
                    <input id="sks" type="number" name="sks" class="form-control"
                        placeholder="Masukkan jumlah SKS" required>
                </div>

                <div class="form-group">
                    <label for="semester_aktif">Semester Aktif</label>
                    <select class="form-control" id="semester_aktif" name="semester_aktif" required>
                        <option value="">Pilih Semester Aktif</option>
                        <option value="Ganjil">Ganjil</option>
                        <option value="Genap">Genap</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="jenis">Jenis</label>
                    <select class="form-control" id="jenis" name="jenis" required>
                        <option value="">Pilih jenis Mata kuliah</option>
                        <option value="Wajib">Wajib</option>
                        <option value="Pilihan">Pilihan</option>
                    </select>
                </div>

                <div class="btn-container">
                    <button type="button" class="btn btn-outline-secondary"
                        onclick="window.location.href='{{ route('ketuaprogramstudi') }}'">←</button>
                    <div class="btn-right">
                        <button type="submit" class="btn btn-custom">SIMPAN</button>
                        <button type="button" class="btn btn-custom-secondary"
                            onclick="window.location.href='{{ route('memilihmatakuliah.index') }}'">LIHAT</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
