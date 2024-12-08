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
    public function profile()
    {
        $user = Auth::user();
        $pembimbingAkademik = $user->dosen ? $user->dosen->pembimbingAkademik : null;

        if (!$user) {
            return redirect()->route('login')->withErrors(['message' => 'User tidak ditemukan.']);
        }

        $nama = $user->name;
        $nidn = null;

        if ($pembimbingAkademik) {
            $nidn = $pembimbingAkademik->nidn_pembimbingakademik;
            $programstudi = $pembimbingAkademik->dosen->programStudi->nama_programstudi ?? 'Program Studi tidak ditemukan';
            return view('pembimbingakademik.profile', compact('nama', 'nidn', 'programstudi'));
        }
        return redirect()->route('home');
    }

    public function approveIRS(Request $request)
    {
        $user = Auth::user();
        $pembimbingAkademik = $user->dosen ? $user->dosen->pembimbingAkademik : null;

        if (!$user) {
            return redirect()->route('login')->withErrors(['message' => 'User tidak ditemukan.']);
        }

        $nama = $user->name;
        $nidn = $pembimbingAkademik->nidn_pembimbingakademik;

        $userEmail = Auth::user()->email;
        $pembimbing = PembimbingAkademik::where('email', $userEmail)->first();

        if (!$pembimbing) {
            Log::error('Pembimbing akademik tidak ditemukan untuk email: ' . $userEmail);
            return back()->with('error', 'Akses ditolak: Data pembimbing akademik tidak ditemukan.');
        }

        // Hitung statistik total tanpa pagination
        $totalMahasiswa = Mahasiswa::where('nidn_pembimbingakademik', $pembimbing->nidn_pembimbingakademik)->count();
        $mahasiswaVerified = Mahasiswa::whereHas('irs', function ($query) {
            $query->where('status_approve', 'disetujui');
        })->where('nidn_pembimbingakademik', $pembimbing->nidn_pembimbingakademik)->count();
        $mahasiswaIsiIRS = Mahasiswa::whereHas('irs')->where('nidn_pembimbingakademik', $pembimbing->nidn_pembimbingakademik)->count();

        // Query mahasiswa dengan pagination
        $mahasiswa = Mahasiswa::with('irs')
            ->where('nidn_pembimbingakademik', $pembimbing->nidn_pembimbingakademik);

        // Tambahkan fitur pencarian jika ada
        if ($request->has('search')) {
            $search = $request->input('search');
            $mahasiswa->where(function ($query) use ($search) {
                $query->where('nim', 'like', '%' . $search . '%')
                    ->orWhere('nama_mahasiswa', 'like', '%' . $search . '%')
                    ->orWhere('semester', 'like', '%' . $search . '%')
                    ->orwhereHas('irs', function ($query) use ($search) {
                        $query->where('status_approve','like', '%' . $search . '%');
                    });
            });
        }

        // Lakukan pagination
        $mahasiswaPaginated = $mahasiswa->orderBy('nama_mahasiswa', 'asc')->paginate(5);

        // Siapkan data untuk view
        $data = [
            'totalMahasiswa' => $totalMahasiswa,
            'mahasiswaVerified' => $mahasiswaVerified,
            'mahasiswaIsiIRS' => $mahasiswaIsiIRS,
            'mahasiswa' => $mahasiswaPaginated
        ];

        return view('pembimbingakademik.verifikasiirs', compact('data', 'nama', 'nidn'));
    }

    public function approveIRS2($nim)
    {
        try {
            // Validasi akses
            $user = Auth::user();
            $userEmail = $user->email;
            $pembimbingAkademik = $user->dosen ? $user->dosen->pembimbingAkademik : null;

            if (!$user) {
                return redirect()->route('login')->withErrors(['message' => 'User tidak ditemukan.']);
            }

            $nama = $user->name;
            $nidn = $pembimbingAkademik->nidn_pembimbingakademik;
            $pembimbing = PembimbingAkademik::where('email', $userEmail)->firstOrFail();

            // Cek apakah mahasiswa adalah bimbingan dari pembimbing yang login
            $mahasiswa = Mahasiswa::where('nim', $nim)
                ->where('nidn_pembimbingakademik', $pembimbing->nidn_pembimbingakademik)
                ->firstOrFail();

            // Ambil IRS mahasiswa dengan relasi yang diperlukan
            $irs = IRS::where('nim', $nim)
                ->with('jadwalkuliah.mataKuliah')
                ->get();

            return view('pembimbingakademik.lihatverifikasi', compact('mahasiswa', 'irs', 'nama', 'nidn'));
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
