@extends('layout.template')

@section('content')
    <div class="container mt-5">
        <h3 class="text-center mb-4">Daftar Mata Kuliah</h3>

        <table class="table table-bordered">
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
                @foreach ($matakuliah as $mk)
                    <tr>
                        <td>{{ $mk->kode_mk }}</td>
                        <td>{{ $mk->nama_mk }}</td>
                        <td>{{ $mk->semester }}</td>
                        <td>{{ $mk->sks }}</td>
                        <td>{{ $mk->semester_aktif }}</td>
                        <td>{{ $mk->jenis }}</td>
                        <td>{{ $mk->programStudi->nama_programstudi ?? 'NA' }}</td>
                        <td>
                            <a href="{{ route('memilihmatakuliah.edit', $mk->kode_mk) }}" class="btn btn-warning btn-sm">Edit</a>
                            
                            <form action="{{ route('memilihmatakuliah.destroy', $mk->kode_mk) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="text-start mt-4">
            <button type="button" class="btn btn-outline-secondary" onclick="window.location.href='{{ route('memilihmatakuliah.create') }}'">
                <i class="fas fa-arrow-left"></i> Kembali
            </button>
        </div>
    </div>
@endsection
