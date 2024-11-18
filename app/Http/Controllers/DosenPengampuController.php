<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DosenPengampuController extends Controller
{
    // public function dashboard()
    // {
    //     $user = Auth::user();
    //     $dosen = $user->dosen;

    //     if (!$user) {
    //         return redirect()->route('login')->withErrors(['message' => 'User tidak ditemukan.']);
    //     }

    //     $nama = $user->name;
    //     $nidn = null;

    //     if ($dosen) {
    //         $nidn = $dosen->nidn;
    //         return view('dosenpengampu.dashboard', compact('nama', 'nidn'));
    //     }
    //     return redirect()->route('home');
    // }
}
