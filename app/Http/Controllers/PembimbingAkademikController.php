<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Mahasiswa; // Pastikan ini ada
use App\Models\IRS; // Pastikan ini ada
use App\Models\PembimbingAkademik;


class PembimbingAkademikController extends Controller
{
    // public function dashboard()
    // {
    //     $user = Auth::user();
    //     $pembimbingAkademik = $user->dosen ? $user->dosen->pembimbingAkademik : null;

    //     if (!$user) {
    //         return redirect()->route('login')->withErrors(['message' => 'User tidak ditemukan.']);
    //     }

    //     $nama = $user->name;
    //     $nidn = null;

    //     if ($pembimbingAkademik) {
    //         $nidn = $pembimbingAkademik->nidn_pembimbingakademik;
    //         return view('pembimbingakademik.dashboard', compact('nama', 'nidn'));
    //     }
    //     return redirect()->route('home');
    // }

    public function approveIRS()
    {
        // Ambil email user yang sedang login
        $userEmail = Auth::user()->email;

        // Cari data pembimbing akademik berdasarkan email
        $pembimbing = PembimbingAkademik::where('email', $userEmail)->first();

        if (!$pembimbing) {
            Log::error('Pembimbing akademik tidak ditemukan untuk email: ' . $userEmail);
            return back()->with('error', 'Akses ditolak: Data pembimbing akademik tidak ditemukan.');
        }

        // Ambil mahasiswa yang terkait dengan pembimbing akademik ini
        $mahasiswa = Mahasiswa::where('nidn_pembimbingakademik', $pembimbing->nidn_pembimbingakademik)
            ->with('irs') // Eager load IRS
            ->get();

        // Debug log
        Log::info('Data Pembimbing:', [
            'nidn' => $pembimbing->nidn_pembimbingakademik,
            'nama' => $pembimbing->nama_pembimbingakademik,
            'jumlah_mahasiswa' => $mahasiswa->count()
        ]);

        // Hitung statistik
        $totalMahasiswa = $mahasiswa->count();
        $mahasiswaVerified = $mahasiswa->filter(function($m) {
            return $m->irs && $m->irs->status_approve === 'disetujui';
        })->count();
        $mahasiswaIsiIRS = $mahasiswa->filter(function($m) {
            return $m->irs !== null;
        })->count();

        return view('pembimbingakademik.verifikasiirs', compact(
            'mahasiswa',
            'pembimbing',
            'totalMahasiswa',
            'mahasiswaVerified',
            'mahasiswaIsiIRS'
        ));
    }

    public function approveIRS2($nim)
    {
        try {
            // Validasi akses
            $userEmail = Auth::user()->email;
            $pembimbing = PembimbingAkademik::where('email', $userEmail)->firstOrFail();

            // Cek apakah mahasiswa adalah bimbingan dari pembimbing yang login
            $mahasiswa = Mahasiswa::where('nim', $nim)
                ->where('nidn_pembimbingakademik', $pembimbing->nidn_pembimbingakademik)
                ->firstOrFail();

            // Ambil IRS mahasiswa dengan relasi yang diperlukan
            $irs = IRS::where('nim', $nim)
                ->with('jadwalkuliah.mataKuliah')
                ->get();

            return view('pembimbingakademik.lihatverifikasi', compact('mahasiswa', 'irs'));
        } catch (\Exception $e) {
            Log::error('Error in approveIRS2: ' . $e->getMessage());
            return back()->with('error', 'Mahasiswa tidak ditemukan atau bukan mahasiswa bimbingan Anda');
        }
    }

    public function persetujuanIRS(Request $request)
    {
        try {
            $nim = $request->input('nim');
            $action = $request->input('action');

            // Validasi input
            $request->validate([
                'nim' => 'required|exists:mahasiswa,nim',
                'action' => 'required|in:setuju,ubah'
            ]);

            // Cek akses pembimbing
            $userEmail = Auth::user()->email;
            $pembimbing = PembimbingAkademik::where('email', $userEmail)->firstOrFail();

            $mahasiswa = Mahasiswa::where('nim', $nim)
                ->where('nidn_pembimbingakademik', $pembimbing->nidn_pembimbingakademik)
                ->firstOrFail();

            // Proses persetujuan
            $query = IRS::where('nim', $nim);

            if ($action === 'setuju') {
                $updated = $query->where('status_approve', 'menunggu konfirmasi')
                    ->update(['status_approve' => 'disetujui']);
                $message = 'IRS berhasil disetujui';
            } else {
                $updated = $query->where('status_approve', 'disetujui')
                    ->update(['status_approve' => 'menunggu konfirmasi']);
                $message = 'Status IRS dikembalikan ke menunggu konfirmasi';
            }

            if ($updated > 0) {
                return redirect()->back()->with('success', $message);
            } else {
                return redirect()->back()->with('error', 'Tidak ada IRS yang dapat diperbarui');
            }
        } catch (\Exception $e) {
            Log::error('Error in persetujuanIRS: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat memproses IRS');
        }
    }

}
