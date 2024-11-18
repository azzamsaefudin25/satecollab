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
            if (!$user) {
                return redirect()->back()->withErrors(['error' => 'Pengguna tidak ditemukan.']);
            }

            $roles = [];
            // Periksa jika user adalah mahasiswa
            if ($user->mahasiswa) {
                $roles[] = 'mahasiswa';
            }
            if ($user->bagianAkademik) {
                $roles[] = 'bagianakademik';
            }
            // Cek apakah user memiliki relasi dosen, dan periksa role terkait dosen jika ada

            if ($user->dosen) {
                if ($user->dosen->pembimbingAkademik) {
                    $roles[] = 'pembimbingakademik';
                }
                if ($user->dosen->ketuaProgramStudi) {
                    $roles[] = 'ketuaprogramstudi';
                }
                if ($user->dosen->dekan) {
                    $roles[] = 'dekan';
                }
                // Role dosen pengampu
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

        session(['role' => $request->role]);

        return redirect()->route($request->role);
    }

    public function Dashboard()
    {
        $user = Auth::user();

        // Pastikan pengguna ada
        if (!$user) {
            return redirect()->route('login')->withErrors(['message' => 'User tidak ditemukan.']);
        }

        // Inisialisasi variabel nama dan nip
        $nama = $user->name;
        $nip = null;
        $nidn = null;
        $nim = null;
        $view = null;
        $bagianAkademik = $user->bagianAkademik;
        $dekan = $user->dosen ? $user->dosen->dekan : null;
        $pembimbingAkademik = $user->dosen ? $user->dosen->pembimbingAkademik : null;
        $ketuaProgramStudi = $user->dosen ? $user->dosen->ketuaProgramStudi : null;
        $mahasiswa = $user->mahasiswa;
        $dosen = $user->dosen;
        $prodi = $user->mahasiswa ? $user->mahasiswa->programStudi : null;
        // Tentukan NIP dan tampilan berdasarkan role yang dipilih
        if (session('role') == 'bagianakademik' && $bagianAkademik) {
            $nip = $user->bagianAkademik->nip;
            $view = 'bagianakademik.dashboard';
        } elseif (session('role') == 'dekan' && $dekan) {
            $nidn = $dekan->nidn_dekan;
            $view = 'dekan.dashboard';
        } elseif (session('role') == 'ketuaprogramstudi' && $ketuaProgramStudi) {
            $nidn = $ketuaProgramStudi->nidn_ketuaprogramstudi;
            $view = 'ketuaprogramstudi.dashboard';
        } elseif (session('role') == 'pembimbingakademik' && $pembimbingAkademik) {
            $nidn = $pembimbingAkademik->nidn_pembimbingakademik;
            $view = 'pembimbingakademik.dashboard';
        } elseif (session('role') == 'dosenpengampu' && $dosen) {
            $nidn = $dosen->nidn_dosen;
            $view = 'dosenpengampu.dashboard';
        } elseif (session('role') == 'mahasiswa' && $mahasiswa) {
            $nim = $mahasiswa->nim;
            $jurusan = $prodi->nama_programstudi;
            $view = 'mahasiswa.dashboard';
        } else {
            return redirect()->route('home')->withErrors(['message' => 'Role tidak dikenali atau tidak ada data terkait.']);
        }

        // Kirim data nama dan nip ke tampilan yang sesuai
        return view($view, compact('nama', 'nip', 'nidn', 'nim'));
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

    // public function handleRoleSelection(Request $request)
    // {
    //     $request->validate([
    //         'role' => 'required|string',
    //     ]);

    //     // Simpan role yang dipilih di session
    //     session(['role' => $request->role]);

    //     // Redirect ke dashboard berdasarkan role yang dipilih
    //     switch ($request->role) {
    //         case 'mahasiswa':
    //             return redirect()->route('mahasiswa');
    //         case 'pembimbingakademik':
    //             return redirect()->route('pembimbingakademik');
    //         case 'ketuaprogramstudi':
    //             return redirect()->route('ketuaprogramstudi');
    //         case 'dekan':
    //             return redirect()->route('dekan');
    //         case 'bagianakademik':
    //             return redirect()->route('bagianakademik');
    //         case 'dosenpengampu':
    //             return redirect()->route('dosenpengampu');
    //         default:
    //             return redirect()->route('home');
    //     }
    // }