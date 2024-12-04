@extends('layout.template_b')
<!-- START FORM -->
@section('content')
    <!-- Header -->
    <div class="container">
        <br>
        <h4>Penyusunan Ruang Perkuliahan</h4>

        <h5>Pengisian Data Ruangan: </h5>
        <br>

        <div class="form">
            <form action="{{ route('penyusunanruang.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="kode_ruang">Kode Ruang</label>
                    <input type="text" class="form-control" value="{{ old('kode_ruang', Session::get('kode_ruang')) }}"
                        id="kode_ruang" name="kode_ruang" placeholder="Masukkan Kode Ruang">
                </div>
                <div class="form-group">
                    <label for="gedung">Gedung</label>
                    <input type="text" class="form-control" value="{{ old('gedung', Session::get('gedung')) }}"
                        id="gedung" name="gedung" placeholder="Masukkan Nama Gedung">
                </div>
                <div class="form-group">
                    <label for="kapasitas">Kapasitas</label>
                    <input type="number" class="form-control" value="{{ old('kapasitas', Session::get('kapasitas')) }}"
                        id="kapasitas" name="kapasitas" placeholder="Masukkan Kapasitas">
                </div>

                <div class="btn-container">
                    <button type="button" class="btn btn-dark back-button"
                        onclick="window.location.href='{{ route('penyusunanruang.index') }}'"><svg
                            xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-arrow-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M15 8a.5.5 0 0 1-.5.5H3.707l3.147 3.146a.5.5 0 0 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 0 1 .708.708L3.707 7.5H14.5A.5.5 0 0 1 15 8z" />
                        </svg>
                        BACK
                    </button>
                    <div class="btn-right">
                        <button type="submit" class="btn btn-custom">SIMPAN</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
