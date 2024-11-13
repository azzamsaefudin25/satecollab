<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PembimbingAkademikController extends Controller
{
    public function dashboard()
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
            return view('pembimbingakademik.dashboard', compact('nama', 'nidn'));
        }
        return redirect()->route('home');
    }
}
