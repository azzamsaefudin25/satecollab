<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\RuangPerkuliahan;
use Illuminate\Http\Request;
use App\Models\DosenPengampu;
use App\Models\MataKuliah;
use App\Models\JadwalKuliah;
use App\Models\PengalokasianRuang;
use App\Models\ProgramStudi;
use Illuminate\Support\Facades\Log;


class KetuaProgramStudiController extends Controller
{

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
    /**
     * Display a listing of the resource.
     */
    public function index() {}

    /**
     * Show the form for creating a new resource.
     */

    public function indexjadwalKuliah()
    {
        $jadwal = JadwalKuliah::with('matakuliah.dosenPengampu')->get();;
        // dd($jadwal[0]->toArray());
        // dd($jadwal->toArray());
        // foreach ($jadwal as $item) {
        //     echo '<pre>'; // Menambahkan <pre> agar output lebih rapi
        //     echo 'Mata Kuliah: ';
        //     print_r($item->mataKuliah ? $item->mataKuliah->toArray() : 'Mata Kuliah not available');

        //     echo 'Dosen Pengampu: ';
        //     print_r($item->mataKuliah && $item->mataKuliah->dosenPengampu ? $item->mataKuliah->dosenPengampu->toArray() : 'Dosen not available');
        //     echo '</pre>';
        // }
        return view('ketuaprogramstudi.lihatjadwalkuliah', compact('jadwal'));
    }

    public function createMemilihMataKuliah()
    {
        $dosenpengampu = DosenPengampu::all();
        return view('ketuaprogramstudi.memilihmatakuliah.create', compact('dosenpengampu'));
    }

    public function createJadwalKuliah()
    {
        $matakuliah = MataKuliah::all();
        $ruangperkuliahan = RuangPerkuliahan::all();
        $kelas = Kelas::all();
        $programstudi = ProgramStudi::all();
        return view('ketuaprogramstudi.jadwalkuliah', compact('matakuliah', 'ruangperkuliahan', 'kelas', 'programstudi'));
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
            'semester' => 'required|integer|min:1|max:8',
            'sks' => 'required|integer|min:1|max:6',
            'jenis' => 'required|string|max:10',
            'nidn_dosenpengampu' => 'required|exists:dosenpengampu,nidn_dosenpengampu', // Hapus exists
        ]);

        $dosen = DosenPengampu::where('nidn_dosenpengampu', $request->nidn_dosenpengampu)->first();

        if (!$dosen) {
            return redirect()->back()->withErrors(['nidn_dosenpengampu' => 'Dosen pengampu tidak ditemukan.']);
        }
        // Simpan data ke dalam tabel matakuliah
        MataKuliah::create([
            'kode_mk' => $request->kode_mk,
            'nama_mk' => $request->nama_mk,
            'semester' => $request->semester,
            'sks' => $request->sks,
            'jenis' => $request->jenis,
            'nidn_dosenpengampu' => $request->nidn_dosenpengampu,  // Menyimpan dosen pengampu
        ]);
        // dd($dosenpengampu);
        // Redirect ke halaman daftar mata kuliah dengan pesan sukses
        return redirect()->route('memilihmatakuliah.create')->with('success', 'Mata kuliah berhasil ditambahkan.');
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

    public function storeJadwalKuliah(Request $request)
    {
        // dd($request->all());  // Untuk debugging input yang masuk
        // Validasi input
        $request->validate([
            'kode_mk' => 'required|exists:matakuliah,kode_mk',
            'kode_ruang' => 'required|exists:ruangperkuliahan,kode_ruang',
            'hari' => 'required|string|min:1|max:10',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'nama_kelas' => 'required|exists:kelas,nama_kelas',
        ]);

        $mataKuliah = MataKuliah::where('kode_mk', $request->kode_mk)->first();

        if (!$mataKuliah) {
            return redirect()->back()->withErrors(['kode_mk' => 'Mata kuliah tidak ditemukan.']);
        }


        // Validasi apakah kelas sudah mengambil mata kuliah yang sama
        $duplicateMatakuliah = JadwalKuliah::where('nama_kelas', $request->nama_kelas)
            ->where('kode_mk', $request->kode_mk) // Asumsikan nama_mk adalah nama mata kuliah
            ->exists();

        if ($duplicateMatakuliah) {
            return redirect()->back()->withErrors(['nama_mk' => 'Kelas ini sudah terdaftar untuk mata kuliah tersebut di hari lain.']);
        }

        // Lanjutkan dengan validasi bentrok ruangan dan jadwal
        $overlapRuangan = JadwalKuliah::where('kode_ruang', $request->kode_ruang)
            ->where('hari', $request->hari)
            ->where(function ($query) use ($request) {
                $query->where('jam_mulai', '<', $request->jam_selesai)
                    ->where('jam_selesai', '>', $request->jam_mulai);
            })
            ->first();

        if ($overlapRuangan) {
            return redirect()->back()->withErrors(['kode_ruang' => 'Ruangan telah digunakan pada hari dan jam yang dipilih.']);
        }

        // Pengecekan bentrok kelas
        $overlapKelas = JadwalKuliah::where('nama_kelas', $request->nama_kelas)
            ->where('hari', $request->hari)
            ->where(function ($query) use ($request) {
                $query->where('jam_mulai', '<', $request->jam_selesai)
                    ->where('jam_selesai', '>', $request->jam_mulai);
            })
            ->first();

        if ($overlapKelas) {
            return redirect()->back()->withErrors(['nama_kelas' => 'Kelas sudah memiliki mata kuliah lain pada hari dan jam yang dipilih.']);
        }


        // Simpan jadwal kuliah
        JadwalKuliah::create([
            'kode_mk' => $request->kode_mk,
            'kode_ruang' => $request->kode_ruang,
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'nama_mk' =>  MataKuliah::where('kode_mk', $request->kode_mk)->first()->nama_mk,
            'jenis' =>  MataKuliah::where('kode_mk', $request->kode_mk)->first()->jenis,
            'semester' =>  MataKuliah::where('kode_mk', $request->kode_mk)->first()->semester,
            'sks' => MataKuliah::where('kode_mk', $request->kode_mk)->first()->sks,
            'nama_kelas' => $request->nama_kelas,
            'nidn_dosenpengampu' => MataKuliah::where('kode_mk', $request->kode_mk)->first()->nidn_dosenpengampu,
        ]);

        return redirect()->route('jadwalkuliah.create')->with('success', 'Jadwal kuliah berhasil disimpan.');
    }



    public function indexMemilihMataKuliah()
    {
        $matakuliah = MataKuliah::all();
        return view('ketuaprogramstudi.memilihmatakuliah.index', compact('matakuliah'));
    }

    public function editMemilihMataKuliah($kode_mk)
    {
        $matakuliah = MataKuliah::where('kode_mk', $kode_mk)->first();
        $dosenpengampu = DosenPengampu::all();

        if (!$matakuliah) {
            return redirect()->route('memilihmatakuliah.index')->withErrors('Mata kuliah tidak ditemukan.');
        }

        return view('ketuaprogramstudi.memilihmatakuliah.edit', compact('matakuliah', 'dosenpengampu'));
    }

    public function updateMemilihMataKuliah(Request $request, $kode_mk)
    {
        // Validasi input
        $request->validate([
            'nama_mk' => 'required|string|max:50',
            'semester' => 'required|integer|min:1|max:8',
            'sks' => 'required|integer|min:1|max:6',
            'jenis' => 'required|string|max:10',
            'nidn_dosenpengampu' => 'required|exists:dosenpengampu,nidn_dosenpengampu',
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
            'jenis' => $request->jenis,
            'nidn_dosenpengampu' => $request->nidn_dosenpengampu,
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

    // public function hitungJam(Request $request)
    // {
    //     // Mendapatkan data mata kuliah berdasarkan kode_mk
    //     $mataKuliah = MataKuliah::where('kode_mk', $request->kode_mk)->firstOrFail();
    //     $sks = $mataKuliah->sks;

    //     // Mendapatkan jam mulai dari request
    //     $jamMulai = $request->input('jam');

    //     // Konversi jam mulai ke format DateTime agar bisa ditambah waktu
    //     $jamMulaiDateTime = new \DateTime($jamMulai);

    //     // 1 SKS = 50 menit, maka total menit yang akan ditambahkan adalah SKS * 50
    //     $durasi = $sks * 50;

    //     // Tambahkan durasi ke jam mulai
    //     $jamSelesaiDateTime = clone $jamMulaiDateTime; // Salin object DateTime
    //     $jamSelesaiDateTime->modify("+$durasi minutes");

    //     // Format hasil ke string
    //     $jamSelesai = $jamSelesaiDateTime->format('H:i');

    //     // Kembalikan view dengan hasil perhitungan
    //     return view('KetuaProgramStudi.JadwalKuliah', [
    //         'jamMulai' => $jamMulai,
    //         'jamSelesai' => $jamSelesai,
    //         'sks' => $sks,
    //         'kode_ruang' => $request->kode_ruang, // Jika ada input ruang
    //         'hari' => $request->hari, // Jika ada input hari
    //         'nama_kelas' => $request->nama_kelas, // Jika ada input nama kelas
    //         'mataKuliah' => MataKuliah::all() // Data MK untuk dropdown
    //     ]);
    // }


}
