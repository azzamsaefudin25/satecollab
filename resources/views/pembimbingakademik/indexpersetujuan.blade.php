@extends('layout.template_p')
@section('content')
    <h2>Detail IRS Mahasiswa: {{ $mahasiswa->nama_mahasiswa ?? 'N/A' }}</h2>
    <div class="content">
        <table class="table">
            <thead>
                <tr>
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
                    <th>Status</th>
                    <th>Status Approve</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($irs as $item)
                    <tr>
                        <td>{{ $item->kode_mk ?? '-' }}</td>
                        <td>{{ $item->jadwalkuliah->mataKuliah->nama_mk ?? '-' }}</td>
                        <td>{{ $item->kode_ruang ?? '-' }}</td>
                        <td>{{ $item->nama_kelas ?? '-' }}</td>
                        <td>{{ $item->jadwalKuliah->semester ?? '-' }}</td>
                        <td>{{ $item->sks ?? '-' }}</td>
                        <td>{{ $item->jadwalKuliah->jenis ?? '-' }}</td>
                        <td>{{ $item->jadwalKuliah->semester_aktif ?? '-' }}</td>
                        <td>{{ $item->jadwalKuliah->tahun_ajaran ?? '-' }}</td>
                        <td>{{ $item->hari ?? '-' }}</td>
                        <td>{{ $item->jam_mulai ?? '-' }}</td>
                        <td>{{ $item->jam_selesai ?? '-' }}</td>
                        <td>{{ $item->status ?? '-' }}</td>
                        <td>
                            @if ($item->status_approve == 'disetujui')
                                <span class="approved">{{ $item->status_approve }}</span>
                            @elseif ($item->status_approve == 'menunggu konfirmasi')
                                <span class="not-approved">{{ $item->status_approve }}</span>
                            @else
                                {{ $item->status_approve ?? '-' }}
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Data IRS tidak tersedia</td>
                    </tr>
                @endforelse
            </tbody>
        </table>


    </div>

    <div class="d-flex justify-content-between align-items-center mt-4">
        <!-- Back Button -->
        <a onclick="window.location.href='{{ route('pembimbingakademik.indexmahasiswa') }}'" class="btn btn-dark back-button">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-arrow-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M15 8a.5.5 0 0 1-.5.5H3.707l3.147 3.146a.5.5 0 0 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 0 1 .708.708L3.707 7.5H14.5A.5.5 0 0 1 15 8z" />
            </svg>
            BACK
        </a>
        <!-- Approval Buttons -->
        <div>
            <a href="{{ route('irs2.download', ['nim' => $mahasiswa->nim])}}" class="btn btn-primary btn-lg">Unduh IRS</a>
            {{-- Tombol "Setuju" jika ada IRS yang menunggu konfirmasi --}}
            @if ($irs->contains('status_approve', 'menunggu konfirmasi'))
                <form method="POST" action="{{ route('pembimbingakademik.persetujuanirs') }}" class="d-inline mr-2">
                    @csrf
                    <input type="hidden" name="nim" value="{{ $mahasiswa->nim }}">
                    <button type="submit" name="action" value="setuju"
                        class="btn btn-outline-success btn-lg">Setuju</button>
                </form>
            @endif

            {{-- Tombol "Ubah Persetujuan IRS" jika sudah disetujui --}}
            @if ($irs->contains('status_approve', 'disetujui'))
                <form method="POST" action="{{ route('pembimbingakademik.persetujuanirs') }}" class="d-inline">
                    @csrf
                    <input type="hidden" name="nim" value="{{ $mahasiswa->nim }}">
                    <button type="submit" name="action" value="ubah" class="btn btn-outline-warning btn-lg">Ubah
                        Persetujuan IRS</button>
                </form>
            @endif
        </div>
    </div>
@endsection
