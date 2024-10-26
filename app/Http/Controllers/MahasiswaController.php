<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalKuliah;

class MahasiswaController extends Controller
{
    public function createIRS()
    {
        $jadwal = JadwalKuliah::all();
        return view('mahasiswa.IRS.create', compact('jadwal'));
    }
    // MahasiswaController.php
    public function searchMatakuliah(Request $request)
    {
        $query = $request->get('query');
        $mataKuliah = JadwalKuliah::where('status', 'disetujui') // Filter berdasarkan status
                                    ->where('nama_mk', 'LIKE', "%{$query}%")
                                    ->orderBy('nama_mk', 'asc')
                                    ->get(['kode_mk', 'nama_mk', 'jenis', 'semester', 'nama_kelas']);
    
        $result = $mataKuliah->map(function($mk) {
            return [
                'id' => $mk->kode_mk,
                'text' => "{$mk->nama_mk} - {$mk->jenis} - Semester {$mk->semester} - kelas {$mk->nama_kelas} "
            ];
        });
    
        // Tambahkan log untuk debugging
        \Log::info($result);
    
        return response()->json(['results' => $result]);
    }
    
}
