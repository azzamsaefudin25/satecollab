@extends('layout.template')

@section('content')
    <div class="container mt-4">
        <h4 class="mb-4">Daftar Mata Kuliah</h4>

        <!-- Search Box -->
        <form action="{{ route('memilihmatakuliah.index') }}" method="GET" class="mb-3">
            <div class="input-group">
<<<<<<< HEAD
                <input type="text" name="search" class="form-control" 
                       placeholder="Cari Mata Kuliah (Kode, Nama, Semester, Prodi)..."  aria-label="Search"
                       value="{{ request('search') }}"> 
=======
                <input type="text" name="search" class="form-control"
                    placeholder="Cari Mata Kuliah (Kode, Nama, Semester, Prodi)..." value="{{ request('search') }}">
>>>>>>> main
                <button class="btn btn-primary" type="submit">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </form>

        <!-- Add Button -->
        <div class="pb-3">
            <a href="{{ route('memilihmatakuliah.create') }}" class="btn btn-primary"> + Tambah
                Mata Kuliah</a>
        </div>

        <!-- Table -->
        <div class="table-responsive mb-4">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Kode MK</th>
                        <th>Nama MK</th>
                        <th>Semester</th>
                        <th>SKS</th>
                        <th>Semester Aktif</th>
                        <th>Program Studi</th>
                        <th>Jenis</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($matakuliah as $mk)
                        <tr>
                            <td>{{ $mk->kode_mk }}</td>
                            <td>{{ $mk->nama_mk }}</td>
                            <td>{{ $mk->semester }}</td>
                            <td>{{ $mk->sks }}</td>
                            <td>{{ $mk->semester_aktif }}</td>
                            <td>
                                @if ($mk->programStudi)
                                    {{ $mk->programStudi->nama_programstudi }}
                                @else
                                    Tidak ada Prodi
                                @endif
                            </td>
                            <td>{{ $mk->jenis }}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('memilihmatakuliah.edit', $mk->kode_mk) }}"
                                        class="btn btn-warning btn-sm me-1">Edit</a>
                                    <form action="{{ route('memilihmatakuliah.destroy', $mk->kode_mk) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Apakah anda yakin?')">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">Tidak ada mata kuliah yang ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    Menampilkan {{ $matakuliah->firstItem() }} -
                    {{ $matakuliah->lastItem() }} dari
                    {{ $matakuliah->total() }} mata kuliah
                </div>
                <div>
                    {{ $matakuliah->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>

        <!-- Back Button -->
        <div class="text-start mt-4">
            <button type="button" class="btn btn-dark back-button"
                onclick="window.location.href='{{ route('ketuaprogramstudi') }}'">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M15 8a.5.5 0 0 1-.5.5H3.707l3.147 3.146a.5.5 0 0 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 0 1 .708.708L3.707 7.5H14.5A.5.5 0 0 1 15 8z" />
                </svg>
                BACK
            </button>
        </div>
    </div>
@endsection
