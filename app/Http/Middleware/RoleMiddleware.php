<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    // public function handle(Request $request, Closure $next, $role)
    // {
    //     $user = Auth::user();

    //     if (!$user) {
    //         return redirect()->route('login');
    //     }

    //     // Check if the user's role matches the requested route role
    //     if (!$this->userHasRole($user, $role)) {
    //         return redirect()->route('home')->withErrors(['error' => 'Unauthorized access.']);
    //     }

    //     return $next($request);
    // }
    // Middleware untuk mengatur role dari query parameter
    public function handle($request, Closure $next)
    {
        if ($request->has('role')) {
            session(['role' => $request->query('role')]);
        }

        return $next($request);
    }

    // private function userHasRole($user, $role)
    // {
    //     switch ($role) {
    //         case 'mahasiswa':
    //             return $user->mahasiswa !== null;
    //         case 'bagianakademik':
    //             return $user->bagianAkademik !== null;
    //         case 'dekan':
    //             return $user->dosen && $user->dosen->dekan !== null;
    //         case 'ketuaprogramstudi':
    //             return $user->dosen && $user->dosen->ketuaProgramStudi !== null;
    //         case 'pembimbingakademik':
    //             return $user->dosen && $user->dosen->pembimbingAkademik !== null;
    //         case 'dosenpengampu':
    //             return $user->dosen !== null;
    //         default:
    //             return false;
    //     }
    // }
}
