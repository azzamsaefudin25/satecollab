<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\RuangPerkuliahan;
use Illuminate\Http\Request;
use App\Models\Dosen;
use App\Models\DosenPengampu;
use App\Models\MataKuliah;
use App\Models\JadwalKuliah;
use App\Models\PengalokasianRuang;
use App\Models\ProgramStudi;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class KetuaProgramStudiController extends Controller
{
    // public function dashboard()
    // {
    //     $user = Auth::user();
    //     $ketuaProgramStudi = $user->dosen ? $user->dosen->ketuaProgramStudi : null;

    //     if (!$user) {
    //         return redirect()->route('login')->withErrors(['message' => 'User tidak ditemukan.']);
    //     }

    //     $nama = $user->name;
    //     $nidn = null;

    //     if ($ketuaProgramStudi) {
    //         $nidn = $ketuaProgramStudi->nidn_ketuaprogramstudi;
    //         return view('ketuaprogramstudi.dashboard', compact('nama', 'nidn'));
    //     }
    //     return redirect()->route('home');
    // }


    public function getRuangan($id_programstudi)
    {
        // Ambil ruangan berdasarkan pengalokasian program studi
        $ruangPerkuliahan = PengalokasianRuang::where('id_programstudi', $id_programstudi)
            ->where('status', 'disetujui')
            ->with('ruangperkuliahan') // Relasi ke RuangPerkuliahan
            ->get()
            ->pluck('ruangperkuliahan'); // Ambil data ruangan dari relasi

        // Kembalikan data sebagai JSON untuk AJAX
        return response()->json($ruangPerkuliahan);
    }
    public function getMatakuliah($id_programstudi)
    {
        $matakuliah = MataKuliah::where('id_programstudi', $id_programstudi)->get();
        return response()->json($matakuliah);
    }

    /**
     * Display a listing of the resource.
     */
    public function index() {}

    /**
     * Show the form for creating a new resource.
     */

    public function indexjadwalKuliah()
    {
        $jadwal = JadwalKuliah::with(['mataKuliah', 'dosen1', 'dosen2', 'dosen3', 'dosen4', 'dosen5'])->get(); //dia itu manggil cuma dari hasil relasi nmodel nya

        return view('ketuaprogramstudi.lihatjadwalkuliah', compact('jadwal'));
    }

    public function createMemilihMataKuliah()
    {
        $programstudi = ProgramStudi::all();
        return view('ketuaprogramstudi.memilihmatakuliah.create', compact('programstudi'));
    }


    public function createJadwalKuliah()
    {
        $matakuliah = MataKuliah::all();
        $ruangperkuliahan = RuangPerkuliahan::all();
        $kelas = Kelas::all();
        $programstudi = ProgramStudi::all();
        $dosen = Dosen::all();
        return view('ketuaprogramstudi.jadwalkuliah', compact('matakuliah', 'ruangperkuliahan', 'kelas', 'programstudi', 'dosen'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function storeMemilihMataKuliah(Request $request)
    {
        // Validasi input
        $request->validate([
            'kode_mk' => 'required|string|max:8|unique:matakuliah,kode_mk',
            'nama_mk' => 'required|string|max:50',
            'semester' => 'required|integer|min:1|max:9', // Validasi semester 1-9
            'sks' => 'required|integer|min:1|max:9', // Validasi SKS 1-9
            'jenis' => 'required|string|in:Wajib,Pilihan',
            'id_programstudi' => 'required|exists:programstudi,id_programstudi',
        ]);
    
        // Tentukan semester aktif berdasarkan input semester
        $semester = $request->input('semester');
        $semesterAktif = $semester % 2 === 0 ? 'Genap' : 'Ganjil';
    
        // Simpan data ke dalam tabel matakuliah
        MataKuliah::create([
            'kode_mk' => $request->input('kode_mk'),
            'nama_mk' => $request->input('nama_mk'),
            'semester' => $semester,
            'sks' => $request->input('sks'),
            'semester_aktif' => $semesterAktif,
            'jenis' => $request->input('jenis'),
            'id_programstudi' => $request->input('id_programstudi'),
        ]);
    
        // Redirect ke halaman daftar mata kuliah dengan pesan sukses
        return redirect()->route('memilihmatakuliah.create')
            ->with('success', 'Mata kuliah berhasil ditambahkan.');
    }
    

    public function hitungJamSelesai(Request $request)
    {
        // Validasi input
        try {
            $request->validate([
                'kode_mk' => 'required|exists:matakuliah,kode_mk',
                'jam' => 'required|date_format:H:i',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation Error:', $e->errors());
            return response()->json(['errors' => $e->errors()], 422);
        }

        // Log data request
        Log::info('Request Data:', $request->all());

        // Dapatkan mata kuliah berdasarkan kode_mk
        $mataKuliah = MataKuliah::where('kode_mk', $request->kode_mk)->first();

        if (!$mataKuliah) {
            Log::error('Mata Kuliah Tidak Ditemukan:', ['kode_mk' => $request->kode_mk]);
            return response()->json(['message' => 'Mata kuliah tidak ditemukan.'], 404);
        }

        $sks = $mataKuliah->sks;

        // Konversi jam mulai ke format DateTime
        try {
            $jamMulai = new \DateTime($request->input('jam'));
        } catch (\Exception $e) {
            Log::error('Error Mengonversi Jam:', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Format jam tidak valid.'], 400);
        }

        // 1 SKS = 50 menit
        $durasi = $sks * 50;

        // Hitung jam selesai
        $jamSelesai = clone $jamMulai;
        $jamSelesai->modify("+$durasi minutes");

        // Format hasil ke string dan kirim sebagai response JSON
        return response()->json([
            'jam_selesai' => $jamSelesai->format('H:i')  // Pastikan ini sesuai dengan yang akan ditampilkan di view
        ]);
    }
    // public function storeDosen(Request $request)
    // {
    //     $request->validate([
    //         'id' => 'required|exists:jadwalkuliah,id',
    //         'nidn_dosen' => 'required|array', // Pastikan ini adalah array
    //         'nidn_dosen.*' => 'exists:dosen,nidn_dosen', // Pastikan setiap nidn_dosen ada di tabel dosen
    //     ]);

    //     $jadwal = JadwalKuliah::findOrFail($request->id);
    //     $jadwal->dosen()->sync($request->nidn_dosen); // Sinkronkan dosen

    //     return redirect()->back()->with('success', 'Dosen berhasil ditambahkan ke jadwal.');
    // }
    public function getDosenByMk($kode_mk)
    {
        $dosen = Dosen::where('kode_mk', $kode_mk)->get();
        return response()->json($dosen);
    }


    public function storeJadwalKuliah(Request $request)
    {
        // dd($request->all()); // untuk melihat data yang dikirimkan

        $request->validate([
            'kode_mk' => 'required|exists:matakuliah,kode_mk',
            'kode_ruang' => 'required|exists:ruangperkuliahan,kode_ruang',
            'nama_kelas' => 'required|exists:kelas,nama_kelas',
            'tahun_ajaran' => 'required|string|min:9|max:9',
            'hari' => 'required|string|min:1|max:10',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            // Memastikan dosen 1 sampai 5 ada
            'nidn_dosen1' => 'nullable|exists:dosen,nidn_dosen',
            'nidn_dosen2' => 'nullable|exists:dosen,nidn_dosen',
            'nidn_dosen3' => 'nullable|exists:dosen,nidn_dosen',
            'nidn_dosen4' => 'nullable|exists:dosen,nidn_dosen',
            'nidn_dosen5' => 'nullable|exists:dosen,nidn_dosen',
        ]);


        // Ambil data MataKuliah berdasarkan kode_mk dari request
        $mataKuliah = MataKuliah::where('kode_mk', $request->kode_mk)->first();
        if (!$mataKuliah) {
            return redirect()->back()->withErrors(['kode_mk' => 'Mata kuliah tidak ditemukan.']);
        }

         // Validasi bentrok ruangan
         $overlapRuangan = JadwalKuliah::where('kode_ruang', $request->kode_ruang)
         ->where('hari', $request->hari)
         ->where(function ($query) use ($request) {
             $query->where('jam_mulai', '<', $request->jam_selesai)
                 ->where('jam_selesai', '>', $request->jam_mulai);
         })
         ->whereIn('status', ['disetujui', 'menunggu konfirmasi'])
         ->first();

     if ($overlapRuangan) {
         return redirect()->back()->withErrors(['kode_ruang' => 'Ruangan telah digunakan pada hari dan jam yang dipilih.']);
     }

     // Validasi bentrok matkul dan kelas
     $overlapMatkul = JadwalKuliah::where('kode_mk', $request->kode_mk)
         ->where('nama_kelas', $request->nama_kelas)
         ->whereIn('status', ['disetujui', 'menunggu konfirmasi'])
         ->first();

     if ($overlapMatkul) {
         return redirect()->back()->withErrors(['nama_mk' => 'mata kuliah dengan kelas yang sama sudah diajukan dengan status ' . $overlapMatkul->status])->withInput();
     }

         // Ambil dosen yang terkait dengan mata kuliah dari tabel dosenpengampu
         $dosenPengampu = DosenPengampu::where('kode_mk', $request->kode_mk)->pluck('nidn_dosen')->toArray();

         // Batasi hingga maksimal 5 dosen
         $dosenTerpilih = array_slice($dosenPengampu, 0, 5);
        // Buat jadwal kuliah
        $jadwalKuliah = JadwalKuliah::create([
            'kode_mk' => $request->kode_mk,
            'kode_ruang' => $request->kode_ruang,
            'nama_kelas' => $request->nama_kelas,
            'semester' => $mataKuliah->semester,
            'sks' => $mataKuliah->sks,
            'jenis' => $mataKuliah->jenis,
            'semester_aktif' => $mataKuliah->semester_aktif,
            'tahun_ajaran' => $request->tahun_ajaran,
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'nidn_dosen1' => $dosenTerpilih[0] ?? null,
            'nidn_dosen2' => $dosenTerpilih[1] ?? null,
            'nidn_dosen3' => $dosenTerpilih[2] ?? null,
            'nidn_dosen4' => $dosenTerpilih[3] ?? null,
            'nidn_dosen5' => $dosenTerpilih[4] ?? null,
        ]);

        return redirect()->route('jadwalkuliah.create')->with('success', 'Jadwal kuliah berhasil disimpan.');
    }


    public function indexMemilihMataKuliah()
    {
        $matakuliah = MataKuliah::with('programStudi')->get();
        return view('ketuaprogramstudi.memilihmatakuliah.index', compact('matakuliah'));
    }

    public function editMemilihMataKuliah($kode_mk)
    {
        $matakuliah = MataKuliah::where('kode_mk', $kode_mk)->first();

        if (!$matakuliah) {
            return redirect()->route('memilihmatakuliah.index')->withErrors('Mata kuliah tidak ditemukan.');
        }

        return view('ketuaprogramstudi.memilihmatakuliah.edit', compact('matakuliah'));
    }

    public function updateMemilihMataKuliah(Request $request, $kode_mk)
    {
        // Validasi input
        $request->validate([
            'nama_mk' => 'required|string|max:50',
            'semester' => 'required|integer|min:1|max:8',
            'sks' => 'required|integer|min:1|max:6',
            'jenis' => 'required|string|max:10',
        ]);

        $matakuliah = MataKuliah::where('kode_mk', $kode_mk)->first();

        if (!$matakuliah) {
            return redirect()->route('memilihmatakuliah.index')->withErrors('Mata kuliah tidak ditemukan.');
        }

        // Update data
        $matakuliah->update([
            'nama_mk' => $request->nama_mk,
            'semester' => $request->semester,
            'sks' => $request->sks,
            'semester_aktif' => $request->semester_aktif,
            'jenis' => $request->jenis,
        ]);

        return redirect()->route('memilihmatakuliah.index')->with('success', 'Mata kuliah berhasil diperbarui.');
    }

    public function destroyMemilihMataKuliah($kode_mk)
    {
        $matakuliah = MataKuliah::where('kode_mk', $kode_mk)->first();

        if (!$matakuliah) {
            return redirect()->route('memilihmatakuliah.index')->withErrors('Mata kuliah tidak ditemukan.');
        }

        $matakuliah->delete();

        return redirect()->route('memilihmatakuliah.index')->with('success', 'Mata kuliah berhasil dihapus.');
    }
}
