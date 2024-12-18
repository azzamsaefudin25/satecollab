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
        // Dapatkan data mahasiswa
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login')->withErrors(['message' => 'User tidak ditemukan.']);
        }

        $mahasiswa = $user->mahasiswa;
        $nama = $user->name;
        $nim = $mahasiswa->nim;
        $prodi = $mahasiswa->programStudi->nama_programstudi;
        $pa = $mahasiswa->pembimbingAkademik->nama_pembimbingakademik;
        $irs = $mahasiswa->irs()->where('status_approve', 'disetujui')->get();

        // Generate PDF
        $pdf = PDF::loadView('PDF.pdfirs', compact('irs', 'nama', 'nim', 'prodi', 'pa'))
            ->setPaper('a4', 'portrait');

        // Render PDF terlebih dahulu untuk mendapatkan jumlah halaman
        $dompdf = $pdf->getDomPDF();
        $dompdf->render();

        // Tambahkan halaman di footer
        $canvas = $dompdf->getCanvas();
        $fontMetrics = new \Dompdf\FontMetrics($canvas, $dompdf->getOptions());

        $canvas->page_script(function ($pageNumber, $pageCount, $canvas, $fontMetrics) {
            $text = "Halaman $pageNumber dari $pageCount";
            $font = $fontMetrics->getFont('Times-Roman');
            $size = 10;
            $width = $canvas->get_width();
            $height = $canvas->get_height();

            // Posisi teks di tengah bawah halaman
            $x = ($width - $fontMetrics->getTextWidth($text, $font, $size)) / 2;
            $y = $height - 30;

            $canvas->text($x, $y, $text, $font, $size);
        });

        // Unduh file PDF
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
        // Render PDF terlebih dahulu untuk mendapatkan jumlah halaman
        $dompdf = $pdf->getDomPDF();
        $dompdf->render();

        // Tambahkan halaman di footer
        $canvas = $dompdf->getCanvas();
        $fontMetrics = new \Dompdf\FontMetrics($canvas, $dompdf->getOptions());

        $canvas->page_script(function ($pageNumber, $pageCount, $canvas, $fontMetrics) {
            $text = "Halaman $pageNumber dari $pageCount";
            $font = $fontMetrics->getFont('Times-Roman');
            $size = 10;
            $width = $canvas->get_width();
            $height = $canvas->get_height();

            // Posisi teks di tengah bawah halaman
            $x = ($width - $fontMetrics->getTextWidth($text, $font, $size)) / 2;
            $y = $height - 30;

            $canvas->text($x, $y, $text, $font, $size);
        });
        // Unduh PDF
        return $pdf->download("IRS_Mahasiswa_{$nama}_{$nim}.pdf");
    }
}
