@extends('layout.template_k')
@section('content')
    <div class="content">
        <h2>VERIFIKASI IRS</h2>

        <div class="statistik">
            <section>
                <span>
                    <h5><b>Statistik Mahasiswa</b><br></h5>
                    Informasi selengkapnya mengenai statistik mahasiswa seperti mahasiswa aktif,
                    mahasiswa yang telah mengisi IRS, dan mahasiswa yang menunggu verifikasi.
                </span>
            </section>
            <div>Mahasiswa Aktif<br><b>{{ $data['totalMahasiswa'] ?? 0 }}</b></div>
            <div>Mahasiswa Yang Sudah Diverifikasi<br><b>{{ $data['mahasiswaVerified'] ?? 0 }}</b></div>
            <div>Mahasiswa Yang Sudah Mengisi IRS<br><b>{{ $data['mahasiswaIsiIRS'] ?? 0 }}</b></div>
        </div>

        <form action="{{ route('monitoringirs.index') }}" method="GET">
            <div class="search-container">
                <input type="text" name="search" placeholder="CARI MAHASISWA" value="{{ request('search') }}">
                <button type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path
                            d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0016 9.5 6.5 6.5 0 109.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C8.01 14 6 11.99 6 9.5S8.01 5 10.5 5 15 7.01 15 9.5 12.99 14 10.5 14z" />
                    </svg>
                </button>
            </div>
        </form>

        <table id="mahasiswaTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Semester</th>
                    <th>Status IRS</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data['mahasiswa'] as $index => $mhs)
                    <tr>
                        <td>{{ $data['mahasiswa']->firstItem() + $index }}</td>
                        <td>{{ $mhs->nim }}</td>
                        <td>{{ $mhs->nama_mahasiswa }}</td>
                        <td>{{ $mhs->semester }}</td>
                        <td>
                            @if ($mhs->irs && $mhs->irs->status_approve === 'disetujui')
                                <span class="approved">Disetujui</span>
                            @elseif($mhs->irs)
                                <span class="waiting-approved">Menunggu</span>
                            @else
                                <span class="not-approved">Belum Ada IRS</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Data Mahasiswa Tidak Ditemukan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $data['mahasiswa']->withQueryString()->links() }}

        <!-- Back Button -->
        <a onclick="window.location.href='{{ route('pembimbingakademik') }}'" class="btn btn-dark back-button">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-arrow-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M15 8a.5.5 0 0 1-.5.5H3.707l3.147 3.146a.5.5 0 0 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 0 1 .708.708L3.707 7.5H14.5A.5.5 0 0 1 15 8z" />
            </svg>
            Back
        </a>
    </div>
@endsection
