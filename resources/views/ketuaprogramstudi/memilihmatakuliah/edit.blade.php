@extends('layout.template_k')

@section('content')
    <div class="container mt-5">
        <div class="card shadow p-4" style="border-radius: 10px;">
            <h2 class="text-center mb-4">Penyusunan Mata Kuliah</h2>
            <h4 class="mb-3">Edit Mata Kuliah</h4>

            <form action="{{ route('memilihmatakuliah.update', $matakuliah->kode_mk) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="kode_mk" class="form-label">Kode Mata Kuliah</label>
                    <div class="col-sm-10">
                        {{ $matakuliah->kode_mk }}
                    </div>
                </div>

                <div class="mb-3">
                    <label for="nama_mk" class="form-label">Nama Mata Kuliah</label>
                    <input id="nama_mk" type="text" class="form-control" name="nama_mk"
                        value="{{ $matakuliah->nama_mk }}" required>
                </div>

                <div class="mb-3">
                    <label for="semester" class="form-label">Semester</label>
                    <input id="semester" type="number" class="form-control" name="semester"
                        value="{{ $matakuliah->semester }}" required>
                </div>

                <div class="mb-3">
                    <label for="sks" class="form-label">Jumlah SKS</label>
                    <input id="sks" type="number" class="form-control" name="sks" value="{{ $matakuliah->sks }}"
                        required>
                </div>

                <div class="mb-3">
                    <label for="semester_aktif" class="form-label">Semester Aktif</label>
                    <select id="semester_aktif" class="form-control" name="semester_aktif" required>
                        <option value="Ganjil" {{ $matakuliah->semester_aktif == 'Ganjil' ? 'selected' : '' }}>Ganjil
                        </option>
                        <option value="Genap" {{ $matakuliah->semester_aktif == 'Genap' ? 'selected' : '' }}>Genap</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="jenis" class="form-label">Jenis</label>
                    <select id="jenis" class="form-control" name="jenis" required>
                        <option value="Wajib" {{ $matakuliah->jenis == 'Wajib' ? 'selected' : '' }}>Wajib</option>
                        <option value="Pilihan" {{ $matakuliah->jenis == 'Pilihan' ? 'selected' : '' }}>Pilihan</option>
                    </select>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary px-4">Simpan</button>
                </div>
            </form>

            <div class="text-start mt-3">
                <button type="button" class="btn btn-dark back-button"
                    onclick="window.location.href='{{ route('memilihmatakuliah.index') }}'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-arrow-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M15 8a.5.5 0 0 1-.5.5H3.707l3.147 3.146a.5.5 0 0 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 0 1 .708.708L3.707 7.5H14.5A.5.5 0 0 1 15 8z" />
                    </svg>
                    BACK
                </button>
            </div>
        </div>
    </div>
@endsection
