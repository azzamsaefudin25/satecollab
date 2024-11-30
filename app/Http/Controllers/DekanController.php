<?php

namespace App\Http\Controllers;

use App\Models\PengalokasianRuang;
use App\Models\JadwalKuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DekanController extends Controller
{
    // public function dashboard()
    // {
    //     $user = Auth::user();
    //     $dekan = $user->dosen ? $user->dosen->dekan : null;
    //     if (!$user) {
    //         return redirect()->route('login')->withErrors(['message' => 'User tidak ditemukan.']);
    //     }

    //     $nama = $user->name;
    //     $nidn = null;

    //     if ($dekan) {
    //         $nidn = $dekan->nidn_dekan;
    //         return view('dekan.dashboard', compact('nama', 'nidn'));
    //     }
    //     // return redirect()->route('home');
    // }

    public function indexPengajuanRuang(Request $request)
    {
        $pengajuans_ruang = PengalokasianRuang::with('programStudi');

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
        $pengajuans_ruang = $pengajuans_ruang->orderBy('id', 'desc')->paginate(5);

        return view('dekan.approveruang', compact('pengajuans_ruang'));
    }

    public function indexPengajuanJadwal(Request $request)
    {
        $pengajuans = JadwalKuliah::with('mataKuliah');

        if ($request->has('search')) {
            $search = $request->input('search');
            $pengajuans->where(function ($query) use ($search) {
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
        $pengajuans = $pengajuans->orderBy('hari', 'desc')->paginate(5);

        return view('dekan.approvejadwal', compact('pengajuans'));
    }

    // Menyetujui atau menolak pengalokasian ruang (diakses oleh dekan)
    public function updatePengajuanRuang(Request $request, $id)
    {
        if ($request->input('action') === 'setuju') {

            PengalokasianRuang::query()->update(['status' => 'disetujui']);

            return redirect()->route('dekan.approveruang')->with('success', 'Pengajuan ruangan telah disetujui.');

        }elseif ($request->input('action') === 'ubah') {

            PengalokasianRuang::query()->update(['status' => 'menunggu konfirmasi']);

            return redirect()->route('dekan.approveruang')->with('success', 'Pengajuan ruangan telah dibatalkan');
        }

        return redirect()->route('dekan.approveruang')->with('error', 'Tindakan tidak valid.');
    }


    // Menyetujui atau menolak jadwal kuliah (diakses oleh dekan)
    public function updatePengajuanJadwal(Request $request, $id)
    {
        $pengajuan = JadwalKuliah::findOrFail($id);

        if ($request->input('action') === 'setuju') {
            // Update status jadwal menjadi disetujui
            $pengajuan->status = 'disetujui';
            $pengajuan->save();

            return redirect()->route('dekan.approvejadwal')->with('success', 'Jadwal dengan kode MK ' . $pengajuan->kode_mk . ' telah disetujui.');
        } elseif ($request->input('action') === 'tolak') {
            // Update status jadwal menjadi ditolak (tanpa menghapus dari database)
            $pengajuan->status = 'ditolak';
            $pengajuan->save();

            return redirect()->route('dekan.approvejadwal')->with('success', 'Jadwal dengan kode MK ' . $pengajuan->kode_mk . ' telah ditolak.');
        }

        return redirect()->route('dekan.approvejadwal')->with('error', 'Tindakan tidak valid.');
    }
}
