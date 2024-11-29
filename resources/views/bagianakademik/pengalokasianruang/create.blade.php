@extends('layout.template')
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
                    <label for="id_programstudi">Kode Ruangan</label>
                    <select name="id_programstudi" class="form-control dropdown" id="id_programstudi">
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
                    <div class="row"> 
                        @foreach ($ruangPerkuliahan as $ruang)
                        {{-- /* Bagi menjadi 2 kolom */ --}}
                            <div class="col-md-4"> 
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="kode_ruang[]"
                                        value="{{ $ruang->kode_ruang }}" id="kode_ruang_{{ $ruang->kode_ruang }}"
                                        {{ in_array($ruang->kode_ruang, old('kode_ruang', Session::get('kode_ruang', [])) ?? []) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="kode_ruang_{{ $ruang->kode_ruang }}">
                                        {{ $ruang->kode_ruang }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="btn-container">
                    <button type="button" class="btn btn-dark back-button"
                        onclick="window.location.href='{{ route('pengalokasianruang.index') }}'">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-arrow-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M15 8a.5.5 0 0 1-.5.5H3.707l3.147 3.146a.5.5 0 0 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 0 1 .708.708L3.707 7.5H14.5A.5.5 0 0 1 15 8z" />
                        </svg>
                        BACK
                    </button>

                    <div class="btn-right">
                        <button type="submit" class="btn btn-custom">AJUKAN</button>
                    </div>
                </div>
            </form>
        </div>

        </div>
    </div>
@endsection