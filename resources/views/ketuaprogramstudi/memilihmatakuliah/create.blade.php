@extends('layout.template')
<!-- START FORM -->
@section('content')
    <div class="container">
        <br>
        <h4>Penyusunan Mata Kuliah</h4>

        <h5>Pengisian Data Mata Kuliah: </h5>
        <br>
        <div class="form">
            <form id="matkulForm" action="{{ route('memilihmatakuliah.store') }}" method="POST">
                @csrf <!-- Token CSRF untuk keamanan -->

                <input type="hidden" name="id_programstudi" value="{{ $programStudi->id_programstudi }}">

                <div class="form-group">
                    <label>Program Studi</label>
                    <input type="text" class="form-control" value="{{ $programStudi->nama_programstudi }}" readonly>
                </div>

                <div class="form-group">
                    <label for="kode_mk">Kode Mata Kuliah</label>
                    <input id="kode_mk" class="form-control" type="text" name="kode_mk"
                        placeholder="Masukkan kode mata kuliah" required>
                </div>

                <div class="form-group">
                    <label for="nama_mk">Nama Mata Kuliah</label>
                    <input id="nama_mk" type="text" class="form-control" name="nama_mk"
                        placeholder="Masukkan nama mata kuliah" required>
                </div>

                <div class="form-group">
                    <label for="semester">Semester</label>
                    <input id="semester" type="number" class="form-control" name="semester"
                        placeholder="Masukkan semester (1-9)" required>
                    <small id="semesterError" class="text-danger" style="display:none;">Semester harus di antara 1-9.</small>
                </div>

                <div class="form-group">
                    <label for="sks">Jumlah SKS</label>
                    <input id="sks" type="number" name="sks" class="form-control"
                        placeholder="Masukkan jumlah SKS (1-9)" required>
                    <small id="sksError" class="text-danger" style="display:none;">SKS harus di antara 1-9.</small>
                </div>

                <input type="hidden" id="semester_aktif" name="semester_aktif" value="">

                <div class="form-group">
                    <label for="jenis">Jenis</label>
                    <select class="form-control" id="jenis" name="jenis" required>
                        <option value="">Pilih jenis Mata kuliah</option>
                        <option value="Wajib">Wajib</option>
                        <option value="Pilihan">Pilihan</option>
                    </select>
                </div>
                
    
                <div class="btn-container">
                    <button type="button" class="btn btn-dark back-button"
                    onclick="window.location.href='{{ route('memilihmatakuliah.index') }}'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-arrow-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M15 8a.5.5 0 0 1-.5.5H3.707l3.147 3.146a.5.5 0 0 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 0 1 .708.708L3.707 7.5H14.5A.5.5 0 0 1 15 8z" />
                    </svg>
                    BACK
                </button>
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

@section('scripts')
    <script>
        const form = document.getElementById('matkulForm');
        const semesterInput = document.getElementById('semester');
        const sksInput = document.getElementById('sks');
        const semesterError = document.getElementById('semesterError');
        const sksError = document.getElementById('sksError');
        const semesterAktif = document.getElementById('semester_aktif');

        function validateInput(input, errorElement) {
            const value = parseInt(input.value);
            if (value >= 1 && value <= 9) {
                errorElement.style.display = 'none';
                return true;
            } else {
                errorElement.style.display = 'block';
                return false;
            }
        }

        semesterInput.addEventListener('input', function () {
            if (validateInput(semesterInput, semesterError)) {
                semesterAktif.value = semesterInput.value % 2 === 0 ? 'Genap' : 'Ganjil';
            } else {
                semesterAktif.value = '';
            }
        });

        sksInput.addEventListener('input', function () {
            validateInput(sksInput, sksError);
        });

        form.addEventListener('submit', function (event) {
            const isSemesterValid = validateInput(semesterInput, semesterError);
            const isSksValid = validateInput(sksInput, sksError);

            if (!isSemesterValid || !isSksValid) {
                event.preventDefault(); // Mencegah form submit jika ada error
            }
        });
    </script>
@endsection
