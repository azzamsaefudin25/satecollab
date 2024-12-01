@extends('layout.template_d')
<!-- START FORM -->
@section('content')
    <!-- Header -->

    <div class="container mt-4">
        <div class="table-container">
            <h4 class="mt-4">Daftar Pengajuan Jadwal Kuliah</h4>

            <form action="{{ route('dekan.approvejadwal') }}" method="GET">
                <div class="search-box d-flex justify-content-between align-items-center">
                    <input name="search" type="search" class="form-control me-2" placeholder="CARI PENGAJUAN JADWAL"
                        aria-label="Search" value="{{ request('search') }}">
                    <button class="btn" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                    <button class="capacity-btn">
                        <i class="bi bi-plus-minus"></i>
                    </button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Kode Mata Kuliah</th>
                            <th>Nama Mata Kuliah</th>
                            <th>Kode Ruang</th>
                            <th>Nama Kelas</th>
                            <th>Semester</th>
                            <th>Sks</th>
                            <th>Jenis</th>
                            <th>Semester Aktif</th>
                            <th>Tahun Ajaran</th>
                            <th>Hari</th>
                            <th>Jam Mulai</th>
                            <th>Jam Selesai</th>
                            {{-- <th>Nama Dosen Pengampu</th> --}}
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = $pengajuans_jadwal->firstItem(); ?>
                        @foreach ($pengajuans_jadwal as $pengajuan)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $pengajuan->kode_mk }}</td>
                                <td>{{ $pengajuan->mataKuliah->nama_mk ?? 'mata kuliah tidak ditemukan' }}</td>
                                <td>{{ $pengajuan->kode_ruang }}</td>
                                <td>{{ $pengajuan->nama_kelas }}</td>
                                <td>{{ $pengajuan->mataKuliah->semester ?? 'N/A' }}</td>
                                <td>{{ $pengajuan->mataKuliah->sks ?? 'N/A' }}</td>
                                <td>{{ $pengajuan->mataKuliah->jenis ?? 'N/A' }}</td>
                                <td>{{ $pengajuan->mataKuliah->semester_aktif ?? 'N/A' }}</td>
                                <td>{{ $pengajuan->tahun_ajaran }}</td>
                                <td>{{ $pengajuan->hari }}</td>
                                <td>{{ $pengajuan->jam_mulai }}</td>
                                <td>{{ $pengajuan->jam_selesai }}</td>
                                <!-- Menampilkan daftar dosen pengampu -->
                                {{-- <td>
                                    <ol>
                                        @if ($pengajuan->dosen1)
                                            <li>{{ $pengajuan->dosen1->dosen->nama_dosen }}</li>
                                        @endif
                                        @if ($pengajuan->dosen2)
                                            <li>{{ $pengajuan->dosen2->dosen->nama_dosen }}</li>
                                        @endif
                                        @if ($pengajuan->dosen3)
                                            <li>{{ $pengajuan->dosen3->dosen->nama_dosen }}</li>
                                        @endif
                                        @if ($pengajuan->dosen4)
                                            <li>{{ $pengajuan->dosen4->dosen->nama_dosen }}</li>
                                        @endif
                                        @if ($pengajuan->dosen5)
                                            <li>{{ $pengajuan->dosen5->dosen->nama_dosen }}</li>
                                        @endif
                                    </ol>
                                </td> --}}

                                <td>
                                    @if ($pengajuan->status === 'disetujui')
                                        <span class="text-success">Disetujui</span>
                                    @else
                                        <span class="text-warning">Menunggu Konfirmasi</span>
                                    @endif
                                </td>
                            </tr>
                            <?php $i++; ?>
                        @endforeach
                        @if ($pengajuans_jadwal->isEmpty())
                            <tr>
                                <td colspan="20" class="text-center">Tidak ada pengajuan jadwal kuliah.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $pengajuans_jadwal->withQueryString()->links() }}
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
            <div class="btn-right">
                @if ($pengajuan->status === 'menunggu konfirmasi')
                    <form action="{{ route('pengajuan.updatejadwal', $pengajuan->id_jadwal) }}" method="POST"
                        class="d-inline">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="action" value="setuju">
                        <button type="submit" class="btn btn-success me-2">SETUJU</button>
                    </form>
                @endif
                @if ($pengajuan->status === 'disetujui' || $pengajuan->status === 'ditolak')
                    <form action="{{ route('pengajuan.updatejadwal', $pengajuan->id_jadwal) }}" method="POST"
                        class="d-inline">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="action" value="ubah">
                        <button type="submit" class="btn btn-warning">BATALKAN PERSETUJUAN</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
