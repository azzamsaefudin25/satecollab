<?php

namespace App\Http\Controllers;

use App\Models\IRS;
use App\Models\JadwalKuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IRSController extends Controller
{
    public function index()
    {
        $irsIndex = IRS::with(['mataKuliah'])->get();
        $jadwalKuliah = JadwalKuliah::all()->keyBy(function ($item) {
            return $item->kode_mk . '-' . $item->nama_kelas;
        });

        return view('mahasiswa.IRS.index', compact('irsIndex', 'jadwalKuliah'));
    }

    public function store(Request $request)
    {
        $responseMessages = [];

        foreach ($request->irsData as $data) {
            // Cek apakah mata kuliah sudah diajukan dengan kombinasi nim, kode_mk, dan nama_kelas
            $existingIrs = Irs::where('nim', $data['nim'])
                ->where('kode_mk', $data['kode_mk'])
                ->whereIn('status_approve', ['menunggu konfirmasi', 'disetujui'])
                ->first();

            if ($existingIrs) {
                // Jika sudah ada, tambahkan pesan error untuk data tersebut dengan status_approve dari database
                $responseMessages[] = "IRS dengan kode mata kuliah {$data['kode_mk']} sudah pernah diajukan dengan status {$existingIrs->status_approve}.";
            } else {
                // Jika belum ada, buat data IRS baru
                Irs::create([
                    'nim' => $data['nim'],
                    'kode_ruang' => $data['kode_ruang'],
                    'kode_mk' => $data['kode_mk'],
                    'nama_kelas' => $data['nama_kelas'],
                    'status' => 'baru', // Atur sesuai kebutuhan
                    'status_approve' => 'menunggu konfirmasi'
                ]);
                $responseMessages[] = "IRS dengan kode mata kuliah {$data['kode_mk']} berhasil diajukan.";
            }
        }

        // Kirim respons sebagai array pesan
        return response()->json([
            'messages' => $responseMessages
        ]);
    }
}
