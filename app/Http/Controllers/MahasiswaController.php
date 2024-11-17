<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalKuliah;
use App\Models\IRS;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class MahasiswaController extends Controller
{
    // public function dashboard()
    // {
    //     $user = Auth::user();
    //     $mahasiswa = $user->mahasiswa;

    //     if (!$user) {
    //         return redirect()->route('login')->withErrors(['message' => 'User tidak ditemukan.']);
    //     }

    //     $nama = $user->name;
    //     $nim = null;

    //     if ($mahasiswa) {
    //         $nim = $mahasiswa->nim;
    //         return view('mahasiswa.dashboard', compact('nama', 'nim'));
    //     }
    //     return redirect()->route('home');
    // }

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
        $irsData = IRS::with(['mahasiswa', 'jadwalKuliah'])
            ->where('nim', $nim)
            ->whereIn('status_approve', ['menunggu konfirmasi', 'disetujui'])
            ->get();
        $jadwalKuliah = JadwalKuliah::all()->keyBy(function ($item) {
            return $item->kode_mk . '-' . $item->nama_kelas;
        });
        return view('mahasiswa.IRS.create', compact('jadwal', 'irsData', 'jadwalKuliah'), [
            'user' => $user,
            'nim' => $mahasiswa->nim
        ]);
    }

    // MahasiswaController.php
    public function searchMatakuliah(Request $request)
    {
        $query = $request->get('query');

        $mahasiswa = auth()->user()->mahasiswa;

        if (!$mahasiswa) {
            return response()->json(['error' => 'Mahasiswa tidak ditemukan.'], 404);
        }

        $idProgramStudi = $mahasiswa->id_programstudi;

        // Query untuk mengambil data dengan join
        $mataKuliah = DB::table('jadwalkuliah')
            ->join('matakuliah', 'jadwalkuliah.kode_mk', '=', 'matakuliah.kode_mk')
            ->where('jadwalkuliah.status', 'disetujui') // Filter berdasarkan status disetujui
            ->where('matakuliah.nama_mk', 'LIKE', "%{$query}%") // Filter berdasarkan nama mata kuliah
            ->where('matakuliah.id_programstudi', $idProgramStudi)
            ->orderBy('matakuliah.nama_mk', 'asc') // Urutkan berdasarkan nama mata kuliah
            ->limit(10) 
            ->get([
                'jadwalkuliah.kode_mk',
                'matakuliah.nama_mk',
                'jadwalkuliah.jenis',
                'jadwalkuliah.semester',
                'jadwalkuliah.nama_kelas',
                'jadwalkuliah.hari',
                'jadwalkuliah.jam_mulai',
                'jadwalkuliah.jam_selesai',
            ]);

        // Mapping data untuk format Select2
        $result = $mataKuliah->map(function ($mk) {
            return [
                'id' => $mk->kode_mk,
                'text' => "{$mk->nama_mk} - {$mk->jenis} - Semester {$mk->semester} - {$mk->hari}, {$mk->jam_mulai}-{$mk->jam_selesai} - kelas {$mk->nama_kelas}"
                // 'text' => "{$mk->nama_mk} - {$mk->jenis} - Semester {$mk->semester} - kelas {$mk->nama_kelas} - {$mk->hari}, {$mk->jam_mulai}-{$mk->jam_selesai}"
            ];
        });

        return response()->json(['results' => $result]);
    }


    public function getMatkulDetails(Request $request)
    {
        $kodeMk = $request->input('kode_mk');
        $namaKelas = $request->input('nama_kelas');

        Log::info("Menerima permintaan untuk detail mata kuliah", [
            'kode_mk' => $kodeMk,
            'nama_kelas' => $namaKelas
        ]);

        $jadwal = JadwalKuliah::with('pengalokasianRuang.ruangperkuliahan', 'mataKuliah', 'dosen1.dosen', 'dosen2.dosen', 'dosen3.dosen', 'dosen4.dosen', 'dosen5.dosen')
            ->where('kode_mk', $kodeMk)
            ->where('nama_kelas', $namaKelas)
            ->first();

        if (!$jadwal) {
            Log::error("Mata kuliah tidak ditemukan", [
                'kode_mk' => $kodeMk,
                'nama_kelas' => $namaKelas
            ]);
            return response()->json(['error' => 'Mata kuliah tidak ditemukan.'], 404);
        }

        return response()->json([
            'kode_mk' => $jadwal->kode_mk,
            'nama_mk' => $jadwal->mataKuliah->nama_mk ?? 'N/A',
            'nama_kelas' => $jadwal->nama_kelas,
            'sks' => $jadwal->sks,
            'semester' => $jadwal->semester,
            'jenis' => $jadwal->jenis,
            'hari' => $jadwal->hari,
            'jam_mulai' => $jadwal->jam_mulai,
            'jam_selesai' => $jadwal->jam_selesai,
            'kode_ruang' => $jadwal->kode_ruang,
            'jumlah_pendaftar' => $jadwal->jumlah_pendaftar,
            'kapasitas' => $jadwal->pengalokasianRuang->ruangperkuliahan->kapasitas ?? 0,
            'nama_dosen1' => $jadwal->dosen1->dosen->nama_dosen ?? '',
            'nama_dosen2' => $jadwal->dosen2->dosen->nama_dosen ?? '',
            'nama_dosen3' => $jadwal->dosen3->dosen->nama_dosen ?? '',
            'nama_dosen4' => $jadwal->dosen4->dosen->nama_dosen ?? '',
            'nama_dosen5' => $jadwal->dosen5->dosen->nama_dosen ?? '',
        ]);
    }




    public function index()
    {
        $irsIndex = IRS::with(['jadwalKuliah'])->get();
        $jadwalKuliah = JadwalKuliah::all()->keyBy(function ($item) {
            return $item->kode_mk . '-' . $item->nama_kelas;
        });

        return view('mahasiswa.IRS.index', compact('irsIndex', 'jadwalKuliah'));
    }

    public function store(Request $request)
    {
        $responseMessages = []; // Untuk menyimpan pesan sukses atau error

        foreach ($request->irsData as $data) {
            try {
                // Mulai transaksi database
                DB::beginTransaction();

                // Cek apakah IRS dengan kombinasi nim, kode_mk, dan nama_kelas sudah diajukan
                $existingIrs = Irs::where('nim', $data['nim'])
                    ->where('kode_mk', $data['kode_mk'])
                    ->whereIn('status_approve', ['menunggu konfirmasi', 'disetujui'])
                    ->first();

                if ($existingIrs) {
                    // Tambahkan pesan error jika IRS sudah ada
                    $responseMessages[] = "IRS dengan kode mata kuliah {$data['kode_mk']} sudah pernah diajukan dengan status {$existingIrs->status_approve}.";
                    continue;
                }

                // Ambil data jadwal kuliah untuk mata kuliah dan kelas yang diajukan
                $jadwal = JadwalKuliah::with('pengalokasianRuang.ruangperkuliahan')
                    ->where('kode_mk', $data['kode_mk'])
                    ->where('nama_kelas', $data['nama_kelas'])
                    ->first();

                if (!$jadwal) {
                    $responseMessages[] = "Jadwal untuk mata kuliah {$data['kode_mk']} kelas {$data['nama_kelas']} tidak ditemukan.";
                    continue;
                }

                // Periksa kuota ruangan
                $kapasitasRuangan = $jadwal->pengalokasianRuang->ruangperkuliahan->kapasitas ?? 0;
                if ($jadwal->jumlah_pendaftar >= $kapasitasRuangan) {
                    $responseMessages[] = "Kuota ruangan untuk mata kuliah {$data['kode_mk']} kelas {$data['nama_kelas']} sudah penuh.";
                    continue;
                }

                $user = Auth::user();
                $mahasiswa = $user->mahasiswa;
                $nidn_pembimbingakademik = $mahasiswa->nidn_pembimbingakademik;
                // Tambahkan IRS baru
                Irs::create([
                    'id_jadwal' => $jadwal->id_jadwal, // Masukkan id_jadwal dari tabel jadwalkuliah
                    'nim' => $data['nim'],
                    'kode_mk' => $data['kode_mk'],
                    'nama_kelas' => $data['nama_kelas'],
                    'sks' => $jadwal->sks,
                    'kode_ruang' => $jadwal->kode_ruang,
                    'hari' => $jadwal->hari,
                    'jam_mulai' => $jadwal->jam_mulai,
                    'jam_selesai' => $jadwal->jam_selesai,
                    'tahun_ajaran' => $jadwal->tahun_ajaran,
                    'nidn_pembimbingakademik' => $nidn_pembimbingakademik,
                    'status' => 'baru',
                    'status_approve' => 'menunggu konfirmasi',
                ]);

                // Perbarui jumlah pendaftar pada jadwal kuliah
                $jadwal->increment('jumlah_pendaftar');

                // Tambahkan pesan sukses
                $responseMessages[] = "IRS dengan kode mata kuliah {$data['kode_mk']} berhasil diajukan.";

                // Commit transaksi
                DB::commit();
            } catch (\Exception $e) {
                // Rollback transaksi jika terjadi error
                DB::rollBack();
                $responseMessages[] = "Terjadi kesalahan saat mengajukan IRS untuk kode mata kuliah {$data['kode_mk']}: {$e->getMessage()}";
            }
        }

        // Kirim respons sebagai array pesan
        return response()->json([
            'messages' => $responseMessages
        ]);
    }
}
