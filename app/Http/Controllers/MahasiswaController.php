<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalKuliah;
use App\Models\IRS;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class MahasiswaController extends Controller
{
    public function createIRS()
    {
        $jadwal = JadwalKuliah::all();
        $user = Auth::user();

        // Pastikan user ditemukan
        if (!$user) {
            return redirect()->route('login')->withErrors(['message' => 'User tidak ditemukan.']);
        }

        // Ambil data mahasiswa jika user adalah mahasiswa
        $mahasiswa = $user->mahasiswa;

        // Pastikan mahasiswa ditemukan
        if (!$mahasiswa) {
            return redirect()->route('home')->withErrors(['message' => 'Data mahasiswa tidak ditemukan.']);
        }
        $nim = $mahasiswa->nim;
        $irsData = IRS::with(['mahasiswa', 'ruangPerkuliahan', 'mataKuliah', 'kelas'])
            ->where('nim', $nim)
            ->whereIn('status_approve', ['menunggu konfirmasi', 'disetujui'])
            ->get();
        $jadwalKuliah = JadwalKuliah::all()->keyBy(function ($item) {
            return $item->kode_mk . '-' . $item->nama_kelas;
        });
        return view('mahasiswa.IRS.create', compact('jadwal', 'irsData','jadwalKuliah'), [
            'user' => $user,
            'nim' => $mahasiswa->nim
        ]);
    }

    // MahasiswaController.php
    public function searchMatakuliah(Request $request)
    {
        $query = $request->get('query');
        $mataKuliah = JadwalKuliah::where('status', 'disetujui') // Filter berdasarkan status
            ->where('nama_mk', 'LIKE', "%{$query}%")
            ->orderBy('nama_mk', 'asc')
            ->get(['kode_mk', 'nama_mk', 'jenis', 'semester', 'nama_kelas']);

        $result = $mataKuliah->map(function ($mk) {
            return [
                'id' => $mk->kode_mk,
                'text' => "{$mk->nama_mk} - {$mk->jenis} - Semester {$mk->semester} - kelas {$mk->nama_kelas} "
            ];
        });

        // Tambahkan log untuk debugging
        Log::info($result);

        return response()->json(['results' => $result]);
    }

    // Controller untuk mendapatkan detail mata kuliah berdasarkan kode_mk   
    public function getMatkulDetails(Request $request)
    {
        $kodeMk = $request->input('kode_mk');
        $namaKelas = $request->input('nama_kelas');

        // Mencari mata kuliah berdasarkan kode dan kelas
        $matkul = JadwalKuliah::where('kode_mk', $kodeMk)
            ->where('nama_kelas', $namaKelas)
            ->first();

        // Memastikan data mata kuliah ditemukan
        if (!$matkul) {
            return response()->json(['error' => 'Mata kuliah tidak ditemukan.'], 404);
        }

        // Mengembalikan data mata kuliah dalam format JSON
        return response()->json([
            'kode_mk' => $matkul->kode_mk,
            'nama_mk' => $matkul->nama_mk,
            'jenis' => $matkul->jenis,
            'semester' => $matkul->semester,
            'sks' => $matkul->sks,
            'nama_kelas' => $matkul->nama_kelas,
            'hari' => $matkul->hari,
            'jam_mulai' => $matkul->jam_mulai,
            'jam_selesai' => $matkul->jam_selesai,
            'kode_ruang' => $matkul->kode_ruang,
            'nama_dosenpengampu' => $matkul->mataKuliah->dosenPengampu->nama_dosenpengampu
        ]);
    }

    // public function getMatkulDetails($kode_mk)
    // {
    //     $matkuls = JadwalKuliah::where('kode_mk', $kode_mk)->get();

    //     if ($matkuls->isNotEmpty()) {
    //         return response()->json($matkuls);
    //     } else {
    //         return response()->json(['message' => 'Mata Kuliah tidak ditemukan'], 404);
    //     }
    // }
}
