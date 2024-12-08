@extends('layout.template_d')
@section('content')
    <div class="container mt-4">
        <div class="table-container">
            <h4 class="mt-4">Daftar Pengajuan Alokasi Ruangan</h4>

            <form action="{{ route('dekan.approveruang') }}" method="GET">
                <div class="search-box d-flex justify-content-between align-items-center">
                    <input name="search" type="search" class="form-control me-2" placeholder="CARI PENGAJUAN RUANG"
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
                            <th>Kode Ruang</th>
                            <th>Nama Program Studi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = $pengajuans_ruang->firstItem(); ?>
                        @foreach ($pengajuans_ruang as $pengajuan)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $pengajuan->kode_ruang }}</td>
                                <td>{{ $pengajuan->programStudi->nama_programstudi ?? 'Program studi tidak ditemukan' }}
                                </td>
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

            <!-- Modal for Setuju Per Prodi -->
            <div class="modal fade" id="approvalModal" tabindex="-1" aria-labelledby="approvalModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <form action="{{ route('pengajuan.updateruangperprodi', $pengajuans_ruang->first()?->id ?? 0) }}"
                        method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="approvalModalLabel">Pengaturan Persetujuan Ruang Per Prodi</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="programStudi" class="form-label">Pilih Program Studi:</label>
                                    <select name="id_programstudi" id="programStudi" class="form-select">
                                        @foreach ($prodis as $prodi)
                                            <option value="{{ $prodi->id_programstudi }}">{{ $prodi->nama_programstudi }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label d-block">Pilih Aksi:</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="action" id="setujuAction"
                                            value="setuju2" required>
                                        <label class="form-check-label" for="setujuAction">
                                            Setujui Pengajuan
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="action" id="batalkanAction"
                                            value="ubah2" required>
                                        <label class="form-check-label" for="batalkanAction">
                                            Batalkan Persetujuan
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary"
                                    data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-outline-primary">Simpan Perubahan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <button data-bs-toggle="modal" data-bs-target="#approvalModal" class="btn btn-primary">
                ATUR PERSETUJUAN
            </button>

            <div class="btn-right">
                @if ($pengajuans_ruang->isNotEmpty())
                    @php
                        $firstPengajuan = $pengajuans_ruang->first();
                    @endphp
                    @if ($firstPengajuan->status === 'menunggu konfirmasi')
                        <form action="{{ route('pengajuan.updateruang', $firstPengajuan->id) }}" method="POST"
                            class="d-inline">
                            @csrf
                            <input type="hidden" name="_method" value="PATCH">
                            <input type="hidden" name="action" value="setuju">
                            <button type="submit" class="btn btn-success me-2">SETUJUI</button>
                        </form>
                    @endif
                    @if ($firstPengajuan->status === 'disetujui')
                        <form action="{{ route('pengajuan.updateruang', $firstPengajuan->id) }}" method="POST"
                            class="d-inline">
                            @csrf
                            <input type="hidden" name="_method" value="PATCH">
                            <input type="hidden" name="action" value="ubah">
                            <button type="submit" class="btn btn-warning">BATALKAN PERSETUJUAN</button>
                        </form>
                    @endif
                @endif
            </div>
        </div>
    </div>
@endsection
