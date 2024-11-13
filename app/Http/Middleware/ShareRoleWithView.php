<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ShareRoleWithView
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if ($user) {
            $dekan = $user->dosen ? $user->dosen->dekan : null;
            $bagianAkademik = $user->bagianAkademik;

            if ($dekan) {
                // Bagikan data ke session
                session([
                    'role' => 'dekan',
                    'nidn' => $dekan->nidn_dekan,
                    'user' => $user
                ]);
            } elseif ($bagianAkademik) {
                // Bagikan data ke session
                session([
                    'role' => 'bagianAkademik',
                    'nip' => $bagianAkademik->nip,
                    'user' => $user
                ]);
            }
        }

        return $next($request);
    }
}
