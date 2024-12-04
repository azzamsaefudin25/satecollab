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
    public function profile()
    {
        $user = Auth::user();
        $mahasiswa = $user->mahasiswa;

        if (!$user) {
            return redirect()->route('login')->withErrors(['message' => 'User tidak ditemukan.']);
        }

        $nama = $user->name;
        $nim = null;

        if ($mahasiswa) {
            $nim = $mahasiswa->nim;
            return view('mahasiswa.profile', compact('nama', 'nim'));
        }
        return redirect()->route('home');
    }

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
            return redirect('/')->withErrors(['message' => 'Data mahasiswa tidak ditemukan.']);
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

        // Query untuk mengambil data dengan join dan filter tambahan
        $mataKuliah = DB::table('jadwalkuliah')
            ->join('matakuliah', 'jadwalkuliah.kode_mk', '=', 'matakuliah.kode_mk')
            ->where('jadwalkuliah.status', 'disetujui') // Filter berdasarkan status disetujui
            ->where('matakuliah.id_programstudi', $idProgramStudi) // Filter berdasarkan program studi
            ->where(function ($q) use ($query) {
                $q->where('matakuliah.nama_mk', 'LIKE', "%{$query}%") // Filter nama mata kuliah
                    ->orWhere('jadwalkuliah.kode_mk', 'LIKE', "%{$query}%") // Filter kode mata kuliah
                    ->orWhere('jadwalkuliah.semester', 'LIKE', "%{$query}%") // Filter kode mata kuliah
                    ->orWhere('jadwalkuliah.jenis', 'LIKE', "%{$query}%") // Filter kode mata kuliah
                    ->orWhere('jadwalkuliah.hari', 'LIKE', "%{$query}%") // Filter hari
                    ->orWhere('jadwalkuliah.nama_kelas', 'LIKE', "%{$query}%") // Filter kelas
                    ->orWhere(DB::raw("CONCAT(jadwalkuliah.jam_mulai, '-', jadwalkuliah.jam_selesai)"), 'LIKE', "%{$query}%"); // Filter jam
            })
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
                'text' => "{$mk->kode_mk} - {$mk->nama_mk} - {$mk->jenis} - Semester {$mk->semester} - kelas {$mk->nama_kelas} - {$mk->hari}, {$mk->jam_mulai}-{$mk->jam_selesai}"
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
            'jenis' => $jadwal->jenis,
            'sks' => $jadwal->sks,
            'semester' => $jadwal->semester,
            'tahun_ajaran' => $jadwal->tahun_ajaran,
            'hari' => $jadwal->hari,
            'jam_mulai' => $jadwal->jam_mulai,
            'jam_selesai' => $jadwal->jam_selesai,
            'kode_ruang' => $jadwal->kode_ruang,
            'terisi' => $jadwal->terisi,
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
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->withErrors(['message' => 'User tidak ditemukan.']);
        }

        $mahasiswa = $user->mahasiswa;
        $nim = $mahasiswa->nim;
        // Debug query
        $irsIndex = IRS::with(['mahasiswa', 'jadwalKuliah'])
            ->where('nim', $nim)
            ->get();

        if ($irsIndex->isEmpty()) {
            dd('Tidak ada data untuk NIM: ' . $nim);
        }

        $jadwalKuliah = JadwalKuliah::all()->keyBy(function ($item) {
            return $item->kode_mk . '-' . $item->nama_kelas;
        });

        return view('mahasiswa.IRS.index', compact('irsIndex', 'jadwalKuliah'));
    }
    public function store(Request $request)
<<<<<<< HEAD
    {
        $responseMessages = [];
        try {
            // Ambil data mahasiswa
            $user = Auth::user();
            $mahasiswa = $user->mahasiswa;
    
            if (!$mahasiswa) {
                throw new \Exception('Mahasiswa tidak ditemukan untuk user ini.');
=======
{
    $responseMessages = [];
    try {
        // Ambil data mahasiswa
        $user = Auth::user();
        $mahasiswa = $user->mahasiswa;

        if (!$mahasiswa) {
            throw new \Exception('Mahasiswa tidak ditemukan untuk user ini.');
        }

        // Log nilai awal SKS
        Log::info('Jumlah SKS Awal: ' . $mahasiswa->jumlah_sks);

        // Periksa apakah ada data IRS yang dikirim
        if (!$request->has('irsData') || empty($request->irsData)) {
            return response()->json(['error' => 'Tidak ada data IRS'], 400);
        }

        // Tentukan batas maksimal SKS berdasarkan IPK
        $ipk = $mahasiswa->ipk;
        $maxSks = 0;
        if ($ipk >= 2.50 && $ipk < 2.75) {
            $maxSks = 18;
        } elseif ($ipk >= 2.75 && $ipk < 3.00) {
            $maxSks = 22;
        } elseif ($ipk >= 3.00 && $ipk <= 4.00) {
            $maxSks = 24;
        } else {
            throw new \Exception("IPK tidak valid atau di luar jangkauan.");
        }

        // Validasi jumlah SKS saat ini
        $currentSks = $mahasiswa->jumlah_sks;
        if ($currentSks >= $maxSks) {
            throw new \Exception("Jumlah SKS saat ini sudah mencapai batas maksimal: $maxSks SKS.");
        }

        // Variabel untuk menampung total SKS yang akan ditambahkan
        $totalSksTambahan = 0;
        $kodeMkList = []; // Untuk menyimpan kode MK yang diajukan

        foreach ($request->irsData as $data) {
            $jadwal = JadwalKuliah::where('kode_mk', $data['kode_mk'])
                ->where('nama_kelas', $data['nama_kelas'])
                ->first();

            if (!$jadwal) {
                throw new \Exception("Jadwal kuliah tidak ditemukan");
>>>>>>> 612b106894f972d886d4198ee08dc8dbeb3757c5
            }
    
            // Log nilai awal SKS
            \Log::info('Jumlah SKS Awal: ' . $mahasiswa->jumlah_sks);
    
            // Periksa apakah ada data IRS yang dikirim
            if (!$request->has('irsData') || empty($request->irsData)) {
                return response()->json(['error' => 'Tidak ada data IRS'], 400);
            }
    
            // Tentukan batas maksimal SKS berdasarkan IPK
            $ipk = $mahasiswa->ipk;
            $maxSks = 0;
            if ($ipk >= 2.50 && $ipk < 2.75) {
                $maxSks = 18;
            } elseif ($ipk >= 2.75 && $ipk < 3.00) {
                $maxSks = 22;
            } elseif ($ipk >= 3.00 && $ipk <= 4.00) {
                $maxSks = 24;
            } else {
                throw new \Exception("IPK tidak valid atau di luar jangkauan.");
            }
    
            // Validasi jumlah SKS saat ini
            $currentSks = $mahasiswa->jumlah_sks;
            if ($currentSks >= $maxSks) {
                throw new \Exception("Jumlah SKS saat ini sudah mencapai batas maksimal: $maxSks SKS.");
            }
    
            // Variabel untuk menampung total SKS yang akan ditambahkan
            $totalSksTambahan = 0;
            $kodeMkList = []; // Untuk menyimpan kode MK yang diajukan
    
            foreach ($request->irsData as $data) {
                $jadwal = JadwalKuliah::where('kode_mk', $data['kode_mk'])
                    ->where('nama_kelas', $data['nama_kelas'])
                    ->first();
    
                if (!$jadwal) {
                    throw new \Exception("Jadwal kuliah tidak ditemukan");
                }
    
                // Validasi SKS tambahan tidak melebihi batas
                $totalSksTambahan += $jadwal->sks;
                if ($currentSks + $totalSksTambahan > $maxSks) {
                    throw new \Exception("Penambahan SKS melebihi batas maksimal: $maxSks SKS.");
                }
    
                // Hitung prioritas berdasarkan semester mahasiswa dan jadwal
                $priority = $jadwal->semester < $mahasiswa->semester ? 1 : 
                ($jadwal->semester == $mahasiswa->semester ? 2 : 3);
    
                if ($jadwal->terisi >= $jadwal->kapasitas) {
                    // Cari mahasiswa terendah prioritasnya untuk dihapus
                    $lowestPriorityIRS = IRS::where('id_jadwal', $jadwal->id_jadwal)
                        ->orderBy('priority', 'desc')
                        ->first();
    
                    if ($lowestPriorityIRS) {
                        // Hapus IRS dengan prioritas terendah
                        $lowestPriorityIRS->delete();
                        $jadwal->decrement('terisi');
                    }
                }
                $priority = 0; // Default prioritas
                if ($jadwal->semester > $mahasiswa->semester) {
                    $priority = 3;
                } elseif ($jadwal->semester == $mahasiswa->semester) {
                    $priority = 2;
                } elseif ($jadwal->semester < $mahasiswa->semester) {
                    $priority = 1;
                }
    
                // Buat IRS baru
                IRS::create([
                    'id_jadwal' => $jadwal->id_jadwal,
                    'nim' => $data['nim'],
                    'kode_mk' => $data['kode_mk'],
                    'nama_kelas' => $data['nama_kelas'],
                    'sks' => $jadwal->sks,
                    'kode_ruang' => $jadwal->kode_ruang,
                    'hari' => $jadwal->hari,
                    'jam_mulai' => $jadwal->jam_mulai,
                    'jam_selesai' => $jadwal->jam_selesai,
                    'tahun_ajaran' => $jadwal->tahun_ajaran,
                    'nidn_pembimbingakademik' => $mahasiswa->nidn_pembimbingakademik,
                    'status' => 'baru',
                    'status_approve' => 'menunggu konfirmasi',
                    'priority' => $priority
                ]);
    
                $jadwal->increment('terisi');
                $kodeMkList[] = $data['kode_mk']; // Tambahkan ke daftar kode MK
                $responseMessages[] = "IRS dengan kode mata kuliah {$data['kode_mk']} berhasil diajukan.";
            }
    
            // Update jumlah SKS mahasiswa menggunakan SQL
            \DB::table('mahasiswa')
                ->where('nim', $mahasiswa->nim)
                ->update([
                    'jumlah_sks' => $currentSks + $totalSksTambahan
                ]);
    
            \Log::info('Jumlah SKS Setelah: ' . $mahasiswa->fresh()->jumlah_sks); // Refresh data mahasiswa
    
            return response()->json([
                'messages' => $responseMessages
            ]);
        } catch (\Exception $e) {
            \Log::error('Error: ' . $e->getMessage());
    
            return response()->json([
                'error' => true,
                'message' => "Terjadi kesalahan: " . $e->getMessage()
            ], 500);
        }
<<<<<<< HEAD
=======

        // Update jumlah SKS mahasiswa menggunakan SQL
        DB::table('mahasiswa')
            ->where('nim', $mahasiswa->nim)
            ->update([
                'jumlah_sks' => $currentSks + $totalSksTambahan
            ]);

        Log::info('Jumlah SKS Setelah: ' . $mahasiswa->fresh()->jumlah_sks); // Refresh data mahasiswa

        return response()->json([
            'messages' => $responseMessages
        ]);
    } catch (\Exception $e) {
        Log::error('Error: ' . $e->getMessage());

        return response()->json([
            'error' => true,
            'message' => "Terjadi kesalahan: " . $e->getMessage()
        ], 500);
>>>>>>> 612b106894f972d886d4198ee08dc8dbeb3757c5
    }
    
public function delete(Request $request)
{
    try {
        // Validasi input
        $request->validate([
            'nim' => 'required',
            'kode_mk' => 'required',
            'nama_kelas' => 'required'
        ]);

        // Cari IRS berdasarkan kombinasi nim, kode_mk, dan nama_kelas
        $irs = IRS::where('nim', $request->nim)
            ->where('kode_mk', $request->kode_mk)
            ->where('nama_kelas', $request->nama_kelas)
            ->where('status_approve', 'menunggu konfirmasi') // Hanya hapus yang belum dikonfirmasi
            ->first();

        if ($irs) {
            // Ambil jadwal kuliah terkait
            $jadwal = $irs->jadwalKuliah;
            $sksDihapus = $irs->sks;

            if ($jadwal) {
                // Kurangi jumlah pendaftar pada jadwal kuliah
                $jadwal->decrement('terisi');
            }

            // Hapus IRS
            $irs->delete();

            // Kurangi jumlah SKS mahasiswa
            $mahasiswa = $irs->mahasiswa;
            $mahasiswa->decrement('jumlah_sks', $sksDihapus);

            return response()->json([
                'success' => true,
                'message' => 'Mata kuliah berhasil dihapus dari IRS'
            ]);
        }
        if (!$irs) {
            return response()->json([
                'success' => false,
                'message' => 'IRS tidak ditemukan atau sudah dikonfirmasi'
            ], 404);
        }
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error: ' . $e->getMessage()
        ], 500);
    }
}
}
