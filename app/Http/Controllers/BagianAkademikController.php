<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\RuangPerkuliahan;
use App\Models\PengalokasianRuang;
use App\Models\ProgramStudi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;


class BagianAkademikController extends Controller
{

    // public function dashboard()
    // {
    //     $user = Auth::user();
    //     $bagianAkademik = $user->bagianAkademik;

    //     if (!$user) {
    //         return redirect()->route('login')->withErrors(['message' => 'User tidak ditemukan.']);
    //     }

    //     $nama = $user->name;
    //     $nip = null;

    //     if ($bagianAkademik) {
    //         $nip = $user->bagianAkademik->nip;
    //         return view('bagianakademik.dashboard', compact('nama', 'nip'));
    //     }
    //     // return redirect()->route('home');
    // }

    public function indexPenyusunanRuang(Request $request)
    {
        $ruangPerkuliahan = RuangPerkuliahan::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $ruangPerkuliahan->where(function ($query) use ($search) {
                $query->where('kode_ruang', 'like', '%' . $search . '%')
                    ->orWhere('gedung', 'like', '%' . $search . '%')
                    ->orWhere('kapasitas', 'like', '%' . $search . '%');
            });
        }

        $ruangPerkuliahan = $ruangPerkuliahan->orderBy('kode_ruang', 'desc')->paginate(5);

        return view('bagianakademik.penyusunanruang.index', compact('ruangPerkuliahan'));
    }

    public function indexPengalokasianRuang(Request $request)
    {
        $alokasiRuang = PengalokasianRuang::with('programStudi');

        if ($request->has('search')) {
            $search = $request->input('search');
            $alokasiRuang->where(function ($query) use ($search) {
                $query->where('kode_ruang', 'like', '%' . $search . '%')
                    ->orWhere('status', 'like', '%' . $search . '%')
                    ->orWhereHas('programStudi', function ($q) use ($search) {
                        $q->where('nama_programstudi', 'like', '%' . $search . '%');
                    });
            });
        }
        $alokasiRuang = $alokasiRuang->orderBy('id', 'desc')->paginate(5);
        return view('bagianakademik.pengalokasianruang.index', compact('alokasiRuang'));
    }

    public function createPenyusunanRuang()
    {
        return view('bagianakademik.penyusunanruang.create');
    }

    // Menampilkan form penyusunan ruang
    public function createPengalokasianRuang()
    {
        // Mengambil data dari tabel ruangperkuliahan dan program_studi
        $ruangPerkuliahan = RuangPerkuliahan::whereDoesntHave('pengalokasianRuang', function ($query) {
            $query->whereIn('status', ['disetujui', 'menunggu konfirmasi']);
        })->orderBy('kode_ruang', 'asc')->get();
        $programStudi = ProgramStudi::all();

        return view('bagianakademik.pengalokasianruang.create', compact('ruangPerkuliahan', 'programStudi'));
    }
    // Method untuk menyimpan data
    public function storePenyusunanRuang(Request $request)
    {

        Session::flash('kode_ruang', $request->kode_ruang);
        Session::flash('gedung', $request->gedung);
        Session::flash('kapasitas', $request->kapasitas);

        try {
            // Validasi input
            $validatedData = $request->validate([
                'kode_ruang' => 'required|string|max:25|unique:ruangperkuliahan,kode_ruang',
                'gedung' => 'required|string|max:50',
                'kapasitas' => 'required|integer',
            ], [
                'kode_ruang.required' => 'Kode ruang wajib diisi',
                'kode_ruang.unique' => 'Kode ruang sudah ada di database',
                'gedung.required' => 'Gedung wajib diisi',
                'kapasitas.required' => 'Kapasitas wajib diisi',
            ]);

            // Simpan data ke tabel ruangperkuliahan
            RuangPerkuliahan::create([
                'kode_ruang' => $validatedData['kode_ruang'],
                'gedung' => $validatedData['gedung'],
                'kapasitas' => $validatedData['kapasitas'],
            ]);

            // Redirect setelah sukses
            return redirect()->route('penyusunanruang.index')->with('success', 'Data berhasil disimpan!');
        } catch (ValidationException $e) {
            // Tangani error validasi
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (QueryException $e) {
            // Tangani error database
            Log::error($e->getMessage()); // Log error
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi nanti.'])->withInput();
        } catch (\Exception $e) {
            // Tangani error lainnya
            Log::error($e->getMessage()); // Log error
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }


    // Menyimpan data pengalokasian ruang ke tabel
    public function storePengalokasianRuang(Request $request)
    {
        Session::flash('kode_ruang', $request->kode_ruang);
        Session::flash('id_programstudi', $request->id_programstudi);

        try {
            $validatedData = $request->validate(
                [
                    'id_programstudi' => 'required|integer|exists:programstudi,id_programstudi',
                    'kode_ruang' => 'required|string|exists:ruangperkuliahan,kode_ruang',
                    'kode_ruang' => 'required|array', // Validates that 'kode_ruang' is an array
                ],
                [
                    'id_programstudi.required' => 'Program studi wajib diisi',
                    'kode_ruang.required' => 'Kode ruang wajib diisi',
                ]
            );

            // Cek apakah ada alokasi ruang yang sudah ada dengan status 'disetujui' atau 'menunggu konfirmasi'
            $existingPengajuan = PengalokasianRuang::where('kode_ruang', $validatedData['kode_ruang'])
                ->whereIn('status', ['disetujui', 'menunggu konfirmasi'])
                ->first();

            if ($existingPengajuan) {
                // Ambil nama program studi dari tabel programstudi berdasarkan id_programstudi
                $programStudi = ProgramStudi::find($existingPengajuan->id_programstudi)->nama_programstudi;
                $kodeRuangString = implode(', ', $validatedData['kode_ruang']);
                // Jika sudah ada pengajuan, berikan pesan error
                return redirect()->back()->withErrors(['error' => "{$kodeRuangString} sudah diajukan untuk program studi {$programStudi} dengan status " . $existingPengajuan->status])->withInput();
            }
            // Menyimpan data ke tabel pengalokasianruang
            foreach ($validatedData['kode_ruang'] as $room) {
                PengalokasianRuang::create([
                    'kode_ruang' => $room, // Insert each room separately
                    'id_programstudi' => $validatedData['id_programstudi'],
                ]);
            }

            return redirect()->route('pengalokasianruang.index')->with('success', 'Pengalokasian ruang telah diajukan ke dekan.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    public function editPenyusunanRuang(string $kode_ruang)
    {
        $ruangPerkuliahan = RuangPerkuliahan::findOrFail($kode_ruang);
        return view('bagianakademik.penyusunanruang.edit', compact('ruangPerkuliahan'));
    }

    public function updatePenyusunanRuang(Request $request, string $kode_ruang)
    {

        $validatedData = $request->validate(
            [
                'gedung' => 'required|string|max:50',
                'kapasitas' => 'required|integer',
            ],
            [
                'gedung.required' => 'Gedung wajib diisi',
                'kapasitas.required' => 'Kapasitas wajib diisi',
            ]
        );
        // Simpan data ke tabel ruangperkuliahan
        $ruangPerkuliahan = ([
            'gedung' => $validatedData['gedung'],
            'kapasitas' => $validatedData['kapasitas'],
        ]);

        RuangPerkuliahan::where('kode_ruang', $kode_ruang)->update($ruangPerkuliahan);
        // Redirect setelah sukses
        return redirect()->route('penyusunanruang.index')->with('success', 'Data berhasil diupdate');
    }

    public function destroyPenyusunanRuang(string $kode_ruang)
    {
        RuangPerkuliahan::where('kode_ruang', $kode_ruang)->delete();
        return redirect()->route('penyusunanruang.index')->with('success', 'Data berhasil dihapus');
    }

    public function destroyAlokasiRuang(string $kode_ruang)
    {
        // Hapus data PengalokasianRuang dengan kode_ruang tertentu dan status tidak disetujui
        $deletedRows = PengalokasianRuang::where('kode_ruang', $kode_ruang)
            ->where('status', '!=', 'disetujui')
            ->delete();

        if ($deletedRows > 0) {
            return redirect()->route('pengalokasianruang.index')->with('success', 'Data berhasil dihapus');
        } else {
            return redirect()->route('pengalokasianruang.index')->with('error', 'Data tidak diizinkan untuk dihapus.');
        }
    }
}
