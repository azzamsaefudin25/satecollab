<?php

namespace App\Http\Controllers;

use App\Models\PengalokasianRuang;
use App\Models\JadwalKuliah;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DekanController extends Controller
{
    public function profile()
    {
        $user = Auth::user();
        $dekan = $user->dosen ? $user->dosen->dekan : null;

        if (!$user) {
            return redirect()->route('login')->withErrors(['message' => 'User tidak ditemukan.']);
        }

        $nama = $user->name;
        $nidn = null;

        if ($dekan) {
            $nidn = $dekan->nidn_dekan;
            return view('dekan.profile', compact('nama', 'nidn'));
        }
        return redirect()->route('home');
    }

    public function indexPengajuanRuang(Request $request)
    {
        $user = Auth::user();
        $dekan = $user->dosen ? $user->dosen->dekan : null;
        if (!$user) {
            return redirect()->route('login')->withErrors(['message' => 'User tidak ditemukan.']);
        }

        $nama = $user->name;
        $nidn = $dekan->nidn_dekan;

        $pengajuans_ruang = PengalokasianRuang::with('programStudi');
        $prodis = ProgramStudi::all(); // Ambil semua prodi 

        if ($request->has('search')) {
            $search = $request->input('search');
            $pengajuans_ruang->where(function ($query) use ($search) {
                $query->where('kode_ruang', 'like', '%' . $search . '%')
                    ->orWhere('status', 'like', '%' . $search . '%')
                    ->orWhereHas('programStudi', function ($q) use ($search) {
                        $q->where('nama_programstudi', 'like', '%' . $search . '%');
                    });
            });
        }

        $pengajuans_ruang = $pengajuans_ruang->orderBy('id_programstudi', 'asc')->paginate(5);

        return view('dekan.approveruang', compact('pengajuans_ruang', 'prodis', 'nama', 'nidn'));
    }

    public function updatePengajuanRuangPerProdi(Request $request)
    {
        // Log::info('Action: ' . $request->input('action'));
        // Log::info('ID Program Studi: ' . $request->input('id_programstudi'));
        $action = $request->input('action');
        $id_programstudi = $request->input('id_programstudi');

        if ($action === 'setuju2') {
            PengalokasianRuang::where('id_programstudi', $id_programstudi)
                ->where('status', 'menunggu konfirmasi')
                ->update(['status' => 'disetujui']);

            return redirect()->route('dekan.approveruang')->with('success', 'Pengajuan ruangan untuk Prodi dengan ID ' . $id_programstudi . ' telah disetujui.');
        } elseif ($action === 'ubah2') {
            PengalokasianRuang::where('id_programstudi', $id_programstudi)
                ->whereIn('status', ['disetujui'])
                ->update(['status' => 'menunggu konfirmasi']);

            return redirect()->route('dekan.approveruang')->with('success', 'Pengajuan ruangan untuk Prodi dengan ID ' . $id_programstudi . ' telah dibatalkan.');
        }

        return redirect()->route('dekan.approveruang')->with('error', 'Tindakan tidak valid.');
    }
    // Menyetujui atau menolak semua pengalokasian ruang (diakses oleh dekan)
    public function updatePengajuanRuang(Request $request)
    {
        if ($request->input('action') === 'setuju') {
            PengalokasianRuang::where('status', 'menunggu konfirmasi') // Hanya setujui yang statusnya 'menunggu konfirmasi'
                ->update(['status' => 'disetujui']);

            return redirect()->route('dekan.approveruang')->with('success', 'Semua pengajuan ruangan telah disetujui.');
        } elseif ($request->input('action') === 'ubah') {
            PengalokasianRuang::whereIn('status', ['disetujui']) // Hanya ubah yang statusnya 'disetujui' atau 'ditolak'
                ->update(['status' => 'menunggu konfirmasi']);

            return redirect()->route('dekan.approveruang')->with('success', 'Semua pengajuan ruangan telah dibatalkan.');
        }

        return redirect()->route('dekan.approveruang')->with('error', 'Tindakan tidak valid.');
    }

    public function indexPengajuanJadwal(Request $request)
    {
        $user = Auth::user();
        $dekan = $user->dosen ? $user->dosen->dekan : null;
        if (!$user) {
            return redirect()->route('login')->withErrors(['message' => 'User tidak ditemukan.']);
        }

        $nama = $user->name;
        $nidn = $dekan->nidn_dekan;

        $pengajuans_jadwal = JadwalKuliah::with('mataKuliah');
        $prodis = ProgramStudi::all();

        if ($request->has('search')) {
            $search = $request->input('search');
            $pengajuans_jadwal->where(function ($query) use ($search) {
                $query->where('kode_mk', 'like', '%' . $search . '%')
                    ->orWhereHas('mataKuliah', function ($q) use ($search) {
                        $q->where('nama_mk', 'like', '%' . $search . '%');
                    })
                    ->orWhere('kode_ruang', 'like', '%' . $search . '%')
                    ->orWhere('nama_kelas', 'like', '%' . $search . '%')
                    ->orWhere('semester', 'like', '%' . $search . '%')
                    ->orWhere('sks', 'like', '%' . $search . '%')
                    ->orWhere('jenis', 'like', '%' . $search . '%')
                    ->orWhere('semester_aktif', 'like', '%' . $search . '%')
                    ->orWhere('tahun_ajaran', 'like', '%' . $search . '%')
                    ->orWhere('hari', 'like', '%' . $search . '%')
                    ->orWhere('jam_mulai', 'like', '%' . $search . '%')
                    ->orWhere('jam_selesai', 'like', '%' . $search . '%')
                    ->orWhere('status', 'like', '%' . $search . '%');
            });
        }
        $pengajuans_jadwal = $pengajuans_jadwal->orderBy('hari', 'desc')->paginate(5);

        return view('dekan.approvejadwal', compact('pengajuans_jadwal', 'prodis', 'nama', 'nidn'));
    }


    // Menyetujui atau menolak jadwal kuliah (diakses oleh dekan)
    public function updatePengajuanJadwal(Request $request)
    {
        if ($request->input('action') === 'setuju') {
            // Update status jadwal menjadi disetujui
            JadwalKuliah::query()->update(['status' => 'disetujui']);

            return redirect()->route('dekan.approvejadwal')->with('success', 'Pengajuan Jadwal telah disetujui.');
        } elseif ($request->input('action') === 'ubah') {
            // Update status jadwal menjadi ditolak (tanpa menghapus dari database)
            JadwalKuliah::query()->update(['status' => 'menunggu konfirmasi']);

            return redirect()->route('dekan.approvejadwal')->with('success', 'Pengajuan Jadwal telah dibatalkan.');
        }

        return redirect()->route('dekan.approvejadwal')->with('error', 'Tindakan tidak valid.');
    }

    // Menyetujui atau menolak jadwal kuliah per prodi (diakses oleh dekan)
    public function updatePengajuanJadwalPerProdi(Request $request)
    {
        // Log::info('Action: ' . $request->input('action'));
        // Log::info('ID Program Studi: ' . $request->input('id_programstudi'));
        $action = $request->input('action');
        $id_programstudi = $request->input('id_programstudi');

        if ($action === 'setuju2') {
            JadwalKuliah::whereHas('mataKuliah', function ($query) use ($id_programstudi) {
                $query->where('id_programstudi', $id_programstudi);
            })
                ->where('status', 'menunggu konfirmasi')
                ->update(['status' => 'disetujui']);

            return redirect()->route('dekan.approvejadwal')->with('success', 'Pengajuan ruangan untuk Prodi dengan ID ' . $id_programstudi . ' telah disetujui.');
        } elseif ($action === 'ubah2') {
            JadwalKuliah::whereHas('mataKuliah', function ($query) use ($id_programstudi) {
                $query->where('id_programstudi', $id_programstudi);
            })
                ->whereIn('status', ['disetujui'])
                ->update(['status' => 'menunggu konfirmasi']);

            return redirect()->route('dekan.approvejadwal')->with('success', 'Pengajuan ruangan untuk Prodi dengan ID ' . $id_programstudi . ' telah dibatalkan.');
        }

        return redirect()->route('dekan.approvejadwal')->with('error', 'Tindakan tidak valid.');
    }
}
