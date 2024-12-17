<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\IRS;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class IRSController extends Controller
{
    public function downloadPdf(Request $request)
    {
        // Dapatkan data mahasiswa yang sedang login
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login')->withErrors(['message' => 'User tidak ditemukan.']);
        }

        $mahasiswa = $user->mahasiswa;
        $nama = $user->name;
        $nim = $mahasiswa->nim;
        $prodi = $mahasiswa->programStudi->nama_programstudi;
        $pa = $mahasiswa->pembimbingAkademik->nama_pembimbingakademik;
        // Dapatkan data IRS milik mahasiswa tersebut
        $irs = $mahasiswa->irs()->where('status_approve', 'disetujui')->get();

        // Buat PDF dari data IRS
        $pdf = PDF::loadView('PDF.pdfirs', compact('irs', 'nama', 'nim', 'prodi', 'pa'));
        $pdf->setPaper('a4', 'potrait');

        return $pdf->download("IRS_{$nama}_{$nim}.pdf");
    }

    public function downloadPdf2(Request $request, $nim)
    {
        // Dapatkan data mahasiswa yang sedang login
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login')->withErrors(['message' => 'User tidak ditemukan.']);
        }
        
        // $mahasiswa = $user->mahasiswa;
        $mahasiswa = $user->dosen->pembimbingAkademik->mahasiswa()->where('nim', $nim)->first();
        $nama = $mahasiswa->nama_mahasiswa;
        $nim = $mahasiswa->nim;
        $prodi = $mahasiswa->programStudi->nama_programstudi;
        $pa = $mahasiswa->pembimbingAkademik->nama_pembimbingakademik;
        // Dapatkan data IRS milik mahasiswa tersebut
        $irs = $mahasiswa->irs()->where('status_approve', 'disetujui')->get();

        // Buat PDF dari data IRS
        $pdf = PDF::loadView('PDF.pdfirs', compact('irs', 'nama', 'nim', 'prodi', 'pa'));
        $pdf->setPaper('a4', 'potrait');

        // Unduh PDF
        return $pdf->download("IRS_Mahasiswa_{$nama}_{$nim}.pdf");
    }
}
