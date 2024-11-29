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
            <h4 class="mt-4">Daftar Alokasi Ruang Perkuliahan</h4>

            <div class="pb-3">
                <button onclick="window.location.href='{{ route('pengalokasianruang.create') }}'" class="btn btn-primary">+
                    Tambah
                    Data</button>
            </div>

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Ruang Kuliah</th>
                        <th>Nama Program Studi</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = $alokasiRuang->firstItem(); ?>
                    @foreach ($alokasiRuang as $alokasi)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $alokasi->kode_ruang }}</td>
                            <td>{{ $alokasi->programStudi->nama_programstudi }}</td>
                            <td>
                                @if ($alokasi->status === 'disetujui')
                                    <span class="text-success">Disetujui</span>
                                @elseif ($alokasi->status === 'ditolak')
                                    <span class="text-danger">Ditolak</span>
                                @else
                                    <span class="text-warning">Menunggu Konfirmasi</span>
                                @endif
                            </td>
                        </tr>
                        <?php $i++; ?>
                    @endforeach
                </tbody>
            </table>
            {{ $alokasiRuang->withQueryString()->links() }}
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
    </div>
@endsection
