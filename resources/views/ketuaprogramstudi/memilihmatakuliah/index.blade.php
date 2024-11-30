@extends('layout.template')

@section('content')
    <div class="container mt-4">
        <h4 class="mb-4">Daftar Mata Kuliah</h4>

        <!-- Search Box -->
        <form action="{{ route('memilihmatakuliah.index') }}" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" 
                       placeholder="Cari Mata Kuliah (Kode, Nama, Semester, Prodi)..." 
                       value="{{ request('search') }}">
                <button class="btn btn-primary" type="submit">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </form>

        <!-- Add Button -->
        <div class="pb-3">
            <a href="{{ route('memilihmatakuliah.create') }}" class="btn btn-primary">
                Tambah Mata Kuliah
            </a>
        </div>

        <!-- Table -->
        <div class="table-responsive mb-4">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Kode MK</th>
                        <th>Nama MK</th>
                        <th>Semester</th>
                        <th>SKS</th>
                        <th>Semester Aktif</th>
                        <th>Jenis</th>
                        <th>Program Studi</th>
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
                            <td>{{ $mk->jenis }}</td>
                            <td>
                                @if($mk->programStudi)
                                    {{ $mk->programStudi->nama_programstudi }}
                                @else
                                    Tidak ada Prodi
                                @endif
                            </td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('memilihmatakuliah.edit', $mk->kode_mk) }}" 
                                       class="btn btn-warning btn-sm me-1">Edit</a>
                                    <form action="{{ route('memilihmatakuliah.destroy', $mk->kode_mk) }}" 
                                          method="POST" class="d-inline">
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
                            <td colspan="8" class="text-center">Tidak ada mata kuliah ditemukan.</td>
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
            <a href="{{ route('ketuaprogramstudi') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
@endsection