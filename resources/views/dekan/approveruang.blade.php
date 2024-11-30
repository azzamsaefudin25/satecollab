@extends('layout.template')
<!-- START FORM -->
@section('content')
    <!-- Header -->

    <div class="container mt-4">

        <div class="table-container">
            <h4 class="mt-4">Daftar Alokasi Ruang Perkuliahan</h4>

            <div class="search-box">
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Cari Alokasi Ruang Perkuliahan"
                        aria-label="Search">
                    <button class="btn btn-outline-secondary" type="submit">
                        <i class="bi bi-search"></i> <!-- Bootstrap Icons -->
                    </button>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Kode Ruang</th>
                            <th>Nama Program Studi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = $pengajuans_ruang->firstItem(); ?>
                        @foreach ($pengajuans_ruang as $pengajuanruang)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $pengajuanruang->kode_ruang }}</td>
                                <td>{{ $pengajuanruang->programStudi->nama_programstudi ?? 'Program studi tidak ditemukan' }}
                                </td>
                                <td>
                                    @if ($pengajuanruang->status === 'disetujui')
                                        <span class="text-success">Disetujui</span>
                                    @elseif ($pengajuanruang->status === 'ditolak')
                                        <span class="text-danger">Ditolak</span>
                                    @else
                                        <form action="{{ route('pengajuan.updateruang', $pengajuanruang->id) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="_method" value="PATCH">
                                            <input type="hidden" name="action" value="setuju">
                                            <button type="submit" class="btn btn-success btn-sm">Setuju</button>
                                        </form>
                                        <form action="{{ route('pengajuan.updateruang', $pengajuanruang->id) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="_method" value="PATCH">
                                            <input type="hidden" name="action" value="tolak">
                                            <button type="submit" class="btn btn-danger btn-sm">Tolak</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                            <?php $i++; ?>
                        @endforeach
                        @if ($pengajuans_ruang->isEmpty())
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada pengajuan alokasi ruang.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                {{ $pengajuans_ruang->withQueryString()->links() }}
            </div>
        </div>
        <div class="btn-container">
            <button type="button" class="btn btn-dark back-button" onclick="window.location.href='{{ route('dekan') }}'">
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
