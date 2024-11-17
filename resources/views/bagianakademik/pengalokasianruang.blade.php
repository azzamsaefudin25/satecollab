@extends('layout.template')
<!-- START FORM -->
@section('content')
    <div class="container">
        <br>
        <h4>Penyusunan Alokasi Ruang Perkuliahan</h4>

        <h5>Pengisian Data Alokasi Ruangan: </h5>
        <br>

        <div class="form">
            <form action="{{ route('pengalokasianruang.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="id_programstudi">Program Studi</label>
                    <select name="id_programstudi" class="form-control" id="id_programstudi">
                        <option value="">Pilih Program Studi</option>
                        @foreach ($programStudi as $prodi)
                            <option value="{{ $prodi->id_programstudi }}"
                                {{ old('id_programstudi', Session::get('id_programstudi')) == $prodi->id_programstudi ? 'selected' : '' }}>
                                {{ $prodi->nama_programstudi }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="kode_ruang">Kode Ruang</label>
                    <div id="kode_ruang">
                        @foreach ($ruangPerkuliahan as $ruang)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="kode_ruang[]"
                                    value="{{ $ruang->kode_ruang }}" id="kode_ruang_{{ $ruang->kode_ruang }}"
                                    {{ in_array($ruang->kode_ruang, old('kode_ruang', Session::get('kode_ruang', [])) ?? []) ? 'checked' : '' }}
                                    <label class="form-check-label"
                                    for="kode_ruang_{{ $ruang->kode_ruang }}">{{ $ruang->kode_ruang }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- Menggunakan div container untuk tombol -->
                <div class="btn-container">
                    <!-- Tombol back di sebelah kiri -->
                    <button type="button" class="btn btn-outline-secondary"
                        onclick="window.location.href='{{ route('bagianakademik') }}'">←</button>

                    <!-- Tombol simpan dan lihat di sebelah kanan -->
                    <div class="btn-right">
                        <button type="submit" class="btn btn-custom">AJUKAN</button>
                        <button type="button" class="btn btn-custom-secondary"
                            onclick="window.location.href='{{ route('pengalokasianruang.lihat') }}'">LIHAT</button>

                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
