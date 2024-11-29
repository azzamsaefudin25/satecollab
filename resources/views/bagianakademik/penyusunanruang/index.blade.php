@extends('layout.template')
<!-- START FORM -->
@section('content')
    <!-- Header -->

    <!-- Container -->
    <div class="container mt-4">
        <!-- Search Box -->
        <div class="search-box d-flex justify-content-between align-items-center">
            <input type="text" class="form-control me-2" placeholder="CARI RUANG PERKULIAHAN" aria-label="Search">
            <button class="btn">
                <i class="bi bi-search"></i>
            </button>
            <button class="capacity-btn">
                <i class="bi bi-plus-minus"></i>
            </button>
        </div>

        <!-- Table -->
        <div class="table-container">
            <h4 class="mt-4">Daftar Ruang Perkuliahan</h4>

            <div class="pb-3">
                <a onclick="window.location.href='{{ route('penyusunanruang.create') }}'" class="btn btn-primary">+ Tambah
                    Data</a>
            </div>

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Ruang Kuliah</th>
                        <th>Gedung</th>
                        <th>Kapasitas Ruangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = $ruangPerkuliahan->firstItem(); ?>
                    @foreach ($ruangPerkuliahan as $ruang)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $ruang->kode_ruang }}</td>
                            <td>{{ $ruang->gedung }}</td>
                            <td>{{ $ruang->kapasitas }} Mahasiswa</td>
                            <td>
                                <!-- Tombol Edit -->
                                <a href="{{ route('penyusunanruang.edit', $ruang->kode_ruang) }}"
                                    class="btn btn-warning">EDIT</a>

                                <!-- Tombol Hapus -->
                                <form action="{{ route('penyusunanruang.destroy', $ruang->kode_ruang) }}" method="POST"
                                    style="display:inline-block;" onsubmit="return confirm('Yakin akan menghapus data?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">HAPUS</button>
                                </form>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    @endforeach
                </tbody>
            </table>
            {{ $ruangPerkuliahan->withQueryString()->links() }}
        </div>

    </div>
    <div class="btn-container">
        <button type="button" class="btn btn-dark back-button"
            onclick="window.location.href='{{ route('bagianakademik') }}'">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-arrow-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M15 8a.5.5 0 0 1-.5.5H3.707l3.147 3.146a.5.5 0 0 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 0 1 .708.708L3.707 7.5H14.5A.5.5 0 0 1 15 8z" />
            </svg>
            BACK
        </button>
    </div>
@endsection
