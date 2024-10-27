<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function register()
    {
        $data['title'] = 'Register';
        return view('user/register', $data);
    }

    public function register_action(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:tb_user',
            'name' => 'required',
            'password' => 'required',
            'password_confirm' => 'required|same:password',
        ]);

        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            // 'password' => $request->password,
        ]);
        $user->save();

        return redirect()->route('login')->with('success', 'Registration success. Please login!');
    }


    public function login()
    {
        $data['title'] = 'Login';
        return view('user/login', $data);
    }

    public function login_action(Request $request)
    {
        Session::flash('email', $request->email);
        $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required',
            ],
            [
                'email.required' => 'Email wajib diisi',
                'password.required' => 'Password wajib diisi',
            ]
        );

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            $request->session()->regenerate();

            // Pengecekan role berdasarkan relasi
            $user = Auth::user();

            $roles = [];

            if ($user->mahasiswa) {
                $roles[] = 'mahasiswa';
            }
            if ($user->pembimbingAkademik) {
                $roles[] = 'pembimbingakademik';
            }
            if ($user->ketuaProgramStudi) {
                $roles[] = 'ketuaprogramstudi';
            }
            if ($user->dekan) {
                $roles[] = 'dekan';
            }
            if ($user->bagianAkademik) {
                $roles[] = 'bagianakademik';
            }
            if ($user->dosen) {
                $roles[] = 'dosenpengampu';
            }
            if (count($roles) === 1) {
                // Menyimpan role yang ditemukan
                session(['role' => $roles[0]]);
                // Mengarahkan ke route berdasarkan role
                return redirect()->route($roles[0]);
            }
            // Jika user punya lebih dari 1 role, arahkan ke halaman pemilihan role
            return view('user.pemilihanrole', compact('roles'));
        }

        return back()->withErrors([
            'password' => 'Wrong email or password',
        ]);
    }

    public function handleRoleSelection(Request $request)
    {
        $request->validate([
            'role' => 'required|string',
        ]);

        // Simpan role yang dipilih di session
        session(['role' => $request->role]);

        // Redirect ke dashboard berdasarkan role yang dipilih
        switch ($request->role) {
            case 'mahasiswa':
                return redirect()->route('mahasiswa');
            case 'pembimbingakademik':
                return redirect()->route('pembimbingakademik');
            case 'ketuaprogramstudi':
                return redirect()->route('ketuaprogramstudi');
            case 'dekan':
                return redirect()->route('dekan');
            case 'bagianakademik':
                return redirect()->route('bagianakademik');
            case 'dosenpengampu':
                return redirect()->route('dosenpengampu');
            default:
                return redirect()->route('home');
        }
    }

    public function index()
    {
        // Ambil pengguna yang sedang login
        $user = Auth::user();

        // Pastikan user ditemukan
        if (!$user) {
            return redirect()->route('login')->withErrors(['message' => 'User tidak ditemukan.']);
        }

        // Ambil data role berdasarkan relasi
        $bagianAkademik = $user->bagianAkademik;
        $dekan = $user->dekan;
        $pembimbingAkademik = $user->pembimbingAkademik;
        $ketuaProgramStudi = $user->ketuaProgramStudi;
        $mahasiswa = $user->mahasiswa;
        $dosen = $user->dosen; // Ambil relasi dosen dari user

        // Redirect sesuai dengan role yang dipilih
        switch (session('role')) {
            case 'mahasiswa':
                return $this->redirectMahasiswa($mahasiswa, $user);
            case 'bagianakademik':
                return $this->redirectBagianAkademik($bagianAkademik, $user);
            case 'dekan':
                return $this->redirectDekan($dekan, $user);
            case 'ketuaprogramstudi':
                return $this->redirectKetuaProgramStudi($ketuaProgramStudi, $user);
            case 'pembimbingakademik':
                return $this->redirectPembimbingAkademik($pembimbingAkademik, $user);
            case 'dosenpengampu':
                return $this->redirectDosenPengampu($dosen, $user);
            default:
                return redirect()->route('home');
        }
    }

    protected function redirectBagianAkademik($bagianAkademik, $user)
    {
        if ($bagianAkademik) {
            return view('bagianakademik.dashboard', [
                'user' => $user,
                'nidn' => $bagianAkademik->nidn_bagianakademik
            ]);
        }
        return redirect()->route('home');
    }

    protected function redirectDekan($dekan, $user)
    {
        if ($dekan) {
            return view('dekan.dashboard', [
                'user' => $user,
                'nidn' => $dekan->nidn_dekan
            ]);
        }
        return redirect()->route('home');
    }

    protected function redirectKetuaProgramStudi($ketuaProgramStudi, $user)
    {
        if ($ketuaProgramStudi) {
            return view('ketuaprogramstudi.dashboard', [
                'user' => $user,
                'nidn' => $ketuaProgramStudi->nidn_ketuaprogramstudi
            ]);
        }
        return redirect()->route('home');
    }

    protected function redirectPembimbingAkademik($pembimbingAkademik, $user)
    {
        if ($pembimbingAkademik) {
            return view('pembimbingakademik.dashboard', [
                'user' => $user,
                'nidn' => $pembimbingAkademik->nidn_pembimbingakademik
            ]);
        }
        return redirect()->route('home');
    }

    protected function redirectDosenPengampu($dosen, $user)
    {
        if ($dosen) {
            return view('dosenpengampu.dashboard', [
                'user' => $user,
                'nidn' => $dosen->nidn
            ]);
        }
        return redirect()->route('home');
    }

    protected function redirectMahasiswa($mahasiswa, $user)
    {
        if ($mahasiswa) {
            return view('mahasiswa.dashboard', [
                'user' => $user,
                'nim' => $mahasiswa->nim
            ]);
        }
        return redirect()->route('home');
    }


    public function password()
    {
        $data['title'] = 'Change Password';
        return view('user/password', $data);
    }

    public function password_action(Request $request)
    {
        $request->validate([
            'old_password' => 'required|current_password',
            'new_password' => 'required|confirmed',
        ]);
        $user = User::find(Auth::id());
        $user->password = Hash::make($request->new_password);
        // $user->password = ($request->new_password);
        $user->save();
        $request->session()->regenerate();
        return back()->with('success', 'Password changed!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Anda Berhasil Logout');
    }
}

 // public function index()
    // {
    //     // Ambil pengguna yang sedang login
    //     $user = Auth::user();

    //     // Pastikan user ditemukan
    //     if (!$user) {
    //         return redirect()->route('login')->withErrors(['message' => 'User tidak ditemukan.']);
    //     }

    //     // Ambil data role berdasarkan relasi
    //     $bagianAkademik = $user->bagianAkademik;
    //     $dekan = $user->dekan;
    //     $pembimbingAkademik = $user->pembimbingAkademik;
    //     $ketuaProgramStudi = $user->ketuaProgramStudi;
    //     $mahasiswa = $user->mahasiswa;
    //     $dosen = $user->dosen; // Ambil relasi dosen dari user

    //     // Redirect sesuai dengan role yang dipilih
    //     if (session('role') == 'bagianakademik' && $bagianAkademik) {
    //         return view('bagianakademik.dashboard', [
    //             'user' => $user,
    //             'nidn' => $bagianAkademik->nidn_bagianakademik
    //         ]);
    //     } elseif (session('role') == 'dekan' && $dekan) {
    //         return view('dekan.dashboard', [
    //             'user' => $user,
    //             'nidn' => $dekan->nidn_dekan
    //         ]);
    //     } elseif (session('role') == 'ketuaprogramstudi' && $ketuaProgramStudi) {
    //         return view('ketuaprogramstudi.dashboard', [
    //             'user' => $user,
    //             'nidn' => $ketuaProgramStudi->nidn_ketuaprogramstudi
    //         ]);
    //     } elseif (session('role') == 'pembimbingakademik' && $pembimbingAkademik) {
    //         return view('pembimbingakademik.dashboard', [
    //             'user' => $user,
    //             'nidn' => $pembimbingAkademik->nidn_pembimbingakademik
    //         ]);
    //     } elseif (session('role') == 'dosenpengampu' && $dosen) {
    //         return view('dosenpengampu.dashboard', [
    //             'user' => $user,
    //             'nidn' => $dosen->nidn
    //         ]);
    //     } elseif ($mahasiswa) {
    //         return view('mahasiswa.dashboard', [
    //             'user' => $user,
    //             'nim' => $mahasiswa->nim
    //         ]);
    //     }

    //     return redirect()->route('home');
    // }

// public function dashboardBagianAkademik()
// {
//     $user = Auth::user();
//     $bagianAkademik = $user->bagianAkademik;

//     return view('bagianakademik.dashboard', [
//         'user' => $user,
//         'nidn' => $bagianAkademik->nidn_bagianakademik,
//     ]);
// }

// public function dashboardDekan()
// {
//     $user = Auth::user();
//     $dekan = $user->dekan;

//     return view('dekan.dashboard', [
//         'user' => $user,
//         'nidn' => $dekan->nidn_dekan,
//     ]);
// }

// public function dashboardPembimbingAkademik()
// {
//     $user = Auth::user();
//     $pembimbingAkademik = $user->pembimbingAkademik;

//     return view('pembimbingakademik.dashboard', [
//         'user' => $user,
//         'nidn' => $pembimbingAkademik->nidn_pembimbingakademik,
//     ]);
// }

// public function dashboardKetuaProgramStudi()
// {
//     $user = Auth::user();
//     $ketuaProgramStudi = $user->ketuaProgramStudi;

//     return view('ketuaprogramstudi.dashboard', [
//         'user' => $user,
//         'nidn' => $ketuaProgramStudi->nidn_ketuaprogramstudi,
//     ]);
// }

// public function dashboardMahasiswa()
// {
//     $user = Auth::user();
//     $mahasiswa = $user->mahasiswa;

//     return view('mahasiswa.dashboard', [
//         'user' => $user,
//         'nim' => $mahasiswa->nim,
//     ]);
// }
